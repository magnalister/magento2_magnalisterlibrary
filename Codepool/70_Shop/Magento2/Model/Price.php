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

class ML_Magento2_Model_Price extends ML_Shop_Model_Price_Abstract implements ML_Shop_Model_Price_Interface {
    /**
     * @TODO check why blConvert is not used as expected like on Prestashop (converting the price using the rates)
     *  In Magento 1 the difference is the showing and hiding the HTML tags
     * @param float $fPrice
     * @param string $sCode
     * @param bool $blConvert
     * @return float|string
     * @throws Exception
     */
    public function format($fPrice, $sCode, $blConvert = true) {

        if (!isset($sCode) || $sCode == null) {
            throw new Exception("the sCode should not be empty");
         }

        if (!$blConvert) {
            $mPrice = MLMagento2Alias::ObjectManagerProvider('\Magento\Framework\Locale\CurrencyInterface')
                ->getCurrency($sCode)
                ->toCurrency($fPrice);
        } else {
            $mPrice = MLMagento2Alias::ObjectManagerProvider('\Magento\Directory\Model\Currency')->load($sCode)->format($fPrice);
        }
        return $mPrice;
    }
}
