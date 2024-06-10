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
class ML_Ebay_Model_Modul extends ML_Modul_Model_Modul_Abstract {
    /**
     *
     * @var array $aPrice list of ML_Shop_Model_Price_Interface
     */
    protected $aPrice = array(
        'fixed' => null,
        'strike' => null,
        'chinese' => null,
        'buyitnow' => null,
    );
    
    /**
     * better cache it, for exceptions in ebay-api
     * @var string side id
     */
    protected $sEbaySiteId = null;
   
    public function getConfig($sName = null) {
        //Add Tecdoc
        $mParent = parent::getConfig($sName);
        if ($sName === null) {
            $mParent['productfield.brand'] = 
                array_key_exists('productfield.brand', $mParent) 
                ? $mParent['productfield.brand'] 
                : $this->getConfig('manufacturer')
            ;
        } elseif ($sName == 'productfield.brand' && $mParent === null) {
            $mParent = $this->getConfig('manufacturer');
        }
        if(parent::getConfig('importonlypaid')){
            if($sName == 'orderstatus.paid' ){
                return $this->getConfig('orderstatus.open');
            }  else if($sName =='paymentstatus.paid' ){
                return $this->getConfig('orderimport.paymentstatus');
            }
        }
        return $mParent;
    }

    public function getMarketPlaceName($blIntern = true) {
        return $blIntern ? 'ebay' : MLI18n::gi()->get('sModuleNameEbay');
    }

    public function hasStore() {
        try {
            $aStore = MagnaConnector::gi()->submitRequestCached(array('ACTION' => 'HasStore'), 30 * 60);
            $blHasStore = $aStore['DATA']['Answer'] == 'True';
            return $blHasStore;
        } catch (Exception $oEx) { //no store
            return false;
        }
    }

