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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
class ML_MercadoLivre_Model_Service_AddItems extends ML_Modul_Model_Service_AddItems_Abstract {

	public function setAction($sAction) {
		$this->sAction = $sAction;
	}

    protected function getProductArray() {
        /* @var $oHelper ML_MercadoLivre_Helper_Model_Service_Product */
        $oHelper = MLHelper::gi('Model_Service_Product');
        $aMasterProducts = array();
        foreach ($this->oList->getList() as $oProduct) {
            /* @var $oProduct ML_Shop_Model_Product_Abstract */
            $oHelper->setProduct($oProduct);
			$aVariants = $this->oList->getVariants($oProduct);

			if (count($aVariants) === 1) {
				$oVariant = reset($aVariants);
				$oMasterProduct = $oHelper->setVariant($oVariant)->getData();
				$this->processAttributes($oMasterProduct, $oVariant);
			} else if (count($aVariants) > 1) {
				$oMasterProduct = $oHelper->setVariant($oProduct)->getData();
				$oMasterProduct['Variations'] = array();

				foreach ($aVariants as $oVariant) {
					if ($this->oList->isSelected($oVariant)) {
						$oHelper->resetData();

						$oVariantProduct = $oHelper->setVariant($oVariant)->getData();
						$this->processAttributes($oVariantProduct, $oVariant);

						if (isset($oVariantProduct['Images']) === false && isset($oMasterProduct['Images']) === true) {
							$oVariantProduct['Images'] = $oMasterProduct['Images'];
						}

						if (isset($oVariantProduct['Images']) === true) {
							foreach ($oVariantProduct['Images'] as &$image) {
								$image = $image['URL'];
							}
						}

						if ($oVariantProduct['ListingType'] === 'free' && $this->sAction === 'VerifyAddItems') {
							$oVariantProduct['Quantity'] = 1;
						}

						$oMasterProduct['Variations'][] = $oVariantProduct;
					}
				}

				$firstVariant = reset($oMasterProduct['Variations']);
				$oMasterProduct['CategoryID'] = $firstVariant['CategoryID'];
				$oMasterProduct['Currency'] = $firstVariant['Currency'];
				$oMasterProduct['ConditionType'] = $firstVariant['ConditionType'];
				$oMasterProduct['ListingType'] = $firstVariant['ListingType'];
				$oMasterProduct['BuyingMode'] = $firstVariant['BuyingMode'];
				$oMasterProduct['Shipping'] = $firstVariant['Shipping'];
			}

			if ($oMasterProduct['ListingType'] === 'free' && $this->sAction === 'VerifyAddItems') {
				$oMasterProduct['Quantity'] = 1;
			}

			$aMasterProducts[$oProduct->get('id')] = $oMasterProduct;
        }

        return $aMasterProducts;
    }

	protected function uploadItems(){
		// Condition exits because there are no items to upload
		if (count($this->oList->getMasterIds(true)) > 0) {
			parent::uploadItems();
		}
	}

	protected function handleException($oEx) {
		$mError = $oEx->getErrorArray();
		foreach ($mError['ERRORS'] as $aError) {
			$messageAdded = false;
			if (isset($aError['ERRORDATA'])) {
				foreach ($aError['ERRORDATA'] as $aErrorData) {
					if (is_array($aErrorData) && isset($aErrorData['message']) && isset($aErrorData['code'])) {
						$messageAdded = true;
						MLErrorLog::gi()->addError(0, ' ', $aErrorData['message'], $aErrorData['code']);
						MLMessage::gi()->addError($aErrorData['message'], '', false);
						$this->aError[] = $aErrorData['message'];
					}
				}
			}
			if (!$messageAdded) {
				MLErrorLog::gi()->addError(0, ' ', $aError['ERRORMESSAGE'], isset($aError['ERRORCODE']) ? $aError['ERRORCODE'] : 0);
				MLMessage::gi()->addError($aError['ERRORMESSAGE'], '', false);
				$this->aError[] = $aError['ERRORMESSAGE'];
			}
		}
	}

	protected function processAttributes(&$oProduct, $oVariant) {
		$oPreparedItem = MLDatabase::factory('mercadolivre_prepare')
			->set('products_id', $oVariant->get('id'));
		
		if ($oPreparedItem->get('Attributes') !== null && is_array($oPreparedItem->get('Attributes'))) {
			foreach ($oPreparedItem->get('Attributes') as $aAttributes) {
				if (isset($oProduct['VariationId'])) {
					$oProduct['Variation'] = array();
					$this->handleAttributes($oProduct['Variation'], $oVariant, $aAttributes);
				} else {
					$oProduct['Attributes'] = array();
					$this->handleAttributes($oProduct['Attributes'], $oVariant, $aAttributes);
				}
			}
		}

		if (isset($oProduct['VariationId'])) {
			unset($oProduct['VariationId']);
		}
	}

	protected function handleAttributes(&$aAddTo, $oProduct, $aAttributes) {
		foreach ($aAttributes as $sAttributeId => $aAttribute) {
			if ($aAttribute['Code'] === '__none__') {
				continue;
			}

            if ($aAttribute['Code'] === 'aamatchaa') {
				if (empty($aAttribute['MatchAttribute']) === true) {
					continue;
				}
				$sAttributeName = $aAttribute['MatchAttribute'];
				$mValue = $oProduct->getAttributeValue($sAttributeName);

				if (empty($mValue) === true) {
					continue;
				}

				if ($mValue !== null && isset($aAttribute['Values']) && count($aAttribute['Values']) > 0) {
					$mValue = $this->getAttributeOptionId($sAttributeName, $mValue);
					$mValue = $aAttribute['Values'][$mValue];
				}

				if ($mValue === null) {
					continue;
				}

				$aAddTo[] = array(
					'NameId' => (string)$sAttributeId,
					'ValueId' => $mValue
				);
			} else if ($aAttribute['Code'] === '__freevalue__' && empty($aAttribute['MatchAttribute']) === false) {
				$aAddTo[] = array(
					'NameId' => (string)$sAttributeId,
					'ValueId' => $aAttribute['MatchAttribute']
				);
			} else if (empty($aAttribute['Code']) === false) {
				$aAddTo[] = array(
					'NameId' => (string)$sAttributeId,
					'ValueId' => $aAttribute['Code']
				);
			}
		}
	}

	private function getAttributeOptionId($sAttributeCode, $sAttributeValue) {
		$attributes = MLFormHelper::getShopInstance()->getPrefixedAttributeOptions($sAttributeCode);
		//@Todo: https://gitlab.magnalister.com/magnalister/v3/commit/80d663496b473a05b6faf39d38ac52f0c06f8390
        return array_search($sAttributeValue, $attributes);
	}
}
