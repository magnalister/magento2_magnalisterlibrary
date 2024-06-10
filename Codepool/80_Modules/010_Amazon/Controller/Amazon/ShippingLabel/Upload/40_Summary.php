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

class ML_Amazon_Controller_Amazon_ShippingLabel_Upload_Summary extends ML_Core_Controller_Abstract {

    protected $aParameters = array('controller');

    /**
     * @var ML_Amazon_Model_List_Amazon_Order_Summary
     */
    protected $oList = null;

    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_Amazon_Shippinglabel_Upload_Summary');
    }

    public static function getTabActive() {
        return MLModule::gi()->isConfigured();
    }

    public static function getTabDefault() {
        return false;
    }

    protected function callAjaxConfirmShipping() {
        $iRemainingItemCount = $this->getSelectedCount();
        if ($iRemainingItemCount) {
            $sMessage = '';
            $oService = ML::gi()->instance('model_service_shipping');
            $iOffset = $this->getRequest('offset');
            $iOffset = ($iOffset === null) ? 0 : $iOffset;
            /* @var $oService ML_Amazon_Model_Service_Shipping */
            $oSelection = MLDatabase::factory('globalselection')
                            ->set('selectionname', $this->getSelectionName())->getList();
            $iTotalCount = $oSelection->getQueryObject()->getCount();
            $blSuccess = $iTotalCount == $iOffset+1;
            $oSelection->getQueryObject()->limit($iOffset, 1);
            $oService
                    ->setOrders($oSelection->getList())
                    ->confirmShipping();
            if ($blSuccess) {
                $oSelection = MLDatabase::factory('globalselection')->set('selectionname', $this->getSelectionName())->getList();
                $sMessage = $oService
                        ->setOrders($oSelection->getList())
                        ->downloadShippingLabel();
//                delete current selection when all data is submited
                foreach ($oSelection->getList() as $oOrder) {
                    $oOrder->delete();
                }
                
                $sMessage = '<a href="'.$sMessage.'" target="_blank" class="ml-downloadshippinglabel mlbtn action right" style="display: none;"> </a>';
            }
            MLSetting::gi()->add(
                    'aAjax', array(
                        'message'=> $sMessage,
                        'success' => $blSuccess,
                        'error' => $oService->haveError(),
                        'offset' => $iOffset + 1,
                        'info' => array(
                            'total' => $iTotalCount,
                            'current' => $iOffset + 1
                        ),
                    )
            );
        }
    }

    protected function getSelectedCount() {
        return MLDatabase::factory('globalselection')->set('selectionname', $this->getSelectionName())->getList()
                        ->getQueryObject()
                        ->getCount()
        ;
    }

    protected function getOrderlist() {
        if ($this->oList === null) {
            $this->oList = ML::gi()->instance('model_list_amazon_order_summary');
            $this->oList->setSelectionName($this->getSelectionName());
        }
        return $this->oList;
    }

    protected function saveData() {
        $oSelection = MLDatabase::factory('globalselection');
        foreach (MLRequest::gi()->get('shippingserviceid') as $sOrderId => $aShippingService) {
            $aShippingServiceInfo = json_decode($aShippingService, true);
            $oSelection->init()->set('selectionname', $this->getSelectionName())
                    ->set('elementId', $sOrderId);
            $aData = $oSelection->get('data');
            $aData['ShippingServiceId'] = $aShippingServiceInfo['ShippingServiceId'];
            $aData['globalinfo']['shippingservice'] = $aShippingServiceInfo;
            $oSelection->set('elementId', $sOrderId)
                    ->set('data', $aData)
                    ->save();
        }
    }

    /**
     * includes View/widget/orderlist.php
     */
    public function getOrderListWidget() {
        $oList = $this->getOrderlist();
        $this->includeView('widget_list_order', array('oList' => $oList, 'aStatistic' => array()));
    }

    public function getRowAction() {
        return '';
    }

    public function render() {
        $this->saveData();
        $this->getOrderlist();
        $this->getOrderListWidget();
    }

    public function isSelectable() {
        return false;
    }

    public function showPagination() {
        return false;
    }

    protected function getSelectionName() {
        return 'amazon_shippinglabel_orderlist';
    }

}
