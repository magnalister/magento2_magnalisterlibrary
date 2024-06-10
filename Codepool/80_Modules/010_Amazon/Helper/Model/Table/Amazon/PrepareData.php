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

MLFilesystem::gi()->loadClass('Form_Helper_Model_Table_PrepareData_Abstract');

class ML_Amazon_Helper_Model_Table_Amazon_PrepareData extends ML_Form_Helper_Model_Table_PrepareData_Abstract {

    public function getPrepareTableProductsIdField() {
        return 'ProductsID';
    }

    protected function prepareTypeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function skuField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getSku());
    }
    protected function currencyField(&$aField) {
        $aField['value'] = MLModule::gi()->getConfig('currency');
    }

    protected function variationField(&$aField) {
        $aVariants = array();
        foreach ($this->oProduct->getVariatonData() as $aVariant) {
            $aVariants[] = array(
                'Name' => $aVariant['name'],
                'Value' => $aVariant['value']
            );
        }

        $aField['value'] = $aVariants;
    }

    protected function variationGroups_ValueField(&$aField)
    {
        $aField['value'] = $this->getFirstValue($aField);
        $aField['optional'] = array('active' => true);

        if (!isset($aField['value']) || $aField['value'] === ''){
            $this->aErrors[] = 'amazon_prepareform_category';
        }
    }

    protected function quantityField(&$aField) {
        $aStockConf = MLModule::gi()->getStockConfig();
        $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getSuggestedMarketplaceStock($aStockConf['type'], $aStockConf['value'], $aStockConf['max']));
    }

    protected function priceField(&$aField){
        $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject()));
    }

    protected function productsIdField(&$aField){
        $aField['value'] = $this->oProduct->get('id');
    }

    protected function mainCategoryField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, '');
        if (empty($aField['value'])) {
            $aField['value'] = $this->getField('variationgroups.value', 'value');
        }
    }

    protected function topMainCategoryField(&$aField) {
        $aField['value'] = $this->getField('variationgroups.value', 'value');
    }

    protected function topProductTypeField(&$aField) {
        $this->_topField($aField);
        $sParent = $this->getField('topMainCategory','value');
        $aField['value'] = isset($aField['value'][$sParent]) ? $aField['value'][$sParent] : 0;
    }

    protected function topBrowseNode1Field(&$aField) {
        $sMainCat = $this->getField('variationgroups.value','value');
        $aNodes = $this->getField('browsenodes', 'value');
        $aField['value'] = isset($aNodes[$sMainCat][0]) ? $aNodes[$this->getField('variationgroups.value','value')][0] : '';
    }

    protected function topBrowseNode2Field(&$aField) {
        $sMainCat = $this->getField('variationgroups.value','value');
        $aNodes = $this->getField('browsenodes', 'value');
        $aField['value'] = isset($aNodes[$sMainCat][1]) ? $aNodes[$this->getField('variationgroups.value','value')][1] : '';
    }

    protected function _topField(&$aField) {
        $aField['value'] = $this->getField(substr($aField['name'], 3), 'value');
    }

    protected function productTypeField(&$aField) {
        $aField['dependonfield']['depend'] = 'variationgroups.value';
        $aField['value'] = $this->getFirstValue($aField, array());
        // Backward compatibility
        $sMainCategory = $this->getField('maincategory', 'value');
        $sVariationGroupsValue = $this->getField('variationgroups.value', 'value');

        if (!empty($sVariationGroupsValue) && !isset($aField['value'][$sVariationGroupsValue])) {
            $aField['value'] = array($sVariationGroupsValue => null);
        }

        if (!is_array($aField['value'])) {
            $aField['value'] = !empty($sVariationGroupsValue) ? array($sVariationGroupsValue => $aField['value'])
                : array($sMainCategory => $aField['value']);
        }

        if (!array_key_exists($sMainCategory, $aField['value'])
            && !array_key_exists($sVariationGroupsValue, $aField['value'])) {
            $aField['value'] = '';
        }
    }

    protected function browseNodesField(&$aField) {
        $aField['dependonfield']['depend'] = 'variationgroups.value';
        $aField['value'] = $this->getFirstValue($aField, array(''));
        // Backward compatibility
        $sMainCategory = $this->getField('maincategory', 'value');
        $sVariationGroupsValue = $this->getField('variationgroups.value', 'value');

        if (!empty($sVariationGroupsValue) &&
            is_array($aField['value']) &&
            !isset($aField['value'][$sVariationGroupsValue])
        ) {
            $aField['value'] = array($sVariationGroupsValue => null);
        }

        if (!is_array($aField['value'])) {
            $aField['value'] = !empty($sMainCategory) ? array($sMainCategory => array($aField['value']))
                : array($sVariationGroupsValue => array($aField['value']));
        }

        if (!array_key_exists($sMainCategory, $aField['value'])
            && !array_key_exists($sVariationGroupsValue, $aField['value'])) {
            $aField['value'] = array('');
        }
    }

    protected function itemTitleField(&$aField) {
        $oProduct = $this->oProduct;
        $oPrepareList = $this->getPrepareList();
        if ($this->oProduct->get('parentid') == 0) {
            $aVariants = $this->oProduct->getVariants();
            $this->setPreparelist(null)->setProduct(current($aVariants));
        }

        $aField['value'] = $this->getFirstValue($aField, $oProduct->getName());
        $this->setPreparelist($oPrepareList)->setProduct($oProduct);
    }

    protected function manufacturerField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        if (empty($aField['value'])) {

            $mGeneralManufacturer = $this->oProduct->getModulField('general.manufacturer', true);
            if (empty($mGeneralManufacturer)) {
                $mGeneralManufacturer = null;
            }

            $mFallbackManufacturer = MLModule::gi()->getConfig('prepare.manufacturerfallback');
            if (empty($mFallbackManufacturer)) {
                $mFallbackManufacturer = null;
            }

            if (
                $this->oProduct->get('parentid') == 0
                || ($this->oProduct->get('parentid') != 0 && count($this->oProduct->getParent()->getVariatonData()) == 1)
            ) {
                $oProduct = $this->oProduct;
                $oPrepareList = $this->getPrepareList();
                $aVariants = $this->oProduct->getVariants();
                $this->setPreparelist(null)->setProduct(current($aVariants));
                $aField['value'] = $this->getFirstValue($aField, $mGeneralManufacturer, $mFallbackManufacturer);
                $this->setPreparelist($oPrepareList)->setProduct($oProduct);
            } else {
                $aField['value'] = $this->getFirstValue($aField, $mGeneralManufacturer, $mFallbackManufacturer);
            }
        }
    }

    protected function descriptionField(&$aField){
        $oProduct = $this->oProduct;
        $oPrepareList = $this->getPrepareList();
        if ($this->oProduct->get('parentid') == 0) {
            $aVariants = $this->oProduct->getVariants();
            $this->setPreparelist(null)->setProduct(current($aVariants));
        }
        $sDescription = $this->getFirstValue($aField, $oProduct->getDescription());
        // Helper for php8 compatibility - can't pass null to str_replace 
        $sDescription = MLHelper::gi('php8compatibility')->checkNull($sDescription);
        $sDescription = str_replace(array('&nbsp;', html_entity_decode('&nbsp;')), ' ', $sDescription);
        $sDescription = sanitizeProductDescription(
            $sDescription,
            '<p><br><ul><ol><li><strong><b><em><i>',
            '_keep_all_'
        );

        $sDescription = str_replace(array('<br />', '<br/>'), '<br>', $sDescription);
        // $sDescription = preg_replace('/(\s*<br[^>]*>\s*)*$/', ' ', $sDescription);
        $sDescription = preg_replace('/\s\s+/', ' ', $sDescription);
        $sDescription = $this->truncateStringHtmlSafe($sDescription, 2000);
        $aField['value'] = $sDescription;
        $this->setPreparelist($oPrepareList)->setProduct($oProduct);
    }

    protected function brandField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        if (empty($aField['value'])) {
            $this->manufacturerField($aField);
        }
    }

    protected function manufacturerPartNumberField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        if (empty($aField['value'])) {
            $sAmazonConfigValue = MLModule::gi()->getConfig('checkin.skuasmfrpartno');
            if (isset($sAmazonConfigValue) && $sAmazonConfigValue) {
                $sDefaultValue = $this->oProduct->getSku();
            } else {
                $sDefaultValue = $this->oProduct->getModulField('general.manufacturerpartnumber', true);
            }

            if (
                $this->oProduct->get('parentid') == 0
                || ($this->oProduct->get('parentid') != 0 && count($this->oProduct->getParent()->getVariatonData()) == 1)
            ) {
                $oProduct = $this->oProduct;
                $oPrepareList = $this->getPrepareList();
                $aVariants = $this->oProduct->getVariants();
                $this->setPreparelist(null)->setProduct(current($aVariants));

                $aField['value'] = $this->getFirstValue($aField, $sDefaultValue);
                $this->setPreparelist($oPrepareList)->setProduct($oProduct);
            } else {
                $aField['value'] = $sDefaultValue;
            }
        }
    }

    protected function eanField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);

        if (in_array($aField['value'], array(null, ''), true)) {
            $sType = $this->getInternationalIdentifier();
            if (
                $this->oProduct->get('parentid') == 0
                || ($this->oProduct->get('parentid') != 0 && $this->oProduct->getParent()->getVariantCount() == 1)
            ) {
                $aVariants = $this->oProduct->getVariants();
                $oFirstVariant = current($aVariants);
                $sFirstVariantEAN = $oFirstVariant->getModulField('general.'.strtolower($sType), true);
                $sProductEAN = $this->oProduct->getModulField('general.'.strtolower($sType), true);
                $aField['value'] = empty($sFirstVariantEAN) ? $sProductEAN : $sFirstVariantEAN;
            } else {
                $aField['value'] = $this->oProduct->getModulField('general.'.strtolower($sType), true);
            }
        }
    }

    protected function weightField(&$aField) {
        $aField['value'] = $this->oProduct->getWeight();
    }

    protected function imagesField(&$aField) {
        if ($this->oProduct->get('parentid') == 0) {
            $aImages = $this->oProduct->getImages();
            foreach ($this->oProduct->getVariants() as $oVariant) {
                $aImages = array_merge($aImages, $oVariant->getImages());
            }
        } else {
            $aImages = $this->oProduct->getImages();
        }
        $aImages = array_unique($aImages);
        $aField['values'] = array();
        foreach($aImages as $sImage){
            try{
                $aField['values'][$sImage] = MLImage::gi()->resizeImage($sImage, 'product', 80, 80);
            }catch(Exception $oEx){
                //no image in fs
            }
        }
        $aValues = array_slice(array_keys($aField['values']), 0, 9);
        $aField['value'] = $this->getFirstValue($aField, $aValues, array());
    }

    protected function asinField (&$aField) {
        $aDummyField = array('name' => 'aIdentId');
        $aField['value'] = $this->getFirstValue($aDummyField);
    }

    protected function willShipInternationallyField (&$aField) {
        $aDummyField = array('name' => 'shipping');
        $aField['value'] = $this->getFirstValue($aDummyField, MLModule::gi()->getConfig('internationalshipping'));
    }

    public function bulletPointsField(&$aField) {
        $aField['value'] = $this->getFirstValue(
            $aField,
            $this->stringToArray(
                $this->oProduct->getMetaDescription(),
                5,
                500
            )
        );
    }

    protected function keywordsField(&$aField) {
        $sProductKeywords = $this->oProduct->getMetaKeywords();
        // Helper for php8 compatibility - can't pass null to str_replace 
        $sProductKeywords = MLHelper::gi('php8compatibility')->checkNull($sProductKeywords);
        $sProductKeywords = substr($sProductKeywords, 0, strpos(wordwrap($sProductKeywords, 1000, "\n", true)."\n", "\n"));
        $aField['value'] = $this->getFirstValue($aField, $sProductKeywords);
    }

    protected function shippingTimeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, MLModule::gi()->getConfig('leadtimetoship'));
    }

    protected function basePriceField(&$aField) {
        $aField['value'] = $this->oProduct->getBasePrice();
    }

    protected function B2BActiveField(&$aField) {
        $b2bActiveGlobally = $this->getFromConfig('b2bactive');
        if (empty($b2bActiveGlobally) || $b2bActiveGlobally === 'false') {
            $aField['disable'] = true;
            $aField['value'] = 'false';
        } else {
            $aField['value'] = $this->getFirstValue($aField, 'false');
        }
    }

    protected function B2BSellToField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, 'b2b_b2c');
    }

    protected function B2BDiscountTypeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, '');
    }

    protected function B2BDiscountTier1QuantityField(&$aField) {
        $this->validateB2BDiscountTier($aField, '', '1', true);
    }

    protected function B2BDiscountTier2QuantityField(&$aField) {
        $this->validateB2BDiscountTier($aField, 'B2BDiscountTier1Quantity', '2', true);
    }

    protected function B2BDiscountTier3QuantityField(&$aField) {
        $this->validateB2BDiscountTier($aField, 'B2BDiscountTier2Quantity', '3', true);
    }

    protected function B2BDiscountTier4QuantityField(&$aField) {
        $this->validateB2BDiscountTier($aField, 'B2BDiscountTier3Quantity', '4', true);
    }

    protected function B2BDiscountTier5QuantityField(&$aField) {
        $this->validateB2BDiscountTier($aField, 'B2BDiscountTier4Quantity', '5', true);
    }

    protected function B2BDiscountTier1DiscountField(&$aField) {
        $this->validateB2BDiscountTier($aField, '', '1');
    }

    protected function B2BDiscountTier2DiscountField(&$aField) {
        $this->validateB2BDiscountTier($aField, 'B2BDiscountTier1Discount', '2');
    }

    protected function B2BDiscountTier3DiscountField(&$aField) {
        $this->validateB2BDiscountTier($aField, 'B2BDiscountTier2Discount', '3');
    }

    protected function B2BDiscountTier4DiscountField(&$aField) {
        $this->validateB2BDiscountTier($aField, 'B2BDiscountTier3Discount', '4');
    }

    protected function B2BDiscountTier5DiscountField(&$aField) {
        $this->validateB2BDiscountTier($aField, 'B2BDiscountTier4Discount', '5');
    }

    /**
     * Adds error if quantity discount tier configuration is not set properly.
     * Field is invalid if it is different than zero and less than value for corresponding field in previous tier,
     * or only one of quantity and discount field in the same tier is not set.
     *
     * @param array $aField Field to validate
     * @param string $prevFieldId ID of corresponding field in previous tier
     * @param int $tierNumber Current tier number
     * @param bool $quantityField TRUE if current field is quantity field
     */
    private function validateB2BDiscountTier(&$aField, $prevFieldId, $tierNumber, $quantityField = false) {
        $value = $aField['value'] = $this->getFirstValue($aField, 0);
        $previousValue = null;
        if (!empty($prevFieldId)) {
            $previousValue = $this->getField($prevFieldId, 'value');
            $previousValue = !empty($previousValue) ? $previousValue : 0;
        }
        $tierType = $this->getField('B2BDiscountType', 'value');

        if (!empty($tierType) && $this->getField('B2BActive', 'value') == 'true') {
            // quantity field value should always be greater than previous field value
            // discount (price) field should be greater for percent values and less for fixed price values
            $rise = $tierType === 'percent' || $quantityField;

            if ($quantityField) {
                // price and quantity fields should be set either both or none
                // check it for quantity field only to prevent circular reference
                $discountId = str_replace('quantity', 'discount', strtolower($aField['name']));
                $discountValue = $this->getField($discountId, 'value');
                if (($value == 0 && $discountValue != 0) || ($value != 0 && $discountValue == 0)) {
                    $this->aErrors[] = MLI18n::gi()->get('amazon_config_tier_error', array('TierNumber' => $tierNumber));
                    $aField['cssclasses'][] = 'ml-error';
                }
            }

            if ($previousValue !== null
                && ($value > 0
                    && ($previousValue == 0
                        || ($rise && $value <= $previousValue)
                        || (!$rise && $value >= $previousValue)
                    )
                )
            ) {
                $this->aErrors[] = MLI18n::gi()->get('amazon_config_tier_error', array('TierNumber' => $tierNumber - 1));
            } elseif ($value < 0) {
                $this->aErrors[] = MLI18n::gi()->get('amazon_config_tier_error', array('TierNumber' => $tierNumber));
                $aField['cssclasses'][] = 'ml-error';
            }
        }
    }

    public function stringToArray($sString,$iCount,$iMaxChars) {
        // Helper for php8 compatibility - can't pass null to str_replace 
        $sString = MLHelper::gi('php8compatibility')->checkNull($sString);
        $aArray = explode(',', $sString);
        array_walk($aArray, array($this, 'trim'));
        $aOut = array_slice($aArray, 0, $iCount);
        foreach ($aOut as $sKey => $sBullet) {
            $aOut[$sKey] = trim($sBullet);
            if (empty($aOut[$sKey])){
                continue;
            }
            $sBullet = str_replace("\n", "", $sBullet);
            $aOut[$sKey] = substr($sBullet, 0, strpos(wordwrap($sBullet, $iMaxChars, "\n", true)."\n", "\n"));
        }
        return $aOut;
    }

    protected function trim(&$v, $k){
        $v = trim($v);
    }

    private function getInternationalIdentifier() {
        $sSite = MLModule::gi()->getConfig('site');
        if ($sSite === 'US') {
            return 'UPC';
        }

        return 'EAN';
    }

    protected function shippingTemplateField(&$aField) {
        $aField['optional']['active'] = true;
        $aDefaultTemplate = MLModule::gi()->getConfig('shipping.template');
        $Default = 0;
        if (is_array($aDefaultTemplate)) {
            foreach ($aDefaultTemplate as $iKey => $sValue) {
                if ($sValue['default'] == '1') {
                    $Default = $iKey;
                    break;
                }
            }
        }

        $aField['value'] = $this->getFirstValue($aField, $Default);
    }

    /**
     * "BopisStores" Field of Prepare Form
     *
     * @param $aField
     * @return void
     */
    protected function bopisStoresField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }


    /**
     * checks if a field is active, or not
     * force some fields to get full value because after its optional active
     *
     * @param type $aField
     * @param bool $blDefault defaultvalue, if  no request or dont find in prepared
     * @return bool
     */
    public function optionalIsActive($aField) {
        if (is_string($aField)) {
            $sField = $aField;
        } else {
            if (isset($aField['optional']['name'])) {
                $sField = $aField['optional']['name'];
            } else {
                $sField = isset($aField['realname']) ? $aField['realname'] : $aField['name'];
            }
        }
        if (strtolower($sField) == 'shippingtemplate') {
            return true;
        }
        return parent::optionalIsActive($aField);
    }

    public function searchEanAndAsinOnAmazon($asin, $ean, $productsName)
    {
        $searchResults = array();
        if (!empty($asin)) {
            try {
                $result = MagnaConnector::gi()->submitRequest(array(
                    'ACTION' => 'ItemLookup',
                    'ASIN' => $asin
                ));
                if (!empty($result['DATA'])) {
                    $searchResults = array_merge($searchResults, $result['DATA']);
                }
            } catch (MagnaException $e) {
                $e->setCriticalStatus(false);
            }
        }
        $ean = str_replace(array(' ', '-'), '', $ean);
        if (!empty($ean)) {
            try {
                $result = MagnaConnector::gi()->submitRequest(array(
                    'ACTION' => 'ItemLookup',
                    'ASIN' => $ean
                ));
                if (!empty($result['DATA'])) {
                    $searchResults = array_merge($searchResults, $result['DATA']);
                }
            } catch (MagnaException $e) {
                $e->setCriticalStatus(false);
            }
            if (empty($searchResults)) {
                try {
                    $result = MagnaConnector::gi()->submitRequest(array(
                        'ACTION' => 'ItemSearch',
                        'NAME' => $ean
                    ));
                    if (!empty($result['DATA'])) {
                        $searchResults = array_merge($searchResults, $result['DATA']);
                    }
                } catch (MagnaException $e) {
                    $e->setCriticalStatus(false);
                }
            }
        }

        if (!empty($productsName)) {
            try {
                $result = MagnaConnector::gi()->submitRequest(array(
                    'ACTION' => 'ItemSearch',
                    'NAME' => $productsName
                ));
                if (!empty($result['DATA'])) {
                    $searchResults = array_merge($searchResults, $result['DATA']);
                }
            } catch (MagnaException $e) {
                $e->setCriticalStatus(false);
            }
        }

        return $searchResults;
    }

    public function getProductArrayById($oProduct)
    {
        /* @var $oProduct ML_Shop_Model_Product_Abstract */
        $aProduct = array(
            'Id' => $oProduct->get('id'),
            'SKU' => $oProduct->getSKU(),
            'Title' => $oProduct->getName(),
            'Description' => $oProduct->getDescription(),
            'Images' => $oProduct->getImages(),
            'Price' => $oProduct->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject(), true, true),
            'Manufacturer' => $oProduct->getManufacturer(),
            'EAN' => $oProduct->getModulField('general.ean', true)
        );

        return $aProduct;
    }
}
