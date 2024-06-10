<?php
class ML_Modul_Exception_Model_Service_ImportOrders_OrderExist extends Exception{
    protected $sShopOrder = null;
    public function __construct($message, $code, $previous) {
        parent::__construct('Order Exist');
    }
    public function getShopOrder(){
        return $this->sShopOrder;
    }
    public function setShopOrder($sId){
        $this->sShopOrder=$sId;
        return $this;
    }
}