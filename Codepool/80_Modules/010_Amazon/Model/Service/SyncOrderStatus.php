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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Amazon_Model_Service_SyncOrderStatus extends ML_Modul_Model_Service_SyncOrderStatus_Abstract {

    /**
     * @param $oOrder ML_Shop_Model_Order_Abstract
     * @return bool
     */
    protected function skipAOModifyOrderProcessing($oOrder) {
        $aData = $oOrder->get('data');

        //Check for AFN (amazon fulfillment service) and dont confirm them
        if ($aData['FulfillmentChannel'] === 'AFN') {
            $this->saveOrderData($oOrder);
            return true;
        }

        return false;
    }

    /**
     * @param $aOrderData
     * @param $aResponseData
     * @return mixed
     */
    protected function extendSaveOrderData($aOrderData, $aResponseData) {
        $aOrderData = parent::extendSaveOrderData($aOrderData, $aResponseData);

        if (isset($aResponseData['BatchID'])) {
            $aOrderData['BatchID'] = $aResponseData['BatchID'];
        }

        return $aOrderData;
    }

    protected function getCarrier($oOrder) {
        $sConfigCarrier = MLModule::gi()->getConfig('orderstatus.carrier.select');

        switch ($sConfigCarrier) {
            case 'matchShopShippingOptions':
                $sCarrier = $oOrder->getShopOrderCarrierOrShippingMethodId();
                $aCarrierShippingMethodMatching = MLModule::gi()->getConfig('orderstatus.carrier.matching');
                $sMatchedKey = $this->findTheConfigKey($aCarrierShippingMethodMatching, $sCarrier, 'shopCarrier');
                if (isset($sMatchedKey)) {
                    if($aCarrierShippingMethodMatching[$sMatchedKey]['marketplaceCarrier'] === 'Other'){
                        return $oOrder->getShopOrderCarrierOrShippingMethod();
                    }
                    return $aCarrierShippingMethodMatching[$sMatchedKey]['marketplaceCarrier'];
                } else {
                    MLLog::gi()->add('SyncOrderStatus_' . MLModule::gi()->getMarketPlaceId() . '_WrongConfiguration', array(
                        'Problem' => '#carrier-code# is not matched correctly!',
                    ));
                    return null;
                }
            case 'orderFreetextField':
                $mData = $oOrder->getAdditionalOrderField('carrierCode');
                if ($mData !== null) {
                    return $mData;
                } else {
                    MLLog::gi()->add('SyncOrderStatus_' . MLModule::gi()->getMarketPlaceId() . '_WrongConfiguration', array(
                        'Problem' => '#carrier-code# is not filled in order detail of shop or it is empty!',
                    ));
                    return null;
                }
            case 'freetext':
                $sTextField = MLModule::gi()->getConfig('orderstatus.carrier.freetext');
                if (!empty($sTextField)) {
                    return $sTextField;
                } else {
                    MLLog::gi()->add('SyncOrderStatus_' . MLModule::gi()->getMarketPlaceId() . '_WrongConfiguration', array(
                        'Problem' => 'For #carrier-code# "freetext" configuration right text field is empty!',
                    ));
                    return null;
                }
            default:
            {
                //order attribute freetext field(only in Shopware 5)
                if (strpos($sConfigCarrier, 'a_') === 0) {
                    return $oOrder->getAttributeValue($sConfigCarrier);
                }

                //Amazon predefined carrier
                if (!empty($sConfigCarrier)) {
                    return $sConfigCarrier;
                }
                MLLog::gi()->add('SyncOrderStatus_' . MLModule::gi()->getMarketPlaceId() . '_WrongConfiguration', array(
                    'Problem' => '#carrier-code# is not configured!',
                ));
                return null;
            }
        }

    }


    protected function getShippingMethod($oOrder) {
        $sConfigShippingMethod = MLModule::gi()->getConfig('orderstatus.shipmethod.select');
        switch ($sConfigShippingMethod) {
            case 'matchShopShippingOptions':
                $sShippingMethod = $oOrder->getShopOrderCarrierOrShippingMethodId();
                $aCarrierShippingMethodMatching = MLModule::gi()->getConfig('orderstatus.shipmethod.matching');
                $sMatchedKey = $this->findTheConfigKey($aCarrierShippingMethodMatching, $sShippingMethod, 'shopCarrier');
                if (isset($sMatchedKey)) {
                    return $aCarrierShippingMethodMatching[$sMatchedKey]['marketplaceValue'];
                } else {
                    MLLog::gi()->add('SyncOrderStatus_' . MLModule::gi()->getMarketPlaceId() . '_WrongConfiguration', array(
                        'Problem' => '#ship-method# is not matched correctly!',
                    ));
                    return null;
                }
            case 'orderFreetextField':
                $mData = $oOrder->getAdditionalOrderField('shipMethod');
                if ($mData !== null) {
                    return $mData;
                } else {
                    MLLog::gi()->add('SyncOrderStatus_' . MLModule::gi()->getMarketPlaceId() . '_WrongConfiguration', array(
                        'Problem' => '#ship-method# is not filled in order detail of shop or it is empty!',
                    ));
                    return null;
                }
            case 'freetext':
                $sTextField = MLModule::gi()->getConfig('orderstatus.shipmethod.freetext');
                if (!empty($sTextField)) {
                    return $sTextField;
                } else {
                    MLLog::gi()->add('SyncOrderStatus_' . MLModule::gi()->getMarketPlaceId() . '_WrongConfiguration', array(
                        'Problem' => 'For #ship-method# "freetext" configuration right text field is empty!',
                    ));
                    return null;
                }
            default:
            {
                //order attribute freetext field(only in Shopware 5)
                if (strpos($sConfigShippingMethod, 'a_') === 0) {
                    return $oOrder->getAttributeValue($sConfigShippingMethod);
                }
                MLLog::gi()->add('SyncOrderStatus_' . MLModule::gi()->getMarketPlaceId() . '_WrongConfiguration', array(
                    'Problem' => '#ship-method# is not configured!',
                ));
                return null;
            }
        }

    }

    /**
     * @param array $aRequest
     * @param string $sShopOrderStatus
     * @param null|ML_Shop_Model_Order_Abstract $oOrder
     */
    protected function extendShippedRequest(&$aRequest, $sShopOrderStatus, $oOrder = null) {
        $oModule = MLModule::gi();
        $aShippedState = $oModule->getConfig('orderstatus.shippedaddress');
        $aRequest['ShipMethod'] = $this->getShippingMethod($oOrder);

        $sSelectedIndex = array_search($sShopOrderStatus, $aShippedState, true);
        $aName = $oModule->getConfig('orderstatus.shippedaddress.name');
        $aLine1 = $oModule->getConfig('orderstatus.shippedaddress.line1');
        $aLine2 = $oModule->getConfig('orderstatus.shippedaddress.line2');
        $aLine3 = $oModule->getConfig('orderstatus.shippedaddress.line3');
        $aCity = $oModule->getConfig('orderstatus.shippedaddress.city');
        $aCountry = $oModule->getConfig('orderstatus.shippedaddress.county');
        $aRegion = $oModule->getConfig('orderstatus.shippedaddress.stateorregion');
        $aZip = $oModule->getConfig('orderstatus.shippedaddress.postalcode');
        $aCountryCode = $oModule->getConfig('orderstatus.shippedaddress.countrycode');

        $aRequest['ShipFromAddressName'] = $aName[$sSelectedIndex];
        $aRequest['ShipFromAddressLine1'] = $aLine1[$sSelectedIndex];
        $aRequest['ShipFromAddressLine2'] = $aLine2[$sSelectedIndex];
        $aRequest['ShipFromAddressLine3'] = $aLine3[$sSelectedIndex];
        $aRequest['ShipFromAddressCity'] = $aCity[$sSelectedIndex];
        $aRequest['ShipFromAddressCounty'] = $aCountry[$sSelectedIndex];
        $aRequest['ShipFromAddressStateOrRegion'] = $aRegion[$sSelectedIndex];
        $aRequest['ShipFromAddressPostalCode'] = $aZip[$sSelectedIndex];
        $aRequest['ShipFromAddressCountryCode'] = $aCountryCode[$sSelectedIndex];
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

    protected function findTheConfigKey($aConfigMatching, $sSearchedKey, $sKey) {
        foreach ($aConfigMatching as $iIndex => $aMatching) {
            if ($aMatching[$sKey] === (string)$sSearchedKey) {
                return $iIndex;
            }
        }
        return null;
    }

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

    /**
     * Triggered for each order single by single
     *
     * @param $oOrder
     * @return null
     */
    protected function otherActions($oOrder) {
        $oModule = MLModule::gi();
        $sAmazonStatus = '';
        $sReadyForPickup = $oModule->getConfig('bopis.orderstatus.readyforpickup');
        $sPickedUp = $oModule->getConfig('bopis.orderstatus.pickedup');
        $sRefunded = $oModule->getConfig('bopis.orderstatus.refund');
        $sShopStatus = $oOrder->getShopOrderStatus();

        switch ($sShopStatus) {
            case $sReadyForPickup :
                $sAmazonStatus = 'ReadyForPickup';
                $sAction = 'UpdateShippingStatus';
                break;
            case $sPickedUp :
                $sAmazonStatus = 'PickedUp';
                $sAction = 'UpdateShippingStatus';
                break;
            case $sRefunded :
                $sAction = 'InitiateRefund';
                break;
        }
        if (!isset($sAction)) {
            return;
        }
        $orderData = $oOrder->get('orderData');
        $data = $oOrder->get('data');
        $marketplaceOrderId = $data[$this->sOrderIdentifier];

        if ($sAction == 'InitiateRefund') {
            $preparedRefund = array();
            //at the moment we expect only one product per order
            foreach ($orderData['Products'] as $product) {
                $preparedRefund = array(
                    'MarketplaceIds' => MLModule::gi()->getMarketPlaceId(), # REQUIRED
                    'AmazonOrderID' => $marketplaceOrderId, # REQUIRED
                    'AmazonOrderItemID' => $product['AmazonOrderItemID'], # REQUIRED
                    'AdjustmentReasonCode' => $oModule->getConfig('bopis.refund.reason'), # REQUIRED NoInventory, CustomerReturn, GeneralAdjustment, CouldNotShip, DifferentItem, Abandoned, CustomerCancel, PriceError
                    'Currency' => $orderData['Order']['Currency'], # REQUIRED --> USD, GBP, EUR, JPY, CAD
                    //                this is not included at the moment, maybe in the future
                    //                'ItemPriceAdj' => '',
                    //                'ItemTaxAdj' => '',
                    //                'ShippingPriceAdj' => '',
                    //                'ShippingTaxAdj' => '',
                    //                'GiftWrapPriceAdj' => '',
                    //                'GiftWrapTaxAdj' => '',
                    //                'ItemPromotionAdj' => '',
                    //                'ItemPromotionId' => '',
                    //                'ShipPromotionAdj' => '',
                    //                'ShipPromotionId' => '',
                    //                'QuantityCancelled' => ''
                );
            }
            $aUpdateRequest = $preparedRefund;
        } else {
            $orderItems = array();
            $aUpdateRequest = array(
                'AmazonOrderIDs' => array($marketplaceOrderId),
                'ShipmentStatus' => $sAmazonStatus,
            );

            // not supported by amazon at the moment the field will be ignored, but it will be supported later
            // at the moment we expect only one product per order
            foreach ($orderData['Products'] as $product) {
                $orderItems[] = array(
                  'orderItemId' => $product['AmazonOrderItemID'],
                  'quantity' => $product['Quantity'],
                );
            }

            $aUpdateRequest['orderItems'] = $orderItems;
        }

        $aUpdateModels[$marketplaceOrderId] = $oOrder;
        $this->submitRequestAndProcessResult($sAction, $aUpdateRequest, $aUpdateModels, $marketplaceOrderId);

    }
}
