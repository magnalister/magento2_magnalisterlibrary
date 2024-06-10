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

class ML_Amazon_Model_List_Amazon_Order_Form {

    protected $aList = null;
    protected $aMixedData = array();
    protected $sSelectionName;

    public function getList() {
        if ($this->aList === null) {
            $aOrderIds = array();
            $aSelectedOrder = MLDatabase::factory('globalselection')
                ->set('selectionname', $this->getSelectionName())->getList()->getQueryObject()->getResult();
            foreach ($aSelectedOrder as $aOrderId) {
                $aOrderIds[] = $aOrderId['elementId'];
            }

            $aResponse = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetOrdersForDateRange',
                'BEGIN' => date('Y-m-d H:i:s', time() - 60 * 60 * 24 * 30),
                "ForceV3" => true,
                "GetMFSDetails" => true,
                'OrderIDs' => $aOrderIds
            ), 0);

            if (!isset($aResponse['DATA']) || $aResponse['STATUS'] != 'SUCCESS' || !is_array($aResponse['DATA'])) {
                throw new Exception('There is a problem to get list of orders');
            } else {
                $this->aList = $aResponse['DATA'];
                $oSelection = MLDatabase::factory('globalselection');
                foreach ($this->aList as $iOrderKey => $aOrderData) {
                    $fTotalWeight = 0;
                    foreach ($aOrderData['Products'] as $iProductKey => $aProduct) {
                        if ($aProduct['Quantity'] <= $aProduct['QuantitySent']) {
                            unset($aOrderData['Products'][$iProductKey]);
                            unset($this->aList[$iOrderKey]['Products'][$iProductKey]);
                            MLMessage::gi()->addWarn(MLI18n::gi()->get('sAddItemProductWithZeroQuantity'));
                        } else {
                            if (isset($aProduct['QuantitySent']) && $aProduct['QuantitySent'] > 0) {
                                $this->aList[$iOrderKey]['Products'][$iProductKey]['Quantity'] = $aProduct['Quantity'] - $aProduct['QuantitySent'];
                            } else {
                                $this->aList[$iOrderKey]['Products'][$iProductKey]['Quantity'] = $aProduct['Quantity'];
                            }
                            $fWeight = null;
                            $oProduct = MLProduct::factory()->getByMarketplaceSKU($aProduct['SKU']);
                            if ($oProduct->exists()) {
                                $oConvertor = MLHelper::gi('unitconvertor');
                                $aWeight = $oProduct->getWeight();
                                $fWeight = $oConvertor->convertWeight($aWeight['Value'], $aWeight['Unit'], MLModule::gi()->getConfig('shippinglabel.weight.unit'));
                            }
                            $fWeight = $fWeight === null ? MLModule::gi()->getConfig('shippinglabel.fallback.weight') : $fWeight;
                            $this->aList[$iOrderKey]['Products'][$iProductKey]['Weight'] = $fWeight;
                            $fTotalWeight += $fWeight * $this->aList[$iOrderKey]['Products'][$iProductKey]['Quantity'];
                        }
                    }
                    $this->aList[$iOrderKey]['TotalWeight'] = $fTotalWeight;
                    $oSelection->init()
                        ->set('selectionname', $this->getSelectionName())
                        ->set('elementId', $aOrderData['MPSpecific']['MOrderID']);
                    if (empty($aOrderData['Products'])) {
                        unset($this->aList[$iOrderKey]);
                        $oSelection->delete();
                    } else {
                        $aData = $oSelection->get('data');
                        $aData['globalinfo'] = $aOrderData;
                        $oSelection->set('elementId', $aOrderData['MPSpecific']['MOrderID'])
                            ->set('data', $aData)
                            ->save();
                    }
                }
            }
        }
        return $this->aList;
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
        $aHead['Name'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Form_ProductName'),
            'type' => 'product',
        );
        $aHead['SKU'] = array(
            'title' => MLI18n::gi()->get('SKU'),
            'type' => 'sku'
        );
        //        $aHead['Status'] = array(
        //            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Form_Status'),
        //            'type' => 'status'
        //        );
        //        $aHead['Notice'] = array(
        //            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Form_Notice'),
        //            'type' => 'notice'
        //        );
        $aHead['QuantitySent'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Form_Sent'),
            'type' => 'sent',
        );
        $aHead['Quantity'] = array(
            'title' => MLI18n::gi()->get('ML_Amazon_Shippinglabel_Form_Quantity'),
            'type' => 'quantity',
        );
        return $aHead;
    }

    public function isSelectable() {
        return false;
    }

    public function setSelectionName($sSelectionName) {
        $this->sSelectionName = $sSelectionName;
    }

    public function getSelectionName() {
        return $this->sSelectionName;
    }


}
