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

class ML_Ricardo_Model_Service_ImportOrders extends ML_Modul_Model_Service_ImportOrders_Abstract {
    public function canDoOrder(ML_Shop_Model_Order_Abstract $oOrder, &$aOrder) {
        $aOrderData = $oOrder->get('data');
        if (//same address
            isset($aOrderData['AddressId'])
            && isset($aOrder['MPSpecific']['AddressId'])
            && $aOrderData['AddressId'] == $aOrder['MPSpecific']['AddressId']
        ) {
            return 'Extend existing order - same customer address';
        } elseif ($oOrder->get('orders_id') === null) {
            return 'Create order';
        } else {
            throw MLException::factory('Model_Service_ImportOrders_OrderExist')->setShopOrder($oOrder);
        }
    }

    protected function extendPromotionMailPlaceholders(&$placeHolders, $aOrder) {
        if (array_key_exists('MPSpecific', $aOrder)) {
            if (array_key_exists('MOrderID', $aOrder['MPSpecific'])) {
                $placeHolders['#MARKETPLACEORDERID#'] = $aOrder['MPSpecific']['MOrderID'];
            }
            if (array_key_exists('BuyerUsername', $aOrder['MPSpecific'])) {
                $placeHolders['#USERNAME#'] = $aOrder['MPSpecific']['BuyerUsername'];
            }
        }
    }
}
