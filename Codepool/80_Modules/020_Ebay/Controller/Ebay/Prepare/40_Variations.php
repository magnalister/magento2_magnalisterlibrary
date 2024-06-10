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
MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_VariationsAbstract');

class ML_Ebay_Controller_Ebay_Prepare_Variations extends ML_Form_Controller_Widget_Form_VariationsAbstract
{
    protected $numberOfMaxAdditionalAttributes = self::UNLIMITED_ADDITIONAL_ATTRIBUTES;

    public function getRequest($sName = null)
    {
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
        try{
            $aOriginalAjaxData =  $this->getAjaxData();
            $aAjaxData = $aOriginalAjaxData;
            $unpackedKey = '';
            $packedKey = '';
            if(isset($aAjaxData['method'])) {
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

            if(isset($aAjaxData['method'])) {
                if(isset($aAjaxData['field'])) {
                    $aField=$aAjaxData['field'];
                    $sField=$this->getRequestField($aField['name']);
                } else {
                    $aField=array('name'=>$aAjaxData['method']);
                    $sField=null;
                }
                unset($aField['value']);// value will come from do-method (request-isset value)
                if (array_key_exists('subfields', $aField)) {
                    foreach ($aField['subfields'] as &$aSubField) {
                        unset($aSubField['value']);// value will come from do-method (request-isset value)
                    }
                }
                $aField=$this->getField($aField);
                MLMessage::gi()->addDebug('ajax-field: '.$aField['realname'], $aField);
                if (isset($aField['type'])) {
                    $domId = $aField['id'];
                    if (!empty($packedKey) && !empty($unpackedKey)) {
                        $sPackedKeyDot2Underscore = str_replace('.', '_', $packedKey);
                        $domId = str_replace(strtolower($sPackedKeyDot2Underscore), $unpackedKey, $domId);
                        $aField['doKeyPacking'] = true;
                    }
                    MLSetting::gi()->add('aAjaxPlugin', array('dom' => array( '#'.$domId.'_ajax'=> $this->includeTypeBuffered($aField))));
                    return parent::finalizeAjax();
                }
            }
        }catch(Exception $oEx){
            MLMessage::gi()->addError($oEx->getMessage());
        }
    }

    protected function variationGroupsField(&$aField)
    {
        $sMarketplaceName = MLModule::gi()->getMarketPlaceName();
        $aField['subfields']['variationgroups.value']['select2'] = true;
        $aField['subfields']['variationgroups.value']['values'] = array('' => '..') +
            ML::gi()->instance('controller_' . $sMarketplaceName . '_config_prepare')->getField('primarycategory', 'values');

        foreach ($aField['subfields'] as &$aSubField) {
            // adding current cat, if not in top cat
            if (isset($aSubField['value']) && !array_key_exists($aSubField['value'], $aSubField['values'])) {
                $oCat = MLDatabase::factory($sMarketplaceName . '_categories' . $aSubField['cattype']);
                $oCat->init(true)->set('categoryid', $aSubField['value'] ? $aSubField['value'] : 0);
                $sCat = '';
                foreach ($oCat->getCategoryPathArray() as $oParentCat) {
                    $sCat = $oParentCat->get('categoryname') . ' &gt; ' . $sCat;
                }

                $aSubField['values'][$aSubField['value']] = substr($sCat, 0, -6);
            }
        }
    }
    
    protected function getAttributesFromDB($sIdentifier, $sCustomIdentifier = '') {
        $aParent = parent::getAttributesFromDB($sIdentifier, $sCustomIdentifier = '');
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
                            }
                        }
                    }
                }
            }
        }
        return $aParent;
    }
    
    protected function prepareFieldByFormHelper(&$aField) {
        if (isset($aField['realname'])) {
            $sMethod = str_replace('.', '_', $aField['realname'] . 'field');

            #echo print_m($sMethod, __FUNCTION__.__LINE__)."\n";

            $sMethod = str_replace('!dot!', '.', $sMethod);
            #echo print_m($sMethod, __FUNCTION__.__LINE__)."\n";

            if (method_exists($this->oConfigHelper, $sMethod)) {
                $this->oConfigHelper->{$sMethod}($aField);
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
            foreach ($aNames as &$aName) {
                $aName = str_replace('!dot!', '.', $aName);
            }
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

    public function getValue(&$aField) {
        $sName = $aField['realname'];

        // when top variation groups drop down is changed, its value is updated in getRequestValue
        // otherwise, it should remain empty.
        // without second condition this function will be executed recursively because of the second line below.
        if (!isset($aField['value']) && $sName !== 'variationgroups.value') {
            // check whether we're getting value for standard group or for custom variation matching group
            $sCustomGroupName = $this->getField('variationgroups.value', 'value');
            $aCustomIdentifier = array();
            if (isset($sCustomGroupName)) {
                $aCustomIdentifier = explode(':', $sCustomGroupName);
            }

            if (count($aCustomIdentifier) == 2 && ($sName === 'attributename' || $sName === 'customidentifier')) {
                $aField['value'] = $aCustomIdentifier[$sName === 'attributename' ? 0 : 1];
                return;
            }

            $aNames = explode('.', $sName);
            if (count($aNames) == 4 && strtolower($aNames[3]) === 'code') {
                // real name is in format "variationgroups.qnvjagzvcm1hda____.rm9ybwf0.code"
                $sCustomIdentifier = count($aCustomIdentifier) == 2 ? $aCustomIdentifier[1] : '';
                $aValue = $this->getAttributesFromDB($aNames[1], $sCustomIdentifier);
                if ($aValue) {
                    $aFieldName = strtolower(pack('H*', $aNames[2]));

                    foreach ($aValue as $sKey => $aMatch) {
                        $sKeyReplacedDot = str_replace('.', '!dot!', $sKey);
                        if (strtolower($sKey) === $aFieldName || strtolower($sKeyReplacedDot) === $aFieldName) {
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
    }

    /**
     * Checks whether there are some items prepared differently than in Variation Matching tab.
     * If so, adds notice to
     *
     * @param $sIdentifier
     * @param $sIdentifierName
     */
    protected function checkAttributesFromDB($sIdentifier, $sIdentifierName)
    {
        $aValue = MLDatabase::getVariantMatchingTableInstance()->getMatchedVariations($sIdentifier);

        $oPrepareTable = MLDatabase::getPrepareTableInstance();
        $sShopVariationField = $oPrepareTable->getShopVariationFieldName();
        
        $oSelect = MLDatabase::factorySelectClass();
        $aData = $oSelect
            ->select('DISTINCT '.$sShopVariationField)
            ->from($oPrepareTable->getTableName())
            ->where(array($oPrepareTable->getPrimaryCategoryFieldName() => $sIdentifier))
            ->where(array('mpID' => MLModule::gi()->getMarketPlaceId()))
            ->limit(2) // 2 is enough for find out if there are prepred data !== default-data
            ->getResult()
        ;
        $aValuesFromPrepare = array_map(function ($jsonShopVariation) {
            return json_decode($jsonShopVariation['ShopVariation'], true);
        }, $aData);
        $aValuesFromPrepareSecondaryCategory = $this->getPreparedSecondaryCategoryVariations($sIdentifier);
        $aValuesFromPrepare = array_merge($aValuesFromPrepare, $aValuesFromPrepareSecondaryCategory);
        if (!empty($aValuesFromPrepare)) {
            foreach ($aValuesFromPrepare as $prepareValue) {
                // comparing arrays! do not use '!=='
                if ($prepareValue != $aValue) {
                    MLMessage::gi()->addNotice(self::getMessage('_prepare_variations_notice', array('category_name' => $sIdentifierName)));
                    return;
                }
            }
        }
    }

    /**
     * Gets prepared values for selected identifier
     *
     * @param string $sIdentifier Matching identifier (usually category name or ID).
     * @return array|bool
     */
    private function getPreparedSecondaryCategoryVariations($sIdentifier)
    {
        $oPrepareTable = MLDatabase::getPrepareTableInstance();
        $sShopVariationField = $oPrepareTable->getShopVariationFieldName();
        $oSelect = MLDatabase::factorySelectClass();
        $aData = $oSelect
            ->select('DISTINCT '.$sShopVariationField)
            ->from($oPrepareTable->getTableName())
            ->where(array('SecondaryCategory' => $sIdentifier))
            ->where(array('mpID' => MLModule::gi()->getMarketPlaceId()))
            ->limit(2) // 2 is enough for find out if there are prepred data !== default-data
            ->getResult()
        ;
        return array_map(function ($jsonShopVariation) {
            return json_decode($jsonShopVariation['ShopVariation'], true);
        }, $aData);
    }
}
