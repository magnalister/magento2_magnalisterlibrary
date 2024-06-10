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

abstract class ML_Modul_Model_Service_SyncOrderStatus_Abstract extends ML_Modul_Model_Service_Abstract {
    protected $blVerbose = false;
    protected $sOrderIdentifier = 'MOrderID';
    protected $sOrderIdConfirmations = 'MOrderId';
    protected $iOrderPerRequest = 100;

    public function __construct() {
        MLDatabase::getDbInstance()->logQueryTimes(false);
        MagnaConnector::gi()->setTimeOutInSeconds(600);
        @set_time_limit(60 * 10); // 10 minutes per module
        parent::__construct();
    }

    public function getOrderPerRequest() {
        return $this->iOrderPerRequest;
    }

    public function __destruct() {
        MagnaConnector::gi()->resetTimeOut();
        MLDatabase::getDbInstance()->logQueryTimes(true);
    }

    /*
     * You can modify the order and(or)[A(nd)O(r)] skip it in processing
     * @param:
     *  $oOrder: the order object
     * @return: if true should skip this order in process
     */
    protected function skipAOModifyOrderProcessing($oOrder) {
        return false;
    }

    public function execute() {
        $oModule = MLModule::gi();

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
            $oList->getQueryObject()->orderBy('order_status_sync_last_check_date ASC');

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
                        if ($this->isCancelled($sShopStatus)) {
                            $aCanceledRequest[$sOrderId] = array($this->sOrderIdentifier => $sOrderId);
                            $aCanceledModels[$sOrderId] = $oOrder;
                        } elseif ($this->isShipped($sShopStatus)) {
                            $sCarrier = $this->getCarrier($oOrder);
                            $aShippedRequest[$sOrderId] = array(
                                $this->sOrderIdentifier => $sOrderId,
                                'ShippingDate'          => $this->getShippingDate($oOrder),
                                'Carrier'               => $sCarrier,
                                'TrackingCode'          => $oOrder->getShippingTrackingCode()
                            );
                            $this->extendShippedRequest($aShippedRequest[$sOrderId], $sShopStatus, $oOrder);
                            $aShippedModels[$sOrderId] = $oOrder;
                        } else {
                            $this->otherActions($oOrder);
                            // In this case update order status in magnalister tables
                            $oOrder->set('status', $sShopStatus); // use the same order status as request beginning because during process it could change
                            $oOrder->set('order_status_sync_last_check_date', 'NOW()'); // update date when last check happened
                            $oOrder->save();
                            continue;
                        }
                    }
                } catch (Exception $oExc) {
                    $this->out($oOrder->get('data')[$this->sOrderIdentifier].':: Exception by order synchronization: ' . $oExc->getMessage() . '. Check the following log for more information:' . 'SyncOrderStatus_' . MLModule::gi()->getMarketPlaceId() . '_Exception');
                    MLLog::gi()->add('SyncOrderStatus_' . MLModule::gi()->getMarketPlaceId() . '_Exception', array(
                        'Exception' => array(
                            'Message'   => $oExc->getMessage(),
                            'Code'      => $oExc->getCode(),
                            'Backtrace' => $oExc->getTrace(),
                        )
                    ));
                    if ($oExc->getMessage() === 'This order is not found in shop') {
                        $oOrder->set('order_exists_in_shop', 0);
                    }
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

    /**
     * return the carrier
     *  special in eBay it check for a valid value in carrier list
     *
     * @param ML_Shop_Model_Order_Abstract $oOrder
     * @return string $sCarrier
     */
    protected function getCarrier($oOrder) {
        return $oOrder->getShippingCarrier();
    }

    protected function extendSaveOrderData($aOrderData, $aResponseData) {
        if (isset($aResponseData['Note']) && !empty($aResponseData['Note'])) {
            $aOrderData['Note'] = $aResponseData['Note'];
        } elseif (isset($aOrderData['Note'])) {
            unset($aOrderData['Note']);
        }

        return $aOrderData;
    }

    protected function saveOrderData($oOrder, $aResponseData = array()) {
        $oOrder->set('status', $oOrder->getShopOrderStatus());
        $aOrderData = $oOrder->get('data');
        $aOrderData = $this->extendSaveOrderData($aOrderData, $aResponseData);
        $oOrder->set('data', $aOrderData);
        $oOrder->save();
    }


    /**
     * implemented to extend it
     *  special in eBay if order cant updated any more
     */
    protected function postProcessError($aError, &$aModels) {

    }

    /**
     * @param $sAction
     * @param $aRequest
     * @param $aModels
     * @param $singleOrderRequest null|string - Marketplace Order id of processing order, Warning only use when the API request needs to be done per (one) order
     * @return void
     */
    protected function submitRequestAndProcessResult($sAction, $aRequest, $aModels, $singleOrderRequestOrderId = false) {
        if (!empty($aRequest)) {
            try {
                $aApiRequest = array(
                    'ACTION' => $sAction,
                    'SUBSYSTEM' => $this->oModul->getMarketplaceName(),
                    'MARKETPLACEID' => $this->oModul->getMarketplaceId(),
                    'DATA' => $aRequest,
                );

                MLHelper::gi('stream')->deeper('Start ('.$sAction.')');
                if ($singleOrderRequestOrderId !== false) {
                    MLHelper::gi('stream')->stream($singleOrderRequestOrderId);
                } else {
                    foreach ($aRequest as $sOrderId => $aRequestData) {
                        MLHelper::gi('stream')->stream($sOrderId);
                    }
                }
                MLHelper::gi('stream')->higher('End ('.$sAction.')');

                $aApiRequest = $this->manipulateRequest($aApiRequest);
                $aResponse = MagnaConnector::gi()->submitRequest($aApiRequest);
                $iCurrentOffset = (int)MLModule::gi()->getConfig('orderstatussyncoffset') + $this->getOrderPerRequest();
                if (isset($aResponse['STATUS']) && ($aResponse['STATUS']) == 'SUCCESS') {
                    if (isset($aResponse['CONFIRMATIONS'])) {
                        foreach ($aResponse['CONFIRMATIONS'] as $aResponseData) {
                            if (!array_key_exists($aResponseData[$this->sOrderIdConfirmations], $aModels)) {
                                continue;
                            }
                            $this->saveOrderData($aModels[$aResponseData[$this->sOrderIdConfirmations]], $aResponseData);
                            unset($aModels[$aResponseData[$this->sOrderIdConfirmations]]);
                        }
                        $iCurrentOffset -= count($aResponse['CONFIRMATIONS']);
                    }
                    if (isset($aResponse['ERRORS'])) {
                        foreach ($aResponse['ERRORS'] as $aError) {
                            $sMessage = null;
                            $aData = null;
                            if (isset($aError['ERRORMESSAGE'])) {
                                $sMessage = $aError['ERRORMESSAGE'];
                                if (isset($aError['DETAILS'])) { // Rakuten
                                    $aData = $aError['DETAILS'];
                                } elseif (isset($aError['VALUE'])) { // eBay
                                    $aData = array('MOrderID' => $aError['VALUE']);
                                } else { // other
                                    $aData = array();
                                }
                            }
                            if ($sMessage !== null) {
                                MLErrorLog::gi()->addError(0, '', $sMessage, $aData);
                            }
                            $this->postProcessError($aError, $aModels);
                        }
                    }
                }
                MLModule::gi()->setConfig('orderstatussyncoffset', $iCurrentOffset);
                MLLog::gi()->add('SyncOrderStatus_'.MLModule::gi()->getMarketPlaceId().'_'.$sAction, array(
                    'Request'  => $aRequest,
                    'Response' => $aResponse,
                ));
            } catch (MagnaException $oEx) {
                MLLog::gi()->add('SyncOrderStatus_' . MLModule::gi()->getMarketPlaceId() . '_Exception', array(
                    'RequestData' => $aRequest,
                    'Exception' => array(
                        'Message' => $oEx->getMessage(),
                        'Code' => $oEx->getCode(),
                        'Backtrace' => $oEx->getTrace(),
                    )
                ));
            }
        }
    }

    protected function manipulateRequest($aRequest) {
        return $aRequest;
    }

    protected function isCancelled($sShopStatus) {
        $oModule = MLModule::gi();
        $sCancelState = $oModule->getConfig('orderstatus.cancelled');
        if ($sCancelState === null) {
            $sCancelState = $oModule->getConfig('orderstatus.canceled');
        }
        return $sShopStatus == $sCancelState;
    }

    /**
     * @param $sShopStatus
     * @return bool
     */
    public function isShipped($sShopStatus) {
        $oModule = MLModule::gi();
        $sShippedState = $oModule->getConfig('orderstatus.shipped');

        return $sShopStatus == $sShippedState;
    }

    /**
     * Allows to extend the data for ConfirmShipment
     * @param array $aRequest
     * @param string $sShopOrderStatus
     * @param null|ML_Shop_Model_Order_Abstract $oOrder
     */
    protected function extendShippedRequest(&$aRequest, $sShopOrderStatus, $oOrder = null) {

    }

    protected function otherActions($oOrder) {

    }

    /**
     * @param array $iTotal
     * @param int $iOffset
     */
    protected function showStatistics($iTotal, $iOffset) {
        MLHelper::gi('stream')->deeper('Statistic');
        MLHelper::gi('stream')->outWithNewLine('Total number of orders to be synchronized: '.$iTotal);
        MLHelper::gi('stream')->outWithNewLine('Current offset: '.$iOffset);
        MLHelper::gi('stream')->outWithNewLine('Current limit: '.$this->getOrderPerRequest());
        MLHelper::gi('stream')->higher('');
    }

    protected function getShippingDate($oOrder) {
        return $oOrder->getShippingDateTime();
    }
}
