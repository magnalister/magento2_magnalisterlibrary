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

class ML_Amazon_Controller_Amazon_Prepare_Apply_Form extends ML_Form_Controller_Widget_Form_PrepareWithVariationMatchingAbstract {

    protected $aParameters = array('controller');

    protected function getSelectionNameValue() {
        return 'apply';
    }

    protected function getCustomIdentifier() {
        $category = $this->getRequestField('variationgroups.value');
        if (!isset($category)) {
            $category = $this->getField('variationgroups.value','value');
        }

        $sCustomIdentifier = $this->getRequestField('ProductType');
        if (!isset($sCustomIdentifier)) {
            $sCustomIdentifier = $this->getField('ProductType','value');
        }
        return !empty($sCustomIdentifier[$category]) ? $sCustomIdentifier[$category] : '';
    }

    protected function triggerBeforeFinalizePrepareAction() {
        $blReturn = parent::triggerBeforeFinalizePrepareAction();
        $aActions = $this->getRequest($this->sActionPrefix);
        $savePrepare = $aActions['prepareaction'] === '1';

        $sMessage = '';
        //$sMessageForEAN= '';
        $oddEven = true;
        $i = 0;
        foreach ($this->oPrepareList->getList() as $oPrepared) {
            $this->oProduct = MLProduct::factory()->set('id', $oPrepared->get('productsid'));
            $aProductPrepareData = MLModule::getPrepareDataHelper()->setProduct($this->oProduct)->getPrepareData(
                array(
                    'mainCategory' => array('optional' => array('active' => true)),
                    'topBrowseNode1' => array('optional' => array('active' => true)),
                    'itemTitle' => array('optional' => array('active' => true)),
                    'manufacturer' => array('optional' => array('active' => true)),
                ), 'value');
            $aMissingValues = array();
            foreach(array(
                        MLI18n::gi()->get('ML_LABEL_MAINCATEGORY') => 'mainCategory',
                        MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_BROWSENODES') => 'topBrowseNode1',
                        MLI18n::gi()->get('ML_LABEL_PRODUCT_NAME') => 'itemTitle',
                        MLI18n::gi()->get('ML_GENERIC_MANUFACTURER_NAME')       => 'manufacturer',
                    ) as $sMissingText => $sFieldName) {
                $mValue = $aProductPrepareData[$sFieldName];
                if (empty($mValue)) {
                    $blReturn = false;
                    $aMissingValues[] = $sMissingText;
                }
            }
                    
            if (!empty($aMissingValues)) {
                $this->setPreparedStatus(false);
            }
            
           /* if($this->oProduct->isEanDuplicated()){                
                 $sMessageForEAN .= '
                    Place-Holder
                ';                              
            }*/

            if (!empty($aMissingValues) && $i <= 20) {
                $sMessage .= '
                    <tr class="'.(($oddEven = !$oddEven) ? 'odd' : 'even') . '">
                        <td>' . $this->oProduct->get('id') . '</td>
                        <td>' . $this->oProduct->getMarketPlaceSku() . '</td>
                        <td>' . $this->oProduct->getName() . '</td>
                        <td>' . implode(', ', $aMissingValues) . '</td>
                        <td  class="ml-product-edit"><div class="product-link"><a class="gfxbutton edit ml-js-noBlockUi" title="bearbeiten" target="_blank" href="' . $this->oProduct->getEditLink() . '">&nbsp;</a></div></td>
                    </tr>
                ';
            } elseif(!empty($aMissingValues) && $i == 21) {
                $sMessage .= '
                    <tr class="' . (($oddEven = !$oddEven) ? 'odd' : 'even') . '">
                        <td colspan="5" class="textcenter bold">&hellip;</td>
                    </tr>
                ';
            }

            ++$i;
        }
       /* if (!empty($sMessageForEAN)) {

            MLMessage::gi()->addNotice('Place Holder' );
        }*/
        
        if ($savePrepare && !empty($sMessage)) {
            $sMessage = '
                <table class="datagrid">
                    <thead>
                        <tr>
                            <th>' . $this->__('ML_LABEL_PRODUCTS_ID') . '</th>
                            <th>' . $this->__('ML_LABEL_ARTICLE_NUMBER') . '</th>
                            <th>' . $this->__('ML_LABEL_PRODUCT_NAME') . '</th>
                            <th>' . $this->__('ML_AMAZON_LABEL_MISSING_FIELDS') . '</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        ' . $sMessage . '
                    </tbody>
                </table>
            ';
            MLMessage::gi()->addNotice($this->__('ML_AMAZON_TEXT_APPLY_DATA_INCOMPLETE') . $sMessage);
        }

        if ($savePrepare) {
            $this->oPrepareList->set('applydata', '');
        }

        return $blReturn;
    }

