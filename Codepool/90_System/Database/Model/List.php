<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of List
 *
 * @author mba
 */
class ML_Database_Model_List {
    /**
     *
     * @var ML_Database_Model_Table_Abstract $oModel
     */
    protected $oModel=null;
    /**
     * @var ML_Database_Model_Query_Select $oSelection
     */
    protected $oSelection=null;
    protected $aList=array();
    protected $iCountTotal=0;
    protected $sOrder='';
    public function __construct(){
        $this->init();
    }
    public function init(){
        $this->reset();
        $this->oSelection = MLDatabase::factorySelectClass();
        return $this;
    }
    public function setModel(ML_Database_Model_Table_Abstract $oModel){
        $this->init();
        $this->oModel=$oModel;
        $this->oSelection
            ->init()
            ->select('*')
            ->from($this->oModel->getTableName())
        ;
        $aData=$this->oModel->data(false);
//        $aCols=$oModel->getTableInfo();
//        array_change_key_case($aCols);
//        foreach(array_keys($aData) as $sData ){
//            if(!array_key_exists(strtolower($sData),$aCols)){
//                unset($aData[$sData]);
//            }
//        }
        if(count($aData)>0){
            $this->oSelection->where($aData);
        }
        if($this->sOrder!=''){
            $this->oSelection->orderBy($this->sOrder);
        }
        return $this;
    }
    public function getModel(){
        return $this->oModel;
    }
    /**
     * 
     * @return ML_Database_Model_Query_Select
     */
    public function getQueryObject(){
        return $this->oSelection;
    }
    public function reset(){
        if($this->oSelection!==null){
            $this->oSelection->reset();
        }
        $this->aList=array();
        $this->iCountTotal=0;
        return $this;
    }
    public function setOrder($sOrder){
        $this->sOrder=$sOrder;
        return $this;
    }
    /**
     * builds and executes query(s)
     * @uses Reflection
     * @return \ML_Database_Model_List
     */
    protected function execute(){
        if(count($this->aList)==0){
            $this->iCountTotal=  $this->oSelection->getCount(true);
            foreach ($this->oSelection->getResult() as $aRow) {
                $this->add($aRow);
            }
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getList(){
        return $this->execute()->aList;
    }

    public function getByKey($sKey){
        $this->execute();
        if(isset($this->aList[$sKey])){
            return $this->aList[$sKey];
        }else{
            throw new Exception('`'.$sKey.'` not exist.');
        }
    }
    public function getCountTotal(){
        return $this->execute()->iCountTotal;
    }
    public function get($sName, $blDistinct=false){
        $aOut=array();
        $aData=array();
        foreach($this->getList() as $oTable){
            $aData[$this->calcListKey($oTable)]=$oTable->get($sName);
        }
        if($blDistinct){
            $aCompare= array();
            foreach($aData as $sKey=>$mValue){
                $sSerialized=  serialize($mValue);
                if(!in_array($sSerialized, $aCompare)){
                    $aOut[$sKey]=$mValue;
                    $aCompare[]=$sSerialized;
                }
            }
        }else{
            $aOut=$aData;
        }
        return $aOut;
    }
    public function delete(){
        foreach($this->getList() as $oTable){
            $oTable->delete();
        }
        $this->reset();
        return $this;
    }
    public function add($aArray){
        $sClass = get_class($this->oModel);
        $oTable = new $sClass;
        $aData=array_merge($this->oModel->data(false),$aArray);
        foreach($aData as $sKey=>$sValue){
            $oTable->set($sKey,$sValue);
        }
        $this->aList[$this->calcListKey($oTable)]=$oTable;
        return $this;
    }
    public function save(){
        foreach($this->getList() as $oTable){
            /** @var $oTable ML_Database_Model_Table_Abstract */
            $oTable->save();
        }
        return $this;
    }
    public function data(){
        $aData=array();
        foreach($this->getList() as $oTable){
            $aData[$this->calcListKey($oTable)]=$oTable->data();
        }
        return $aData;
    }
    public function set($sKey, $mValue){
        foreach($this->getList() as $oTable){
            $oTable->set($sKey, $mValue);
        }
        return $this;
    }

    /**
     * @todo here we should "new $this->oModel" instead of "$this->oModel", if key of existing object was filled, getMissingKeys will return empty array, but it is global, it should be tested carefully
     * @param $oTable
     * @return string
     */
    protected function calcListKey($oTable){
        $aKeys=$this->oModel->getMissingKeys();
        $sVector='';
        foreach($aKeys as $sKey){
            $sVector.='['.$oTable->get($sKey).']';
        }
        return $sVector;
    }
}