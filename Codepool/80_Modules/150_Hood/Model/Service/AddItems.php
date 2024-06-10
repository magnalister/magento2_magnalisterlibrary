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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Hood_Model_Service_AddItems extends ML_Modul_Model_Service_AddItems_Abstract {

    protected $blCheckVariantQuantity = false;
    protected $sVariationDimensionForPictures = null;

    /**
     * needed to get correct index for variationimages (if value of varition have baseprice added)
     * @var array $aVariationTranslation
     */
    protected $aVariationTranslationBasePrice = array();

    public function setValidationMode($blValidation) {
        $this->sAction = $blValidation ? 'VerifyAddItems' : 'AddItems';
        return $this;
    }

    protected $oCurrentProduct = null;

    protected function addItems() {

        if (count($this->oList->getMasterIds(true)) > 0) {
            if (empty($this->aData)) {
                $this->aData = array();
            }
            foreach ($this->getProductArray() as $iProductId => $aAddItemData) {
                $this->hookAddItem($iProductId, $aAddItemData);
                $this->aData[] = $aAddItemData;
            }
            $this->filterAndSplitSubmitData();
            MLMessage::gi()->addDebug('Product data before check quantity : ', 'Data: '.json_indent(json_encode($this->aData)));
            if ($this->checkQuantity()) {
                $aRequest = array(
                    'ACTION'        => $this->sAction,
                    'SUBSYSTEM'     => $this->getSubSystem(),
                    //'MODE' => ($this->blPurge ? 'PURGE' : 'Verify'),
                    //'MODE' => ($this->blPurge ? 'PURGE' : $this->sAction == 'AddItems' ? 'ADD' : 'Verify'), -> Without Brackets deprecated since php 7.4
                    'MODE'          => $this->blPurge ? 'PURGE' : ($this->sAction == 'AddItems' ? 'ADD' : 'Verify'),
                    'MARKETPLACEID' => $this->oModul->getMarketPlaceId(),
                    'DATA'          => array_values($this->aData), //use array_values() covert indexes to auto index , other indexes can make malform error specialy in Rakuten Additem
                );

                try {
                    if (!MLSetting::gi()->get('blDryAddItems')) {
                        $aResponse = MagnaConnector::gi()->submitRequest($aRequest);
                        if (isset($aResponse['ERRORS'])) {
                            foreach ($aResponse['ERRORS'] as $aError) {
                                if (array_key_exists('ERRORLEVEL', $aError) && !in_array($aError['ERRORLEVEL'], array('NOTICE'))) {
                                    $sMessage = (isset($aError['SUBSYSTEM']) ? $aError['SUBSYSTEM'].' : ' : '').(isset($aError['ERRORDATA']) && isset($aError['ERRORDATA']['SKU']) ? ' Item SKU ( '.$aError['ERRORDATA']['SKU'].' ) ' : '').$aError['ERRORMESSAGE'];
                                    MLMessage::gi()->addWarn($sMessage, '', false);
                                }
                                MLErrorLog::gi()->addApiError($aError);
                            }
                        }
                        $this->additionalErrorManagement($aResponse);
                    }
                } catch (MagnaException $oEx) {
                    $oEx->setCriticalStatus(false);
                    $this->handleException($oEx);
                } catch (Exception $oEx) {

                    MLMessage::gi()->addDebug($oEx);
                }
                MLMessage::gi()->addDebug('Api Response: addItems', json_indent(json_encode((isset($aResponse) && !empty($aResponse)) ? $aResponse : $aRequest)));
            }
            //MLMessage::gi()->addDebug(get_class($this->oList).'2 2 we are here'.microtime());

            $aStatistic = $this->oList->getStatistic();

            if ($aStatistic['iCountPerPage'] != $aStatistic['iCountTotal']) {
                throw new Exception('list not finished');
            }
        }
        return $this;
    }

    protected function handleException($oEx) {
        $mError = $oEx->getErrorArray();
        foreach ($mError['ERRORS'] as $aError) {
            MLMessage::gi()->addError($aError['ERRORMESSAGE'], '', false);
            $this->aError[] = $aError['ERRORMESSAGE'];
        }
    }

    protected function getProductArray() {

        $aOut = array();
        /* @var $oPrepareHelper ML_Hood_Helper_Model_Table_Hood_PrepareData */
        $oPrepareHelper = MLHelper::gi('Model_Table_Hood_PrepareData');
        try {
            $aDefineMasterMaster = $this->getFieldDefineMasterMaster();
            $aDefineMasterVariant = $this->getFieldDefineMasterVariant();

            $aDefineVariant = $this->getFieldDefineVariant();
            $aDefineComplete = array_merge($aDefineMasterMaster, $aDefineMasterVariant, $aDefineVariant);
            unset($aDefineComplete['variation'], $aDefineComplete['VariationDimensionForPictures'], $aDefineComplete['VariationPictures']);
            // (master and variant) or (variants as master)

            $blConfigUseVariation = MLModul::gi()->getConfig('usevariations') == '1';
            if (!$blConfigUseVariation) {

                //if variation is disable in configuration
                foreach ($this->oList->getList() as $oMaster) {

                    /* @var $oMaster ML_Shop_Model_Product_Abstract */
                    $this->oCurrentProduct = $oMaster;
                    $oVariant = current($this->oList->getVariants($oMaster));
                    $aOut[$oMaster->get('id')] = $this->replacePrepareData(
                        $oPrepareHelper
                            ->setPrepareList(null)
                            ->setProduct($oVariant)
                            ->setMasterProduct($oMaster)
                            ->getPrepareData($aDefineComplete, 'value')
                    );
                    if (!isset($aOut[$oMaster->get('id')]['Weight']['Unit']) || !isset($aOut[$oMaster->get('id')]['Weight']['Value'])) {
                        unset($aOut[$oMaster->get('id')]['Weight']);
                    }

                    if ($aOut[$oMaster->get('id')]['ListingType'] === 'StoresFixedPrice') {
                        $aOut[$oMaster->get('id')]['ListingType'] = 'shopProduct';
                    }
                    if ($aOut[$oMaster->get('id')]['ListingType'] === 'FixedPriceItem') {
                        $aOut[$oMaster->get('id')]['ListingType'] = 'buyItNow';
                    }
                    if ($aOut[$oMaster->get('id')]['ListingType'] === 'Chinese') {
                        $aOut[$oMaster->get('id')]['ListingType'] = 'classic';
                        $aOut[$oMaster->get('id')]['StartPrice'] = $aOut[$oMaster->get('id')]['Price'];
                    }
                    if (isset($aOut[$oMaster->get('id')]['PrimaryCategory']) || isset($aOut[$oMaster->get('id')]['SecondaryCategory'])) {
                        $aOut[$oMaster->get('id')]['MarketplaceCategories'] = array($aOut[$oMaster->get('id')]['PrimaryCategory'], $aOut[$oMaster->get('id')]['SecondaryCategory']);
                        foreach ($aOut[$oMaster->get('id')]['MarketplaceCategories'] as $key => $value) {
                            if ($value == "") {
                                unset($aOut[$oMaster->get('id')]['MarketplaceCategories'][$key]);
                            }
                        }
                    } else {
                        $aOut[$oMaster->get('id')]['MarketplaceCategories'] = array(0);
                    }
                    if (isset($aOut[$oMaster->get('id')]['StoreCategory']) || isset($aOut[$oMaster->get('id')]['StoreCategory2']) || isset($aOut[$oMaster->get('id')]['StoreCategory3'])) {
                        $aOut[$oMaster->get('id')]['StoreCategories'] = array($aOut[$oMaster->get('id')]['StoreCategory'], $aOut[$oMaster->get('id')]['StoreCategory2'], $aOut[$oMaster->get('id')]['StoreCategory3']);
                        foreach ($aOut[$oMaster->get('id')]['StoreCategories'] as $key => $value) {
                            if ($value == "") {
                                unset($aOut[$oMaster->get('id')]['StoreCategories'][$key]);
                            }
                        }
                    } else {
                        if (isset($aOut[$oMaster->get('id')]['StoreCategories'])) {
                            unset($aOut[$oMaster->get('id')]['StoreCategories']);
                        }
                    }
                    $aOut[$oMaster->get('id')]['ShippingTime'] = array('Min' => MLModul::gi()->getConfig('shippingtime.min'), 'Max' => MLModul::gi()->getConfig('shippingtime.max'));

                    $aOut[$oMaster->get('id')]['ShippingServices'] = $aOut[$oMaster->get('id')]['ShippingDetails']['ShippingServiceOptions'];
                    foreach ($aOut[$oMaster->get('id')]['ShippingDetails']['InternationalShippingServiceOption'] as $key => $value) {
                        $aOut[$oMaster->get('id')]['ShippingServices'][] = $aOut[$oMaster->get('id')]['ShippingDetails']['InternationalShippingServiceOption'][$key];
                    }
                    foreach ($aOut[$oMaster->get('id')]['ShippingServices'] as $key => $value) {

                        $aOut[$oMaster->get('id')]['ShippingServices'][$key]['Service'] = $aOut[$oMaster->get('id')]['ShippingServices'][$key]['ShippingService'];
                        $aOut[$oMaster->get('id')]['ShippingServices'][$key]['Cost'] = $aOut[$oMaster->get('id')]['ShippingServices'][$key]['ShippingServiceCost'];
                    }
                    //foreach unset internationalshipping that have empty service value
                    foreach ($aOut[$oMaster->get('id')]['ShippingServices'] as $key => $value) {
                        if ($aOut[$oMaster->get('id')]['ShippingServices'][$key]['Service'] == "") {
                            unset($aOut[$oMaster->get('id')]['ShippingServices'][$key]);
                        }
                    }

                }

            } else {

                foreach ($this->oList->getList() as $oMaster) {

                    /* @var $oMaster ML_Shop_Model_Product_Abstract */
                    $this->oCurrentProduct = $oMaster;
                    $aVariants = array();
                    $pauction = current($this->oList->getVariants($oMaster));

                    foreach ($this->oList->getVariants($oMaster) as $oVariant) {

                        /* @var $oVariant ML_Shop_Model_Product_Abstract */
                        if ($this->oList->isSelected($oVariant)) {
                            $aVariants[] = $oVariant;
                        }
                    }
                    $ListingType = $oPrepareHelper
                        ->setPrepareList(null)
                        ->setProduct($pauction)
                        ->setMasterProduct($oMaster)
                        ->getPrepareData(array(
                            'ListingType' => array('optional' => array('active' => true)),
                        ), 'value');

                    if (count($aVariants) == 1 && current($aVariants)->getVariatonData() == array()) {

                        //master only
                        $aOut[$oMaster->get('id')] = $this->replacePrepareData(
                            $oPrepareHelper
                                ->setPrepareList(null)
                                ->setProduct($oVariant)
                                ->setMasterProduct($oMaster)
                                ->getPrepareData($aDefineComplete, 'value')
                        );

                        if (!isset($aOut[$oMaster->get('id')]['Weight']['Unit']) || !isset($aOut[$oMaster->get('id')]['Weight']['Value'])) {
                            unset($aOut[$oMaster->get('id')]['Weight']);
                        }

                        if ($aOut[$oMaster->get('id')]['ListingType'] == 'StoresFixedPrice') {
                            $aOut[$oMaster->get('id')]['ListingType'] = 'shopProduct';
                        }
                        if ($aOut[$oMaster->get('id')]['ListingType'] == 'FixedPriceItem') {
                            $aOut[$oMaster->get('id')]['ListingType'] = 'buyItNow';
                        }
                        if ($aOut[$oMaster->get('id')]['ListingType'] == 'Chinese') {
                            $aOut[$oMaster->get('id')]['ListingType'] = 'classic';
                            $aOut[$oMaster->get('id')]['StartPrice'] = $aOut[$oMaster->get('id')]['Price'];
                        }

                        //categorise start
                        if (isset($aOut[$oMaster->get('id')]['PrimaryCategory']) || isset($aOut[$oMaster->get('id')]['SecondaryCategory'])) {
                            $aOut[$oMaster->get('id')]['MarketplaceCategories'] = array();
                            if (isset($aOut[$oMaster->get('id')]['PrimaryCategory'])) {
                                $aOut[$oMaster->get('id')]['MarketplaceCategories'][] = $aOut[$oMaster->get('id')]['PrimaryCategory'];
                            }
                            if (isset($aOut[$oMaster->get('id')]['SecondaryCategory'])) {
                                $aOut[$oMaster->get('id')]['MarketplaceCategories'][] = $aOut[$oMaster->get('id')]['SecondaryCategory'];
                            }
                            foreach ($aOut[$oMaster->get('id')]['MarketplaceCategories'] as $key => $value) {
                                if ($value == "") {
                                    unset($aOut[$oMaster->get('id')]['MarketplaceCategories'][$key]);
                                }
                            }
                        } else {
                            $aOut[$oMaster->get('id')]['MarketplaceCategories'] = array(0);
                        }
                        if (isset($aOut[$oMaster->get('id')]['StoreCategory']) || isset($aOut[$oMaster->get('id')]['StoreCategory2']) || isset($aOut[$oMaster->get('id')]['StoreCategory3'])) {
                            $aOut[$oMaster->get('id')]['StoreCategories'] = array($aOut[$oMaster->get('id')]['StoreCategory'], $aOut[$oMaster->get('id')]['StoreCategory2'], $aOut[$oMaster->get('id')]['StoreCategory3']);
                            foreach ($aOut[$oMaster->get('id')]['StoreCategories'] as $key => $value) {
                                if ($value == "") {
                                    unset($aOut[$oMaster->get('id')]['StoreCategories'][$key]);
                                }
                            }
                        } else {
                            if (isset($aOut[$oMaster->get('id')]['StoreCategories'])) {
                                unset($aOut[$oMaster->get('id')]['StoreCategories']);
                            }
                        }
                        //categorise end
                        $aOut[$oMaster->get('id')]['ShippingTime'] = array('Min' => MLModul::gi()->getConfig('shippingtime.min'), 'Max' => MLModul::gi()->getConfig('shippingtime.max'));

                        $aOut[$oMaster->get('id')]['ShippingServices'] = $aOut[$oMaster->get('id')]['ShippingDetails']['ShippingServiceOptions'];

                        if (isset($aOut[$oMaster->get('id')]['ShippingDetails']['InternationalShippingServiceOption'])) {
                            foreach ($aOut[$oMaster->get('id')]['ShippingDetails']['InternationalShippingServiceOption'] as $key => $value) {
                                $aOut[$oMaster->get('id')]['ShippingServices'][] = $aOut[$oMaster->get('id')]['ShippingDetails']['InternationalShippingServiceOption'][$key];
                            }
                        }

                        foreach ($aOut[$oMaster->get('id')]['ShippingServices'] as $key => $value) {

                            $aOut[$oMaster->get('id')]['ShippingServices'][$key]['Service'] = $aOut[$oMaster->get('id')]['ShippingServices'][$key]['ShippingService'];
                            $aOut[$oMaster->get('id')]['ShippingServices'][$key]['Cost'] = $aOut[$oMaster->get('id')]['ShippingServices'][$key]['ShippingServiceCost'];
                        }
                        //foreach unset internationalshipping that have empty service value
                        foreach ($aOut[$oMaster->get('id')]['ShippingServices'] as $key => $value) {
                            if ($aOut[$oMaster->get('id')]['ShippingServices'][$key]['Service'] == "") {
                                unset($aOut[$oMaster->get('id')]['ShippingServices'][$key]);
                            }
                        }

                        // $aOut[$oMaster->get('id')]['Price'] = array($aOut[$oMaster->get('id')]['Price']);
                    } elseif ($ListingType['ListingType'] === 'Chinese') {
                        $this->oCurrentProduct = $oMaster;
                        /* @var $oMaster ML_Shop_Model_Product_Abstract */
                        $aListOfVariant = $this->oList->getVariants($oMaster);
                        $iVariantCount = count($aListOfVariant);
                        foreach ($aListOfVariant as $oVariant) {
                            /* @var $oVariant ML_Shop_Model_Product_Abstract */
                            if ($this->oList->isSelected($oVariant)) {
                                $oPrepareHelper
                                    ->setPrepareList(null)
                                    ->setProduct($oVariant)
                                    ->setMasterProduct($oMaster);
                                if ($iVariantCount > 1) {
                                    $aDefineComplete['Title']['value'] = $oPrepareHelper->replaceTitle(MLModul::gi()->getConfig('template.name'));
                                }
                                //
                                $aPrepareData = $oPrepareHelper->getPrepareData($aDefineComplete, 'value');

                                $aPrepareData['Images'] = $this->variationImageAsSingleProductImage($aPrepareData['Images'], $oVariant);

                                $aOut[$oVariant->get('id')] = $this->replacePrepareData(
                                    $aPrepareData
                                );
                                $aOut[$oVariant->get('id')]['IsSplit'] = 1;

                                if ($aOut[$oVariant->get('id')]['ListingType'] == 'Chinese') {
                                    $aOut[$oVariant->get('id')]['ListingType'] = 'classic';
                                }
                                //categorise start
                                if (isset($aOut[$oVariant->get('id')]['PrimaryCategory']) || isset($aOut[$oVariant->get('id')]['SecondaryCategory'])) {
                                    $aOut[$oVariant->get('id')]['MarketplaceCategories'] = array($aOut[$oVariant->get('id')]['PrimaryCategory'], $aOut[$oVariant->get('id')]['SecondaryCategory']);
                                    foreach ($aOut[$oVariant->get('id')]['MarketplaceCategories'] as $key => $value) {
                                        if ($value == "") {
                                            unset($aOut[$oVariant->get('id')]['MarketplaceCategories'][$key]);
                                        }
                                    }
                                } else {
                                    $aOut[$oVariant->get('id')]['MarketplaceCategories'] = array(0);
                                }
                                if (isset($aOut[$oVariant->get('id')]['StoreCategory']) || isset($aOut[$oVariant->get('id')]['StoreCategory2']) || isset($aOut[$oVariant->get('id')]['StoreCategory3'])) {
                                    $aOut[$oVariant->get('id')]['StoreCategories'] = array($aOut[$oVariant->get('id')]['StoreCategory'], $aOut[$oVariant->get('id')]['StoreCategory2'], $aOut[$oMaster->get('id')]['StoreCategory3']);
                                    foreach ($aOut[$oVariant->get('id')]['StoreCategories'] as $key => $value) {
                                        if ($value == "") {
                                            unset($aOut[$oVariant->get('id')]['StoreCategories'][$key]);
                                        }
                                    }
                                } else {
                                    if (isset($aOut[$oVariant->get('id')]['StoreCategories'])) {
                                        unset($aOut[$oVariant->get('id')]['StoreCategories']);
                                    }
                                }
                                //categorise end
                                $aOut[$oVariant->get('id')]['ShippingTime'] = array('Min' => MLModul::gi()->getConfig('shippingtime.min'), 'Max' => MLModul::gi()->getConfig('shippingtime.max'));

                                $aOut[$oVariant->get('id')]['ShippingServices'] = $aOut[$oVariant->get('id')]['ShippingDetails']['ShippingServiceOptions'];

                                foreach ($aOut[$oVariant->get('id')]['ShippingDetails']['InternationalShippingServiceOption'] as $key => $value) {
                                    $aOut[$oVariant->get('id')]['ShippingServices'][] = $aOut[$oVariant->get('id')]['ShippingDetails']['InternationalShippingServiceOption'][$key];
                                }
                                foreach ($aOut[$oVariant->get('id')]['ShippingServices'] as $key => $value) {
                                    $aOut[$oVariant->get('id')]['ShippingServices'][$key]['Service'] = $aOut[$oVariant->get('id')]['ShippingServices'][$key]['ShippingService'];
                                    $aOut[$oVariant->get('id')]['ShippingServices'][$key]['Cost'] = $aOut[$oVariant->get('id')]['ShippingServices'][$key]['ShippingServiceCost'];
                                }
                                //
                                //foreach unset international shipping that have empty service value
                                foreach ($aOut[$oVariant->get('id')]['ShippingServices'] as $key => $value) {
                                    if ($aOut[$oVariant->get('id')]['ShippingServices'][$key]['Service'] == "") {
                                        unset($aOut[$oVariant->get('id')]['ShippingServices'][$key]);
                                    }
                                }

                                // $aOut[$oMaster->get('id')]['Price'] = array($aOut[$oMaster->get('id')]['Price']);

                                $aOut[$oVariant->get('id')]['StartPrice'] = $aOut[$oVariant->get('id')]['Price'];
                                if (!isset($aOut[$oVariant->get('id')]['Weight']['Unit']) || !isset($aOut[$oVariant->get('id')]['Weight']['Value'])) {
                                    unset($aOut[$oVariant->get('id')]['Weight']);
                                }

                                unset($aOut[$oVariant->get('id')]['BasePriceString']);
                            }
                        }
                    } else {
                        $oFirstVariant = current($aVariants);
                        $oPrepareList = MLDatabase::factory(MLModul::gi()->getMarketPlaceName().'_prepare')->getList();
                        $oPrepareList->getQueryObject()->where($oPrepareHelper->getPrepareTableProductsIdField()." = '".$oFirstVariant->get('id')."'");
                        foreach (array('Title', 'Description', 'ShortDescription', 'Subtitle', 'Manufacturer','ManufacturerPartNumber','StartTime') as $sField) {
                            $aPrepared = $oPrepareList->get($sField, true);
                            if (count($aPrepared) > 0 && !in_array(null, $aPrepared, true)) {
                                $aDefineMasterVariant[$sField] = $aDefineMasterMaster[$sField];
                                unset($aDefineMasterMaster[$sField]);
                            }
                        }
                        $aMasterData = $oPrepareHelper
                            ->setPrepareList(null)
                            ->setProduct($oMaster)
                            ->setMasterProduct($oMaster)
                            ->getPrepareData($aDefineMasterMaster, 'value');
                        //prepared images are stored with variation product id, they could be got from oFirstVariant
                        $aDefineMasterVariant['Images'] = $aDefineMasterMaster['Images'];
                        // set first variation data to master
                        foreach ($oPrepareHelper
                                     ->setPrepareList(null)
                                     ->setProduct($oFirstVariant)
                                     ->setMasterProduct($oMaster)
                                     ->getPrepareData($aDefineMasterVariant, 'value') as $sKey => $mValue
                        ) {
                            $aMasterData[$sKey] = $mValue;
                        }
                        $this->manageCategoriesWithVariations($aMasterData);

                        if (!isset($aMasterData['Weight']['Unit']) || !isset($aMasterData['Weight']['Value'])) {
                            unset($aMasterData['Weight']);
                        }

                        if ($aMasterData['ListingType'] == 'StoresFixedPrice') {
                            $aMasterData['ListingType'] = 'shopProduct';
                        }
                        if ($aMasterData['ListingType'] == 'FixedPriceItem') {
                            $aMasterData['ListingType'] = 'buyItNow';
                        }
                        if ($aMasterData['ListingType'] == 'Chinese') {
                            $aMasterData['ListingType'] = 'classic';
                        }

                        $aMasterData['ShopProductInstance'] = $oMaster;
                        $aMasterData['Variations'] = array();
                        $aMasterData['Quantity'] = 0;

                        foreach ($aVariants as $key => $oVariant) {
                            /* @var $oVariant ML_Shop_Model_Product_Abstract */
                            $aPreparedVariant = $this->replacePrepareData($oPrepareHelper
                                ->setPrepareList(null)
                                ->setProduct($oVariant)
                                ->setMasterProduct($oMaster)
                                ->getPrepareData($aDefineVariant, 'value')
                            );

                            $aPreparedVariant['ShopProductInstance'] = $oVariant;

                            $aPreparedVariant['SortOrder'] = $key;
                            $aMasterData['Variations'][] = $aPreparedVariant;
                            foreach ($aMasterData['Variations'] as $key => $value) {
                                unset($aMasterData['Variations'][$key]['ShopProductInstance']);
                            }

                            $aMasterData['Quantity'] += (int)$aPreparedVariant['Quantity']; //when Product have several variants , master quantity is sum of all variants quantity
                        }

                        if (count($aMasterData['Variations']) == 1 && $aMasterData['Variations'][0]['Variation'] == array()) { //is master
                            $aMasterData = array_merge($aMasterData, $aMasterData['Variations'][0]);
                            $this->unsetShopRawData($aMasterData);
                            //unset($aMasterData['variation'], $aMasterData['Variations'], $aMasterData['VariationPictures'], $aMasterData['VariationDimensionForPictures']);
                        } else {
                            foreach ($aMasterData['Variations'] as &$aVariation) {
                                $aVariation = $this->replacePrepareData($aVariation);
                            }
                        }

                        foreach ($aMasterData['Variations'] as $key => $value) {
                            foreach ($aMasterData['Variations'][$key]['Variation'] as $key2 => $value2) {

                                $aMasterData['Variations'][$key]['Variation'][$key2]['Name'] = $aMasterData['Variations'][$key]['Variation'][$key2]['name'];
                                $aMasterData['Variations'][$key]['Variation'][$key2]['Value'] = $aMasterData['Variations'][$key]['Variation'][$key2]['value'];
                                unset($aMasterData['Variations'][$key]['Variation'][$key2]['name']);
                                unset($aMasterData['Variations'][$key]['Variation'][$key2]['value']);
                            }
                        }

                        //fix EAN for speacial situation that the master product don't fill EAN value and the we give the first value ean of first variant to fill the masterproduct ean
                        if (isset($aMasterData['EAN']) && $aMasterData['EAN'] == "") {
                            foreach ($aMasterData['Variations'] as $key => $value) {
                                if (isset($aMasterData['Variations'][$key]['EAN']) && $aMasterData['Variations'][$key]['EAN'] != "") {
                                    $aMasterData['EAN'] = $aMasterData['Variations'][$key]['EAN'];
                                    break;
                                }
                            }
                        }

                        $aMasterData = $this->replacePrepareData($aMasterData);
                        $this->manageShippingWithVariations($aMasterData);

                        unset($aMasterData['BasePriceString']);
                        $aOut[$oMaster->get('id')] = $aMasterData;
                    }
                }
            }
        } catch (Exception $oEx) {

            echo $oEx->getMessage();
        }

        return $aOut;
    }

    protected function manageCategoriesWithVariations(&$aMasterData) {
        if (isset($aMasterData['PrimaryCategory']) || isset($aMasterData['SecondaryCategory'])) {
            $aMasterData['MarketplaceCategories'] = array($aMasterData['PrimaryCategory'], $aMasterData['SecondaryCategory']);
            foreach ($aMasterData['MarketplaceCategories'] as $key => $value) {
                if ($value == "") {
                    unset($aMasterData['MarketplaceCategories'][$key]);
                }
            }
        } else {
            $aMasterData['MarketplaceCategories'] = array(0);
        }
        if (isset($aMasterData['StoreCategory']) || isset($aMasterData['StoreCategory2']) || isset($aMasterData['StoreCategory3'])) {
            $aMasterData['StoreCategories'] = array($aMasterData['StoreCategory'], $aMasterData['StoreCategory2'], $aMasterData['StoreCategory3']);
            foreach ($aMasterData['StoreCategories'] as $key => $value) {
                if ($value == "") {
                    unset($aMasterData['StoreCategories'][$key]);
                }
            }
        } else {
            if (isset($aMasterData['StoreCategories'])) {
                unset($aMasterData['StoreCategories']);
            }
        }
    }

    protected function manageShippingWithVariations(&$aMasterData) {
        $aMasterData['ShippingTime'] = array('Min' => MLModul::gi()->getConfig('shippingtime.min'), 'Max' => MLModul::gi()->getConfig('shippingtime.max'));

        $aMasterData['ShippingServices'] = $aMasterData['ShippingDetails']['ShippingServiceOptions'];
        if (isset($aMasterData['ShippingDetails']['InternationalShippingServiceOption'])) {
            foreach ($aMasterData['ShippingDetails']['InternationalShippingServiceOption'] as $key => $value) {
                $aMasterData['ShippingServices'][] = $aMasterData['ShippingDetails']['InternationalShippingServiceOption'][$key];
            }
        }
        foreach ($aMasterData['ShippingServices'] as $key => $value) {
            $aMasterData['ShippingServices'][$key]['Service'] = $aMasterData['ShippingServices'][$key]['ShippingService'];
            $aMasterData['ShippingServices'][$key]['Cost'] = $aMasterData['ShippingServices'][$key]['ShippingServiceCost'];
        }
        //foreach unset international shipping that have empty service value
        foreach ($aMasterData['ShippingServices'] as $key => $value) {
            if ($aMasterData['ShippingServices'][$key]['Service'] == "") {
                unset($aMasterData['ShippingServices'][$key]);
            }
        }
    }

    protected function checkQuantity() {
        if ($this->sAction == 'VerifyAddItems') {
            return true;
        }
        return parent::checkQuantity();
    }

    protected function hasAttributeMatching() {
        return false;
    }

    protected function setVariationDefinition($categoryAttributes) {
        $newVariationDefinitions = array();
        foreach ($categoryAttributes as $categoryAttributeKey => $categoryAttributeValue) {
            $newVariationDefinitions[] = array(
                'name'  => $categoryAttributeKey,
                'value' => $categoryAttributeValue,
            );
        }

        return $newVariationDefinitions;
    }

    /**
     * @param $aData
     * @return mixed
     */
    protected function replacePrepareData($aData) {
        foreach ($aData as $sKey => $mValue) {
            if ($mValue === null) {
                unset($aData[$sKey]);
            } else {
                if (method_exists($this, 'replace'.$sKey)) {
                    $aData[$sKey] = $this->{'replace'.$sKey}($mValue, $aData);
                }
            }
        }
        return $aData;
    }

    protected function _getImageUrl($mValue) {
        $sSize = MLModul::gi()->getConfig('imagesize');
        $iSize = $sSize == null ? 500 : (int)$sSize;
        $aOut = array();
        foreach (is_array($mValue) ? $mValue : array($mValue) as $sImage) {
            if($sImage !== 'false') {
                try {
                    $aImage = MLImage::gi()->resizeImage($sImage, 'products', $iSize, $iSize);
                    $aOut[] = array('URL' => $aImage['url']);
                } catch (Exception $oEx) { //no image
                }
            }
        }
        return is_array($mValue) ? $aOut : current($aOut);
    }

    protected function replaceMpn($mValue, $aData) {
        return empty($mValue) ? $this->oCurrentProduct->getSku() : $mValue;
    }

    protected function replaceImages($mValue, $aData) {
        /* if ($this->sAction == 'VerifyAddItems') {
          if (is_array($mValue)) {
          foreach ($mValue as &$sLink) {
          $sLink = 'http://example.com/test.png';
          }
          return $mValue;
          } else {
          return 'http://example.com/test.png';
          }
          } else { */
        return $this->_getImageUrl($mValue);
        /* } */
    }

    protected function variationImageAsSingleProductImage($aPreparedImages, $oVariant) {
        $aVariatioImages = array();
        $aImages = $oVariant->getImages();
        foreach ($aImages as $sImage) {
            if (in_array($sImage, $aPreparedImages)) {
                $aVariatioImages[] = $sImage;
            }
        }
        return $aVariatioImages;
    }

    protected function replaceQuantity($mValue, $aData) {
        if ($this->sAction == 'VerifyAddItems' && array_key_exists('Description', $aData)) { // we need replacement only for master
            return 1;
        } else {
            return $mValue;
        }
    }

    protected function replaceShippingDetails($mValue, $aData) {
        if (is_array($mValue['ShippingServiceOptions']) && count($mValue['ShippingServiceOptions']) > 0) {
            foreach ($mValue['ShippingServiceOptions'] as &$aService) {
                if ($aService['ShippingServiceCost'] == '=GEWICHT') {
                    $aWeight = $this->oCurrentProduct->getWeight();
                    $aService['ShippingServiceCost'] = empty($aWeight) ? '0' : (string)$aWeight['Value'];
                }
                $aService['ShippingServiceCost'] = MLPrice::factory()->unformat($aService['ShippingServiceCost']);
            }
        }
        if (isset($mValue['InternationalShippingServiceOption']) && is_array($mValue['InternationalShippingServiceOption']) && count($mValue['InternationalShippingServiceOption']) > 0) {
            foreach ($mValue['InternationalShippingServiceOption'] as $iService => &$aService) {
                if (empty($aService['ShippingService'])) { // config value = no-shipping
                    unset($mValue['InternationalShippingServiceOption'][$iService]);
                } else {
                    if ($aService['ShippingServiceCost'] == '=GEWICHT') {
                        $aWeight = $this->oCurrentProduct->getWeight();
                        $aService['ShippingServiceCost'] = empty($aWeight) ? '0' : (string)$aWeight['Value'];
                    }
                    $aService['ShippingServiceCost'] = MLPrice::factory()->unformat($aService['ShippingServiceCost']);
                }
            }
        }
        if (!isset($mValue['InternationalShippingServiceOption']) || empty($mValue['InternationalShippingServiceOption'])) {
            unset($mValue['InternationalShippingServiceOption']);
            unset($mValue['InternationalPromotionalShippingDiscount']);
            unset($mValue['InternationalShippingDiscountProfileID']);
        }
        return $mValue;
    }

    protected function replacePrice($mValue, $aData) {
        return MLPrice::factory()->unformat($mValue);
    }

    protected function replaceFeatures($mValue, $aData) {
        $aReturn = array();
        foreach (array(
                     "BoldTitle",
                     "BackGroundColor",
                     "Gallery",
                     "Category",
                     "HomePage",
                     "HomePageImage",
                     "XXLImage",
                     "NoAds"
                 ) as $sKey) {
            $aReturn[$sKey] = isset($mValue[strtolower($sKey)]) ? true : false;
        }
        return $aReturn;
    }

    /**
     * cuts title, but rescue #BASPRICE#
     * @param string $mValue
     * @param array $aData
     * @return string
     */
    protected function replaceTitle($mValue, $aData, $iMaxChars = 85) {
        /* @var $oPrepareHelper ML_Hood_Helper_Model_Table_Hood_PrepareData */
        $oPrepareHelper = MLHelper::gi('Model_Table_Hood_PrepareData');
        return $oPrepareHelper->basePriceReplace($mValue, $aData, $iMaxChars);
    }

    protected function getFieldDefineMasterMaster() {
        $aRetrun = array(
            'Title'                  => array('optional' => array('active' => true)),
            'Manufacturer'           => array('optional' => array('active' => true)),
            'ManufacturerPartNumber' => array('optional' => array('active' => true)),
            'ShortDescription'       => array('optional' => array('active' => true)),
            'SKU'                    => array('optional' => array('active' => true)),
            'Description'            => array('optional' => array('active' => true), 'preparemode' => true),
            'Images'                 => array('optional' => array('active' => true)),
            'Subtitle'               => array(),
            'StartTime'              => array(),
            'Price'                  => array('optional' => array('active' => true)),
            'Quantity'               => array('optional' => array('active' => true)),
            'BasePrice'              => array('optional' => array('active' => true)),
            'Weight'                 => array('optional' => array('active' => true)),
            'NoIdentifierFlag'       => array('optional' => array('active' => true)),
            'EAN'                    => array('optional' => array('active' => true)),
        );
        return $aRetrun;
    }

    protected function getFieldDefineMasterVariant() {
        $aReturn = array(
            'HitCounter'            => array('optional' => array('active' => true)),
            'PrimaryCategory'       => array('optional' => array('active' => true)),
            'ConditionType'         => array('optional' => array('active' => true)),
            'MarketplaceCategories' => array(),
            'SecondaryCategory'     => array(),
            'StoreCategory'         => array(),
            'StoreCategory2'        => array(),
            'StoreCategory3'        => array(),
            'ListingType'           => array('optional' => array('active' => true)),
            'ListingDuration'       => array('optional' => array('active' => true)),
            'Country'               => array('optional' => array('active' => true)),
            'Site'                  => array('optional' => array('active' => true)),
            'currencyID'            => array('optional' => array('active' => true)),
            'Location'              => array('optional' => array('active' => true)),
            'PostalCode'            => array('optional' => array('active' => true)),
            'Tax'                   => array('optional' => array('active' => true)),
            'PaymentMethods'        => array('optional' => array('active' => true)),
            'PaymentInstructions'   => array('optional' => array('active' => true)),
            'ShippingDetails'       => array('optional' => array('active' => true)),
            'FSK'                   => array('optional' => array('active' => true)),
            'USK'                   => array('optional' => array('active' => true)),
            'Features'              => array('optional' => array('active' => true)),
        );

        return $aReturn;
    }

    protected function getFieldDefineVariant() {
        $aRetrun = array(
            'SKU'       => array('optional' => array('active' => true)),
            'Price'     => array('optional' => array('active' => true)),
            'BasePrice' => array('optional' => array('active' => true)),
            'Quantity'  => array('optional' => array('active' => true)),
            'EAN'       => array('optional' => array('active' => true)),
            'Variation' => array('optional' => array('active' => true)),
        );

        return $aRetrun;
    }

    protected function shouldSendShopData() {
        return true;
    }

}
