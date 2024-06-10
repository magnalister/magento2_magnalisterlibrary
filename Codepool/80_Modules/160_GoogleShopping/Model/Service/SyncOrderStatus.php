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

class ML_GoogleShopping_Model_Service_SyncOrderStatus extends ML_Modul_Model_Service_SyncOrderStatus_Abstract {
    public function execute() {
        $oModule = MLModule::gi();
        $sCancelState = $oModule->getConfig('orderstatus.canceled');
        $sShippedState = $oModule->getConfig('orderstatus.shipped');

        if ($oModule->getConfig('orderstatus.sync') == 'auto') {
            $oOrder = MLOrder::factory()->setKeys(array_keys(array('special' => $this->sOrderIdentifier)));
            $iOffset = 0;//(int)MLModule::gi()->getConfig('orderstatussyncoffset');
            $iTotal = $oOrder->getOutOfSyncOrdersArray(0, true);
            if ($iOffset > $iTotal) {
                $iOffset = 0;
                MLModule::gi()->setConfig('orderstatussyncoffset', $iOffset);
            }
            $this->showStatistics($iTotal, $iOffset);
            $aChanged = $oOrder->getOutOfSyncOrdersArray($iOffset);
            $oList = $oOrder->getList();
            $oList->getQueryObject()->where("current_orders_id IN ('".implode("', '", $aChanged)."')");

            $aCanceledRequest = array();
            $aCanceledModels = array();
            $aShippedRequest = array();
            $aShippedModels = array();

            foreach ($oList->getList() as $oOrder) {
                $sShopStatus = $oOrder->getShopOrderStatus();
                if ($sShopStatus != $oOrder->get('status')) {
                    $aData = $oOrder->get('data');
                    $sOrderId = $aData[$this->sOrderIdentifier];
                    // skip (and / or) modify order
                    if ($this->skipAOModifyOrderProcessing($oOrder)) {
                        continue;
                    }

                    switch ($sShopStatus) {
                        case $sCancelState: {
                            $aCanceledRequest[$sOrderId] = array(
                                $this->sOrderIdentifier => $sOrderId,
                                'Reason' => $oModule->getConfig('orderstatus.cancelreason'),
                            );
                            $aCanceledModels[$sOrderId] = $oOrder;
                            break;
                        }
                        case $sShippedState: {
                            $sCarrier = $oModule->getConfig('orderstatus.carrier');
                            $aShippedRequest[$sOrderId] = array(
                                $this->sOrderIdentifier => $sOrderId,
                                'ShippingDate' => $oOrder->getShippingDateTime(),
                                'CarrierCode' => $sCarrier,
                                'TrackingCode' => $oOrder->getShippingTrackingCode()
                            );
                            $aShippedModels[$sOrderId] = $oOrder;
                            $oOrder->set('status', $oOrder->getShopOrderStatus());
                            $oOrder->save();
                            break;
                        }
                        default: {
                            // In this case update order status in magnalister tables
                            $oOrder->set('status', $oOrder->getShopOrderStatus());
                            $oOrder->save();
                            break;
                        }
                    }
                }

                $oOrder->set('order_status_sync_last_check_date', 'NOW()'); // update date when last check happened
                $oOrder->save();
            }

            $this->submitRequestAndProcessResult('ConfirmShipment', $aShippedRequest, $aShippedModels);
            $this->submitRequestAndProcessResult('CancelShipment', $aCanceledRequest, $aCanceledModels);
        }
    }

    /**
     * @param $aError
     * @param $aModels
     */
    protected function postProcessError($aError, &$aModels) {
        $sMarketplaceOrderId = null;
        if (isset($aError['DETAILS']) && isset($aError['DETAILS'][$this->sOrderIdentifier])) {
            $sMarketplaceOrderId = $aError['DETAILS'][$this->sOrderIdentifier];
        }
        if (empty($sMarketplaceOrderId)) {
            return;
        }

        if (isset($aError['DETAILS']['ErrorCode'])
               && in_array($aError['DETAILS']['ErrorCode'], array(
                '1497954205', // 1497954205: The following tracking_number is not valid
            ))
               && array_key_exists($sMarketplaceOrderId, $aModels) // could be already processed, because hitmeister returns error for each article not only for order
        ) {
            $this->saveOrderData($aModels[$sMarketplaceOrderId]);
            unset($aModels[$sMarketplaceOrderId]);
        }
    }
}
