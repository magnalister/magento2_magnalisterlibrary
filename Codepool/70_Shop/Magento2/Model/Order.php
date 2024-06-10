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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Shop_Model_Order_Abstract');

class ML_Magento2_Model_Order extends ML_Shop_Model_Order_Abstract {

    /**
     *
     * @return Magento\Sales\Model\Order
     * @throws Exception
     */
    public function getShopOrderObject(){
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $oOrder = $objectManager->create('Magento\Sales\Model\Order')->load($this->get('current_orders_id'));
        if (is_object($oOrder)) {
            return $oOrder;
        }
        throw new Exception('This order cannot be found in shop: '.$this->get('current_orders_id'), 1622809739);

    }

    public function existsInShop() {
        try {
            $this->getShopOrderObject();
        } catch (\Exception $ex) {
            if ($ex->getCode() === 1622809739) {
                return false;
            } else {
                throw $ex;
            }
        }
        return true;
    }

    /**
     * return uuid of current order state
     * @return string|null
     */
    public function getShopOrderStatus(): ?string {
        try {
            return $this->getShopOrderObject()->getStatus();
        } catch (Exception $oExc) {
            return null;
        }
    }

    /**
     *
     * @return string|null
     */
    public function getShopOrderStatusName() {
        try {
            return $this->getShopOrderObject()->getStatusLabel();
        } catch (Exception $oExc) {
            return null;
        }
    }

    public function getEditLink() {
        return MLMagento2Alias::ObjectManagerProvider('Magento\Backend\Helper\Data')
            ->getUrl('sales/order/view', ['order_id' => $this->get('current_orders_id')]);
    }

    public function getShippingCarrier() {
        $sDefaultCarrier = $this->getDefaultCarrier();
        if ($sDefaultCarrier == '-1') {
            return $this->getShopOrderCarrierOrShippingMethod();
        } elseif ($sDefaultCarrier == '') {
            return null;
        } else {
            return $sDefaultCarrier;
        }
    }

    public function getShopOrderCarrierOrShippingMethod() {
        try {
            $oOrder = $this->getShopOrderObject();
            //make sure we do not need code
            $sCarrier = $oOrder->getShippingDescription();
            return empty($sCarrier) ? null : $sCarrier;
        } catch (Exception $oEx) {
            return null;
        }

    }

    public function getShopOrderCarrierOrShippingMethodId() {
        try {
            $oOrder = $this->getShopOrderObject();
            $sCarrierCode = $oOrder->getShipmentsCollection()->getLastItem()->getTracksCollection()->getLastItem()->getCarrierCode();
            return empty($sCarrierCode) ? null : $sCarrierCode;
        } catch (Exception $oEx) {
            return null;
        }
    }

    public function getShippingDateTime() {
        $sShipDate = $this->getShopOrderObject()->getShipmentsCollection()->getLastItem()->getUpdatedAt();
        if (empty($sShipDate)) {//no shipping found, walk status history
            foreach ($this->getShopOrderObject()->getStatusHistoryCollection()->getItemsByColumnValue('status', $this->getShopOrderStatus()) as $oHistory) {
                $sShipDate = empty($sShipDate) ? $oHistory->getCreatedAt() : $sShipDate;
                if ($oHistory->getEntityName() == 'shipment') {//is shipment, force!
                    $sShipDate = $oHistory->getCreatedAt();
                    break;
                }
            }
        }

        return empty($sShipDate) ? date('Y-m-d H:i:s') : $sShipDate;
    }

    public function getShopOrderId() {
        try {
            return $this->getShopOrderObject()->getIncrementId();
        } catch (Exception $oEx) {//if order deosn't exist in magento 2
            return $this->get('orders_id');
        }
    }
    public function getShopAlternativeOrderId() {
        try {
            return $this->getShopOrderObject()->getId();
        } catch (Exception $oEx) {//if order deosn't exist in magento 2
            return $this->get('current_orders_id');
        }
    }
    public function setSpecificAcknowledgeField(&$aOrderParameters, $aOrder) {

    }

