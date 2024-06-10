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

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_PrepareWithVariationMatchingAbstract');

class ML_Otto_Controller_Otto_Prepare_Apply_Form extends ML_Form_Controller_Widget_Form_PrepareWithVariationMatchingAbstract {

    /** @var ML_Otto_Helper_Model_Table_Otto_PrepareData $oPrepareHelper */
    protected $oPrepareHelper = null;

    protected $categoryIndependentAttributes = 'category_independent_attributes';

    public function deliverytypeField(&$aField) {
        $aField['values'] = array(
            'PARCEL' => MLI18n::gi()->get('ML_OTTO_DELIVERYTYPE_PARCEL'),
            'FORWARDER_PREFERREDLOCATION' => MLI18n::gi()->get('ML_OTTO_DELIVERYTYPE_FORWARDER_PREFERREDLOCATION'),
            'FORWARDER_CURBSIDE' => MLI18n::gi()->get('ML_OTTO_DELIVERYTYPE_FORWARDER_CURBSIDE')
        );
    }

    public function deliverytimeField(&$aField) {
        $days = array();
        $i = 1;
        while ($i <= 90) {
            $days[$i.''] = $i;
            $i++;
        }

        $aField['values'] = $days;
    }

    public function callAjaxGetCategories() {
        $tableName = 'magnalister_'.MLModul::gi()->getMarketPlaceName().'_categories_marketplace';
        $sql = "SELECT * FROM $tableName";

        $results = MLDatabase::getDbInstance()->fetchArray($sql);

        foreach ($results as $aCategory) {
            // display only leaf categories (otto has only one leaf)
            if ($aCategory['LeafCategory'] == 1) {
                $aFinalCategories[] = array(
                    'id' => $aCategory['CategoryID'],
                    'text' => html_entity_decode($aCategory['CategoryName'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, 'UTF-8'),
                );
            }
        }

        $sSearch = MLRequest::gi()->data('categoryfilterSearch');
        if (!empty($sSearch)) {
            foreach ($aFinalCategories as $sKey => &$aCategory) {
                if (stripos($aCategory['text'], $sSearch) === false) {
                    unset($aFinalCategories[$sKey]);
                }
            }
        }

        // Pagination
        $iLength = 50;
        $iPageLength = (int)MLRequest::gi()->data('categoryfilterPage') * $iLength;
        $iOffset = (($iPageLength) - $iLength);

        // response
        MLSetting::gi()->add('aAjax', array(
            'results' => array_slice($aFinalCategories, $iOffset, $iLength),
            'pagination' => array(
                'more' => (count($aFinalCategories) > $iPageLength) ? true : false,
            )
        ));

        return $this;
    }

    public function callAjaxGetBrands() {
        $aNewArray = array();
        $brands = array();
        $aFinalBrands = array();
        $excludeAuto = MLRequest::gi()->data('brandmatchingExcludeAuto');
        $sCustomIdentifier = MLRequest::gi()->data('brandmatchingCustomIdentifier');
        $sMPAttributeCode = MLRequest::gi()->data('brandmatchingMpAttributeCode');
        if (MLRequest::gi()->data('brandmatching') == 'PreloadBrandCache') {
            $this->getCategoryIndependentAttributes();
        }

        //get shop brands
        $matchingValue = MLRequest::gi()->data('brandmatchingShopMatchingValue');
        if (MLRequest::gi()->data('brandmatching') == 'GetBrands' && $matchingValue != '') {
            $sVariationValue = MLRequest::gi()->data('brandmatchingVariationValue');
            $sAttributeCode = $matchingValue;
            $aShopAttributes = $this->getShopAttributeDetails($sAttributeCode);
            $brands = $aShopAttributes['values'];
            $aMatchedAttributes = $this->getAttributeValues($sVariationValue, $sCustomIdentifier, $sMPAttributeCode);
            if (is_array($aMatchedAttributes)) {
                foreach ($aMatchedAttributes as $aValue) {
                    if (isset($aValue['Shop']['Key']) && !is_array($aValue['Shop']['Key'])) {
                        unset($brands[$aValue['Shop']['Key']]);
                    }
                }
            }
            $aNewArray = array(
                'all' => MLI18n::gi()->get('form_type_matching_select_all'),
            );
        }

        //get marketplace brands
        if (MLRequest::gi()->data('brandmatching') == 'GetBrands' && $matchingValue == '') {
            $results = $this->getCategoryIndependentAttributes();
            $brands = $results['DATA']['attributes'][current(unpack('H*', 'Brand'))]['values'];
            //exclude auto match options
            if(!$excludeAuto) {
                $aNewArray = array(
                    'auto' => MLI18n::gi()->get('form_type_matching_select_auto'),
                    'reset' => MLI18n::gi()->get('form_type_matching_select_reset'),
                );
            }
        }

        if (!empty($brands)) {
            $brands = $aNewArray + $brands;
            //exclude auto match options
            if (!$excludeAuto) {
                $aFinalBrands = [['text' => MLI18n::gi()->get('otto_config_matching_options')], ['text' => MLI18n::gi()->get('otto_config_matching_shop_values')]];
            } else {
                $aFinalBrands = [['text' => MLI18n::gi()->get('otto_config_matching_shop_values')]];
            }
            if (MLRequest::gi()->data('brandmatching') == 'GetBrands' && $matchingValue == '') {
                //exclude auto match options
                if (!$excludeAuto) {
                    $aFinalBrands = [['text' => MLI18n::gi()->get('otto_config_matching_options')], ['text' => MLI18n::gi()->get('otto_config_matching_otto_values')]];
                } else {
                    $aFinalBrands = [['text' => MLI18n::gi()->get('otto_config_matching_otto_values')]];
                }
            }

            foreach ($brands as $id => $text) {
                if (in_array($id, ['all', 'auto', 'reset'])) {
                    $aFinalBrands[0]['children'][] = array(
                        'id' => $id,
                        'text' => $text
                    );
                } else {
                    $aFinalBrands[1]['children'][] = array(
                        'id' => $id,
                        'text' => $text
                    );
                }
            }

            $sSearch = MLRequest::gi()->data('brandmatchingSearch');
            if (!empty($sSearch)) {
                foreach ($aFinalBrands[1]['children'] as $sKey => $aBrand) {
                    if (stripos($aBrand['text'], $sSearch) === false) {
                        unset($aFinalBrands[1]['children'][$sKey]);
                    }
                }
            }

            // Pagination
            $iLength = 50;
            $iPageLength = (int)MLRequest::gi()->data('brandmatchingPage') * $iLength;
            $iOffset = (($iPageLength) - $iLength);
            $aBrandCount = count($aFinalBrands[1]['children']);
            $aFinalBrands[1]['children'] = array_slice($aFinalBrands[1]['children'], $iOffset, $iLength);

            if((int)MLRequest::gi()->data('brandmatchingPage') !== 1) {
                $aBrandPage = [['text' => MLI18n::gi()->get('otto_config_matching_otto_values')]];
                $aBrandPage[0]['children'] = $aFinalBrands[1]['children'];

                $aFinalBrands = $aBrandPage;
            }

            // response
            MLSetting::gi()->add('aAjax', array(
                'validation' => $this->getErrorValue('category_independent_attributes', $sCustomIdentifier, $sMPAttributeCode),
                'results' => $aFinalBrands,
                'pagination' => array(
                    'more' => ($aBrandCount > $iPageLength) ? true : false,
                )
            ));
        }

        return $this;
    }

    public function callAjaxRefreshBrands() {
        $this->getCategoryIndependentAttributes(false, true);
    }

    public function getCategoryIndependentAttributes($getAllAttributes = false, $forceRefresh = false) {
        $request = array(
            'ACTION' => 'GetCategoryIndependentAttributes',
        );
        if ($forceRefresh) {
            $request['DATA'] = array(
                'ForceUpdate' => true,
            );
        }

        $aCategoryDetails = MagnaConnector::gi()->submitRequestCached($request, 86400, $forceRefresh);


        if (MLModule::gi()->isNeededPackingAttrinuteName()) {
            $aCodedKeys = array();
            foreach ($aCategoryDetails['DATA']['attributes'] as $aCategoryDetail) {
                if (!$getAllAttributes && !$this->oProduct instanceof ML_Shop_Model_Product_Abstract && !$aCategoryDetail['multi']) {
                    continue;
                }
                $aCodedKeys[current(unpack('H*', $aCategoryDetail['name']))] = $aCategoryDetail;
            }

            $aCategoryDetails['DATA']['attributes'] = $aCodedKeys;
        }
        return $aCategoryDetails;
    }

    public function getMPCategoryIndependentAttributes($sVariationValue) {
        if ($this->aMPAttributes !== null) {
            return $this->aMPAttributes;
        }

        $aValues = $this->getCategoryIndependentAttributes(true);
        $result = array();
        if ($aValues && !empty($aValues['DATA']['attributes'])) {
            foreach ($aValues['DATA']['attributes'] as $key => $value) {
                $result[$key] = array(
                    'value' => $value['title'],
                    'required' => isset($value['mandatory']) ? $value['mandatory'] : true,
                    'changed' => isset($value['changed']) ? $value['changed'] : null,
                    'desc' => isset($value['desc']) ? $value['desc'] : '',
                    'help' => isset($value['help']) ? $value['help'] : null,
                    'values' => !empty($value['values']) ? $value['values'] : array(),
                    'dataType' => !empty($value['type']) ? $value['type'] : 'text',
                    'isbrand' => $value['name'] === 'Brand' ? 1 : 0,
                );
            }
        }

        $aResultFromDB = $this->getPreparedData($sVariationValue, '');

        if (!is_array($aResultFromDB)) {
            $aResultFromDB = $this->getAttributesFromDB($sVariationValue);
        }

        if ($this->getNumberOfMaxAdditionalAttributes() > 0) {
            $additionalAttributes = array();
            $newAdditionalAttributeIndex = 0;
            $positionOfIndexInAdditionalAttribute = 2;

            if (!empty($aResultFromDB)) {
                foreach ($aResultFromDB as $key => $value) {
                    if (strpos($key, 'additional_attribute_') === 0) {
                        $additionalAttributes[$key] = $value;
                        $additionalAttributeIndex = explode('_', $key);
                        $additionalAttributeIndex = (int)$additionalAttributeIndex[$positionOfIndexInAdditionalAttribute];
                        $newAdditionalAttributeIndex = ($newAdditionalAttributeIndex > $additionalAttributeIndex) ?
                            $newAdditionalAttributeIndex + 1 : $additionalAttributeIndex + 1;
                    }
                }
            }

            $additionalAttributes['additional_attribute_'.$newAdditionalAttributeIndex] = array();

            foreach ($additionalAttributes as $attributeKey => $attributeValue) {
                $result[$attributeKey] = array(
                    'value' => self::getMessage('_prepare_variations_additional_attribute_label'),
                    'custom' => true,
                    'required' => false,
                );
            }
        }

        $this->detectChanges($result, $sVariationValue);

        return $result;
    }

    protected function getMPAttributeValues($sCategoryId, $sMpAttributeCode, $sAttributeCode = false)
    {
        if ($sCategoryId === $this->categoryIndependentAttributes) {
            $response = $this->getCategoryIndependentAttributes();
        } else {
            $response = $this->callGetCategoryDetails($sCategoryId);
        }

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
            } else {
                $aValues = array();
            }
        }

