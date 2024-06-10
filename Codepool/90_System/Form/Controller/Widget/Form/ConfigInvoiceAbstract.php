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

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_ConfigAbstract');

class ML_Form_Controller_Widget_Form_ConfigInvoiceAbstract extends ML_Form_Controller_Widget_Form_ConfigAbstract {


    /**
     * ERP
     */
    public function erp_invoice_sourceField(&$aField) {
        if ($aField['value'] === null) {
            $path = MLFilesystem::gi()->getWritablePath('').'Receipts'
                .DIRECTORY_SEPARATOR.MLModule::gi()->getMarketPlaceName(false)
                .DIRECTORY_SEPARATOR.'ToBeProcessed'
                .DIRECTORY_SEPARATOR.'Invoices';
            $aField['value'] = $this->getAndGenerateErpDirectoryPath($path);
        }
    }

    private function getAndGenerateErpDirectoryPath($path) {
        $oFilesystem = MLHelper::getFilesystemInstance();
        try {
            $oFilesystem->write($path);
        } catch (ML_Core_Exception_Update $e) {
            return $_SERVER['DOCUMENT_ROOT'];
        }

        return $path;
    }

    /**
     *  ERP
     */
    public function erp_invoice_destinationField(&$aField) {
        if ($aField['value'] === null) {
            $path = MLFilesystem::gi()->getWritablePath('').'Receipts'
                .DIRECTORY_SEPARATOR.MLModule::gi()->getMarketPlaceName(false)
                .DIRECTORY_SEPARATOR.'Processed'
                .DIRECTORY_SEPARATOR.'Invoices';
            $aField['value'] = $this->getAndGenerateErpDirectoryPath($path);
        }
    }

    /**
     *  ERP
     */
    public function erp_creditnote_sourceField(&$aField) {
        if ($aField['value'] === null) {
            $path = MLFilesystem::gi()->getWritablePath('').'Receipts'
                .DIRECTORY_SEPARATOR.MLModule::gi()->getMarketPlaceName(false)
                .DIRECTORY_SEPARATOR.'ToBeProcessed'
                .DIRECTORY_SEPARATOR.'CreditNotes';
            $aField['value'] = $this->getAndGenerateErpDirectoryPath($path);
        }
    }

    /**
     *  ERP
     */
    public function erp_creditnote_destinationField(&$aField) {
        if ($aField['value'] === null) {
            $path = MLFilesystem::gi()->getWritablePath('').'Receipts'
                .DIRECTORY_SEPARATOR.MLModule::gi()->getMarketPlaceName(false)
                .DIRECTORY_SEPARATOR.'Processed'
                .DIRECTORY_SEPARATOR.'CreditNotes';
            $aField['value'] = $this->getAndGenerateErpDirectoryPath($path);
        }
    }

    public function invoice_invoiceprefixField(&$aField) {
        $this->useI18nDefault($aField);
    }

    /**
     * Normally its not possible to use i18n value as default
     *  so we trigger this function for each field that should use it
     *
     * @param $field
     */
    private function useI18nDefault(&$field) {
        if (array_key_exists('i18n', $field) && array_key_exists('default', $field['i18n'])) {
            $field['default'] = $field['i18n']['default'];
            if ($field['value'] === null) {
                $field['value'] = $field['default'];
            }
        }
    }

    public function invoice_reversalinvoiceprefixField(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function invoice_companyadressleftField(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function invoice_companyadressrightField(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function invoice_headlineField(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function invoice_invoicehintheadlineField(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function invoice_invoicehinttextField(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function invoice_footercell1Field(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function invoice_footercell2Field(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function invoice_footercell3Field(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function invoice_footercell4Field(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function invoice_invoicedirField(&$aField) {
        $aField['url'] = MLModule::gi()->getPublicInvoiceUrl();
    }

    public function invoice_previewField(&$aField) {
        $companyleft = MLModule::gi()->getConfig('invoice.companyadressleft');
        if (empty($companyleft)) {
            $aField['disabled'] = true;
        }
    }

    public function callAjaxGetConfiguredBasePath() {
        $this->getFileBrowserHelper()->getConfiguredBasePath();
    }

    /**
     * @return ML_Form_Helper_FileBrowser|object
     */
    protected function getFileBrowserHelper() {
        return MLHelper::gi('FileBrowser');
    }

    public function callAjaxGetDirectories() {
        $this->getFileBrowserHelper()->getDirectories();
    }

    protected function finalizeAjax() {

    }

    /**
     * @TODO to be checked after API
     */
    protected function callAjaxInvoicePreview() {
        try {
            $result = MagnaConnector::gi()->submitRequest(array(
                'ACTION' => 'TestInvoiceGeneration'
            ));
            $iframeURL = $result['DATA']['URL'];

            echo json_encode(array(
                'iframeUrl' => $iframeURL,
                'error'     => '',
            ));
        } catch (MagnaException $e) {
            echo json_encode(array(
                'iframeUrl' => '',
                'error'     => $e->getMessage(),
            ));
        }
    }
}