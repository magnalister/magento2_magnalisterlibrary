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

class ML_Ebay_Model_Service_SyncOrderStatus extends ML_Modul_Model_Service_SyncOrderStatus_Abstract {

    protected function getCarrier($oOrder) {
        $sCarrier = $oOrder->getShippingCarrier();
        $sConfigCarrier = MLModule::gi()->getConfig('orderstatus.carrier.default');

        if (    $sConfigCarrier != null
             && $sConfigCarrier != '-1'
             && strpos($sConfigCarrier, 'a_') === false
        ) {
            // fixed value configured
            return $sConfigCarrier;
        }

        $aCarriers = MLModule::gi()->getCarrier();
        if (
            in_array($sCarrier, $aCarriers) ||
            $sConfigCarrier == null ||
            $sConfigCarrier == '-1' ||//shipping method will be transferred as carrier
            strpos($sConfigCarrier, 'a_') !== 0//right now it works only after activating IVCarrierFreeTextFieldMatching individually
        ) {
            return $sCarrier;
        }
        //order attribute freetext field(only in Shopware 5)
        if (strpos($sConfigCarrier, 'a_') === 0) {
            return $oOrder->getAttributeValue($sConfigCarrier);
        } else {
            return $sConfigCarrier;
        }
    }


    protected function postProcessError($aError, &$aModels) {
        $sFieldId = 'MOrderID';
        $sMarketplaceOrderId = null;
        if (isset($aError['DETAILS']) && isset($aError['DETAILS'][$sFieldId])) {
            $sMarketplaceOrderId = $aError['DETAILS'][$sFieldId];
        }
        if (empty($sMarketplaceOrderId)) {
            return;
        }

        // it will return if order don't belongs to customer or is to old
        if (isset($aError['ERRORCODE']) && $aError['ERRORCODE'] == 1450279354) {
            $this->saveOrderData($aModels[$sMarketplaceOrderId]);
            unset($aModels[$sMarketplaceOrderId]);
        }
    }

    /**
     * @param $oOrder ML_Shop_Model_Order_Abstract
     */
    public function otherActions($oOrder) {
        $aOrderData = $oOrder->get('data');

        // PHP Fix for in_array check cant be done against NULL as value
        $refundStatuses = MLModule::gi()->getConfig('refundstatus');
        if (empty($refundStatuses)) {
            $refundStatuses = array();
        }

        if (    !isset($aOrderData['refund'])
            && MLModule::gi()->isPaymentProgramAvailable()
            && in_array($oOrder->getShopOrderStatus(), $refundStatuses, true)
        ) {
            $aReasons = MLModule::gi()->getConfig('refundreason');
            $aComments = MLModule::gi()->getConfig('refundcomment');
            $iIndex = array_search($oOrder->getShopOrderStatus(), MLModule::gi()->getConfig('refundstatus'), true);
            $aRequest = array(
                'ACTION' => 'DoRefund',
                'MagnalisterOrderId' => $oOrder->get('special'),
                'ReasonOfRefund' => $aReasons[$iIndex],
                'Comment' => $aComments[$iIndex],
            );

            try {
                MagnaConnector::gi()->submitRequest($aRequest);
                $aOrderData['refund'] = 'requested';
                $oOrder->set('data', $aOrderData);
            } catch (MagnaException $oEx) {
                $aErrorData = array(
                    'MOrderID' => $oOrder->get('special'),
                );

                if (is_numeric(substr($oEx->getMessage(), 0, 5))) {
                    $aErrorData['origin'] = 'eBay';
                } else {
                    $aErrorData['origin'] = 'magnalister';
                }

                MLErrorLog::gi()->addError(0, ' ', $oEx->getMessage(), $aErrorData);
            }
        }
    }

}
