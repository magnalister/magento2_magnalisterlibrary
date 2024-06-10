<?php

class ML_Check24_Model_Service_ImportOrders extends ML_Modul_Model_Service_ImportOrders_Abstract {
    public function canDoOrder(ML_Shop_Model_Order_Abstract $oOrder, &$aOrder) {
        $aOrderData = $oOrder->get('data');
        if(//same address
            isset($aOrderData['AddressId'])
            && isset($aOrder['MPSpecific']['AddressId'])
            && $aOrderData['AddressId'] == $aOrder['MPSpecific']['AddressId']
        ) {
            return 'Extend existing order - same customer address';
        } elseif($oOrder->get('orders_id') === null) {
            return 'Create order';
        } else {
//             throw new Exception('Order aleready exists');
            throw MLException::factory('Model_Service_ImportOrders_OrderExist')->setShopOrder($oOrder);
        }
    }
}