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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Hitmeister_Model_Service_SyncOrderStatus extends ML_Modul_Model_Service_SyncOrderStatus_Abstract {

    public function execute() {
        $oModule = MLModule::gi();
        $sCancelState = $oModule->getConfig('orderstatus.cancelled');
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
                try {
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
                                $sCarrier = $this->getCarrier($oOrder);
                                $aShippedRequest[$sOrderId] = array(
                                    $this->sOrderIdentifier => $sOrderId,
                                    'ShippingDate' => $oOrder->getShippingDateTime(),
                                    'CarrierCode' => $sCarrier,
                                    'TrackingCode' => $oOrder->getShippingTrackingCode()
                                );
                                $aShippedModels[$sOrderId] = $oOrder;
                                break;
                            }
                            default: {
                                // In this case update order status in magnalister tables
                                $oOrder->set('status', $sShopStatus); // use the same order status as request beginning because during process it could change
                                $oOrder->save();
                                break;
                            }
                        }
                    }
                } catch (Exception $oExc) {
                    MLLog::gi()->add('SyncOrderStatus_'.MLModule::gi()->getMarketPlaceId().'_Exception', array(
                        'Exception' => array(
                            'Message' => $oExc->getMessage(),
                            'Code' => $oExc->getCode(),
                            'Backtrace' => $oExc->getTrace(),
                        )
                    ));
                }

                $oOrder->set('order_status_sync_last_check_date', 'NOW()'); // update date when last check happened
                $oOrder->save();
            }
            //echo print_m($aShippedRequest, '$aShippedRequest')."\n";
            //echo print_m($aCanceledRequest, '$aCanceledRequest')."\n";
            $this->submitRequestAndProcessResult('ConfirmShipment', $aShippedRequest, $aShippedModels);
            $this->submitRequestAndProcessResult('CancelShipment', $aCanceledRequest, $aCanceledModels);
        }
    }

    protected function postProcessError($aError, &$aModels) {
        $sMarketplaceOrderId = null;
        if (isset($aError['DETAILS']) && isset($aError['DETAILS'][$this->sOrderIdentifier])) {
            $sMarketplaceOrderId = $aError['DETAILS'][$this->sOrderIdentifier];
        }
        if (empty($sMarketplaceOrderId) || !array_key_exists($sMarketplaceOrderId, $aModels)) {
            return;
        }
        $sErrorCode = null;
        if(isset($aError['DETAILS']['ErrorCode'])) {
            $sErrorCode = $aError['DETAILS']['ErrorCode'];
        } else if(isset($aError['ERRORCODE'])) {
            $sErrorCode = $aError['ERRORCODE'];
        }
        if (in_array($sErrorCode, array(
            '1497954205', // 1497954205: The following tracking_number is not valid
            '1382002841', // 1382002841: Unit is already in status cancelled
        ))
        ) {
            $this->saveOrderData($aModels[$sMarketplaceOrderId]);
            unset($aModels[$sMarketplaceOrderId]);
        }
    }

    protected function getCarrier($oOrder)
    {
        $sCarrier = $oOrder->getShippingCarrier();
        $sConfigCarrier = MLModule::gi()->getConfig('orderstatus.carrier');

        //order attribute freetext field(only in Shopware 5)
        if (is_string($sConfigCarrier) && strpos($sConfigCarrier, 'a_') === 0) {
            return $oOrder->getAttributeValue($sConfigCarrier);
        } elseif (
            $sConfigCarrier == null || $sConfigCarrier == '-1'//shipping method will be transferred as carrier
        ) {
            return $sCarrier;
        } else {
            return $sConfigCarrier;
        }
    }

    /**
     * Skip processing for FBK orders.
     *
     * @param $oOrder ML_Shop_Model_Order_Abstract
     * @return bool
     */
    protected function skipAOModifyOrderProcessing($oOrder) {
        $aData = $oOrder->get('data');

        // Skip processing FBK orders
        if ($aData['FulfillmentType'] === 'fulfilled_by_kaufland') {
            $this->saveOrderData($oOrder);

            return true;
        }

        return false;
    }

    /**
     * @param $sAction
     * @param $aRequest
     * @param ML_Shop_Model_Order_Abstract[] $aModels
     * @param $singleOrderRequestOrderId
     * @return void
     */
    protected function submitRequestAndProcessResult($sAction, $aRequest, $aModels, $singleOrderRequestOrderId = false) {
        if ($sAction === 'ConfirmShipment') {
            //check if user lets generate the invoices via magnalister - if so then submit VAT details about products
            if (MLModule::gi()->getConfig('invoice.option') === 'magna') {
                $requestData = array();
                try {
                    //request api to provide VAT details
                    foreach ($aModels as $orderId => $orderModel) {
                        $requestData[$orderId] = $orderModel->getShopOrderProducts();
                    }

                    if (!empty($requestData)) {
                        try {
                            MagnaConnector::gi()->submitRequest(array(
                                'ACTION' => 'UpdateVatDetailsForOrderProducts',
                                'DATA' => $requestData,
                            ), true);
                        } catch (MagnaException $e) {
                        }
                    }
                } catch (Exception $ex) {
                }
            }

        }

        parent::submitRequestAndProcessResult($sAction, $aRequest, $aModels, $singleOrderRequestOrderId);
    }
}
