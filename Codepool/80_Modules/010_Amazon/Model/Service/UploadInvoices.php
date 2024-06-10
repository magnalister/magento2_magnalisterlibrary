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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Modul_Model_Service_UploadInvoices_Abstract');
class ML_Amazon_Model_Service_UploadInvoices extends ML_Modul_Model_Service_UploadInvoices_Abstract {

    /**
     * @var string
     */
    protected $sOrderIdIndexName = 'AmazonOrderId';
    /**
     * @var string
     */
    protected $sDocumentTypeIndexName = 'TransactionType';

    protected function setErpSetting() {
        try {
            MLHelper::getReceiptUpload()->setConfig(array(
                'SHIPMENT'             => MLModule::gi()->getConfig('invoice.erpinvoicesource'),
                'SHIPMENT_DESTINATION' => MLModule::gi()->getConfig('invoice.erpinvoicedestination'),
                'RETURN'               => MLModule::gi()->getConfig('invoice.erpreversalinvoicesource'),
                'RETURN_DESTINATION'   => MLModule::gi()->getConfig('invoice.erpreversalinvoicedestination'),
                'REFUND'               => MLModule::gi()->getConfig('invoice.erpreversalinvoicesource'),
                'REFUND_DESTINATION'   => MLModule::gi()->getConfig('invoice.erpreversalinvoicedestination'),
            ));
        } catch (MagnaException $e) {
            if (ML_Form_Helper_ReceiptUpload::$ReceiptUploadError == $e->getCode()) {
                MLHelper::gi('stream')->stream($e->getMessage());
            } else {
                throw $e;
            }
        }
    }

    /**
     * @param mixed $sVCSInvoiceConfig
     * @return string|null
     */
    public function getInvoiceOptionConfig() {
        $sVCSConfig = MLModule::gi()->getConfig('amazonvcs.option');
        if (!in_array($sVCSConfig, array('vcs-lite', 'off'), true)) {
            $this->sInvoiceOptionConfig = null;
        } else if ($this->sInvoiceOptionConfig === null) {
            $sVCSInvoiceConfig = MLModule::gi()->getConfig('amazonvcs.invoice');
            $this->sInvoiceOptionConfig = $sVCSInvoiceConfig;
        }
        return $this->sInvoiceOptionConfig;
    }

    /**
     * @param mixed $aOrders
     * @return void
     */
    protected function displayListOfProcessingOrder($aOrders) {
        MLHelper::gi('stream')->deeper('Processing orders to upload invoices');
        foreach ($aOrders as $aOrder) {
            MLHelper::gi('stream')->stream($aOrder[$this->sOrderIdIndexName].' : '.$aOrder[$this->sDocumentTypeIndexName]);
        }
        MLHelper::gi('stream')->higher('');
    }


    protected function getInvoiceNumberOptionConfig() {
        if ($this->sInvoiceNumberOptionConfig === null) {
            $this->sInvoiceNumberOptionConfig = MLModule::gi()->getConfig('amazonvcsinvoice.invoicenumberoption');
        }
        return $this->sInvoiceNumberOptionConfig;
    }

    protected function manipulateSubmittedInvoiceData($aData, $aOrder) {
        $aData['TransactionId'] = $aOrder['TransactionId'];
        return $aData;
    }

    protected function manipulateUploadRequest($aData) {
        $aData['RequestVersion'] = 2;
        return $aData;
    }
}
