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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Check24_Helper_Model_Service_Product {

    /** @var ML_Database_Model_Table_Selection $oSelection     */
    protected $oSelection = null;
    protected $aSelectionData = array();

    /** @var ML_Check24_Model_Table_Check24_Prepare $oPrepare     */
    protected $oPrepare = null;

    /** @var ML_Shop_Model_Product_Abstract $oProduct     */
    protected $oProduct = null;
    /**
     * @var ML_Shop_Model_Product_Abstract
     */
    protected $oVariant = null;
    protected $aData = null;

    public function __call($sName, $mValue) {
        return $sName . '()';
    }

    public function __construct() {
        $this->oPrepare = MLDatabase::factory('check24_prepare');
        $this->oSelection = MLDatabase::factory('selection');
    }

    public function setProduct(ML_Shop_Model_Product_Abstract $oProduct) {
        $this->oProduct = $oProduct;
        $this->sPrepareType = '';
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
                'Title',
                'Description',
                'Manufacturer',
                'ManufacturerPartNumber',
                'EAN',
                'Images',
                'ProductUrl',
                'Quantity',
                'Price',
                'BasePrice',
                'ShippingTime',
                'ShippingCost',
                'Weight',
                'CategoryPath',
                'DeliveryMode',
                '2MenHandling',
                'InstallationService',
                'RemovalOldItem',
                'RemovalPackaging',
                'AvailableServiceProductIds',
                'LogisticsProvider',
                'CustomTariffsNumber',
                'ReturnShippingCosts',
            ) as $sField) {
                if (method_exists($this, 'get' . $sField)) {
                    $mValue = $this->{'get' . $sField}();
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
                    MLMessage::gi()->addWarn("function  ML_Check24_Helper_Model_Service_Product::get" . $sField . "() doesn't exist");
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

    protected function getTitle() {
        $iLangId = MLModule::gi()->getConfig('lang');
        $this->oVariant->setLang($iLangId);

        return $this->oVariant->getName();
    }

    protected function getDescription() {
        $iLangId = MLModule::gi()->getConfig('lang');
        $this->oVariant->setLang($iLangId);

        return $this->getSanitizedProductDescription($this->oVariant->getDescription());
    }

    protected function getManufacturer() {
        return $this->oVariant->getManufacturer();
    }

    protected function getManufacturerPartNumber() {
        return $this->oVariant->getManufacturerPartNumber();
    }

    protected function getEAN() {
        return $this->oVariant->getEAN();
    }

    protected function getImages() {
        $sSize = MLModule::gi()->getConfig('imagesize');
        $iSize = $sSize === null ? 500 : (int)$sSize;

        $aOut = array();
        foreach ($this->oVariant->getImages() as $sImage) {
            try {
                $aImage = MLImage::gi()->resizeImage($sImage, 'products', $iSize, $iSize);
                $aOut[]['URL'] = $aImage['url'];
            } catch (Exception $ex) {
                // Happens if image doesn't exist.
            }
        }
        return $aOut;
    }

    protected function getProductUrl() {
        return $this->oVariant->getFrontendLink();
    }

    protected function getQuantity() {
        $iQty = $this->oVariant->getSuggestedMarketplaceStock(
            MLModule::gi()->getConfig('quantity.type'), MLModule::gi()->getConfig('quantity.value')
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

    protected function getShippingTime() {
        return $this->oPrepare->get('ShippingTime');
    }

    protected function getShippingCost() {
        return $this->oPrepare->get('ShippingCost');
    }

    protected function getDeliveryMode() {
        $sDeliveryMode = $this->oPrepare->get('DeliveryMode');
        if ($sDeliveryMode == 'EigeneAngaben') {
            return $this->oPrepare->get('DeliveryModeText');
        }
        return $sDeliveryMode;
    }

    protected function get2MenHandling() {
        return $this->oPrepare->get('Two_men_handling');
    }

    protected function getInstallationService() {
        return $this->oPrepare->get('Installation_service');
    }

    protected function getRemovalOldItem() {
        return $this->oPrepare->get('Removal_old_item');
    }

    protected function getRemovalPackaging() {
        return $this->oPrepare->get('Removal_Packaging');
    }

    protected function getAvailableServiceProductIds() {
        return $this->oPrepare->get('Available_Service_Product_Ids');
    }

    protected function getLogisticsProvider() {
        return $this->oPrepare->get('Logistics_Provider');
    }

    protected function getCustomTariffsNumber() {
        return $this->oPrepare->get('Custom_Tariffs_Number');
    }

    protected function getReturnShippingCosts() {
        return $this->oPrepare->get('Return_Shipping_Costs');
    }

    protected function getWeight() {
        return $this->oVariant->getWeight();
    }

    protected function getCategoryPath() {
        // function returns html in some of Codepool/70_Shop/<ShopSytem>/Model/Product.php
        // This is not suitable for Check24
        return str_replace(array('&nbsp;&gt;&nbsp;', '<br>'), array(' > ', ''), $this->oVariant->getCategoryPath());
    }

    /**
     * Sanitizes description and preparing it for Check24 because Check24 doesn't allow html tags.
     *
     * @param string $sDescription
     * @return string $sDescription
     *
     */
    private function getSanitizedProductDescription($sDescription)
    {
        if (empty($sDescription)) {
            return '';
        }

        $sDescription = preg_replace("#(<\\?div>|<\\?li>|<\\?p>|<\\?h1>|<\\?h2>|<\\?h3>|<\\?h4>|<\\?h5>|<\\?blockquote>)([^\n])#i", "$1\n$2", $sDescription);
        // Replace <br> tags with new lines
        $sDescription = preg_replace('/<[h|b]r[^>]*>/i', "\n", $sDescription);
        $sDescription = trim(strip_tags($sDescription));
        // Normalize space
        $sDescription = str_replace("\r", "\n", $sDescription);
        $sDescription = preg_replace("/\n{3,}/", "\n\n", $sDescription);

        return $sDescription;
    }

}
