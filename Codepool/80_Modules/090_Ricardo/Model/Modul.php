<?php
/**
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
 * (c) 2010 - 2018 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
class ML_Ricardo_Model_Modul extends ML_Modul_Model_Modul_Abstract {

    public function getMarketPlaceName($blIntern = true) {
        return $blIntern ? 'ricardo' : MLI18n::gi()->get('sModuleNameRicardo');
    }

    public function getConfig($sName = null) {
        if ($sName == 'lang') { // get mainlanguage
            $aField = array();
            $sMainLang = null;
            MLHelper::gi('model_table_ricardo_configdata')->langsField($aField);
            $aParent = parent::getConfig('langs');
            foreach ($aField['valuessrc'] as $sMainLang => $aLang) {
                if ($aLang['required'] && isset($aParent[$sMainLang])) {
                    break;
                }
            }
            $mReturn = isset($aParent[$sMainLang]) ? $aParent[$sMainLang] : null;
        } elseif ($sName == 'currency') { // get currency for mainlanguage
            $aField = array();
            MLHelper::gi('model_table_ricardo_configdata')->langsField($aField);
            foreach ($aField['valuessrc'] as $sMainLang => $aLang) {
                if ($aLang['required']) {
                    break;
                }
            }
            $mReturn = isset($aLang['currency']) ? $aLang['currency'] : null;
        } else {// parent
            $mReturn = parent::getConfig($sName);
        }

        if ($sName === null) {
            $mReturn = MLHelper::getArrayInstance()->mergeDistinct($mReturn, array('lang' => $this->getConfig('lang'), 'currency' => $this->getConfig('currency')));
        }

        return $mReturn;
    }

    public function tokenAvailable($blResetCache = false) {
        $sCacheKey = strtoupper(__class__) . '__' . $this->getMarketPlaceId() . '_ricardotoken';
        $oCache = MLCache::gi();
        if ($blResetCache) {
            $oCache->delete($sCacheKey);
        }
        if (!$oCache->exists($sCacheKey) || !((bool)$oCache->get($sCacheKey))) {
            $blToken = false;
            try {
                $result = MagnaConnector::gi()->submitRequest(array(
                    'ACTION' => 'CheckIfTokenAvailable'
                ));
                if ('true' == $result['DATA']['TokenAvailable']) {
                    $this->setConfig('token', '__saved__');
                    $this->setConfig('token.expires', $result['DATA']['TokenExpirationTime']);
                    $blToken = true;
                }
            } catch (MagnaException $e) {
            }
            $oCache->set($sCacheKey, $blToken, 60 * 15);
        }
        return (bool)$oCache->get($sCacheKey);
    }

    public function isAuthed($blResetCache = false) {
        if (parent::isAuthed($blResetCache)) {
            if ($this->tokenAvailable($blResetCache)) {
                $expires = $this->getConfig('token.expires');
                if (ml_is_datetime($expires) && ($expires < date('Y-m-d H:i:s'))) {
                    MLMessage::gi()->addNotice(MLI18n::gi()->ML_RICARDO_TEXT_TOKEN_INVALID);
                    return false;
                } else {
                    return true;
                }
            } else {
                MLMessage::gi()->addError(MLI18n::gi()->ML_RICARDO_TEXT_TOKEN_NOT_AVAILABLE_YET);
                return false;
            }
        } else {
            return false;
        }
    }

    public function getPriceObject($sType = null) {
        if ($this->oPrice === null) {
            $sKind = $this->getConfig('price.addkind');
            $fFactor = (float)$this->getConfig('price.factor');
            $iSignal = $this->getConfig('price.signal');
            $iSignal = $iSignal === '' ? null : $iSignal;
            $sGroup = $this->getConfig('price.group');
            $fTax = $this->getConfig('mwst');
            $fTax = $fTax === '' ? null : $fTax;
            $this->oPrice = MLPrice::factory();
            $blSpecial = (boolean)$this->getConfig($this->oPrice->getSpecialPriceConfigKey());
            $this->oPrice->setPriceConfig($sKind, $fFactor, $iSignal, $sGroup, $blSpecial, $fTax);
        }
        return $this->oPrice;
    }

    public function getStockConfig($sType = null) {
        return array(
            'type' => $this->getConfig('quantity.type'),
            'value' => $this->getConfig('quantity.value')
        );
    }

    /**
     * @return array('configKeyName'=>array('api'=>'apiKeyName', 'value'=>'currentSantizedValue'))
     */
    protected function getConfigApiKeysTranslation() {
        $aConfig = $this->getConfig();
        $sDate = $aConfig['preimport.start'];
        //magento tip to find empty date
        $sDate = (preg_replace('#[ 0:-]#', '', $sDate) === '') ? date('Y-m-d') : $sDate;
        $sDate = date('Y-m-d', strtotime($sDate));
        $sSync = $this->getConfig('stocksync.tomarketplace');
        return array(
            'import' => array('api' => 'Orders.Import', 'value' => ($this->getConfig('import') ? 'true' : 'false')),
            'preimport.start' => array('api' => 'Orders.Import.Start', 'value' => $sDate),
            'stocksync.tomarketplace' => array('api' => 'Callback.SyncInventory', 'value' => isset($sSync) ? $sSync : 'no'),
        );
    }

    public function isConfigured() {
        $bReturn = parent::isConfigured();

        $sCurrency = $this->getConfig('currency');
        if (!empty($sCurrency) && !in_array($sCurrency, array_keys(MLCurrency::gi()->getList()))) {
            MLMessage::gi()->addError(sprintf(MLI18n::gi()->ML_GENERIC_ERROR_CURRENCY_NOT_IN_SHOP, $sCurrency));
            return false;
        }

        return $bReturn;
    }
}
