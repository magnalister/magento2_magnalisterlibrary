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

/* @var $oList ML_Amazon_Model_List_Amazon_Order */
/* @var $aOrder array */
 if (!class_exists('ML', false))
     throw new Exception();

$fulfillment = $aOrder['FulfillmentChannel'];

if ($fulfillment !== 'MFN-Prime' && $fulfillment !== 'MFN' && $fulfillment !== 'Business') {
    $sLogo = 'amazon_fba_orderview';
} else {
    $suffix = '';
    if ($fulfillment === 'MFN-Prime') {
        $suffix = '_prime';
        if (isset($aOrder['ShipServiceLevel'])) {
            $sShipServiceLevel = $aOrder['ShipServiceLevel'];
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
    }

    $sLogo = 'amazon_orderview'.$suffix;
}

echo '<img src="'.MLHttp::gi()->getResourceUrl('images/logos/'.$sLogo.'.png').'" alt="'.$aOrder['FulfillmentChannel'].'">';

echo ' '.$aOrder['AmazonOrderID'];