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

MLFilesystem::gi()->loadClass('Form_Helper_Model_Table_ConfigData_Abstract');

class ML_Otto_Helper_Model_Table_Otto_ConfigData extends ML_Form_Helper_Model_Table_ConfigData_Abstract {

    public function processingTimeField(&$aField) {
        for ($i = 0; $i < 100; $i++) {
            $aField['values'][$i] = $i;
        }
    }

    /**
     * Offer Select and FreeText option in shop order details of shop
     *
     * @param $aField
     * @throws MLAbstract_Exception
     */
    public function orderstatus_returncarrier_selectField(&$aField) {
        if (isset($aField['matching'])) {
            $aField = $this->carrierWithFreeText($aField['matching'], $aField, 'return');
        }
    }

    public function orderstatus_returncarrier_matchingField(&$aField) {
        $aField = $this->carrierMatching($aField, 'return');
//        $this->duplicateValidation($aField, 'return.carrier');
    }

    /**
     * Commom Option to enter return tracking information on Order Details pages of shop
     *
     * @param $aField
     * @throws MLAbstract_Exception
     */
    public function orderstatus_returntrackingkeyField(&$aField) {
        $aField['values'] = array(
            'orderFreeTextField' => MLI18n::gi()->get('otto_config_free_text_attributes_opt_group_value'),
        );
    }

    public function orderstatus_sendcarrier_selectField (&$aField) {
        if (isset($aField['matching'])) {
            $aField = $this->carrierSelect($aField['matching'], $aField);
        }
    }

    public function orderstatus_sendcarrier_matchingField(&$aField) {
        $aField = $this->carrierMatching($aField);
//        $this->duplicateValidation($aField, 'orderstatus.standardshipping');
    }

    public function orderstatus_forwardercarrier_selectField (&$aField) {
        if (isset($aField['matching'])) {
            $aField = $this->carrierSelect($aField['matching'], $aField, 'forwarding');
        }
    }

    public function orderstatus_forwardercarrier_matchingField(&$aField) {
        $aField = $this->carrierMatching($aField, 'forwarding');
//        $this->duplicateValidation($aField, 'orderstatus.forwardershipping');
    }

    public function shippingtypeField(&$aField) {
        $aField['values'] = array(
            'PARCEL' => 'PARCEL',
            'FORWARDER' => 'FORWARDER',
        );
    }

    public function vatField(&$aField) {
        $this->setTaxMatchingField($aField);
    }

    private function setTaxMatchingField(&$aField) {
        $shopTaxes = MLFormHelper::getShopInstance()->getTaxClasses();
        $aField['valuessrc'] = array();
        if ($shopTaxes) {
            foreach ($shopTaxes as $tax) {
                $aField['valuessrc'][$tax['value']] = array('i18n' => $tax['label'], 'required' => true);
            }
        }

        $aField['valuesdst'] = array('' => MLI18n::gi()->get('form_type_matching_select_optional'))
            + $this->callApi(array('ACTION' => 'GetVatCodes', 'SUBSYSTEM' => 'otto'), 60);
    }

    public function deliverytypeField(&$aField) {
        $aField['values'] = array(
            'PARCEL' => MLI18n::gi()->get('ML_OTTO_DELIVERYTYPE_PARCEL'),
            'FORWARDER_PREFERREDLOCATION' => MLI18n::gi()->get('ML_OTTO_DELIVERYTYPE_FORWARDER_PREFERREDLOCATION'),
            'FORWARDER_CURBSIDE' => MLI18n::gi()->get('ML_OTTO_DELIVERYTYPE_FORWARDER_CURBSIDE')
        );
    }

    public function deliverytimeField(&$aField) {
        $days = array();
        $i = 1;
        while ($i <= 90) {
            $days[$i.''] = $i;
            $i++;
        }

        $aField['values'] = $days;
    }

    public function orderstatus_acceptedField(&$aField) {
        $this->orderstatus_canceledField($aField);
        $aField['values'] = array('auto' => 'Auto Acceptance') + $aField['values'];
    }

