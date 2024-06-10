<?php

class ML_PriceMinister_Model_Service_ImportOrders extends ML_Modul_Model_Service_ImportOrders_Abstract {
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
            throw MLException::factory('Model_Service_ImportOrders_OrderExist')->setShopOrder($oOrder);
        }
    }

    protected function acknowledgeOrders() {
        $aProcessedOrders = array();
        $oModul = $this->oModul;

        /* Checking for auto acceptance of orders */
        $orderStatusOpen = $this->oModul->getConfig('orderstatus.open');
        $orderStatusAccept = $this->oModul->getConfig('orderstatus.accepted');
        $autoAcceptOrders = $orderStatusOpen === $orderStatusAccept;
        
        foreach ($this->aOrders as $iKey => $aOrder) {
            $sOrderId = $this->aOrdersList[$iKey]->get('orders_id');
            if (!empty($sOrderId)) {
                $aOrderParameters = array();
                $aOrderParameters['MOrderID'] = $aOrder['MPSpecific']['MOrderID'];
                $aOrderParameters['ShopOrderID'] = $sOrderId;
                $this->aOrdersList[$iKey]->setSpecificAcknowledgeField($aOrderParameters,$aOrder);
                $aProcessedOrders[] = $aOrderParameters;
            }
        }
        if (count($aProcessedOrders) > 0) {
            $aRequest = array(
                'ACTION' => $this->sAcknowledgeApiAction,
                'SUBSYSTEM' => $oModul->getMarketplaceName(),
                'MARKETPLACEID' => $oModul->getMarketplaceId(),
                'DATA' => array(
                    'ProcessedOrders' => $aProcessedOrders,
                    'AutoAcceptOrders' => $autoAcceptOrders,
                ),
            );
            try {
                $aResponse = MagnaConnector::gi()->submitRequest($aRequest);
                MLLog::gi()->add(MLSetting::gi()->get('sCurrentOrderImportLogFileName'), array(
                    'MOrderId' => 'AcknowledgeOrders',
                    'PHP' => get_class($this).'::'.__METHOD__.'('.__LINE__.')',
                    'Request' => $aRequest,
                    'Response' => $aResponse,
                ));
            } catch (MagnaException $oEx) {
                if ($oEx->getCode() == MagnaException::TIMEOUT) {
                    $oEx->saveRequest();
                    $oEx->setCriticalStatus(false);
                }
                MLLog::gi()->add(MLSetting::gi()->get('sCurrentOrderImportLogFileName'), array(
                    'MOrderId' => 'AcknowledgeOrdersException',
                    'PHP' => get_class($this).'::'.__METHOD__.'('.__LINE__.')',
                    'Request' => $aRequest,
                    'Exception' => $oEx->getMessage(),
                ));
            }
        }
        return $this;
    }
}