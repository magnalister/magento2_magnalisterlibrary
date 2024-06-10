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

class ML_Ebay_Controller_Ebay_Prepare_Apply_Form extends ML_Form_Controller_Widget_Form_PrepareWithVariationMatchingAbstract {

    protected $numberOfMaxAdditionalAttributes = self::UNLIMITED_ADDITIONAL_ATTRIBUTES;

    public function __construct() {
        parent::__construct();
        if ($this->oSelectList->getCountTotal() == 1 && $this->oProduct->get('parentid') != 0) {
            $this->oProduct = $this->oProduct->getParent();
            $this->oPrepareHelper->setProduct($this->oProduct);
        }
    }

    protected function getSelectionNameValue() {
        return 'apply';
    }

    protected function getProductId() {
        if (isset($this->oProduct)) {
            $aVariations = $this->oProduct->getVariants();
            if (isset($aVariations)) {
                return $aVariations[0]->get('id');
            }

            return $sProductId = $this->oProduct->get('id');
        }

        return null;
    }

    protected function getCategoryIdentifierValue() {
        $aMatching = $this->getRequestField();
        return isset($aMatching['primarycategory']) ? $aMatching['primarycategory'] : '';
    }

    protected function variationThemeBlacklistField(&$aField) {
        $aField['type'] = 'ajax';
        $aField['ajax'] = array(
            'selector' => '.variationMatchingSelector .input select',
            'trigger' => 'change',
            'field' => array(
                'type' => 'hidden',
                'value' => '',
            )
        );

        $mParentValue = $this->getField('PrimaryCategory', 'value');
        if (!empty($mParentValue)) {
            $categoryDetails = $this->callGetCategoryDetails($mParentValue);

            if (!empty($categoryDetails['DATA']['variation_details_blacklist'])) {
                $aField['ajax']['field']['value'] = htmlspecialchars(json_encode($categoryDetails['DATA']['variation_details_blacklist']));
            }
        }
    }

    protected function triggerBeforeFinalizePrepareAction() {
        $oPreparedProduct = current($this->oPrepareList->getList());
        if (is_object($oPreparedProduct)) {

            $variationMatchingIsValid = parent::triggerBeforeFinalizePrepareAction();

            // Do not run eBay validation if AM is not valid
            if (!$variationMatchingIsValid) {
                return false;
            }

            // Remove old attributes
            $this->oPrepareList->set('primarycategoryattributes', '');
            $this->oPrepareList->set('secondarycategoryattributes', '');

            $iParentId = null;
            foreach ($this->oPrepareList->getList() as $oVariant) {
                $sProductsId = $oVariant->get($this->oPrepareHelper->getPrepareTableProductsIdField());
                $oProduct = MLProduct::factory()->set('id', $sProductsId);
                if ($iParentId !== null && ($iParentId != $oProduct->get('parentid') || !MLDatabase::factory('ebay_categories')->set('categoryid', $oVariant->get('PrimaryCategory'))->variationsEnabled())) {
                    break;
                }
                $oProductList = MLProductList::gi('generic')->addVariant($oProduct);
                $iParentId = $oProduct->get('parentid');
            }

            $oService = MLService::getAddItemsInstance()->setValidationMode(true)->setProductList($oProductList);
            /* @var $oService ML_Ebay_Model_Service_AddItems */
            try {
                $oService->execute();
            } catch (Exception $oEx) {
                if ($oEx->getCode() === 1605109425) {
                    $this->oPrepareList->set('verified', 'ERROR');
                    MLMessage::gi()->addError(MLI18n::gi()->get('ebay_prepare_verfiyproduct_error_1605109425', array('sku' => $oProduct->getSku())), null, false);
                    return false;
                }
//            echo $oEx->getMessage();
            }

            $aResponse = $oService->getResponse();
            if ($oService->haveError()) {
                $ErrorCode = '';
                foreach ($aResponse['RESPONSEDATA'][0]['ERRORS'] as $aErr) {
                    if ($aErr['ERRORLEVEL'] == 'Error') {
                        $ErrorCode = $aErr['ERRORCODE'];
                        break;
                    }
                }
                if ($ErrorCode == '21920000') {
                    $this->oPrepareList->set('productRequired', 'true');
                }
                $this->oPrepareList->set('verified', 'ERROR');
            } else {
                $this->oPrepareList->set('verified', 'OK');
            }
            // if we have only 1 Item, and we've got EPID from API, we can store it
            if (count($this->oPrepareList->getList()) === 1 && isset($aResponse['RESPONSEDATA'][0]['DATA']['EPID'])) {
                $this->oPrepareList->set('epid', $aResponse['RESPONSEDATA'][0]['DATA']['EPID'])
                        ->set('productRequired', 'true');
            }
            return !$oService->haveError(); // Redirect if service have no error and variation matching is valid
        } else {
            MLMessage::gi()->addDebug("One of products is not existed , please try again");
            return false;
        }
    }

