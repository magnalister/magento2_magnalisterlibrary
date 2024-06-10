<?php

/**
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
 * $Id$
 *
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLFilesystem::gi()->loadClass('Form_Helper_Model_Table_ConfigData_Abstract');

class ML_Ricardo_Helper_Model_Table_Ricardo_ConfigData extends ML_Form_Helper_Model_Table_ConfigData_Abstract {

    public function siteIdField(&$aField) {
        $aSites = $this->callApi(array('ACTION' => 'GetSites'), 60);
        $aField['type'] = 'select';
        $aField['values'] = array();
        $aField['values'][] = MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT');
        foreach ($aSites as $aSite) {
            $aField['values'][$aSite['id']] = $aSite['name'];
        }
    }
    
    public function getSiteDetails() {
        return $this->callApi(array('ACTION' => 'GetSiteDetails'), 60);
    }

    public function primaryCategoryField(&$aField) {
        $aField['values'] = MLDatabase::factory('ricardo_prepare')->getTopPrimaryCategories();
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
	
	public function langsField (&$aField) {
        $aField['valuessrc'] = array(
			'de' => array(
				'i18n' => 'de',
				'required' => true,
				'currency' => 'CHF',
			),
			'fr' => array(
				'i18n' => 'fr',
				'required' => true,
				'currency' => 'CHF',
			)
		);
		
		$aField['valuesdst'] = MLFormHelper::getShopInstance()->getDescriptionValues();

		// Setting default value
		if (!isset($aField['value'])) {
			$aField['value'] = array(
				'de' => key($aField['valuesdst']),
				'fr' => key($aField['valuesdst']),
			);
		}
    }
	
	public function articleConditionField(&$aField) {
        $aField['values'] = $this->callApi(array('ACTION' => 'GetArticleConditions'), 60);
    }
	
	public function descriptionTemplateField(&$aField) {
		$aField['values'][-1] = MLI18n::gi()->get('ricardo_config_account_defaulttemplate');
        $aTemplates = $this->callApi(array('ACTION' => 'GetTemplates'), 60);
		foreach ($aTemplates as $iTemplateId => $sTemplateName) {
			$aField['values'][$iTemplateId] = $sTemplateName;
		}
    }
	
	public function availabilityField(&$aField) {
        $aField['values'] = $this->callApi(array('ACTION' => 'GetArticleAvailability'), 60);
    }
				
	public function buyingModeField(&$aField) {
        $aField['values'] = $this->callApi(array('ACTION' => 'GetBuyingModes'), 60);
    }
	
	public function paymentMethodsField(&$aField) {
        $aField['values'] = $this->callApi(array('ACTION' => 'GetPaymentMethods'), 60);
    }

	public function warrantyConditionField(&$aField) {
		$aField['values'] = $this->callApi(array('ACTION' => 'GetWarrantyCondition'), 60);
	}
	
	public function firstPromotionField(&$aField) {
		$aPromotion =  $this->callApi(array('ACTION' => 'GetFirstPromotion'), 60);
		$aField['values'] = $aPromotion['Combobox'];
		$aField['i18n']['help'] = $aPromotion['Text'];
    }
	
	public function secondPromotionField(&$aField) {
		$aPromotion =  $this->callApi(array('ACTION' => 'GetSecondPromotion'), 60);
		$aField['values'] = $aPromotion['Combobox'];
		$aField['i18n']['help'] = $aPromotion['Text'];
    }
	
	public function mail_sendField(&$aField) {
        $aField['values'] = array(
            1 => MLI18n::gi()->get('ML_BUTTON_LABEL_YES'),
            0 => MLI18n::gi()->get('ML_BUTTON_LABEL_NO'));
    }

    public function mail_copyField(&$aField) {
        $aField['values'] = array(
            1 => MLI18n::gi()->get('ML_BUTTON_LABEL_YES'),
            0 => MLI18n::gi()->get('ML_BUTTON_LABEL_NO'));
    }
    
    public function stocksync_toMarketplaceField (&$aField) {
        $aField['values'] = MLI18n::gi()->get('ricardo_configform_sync_values');
    }
    
    public function inventorysync_priceField (&$aField) {
        $aField['values'] = MLI18n::gi()->get('ricardo_configform_sync_values');
    }

	public function price_signalField (&$aField) {
		$aField['value'] = isset($aField['value']) ? str_replace(',', '.',trim($aField['value'])) : '';
		if (!empty($aField['value']) && (string)((int)$aField['value']) != $aField['value']) {
			$this->addError($aField, MLI18n::gi()->get('configform_price_signal_error'));
		}

		$iLastDigit = substr((string)((int)$aField['value']), -1);
		if ($iLastDigit != 0 && $iLastDigit != 5) {
			$this->addError($aField, MLI18n::gi()->get('ricardo_config_error_price_signal'));
		}
	}
    public function mwstField (&$aField) {
        if($aField['value'] !== ''){
            parent::mwstField($aField);
        }
    }
}
