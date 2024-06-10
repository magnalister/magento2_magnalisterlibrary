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

MLFilesystem::gi()->loadClass('Productlist_Controller_Widget_ProductList_UploadAbstract');

class ML_Amazon_Controller_Amazon_Checkin extends ML_Productlist_Controller_Widget_ProductList_UploadAbstract {

    public function getPrice(ML_Shop_Model_Product_Abstract $oProduct) {
        return $oProduct->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject(), true, false);
    }

    public function getStock(ML_Shop_Model_Product_Abstract $oProduct) {
        $aStockConf = MLModule::gi()->getStockConfig();
        return $oProduct->getSuggestedMarketplaceStock($aStockConf['type'], $aStockConf['value'], $aStockConf['max']);
    }

    /**
     * only prepared can be selected
     * @param ML_Database_Model_Table_Abstract $mProduct
     * @return int
     */
    public function getVariantCount($mProduct) {
        $sMpName = MLModule::gi()->getMarketPlaceName();
        return MLDatabase::factory($sMpName.'_prepare')->getVariantCount($mProduct);
    }
}
