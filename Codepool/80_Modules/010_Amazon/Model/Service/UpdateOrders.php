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

MLFilesystem::gi()->loadClass('Modul_Model_Service_ImportOrders_Abstract');

class ML_Amazon_Model_Service_UpdateOrders extends ML_Modul_Model_Service_ImportOrders_Abstract {
    protected $sGetOrdersApiAction = 'GetOrdersUpdates';
    protected $sAcknowledgeApiAction = 'AcknowledgeUpdatedOrders';
    protected $blUpdateMode = true;

    protected $aWasUpdated = array();

    /**
     * Transfer if the order was updated in shop or skipped - true = updates; false = not updated
     *
     * @param $aRequest
     * @return mixed
     */
    protected function manipulateRequest($aRequest) {
        if (isset($aRequest['DATA'])) {//By importing order created in test order tool it could be empty
            foreach ($aRequest['DATA'] as &$aData) {
                $aData['Updated'] = in_array($aData['ShopOrderID'], $this->aWasUpdated);
            }
        }
        return $aRequest;
    }

    public function canDoOrder(ML_Shop_Model_Order_Abstract $oOrder, &$aOrder) {
        $aOldOrderData = $oOrder->get('orderdata');
        if (array_key_exists('AddressSets', $aOldOrderData)) {
            $bDoUpdate = false;
            foreach ($aOldOrderData['AddressSets'] as $aAddressSet) {
                if (empty($aAddressSet['Firstname']) && empty($aAddressSet['Lastname'])) {
                    $bDoUpdate = true;
                    break;
                }
            }

            if (!$bDoUpdate) {
                throw MLException::factory('Model_Service_ImportOrders_OrderExist')->setShopOrder($oOrder);
            }
        }

        if ($oOrder->get('orders_id') !== null) { // only existing orders
            $this->aWasUpdated[] = $oOrder->get('orders_id');
            return 'Update order';
        } else {
            throw new Exception("Order doesn't exist");
        }
    }

}