<?php
/**
 * Discribes an interface for anything related to calculate prices.
 */
interface ML_Shop_Model_Price_Interface {
    /**
     * Renders a price with its currency code.
     *
     * @param float $fPrice
     * @param string $sCode
     * @param bool $blConvert sometime we don't need to convert price
     * @return string
     */
    public function format($fPrice, $sCode, $blConvert = true);
    
    /**
     * Calculates missing percentages.
     * Minimum 2 parameters must be set, the third one will be returned.
     * If all 3 parameters are set, verify that all values are correct.
     *
     * @param float $fBrut
     * @param float $fNet
     * @param float $fPercent 10(%)
     * @return mixed
     *    Returns a boolean if all 3 parameters have been set.
     *        true: All parameters are correct, false otherwise.
     *    Returns a float if a missing parameter has been calculated.
     *
     * @throws Exception
     *    In case parameters paramets are missing
     */
    public function calcPercentages($fBrut = null, $fNet = null, $fPercent = null);
    
    /**
     * Sets the config values to calculate the prices based on the saved
     * settings.
     *
     * @param string $sKind
     *    Surcharge kind (e.g. fixed or percentage)
     * @param float $fFactor
     *    Surcharge factor
     * @param int $iSignal
     *    Defines the decimal places for the price, eg always x.99
     * @param string $sGroup
     *    The customer group which should be used to load the price from.
     * @param bool $blSpecial
     *    Use the special price if available
     *
     * @return self
     */
    public function setPriceConfig($sKind, $fFactor, $iSignal, $sCustomerGroup, $blSpecial, $fTax = null);
    
    /**
     * Gets the current applied price config.
     * 
     * @return array
     *    An array containing the keys:
     *        kind, factor, signal, group and special
     *    For their meanings @see self::setPriceConfig
     */
    public function getPriceConfig();

}
