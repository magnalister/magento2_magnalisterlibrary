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

class ML_Etsy_Helper_Model_Service_Product {

    /** @var ML_Database_Model_Table_Selection $oSelection */
    protected $oSelection = null;
    protected $aSelectionData = array();

    /** @var ML_Etsy_Model_Table_Etsy_Prepare $oPrepare */
    protected $oPrepare = null;

    /** @var ML_Shop_Model_Product_Abstract $oProduct */
    protected $oProduct = null;
    /** @var ML_Shop_Model_Product_Abstract */
    protected $oVariant = null;
    protected $aData = null;

    public function __call($sName, $mValue) {
        return $sName.'()';
    }

    public function __construct() {
        $this->oPrepare = MLDatabase::factory('etsy_prepare');
        $this->oSelection = MLDatabase::factory('selection');
    }

    public function setProduct(ML_Shop_Model_Product_Abstract $oProduct) {
        $this->oProduct = $oProduct;
        $this->aData = null;
        return $this;
    }

    public function setVariant(ML_Shop_Model_Product_Abstract $oProduct) {
        $this->oVariant = $oProduct;
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
                    'SKU',
                    'MasterSKU',
                    'Images',
                    'Quantity',
                    'Price',
                    'Attributes',
                    'Whomade',
                    'Whenmade',
                    'IsSupply',
                    'Language',
                    'Currency',
                    'ShippingProfile',
                    'Primarycategory',
                    'Description',
                    'Title',
                    'ProductId',
                    'CategoryAttributes',
                    'MasterTitle',
                    'MasterDescription',
                ) as $sField) {

                if (method_exists($this, 'get'.$sField)) {
                    $mValue = $this->{'get'.$sField}();
                    if (is_array($mValue)) {
                        foreach ($mValue as $sKey => $mCurrentValue) {
                            if (empty($mCurrentValue)) {
                                unset ($mValue[$sKey]);
                            }
                        }
                        $mValue = empty($mValue) ? null : $mValue;
                    }
                    if ($mValue !== null) {
                        $aData[$sField] = $mValue;
                    }
                } else {
                    MLMessage::gi()->addWarn("function  ML_Etsy_Helper_Model_Service_Product::get".$sField."() doesn't exist");
                }
            }
            if (empty($aData['BasePrice'])) {
                unset($aData['BasePrice']);
            }
            $this->aData = $aData;
        }
        return $this->aData;
    }

    protected function getSKU() {
        return $this->oVariant->getMarketPlaceSku();
    }

    protected function getMasterSKU() {
        if ($this->oProduct->getVariantCount() === 1) {
            return $this->oVariant->getMarketPlaceSku();
        }
        return $this->oProduct->getMarketPlaceSku();
    }

    protected function getImageSize() {
        $sSize = MLModule::gi()->getConfig('imagesize');
        $iSize = $sSize == null ? 500 : (int)$sSize;
        return $iSize;
    }

    protected function getImages() {
        $aImagesPrepare = $this->oPrepare->get('Image');
        $iSize = $this->getImageSize();
        $aOut = array();
        $aImages = $this->oVariant->getImages();
        $aImages = empty($aImages) ? $this->oProduct->getImages() : $aImages;
        if (!empty($aImagesPrepare)) {
            foreach ($aImages as $sImage) {
                if (in_array($sImage, $aImagesPrepare)) {
                    try {
                        $aImage = MLImage::gi()->resizeImage($sImage, 'products', $iSize, $iSize);
                        $aOut[]['URL'] = $aImage['url'];
                    } catch (Exception $ex) {
                        MLMessage::gi()->addDebug($ex);
                    }
                }
            }
        } else {
            foreach ($aImages as $sImage) {
                try {
                    $aImage = MLImage::gi()->resizeImage($sImage, 'products', $iSize, $iSize);
                    $aOut[]['URL'] = $aImage['url'];
                } catch (Exception $ex) {
                    MLMessage::gi()->addDebug($ex);
                }
            }
        }

        return $aOut;
    }

    protected function getQuantity() {
        $aStockConf = MLModule::gi()->getStockConfig();
        $iQty = $this->oVariant->getSuggestedMarketplaceStock(
            $aStockConf['type'], $aStockConf['value'],(int)$aStockConf['max'] > 0 ?$aStockConf['max']:null
        );
        return $iQty < 0 ? 0 : $iQty;
    }

    protected function getPrice() {
        if (isset($this->aSelectionData['price'])) {
            return $this->aSelectionData['price'];
        } else {
            return $this->oVariant->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject());
        }
    }

    protected function getBasePrice() {
        return $this->oVariant->getBasePrice();
    }

    protected function getMarketplaceCategories() {
        return array(
            $this->oPrepare->get('PrimaryCategory'),
        );
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

    protected function getWhenmade() {
        return $this->oPrepare->get('Whenmade');
    }

    protected function getWhomade() {
        return $this->oPrepare->get('Whomade');
    }

    protected function getIsSupply() {
        return $this->oPrepare->get('IsSupply');
    }

    protected function getLanguage() {
        return MLModule::gi()->getConfig('shop.language');
    }

    protected function getCurrency() {
        return MLModule::gi()->getConfig('currency');
    }

    protected function getShippingProfile() {
        return $this->oPrepare->get('ShippingProfile');
    }

    protected function getVerified() {
        return $this->oPrepare->get('Verified');
    }

    protected function getPrimarycategory() {
        return $this->oPrepare->get('Primarycategory');
    }

    protected function getTitle() {
        $sTitle = $this->oPrepare->get('Title');
        return (!empty($sTitle) ? $sTitle : $this->oVariant->getName());
    }

    protected function getDescription() {
        $sDescription = $this->oPrepare->get('Description');


        if (!empty($sDescription)) {
            return $sDescription;
        } else {
            /** @var $oStringHelper ML_Modul_Helper_String */
            $oStringHelper = MLHelper::gi('String');
            $sDescription = $this->oVariant->getDescription();
            return $oStringHelper->removeHtml($sDescription);
        }
    }

    protected function getMasterTitle() {
        $sTitle = $this->oPrepare->get('Title');
        $oProduct = $this->oVariant;
        if ((int)($oProduct->get('parentid')) > 0) {
            $oProduct = $oProduct->getParent();
        }
        return (!empty($sTitle) ? $sTitle : $oProduct->getName());
    }

    protected function getMasterDescription() {
        return $this->getDescription();
    }

    protected function getProductId() {
        return $this->oPrepare->get('products_id');
    }

    protected function getPreparedTS() {
        return $this->oPrepare->get('PreparedTS');
    }

    protected function getCategoryAttributes() {

        /* @var $attributesMatchingService ML_Modul_Helper_Model_Service_AttributesMatching */
        $attributesMatchingService = MLHelper::gi('Model_Service_AttributesMatching');

        $aCatAttributes = $attributesMatchingService->mergeConvertedMatchingToNameValue(
            $this->oPrepare->get('ShopVariation'),
            $this->oVariant,
            $this->oProduct//If a value is matched only for main variant, this matching will be used for not matched variant in the product as default
        );
        if (empty($aCatAttributes)) {
            return array();
        } else {
            //        MLMessage::gi()->addDebug(__LINE__.':'.microtime(true), array($aCatAttributes));
            return array("property_values" => $aCatAttributes);
        }

    }

    /**
     * it is used only in Shopify to fix some old data structure
     * @param $shopVariants
     * @return array
     */
    protected function manipulateShopVariationData($shopVariants) {
        return $shopVariants;
    }
}
