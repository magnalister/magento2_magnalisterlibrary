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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_GoogleShopping_Helper_Model_Service_Product {

    /** @var ML_Database_Model_Table_Selection $oSelection */
    protected $oSelection = null;
    protected $aSelectionData = array();

    /** @var ML_GoogleShopping_Model_Table_GoogleShopping_Prepare $oPrepare*/
    protected $oPrepare = null;

    /** @var ML_Shop_Model_Product_Abstract $oProduct*/
    protected $oProduct = null;
    /** @var ML_Shop_Model_Product_Abstract */
    protected $oVariant = null;
    protected $aData = null;

    private $images = array();

    public function __call($sName, $mValue) {
        return $sName.'()';
    }

    public function __construct() {
        $this->oPrepare = MLDatabase::factory('googleshopping_prepare');
        $this->oSelection = MLDatabase::factory('selection');
    }

    public function setProduct(ML_Shop_Model_Product_Abstract $oProduct) {
        $this->oProduct = $oProduct;
        $this->sPrepareType = '';
        $this->aData = null;
        return $this;
    }
    
    public function setVariant(ML_Shop_Model_Product_Abstract $oProduct) {
        $this->oVariant=$oProduct;
        return $this;
    }
    
    public function resetData() {
        $this->aData = null;
        return $this;
    }
    
    public function getData() {
        if ($this->aData === null) {
            $this->oPrepare->init()->set('products_id', $this->oVariant->get('id'));
            $aData = array();
            foreach (
            array(
                'Primarycategory',
                'PrimaryCategoryName',
                'Verified',
                'title',
                'ProductId',
                'PreparedTS',
                'ShippingTemplate',
                'ClientId',
                'ClientSecret',
                'channel',
                'OfferId',
                'brand',
                'condition',
                'Language',
                'currency',
                'link',
                'description',
                'availability',
                'contentLanguage',
                'targetCountry',
                'MasterSKU',
                'itemGroupId',
                'Price',
                'Image',
                'additionalImages',
                'Quantity',
                'CategoryAttributes',
                'Attributes',
                'SKU',
                'EAN',
                'MPN',
                'Brand',
                'Link',
                'CustomAttributes',
                'CategoryAttributes'
            ) as $sField) {
                if (method_exists($this, 'get'.$sField)) {
                    $mValue = $this->{'get'.$sField}();
                    if (is_array($mValue)) {
                        foreach ($mValue as $sKey => $mCurrentValue) {
                            if (empty($mCurrentValue)) {
                                unset($mValue[$sKey]);
                            }
                        }
                        $mValue = empty($mValue) ? null : $mValue;
                    }
                    if ($mValue !== null) {
                        $aData[$sField] = $mValue;
                    }
                } else {
                    MLMessage::gi()->addWarn("function  ML_GoogleShopping_Helper_Model_Service_Product::get".$sField."() doesn't exist");
                }
            }
            $this->aData = $aData;
        }

        return $this->aData;
    }

    /**
     * @return mixed|string
     */
    protected function getCustomAttributes() {
        return '';
    }

    protected function getLink() {
        return $this->oProduct->getFrontendLink();
    }

    protected function getBrand() {
        return $this->oProduct->getManufacturer();
    }

    protected function getSKU() {
        return $this->oVariant->getMarketPlaceSku();
    }

    protected function getEAN() {
        return $this->oProduct->getEAN();
    }

    protected function getMPN() {
        return $this->oProduct->getManufacturerPartNumber();
    }

    protected function getQuantity() {
        return $this->oVariant->getStock();
    }

    protected function getMasterSKU() {
        return $this->oVariant->getMarketPlaceSku();
    }

    protected function getItemGroupId() {
        return $this->oProduct->getMarketPlaceSku();
    }

    protected function getPrice() {
        return $this->oVariant->getShopPrice();
    }

    protected function getBasePrice() {
        return $this->oVariant->getBasePrice();
    }

    private function getOrGenerateImages() {
        if (!empty($this->images)) {
            return $this->images;
        }

        $sSize = MLModule::gi()->getConfig('imagesize');
        $iSize = $sSize == null ? 500 : (int)$sSize;

        $aImagesPrepare = $this->oPrepare->get('Image');

        if (empty($aImagesPrepare) === false) {
            $aImages = $this->oVariant->getImages();
            $aImages = empty($aImages) ? $this->oProduct->getImages() : $aImages;

            foreach ($aImages as $sImage) {
                try {
                    $aImage = MLImage::gi()->resizeImage($sImage, 'products', $iSize, $iSize);
                    $this->images[]['URL'] = $aImage['url'];
                } catch (Exception $ex) {
                    // Happens if image doesn't exist.
                }
            }
        }

        return $this->images;
    }

    protected function getImage() {
        $images = $this->getOrGenerateImages();
        $image = reset($images);
        if (array_key_exists('URL', $image)) {
            $image = $image['URL'];
        }
        return $image;
    }

    protected function getAdditionalImages() {
        $images = $this->getOrGenerateImages();
        unset($images[0]);
        return json_encode(array_values($images));
    }

    protected function getMarketplaceCategories() {
        return array(
            $this->oPrepare->get('PrimaryCategory'),
        );
    }

    protected function getPrimarycategory() {
        return $this->oPrepare->get('Primarycategory');
    }

    protected function getPrimaryCategoryName() {
        return $this->oPrepare->get('primaryCategoryName');
    }

    protected function getAvailability() {
        return $this->oPrepare->get('availability');
    }

    protected function getPreparedTS() {
        return $this->oPrepare->get('PreparedTS');
    }

    protected function getContentLanguage() {
        return MLModule::gi()->getConfig('googleshopping.language');
    }

    protected function getTargetCountry() {
        return MLModule::gi()->getConfig('googleshopping.targetcountry');
    }

    protected function getOfferId() {
        return $this->oPrepare->get('offerId');
    }

    protected function getTitle() {
        return $this->oVariant->getName();
    }

    protected function getDescription() {
        return $this->oVariant->getDescription();
    }

    protected function getCondition() {
        return $this->oPrepare->get('condition');
    }

    protected function getClientId() {
        return $this->oPrepare->get('clientId');
    }

    protected function getClientSecret() {
        return $this->oPrepare->get('clientSecret');
    }

    protected function getLanguage() {
        return MLModule::gi()->getConfig('lang');
    }

    protected function getCurrency() {
        return MLModule::gi()->getConfig('currency');
    }

    protected function getChannel() {
        return 'online';
    }

    protected function getShippingService() {
        return $this->oPrepare->get('ShippingService');
    }

    protected function getVerified() {
        return $this->oPrepare->get('Verified');
    }

    protected function getShippingTemplate() {
        return $this->oPrepare->get('shippingTemplate');
    }

    protected function getProductId() {
        return $this->oPrepare->get('products_id');
    }

    protected function getAttributes() {
        $iCategorie = $this->oPrepare->get('PrimaryCategory');
        if (!empty($iCategorie)) {
            $aCatAttributes = $this->oPrepare->get('Attributes');
            if (isset($aCatAttributes[$iCategorie])) {
                $aAttributes = array();
                foreach ($aCatAttributes[$iCategorie]['specifics'] as $aCatAttribute) {
                    $aAttributes = array_merge($aAttributes, $aCatAttribute);
                }
                return $aAttributes;
            }
        }
        return array();
    }

    protected function getCategoryAttributes() {
        $attributesMatchingService = MLHelper::gi('Model_Service_AttributesMatching');
        $shopVariations = $this->fixMarketplacePredefinedValueKeys($this->oPrepare->get('ShopVariation'));

        $aCatAttributes = $attributesMatchingService->mergeConvertedMatchingToNameValue(
            $shopVariations,
            $this->oVariant,
            $this->oProduct//If a value is matched only for main variant, this matching will be used for not matched variant in the product as default
        );

        $properties['property_values'] = array();
        foreach ($aCatAttributes as $key => $attribute) {
            $properties['property_values'][] = array('property_id' => $key, 'value' => $attribute);
        }

        return $properties;
    }

    private function getCategoryAttributeValue($key, $id, $category) {
        try {
            $aValues = MagnaConnector::gi()->submitRequestCached(array(
                    'ACTION' => 'GetCategoryDetails',
                    'DATA' => [
                        'categoryId' => $category,
                        'targetCountry' => MLModule::gi()->getConfig('targetcountry'),
                        'Language' => MLModule::gi()->getConfig('language')
                    ])
            )['DATA']['attributes'];
        } catch (Exception $e) {
            $aValues = array();
        }

        return empty($aValues) ? '' : $aValues[$key]['values'][$id];
    }

    private function fixMarketplacePredefinedValueKeys($shopVariants) {
        if (!is_array($shopVariants)) {
            return array();
        }

        foreach ($shopVariants as $key => &$variant) {
            if ($variant['Kind'] === 'Matching' && $variant['Code'] === 'attribute_value') {
                $variant['Values'] = $this->getCategoryAttributeValue($key, $variant['Values'], $this->getPrimarycategory());
                continue;
            }
        }

        if (array_key_exists('sizeClothingAndOthers', $shopVariants)) {
            $shopVariants['sizes'] = $shopVariants['sizeClothingAndOthers'];
            unset($shopVariants['sizeClothingAndOthers']);
        }

        return $shopVariants;
    }
}
