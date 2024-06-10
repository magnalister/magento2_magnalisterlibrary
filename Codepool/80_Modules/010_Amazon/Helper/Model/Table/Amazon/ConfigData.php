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

MLFilesystem::gi()->loadClass('Form_Helper_Model_Table_ConfigData_Abstract');

class ML_Amazon_Helper_Model_Table_Amazon_ConfigData extends ML_Form_Helper_Model_Table_ConfigData_Abstract {

    protected $carrierOptions = array(
        'marketplaceCarrier',
        'shopFreeTextField',
        'matchShopShippingOptions',
        'databaseMatching',
        'orderFreeTextField',
        'freeText',
    );

    protected $shipmethodOptions = array(
        'shopFreeTextField',
        'matchShopShippingOptions',
        'databaseMatching',
        'orderFreeTextField',
        'freeText',
    );

    protected $timeUnits = array(
        'Days',
        'Hours',
        'Minutes',
    );
    protected $refundReasons = array(
        'NoInventory',
        'CustomerReturn',
        'GeneralAdjustment',
        'CouldNotShip',
        'DifferentItem',
        'Abandoned',
        'CustomerCancel',
        'PriceError',
    );

    protected $countryCodes = array(
        'JP' => 'JP',
        'US' => 'US',
        'TR' => 'TR',
        'AU' => 'AU',
        'SP' => 'SP',
        'ES' => 'ES',
        'GB' => 'UK',
        'FR' => 'FR',
        'DE' => 'DE',
        'IT' => 'IT',
        'CA' => 'CA',
        'NL' => 'NL',
        'SE' => 'SE',
        'PL' => 'PL',
        'SG' => 'SG',
    );

    /**
     * Gets Site list of amazon for config form.
     * 
     * @param array $aField
     */
    public function siteField(&$aField) {
        foreach (MLModule::gi()->getMarketPlaces() as $aMarketplace) {
            $aField['values'][$aMarketplace['Key']] = fixHTMLUTF8Entities($aMarketplace['Label']);
        }
        array_unshift($aField['values'],MLI18n::gi()->get('form_type_matching_select_optional'));
    }   
    
