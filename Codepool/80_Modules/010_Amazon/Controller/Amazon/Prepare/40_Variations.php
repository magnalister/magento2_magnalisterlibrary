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
MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_VariationsAbstract');

class ML_Amazon_Controller_Amazon_Prepare_Variations extends ML_Form_Controller_Widget_Form_VariationsAbstract {

    protected function variationGroups_ValueField(&$aField)
    {
        $aField['values'] = array_merge(
            array('none' => MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT')),
            MLModule::gi()->getMainCategories()
        );
    }

    protected function customidentifierField(&$aField)
    {
        $values = array();

        $category = $this->getRequestField('variationgroups.value');
        if (!empty($category) && !MLRequest::gi()->data('resetForm')) {
            $values = $this->getMPProductTypes($category);
        }

        $values = !empty($values) ? $values : array('' => MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT'));

        if (isset($aField['type']) && $aField['type'] === 'ajax') {
            $aField['ajax'] = array(
                'selector' => '#' . $this->getField('variationgroups.value', 'id'),
                'trigger' => 'change',
                'field' => array(
                    'type' => 'select',
                    'autoTriggerOnLoad' => 'change',
                    'values' => $values
                ),
            );
        } else {
            $aField['values'] = $values;
            unset($aField['value']); // At this point this is just initial placeholder field value
        }
    }

    protected function getMPProductTypes($category) {
        if ($category == 'none') {
            return array();
        }

        try {
            $aValues = MagnaConnector::gi()->submitRequestCached(array('ACTION' => 'GetCategoryDetails', 'CATEGORY' => $category));
        } catch (Exception $oEx) {
            MLMessage::gi()->addDebug($oEx);
            $aValues = array();
        }
        return !empty($aValues['DATA']['productTypes']) ? $aValues['DATA']['productTypes'] : array();
    }

    protected function variationMatchingField(&$aField)
    {
        $aField['ajax'] = array(
            'selector' => '#' . $this->getField('customidentifier', 'id'),
            'trigger' => 'change',
            'field' => array(
                'type' => 'switch',
            ),
        );
    }

    protected function callGetCategoryDetails($sCategoryId) {
        if ($sCategoryId == 'none') {
            return array();
        }

        $requestParams = array(
            'ACTION' => 'GetCategoryDetails',
            'CATEGORY' => $sCategoryId
        );

        $productType = $this->getRequestField('customidentifier');
        if (!empty($productType)) {
            $requestParams['PRODUCTTYPE'] = $productType;
        }

        return MagnaConnector::gi()->submitRequest($requestParams);
    }

    public function getMPVariationAttributes($sVariationValue)
    {
        $aValues = $this->callGetCategoryDetails($sVariationValue);
        $result = array();
        if ($aValues && isset($aValues['DATA']['attributes']) && is_array($aValues['DATA']['attributes'])) {
            foreach ($aValues['DATA']['attributes'] as $key => $value) {
                $result[$key] = array(
                    'value' => $value['title'],
                    'required' => isset($value['mandatory']) ? $value['mandatory'] : true,
                    'changed' => isset($value['changed']) ? $value['changed'] : null,
                    'desc' => isset($value['desc']) ? $value['desc'] : '',
                    'values' => !empty($value['values']) ? $value['values'] : array(),
                    'dataType' => !empty($value['type']) ? $value['type'] : 'text',
                );
            }
        }

        $this->checkAttributesFromDB($sVariationValue, $aValues['DATA']['name']);

        $aResultFromDB = $this->getAttributesFromDB($sVariationValue);
        $additionalAttributes = array();
        $newAdditionalAttributeIndex = 0;
        $positionOfIndexInAdditionalAttribute = 2;

        if ($aResultFromDB) {
            foreach ($aResultFromDB as $key => $value) {
                if (strpos($key, 'additional_attribute_') === 0) {
                    $additionalAttributes[$key] = $value;
                    $aAdditionalAttributeIndex = explode('_', $key);
                    $additionalAttributeIndex = (int)$aAdditionalAttributeIndex[$positionOfIndexInAdditionalAttribute];
                    $newAdditionalAttributeIndex = ($newAdditionalAttributeIndex > $additionalAttributeIndex) ?
                        $newAdditionalAttributeIndex + 1 : $additionalAttributeIndex + 1;
                }
            }
        }

        if (count($additionalAttributes) < $this->numberOfMaxAdditionalAttributes || $this->numberOfMaxAdditionalAttributes === -1) {
            $additionalAttributes['additional_attribute_' . $newAdditionalAttributeIndex] = array();
        }

        foreach ($additionalAttributes as $attributeKey => $attributeValue) {
            $result[$attributeKey] =  array(
                'value' => self::getMessage('_prepare_variations_additional_attribute_label'),
                'required' => false,
            );
        }

        return $result;
    }

    protected function getMPAttributeValues($sCategoryId, $sMpAttributeCode, $sAttributeCode = false)
    {
        $response = $this->callGetCategoryDetails($sCategoryId);
        $fromMP = false;
        foreach ($response['DATA']['attributes'] as $key => $attribute) {
            if ($key === $sMpAttributeCode && !empty($attribute['values'])) {
                $aValues = $attribute['values'];
                $fromMP = true;
                break;
            }
        }

        if (!isset($aValues)) {
            if ($sAttributeCode) {
                $shopValues = $this->getShopAttributeValues($sAttributeCode);
                foreach ($shopValues as $value) {
                    $aValues[$value] = $value;
                }
            }
        }

        return array(
            'values' => isset($aValues) ? $aValues : array(),
            'from_mp' => $fromMP
        );
    }
}
