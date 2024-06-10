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

MLFilesystem::gi()->loadClass('Form_Helper_Model_Table_PrepareData_Abstract');
class ML_MercadoLivre_Helper_Model_Table_MercadoLivre_PrepareData extends ML_Form_Helper_Model_Table_PrepareData_Abstract {
	public $aErrorFields = array();

	public function getPrepareTableProductsIdField() {
        return 'products_id';    
    }

    protected function currencyField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function itemConditionField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function listingTypeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function buyingModeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function shippingModeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }
    
    protected function primaryCategoryField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }
	
	protected function products_idField(&$aField) {
        $aField['value'] = $this->oProduct->get('id');
    }

	protected function attributesField(&$aField) {
		$aAttributes = $this->getFirstValue($aField, array());
        $aField['value'] = json_encode($aAttributes);
		$aCat = reset($aAttributes);
		$aCat = is_array($aCat) ? $aCat : array();
		$sCategoryId = key($aAttributes);

		foreach ($aCat as $sAttributeId => $sAttributeValue) {
			$blRequired = (int)$sAttributeValue['Required'] === 1;
			$iMaxLength = (int)$sAttributeValue['MaxLength'];
			$sCode = $sAttributeValue['Code'];
			$sMatchAttribute = isset($sAttributeValue['MatchAttribute']) ? $sAttributeValue['MatchAttribute'] : null;

			if ($blRequired === true) {
				if ($sCode === '__none__' || ($sCode === '__freevalue__' && empty($sMatchAttribute) === true)) {
					$this->aErrorFields["attributes.$sCategoryId.$sAttributeId.code"] = true;
				} else if ($blRequired === true && $sCode === 'aamatchaa') {
					if (empty($sMatchAttribute) === true) {
						$this->aErrorFields["attributes.$sCategoryId.$sAttributeId.code"] = true;
//					} else {
//          			$aValues = isset($sAttributeValue['Values']) ? $sAttributeValue['Values'] : array();
//						$aErrors = array();
//						
//						foreach ($aValues as $sKey => $sValue) {
//							if ($sValue == '0') {
//								$aErrors[] = $sKey;
//							}
//						}
//
//						if (count($aErrors) > 0) {
//							$this->aErrorFields["attributes.$sCategoryId.$sAttributeId.code"] = $aErrors;
//						}
					}
				}
			}

			if (count($this->aErrorFields) > 0) {
				MLMessage::gi()->addError(MLI18n::gi()->get('configform_check_entries_error'));
			}

			if ($sCode === '__freevalue__' && strlen($sMatchAttribute) > $iMaxLength) {
				MLMessage::gi()->addError(MLI18n::gi()->get('mercadolivre_prepareform_max_length_part1')
                    . ' ' . $sAttributeValue['AttrName'] . ' ' . MLI18n::gi()->get('mercadolivre_prepareform_max_length_part2') 
                    . ' ' . $sAttributeValue['MaxLength'] . '.');
				$this->aErrorFields["attributes.$sCategoryId.$sAttributeId.code"] = true;
			}
		}
    }
}
