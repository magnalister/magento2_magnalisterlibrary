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
MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_PrepareAbstract');

class ML_Ricardo_Controller_Ricardo_Prepare_Form extends ML_Form_Controller_Widget_Form_PrepareAbstract {

	public function construct() {
		parent::construct();
        $this->oPrepareHelper->bIsSinglePrepare = $this->oSelectList->getCountTotal() === '1';
	}
	
    protected $aParameters = array('controller');

    public function render() {
        $this->getFormWidget();
        return $this;
    }

	public function getRequestField($sName = null, $blOptional = false) {
		if (count($this->aRequestFields) == 0) {
			$this->aRequestFields = $this->getRequest($this->sFieldPrefix);
			$this->aRequestFields = is_array($this->aRequestFields)?$this->aRequestFields:array();
		}

		return parent::getRequestField($sName, $blOptional);
	}

    protected function getSelectionNameValue() {
        return 'match';
    }

	protected function triggerBeforeFinalizePrepareAction() {
		if (!empty($this->oPrepareHelper->aErrors)) {
			foreach ($this->oPrepareHelper->aErrors as $error) {
				MLMessage::gi()->addError(MLI18n::gi()->get($error));
			}
			
			$this->oPrepareList->set('verified', 'ERROR');
			return false;
		}
		
        $this->oPrepareList->set('verified', 'OK');
        return true;
    }
	protected function descriptionTemplateField(&$aField) {
		$aField['values'][-1] = MLI18n::gi()->get('ricardo_prepareform_defaulttemplate');
        $aTemplates = $this->callApi(array('ACTION' => 'GetTemplates'), 60);
		foreach ($aTemplates as $iTemplateId => $sTemplateName) {
			$aField['values'][$iTemplateId] = $sTemplateName;
		}
	}
		
	protected function articleConditionField(&$aField) {
		$aField['values'] = $this->callApi(array('ACTION' => 'GetArticleConditions'), 60);
	}
	
	protected function fixPriceAjaxField(&$aField) {
		$aFixPrice = $this->getField('fixprice');
		$sBuyingMode = $this->getField('buyingmode', 'value');
		$sLabel = '';
		if ($this->oSelectList->getCountTotal() === '1') {
			$aFieldAjax = array(
				'name' => $aFixPrice['name'],
				'type' => 'price',
				'value' => $aFixPrice['value'],
				'currency' => 'CHF',
				'enabled' => $sBuyingMode === 'auction',
			);
			$sLabel = MLI18n::gi()->get('ricardo_prepareform_labelfixprice');
		} else {
			$aFieldAjax = array(
				'type' => 'information',
				'value' => ' ',
			);
		}
		
		$aField['type'] = 'ajax';
		$aField['i18n'] = array(
			'label' => $sLabel,
		);
		$aField['ajax'] = array(
			'selector' => '#' . $this->getField('buyingmode', 'id'),
			'trigger' => 'change',
			'field' => $aFieldAjax
		);
	}
	
	protected function enableBuyNowPriceAjaxField(&$aField) {
		$aEnable = $this->getField('enablebuynowprice');
		$sBuyingMode = $this->getField('buyingmode', 'value');
		$sValuehint = '';
		if ((int)$this->oSelectList->getCountTotal() === 1) {
			$aFieldAjax = array(
				'type' => 'information',
				'value' => ' ',
			);			
		} elseif ($sBuyingMode === 'auction')  {
			$aFieldAjax = array(
				'name' => $aEnable['name'],
				'type' => 'bool',
				'value' => $aEnable['value'],
			);
			$sValuehint = MLI18n::gi()->get('ricardo_prepareform_valuehintlprice');
		} else {			
			$aFieldAjax = array(
				'type' => 'information',
				'value' => MLI18n::gi()->get('ricardo_prepareform_labelprice'),
			);
		}
		
		$aField['type'] = 'ajax';
		$aField['i18n'] = array(
			'label' => '',
			'valuehint' => $sValuehint,
		);
		$aField['ajax'] = array(
			'selector' => '#' . $this->getField('buyingmode', 'id'),
			'trigger' => 'change',
			'field' => $aFieldAjax
		);
	}

