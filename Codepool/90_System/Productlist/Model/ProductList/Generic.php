<?php
class ML_Productlist_Model_ProductList_Generic extends ML_Productlist_Model_ProductList_Abstract {
    protected $aVariants=array();
    public function addVariant(ML_Shop_Model_Product_Abstract $oProduct){
        $this->aVariants[$oProduct->get('id')]=$oProduct;
        return $this;
    }
    public function additionalRows(ML_Shop_Model_Product_Abstract $oProduct) {
        throw new Exception('Method `'.__method__.'` not implemented.');
    }

    public function getFilters() {
        throw new Exception('Method `'.__method__.'` not implemented.');
        
    }

    public function getHead() {
        throw new Exception('Method `'.__method__.'` not implemented.');
        
    }

    public function getList() {
        $aMaster=array();
        foreach($this->aVariants as $oVariant){
            if (!array_key_exists($oVariant->get('parentid'), $aMaster)) {
                $aMaster[$oVariant->get('parentid')]=  MLProduct::factory()->set('id',$oVariant->get('parentid'))->load();
            }
        }
        return new ArrayIterator($aMaster);
        
    }

    public function getMixedData(ML_Shop_Model_Product_Abstract $oProduct, $sKey) {
        throw new Exception('Method `'.__method__.'` not implemented.');
        
    }
    public function getMasterIds($blPage = false) {
        $aIds=array();
        foreach ($this->aVariants as $oVariant) {
            if(!in_array($oVariant->get('parentid'), $aIds)){
                $aIds[] = $oVariant->get('parentid');
            }
        }
        return $aIds;
    }

    public function getStatistic() {
        throw new Exception('Method `'.__method__.'` not implemented.');
        
    }

    public function setFilters($aFilter) {
        throw new Exception('Method `'.__method__.'` not implemented.');
        
    }

    public function setLimit($iFrom, $iCount) {
        throw new Exception('Method `'.__method__.'` not implemented.');
        
    }

    public function variantInList(ML_Shop_Model_Product_Abstract $oProduct) {
        return array_key_exists($oProduct->get('id'), $this->aVariants);
        
    }
    public function isSelected(ML_Shop_Model_Product_Abstract $oProduct){
        return true;//variants are given by "hand"
    }
}