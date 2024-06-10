<?php

MLFilesystem::gi()->loadClass('Magento2_Model_ProductList_Abstract');
abstract class ML_Magento2_Model_ProductList_UploadAbstract extends ML_Magento2_Model_ProductList_Abstract {

    protected $iFrom=0;
    protected $iCount=5;
    protected $aList = null;
    protected $blAdditemMode = false;
    protected $iCountTotal;

    public function setAdditemMode($blMode){
        $this->blAdditemMode = $blMode;
        return $this;
    }

    public function getList() {
        if($this->blAdditemMode){
            if ($this->aList === null) {
                $aData = $this->getAdditemListData($this->iFrom, $this->iCount);
                $this->aList = $aData['List'];
                $this->iCountTotal = $aData['CountTotal'];
            }
            $aList = new ArrayIterator($this->aList);
        }else{
            $aList = parent::getList();
        }
        return $aList;
    }

    public function setLimit($iFrom, $iCount){
        if($this->blAdditemMode){
            $this->iFrom=(int)$iFrom;
            $this->iCount=((int)$iCount>0)?((int)$iCount):5;
            return $this;
        } else {
            return parent::setLimit($iFrom, $iCount);
        }
    }

    public function getStatistic() {
        if($this->blAdditemMode){
            $this->getList();
            $aOut= array(
                'iCountPerPage'=>$this->iCount,
                'iCurrentPage'=>$this->iFrom/$this->iCount,
                'iCountTotal'=>$this->iCountTotal,
                'aOrder'=>array(
                    'name'=>'',
                    'direction'=>''
                )
            );
            return $aOut;
        } else {
            return parent::getStatistic();
        }
    }

    public function getMasterIds($blPage = false) {
        if($this->blAdditemMode) {
            $this->getList();
            return array_keys($this->aList);
        } else {
            return parent::getMasterIds($blPage);
        }
    }



    protected function executeFilter(){
         $this->oFilter
            ->registerDependency('searchfilter')
            ->limit()
            ->registerDependency('selectionstatusfilter', array('selectionname' => $this->getSelectionName()))
            ->registerDependency('categoryfilter')
            ->registerDependency('preparestatusfilter', array('blPrepareMode' => false))
            ->registerDependency('lastpreparedfilter')
            ->registerDependency('productstatusfilter', array('blPrepareMode' => false))
            ->registerDependency('manufacturerfilter')
            ->registerDependency('producttypefilter');

        return $this;
    }

    public function getSelectionName() {
        return 'checkin';
    }

    public function variantInList(ML_Shop_Model_Product_Abstract $oProduct) {
        if($this->blAdditemMode) {
            return MLDatabase::factory('selection')->loadByProduct($oProduct, 'checkin')->get('expires') === null ? false : true;
        }else{
            return parent::variantInList($oProduct);
        }
    }
}
