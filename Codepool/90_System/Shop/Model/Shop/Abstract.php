<?php
/*
 * 888888ba                 dP  .88888.                    dP
 * 88    `8b                88 d8'   `88                   88
 * 88aaaa8P' .d8888b. .d888b88 88        .d8888b. .d8888b. 88  .dP  .d8888b.
 * 88   `8b. 88ooood8 88'  `88 88   YP88 88ooood8 88'  `"" 88888"   88'  `88
 * 88     88 88.  ... 88.  .88 Y8.   .88 88.  ... 88.  ... 88  `8b. 88.  .88
 * dP     dP `88888P' `88888P8  `88888'  `88888P' `88888P' dP   `YP `88888P'
 *
 *                          m a g n a l i s t e r
 *                                      boost your Online-Shop
 *
 * -----------------------------------------------------------------------------
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

abstract class ML_Shop_Model_Shop_Abstract {

    /**
     * @var Exception
     */
    static protected $oAuthentificationException = null;

    /**
     * if get shopinfo request have exception it will redirect to configuration
     * @var bool
     */
    protected $blRedirectInException = true;

    /**
     * can change default behavior if you don't want to redirect if there is any exception
     * @param bool $blRedirect
     * @return ML_Shop_Model_Shop_Abstract
     */
//    public function setRedirectInException($blRedirect){
//        $this->blRedirectInException = $blRedirect;
//        return $this;
//    }

    /**
     * get magnalister shop id from current shop
     * @return int|null int if shop-id found, otherwise null
     * @throws Exception
     */
	public function getShopId() {
        try {
            $aInfo = $this->getShopInfo();
            return isset($aInfo['DATA']) && isset($aInfo['DATA']['ShopID']) && !empty($aInfo['DATA']['ShopID']) ? $aInfo['DATA']['ShopID'] : null;
        } catch (MagnaException $oEx) {
            return null;
        }
    }

    /**
     * get magnalister customer id from current shop
     * @return int\null int if customer found, otherwise null
     * @throws Exception
     */
	public function getCustomerId() {
        try {
            $aInfo = $this->getShopInfo();
            return isset($aInfo['DATA']) && isset($aInfo['DATA']['CustomerID']) && !empty($aInfo['DATA']['CustomerID']) ? $aInfo['DATA']['CustomerID'] : null;
        } catch (MagnaException $oEx) {
            return null;
        }
    }

    /**
     * get marketplaces for shop as array(marketplaceid => marketplacename)
     * @return array
     * @throws Exception
     */
    public function getMarketplaces () {
        try {
            $aInfo = $this->getShopInfo();
            $aMarketplaces = array();
            if (isset($aInfo['DATA']) && isset($aInfo['DATA']['Marketplaces'])) {
                foreach ($aInfo['DATA']['Marketplaces'] as $aMarketplace) {
                    $aMarketplaces[$aMarketplace['ID']] = $aMarketplace['Marketplace'];
                }
            }
            return $aMarketplaces;
        } catch (MagnaException $oEx) {
            return array();
        }
    }

    public function addonBooked($sAddonSku) {
        $sAddonSku = strtolower($sAddonSku);
        $aAddons = $this->getAddons();
        foreach ($aAddons as $aAddon) {
            if (strtolower($aAddon['SKU']) == $sAddonSku) {
                return true;
            }
        }
        return false;
    }

    /**
     * get marketplaces for shop as array(marketplaceid => marketplacename)
     * @return array
     * @throws MLAbstract_Exception
     * @throws ML_Filesystem_Exception
     */
    public function getAddons () {
        try {
            $aInfo = $this->getShopInfo();
            return array_key_exists('DATA', $aInfo) && array_key_exists('Addons', $aInfo['DATA']) ? $aInfo['DATA']['Addons'] : array();
        } catch (MagnaException $oEx) {
            MLMessage::gi()->addDebug($oEx);
            return array();
        }
    }

    /**
     * loads shopinfo from magnalister-server
     * @param bool $blPurge
     * @return array|void
     * @throws MLAbstract_Exception
     * @throws ML_Filesystem_Exception
     * @throws MagnaException
     */
    public function getShopInfo($blPurge = false) {
        if (!ML::isInstalled() || MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.passphrase')->get('value') == null) {
            return;
        }
        if(is_object(self::$oAuthentificationException)){
            throw self::$oAuthentificationException;
        }
        try {
            $aSession = MLSession::gi()->get('setting');
            $blSession = isset($aSession['sApiUrl']) ? true : false;
        } catch (Exception $oEx) {
            $blSession = false;
        }
        if (!$blSession && MLCache::gi()->exists(__CLASS__.'__sApiUrl.txt')) { // sApiUrl cache2setting
            MLSetting::gi()->set('sApiUrl', MLCache::gi()->get(__CLASS__.'__sApiUrl.txt'), true);
        }
        try {
            $aProps = MagnaConnector::gi()->getAddRequestsProps();
            MagnaConnector::gi()->setAddRequestsProps(array());
            $aShop = MagnaConnector::gi()->submitRequestCached(
                array(
                    'SUBSYSTEM' => 'Core',
                    'ACTION' => 'GetShopInfo',
                    'CALLBACKURL' => MLHttp::gi()->getFrontendDoUrl(array()),
                    'ShopSystemVersion' => MLShop::gi()->getShopVersion(),
                ),
                30 * 60,
                $blPurge
            );
            MagnaConnector::gi()->setAddRequestsProps($aProps);
        } catch (MagnaException $oEx) {
            $aErrorArray = $oEx->getErrorArray();
            $aErrors = isset($aErrorArray['ERRORS']) && is_array($aErrorArray['ERRORS']) ? $aErrorArray['ERRORS'] : array();
            if(MLRequest::gi()->data('mp') !== 'configuration'){
                $sRequestConttolelr = MLRequest::gi()->data('controller');
                foreach($aErrors as $aError) {
                    if (
                        isset($aError['ERRORLEVEL']) && $aError['ERRORLEVEL'] === 'FATAL'
                        && isset($aError['APIACTION']) && $aError['APIACTION'] === 'CheckAuthentification'
                        && 'guide' !== $sRequestConttolelr
                        && (is_string($sRequestConttolelr) && !preg_match('/main_tools_*/', $sRequestConttolelr))
                        && $sRequestConttolelr != ''
                        && !MLHttp::gi()->isAjax()
                    ) {
                        MLHttp::gi()->redirect(array('controller' => 'configuration'));
                    }
                }
            }else{
                foreach($aErrors as $aError) {
                    if(isset($aError['APIACTION']) && $aError['APIACTION'] === 'CheckAuthentification'){
                        self::$oAuthentificationException = $oEx;
                    }
                }
            }
            MLMessage::gi()->addError($oEx);
            throw $oEx;
        }
        if (
            !$blSession
            && isset($aShop['DATA']) && isset($aShop['DATA']['APIUrl']) && !empty($aShop['DATA']['APIUrl'])
            && $aShop['DATA']['APIUrl'] !== MLSetting::gi()->data('sApiUrl')
        ) {
            $sApiUrlBackup = MLSetting::gi()->data('sApiUrl');
            MLSetting::gi()->set('sApiUrl', $aShop['DATA']['APIUrl'], true);// set responded api-url
            try {
                $aPing = MagnaConnector::gi()->submitRequest(array(
                    'SUBSYSTEM' => 'Core',
                    'ACTION' => 'Ping',
                ));
                if (!isset($aPing['STATUS']) || $aPing['STATUS'] !== 'SUCCESS') { //API dont work, rollback
                    MLSetting::gi()->set('sApiUrl', $sApiUrlBackup, true);
                } else { // set cache
                    MLCache::gi()->set(__CLASS__.'__sApiUrl.txt', MLSetting::gi()->data('sApiUrl'));
                }
            } catch (MagnaException $oEx) {
                MLSetting::gi()->set('sApiUrl', $sApiUrlBackup, true);
            }
        }
        return $aShop;
    }

    public function apiAccessAllowed() {
        try {
            $aShop = $this->getShopInfo();
            if (
                    isset($aShop['DATA'])
                    && isset($aShop['DATA']['IsAccessAllowed'])
            ) {
                MLMessage::gi()->addDebug(__FUNCTION__, $aShop);
                if ($aShop['DATA']['IsRookieLimitExceeded'] === 'yes') {
                    return false;
                } elseif ($aShop['DATA']['IsAccessAllowed'] === 'no') {
                    MLMessage::gi()->addFatal(MLi18n::gi()->get('ML_ERROR_ACCESS_DENIED_TO_SERVICE_LAYER_TEXT'));
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        } catch (Exception $oEx) {
            return false;
        }
    }

    /**
     * @return bool
     */
    public function needConvertToTargetCurrency(){
        return true;
    }

    /**
     * @return bool
     */
    public function isCurrencyMatchingNeeded() {
        return false;
    }

    /**
     * version of plugin in specific shop system
     */
    public function getPluginVersion(){
        return MLSetting::gi()->get('sClientVersion');
    }


    /**
     * Get latest version of plugin in specific shop system
     */
    public function getPluginLatestVersion() {
        try {
            $aRequest = MagnaConnector::gi()->submitRequestCached(
                array(
                    'ACTION'    => 'GetPluginVersion',
                    'SUBSYSTEM' => 'Core',
                )
            );

            if(isset($aRequest['DATA'])){
                return $aRequest['DATA'];
            }


        } catch (\Exception $ex) {
            //display respective warning
            MLMessage::gi()->addDebug($ex->getMessage());
            MLMessage::gi()->addWarn($ex);
        }
        return array();
    }

    /**
     * Gets the name of the shop system.
     * @return string
     */
    abstract public function getShopSystemName();

    /**
     * Returns the database connection details.
     * @return array
     *     Format: array('host' => string, 'user' => string, 'password' => string, 'database' => string, persistent => bool)
     */
    abstract public function getDbConnection();

    /**
     * initialize database like charset etc.
     * @return $this
     */
    abstract public function initializeDatabase();

    /**
     * Get a list of products with missing or double assigned SKUs.
     * @return array
     */
    abstract public function getProductsWithWrongSku();

    /**
     * Returns statistic information of orders.
     * @param string $sDateBack
     *     Beginning date to get order info up to now.
     * @return array
     */
    abstract public function getOrderSatatistic($sDateBack);

    /**
     * Returns the current session id.
     * @return ?string
     */
    abstract public function getSessionId();

    /**
     * will be triggered after plugin update for shop-spec. stuff
     * eg. clean shop-cache
     * @param bool $blExternal if true external files (outside of plugin-folder) was updated
     * @return $this
     */
    abstract public function triggerAfterUpdate($blExternal);

    /**
     * get table name and field name to get collation of shop database
     * @return array
     */
    abstract public function getDBCollationTableInfo();

    /**
     * If there is shop-configuration to set time-zone different from PHP-configuration, this function should be implemented
     * At the moment it is important to convert shipping time to central time to send to Amazon
     * @return string|null
     */
    public function getTimeZone() {
        return null;
    }

    public function getTimeZoneOnlyForShow() {
        return null;
    }

    /**
     * It is useful to test special CRONs in Shopify, may be in future another cloud shop
     * @return array
     */
    public function getShopCronActions() {
        return array();
    }

    /**
     * Implement in shop system to return restricted db column types as keys and their replacement as values
     * Implemented only in magento 2 for now
     * eg('time' => 'datetime')
     *
     * @return array
     */
    public function getDBRestrictedTypes() {
        return array();
    }

    public function addShopMessages() {
    }

    /**
     * @param $sField string|null is null fo isConfigured call, and it is set by addMissingKey call
     * @return int|true
     * @throws MLAbstract_Exception
     */
    public function isConfiguredKeysValid() {
        $return = true;
        foreach (MLModule::gi()->getListOfConfigurationKeysNeedShopValidationOnlyActive() as $sCustomerGroupConfigurationKey => $sControllerPostfix) {
            $return = $this->checkCustomerGroup($sCustomerGroupConfigurationKey, $sControllerPostfix);
            //MLMessage::gi()->addDebug(__LINE__.':'.microtime(true), array($sCustomerGroupConfigurationKey, $return));
            if (!$return) {
                $sMarketplace = MLModule::gi()->getModuleBaseUrl();
                $sController = MLRequest::gi()->get('controller');
                if (strpos($sController, $sMarketplace) !== false && !MLHttp::gi()->isAjax()) {
                    MLHttp::gi()->redirect(MLHttp::gi()->getUrl(array('controller' => $sMarketplace . '_' . $sControllerPostfix)));
                }
                return $return;
            }
        }
        return $return;
    }

    /**
     * @param $sField string|null is null fo isConfigured call, and it is set by addMissingKey call
     * @return null|bool
     * @throws MLAbstract_Exception
     */
    public function isConfiguredKeyValid($sField) {
        $return = null;
        $aListOfKeys = MLModule::gi()->getListOfConfigurationKeysNeedShopValidation();
        $aListOfKeysOnlyActive = MLModule::gi()->getListOfConfigurationKeysNeedShopValidationOnlyActive();
        if (array_search($sField, $aListOfKeys) && !isset($aListOfKeysOnlyActive[$sField])) {//To be sure if config is not deactivated(b2b.price.group)
            $return = true;
        } else if (isset($aListOfKeysOnlyActive[$sField])) {
            $sControllerPostfix = $aListOfKeysOnlyActive[$sField];
            $return = $this->checkCustomerGroup($sField, $sControllerPostfix);
        }
        return $return;
    }


    protected function checkCustomerGroup($sCustomerGroupConfigurationKey, $sControllerPostfix) {
        return true;
    }

    protected function manageRestoreConfiguration() {
        if (MLRequest::gi()->data('action') === 'restoreConfiguration') {
            $aResponse = MagnaConnector::gi()->submitRequest(array(
                'SUBSYSTEM' => 'Core',
                'ACTION' => 'GetPluginConfigAsArray'
            ));
            if (!empty($aResponse['DATA']) && is_array($aResponse['DATA'])) {
                foreach ($aResponse['DATA'] as $data) {
                    MLDatabase::factory('config')->set('mpid', $data['mpID'])->set('mkey', $data['mkey'])->set('value', $data['value'])->save();
                }

            }
            MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'configurationIsRestored')->set('value', 'true')->save();
        } elseif (MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'configurationIsRestored')->get('value') !== 'true') {
            $sPassPhrase = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.passphrase')->get('value');
            if (!empty($sPassPhrase) && is_string($sPassPhrase)) {
                MLMessage::gi()->addWarn('<a href="' . MLHttp::gi()->getUrl(array(
                        'action' => 'restoreConfiguration'
                    )) . '" style="cursor: pointer;">Click here to restore plugin configuration</a>');
            }
        }
    }

    public function getShopNameForMarketingContent() {
        return $this->getShopSystemName();
    }

    /**
     * This will help us to create cache file specifically lock file with same method as shop-system does
     * @return ML_Core_Model_Cache
     */
    public function getCacheObject() {
        return MLCache::gi();
    }

    public function getShopVersion() {
        return "";
    }
}
