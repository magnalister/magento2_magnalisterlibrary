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

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_PrepareAbstract');

abstract class ML_Form_Controller_Widget_Form_PrepareWithVariationMatchingAbstract extends ML_Form_Controller_Widget_Form_PrepareAbstract
{
    const UNLIMITED_ADDITIONAL_ATTRIBUTES = PHP_INT_MAX;

    protected $aParameters = array('controller');
    protected $shopAttributes;
    protected $numberOfMaxAdditionalAttributes = 0;
    protected $aMPAttributes;

    protected $variationCache = array();

    public function construct()
    {
        MLSettingRegistry::gi()->addJs('select2/select2.min.js');
        MLSettingRegistry::gi()->addJs('select2/i18n/'.strtolower(MLLanguage::gi()->getCurrentIsoCode().'.js'));
        MLSetting::gi()->add('aCss', array('select2/select2.min.css'), true);
        parent::construct();
        $this->oPrepareHelper->bIsSinglePrepare = $this->oSelectList->getCountTotal() === '1';
    }

    public function render()
    {
        $this->getFormWidget();
        return $this;
    }

    public function getRequestField($sName = null, $blOptional = false)
    {
        if (count($this->aRequestFields) == 0) {
            $this->aRequestFields = $this->getRequest($this->sFieldPrefix);
            $this->aRequestFields = is_array($this->aRequestFields) ? $this->aRequestFields : array();
        }

        return parent::getRequestField($sName, $blOptional);
    }

    /**
     * @return int
     */
    public function getNumberOfMaxAdditionalAttributes()
    {
        return $this->numberOfMaxAdditionalAttributes;
    }

    protected function getSelectionNameValue()
    {
        return 'apply';
    }

    public function getModificationDate()
    {
        $aRows = $this->oPrepareList->getList();
        return count($aRows) > 0 ? current($aRows)->get(MLDatabase::getPrepareTableInstance()->getPreparedTimestampFieldName()) : '';
    }

