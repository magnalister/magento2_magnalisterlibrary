<?php
abstract class ML_Shop_Model_Currency_Abstract {
    
    /**
     * array(
     *  'EUR' = array (
     *      'title' => 'Euro',
     *      'symbol_left' => '',
     *      'symbol_right' => '€',
     *      'decimal_point' => '.',
     *      'thousands_point' => '',
     *      'decimal_places' => 2,
     *      'value' => 1
     *  ),
     * )
     * 
     * @return array 
     */
    abstract public function getList();
    
    /**
     * @return string len(3) 
     */
    abstract public function getDefaultIso();
    /**
     * 
     * @param string $sCurrency iso-code of currency to update
     * @return ML_Shop_Model_Currency_Abstract
     */
    abstract public function updateCurrencyRate($sCurrency);
}