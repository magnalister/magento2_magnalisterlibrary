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

class ML_Amazon_Model_List_Amazon_Order_ShippingMethod {

    protected $aList = null;
    protected $sSelectionName;

    public function getList() {
        if ($this->aList === null) {
            $oService = ML::gi()->instance('model_service_shipping');
            /* @var $oService ML_Amazon_Model_Service_Shipping */
            $oSelection = MLDatabase::factory('globalselection')->set('selectionname', $this->getSelectionName())->getList();
            $oService->setOrders($oSelection->getList());
            $this->aList = $oService->getShippingService();
        }
        return $this->aList;
    }

    public function setSelectionName($sSelectionName) {
        $this->sSelectionName = $sSelectionName;
    }

    public function getSelectionName() {
        return $this->sSelectionName;
    }

    public function getOrdersIds() {
        $mlOrdersIds = array();
        foreach ($this->getList() as $aOrder) {
            $mlOrdersIds[] = $aOrder['AmazonOrderID'];
        }
        return $mlOrdersIds;
    }

    public function getHead() {
        $aHead = array();
        $aHead['CarrierName'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Form_CarrierName'),
            'type' => 'carriername'
        );
        $aHead['ShippingServiceName'] = array(
            'title' => MLI18n::gi()->get('ML_LABEL_MARKETPLACE_SHIPPING_METHOD'),
            'type' => 'servicename'
        );
        $aHead['DeliveryTime'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Shippinmethod_DeliveryTime'),
            'type' => 'deliverytime'
        );
        $aHead['Amount'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Shippinmethod_Amount'),
            'type' => 'price'
        );
        $aHead['Comment'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Shippinmethod_Comment'),
            'type' => 'comment',
        );
        return $aHead;
    }
}
