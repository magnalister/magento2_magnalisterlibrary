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

class ML_Idealo_Helper_Model_Service_Product {

    /** @var ML_Database_Model_Table_Selection $oSelection */
    protected $oSelection = null;
    protected $aSelectionData = array();

    /** @var ML_Idealo_Model_Table_Idealo_Prepare $oPrepare */
    protected $oPrepare = null;

    /** @var ML_Shop_Model_Product_Abstract $oProduct */
    protected $oProduct = null;
    /** @var ML_Shop_Model_Product_Abstract $oProduct */
    protected $oVariant = null;
    protected $aData = null;

    public function __call($sName, $mValue) {
        return $sName.'()';
    }

    public function __construct() {
        $this->oPrepare = MLDatabase::factory('idealo_prepare');
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
                    'ItemTitle',
                    'Price',
                    'Description',
                    'ItemUrl',
                    'EAN',
                    'Manufacturer',
                    'Image',
                    'ShippingTime',
                    'Quantity',
                    'Weight',
                    'BasePrice'
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
                    MLMessage::gi()->addWarn("function  ML_Idealo_Helper_Model_Service_Product::get".$sField."() doesn't exist");
                }
            }
            $this->aData = $aData;
        }
        return $this->aData;
    }

    public function shippingCountryField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    public function shippingCostField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        if ($aField['value'] == '') {
            $aField['value'] = '0.00';
        }
    }

    protected function getSKU() {
        return $this->oVariant->getMarketPlaceSku();
    }

    protected function getEAN() {
        return $this->oVariant->getModulField('general.ean', true);
    }

    protected function getItemTitle() {
        $sTitle = $this->oPrepare->get('Title');
        if (empty($sTitle)) {
            $sTitle = $this->oVariant->getName();
        }
        return $sTitle;
    }

    protected function getDescription() {
        $sDescription = $this->oPrepare->get('Description');
        if (empty($sDescription)) {
            $sDescription = $this->oVariant->getDescription();
        }
        return $sDescription;
    }

    protected function getManufacturer() {
        return $this->oVariant->getModulField('manufacturer');
    }

    protected function getShippingTime() {
        return $this->oVariant->getModulField('shippingtime');
    }

    protected function getImage() {
        $aOut = array();
        foreach ($this->oVariant->getImages() as $sImage) {
            try {
                $aImage = MLImage::gi()->resizeImage($sImage, 'products', 500, 500);
                $aOut[]['URL'] = $aImage['url'];
            } catch (Exception $ex) {
                // Happens if image doesn't exist.
            }
        }
        return $aOut;
    }

    protected function getQuantity() {
        $iQty = $this->oVariant->getStock();
        return $iQty < 0 ? 0 : $iQty;
    }

    protected function getWeight() {
        return $this->oVariant->getWeight();
    }

    protected function getPrice() {
        return $this->oVariant->getSuggestedMarketplacePrice(MLModul::gi()->getPriceObject());
    }

    protected function getItemUrl() {
        return $this->oVariant->getFrontendLink();
    }

    protected function getBasePrice() {
        return $this->oVariant->getBasePrice();
    }

}
