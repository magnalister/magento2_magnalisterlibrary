<?php
abstract class ML_Shop_Model_Language_Abstract {
    /**
     * @return ISO2Code 
     */
    abstract public function getCurrentIsoCode();
    /**
     * @reurn currentcharset eg UTF-8
     */
    abstract public function getCurrentCharset();
}
