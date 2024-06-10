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

/** @var ML_Form_Controller_Widget_Form_VariationsAbstract|ML_Form_Controller_Widget_Form_PrepareWithVariationMatchingAbstract $this */
/** @var array $aField */

if (!class_exists('ML', false))
    throw new Exception();
$marketplaceName = MLModule::gi()->getMarketPlaceName();

$aParent = $this->getField(substr($aField['realname'], 0, -5));
$aParentValue = isset($aParent['valuearr']) ? $aParent['valuearr'] : null;

//Getting type of tab (is it variation tab or apply form)
$sParentId = ' ' . $aParent['id'];
if (!empty($aField['id_suffix'])) {
    $sId = $aField['id_suffix'];
} else {
    $ini = strpos($sParentId, $marketplaceName . '_prepare_');
    if ($ini == 0) return '';
    $ini += strlen($marketplaceName . '_prepare_');
    $len = strpos($sParentId, '_field', $ini) - $ini;
    $tabType = substr($sParentId, $ini, $len);
    if ($tabType === 'variations') {
        $sId = '_prepare_variations';
    } else {
        $sId = '_prepare_apply_form';
    }
}
MLFormHelper::getPrepareAMCommonInstance()->addExtraInfo($aField);

$sId = $marketplaceName . $sId;

if ($aParentValue == null) {
    // if parent's value is a string it is set from database.
    // in that case, field's value has all the information needed here.
    $aParentValue = isset($aField['value']) ? $aField['value'] : null;
}

if (is_array($aParentValue) && count($aParentValue) === 2 && reset($aParentValue) != '') {
    $aName = explode('.', $aParentValue['name']);
    $sAttributeCode = reset($aParentValue);
    $sMPAttributeCode = MLFormHelper::getPrepareAMCommonInstance()->getMPAttributeCode($aParentValue, $aField);
    $sName = MLFormHelper::getPrepareAMCommonInstance()->getSName($aName, $aField, $sMPAttributeCode);
    $sVariationValue = $aName[1];
    $aShopAttributes = $this->getShopAttributeDetails($sAttributeCode);
    $aMPAttribute = $this->getMPAttributes($sVariationValue, $sMPAttributeCode, $sAttributeCode);
    $i18n = $this->getFormArray('aI18n');

    $sCustomGroupName = $this->getField('variationgroups.value', 'value');
    $aCustomIdentifier = explode(':', $sCustomGroupName);
    $sCustomIdentifier = count($aCustomIdentifier) == 2 ? $aCustomIdentifier[1] : '';
    if (empty($sCustomIdentifier) && MLFormHelper::getPrepareAMCommonInstance()->shouldCheckOtherIdentifier()) {
        if ($tabType === 'variations') {
            $sCustomIdentifier = $this->getRequestField('customidentifier');
        } else {
            $sCustomIdentifier = $this->getRequestField('ProductType');
            if (!isset($sCustomIdentifier)) {
                $sCustomIdentifier = $this->getField('ProductType', 'value');
            }

            if (is_array($sCustomIdentifier)) {
                $sCustomIdentifier = $sCustomIdentifier[$sVariationValue];
            }
        }
    }

    if ($sCustomIdentifier === null) {
        $sCustomIdentifier = '';
    }

    $aMatchedAttributes = $this->getAttributeValues($sVariationValue, $sCustomIdentifier, $sMPAttributeCode);
    $bError = $this->getErrorValue($sVariationValue, $sCustomIdentifier, $sMPAttributeCode);
    $freeTextDisabled = $aMPAttribute['from_mp'];
    $marketplaceDataType = !empty($aMPAttribute) ? $aMPAttribute['dataType'] : 'text';

    if (!empty($aMPAttribute)) {
        $freeTextDisabled = false === strpos(strtolower($marketplaceDataType), 'text');
    }

    if ($sAttributeCode === 'freetext') {//user want to enter own entry to be sent as value for this attribute
        $shopValue = $this->getAttributeValues($sVariationValue, $sCustomIdentifier, $sMPAttributeCode, true);
        $aNewField = array(
            'type' => 'string',
            'name' => $sName,
            'value' => is_array($shopValue) ? implode(', ', $shopValue) : $shopValue,
        );
    } else if ($sAttributeCode === 'attribute_value') {// one of marketplace presented option is selected
        $aSelectValues = $this->getManipulateMarketplaceAttributeValues($aMPAttribute['values']);
        $aNewField = array(
            'name' => $sName,
            'type' => 'select',
            'value' => $this->getAttributeValues($sVariationValue, $sCustomIdentifier, $sMPAttributeCode, true),
            'values' => $aSelectValues,
        );

        if (MLHelper::gi('Model_Service_AttributesMatching')->isMultiSelectType($marketplaceDataType)) {
            $aNewField['type'] = 'multipleselect';
            $aNewField['limit'] = isset($aMPAttribute['limit']) ? $aMPAttribute['limit'] : null;
        } else {
            $aNewField['values'] = array('' => MLI18n::gi()->get('form_type_matching_select_optional')) + $aNewField['values'];
        }

        if ($bError) {
            $aNewField['cssclass'] = 'error';
        }
    } else if (empty($aShopAttributes['values'])) {
        $aNewField = array(
            'type' => 'hidden',
            'id' => $sId . '_field_hidden',
            'name' => $sName,
            'value' => 'true'
        );
    } else {
        $aNewField = array(
            'type' => !empty($aField['new_field_type']) ? $aField['new_field_type'] : 'matchingselect',
            'name' => $sName,
            'i18n' => isset($i18n['field']['attributematching']) ? $i18n['field']['attributematching'] : '',
            'addonempty' => true,
            'automatch' => true,
            'valuessrc' => $aShopAttributes['values'],
            'shopDataType' => $aShopAttributes['attributeDetails']['type'],
            'valuesdst' => array(
                'values' =>  $aMPAttribute['values'],
                'from_mp' => $freeTextDisabled,
            ),
            'marketplaceDataType' => $marketplaceDataType,
            'values' => $aMatchedAttributes,
            'limit' => isset($aMPAttribute['limit']) ? $aMPAttribute['limit'] : null,
            'error' => $bError,
        );
        if (isset($aField['doKeyPacking'])) {
            $aNewField['doKeyPacking'] = $aField['doKeyPacking'];
        }
        $useShopValues = $this->getUseShopValues($sVariationValue, $sCustomIdentifier, $sMPAttributeCode);
        if (isset($useShopValues)) {
            $aNewField['useShopValues'] = $useShopValues;
        }
    }
    $aNewField['notMatchIsSupported'] = MLFormHelper::getShopInstance()->shouldBeDisplayedAsVariationAttribute($sAttributeCode) && MLModule::gi()->isAttributeMatchingNotMatchOptionImplemented();
    $this->includeType($aNewField);
} else {
    // without this line the whole row is removed which removes needed controls
    echo ' ';
}
