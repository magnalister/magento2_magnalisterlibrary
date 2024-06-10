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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Hood_Model_Modul extends ML_Modul_Model_Modul_Abstract {

    /**
     *
     * @var array $aPrice list of ML_Shop_Model_Price_Interface
     */
    protected $aPrice = array(
        'fixed'    => null,
        'chinese'  => null,
        'buyitnow' => null,
    );

    /**
     * better cache it, for exceptions in hood-api
     * @var string side id
     */
    protected $sHoodSiteId = null;

    public function getConfig($sName = null) {
        if ($sName == 'currency') {
            $mReturn = 'EUR';
        } else {
            $mReturn = parent::getConfig($sName);
        }

        if ($sName === null) {// merge
            $mReturn = MLHelper::getArrayInstance()->mergeDistinct($mReturn, array('lang' => $this->getConfig('lang'), 'currency' => 'EUR'));
        }

        return $mReturn;
    }

    public function getMarketPlaceName($blIntern = true) {
        return $blIntern ? 'hood' : MLI18n::gi()->get('sModuleNameHood');
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

    protected function getShippingServiceDetails() {
        try {
            $aShipping = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetShippingServiceDetails',
                'DATA'   => array(
                    'Site' => MLModul::gi()->getConfig('site')
                ),
            ), 30 * 60);
            if ($aShipping['STATUS'] == 'SUCCESS') {
                $aLocalService = array();
                $aIntService = array();
                foreach ($aShipping['DATA']['ShippingServices'] as $sService => $aService) {
                    if ($aService['InternationalService'] == 0) {
                        $aLocalService[$sService] = $aService['Description'];
                    } else {
                        $aIntService[$sService] = $aService['Description'];
                    }
                }
                return array('local' => $aLocalService, 'international' => $aIntService);
            } else {
                return array('local' => array(), 'international' => array());
            }
        } catch (MagnaException $oEx) {
            return array('local' => array(), 'international' => array());
        }
    }

    public function getLocalShippingServices() {
        $aShipping = $this->getShippingServiceDetails();
        return isset($aShipping['local']) ? $aShipping['local'] : array();
    }

    public function getInternationalShippingServices() {
        $aShipping = $this->getShippingServiceDetails();
        return isset($aShipping['international']) ? $aShipping['international'] : array();
    }

    /**
     * @param string $sService only amount value of selected service
     * @return array|string
     */
    public function getShippingDiscountProfiles($sService = null) {
        $aOut = array();
        try {
            $aResponse = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetShippingDiscountProfiles'
            ), 30 * 60);
            if ($aResponse['STATUS'] == 'SUCCESS') {
                if (array_key_exists('Profiles', $aResponse['DATA'])) {
                    foreach ($aResponse['DATA']['Profiles'] as $key => $profile) {
                        $aOut[$key] = array('name' => $profile['ProfileName'], 'amount' => $profile['EachAdditionalAmount']);
                    }
                }
            }
        } catch (MagnaException $e) {

        }

        if ($sService === null) {
            return $aOut;
        } else {
            return isset($aOut[$sService]) ? $aOut[$sService]['amount'] : 0;
        }
    }

    public function getShippingPromotionalDiscount() {
        try {
            $aResponse = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetShippingDiscountProfiles'
            ), 30 * 60);
            if ($aResponse['STATUS'] == 'SUCCESS') {
                if (array_key_exists('PromotionalShippingDiscount', $aResponse['DATA'])) {
                    return $aResponse['DATA']['PromotionalShippingDiscount'];
                }
            }
        } catch (MagnaException $e) {

        }
        return array();
    }

    public function getListingDurations($sListingType) {
        // store items are always unlimited
        if ($sListingType == 'StoresFixedPrice') {
            $aOut = array(
                'unlimited' => MLI18n::gi()->get('ML_HOOD_LABEL_LISTINGDURATION_UNLIMITED'),
            );

            return $aOut;
        }

        try {
            $aDurations = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetListingDurations',
                'DATA'   => array(
                    'ListingType' => $sListingType
                )
            ), 30 * 60);
        } catch (MagnaException $e) {
            $aDurations = array(
                'DATA' => array(
                    'ListingDurations' => array('no' => $e->getMessage())
                )
            );
        }
        $aOut = array();
        foreach ($aDurations['DATA']['ListingDurations'] as $key => $sDuration) {

            $sDefine = 'ML_HOOD_LABEL_LISTINGDURATION_DAYS_'.strtoupper($sDuration);
            $aOut[$sDuration] = MLI18n::gi()->get($sDefine);
        }

        return $aOut;
    }

    public function getFsk($sListingType = 'shopProduct') {
        try {
            $aDurations = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetFskOptions',
                'DATA'   => array(
                    'FskOptions' => $sListingType
                )
            ), 30 * 60);
        } catch (MagnaException $e) {
            $aDurations = array(
                'DATA' => array(
                    'FskOptions' => array('no' => $e->getMessage())
                )
            );
        }
        $aOut = array();
        foreach ($aDurations['DATA']['FskOptions'] as $key => $sDuration) {
            $sDefine = 'ML_HOOD_LABEL_FSK_'.strtoupper($key);
            if ($key == '-1') {
                $sDefine = 'ML_HOOD_LABEL_FSK_NOINFO';
            }
            $translate = MLI18n::gi()->$sDefine;
            $aOut[$key] = (!empty($translate) ? $translate : $sDuration);
        }

        return $aOut;
    }

    public function getUsk($sListingType = 'shopProduct') {
        try {
            $aDurations = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetUskOptions',
                'DATA'   => array(
                    'UskOptions' => $sListingType
                )
            ), 30 * 60);
        } catch (MagnaException $e) {
            $aDurations = array(
                'DATA' => array(
                    'UskOptions' => array('no' => $e->getMessage())
                )
            );
        }
        $aOut = array();
        foreach ($aDurations['DATA']['UskOptions'] as $key => $sDuration) {
            $sDefine = 'ML_HOOD_LABEL_USK_'.strtoupper($key);
            if ($key == '-1') {
                $sDefine = 'ML_HOOD_LABEL_USK_NOINFO';
            }
            $translate = MLI18n::gi()->$sDefine;
            $aOut[$key] = (!empty($translate) ? $translate : $sDuration);
        }
        return $aOut;
    }

    public function getNoIdentifierFlagValue() {
        $oI18n = MLI18n::gi();
        return array(
            '0' => $oI18n->get('ML_HOOD_LABEL_NOIDENTIFIERFLAG_NO'),
            '1' => $oI18n->get('ML_HOOD_LABEL_NOIDENTIFIERFLAG_YES'),
        );
    }

    public function getPaymentOptions() {
        try {
            $aPayment = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetPaymentOptions',
                'DATA'   => array('Site' => MLModul::gi()->getConfig('site')),
            ), 30 * 60);
            if ($aPayment['STATUS'] == 'SUCCESS' && isset($aPayment['DATA']['PaymentOptions']) && is_array($aPayment['DATA']['PaymentOptions'])) {
                return $aPayment['DATA']['PaymentOptions'];
            } else {
                return array();
            }
        } catch (MagnaException $e) {
            return array();
        }
    }

    public function getConditionValues() {
        $oI18n = MLI18n::gi();
        return array(
            'new'         => $oI18n->get('ML_HOOD_CONDITION_NEW'),
            'likeNew'     => $oI18n->get('ML_HOOD_CONDITION_NEW_OTHER'),
            'defect'      => $oI18n->get('ML_HOOD_CONDITION_NEW_WITH_DEFECTS'),
            'refurbished' => $oI18n->get('ML_HOOD_CONDITION_MANUF_REFURBISHED'),
            'veryGood'    => $oI18n->get('ML_HOOD_CONDITION_VERY_GOOD'),
            'usedGood'    => $oI18n->get('ML_HOOD_CONDITION_GOOD'),
            'acceptable'  => $oI18n->get('ML_HOOD_CONDITION_ACCEPTABLE'),
        );
    }

    public function getAgeValues() {
        $oI18n = MLI18n::gi();
        return array(
            '-1'      => $oI18n->get('ML_HOOD_LABEL_FSK_NOINFO'),
            '0'       => $oI18n->get('ML_HOOD_LABEL_FSK_0'),
            '1'       => $oI18n->get('ML_HOOD_LABEL_FSK_6'),
            '2'       => $oI18n->get('ML_HOOD_LABEL_FSK_12'),
            '3'       => $oI18n->get('ML_HOOD_LABEL_FSK_16'),
            '4'       => $oI18n->get('ML_HOOD_LABEL_FSK_18'),
            'unknown' => $oI18n->get('ML_HOOD_LABEL_FSK_UNKNOWN'),
        );
    }

    public function getHitcounterValues() {
        $oI18n = MLI18n::gi();
        return array(
            'NoHitCounter' => $oI18n->get('ML_HOOD_NO_HITCOUNTER'),
            'BasicStyle'   => $oI18n->get('ML_HOOD_BASIC_HITCOUNTER'),
            'RetroStyle'   => $oI18n->get('ML_HOOD_RETRO_HITCOUNTER'),
            'HiddenStyle'  => $oI18n->get('ML_HOOD_HIDDEN_HITCOUNTER'),
        );
    }

    public function getListingTypeValues() {
        $oI18n = MLI18n::gi();
        $aOut = array();
        if ($this->hasStore()) {
            $aOut['StoresFixedPrice'] = $oI18n->get('ML_HOOD_LISTINGTYPE_STORESFIXEDPRICE');
        } else {
            $aOut['FixedPriceItem'] = $oI18n->get('ML_HOOD_LISTINGTYPE_FIXEDPRICEITEM');
        }
        $aOut['Chinese'] = $oI18n->get('ML_HOOD_LISTINGTYPE_CHINESE');
        return $aOut;
    }

    /**
     * configures price-object
     * @return ML_Shop_Model_Price_Interface
     */
    public function getPriceObject($sType = null) {
        $sType = strtolower($sType);
        if (in_array($sType, array('storesfixedprice', 'fixedpriceitem'))) {
            $sType = 'fixed';
        } elseif ($sType == 'chinese') {
            $sType = 'chinese';
        } else { //buynow
            $sType = 'buyitnow';
        }
        if ($this->aPrice[$sType] === null) {
            $sKind = $this->getConfig($sType.'.price.addkind');
            $fFactor = (float)$this->getConfig($sType.'.price.factor');
            $iSignal = $this->getConfig($sType.'.price.signal');
            $iSignal = $iSignal === '' ? null : $iSignal;
            $sGroup = $this->getConfig(($sType == 'buyitnow' ? 'chinese' : $sType).'.price.group');
            $this->aPrice[$sType] = MLPrice::factory();
            $blSpecial = (boolean)$this->getConfig(($sType == 'buyitnow' ? 'chinese' : $sType).'.'.$this->aPrice[$sType]->getSpecialPriceConfigKey());
            $this->aPrice[$sType]->setPriceConfig($sKind, $fFactor, $iSignal, $sGroup, $blSpecial);
        }
        return $this->aPrice[$sType];
    }

    public function getPriceGroupKeys(){
        return array('chinese.price.group', 'fixed.price.group');
    }

    public function getStockConfig($sType = null) {
        $sType = strtolower($sType);


        if (in_array($sType, array('storesfixedprice', 'fixedpriceitem'))) {
            return array(
                'type'  => $this->getConfig('fixed.quantity.type'),
                'value' => $this->getConfig('fixed.quantity.value'),
                'max'   => $this->getConfig('maxquantity')
            );
        } else {
            return array(
                'type'  => $this->getConfig('chinese.quantity.type'),
                'value' => $this->getConfig('chinese.quantity.value'),
                'max'   => $this->getConfig('maxquantity')
            );
        }
    }

    public function getHoodSiteId() {
        if ($this->sHoodSiteId === null) {
            try {
                $aResponse = MagnaConnector::gi()->submitRequestCached(array(
                    'ACTION' => 'GethoodOfficialTime'
                ), 30 * 60);
                $sHoodSite = $aResponse['DATA']['SiteID'];
            } catch (MagnaException $e) {
                $e->setCriticalStatus(false);
                $sHoodSite = 77;
            }
            $this->sHoodSiteId = $sHoodSite;
        }
        return $this->sHoodSiteId;
    }

    /**
     * @return array('configKeyName'=>array('api'=>'apiKeyName', 'value'=>'currentSantizedValue'))
     */
    protected function getConfigApiKeysTranslation() {
        $sDate = $this->getConfig('preimport.start');
        //magento tip to find empty date
        $sDate = (preg_replace('#[ 0:-]#', '', $sDate) === '') ? date('Y-m-d') : $sDate;
        $sDate = date('Y-m-d', strtotime($sDate));
        $sFixedSync = $this->getConfig('stocksync.tomarketplace');
        $sFixedPriceSync = $this->getConfig('inventorysync.price');
        $sClassicSync = $this->getConfig('chinese.stocksync.tomarketplace');
        $sClassicPriceSync = $this->getConfig('chinese.inventorysync.price');

        return array(
            'apikey'                          => array('api' => 'Access.Key', 'value' => $this->getConfig('apikey')),
            'username'                        => array('api' => 'Access.MPUsername', 'value' => $this->getConfig('mpusername')),
            'import'                          => array('api' => 'Orders.Import', 'value' => ($this->getConfig('import'))),
            'preimport.start'                 => array('api' => 'Orders.Import.TS', 'value' => $sDate),
            'importonlypaid'                  => array('api' => 'Orders.ImportOnlyPaid', 'value' => ($this->getConfig('importonlypaid') == '1' ? 'true' : 'false')),
            'inventorysync.price'             => array('api' => 'SyncInventory.Fixed.Price', 'value' => isset($sFixedPriceSync) ? $sFixedPriceSync : 'no'),
            'stocksync.tomarketplace'         => array('api' => 'SyncInventory.Fixed.Quantity', 'value' => isset($sFixedSync) ? $sFixedSync : 'no'),
            'chinese.stocksync.tomarketplace' => array('api' => 'SyncInventory.Auction.Quantity', 'value' => isset($sClassicSync) ? $sClassicSync : 'no'),
            'chinese.inventorysync.price'     => array('api' => 'SyncInventory.Auction.Price', 'value' => isset($sClassicPriceSync) ? $sClassicPriceSync : 'no'),
        );
    }

    public function getCarrier() {
        $aCarriers = array();
        try {
            $aResponse = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetCarriers'
            ), 30 * 60);
            if (!empty($aResponse['DATA']) && is_array($aResponse['DATA'])) {
                foreach ($aResponse['DATA'] as $sCarrier) {
                    $aCarriers[$sCarrier] = $sCarrier;
                }
            }
        } catch (MagnaException $e) {
            MLMessage::gi()->addDebug($e);
        }
        return $aCarriers;
    }

    public function isMultiPrepareType() {
        return true;
    }

    public function isConfigured() {
        $bReturn = parent::isConfigured();
        $sCurrency = $this->getConfig('currency');
        $aFields = MLRequest::gi()->data('field');
        if (!MLHttp::gi()->isAjax() && $aFields !== null && isset($aFields['currency'])) { // saving new site in configuration
            $sCurrency = $aFields['currency'];
        }
        if (!empty($sCurrency) && !in_array($sCurrency, array_keys(MLCurrency::gi()->getList()))) {
            MLMessage::gi()->addWarn(sprintf(MLI18n::gi()->ML_GENERIC_ERROR_CURRENCY_NOT_IN_SHOP, $sCurrency));
            return false;
        }

        return $bReturn;
    }

    /**
     * It depends on shipped and cancel status configuration in marketplace
     * most of marketplaces use these three key, other one should override this method
     * @return array
     */
    public function getStatusConfigurationKeyToBeConfirmedOrCanceled() {
        return array(
            'orderstatus.shipped',
            'orderstatus.canceled.nostock',
            'orderstatus.canceled.revoked',
            'orderstatus.canceled.nopayment',
            'orderstatus.canceled.defect',
        );
    }

    public function isOrderShippingMethodAvailable() {
        return true;
    }

    public function isOrderPaymentMethodAvailable(){
        return true;
    }

    public function getNoneRepeatedStatusConfigurationKey() {
        $configFields = parent::getNoneRepeatedStatusConfigurationKey();

        $configFields = array_filter($configFields, function ($sKey) {
            return !in_array($sKey, array(
                'orderstatus.canceled.nostock',
                'orderstatus.canceled.revoked',
                'orderstatus.canceled.nopayment',
                'orderstatus.canceled.defect',
            ));
        });
        return $configFields;
    }

}