    public function getEBayAccountSettings() {
        try {
            $aSettings = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GeteBayAccountSettings',
            ), 30 * 60);
            return $aSettings['DATA'] ;
        } catch (MagnaException $oEx) {
            return false;
        }
    }
    
    protected function getShippingServiceDetails() {
        try {
            $aShipping = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetShippingServiceDetails',
                'DATA' => array('Site' => MLModule::gi()->getConfig('site')
            ),), 30 * 60);
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
                $aLocations = $aShipping['DATA']['ShippingLocations'];
                return array('local' => $aLocalService, 'international' => $aIntService, 'locations' => $aLocations);
            } else {
                return array('local' => array(), 'international' => array(), 'locations' => array());
            }

        } catch (MagnaException $oEx) {
            return array('local' => array(), 'international' => array(), 'locations' => array());
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

    public function getInternationalShippingLocations() {
        $aShipping = $this->getShippingServiceDetails();
        return isset($aShipping['locations']) ? $aShipping['locations'] : array();
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
                //$aOut=$aResponse['DATA'];
            }
        } catch (MagnaException $e) {}

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
        } catch (MagnaException $e) {}
        return array();
    }

    public function getListingDurations($sListingType) {
        try {
            $aDurations = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetListingDurations',
                'DATA' => array(
                    'ListingType' => $sListingType
                )
            ), 30 * 60);
        } catch (MagnaException $e) {
            //echo print_m($e->getErrorArray(), 'Error');
            $aDurations = array(
                'DATA' => array(
                    'ListingDurations' => array('no' => $e->getMessage())
                )
            );
        }
        $aOut = array();
        foreach ($aDurations['DATA']['ListingDurations'] as $sDuration) {
            $sDefine = 'ML_EBAY_LABEL_LISTINGDURATION_'.strtoupper($sDuration);
            $translate = MLI18n::gi()->$sDefine;
            $aOut[$sDuration] = (!empty($translate) ? $translate : $sDuration);
        }
        return $aOut;
    }

    public function getPaymentOptions() {
        try {
            $aPayment = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetPaymentOptions',
                'DATA' => array('Site' => MLModule::gi()->getConfig('site')),
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
            '1000' => $oI18n->get('ML_EBAY_CONDITION_NEW'),
            '1500' => $oI18n->get('ML_EBAY_CONDITION_NEW_OTHER'),
            '1750' => $oI18n->get('ML_EBAY_CONDITION_NEW_WITH_DEFECTS'),
            '2000' => $oI18n->get('ML_EBAY_CONDITION_CERTIFIED_REFURBISHED'),
            '2010' => $oI18n->get('ML_EBAY_CONDITION_EXCELLENT_REFURBISHED'),
            '2020' => $oI18n->get('ML_EBAY_CONDITION_VERY_GOOD_REFURBISHED'),
            '2030' => $oI18n->get('ML_EBAY_CONDITION_GOOD_REFURBISHED'),
            '2500' => $oI18n->get('ML_EBAY_CONDITION_SELLER_REFURBISHED'),
            '2750' => $oI18n->get('ML_EBAY_CONDITION_AS_NEW'),
            '3000' => $oI18n->get('ML_EBAY_CONDITION_USED'),
            '4000' => $oI18n->get('ML_EBAY_CONDITION_VERY_GOOD'),
            '5000' => $oI18n->get('ML_EBAY_CONDITION_GOOD'),
            '6000' => $oI18n->get('ML_EBAY_CONDITION_ACCEPTABLE'),
            '7000' => $oI18n->get('ML_EBAY_CONDITION_FOR_PARTS_OR_NOT_WORKING')
        );
    }

    public function getListingTypeValues() {
        $oI18n = MLI18n::gi();
        $aOut = array();
        if ($this->hasStore()) {
            $aOut['StoresFixedPrice'] = $oI18n->get('ML_EBAY_LISTINGTYPE_STORESFIXEDPRICE');
        }
        $aOut['FixedPriceItem'] = $oI18n->get('ML_EBAY_LISTINGTYPE_FIXEDPRICEITEM');
        $aOut['Chinese'] = $oI18n->get('ML_EBAY_LISTINGTYPE_CHINESE');
        return $aOut;
    }

    /**
     * configures price-object
     * @return ML_Shop_Model_Price_Interface
     */
    public function getPriceObject($sType = null, $aSettings = null) {
        $sType = strtolower(MLHelper::gi('php8compatibility')->checkNull($sType));
        if (in_array($sType, array('storesfixedprice', 'fixedpriceitem'))) {
            $sType = 'fixed';
        } else if (in_array($sType, array('strike', 'strikeprice'))) {
            $sType = 'strike';
        } elseif ($sType == 'chinese') {
            $sType = 'chinese';
        } else { //buynow
            $sType = 'buyitnow';
        }
        if ($this->aPrice[$sType] === null) {
            if ('strike' == $sType) {
                if (null == $aSettings) { // use config values
                    $sKind = $this->getConfig($sType.'price.addkind');
                    $fFactor = (float)$this->getConfig($sType.'price.factor');
                    $iSignal = $this->getConfig($sType.'price.signal');
                    $iSignal = $iSignal === '' ? null : $iSignal;
                    $sGroup = $this->getConfig($sType.'price.group');
                    $this->aPrice[$sType] =  MLPrice::factory();
                    $blSpecial = true; // always special, special means use a group
                    $this->aPrice[$sType]->setPriceConfig($sKind, $fFactor, $iSignal, $sGroup, $blSpecial);
                } else { // use settings values
                    $this->aPrice[$sType] =  MLPrice::factory();
                    $this->aPrice[$sType]->setPriceConfig($aSettings['sKind'], $aSettings['fFactor'], $aSettings['iSignal'], $aSettings['sGroup'], true);
                }
                return $this->aPrice[$sType];
            }
            if (null == $aSettings) { // use config values
                $sKind = $this->getConfig($sType.'.price.addkind');
                $fFactor = (float)$this->getConfig($sType.'.price.factor');
                $iSignal = $this->getConfig($sType.'.price.signal');
                $iSignal = $iSignal === '' ? null : $iSignal;
                $sGroup = $this->getConfig(($sType == 'buyitnow' ? 'chinese' : $sType).'.price.group');
                $this->aPrice[$sType] =  MLPrice::factory();
                $blSpecial = (boolean)$this->getConfig(($sType == 'buyitnow' ? 'chinese' : $sType).'.'.$this->aPrice[$sType]->getSpecialPriceConfigKey());
                $this->aPrice[$sType]->setPriceConfig($sKind, $fFactor, $iSignal, $sGroup, $blSpecial);
            } else { // use settings values
                $this->aPrice[$sType] =  MLPrice::factory();
                $blSpecial = (boolean)$this->getConfig(($sType == 'buyitnow' ? 'chinese' : $sType).'.'.$this->aPrice[$sType]->getSpecialPriceConfigKey());
                $this->aPrice[$sType]->setPriceConfig($aSettings['sKind'], $aSettings['fFactor'], $aSettings['iSignal'], $aSettings['sGroup'], $blSpecial);
            }
        }
        return $this->aPrice[$sType];
    }
    
    public function getPriceGroupKeys(){
        return array('chinese.price.group', 'fixed.price.group', 'strikeprice.group');
    }

    public function getStockConfig($sType = null) {
        $sType = strtolower($sType);
        if (in_array($sType, array('storesfixedprice', 'fixedpriceitem'))) {
            return array(
                'type' => $this->getConfig('fixed.quantity.type'),
                'value' => $this->getConfig('fixed.quantity.value'),
                'max' => $this->getConfig('maxquantity')
            );
        } else {
            return array(
                'type' => 'stock',
                'value' => null,
                'max' => 1
            );
        }
    }

    public function getEbaySiteId() {
        if ($this->sEbaySiteId === null) {
            try {
                $aResponse = MagnaConnector::gi()->submitRequestCached(array(
                    'ACTION' => 'GeteBayOfficialTime'
                ), 30 * 60);
                $sEbaySite = $aResponse['DATA']['SiteID'];
            } catch (MagnaException $e) {
                $e->setCriticalStatus(false);
                $sEbaySite = 77;
            }
            $this->sEbaySiteId = $sEbaySite;
        }
        return $this->sEbaySiteId;
    }

    protected function geteBayReturnPolicyDetails() {
        global $_MagnaSession;
        #echo print_m($_MagnaSession,'$_MagnaSession');
        $mpID = (int)MLRequest::gi()->get('mp');
        $site = MLModule::gi()->getConfig('site');
        if (!isset($site) || empty($site)) {
            $site = '999'; //  999 um keine falsche Gleichheit bei nicht gesetzten Werten zu bekommen
        }
        if (@isset($_MagnaSession[$mpID]['eBayReturnPolicyDetails']['Site']) &&
            ($_MagnaSession[$mpID]['eBayReturnPolicyDetails']['Site'] == $site)
        ) {
            return $_MagnaSession[$mpID]['eBayReturnPolicyDetails'];

        } else {
            try {
                $returnPolicyDetails = MagnaConnector::gi()->submitRequest(array(
                    'ACTION' => 'GetReturnPolicyDetails',
                    'DATA' => array('Site' => $site),
                ));
            } catch (MagnaException $e) {
                $returnPolicyDetails = array(
                    'DATA' => false
                );
            }
            if (!is_array($returnPolicyDetails) || @empty($returnPolicyDetails['DATA'])) {
                return false;
            }
            arrayEntitiesFixHTMLUTF8($returnPolicyDetails['DATA']['ReturnPolicyDetails']);
            $_MagnaSession[$mpID]['eBayReturnPolicyDetails'] = $returnPolicyDetails['DATA']['ReturnPolicyDetails'];
            return $returnPolicyDetails['DATA']['ReturnPolicyDetails'];
        }
    }

    public function geteBaySingleReturnPolicyDetail($detailName) {
        global $_MagnaSession;
        $mpID = $_MagnaSession['mpID'];
        if ((!isset($_MagnaSession[$mpID]['eBayReturnPolicyDetails'])) || (!is_array($_MagnaSession[$mpID]['eBayReturnPolicyDetails']))) {
            $returnPolicyDetails = $this->geteBayReturnPolicyDetails();
        } else {
            $returnPolicyDetails = $_MagnaSession[$mpID]['eBayReturnPolicyDetails'];
        }
        if (!isset($returnPolicyDetails[$detailName])) {
            return array('' => '-');
        }
        return $returnPolicyDetails[$detailName];
    }
    
    /**
     * @return array('configKeyName'=>array('api'=>'apiKeyName', 'value'=>'currentSantizedValue'))
     */
    protected function getConfigApiKeysTranslation() {
        $sDate = $this->getConfig('preimport.start');
        //magento tip to find empty date
        $sDate = (preg_replace('#[ 0:-]#', '', $sDate) ==='') ? date('Y-m-d') : $sDate;
        $sDate = date('Y-m-d', strtotime($sDate));
        $sSync = $this->getConfig('stocksync.tomarketplace');
        return array(
            'site'=>array('api' => 'Access.Site', 'value' => ($this->getConfig('site'))),            
            'import' => array('api' => 'Orders.Import', 'value' => ($this->getConfig('import'))),
            'preimport.start' => array('api' => 'Orders.Import.TS', 'value' => $sDate),
            'importonlypaid' => array('api' => 'Orders.ImportOnlyPaid', 'value' => ($this->getConfig('importonlypaid') == '1' ? 'true':'false')),
            'syncproperties' => array('api' => 'Inventory.ListingDetailsSync', 'value' => ((bool)$this->getConfig('syncproperties')?'true':'false')),
            'syncrelisting' => array('api' => 'Inventory.AutoRelist', 'value' => ((bool)$this->getConfig('syncrelisting')?'true':'false')),
            'synczerostock' => array('api' => 'Inventory.ZeroStockSynchro', 'value' => ((bool)$this->getConfig('synczerostock')?'true':'false')),
            'stocksync.tomarketplace' => array('api' => 'Callback.SyncInventory', 'value' => isset($sSync) ? $sSync : 'no'),
        );
    }
    
    
    public function getCarrier() {
        try {
            $aResponse = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetCarriers'
            ), 30 * 60);
            return $aResponse['DATA'];             
        } catch (MagnaException $e) {
            return array();
        }
    }
    
    public function isAuthed($blResetCache = false) {
        if (parent::isAuthed($blResetCache)) {
            if ($this->tokenAvailable()) {
                $expires = $this->getConfig('token.expires');
                if (ml_is_datetime($expires) && ($expires < date('Y-m-d H:i:s'))) {
                    MLMessage::gi()->addNotice(MLI18n::gi()->ML_EBAY_TEXT_TOKEN_INVALID);
                    return false;
                } else {
                    return true;
                }
            } else {
                MLMessage::gi()->addError(MLI18n::gi()->ML_EBAY_TEXT_TOKEN_NOT_AVAILABLE_YET);
                return false;
            }
        }else{
            return false;
        }
    }

    public function tokenAvailable($blResetCache = false) {
        $sCacheKey = strtoupper(__class__) . '__' . $this->getMarketPlaceId() . '_ebaytoken';
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
                    if (array_key_exists('OauthTokenExpirationTime', $result['DATA'])) {
                        // actually, it's the expiration time for the "refresh token" - but we handle these things within the API (the customer only needs to know when it's time to renew the auth process)
                        $this->setConfig('oauth.token.expires', $result['DATA']['OauthTokenExpirationTime']);
                    }
                    $blToken = true;
                }
            } catch (MagnaException $e) {
            }
            $oCache->set($sCacheKey, $blToken, 60 * 15);
        }
        return (bool)$oCache->get($sCacheKey);
    }


    public function isMultiPrepareType(){
        return true;
    }
    
    public function isConfigured() {
        $sCurrency = $this->getConfig('currency');
        $aFields = MLRequest::gi()->data('field');
        if(!MLHttp::gi()->isAjax() && $aFields !== null && isset($aFields['currency']) ){ // saving new site in configuration
            $sCurrency = $aFields['currency'];
        }
        if (!empty($sCurrency) && !in_array($sCurrency, array_keys(MLCurrency::gi()->getList()))) {
            MLMessage::gi()->addWarn(sprintf(MLI18n::gi()->ML_GENERIC_ERROR_CURRENCY_NOT_IN_SHOP , $sCurrency));
            $sController = $this->getMarketPlaceName().':'.$this->getMarketPlaceId().'_config_account';
            if(MLRequest::gi()->get('controller') != $sController){
                MLHttp::gi()->redirect(MLHttp::gi()->getUrl(array('controller'=>$sController)));
            } else {
                return true;
            }
        }
        
        $bReturn = parent::isConfigured();
        return $bReturn;
    }

    /**
     * search with lookup and search by available fields 
     * @param string $sEpid
     * @param string $sEan
     * @param string $sMpn
     * @param string $sProductName
     * @param string $sKeywords
     * @return array
     */
    public function performItemSearch($sEpid='', $sEan='', $sMpn='', $sProductName='', $sKeywords='') {
            $aResult = array();
            
            if (!empty($sEpid)) {
                $aResult = $this->ebayLookUp($sEpid);
            } else {
                $aResult = $this->ebaySearch($sEan, $sMpn, $sProductName, $sKeywords);
            }
            
            foreach ($aResult as &$item) {
                if (isset($item['GTIN']) && is_array($item['GTIN'])) {
                    if (count($item['GTIN']) == 1) {
                        $item['GTIN'] = current($item['GTIN']);
                    } else {
                        $item['GTIN'] = implode(', ', $item['GTIN']);
                    }
                } else {
                    $item['GTIN'] = ' ';
                }

                if (isset($item['MPN']) && is_array($item['MPN'])) {
                    if (count($item['MPN']) == 1) { 
                        $item['MPN'] = current($item['MPN']);
                    } else {
                        $item['MPN'] = implode(', ', $item['MPN']);
                    }
                } else {
                    $item['MPN'] = ' ';
                }
            }
        return $aResult;
    }
    
    public function ebayLookUp($sSearch) {
        $sCacheId = __FUNCTION__ . '_' . md5($sSearch);
        try {
            $aResult = MLCache::gi()->get($sCacheId);
            $aRequest = MLCache::gi()->get($sCacheId.'_Request');
        } catch (ML_Filesystem_Exception $oEx) {
            $aResult = array();
            try {
                $aRequest = array(
                    'ACTION' => 'ItemLookup',
                    'EPID' => $sSearch
                );
                $result = MagnaConnector::gi()->submitRequest($aRequest);
                if (!empty($result['DATA'])) {
                    $aResult = array_merge($aResult, $result['DATA']);
                }
            } catch (MagnaException $e) {
                $e->setCriticalStatus(false);
            }
            MLCache::gi()->set($sCacheId, $aResult, 60 * 30 * 2);
            MLCache::gi()->set($sCacheId.'_Request', $aRequest, 60 * 30 * 2);
        }
        MLMessage::gi()->addDebug( __FUNCTION__ .' request', $aRequest);
        MLMessage::gi()->addDebug( __FUNCTION__ .' result', $aResult);
        return $aResult ;
    }

    
    public function ebaySearch($sEan = '', $sMpn = '', $sProductName = '', $sKeywords = '') {
        $sCacheId = __FUNCTION__ . '_' . md5(json_encode(array($sEan, $sMpn, $sProductName, $sKeywords)));
        try {
            $aResult = MLCache::gi()->get($sCacheId);
            $aRequest = MLCache::gi()->get($sCacheId.'_Request');
        } catch (ML_Filesystem_Exception $oEx) {
            $aResult = array();
            try {
                $aRequest = array(
                    'ACTION' => 'ItemSearch',
                );
                if (!empty($sEan)) {
                    $aRequest['EAN'] = $sEan;
                }
                if (!empty($sMpn)) {
                    $aRequest['MPN'] = $sMpn;
                }
                if (!empty($sProductName)) {
                    $aRequest['NAME'] = $sProductName;
                }
                if (!empty($sKeywords)) {
                    $aRequest['KEYWORDS'] = $sKeywords;
                }
                if (count($aRequest) > 1) {
                    $result = MagnaConnector::gi()->submitRequest($aRequest);
                    if (!empty($result['DATA'])) {
                        $aResult = array_merge($aResult, $result['DATA']);
                    }
                }
                //echo print_m($result['DATA']);
            } catch (MagnaException $e) {
                $e->setCriticalStatus(false);
            }
            MLCache::gi()->set($sCacheId, $aResult, 60 * 30 * 2);
            MLCache::gi()->set($sCacheId.'_Request', $aRequest, 60 * 30 * 2);
        }
        MLMessage::gi()->addDebug( __FUNCTION__ .' request', $aRequest);
        MLMessage::gi()->addDebug( __FUNCTION__ .' result', $aResult);
        return $aResult;
    }

    public function getGetNumberOfNewErrors() {
            $aResult = 0;
            try {
                $aRequest = array(
                    'ACTION' => 'GetNumberOfNewErrors',
                    'SECONDS' => 600
                );
                $result = MagnaConnector::gi()->submitRequest($aRequest);
                if (isset($result['DATA']['Errors'])) {
                    $aResult = (int)$result['DATA']['Errors'];
                }
            } catch (MagnaException $e) {
                $e->setCriticalStatus(false);
            }
            return $aResult;
    }

    /**
     * It is useful to get current category from API.
     * In cases that category is expired and deleted from magnalister_ebay_categories tables
     * @param $iCategoryId
     * @return array
     * @throws Exception
     */
    public function getCategoryWithAncestors($iCategoryId){
        $aData = array();
        try {
            $aRequest = MagnaConnector::gi()->submitRequest(array(
                'ACTION' => 'GetCategoryWithAncestors',
                'DATA' => array(
                    'CategoryID' => $iCategoryId,
                    'Site' => $this->getConfig('site')
                ),
            ));
            if ($aRequest['STATUS'] == 'SUCCESS' && is_array($aRequest['DATA']) && count($aRequest['DATA']) > 0) {
                $aData = $aRequest['DATA'];
            }
            MLLog::gi()->add('ebay_category_temp', $aRequest);
        } catch (MagnaException $oEx) {
            MLMessage::gi()->addDebug($oEx);
            throw new Exception(MLI18n::gi()->ML_ERROR_LABEL_API_CONNECTION_PROBLEM, 1548502937);
        }
        return $aData;
    }

    /**
     * Get all store category of customer eBay account
     * @return array
     * @throws Exception
     */
    public function getStoreCategories() {
        $aResult = array();
        $aRequest = array(
            'ACTION' => 'GetStoreCategories',
        );
        try {
            $aResponse = MagnaConnector::gi()->submitRequestCached($aRequest, 30 * 60);
            if ($aResponse['STATUS'] == 'SUCCESS' && isset($aResponse['DATA']) && is_array($aResponse['DATA']) && !empty($aResponse['DATA'])) {
                $aResult = $aResponse['DATA'];
            }
        } catch (MagnaException $oEx) {
            if ($oEx->getCode() === 13003) { // eBay error: if user have no ebay store.
                throw $oEx;
            } else {
                throw new Exception(MLI18n::gi()->ML_ERROR_LABEL_API_CONNECTION_PROBLEM);
            }

        }
        return $aResult;

    }

    /**
     * check if Payment Program is available
     * @return bool
     * @throws Exception
     */
    public function isPaymentProgramAvailable() {
        $blResult = false;
        try {
            $aResponse = MagnaConnector::gi()->submitRequestCached( array(
                'ACTION' => 'CheckPaymentProgramAvailability',
            ), 60 * 60);
            $blResult = isset($aResponse['IsAvailable']) ? $aResponse['IsAvailable'] : false;
        } catch (MagnaException $oEx) {
            MLMessage::gi()->addDebug($oEx->getMessage());
        }
        return $blResult;

    }

    public function getStatusConfigurationKeyToBeConfirmedOrCanceled() {
        $aParentReturn = parent::getStatusConfigurationKeyToBeConfirmedOrCanceled();
        $aParentReturn[] = 'refundstatus';
        return $aParentReturn;
    }

    public function getNoneRepeatedStatusConfigurationKey() {
        $configFields = parent::getNoneRepeatedStatusConfigurationKey();

        $configFields = array_filter($configFields, function ($sKey) {
            return $sKey !== 'refundstatus';
        });
        return $configFields;
    }

    public function isOrderShippingMethodAvailable() {
        return true;
    }

    public function isOrderPaymentMethodAvailable() {
        return true;
    }

    public function addRequiredConfigurationKeys($aRequiredConfig) {
        if (
            $this->getConfig('importonlypaid') !== '1' &&
            MLRequest::gi()->data('do') === null // by running cron (order import)
        ) {
            $aNewRequiredConfig = array(
                'orderstatus.closed',
                'updateable.orderstatus'
            );
            return array_merge($aNewRequiredConfig, $aRequiredConfig);
        }
        return $aRequiredConfig;
    }

    public function getListOfConfigurationKeysNeedShopValidationOnlyActive() {
        $aReturn = array();
        $aSettings = MLSetting::gi()->get('aModules');
        $aConfigKeysNeedsShopValidation = $aSettings[MLModule::gi()->getMarketPlaceName()]['configKeysNeedsShopValidation'];
        if (is_array($aConfigKeysNeedsShopValidation)) {
            foreach ($aConfigKeysNeedsShopValidation as $sKey) {
                $aReturn[$sKey] = 'config' . $this->getPriceConfigurationUrlPostfix();
            }
        } else {
            MLMessage::gi()->addDebug(__LINE__ . ':' . microtime(true), array($aConfigKeysNeedsShopValidation));
        }
        return $aReturn;
    }

    //    public function isAttributeMatchingNotMatchOptionImplemented() {
    //        return true;
    //    }
}
