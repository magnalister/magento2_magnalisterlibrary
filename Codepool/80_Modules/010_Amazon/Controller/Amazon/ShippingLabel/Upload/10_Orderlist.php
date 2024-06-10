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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

class ML_Amazon_Controller_Amazon_ShippingLabel_Upload_Orderlist  extends ML_Core_Controller_Abstract {

    protected $aParameters = array('controller');
    /**
     * @var ML_Amazon_Model_List_Amazon_Order
     */
    protected $oList = null;
    
    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_Amazon_Shippinglabel_Upload_Orderlist');
    }
      
    public static function getTabActive() {
        return MLModule::gi()->isConfigured();
    }

    public static function getTabDefault() {
        return true;
    }

    /**
     * sets productlist filter by request or session
     * save possible filters to session
     * @return $this
     */
    protected function setFilter() {
        $aRequestFilter = MLRequest::gi()->data('filter');
        $sIdent = MLModule::gi()->getMarketPlaceId() . '_' . $this->getIdent();
        $aFilters = array();
        if ($aRequestFilter !== null) {
            $aFilters[$sIdent] = $aRequestFilter;
        }
        $aSessionFilter = MLSession::gi()->get('AMAZONOERDERLIST__filter.json');
        if (is_array($aSessionFilter)) {
            foreach ($aSessionFilter as $sController => $aFilter) {
                unset($aFilter['meta']);
                if (substr($sIdent, 0, strlen($sController)) == $sController && !isset($aFilters[$sController])) {
                    $aFilters[$sController] = $aFilter;
                }
                if (
                        (
                        $aRequestFilter === null ||
                        count($aRequestFilter) == 1 && isset($aRequestFilter['meta'])
                        ) && $sController == $sIdent
                ) {
                    if (isset($aRequestFilter['meta'])) {
                        $aFilter['meta'] = $aRequestFilter['meta'];
                    }
                    $aRequestFilter = $aFilter;
                }
            }
        }
        MLSession::gi()->set('AMAZONOERDERLIST__filter.json', $aFilters);
        $this->getOrderlist()->setFilters($aRequestFilter);
        return $this;
    }

    protected function getOrderlist(){
        if ($this->oList === null) {
            $this->oList = ML::gi()->instance('model_list_amazon_order');
            $this->oList->setSelectionName($this->getSelectionName());
        }
        return $this->oList;
       
    }
    
    public function __construct() {
        parent::__construct();
        $this->getOrderlist(); 
        $this->setFilter();
        
        $aFilter = MLRequest::gi()->data('filter');
        if (isset($aFilter['meta']['selection'])) {
            $aSelection = explode('_', $aFilter['meta']['selection']);
            if (count($aSelection) == 2) {
                if ($aSelection[1] == 'page') {
                    $aIds = $this->getOrderlist()->getOrdersIds(true); 
                    if (MLHttp::gi()->isAjax()) {
                        MLSetting::gi()->add('aAjax', array('Redirect' => $this->getCurrentUrl())); 
                    }
                } elseif ($aSelection[1] == 'filter') {
                    if (MLHttp::gi()->isAjax()) {
                        $aStatistic = $this->getOrderlist()->getStatistic();
                        $iFrom = 0;
                        $iCount = 5;
                         if (MLRequest::gi()->data('selectionlimit') !== null) {
                             list($iFrom,$iCount) = explode('_', MLRequest::gi()->data('selectionlimit'));
                         }
                         if( $aStatistic['iCountTotal'] > $iCount && $aStatistic['iCountTotal']  > $iFrom ){
                                MLSetting::gi()->add('aAjax', array('Next' => $this->getCurrentUrl(array(                         
                                   'filter' => $aFilter ,
                                   'selectionlimit' => ($iFrom + $iCount)."_". $iCount , 
                               ))));
                         }else{                                                                
                            MLSetting::gi()->add('aAjax', array('Redirect' => $this->getCurrentUrl())); 
                         }
                        $aIds = $this->getOrderlist()->setLimit($iFrom,$iCount)->getOrdersIds(true);
                    }else{
                        $aIds = $this->getOrderlist()->getOrdersIds();
                    }
                } else {
                    $aIds = null;                    
                    if (MLHttp::gi()->isAjax()) {
                        MLSetting::gi()->add('aAjax', array('Redirect' => $this->getCurrentUrl())); 
                    }
                }
                if ($aSelection[0] == 'sub') {//delete, we dont need to check article for errors   
                    $this->deleteOrdersFromSelection($aIds);   
                }elseif ($aIds !== null) {// have ids but no (delete)query => add items
                    $this->addOrderToSelection($aIds);
                }
            }
        }
    }
    
    /**
     * includes View/widget/orderlist.php
     */
    public function getOrderListWidget() {        
        $oList = $this->getOrderlist();
        $aDependencies = array();
        foreach ($oList->getFilters() as $oFilter) {
            if (is_object($oFilter)) {
                $aDependencies[get_class($oFilter)] = $oFilter->getFilterValue();
            }
        }
        $aStatistic = $oList->getStatistic();
        $this->includeView('widget_list_order', array('oList' => $oList, 'aStatistic' => $aStatistic));
    }

    /**
     * gets form action for each row
     * @param $aOrder array  
     * @return string url
     */
    public function getRowAction($aOrder) {
        return $this->getCurrentUrl(array('ajax' => true, 'mlorderid' => $aOrder['AmazonOrderID']));
    }
    
    protected function getSelectedCount () {
        return MLDatabase::factory('globalselection')->set('selectionname', $this->getSelectionName())->getList()
                        ->getQueryObject()
                        ->getCount()
        ;
    }
        
    protected function callAjaxDeleteFromSelection() {
        $iOrderId =  MLRequest::gi()->get('mlorderid');
        $this->deleteOrdersFromSelection(array($iOrderId));
        $this->includeView('widget_list_order_action_selection_selectionoption', array(
            'sName' => MLI18n::gi()->get(
                'Productlist_Cell_aToMagnalisterSelection_selectedArticlesCountInfo', 
                 array('count' => $this->getSelectedCount())
            )
        ));
        return $this;
    }
    
    protected function callAjaxAddToSelection() {
        
        $iOrderId =  MLRequest::gi()->get('mlorderid');
        $aData = $this->getRequest('selection');
        $this->addOrderToSelection(array($iOrderId), isset($aData['data']) && is_array($aData['data']) ? $aData['data'] : array());
        
        $this->includeView('widget_list_order_action_selection_selectionoption', array(
            'sName' => MLI18n::gi()->get(
                'Productlist_Cell_aToMagnalisterSelection_selectedArticlesCountInfo', 
                 array('count' => $this->getSelectedCount())
            )
        ));
        return $this;
    }
    
    /**
     * @param array $aOrders 
     * @param array $aData data-field of selection
     * @return \ML_Amazon_Controller_Amazon_ShippingLabel_Upload_Orderlist
     */
    protected function addOrderToSelection($aOrders, $aData = array()) {
        $oSelection = MLDatabase::factory('globalselection');
        foreach ($aOrders as $sOrder) {
            $oSelection->init()
                    ->set('selectionname', $this->getSelectionName())
                    ->set('elementId', $sOrder)
                    ->set('data', $aData)
                    ->save();
        }
        return $this;
    }
    
    /**
     * @param array $aOrders 
     * @param null $aOrders delete complete selection
     * @return \ML_Amazon_Controller_Amazon_ShippingLabel_Upload_Orderlist
     */
    protected function deleteOrdersFromSelection($aOrders=array()) {
        $oQuery =
            MLDatabase::factory('globalselection')->getList()
            ->getQueryObject()
        ;
        if (!empty($aOrders)) {// we dont care of master or variant just delete from selection
            $oQuery->where( "selectionname= '".$this->getSelectionName()."' ")
                    ->where("elementId in ('".implode("', '",$aOrders)."')");
        }
        MLMessage::gi()->addDebug(sprintf(MLI18n::gi()->get('Productlist_Message_sDeleteProducts'), $oQuery->doDelete()));
        MLMessage::gi()->addDebug($aOrders);
        return $this;
    }
    
    public function render() {
        $this->getOrderListWidget(); 
    }
    
    public function isSelectable() {
        return true;
    }
    
    public function showPagination() {
        return true;
    }
    
    protected function getSelectionName(){
        return 'amazon_shippinglabel_orderlist';
    }    
}
