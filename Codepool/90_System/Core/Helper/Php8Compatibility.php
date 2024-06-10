<?php
/**
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
 * $Id$
 *
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

/**
 * Making changes on methods that are deprecated on PHP 8.1
 */
class ML_Core_Helper_Php8Compatibility {

    public function htmlspecialcharsDecode($sValue) 
    {
        if (!is_null($sValue)) {
            return htmlspecialchars_decode($sValue);
        }

        return '';
    }

    public function checkNull($sValue) {
        if (is_null($sValue)) {
            return '';
        }

        return $sValue;
    }

    public function restrictToString($sValue) {
        if (is_string($sValue)) {
            return $sValue;
        } else if (is_array($sValue)) {
            return json_encode($sValue);
        }
        MLMessage::gi()->addDebug('value is not string'.':'.microtime(true), array('value is not string' => $sValue));
        return '';
    }
}
