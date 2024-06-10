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

abstract class ML_Modul_Model_Service_AddItems_Abstract extends ML_Modul_Model_Service_Abstract {
    /** @var ML_Productlist_Model_ProductList_Abstract */
    protected $oList = null;
    protected $blPurge = false;
    protected $sAction = 'AddItems';
    protected $sGetItemsFeeAction = 'GetArticlesFee';
    protected $aError = array();
    protected $aData = null;
    protected $aResponse = array();
    
    protected $blCheckVariantQuantity = true;

    protected function getSubSystem(){
        return $this->oModul->getMarketPlaceName();
    }

    public function execute() {
        $this->addItems();
        $this->uploadItems();
        return $this;
    }

    public function setProductList(ML_Productlist_Model_ProductList_Abstract $oList) {
        $this->oList = $oList;
        return $this;
    }

    public function setPurge($blPurge) {
        $this->blPurge = $blPurge;
        return $this;
    }

    protected function uploadItems() {
        $aRequest = array(
            'ACTION' => 'UploadItems',
            'SUBSYSTEM' => $this->getSubSystem(),
            'MARKETPLACEID' => $this->oModul->getMarketPlaceId(),
        );
        try {
            if (!MLSetting::gi()->get('blDryAddItems')) {
                $aResponse = MagnaConnector::gi()->submitRequest($aRequest);
                if (isset($aResponse['ERRORS'])) {
                    foreach ($aResponse['ERRORS'] as $aError) {
                        $sMessage = (isset($aError['SUBSYSTEM']) ? $aError['SUBSYSTEM'] . ' : ' : '')
                            . (isset($aError['ERRORDATA']['SKU']) ? ' Item SKU ( ' . $aError['ERRORDATA']['SKU'] . ' ) ' : '')
                            . $aError['ERRORMESSAGE'];
                        MLMessage::gi()->addWarn($sMessage, '', false);
                        MLErrorLog::gi()->addApiError($aError);
                    }
                }
                $this->additionalErrorManagement($aResponse);
            }
        } catch (MagnaException $oEx) {
            $this->handleException($oEx);
        } catch (Exception $oEx) {
            MLMessage::gi()->addDebug($oEx);
        }
        MLMessage::gi()->addDebug('Api Response: upload', json_indent(json_encode((isset($aResponse) && !empty($aResponse)) ? $aResponse : $aRequest)));
        if (isset($oEx)) {
            throw $oEx;
        } else {
            return $this;
        }
    }

    /**
     * remove master or variants that their quantity <= 0
     * @return boolean
     * @throws MLAbstract_Exception
     */
    protected function checkQuantity() {
        foreach ($this->aData as $sKey => $aItem) {
            if (isset($aItem['Quantity']) && ((int) $aItem['Quantity']) <= 0) {
                $sMessage = MLI18n::gi()->get('sAddItemProductWithZeroQuantity');
                MLMessage::gi()->addWarn($sMessage, '', false);

                $oProduct = MLProduct::factory()->getByMarketplaceSKU($aItem['SKU'], true);
                if(!$oProduct->existsMlProduct()){//it is possible that we send a variation as master product(if variation is not supported) 
                    $oProduct = MLProduct::factory()->getByMarketplaceSKU($aItem['SKU']);  
                }                  
                $iProductId = $oProduct->get('id');
                MLErrorLog::gi()->addError($iProductId, $aItem['SKU'], $sMessage, array('SKU' => $aItem['SKU']));
                $this->aError[] = $sMessage;
                unset($this->aData[$sKey]);
            } elseif ($this->blCheckVariantQuantity && !empty($aItem['Variations'])) {
                foreach ($aItem['Variations'] as $sVKey => $aVItem) {
                    if (isset($aVItem['Quantity']) && ((int) $aVItem['Quantity']) <= 0) {
                        unset($this->aData[$sKey]['Variations'][$sVKey]);
                    }
                }
                if (empty($aItem['Variations'])) {
                    $sMessage = MLI18n::gi()->get('sAddItemProductWithZeroQuantity');
                    MLMessage::gi()->addWarn($sMessage, '', false);

                    $oProduct = MLProduct::factory()->getByMarketplaceSKU($aItem['SKU']);
                    $iProductId = $oProduct->get('id');
                    MLErrorLog::gi()->addError($iProductId, $aItem['SKU'], $sMessage, array('SKU' => $aItem['SKU']));
                    $this->aError[] = $sMessage;
                    unset($this->aData[$sKey]);
                } else {
                    // reset index keys of array
                    $this->aData[$sKey]['Variations'] = array_values($this->aData[$sKey]['Variations']);
                }

            }

        }
        return !empty($this->aData);
    }