    protected function getCustomIdentifier()
    {
        $sCustomIdentifier = $this->getRequestField('customidentifier');
        return !empty($sCustomIdentifier) ? $sCustomIdentifier : '';
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
                $aValue['AttributeName']= str_replace($aExplode[0].$sDelimiter, '', $aValue['AttributeName']);
            }
        }
    }

    protected function validateCustomAttributes(
        $key,
        &$value,
        &$previouslyMatchedAttributes,
        &$aErrors,
        &$emptyCustomName,
        $savePrepare,
        $isSelectedAttribute,
        &$numberOfMatchedAdditionalAttributes
    ) {
        if (!isset($value['CustomAttributeNameCode']) || $value['Code'] == '') {
            $previouslyMatchedAttributes[$key] = $value;
            return;
        }

        $invalidName = false;
        $numberOfMatchedAdditionalAttributes++;

        if (empty($value['AttributeName'])) {
            if ($this->shouldValidateAttribute($savePrepare, $isSelectedAttribute)) {
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

            if ($invalidName && $this->shouldValidateAttribute($savePrepare, $isSelectedAttribute)) {
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
        $previouslyMatchedAttributes[$key] = $value;
    }

    protected function getCategoryIdentifierValue()
    {
        $aMatching = $this->getRequestField();
        return isset($aMatching['variationgroups.value']) ? $aMatching['variationgroups.value'] : '';
    }

    /**
     * Checks if prepare has any errors which should be considered only if $savePrepare === true (button for saving all
     * data from form is pressed).
     *
     * @param $savePrepare Bool False or code of submitted attribute
     * @return bool
     */
    protected function prepareHasErrors($savePrepare)
    {
        return $savePrepare && !empty($this->oPrepareHelper->aErrors);
    }

    /**
     * Sets prepared status to error if there are any errors
     */
    protected function setPreparedStatusToError()
    {
        $productIDs = array();
        foreach ($this->oPrepareHelper->aErrors as $error) {
            if (is_array($error)) {
                $productIDs[] = $error['product_id'];
                $error = $error['message'];
            }

                MLMessage::gi()->addError(MLI18n::gi()->get($error));
            }

        $this->setPreparedStatus(false, $productIDs);
    }

    /**
     * Gets the data that is needed for proper validation of attributes when there is some variation theme chosen. All
     * attributes that make variation theme and variation theme code are needed for validation. Code is needed because
     * if code for splitting all variations, or 'null' code is submitted, validation should not be done.
     *
     * @param array $aMatching Used for transmitting variation theme data
     * @return array Data that is needed for variation theme validation
     */
    protected function getVariationThemeValidationData($aMatching)
    {
        $variationThemeAttributes = null;
        $submittedVariationThemeCode = '';

        if (isset($aMatching['variationthemealldata'])) {
            $variationThemes = json_decode(htmlspecialchars_decode($aMatching['variationthemealldata']), true);

            $submittedVariationTheme = array();
            if (isset($aMatching['variationthemecode']) && is_array($aMatching['variationthemecode'])) {
                // When submitting ajax field in V3 submitted value is an array. That array has format :
                // variationthemecode => array($codeOfDependingField => $variationThemeCode);
                $submittedVariationTheme = array_values($aMatching['variationthemecode']);
            }

            $submittedVariationThemeCode = reset($submittedVariationTheme);
            $variationThemeAttributes = array();
            if (isset($variationThemes[$submittedVariationThemeCode]['attributes'])) {
                $variationThemeAttributes = $variationThemes[$submittedVariationThemeCode]['attributes'];

            }
        }

        return array(
            'variationThemeAttributes' => $variationThemeAttributes,
            'submittedVariationThemeCode' => $submittedVariationThemeCode,
        );
    }

    /**
     * Saves variation theme black list. In some marketplaces there is list of attributes that can not be used as
     * variation ones. They are saved in prepare table because later will be used for making the addItems request(split
     * and skip)
     *
     * @param array $aMatching Used for transmitting variation theme blacklist data
     */
    protected function saveVariationThemeBlacklist(&$aMatching)
    {
        if (isset($aMatching['variationthemeblacklist'])) {
            $variationThemeBlacklistHTMLDecoded = htmlspecialchars_decode($aMatching['variationthemeblacklist']);
            $variationThemeBlacklist = json_decode($variationThemeBlacklistHTMLDecoded, true);

            $this->oPrepareList->set('VariationThemeBlacklist', $variationThemeBlacklist);
            unset($aMatching['variationthemeblacklist']);
        }
    }

    /**
     * @param array $aMatching
     * @param string $identifier
     * @return string
     */
    protected function getIdentifier($aMatching)
    {
        $identifier = $this->getCategoryIdentifierValue();
        if (empty($identifier) && !empty($aMatching['variationgroups'])) {
            $variationGroupKeys = array_keys($aMatching['variationgroups']);
            $identifier = array_shift($variationGroupKeys);
        }

        if ($identifier === 'new') {
            $identifier = $aMatching['variationgroups.code'];
        }

        return $identifier;
    }

    protected function attributeIsMatched($value) {
        return  $value['Code'] !== '' && (!empty($value['Values']) || (isset($value['Values']) && $value['Values'] === '0'));
    }

    /**
     * Sets validated data for mandatory or variation theme attributes.
     *
     * @param array $attributeProperties Properties of an attribute that is being validated
     * @param bool $isVariationThemeAttribute Flag for checking whether it is an attribute from variation theme
     * @param mixed $savePrepare Bool False or code of submitted attribute
     * @param bool $isSelectedAttribute Flag representing whether it is an attribute on which save or delete is invoked
     * @param string $attributeName Name of an attribute needed for error log
     * @param array $aMatching Whole matching
     * @param array $aErrors Whole errors array that will be returned to client
     * @param string $key Code for unset from matching
     */
    protected function setValidatedDataForRequiredOrVariationThemeAttribute(
        &$attributeProperties,
        $isVariationThemeAttribute,
        $savePrepare,
        $isSelectedAttribute,
        $attributeName,
        &$aMatching,
        &$aErrors,
        $key
    ) {
        if ($this->attributeIsMatched($attributeProperties)) {
            return;
        }

        if ($this->isRequiredAttribute($attributeProperties, $isVariationThemeAttribute)) {
            $this->setPreparedStatus(false);

            if ($this->shouldValidateAttribute($savePrepare, $isSelectedAttribute)) {
                $attributeProperties['Error'] = true;

                if ($savePrepare) {
                    $aErrors[] = self::getMessage('_prepare_variations_error_text',
                        array('attribute_name' => $attributeName));
                }
            }
        }

        // $key should be unset whenever item does not have any errors and condition
        // (isset($value['Required']) && $value['Required'] && $savePrepare) is not true. That way only required data
        // or data with errors will be saved to DB.
        if ((!$this->isRequiredAttribute($attributeProperties, $isVariationThemeAttribute) || !$savePrepare) &&
            empty($attributeProperties['Error'])
        ) {
            unset($aMatching[$key]);
        }

        // Unset previous values if code is empty (can happen when user click on "-" attribute button
        $attributeProperties['Values'] = array();
    }

    /**
     * Sets attribute properties when no selection code is submitted.
     *
     * @param array $attributeProperties Properties of an attribute that is being validated
     * @param bool $isVariationThemeAttribute Flag for checking whether it is an attribute from variation theme
     * @param mixed $savePrepare Bool False or code of submitted attribute
     * @param bool $isSelectedAttribute Flag representing whether it is an attribute on which save or delete is invoked
     * @param string $attributeName Name of an attribute needed for error log
     * @param array $aErrors Whole errors array that will be returned to client
     */
    protected function setValidatedNoSelectionAttribute(
        &$attributeProperties,
        $isVariationThemeAttribute,
        $savePrepare,
        $isSelectedAttribute,
        $attributeName,
        &$aErrors
    ) {
        if ($attributeProperties['Values']['0']['Shop']['Key'] !== 'noselection' &&
            $attributeProperties['Values']['0']['Marketplace']['Key'] !== 'noselection'
        ) {
            return;
        }

        unset($attributeProperties['Values']['0']);

        if (empty($attributeProperties['Values']) &&
            $this->isRequiredAttribute($attributeProperties, $isVariationThemeAttribute) &&
            $this->shouldValidateAttribute($savePrepare, $isSelectedAttribute)
        ) {
            if ($savePrepare) {
                $aErrors[] = self::getMessage('_prepare_variations_error_text',
                    array('attribute_name' => $attributeName));
            }
            $attributeProperties['Error'] = true;
        }

        foreach ($attributeProperties['Values'] as $k => &$v) {
            if (empty($v['Marketplace']['Info']) || $v['Marketplace']['Key'] === 'manual') {
                $v['Marketplace']['Info'] = $v['Marketplace']['Value'] .
                    self::getMessage('_prepare_variations_free_text_add');
            }
        }
    }

    protected function isRequiredAttribute($attributeProperties, $isVariationThemeAttribute)
    {
        return isset($attributeProperties['Required']) && $attributeProperties['Required'] || $isVariationThemeAttribute;
    }

    protected function shouldValidateAttribute($savePrepare, $isSelectedAttribute)
    {
        return $savePrepare || $isSelectedAttribute;
    }

    /**
     * Sets attribute values depending on shop key.
     *
     * @param array $attributeProperties
     * @param string $info
     */
    protected function setAttributeValues(&$attributeProperties, $info)
    {
        if ($attributeProperties['Values']['0']['Shop']['Key'] === 'all') {
            $newValue = array();
            $i = 0;
            $matchedMpValue = $attributeProperties['Values']['0']['Marketplace']['Value'];

            foreach ($this->getShopAttributeValues($attributeProperties['Code']) as $keyAttribute => $valueAttribute) {
                $newValue[$i]['Shop']['Key'] = $keyAttribute;
                $newValue[$i]['Shop']['Value'] = $valueAttribute;
                $newValue[$i]['Marketplace']['Key'] = $attributeProperties['Values']['0']['Marketplace']['Key'];
                $newValue[$i]['Marketplace']['Value'] = $attributeProperties['Values']['0']['Marketplace']['Key'];
                // $matchedMpValue can be array if it is multi value, so that`s why this is checked and converted to
                // string if it is. That is done because this information will be displayed in matched table.
                $newValue[$i]['Marketplace']['Info'] = (is_array($matchedMpValue) ? implode(', ', $matchedMpValue)
                        : $matchedMpValue) . $info;
                $i++;
            }

            $attributeProperties['Values'] = $newValue;
        } else {
            foreach ($attributeProperties['Values'] as $k => &$v) {
                if (empty($v['Marketplace']['Info'])) {
                    // $v['Marketplace']['Value'] can be array if it is multi value, so that`s why this is checked
                    // and converted to string if it is. That is done because this information will be displayed in
                    // matched table.
                    $v['Marketplace']['Info'] = (is_array($v['Marketplace']['Value']) ?
                            implode(', ', $v['Marketplace']['Value'])  : $v['Marketplace']['Value']) . $info;
                }

                if ($v['Marketplace']['Key'] === 'manual') {
                    $v['Marketplace']['Key'] = $v['Marketplace']['Value'];

                } else if ($v['Marketplace']['Key'] === 'notmatch') {//to keep not match in matching here we shouldn't do anything

                } else {
                    $v['Marketplace']['Value'] = $v['Marketplace']['Key'];
                }
            }
        }

        $attributeProperties['Values'] = $this->fixAttributeValues($attributeProperties['Values']);
    }

    /**
     * Saves shop variation and chosen category to DB.
     *
     * @param array $shopVariation
     * @param string $category
     */
    private function saveShopVariationAndPrimaryCategory($shopVariation, $category)
    {
        $oPrepareTable = MLDatabase::getPrepareTableInstance();
        $this->oPrepareList->set('shopvariation', json_encode($shopVariation));
        // for first preparation we should add calculated shopvariaton to request field
        // otherwise it try to read it from prepare table, but prepare table is always empty in first preparation
        $this->aRequestFields['shopvariation'] = $shopVariation;
        $this->oPrepareHelper->setRequestFields($this->aRequestFields);
        $this->oPrepareList->set($oPrepareTable->getPrimaryCategoryFieldName(), $category);
    }

    /**
     * @param array $errors
     *
     */
    protected function setAllErrorsAndPreparedStatus($errors) {
        if (!empty($errors)) {
            foreach ($errors as $error) {
                MLMessage::gi()->addError($error);
            }
            $this->setPreparedStatus(false);
        }
    }

    protected function triggerBeforeFinalizePrepareAction()
    {
        $aActions = $this->getRequest($this->sActionPrefix);
        $savePrepare = $aActions['prepareaction'] === '1';
        $this->oPrepareList->set('preparetype', $this->getSelectionNameValue());
        $this->setPreparedStatus(true);

        if ($this->prepareHasErrors($savePrepare)) {
            $this->setPreparedStatusToError();
            return false;
        }

        $aMatching = $this->getRequestField();

        $variationThemeData = $this->getVariationThemeValidationData($aMatching);
        $variationThemeAttributes = $variationThemeData['variationThemeAttributes'];
        $submittedVariationThemeCode = $variationThemeData['submittedVariationThemeCode'];

        $variationThemeExists = isset($aMatching['variationthemealldata']);
        if ($variationThemeExists) {
            // Save variation theme to prepare table and it will be later used for making addItems request(split & skip)
            $this->oPrepareList->set(
                'variation_theme',
                json_encode(array($submittedVariationThemeCode => $variationThemeAttributes),true)
            );
            unset($aMatching['variationthemecode']);
            unset($aMatching['variationthemealldata']);
        }

        $this->saveVariationThemeBlacklist($aMatching);
        $sIdentifier = $this->getIdentifier($aMatching);

        if (empty($sIdentifier)) {
            MLMessage::gi()->addError(MLI18n::gi()->get($this->getMPName() . '_prepareform_category'));
            $this->setPreparedStatus(false);

            return false;
        }

        $sCustomIdentifier = $this->getCustomIdentifier();

        if (isset($aMatching['variationgroups'])) {
            if (!empty($aMatching['variationgroups']['new'])) {
                $aMatching = $aMatching['variationgroups']['new'];
            } else {
                $aMatching = $aMatching['variationgroups'][$sIdentifier];
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
                    $value['Required'] = in_array($value['Required'],array(1, true, '1', 'true'),true);
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
                            continue;
                        }

                        if ($value['Values']['0']['Marketplace']['Key'] === 'reset') {
                            $aMatching[$key]['Values'] = array();
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
            if (!empty($aErrors) || !$savePrepare) {
                // stay on prepare form
                return false;
            }

            $this->saveToAttributesMatchingTable($oVariantMatching, $sIdentifier, $sCustomIdentifier, $aMatching);
            //MLMessage::gi()->addSuccess(self::getMessage('_prepare_match_variations_saved'));
        } else {// if nothing is matched in attribute matching we should save varaiationgroups as primary category of marketplace
            $this->oPrepareList->set(MLDatabase::getPrepareTableInstance()->getPrimaryCategoryFieldName(), $sIdentifier);
        }
        return true;
    }

    /**
     * Saves prepare attributes to AM table if it does not exist.
     *
     * @param ML_Database_Model_Table_VariantMatching_Abstract $oVariantMatching
     * @param string $sIdentifier
     * @param string $sCustomIdentifier
     * @param array $aMatching
     * @throws Exception
     */
    protected function saveToAttributesMatchingTable($oVariantMatching, $sIdentifier, $sCustomIdentifier, $aMatching) {
        $aShopVariation = $oVariantMatching
            ->set('Identifier', $sIdentifier)
            ->set('CustomIdentifier', $sCustomIdentifier)
            ->get('ShopVariation');

        if (!isset($aShopVariation)) {
            $oVariantMatching
                ->set('Identifier', $sIdentifier)
                ->set('CustomIdentifier', $sCustomIdentifier)
                ->set('ShopVariation', json_encode($aMatching))
                ->set('ModificationDate', date('Y-m-d H:i:s'))
                ->save();
        }
    }

    protected function fixAttributeValues($values) {
        if (isset($values['0']) && !empty($values['0']['Marketplace']['Info'])) {
            $fixedValues = array();
            $i = 1;
            foreach ($values as $value) {
                $fixedValues[$i] = $value;
                $i++;
            }

            return $fixedValues;
        }

        return $values;
    }

    protected function setPreparedStatus($verified, $productIDs = array()) {
        $status = $verified ? 'OK' : 'ERROR';

        if (!empty($productIDs)) {
            foreach ($productIDs as $key) {
                $prepareItem = $this->oPrepareList->getByKey('[' . $key . ']');
                if (isset($prepareItem)) {
                    $prepareItem->set('verified', $status);
                }
            }
        } else {
            $this->oPrepareList->set('verified', $status);
        }
    }

    public function triggerBeforeField(&$aField)
    {
        parent::triggerBeforeField($aField);
        $sName = $aField['realname'];
        if ($sName === 'variationgroups.value') {
            return;
        }
        $aRequestTriggerField = MLRequest::gi()->data('ajaxData');
        if (MLHttp::gi()->isAjax() && $aRequestTriggerField !== null) {
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
                for ($i = 1; $i < count($aNames); $i++) {
                    if (is_array($aTmp)) {
                        foreach ($aTmp as $key => $value) {
                            if (strtolower($key) === 'code') {
                                break;
                            } elseif (strtolower($key) == $aNames[$i]) {
                                $sName .= '.' . $key;
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

    public function triggerAfterField(&$aField, $parentCall = false)
    {
        //TODO Check this parent call
        parent::triggerAfterField($aField);

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
                    $aValue = $this->getPreparedShopVariationForList($this->oPrepareList);
                    if (!isset($aValue) || strtolower($sPrimaryCategoriesValue) !== strtolower($aNames[1])) {
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
     * Detects if matched attribute is deleted on shop.
     * @param array $savedAttribute
     * @param string $warningMessageCode message code that should be displayed
     * @return bool
     */
    public function detectIfAttributeIsDeletedOnShop($savedAttribute, &$warningMessageCode) {
        return MLFormHelper::getPrepareAMCommonInstance()->detectIfAttributeIsDeletedOnShop($savedAttribute, $warningMessageCode);
    }

    protected function variationGroupsField(&$aField)
    {
        $aField['subfields']['variationgroups.value']['values'] = array('' => '..') + $this->getPrimaryCategoryFieldValues();

        foreach ($aField['subfields'] as &$aSubField) {
            //adding current cat, if not in top cat
            if (!array_key_exists((string)$aSubField['value'], $aSubField['values'])) {
                $oCat = MLDatabase::factory(self::getMPName().'_categories'.$aSubField['cattype']);
                $oCat->init(true)->set('categoryid', $aSubField['value'] ? $aSubField['value'] : 0);
                $sCat = '';
                foreach ($oCat->getCategoryPath() as $oParentCat) {
                    $sCat = $oParentCat->get('categoryname').' &gt; '.$sCat;
                }
                if (empty($sCat)) {
                    $aSubField['values'][$aSubField['value']] = MLI18n::gi()->{'ml_prepare_form_category_notvalid'};
                } else {
                    $aSubField['values'][$aSubField['value']] = substr($sCat, 0, -6);
                }
            }
        }
    }

    protected function variationMatchingField(&$aField)
    {
        $aField['ajax'] = array(
            'selector' => '#' . $this->getField('variationgroups.value', 'id'),
            'trigger' => 'change',
            'field' => array(
                'type' => 'switch',
            ),
        );
    }

    protected function variationGroups_ValueField(&$aField)
    {
        $aField['type'] = 'categoryselect';
        $aField['cattype'] = 'marketplace';
    }

    protected function getPrimaryCategoryFieldValues()
    {
        return ML::gi()->instance('controller_' . self::getMPName() . '_config_prepare')
            ->getField('primarycategory', 'values');
    }

    protected function callGetCategoryDetails($sCategoryId) {
        return MLFormHelper::getPrepareAMCommonInstance()->getCategoryDetails($sCategoryId);
    }

    /**
     * Serialized data for variation pattern(variation theme) will be submitted through the hidden field.
     * @param $aField
     */
    protected function variationThemeAllDataField(&$aField)
    {
        $aField['type'] = 'ajax';
        $aField['ajax'] = array(
            'selector' => '#' . $this->getField('variationgroups.value', 'id'),
            'trigger' => 'change',
            'field' => array (
                'type' => 'hidden',
                'value' => '',
            ),
        );

        $mParentValue = $this->getField('variationgroups.value', 'value');
        if ($mParentValue != '') {
            $categoryDetails = $this->callGetCategoryDetails($mParentValue);

            if (!empty($categoryDetails['DATA']['variation_details'])) {
                $aField['ajax']['field']['value'] = htmlspecialchars(json_encode($categoryDetails['DATA']['variation_details']));
                $aField['value'] = htmlspecialchars(json_encode($categoryDetails['DATA']['variation_details']));
            }
        }
    }

    /**
     * Serialized data for variation blacklist will be submitted through the hidden field.
     * @param $aField
     */
    protected function variationThemeBlacklistField(&$aField)
    {
        $aField['type'] = 'ajax';
        $aField['ajax'] = array(
            'selector' => '.variationMatchingSelector .input select',
            'trigger' => 'change',
            'field' => array(
                'type' => 'hidden',
                'value' => '',
            )
        );

        $mParentValue = $this->getField('variationgroups.value', 'value');
        if (!empty($mParentValue)) {
            $categoryDetails = $this->callGetCategoryDetails($mParentValue);

            if (!empty($categoryDetails['DATA']['variation_details_blacklist'])) {
                $aField['ajax']['field']['value'] = htmlspecialchars(json_encode($categoryDetails['DATA']['variation_details_blacklist']));
            }
        }
    }

    /**
     * For all marketplaces that have variation pattern(variation theme) select with options from marketplace
     * will be displayed.
     * @param $aField
     */
    protected function variationThemeCodeField(&$aField)
    {
        // Helper for php8 compatibility - can't pass null to htmlspecialchars_decode 
        $sValue = MLHelper::gi('php8compatibility')->checkNull($this->getField('variationthemealldata', 'value'));
        $variationThemes = json_decode(htmlspecialchars_decode($sValue), true);
        $aField['type'] = 'ajax';
        $aField['ajax'] = array(
            'selector' => '#' . $this->getField('variationgroups.value', 'id'),
            'trigger' => 'change',
        );

        $mParentValue = $this->getField('variationgroups.value', 'value');

        if (is_array($variationThemes) && count($variationThemes) > 0 && $mParentValue != '') {

                $variationThemeNames = array();
                foreach ($variationThemes as $variationThemeKey => $variationTheme) {
                    $variationThemeNames[$variationThemeKey] = $variationTheme['name'];
                }

                $aField['values'] = array('null' => $this->__('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT')) + $variationThemeNames;
                $primaryCategory = $this->oPrepareList->get('PrimaryCategory');
                $differentCategory = $mParentValue !== array_pop($primaryCategory);
                $savedVariationThemes = $differentCategory ? array() : $this->oPrepareList->get('variation_theme');

                $savedVariationTheme = array_pop($savedVariationThemes);
                if (empty($savedVariationTheme)) {
                    $savedVariationTheme = array('null' => array());
                }

                $savedVariationThemeCode = key($savedVariationTheme);

                // Value of an ajax field in V3 an array. That array has format :
                // $aField['value'] = array($codeOfDependingField => $variationThemeCode);
                $aField['value'] = array($mParentValue => $savedVariationThemeCode);
                $aField['ajax']['field']['type'] = 'dependonfield';
                $aField['dependonfield']['depend'] = 'variationgroups.value';
                $aField['dependonfield']['field']['type'] = 'select';
            }
    }

    public function getMPVariationAttributes($sVariationValue) {
        if ($this->aMPAttributes !== null) {
            return $this->aMPAttributes;
        }

        $aValues = $this->callGetCategoryDetails($sVariationValue);
        $result = array();
        if ($aValues && !empty($aValues['DATA']['attributes'])) {
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

            $additionalAttributes['additional_attribute_' . $newAdditionalAttributeIndex] = array();

            foreach ($additionalAttributes as $attributeKey => $attributeValue) {
                $result[$attributeKey] = array(
                    'value' => self::getMessage('_prepare_variations_additional_attribute_label'),
                    'custom' => true,
                    'required' => false,
                );
            }
        }

        $this->detectChanges($result, $sVariationValue);

        $this->aMPAttributes = $result;
        return $this->aMPAttributes;
    }

    /**
     * @param $sIdentifier
     * @param $sCustomIdentifier
     * @return mixed
     */
    protected function getPreparedData($sIdentifier, $sCustomIdentifier)
    {
        $sProductId = $this->getProductId();

        $oPrepareTable = MLDatabase::getPrepareTableInstance();
        $sPrimaryCategory = $this->oPrepareList->get($oPrepareTable->getPrimaryCategoryFieldName());

        $sPrimaryCategoryValue = isset($sPrimaryCategory['[' . $sProductId . ']'])
            ? $sPrimaryCategory['[' . $sProductId . ']'] : reset($sPrimaryCategory);

        if (!empty($sPrimaryCategory)) {
            if ($sPrimaryCategoryValue === $sIdentifier) {
                $aValue = $this->getPreparedShopVariationForList($this->oPrepareList);
            }
        }

        if (!isset($aValue)) {
            $aValue = $this->getAttributesFromDB($sIdentifier, $sCustomIdentifier);
        }

        return $aValue;
    }

    /**
     * Gets ShopVariation data fof given prepare list and current product
     *
     * @param ML_Database_Model_list $oPrepareList Where to look for ShopVariation field data
     *
     * @param bool $setDefaultValue If set to true in case when exact match by product id is not found
     * first value from the list will be returned. Set this to false to get only exact product id match
     *
     * @return mixed|null ShopVariation field data or null if nothing is found for current product
     */
    protected function getPreparedShopVariationForList($oPrepareList, $setDefaultValue = true)
    {
        $sProductId = $this->getProductId();
        $aValue = null;

        $aShopVariation = $oPrepareList->get(MLDatabase::getPrepareTableInstance()->getShopVariationFieldName());
        if (!empty($aShopVariation) && isset($aShopVariation['[' . $sProductId . ']'])) {
            $aValue = $aShopVariation['[' . $sProductId . ']'];
        } else if (!empty($aShopVariation) && $setDefaultValue) {
            $aValue = reset($aShopVariation);
        }

        return $aValue;
    }

    protected function getAttributeValues($sIdentifier, $sCustomIdentifier, $sAttributeCode = null, $bFreeText = false)
    {
        $aValue = $this->getPreparedData($sIdentifier, $sCustomIdentifier);
        if ($aValue) {
            if ($sAttributeCode !== null) {
                foreach ($aValue as $sKey => $aMatch) {
                    if ($sKey === $sAttributeCode) {
                        return isset($aMatch['Values']) ? $aMatch['Values'] : ($bFreeText ? '' : array());
                    }
                }
            } else {
                return $aValue;
            }
        }

        if ($bFreeText) {
            return '';
        }

        return array();
    }

    protected function getUseShopValues($sIdentifier, $sCustomIdentifier, $sAttributeCode = null) {
        $aValue = $this->getPreparedData($sIdentifier, $sCustomIdentifier);
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

    protected function getShopAttributes()
    {
        if ($this->shopAttributes == null) {
            $this->shopAttributes = MLFormHelper::getShopInstance()->getGroupedAttributesForMatching();
        }

        return $this->shopAttributes;
    }

    protected function getShopAttributeValues($sAttributeCode) {
        return MLFormHelper::getPrepareAMCommonInstance()->getShopAttributeValues($sAttributeCode);
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
                         || $sType == 'multiSelectAndText')) {
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

        if ($this->variationCache[$hashParams]) {
            return $this->variationCache[$hashParams];
        }

        return array();
    }

    protected function getErrorValue($sIdentifier, $sCustomIdentifier, $sAttributeCode)
    {
        $aValue = $this->oPrepareList->get('shopvariation');
        $sProductId = $this->getProductId();

        if (!empty($aValue['[' . $sProductId . ']'])) {
            foreach ($aValue['[' . $sProductId . ']'] as $sKey => $aMatch) {
                if ($sKey === $sAttributeCode) {
                    return $aMatch['Error'];
                }
            }
        }

        return false;
    }

    protected function callApi($actionName, $aData = array(), $iLifeTime = 60)
    {
        try {
            $aResponse = MagnaConnector::gi()->submitRequestCached(array('ACTION' => $actionName, 'DATA' => $aData), $iLifeTime);
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
    protected function getVariationDb()
    {
        return MLDatabase::getVariantMatchingTableInstance();
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
                // if value is not found in mp values and if attribute can be added as freetext, it is added here as freetext
                if(!$blFoundInMP && isset($aAttributes['DataType']) && strpos(strtolower($aAttributes['DataType']), 'text') !== false ) {
                    $newValue[$i]['Shop']['Key'] = $keyAttribute;
                    $newValue[$i]['Shop']['Value'] = $valueAttribute;
                    $newValue[$i]['Marketplace']['Key'] = $valueAttribute;
                    $newValue[$i]['Marketplace']['Value'] = $valueAttribute;
                    $newValue[$i]['Marketplace']['Info'] = $valueAttribute. self::getMessage('_prepare_variations_free_text_add');
                    $blFound = true;
                    $i++;
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
            unset($aAttributes['Values']['0']);
        }

        $this->checkNewMatchedCombination($aAttributes['Values']);
    }

    protected function checkNewMatchedCombination(&$aAttributes)
    {
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

        $oPrepareTable = MLDatabase::getPrepareTableInstance();

        $sShopVariationField = $oPrepareTable->getShopVariationFieldName();
        $sProductId = $this->getProductId();

        $oPrepareTable->set($oPrepareTable->getProductIdFieldName(), $sProductId);
        $mainCategory = $oPrepareTable->get($oPrepareTable->getPrimaryCategoryFieldName());

        if ($mainCategory !== $sIdentifier) {
            return;
        }

        $productMatching = $oPrepareTable
            ->set($oPrepareTable->getPrimaryCategoryFieldName(), $sIdentifier)
            ->get($sShopVariationField);


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
     * Gets all data for marketplace attribute which is supplied.
     * @param $categoryId
     * @param $mpAttributeCode
     * @param $shopAttributeCode
     * @return array
     */
    public function getMPAttributes($categoryId, $mpAttributeCode, $shopAttributeCode)
    {
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

    protected function getShopAttributeDetails($sAttributeCode)
    {
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
    protected function transformMatching(&$matchedAttribute)
    {
        if (isset($matchedAttribute['Values']) && is_array($matchedAttribute['Values'])) {
            $emptyOptionValue = 'noselection';
            $multiSelectKey = 'multiselect';

            foreach ($matchedAttribute['Values'] as &$matchedAttributeValue) {
                if (is_array($matchedAttributeValue)) {
                    if (is_array($matchedAttributeValue['Shop']['Key'])) {
                        $matchedAttributeValue['Shop']['Value'] =
                            json_decode($matchedAttributeValue['Shop']['Value'], true);

                    } else if (strtolower($matchedAttributeValue['Shop']['Key']) === $multiSelectKey){
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

    protected function getProductId()
    {
        if (isset($this->oProduct)) {
            $aVariations = $this->oProduct->getVariants();
            if (isset($aVariations) && count($aVariations) > 1) {
                return $aVariations[0]->get('id');
            }

            return $sProductId = $this->oProduct->get('id');
        }

        return null;
    }

    protected static function getMessage($sIdentifier, $aReplace = array())
    {
        return MLI18n::gi()->get(MLModule::gi()->getMarketPlaceName() . $sIdentifier, $aReplace);
    }

    protected static function getMPName()
    {
        return MLModule::gi()->getMarketPlaceName();
    }

    public function getManipulateMarketplaceAttributeValues($values) {
        return MLFormHelper::getPrepareAMCommonInstance()->getManipulateMarketplaceAttributeValues($values);
    }

}
