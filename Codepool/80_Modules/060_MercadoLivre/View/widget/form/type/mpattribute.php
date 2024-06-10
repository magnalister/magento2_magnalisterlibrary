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

/** @var ML_MercadoLivre_Controller_MercadoLivre_Prepare_Form $this */
if (!class_exists('ML', false))
    throw new Exception();

$aParent = $this->getField(substr($aField['realname'], 0, -5));
$aParentValue = isset($aParent['valuearr']) ? $aParent['valuearr'] : null;
if ($aParentValue === null) {
    // if parent's value is a string it is set from database.
    // in that case, field's value has all the information needed here.
    $aParentValue = isset($aField['value']) === true ? $aField['value'] : null;
}

if ($aParentValue === null) {
	$aName = explode('.', $aField['id']);
	$aAttributesPrepare = json_decode($this->getField('attributes', 'value'), true);
	$aAttributesPrepare = reset($aAttributesPrepare);
	
	if ($aAttributesPrepare !== false) {
		$aParentValue = array(
			$aName[2] => $aAttributesPrepare[$aName[2]],
			'name' => "{$aName[0]}.{$aName[1]}.{$aName[2]}"
		);
	}
}

if ($aParentValue === null) {
	$aName = explode('.', $aField['id']);
	$oMatchedAttribute = MLDatabase::factory('mercadolivre_matchedAttributes')->set('MercadoAttributeID', $aName[2]);
	$sShopAttributeID = $oMatchedAttribute->get('ShopAttributeID');
	$sMatching = $oMatchedAttribute->get('Matching');

	if ($sShopAttributeID !== null && $sMatching !== null) {
		$aParentValue = array(
			$aName[2] => array(
				'Code' => 'aamatchaa',
				'MatchAttribute' => $sShopAttributeID
			),
			'name' => "{$aName[0]}.{$aName[1]}.{$aName[2]}"
		);
	}
}

if (is_array($aParentValue) && count($aParentValue) === 2 && reset($aParentValue) != '') {
	$aName = explode('.', $aParentValue['name']);
    $sName = 'field[' . implode('][', $aName) . '][MatchAttribute]';
	$aInnerParentValue = reset($aParentValue);
	$sSelectedValue = $aInnerParentValue['Code'];
	
	if ($sSelectedValue === '__freevalue__') {
		$aNewField = array(
			'type' => 'string',
			'name' => $sName,
			'value' => (isset($aParentValue[$aName[2]]['MatchAttribute']) && (MLHttp::gi()->isAjax() === null || MLHttp::gi()->isAjax() === false)) ? $aParentValue[$aName[2]]['MatchAttribute'] : null
		);
		
		if ($aField['error'] !== false) {
			$aNewField['cssclasses'] = array('error');
		}

		$this->includeType($aNewField);
	} else if ($sSelectedValue === 'aamatchaa') {
		$sId = $aParentValue['name'] . '.' . $sSelectedValue;
		$aSelectField = $this->getField($sId);

		$aSelectField['type'] = 'select';
		$aSelectField['name'] = $sName;
		$aSelectField['values'] = $this->getShopAttributes();
		if (isset($aParentValue[$aName[2]]['MatchAttribute']) === true) {
			$aSelectField['value'] = $aParentValue[$aName[2]]['MatchAttribute'];
		} 
		
        $aSelectField['i18n']['label'] = '';
		if ($aField['error'] !== false) {
			$aSelectField['cssclass'] = 'error';
		}

		$aAjaxField = $this->getField($sId . '_ajax');
		$aAjaxField['type'] = 'ajax';
		$aAjaxField['cascading'] = true;
		$aAjaxField['breakbefore'] = true;
		$aAjaxField['padding-right'] = 0;
		$aAjaxField['i18n']['label'] = '';
		$aAjaxField['ajax'] = array(
			'selector' => '#' . $aSelectField['id'],
			'trigger' => 'change',
			'field' => array(
				'id' => $sId . '_ajax_field',
				'type' => 'attributematch',
				'error' => $aField['error']
			),
		);

		$aSubfield = $this->getField($sId . '_sub');
		$aSubfield['type'] = 'subFieldsContainer';
		$aSubfield['i18n']['label'] = '';
		$aSubfield['subfields'] = array(
			'select' => $aSelectField,
			'ajax' => $aAjaxField,
		);
		
		if (MLHttp::gi()->isAjax() === true) {
			foreach ($this->aFields as $key => &$aValue) {
				if (isset($aValue['value']['MatchAttribute']) === true) {
					$aValue['value']['MatchAttribute'] = '';
					$aValue['valuearr'][$aName[2]]['MatchAttribute'] = '';					
				}
			}		
		}

		$this->includeType($aSubfield);
	}
}

// without this line the whole row is removed which removes needed controls
echo ' ';
