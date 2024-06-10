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

class ML_Otto_Helper_Model_Table_Otto_PrepareData extends ML_Form_Helper_Model_Table_PrepareData_Abstract {

    public $aErrors = array();

    /**
     * @var ML_Shop_Model_Product_Abstract $oMasterProduct
     */
    protected $oMasterProduct = null;

    public function getPrepareTableProductsIdField() {
        return 'products_id';
    }

    public function setMasterProduct(ML_Shop_Model_Product_Abstract $oMasterProduct) {
        $this->oMasterProduct = $oMasterProduct;

        return $this;
    }

    protected function products_idField(&$aField) {
        $aField['value'] = $this->oProduct->get('id');
    }

    public function skuField(&$aField) {
        $aField['value'] = $this->oProduct->getMarketPlaceSku();
    }

    protected function EANField(&$aField) {
        $aField['value'] = $this->oProduct->getEAN();
    }

    protected function titleDisabledField(&$aField) {
        $aField['value'] =  MLI18n::gi()->get('ML_OTTO_PREPARE_TITLE_INFO');
    }

    protected function productNameField(&$aField) {
        if ($this->oProduct->get('parentid') === '0') {
            $aField['value'] = $this->oProduct->getMarketPlaceSku();
        } else {
            $aField['value'] = $this->oProduct->getParent()->getMarketPlaceSku();
        }
    }

    protected function standardPriceField(&$aField) {
        $aField['value'] = $this->oProduct->getSuggestedMarketplacePrice(MLModul::gi()->getPriceObject());
    }

