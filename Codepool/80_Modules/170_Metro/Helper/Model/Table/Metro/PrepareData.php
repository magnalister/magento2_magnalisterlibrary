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

MLFilesystem::gi()->loadClass('Form_Helper_Model_Table_PrepareData_Abstract');

class ML_Metro_Helper_Model_Table_Metro_PrepareData extends ML_Form_Helper_Model_Table_PrepareData_Abstract {

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

    public function masterSkuField(&$aField) {
        if ($this->oProduct->get('parentid') === '0') {
            $aField['value'] = $this->oProduct->getMarketPlaceSku();
        } else {
            $aField['value'] = $this->oProduct->getParent()->getMarketPlaceSku();
        }
    }

    public function quantityField(&$aField) {
        $aField['value'] = $this->oProduct->getSuggestedMarketplaceStock(
            MLModul::gi()->getConfig('quantity.type'),
            MLModul::gi()->getConfig('quantity.value'),
            $this->getField('checkout', 'value') ? MLModul::gi()->getConfig('maxquantity') : null
        );
    }

    public function productPriceField(&$aField) {
        $aField['value'] = $this->oProduct->getSuggestedMarketplacePrice(MLModul::gi()->getPriceObject());
    }

    public function gtinField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getEAN());

        $manufacturerField = $this->getField('Manufacturer');
        $sManufacturer = $this->getFirstValue($manufacturerField, $this->oProduct->getManufacturer());

        $manufacturerPartNumberField = $this->getField('ManufacturerPartNumber');
        $sMPN = $this->getFirstValue($manufacturerPartNumberField, $this->oProduct->getManufacturerPartNumber());

        if ((!isset($aField['value']) || $aField['value'] === '') && (empty($sManufacturer) || empty($sMPN))) {
            $this->aErrors[] = 'ML_METRO_ERROR_MISSING_GTIN_MPN_MANUFACTURER';
        }
    }

    /**
     * This function is needed only for additem, and it has no meaning in preparation
     * @param $aField
     */
    public function categoryIDField(&$aField) {
        $aField['value'] = $this->getField('primarycategory', 'value');
    }

    /**
     * This function is needed only for additem, and it has no meaning in preparation
     * @param $aField
     */
    public function vatField(&$aField) {
        $aField['value'] = $this->oProduct->getTax();
    }

    protected function titleField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getName());

        if (!isset($aField['value']) || $aField['value'] === '') {
            $this->aErrors[] = 'ML_METRO_ERROR_MISSING_TITLE';
        }
    }

    public function manufacturerField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getManufacturer());
    }

    public function manufacturerPartNumberField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getManufacturerPartNumber());
    }

    public function brandField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getManufacturer());
    }

    public function shortDescriptionField(&$aField) {
        $aField['value'] = $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getShortDescription());
    }

    protected function imagesField(&$aField) {
        $aImages = $aProductImages = $this->oProduct->getImages();
        if ($this->oProduct->get('parentid') !== '0') {
            $aImages = array_merge($aProductImages, $this->oProduct->getParent()->getImages());
        }
        foreach ($aImages as $sImage) {
            try {
                $aField['values'][$sImage] = MLImage::gi()->resizeImage($sImage, 'products', 80, 80);
            } catch (Exception $oEx) {
                $this->aErrors[] = 'metro_prepare_images_not_exist';
            }
        }

        if (isset($aField['values'])) {
            reset($aImages);
            $aField['value'] = $this->getFirstValue($aField, array_keys($aField['values']));
            $aField['value'] = empty($aField['value']) ? array_keys($aField['values']) : $aField['value'];
            $aField['value'] = (array)$aField['value'];
        } else {
            $aField['value'] = (array)$this->getFirstValue($aField, $aImages);
        }

        if (!isset($aField['value']) || $aField['value'] === '') {
            $this->aErrors[] = 'ML_METRO_ERROR_MISSING_IMAGES';
        }
        if(!empty($aField['additemmode'])){
            $aAllImages = $aField['value'];
            $aField['value'] = array();
            foreach ($aProductImages as $sImage){
                if(in_array($sImage, $aAllImages, true)){
                    $aField['value'][] = $sImage;
                }
            }

        }
    }

    public function descriptionField(&$aField) {
        $sDescription = $this->getFirstValue($aField, $this->oProduct->getDescription());
        $aField['value'] = sanitizeProductDescription(
            $sDescription,
            '<p><ul><ol><li><span><br><b>)',
            '_keep_all_'
        );

        if (!isset($aField['value']) || $aField['value'] === '') {
            $this->aErrors[] = 'ML_METRO_ERROR_MISSING_DESCRIPTION';
        }
    }

    public function processingTimeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    /**
     * Set Value to be from preparation or pull from configuration
     *
     * @param $aField
     * @return void
     */
    public function maxProcessingTimeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    public function businessModelField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    public function shippingProfileField(&$aField) {
        $aDefaultTemplate = MLModul::gi()->getConfig('shippingprofile');
        $iDefault = 0;
        foreach ($aDefaultTemplate as $iKey => $sValue) {
            if ($sValue['default']) {
                $iDefault = $iKey;
            }
        }
        $aField['value'] = $this->getFirstValue($aField, $iDefault);
    }

    public function shippingCostField(&$aField) {
        $aDefaultTemplate = MLModul::gi()->getConfig('shippingprofile');
        $aTemplateCost = MLModul::gi()->getConfig('shippingprofile.cost');
        $iDefault = 0;
        $iKey = $this->getField('shippingProfile', 'value');
        $aField['value'] = $aTemplateCost[$iKey];
    }

    public function freightForwardingField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    public function shippingGroupField(&$aField) {
        $aDefaultGroup = MLModul::gi()->getConfig('shipping.group');
        $iDefault = 0;
        foreach ($aDefaultGroup as $iKey => $sValue) {
            if ($sValue['default']) {
                $iDefault = $iKey;
            }
        }
        $aField['value'] = $this->getFirstValue($aField, $iDefault);
    }

    public function shippingGroupIdField(&$aField) {
        $aDefaultGroup = MLModul::gi()->getConfig('shipping.group');
        $aGroupId = MLModul::gi()->getConfig('shippingprofile.group.id');
        $iDefault = 0;
        $iKey = $this->getField('shippingGroup', 'value');
        $aField['value'] = $aGroupId[$iKey];
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

    public function manufacturersSuggestedRetailPriceField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        if(isset($aField['value'])) {
            $aField['value'] = str_replace(',', '.', trim($aField['value']));
            if ((string)((float)$aField['value']) != $aField['value']) {
                $this->aErrors[] = 'ML_METRO_ERROR_WRONG_MANUFACTURERSSUGGESTEDRETAILPRICE';
            } else {
                $aField['value'] = number_format($aField['value'], 2);
            }
            if ($aField['value'] <= 0) {
                $aField['value'] = '';
            }
        }
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
            $this->aErrors[] = 'ML_METRO_ERROR_MISSING_CATEGORY';
        }
    }

    protected function primaryCategoryNameField(&$aField) {
        $sCategoryID = $this->getField('variationgroups.value', 'value');
        $oCat = MLDatabase::factory('Metro_CategoriesMarketplace');
        $oCat->init(true)->set('categoryid', $sCategoryID);
        $sCat = '';
        foreach ($oCat->getCategoryPath() as $oParentCat) {
            $sCat = $oParentCat->get('categoryname').' &gt; '.$sCat;
        }
        $aField['value'] = $sCat;
    }

    protected function shopVariationField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, array());
    }

    protected function marketplaceAttributesField(&$aField) {
        $attributesMatchingService = MLHelper::gi('Model_Service_AttributesMatching');
        $aCatAttributes = $attributesMatchingService->mergeConvertedMatchingToNameValue(
            $this->getField('ShopVariation', 'value'),
            $this->oProduct,
            $this->oMasterProduct//If a value is matched only for main variant, this matching will be used for not matched variant in the product as default
        );
        $aKeys = array_keys($aCatAttributes);
        foreach ($aKeys as $sKey){
            $aCatAttributes[pack('H*',$sKey)] =  $aCatAttributes[$sKey];
            unset($aCatAttributes[$sKey]);
        }

        $aField['value'] = $aCatAttributes;
    }

    protected function stringToArray($sString, $iCount, $iMaxChars) {
        // Helper for php8 compatibility - can't pass null to explode 
        $sString = MLHelper::gi('php8compatibility')->checkNull($sString);
        $aArray = explode(',', $sString);
        array_walk($aArray, array($this, 'trim'));
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

    protected function trim(&$v, $k) {
        $v = trim($v);
    }

    protected function getImageSize() {
        $sSize = MLModul::gi()->getConfig('imagesize');
        $iSize = $sSize === null ? 500 : (int)$sSize;
        return $iSize;
    }

    /**
     * used in add-item or update items to send net volume prices to API
     * @param $aField
     * @return void
     */
    protected function volumePricesField(&$aField) {
        $mConfig = MLModule::gi()->getConfig('volumepricesenable');
        if ($mConfig === 'webshop') {
            $aField['value'] = array();
            $sType = strtolower('WebshopPriceOptions'); // naming of field like "VolumepricePriceWebshopOptions" priceObject need "volumepriceprice#placeholder#addkind"
            $priceConfig = MLModule::gi()->getPriceObject($sType)->getPriceConfig();
            $aPrices = $this->oProduct->getVolumePrices(
                MLModule::gi()->getConfig('volumepriceswebshopcustomergroup'),
                false,
                $priceConfig['kind'],
                $priceConfig['factor'],
                $priceConfig['signal']
            );

            $iNumberOfGreaterThan5 = 0;
            foreach ($aPrices as $iStartQuantity => $fPrice) {
                $aField['value'][$iStartQuantity] = round($fPrice, 2);
                if ((int)$iStartQuantity > 5) {
                    $iNumberOfGreaterThan5++;
                }
                if ($iNumberOfGreaterThan5 === 2) {
                    break;
                }
            }
        } elseif ($mConfig === 'useconfig') {
            $aField['value'] = array();
            foreach (array('2', '3', '4', '5') as $sType) {
                $mTypeConfig = MLModule::gi()->getConfig('volumepriceprice'.$sType.'addkind');
                if ($mTypeConfig !== 'dontuse') {
                    $aField['value'][$sType] = round($this->oProduct->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject($sType), false), 2);
                }
            }
            foreach (array('a', 'b') as $sType) {
                try {
                    $mTypeConfig = MLModule::gi()->getConfig('volumepriceprice'.$sType.'addkind');
                    if ($mTypeConfig !== 'dontuse') {
                        $aField['value'][MLModule::gi()->getConfig('volumepriceprice'.$sType.'start')] = round($this->oProduct->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject($sType), false), 2);
                    }
                } catch (\Exception $ex) {
                    MLMessage::gi()->addDebug($ex);
                }
            }
        } elseif ($mConfig === 'dontuse') {
            // need to set it empty array - so it will be removed from metro
            $aField['value'] = array(); // if you don't set it to an empty array it will use data from magnalister database
        }
    }

}
