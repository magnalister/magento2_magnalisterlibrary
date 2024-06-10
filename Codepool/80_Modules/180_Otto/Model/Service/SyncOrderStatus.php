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

class ML_Otto_Model_Service_SyncOrderStatus extends ML_Modul_Model_Service_SyncOrderStatus_Abstract {

    protected $sOrderIdentifier = 'OttoOrderId';

    /**
     * @ToDo: Don't overwrite this function - instead use Abstract function to extend request parameters
     *
     * @throws Exception
     */
    public function execute() {
        $oModule = MLModule::gi();
        $returnTrackingKeyConfig = $oModule->getConfig('orderstatus.returntrackingkey');
        $trackingKeyConfig = $oModule->getConfig('orderstatus.trackingkey');

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

                        if ($this->isCancelled($sShopStatus)) {
                            $aCanceledRequest[$sOrderId] = array($this->sOrderIdentifier => $sOrderId);
                            $aCanceledModels[$sOrderId] = $oOrder;
                        } else {
                            $sShippedStates = $oModule->getConfig('orderstatus.shippedaddress');
                            foreach ($sShippedStates as $key => $shippedStatus) {
                                if ($sShopStatus == $shippedStatus) {
                                    $oShipAddress = array(
                                        'City' => $oModule->getConfig('orderstatus.shippedaddress.city')[$key],
                                        'Country' => $oModule->getConfig('orderstatus.shippedaddress.code')[$key],
                                        'Zip' => $oModule->getConfig('orderstatus.shippedaddress.zip')[$key]
                                    );

                                    $aShippedRequest[$sOrderId] = array(
                                        $this->sOrderIdentifier => $sOrderId,
                                        'StandardCarrier' => $this->getCarrierValue('orderstatus.sendcarrier', $oOrder),
                                        'ForwardingCarrier' => $this->getCarrierValue('orderstatus.forwardercarrier', $oOrder, 'forwarding'),
                                        'TrackingCode' => $oOrder->getShippingTrackingCode(),
                                        'ShipFromCity' => $oShipAddress['City'],
                                        'ShipFromCountryCode' => $oShipAddress['Country'],
                                        'ShipFromZip' => $oShipAddress['Zip'],
                                        'ShippingDate' => $this->getShippingDate($oOrder),
                                        'ReturnCarrier' => $this->getCarrierValue('orderstatus.returncarrier', $oOrder, 'return'),
                                        'ReturnTrackingKey' => $this->getReturnTrackingKey($returnTrackingKeyConfig, $oOrder),
                                    );
                                    $aShippedModels[$sOrderId] = $oOrder;
                                }
                            }
                        }

                        // update order status in magnalister tables (if processed, or if no processing needed)
                        $oOrder->set('status', $sShopStatus); // use the same order status as request beginning because during process it could change
                        $oOrder->save();
                    }
                } catch (Exception $oExc) {
                    MLLog::gi()->add('SyncOrderStatus_'.MLModul::gi()->getMarketPlaceId().'_Exception', array(
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
        }
    }

    /**
     * Send Shipping time including timezone to API...
     *
     * @param $oOrder
     * @return string
     * @throws Exception
     */
    protected function getShippingDate($oOrder) {
        $sDateTime = parent::getShippingDate($oOrder);
        $sTimeZone = MLShop::gi()->getTimeZone();
        if (!empty($sTimeZone)) {
            $oDateTime = new DateTime($sDateTime, new DateTimeZone($sTimeZone));
        } else {
            $oDateTime = new DateTime($sDateTime);
        }

        $oDateTime->setTimezone(new DateTimeZone("UTC"));
        return $oDateTime->format("Y-m-d\TH:i:s\Z");
    }


    protected function manipulateRequest($aRequest) {
        $aConfig = MLModul::gi()->getConfig();
        if ($aRequest['ACTION'] == 'CancelOrder') {
            foreach ($aRequest['DATA'] as &$aOrder) {
                $aOrder['CancellationReason'] = 'CANCELLED_BY_PARTNER';
            }
        }
        return $aRequest;
    }

    /**
     * Returns carrier value based on configuration settings and shipping type in shop system
     *
     * @param $carrierType
     * @param ML_Shop_Model_Order_Abstract $oOrder
     * @param string $marketplaceCarrierType
     * @return string
     */
    private function getCarrierValue($carrierType, $oOrder = null, $marketplaceCarrierType = 'standard') {
        $oModule = MLModul::gi();
        $selectValue = $oModule->getConfig($carrierType. '.select');
        $carrierValue = null;
        switch ($selectValue) {
            case 'sendCarrierMatching':
            case 'forwardingCarrierMatching':
            case 'returnCarrierMatching':
            // checks if carrier is set as matching
            $sCarrierId = $oOrder->getShopOrderCarrierOrShippingMethodId();
            $carrierMatches = $oModule->getConfig($carrierType . '.matching');
            foreach ($carrierMatches as $carrierMatch) {
                if ($carrierMatch['shopCarrier'] == $sCarrierId) {
                    $carrierValue = $carrierMatch['marketplaceCarrier'];
                    break;
                }
            }
            break;
            case 'orderFreeTextField':
                $carrierValue = $oOrder->getAdditionalOrderField('returnCarrier');
                break;
            default:
            {
                //order attribute freetext field(only in Shopware 5)
                if (strpos($selectValue, 'a_') === 0) {
                    $carrierValue = $oOrder->getAttributeValue($selectValue);
                    break;
                }

                //checks if carrier is set as marketplace value
                $carrierValue = $this->getMarketplaceCarrier($marketplaceCarrierType, $selectValue);
                break;
            }
        }

        if ($carrierValue === null) {
            MLLog::gi()->add('SyncOrderStatus_'.MLModul::gi()->getMarketPlaceId().'_WrongConfiguration', array(
                'Problem' => $carrierType . ' is not configured!',
            ));
        }

        return $carrierValue;
    }

    /**
     * Returns return tracking key value based on configuration settings and shipping type in shop system
     *
     * @param $selectValue
     * @param $oOrder
     * @return null
     */
    private function getReturnTrackingKey($selectValue, $oOrder) {
        $sReturnTrackingKeyValue = null;

        if (strpos($selectValue, 'a_') === 0) {
            $sReturnTrackingKeyValue = $oOrder->getAttributeValue($selectValue);
        }

        if ($selectValue === 'orderFreeTextField') {
            $sReturnTrackingKeyValue = $oOrder->getAdditionalOrderField('returnTrackingNumber');
        }

        if ($sReturnTrackingKeyValue === null) {
            MLLog::gi()->add('SyncOrderStatus_'.MLModul::gi()->getMarketPlaceId().'_WrongConfiguration', array(
                'Problem' => '#return-tracking# is not configured!',
            ));
        }

        // Check Based on Modul Class
        $blOnlyFirst = true;
        try {
            $blOnlyFirst = MLModule::gi()->submitFirstTrackingNumber();
        } catch (\Exception $ex) {
            //here no marketplace is loaded
        }

        // Only submit first tracking code "12345" is submitted instead of "12345,738427,234098" and "12345;123123;12123"
        if ($blOnlyFirst) {
            $sSeparator = '';
            if (strpos($sReturnTrackingKeyValue, ',') !== false) {
                $sSeparator = ',';
            } else if (strpos($sReturnTrackingKeyValue, ';') !== false) {
                $sSeparator = ';';
            }
            if ($sSeparator !== '') {
                $sReturnTrackingKeyValue = current(explode($sSeparator, $sReturnTrackingKeyValue));
            }
        }

        return $sReturnTrackingKeyValue;
    }

    /**
     * Returns marketplace carrier value based on predefined carrier list provided by OTTO
     *
     * @param $marketplaceCarrierType
     * @param $value
     * @return string
     */
    private function getMarketplaceCarrier($marketplaceCarrierType, $value) {
        $carrierValue = null;
        $apiMarketplaceCarriers = MLModule::gi()->getOttoShippingSettings($marketplaceCarrierType);
        foreach ($apiMarketplaceCarriers as $key => $marketplaceCarrier) {
            if ($value === $key) {
                $carrierValue = $key;
                break;
            }
        }
        return $carrierValue;
    }

    /**
     * In Amazon the order status for shipped has multiple options
     * so we compare the set values with the current order status value
     *
     * @param $sShopStatus
     * @return bool
     */
    public function isShipped($sShopStatus) {
        $oModule = MLModule::gi();
        $aShippedState = $oModule->getConfig('orderstatus.shippedaddress');

        return in_array($sShopStatus, array_values($aShippedState), true);
    }
}
