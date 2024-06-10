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
MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_ConfigAbstract');

class ML_Ricardo_Controller_Ricardo_Config_Prepare extends ML_Form_Controller_Widget_Form_ConfigAbstract {

    public static function getTabTitle() {
        return MLI18n::gi()->get('ricardo_config_account_prepare');
    }

    public static function getTabActive() {
        return self::calcConfigTabActive(__class__, false);
    }
	
	public function deliveryPackageField(&$aField) {
		$aValues = array();
		$aIdsSelect = array(1, 2, 3, 4, 5);
		$iIdDelivery = $this->getField('deliverycondition', 'value');
		if (isset($iIdDelivery) === false) {
			$iIdDelivery = 1;
		}
		
		if (in_array($iIdDelivery, $aIdsSelect)) {
			$aParams = array(
				'ACTION' => 'GetPackageSize',
				'DATA' => array(
					'DeliveryType' => $iIdDelivery
				),
			);
			$aValues = $this->callApi($aParams, 60);
			$sType = 'select';
		} else {
			$sType = 'hidden';			
		}
		
		if (isset($aField['type']) && $aField['type'] === 'ajax') {
			$aField['ajax'] = array(
				'selector' => '#' . $this->getField('deliverycondition', 'id'),
				'trigger' => 'change',
				'field' => array(
					'type' => $sType,
					'values' => $aValues
				),
			);
			if ($sType === 'hidden') {
				$aField['ajax']['field']['value'] = 0;
			}
		} else {
			if ($sType === 'hidden') {
				$aField['value'] = 0;
			}
			
			$aField['type'] = $sType;
			$aField['values'] = $aValues;
		}
    }
	
	public function warrantyDescriptionField(&$aField) {
		$this->getDescription($aField, 'warrantycondition', true);
	}

	public function deliveryConditionField(&$aField) {
		$aValues = $this->callApi(array('ACTION' => 'GetDeliveryTypes'), 60);

		$aPaymentMethods = $this->getField('paymentmethods', 'value');
		if (is_array($aPaymentMethods) && in_array('262144', $aPaymentMethods)) {
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

	public function deliveryDescriptionField(&$aField) {
		$this->getDescription($aField, 'deliverycondition');
	}
	
	public function paymentDescriptionField(&$aField) {
		$this->getDescription($aField, 'paymentmethods');
	}
    
    public function durationField(&$aField) {
		$aParams = $this->callApi(array('ACTION' => 'GetListingStartTimeAndDurationOptions'), 60);
		$aField['values'][1] = '1 ' . MLI18n::gi()->get('generic_prepareform_day');
		for ($i = 2; $i <= (int)$aParams['Duration']; $i++) {
			$aField['values'][$i] = $i . ' ' . MLI18n::gi()->get('ricardo_prepareform_days');
		}
    }
	
	public function maxRelistCountField(&$aField) {
		$aMaxRelsitCount =  $this->callApi(array('ACTION' => 'GetMaxRelistCount'), 60);
		$aValues = array();
		for ($index = 0; $index <= (int)$aMaxRelsitCount['MaxRelistCount']; $index++) {
			$aValues[$index] = $index . ' x';
		}
		
		$sBuyingMode = $this->getField('buyingmode', 'value');
		if ($sBuyingMode === 'buy_it_now') {
			$aValues[2147483647] = MLI18n::gi()->ricardo_config_prepare_maxrelistcount_sellout;
		}
		
		if (isset($aField['type']) && $aField['type'] === 'ajax') {
			$aField['ajax'] = array(
				'selector' => '#' . $this->getField('buyingmode', 'id'),
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

	protected function callApi($aRequest, $iLifeTime){
        try { 
            $aResponse = MagnaConnector::gi()->submitRequestCached($aRequest, $iLifeTime);
            if ($aResponse['STATUS'] == 'SUCCESS' && isset($aResponse['DATA']) && is_array($aResponse['DATA'])) {
                return $aResponse['DATA'];
            }else{
                return array();
            }
		} catch (MagnaException $e) {
            return array();
		}
    }
	
	private function getDescription(&$aField, $sSelector, $bIsWarranty = false) {
		$mId = $this->getField($sSelector, 'value');
		if ($bIsWarranty === true && isset($mId) === false) {
			$mId = '0';
		}
		
		$aValues = array(
			'de' => 'true',
			'fr' => 'true',
		);
		
		if ((is_string($mId) && $mId === '0') || (is_array($mId) && in_array('0', $mId))) {
			$sCss = '';
		} else {
			$sCss = 'hide';
		}
		
		if (isset($aField['type']) && $aField['type'] === 'ajax') {
			$aField['ajax'] = array(
				'selector' => '#' . $this->getField($sSelector, 'id'),
				'trigger' => 'change',
				'field' => array(
					'type' => 'table',
					'values' => $aValues,
					'cssclass' => $sCss
				),
			);
			if ($sCss === 'hide') {
				$aField['ajax']['field']['value'] = '';
			}
		} else {
			if ($sCss === 'hide') {
				$aField['value'] = '';
			}
			
			$aField['cssclass'] = $sCss;
			$aField['values'] = $aValues;
		}
	}
}
