<?php
/**
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
 * $Id$
 *
 * (c) 2010 - 2015 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLFilesystem::gi()->loadClass('Productlist_Controller_Widget_ProductList_Selection');
class ML_Amazon_Controller_Amazon_ShippingLabel_Upload_ShippingMethod extends ML_Core_Controller_Abstract {
 
    protected $aParameters = array('controller');
    /**
     * @var ML_Amazon_Model_List_Amazon_Order_ShippingMethod
     */
    protected $oList=null;

    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_Amazon_Shippinglabel_Upload_Shippingmethod');
    }
    
    public static function getTabActive() {
        return MLModule::gi()->isConfigured();
    }
    
    public static function getTabDefault() {
        return false;
    }

    protected function getOrderlist(){
        if ($this->oList === null) {
            $this->oList = ML::gi()->instance('model_list_amazon_order_shippingmethod'); 
            $this->oList->setSelectionName($this->getSelectionName());
        }
        return $this->oList;
       
    }
    
    public function __construct() {
        parent::__construct();
        $this->saveData();
        $this->getOrderlist(); 
    }
    
    /**
     * includes View/widget/orderlist.php
     */
    public function getOrderListWidget() {        
        $oList = $this->getOrderlist();
        $this->includeView('widget_list_order', array('oList' => $oList, 'aStatistic' => array()));
    }
    
    protected function saveData() {
        if($this->getRequest('weight')!== null){
            $aOrders = array();
            foreach(array(
                'Length',
                'Width',
                'Height',
                ) as $sDimention){

                foreach ($this->getRequest(strtolower($sDimention)) as $sOrderId => $sValue){
                    $aOrders[$sOrderId]['PackageDimensions'][$sDimention] = (float)$sValue;
                }
            }
            foreach ($this->getRequest('weight') as $sOrderId => $sValue){
                    $aOrders[$sOrderId]['Weight']['Value']= (float)$sValue;
                $aOrders[$sOrderId]['Weight']['Unit'] = MLModule::gi()->getConfig('shippinglabel.weight.unit');
                    $aOrders[$sOrderId]['AmazonOrderId'] = $sOrderId;
            }
            
            foreach ($this->getRequest('date') as $sOrderId => $sValue){
                    $aOrders[$sOrderId]['ShippingDate']= $sValue;
            }
            foreach ($this->getRequest('ItemList') as $sOrderId => $aItems){
                foreach ( $aItems as $sSku => $iQuantity){
                    $aOrders[$sOrderId]['ItemList'][] = array(
                        'OrderItemId'=> $sSku,//todo here we should have orderitemid instead of sku
                        'Quantity'=> (float)$iQuantity,
                    );
                }
            }
            
            foreach ($this->getRequest('deliveryexperience') as $sOrderId => $aItems){
                $aOrders[$sOrderId]['ShippingServiceOptions']["DeliveryExperience"] = $aItems ;
            }
            foreach ($this->getRequest('carrierwillpickup') as $sOrderId => $aItems){
                $aOrders[$sOrderId]['ShippingServiceOptions']["CarrierWillPickUp"] =  $aItems == 'true';
            }
            
            foreach ($this->getRequest('addressfrom') as $sOrderId => $iAddressId){
                $aOrders[$sOrderId]["ShipFromAddress"] = $this->getAddressById($iAddressId);
            }
            
            $oSelection = MLDatabase::factory('globalselection');
            foreach ($aOrders as $sOrderId => $aData){
                    $oSelection->init()->set('elementId', $sOrderId)
                             ->set('selectionname', $this->getSelectionName());
                    $aOrderData = $oSelection->get('data');
                    $aData['globalinfo'] = $aOrderData['globalinfo'];
                    $oSelection->set('elementId', $sOrderId)
                            ->set('data', $aData)
                            ->save();
            }
        }else{
            $oSelection = MLDatabase::factory('globalselection');
            foreach ($aOrders as $sOrderId => $aData){
                    $oSelection->init()->set('selectionname', $this->getSelectionName())->set('elementId', $sOrderId);
                    $aOrderData = $oSelection->get('data');
                    if(!isset($aOrderData['Weight'])){
                        MLHttp::gi()->redirect($this->getParentUrl().'_form');
                    }
            }
            
        }
        
        return $this;
    } 
    
    
    public function getAddressById($iAddressId) {
        $aAddress = array();
        $aConfigAddress = MLModule::gi()->getOneFromMultiOptionConfig('shippinglabel.address', $iAddressId);

        if (empty($aConfigAddress['name'])) {
            $aAddress["Name"] = $aConfigAddress['company'];
        } else {
            $aAddress["Name"] = $aConfigAddress['name'];
        }

        if (!empty($aConfigAddress['company']) && ($aConfigAddress['company'] != $aConfigAddress['name'])) {
            $aAddress["AddressLine1"] = $aConfigAddress['company'];
            $aAddress["AddressLine2"] = $aConfigAddress['streetandnr'];
        } else {
            $aAddress["AddressLine1"] = $aConfigAddress['streetandnr'];
        }

//        $aAddress["_DistrictOrCounty"] = $aConfigAddress['state'];
        $aAddress["Email"] = $aConfigAddress['email'];
        $aAddress["City"] = $aConfigAddress['city'];
//        $aAddress["_StateOrProvinceCode"] = $aConfigAddress['state'];
        $aAddress["PostalCode"] = $aConfigAddress['zip'];
        $aAddress["CountryCode"] = $aConfigAddress['country'];
        $aAddress["Phone"] = $aConfigAddress['phone'];
        return $aAddress;
    }

    public function isSelectable() {
        return true;
    }
    
    public function showPagination() {
        return false;
    }
    
    protected function getSelectionName(){
        return 'amazon_shippinglabel_orderlist';
    }
    
    public function render() {
        $this->getOrderListWidget(); 
    }
}