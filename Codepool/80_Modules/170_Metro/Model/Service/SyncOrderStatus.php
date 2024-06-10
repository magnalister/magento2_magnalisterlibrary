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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Metro_Model_Service_SyncOrderStatus extends ML_Modul_Model_Service_SyncOrderStatus_Abstract {

    protected $sOrderIdentifier = 'MetroOrderId';

    // copied from the parent function and extended
    // (faster than calling the whole mechanics here, and then calling the parent method for the standard stuff)
    // Differences to the parent:
    // * CancelOrder instead of CancelShipping
    // * deactivated for now: AcceptOrder
    public function execute() {
        $oModule = MLModule::gi();
        $sShippedState = $oModule->getConfig('orderstatus.shipped');
        //$sAcceptedState = $oModule->getConfig('orderstatus.accepted');
        $sAcceptedState = 'auto'; // accepting orders by status change deactivated for now
        $sOpenState = $oModule->getConfig('orderstatus.open');

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
            $aAcceptedRequest = array();
            $AcceptedModels = array();

            foreach ($oList->getList() as $oOrder) {
                try {
                    $sShopStatus = $oOrder->getShopOrderStatus();
                    if ($sShopStatus != $oOrder->get('status')) {
                        $aData = $oOrder->get('data');
                        $sOrderId = $aData[$this->sOrderIdentifier];

                        if ($this->isCancelled($sShopStatus)) {
                            $aCanceledRequest[$sOrderId] = array($this->sOrderIdentifier => $sOrderId);
                            $aCanceledModels[$sOrderId] = $oOrder;
                        } elseif ($sShopStatus == $sShippedState) {
                            $sCarrier = $this->getCarrier($oOrder);
                            $aShippedRequest[$sOrderId] = array(
                                $this->sOrderIdentifier => $sOrderId,
                                'ShippingDate' => $oOrder->getShippingDateTime(),
                                'Carrier' => $sCarrier,
                                'TrackingCode' => $oOrder->getShippingTrackingCode(),
                                'Country' => 'DE',
                            );
                            $aShippedModels[$sOrderId] = $oOrder;
                        } elseif (    ($sAcceptedState != 'auto')
                            // AcceptOrder is sent only if
                            // * auto accept is off
                            // * order state is <> start state
                            // * order state is <> cancel state
                            // * order state is <> sent state (ConfirmShipment means also accept)
                                   && ($sShopStatus != $sOpenState) 
                                   && (!$this->isCancelled($sShopStatus))
                                   && ($sShopStatus != $sShippedState)) {

                            $aAcceptedRequest[$sOrderId] = array($this->sOrderIdentifier => $sOrderId);
                            $aAcceptedModels[$sOrderId] = $oOrder;
                        }
                        // update order status in magnalister tables (if processed, or if no processing needed)
                        $oOrder->set('status', $sShopStatus);
                        $oOrder->save();
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
            $this->submitRequestAndProcessResult('ConfirmShipment', $aShippedRequest, $aShippedModels);
            $this->submitRequestAndProcessResult('CancelOrder', $aCanceledRequest, $aCanceledModels);
            //$this->submitRequestAndProcessResult('AcceptOrder', $aAcceptedRequest, $aAcceptedModels);
        }
    }

    protected function manipulateRequest($aRequest) {
        $aConfig = MLModule::gi()->getConfig();
        if ($aRequest['ACTION'] == 'CancelOrder') {
            foreach ($aRequest['DATA'] as &$aOrder) {
                $aOrder['CancellationReason'] = $aConfig['orderstatus.cancellationreason'];
            }
        }
        return $aRequest;
    }
}
