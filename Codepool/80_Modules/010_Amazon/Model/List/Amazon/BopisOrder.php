<?php
/*
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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Amazon_Model_List_Amazon_BopisOrder {

    protected $aList = null;
    protected $iCountTotal = 0;
    protected $aMixedData = array();
    protected $iFrom = 0;
    protected $iCount = 25;
    protected $sOrder = '';
    protected $sSearch = '';
    protected $sStatus = 'all';
    protected $sStore = '';
    protected $sSelectionName;

    public function getFilters() {
        $storeFilter = array(
            array(
                'value' => 'all', 'label' => MLI18n::gi()->get('ML_Amazon_Bopis_Filter_Store_Default')
            ),
        );
        $storeAliases = MLSession::gi()->get('storeAliases');
        if (!$storeAliases) {
            $storeAliases = array();
            if (is_array($this->aList === null)) {
                $storeAliases = array_unique(array_column($this->aList, 'SupplySourceAlias'));
            }

            MLSession::gi()->set('storeAliases', $storeAliases);
        }
        foreach($storeAliases as $alias) {
            $storeFilter[] = array(
                'value' => $alias, 'label' => $alias
            );
        }
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
                        'value' => 'all', 'label' => MLI18n::gi()->get('ML_Amazon_Bopis_Filter_Status_Default')
                    ),
                    array(
                        'value' => 'open', 'label' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Open')
                    ),
                    array(
                        'value' => 'readyForPickup', 'label' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_ReadyForPickup')
                    ),
                    array(
                        'value' => 'pickedUp', 'label' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_PickedUp')
                    ),
                    array(
                        'value' => 'refusedPickup', 'label' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_RefusedPickup')
                    ),
                    array(
                        'value' => 'cancelled', 'label' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Cancelled')
                    ),
                    array(
                        'value' => 'refunded', 'label' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Refunded')
                    ),
                )
            ),
            'store' => array(
                'name' => 'store',
                'type' => 'select',
                'value' => $this->sStore,
                'values' => $storeFilter,
            ),
        );
        return $aFilter;
    }

    private function prepareRequest() {
        $aRequest = array(
            'ACTION' => 'GetBopisOrders',
        );
        if ($this->sSearch != '') {
            $aRequest['SEARCH'] = $this->sSearch;
        }
        if ($this->sStatus != 'all') {
            $aRequest['ORDERSTATUSFILTER'] = $this->sStatus;
        }
        if ($this->sStore != 'all') {
            $aRequest['BOPISSTOREFILTER'] = $this->sStore;
        }
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

        return $aRequest;
    }

    public function getList() {
        if ($this->aList === null) {
            $this->iCountTotal = 0;
            try {
                $aResponse = MagnaConnector::gi()->submitRequest($this->prepareRequest(), 0);
            } catch (MagnaException $oExc) {

            }
            if (!isset($aResponse['DATA']) || $aResponse['STATUS'] != 'SUCCESS' || !is_array($aResponse['DATA'])) {
                throw new Exception('There is a problem to get list of bopis orders');
            } else {
                $this->aList = $aResponse['DATA'];
                foreach ($this->aList as &$aOrder) {
                    $aOrder['isselected'] = $this->isSelected($aOrder['AmazonOrderID']);
                    $aOrder['CustomerName'] = $aOrder['BuyerName'];
                    $aOrder['CustomerPhone'] = $aOrder['BuyerPhone'];
                    if (isset($aOrder['TotalPrice']) && isset($aOrder['Currency'])) {
                        $aOrder['ItemPriceAdj'] = $aOrder['TotalPrice'];
                        try {
                            $aOrder['TotalPrice'] = MLHelper::gi('model_price')->getPriceByCurrency($aOrder['TotalPrice'], $aOrder['Currency'], true);
                        } catch (Exception $e) {
                            MLMessage::gi()->addWarn($e->getMessage());
//                            throw new Exception('There is a problem to get list of bopis orders');
                        }
                    }
                }
                $this->iCountTotal = count($this->aList);
            }
        }
        if ($this->iCount !== null) {
            return array_slice($this->aList, $this->iFrom, $this->iCount);
        } else {
            return $this->aList;
        }
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
            'aOrder' => array()
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
        $this->sStore = isset($aFilter['store']) ? $aFilter['store'] : 'all';

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

    public function setSelectionName($sSelectionName) {
        $this->sSelectionName = $sSelectionName;
    }

    public function getSelectionName() {
        return $this->sSelectionName;
    }

    public function getHead() {
        $aHead = array();
        $aHead['PurchaseDate'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Orderlist_PurchaseDate'),
            'order' => 'PurchaseDate'
        );
        $aHead['RemainingDaysForPickup'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Deadline_Pickup'),
            'type' => 'deadlinePickup',
        );
        $aHead['RemainingTimeForReadyForPickup'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Deadline_ReadyForPickup'),
            'type' => 'deadlineReadyForPickup',
            'order' => 'RemainingTimeForReadyForPickup'
        );
        $aHead['Products'] = array(
            'title' => MLI18n::gi()->get('ML_LABEL_PRODUCTS'),
            'type' => 'bopisProducts',
        );
        $aHead['TotalPrice'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Orderlist_Price'),
        );
        $aHead['AmazonOrderID'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Orderlist_AmazonOrderID'),
            'type' => 'amazonOrderId'
        );
        $aHead['CustomerName'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Orderlist_BuyerName'),
            'type' => 'customername',
        );
        $aHead['CustomerPhone'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_BuyerPhone'),
        );
        $aHead['SupplySourceAlias'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_SupplySourceAlias'),
        );
        $aHead['OrderStatus'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Orderlist_CurrentStatus'),
            'type' => 'shippingStatus',
        );
        $aHead['Actions'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Bopis_Orderlist_Actions'),
            'type' => 'bopisActions'
        );
//        $aHead['DownloadInvoice'] = array(
//            'title' => 'Download Invoices',
//            'type' => 'downloadInvoice',
//            //            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Overview_SenderAndTrackingId'),
//        );
        return $aHead;
    }

}
