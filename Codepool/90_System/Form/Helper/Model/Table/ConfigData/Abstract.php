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

abstract class ML_Form_Helper_Model_Table_ConfigData_Abstract {

    protected $sIdent = '';
    /**
     * comes from request or use as primary default
     * @var array array('name'=>mValue)
     */
    protected $aRequestFields = array();

    /**
     * makes active or not
     * @var array array('name'=>blValue)
     */
    protected $aRequestOptional = array();

    public function setIdent($sIndent) {
        $this->sIdent = $sIndent;
        return $this;
    }

    public function getIdent() {
        return $this->sIdent;
    }

    public function getFieldId($sField) {
        return str_replace('.', '_', strtolower($this->getIdent().'_field_'.$sField));
    }

    public function quantity_typeField(&$aField) {
        $aField['values'] = MLSetting::gi()->getGlobal('configform_quantity_values');
        if (MLI18n::gi()->isTranslationActive()) {
            foreach ($aField['values'] as $key => &$value) {
                $value['translationData'] = MLI18n::gi()->getTranslationData("configform_quantity_values_{$key}_title");
            }
        }
    }

    public function quantity_valueField(&$aField) {
        $aField['value'] = isset($aField['value']) ? trim($aField['value']) : 0;
        if (MLModule::gi()->getConfig('quantity.type') != 'stock' && (string)((int)$aField['value']) != $aField['value']) {
            $this->addError($aField, MLI18n::gi()->get('configform_quantity_value_error'));
        }
    }

    public function price_addKindField(&$aField) {
        $aField['values'] = MLI18n::gi()->get('configform_price_addkind_values');
    }

    public function price_factorField(&$aField) {
        $aField['value'] = isset($aField['value']) ? str_replace(',', '.', trim($aField['value'])) : 0;
        if ((string)((float)$aField['value']) != $aField['value']) {
            $this->addError($aField, MLI18n::gi()->get('configform_price_factor_error'));
        } else {
            $aField['value'] = number_format($aField['value'], 2, '.', '');
        }
    }

    public function price_signalField(&$aField) {
        $aField['value'] = isset($aField['value']) ? str_replace(',', '.', trim($aField['value'])) : '';
        if (!empty($aField['value']) && (string)((int)$aField['value']) != $aField['value']) {
            $this->addError($aField, MLI18n::gi()->get('configform_price_signal_error'));
        }
    }

