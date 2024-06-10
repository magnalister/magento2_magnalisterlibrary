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

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

/**
 *
 * @see View: /Codepool/90_System/Tools/View/Main/Tools/Products/Search.php
 */
class ML_Tools_Controller_Main_Tools_Products_Search extends ML_Core_Controller_Abstract {

    protected $aParameters = array('controller');
    protected $aMessages = array();

    public function __construct() {
        parent::__construct();
        //        $iRequestMp = $this->getRequestedMpid();
        //        if($iRequestMp != null) {
        //            ML::gi()->init(array('mp' => $iRequestMp));
        //            if (!MLModule::gi()->isConfigured()) {
        //                throw new Exception('module is not configured');
        //            }
        //        }
    }

    protected function getRequestedSku() {
        return $this->getRequest('sku');
    }

    protected function getRequestedMpid() {
        return $this->getRequest('mpid');
    }

    protected function getProduct($blMaster) {
        $sSku = $this->getRequestedSku();
        if (!empty($sSku)) {
            return MLProduct::factory()->getByMarketplaceSKU($sSku, $blMaster);
        }
    }

    protected function getPriceType() {
        $sType = $this->getRequest('pricetype');
        return $sType !== '' ? $sType : null;
    }

    protected function getMasterProductFieldAndMethods(ML_Shop_Model_Product_Abstract $oProduct) {
        $return = array(
            'Sku' => $oProduct->getSku(),
            'Name' => $oProduct->getName(),
            'Description' => htmlentities($oProduct->getDescription()),
            'Stock' => $oProduct->getStock(),
            'Shop Price' => $oProduct->getShopPrice(),
            'EAN' => $oProduct->getEAN(),
            'Tax' => $oProduct->getTax(),
            'Manufacturer' => $oProduct->getManufacturer(),
            'Manufacturer Part Number' => $oProduct->getManufacturerPartNumber(),
            'Images' => $oProduct->getImages(),
            'isSingle' => $oProduct->isSingle(),
            'VariantCount' => $oProduct->getVariantCount(),
            'isActive' => $oProduct->isActive(),
            'Variation Data' => $oProduct->getVariatonDataOptinalField(array('code', 'valueid', 'name', 'value')),
            'Frontend Link' => $oProduct->getFrontendLink(),
            'Category Path' => $oProduct->getCategoryPath(),
            'Category Ids' => $oProduct->getCategoryIds(),
            'Category Structure' => $oProduct->getCategoryStructure(),
            'EditLink' => $oProduct->getEditLink(),
            'ImageUrl' => $oProduct->getImageUrl(),
            'Meta Description' => $oProduct->getMetaDescription(),
            'Meta Keywords' => $oProduct->getMetaKeywords(),
            'Weight' => $oProduct->getWeight(),
        );
        if (MLRequest::gi()->data('attributeCode') !== null) {
            $return['AttributeValue("' . MLRequest::gi()->data('attributeCode') . '")'] = $oProduct->getAttributeValue(MLRequest::gi()->data('attributeCode'));
        }
        return $return;
    }


    public function getVariantProductFieldAndMethods(ML_Shop_Model_Product_Abstract $oProduct) {
        $sCountryCode = $this->getRequest('countrycode');
        $return = array(

            'SKU' => $oProduct->getSku(),
            'Name' => $oProduct->getName(),
            'Description' => !is_string($oProduct->getDescription()) ? $oProduct->getDescription() : htmlentities($oProduct->getDescription()),
            'Stock' => $oProduct->getStock(),
            'Marketplace Stock' => '(not set)',
            'Shop Price' => $oProduct->getShopPrice(),
            'Marketplace Price' => '(not set)',
            'Marketplace Price(net)' => '(not set)',
            'Tax(' . $sCountryCode . ')' => '(not set)',
            'Volume Prices' => '(not set)',
            'Base Price' => $oProduct->getBasePrice(),
            'Base Price String' => '(not set)',
            'EAN' => '(not set)',
            'Manufacturer' => '(not set)',
            'Manufacturer Part Number' => '(not set)',
            'Images' => $oProduct->getImages(),
            'Tax' => $oProduct->getTax(),
            'isActive' => $oProduct->isActive(),
            'Variation Data' => $oProduct->getVariatonDataOptinalField(array('code', 'valueid', 'name', 'value')),
            'Frontend Link' => $oProduct->getFrontendLink(),
            'Category Path' => $oProduct->getCategoryPath(),
            'Category Ids' => $oProduct->getCategoryIds(),
            'Category Structure' => $oProduct->getCategoryStructure(),
            'EditLink' => $oProduct->getEditLink(),
            'Image Url' => $oProduct->getImageUrl(),
            'Meta Description' => $oProduct->getMetaDescription(),
            'Meta Keywords' => $oProduct->getMetaKeywords(),
            'Weight' => $oProduct->getWeight(),
        );
        if (MLRequest::gi()->data('attributeCode') !== null) {
            $return['AttributeValue("' . MLRequest::gi()->data('attributeCode') . '")'] = $oProduct->getAttributeValue(MLRequest::gi()->data('attributeCode'));
        }
        return $return;
    }