    public function primaryCategoryField(&$aField) {
        $aRequest = MLRequest::gi()->data();
        if (MLModul::gi()->getMarketPlaceName().':'.MLModul::gi()->getMarketPlaceId().'_prepare_variations' === $aRequest['controller']) {
            $aField['values'] = MLDatabase::factory(MLModul::gi()->getMarketPlaceName() . '_variantmatching')->getTopPrimaryCategories();
        } else {
            $aField['values'] = MLDatabase::factory( MLModul::gi()->getMarketPlaceName() . '_prepare')->getTopPrimaryCategories();
        }
    }

    public function orderstatus_shippedaddress_codeField(&$aField) {
        $aField['values'] = MLModul::gi()->getOttoShippingSettings('countries');
    }
//    public function orderstatus_shippedaddress_cityField(&$aField) {
//        $this->duplicateValidation($aField, 'orderstatus.shippedaddress');
//    }
//    public function orderstatus_shippedaddress_zipField(&$aField) {
//        $this->duplicateValidation($aField, 'orderstatus.shippedaddress');
//    }

    // only for shopify and shopware payment status


    public function orderstatus_shippedaddressField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getOrderStatusValues();
    }

    public function orderstatus_confirm_shippingField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getOrderStatusValues();
    }

    public function orderstatus_carrier_defaultField(&$aField) {
        $aField['values'] = array('auto' => 'no entry');
    }

    public function paymentmethodsField(&$aField) {
        $aField['values'] = array('auto' => 'Automatic Allocation');
    }

    public function shippingserviceField(&$aField) {
        $aField['values'] = array('auto' => 'Automatic Allocation');
    }

    public function customfieldshipingtrackingnumberField(&$aField) {
        $aField['values'] = array('' => 'Choose one') + array('auto' => 'Let magnalister create this field');
    }

    /**
     * Inserts the free text fields in specific position in carrier select
     *
     * @param $matchingElement - matching option key value "returnCarrierMatching" must be the same as "matching" value on form fields
     * @param $aField
     * @param $carrierType
     * @return mixed
     * @throws MLAbstract_Exception
     */
    protected function carrierWithFreeText($matchingElementValue, $aField, $carrierType = 'standard') {
        $aField = $this->carrierSelect($matchingElementValue, $aField, $carrierType);
        $optGroup[MLI18n::gi()->get('otto_config_free_text_attributes_opt_group').':'] = array(
            'orderFreeTextField' => MLI18n::gi()->get('otto_config_free_text_attributes_opt_group_value'),
            'optGroupClass' => 'freetext'
        );

        // inserts free text field between marketplace carrier values and matching option
        $aField['values'] = array_slice($aField['values'], 0, 2, true) + $optGroup +
            array_slice($aField['values'], 2, count($aField['values']) - 1, true);

        return $aField;
    }

    /**
     * Populates the select for carriers
     *
     * @param $matchingElement - matching option key value "returnCarrierMatching" must be the same as "matching" value on form fields
     * @param $aField
     * @param $carrierType
     * @return mixed
     * @throws MLAbstract_Exception
     */
    public function carrierSelect($matchingElementValue, $aField, $carrierType = 'standard') {
        $optGroups = array();
        $marketplaceCarriers = array();
        $matchingElement = array();
        // First element is pure text that explains that nothing is selected so it should not be added
        $aFirstElement = array('' => MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT'));

        // Marketplace carriers
        $apiMarketplaceCarriers = MLModul::gi()->getOttoShippingSettings($carrierType);
        foreach ($apiMarketplaceCarriers as $key => $marketplaceCarrier) {
            $marketplaceCarriers[$key] = $marketplaceCarrier;
        }
        if (!empty($apiMarketplaceCarriers)) {
            $marketplaceCarriers['optGroupClass'] = 'marketplaceCarriers';
            $optGroups += array(MLI18n::gi()->get('otto_config_carrier_option_group_marketplace_carrier') => $marketplaceCarriers);
        }

        // Free text fields - additional fields
        if (method_exists(MLFormHelper::getShopInstance(), 'getOrderFreeTextFieldsAttributes')) {
            $aShopFreeTextFieldsAttributes = MLFormHelper::getShopInstance()->getOrderFreeTextFieldsAttributes();
            if (!empty($aShopFreeTextFieldsAttributes)) {
                $aShopFreeTextFieldsAttributes['optGroupClass'] = 'freetext';
                $optGroups += array(MLI18n::gi()->get('otto_config_free_text_attributes_opt_group') . ':' => $aShopFreeTextFieldsAttributes);
            }
        }

        // matching option key value "returnCarrierMatching" must be the same as "matching" value on form fields
        $matchingElement[$matchingElementValue] = MLI18n::gi()->get('otto_config_carrier_option_matching_option');
        $matchingElement['optGroupClass'] = 'matching';
        $optGroups += array(MLI18n::gi()->get('otto_config_carrier_option_group_additional_option') => $matchingElement);

        $aField['values'] = $aFirstElement + $optGroups;
        return $aField;
    }

    /**
     * Populates two drop downs for select
     *
     * @param $aField
     * @param $carrierType
     * @return mixed
     * @throws MLAbstract_Exception
     */
    public function carrierMatching($aField, $carrierType = 'standard') {
        $shopCarriers = MLFormHelper::getShopInstance()->getShopShippingModuleValues();
        
        $apiMarketplaceCarriers = MLModul::gi()->getOttoShippingSettings($carrierType);
        $aField['i18n']['matching'] = array(
            'titlesrc' => MLI18n::gi()->get('otto_config_carrier_matching_title_marketplace_carrier'),
            'titledst' => MLI18n::gi()->get('otto_config_carrier_matching_title_shop_carrier')
        );
        $aField['valuesdst'] = array('' => MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT'));
        $aField['valuessrc'] = array('' => MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT'));

        if (!empty($shopCarriers)) {
            $aField['valuesdst'] = $aField['valuesdst'] + $shopCarriers;

        }
        if (!empty($apiMarketplaceCarriers)) {
            $aField['valuessrc'] = $aField['valuessrc'] + $apiMarketplaceCarriers;
        }

        return $aField;
    }

    /**
     * TODO fix validation after fix on system validation
     * Validates matching case for carrier and shipping address options
     *
     * @param $aField
     * @throws MLAbstract_Exception
     */
    private function duplicateValidation($aField, $transKey) {
        if(isset($aField['value']) && is_array($aField['value'])) {
            foreach ($aField['value'] as $value) {
                if ((isset($value['marketplaceCarrier'], $value['shopCarrier']) && ($value['marketplaceCarrier'] == '' || $value['marketplaceCarrier'] == ''))) {
                    $filedSetTrans = MLI18n::gi()->get('otto_config_order');
                    $filedTrans = MLI18n::gi()->get('formfields_otto');

                    $sLegend = isset($filedSetTrans['legend']['orderstatus']) ? $filedSetTrans['legend']['orderstatus'].' > ' : '';
                    $sLabel = isset($filedTrans[$transKey]['label']) ? $filedTrans[$transKey]['label'].' > ' : '';
                    $filed = isset($aField['i18n']['label']) ? $aField['i18n']['label'].' > ' : '';
                    $tableHeaderFirst = isset($aField['i18n']['matching']['titlesrc']) ? $aField['i18n']['matching']['titlesrc'].', ' : '';
                    $tableHeaderSecond = isset($aField['i18n']['matching']['titledst']) ? $aField['i18n']['matching']['titledst'] : '';

                    MLMessage::gi()->addError(
                        MLModul::gi()->getMarketPlaceName(false).'('.MLModul::gi()->getMarketPlaceId().') '.sprintf(
                            ML_CONFIG_FIELD_EMPTY_OR_MISSING,
                            $sLegend.$sLabel.$filed.$tableHeaderFirst.$tableHeaderSecond
                        )
                    );
                    break;
                }
            }
        }
    }

    /**
     * Returns available images sizes
     *
     * @param $aField
     */
    public function imagesizeField(&$aField) {
        $aField['values'] = array();

        for ($i = 1000; $i <= 4500; $i += 100) {
            $aField['values'][(string)$i] = $i."px";
        }
    }
}