    public function price_groupField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getCustomerGroupValues();
    }

    public function importField(&$aField) {
        $aField['values'] = array(1 => MLI18n::gi()->get('ML_BUTTON_LABEL_YES'), 0 => MLI18n::gi()->get('ML_BUTTON_LABEL_NO'));
    }

    public function customerGroupField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getCustomerGroupValues(true);
    }

    public function orderstatus_openField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getOrderStatusValues();
    }

    public function mwst_fallbackField(&$aField) {
        $aField['value'] = isset($aField['value']) ? str_replace(',', '.', trim($aField['value'])) : 0;
        if ((string)((float)$aField['value']) != $aField['value']) {
            $this->addError($aField, MLI18n::gi()->get('configform_ust_error'));
        } else {
            $aField['value'] = number_format($aField['value'], 2);
        }
    }

    public function mwstfallbackField(&$aField) {
        $aField['value'] = isset($aField['value']) ? str_replace(',', '.', trim($aField['value'])) : 0;
        if ((string)((float)$aField['value']) != $aField['value']) {
            $this->addError($aField, MLI18n::gi()->get('configform_ust_error'));
        } else {
            $aField['value'] = $aField['value'];
        }
    }

    public function mwstField(&$aField) {
        $aField['value'] = isset($aField['value']) ? str_replace(',', '.', trim($aField['value'])) : 0;
        if ((string)((float)$aField['value']) != $aField['value']) {
            $this->addError($aField, MLI18n::gi()->get('configform_ust_error'));
        } else {
            $aField['value'] = $aField['value'];
        }
    }

    public function mwst_shippingField(&$aField) {
        $aField['value'] = isset($aField['value']) ? str_replace(',', '.', trim($aField['value'])) : 0;
        if ((string)((float)$aField['value']) != $aField['value']) {
            $this->addError($aField, MLI18n::gi()->get('configform_ust_error'));
        } else {
            $aField['value'] = number_format($aField['value'], 2);
        }
    }

    public function orderstatus_syncField(&$aField) {
        $aField['values'] = MLI18n::gi()->get('configform_sync_values');
    }

    public function stocksync_toMarketplaceField(&$aField) {
        $aField['values'] = MLI18n::gi()->get('configform_fast_sync_values');
    }

    public function stocksync_fromMarketplaceField(&$aField) {
        $aField['values'] = MLI18n::gi()->get('configform_stocksync_values');
    }

    public function inventorysync_priceField(&$aField) {
        $aField['values'] = MLI18n::gi()->get('configform_sync_values');
    }

    public function orderstatus_shippedField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getOrderStatusValues();
    }

    public function orderstatus_canceledField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getOrderStatusValues();
        if ($aField['value'] === null && MLFormHelper::getShopInstance()->getDefaultCancelStatus() !== null) {
            $aField['value'] = MLFormHelper::getShopInstance()->getDefaultCancelStatus();
        }
    }

    protected function addError(&$aField, $sMessage) {
        $aField['cssclasses'] = isset ($aField['cssclasses']) ? $aField['cssclasses'] : array();
        if (!in_array('ml-error', $aField['cssclasses'])) {
            $aField['cssclasses'][] = 'ml-error';
        }
        MLMessage::gi()->addError(MLI18n::gi()->get('configform_check_entries_error'));
        MLMessage::gi()->addError($sMessage);
    }

    protected function callApi($aRequest, $iLifeTime) {
        try {
            $aResponse = MagnaConnector::gi()->submitRequestCached($aRequest, $iLifeTime);
            if ($aResponse['STATUS'] == 'SUCCESS' && isset($aResponse['DATA']) && is_array($aResponse['DATA'])) {
                return $aResponse['DATA'];
            } else {
                return array();
            }
        } catch (MagnaException $e) {
            return array();
        }
    }

    /**
     * Returns available images sizes
     *
     * @param $aField
     * @return void
     */
    public function imagesizeField(&$aField) {
        $startSize = 500;
        $maxSize = 1500;

        $aField['values'] = array();

        for ($i = $startSize; $i <= $maxSize; $i += 100) {
            $aField['values'][(string)$i] = $i."px";
        }
    }

    public function orderimport_shopField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getShopValues();
    }

    public function setRequestOptional($aRequestOptional = array()) {
        $this->aRequestOptional = $aRequestOptional;
        return $this;
    }

    /**
     * setting values with high priority eg. request
     * @param array $aRequestFields
     * @return \ML_Ebay_Helper_Ebay_Prepare
     */
    public function setRequestFields($aRequestFields = array()) {
        $this->aRequestFields = $aRequestFields;
        return $this;
    }

    protected function getRequestField($sName = null, $blOptional = false) {
        $sName = strtolower($sName);
        if ($blOptional) {
            $aFields = $this->aRequestOptional;
        } else {
            $aFields = $this->aRequestFields;
        }
        $aFields = array_change_key_case($aFields, CASE_LOWER);
        if ($sName == null) {
            return $aFields;
        } else {
            return isset($aFields[$sName]) ? $aFields[$sName] : null;
        }
    }

    /**
     * checks if a field is active, or not
     *
     * @param type $aField
     * @param bool $blDefault defaultvalue, if  no request or dont find in prepared
     * @return bool
     */
    public function optionalIsActive($aField) {
        if (isset($aField['optional']['active'])) {
            // 1. already setted
            $blActive = $aField['optional']['active'];
        } else {
            if (is_string($aField)) {
                $sField = $aField;
            } else {
                if (isset($aField['optional']['name'])) {
                    $sField = $aField['optional']['name'];
                } else {
                    $sField = isset($aField['realname']) ? $aField['realname'] : $aField['name'];
                }
            }
            $sField = strtolower($sField);
            // 2. get from request
            $sActive = $this->getRequestField($sField, true);
            if ($sActive == 'true' || $sActive === true) {
                $blActive = true;
            } elseif ($sActive == 'false' || $sActive === false) {
                $blActive = false;
            } else {
                $blActive = null;
            }
        }
        return $blActive;
    }

    public function preimport_startField(&$aField) {
        $aField['values'] = date('Y-m-d');
    }

    public function orderimport_shippingmethodField(&$aField) {
        if (isset($aField['type']) && $aField['type'] == 'select') {
            if (method_exists(MLFormHelper::getShopInstance(), 'getShippingMethodValues')) {
                $aField['values'] = MLFormHelper::getShopInstance()->getShippingMethodValues();
            } else {
                try {
                    $sMpName = MLModule::gi()->getMarketPlaceName(false);
                    $aField['values'] = array($sMpName => $sMpName);
                } catch (Exception $ex) {

                }
            }
        }
    }

    public function orderimport_paymentmethodField(&$aField) {
        if (isset($aField['type']) && $aField['type'] == 'select') {
            if (method_exists(MLFormHelper::getShopInstance(), 'getPaymentMethodValues')) {
                $aField['values'] = MLFormHelper::getShopInstance()->getPaymentMethodValues();
            } else {
                try {
                    $sMpName = MLModule::gi()->getMarketPlaceName(false);
                    $aField['values'] = array($sMpName => $sMpName);
                } catch (Exception $ex) {

                }
            }
        }
    }

    public function orderimport_paymentstatusField(&$aField) {
        if (isset($aField['type']) && $aField['type'] == 'select') {
            if (method_exists(MLFormHelper::getShopInstance(), 'getPaymentStatusValues')) {
                $aField['values'] = MLFormHelper::getShopInstance()->getPaymentStatusValues();
            } else {
                try {
                    $sMpName = MLModule::gi()->getMarketPlaceName(false);
                    $aField['values'] = array($sMpName => $sMpName);
                } catch (Exception $ex) {

                }
            }
        }
    }

    /**
     * Gets languages for config form.
     *
     * @param array $aField
     */
    public function langField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getDescriptionValues();
    }

    /**
     * @param $aField
     * @throws MLAbstract_Exception
     * @throws ML_Filesystem_Exception
     */
    public function exchangerate_updateField(&$aField) {
        if (MLShop::gi()->isCurrencyMatchingNeeded()) {
            $modulCurrency = MLModule::gi()->getConfig('currency');
            $shopCurrency = MLHelper::gi('model_price')->getShopCurrency();
            $mpCurrency = empty($modulCurrency) ? getCurrencyFromMarketplace(MLModule::gi()->getMarketPlaceId()) : $modulCurrency;

            if (!empty($mpCurrency) && (strtoupper($shopCurrency) !== strtoupper($mpCurrency))) {
                MLSettingRegistry::gi()->addJs('magnalister.woocommerce.currencypopup.js');
                $exchangeRateValue = MLModule::gi()->getExchangeRateRatio($shopCurrency, $mpCurrency) ?: 1;
                $cache = MLCache::gi()->get('currencyExchangeRateFrom'.$shopCurrency.'To'.$mpCurrency);
                $cacheTime = $cache['TIMESTAMP'];
                $cacheTime = DateTime::createFromFormat('Y-d-m\TH:i:s.uP', $cacheTime);
                $aField['type'] = 'information';
                $aField['value'] = sprintf(MLI18n::gi()->get('ML_CHECKCURRENCY_INFO'), $shopCurrency, $exchangeRateValue, $mpCurrency, $cacheTime->format('d.m.Y H:i:s'));
            } else {
                $aField['value'] = '0';
                $aField['disabled'] = "disabled";
            }
        }
    }

    /**
     * For attribute matching you should implement this function
     * @param $aField
     * @return mixed
     */
    abstract public function primaryCategoryField(&$aField);

    public function strikeprice_addKindField(&$aField) {
        $aField['values'] = MLI18n::gi()->get('configform_price_addkind_values');
    }

    public function strikeprice_groupField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getCustomerGroupValues();
    }

    public function strikeprice_kindField(&$aField) {
        $aField['values'] = MLI18n::gi()->get('configform_strikeprice_kind_values');
    }

    public function invoice_invoicenumber_matchingField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getOrderFreeTextFieldsAttributes();
    }

    public function invoice_reversalinvoicenumber_matchingField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getOrderFreeTextFieldsAttributes();
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
     * ERP Invoice
     * @param $aField
     */
    public function invoice_erpinvoicesourceField(&$aField) {
        if ($aField['value'] === null) {
            $path = MLFilesystem::gi()->getWritablePath(
                implode(
                    DIRECTORY_SEPARATOR,
                    array('Receipts', MLModule::gi()->getMarketPlaceName(false), 'ToBeProcessed', 'Invoices')
                )
            );
            $aField['value'] = $this->getAndGenerateErpDirectoryPath($path);
        }
    }

    /**
     * ERP Invoice
     * @param $aField
     */
    public function invoice_erpinvoicedestinationField(&$aField) {
        if ($aField['value'] === null) {
            $path = MLFilesystem::gi()->getWritablePath(
                implode(
                    DIRECTORY_SEPARATOR,
                    array('Receipts', MLModule::gi()->getMarketPlaceName(false), 'Processed', 'Invoices')
                )
            );
            $aField['value'] = $this->getAndGenerateErpDirectoryPath($path);
        }
    }

    /**
     * ERP Invoice
     * @param $aField
     */
    public function invoice_erpreversalinvoicesourceField(&$aField) {
        if ($aField['value'] === null) {
            $path = MLFilesystem::gi()->getWritablePath(
                implode(
                    DIRECTORY_SEPARATOR,
                    array('Receipts', MLModule::gi()->getMarketPlaceName(false), 'ToBeProcessed', 'CreditNotes')
                )
            );
            $aField['value'] = $this->getAndGenerateErpDirectoryPath($path);
        }
    }

    /**
     * ERP Invoice
     * @param $aField
     */
    public function invoice_erpreversalinvoicedestinationField(&$aField) {
        if ($aField['value'] === null) {
            $path = MLFilesystem::gi()->getWritablePath(
                implode(
                    DIRECTORY_SEPARATOR,
                    array('Receipts', MLModule::gi()->getMarketPlaceName(false), 'Processed', 'CreditNotes')
                )
            );
            $aField['value'] = $this->getAndGenerateErpDirectoryPath($path);
        }
    }

    public function invoice_optionField(&$aField) {
        $aField['values'] = MLI18n::gi()->get('formfields_uploadInvoiceOption_values');
        if (in_array(MLShop::gi()->getShopSystemName(), array('woocommerce', 'shopify'))) {
            unset($aField['values']['webshop']);
        }
        if (in_array(MLShop::gi()->getShopSystemName(), array('shopify'))) {
            unset($aField['values']['erp']);
        }
    }

}
