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

class ML_GoogleShopping_Model_Service_SyncInventory extends ML_Modul_Model_Service_SyncInventory_Abstract {
    /**
     *
     * @param ML_Shop_Model_Product_Abstract $oProduct
     * @param array $aResponse api-response of current product
     * return array() for request eg. array('Quantity' => (int))
     */
    protected function getStock(ML_Shop_Model_Product_Abstract $oProduct, $aMpItem) {
        $sTable = 'magnalister_googleshopping_prepare';

        $iShopQuantity = $oProduct->getStock();

        $sQuery = 'SELECT availability FROM ' . $sTable . ' WHERE offerId = "' . $aMpItem['SKU'] . '"';
        $sAvailability = MLDatabase::getDbInstance()->fetchOne($sQuery);
        if ($sAvailability == 'out of stock') {
            $iShopQuantity = 0;
        }
        if ($sAvailability == 'preorder') {
            $iShopQuantity = 1;
        }

        return array(
            'Quantity' => $iShopQuantity,
            'Availability' => ($iShopQuantity > 0 && $sAvailability != 'preorder') ? 'in stock' : $sAvailability,
        );
    }
}
