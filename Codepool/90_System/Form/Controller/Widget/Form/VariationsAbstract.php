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

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_ConfigAbstract');

abstract class ML_Form_Controller_Widget_Form_VariationsAbstract extends ML_Form_Controller_Widget_Form_ConfigAbstract {

    const UNLIMITED_ADDITIONAL_ATTRIBUTES = PHP_INT_MAX;

    protected $aParameters = array('controller');
    protected $shopAttributes;
    protected $numberOfMaxAdditionalAttributes = 0;
    private $variationCache = array();

    public function __construct() {
        MLSettingRegistry::gi()->addJs('select2/select2.min.js');
        MLSettingRegistry::gi()->addJs('select2/i18n/'.strtolower(MLLanguage::gi()->getCurrentIsoCode().'.js'));
        MLSetting::gi()->add('aCss', array('select2/select2.min.css'), true);

        parent::__construct();
    }

    public static function getTabTitle() {
        return MLI18n::gi()->{'attributes_matching_tab_title'};
    }

    public static function getTabActive() {
        return MLModule::gi()->isAuthed();
    }

    public function getModificationDate($sIdentifier, $sCustomIdentifier = '') {
        $hashParams = md5($sIdentifier.$sCustomIdentifier.'ModificationDate');
        if (!array_key_exists($hashParams, $this->variationCache)) {
            $this->variationCache[$hashParams] = $this->getVariationDb()
                ->set('Identifier', $sIdentifier)
                ->set('CustomIdentifier', $sCustomIdentifier)
                ->get('ModificationDate');
        }

        return $this->variationCache[$hashParams];
    }

    /**
     * @return int
     */
    public function getNumberOfMaxAdditionalAttributes() {
        return $this->numberOfMaxAdditionalAttributes;
    }

    public function deleteAction($blExecute = true) {
        if ($blExecute) {
            $this->getRequestField();
            $sCustomIdentifier = $this->getCustomIdentifier();
            $this->getVariationDb()->deleteCustomVariation($sCustomIdentifier);
        }
    }

    public function resetAction($blExecute = true) {
        if ($blExecute) {
            $aActions = $this->getRequest($this->sActionPrefix);
            $reset = $aActions['resetaction'] === '1';
            if ($reset) {
                $aMatching = $this->getRequestField();
                $sIdentifier = $aMatching['variationgroups.value'];
                if (empty($sIdentifier) || $sIdentifier === 'none') {
                    MLMessage::gi()->addError(self::getMessage('_prepare_match_variations_category_missing'));
                    return;
                }

                $sCustomIdentifier = $this->getCustomIdentifier();

                $oVariantMatching = $this->getVariationDb();
                $oVariantMatching->deleteVariation($sIdentifier, $sCustomIdentifier);
                MLRequest::gi()->set('resetForm', true);
                MLMessage::gi()->addSuccess(self::getMessage('_prepare_variations_reset_success'));
            }
        }
    }

    /**
     * Remove Hint like "Zusatzfelder:" or "Eigenschaften:"
     * @param $aValue
     */
    protected function removeCustomAttributeHint(&$aValue) {
        // if custom attribute and not empty
        if (isset($aValue['CustomAttributeNameCode']) && $aValue['Code'] != '') {
            $sDelimiter = ': ';
            $aExplode = explode($sDelimiter, $aValue['AttributeName']);
            if (!empty($aExplode)) {
                $aValue['AttributeName'] = str_replace($aExplode[0].$sDelimiter, '', $aValue['AttributeName']);
            }
        }
    }

