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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

class ML_Tools_Controller_Main_Tools_Orders extends ML_Core_Controller_Abstract {
    protected $aParameters = array('controller');
    protected $aData = null;

    protected function getRequestedOrderSpecial() {
        return $this->getRequest('orderspecial');
    }

    protected function isExpert() {
        return $this->getRequest('mode') === 'expert';
    }

    protected function getOrderData() {
        $oOrder = MLOrder::factory()->getByMagnaOrderId($this->getRequestedOrderSpecial());
        if (!$oOrder->exists()) {
            $oOrder = MLOrder::factory()->set('current_orders_id', $this->getRequestedOrderSpecial());
        }
        if ($this->getRequestedOrderSpecial() != '' && $oOrder->exists()) {
            if ($this->aData === null) {
                if ($this->getRequest('action') === 'unacknowledge') {
                    try {
                        $this->aData = array('unAcknowledgeImportedOrder' => $oOrder->unAcknowledgeImportedOrder($oOrder->get('platform'), $oOrder->get('mpid'), $oOrder->get('special'), $oOrder->get('orders_id'), $this->getRequest('apirequest') == 'yes'));
                    } catch (Exception $oEx) {
                        $this->aData = array('Exception' => $oEx->getMessage());
                    }
                } else if ($this->getRequest('action') === 'recreateProducts') {
                    ML::gi()->init(array('mp' => $oOrder->get('mpid')));
                    $oOrderHelper = MLHelper::gi('model_shoporder');
                    /* @var $oOrderHelper ML_Shopware_Helper_Model_ShopOrder */
                    $sMpId = MLModule::gi()->getMarketPlaceId();
                    MLSetting::gi()->set('sCurrentOrderImportLogFileName', 'OrderImport_'.$sMpId, true);
                    MLSetting::gi()->sCurrentOrderImportMarketplaceOrderId = $oOrder->get('special');
                    $oOrderHelper
                        ->setOrder($oOrder)
                        ->recreateProducts();
                } else if ($this->getRequest('action') === 'resetOrderStatus') {
                    ML::gi()->init(array('mp' => $oOrder->get('mpid')));
                    $oOrderHelper = MLHelper::gi('model_shoporder');
                    /* @var $oOrderHelper ML_Shopware_Helper_Model_ShopOrder */
                    $sMpId = MLModule::gi()->getMarketPlaceId();
                    $oOrder->set('status', MLModule::gi()->getConfig('orderstatus.open'))->save();
                } else {
                    ML::gi()->init(array('mp' => $oOrder->get('mpid')));

                    try {

                        $aShop = array(
                            '$oOrder->getShopOrderStatus()'                  => $oOrder->getShopOrderStatus(),
                            '$oOrder->getShopOrderLastChangedDate()'         => $oOrder->getShopOrderLastChangedDate(),
                            '$oOrder->getShippingDateTime()'                 => $oOrder->getShippingDateTime(),
                            '$oOrder->getShippingCarrier()'                  => $oOrder->getShippingCarrier(),
                            '$oOrder->getShopOrderCarrierOrShippingMethod()' => $oOrder->getShopOrderCarrierOrShippingMethod(),
                            '$oOrder->getShippingTrackingCode()'             => $oOrder->getShippingTrackingCode(),
                            '$oOrder->getShopOrderTotalAmount()'             => $oOrder->getShopOrderTotalAmount(),
                            '$oOrder->getShopOrderTotalTax()'                => $oOrder->getShopOrderTotalTax(),
                            '$oOrder->getShopAlternativeOrderId()'           => $oOrder->getShopAlternativeOrderId()
                        );
                        if (method_exists($oOrder, 'getShopPaymentStatus')) {
                            $aShop['$oOrder->getShopPaymentStatus()'] = $oOrder->getShopPaymentStatus();
                        }
                        if (MLSetting::gi()->blDebug) {
                            $aShop += array(
                                '$oOrder->getShopOrderInvoiceNumber("SHIPMENT")' => htmlentities($oOrder->getShopOrderInvoiceNumber('SHIPMENT')),
                                '$oOrder->getShopOrderInvoiceNumber("REFUND")'   => htmlentities($oOrder->getShopOrderInvoiceNumber('REFUND'))
                            );

                            try {
                                $aShop += array(
                                    get_class(MLService::getUploadInvoices()).'::getInvoiceNumber("SHIPMENT")' => MLService::getUploadInvoicesInstance()->getInvoiceNumber($oOrder, 'SHIPMENT'),
                                    get_class(MLService::getUploadInvoices()).'::getInvoiceNumber("REFUND")'   => MLService::getUploadInvoicesInstance()->getInvoiceNumber($oOrder, 'REFUND')
                                );
                            } catch (\Exception $ex) {
                                MLMessage::gi()->addDebug($ex);
                            }

                            if (MLModule::gi()->getConfig('amazonvcsinvoice.invoicenumberoption') === 'matching') {
                                $aShop += array(
                                    '$oOrder->getAttributeValue(' . MLModule::gi()->getConfig('amazonvcsinvoice.invoicenumber.matching') . ')' => $oOrder->getAttributeValue(MLModule::gi()->getConfig('amazonvcsinvoice.invoicenumber.matching'))
                                );
                            }
                            if (MLModule::gi()->getConfig('amazonvcsinvoice.reversalinvoicenumberoption') === 'matching') {

                                $aShop += array(
                                    '$oOrder->getAttributeValue(' . MLModule::gi()->getConfig('amazonvcsinvoice.reversalinvoicenumber.matching') . ')' => $oOrder->getAttributeValue(MLModule::gi()->getConfig('amazonvcsinvoice.invoicenumber.matching'))
                                );
                            }
                        }
                        if (MLSetting::gi()->blDev) {
                            $aShop += array(
                                '$oOrder->getShopOrderInvoice("SHIPMENT")' => $oOrder->getShopOrderInvoice('SHIPMENT'),
                                '$oOrder->getShopOrderInvoice("REFUND")'   => $oOrder->getShopOrderInvoice('REFUND'),
                            );
                        }
                    } catch (\Exception $ex) {
                        $aShop = array();
                    }
                    $this->aData = array(
                        '$oOrder->data()' => $oOrder->data(),
                        'Shop'            => $aShop,
                    );
                    if (method_exists(MLFormHelper::getShopInstance(), 'getOrderFreeTextFieldsAttributes') && method_exists($oOrder, 'getAttributeValue')) {
                        $this->aData['Attributes'] = array();
                        foreach (MLFormHelper::getShopInstance()->getOrderFreeTextFieldsAttributes() as $sKey => $sLabel) {
                            $this->aData['Attributes'][$sLabel] = $oOrder->getAttributeValue($sKey);
                        }
                    }
                }
                ML::gi()->init(array());
            }
            return $this->aData;
        }
    }
}