    protected function setPreparedStatus($verified, $productIDs = array()) {
        $this->oPrepareList->set('iscomplete', $verified ? 'true' : 'false');
    }

    protected function variationGroups_valueField(&$aField) {
        $aField['type'] = 'select';
        $aTopTen = $this->getTopTenCategories('topMainCategory', $aField['name']);
        if (count($aTopTen) > 0) {
            $aCategories = array($this->__('ML_TOPTEN_TEXT') => $aTopTen) + MLModule::gi()->getMainCategories();
        } else {
            $aCategories = MLModule::gi()->getMainCategories();
        }

        $aField['values'] = array('' => $this->__('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT')) + $aCategories;
    }

    protected function prepareTypeField(&$aField) {
        $aField['value'] = 'apply';
        $aField['type'] = 'hidden';
    }

    protected function productTypeField(&$aField) {
        $aField['type']='ajax';
        $mParentValue=$this->getField('variationgroups.value','value');
        $aField['ajax']=array(
            'selector' => '#' . $this->getField('variationgroups.value', 'id'),
            'trigger' => 'change',
        );
        $aField['ajax']['field']['autoTriggerOnLoad'] = 'change';

        if ($mParentValue != '') {
            $aTypesAndAttributes = MLModule::gi()->getProductTypesAndAttributes($mParentValue);
            if (isset($aTypesAndAttributes['ProductTypes']) && !empty($aTypesAndAttributes['ProductTypes'])) {
                $aTopTen = $this->getTopTenCategories('topProductType', array($mParentValue));
                if (count($aTopTen) > 0) {
                    $aCategories = array_merge(
                        array($this->__('ML_TOPTEN_TEXT') => $aTopTen), $aTypesAndAttributes['ProductTypes']
                    );
                } else {
                    $aCategories = $aTypesAndAttributes['ProductTypes'];
                }

                $aField['values'] = $aCategories;

                $aField['ajax']['field']['type'] = 'dependonfield';
                $aField['dependonfield']['field']['type'] = 'select';
            }
        }
    }

    protected function variationMatchingField(&$aField) {
        $aField['ajax'] = array(
            'selector' => '#' . $this->getField('ProductType', 'id'),
            'trigger' => 'change',
            'field' => array(
                'type' => 'switch',
            ),
        );
    }

    protected function variationThemeAllDataField(&$aField) {
        $aField['type'] = 'ajax';
        $aField['ajax'] = array(
            'selector' => '#' . $this->getField('ProductType', 'id'),
            'trigger' => 'change',
            'field' => array (
                'type' => 'hidden',
                'value' => '',
            ),
        );

        $categoryId = $this->getField('variationgroups.value', 'value');
        if ($categoryId != '') {
            $categoryDetails = $this->callGetCategoryDetails($categoryId);

            if (!empty($categoryDetails['DATA']['variation_details'])) {
                $aField['ajax']['field']['value'] = htmlspecialchars(json_encode($categoryDetails['DATA']['variation_details']));
                $aField['value'] = htmlspecialchars(json_encode($categoryDetails['DATA']['variation_details']));
            }
        }
    }

