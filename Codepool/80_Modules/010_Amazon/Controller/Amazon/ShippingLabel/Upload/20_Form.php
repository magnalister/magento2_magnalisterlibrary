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
MLFilesystem::gi()->loadClass('Core_Controller_Abstract');
class ML_Amazon_Controller_Amazon_ShippingLabel_Upload_Form extends ML_Core_Controller_Abstract {

    protected $aParameters = array('controller');
    /**
     * @var ML_Amazon_Model_List_Amazon_Order_Form
     */
    protected $oList=null;

    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_Amazon_Shippinglabel_Upload_Form');
    }
    
    public static function getTabActive() {
        return MLModule::gi()->isConfigured();
    }

    public static function getTabDefault() {
        return false;
    }

    protected function getOrderlist(){
        if ($this->oList === null) {
            $this->oList = ML::gi()->instance('model_list_amazon_order_form');
            $this->oList->setSelectionName($this->getSelectionName());
        }
        return $this->oList;
       
    }
    
    public function __construct() {
        parent::__construct();
        $this->getOrderlist(); 
    }
    
    /**
     * includes View/widget/orderlist.php
     */
    public function getOrderListWidget() {        
        $oList = $this->getOrderlist();
        $this->includeView('widget_list_order', array('oList' => $oList, 'aStatistic' => array()));
    }
    
    protected function getSelectionName(){
        return 'amazon_shippinglabel_orderlist';
    }
    
    public function isSelectable() {
        return false;
    }
    
    public function showPagination() {
        return false;
    }
    
    public function render() {
        $this->getOrderListWidget(); 
    }

}