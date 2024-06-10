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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Hood_Controller_Widget_ProductList_Hood_Abstract');

class ML_Hood_Controller_Hood_Checkin extends ML_Hood_Controller_Widget_ProductList_Hood_Abstract {

    protected $aParameters = array('controller');


    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_GENERIC_CHECKIN');
    }

    public static function getTabActive() {
        return MLModul::gi()->isConfigured();
    }

    public function getProductListWidget() {
        if ($this->isCurrentController()) {
            return parent::getProductListWidget();
        } else {
            return $this->getChildController('summary')->render();
        }
    }

    protected function callAjaxDontShowWarning() {
        MLModul::gi()->setConfig('checkin.dontshowwarning', 1, true);
        MLSetting::gi()->add(
            'aAjax', array(
                'success' => true,
                'error' => '',
            )
        );
        return true;

    }

    /**
     * only prepared can be selected
     * @param ML_Database_Model_Table_Abstract $mProduct
     * @return type
     */
    public function getVariantCount($mProduct) {
        return MLDatabase::factory('hood_prepare')->getVariantCount($mProduct);
    }

    protected $aPrepare = array();
    protected $aSelected = array();

    public function getPriceObject(ML_Shop_Model_Product_Abstract $oProduct) {
        $oPrepare = $this->getPrepareData($oProduct);
        return MLModul::gi()->getPriceObject($oPrepare->get('ListingType'));
    }

    public function getPrepareData(ML_Shop_Model_Product_Abstract $oProduct) {
        if (!isset($this->aPrepare[$oProduct->get('id')])) {
            $this->aPrepare[$oProduct->get('id')] = MLDatabase::factory('hood_prepare')->set('products_id', $oProduct->get('id'));
        }
        return $this->aPrepare[$oProduct->get('id')];
    }

    public function getPrice(ML_Shop_Model_Product_Abstract $oProduct) {
        $oPrepare = $this->getPrepareData($oProduct);
        if ($oPrepare->get('price') !== null) {
            return $oPrepare->get('price');
        } else {
            return $oProduct->getSuggestedMarketplacePrice(MLModul::gi()->getPriceObject($oPrepare->get('ListingType')), true, false);
        }
    }

    public function getStock(ML_Shop_Model_Product_Abstract $oProduct) {
        $oPreparedProduct = $oProduct;
        if ($oPreparedProduct->get('parentid') == 0) {
            $oPreparedProduct = $this->getFirstVariant($oPreparedProduct);
        }
        $oPrepare = $this->getPrepareData($oPreparedProduct);
        $aStockConf = MLModul::gi()->getStockConfig($oPrepare->get('ListingType'));
        return $oProduct->getSuggestedMarketplaceStock($aStockConf['type'], $aStockConf['value'], $aStockConf['max']);
    }
}