    protected function validateCustomAttributes(
        $key, &$value, &$previouslyMatchedAttributes, &$aErrors,
        &$emptyCustomName, $savePrepare, $isSelectedAttribute
    ) {
        if (isset($value['CustomAttributeNameCode']) && $value['Code'] != '') {
            $invalidName = false;

            if (empty($value['AttributeName'])) {
                if ($savePrepare || $isSelectedAttribute) {
                    $value['Error'] = true;
                }

                if (!$emptyCustomName && $savePrepare) {
                    $aErrors[] = self::getMessage('_prepare_variations_error_empty_custom_attribute_name');
                }
                $emptyCustomName = true;

            } else {
                foreach ($previouslyMatchedAttributes as $previouslyMatchedAttribute) {
                    if ($previouslyMatchedAttribute['AttributeName'] === $value['AttributeName']) {
                        $invalidName = true;
                        break;
                    }
                }

                if ($invalidName && ($savePrepare || $isSelectedAttribute)) {
                    $value['Error'] = true;
                    if ($savePrepare) {
                        $aErrors[] = self::getMessage(
                            '_prepare_variations_error_duplicated_custom_attribute_name',
                            array(
                                'attributeName' => $value['AttributeName'],
                                'marketplace' => MLModule::gi()->getMarketPlaceName(false),
                            )
                        );
                    }
                }
            }
        }

        $previouslyMatchedAttributes[$key] = $value;
    }

