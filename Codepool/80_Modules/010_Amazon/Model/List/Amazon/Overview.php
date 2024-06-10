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

class ML_Amazon_Model_List_Amazon_Overview {

    protected $aList = null;
    protected $iCountTotal = 0;
    protected $aMixedData = array();
    protected $iFrom = 0;
    protected $iCount = 5;
    protected $sOrder = '';
    protected $sSearch = '';
    protected $sStatus = 'all';
    protected $sSelectionName;

    public function getFilters() {
        $aFilter = array();
        return $aFilter;
    }

    private function prepareRequest() {
        $aRequest = array(
            'ACTION' => 'MFS_GetShipmentList',
        );
        if ($this->sSearch != '') {
            $aRequest['SEARCH'] = $this->sSearch;
        }
        //        $aRequest['CompletelyShipped'] = $this->sStatus;

        if ($this->sOrder != '') {
            $aSorting = explode('_', $this->sOrder);
            $aRequest['ORDERBY'] = $aSorting[0];
            if ($aSorting[1] == 'desc') {
                $aRequest['SORTORDER'] = 'DESC';
            } else {
                $aRequest['SORTORDER'] = 'ASC';
            }
        }

        return $aRequest;
    }

    public function getList() {
        if ($this->aList === null) {
            $this->iCountTotal = 0;
            try {
                $aResponse = MagnaConnector::gi()->submitRequest($this->prepareRequest());
            } catch (MagnaException $oExc) {

            }
            if (!isset($aResponse['DATA']) || $aResponse['STATUS'] != 'SUCCESS' || !is_array($aResponse['DATA'])) {
                throw new Exception('There is a problem to get list of orders');
            } else {
                $this->aList = $aResponse['DATA'];
                foreach ($this->aList as &$aOrder) {
                    $aOrder['AmazonOrderID'] = $aOrder['ShipmentId'];
                    $aOrder['isselected'] = $this->isSelected($aOrder['AmazonOrderID']);
                    if (!empty($aOrder['ShippingService'])) {
                        $aOrder['ShippingCost'] = MLPrice::factory()->format($aOrder['ShippingService']['Rate']['Amount'], $aOrder['ShippingService']['Rate']['CurrencyCode']);
                        $aOrder['SenderAndTrackingId'] = $aOrder['ShippingService']['CarrierName'].' <br>'.$aOrder['TrackingId'];
                        $aOrder['CustomerName'] = $aOrder['Address']['ShipToAddress']['Name'];
                        $aOrder['CreatedDate'] = date(MLI18n::gi()->get('sDateTimeFormat'), strtotime($aOrder['CreatedDate']));
                        if ($aOrder['ShippingDate'] === '0000-00-00 00:00:00') {
                            $aOrder['ShippingDate'] = '&mdash;';
                        } else {
                            $aOrder['ShippingDate'] = date(MLI18n::gi()->get('sDateTimeFormat'), strtotime( $aOrder['ShippingDate']));
                        }
                    }

                    if (!empty($aOrder['ItemList'])) {
                        $aProduct = current($aOrder['ItemList']);
                        $aOrder['Product'] = isset($aProduct['ProductName']) ? $aProduct['ProductName'] : '---';
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
        $aHead['CreatedDate'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Overview_CreatedDate'),
        );
        $aHead['ShippingDate'] = array(
            'title' => MLI18n::gi()->get('ML_GENERIC_SHIPPING'),
        );
        $aHead['ShipmentId'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Orderlist_ShipmentId'),
        );
        $aHead['AmazonOrderId'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Orderlist_AmazonOrderID'),
        );
        $aHead['CustomerName'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Orderlist_BuyerName'),
            'type' => 'customername',
        );
        $aHead['Product'] = array(
            'title' => MLI18n::gi()->get('ML_LABEL_PRODUCTS'),
            'type' => 'product',
        );
        $aHead['ShippingCost'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_TotalPrice'),
            'type' => 'shippingcost',
        );
        $aHead['SenderAndTrackingId'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Overview_SenderAndTrackingId'),
            'type' => 'trackingcode',
        );
        return $aHead;
    }

}
