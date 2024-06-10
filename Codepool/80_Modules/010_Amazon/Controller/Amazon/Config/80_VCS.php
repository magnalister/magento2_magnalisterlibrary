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

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_ConfigInvoiceAbstract');

class ML_Amazon_Controller_Amazon_Config_VCS extends ML_Form_Controller_Widget_Form_ConfigInvoiceAbstract {

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
                $field['value'] =  $field['default'];
            }
        }
    }

    public static function getTabTitle() {
        return MLI18n::gi()->get('amazon_config_account_vcs');
    }

    public static function getTabActive() {
        return self::calcConfigTabActive(__class__, false) ;
    }

    public function amazonvcsinvoice_invoiceprefixField(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function amazonvcsinvoice_reversalinvoiceprefixField(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function amazonvcsinvoice_companyadressleftField(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function amazonvcsinvoice_companyadressrightField(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function amazonvcsinvoice_headlineField(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function amazonvcsinvoice_invoicehintheadlineField(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function amazonvcsinvoice_invoicehinttextField(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function amazonvcsinvoice_footercell1Field(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function amazonvcsinvoice_footercell2Field(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function amazonvcsinvoice_footercell3Field(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function amazonvcsinvoice_footercell4Field(&$aField) {
        $this->useI18nDefault($aField);
    }

    public function amazonvcsinvoice_invoicedirField(&$aField) {
        $aField['url'] = MLModule::gi()->getPublicDirLink() . 'Invoices/';
    }

    public function amazonvcsinvoice_previewField(&$aField) {
        $companyleft = MLModule::gi()->getConfig('amazonvcsinvoice.companyadressleft');
        if (empty($companyleft)) {
            $aField['disabled'] = true;
        }
    }

    protected function callAjaxVcsInvoicePreview() {
        try {
            $result = MagnaConnector::gi()->submitRequest(array(
                'ACTION' => 'TestInvoiceGeneration'
            ));
            $iframeURL = $result['DATA']['URL'];

            MLSetting::gi()->add(
                'aAjax', array(
                    'iframeUrl' => $iframeURL,
                    'error' => '',
                )
            );
        } catch (MagnaException $e) {
            MLMessage::gi()->addDebug($e);
            MLSetting::gi()->add(
                'aAjax', array(
                    'iframeUrl' => '',
                    'error' => $e->getMessage(),
                )
            );
        }
    }

}