    protected function brandField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getManufacturer());
    }

    /**
     * Get Images for item preparation and upload
     *
     * @param $aField
     * @return void
     */
    protected function imagesField(&$aField) {
        $aImages = $aProductImages = $this->oProduct->getImages();
        if ($this->oProduct->get('parentid') !== '0') {
            $aImages = array_merge($aProductImages, $this->oProduct->getParent()->getImages());
        }
        foreach ($aImages as $sImage) {
            try {
                $aField['values'][$sImage] = MLImage::gi()->resizeImage($sImage, 'products', 80, 80);
            } catch (Exception $oEx) {
                MLMessage::gi()->addDebug($oEx);
                //$this->aErrors[] = 'otto_prepare_images_not_exist';
            }
        }

        // Check for already prepared data
        if (isset($aField['values'])) {
            reset($aImages);
            $aField['value'] = $this->getFirstValue($aField, array_keys($aField['values']));
            $aField['value'] = empty($aField['value']) ? array_keys($aField['values']) : $aField['value'];
            $aField['value'] = (array)$aField['value'];
        } else {
            $aField['value'] = (array)$this->getFirstValue($aField, $aImages);
        }

        if (!isset($aField['value']) || $aField['value'] === '') {
            $this->aErrors[] = 'ML_OTTO_ERROR_MISSING_IMAGES';
        }

        // Check when Uploading Items
        if (!empty($aField['additemmode'])) {
            $aAllImages = $aField['value'];
            $aField['value'] = array();
            foreach ($aProductImages as $sImage) {
                if (in_array($sImage, $aAllImages, true)) {
                    $aField['value'][] = $sImage;
                }
            }
        }
    }


    protected function primaryCategoryNameField(&$aField) {
        $sCategoryID = $this->getField('primarycategory', 'value');
        $oCat = MLDatabase::factory('Otto_CategoriesMarketplace');
        $oCat->init(true)->set('categoryid', $sCategoryID);
        $sCat = $oCat->get('categoryname');

        $aField['value'] = $sCat;
    }
    /**
     * This function is needed only for additem, and it has no meaning in preparation
     * @param $aField
     */
    public function vatField(&$aField) {
        $taxClassId = $this->oProduct->getTaxClassId();
        $taxConfiguration = MLModul::gi()->getConfig('vat');
        $aField['value'] = $taxConfiguration[$taxClassId] ? $taxConfiguration[$taxClassId] : '';
    }

    protected function manufacturerField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getManufacturer());
    }

    protected function descriptionField(&$aField) {
        $sDescription = $this->getFirstValue($aField, $this->oProduct->getDescription());
        $aField['value'] = sanitizeProductDescription(
            $sDescription,
            '<p><ul><ol><li><span><br><b><div><h1><h2><h3><h4><h5><h6><blockquote><i><font><s><u><o><sup><sub><ins><del><strong><strike><tt><code><big><small><br><span><em>)',
            '_keep_all_'
        );

        if (!isset($aField['value']) || $aField['value'] === '') {
            $this->aErrors[] = 'ML_OTTO_ERROR_MISSING_DESCRIPTION';
        }
    }

    protected function msrpPriceField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        if(isset($aField['value'])) {
            $aField['value'] = str_replace(',', '.', trim($aField['value']));
            if ((string)((float)$aField['value']) != $aField['value']) {
                $this->aErrors[] = 'ML_OTTO_ERROR_WRONG_MANUFACTURERSSUGGESTEDRETAILPRICE';
            } else {
                $aField['value'] = number_format($aField['value'], 2);
            }
            if ($aField['value'] <= 0) {
                $aField['value'] = '';
            }
        }
    }

    protected function currencyField(&$aField) {
        $aField['value'] = MLModul::gi()->getConfig('currency');
    }

    public function deliveryTypeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField) !== null ? $this->getFirstValue($aField) : MLModul::gi()->getConfig('deliverytype');
    }

    public function deliveryTimeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField) !== null ? $this->getFirstValue($aField) : MLModul::gi()->getConfig('deliverytime');

        if (!isset($aField['value']) || $aField['value'] === '0') {
            $this->aErrors[] = 'ML_OTTO_ERROR_WRONG_DELIVERY_TIME';
        }
    }

    protected function MarketplaceAttributesField(&$aField) {
        $attributesMatchingService = MLHelper::gi('Model_Service_AttributesMatching');
        $storedAttributes = $this->getField('ShopVariation', 'value');
        /** @var ML_Modul_Helper_Model_Service_AttributesMatching $attributesMatchingService */
        $aCatAttributes = $attributesMatchingService->mergeConvertedMatchingToNameValue(
            $storedAttributes,
            $this->oProduct,
            $this->oMasterProduct//If a value is matched only for main variant, this matching will be used for not matched variant in the product as default
        );

        $aKeys = array_keys($aCatAttributes);

        foreach ($aKeys as $sKey){
            $aCatAttributes[pack('H*',$sKey)] = $this->checkAndConvertAttributeByType($aCatAttributes[$sKey]);
            unset($aCatAttributes[$sKey]);
        }

        $aField['value'] = $aCatAttributes;
    }

    /**
     * Casts the variable to boolean if it has 'true' or 'false' as string
     * TODO Otto returns data type but this is not imported in v3 maybe later we can
     * TODO import data type and validate and cast attributes based on data given from otto
     *
     * @param $variable
     * @param $marketplaceDataType
     * @return mixed
     */
    private function checkAndConvertAttributeByType($variable, $marketplaceDataType = null) {
        // check for boolean
        if (    is_string($variable)
            && (strtolower($variable) === 'false' || strtolower($variable) === 'true')
        ) {
            $variable = filter_var($variable, FILTER_VALIDATE_BOOLEAN);
        }

        // check if variable is a string with a float value (dot for decimals)
        if (is_string($variable) && preg_match('/^-?\d+\.\d*$/', $variable)) {
            $variable = (float)$variable; // cast to float
        }

        // check if variable is a string with a float value (comma for decimals)
        if (is_string($variable) && preg_match('/^-?\d+\,\d*$/', $variable)) {
            $variable = (float)str_replace(',', '.', $variable);
        }

        //converts float values from string with comma to real floats
        return $variable;
    }

    protected function CategoryIndependentAttributesField(&$aField) {
        $attributesMatchingService = MLHelper::gi('Model_Service_AttributesMatching');
        /** @var ML_Modul_Helper_Model_Service_AttributesMatching $attributesMatchingService */
        $aCatAttributes = $attributesMatchingService->mergeConvertedMatchingToNameValue(
            $this->getField('CategoryIndependentShopVariation', 'value'),
            $this->oProduct,
            $this->oMasterProduct//If a value is matched only for main variant, this matching will be used for not matched variant in the product as default
        );

        $aKeys = array_keys($aCatAttributes);
        foreach ($aKeys as $sKey){
            $aCatAttributes[pack('H*',$sKey)] = $this->checkAndConvertAttributeByType($aCatAttributes[$sKey]);
            unset($aCatAttributes[$sKey]);
        }

        $aField['value'] = $aCatAttributes;
    }

    protected function CategoryIndependentShopVariationField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, array());
    }

    public function processingTimeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    public function shippingTypeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    public function featureField(&$aField) {
        $aField['value'] = $this->getFirstValue(
            $aField,
            $this->stringToArray(
                $this->oProduct->getMetaDescription(),
                5,
                500
            )
        );
    }

    /**
     * only for add item request
     * @param $aField
     */
    public function featuresField(&$aField) {
        $aField['value'] = $this->getField('feature', 'value');
    }

    protected function variationGroups_ValueField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        $aField['optional'] = array('active' => true);
    }

    protected function primaryCategoryField(&$aField) {
        // variationgroups.value is general key for category
        // but in table of prepare we have primary category field
        // in preparation we get correct category from variationgroups.value posted value
        // and in additem we get that value from primary category field of prepare table
        if ($this->getField('variationgroups.value', 'value') !== null) {
            $aField['value'] = $this->getField('variationgroups.value', 'value');
        } else {
            $aField['value'] = $this->getFirstValue($aField);
        }

        if (empty($aField['value'])) {
            $this->aErrors[] = 'ML_OTTO_ERROR_MISSING_CATEGORY';
        }
    }

    protected function shopVariationField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, array());
    }

    protected function stringToArray($sString, $iCount, $iMaxChars) {
        // Helper for php8 compatibility - can't pass null to explode 
        $sString = MLHelper::gi('php8compatibility')->checkNull($sString);
        $aArray = explode(',', $sString);
        foreach ($aArray as $key => $value) {
            $aArray[$key] = trim($value);
        }

        $aOut = array_slice($aArray, 0, $iCount);
        foreach ($aOut as $sKey => $sBullet) {
            $aOut[$sKey] = trim($sBullet);
            if (empty($aOut[$sKey])) {
                continue;
            }
            $aOut[$sKey] = substr($sBullet, 0, $iMaxChars);
        }
        return $aOut;
    }

    protected function getImageSize() {
        $sSize = MLModule::gi()->getConfig('imagesize');
        $iSize = $sSize === null ? 500 : (int)$sSize;
        return $iSize;
    }
}
