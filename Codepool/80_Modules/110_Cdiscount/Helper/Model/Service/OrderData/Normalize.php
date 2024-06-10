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

MLFilesystem::gi()->loadClass('Modul_Helper_Model_Service_OrderData_Normalize');

class ML_Cdiscount_Helper_Model_Service_OrderData_Normalize extends ML_Modul_Helper_Model_Service_OrderData_Normalize {

    protected $oModul = null;

    protected function getModul() {
        if($this->oModul === null ){
            $this->oModul = MLModule::gi();
        }

        return $this->oModul;
    }
    
    protected function getShippingCode($aTotal) {
        $sShippingMethod = $this->getModul()->getConfig('orderimport.shippingmethod');
        if (!empty($sShippingMethod)) {
            if ('textfield' == $sShippingMethod) {
               $sShipping = $this->getModul()->getConfig('orderimport.shippingmethod.name');
                return $sShipping == '' ? MLModule::gi()->getMarketPlaceName() : $sShipping;
            }

            return $sShippingMethod;
        }

        return MLModule::gi()->getMarketPlaceName();
    }

}
