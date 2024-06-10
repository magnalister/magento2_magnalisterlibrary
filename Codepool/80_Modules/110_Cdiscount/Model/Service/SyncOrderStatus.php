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

class ML_Cdiscount_Model_Service_SyncOrderStatus extends ML_Modul_Model_Service_SyncOrderStatus_Abstract {
    
    protected function postProcessError($aError, &$aModels) {
        $sMarketplaceOrderId = null;
        if (isset($aError['DETAILS']) && isset($aError['DETAILS'][$this->sOrderIdentifier])) {
            $sMarketplaceOrderId = $aError['DETAILS'][$this->sOrderIdentifier];
        }
        if (empty($sMarketplaceOrderId)) {
            return;
        }

        if (   isset($aError['DETAILS']['ErrorType'])
            && in_array ($aError['DETAILS']['ErrorType'], array(
                'OrderStateIncoherent', // OrderStateIncoherent: Shipped state is not possible to set at this stage
                'UnexpectedException', // could be many errors of cdiscount
            ))
        ) {
            $this->saveOrderData($aModels[$sMarketplaceOrderId]);
            unset($aModels[$sMarketplaceOrderId]);
        }
    }

    /**
     * @param $oOrder
     * @return array|mixed|string|null
     */
    protected function getCarrier($oOrder) {
        $sConfigCarrier = MLModule::gi()->getConfig('orderstatus.carrier.select');

        switch ($sConfigCarrier) {
            case 'matchShopShippingOptions':
                $sCarrier = $oOrder->getShopOrderCarrierOrShippingMethodId();

                $aCarrierShippingMethodMatching = MLModule::gi()->getConfig('orderstatus.carrier.matching');
                $sMatchedKey = $this->findTheConfigKey($aCarrierShippingMethodMatching, $sCarrier, 'shopCarrier');
                if (isset($sMatchedKey)) {
                    if ($aCarrierShippingMethodMatching[$sMatchedKey]['marketplaceCarrier'] === 'UseShopValue') {
                        return $oOrder->getShopOrderCarrierOrShippingMethod();
                    }
                    return $aCarrierShippingMethodMatching[$sMatchedKey]['marketplaceCarrier'];
                } else {
                    MLLog::gi()->add('SyncOrderStatus_'.MLModule::gi()->getMarketPlaceId().'_WrongConfiguration', array(
                        'Problem' => '#carrier-code# is not matched correctly!',
                    ));
                    return null;
                }
            case 'orderFreetextField':
                $mData = $oOrder->getAdditionalOrderField('carrierCode');
                if ($mData !== null) {
                    return $mData;
                } else {
                    MLLog::gi()->add('SyncOrderStatus_'.MLModule::gi()->getMarketPlaceId().'_WrongConfiguration', array(
                        'Problem' => '#carrier-code# is not filled in order detail of shop or it is empty!',
                    ));
                    return null;
                }
            case 'freetext':
                $sTextField = MLModule::gi()->getConfig('orderstatus.carrier.freetext');
                if (!empty($sTextField)) {
                    return $sTextField;
                } else {
                    MLLog::gi()->add('SyncOrderStatus_'.MLModule::gi()->getMarketPlaceId().'_WrongConfiguration', array(
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

                //Cdiscount predefined carrier
                if (!empty($sConfigCarrier)) {
                    return $sConfigCarrier;
                }
                MLLog::gi()->add('SyncOrderStatus_'.MLModule::gi()->getMarketPlaceId().'_WrongConfiguration', array(
                    'Problem' => '#carrier-code# is not configured!',
                ));
                return null;
            }
        }

    }

    protected function findTheConfigKey($aConfigMatching, $sSearchedKey, $sKey) {
        foreach ($aConfigMatching as $iIndex => $aMatching) {
            if ($aMatching[$sKey] === (string)$sSearchedKey) {
                return $iIndex;
            }
        }
        return null;
    }
}