    protected function variationThemeCodeField(&$aField) {
        // Helper for php8 compatibility - overriding deprecated function htmlspecialchars_decode 
        $sField = MLHelper::gi('php8compatibility')->htmlspecialcharsDecode($this->getField('variationthemealldata', 'value'));
        $variationThemes = json_decode($sField, true);
        $aField['type'] = 'ajax';
        $aField['ajax'] = array(
            'selector' => '#' . $this->getField('ProductType', 'id'),
            'trigger' => 'change',
        );

        $mParentValue = $this->getField('variationgroups.value', 'value');

        if (is_array($variationThemes) && count($variationThemes) > 0 && $mParentValue != '') {

            $variationThemeNames = array();
            foreach ($variationThemes as $variationThemeKey => $variationTheme) {
                $variationThemeNames[$variationThemeKey] = $variationTheme['name'];

                if (!empty($variationTheme['attributes'])) {
                    $variationThemeNames[$variationThemeKey] .= ' ('.implode(' + ', $variationTheme['attributes']).')';
                }
            }

            $aField['values'] = array('null' => $this->__('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT')) + $variationThemeNames;
            $primaryCategory = $this->oPrepareList->get(MLDatabase::getPrepareTableInstance()->getPrimaryCategoryFieldName());
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

    protected function browseNodesField(&$aField){
        $aField['type']='ajax';
        $aField['ajax']=array(
            'selector' => '#' . $this->getField('variationgroups.value', 'id'),
            'trigger' => 'change',
        );

        $mParentValue=$this->getField('variationgroups.value','value');
        if($mParentValue!=''){
            $aBrowseNodes = MLModule::gi()->getBrowseNodes($mParentValue);
            if(!empty($aBrowseNodes)){
                $aTopTen = $this->getTopTenCategories('topBrowseNode', array($mParentValue));
                if (count($aTopTen) > 0) {
                    $aBrowseNodes = array($this->__('ML_TOPTEN_TEXT') => $aTopTen) + $aBrowseNodes;
                }

                $aField['values'] = array('' => $this->__('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT')) + $aBrowseNodes;
                $aField['ajax']['field']['type'] = 'dependonfield';
                $aField['dependonfield']['field']['type'] = 'amazon_browsenodes';
            }
        }
    }

    protected function ItemTitleField(&$aField){
        $aField['type']='string';
        $aField['singleproduct'] = true;
    }

    protected function ManufacturerField(&$aField){
        $aField['type']='string';
        $aField['singleproduct'] = true;
    }

    protected function BrandField(&$aField){
        $aField['type']='string';
        $aField['singleproduct'] = true;
    }

    protected function ManufacturerPartNumberField(&$aField){
        $aField['type']='string';
        $aField['singleproduct'] = true;
    }

    protected function EanField(&$aField){
        $aField['type']='string';
        $aField['singleproduct'] = true;
        $sType = $this->getInternationalIdentifier();
        $aField['i18n']['label'] = $sType;
        $aField['i18n']['hint'] = MLI18n::gi()->replace($aField['i18n']['hint'], array('Type' => $sType));
        $aField['i18n']['optional']['checkbox']['labelNegativ'] = MLI18n::gi()->replace($aField['i18n']['optional']['checkbox']['labelNegativ'], array('Type' => $sType));
    }

    protected function ImagesField(&$aField){
        $aField['type']='imagemultipleselect';
    }

    protected function DescriptionField(&$aField) {
        $aField['type']='text';
    }

    protected function b2bselltoField(&$aField) {
        $aField['values'] = $aField['i18n']['values'];
    }

    protected function shippingTimeField(&$aField) {
        $aValues = array(
            '-' => MLI18n::gi()->get('ML_AMAZON_SHIPPING_TIME_DEFAULT_VALUE'),
            '0' => MLI18n::gi()->get('ML_AMAZON_SHIPPING_TIME_SAMEDAY_VALUE')
        );

        for ($i = 1; $i < 31; $i++) {
            $aValues[$i.''] = $i;
        }

        return array(
            'type' => 'select',
            'values' => $aValues,
        );
    }

    protected function callGetCategoryDetails($sCategoryId) {
        if ($sCategoryId == 'none') {
            return array();
        }
        try {
            $requestParams = array(
                'ACTION'   => 'GetCategoryDetails',
                'CATEGORY' => $sCategoryId
            );

            $productType = $this->getCustomIdentifier();
            if (!empty($productType)) {
                $requestParams['PRODUCTTYPE'] = $productType;
            }

            return MagnaConnector::gi()->submitRequest($requestParams);
        } catch (MagnaException $oEx) {
            MLMessage::gi()->addDebug($oEx);
            return array();
        }
    }

    public function getMPVariationAttributes($sVariationValue) {
        $aValues = $this->callGetCategoryDetails($sVariationValue);
        $result = array();
        if ($aValues && is_array($aValues['DATA']['attributes'])) {
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
        
        $aResultFromDB = $this->getAttributesFromDB($sVariationValue, $this->getCustomIdentifier());
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
            $result[$attributeKey] = array(
                'value' => self::getMessage('_prepare_variations_additional_attribute_label'),
                'custom' => true,
                'required' => false,
            );
        }
                
        $this->detectChanges($result, $sVariationValue);
    
        return $result;
    }

    protected function getMPAttributeValues($sCategoryId, $sMpAttributeCode, $sAttributeCode = false) {
        $response = $this->callGetCategoryDetails($sCategoryId);
        $aValues = array();
        $fromMP = false;
        if ($response && is_array($response['DATA']['attributes'])) {
            foreach ($response['DATA']['attributes'] as $key => $attribute) {
                if ($key === $sMpAttributeCode && !empty($attribute['values'])) {
                    $aValues = $attribute['values'];
                    $fromMP = true;
                    break;
                }
            }
        }

        if (empty($aValues) && $sAttributeCode) {
            $shopValues = $this->getShopAttributeValues($sAttributeCode);
            foreach ($shopValues as $value) {
                $aValues[$value] = $value;
            }
        }

        return array(
            'values' => $aValues,
            'from_mp' => $fromMP
        );
    }

    public function triggerAfterField(&$aField, $parentCall = false) {
        //TODO Check this parent call
        parent::triggerAfterField($aField, true);
        $sName = $aField['realname'];
          
        // when top variation groups drop down is changed, its value is updated in getRequestValue
        // otherwise, it should remain empty.
        // without second condition this function will be executed recursevly because of the second line below.
        if (!isset($aField['value'])) {
            $sProductId = $this->getProductId();

            $oPrepareTable = MLDatabase::getPrepareTableInstance();
            $sShopVariationField = $oPrepareTable->getShopVariationFieldName();

            $aPrimaryCategories = $this->oPrepareList->get($oPrepareTable->getPrimaryCategoryFieldName());
            $sPrimaryCategoriesValue = isset($aPrimaryCategories['[' . $sProductId . ']']) ? $aPrimaryCategories['[' . $sProductId . ']'] : reset($aPrimaryCategories);
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
                    $aValue = $this->oPrepareList->get($sShopVariationField);
                    $aValueFix = isset($aValue['[' . $sProductId . ']']) ? $aValue['[' . $sProductId . ']'] : reset($aValue);

                    // the ApplyData column is deprecated and we do not use it anymore
//                    if (empty($aValueFix)) {
//                        $aValue = $this->oPrepareList->get('ApplyData');
//                        $aValueFix = isset($aValue['[' . $sProductId . ']']) ? $aValue['[' . $sProductId . ']'] : reset($aValue);
//                        if (!empty($aValueFix['Attributes'])) {
//                            $aValueFix = $this->fixOldAttributes($aValueFix['Attributes'], $sPrimaryCategoriesValue);
//                        }
//                    }

                    // real name is in format "variationgroups.qnvjagzvcm1hda____.rm9ybwf0.code"
                    $sCustomIdentifier = count($aCustomIdentifier) == 2 ? $aCustomIdentifier[1] : '';
                    if (empty($sCustomIdentifier)) {
                        $sCustomIdentifier = $this->getCustomIdentifier();
                    }

                    $aProductType = $this->oPrepareList->get('ProductType');
                    $aProductTypeFirst = reset($aProductType);
                    $sProductType = !empty($aProductType['[' . $sProductId . ']'][$sPrimaryCategoriesValue]) ? $aProductType['[' . $sProductId . ']'][$sPrimaryCategoriesValue] : (!empty($aProductTypeFirst[$sPrimaryCategoriesValue])? $aProductTypeFirst[$sPrimaryCategoriesValue]:null);
                    if (!isset($aValueFix) || (strtolower($sPrimaryCategoriesValue) !== strtolower($aNames[1])) || ($sProductType !== $sCustomIdentifier)) {
                        // cache db values
                        $hashParams = md5($aNames[1].$sCustomIdentifier.'ShopVariation');
                        if (!array_key_exists($hashParams, $this->variationCache)) {
                            $this->variationCache[$hashParams] = $this->getVariationDb()
                                ->set('Identifier', $aNames[1])
                                ->set('CustomIdentifier', $sCustomIdentifier)
                                ->get('ShopVariation');
                        }
                        $aValue = $this->variationCache[$hashParams];
                    } else {
                        $aValue = $aValueFix;
                    }

                    if ($aValue) {
                        foreach ($aValue as $sKey => $aMatch) {
                            if (strtolower($sKey) === $aNames[2]) {
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
     * @param $sIdentifier - Amazon Main Category
     * @param $sCustomIdentifier - Product Type
     * @param null $sAttributeCode - Attribute
     * @param bool $bFreeText - If is a free text field
     *
     * @return array|mixed|string
     */
    protected function getAttributeValues($sIdentifier, $sCustomIdentifier, $sAttributeCode = null, $bFreeText = false) {
        $sProductId = $this->getProductId();

        $oPrepareTable = MLDatabase::getPrepareTableInstance();
        $sShopVariationField = $oPrepareTable->getShopVariationFieldName();
        $sPrimaryCategory = $this->oPrepareList->get($oPrepareTable->getPrimaryCategoryFieldName());
        $aProductType = $this->oPrepareList->get('ProductType');
        $aProductTypeFirst = reset($aProductType);
        $sPrimaryCategoryValue = isset($sPrimaryCategory['[' . $sProductId . ']']) ? $sPrimaryCategory['[' . $sProductId . ']'] : reset($sPrimaryCategory);
        $sProductType = !empty($aProductType['[' . $sProductId . ']'][$sPrimaryCategoryValue]) ? $aProductType['[' . $sProductId . ']'][$sPrimaryCategoryValue] : (!empty($aProductTypeFirst[$sPrimaryCategoryValue]) ? $aProductTypeFirst[$sPrimaryCategoryValue] : null);
        if (!empty($sPrimaryCategory)) {
            if ($sPrimaryCategoryValue === $sIdentifier && $sProductType == $sCustomIdentifier) {
                $aShopVariation = $this->oPrepareList->get($sShopVariationField);
                $aValue = isset($aShopVariation['[' . $sProductId . ']']) ? $aShopVariation['[' . $sProductId . ']'] : reset($aShopVariation);
                // the ApplyData column is deprecated we do not use it anymore
//                if (empty($aValue)) {
//                    $aShopVariation = $this->oPrepareList->get('ApplyData');
//                    $aValue = isset($aShopVariation['[' . $sProductId . ']']) ? $aShopVariation['[' . $sProductId . ']'] : reset($aShopVariation);
//                    if (!empty($aValue['Attributes'])) {
//                        $aValue = $this->fixOldAttributes($aValue['Attributes'], $sIdentifier);
//                    }
//                }
            }
        }

        if (!isset($aValue)) {
            // cache db values
            $hashParams = md5($sIdentifier.$sCustomIdentifier.'ShopVariation');
            if (!array_key_exists($hashParams, $this->variationCache)) {
                $this->variationCache[$hashParams] = $this->getVariationDb()
                    ->set('Identifier', $sIdentifier)
                    ->set('CustomIdentifier', $sCustomIdentifier)
                    ->get('ShopVariation');
            }
            $aValue = $this->variationCache[$hashParams];
        }

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

    /**
     * Covering situation if client prepared item before new variation matching concept
     *
     * @param $attributes
     * @param $sCategoryId
     * @return array
     */
    private function fixOldAttributes($attributes, $sCategoryId) {
        $response = $this->callGetCategoryDetails($sCategoryId);
        $mpAttributes = empty($response)? array() : $response['DATA']['attributes'];

        $attributesFixed = array();
        foreach ($attributes as $attributeKey => $attributeValue) {
            $attributesFixed[$attributeKey] = array(
                'Kind' => 'Matching',
                'Values' => $attributeValue,
                'Required' => isset($mpAttributes[$attributeKey]['mandatory']) ? (bool)$mpAttributes[$attributeKey]['mandatory'] : false,
                'Code' => !empty($mpAttributes[$attributeKey]['values']) ? 'attribute_value' : 'freetext',
                'Error' => false
            );
        }

        return $attributesFixed;
    }
    
    /**
     * @param $sField
     * @param array $aConfig
     * @return array
     */
    private function getTopTenCategories($sField, $aConfig=array()) {
        $mpID = MLModule::gi()->getMarketPlaceId();
        $sParent = isset($aConfig[0]) ? $aConfig[0] : '';
        switch ($sField) {
            case 'topMainCategory':{
                $sWhere = "1 = 1";
                $sUnion = null;
                break;
            }
            case 'topProductType':{
                $sWhere = "topMainCategory = '".$sParent."'";
                $sUnion = null;
                break;
            }
            case 'topBrowseNode':{
                $sField = 'topBrowseNode1';
                $sWhere = "topMainCategory = '".$sParent."'";
                $sUnion = 'topBrowseNode2';
                break;
            }
        }

        if ($sUnion === null) {
            $sSql = "
                SELECT ".$sField." 
                  FROM magnalister_amazon_prepare
                 WHERE     ".$sWhere."
                       AND mpID = '".$mpID."'
                       AND ".$sField." <> '0'
              GROUP BY ".$sField." 
              ORDER BY COUNT(*) DESC
            ";
        } else {
            // if performance problems in this query, get all data and prepare with php
            $sSql="
				SELECT m.".$sField." FROM
				(
					(
						SELECT f.".$sField."
						FROM magnalister_amazon_prepare f 
						WHERE ".$sWhere." AND mpID = '".$mpID."' AND ".$sField." <> '0' 
					)
					UNION ALL
					(
						SELECT u.".$sUnion."
						FROM magnalister_amazon_prepare u 
						WHERE ".$sWhere." AND mpID = '".$mpID."' AND ".$sUnion." <> '0'
					)
				) m
				GROUP BY m.".$sField."
				ORDER BY COUNT(m.".$sField.") DESC
			";
        }

        $aTopTen = MLDatabase::getDbInstance()->fetchArray($sSql, true);
        $aOut = array();
        try {
            switch ($sField) {
                case 'topMainCategory':{
                    $aCategories = MLModule::gi()->getMainCategories();
                    break;
                }
                case 'topProductType':{
                    $aCategories = MLModule::gi()->getProductTypesAndAttributes($sParent);
                    $aCategories = $aCategories['ProductTypes'];
                    break;
                }
                case 'topBrowseNode1':{
                    $aCategories = MLModule::gi()->getBrowseNodes($sParent);
                    break;
                }
            }

            foreach($aTopTen as $sCurrent){
                if(array_key_exists($sCurrent, $aCategories)) {
                    $aOut[$sCurrent] = $aCategories[$sCurrent];
                }else{
                    MLDatabase::getDbInstance()->query("UPDATE magnalister_amazon_prepare set ".$sField." = 0 where ".$sField." = '".$sCurrent."'");//no mpid
                    if($sUnion !== null){
                        MLDatabase::getDbInstance()->query("UPDATE magnalister_amazon_prepare set ".$sUnion." = 0 where ".$sUnion." = '".$sCurrent."'");//no mpid
                    }
                }
            }
        } catch (MagnaException $e) {
            echo print_m($e->getErrorArray(), 'Error: '.$e->getMessage(), true);
        }

        asort($aOut);
        return $aOut;
    }

    private function getInternationalIdentifier() {
        $sSite = MLModule::gi()->getConfig('site');
        if ($sSite === 'US') {
            return 'UPC';
        }

        return 'EAN';
    }
    
    protected function shippingTemplateField(&$aField) {
        $aDefaultTemplate = MLModule::gi()->getConfig('shipping.template');
        $aTemplateName = MLModule::gi()->getConfig('shipping.template.name');
        $aField['type']='select';
        $aField['autooptional'] = false;
        foreach ($aDefaultTemplate as $iKey => $sValue) {
             $aField['values'][]= $aTemplateName[$iKey];
        }
    }

    /**
     * "BopisStores" Field of Prepare Form
     *
     * @param $aField
     * @return void
     */
    protected function bopisStoresField(&$aField) {
        $shopData = MLShop::gi()->getShopInfo();
        if ($shopData['DATA']['IsBopisPilot'] === 'yes') {
            $aField['type'] = 'multipleselect';
            $aField['values'] = MLModule::gi()->GetBopisStores();
        }
    }
}