    public function getVariantProductModuleDependentFieldAndMethods(ML_Shop_Model_Product_Abstract $oProduct, array $aDataToSendToMarketplace) {
        try {
            $aStockConf = MLModule::gi()->getStockConfig($this->getRequest('pricetype'));
            $aDataToSendToMarketplace['Marketplace Stock'] = $oProduct->getSuggestedMarketplaceStock($aStockConf['type'], $aStockConf['value'], isset($aStockConf['max']) ? $aStockConf['max'] : null);
            $aDataToSendToMarketplace['Marketplace Price'] = $oProduct->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject($this->getRequest('pricetype')), true, true);
            $aDataToSendToMarketplace['Marketplace Price(net)'] = $oProduct->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject($this->getRequest('pricetype')), false, true);
            $sShopGroupId = $this->getVolumePriceCustomerGroup($this);
            $aDataToSendToMarketplace['Volume Prices'] = array(
                'Gross' => $oProduct->getVolumePrices($sShopGroupId),
                'Net'   => $oProduct->getVolumePrices($sShopGroupId, false),
            );
            $aDataToSendToMarketplace['EAN'] = $oProduct->getEAN();
            $aDataToSendToMarketplace['Manufacturer'] = $oProduct->getManufacturer();
            $aDataToSendToMarketplace['Manufacturer Part Number'] = $oProduct->getManufacturerPartNumber();
            $sCountryCode = $this->getRequest('countrycode');
            $aDataToSendToMarketplace['Tax(' . $sCountryCode . ')'] = $oProduct->getTax(empty($sCountryCode) ? null : array('Shipping' => array('CountryCode' => $sCountryCode)));
            $fPrice = $oProduct->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject());
            $aDataToSendToMarketplace['Base Price String'] = $oProduct->getBasePriceString($fPrice);
        } catch (\Exception $ex) {
            $this->aMessages[] = $ex;
            $aDataToSendToMarketplace['MarketplacePrice(20)'] = 20;
            $aDataToSendToMarketplace['Base Price String(20)'] = $oProduct->getBasePriceString(20);
        }
        return $aDataToSendToMarketplace;
    }

    public function getMasterProductModuleDependentFieldAndMethods(ML_Shop_Model_Product_Abstract $oProduct, array $aDataToSendToMarketplace) {
        try {
            $aDataToSendToMarketplace['EAN'] = $oProduct->getEAN();
            $aDataToSendToMarketplace['Manufacturer'] = $oProduct->getManufacturer();
            $aDataToSendToMarketplace['Manufacturer Part Number'] = $oProduct->getManufacturerPartNumber();
            $sCountryCode = $this->getRequest('countrycode');
            $aDataToSendToMarketplace['Tax(' . $sCountryCode . ')'] = $oProduct->getTax(empty($sCountryCode) ? null : array('Shipping' => array('CountryCode' => $sCountryCode)));
        } catch (\Exception $ex) {
            $this->aMessages[] = $ex;
        }
        return $aDataToSendToMarketplace;
    }

    public function getVolumePriceCustomerGroup() {
        $sShopGroupId = MLModule::gi()->getConfig('volumepriceswebshopcustomergroup');
        if ($sShopGroupId === null) {
            $sShopGroupId = MLModule::gi()->getPriceObject($this->getPriceType())->getPriceConfig()['group'];
        }
        return $sShopGroupId;
    }

}