        return array(
            'values' => isset($aValues) ? $aValues : array(),
            'from_mp' => $fromMP
        );
    }

    /**
     * Checks for each attribute whether it is prepared differently in Attributes Matching tab,
     * and if so, marks it Modified.
     * Arrays cannot be compared directly because values could be in different order (with different numeric keys).
     *
     * @param $result
     * @param $sIdentifier
     */
    protected function detectChanges(&$result, $sIdentifier) {
        // similar validation exists in ML_Productlist_Model_ProductList_Abstract::isPreparedDifferently
        $globalMatching = MLDatabase::getVariantMatchingTableInstance()->getMatchedVariations($sIdentifier, $this->getCustomIdentifier());

        $sShopVariationField = $sIdentifier === $this->categoryIndependentAttributes ?
            MLDatabase::getPrepareTableInstance()->getCategoryIndependentShopVariationFieldName() :
            MLDatabase::getPrepareTableInstance()->getShopVariationFieldName();

        $oPrepareTable = MLDatabase::getPrepareTableInstance();
        $sProductId = $this->getProductId();

        $oPrepareTable->set($oPrepareTable->getProductIdFieldName(), $sProductId);

        if ($sIdentifier !== $this->categoryIndependentAttributes) {
            $productMatching = $oPrepareTable
                ->set($oPrepareTable->getPrimaryCategoryFieldName(), $sIdentifier)
                ->get($sShopVariationField);
        } else {
            $productMatching = $oPrepareTable->get($sShopVariationField);
        }

        if (is_array($globalMatching)) {
            foreach ($globalMatching as $attributeCode => $attributeSettings) {
                // If attribute is deleted on MP do not detect changes for that attribute at all since whole attribute is missing!
                if (!isset($result[$attributeCode])) {
                    continue;
                }

                // attribute is matched globally but not on product
                if ($productMatching !== 'null' && $productMatching !== null && empty($productMatching[$attributeCode])) {
                    $result[$attributeCode]['modified'] = true;
                    continue;
                }

                if (empty($productMatching)) {
                    continue;
                }

                $productAttrs = $productMatching[$attributeCode];

                if (!array_key_exists('Values', $productAttrs) || !array_key_exists('Values', $attributeSettings)) {
                    continue;
                }

                if (!is_array($productAttrs['Values']) || !is_array($attributeSettings['Values'])) {
                    $result[$attributeCode]['modified'] = $productAttrs != $attributeSettings;
                    continue;
                }

                $productAttrsValues = $productAttrs['Values'];
                $attributeSettingsValues = $attributeSettings['Values'];
                unset($productAttrs['Values']);
                unset($attributeSettings['Values']);

                // first compare without values (optimization)
                $allValuesMatched = count($productAttrsValues) === count($attributeSettingsValues);
                if ($productAttrs['Code'] == $attributeSettings['Code'] && $allValuesMatched) {
                    // compare values
                    // values could be in different order so we need to iterate through array and check one by one
                    foreach ($productAttrsValues as $attribute) {
                        // Since $productAttrsValues can be array of (string) values, we must check for existence of Info to
                        // avoid Fatal error: Cannot unset string offsets
                        if (!empty($attribute['Marketplace']['Info'])) {
                            unset($attribute['Marketplace']['Info']);
                        }

                        $found = false;
                        foreach ($attributeSettingsValues as $value) {
                            if (!empty($value['Marketplace']['Info'])) {
                                unset($value['Marketplace']['Info']);
                            }

                            if ($attribute == $value) {
                                $found = true;
                                break;
                            }
                        }

                        if (!$found) {
                            $allValuesMatched = false;
                            break;
                        }
                    }
                }

                $result[$attributeCode]['modified'] = !$allValuesMatched;
            }
        }
    }

    /**
     * @param $sIdentifier
     * @param $sCustomIdentifier
     * @return mixed
     */
    protected function getPreparedData($sIdentifier, $sCustomIdentifier)
    {
        if ($sIdentifier !== $this->categoryIndependentAttributes) {

            $sProductId = $this->getProductId();

            $oPrepareTable = MLDatabase::getPrepareTableInstance();
            $sPrimaryCategory = $this->oPrepareList->get($oPrepareTable->getPrimaryCategoryFieldName());

            $sPrimaryCategoryValue = isset($sPrimaryCategory['['.$sProductId.']'])
                ? $sPrimaryCategory['['.$sProductId.']'] : reset($sPrimaryCategory);

            if (!empty($sPrimaryCategory)) {
                if ($sPrimaryCategoryValue === $sIdentifier) {
                    $aValue = $this->getPreparedShopVariationForList($this->oPrepareList);
                }
            }
        } else {
            $aValue = $this->getPreparedShopVariationForList($this->oPrepareList, true);
        }

        if (!isset($aValue)) {
            $aValue = $this->getAttributesFromDB($sIdentifier, $sCustomIdentifier);
        }

        return $aValue;
    }

    protected function triggerBeforeFinalizePrepareAction() {
        $aActions = $this->getRequest($this->sActionPrefix);
        $savePrepare = $aActions['prepareaction'] === '1';
        $this->oPrepareList->set('preparetype', $this->getSelectionNameValue());
        $this->setPreparedStatus(true);

        if ($this->prepareHasErrors($savePrepare)) {
            $this->setPreparedStatusToError();
            return false;
        }

        $aMatchings = $this->getRequestField();

        $variationThemeData = $this->getVariationThemeValidationData($aMatchings);
        $variationThemeAttributes = $variationThemeData['variationThemeAttributes'];
        $submittedVariationThemeCode = $variationThemeData['submittedVariationThemeCode'];

        $variationThemeExists = isset($aMatchings['variationthemealldata']);
        if ($variationThemeExists) {
            // Save variation theme to prepare table and it will be later used for making addItems request(split & skip)
            $this->oPrepareList->set(
                'variation_theme',
                json_encode(array($submittedVariationThemeCode => $variationThemeAttributes), true)
            );
            unset($aMatchings['variationthemecode']);
            unset($aMatchings['variationthemealldata']);
        }

        $this->saveVariationThemeBlacklist($aMatchings);
        $sCustomIdentifier = $this->getCustomIdentifier();
        $sIdentifier = $this->getIdentifier($aMatchings);
        $allErrors = array();

        if (isset($aMatchings['variationgroups'])) {
            foreach ($aMatchings['variationgroups'] as $ident => $aMatching) {
                $sIdentifier = $this->getIdentifier($aMatchings);
                if ($ident === $this->categoryIndependentAttributes) {
                    $sIdentifier = $ident;
                }

                if (empty($sIdentifier)) {
                    MLMessage::gi()->addError(MLI18n::gi()->get($this->getMPName().'_prepareform_category'));
                    $this->setPreparedStatus(false);

                    return false;
                }

                $oVariantMatching = $this->getVariationDb();
                unset($aMatching['variationgroups.code']);

                $aErrors = array();
                $previouslyMatchedAttributes = array();
                $emptyCustomName = false;
                $maxNumberOfAdditionalAttributes = $this->getNumberOfMaxAdditionalAttributes();
                $numberOfMatchedAdditionalAttributes = 0;

                foreach ($aMatching as $key => &$value) {
                    if (isset($value['Required'])) {
                        // If value is required convert Required to boolean value.
                        $value['Required'] = in_array($value['Required'], array(1, true, '1', 'true'), true);
                    }

                    $value['CategoryId'] = $this->getCategoryIdentifierValue();

                    if ($sIdentifier === $this->categoryIndependentAttributes && empty($value['Values']) && $savePrepare) {
                        $value['Values'] = true;
                    }

                    // Initial value for error is false.
                    $value['Error'] = false;
                    // Flag used for validating only those attributes for which save or delete button is pressed.
                    $isSelectedAttribute = $key === $aActions['prepareaction'];

                    // this field is only available on attributes that are FreeText Kind
                    // this is used to improve auto matching if checked no matched values will be saved
                    // we will use shop values and do the matching during product upload
                    if (isset($value['UseShopValues']) && $value['UseShopValues'] === '1') {
                        $value['Values'] = array();
                    } else {
                        $this->transformMatching($value);
                        $this->validateCustomAttributes($key, $value, $previouslyMatchedAttributes, $aErrors, $emptyCustomName,
                            $savePrepare, $isSelectedAttribute, $numberOfMatchedAdditionalAttributes);
                        $this->removeCustomAttributeHint($value);
                        $sAttributeName = $value['AttributeName'];
                        // If variation theme is sent in request and submitted attribute is in attributes of variation theme
                        // that is variation theme attribute for which validation should be the same as for required attribute.
                        $isVariationThemeAttribute = $variationThemeExists && in_array($key, $variationThemeAttributes);

                        if (!isset($value['Code'])) {
                            // this will happen only if attribute was matched and then it was deleted from the shop
                            $value['Code'] = '';
                        }

                        $this->setValidatedDataForRequiredOrVariationThemeAttribute(
                            $value,
                            $isVariationThemeAttribute,
                            $savePrepare,
                            $isSelectedAttribute,
                            $sAttributeName,
                            $aMatching,
                            $aErrors,
                            $key
                        );

                        // this field is only available on attributes that are FreeText Kind
                        // this is used to improve auto matching if checked no matched values will be saved
                        // we will use shop values and do the matching during product upload
                        if (isset($value['UseShopValues']) && $value['UseShopValues'] === '1') {
                            $value['Values'] = array();
                        } else {
                            if (!$this->attributeIsMatched($value) || !is_array($value['Values']) ||
                                !isset($value['Values']['FreeText'])
                            ) {
                                if (!empty($aErrors)) {
                                    $allErrors[] = $aErrors;
                                }
                                continue;
                            }

                            $sInfo = self::getMessage('_prepare_variations_manualy_matched');
                            $sFreeText = $value['Values']['FreeText'];
                            unset($value['Values']['FreeText']);
                            $isNoSelection = $value['Values']['0']['Shop']['Key'] === 'noselection'
                                || $value['Values']['0']['Marketplace']['Key'] === 'noselection';

                            $this->setValidatedNoSelectionAttribute(
                                $value,
                                $isVariationThemeAttribute,
                                $savePrepare,
                                $isSelectedAttribute,
                                $sAttributeName,
                                $aErrors
                            );

                            if ($isNoSelection) {
                                if (!empty($aErrors)) {
                                    $allErrors[] = $aErrors;
                                }
                                continue;
                            }

                            if ($value['Values']['0']['Marketplace']['Key'] === 'reset') {
                                $aMatching[$key]['Values'] = array();
                                if (!empty($aErrors)) {
                                    $allErrors[] = $aErrors;
                                }
                                continue;
                            }

                            // here is useful for first matching not updating matched value
                            if ($value['Values']['0']['Marketplace']['Key'] === 'manual') {
                                $sInfo = self::getMessage('_prepare_variations_free_text_add');
                                if (empty($sFreeText)) {
                                    if ($this->shouldValidateAttribute($savePrepare, $isSelectedAttribute)) {
                                        if ($savePrepare) {
                                            $aErrors[] = $key.self::getMessage('_prepare_variations_error_free_text');
                                        }
                                        $value['Error'] = true;
                                    }

                                    unset($value['Values']['0']);
                                    if (!empty($aErrors)) {
                                        $allErrors[] = $aErrors;
                                    }
                                    continue;
                                }

                                $value['Values']['0']['Marketplace']['Value'] = $sFreeText;
                            }

                            if ($value['Values']['0']['Marketplace']['Key'] === 'auto') {
                                $this->autoMatch($sIdentifier, $key, $value);
                                $value['Values'] = $this->fixAttributeValues($value['Values']);
                                // Validate if auto match didn't find any matching
                                if (empty($value['Values']) &&
                                    $this->isRequiredAttribute($value, $isVariationThemeAttribute) &&
                                    $this->shouldValidateAttribute($savePrepare, $isSelectedAttribute)
                                ) {
                                    if ($savePrepare) {
                                        $aErrors[] = self::getMessage('_prepare_variations_error_text',
                                            array('attribute_name' => $sAttributeName));
                                    }

                                    $value['Error'] = true;
                                }
                                if (!empty($aErrors)) {
                                    $allErrors[] = $aErrors;
                                }
                                continue;
                            }

                            $this->checkNewMatchedCombination($value['Values']);
                            $this->setAttributeValues($value, $sInfo);
                        }
                    }
                }

                if ($savePrepare && $numberOfMatchedAdditionalAttributes > $maxNumberOfAdditionalAttributes) {
                    // If there is a limit on number of custom attributes, validation message should be displayed.
                    $aErrors[] = self::getMessage('_prepare_variations_error_maximal_number_custom_attributes_exceeded',
                        array('numberOfAttributes' => $maxNumberOfAdditionalAttributes));
                }

                // If variation theme is defined for that category and mandatory but nothing is selected.
                if ($submittedVariationThemeCode === 'null') {
                    $aErrors[] = self::getMessage('_prepare_variations_theme_mandatory_error');
                }

                $this->saveShopVariationAndPrimaryCategory($aMatching, $sIdentifier);
                $this->setAllErrorsAndPreparedStatus($aErrors);

                $this->saveToAttributesMatchingTable($oVariantMatching, $sIdentifier, $sCustomIdentifier, $aMatching);
                //MLMessage::gi()->addSuccess(self::getMessage('_prepare_match_variations_saved'));
            }
            if (!empty($allErrors) || !$savePrepare) {
                // stay on prepare form
                return false;
            }
        } else {// if nothing is matched in attribute matching we should save varaiationgroups as primary category of marketplace
            $this->oPrepareList->set(MLDatabase::getPrepareTableInstance()->getPrimaryCategoryFieldName(), $sIdentifier);
        }
        return true;
    }

    protected function autoMatch($categoryId, $sMpAttributeCode, &$aAttributes)
    {
        $aMPAttributeValues = $this->getMPAttributeValues($categoryId, $sMpAttributeCode, $aAttributes['Code']);
        $sInfo = self::getMessage('_prepare_variations_auto_matched');
        $blFound = false;
        if ($aAttributes['Values']['0']['Shop']['Key'] === 'all') {
            $newValue = array();
            $i = 0;
            foreach ($this->getShopAttributeValues($aAttributes['Code']) as $keyAttribute => $valueAttribute) {
                $blFoundInMP = false;
                foreach ($aMPAttributeValues['values'] as $key => $value) {
                    if (strcasecmp($valueAttribute, $value) == 0) {
                        $newValue[$i]['Shop']['Key'] = $keyAttribute;
                        $newValue[$i]['Shop']['Value'] = $valueAttribute;
                        $newValue[$i]['Marketplace']['Key'] = $key;
                        $newValue[$i]['Marketplace']['Value'] = $key;
                        // $value can be array if it is multi value, so that`s why this is checked
                        // and converted to string if it is. That is done because this information will be displayed in matched
                        // table.
                        $newValue[$i]['Marketplace']['Info'] = (is_array($value) ? implode(', ', $value) : $value) . $sInfo;
                        $blFound = $blFoundInMP = true;
                        $i++;
                        break;
                    } 
                }
            }

            $aAttributes['Values'] = $newValue;
        } else {
            foreach ($aMPAttributeValues['values'] as $key => $value) {
                if (strcasecmp($aAttributes['Values']['0']['Shop']['Value'], $value) == 0) {
                    $aAttributes['Values']['0']['Marketplace']['Key'] = $key;
                    $aAttributes['Values']['0']['Marketplace']['Value'] = $key;
                    // $value can be array if it is multi value, so that`s why this is checked
                    // and converted to string if it is. That is done because this information will be displayed in matched
                    // table.
                    $aAttributes['Values']['0']['Marketplace']['Info'] =
                        (is_array($value) ? implode(', ', $value) : $value) . $sInfo;
                    $blFound = true;
                    break;
                }
            }
        }

        if (!$blFound) {
            MLMessage::gi()->addWarn(MLI18n::gi()->otto_prepare_match_notice_not_all_auto_matched);
            unset($aAttributes['Values']['0']);
        }

        $this->checkNewMatchedCombination($aAttributes['Values']);
    }

    /**
     * Saves shop variation and chosen category to DB.
     *
     * @param array $shopVariation
     * @param string $category
     */
    protected function saveShopVariationAndPrimaryCategory($shopVariation, $category)
    {
        if ($category !== $this->categoryIndependentAttributes) {
            $oPrepareTable = MLDatabase::getPrepareTableInstance();
            $this->oPrepareList->set('shopvariation', json_encode($shopVariation));
            $this->oPrepareList->set($oPrepareTable->getPrimaryCategoryFieldName(), $category);
        } else {
            $this->oPrepareList->set('categoryindependentshopvariation', json_encode($shopVariation));
        }
        // for first preparation we should add calculated shopvariaton to request field
        // otherwise it try to read it from prepare table, but prepare table is always empty in first preparation
        $this->aRequestFields['shopvariation'] = $shopVariation;
        $this->oPrepareHelper->setRequestFields($this->aRequestFields);
    }

    public function triggerAfterField(&$aField, $parentCall = false)
    {
        parent::triggerAfterField($aField, true);

        if ($parentCall) {
            return;
        }

        $sName = $aField['realname'];

        // when top variation groups drop down is changed, its value is updated in getRequestValue
        // otherwise, it should remain empty.
        // without second condition this function will be executed recursevly because of the second line below.
        if (!isset($aField['value'])) {
            $sProductId = $this->getProductId();

            $oPrepareTable = MLDatabase::getPrepareTableInstance();

            $aPrimaryCategories = $this->oPrepareList->get($oPrepareTable->getPrimaryCategoryFieldName());
            $sPrimaryCategoriesValue = isset($aPrimaryCategories['[' . $sProductId . ']'])
                ? $aPrimaryCategories['[' . $sProductId . ']'] : reset($aPrimaryCategories);

            if ($sName === 'variationgroups.value') {
                $aField['value'] = $sPrimaryCategoriesValue;
            } else {
                // check whether we're getting value for standard group or for custom variation mathing group
                $sCustomGroupName = $this->getField('variationgroups.value', 'value');
                $aCustomIdentifier = explode(':', $sCustomGroupName);

                if (count($aCustomIdentifier) == 2 && ($sName === 'attributename' || $sName === 'customidentifier')) {
                    $aField['value'] = $aCustomIdentifier[$sName === 'attributename' ? 0 : 1];
                    return;
                }

                $aNames = explode('.', $sName);
                if (count($aNames) == 4 && strtolower($aNames[3]) === 'code') {
                    $category = strtolower($aNames[1]);
                    $categoryIndependent = $category === $this->categoryIndependentAttributes ? true : false;
                    $aValue = $this->getPreparedShopVariationForList($this->oPrepareList, $categoryIndependent);
                    if (!isset($aValue) || (strtolower($sPrimaryCategoriesValue) !== $category && $category !== $this->categoryIndependentAttributes)) {
                        // real name is in format "variationgroups.qnvjagzvcm1hda____.rm9ybwf0.code"
                        $sCustomIdentifier = count($aCustomIdentifier) == 2 ? $aCustomIdentifier[1] : '';
                        if (empty($sCustomIdentifier)) {
                            $sCustomIdentifier = $this->getCustomIdentifier();
                        }
                        $aValue = $this->getAttributesFromDB($aNames[1], $sCustomIdentifier);
                    }

                    if ($aValue) {
                        foreach ($aValue as $sKey => &$aMatch) {
                            if (strtolower($sKey) === $aNames[2]) {
                                if (!isset($aMatch['Code'])) {
                                    // this will happen only if attribute was matched and then deleted from the shop
                                    $aMatch['Code'] = '';
                                }
                                $aField['value'] = $aMatch['Code'];
                                break;
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * Gets ShopVariation data fof given prepare list and current product
     *
     * @param ML_Database_Model_list $oPrepareList Where to look for ShopVariation field data
     *
     * @param bool $getCategoryIndependentField Get category independent variations if st true
     *
     * @param bool $setDefaultValue If set to true in case when exact match by product id is not found
     * first value from the list will be returned. Set this to false to get only exact product id match
     *
     * @return mixed|null ShopVariation field data or null if nothing is found for current product
     */
    protected function getPreparedShopVariationForList($oPrepareList, $getCategoryIndependentField = false, $setDefaultValue = true)
    {
        $sProductId = $this->getProductId();
        $aValue = null;

        $dbFieldName = $getCategoryIndependentField ?
            MLDatabase::getPrepareTableInstance()->getCategoryIndependentShopVariationFieldName() :
            MLDatabase::getPrepareTableInstance()->getShopVariationFieldName();
        $aShopVariation = $oPrepareList->get($dbFieldName);
        if (!empty($aShopVariation) && isset($aShopVariation['[' . $sProductId . ']'])) {
            $aValue = $aShopVariation['[' . $sProductId . ']'];
        } else if (!empty($aShopVariation) && $setDefaultValue) {
            $aValue = reset($aShopVariation);
        }

        return $aValue;
    }

    protected function getErrorValue($sIdentifier, $sCustomIdentifier, $sAttributeCode)
    {
        if ($sIdentifier === $this->categoryIndependentAttributes) {
            $aValue = $this->oPrepareList->get('categoryindependentshopvariation');
        } else {
            $aValue = $this->oPrepareList->get('shopvariation');
        }

        $sProductIds = $this->oPrepareList->get('products_id');
        foreach ($sProductIds as $sProductId) {
            if (!empty($aValue['['.$sProductId.']'])) {
                foreach ($aValue['['.$sProductId.']'] as $sKey => $aMatch) {
                    if ($sKey === $sAttributeCode) {
                        return $aMatch['Error'];
                    }
                }
            }
        }

        return false;
    }
}
