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

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

class ML_Rookie_Controller_Rookie extends ML_Core_Controller_Abstract {

    /**
     * Returns the content provided by the request from API
     *
     * @return mixed
     */
    protected function getRookieInfo() {
        $response = MagnaConnector::gi()->submitRequestCached(
            array(
                'SUBSYSTEM' => 'Core',
                'ACTION' => 'GetRookieTariffInfo',
            ),
            30 * 60,
            true
        );

        return $response['DATA'];
    }

    /**
     * Returns ture if tariff successfully booked otherwise false
     *
     * @return bool
     */
    protected function bookNewTariff() {
        // catch if no tariff is selected
        $requestTariff = MLRequest::gi()->data('Tariff');
        if (empty($requestTariff)) {
            return false;
        }

        try {
            $response = MagnaConnector::gi()->submitRequest(
                array(
                    'SUBSYSTEM' => 'Core',
                    'ACTION' => 'BookTariffUpgrade',
                    'DATA' => array(
                        'Tariff' => $requestTariff
                    )
                ),
                30 * 60,
                true
            );
        } catch (MagnaException $e) {
            MLMessage::gi()->addWarn($e->getMessage());
        }

        // in case of success return true
        if ($response['STATUS'] == 'SUCCESS') {
            MLShop::gi()->getShopInfo(true);
            return true;
        }

        return false;
    }

}
