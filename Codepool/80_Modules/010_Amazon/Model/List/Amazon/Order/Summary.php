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

class ML_Amazon_Model_List_Amazon_Order_Summary {

    protected $aList = null;
    protected $aMixedData = array();
    protected $sSelectionName;

    public function getList() {
        if ($this->aList === null) {
            $oSelection = MLDatabase::factory('globalselection')->set('selectionname', $this->getSelectionName());
            foreach ($oSelection->getList()->getList() as $oOrder) {
                $aData = $oOrder->get('data');
                if (isset($aData['ShippingServiceId'])) {
                    $fPrice = MLPrice::factory()->format($aData['globalinfo']['shippingservice']['Rate']['Amount'], $aData['globalinfo']['shippingservice']['Rate']['CurrencyCode']);
                    $this->aList[] = array(
                        'BuyerName' => $aData['globalinfo']['AddressSets']['Shipping']['Firstname'].' '.$aData['globalinfo']['AddressSets']['Shipping']['Lastname'],
                        'ShippingDate' => $aData['ShippingDate'],
                        'Weight' => $aData['Weight']['Value'].' '.$aData['Weight']['Unit'],
                        'ShippingServiceName' => $aData['globalinfo']['shippingservice']['ShippingServiceName'],
                        'CarrierName' => $aData['globalinfo']['shippingservice']['CarrierName'],
                        'UnitPrice' => $fPrice,
                        'TotalPrice' => $fPrice,
                    );
                } else {
                    $oOrder->delete();
                }
            }
        }
        return $this->aList;
    }

    public function getFilters() {
        return array();
    }

    public function setSelectionName($sSelectionName) {
        $this->sSelectionName = $sSelectionName;
    }

    public function getSelectionName() {
        return $this->sSelectionName;
    }

    public function getHead() {
        $aHead = array();
        $aHead['BuyerName'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Receiver'),
        );
        $aHead['ShippingDate'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_ShippingDate'),
        );
        $aHead['Weight'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Weight'),
        );
        $aHead['CarrierName'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_CarrierName'),
        );
        $aHead['ShippingServiceName'] = array(
            'title' => MLI18n::gi()->get('ML_LABEL_MARKETPLACE_SHIPPING_METHOD'),
        );
        $aHead['TotalPrice'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_TotalPrice'),
        );
        return $aHead;
    }


}