    public function triggerAfterField(&$aField, $parentCall = false) {
        parent::triggerAfterField($aField);

        if ($parentCall) {
            return;
        }

        $sName = $aField['realname'];

        // when top variation groups drop down is changed, its value is updated in getRequestValue
        // otherwise, it should remain empty.
        // without second condition this function will be executed recursively because of the second line below.,
        if (!isset($aField['value'])) {
            $sProductId = $this->getProductId();

            $oPrepareTable = MLDatabase::getPrepareTableInstance();
            $sShopVariationField = $oPrepareTable->getShopVariationFieldName();

            $aPrimaryCategories = $this->oPrepareList->get($oPrepareTable->getPrimaryCategoryFieldName());
            $sPrimaryCategoriesValue = isset($aPrimaryCategories['[' . $sProductId . ']']) ? $aPrimaryCategories['[' . $sProductId . ']'] : reset($aPrimaryCategories);

            if ($sName === 'variationgroups.value') {
                $aField['value'] = $sPrimaryCategoriesValue;
            } else {
                // check whether we're getting value for standard group or for custom variation matching group
                $sCustomGroupName = $this->getField('variationgroups.value', 'value');
                $aCustomIdentifier = explode(':', $sCustomGroupName);

                if (count($aCustomIdentifier) == 2 && ($sName === 'attributename' || $sName === 'customidentifier')) {
                    $aField['value'] = $aCustomIdentifier[$sName === 'attributename' ? 0 : 1];
                    return;
                }

                $aNames = explode('.', $sName);
                if (count($aNames) == 4 && strtolower($aNames[3]) === 'code') {
                    $aValue = $this->oPrepareList->get($sShopVariationField);
                    $aValueFix = isset($aValue['[' . $sProductId . ']']) ? $aValue['[' . $sProductId . ']'] : reset($aValue);

                    if (empty($aValueFix)) {
                        $aValue = $this->oPrepareList->get('PrimaryCategoryAttributes');
                        $aValueFix = isset($aValue['[' . $sProductId . ']']) ? $aValue['[' . $sProductId . ']'] : reset($aValue);
                        if (!empty($aValueFix)) {
                            $aValueFix = $this->convertOldAttributes($aValueFix, $sPrimaryCategoriesValue);
                        }

                        $secondaryCategory = $this->getRequestField('SecondaryCategory');
                        if (!empty($aValueFix) && !empty($secondaryCategory) && ($secondaryCategory !== 'none') && ($secondaryCategory !== 'new')) {
                            $aSecondaryCategoryValue = $this->oPrepareList->get('SecondaryCategoryAttributes');
                            $aSecondaryCategoryValueFix = isset($aSecondaryCategoryValue['[' . $sProductId . ']']) ? $aSecondaryCategoryValue['[' . $sProductId . ']'] : reset($aSecondaryCategoryValue);
                            if (!empty($aSecondaryCategoryValueFix)) {
                                $aSecondaryCategoryValueFix = $this->convertOldAttributes($aSecondaryCategoryValueFix, $secondaryCategory);

                                if (!empty($aSecondaryCategoryValueFix)) {
                                    $aValueFix = is_array($aValueFix) ? $aValueFix : array();
                                    foreach ($aSecondaryCategoryValueFix as $attributeCode => $attributeSettings) {
                                        if (isset($aValueFix[$attributeCode])) {
                                            continue;
                                        }

                                        $aValueFix[$attributeCode] = $attributeSettings;
                                    }
                                }
                            }
                        }
                    }

                    if (empty($aValueFix) || strtolower($sPrimaryCategoriesValue) !== strtolower($aNames[1])) {
                        // real name is in format "variationgroups.qnvjagzvcm1hda____.rm9ybwf0.code"
                        $sCustomIdentifier = count($aCustomIdentifier) == 2 ? $aCustomIdentifier[1] : '';
                        $aValue = $this->getAttributesFromDB($aNames[1], $sCustomIdentifier);
                        $this->fillMatchingWithSecondaryCategoryGlobal($aValue);

                    } else {
                        $aValue = $aValueFix;
                    }

                    if ($aValue) {
                        $aFieldName = strtolower(pack('H*', $aNames[2]));
                        foreach ($aValue as $sKey => &$aMatch) {
                            $sKeyReplacedDot = str_replace('.', '!dot!', $sKey);
                            if (strtolower($sKey) === $aFieldName || strtolower($sKeyReplacedDot) === $aFieldName) {
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

    protected function variationGroupsField(&$aField) {
        $aField['subfields']['variationgroups.value']['values'] = array('' => '..') + $this->getPrimaryCategoryFieldValues();

        foreach ($aField['subfields'] as &$aSubField) {
            //adding current cat, if not in top cat
            if (!array_key_exists((string) $aSubField['value'], $aSubField['values'])) {
                $oCat = MLDatabase::factory(self::getMPName() . '_categories' . $aSubField['cattype']);
                $oCat->init(true)->set('categoryid', $aSubField['value'] ? $aSubField['value'] : 0);
                $sCat = '';
                foreach ($oCat->getCategoryPathArray() as $oParentCat) {
                    $sCat = $oParentCat->get('categoryname') . ' &gt; ' . $sCat;
                }

                $aSubField['values'][$aSubField['value']] = substr($sCat, 0, -6);
            }
        }
    }

    protected function priceContainerField(&$aField) {
        $aField['type'] = 'ajax';
        $aField['ajax'] = array(
            'selector' => '#' . $this->getField('listingType', 'id'),
            'trigger' => 'change',
            'field' => array(
                'type' => 'ebay_pricecontainer',
            )
        );
    }

    protected function listingDurationField(&$aField) {
        $aField['type'] = 'ajax';
        $sListingType = $this->getField('listingType', 'value');
        $aField['ajax'] = array(
            'selector' => '#' . $this->getField('listingType', 'id'),
            'trigger' => 'change',
            'field' => array(
                'type' => 'select',
                'values' => MLModule::gi()->getListingDurations($sListingType),
            )
        );
        if (empty($aField['value']) || MLHttp::gi()->isAjax()) {//it is not in prepareData helper class because additems is ajax too and there it will be ever default value
            $aField['value'] = MLModule::gi()->getConfig(strtolower($sListingType) == 'chinese' ? 'chinese.duration' : 'fixed.duration');
        }
    }

    protected function startTimeField(&$aField) {
        $aField['type'] = 'optional';
        $aField['optional']['field']['type'] = 'datetimepicker';
    }

    protected function titleField(&$aField) {
        $aField['default'] = $this->oPrepareHelper->replaceTitle(MLModule::gi()->getConfig('template.name'));
        $aField['type'] = 'string';
        $aField['maxlength'] = 80;
    }

    protected function subtitleField(&$aField) {
        $aField['optional']['field']['type'] = 'string';
    }

    public function descriptionContainerField(&$aField) {
        $aField['type'] = 'tabs';
        foreach ($aField['subfields'] as &$aSubField) {
            $sMethodName = 'replace' . $aSubField['realname'];
            if(method_exists($this->oPrepareHelper, $sMethodName.'Main')){
                $sMethodName .= 'Main';
            }
            $aSubField['default'] = $this->oPrepareHelper->{$sMethodName}(MLModule::gi()->getConfig($aSubField['default']));
        }
        unset($aSubField);
        if (MLModule::gi()->getConfig('template.mobile.active') != 'true') {
            unset($aField['subfields']['descriptionmobile']);
            unset($aField['fullwidth']);
//            new dBug($aField);
            $aField['i18n'] = $aField['subfields']['description']['i18n'];
        }
    }

    protected function conditionIdField(&$aField) {
        $aField['type'] = 'ajax';
        $aField['ajax'] = array(
            'selector' => '#' . $this->getField(array('name' => 'PrimaryCategory', 'hint' => array('template' => 'ebay_categories')), 'id'),
            'trigger' => 'change',
            'field' => array(
                'type' => 'select',
                'hint' => array(
                    'template' => 'text'
                )
            )
        );
        $iCategoryId = $this->getField(array('name' => 'PrimaryCategory', 'hint' => array('template' => 'ebay_categories')), 'value');

        if ($iCategoryId != null && $iCategoryId != '0') {
            $iCatId = (int) $iCategoryId;
            $aField['values'] = MLDatabase::factory('ebay_categories')->set('categoryid', $iCatId)->getConditionValues();
            if (empty($aField['values'])) {
                $aField['ajax']['field']['type'] = 'information';
                $aField['value'] = MLI18n::gi()->ml_ebay_no_conditions_applicable_for_cat;
            }
        } else {
            $aField['values'] = MLModule::gi()->getConditionValues();
        }
    }

    protected function conditionDescriptorsField(&$aField) {
        $aField['type'] = 'ajax';
        $aField['ajax'] = array(
            'selector' => '#' . $this->getField('ConditionID', 'id'),
            'trigger' => 'change',
            'field' => array(
                'type' => 'ebay_conditiondescriptors',
                'subfields' => $this->conditionDescriptorSubfields(
                    $this->getField(array('name' => 'PrimaryCategory', 'hint' => array('template' => 'ebay_categories')), 'value'),
                    $this->getField('ConditionID', 'value')
                )
            )
        );
    }

    private function conditionDescriptorSubfields($iCategoryId, $iConditionId) {
        $oPrepareTable = MLDatabase::getPrepareTableInstance();
        $preparedData = $this->oPrepareList->get('ConditionDescriptors');
        if (is_array($preparedData)) {
            $preparedData = current($preparedData);
        } else {
            $preparedData = array();
        }
        $aConditionPolicies = MLDatabase::factory('ebay_categories')->set('categoryid', $iCategoryId)->getConditionPolicies();
        $aSubfields = array();
        if (    !empty($aConditionPolicies)
             && isset($aConditionPolicies[$iConditionId]['conditionDescriptors'])
        ) {
            foreach ($aConditionPolicies[$iConditionId]['conditionDescriptors'] as $iDescriptorId => $aDescriptor) {
                if ($aDescriptor['conditionDescriptorConstraint']['mode'] == 'SELECTION_ONLY') {
                    $aSubfields[] = array(
                        'name'    => 'field[conditionDescriptors]['.$iDescriptorId.']',
                        'label'   => $aDescriptor['conditionDescriptorName'],
                        'type'    => 'select',
                        'values'  => $aDescriptor['conditionDescriptorValues'],
                        'value' => isset($preparedData[$iDescriptorId])
                            ? $preparedData[$iDescriptorId]
                            : '',
                    );
                } else {
                    $aSubfields[] = array(
                        'name'   => 'field[conditionDescriptors]['.$iDescriptorId.']',
                        'label'  => $aDescriptor['conditionDescriptorName'],
                        'type'   => 'string',
                        'value' => isset($preparedData[$iDescriptorId])
                            ? $preparedData[$iDescriptorId]
                            : '',
                    );
                }
            }
            return $aSubfields;
        } else {
            return array();
        }
    }

    protected function conditionDescriptionField(&$aField) {
        $aField['optional']['field']['type'] = 'string';
    }

    protected function startPriceField(&$aField) {
        $aField['type'] = 'ebay_pricecontainer_fixed';
        $aField['autooptional'] = false;
        $aField['checkajax'] = false;
        $aField['ebay_pricecontainer_fixed'] = array(
            'field' => array(
                'type' => 'string'
            )
        );
    }

    protected function strikePriceField(&$aField) {
        $aField['type'] = 'select';
        $aField['autooptional'] = false; // ändert nix wg multi
        $aField['values'] = array('false' => MLI18n::gi()->form_type_optional_select__false, 'true' => MLI18n::gi()->form_type_optional_select__true);
        $aField['default'] = (MLModule::gi()->getConfig('strikeprice.active') == 1) ? 'true' : 'false';
    }

    protected function buyItNowPriceField(&$aField) {
        if ($this->getField('listingType', 'value') == 'Chinese') {
            $oActive = json_decode(MLModule::gi()->getConfig('chinese.buyitnow.price.active'));
            $aField['type'] = 'ebay_pricecontainer_buyitnow';
            $aField['autooptional'] = false;
            $aField['checkajax'] = false;
            $aField['ebay_pricecontainer_buyitnow']['field'] = array(
                'type' => 'optional',
                'optional' => array(
                    'field' => array(
                        'type' => 'string',
                    )
                )
            );
        } else {
            $aField['value'] = null;
        }
    }

    protected function siteField(&$aField) {
        $aField['type'] = 'readonly';
        $aField['value'] = MLModule::gi()->getConfig('site');
    }

    protected function privateListingField(&$aField) {
        $aField['type'] = 'bool';
    }

    protected function bestOfferEnabledField(&$aField) {
        $aField['type'] = 'bool';
    }

    protected function ebayPlusField(&$aField) {
        $aField['type'] = 'bool';
        $aField['autooptional'] = false;
        $aField['disabled'] = true;

        $aSetting = MLModule::gi()->getEBayAccountSettings();
        if (isset($aSetting['eBayPlus']) && $aSetting['eBayPlus'] == "true") {
            $aField['disabled'] = false;
        }
        if (isset($aField['value']) && $aField['value'] === "true") {
            $aField['value'] = true;
        } else {
            $aField['value'] = false;
        }
    }

    protected function pictureUrlField(&$aField) {
        if (MLModule::gi()->getConfig('picturepack')) {
            $aField['type'] = 'imagemultipleselect';
        } else {
            $aField['type'] = 'imageselect';
            $aField['asarray'] = true;
        }
        if (isset($aField['values']) && is_array($aField['values'])) {
            foreach ($aField['values'] as $no => $image) {
                if ($image['height'] > 80) {
                    $aField['values'][$no]['width'] = (int)((80 * $image['width']) / $image['height']);
                    $aField['values'][$no]['height'] = 80;
                }
            }
            unset($no); unset($image);
        }
    }

    protected function galleryTypeField(&$aField) {
        MLHelper::gi('model_table_Ebay_ConfigData')->galleryTypeField($aField);
    }

    protected function VariationDimensionForPicturesField(&$aField) {
        if (
            MLModule::gi()->getConfig('picturepack') && MLShop::gi()->addonBooked('EbayPicturePack') && (
                !$this->oProduct instanceof ML_Shop_Model_Product_Abstract ||
                $this->oProduct->getVariantCount() > 1
                )
        ) {
            $aField['type'] = 'select';
        }
    }

    protected function VariationPicturesField(&$aField) {
        if (
            MLModule::gi()->getConfig('picturepack') && MLShop::gi()->addonBooked('EbayPicturePack') && $this->oProduct instanceof ML_Shop_Model_Product_Abstract && $this->oProduct->getVariantCount() > 1
        ) {
            $sControlValue = $this->getField('VariationDimensionForPictures', 'value');
            $aField['autooptional'] = false;
            if (MLHttp::gi()->isAjax()) {
                if (empty($sControlValue)) {
                    $aField['type'] = 'ebay_variationpictures'; //empty field
                } else {
                    $aField['type'] = 'optional';
                    $aField['checkajax'] = false;
                    $aField['optional'] = array('field' => array('type' => 'ebay_variationpictures'));
                }
            } else {
                $aField['type'] = 'ajax';
                $aField['ajax'] = array(
                    'selector' => '#' . $this->getField('VariationDimensionForPictures', 'id'),
                    'trigger' => 'change',
                );
                if (!empty($sControlValue)) {
                    $aField['ajax']['field'] = array(
                        'type' => 'optional',
                        'optional' => array(
                            'field' => array(
                                'type' => 'ebay_variationpictures',
                                'name' => 'field[VariationPictures]',
                            )
                        )
                    );
                }
            }
        }
    }

    /**
     * @return ML_Ebay_Model_Table_Ebay_Categories
     */
    protected function getCategoryTableModel(){
        return MLDatabase::factory('ebay_categories');
    }
    protected function primaryCategoryField(&$aField) {
        $this->getCategoryTableModel()->set('categoryid', 0)->set('storecategory', 0)->getChildCategories(true);//populate ebay category
        $this->_categoryField($aField);
        $aField['classes'] = array('variationMatchingSelector');
    }

    protected function secondaryCategoryField(&$aField) {
        $this->_categoryField($aField);
        $aField['classes'] = array('variationMatchingSelector');
    }

    protected function storeCategoryField(&$aField) {
        if (!MLModule::gi()->hasStore()) {
            unset($aField);
        }
        try {
            $this->getCategoryTableModel()->set('categoryid', 0)->set('storecategory', 1)->getChildCategories(true);//populate ebay store category
        } catch (\Exception $ex) {
            MLMessage::gi()->addDebug($ex);
        }

        $this->_categoryField($aField, true);
    }

    protected function storeCategory2Field(&$aField) {
        if (!MLModule::gi()->hasStore()) {
            unset($aField);
        }
        $this->_categoryField($aField, true);
    }

    protected function _categoryField(&$aField, $blStore = false) {
        $aField['type'] = 'ebay_categories';
        $aField['ebay_categories'] = array(
            'field' => array(
                'type' => 'select',
                'select2' => true,
            )
        );
        $aAjaxData = $this->getAjaxData();
        if(!isset($aField['realname'])){//if seller doesn't have any ebay store, "realname" for store category is empty
            return;
        }
        if ($aAjaxData !== null || $aField['realname'] === 'primarycategory') {
            /* @var $oCategories ML_Ebay_Helper_Model_Service_CategoryMatching */
            $oCategories = MLHelper::gi('Model_Service_CategoryMatching');
            $aField['ebay_categories']['oCategory'] = $oCategories;
        }
        if ($aAjaxData === null) {
            $aField['ebay_categories']['field']['values'] = MLDatabase::factory('ebay_categories')->getTopTenCategories('top' . $aField['name']);
            $aField['ebay_categories']['field']['values'] = array(0 => '..') + (array)$aField['ebay_categories']['field']['values'];
            if (!in_array($aField['value'], $aField['ebay_categories']['field']['values']) && (int) $aField['value'] != 0) {
                $aField['ebay_categories']['field']['values'][$aField['value']] = MLDatabase::factory('ebay_categories')
                        ->set('storecategory', $blStore)
                        ->set('categoryid', $aField['value'])
                        ->getCategoryPath()
                ;
            }
        }
    }

    protected function variationMatchingField(&$aField) {
        $aField['ajax'] = array(
            'selector' => '.variationMatchingSelector .input select',
            'trigger' => 'change',
            'field' => array(
                'type' => 'switch',
            ),
        );
    }

    public function getRequest($sName = null) {
        $mParent = parent::getRequest($sName);
        if (is_array($mParent) && $sName == $this->sFieldPrefix) {
            if (array_key_exists('variationgroups', $mParent)) {
                foreach ($mParent['variationgroups'] as &$aCategory) {
                    $aPackedAttributes = array();
                    foreach ($aCategory as $sAttributeKey => $aAttributeValue) {
                        $aPackedAttributes[pack('H*', $sAttributeKey)] = $aAttributeValue;
                    }
                    $aCategory = $aPackedAttributes;
                }
            }
        } elseif ($sName === null && array_key_exists($this->sFieldPrefix, $mParent)) {
            $mParent[$this->sFieldPrefix] = $this->getRequest($this->sFieldPrefix);
        }
        return $mParent;
    }

    public function callAjaxGetField() {
        try {
            $aOriginalAjaxData = $this->getAjaxData();
            $aAjaxData = $aOriginalAjaxData;
            $unpackedKey = '';
            $packedKey = '';
            if (isset($aAjaxData['method'])) {
                if (strpos($aAjaxData['method'], 'variationgroups') !== false) {
                    $unpackedKey = explode('.', $aAjaxData['method']);
                    $unpackedKey = $unpackedKey[2];
                    $packedKey = pack('H*', $unpackedKey);
                    $packedKey = str_replace('.', '!dot!', $packedKey);

                    $aAjaxData['method'] = str_replace($unpackedKey, $packedKey, $aAjaxData['method']);
                    if (isset($aAjaxData['field'])) {
                        $aAjaxData['field']['name'] = str_replace($unpackedKey, $packedKey, $aAjaxData['field']['name']);
                        $aAjaxData['field']['id'] = str_replace($unpackedKey, $packedKey, $aAjaxData['field']['id']);
                    }
                }
            }

            if (isset($aAjaxData['method'])) {
                if (isset($aAjaxData['field'])) {
                    $aField = $aAjaxData['field'];
                    $sField = $this->getRequestField($aField['name']);
                } else {
                    $aField = array('name' => $aAjaxData['method']);
                    $sField = null;
                }
                unset($aField['value']); // value will come from do-method (request-isset value)
                if (array_key_exists('subfields', $aField)) {
                    foreach ($aField['subfields'] as &$aSubField) {
                        unset($aSubField['value']); // value will come from do-method (request-isset value)
                    }
                }
                $aField = $this->getField($aField);
                MLMessage::gi()->addDebug('ajax-field: ' . $aField['realname'], $aField);
                if (isset($aField['type'])) {
                    $domId = $aField['id'];
                    if (!empty($packedKey) && !empty($unpackedKey)) {
                        $search =strtolower($packedKey);
                        $pos = strrpos($domId, $search);
                        if($pos !== false){
                            $domId = substr_replace($domId, $unpackedKey, $pos, strlen($search));
                        }
                        $aField['doKeyPacking'] = true;
                    }
                    MLSetting::gi()->add('aAjaxPlugin', array('dom' => array('#' . $domId . '_ajax' => $this->includeTypeBuffered($aField))));
                    return parent::finalizeAjax();
                }
            }
        } catch (Exception $oEx) {
            MLMessage::gi()->addDebug($oEx);
            MLMessage::gi()->addError($oEx->getMessage());
        }
    }

    protected function listingTypeField(&$aField) {
        $aField['values'] = MLModule::gi()->getListingTypeValues();
        $aField['type'] = 'select';
    }

    protected function dispatchTimeMaxField(&$aField) {
        $aField['default'] = $this->oPrepareHelper->getFromConfig($aField['realname']);
        $aField['values'] = MLI18n::gi()->ebay_configform_prepare_dispatchtimemax_values;
        $this->getSellerProfileHelper()->manipulateFieldForSellerProfile($aField, $this->getField('shippingSellerProfile'), 'shipping');
    }

    public function paymentSellerProfileField(&$aField) {
        $this->getSellerProfileHelper()->sellerProfileField($aField, 'payment');
    }

    protected function paymentMethodsField(&$aField) {
        $aField['values'] = MLModule::gi()->getPaymentOptions();
        if (count($aField['values']) > 1) {
            $aField['type'] = 'multipleSelect';
            $this->getSellerProfileHelper()->manipulateFieldForSellerProfile($aField, $this->getField('paymentSellerProfile'), 'Payment');
        } else {
            $aField['value'] = current($aField['values']);
            $aField['type'] = 'information';
            unset($aField['values']);
        }
    }
    
    /**
     * 
     * @return ML_Ebay_Helper_Model_Form_Type_SellerProfiles
     */
    protected function getSellerProfileHelper(){
        return MLHelper::gi('model_form_type_sellerprofiles');
    }
    
    public function shippingSellerProfileField(&$aField) {
        $this->getSellerProfileHelper()->sellerProfileField($aField, 'shipping');
    }

    public function shippingLocalContainerField(&$aField) {
        $this->getSellerProfileHelper()->manipulateFieldForSellerProfile($aField, $this->getField('shippingSellerProfile'), 'Shipping');
    }

    public function shippingInternationalContainerField(&$aField) {
        $this->getSellerProfileHelper()->manipulateFieldForSellerProfile($aField, $this->getField('shippingSellerProfile'), 'Shipping');
    }

    protected function _shippingField(&$aField) {
        $aField['type'] = 'duplicate';
        $aField['duplicate']['field']['type'] = 'ebay_shippingcontainer_shipping';
    }

    protected function shippingLocalField(&$aField) {
        $aField['values'] = MLModule::gi()->getLocalShippingServices();
        $this->_shippingField($aField);
    }

    protected function shippingInternationalField(&$aField) {
        $aField['autooptional'] = false;
        $aField['values'] = array_merge(array('' => MLI18n::gi()->get('sEbayNoInternationalShipping')), MLModule::gi()->getInternationalShippingServices());
        $aField['locations'] = MLModule::gi()->getInternationalShippingLocations();
        $this->_shippingField($aField);
    }

    protected function _shippingDiscountField(&$aField) {
        $aField['type'] = 'bool';
        $this->getSellerProfileHelper()->manipulateFieldForSellerProfile($aField, $this->getField('shippingSellerProfile'), 'Shipping');
    }

    protected function shippingLocalDiscountField(&$aField) {
        $this->_shippingDiscountField($aField);
    }

    protected function shippingInternationalDiscountField(&$aField) {
        $this->_shippingDiscountField($aField);
    }

    protected function _shippingProfileField(&$aField, $iDefault) {
        $aField['type'] = 'optional';
        $aField['optional']['field']['type'] = 'select';
        $aProfiles = array();
        $oI18n = MLI18n::gi();
        $oPrice = MLPrice::factory();
        $sCurrency = MLModule::gi()->getConfig('currency');
        if (isset($aField['i18n'])) {
            foreach (MLModule::gi()->getShippingDiscountProfiles() as $sProfil => $aProfil) {
                $aProfiles[$sProfil] = $oI18n->replace(
                        $aField['i18n']['option'], array(
                    'NAME' => $aProfil['name'],
                    'AMOUNT' => $oPrice->format($aProfil['amount'], $sCurrency)
                        )
                );
            }
        }
        $aField['values'] = $aProfiles;
        $this->getSellerProfileHelper()->manipulateShippingProfileFieldForSellerProfile($aField, $this->getField('shippingSellerProfile'));
    }

    protected function shippingLocalProfileField(&$aField) {
        $this->_shippingProfileField($aField, MLModule::gi()->getConfig('default.shippingprofile.international'));
    }

    protected function shippingInternationalProfileField(&$aField) {
        $this->_shippingProfileField($aField, MLModule::gi()->getConfig('default.shippingprofile.local'));
    }

    protected function callGetCategoryDetails($sCategoryId) {
        $secondaryCategory = $this->getRequestField('SecondaryCategory');
        $requestParams = array(
            'ACTION' => 'GetCategoryDetails',
            'DATA' => array('CategoryID' => $sCategoryId)
        );

        if (!empty($secondaryCategory) && ($secondaryCategory !== 'none') && ($secondaryCategory !== 'new')) {
            $requestParams['DATA']['SecondaryCategoryID'] = $secondaryCategory;
        }

        return MagnaConnector::gi()->submitRequest($requestParams);
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
        $oPrepareTable = MLDatabase::getPrepareTableInstance();
        $sShopVariationField = $oPrepareTable->getShopVariationFieldName();

        $productMatchingList = $this->oPrepareList;
        $productMatching = $productMatchingList->get($sShopVariationField);

        $sProductId = $this->getProductId();
        $productMatching = isset($productMatching['[' . $sProductId . ']']) ? $productMatching['[' . $sProductId . ']'] : null;
        if (empty($productMatching)) {
            $productMatching = $productMatchingList->get('PrimaryCategoryAttributes');
            $productMatching = isset($productMatching['[' . $sProductId . ']']) ? $productMatching['[' . $sProductId . ']'] : reset($productMatching);
            if (!empty($productMatching)) {
                $productMatching = $this->convertOldAttributes($productMatching, $sIdentifier);
            } else {
                $productMatching = null;
            }

            $secondaryCategory = $this->getRequestField('SecondaryCategory');
            if (!empty($productMatching) && !empty($secondaryCategory) && ($secondaryCategory !== 'none') && ($secondaryCategory !== 'new')) {
                $aSecondaryCategoryValue = $productMatchingList->get('SecondaryCategoryAttributes');
                $aSecondaryCategoryValueFix = isset($aSecondaryCategoryValue['[' . $sProductId . ']']) ? $aSecondaryCategoryValue['[' . $sProductId . ']'] : reset($aSecondaryCategoryValue);
                if (!empty($aSecondaryCategoryValueFix)) {
                    $aSecondaryCategoryValueFix = $this->convertOldAttributes($aSecondaryCategoryValueFix, $secondaryCategory);

                    if (!empty($aSecondaryCategoryValueFix)) {
                        $productMatching = is_array($productMatching) ? $productMatching : array();
                        foreach ($aSecondaryCategoryValueFix as $attributeCode => $attributeSettings) {
                            if (isset($productMatching[$attributeCode])) {
                                continue;
                            }

                            $productMatching[$attributeCode] = $attributeSettings;
                        }
                    }
                }
            }
        }

        if ($productMatching === null) {
            return;
        }

        // similar validation exists in ML_Productlist_Model_ProductList_Abstract::isPreparedDifferently
        $globalMatching = MLDatabase::getVariantMatchingTableInstance()->getMatchedVariations($sIdentifier);

        $this->fillMatchingWithSecondaryCategoryGlobal($globalMatching);


        if (is_array($globalMatching)) {
            foreach ($globalMatching as $attributeCode => $attributeSettings) {
                // If attribute is deleted on MP do not detect changes for that attribute at all
                // since whole attribute is missing!
                if (!isset($result[$attributeCode])) {
                    continue;
                }

                // attribute is matched globally but not on product
                if ($productMatching !== null && empty($productMatching[$attributeCode])) {
                    $result[$attributeCode]['modified'] = true;
                    continue;
                }

                $productAttrs = $productMatching[$attributeCode];
                if (!isset($productAttrs['Values'])) {
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

    protected function getPreparedData($sIdentifier, $sCustomIdentifier) {
        $sProductId = $this->getProductId();

        $oPrepareTable = MLDatabase::getPrepareTableInstance();
        $sShopVariationField = $oPrepareTable->getShopVariationFieldName();
        $sPrimaryCategory = $this->oPrepareList->get($oPrepareTable->getPrimaryCategoryFieldName());

        $sPrimaryCategoryValue = isset($sPrimaryCategory['[' . $sProductId . ']']) ? $sPrimaryCategory['[' . $sProductId . ']'] : reset($sPrimaryCategory);
        if (!empty($sPrimaryCategory)) {
            if ($sPrimaryCategoryValue === $sIdentifier) {
                $aShopVariation = $this->oPrepareList->get($sShopVariationField);
                $aValue = isset($aShopVariation['[' . $sProductId . ']']) ? $aShopVariation['[' . $sProductId . ']'] : reset($aShopVariation);

                if (empty($aValue)) {
                    $aValue = $this->oPrepareList->get('PrimaryCategoryAttributes');
                    $aValue = isset($aValue['[' . $sProductId . ']']) ? $aValue['[' . $sProductId . ']'] : reset($aValue);
                    if (!empty($aValue)) {
                        $aValue = $this->convertOldAttributes($aValue, $sPrimaryCategoryValue);
                    }

                    $secondaryCategory = $this->getRequestField('SecondaryCategory');
                    if (!empty($aValue) && !empty($secondaryCategory) && ($secondaryCategory !== 'none') && ($secondaryCategory !== 'new')) {
                        $aSecondaryCategoryValue = $this->oPrepareList->get('SecondaryCategoryAttributes');
                        $aSecondaryCategoryValueFix = isset($aSecondaryCategoryValue['[' . $sProductId . ']']) ? $aSecondaryCategoryValue['[' . $sProductId . ']'] : reset($aSecondaryCategoryValue);
                        if (!empty($aSecondaryCategoryValueFix)) {
                            $aSecondaryCategoryValueFix = $this->convertOldAttributes($aSecondaryCategoryValueFix, $secondaryCategory);

                            if (!empty($aSecondaryCategoryValueFix)) {
                                $aValue = is_array($aValue) ? $aValue : array();
                                foreach ($aSecondaryCategoryValueFix as $attributeCode => $attributeSettings) {
                                    if (isset($aValue[$attributeCode])) {
                                        continue;
                                    }

                                    $aValue[$attributeCode] = $attributeSettings;
                                }
                            }
                        }
                    }
                }
            }
        }

        if (empty($aValue)) {
            $aValue = $this->getAttributesFromDB($sIdentifier, $sCustomIdentifier);
            $this->fillMatchingWithSecondaryCategoryGlobal($aValue);
        }

        return $aValue;
    }

    /**
     * Gets matched values for selected identifier
     *
     * @param string $sIdentifier Matching identifier (usually category name or ID).
     * @return array|bool
     */
    private function getMatchedVariations($sIdentifier) {
        $oVariantMatching = $this->getVariationDb();
        $oSelect = MLDatabase::factorySelectClass();
        $aResult = $oSelect->select("*")->from($oVariantMatching->getTableName())->where(array('identifier' => $sIdentifier))->getResult();
        $aData = isset($aResult[0]) ? $aResult[0] : array();
        return empty($aData) ? array() : json_decode($aData['ShopVariation'], true);
    }

    private function fillMatchingWithSecondaryCategoryGlobal(&$globalMatching) {
        $secondaryCategory = $this->getRequestField('SecondaryCategory');
        if (!empty($secondaryCategory) && ($secondaryCategory !== 'none') && ($secondaryCategory !== 'new')) {
            $secondaryCategoryGlobalMatching = $this->getMatchedVariations($secondaryCategory);
            if (!empty($secondaryCategoryGlobalMatching)) {
                $globalMatching = !empty($globalMatching) ? $globalMatching : array();
                foreach ($secondaryCategoryGlobalMatching as $attributeCode => $attributeSettings) {
                    if (isset($globalMatching[$attributeCode])) {
                        continue;
                    }

                    $globalMatching[$attributeCode] = $attributeSettings;
                }
            }
        }
    }

    public function convertOldAttributes($oldAttributes, $category) {
        $newAttributes = array();
        if (empty($oldAttributes[$category]['specifics'])) {
            return $newAttributes;
        }


        foreach ($oldAttributes[$category]['specifics'] as $key => $oldAttribute) {
            if (is_array($oldAttribute) && !empty($oldAttribute['select']) && ($oldAttribute['select'] == -1)) {
                continue;
            }

            if (is_array($oldAttribute) && !empty($oldAttribute) && empty($oldAttribute['select']) && empty($oldAttribute['text'])) {
                $values = array_map(function ($oldValue) {
                    return html_entity_decode($oldValue, ENT_NOQUOTES, 'UTF-8');
                }, $oldAttribute);

                $newAttributes[$key] = array(
                    "Code" => "attribute_value",
                    "Kind" => "Matching",
                    "Required" => false,
                    'DataType' => 'multiSelectAndText',
                    "AttributeName" => $key,
                    'CategoryId' => $category,
                    "Values" => $values,
                    "Error" => false,
                );
            } else if (is_array($oldAttribute) && !empty($oldAttribute['select'])) {
                $newAttributes[$key] = array(
                    "Code" => ($oldAttribute['select'] == -6) ? "freetext" : "attribute_value",
                    "Kind" => ($oldAttribute['select'] == -6) ? "FreeText" : "Matching",
                    "Required" => false,
                    'DataType' => 'selectAndText',
                    "AttributeName" => $key,
                    'CategoryId' => $category,
                    "Values" => html_entity_decode(($oldAttribute['select'] == -6) ? $oldAttribute['text'] : $oldAttribute['select']),
                    "Error" => false,
                );
            } else if (is_string($oldAttribute) && !empty($oldAttribute)) {
                $newAttributes[$key] = array(
                    "Code" => "freetext",
                    "Kind" => "FreeText",
                    "Required" => false,
                    'DataType' => 'text',
                    "AttributeName" => $key,
                    'CategoryId' => $category,
                    "Values" => html_entity_decode($oldAttribute),
                    "Error" => false,
                );
            }
        }

        return $newAttributes;
    }

    protected function mwstField(&$aField) {
        $aField['autooptional'] = false;
    }

    protected function getAttributesFromDB($sIdentifier, $sCustomIdentifier = '') {
        $aParent = parent::getAttributesFromDB($sIdentifier, $sCustomIdentifier = '');
        if (!is_array($aParent)) {
            return array();
        }
        $aCategoryDetails = $this->callGetCategoryDetails($sIdentifier);
        if (isset($aCategoryDetails['DATA']) && isset($aCategoryDetails['DATA']['attributes'])) {
            $aProductListingDetailsFieldNames = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetConfigItemSpecProductListingDetailsFieldNames',
            ), 60 * 60 * 12);
            if (isset($aProductListingDetailsFieldNames['DATA'])) {
                foreach ($aCategoryDetails['DATA']['attributes'] as $aCategoryDetail) {
                    foreach ($aProductListingDetailsFieldNames['DATA'] as $sProductListingDetailsFieldName => $aProductListingDetailsFieldName) {
                        if (!isset($aParent[$aCategoryDetail['name']]) && in_array($aCategoryDetail['name'], $aProductListingDetailsFieldName)) {
                            $sConfigCode = null;
                            if ($sProductListingDetailsFieldName === 'Brand') {
                                $sConfigCode = 'productfield.brand';
                            } elseif ($sProductListingDetailsFieldName === 'MPN') {
                                $sConfigCode = 'general.manufacturerpartnumber';
                            } elseif ($sProductListingDetailsFieldName === 'EAN') {
                                $sConfigCode = 'general.ean';
                            }
                            if ($sConfigCode !== null) {
                                $aValues = array();
                                foreach ($this->getShopAttributeValues(MLModule::gi()->getConfig($sConfigCode)) as $sId => $sName) {
                                    $aValues[] = array(
                                        'Shop' => array('Key' => $sId, 'Value' => $sName), 
                                        'Marketplace' => array('Key' => 'manual', 'Value' => $sName, 'Info' => $sName.self::getMessage('_prepare_variations_free_text_add'))
                                    );
                                }
                                $aParent[$aCategoryDetail['name']] = array(
                                    'Code' => MLModule::gi()->getConfig($sConfigCode),
                                    'Kind' => 'Matching',
                                    'Required' => true,
                                    'DataType' => 'selectAndText',
                                    'AttributeName' => $aCategoryDetail['name'],
                                    'CategoryId' => $sIdentifier,
                                    'Error' => false,
                                    'Values' => $aValues,
                                );
                                MLMessage::gi()->addDebug('addattr: '.$sProductListingDetailsFieldName, $aParent[$aCategoryDetail['name']]);
                            }
                        }
                    }
                }
            }
        }
        return $aParent;
    }

   public function triggerBeforeField(&$aField) {
        parent::triggerBeforeField($aField);
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
            foreach ($aNames as &$aName) {
                $aName = str_replace('!dot!', '.', $aName);
            }
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
                                $sName .= '.'.str_replace('.', '!dot!', $key);
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

    public function render() {
        if(!MLHttp::gi()->isAjax()) {
            MLSetting::gi()->add('aCss', 'magnalister.ebayprepareform.css?%s', true);
        }
        parent::render();
    }
}