    public function getShippingDate() {
        return substr($this->getShippingDateTime(), 0, 10);
    }

    public function getShippingTrackingCode() {
        $oOrder = $this->getShopOrderObject();
        $oShip = $oOrder->getShipmentsCollection()->getLastItem();
        $oTrack = $oShip->getTracksCollection()->getLastItem();
        return $oTrack->getNumber() !== null ? $oTrack->getNumber() : '';
    }

    public function getShopOrderLastChangedDate() {
        try {
            if($this->getShopOrderObject()->getUpdatedAt() !== null) {
                return $this->getShopOrderObject()->getUpdatedAt();
            }
        } catch (Exception $oEx) {

        }
        return null;
    }

    public static function getOutOfSyncOrdersArray($iOffset = 0, $blCount = false) {

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $oCollection = $objectManager->create('Magento\Sales\Model\Order')->getCollection();
        $oSelect = $oCollection->getSelect();
        $oSelect
            ->joinRight(array('magnalister_orders' => 'magnalister_orders'), 'main_table.entity_id = magnalister_orders.current_orders_id')
            ->where("main_table.status != magnalister_orders.status and magnalister_orders.mpID = '" . MLModule::gi()->getMarketPlaceId() . "'");


        if($blCount){
            return $oCollection->count();
        }  else {
            $oSelect->limit(100 ,$iOffset);
            $aOut = array();
            foreach ($oCollection as $oShopOrder) {
                $aOut[] = $oShopOrder->getId();
            }
            return $aOut;
        }
    }

    /**
     *
     * @param array $aData
     * @return array
     */
    public function shopOrderByMagnaOrderData($aData) {
        $oSHopOrderHelper = MLMagento2Alias::getShopOrderHelper();
        try {
            $mReturn = $oSHopOrderHelper
                ->setOrder($this)
                ->setNewOrderData($aData)
                ->shopOrder();
            return $mReturn;
        } catch (Throwable $oEx) {
            MLMessage::gi()->addDebug($oEx);
            throw $oEx;
        }
    }


    public function getShopOrderTotalAmount() {
        return $this->getShopOrderObject()->getGrandTotal();
    }

    public function getShopOrderTotalTax() {
        $this->getShopOrderObject()->getTaxAmount();
    }

    public function getShopOrderInvoice($sType) {
        $sPdf = '';

        if ($this->isInvoiceDocumentType($sType)) {
            foreach ($this->getShopOrderObject()->getInvoiceCollection() as $oInvoice) {
                $pdf = MLMagento2Alias::CreateObjectManagerProvider('\Magento\Sales\Model\Order\Pdf\Invoice')->getPdf(array($oInvoice));
                if(!empty($pdf)) {
                    $pdfFile = $pdf->render();
                    $sPdf = base64_encode($pdfFile);
                    break;
                }
            }
        } elseif ($this->isCreditNoteDocumentType($sType)) {
            foreach ($this->getShopOrderObject()->getCreditmemosCollection() as $oCreditMemo) {
                $pdf = MLMagento2Alias::CreateObjectManagerProvider('\Magento\Sales\Model\Order\Pdf\Creditmemo')->getPdf(array($oCreditMemo));
                if(!empty($pdf)) {
                    $pdfFile = $pdf->render();
                    $sPdf = base64_encode($pdfFile);
                    break;
                }
            }
        }
        return $sPdf;
    }

    public function getShopOrderInvoiceNumber($sType) {
        if ($this->isInvoiceDocumentType($sType)) {
            foreach ($this->getShopOrderObject()->getInvoiceCollection() as $oInvoice) {
                return $oInvoice->getIncrementId();
            }
        } elseif ($this->isCreditNoteDocumentType($sType)) {
            foreach ($this->getShopOrderObject()->getCreditmemosCollection() as $oCreditMemo) {
                return $oCreditMemo->getIncrementId();
            }
        }
        return '';
    }

    public function getShopOrderProducts() {
        return array();
    }

    public function getOrderIdForAcknowledge() {
        return $this->getShopOrderObject()->getIncrementId();
    }
}