	protected function priceAjaxField(&$aField) {
		$sBuyingMode = $this->getField('buyingmode', 'value');
		$aAjaxField = array();
		if ($sBuyingMode === 'auction') {
			$aAjaxField = array(
				'name' => 'auction',
				'type' => 'subFieldsContainer',
				'subfields' => array(
					'priceforauction' => $this->getField('priceforauction'),
					'priceincrement' => $this->getField('priceincrement'),
				),
			);
		} else {
			$aAjaxField = array(
				'type' => 'information',
				'value' => ' ',
			);
		}
		
		$aField['type'] = 'ajax';
		$aField['ajax'] = array(
			'selector' => '#' . $this->getField('buyingmode', 'id'),
			'trigger' => 'change',
			'field' => $aAjaxField,
		);
	}
	
	protected function warrantyConditionField(&$aField) {
		$aField['values'] = $this->callApi(array('ACTION' => 'GetWarrantyCondition'), 60);
	}
	
	protected function warrantyConditionAjaxField(&$aField) {
		$iIdWarranty = $this->getField('warrantycondition', 'value');
		$aAjaxField = array();
		$aAjaxFieldPrepare = $this->getField('warrantydescription');
		if ($iIdWarranty == 0) {
			$aAjaxFieldPrepare = $this->getField('warrantydescription');
			$aAjaxField = array (
				'name' => $aAjaxFieldPrepare['name'],
				'type' => $aAjaxFieldPrepare['type'],
				'value' => $aAjaxFieldPrepare['value'],
				'values' => $aAjaxFieldPrepare['values'],
			);
		} else {
			$aAjaxField = array (
				'type' => 'information',
				'value' => ' ',
			);
		}
		
		$aField['type'] = 'ajax';
		$aField['ajax'] = array(
			'selector' => '#' . $this->getField('warrantycondition', 'id'),
			'trigger' => 'change',
			'field' => $aAjaxField,
		);
	}

	protected function availabilityField(&$aField) {
		$aField['values'] = $this->callApi(array('ACTION' => 'GetArticleAvailability'), 60);
	}

	protected function deliveryConditionField(&$aField) {
		$aValues = $this->callApi(array('ACTION' => 'GetDeliveryTypes'), 60);

		$aPaymentMethods = $this->getField('paymentmethods', 'value');
		if (empty($aPaymentMethods) === false && in_array('262144', $aPaymentMethods)) {
			unset($aValues[0]);
		}
		
		if (isset($aField['type']) && $aField['type'] === 'ajax') {
			$aField['ajax'] = array(
				'selector' => '#' . $this->getField('paymentmethods', 'id'),
				'trigger' => 'change',
				'field' => array(
					'type' => 'select',
					'values' => $aValues
				),
			);
		} else {
			$aField['values'] = $aValues;
		}
	}
	
	protected function deliveryConditionAjaxField(&$aField) {
		$aIdsSelect = array(1, 2, 3, 4, 5);
		$iIdDelivery = $this->getField('deliverycondition', 'value');
		$aAjaxField = array();
		if (in_array($iIdDelivery, $aIdsSelect)) {
			$aParams = array(
				'ACTION' => 'GetPackageSize',
				'DATA' => array(
					'DeliveryType' => $iIdDelivery
				),
			);
			$aValuesPackage = $this->callApi($aParams, 60);
			$aAjaxField = $this->getField('deliverypackage');
			$aAjaxField = array (
				'name' => $aAjaxField['name'],
				'type' => $aAjaxField['type'],
				'value' => $aAjaxField['value'],
				'values' => $aValuesPackage,
			);
		} elseif ($iIdDelivery == 0) {
			$aAjaxField = $this->getField('deliverydescription');
			$aAjaxField = array (
				'name' => $aAjaxField['name'],
				'type' => $aAjaxField['type'],
				'value' => $aAjaxField['value'],
				'values' => $aAjaxField['values'],
			);
		} else {
			$aAjaxField = array (
				'type' => 'information',
				'value' => ' ',
			);
		}
		
		$aField['type'] = 'ajax';
		$aField['ajax'] = array(
							'selector' => '#' . $this->getField('deliverycondition', 'id'),
							'trigger' => 'change',
							'field' => $aAjaxField,
		);
	}
	
	protected function paymentMethodsField(&$aField) {
		$aField['values'] = $this->callApi(array('ACTION' => 'GetPaymentMethods'), 60);
	}
	
