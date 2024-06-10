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
if ($aParentValue == null) {
    // if parent's value is a string it is set from database.
    // in that case, field's value has all the information needed here.
    $aParentValue = isset($aField['value']) === true ? $aField['value'] : null;
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
				'MatchAttribute' => $sShopAttributeID,
				'Values' => $sMatching
			),
			'name' => "{$aName[0]}.{$aName[1]}.{$aName[2]}"
		);
	}
}

if (is_array($aParentValue) && count($aParentValue) === 2 && reset($aParentValue) != '') {
    $aName = explode('.', $aParentValue['name']);
    $sName = 'field[' . implode('][', $aName) . '][Values]';
	$aInnerParentValue = reset($aParentValue);
	if (isset($aInnerParentValue['MatchAttribute']) === true) {
		$sAttributeCode = $aInnerParentValue['MatchAttribute'];
		$aShopAttributes = $this->getShopAttributeValues($sAttributeCode);
	} else {
		echo ' ';
		return;
	}

	$aMercadoAttributes = $this->getCategoryAttributes($aName[1]);
	$aMercadoAttribute = $aMercadoAttributes[$aName[2]];

	if (($aMercadoAttribute['type'] !== 'list' && $aMercadoAttribute['type'] !== 'boolean') || count($aShopAttributes) === 0) {
		echo ' ';
		return;
	}

	$aMercadoAttributeValues = array();
	foreach ($aMercadoAttribute['values'] as $key => $value) {
		$aMercadoAttributeValues[$value['id']] = $value['name'];
	}

    $i18n = $this->getFormArray('aI18n');

    $aNewField = array(
        'type' => 'matching',
        'name' => $sName,
        'i18n' => $i18n['field']['attributematching'],
        'addonempty' => true,
        'automatch' => true,
        'valuessrc' => $aShopAttributes,
        'valuesdst' => $aMercadoAttributeValues,
    );

	$aNewField['value'] = array();
	foreach ($aShopAttributes as $key => $value) {
		if (isset($aInnerParentValue['Values']) === true && isset($aInnerParentValue['Values'][$key]) === true) {
			$aNewField['value'][$key] = $aInnerParentValue['Values'][$key];
		}
	}

	if (is_array($aField['error'])) {
		foreach ($aField['error'] as $key => $value) {
			$aNewField['error'][$value] = true;
		}
	}

    $this->includeType($aNewField);
} else {
    // without this line the whole row is removed which removes needed controls
    echo ' ';
}
