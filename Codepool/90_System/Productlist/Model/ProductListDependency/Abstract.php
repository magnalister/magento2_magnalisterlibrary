<?php
abstract class ML_Productlist_Model_ProductListDependency_Abstract {
    
    /**
     * value to filter
     * @var string $sFilterValue
     */
    protected $sFilterValue = null;
    
    /**
     * Configuration for dependency, so behavior can controlled from extern
     * @var array $aConfig
     */
    protected $aConfig = array();
    
    /**
     * sets the current value for filter products
     * @param string $sValue
     */
    public function setFilterValue ($sValue) {
        $this->sFilterValue = $sValue;
        return $this;
    }
    
    /**
     * return current value for filter products
     * @return string
     */
    public function getFilterValue () {
        return $this->sFilterValue;
    }
    
    /**
     * render current filter form-field
     * @param ML_Core_Controller_Abstract $oController
     * @param string $sFilterName
     * @return string rendered HTML
     */
    public function renderFilter (ML_Core_Controller_Abstract $oController, $sFilterName) {
        return '';
    }
    
    /**
     * change default-config 
     * @param array $aConfig
     * @return \ML_Productlist_Model_ProductListDependency_Abstract
     */
    public function setConfig ($aConfig) {
        $this->aConfig = array_merge ($this->aConfig, $aConfig);
        return $this;
    }
    
    /**
     * getConfig value
     * @param string $sName
     * @return mixed
     */
    public function getConfig ($sName) {
        return isset($this->aConfig[$sName]) ? $this->aConfig[$sName] : null;
    } 
    
    /**
     * check if variant is in filter or not
     * @param ML_Shop_Model_Product_Abstract $oProduct
     * @return boolean
     */
    public function variantIsActive (ML_Shop_Model_Product_Abstract $oProduct) {
        return true;
    }
    
    /**
     * returns array with in or not in ident-type query-values
     * @return array array('in' => (array||null), 'notIn' => (array||null)) if null, filter-part is not active
     */
    public function getMasterIdents () {
        return array('in' => null, 'notIn' => null);
    }
    
    /**
     * manipulates sql-query $mQuery. $mQuery is completelyshopspecific, so take shure, its correct type.
     * @param mixed $mQuery shopsystemspecific
     * @return mixed shopsystemspecific
     */
    public function manipulateQuery ($mQuery) {
        return $mQuery;
    }
    
    /**
     * dependency can do stuff via ajax
     * @return $this 
     */
    public function callAjax() {
        return $this;
    }
    
}