    public function saveAction($blExecute = true) {
        if ($blExecute) {
            $aActions = $this->getRequest($this->sActionPrefix);
            $savePrepare = $aActions['saveaction'] === '1';
            $aMatching = $this->getRequestField();
            $sIdentifier = $aMatching['variationgroups.value'];
            $sCustomIdentifier = $this->getCustomIdentifier();
            if (isset($aMatching['attributename'])) {
                $sIdentifier = $aMatching['attributename'];
                if ($sIdentifier === 'none') {
                    MLMessage::gi()->addError(self::getMessage('_prepare_match_variations_attribute_missing'));
                    return;
                }
            }

            if (isset($aMatching['variationgroups'])) {
                $aMatching = $aMatching['variationgroups'][$sIdentifier];
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
                            $aMatching[$key]['Values'] = array();
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
                }
            } else {
                MLMessage::gi()->addError(self::getMessage('_prepare_match_variations_no_selection'));
            }
        }
    }

    public function getRequestValue(&$aField) {
        try {
            if (MLRequest::gi()->data('resetForm')) {
                unset($aField['value']);
                return;
            }
        } catch (MagnaException $ex) {
        }

        parent::getRequestValue($aField);
        $sName = $aField['realname'];
        if ($sName === 'variationgroups.value') {
            return;
        }

        if (MLHttp::gi()->isAjax()) {
            $aRequestTriggerField = MLRequest::gi()->get('ajaxData');
            if ($aRequestTriggerField['method'] === 'variationmatching') {
                unset($aField['value']);
                return;
            }
        }

        if (!isset($aField['value'])) {
            $mValue = null;
            $aRequestFields = $this->getRequestField();
            $aNames = explode('.', $aField['realname']);
            $value = null;
            if (count($aNames) > 1 && isset($aRequestFields[$aNames[0]])) {
                // parent real name is in format "variationgroups.qnvjagzvcm1hda____.rm9ybwf0.code"
                // and name in request is "[variationgroups][Buchformat][Format][Code]"
                $sName = $sKey = $aNames[0];
                $aTmp = $aRequestFields[$aNames[0]];
                $value = null;
                for ($i = 1; $i < count($aNames); $i++) {
                    if (is_array($aTmp)) {
                        foreach ($aTmp as $key => $value) {
                            if (strtolower($key) === 'code') {
                                break;
                            } elseif (strtolower($key) == $aNames[$i]) {
                                $sName .= '.'.$key;
                                $sKey = $key;
                                $aTmp = $value;
                                break;
                            }
                        }
                    } else {
                        break;
                    }
                }

                if (isset($sKey) && $sKey !== $aNames[0] && !is_array($value)) {
                    $mValue = array($sKey => $value, 'name' => $sName);
                }
            }

            if ($mValue != null) {
                $aField['value'] = reset($mValue);
                $aField['valuearr'] = $mValue;
            }
        }
    }

    public function getValue(&$aField) {
        $sName = $aField['realname'];

        // when top variation groups drop down is changed, its value is updated in getRequestValue
        // otherwise, it should remain empty.
        // without second condition this function will be executed recursevly because of the second line below.
        if (!isset($aField['value']) && $sName !== 'variationgroups.value') {
            // check whether we're getting value for standard group or for custom variation mathing group
            $sCustomGroupName = $this->getField('variationgroups.value', 'value');

            // Helper for php8 compatibility - can't pass null to explode 
            $sCustomGroupName = MLHelper::gi('php8compatibility')->checkNull($sCustomGroupName);
            $aCustomIdentifier = explode(':', $sCustomGroupName);

            if (count($aCustomIdentifier) == 2 && ($sName === 'attributename' || $sName === 'customidentifier')) {
                $aField['value'] = $aCustomIdentifier[$sName === 'attributename' ? 0 : 1];
                return;
            }

            $aNames = explode('.', $sName);
            if (count($aNames) == 4 && strtolower($aNames[3]) === 'code') {
                // real name is in format "variationgroups.qnvjagzvcm1hda____.rm9ybwf0.code"
                $sCustomIdentifier = count($aCustomIdentifier) == 2 ? $aCustomIdentifier[1] : '';
                if (empty($sCustomIdentifier)) {
                    $sCustomIdentifier = $this->getCustomIdentifier();
                }

                $aValue = $this->getAttributesFromDB($aNames[1], $sCustomIdentifier);
                foreach ($aValue as $sKey => &$aMatch) {
                    if (strtolower($sKey) === $aNames[2]) {
                        if (!isset($aMatch['Code'])) {
                            // this will happen only if attribute was matched and then it was deleted from the shop
                            $aMatch['Code'] = '';
                        }
                        $aField['value'] = $aMatch['Code'];
                        break;
                    }
                }
            }
        }
    }

    protected function getCustomIdentifier() {
        $sCustomIdentifier = $this->getRequestField('customidentifier');
        return !empty($sCustomIdentifier) ? $sCustomIdentifier : '';
    }

    protected function encodeText($sText, $blLower = true) {
        return MLHelper::gi('text')->encodeText($sText, $blLower);
    }

    protected function decodeText($sText) {
        return MLHelper::gi('text')->decodeText($sText);
    }

    protected function variationGroupsField(&$aField) {
        $sMarketplaceName = MLModule::gi()->getMarketPlaceName();
        $aField['subfields']['variationgroups.value']['values'] = array('' => '..') +
            ML::gi()->instance('controller_'.$sMarketplaceName.'_config_prepare')
                ->getField('primarycategory', 'values');

        foreach ($aField['subfields'] as &$aSubField) {
            // adding current cat, if not in top cat
            if (isset($aSubField['value']) && !array_key_exists($aSubField['value'], $aSubField['values'])) {
                $oCat = MLDatabase::factory($sMarketplaceName.'_categories'.$aSubField['cattype']);
                $oCat->init(true)->set('categoryid', $aSubField['value'] ? $aSubField['value'] : 0);
                $sCat = '';
                foreach ($oCat->getCategoryPath() as $oParentCat) {
                    $sCat = $oParentCat->get('categoryname').' &gt; '.$sCat;
                }

                $aSubField['values'][$aSubField['value']] = substr($sCat, 0, -6);
            }
        }
    }

    /**
     * If in api doesn't return any category name in getCategoryDetail
     * we should get it from category table
     * @param $sCategoryId
     * @return string
     */
    protected function getCategoryName($sCategoryId){
        return '';
    }

    protected function variationMatchingField(&$aField) {
        $aField['ajax'] = array(
            'selector' => '#'.$this->getField('variationgroups.value', 'id'),
            'trigger' => 'change',
            'field' => array(
                'type' => 'switch',
            ),
        );
    }

    protected function deleteActionField(&$aField) {
        $sGroupIdentifier = $this->getField('variationgroups.value', 'value');
        $aCustomIdentifier = explode(':', $sGroupIdentifier);
        $sCustomIdentifier = count($aCustomIdentifier) == 2 ? $aCustomIdentifier[1] : '';
        if (empty($sCustomIdentifier)) {
            $sCustomIdentifier = $this->getCustomIdentifier();
        }

        if (!empty($sCustomIdentifier)) {
            $aField['type'] = 'submit';
            $aField['value'] = 'delete';
        } else {
            $aField['type'] = '';
        }
    }

    protected function attributeNameField(&$aField) {
        $aField['type'] = 'select';
        $aField['values'] = array_merge(
            array('none' => MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT')),
            $this->getMPVariationGroups(false)
        );
    }

    protected function attributeNameAjaxField(&$aField) {
        $aField['type'] = 'ajax';
        $aField['cascading'] = true;
        $aField['breakbefore'] = true;
        $aField['ajax'] = array(
            'selector' => '#'.$this->getField('attributename', 'id'),
            'trigger' => 'change',
            'field' => array(
                'type' => 'variations',
            ),
        );
    }

    protected function callGetCategoryDetails($sCategoryId) {
        return MLFormHelper::getPrepareAMCommonInstance()->getCategoryDetails($sCategoryId);
    }

    /**
     * Gets all data for marketplace attribute which is supplied.
     * @param $categoryId
     * @param $mpAttributeCode
     * @param $shopAttributeCode
     * @return array
     */
    public function getMPAttributes($categoryId, $mpAttributeCode, $shopAttributeCode) {
        $mpValues = $this->callGetCategoryDetails($categoryId);

        $valuesAndFromMp = $this->getMPAttributeValues($categoryId, $mpAttributeCode, $shopAttributeCode);
        $result = array(
            'values' => $valuesAndFromMp['values'],
            'from_mp' => $valuesAndFromMp['from_mp'],
        );

        if (isset($mpValues['DATA']) && isset($mpValues['DATA']['attributes'][$mpAttributeCode])) {
            $mpAttribute = $mpValues['DATA']['attributes'][$mpAttributeCode];
            $result = array_merge($result, array(
                    'value' => $mpAttribute['title'],
                    'required' => isset($mpAttribute['mandatory']) ? $mpAttribute['mandatory'] : true,
                    'changed' => isset($mpAttribute['changed']) ? $mpAttribute['changed'] : null,
                    'desc' => isset($mpAttribute['desc']) ? $mpAttribute['desc'] : '',
                    'dataType' => !empty($mpAttribute['type']) ? $mpAttribute['type'] : 'text',
                    'limit' => !empty($mpAttribute['limit']) ? $mpAttribute['limit'] : null,
                )
            );
        } else {
            $result['dataType'] = 'text';
        }

        return $result;
    }

    public function getMPVariationAttributes($sVariationValue) {
        $aValues = $this->callGetCategoryDetails($sVariationValue);
        $result = array();
        if ($aValues) {
            foreach ($aValues['DATA']['attributes'] as $key => $value) {
                $result[$key] = array(
                    'value' => $value['title'],
                    'required' => isset($value['mandatory']) ? $value['mandatory'] : true,
                    'changed' => isset($value['changed']) ? $value['changed'] : null,
                    'desc' => isset($value['desc']) ? $value['desc'] : '',
                    'values' => !empty($value['values']) ? $value['values'] : array(),
                    'dataType' => !empty($value['type']) ? $value['type'] : 'text',
                    'categoryId' => !empty($value['categoryId']) ? $value['categoryId'] : null,
                    'attributeId' => !empty($value['id']) ? $value['id'] : null,
                );
            }
        }

        $this->checkAttributesFromDB($sVariationValue, isset($aValues['DATA']['name']) ? $aValues['DATA']['name'] : $this->getCategoryName($sVariationValue));

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

    protected function getAttributeValues($sIdentifier, $sCustomIdentifier = '', $sAttributeCode = null, $bFreeText = false) {
        $aReturn = null;
        $aValue = $this->getAttributesFromDB($sIdentifier, $sCustomIdentifier);
        if ($aValue) {
            if ($sAttributeCode !== null) {
                foreach ($aValue as $sKey => $aMatch) {
                    if ($sKey === $sAttributeCode) {
                        $aReturn = isset($aMatch['Values']) ? $aMatch['Values'] : '';
                        break;
                    }
                }
            } else {
                $aReturn = $aValue;
            }
        }
        if ($aReturn === null) {
            $aReturn = $bFreeText ? '' : array();
        }
        return $aReturn;
    }

    protected function getUseShopValues($sIdentifier, $sCustomIdentifier, $sAttributeCode = null) {
        $aValue = $this->getAttributesFromDB($sIdentifier, $sCustomIdentifier);
        $result = null;
        if ($aValue) {
            if ($sAttributeCode !== null) {
                foreach ($aValue as $sKey => $aMatch) {
                    if ($sKey === $sAttributeCode && isset($aMatch['UseShopValues'])) {
                        $result = $aMatch['UseShopValues'];
                        break;
                    }
                }
            }
        }

        return $result;
    }

    protected function getErrorValue($sIdentifier, $sCustomIdentifier, $sAttributeCode) {
        $aValue = $this->getAttributesFromDB($sIdentifier, $sCustomIdentifier);
        foreach ($aValue as $sKey => $aMatch) {
            if ($sKey === $sAttributeCode) {
                return $aMatch['Error'];
            }
        }

        return false;
    }

    protected function getMPVariationGroups($blFinal) {
        return array();
    }

    protected function getShopAttributes() {
        if ($this->shopAttributes == null) {
            $this->shopAttributes = MLFormHelper::getShopInstance()->getGroupedAttributesForMatching();
        }

        return $this->shopAttributes;
    }

    protected function getShopAttributeValues($sAttributeCode) {
        return MLFormHelper::getPrepareAMCommonInstance()->getShopAttributeValues($sAttributeCode);
    }

    /**
     * Gets values for sent attribute code and all its details. (Name, DataType,..)
     * @param $sAttributeCode
     * @return array
     */
    public function getShopAttributeDetails($sAttributeCode) {
        return array(
            'values' => $this->getShopAttributeValues($sAttributeCode),
            'attributeDetails' => MLFormHelper::getShopInstance()->getFlatShopAttributesForMatching($sAttributeCode),
        );
    }

    /**
     * In case that multiple values are sent for shop and marketplace, that information will be json_encoded array.
     * Deserialization is done so that it can be properly saved to database.
     * @param $matchedAttribute
     */
    protected function transformMatching(&$matchedAttribute) {
        if (isset($matchedAttribute['Values']) && is_array($matchedAttribute['Values'])) {
            $emptyOptionValue = 'noselection';
            $multiSelectKey = 'multiselect';

            foreach ($matchedAttribute['Values'] as &$matchedAttributeValue) {
                if (is_array($matchedAttributeValue)) {
                    if (is_array($matchedAttributeValue['Shop']['Key'])) {
                        $matchedAttributeValue['Shop']['Value'] =
                            json_decode($matchedAttributeValue['Shop']['Value'], true);

                    } else if (strtolower($matchedAttributeValue['Shop']['Key']) === $multiSelectKey) {
                        // If multi select is chosen but nothing is selected from multiple select, this value should be ignored.
                        $matchedAttributeValue['Shop']['Key'] = $emptyOptionValue;
                    }

                    if (is_array($matchedAttributeValue['Marketplace']['Key'])) {
                        $matchedAttributeValue['Marketplace']['Value'] =
                            json_decode($matchedAttributeValue['Marketplace']['Value'], true);

                    } else if (strtolower($matchedAttributeValue['Marketplace']['Key']) === $multiSelectKey) {
                        // If multi select is chosen but nothing is selected from multiple select, this value should be ignored.
                        $matchedAttributeValue['Marketplace']['Key'] = $emptyOptionValue;
                    }
                }
            }
        }
    }

    protected function getMPAttributeValues($sCategoryId, $sMpAttributeCode, $sAttributeCode = false) {
        $response = $this->callGetCategoryDetails($sCategoryId);
        $fromMP = false;
        $sType = '';
        foreach ($response['DATA']['attributes'] as $key => $attribute) {
            if ($key === $sMpAttributeCode && !empty($attribute['values'])) {
                $aValues = $attribute['values'];
                $sType = $attribute['type']; 
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
        } else if (    $sAttributeCode
                    && (    $sType == 'text'
                         || $sType == 'selectAndText'
                         || $sType == 'multiSelectAndText')
        ) {
                // predefined values exist, but free text is allowed => add shop's values to selection
                // at the end, and sorted, so that it's visible that it's added
                $shopValues = $this->getShopAttributeValues($sAttributeCode);
                asort($shopValues);
                $aLowerValues = array_map('mb_strtolower', $aValues);
                foreach ($shopValues as $value) {
                    if (array_search(mb_strtolower($value), $aLowerValues) !== false) {
                        continue;
                    }
                    $aValues[$value] = $value;
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
        $sShopVariationField = $oPrepareTable->getShopVariationFieldName();
        $marketplaceID = MLModule::gi()->getMarketPlaceId();

        // SELECT DISTINCT because we don't need to load similar matching's
        $aPreparedDataQuery = $this->oDB->query("
            SELECT DISTINCT $sShopVariationField
            FROM {$oPrepareTable->getTableName()}
            WHERE mpID = $marketplaceID
                AND {$oPrepareTable->getPrimaryCategoryFieldName()} = '".$this->oDB->escape($sIdentifier)."'
        ");

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

    protected function getAttributesFromDB($sIdentifier, $sCustomIdentifier = '') {
        if ($sCustomIdentifier === null) {
            $sCustomIdentifier = '';
        }
        
        $hashParams = md5($sIdentifier.$sCustomIdentifier.'ShopVariation');
        if (!array_key_exists($hashParams, $this->variationCache)) {
            $this->variationCache[$hashParams] = $this->getVariationDb()
                ->set('Identifier', $sIdentifier)
                ->set('CustomIdentifier', $sCustomIdentifier)
                ->get('ShopVariation');
        }

        if ($this->variationCache[$hashParams] && $this->variationCache[$hashParams] !== 'null') {
            return $this->variationCache[$hashParams];
        }

        return array();
    }

    protected function getFromApi($actionName, $aData = array()) {
        try {
            $aResponse = MagnaConnector::gi()->submitRequestCached(array('ACTION' => $actionName, 'DATA' => $aData));
            if ($aResponse['STATUS'] == 'SUCCESS' && isset($aResponse['DATA']) && is_array($aResponse['DATA'])) {
                return $aResponse['DATA'];
            }
        } catch (MagnaException $e) {

        }

        return array();
    }

    /**
     * @return ML_Database_Model_Table_VariantMatching_Abstract
     */
    protected function getVariationDb() {
        return MLDatabase::getVariantMatchingTableInstance();
    }

    protected function autoMatch($categoryId, $sMpAttributeCode, &$aAttributes) {
        $aMPAttributeValues = $this->getMPAttributeValues($categoryId, $sMpAttributeCode, $aAttributes['Code']);
        $sInfo = self::getMessage('_prepare_variations_auto_matched');
        $blFound = false;
        $allValuesAreMatched = true;
        if ($aAttributes['Values']['0']['Shop']['Key'] === 'all') {
            $newValue = array();
            $i = 0;
            $shopAttributes = $this->getShopAttributeValues($aAttributes['Code']);
            foreach ($shopAttributes as $keyAttribute => $valueAttribute) {
                $blFoundInMP = false;
                foreach ($aMPAttributeValues['values'] as $key => $value) {
                    if (strcasecmp($valueAttribute, $value) == 0) {
                        $newValue[$i]['Shop']['Key'] = $keyAttribute;
                        $newValue[$i]['Shop']['Value'] = $valueAttribute;
                        $newValue[$i]['Marketplace']['Key'] = $key;
                        $newValue[$i]['Marketplace']['Value'] = $value;
                        // $value can be array if it is multi value, so that`s why this is checked
                        // and converted to string if it is. That is done because this information will be displayed in matched
                        // table.
                        $newValue[$i]['Marketplace']['Info'] = (is_array($value) ? implode(', ', $value) : $value).$sInfo;
                        $blFound = $blFoundInMP = true;
                        $i++;
                        break;
                    }
                }
                // if value is not found in mp values and if attribute can be added as freetext, it is added here as freetext
                if (!$blFoundInMP && isset($aAttributes['DataType']) && strpos(strtolower($aAttributes['DataType']), 'text')) {
                    $newValue[$i]['Shop']['Key'] = $keyAttribute;
                    $newValue[$i]['Shop']['Value'] = $valueAttribute;
                    $newValue[$i]['Marketplace']['Key'] = $valueAttribute;
                    $newValue[$i]['Marketplace']['Value'] = $valueAttribute;
                    $newValue[$i]['Marketplace']['Info'] = $valueAttribute.self::getMessage('_prepare_variations_free_text_add');
                    $blFound = true;
                    $i++;
                }
            }

            $aAttributes['Values'] = $newValue;
            if (count($shopAttributes) !== count($newValue)) {
                $allValuesAreMatched = false;
            }
        } else {
            foreach ($aMPAttributeValues['values'] as $key => $value) {
                if (strcasecmp($aAttributes['Values']['0']['Shop']['Value'], $value) == 0) {
                    $aAttributes['Values']['0']['Marketplace']['Key'] = $key;
                    $aAttributes['Values']['0']['Marketplace']['Value'] = $value;
                    // $value can be array if it is multi value, so that`s why this is checked
                    // and converted to string if it is. That is done because this information will be displayed in matched
                    // table.
                    $aAttributes['Values']['0']['Marketplace']['Info'] =
                        (is_array($value) ? implode(', ', $value) : $value).$sInfo;
                    $blFound = true;
                    break;
                }
            }

            if (!$blFound) {
                $allValuesAreMatched = false;
            }
        }

        if (!$blFound) {
            unset($aAttributes['Values']['0']);
        }

        $this->checkNewMatchedCombination($aAttributes['Values']);

        return $allValuesAreMatched;
    }

    protected function checkNewMatchedCombination(&$aAttributes) {
        foreach ($aAttributes as $key => $value) {
            if ($key === 0) {
                continue;
            }

            if (isset($aAttributes['0']) && $value['Shop']['Key'] === $aAttributes['0']['Shop']['Key']) {
                unset($aAttributes[$key]);
                break;
            }
        }
    }

    protected static function getMessage($sIdentifier, $aReplace = array()) {
        return MLI18n::gi()->get(MLModule::gi()->getMarketPlaceName() . $sIdentifier, $aReplace);
    }

    /**
     * Detects if matched attribute is deleted on shop.
     * @param array $savedAttribute
     * @param string $warningMessageCode message code that should be displayed
     * @return bool
     */
    public function detectIfAttributeIsDeletedOnShop($savedAttribute, &$warningMessageCode) {
        return MLFormHelper::getPrepareAMCommonInstance()->detectIfAttributeIsDeletedOnShop($savedAttribute, $warningMessageCode);
    }

    protected function isNeededPackingAttrinuteName(){
        return false;
    }

    /**
     * @param $values array
     * @return array
     */
    public function getManipulateMarketplaceAttributeValues($values) {
        return MLFormHelper::getPrepareAMCommonInstance()->getManipulateMarketplaceAttributeValues($values);

    }
}
