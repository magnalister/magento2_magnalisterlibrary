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
MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_VariationsAbstract');

class ML_Otto_Controller_Otto_Prepare_Variations extends ML_Form_Controller_Widget_Form_VariationsAbstract {

    public function __construct() {
        parent::__construct();
        MLSetting::gi()->add('aCss', array('magnalister.otto.prepare.css'), true);
    }


    protected $categoryIndependentAttributes = 'category_independent_attributes';

    protected function getCategoryName($sCategoryId) {
        $oCat = MLDatabase::factory(MLModul::gi()->getMarketPlaceName().'_categoriesmarketplace');
        return $oCat->init(true)->set('categoryid', $sCategoryId)->get('categoryname');
    }

    public function callAjaxGetCategories() {
        $tableName = 'magnalister_'.MLModul::gi()->getMarketPlaceName().'_categories_marketplace';
        $sql = "SELECT * FROM $tableName";

        $results = MLDatabase::getDbInstance()->fetchArray($sql);

        foreach ($results as $aCategory) {
            // display only leaf categories (otto has only one leaf)
            if ($aCategory['LeafCategory'] == 1) {
                $aFinalCategories[] = array(
                    'id'   => $aCategory['CategoryID'],
                    'text' => html_entity_decode($aCategory['CategoryName'], ENT_QUOTES|ENT_SUBSTITUTE, 'UTF-8'),
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
        if (MLRequest::gi()->data('brandmatching') == 'PreloadBrandCache') {
            $this->getCategoryIndependentAttributes();
        }

        //get shop brands
        $matchingValue = MLRequest::gi()->data('brandmatchingShopMatchingValue');
        if (MLRequest::gi()->data('brandmatching') == 'GetBrands' && $matchingValue != '') {
            $sVariationValue = MLRequest::gi()->data('brandmatchingVariationValue');
            $sCustomIdentifier = MLRequest::gi()->data('brandmatchingCustomIdentifier');
            $sMPAttributeCode = MLRequest::gi()->data('brandmatchingMpAttributeCode');
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
                'results' => $aFinalBrands,
                'pagination' => array(
                    'more' => ($aBrandCount > $iPageLength) ? true : false,
                )
            ));
        }
        return $this;
    }

    public function callAjaxRefreshBrands() {
        $this->getCategoryIndependentAttributes(true);
    }

    public function getCategoryIndependentAttributes($forceRefresh = false) {
        $aCategoryIndependentAttributes = MagnaConnector::gi()->submitRequestCached(array(
            'ACTION' => 'GetCategoryIndependentAttributes',
        ), 86400, $forceRefresh);

        if(MLModul::gi()->isNeededPackingAttrinuteName()) {
            $aCodedKeys = array();
            foreach ($aCategoryIndependentAttributes['DATA']['attributes'] as $aCategoryIndependentAttribute) {
                $aCodedKeys[current(unpack('H*', $aCategoryIndependentAttribute['name']))] = $aCategoryIndependentAttribute;
            }
            $aCategoryIndependentAttributes['DATA']['attributes'] = $aCodedKeys;
        }
        return $aCategoryIndependentAttributes;
    }

    public function getMPCategoryIndependentAttributes($sVariationValue) {

        $aValues = $this->getCategoryIndependentAttributes();
        $result = array();
        if ($aValues) {
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

        $this->checkAttributesFromDB($sVariationValue, MLI18n::gi()->get(MLModul::gi()->getMarketPlaceName() . '_prepare_category_independent_title'));

        $aResultFromDB = $this->getAttributesFromDB($sVariationValue);

        if ($this->getNumberOfMaxAdditionalAttributes() > 0) {
            $additionalAttributes = array();
            $newAdditionalAttributeIndex = 0;
            $positionOfIndexInAdditionalAttribute = 2;

            if ($aResultFromDB) {
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

        return $result;
    }

    protected function getMPAttributeValues($sCategoryId, $sMpAttributeCode, $sAttributeCode = false) {
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
     * Checks whether there are some items prepared differently than in Variation Matching tab.
     * If so, adds notice to
     *
     * @param $sIdentifier
     * @param $sIdentifierName
     */
    protected function checkAttributesFromDB($sIdentifier, $sIdentifierName) {
        // similar validation exists in ML_Productlist_Model_ProductList_Abstract::isPreparedDifferently
        $aValue = MLDatabase::getVariantMatchingTableInstance()->getMatchedVariations($sIdentifier, $this->getCustomIdentifier());

        $oPrepareTable = MLDatabase::getPrepareTableInstance();
        $marketplaceID = MLModul::gi()->getMarketPlaceId();

        if ($sIdentifier === $this->categoryIndependentAttributes) {
            // we dont check for category independent attributes for now because of performance issues
            $sShopVariationField = '';
        } else {
            $sShopVariationField = $oPrepareTable->getShopVariationFieldName();
            $query = "SELECT DISTINCT $sShopVariationField
            FROM {$oPrepareTable->getTableName()}
            WHERE mpID = $marketplaceID
                AND {$oPrepareTable->getPrimaryCategoryFieldName()} = '".$this->oDB->escape($sIdentifier)."'";

            // SELECT DISTINCT because we don't need to load similar matching's
            $aPreparedDataQuery = $this->oDB->query($query);

            $bFoundDifferent = false;
            while (($aPreparedData = MLDatabase::getDbInstance()->fetchNext($aPreparedDataQuery)) && !$bFoundDifferent) {
                if (!empty($aPreparedData)) {
                    $aPreparedDataValue = json_decode($aPreparedData[$sShopVariationField], true);
                    if ($aPreparedDataValue != $aValue) {
                        MLMessage::gi()->addNotice(self::getMessage('_prepare_variations_notice', array('category_name' => $sIdentifierName)));
                        $bFoundDifferent = true;
                    }
                }
            }
        }
    }

    public function saveAction($blExecute = true) {
        if ($blExecute) {
            $aActions = $this->getRequest($this->sActionPrefix);
            $savePrepare = $aActions['saveaction'] === '1';

            $aMatchings = $this->getRequestField();

            if (isset($aMatchings['variationgroups'])) {
                foreach ($aMatchings['variationgroups'] as $ident => $aMatching) {
                    if (is_array($aMatching) && $ident !== ('variationgroups.value' || 'attributename')) {
                        $sIdentifier = $aMatchings['variationgroups.value'];
                        $sCustomIdentifier = $this->getCustomIdentifier();
                        if (isset($aMatchings['attributename'])) {
                            $sIdentifier = $aMatchings['attributename'];
                            if ($sIdentifier === 'none') {
                                MLMessage::gi()->addError(self::getMessage('_prepare_match_variations_attribute_missing'));
                                return;
                            }
                        }

                        if ($ident === $this->categoryIndependentAttributes) {
                            $sIdentifier = $ident;
                        }

                        $oVariantMatching = $this->getVariationDb();
                        $oVariantMatching->deleteVariation($sIdentifier, $sCustomIdentifier);

                        if ($sIdentifier === 'new') {
                            $sIdentifier = $aMatching['variationgroups.code'];
                            unset($aMatching['variationgroups.code']);
                        }

                        $aErrors = array();
                        $addNotAllValuesMatchedNotice = false;
                        $previouslyMatchedAttributes = array();
                        $emptyCustomName = false;

                        foreach ($aMatching as $key => &$value) {

                            if (isset($value['Required'])) {
                                $value['Required'] = (bool)$value['Required'];
                            }

                            if ($sIdentifier === $this->categoryIndependentAttributes && empty($value['Values']) && $savePrepare) {
                                $value['Values'] = true;
                            }

                            $value['Error'] = false;
                            $isSelectedAttribute = $key === $aActions['saveaction'];

                            // this field is only available on attributes that are FreeText Kind
                            // this is used to improve auto matching if checked no matched values will be saved
                            // we will use shop values and do the matching during product upload
                            if (isset($value['UseShopValues']) && $value['UseShopValues'] === '1') {
                                $value['Values'] = array();
                            } else {
                                $this->transformMatching($value);
                                $this->validateCustomAttributes($key, $value, $previouslyMatchedAttributes, $aErrors,
                                    $emptyCustomName, $savePrepare, $isSelectedAttribute);
                                $this->removeCustomAttributeHint($value);
                                $sAttributeName = $value['AttributeName'];
                                if (!isset($value['Code'])) {
                                    // this will happen only if attribute was matched and then it was deleted from the shop
                                    $value['Code'] = '';
                                }
                                if ($value['Code'] === '' || (empty($value['Values']) && $value['Values'] !== '0')) {
                                    if (isset($value['Required']) && $value['Required']) {
                                        if ($savePrepare || $isSelectedAttribute) {
                                            if ($savePrepare) {
                                                $aErrors[] = self::getMessage('_prepare_variations_error_text',
                                                    array('attribute_name' => $sAttributeName));
                                            }
                                            $value['Error'] = true;
                                        }
                                    }

                                    // $key should be unset whenever condition (isset($value['Required']) && $value['Required'] && $savePrepare)
                                    // is not true.
                                    if (!isset($value['Required']) || !$value['Required'] || !$savePrepare) {
                                        unset($aMatching[$key]);
                                    }

                                    continue;
                                }

                                if (!is_array($value['Values']) || !isset($value['Values']['FreeText'])) {
                                    continue;
                                }

                                $sInfo = self::getMessage('_prepare_variations_manualy_matched');
                                $sFreeText = $value['Values']['FreeText'];
                                unset($value['Values']['FreeText']);
                                if ($value['Values']['0']['Shop']['Key'] === 'noselection'
                                    || $value['Values']['0']['Marketplace']['Key'] === 'noselection'
                                ) {
                                    unset($value['Values']['0']);
                                    if (empty($value['Values']) && $value['Required'] && ($savePrepare || $isSelectedAttribute)) {
                                        if ($savePrepare) {
                                            $aErrors[] = self::getMessage('_prepare_variations_error_text',
                                                array('attribute_name' => $sAttributeName));
                                        }
                                        $value['Error'] = true;
                                    }

                                    foreach ($value['Values'] as $k => &$v) {
                                        if (empty($v['Marketplace']['Info']) || $v['Marketplace']['Key'] === 'manual') {
                                            $v['Marketplace']['Info'] = $v['Marketplace']['Value'].
                                                self::getMessage('_prepare_variations_free_text_add');
                                        }
                                    }

                                    continue;
                                }

                                if ($value['Values']['0']['Marketplace']['Key'] === 'reset') {
                                    unset($aMatching[$key]);
                                    continue;
                                }

                                if ($value['Values']['0']['Marketplace']['Key'] === 'manual') {
                                    $sInfo = self::getMessage('_prepare_variations_free_text_add');
                                    if (empty($sFreeText)) {
                                        if ($savePrepare || $isSelectedAttribute) {
                                            if ($savePrepare) {
                                                $aErrors[] = $sAttributeName.self::getMessage('_prepare_variations_error_free_text');
                                            }
                                            $value['Error'] = true;
                                        }

                                        unset($value['Values']['0']);
                                        continue;
                                    }

                                    $value['Values']['0']['Marketplace']['Value'] = $sFreeText;
                                }

                                if ($value['Values']['0']['Marketplace']['Key'] === 'auto') {
                                    $addNotAllValuesMatchedNotice = !$this->autoMatch($sIdentifier, $key, $value);
                                    continue;
                                }

                                $this->checkNewMatchedCombination($value['Values']);
                                if ($value['Values']['0']['Shop']['Key'] === 'all') {
                                    $newValue = array();
                                    $i = 0;
                                    $matchedMpValue = $value['Values']['0']['Marketplace']['Value'];

                                    foreach ($this->getShopAttributeValues($value['Code']) as $keyAttribute => $valueAttribute) {
                                        $newValue[$i]['Shop']['Key'] = $keyAttribute;
                                        $newValue[$i]['Shop']['Value'] = $valueAttribute;
                                        $newValue[$i]['Marketplace']['Key'] = $value['Values']['0']['Marketplace']['Key'];
                                        $newValue[$i]['Marketplace']['Value'] = $value['Values']['0']['Marketplace']['Value'];
                                        // $matchedMpValue can be array if it is multi value, so that`s why this is checked and converted to
                                        // string if it is. That is done because this information will be displayed in matched table.
                                        $newValue[$i]['Marketplace']['Info'] = (is_array($matchedMpValue) ? implode(', ', $matchedMpValue)
                                                : $matchedMpValue).$sInfo;
                                        $i++;
                                    }

                                    $value['Values'] = $newValue;
                                } else {
                                    foreach ($value['Values'] as $k => &$v) {
                                        if (empty($v['Marketplace']['Info'])) {
                                            // $v['Marketplace']['Value'] can be array if it is multi value, so that`s why this is checked
                                            // and converted to string if it is. That is done because this information will be displayed in matched
                                            // table.
                                            $v['Marketplace']['Info'] = (is_array($v['Marketplace']['Value']) ?
                                                    implode(', ', $v['Marketplace']['Value']) : $v['Marketplace']['Value']).$sInfo;
                                        }
                                    }
                                }
                            }
                        }
                        $oVariantMatching->set('Identifier', $sIdentifier)
                            ->set('CustomIdentifier', $sCustomIdentifier)
                            ->set('ShopVariation', json_encode($aMatching))
                            ->set('ModificationDate', date('Y-m-d H:i:s'))
                            ->save();
                    }
                }
                if ($savePrepare) {
                    $showSuccess = empty($aErrors) && !$addNotAllValuesMatchedNotice;
                    if ($showSuccess) {
                        MLRequest::gi()->set('resetForm', true);
                        MLMessage::gi()->addSuccess(self::getMessage('_prepare_variations_saved'));
                    } else {
                        foreach ($aErrors as $sError) {
                            MLMessage::gi()->addError($sError);
                        }

                        if ($addNotAllValuesMatchedNotice) {
                            MLMessage::gi()->addNotice(self::getMessage('_prepare_match_notice_not_all_auto_matched'));
                        }
                    }
                } else if ($addNotAllValuesMatchedNotice) {
                    MLMessage::gi()->addNotice(self::getMessage('_prepare_match_notice_not_all_auto_matched'));
                } else {
//                    MLMessage::gi()->addError(self::getMessage('_prepare_match_variations_no_selection'));
                }
            }
        }
    }

    public function resetAction($blExecute = true) {
        if ($blExecute) {
            $aActions = $this->getRequest($this->sActionPrefix);
            $reset = $aActions['resetaction'] === '1';
            if ($reset) {
                $aMatching = $this->getRequestField();
                $sIdentifiers[] = $aMatching['variationgroups.value'];
                $sIdentifiers[] = $this->categoryIndependentAttributes;
                $sCustomIdentifier = $this->getCustomIdentifier();

                foreach ($sIdentifiers as $sIdentifier) {
                    if (!empty($sIdentifier) || !$sIdentifier === 'none') {
                        $oVariantMatching = $this->getVariationDb();
                        $oVariantMatching->deleteVariation($sIdentifier, $sCustomIdentifier);
                    }
                }

                MLRequest::gi()->set('resetForm', true);
                MLMessage::gi()->addSuccess(self::getMessage('_prepare_variations_reset_success'));
            }
        }
    }
}
