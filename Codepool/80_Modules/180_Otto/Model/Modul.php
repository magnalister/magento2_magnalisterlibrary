<?php
/*
 * 888888ba                 dP  .88888.                    dP
 * 88    `8b                88 d8'   `88                   88
 * 88aaaa8P' .d8888b. .d888b88 88        .d8888b. .d8888b. 88  .dP  .d8888b.
 * 88   `8b. 88ooood8 88'  `88 88   YP88 88ooood8 88'  `"" 88888"   88'  `88
 * 88     88 88.  ... 88.  .88 Y8.   .88 88.  ... 88.  ... 88  `8b. 88.  .88
 * dP     dP `88888P' `88888P8  `88888'  `88888P' `88888P' dP   `YP `88888P'
 *
 *                            m a g n a l i s t e r
 *                                        boost your Online-Shop
 *
 *   -----------------------------------------------------------------------------
 *   @author magnalister
 *   @copyright 2010-2022 RedGecko GmbH -- http://www.redgecko.de
 *   @license Released under the MIT License (Expat)
 *   -----------------------------------------------------------------------------
 */

class ML_Otto_Model_Modul extends ML_Modul_Model_Modul_Abstract {

    /**
     *
     * @var array $aPrice list of ML_Shop_Model_Price_Interface
     */
    protected $aPrice = array(
        'fixed' => null,
        'chinese' => null,
        'buyitnow' => null,
    );

    protected $aRequiredMatchingCarrierConfig = array(
        'orderstatus.returncarrier.matching' => '_config_order',
        'orderstatus.sendcarrier.matching' => '_config_order',
        'orderstatus.forwardercarrier.matching' => '_config_order',
    );

    protected $aRequiredShippingAddressConfig = array(
        'orderstatus.shippedaddress.city' => '_config_order',
        'orderstatus.shippedaddress.zip' =>'_config_order',
    );

    /**
     * better cache it, for exceptions in otto-api
     * @var string side id
     */
    protected $sOttoSiteId = null;

    public function getConfig($sName = null) {
        if ($sName === 'currency') {
            $mReturn = 'EUR';
        } else {
            $mReturn = parent::getConfig($sName);
        }

        if ($sName === null) {// merge
            $mReturn['lang'] = $this->getConfig('lang');
            $mReturn['currency'] = 'EUR';
        }

        return $mReturn;
    }

    public function getMarketPlaceName($blIntern = true) {
        return $blIntern ? 'otto' : MLI18n::gi()->get('sModuleNameOtto');
    }

    public function hasStore() {
        try {
            $aStore = MagnaConnector::gi()->submitRequestCached(array('ACTION' => 'HasStore'), 30 * 60);
            //$blHasStore = $aStore['DATA']['Answer'] == 'True';
            return $aStore['DATA'];
        } catch (Exception $oEx) { //no store
            return false;
        }
    }

    public function getDaysValue() {
        $oI18n = MLI18n::gi();
        return array(
            '0' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_X'),
            '1' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_0'),
            '2' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_1'),
            '4' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_2'),
            '5' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_3'),
            '6' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_4'),
            '7' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_5'),
            '8' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_6'),
            '9' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_7'),
            '10' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_8'),
            '11' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_9'),
            '12' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_10'),
            '13' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_13'),
            '14' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_14'),
            '15' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_15'),
            '16' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_16'),
            '17' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_17'),
            '18' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_18'),
            '19' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_19'),
            '20' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_20'),
            '21' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_21'),
            '22' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_22'),
            '23' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_23'),
            '24' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_24'),
            '25' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_25'),
            '26' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_26'),
            '27' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_27'),
            '28' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_28'),
            '29' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_29'),
            '30' => $oI18n->get('ML_OTTO_LABEL_LISTINGDURATION_DAYS_30'),
        );
    }

    public function getStockConfig($sType = null) {
        $max = $this->getConfig('maxquantity');
        return array(
            'type' => $this->getConfig('quantity.type'),
            'value' => $this->getConfig('quantity.value'),
            'max' => $max > 0 ? $max : null
        );
    }

    /**
     * @return array('configKeyName'=>array('api'=>'apiKeyName', 'value'=>'currentSantizedValue'))
     */
    protected function getConfigApiKeysTranslation() {
        $sDate = $this->getConfig('preimport.start');
        //magento tip to find empty date
        $sDate = (preg_replace('#[ 0:-]#', '', $sDate) === '') ? date('Y-m-d') : $sDate;
        $sDate = date('Y-m-d', strtotime($sDate));

        return array(
            'import' => array('api' => 'Orders.Import', 'value' => ($this->getConfig('import') ? 'true' : 'false')),
            'preimport.start' => array('api' => 'Orders.Import.Start', 'value' => $sDate),
        );
    }