    /**
     * Gets Currency list of amazon for config form.
     */
    public function currencyField(&$aField) {
        foreach (MLModule::gi()->getMarketPlaces() as $aMarketplace) {
            $aField['values'][$aMarketplace['Key']] = fixHTMLUTF8Entities($aMarketplace['Currency']);
        }
    }
    /**
     * Gets Laguage list of amazon for config form.
     */
    public function langField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getDescriptionValues();
    }
    
    public function internationalShippingField(&$aField) {
        $aField['values'] = MLFormHelper::getModulInstance()->getShippingLocationValues();
    }
    
    public function leadtimetoshipField(&$aField) {
        $aField['values']['-'] = MLI18n::gi()->get('ML_AMAZON_SHIPPING_TIME_DEFAULT_VALUE');
        $aField['values']['0'] = MLI18n::gi()->get('ML_AMAZON_SHIPPING_TIME_SAMEDAY_VALUE');
        for ($i = 1; $i < 31; $i++) {
             $aField['values'][$i.''] = $i;
        }
        
    }
    public function orderstatus_syncField (&$aField) {
        $aField['values'] = MLI18n::gi()->get('amazon_configform_orderstatus_sync_values');
    }
    public function stocksync_toMarketplaceField (&$aField) {
        $aField['values'] = MLI18n::gi()->get('amazon_configform_sync_values');
    }
    
    public function stocksync_fromMarketplaceField (&$aField) {
        $aField['values'] = MLI18n::gi()->get('amazon_configform_stocksync_values');
    }    
    
    public function inventorysync_priceField (&$aField) {
        $aField['values'] = MLI18n::gi()->get('amazon_configform_pricesync_values');
    }
    
    public function importField (&$aField) {
        $aField['value'] = isset($aField['value']) && in_array($aField['value'], array('true','false') )? $aField['value'] : 'true';
        $aField['values'] = array('true' => MLI18n::gi()->get('ML_BUTTON_LABEL_YES'),'false' => MLI18n::gi()->get('ML_BUTTON_LABEL_NO'));
    }
    
    public function mail_sendField(&$aField) {
        $aField['values'] = array(
            "true" => MLI18n::gi()->get('ML_BUTTON_LABEL_YES'),
            "false" => MLI18n::gi()->get('ML_BUTTON_LABEL_NO'));
    }    
    
    public function mail_copyField(&$aField) {
        $aField['values'] = array(
            "true" => MLI18n::gi()->get('ML_BUTTON_LABEL_YES'),
            "false" => MLI18n::gi()->get('ML_BUTTON_LABEL_NO'));
    }
    
    public function orderstatus_fbaField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getOrderStatusValues();
    }
    
    public function orderstatus_cancelledField(&$aField) {
        $this->orderstatus_canceledField($aField);
    }
    
    public function orderimport_shippingmethodField (&$aField) {
        if(method_exists(MLFormHelper::getShopInstance(), 'getShippingMethodValues')){
            $aField['values'] = MLFormHelper::getShopInstance()->getShippingMethodValues();
        }else{
            $aField['values'] = MLI18n::gi()->get('amazon_configform_orderimport_shipping_values');
        }        
    }
    
    public function orderimport_paymentmethodField (&$aField) {
        $aField['values'] = MLI18n::gi()->get('amazon_configform_orderimport_payment_values');
    }
    
    public function orderimport_fbashippingmethodField (&$aField) {
        $this->orderimport_shippingmethodField($aField);
    }
    
    public function orderimport_fbapaymentmethodField (&$aField) {
        $aField['values'] = MLI18n::gi()->get('amazon_configform_orderimport_payment_values');
    }
    
    public function shippingservice_carrierwillpickupField(&$aField) {
        $aService = MLModule::gi()->MfsGetConfigurationValues('ServiceOptions');
        $aField['values'] = array_key_exists('CarrierWillPickUp', $aService) ? $aService['CarrierWillPickUp'] : array();
    }
    
    public function shippingservice_deliveryexperienceField(&$aField) {
        $aService = MLModule::gi()->MfsGetConfigurationValues('ServiceOptions');
        $aField['values'] = array_key_exists('DeliveryExperience', $aService) ? $aService['DeliveryExperience'] : array();
    }
     
    public function shippinglabel_size_unitField(&$aField) {
        $aField['values'] = MLModule::gi()->MfsGetConfigurationValues('SizeUnits');
    }
     
    public function shippinglabel_weight_unitField(&$aField) {
        $aField['values'] = MLModule::gi()->MfsGetConfigurationValues('WeightUnits');
    }
    
    public function shippinglabel_address_countryField(&$aField) {
        $aField['values'] = MLModule::gi()->MfsGetConfigurationValues('Countries');
    }

    public function b2b_price_addKindField (&$aField) {
        $aField['values'] = MLI18n::gi()->get('configform_price_addkind_values');
    }

    public function b2b_price_factorField (&$aField) {
        $aField['value'] = isset($aField['value']) ? str_replace(',', '.',trim($aField['value'])) : 0;
        if ((string)((float)$aField['value']) != $aField['value']) {
            $this->addError($aField, MLI18n::gi()->get('configform_price_factor_error'));
        } else {
            $aField['value'] = number_format($aField['value'], 2);
        }
    }

    public function b2b_price_signalField (&$aField) {
        $aField['value'] = isset($aField['value']) ? str_replace(',', '.',trim($aField['value'])) : '';
        if (!empty($aField['value']) && (string)((int)$aField['value']) != $aField['value']) {
            $this->addError($aField, MLI18n::gi()->get('configform_price_signal_error'));
        }
    }

    public function b2b_price_groupField (&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getCustomerGroupValues();
    }

    public function b2b_tax_code_categoryField(&$aField)
    {
        $aField['values'] = array('' => MLI18n::gi()->get('form_type_matching_select_optional'))
            + MLModule::gi()->getMainCategories();
    }

    public function b2bselltoField(&$aField) {
        $aField['values'] = $aField['i18n']['values'];
    }

    public function b2bdiscounttypeField(&$aField) {
        $aField['values'] = $aField['i18n']['values'];
    }

    public function b2b_tax_codeField(&$aField) {
        $this->setTaxMatchingField($aField);
    }
    
    public function b2b_tax_code_specificField(&$aField)
    {
        $catSelector = 'b2b.tax_code_category';

        $aField['ajax'] = array(
            'selector' => '#' . $this->getFieldId($catSelector),
            'trigger' => 'change',
            'duplicated' => true,
            'field' => array(
                'type' => 'matching',
            ),
        );

        $aField['cssclass'] = 'js-b2b';

        $selectedCat = $this->getRequestField($catSelector);
        if ($selectedCat) {
            $category = reset($selectedCat);
            if (isset($aField['postname'])) {
                // this means ajax call. field is inside "duplicate" so it has "[X]" suffix
                // and this is index of value for selected category
                $oldName = explode('][', $aField['postname']);
                $valueKey = rtrim(end($oldName), ']');
                if (isset($selectedCat[$valueKey])) {
                    $category = $selectedCat[$valueKey];
                }
            }
        } else {
            $category = MLModule::gi()->getConfig($catSelector);
            $category = $category ? reset($category) : '';
        }

        $this->setTaxMatchingField($aField, $category);
        if (empty($category)) {
            // hide field. do not add type => hidden because we need the field for ajax to work properly.
            $aField['cssclass'] = 'hide';
        }
    }

    private function setTaxMatchingField(&$aField, $category = '') {
        $shopTaxes = MLFormHelper::getShopInstance()->getTaxClasses();
        $aField['valuessrc'] = array();
        if ($shopTaxes) {
            foreach ($shopTaxes as $tax) {
                $aField['valuessrc'][$tax['value']] = array('i18n' => $tax['label'], 'required' => true);
            }
        }

        $aField['valuesdst'] = array('' => MLI18n::gi()->get('form_type_matching_select_optional'))
            + $this->callApi(array(
                'ACTION' => 'GetB2BProductTaxCode',
                'CATEGORY' => $category,
            ), 60);
    }
    
    public function itemConditionField(&$aField){
        $aField['values'] = MLFormHelper::getModulInstance()->getConditionValues();
    }

    /**
     * For attribute matching you should implement this function
     * but amazon use some other method for primaryCategory
     * @param $aField
     * @return mixed
     */
    public function primaryCategoryField(&$aField) {

    }

    public function amazonvcsinvoice_invoicenumber_matchingField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getOrderFreeTextFieldsAttributes();
    }

    public function amazonvcsinvoice_reversalinvoicenumber_matchingField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getOrderFreeTextFieldsAttributes();
    }

    /**
     * Populates the select for carriers
     *
     * @param $options
     * @param $aField
     * @param $matchType - carrier or shipmethod
     * @return mixed
     * @throws MLAbstract_Exception
     */
    protected function selectWithMatchingOptionsFromTypeValueGenerator($options, $aField, $matchType) {
        // list of available options
        if (empty($options)) {
            $options = array(
                'marketplaceCarrier',
                'shopFreeTextField',
                'matchShopShippingOptions',
                'databaseMatching',
                'orderFreeTextField',
                'freeText',
            );
        }

        $optGroups = array();
        $marketplaceCarriers = array();
        $matchingElement = array();
        // First element is pure text that explains that nothing is selected so it should not be added
        $aFirstElement = array('' => MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT'));

        // Marketplace carriers
        if (in_array('marketplaceCarrier', $options)) {
            $apiMarketplaceCarriers = MLModule::gi()->getCarrierCodes();
            foreach ($apiMarketplaceCarriers as $key => $marketplaceCarrier) {
                if ($marketplaceCarrier === 'Other') {
                    continue;
                }
                $marketplaceCarriers[$marketplaceCarrier] = $marketplaceCarrier;
            }

            if (!empty($apiMarketplaceCarriers)) {
                $marketplaceCarriers['optGroupClass'] = 'marketplaceCarriers';
                $optGroups += array(MLI18n::gi()->get('amazon_config_carrier_option_group_marketplace_carrier') => $marketplaceCarriers);
            }
        }

        // Free text fields - additional fields
        if (in_array('shopFreeTextField', $options) && method_exists(MLFormHelper::getShopInstance(), 'getOrderFreeTextFieldsAttributes')) {
            $aShopFreeTextFieldsAttributes = MLFormHelper::getShopInstance()->getOrderFreeTextFieldsAttributes();
            if (!empty($aShopFreeTextFieldsAttributes)) {
                $aShopFreeTextFieldsAttributes['optGroupClass'] = 'freetextfield';
                $optGroups += array(MLI18n::gi()->get('amazon_config_carrier_option_group_shopfreetextfield_option_'.$matchType).':' => $aShopFreeTextFieldsAttributes);
            }
        }

        // matching option key value "returnCarrierMatching" must be the same as "matching" value on form fields
        if (in_array('matchShopShippingOptions', $options)) {
            $matchingElement['matchShopShippingOptions'] = MLI18n::gi()->get('amazon_config_carrier_option_matching_option_'.$matchType);
        }
        // Database matching will be implemented later on
        if (false && in_array('databaseMatching', $options)) {
            $matchingElement['database'] = MLI18n::gi()->get('amazon_config_carrier_option_database_option');
        }
        // Check for Order FreeText Field Option
        if (in_array('orderFreeTextField', $options)) {
            $matchingElement['orderFreetextField'] = MLI18n::gi()->get('amazon_config_carrier_option_orderfreetextfield_option');
        }
        // Check for FreeText Option
        if (in_array('freeText', $options)) {
            $matchingElement['freetext'] = MLI18n::gi()->get('amazon_config_carrier_option_freetext_option_'.$matchType);
        }
        if (!empty($matchingElement)) {
            $matchingElement['optGroupClass'] = 'matching';
            $optGroups += array(MLI18n::gi()->get('amazon_config_carrier_option_group_additional_option') => $matchingElement);
        }

        $aField['values'] = $aFirstElement + $optGroups;
        return $aField;
    }

    public function orderstatus_carrier_selectField(&$field) {
        $field = $this->selectWithMatchingOptionsFromTypeValueGenerator($this->carrierOptions, $field, 'carrier');
    }

    public function orderstatus_shipmethod_selectField(&$field) {
        $field = $this->selectWithMatchingOptionsFromTypeValueGenerator($this->shipmethodOptions, $field, 'shipmethod');
    }

    public function orderstatus_shippedaddressField(&$field) {
        $field['values'] = MLFormHelper::getShopInstance()->getOrderStatusValues();
    }

    /**
     * Populates two drop downs for select
     *
     * @param $field
     * @param bool $carrierMatching
     * @return mixed
     * @throws MLAbstract_Exception
     */
    public function carrierOrShipMethodMatching($field, $carrierMatching = true) {
        $field['i18n']['matching'] = array(
            'titlesrc' => MLI18n::gi()->get('amazon_config_carrier_matching_title_marketplace_shipmethod'),
            'titledst' => MLI18n::gi()->get('amazon_config_carrier_matching_title_shop_carrier')
        );
        $field['valuesdst'] = array('' => MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT'));
        $field['valuessrc'] = array('' => MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT'));

        $shopCarriers = MLFormHelper::getShopInstance()->getShopShippingModuleValues();
        if (!empty($shopCarriers)) {
            $field['valuesdst'] = $field['valuesdst'] + $shopCarriers;
        }


        if ($carrierMatching) {
            $field['i18n']['matching']['titlesrc'] = MLI18n::gi()->get('amazon_config_carrier_matching_title_marketplace_carrier');
            $aMarketplaceCarriers = array();
            foreach (MLModule::gi()->getCarrierCodes() as $key => $marketplaceCarrier) {
                $aMarketplaceCarriers[$marketplaceCarrier] = $marketplaceCarrier;
            }
            $aMarketplaceCarriers['Other'] = MLI18n::gi()->amazon_config_carrier_other;
            if (!empty($aMarketplaceCarriers)) {
                $field['valuessrc'] = $field['valuessrc'] + $aMarketplaceCarriers;
            }
        }

        return $field;
    }

    public function orderstatus_carrier_matchingField(&$field) {
        $field = $this->carrierOrShipMethodMatching($field);
    }

    public function orderstatus_shipmethod_matchingField(&$field) {
        $field = $this->carrierOrShipMethodMatching($field, false);
    }

    public function orderstatus_shippedaddress_countrycodeField(&$aField) {
        $aField['values'] = MLModule::gi()->MfsGetConfigurationValues('Countries');
    }

    public function imagesizeField(&$aField) {
        $aField['values'] =  array(
            500 => '500px',
            600 => '600px',
            700 => '700px',
            800 => '800px',
            900 => '900px',
            1000 => '1000px',
            1200 => '1200px',
            1300 => '1300px',
            1400 => '1400px',
            1500 => '1500px',
            1600 => '1600px',
            1700 => '1700px',
            1800 => '1800px',
            1900 => '1900px',
            2000 => '2000px',
            2100 => '2100px',
            2200 => '2200px',
            2300 => '2300px',
            2400 => '2400px',
            2500 => '2500px',
            2600 => '2600px',
            2700 => '2700px',
            2800 => '2800px',
            2900 => '2900px',
            3000 => '3000px',
            3100 => '3100px',
            3200 => '3200px',
            3300 => '3300px',
            3400 => '3400px',
            3500 => '3500px',
            3600 => '3600px',
            3700 => '3700px',
            3800 => '3800px',
            3900 => '3900px',
        );
    }

    /**
     * Fetch currently active BOPIS-Stores from Amazon
     * @param $aField
     */
    public function bopis_array_address_countrycodeField(&$aField) {
        $values = array();
        foreach ($this->countryCodes as $code => $countryCode) {
            $values[$code] = $countryCode;
        }
        $aField['values'] = $values;
    }

    /**
     * Fetch currently active BOPIS-Stores from Amazon
     * @param $aField
     */
    public function bopis_array_capabilities_returnlocation_address_countrycodeField(&$aField) {
        // same logic
        $this->bopis_array_address_countrycodeField($aField);
    }

    /**
     * Fetch currently active BOPIS-Stores from Amazon
     * @param $aField
     */
    public function bopis_array_configuration_timezoneField(&$aField) {
        $values = array();
        foreach (MLModule::gi()->GetAmazonTimezones() as $timezone) {
            $values[$timezone] = $timezone;
        }
        $aField['values'] = $values;
    }

    public function bopis_storesField(&$aField) {
        $values = array();
        $aStoreAliases = MLModule::gi()->getConfig('bopis.array.alias');
        $values[''] = MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT');
        if (!is_array($aStoreAliases)) {
            $aStoreAliases = array();
        }
        foreach ($aStoreAliases as $key => $sStoreAlias) {
            $values[$key] = $sStoreAlias;
        }
        $iStoreIndex = MLRequest::gi()->data('storeindex');
        $aField['value'] = $iStoreIndex;
        $aField['values'] = $values;
    }

    /**
     * Fetch currently active BOPIS-Stores from Amazon
     * @param $aField
     */
    public function bopis_array_capabilities_pickupchannel_inventoryholdperiod_timeUnitField(&$aField) {
        foreach ($this->timeUnits as $timeUnit) {
            $values[$timeUnit] = MLI18n::gi()->get('amazon_bopis.handling_time_'.$timeUnit);
        }
        $aField['values'] = $values;
    }


    /**
     * Fetch currently active BOPIS-Stores from Amazon
     * @param $aField
     */
    public function bopis_array_configuration_handlingtime_timeUnitField(&$aField) {
        foreach ($this->timeUnits as $timeUnit) {
            $values[$timeUnit] = MLI18n::gi()->get('amazon_bopis.handling_time_'.$timeUnit);
        }
        $aField['values'] = $values;
    }

    /**
     * Fetch currently active BOPIS-Stores from Amazon
     * @param $aField
     */
    public function bopis_array_capabilities_pickupchannel_handlingtime_timeUnitField(&$aField) {
        foreach ($this->timeUnits as $timeUnit) {
            $values[$timeUnit] = MLI18n::gi()->get('amazon_bopis.handling_time_'.$timeUnit);
        }
        $aField['values'] = $values;
    }

    /**
     * Fetch currently active BOPIS-Stores from Amazon
     * @param $aField
     */
    public function bopis_array_configuration_operationalconfiguration_throughputConfig_timeUnitField(&$aField) {
        foreach ($this->timeUnits as $timeUnit) {
            $values[$timeUnit] = MLI18n::gi()->get('amazon_bopis.handling_time_'.$timeUnit);
        }
        $aField['values'] = $values;
    }

    /**
     * Fetch currently active BOPIS-Stores from Amazon
     * @param $aField
     */
    public function bopis_array_capabilities_operationalconfiguration_throughputConfig_timeUnitField(&$aField) {
        foreach ($this->timeUnits as $timeUnit) {
            $values[$timeUnit] = MLI18n::gi()->get('amazon_bopis.handling_time_'.$timeUnit);
        }
        $aField['values'] = $values;
    }

    /**
     * Fetch currently active BOPIS-Stores from Amazon
     * @param $aField
     */
    public function bopis_array_capabilities_deliverychannel_operationalconfiguration_throughputConfig_timeUnitField(&$aField) {
        foreach ($this->timeUnits as $timeUnit) {
            $values[$timeUnit] = MLI18n::gi()->get('amazon_bopis.handling_time_'.$timeUnit);
        }
        $aField['values'] = $values;
    }

    /**
     * Fetch currently active BOPIS-Stores from Amazon
     * @param $aField
     */
    public function bopis_array_capabilities_pickupchannel_operationalconfiguration_throughputConfig_timeUnitField(&$aField) {
        $aField['values'] = $this->getTimeUnitValues();
    }

    private function getTimeUnitValues() {
        $values = array();
        foreach ($this->timeUnits as $timeUnit) {
            $values[$timeUnit] = MLI18n::gi()->get('amazon_bopis.handling_time_'.$timeUnit);
        }
        return $values;
    }

    /**
     * Fetch currently active BOPIS-Stores from Amazon
     * @param $aField
     */
    public function bopis_orderstatus_updatesField(&$aField) {
        $aField['values'] = array('Sync with Shop', 'Allocate manually');

    }

    public function bopis_orderstatus_readyForPickupField(&$field) {
        $field['values'] = MLFormHelper::getShopInstance()->getOrderStatusValues();
        $field['values'] = array('' => MLI18n::gi()->get('ML_LABEL_DONT_USE')) + $field['values'];
    }

    public function bopis_orderstatus_pickedUpField(&$field) {
        $field['values'] = MLFormHelper::getShopInstance()->getOrderStatusValues();
        $field['values'] = array('' => MLI18n::gi()->get('ML_LABEL_DONT_USE')) + $field['values'];
    }

    public function bopis_orderstatus_refundField(&$field) {
        $field['values'] = MLFormHelper::getShopInstance()->getOrderStatusValues();
        $field['values'] = array('' => MLI18n::gi()->get('ML_LABEL_DONT_USE')) + $field['values'];
    }

    public function bopis_orderstatus_openField(&$field) {
        $field['values'] = MLFormHelper::getShopInstance()->getOrderStatusValues();
    }

    public function bopis_refund_reasonField(&$field) {
        $field['values'] = array();
        $values[''] =MLI18n::gi()->get('ML_LABEL_DONT_USE');
        foreach ($this->refundReasons as $refundReason) {
            $values[$refundReason] = MLI18n::gi()->get('amazon_bopis.refund.reason_'.$refundReason);
        }
        $field['values'] = $values;
    }

    /**
     * Fetch currently active BOPIS-Stores from Amazon
     * @param $aField
     */
    public function bopis_stockmanagement_storeField(&$aField) {
        $aField['values'] = MLModule::gi()->GetBopisStores();
    }

    /**
     * "bopis.stockmanagement.quantity.type" set values and translation
     *
     * @param $aField
     * @return void
     */
    public function bopis_stockmanagement_quantity_typeField(&$aField) {
        $pleaseSelect = array('' => MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT'));
        $defaultStockSettings = MLSetting::gi()->getGlobal('configform_quantity_values');

        foreach ($defaultStockSettings as &$setting) {
            $setting['optGroupClass'] = 'defaultShopSettings';
        }

        //@ToDo
        $shopExclusiveSettings = array();
        if (false) {
            $shopExclusiveSettings = array(
                'warehouse1' => array(
                    'title' => 'Use Stock of "Warehouse1"',
                    'textoption' => 0,
                ),
                'warehouse2' => array(
                    'title' => 'Use Stock of "Warehouse2"',
                    'textoption' => 0,
                )
            );
        }

        $aField['values'] = $pleaseSelect + $defaultStockSettings + $shopExclusiveSettings;
        if (MLI18n::gi()->isTranslationActive()) {
            foreach ($aField['values'] as $key => &$value) {
                $value['translationData'] = MLI18n::gi()->getTranslationData("configform_quantity_values_{$key}_title");
            }
        }
    }

    /**
     * "bopis.stockmanagement.quantity.value" set value and validation
     *
     * @param $aField
     * @return void
     * @throws MLAbstract_Exception
     */
    public function bopis_stockmanagement_quantity_valueField(&$aField) {
        $aField['value'] = isset($aField['value']) ? $aField['value'] : array(0);

        if (is_array($aField['value'])) {
            $configQuantityType = MLModule::gi()->getConfig('bopis.stockmanagement.quantity.type');
            foreach ($aField['value'] as $key => $value) {
                if ($configQuantityType != 'stock' && (string)((int)$value) != $value) {
                    $this->addError($aField, MLI18n::gi()->get('configform_quantity_value_error'));
                }
            }
        }
    }

}
