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

class ML_Amazon_Model_List_Amazon_Order {

    protected $aList = array();
    protected $iCountTotal = 0;
    protected $aMixedData = array();
    protected $iFrom = 0;
    protected $iCount = 5;
    protected $sOrder = '';
    protected $sSearch = '';
    protected $sStatus = 'all';
    protected $sFulfillmentChannel = 'all';
    protected $sSelectionName;

    public function getFilters() {
        $aFilter = array(
            'search' => array(
                'name' => 'search',
                'type' => 'search',
                'placeholder' => 'Productlist_Filter_sSearch',
                'value' => $this->sSearch,
            ),
            'status' => array(
                'name' => 'status',
                'type' => 'select',
                'value' => $this->sStatus,
                'values' => array(
                    array(
                        'value' => 'all', 'label' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Filter_Status_Default')
                    ),
                    array(
                        'value' => 'full', 'label' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Filter_Status_Full')
                    ),
                    array(
                        'value' => 'partly', 'label' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Filter_Status_Partly')
                    ),
                    array(
                        'value' => 'not', 'label' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Filter_Status_Not')
                    ),
                )
            ),
            'ordertype' => array(
                'name' => 'ordertype',
                'type' => 'select',
                'value' => $this->sFulfillmentChannel,
                'values' => array(
                    array(
                        'value' => 'all', 'label' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Filter_OrderType_Default')
                    ),
                    array(
                        'value' => 'MFN', 'label' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Filter_OrderType_MFN')
                    ),
                    array(
                        'value' => 'MFN-Prime', 'label' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Filter_OrderType_MFNPrime')
                    ),
                    array(
                        'value' => 'Business', 'label' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Filter_OrderType_Business')
                    ),
                    array(
                        'value' => 'AFN', 'label' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Filter_OrderType_FBA')
                    ),
                    array(
                        'value' => 'SameDay', 'label' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Filter_OrderType_Prime_SameDay')
                    ),
                    array(
                        'value' => 'NextDay', 'label' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Filter_OrderType_Prime_NextDay')
                    ),
                    array(
                        'value' => 'SecondDay', 'label' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Filter_OrderType_Prime_SecondDay')
                    ),
                ),
            ),
        );
        return $aFilter;
    }

    private function prepareRequest() {
        $aRequest = array(
            'ACTION' => 'GetOrdersAcknowledgeStateForDateRange',
            'BEGIN' => date('Y-m-d H:i:s', time() - 60 * 60 * 24 * 30),
        );
        if ($this->sSearch != '') {
            $aRequest['SEARCH'] = $this->sSearch;
        }
        $aRequest['CompletelyShipped'] = $this->sStatus;
        $aRequest['FulfillmentChannel'] = $this->sFulfillmentChannel;

        if ($this->sOrder != '') {
            $aSorting = explode('_', $this->sOrder);
            $aRequest['ORDERBY'] = $aSorting[0];
            if ($aSorting[1] == 'desc') {
                $aRequest['SORTORDER'] = 'DESC';
            } else {
                $aRequest['SORTORDER'] = 'ASC';
            }
        } else {
            $aRequest['ORDERBY'] = 'PurchaseDate';
            $aRequest['SORTORDER'] = 'DESC';
        }
        $aRequest['OFFSET'] = array(
            'START' => $this->iFrom,
            'COUNT' => $this->iCount
        );
        return $aRequest;
    }

    public function getList() {
        if (!isset($this->aList[$this->iFrom.'_'.$this->iCount])) {
            $this->iCountTotal = 0;
            try {
                $aResponse = MagnaConnector::gi()->submitRequestCached($this->prepareRequest(), 0);
            } catch (MagnaException $oExc) {
                MLMessage::gi()->addDebug($oExc);
            }
            if (!isset($aResponse['DATA']) || $aResponse['STATUS'] != 'SUCCESS' || !is_array($aResponse['DATA'])) {
                $this->aList[$this->iFrom.'_'.$this->iCount] = array();
            } else {
                $this->aList[$this->iFrom.'_'.$this->iCount] = $aResponse['DATA'];
                foreach ($this->aList[$this->iFrom.'_'.$this->iCount] as &$aOrder) {
                    $aOrder['isselected'] = $this->isSelected($aOrder['AmazonOrderID']);
                }
            }
            $this->iCountTotal = $aResponse['TotalCount'];
        }
        return $this->aList[$this->iFrom.'_'.$this->iCount];
    }

    public function getOrdersIds($blPage = false) {
        $mlOrdersIds = array();
        if (!$blPage) {
            $this->iCount = null;
        }
        foreach ($this->getList() as $aOrder) {
            $mlOrdersIds[] = $aOrder['AmazonOrderID'];
        }
        return $mlOrdersIds;
    }

    public function getStatistic() {
        $this->getList();
        $aOut = array(
            'iCountPerPage' => $this->iCount,
            'iCurrentPage' => $this->iFrom / $this->iCount,
            'iCountTotal' => $this->iCountTotal,
            'aOrder' => array(
                'name' => 'PurchaseDate',
                'direction' => 'desc'
            )
        );
        return $aOut;
    }

    public function setLimit($iFrom, $iCount) {
        $this->iFrom = (int)$iFrom;
        $this->iCount = ((int)$iCount > 0) ? ((int)$iCount) : 5;
        return $this;
    }

    public function setFilters($aFilter) {
        $iPage = isset($aFilter['meta']['page']) ? ((int)$aFilter['meta']['page']) : 0;
        $iPage = $iPage < 0 ? 0 : $iPage;
        $iFrom = $iPage * $this->iCount;
        $this->iFrom = $iFrom;

        $this->sOrder = isset($aFilter['meta']['order']) ? $aFilter['meta']['order'] : '';
        $this->sSearch = isset($aFilter['search']) ? $aFilter['search'] : '';
        $this->sStatus = isset($aFilter['status']) ? $aFilter['status'] : 'all';
        $this->sFulfillmentChannel = isset($aFilter['ordertype']) ? $aFilter['ordertype'] : 'all';

        return $this;
    }

    public function isSelected($sMlOrderId) {
        $i = MLDatabase::factory('globalselection')
            ->set('elementId', $sMlOrderId)
            ->set('selectionname', $this->getSelectionName())->getList()
            ->getQueryObject()
            ->getCount();
        return $i > 0;
    }

    public function getHead() {
        $aHead = array();
        $aHead['PurchaseDate'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Orderlist_PurchaseDate'),
            'order' => 'PurchaseDate',
            //            'type' => 'simpleText',
        );
        $aHead['AmazonOrderID'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Orderlist_AmazonOrderID'),
            'order' => 'AmazonOrderID',
            'type' => 'orderId',
        );
        $aHead['BuyerName'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Orderlist_BuyerName'),
            'order' => 'BuyerName',
            //            'type' => 'simpleText'
        );
        $aHead['Value'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Orderlist_Price'),
            'type' => 'price'
        );
        $aHead['CurrentStatus'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Orderlist_CurrentStatus'),
            'order' => 'CurrentStatus',
            'type' => 'currentstatus',
        );
        $aHead['CompletelyShipped'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Orderlist_ShippingStatus'),
            'type' => 'preparedStatus',
        );
        return $aHead;
    }

    public function isSelectable() {
        return true;
    }

    public function setSelectionName($sSelectionName) {
        $this->sSelectionName = $sSelectionName;
    }

    public function getSelectionName() {
        return $this->sSelectionName;
    }

}
