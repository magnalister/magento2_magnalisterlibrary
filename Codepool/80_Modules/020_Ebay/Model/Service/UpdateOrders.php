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

MLFilesystem::gi()->loadClass('Modul_Model_Service_ImportOrders_Abstract');

class ML_Ebay_Model_Service_UpdateOrders extends ML_Modul_Model_Service_ImportOrders_Abstract {
    protected $sGetOrdersApiAction = 'GetOrdersUpdates';
    protected $sAcknowledgeApiAction = 'AcknowledgeUpdatedOrders';
    protected $blUpdateMode = true;

    public function canDoOrder(ML_Shop_Model_Order_Abstract $oOrder, &$aOrder) {
        if ($oOrder->get('orders_id') !== null) { // only existing orders
            $aUpdateableStatusses = MLModule::gi()->getConfig('updateable.orderstatus');
            $aUpdateableStatusses = is_array($aUpdateableStatusses) ? $aUpdateableStatusses : array();
            if (!in_array($oOrder->getShopOrderStatus(), $aUpdateableStatusses, true)) {
                /**
                 * if orderstatus is not in updateable.orderstatus we don't update the order.
                 */
                $sStatusName = $oOrder->getShopOrderStatusName();
                throw new Exception("Order status cannot be updated because '".$oOrder->getShopOrderStatus().(!empty($sStatusName) ? " - ".$sStatusName : '')."' is not updateable");
            } else {
                return 'Update order';
            }
        } else {
            throw new Exception("Order doesn't exist");
        }
    }

}