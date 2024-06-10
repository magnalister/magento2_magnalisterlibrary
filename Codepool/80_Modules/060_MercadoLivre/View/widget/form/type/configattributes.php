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

$i18n = $this->getFormArray('aI18n');
$i18nConfigPrepare = MLI18n::gi()->get('mercadolivre_config_prepare');
$aFieldset = array(
    'type'   => 'fieldset',
    'id'     => $this->getIdent().'_fieldset_config',
    'legend' => array(
        'i18n'     => $i18n['legend']['configmatching'],
        'template' => 'h4'
    ),
    'row'    => array(
        'template' => 'default',
    ),
);

// Currency
$aCurrencyField = $this->getField('currency');
$aCurrencyField['type'] = 'select';
$aCurrencyField['name'] = 'field[currency]';
$aCurrencyField['values']['none'] = MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT');

foreach ($aCategoryInfo['Settings']['Currencies'] as $curr) {
	$aCurrencyField['values'][$curr] = $curr;
}

if (count($aCategoryInfo['Settings']['Currencies']) === 1) {
	$aCurrencyField['value'] = reset($aCategoryInfo['Settings']['Currencies']);
} else if (in_array($aCurrencyField['value'], $aCategoryInfo['Settings']['Currencies']) === false) {
    $sDefaultCurrency = MLModule::gi()->getConfig('currency');
	if (in_array($sDefaultCurrency, $aCategoryInfo['Settings']['Currencies']) === false) {
		$aCurrencyField['value'] = null;
	} else {
		$aCurrencyField['value'] = $sDefaultCurrency;
	}	
}

$aFieldset['fields'][] = $aCurrencyField;

// Item condition
$aItemConditionField = $this->getField('itemcondition');
$aItemConditionField['type'] = 'select';
$aItemConditionField['name'] = 'field[itemcondition]';
$aItemConditionField['values']['none'] = MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT');

foreach ($aCategoryInfo['Settings']['ItemConditions'] as $cond) {
	$aItemConditionField['values'][$cond] = $i18nConfigPrepare['field']['itemcondition']['values'][$cond];
}

if (count($aCategoryInfo['Settings']['ItemConditions']) === 1) {
	$aItemConditionField['value'] = reset($aCategoryInfo['Settings']['ItemConditions']);
} else if (in_array($aItemConditionField['value'], $aCategoryInfo['Settings']['ItemConditions']) === false) {
    $sDefaultItemCondition = MLModule::gi()->getConfig('itemcondition');
	if (in_array($sDefaultItemCondition, $aCategoryInfo['Settings']['ItemConditions']) === false) {
		$aItemConditionField['value'] = null;
	} else {
		$aItemConditionField['value'] = $sDefaultItemCondition;
	}	
}

$aFieldset['fields'][] = $aItemConditionField;

// Listing type
$aListingTypeField = $this->getField('listingtype');
$aListingTypeField['type'] = 'select';
$aListingTypeField['name'] = 'field[listingtype]';
$aListingTypeField['values']['none'] = MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT');

$aListingTypesConfig = MLModule::gi()->getConfig('site.listing_types');

foreach ($aListingTypesConfig as $listingTypeCode => $listingTypeName) {
	$aListingTypeField['values'][$listingTypeCode] = $listingTypeName;
}
if (count($aListingTypesConfig) === 1) {
	$aListingTypeField['value'] = reset($aListingTypesConfig);
} else if (array_key_exists($aListingTypeField['value'], $aListingTypesConfig) === false) {
    $sDefaultListingType = MLModule::gi()->getConfig('listingtype');
	if (array_key_exists($sDefaultListingType, $aListingTypesConfig) === false) {
		$aListingTypeField['value'] = null;
	} else {
		$aListingTypeField['value'] = $sDefaultListingType;
	}	
}

$aFieldset['fields'][] = $aListingTypeField;

// Buying mode
$aBuyingModeField = $this->getField('buyingmode');
$aBuyingModeField['type'] = 'select';
$aBuyingModeField['name'] = 'field[buyingmode]';
$aBuyingModeField['values']['none'] = MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT');

foreach ($aCategoryInfo['Settings']['BuyingModes'] as $mode) {
	$aBuyingModeField['values'][$mode] = $i18nConfigPrepare['field']['buyingmode']['values'][$mode];
}

if (count($aCategoryInfo['Settings']['BuyingModes']) === 1) {
	$aBuyingModeField['value'] = reset($aCategoryInfo['Settings']['BuyingModes']);
} else if (in_array($aBuyingModeField['value'], $aCategoryInfo['Settings']['BuyingModes']) === false) {
    $sDefaultBuyingMode = MLModule::gi()->getConfig('buyingmode');
	if (in_array($sDefaultBuyingMode, $aCategoryInfo['Settings']['BuyingModes']) === false) {
		$aBuyingModeField['value'] = null;
	} else {
		$aBuyingModeField['value'] = $sDefaultBuyingMode;
	}
}

$aFieldset['fields'][] = $aBuyingModeField;

// Shipping mode
$aShippingModeField = $this->getField('shippingmode');
$aShippingModeField['type'] = 'select';
$aShippingModeField['name'] = 'field[shippingmode]';
$aShippingModeField['values']['none'] = MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT');

foreach ($aCategoryInfo['Settings']['ShippingModes'] as $mode) {
	$aShippingModeField['values'][$mode] = $i18nConfigPrepare['field']['shippingmode']['values'][$mode];
}

$sDefaultShippingMode = MLModule::gi()->getConfig('shippingmode');

if (count($aCategoryInfo['Settings']['ShippingModes']) === 1) {
	$aShippingModeField['value'] = reset($aCategoryInfo['Settings']['ShippingModes']);
} else if (in_array($aShippingModeField['value'], $aCategoryInfo['Settings']['ShippingModes']) === false) {
    $sDefaultShippingMode = MLModule::gi()->getConfig('shippingmode');
	if (in_array($sDefaultShippingMode, $aCategoryInfo['Settings']['ShippingModes']) === false) {	
		$aShippingModeField['value'] = null;
	} else {
		$aShippingModeField['value'] = $sDefaultShippingMode;
	}
	
}

$aFieldset['fields'][] = $aShippingModeField;

$this->includeView('widget_form_fieldset', array('aFieldset' => $aFieldset));