	protected function paymentMethodsAjaxField(&$aField) {
		$aPaymentMethods = $this->getField('paymentmethods', 'value');
		if (empty($aPaymentMethods) === false && in_array(0, $aPaymentMethods)) {
			$aAjaxField = $this->getField('paymentdescription');
			$aAjaxField = array (
				'name' => $aAjaxField['name'],
				'type' => $aAjaxField['type'],
				'value' => $aAjaxField['value'],
				'values' => $aAjaxField['values'],
			);
		} else {
			$aAjaxField = array (
				'type' => 'information',
				'value' => ' ',
			);
		}
		
		$aField['type'] = 'ajax';
		$aField['ajax'] = array(
			'selector' => '#' . $this->getField('paymentmethods', 'id'),
			'trigger' => 'change',
			'field' => $aAjaxField,
		);
	}

	protected function maxRelistCountField(&$aField) {
		$aMaxRelsitCount =  $this->callApi(array('ACTION' => 'GetMaxRelistCount'), 60);
		$aValues = array();
		for ($index = 0; $index <= (int)$aMaxRelsitCount['MaxRelistCount']; $index++) {
			$aValues[$index] = $index . ' x';
		}
		
		$sBuyingMode = $this->getField('buyingmode', 'value');
		if ($sBuyingMode === 'buy_it_now') {
			$aValues[2147483647] = 'Bis ausverkauft';
		}
		
		if (isset($aField['type']) && $aField['type'] === 'ajax') {
			$aField['ajax'] = array(
				'selector' => '#' . $this->getField('buyingmode', 'id'),
				'trigger' => 'change',
				'field' => array(
					'type' => 'select',
					'values' => $aValues,
				),
			);
		} else {
			$aField['values'] = $aValues;
		}
	}
	
	protected function buyingModeField(&$aField) {
		$aField['values'] = $this->callApi(array('ACTION' => 'GetBuyingModes'), 60);
    }

    protected function categoriesField(&$aField) {
        $aField['subfields']['primary']['values'] = array('' => '..') + ML::gi()->instance('controller_ricardo_config_prepare')->getField('primarycategory', 'values');

        foreach ($aField['subfields'] as &$aSubField) {
            //adding current cat, if not in top cat
            if (!array_key_exists($aSubField['value'], $aSubField['values'])) {
                $oCat = MLDatabase::factory('ricardo_categories' . $aSubField['cattype']);
                $oCat->init(true)->set('categoryid', $aSubField['value'] ? $aSubField['value'] : 0);
                $sCat = '';
                foreach ($oCat->getCategoryPath() as $oParentCat) {
                    $sCat = $oParentCat->get('categoryname') . ' &gt; ' . $sCat;
                }

                $aSubField['values'][$aSubField['value']] = substr($sCat, 0, -6);
            }
        }
    }
	
	protected function firstPromotionField(&$aField) {
		$aPromotion =  $this->callApi(array('ACTION' => 'GetFirstPromotion'), 60);
		$aField['values'] = $aPromotion['Combobox'];
		$aField['i18n']['help'] = $aPromotion['Text'];
    }
	
	protected function secondPromotionField(&$aField) {
		$aPromotion =  $this->callApi(array('ACTION' => 'GetSecondPromotion'), 60);
		$aField['values'] = $aPromotion['Combobox'];
		$aField['i18n']['help'] = $aPromotion['Text'];
    }
	
	protected function startDateField(&$aField) {
		$aParams = $this->callApi(array('ACTION' => 'GetListingStartTimeAndDurationOptions'), 60);
		$aField['MaxStartDate'] = $aParams['MaxStartDate'];
		$aField['Duration'] = $aParams['Duration'];
    }

	protected function durationField(&$aField) {
		$aParams = $this->callApi(array('ACTION' => 'GetListingStartTimeAndDurationOptions'), 60);
		$aField['values'][1] = '1 ' . MLI18n::gi()->get('generic_prepareform_day');
		for ($i = 2; $i <= (int)$aParams['Duration']; $i++) {
			$aField['values'][$i] = $i . ' ' . MLI18n::gi()->get('ricardo_prepareform_days');
		}
	}

    protected function desubtitleField(&$aField) {
        $aField['optional']['field']['type'] = 'string';
    }

    protected function frsubtitleField(&$aField) {
        $aField['optional']['field']['type'] = 'string';
    }

	protected function callApi($aRequest, $iLifeTime){
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
}
