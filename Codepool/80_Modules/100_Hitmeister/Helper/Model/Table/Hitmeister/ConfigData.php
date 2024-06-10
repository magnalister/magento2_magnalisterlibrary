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

class ML_Hitmeister_Helper_Model_Table_Hitmeister_ConfigData extends ML_Form_Helper_Model_Table_ConfigData_Abstract {
    /**
     * Set configuration for site field.
     *
     * It reads all available storefronts from the API and disabled all options which are not configured in the
     * merchants account.
     *
     * @param array $aField
     * @return void
     */
    public function siteField(&$aField) {
        $aSites = $this->callApi([
            'ACTION' => 'GetSites',
            'VERSION' => 2
        ], 3600);
        $aField['type'] = 'select';
        $aField['values'] = [];
        $aField['disableditems'] = [];
        foreach ($aSites as $sSiteId => $sSite) {
            $aField['values'][$sSiteId] = $sSite['label'].
                (!$sSite['configured'] ? ' [{#i18n:ML_HITMEISTER_NOT_CONFIGURED_IN_KAUFLAND_DE_ACCOUNT#}]' : '');
            if (!$sSite['configured']) {
                $aField['disableditems'][] = $sSiteId;
            }
        }
    }

    public function currencyField(&$aField) {
        $aField['ajax']=array(
            'selector' => '#' . $this->getFieldId('site'),
            'trigger' => 'change',
            'field' => array(
                'type' => 'information',
            ),
        );
        $aAllCurrencies = $this->callApi(array('ACTION' => 'GetCurrencies'), 3600);
        $sValue = MLFormHelper::getModulInstance()->getCurrencyValue($aAllCurrencies);
        $aField['value'] = $sValue;
    }

    public function shippinggroupField(&$aField) {
        $shippingGroups = $this->callApi(array('ACTION' => 'GetListOfShippingGroups'), 12 * 12 * 60);
        if (    is_array($shippingGroups)
             && is_array(current($shippingGroups))
             && array_key_exists('ShippingGroupId', current($shippingGroups))
        ) {
            foreach ($shippingGroups as $shippingGroup) {
                $aField['values'][$shippingGroup['ShippingGroupId'].''] = $shippingGroup['Name'];
            }
        } else {
            $aField['values'][] = 'No shipping group created';
        }
    }

    public function primaryCategoryField(&$aField) {
        $aRequest = MLRequest::gi()->data();
        if (MLModul::gi()->getMarketPlaceName().':'.MLModul::gi()->getMarketPlaceId().'_prepare_variations' === $aRequest['controller']) {
            $aField['values'] = MLDatabase::factory(MLModul::gi()->getMarketPlaceName() . '_variantmatching')->getTopPrimaryCategories();
        } else {
            $aField['values'] = MLDatabase::factory( MLModul::gi()->getMarketPlaceName() . '_prepare')->getTopPrimaryCategories();
        }
    }
    
	public function checkin_currencyField(&$aField) {
		$currencies = MLModul::gi()->getConfig('site.currencies');
		$aField['values'][''] = ML_AMAZON_LABEL_APPLY_PLEASE_SELECT;
		foreach ($currencies as $code => $symbol) {
			$aField['values'][$code] = $code;
		}
	}
	
	public function checkin_listingTypeField(&$aField) {
		$aListingTypes = MLModul::gi()->getConfig('site.listing_types');
		$aField['values'][''] = ML_AMAZON_LABEL_APPLY_PLEASE_SELECT;
		foreach ($aListingTypes as $code => $name) {
			$aField['values'][$code] = $name;
		}
	}
	
	public function langField (&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getDescriptionValues();
    }
    
    public function imagePathField (&$aField) {
        if (isset($aField['value']) === false || empty($aField['value'])) {
            $aField['value'] = MLHttp::gi()->getShopImageUrl();
        }
    }
	
	public function itemConditionField(&$aField) {
        $aField['values'] = $this->callApi(array('ACTION' => 'GetUnitConditions'), 60);
    }
    
	public function shippingTimeField(&$aField) {
        $aField['values'] = $this->callApi(array('ACTION' => 'GetDeliveryTimes'), 60);
    }
    
	public function itemCountryField(&$aField) {
        $aField['values'] = $this->callApi(array('ACTION' => 'GetDeliveryCountries'), 60);
    }
    
	public function orderstatus_carrierField(&$aField) {
        if (MLSetting::gi()->IVCarrierFreeTextFieldMatching) {//we don't release right now for all because of lot work about content and all detail
            $aShopFreeTextFieldsAttributes = MLFormHelper::getShopInstance()->getOrderFreeTextFieldsAttributes();
            $optGroups = array(
                MLI18n::gi()->get('hitmeister_config_carrier_option_group_marketplace_carrier').':' => MLModule::gi()->getCarriers()
            );
            if (!empty($aShopFreeTextFieldsAttributes)) {
                $aShopFreeTextFieldsAttributes['optGroupClass'] = 'freetextfield';
                $optGroups += array(
                    MLI18n::gi()->get('hitmeister_config_carrier_option_group_shopfreetextfield_option_carrier').':' => $aShopFreeTextFieldsAttributes
                );
            }
            $aField['values'] = $optGroups;
        } else {
            $aField['values'] = MLModule::gi()->getCarriers();
        }
    }
    
	public function orderstatus_cancelreasonField(&$aField) {
        $orderStatusData = $this->callApi(array('ACTION' => 'GetOrderStatusData'), 60);;
        $aField['values'] = $orderStatusData['Reasons'];
    }
    
    public function orderstatus_cancelledField(&$aField) {
        $this->orderstatus_canceledField($aField);
    }

    /**
     * Set the values for the order status for new FBK orders.
     *
     * @param array $aField
     * @return void
     * @throws Exception
     */
    public function orderstatus_fbkField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getOrderStatusValues();
    }

    /**
     * Set the values for the synchronization options from the marketplace.
     * @param array $aField
     * @return void
     * @throws MLAbstract_Exception
     */
    public function stocksync_fromMarketplaceField (&$aField) {
        $aField['values'] = MLI18n::gi()->get('ML_HITMEISTER_SYNC_FROM_MARKETPLACE_VALUES');
    }

    public function handlingtimeField(&$aField) {
        $aField['values'] = array(
            '0' => MLI18n::gi()->get('hitmeister_handlingtime_0workingdays'),
            '1' => MLI18n::gi()->get('hitmeister_handlingtime_1workingdays'),
        );

        for ($i = 2; $i <= 100; $i++) {
            $aField['values'][(string)$i] = $i." ".MLI18n::gi()->get('hitmeister_handlingtime_workingdays');
        }
    }

    public function price_lowest_addKindField(&$aField) {
        $aField['values'] = MLI18n::gi()->get('configform_price_addkind_values');
    }

    public function price_lowest_factorField(&$aField) {
        $aField['value'] = isset($aField['value']) ? str_replace(',', '.', trim($aField['value'])) : 0;
        if ((string)((float)$aField['value']) != $aField['value']) {
            $this->addError($aField, MLI18n::gi()->get('configform_price_factor_error'));
        } else {
            $aField['value'] = number_format($aField['value'], 2, '.', '');
        }
    }

    public function price_lowest_signalField(&$aField) {
        $aField['value'] = isset($aField['value']) ? str_replace(',', '.', trim($aField['value'])) : '';
        if (!empty($aField['value']) && (string)((int)$aField['value']) != $aField['value']) {
            $this->addError($aField, MLI18n::gi()->get('configform_price_signal_error'));
        }
    }

    public function price_lowest_groupField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getCustomerGroupValues();
    }

    
}
