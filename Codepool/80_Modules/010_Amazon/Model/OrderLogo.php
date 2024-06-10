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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Amazon_Model_OrderLogo
{
    public function getLogo(ML_Shop_Model_Order_Abstract $oModel)
    {
        $aData = $oModel->get('data');
        $sCancelledStatus = MLDatabase::factory('config')->set('mpid', $oModel->get('mpid'))
            ->set('mkey', 'orderstatus.cancelled')->get('value');
        $sShippedStatus = MLDatabase::factory('config')->set('mpid', $oModel->get('mpid'))
            ->set('mkey', 'orderstatus.shippedaddress')->get('value');

        $fulfillment = $aData['FulfillmentChannel'];
        if (!in_array($fulfillment, array('MFN', 'MFN-Prime', 'Business', 'Bopis'))) {
            $sLogo = 'amazon_fba';

            if (isset($aData['IsBusinessOrder']) && $aData['IsBusinessOrder'] == 'true') {
                $sLogo .= '_business';
            }

            $sLogo .= '_orderview';
        } else {
            // business, prime and regular orders could also be cancelled or shipped
            $suffix = '';
            if ($fulfillment === 'MFN-Prime') {
                $suffix = '_prime';
                if (isset($aData['ShipServiceLevel'])) {
                    $sShipServiceLevel = $aData['ShipServiceLevel'];
                    if ($sShipServiceLevel === 'NextDay') {
                        $suffix .= '_nextday';
                    } else if ($sShipServiceLevel === 'SameDay') {
                        $suffix .= '_sameday';
                    } else if ($sShipServiceLevel === 'SecondDay') {
                        $suffix .= '_secondday';
                    }
                }
            } elseif ($fulfillment === 'Business') {
                $suffix = '_business';
            } elseif ($fulfillment === 'Bopis') {
                $suffix = '_bopis';
            }

            $sStatus = $oModel->get('status');
            if (false) {//todo
                $sLogo = 'amazon_orderview_error';
            } elseif ($sCancelledStatus == $sStatus) {
                $sLogo = 'amazon_orderview_cancelled'.$suffix;
            } elseif (in_array($sStatus, $sShippedStatus)) {
                if ( strpos($suffix, '_nextday') ) {
                    $suffix = substr($suffix, strlen('_nextday'), 0);
                } elseif ( strpos($suffix, '_sameday') ) {
                    $suffix = substr($suffix, strlen('_sameday'), 0);
                } elseif ( strpos($suffix, '_secondday') ) {
                    $suffix = substr($suffix, strlen('_secondday'), 0);
                }
                $sLogo = 'amazon_orderview_shipped'.$suffix;
            } else {
                $sLogo = 'amazon_orderview'.$suffix;
            }
        }

        return $sLogo . '.png';
    }
}
