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
$sCategoryId = $this->getField('primarycategory', 'value');
$aRequestFields = $this->getRequestField();

if ($sCategoryId != null) {
    $bReqiredFields = false;
    $i18n = $this->getFormArray('aI18n');
    $aCategoryInfo = $this->getCategoryInfo($sCategoryId);
    $aFieldset = array(
        'type'   => 'fieldset',
        'id'     => $this->getIdent().'_fieldset_'.$sCategoryId,
        'legend' => array(
            'i18n'     => $i18n['legend']['variationmatching'],
            'template' => 'two-columns',
        ),
        'row'    => array(
            'template' => 'default',
        ),
    );

	$aConfigField = array(
		'type' => 'configattributes'
	);

	$aMercadoAttributes = array();
	$aAttributesPrepare = json_decode($this->getField('attributes', 'value'), true);
	$aAttributesPrepare = reset($aAttributesPrepare);

	if ($aCategoryInfo['AttributeTypes'] !== 'none') {
		$aMercadoAttributes = $this->getCategoryAttributes($sCategoryId);

		foreach ($aMercadoAttributes as $sAttrId => $aValue) {
			$sBaseName = "field[attributes][$sCategoryId][$sAttrId]";
			$sName = $sBaseName . '[Code]';
			$sId = "attributes.$sCategoryId.$sAttrId.code";
			$aSelectField = $this->getField($sId);

			$mError = false;

			if (isset($this->oPrepareHelper->aErrorFields[$sId])) {
				$aSelectField['cssclass'] = 'error';
				$mError = $this->oPrepareHelper->aErrorFields[$sId];
			}

			if (isset($aRequestFields['attributes']) === true && isset($aRequestFields['attributes'][$sCategoryId]) === true) {
				$aAttrRequest = $aRequestFields['attributes'][$sCategoryId][$sAttrId];
				$sAttrRequestCode = $aAttrRequest['Code'];

				$aSelectField['value'] = $sAttrRequestCode;
			} else {
				$oMatchedAttribute = MLDatabase::factory('mercadolivre_matchedAttributes')->set('MercadoAttributeID', $sAttrId);
				$sShopAttributeID = $oMatchedAttribute->get('ShopAttributeID');
				$sMatching = $oMatchedAttribute->get('Matching');

				if ($sShopAttributeID !== null && $sMatching !== null) {
					$aSelectField['value'] = 'aamatchaa';
				}
			}

			$aSelectField['type'] = 'select';
			$aSelectField['name'] = $sName;
			$aSelectField['values']['__none__'] = MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT');
			$aSelectField['values']['aamatchaa'] = 'Matching';
			if (isset($aAttributesPrepare[$sAttrId]['Code']) === true) {
				$aSelectField['value'] = $aAttributesPrepare[$sAttrId]['Code'];
			}

			if ($aValue['type'] === 'list' || $aValue['type'] === 'boolean') {
				foreach ($aValue['values'] as $value) {
					$aSelectField['values'][$value['id']] = $value['name'];
				}
			} else if ($aValue['type'] === 'number' || $aValue['type'] === 'string') {
				$aSelectField['values']['__freevalue__'] = 'Free value';
			}
			
			$aSelectField['i18n'] = $i18n['field']['webshopattribute'];
			$aSelectField['i18n'] = $i18n['field']['label'] = '';

			$aAjaxField = $this->getField($sId . '_ajax');
			$aAjaxField['type'] = 'ajax';
			$aAjaxField['cascading'] = true;
			$aAjaxField['padding-right'] = 0;
			$aAjaxField['i18n']['label'] = '';
			$aAjaxField['ajax'] = array(
				'selector' => '#' . $aSelectField['id'],
				'trigger' => 'change',
				'field' => array(
					'id' => $sId . '_ajax_field',
					'type' => 'mpattribute',
					'error' => $mError
				)
			);

			if ($aValue['required'] === true) {
				$bReqiredFields = true;
				$iRequired = 1;
			} else {
				$iRequired = 0;
			}
			
			$iMaxLength = isset($aValue['max_length']) ? $aValue['max_length'] : 0;

			$aSubfield = $this->getField($sId . '_sub');
			$aSubfield['type'] = 'subFieldsContainer';
			$aSubfield['i18n']['label'] = $aValue['name'];
			$aSubfield['requiredField'] = $aValue['required'];
			$aSubfield['subfields'] = array(
				'select' => $aSelectField,
				'ajax' => $aAjaxField,
				'required' => array(
					'type' => 'hidden',
					'name' =>  $sBaseName . '[Required]',
					'id' => $sId . '_required',
					'value' => $iRequired,
				),
				'maxlength' => array(
					'type' => 'hidden',
					'name' =>  $sBaseName . '[MaxLength]',
					'id' => $sId . '_max_length',
					'value' => $iMaxLength,
				),
				'attrname' => array(
					'type' => 'hidden',
					'name' =>  $sBaseName . '[AttrName]',
					'id' => $sId . '_attr_name',
					'value' => $aValue['name'],
				)
			);

			$aFieldset['fields'][] = $aSubfield;
		}
	}
		
	if ($bReqiredFields === true) {
		echo MLI18n::gi()->get('mercadolivre_prepareform_reqired_fieds');
	}
	
	?>
    <table class="attributesTable">		
		<?php $this->includeType($aConfigField, array('aCategoryInfo' => $aCategoryInfo)); ?>
		<?php $this->includeView('widget_form_fieldset', array('aFieldset' => $aFieldset)); ?>
    </table>
    <?php
} else {
    echo ' ';
}
