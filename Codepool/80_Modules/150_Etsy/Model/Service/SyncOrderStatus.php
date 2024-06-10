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

class ML_Etsy_Model_Service_SyncOrderStatus extends ML_Modul_Model_Service_SyncOrderStatus_Abstract {

    protected function getCarrier($oOrder) {
        $oModule = MLModul::gi();
        $selectValue = $oModule->getConfig('orderstatus.shipping.select');
        $carrierValue = null;

        if ($selectValue === 'sendCarrierMatching') {
            // checks if carrier is set as matching
            $sCarrier = $oOrder->getShopOrderCarrierOrShippingMethodId();

            $carrierMatches = $oModule->getConfig('orderstatus.shipping.matching');
            foreach ($carrierMatches as $carrierMatch) {
                if ($carrierMatch['shopCarrier'] == $sCarrier) {
                    $carrierValue = $carrierMatch['marketplaceCarrier'];
                    break;
                }
            }
        } else {
            //checks if carrier is set as marketplace value
            $carrierValue = $this->getMarketplaceCarrier($selectValue);
        }

        if ($carrierValue === null) {
            // fall back to old configuration
            return $oOrder->getShopOrderCarrierOrShippingMethod();
        }

        return $carrierValue;
    }

    /**
     * Returns marketplace carrier value based on predefined carrier list provided by Etsy
     *
     * @param $marketplaceCarrierType
     * @param $value
     * @return string
     */
    private function getMarketplaceCarrier($value) {
        $carrierValue = null;
        $apiMarketplaceCarriers = MLModul::gi()->getEtsyShippingSettings();
        foreach ($apiMarketplaceCarriers as $key => $marketplaceCarrier) {
            if ($value === $key) {
                $carrierValue = $key;
                break;
            }
        }
        return $carrierValue;
    }

    /**
     * We want to ignore the configuration of cancellation because
     * there is no functionality on Etsy API to cancel the order
     *
     * @param $sShopStatus
     * @return false
     */
    protected function isCancelled($sShopStatus) {
        return false;
    }
}
