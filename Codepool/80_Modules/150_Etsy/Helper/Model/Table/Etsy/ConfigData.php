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
MLFilesystem::gi()->loadClass('Form_Helper_Model_Table_ConfigData_Abstract');

class ML_Etsy_Helper_Model_Table_Etsy_ConfigData extends ML_Form_Helper_Model_Table_ConfigData_Abstract {

    public function shippingprofileField(&$aField) {
        $shippingProfiles = $this->callApi(array('ACTION' => 'GetShippingProfiles'), 12 * 12 * 60);

        if (isset($shippingProfiles['ShippingProfiles'])) {
            foreach ($shippingProfiles['ShippingProfiles'] as $shippingProfile) {
                $aField['values'][$shippingProfile['shippingProfileId'].''] = $shippingProfile['title'];
            }
        } else {
            $aField['values'][] = 'No delivery profile created';
        }

    }

    public function stocksync_toMarketplaceField(&$aField) {
        $aField['type'] = 'etsy_configsync';
        $aField['values'] = MLI18n::gi()->get('etsy_configform_sync_values');
    }

    public function shippingprofileorigincountryField(&$aField) {
        $this->getShippingProfileCountry($aField);
    }

    public function shippingprofiledestinationcountryField(&$aField) {
        $this->getShippingProfileCountry($aField);
    }

    public function shippingprofiledestinationregionField(&$aField) {
        $countries = $this->callApi(array('ACTION' => 'GetShippingDestinationRegions'), 100);

        if (isset($countries)) {
            foreach ($countries as $value => $name) {
                $aField['values'][$value] = $name;
            }
        } else {
            $aField['values'][] = 'No regions available';
        }
    }

    private function getShippingProfileCountry(&$aField) {
        $countries = $this->callApi(array('ACTION' => 'GetCountries', 'SUBSYSTEM' => 'Core'), 100);

        if (isset($countries)) {
            foreach ($countries as $iso => $countryName) {
                $aField['values'][$iso] = $countryName;
            }
        } else {
            $aField['values'][] = 'No country available';
        }
    }

    public function fixed_price_addkindField(&$aField) {
        $this->price_addKindField($aField);
    }

    public function langField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getDescriptionValues();
    }

    public function primaryCategoryField(&$aField) {
        $aRequest = MLRequest::gi()->data();
        if (MLModule::gi()->getMarketPlaceName() . ':' . MLModule::gi()->getMarketPlaceId() . '_prepare_variations' === $aRequest['controller']) {
            $aField['values'] = MLDatabase::factory(MLModule::gi()->getMarketPlaceName() . '_variantmatching')->getTopPrimaryCategories();
        } else {
            $aField['values'] = MLDatabase::factory( MLModul::gi()->getMarketPlaceName() . '_prepare')->getTopPrimaryCategories();
        }
    }

    public function imagesizeField(&$aField) {
        $aField['values'] = array(
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
        );
    }


    public function orderstatus_shipping_selectField (&$aField) {
        if (isset($aField['matching'])) {
            $aField = $this->carrierSelect($aField['matching'], $aField, 'return');
        }
    }


    public function orderstatus_shipping_matchingField (&$aField) {
        // if (isset($aField['matching'])) {
            $aField = $this->carrierMatching($aField);
        // }
    }

    /**
     * Populates the select for carriers
     *
     * @param $matchingElement
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
        $apiMarketplaceCarriers = MLModul::gi()->getEtsyShippingSettings();
        foreach ($apiMarketplaceCarriers as $key => $marketplaceCarrier) {
            $marketplaceCarriers[$key] = $marketplaceCarrier;
        }
        if (!empty($apiMarketplaceCarriers)) {
            $marketplaceCarriers['optGroupClass'] = 'marketplaceCarriers';
            $optGroups += array(MLI18n::gi()->get('etsy_config_carrier_option_group_marketplace_carrier') => $marketplaceCarriers);
        }

        // Free text fields - additional fields
        if (method_exists(MLFormHelper::getShopInstance(), 'getOrderFreeTextFieldsAttributes')) {
            $aShopFreeTextFieldsAttributes = MLFormHelper::getShopInstance()->getOrderFreeTextFieldsAttributes();
            if (!empty($aShopFreeTextFieldsAttributes)) {
                $aShopFreeTextFieldsAttributes['optGroupClass'] = 'freetext';
                $optGroups += array(MLI18n::gi()->get('etsy_config_free_text_attributes_opt_group') . ':' => $aShopFreeTextFieldsAttributes);
            }
        }

        // matching option key value "carrierMatching" must be the same as "matching" value on form fields
        $matchingElement[$matchingElementValue] = MLI18n::gi()->get('etsy_config_carrier_option_matching_option');
        $matchingElement['optGroupClass'] = 'matching';
        $optGroups += array(MLI18n::gi()->get('etsy_config_carrier_option_group_additional_option') => $matchingElement);

        $aField['values'] = $aFirstElement + $optGroups;

        return $aField;
    }

    public function carrierMatching($aField) {
        $shopCarriers = MLFormHelper::getShopInstance()->getShopShippingModuleValues();
        $apiMarketplaceCarriers = MLModul::gi()->getEtsyShippingSettings();

        $aField['i18n']['matching'] = array(
            'titlesrc' => MLI18n::gi()->get('etsy_config_carrier_matching_title_marketplace_carrier'),
            'titledst' => MLI18n::gi()->get('etsy_config_carrier_matching_title_shop_carrier')
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
}