    public function isConfigured() {
        $bReturn = parent::isConfigured();
        $sCurrency = $this->getConfig('currency');
        $aFields = MLRequest::gi()->data('field');
        if (!MLHttp::gi()->isAjax() && $aFields !== null && isset($aFields['currency'])) { // saving new site in configuration
            $sCurrency = $aFields['currency'];
        }
        if (!empty($sCurrency) && !array_key_exists($sCurrency, MLCurrency::gi()->getList())) {
            MLMessage::gi()->addWarn(sprintf(MLI18n::gi()->ML_GENERIC_ERROR_CURRENCY_NOT_IN_SHOP, $sCurrency));
            return false;
        }

        $missingConfigKeys = array();
        foreach ($this->aRequiredMatchingCarrierConfig as $sName => $sController) {
            $configData = $this->getConfig($sName);
            if (is_array($configData)) {
                foreach ($configData as $value) {
                    if ($value !== '' && ($value['marketplaceCarrier'] === '' ||  $value['shopCarrier'] === '') && !in_array($sName, $missingConfigKeys)) {
                        $missingConfigKeys[$sName] = $sController;
                    }
                }
            }
        }

        foreach ($this->aRequiredShippingAddressConfig as $name => $sController) {
            $configData = $this->getConfig($name);
            if (is_array($configData)) {
                foreach ($configData as $value) {
                    if ($value === '' && !in_array($name, $missingConfigKeys)) {
                        $missingConfigKeys[$name] = $sController;
                    }
                }
            }
        }
        $aRequest= MLRequest::gi()->data();
        if (count($missingConfigKeys) != 0 && strpos($aRequest['controller'], '_config') === false && !isset($aRequest['field'])) {
            MLMessage::gi()->addDebug($this->getMarketPlaceName().'('.$this->getMarketPlaceId().') missing '.(count($missingConfigKeys)).' config-keys.', $missingConfigKeys);
            MLHttp::gi()->redirect( MLHttp::gi()->getUrl( array(
                'controller' => $this->getMarketPlaceName() . ':' . $this->getMarketPlaceId() . current($missingConfigKeys)
            )));
            return false;
        } else {
            return $bReturn;
        }
    }

    public function getOttoCancellationReasons() {
        try {
            $result = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetCancellationReasons',
            ));

            if (isset($result['DATA'])) {
                return $result['DATA'];
            }
        } catch (MagnaException $e) {
        }
        return array('noselection' => MLI18n::gi()->ML_ERROR_API);
    }

    public function getOttoShippingSettings($type) {
        $action = $this->getApiRequestType($type);

        if ($type === 'return' || $type === 'standard') {
            $request = array(
                'ACTION' => $action,
                'MODE' => $type
            );
        } else {
            $request = array(
                'ACTION' => $action
            );
        }

        try {
            $result = MagnaConnector::gi()->submitRequestCached($request);

            if (isset($result['DATA'])) {
                return $result['DATA'];
            }
        } catch (MagnaException $e) {
        }
        return array('noselection' => MLI18n::gi()->ML_ERROR_API);
    }

    private function getApiRequestType($type)
    {
        switch ($type) {
            case 'standard':
            case 'return':
                $result = 'GetShippingStandardProviders';
            break;
            case 'forwarding':
                $result = 'GetShippingForwardingProviders';
            break;
            case 'countries':
                $result = 'GetShippingCountryCodes';
            break;
            default:
                $result = '';
                break;
        }

        return $result;
    }

    /**
     * if attribute name in GetCategoryDetail contains some specific character, those are not allowed in jquery selector,
     * it is better to encode them by preparation and attribute matching to hex, and by add-item we can decode them to real name
     * @return bool
     */
    public function isNeededPackingAttrinuteName(){
        return true;
    }

    /**
     * Import for Order Status Sync of Prestashop
     *
     * @return string[]
     */
    public function getStatusConfigurationKeyToBeConfirmedOrCanceled() {
        return array(
            'orderstatus.shippedaddress',
            'orderstatus.canceled',
        );
    }

    /**
     * @inheritDoc
     */
    public function getPriceConfigurationUrlPostfix() {
        return '_priceandstock';
    }
}