    protected function hookAddItem($iMagnalisterProductsId, &$aAddItemData) {
        /* {Hook} "additem": Enables you to extend or modify the product data that will be submitted to the marketplace.
            Variables that can be used: 
            <ul>
                <li>$iMagnalisterProductsId (int): Id of the product in the database table `magnalister_product`.</li>
                <li>$aProductData (array): Data row of `magnalister_product` for the corresponding $iMagnalisterProductsId. The field "productsid" is the product id from the shop.</li>
                <li>$iMarketplaceId (int): Id of marketplace</li>
                <li>$sMarketplaceName (string): Name of marketplace</li>
                <li>&$aAddItemData (array): Data for the AddItems request.</li>
            </ul>
        */
        if (($sHook = MLFilesystem::gi()->findhook('additem', 1)) !== false) {
            $aProductData = MLProduct::factory()->set('id', $iMagnalisterProductsId)->data();
            $iMarketplaceId = MLModule::gi()->getMarketPlaceId();
            $sMarketplaceName = MLModule::gi()->getMarketPlaceName();
            require $sHook;
        }
    }
    
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
                    'ACTION' => $this->sAction,
                    'SUBSYSTEM' => $this->getSubSystem(),
                    'MODE' => ($this->blPurge ? 'PURGE' : 'ADD'),
                    'MARKETPLACEID' => $this->oModul->getMarketPlaceId(),
                    'DATA' => array_values($this->aData)//use array_values() covert indexes to auto index , other indexes can make malform error specialy in Rakuten Additem 
                );
                try {
                    if (!MLSetting::gi()->get('blDryAddItems')) {
                        $this->aResponse = $aResponse = MagnaConnector::gi()->submitRequest($aRequest);
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
                    $this->aResponse = $oEx->getResponse();
                    $oEx->setCriticalStatus(false);
                    $this->handleException($oEx);
                } catch (Exception $oEx) {
                    MLMessage::gi()->addDebug($oEx);
                }
                // if there is a problem with non utf-8 chars it will fix it (note: in submit request its already encoded)
                arrayEntitiesToUTF8($aRequest);
                MLMessage::gi()->addDebug('Api Response: addItems', json_indent(json_encode((isset($aResponse) && !empty($aResponse)) ? $aResponse : $aRequest)));
            }
            $aStatistic = $this->oList->getStatistic();
            if ($aStatistic['iCountPerPage'] != $aStatistic['iCountTotal']) {
                throw new Exception('list not finished');
            }
        }
        return $this;
    }

    /**
     * Gets fee for items selected to be uploaded.
     *
     * @return array|false|mixed|string
     * @throws MagnaException
     */
    public function getItemsFee() {
        $aRequest = array(
            'ACTION' => $this->sGetItemsFeeAction,
            'SUBSYSTEM' => $this->getSubSystem(),
            'MARKETPLACEID' => $this->oModul->getMarketPlaceId(),
            'DATA' => $this->getItemsFeeData()
        );

        return MagnaConnector::gi()->submitRequest($aRequest);
    }

    /**
     * Gets data parameter of GetItemsFee request.
     *
     * @throws MagnaException
     */
    protected function getItemsFeeData() {
        throw new MagnaException('Method getItemsFeeData is not implemented in AddItems service. It must be implemented in order to get fee for items.');
    }

    /**
     * @param $oEx
     */
    protected function handleException($oEx) {
        MLMessage::gi()->addError($oEx, '', false);
        $this->aError[] = $oEx->getMessage();
    }

    /**
     * @return array of product data depend on marketplace
     */
    abstract protected function getProductArray();

    public function haveError() {
        return count($this->aError) > 0;
    }

    public function getErrors() {
        return array_unique($this->aError);
    }
    
    protected function additionalErrorManagement($aResponse){
        //just used in Allyouneed and Rakuten to get special error message
    }

    /**
     * Filters request data based on what needs to be skipped and do splitting if needed.
     */
    protected function filterAndSplitSubmitData()
    {
        if (!$this->hasAttributeMatching()) {
            return;
        }

        $submitData = array();
        foreach ($this->aData as $product) {
            $product['IsSplit'] = 0;
            if (empty($product['Variations'])) {
                // If product does not have variations it is sent as master product. Additional data needed for splitting
                // is unset, because it is not needed i the request.
                $this->unsetShopRawData($product);
                $submitData[] = $product;
                continue;
            }

            $matchedAttributesCodeValueId = $this->getMatchedVariationAttributesCodeValueId($product);
            //MLMessage::gi()->addDebug(__LINE__.':'.microtime(true), array($matchedAttributesCodeValueId));
            if ($this->shouldSendShopData()) {
                // It is special case in which product is sent as is. Additional data needed for splitting is unset,
                // because it is not needed in the request.
                $product = $this->setProductVariationValues($product);
                $this->unsetShopRawData($product);

                $submitData[] = $product;
                continue;
            }

            // Getting only variations that are not skipped.
            $product['Variations'] = $this->getMatchedVariations($product, $matchedAttributesCodeValueId);

            // If it is needed, do the splitting of the product
            $submitData = array_merge($submitData, $this->splitProduct($product, $matchedAttributesCodeValueId,
                $product['RawAttributesMatching']));
        }

        $this->aData = $submitData;
    }
    
    protected function hasAttributeMatching()
    {
        return false;
    }

    protected function setProductVariationValues($product)
    {
        /* @var $attributesMatchingService ML_Modul_Helper_Model_Service_AttributesMatching */
        $attributesMatchingService = MLHelper::gi('Model_Service_AttributesMatching');
        foreach ($product['Variations'] as &$variationProduct) {
            $variationProduct['Variation'] = array_merge(
                $variationProduct['Variation'],
                $attributesMatchingService->convertSingleProductMatchingToNameValue(
                    $product['RawAttributesMatching'],
                    $variationProduct['ShopProductInstance'],
                    $variationProduct['RawShopVariation']
                )
            );
        }

        return $product;
    }

    /**
     * Matched attributes array is a few levels deep and this method forms new structure. It is an array which
     * will have as a key, shop key (code) of matched shop attribute, and as value array of keys for values which are
     * matched (Value ids). That way it is easy to check if some attribute or some of its values is matched.
     *
     * @param $product
     * @return array
     */
    protected function getMatchedVariationAttributesCodeValueId($product) {
        $allMatchedAttributes = !empty($product['RawAttributesMatching']) ? $product['RawAttributesMatching'] : array();
        $variationTheme = !empty($product['variation_theme']) ? $product['variation_theme'] : array();
        $variationBlackList = !empty($product['RawVariationThemeBlacklist']) ? $product['RawVariationThemeBlacklist'] : array();

        $matchedAttributeFormatted = array();
        // Go through all matched attributes.
        foreach ($allMatchedAttributes as $mpAttributeCode => $matchedAttribute) {
            if (!is_array($matchedAttribute['Values']) ||
                $this->getAttributeMatchingHelper()->attributeMatchedValueIsLiteral($matchedAttribute) ||
                in_array($mpAttributeCode, $variationBlackList) ||
                //                (!empty($variationTheme) && !in_array($mpAttributeCode, $variationTheme[key($variationTheme)]))
                (!$this->isVariationThemeEmpty($variationTheme) && !in_array($mpAttributeCode, $variationTheme[key($variationTheme)]))
            ) {
                continue;
            }

            $matchedAttributeFormatted[$matchedAttribute['Code']][$mpAttributeCode] = array();

            // Go through all its values.
            foreach ($matchedAttribute['Values'] as $matchedAttributeValue) {
                // Check if that value is already added. If it is don`t add it again.
                if (!in_array($matchedAttributeValue['Shop']['Key'], $matchedAttributeFormatted[$matchedAttribute['Code']])) {
                    // Form new array which will contain final result.
                    $matchedAttributeFormatted[$matchedAttribute['Code']][$mpAttributeCode][] = $matchedAttributeValue['Shop']['Key'];
                }
            }
        }
        return $matchedAttributeFormatted;
    }

    /**
     * Gets variations that should not be skipped.
     *
     * @param $product
     * @param $matchedAttributesCodeValueId
     * @return array
     */
    protected function getMatchedVariations($product, $matchedAttributesCodeValueId) {
        $matchedVariations = array();
        $matchedValueIds = array();
        //MLMessage::gi()->addDebug(__LINE__.':'.microtime(true), array($matchedAttributesCodeValueId));

        foreach ($matchedAttributesCodeValueId as $matchedAttributeKey => $matchedValuesForMpAttribute) {
           foreach ($matchedValuesForMpAttribute as $valueIds) {
               if (empty($matchedValueIds[$matchedAttributeKey])) {
                   $matchedValueIds[$matchedAttributeKey] = $valueIds;
               } else {
                   $matchedValueIds[$matchedAttributeKey] = array_intersect($matchedValueIds[$matchedAttributeKey], $valueIds);
               }
           }
        }

        foreach ($product['Variations'] as $variation) {
            // Go through all product variations
            $allValuesMatched = true;
            foreach ($variation['RawShopVariation'] as $variationDefinition) {
                // Go through all variation definitions
                $attributeCode = $variationDefinition['code'];
                // Check if attributes that make dimension are matched and if their values are matched
                if (
                    (!$this->isVariationThemeEmpty($product['variation_theme']) && !$this->isShopVariationValueMatched(
                            $product, $variationDefinition, $matchedAttributesCodeValueId, $attributeCode)
                    )
                    ||
                    (
                        $this->isVariationThemeEmpty($product['variation_theme']) && isset($matchedAttributesCodeValueId[$attributeCode])
                        &&
                        !in_array(MLFormHelper::getShopInstance()->getVariationValueID($variationDefinition), $matchedValueIds[$attributeCode])
                    )
                ) {
                    // If any value that makes variation definition is not matched that variation should be skipped.
                    // $allValuesMatched flag will be used for skipping.
                    $allValuesMatched = false;
                    break;
                }
            }

            if ($allValuesMatched) {
                $matchedVariations[] = $variation;
            }
        }
        //MLMessage::gi()->addDebug(__LINE__.':'.microtime(true), array($matchedVariations));
        return $matchedVariations;
    }

    /**
     * @param $product
     * @param $variationDefinition
     * @param $matchedAttributesCodeValueId
     * @param $attributeCode
     * @return bool
     */
    protected function isShopVariationValueMatched($product, $variationDefinition, $matchedAttributesCodeValueId, $attributeCode) {
        $variationThemeCode = key($product['variation_theme']);
        $codeForSplitAll = 'splitAll';

        if (empty($product['variation_theme']) || $variationThemeCode === $codeForSplitAll) {
            return true;
        }

        foreach ($product['variation_theme'][$variationThemeCode] as $mpKey) {
            if (isset($matchedAttributesCodeValueId[$attributeCode][$mpKey]) &&
                !in_array(MLFormHelper::getShopInstance()->getVariationValueID($variationDefinition), $matchedAttributesCodeValueId[$attributeCode][$mpKey])) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param $product
     * @param $variationProduct
     * @param $matchedAttributesCodeValueId
     * @param $matchedShopVariationCode
     * @return bool
     */
    protected function shouldSplitVariation($product, $variationProduct, $matchedAttributesCodeValueId, $matchedShopVariationCode) {
        if (!isset($matchedAttributesCodeValueId[$matchedShopVariationCode]) ||
            $this->isVariationInBlacklist($product, $variationProduct, $matchedShopVariationCode)
        ) {
            return true;
        }

        if ($this->isVariationThemeEmpty($product['variation_theme'])) {
            return false;
        }

        $variationThemeCode = key($product['variation_theme']);
        $codeForSplitAll = 'splitAll';

        if ($variationThemeCode === $codeForSplitAll || !isset($matchedAttributesCodeValueId[$matchedShopVariationCode])
        ) {
            return true;
        }

        $variationTheme = $product['variation_theme'][$variationThemeCode];

        foreach ($matchedAttributesCodeValueId[$matchedShopVariationCode] as $mpKey => $matchedValues) {
            if (!in_array($mpKey, $variationTheme)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param $product
     * @param $variationProduct
     * @param $matchedShopVariationCode
     * @return bool
     */
    protected function isVariationInBlacklist($product, $variationProduct, $matchedShopVariationCode) {
        if (empty($product['RawVariationThemeBlacklist'])) {
            return false;
        }

        $mpVariation = $this->getVariationDefinition(
            $variationProduct,
            $product['RawAttributesMatching'],
            array($matchedShopVariationCode),
            $product['RawVariationThemeBlacklist']
        );

        return empty($mpVariation);
    }

    /**
     * Depending on marketplace type, splitting and skipping should be done.
     * 
     * @return bool
     */
    protected function shouldSendShopData() {
        return false;
    }

    /**
     * Does the splitting of products that have physical master product for variations.
     *
     * @param array $product
     * @param array $matchedAttributesCodeValueId
     * @param array $rawAttributesMatching
     * @return array
     */
    protected function splitProduct($product, $matchedAttributesCodeValueId, $rawAttributesMatching) {
        $masterProducts = array();
        $variationThemeCode = empty($product['variation_theme']) ? 'null' : key($product['variation_theme']);
        $codeForSplitAll = 'splitAll';

        foreach ($product['Variations'] as $variationProduct) {
            // Go through all variations. Initial SKU will be product SKU
            $masterSKU = $product['SKU'];
            $masterTitle = $product['ItemTitle'];
            $matchedShopVariationCodes = array();
            $masterProductTitleSuffix = array();

            foreach ($variationProduct['RawShopVariation'] as $variationDefinition) {
                // Go through each variation definition
                if ($this->shouldSplitVariation($product, $variationProduct, $matchedAttributesCodeValueId, $variationDefinition['code'])) {
                    if ($variationThemeCode === $codeForSplitAll) {
                        // If every variation should be sent as master product masterSKU will be the same as variations` SKU.
                        $masterSKU = $variationProduct['SKU'];

                    } else {
                        // If attribute is not matched format new parent SKU which will be used as new master products` SKU
                        $masterSKU .= '-' . $variationDefinition['name'] . '-' . $variationDefinition['value'];
                    }
                    // If attribute is not matched format new parent ItemTitle which will be used as new master products` ItemTitle
                    $masterProductTitleSuffix[] = $variationDefinition['name'] . ' - ' . $variationDefinition['value'];
                    $masterTitle .= $variationDefinition['name'] . ' - ' . $variationDefinition['value'];
                } else {
                    // If attribute is matched add it to definition for that product. Later it will be used for adding
                    // in appropriate master products` variation.
                    $matchedShopVariationCodes[] = $variationDefinition['code'];
                }
            }

            // If product has new ItemTitle, set it.
            if ($masterTitle !== $product['ItemTitle']) {
                $masterTitle = $product['ItemTitle'] . ' : ' . join(', ', $masterProductTitleSuffix);
            }

            $variationProduct['Variation'] = $this->setVariationDefinition(
                $this->getVariationDefinition(
                    $variationProduct,
                    $rawAttributesMatching,
                    $matchedShopVariationCodes,
                    !empty($product['RawVariationThemeBlacklist']) ? $product['RawVariationThemeBlacklist'] : array()
                )
            );
            $masterProducts[$masterSKU]['MasterTitle'] = $masterTitle;
            $masterProducts[$masterSKU]['Variations'][] = $variationProduct;
        }

        $splitProducts = array();
        foreach ($masterProducts  as $variationMasterSku => $variantProducts) {
            // Go through formatted split products variations and make appropriate new master products with its variations.
            $splitProducts = array_merge(
                $splitProducts,
                $this->createVariantMasterProducts(
                    $variantProducts['Variations'],
                    $variantProducts['MasterTitle'],
                    $variationMasterSku, 
                    $product
                )
            );
        }

        return $splitProducts;
    }

    /**
     * @param $variationProduct
     * @param $rawAttributesMatching
     * @param $matchedShopVariationCodes
     * @param array $variationThemeBlacklist
     * @return mixed
     */
    protected function getVariationDefinition(
        $variationProduct,
        $rawAttributesMatching,
        $matchedShopVariationCodes,
        $variationThemeBlacklist = array()
    ) {
        if (empty($matchedShopVariationCodes)) {
            return array();
        }

        /* @var $attributesMatchingService ML_Modul_Helper_Model_Service_AttributesMatching */
        $attributesMatchingService = MLHelper::gi('Model_Service_AttributesMatching');
        $variationDefinition = $attributesMatchingService->convertSingleProductMatchingToNameValue(
            $rawAttributesMatching,
            $variationProduct['ShopProductInstance'],
            $matchedShopVariationCodes
        );

        if (!empty($variationThemeBlacklist)) {
            foreach ($variationThemeBlacklist as $mpBlacklistCode) {
                unset($variationDefinition[$mpBlacklistCode]);
            }
        }

        return $variationDefinition;
    }

    /**
     *
     * @param $categoryAttributes
     * @return array
     */
    protected function setVariationDefinition($categoryAttributes) {
        return $categoryAttributes;
    }

    /**
     * When product is split it is necessary to create new master product which will have its own variations.
     *
     * @param $variantProducts
     * @param $variationMasterItemTitle
     * @param $variationMasterSku
     * @param $productToClone
     * @return mixed
     */
    protected function createVariantMasterProducts($variantProducts, $variationMasterItemTitle, $variationMasterSku, $productToClone) {
        if (count($variantProducts) === 1 && isset($variantProducts[0]['Variation']) && $variantProducts[0]['Variation'] == array()) {
            // If everything is split and there are no variation dimensions variation product should be sent as master product.
            $masterProduct = array_merge($productToClone, $variantProducts[0]);
            $masterProduct['IsSplit'] = 1;
            $masterProduct['ItemTitle']  = $variationMasterItemTitle;
            unset($masterProduct['Variations']);
            unset($masterProduct['Variation']);
            $this->unsetShopRawData($masterProduct);
            return array($masterProduct);
        }
        // Basic case is that new master product will be the same as old master product just with a new SKU and
        // its own variations.
        $masterProduct = $productToClone;
        $masterProduct['SKU'] = $variationMasterSku;
        $masterProduct['ItemTitle']  = $variationMasterItemTitle;
        $masterProduct['Variations'] = $variantProducts;
        // If product is split add flag for product.
        $masterProduct['IsSplit'] = intval($variationMasterSku != $productToClone['SKU']);
        $this->unsetShopRawData($masterProduct);
        return array($masterProduct);
    }

    /**
     * Unset data that is used for deciding if variation should be skipped and if product should be split. This information
     * is not needed in final request.
     * 
     * @param $product
     */
    protected function unsetShopRawData(&$product) {
        unset(
            $product['RawAttributesMatching'],
            $product['ShopProductInstance'],
            $product['RawShopVariation'],
            $product['RawVariationThemeBlacklist']
        );

        if (empty($product['Variations'])) {
            return;
        }

        foreach ($product['Variations'] as &$variation) {
            $this->unsetShopRawData($variation);
        }
    }

    /**
     * @return array
     */
    public function getResponse() {
        return $this->aResponse;
    }

    /**
     * @param array $variationTheme
     *
     * @return bool
     */
    protected function isVariationThemeEmpty($variationTheme) {
        if (!empty($variationTheme) && is_array($variationTheme)) {
            if (count($variationTheme) === 1) {//In CDiscount variation_theme could be array(array())
                $mSingleItem = current($variationTheme);
                return empty($mSingleItem);
            }
            return false;
        }
        return true;

    }

    /**
     * @return ML_Modul_Helper_Model_Service_AttributesMatching|object
     */
    protected function getAttributeMatchingHelper() {
        return MLHelper::gi('Model_Service_AttributesMatching');
    }
}
