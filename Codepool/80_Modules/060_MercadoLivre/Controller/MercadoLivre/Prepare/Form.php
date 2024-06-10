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
ini_set('xdebug.max_nesting_level', 200);
MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_PrepareAbstract');

class ML_MercadoLivre_Controller_MercadoLivre_Prepare_Form extends ML_Form_Controller_Widget_Form_PrepareAbstract {

    protected $aParameters = array('controller');
    private $shopAttributes;

    public function render() {
        $this->getFormWidget();
        return $this;
    }

    public function getRequestField($sName=null, $blOptional=false) {
        if (count($this->aRequestFields) == 0) {
            $this->aRequestFields = $this->getRequest($this->sFieldPrefix);
            $this->aRequestFields = is_array($this->aRequestFields)?$this->aRequestFields:array();
        }

        return parent::getRequestField($sName, $blOptional);
    }

    public function triggerAfterField(&$aField) {
        if (!isset($aField['value'])) {
            $mValue = null;
            $aRequestFields = $this->getRequestField();
            $aNames = explode('.', $aField['realname']);
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
                            } else if (strtolower($key) === $aNames[$i]) {
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

                if ($sKey && $sKey != $aNames[0] && !is_array($value)) {
                    $mValue = array($sKey => $aTmp, 'name' => $sName);
                }
            }

            if ($mValue != null) {
                $aField['value'] = reset($mValue);
                $aField['valuearr'] = $mValue;
            }
        }
    }

    protected function getShopAttributeValues($sAttributeCode) {
        $attributes = MLFormHelper::getShopInstance()->getPrefixedAttributeOptions($sAttributeCode);
        $aResult = array();
        foreach ($attributes as $key => $value) {
            $aResult[$key] = array(
                'i18n' => $value,
            );
        }

        return $aResult;
    }

    protected function getSelectionNameValue() {
        return 'match';
    }

    protected function triggerBeforeFinalizePrepareAction() {
        if (count($this->oPrepareHelper->aErrorFields) === 0) {
			if (method_exists($this->oPrepareList->getModel(), 'getPreparedTimestampFieldName')) {
				// one request = one timestamp, needed for filtering in productlists
				$this->oPrepareList->set($this->oPrepareList->getModel()->getPreparedTimestampFieldName(), date('Y-m-d H:i:s'));
			}
			$this->oPrepareList->save();
            $this->saveMatchedAttributes();
            $oService = MLService::getAddItemsInstance();
            $oService->setAction('VerifyAddItems');

            try {
                $oList = MLProductList::gi('mercadolivre_verify');
                $oService->setProductList($oList)->execute();
                $blSuccess = true;
            } catch (Exception $oEx) {
                $blSuccess = $oEx->getMessage() === 'list not finished';
            }

            if ($blSuccess === true && $oService->haveError() === false) {
                $this->oPrepareList->set('verified', 'OK');
                return true;
            }
        }

        $this->oPrepareList->set('verified', 'ERROR');
        return false;
    }

    protected function shippingServiceField(&$aField) {
        $aField['values'] = ML::gi()->instance('controller_mercadolivre_config_prepare')->getField('shippingservice', 'values');
    }

    protected function categoriesField(&$aField) {
        $aField['subfields']['primary']['values'] = array('' => '..') + ML::gi()->instance('controller_mercadolivre_config_prepare')->getField('primarycategory', 'values');

        foreach ($aField['subfields'] as &$aSubField) {
            //adding current cat, if not in top cat
            if (!array_key_exists($aSubField['value'], $aSubField['values'])) {
                $oCat = MLDatabase::factory('mercadolivre_categories' . $aSubField['cattype']);
                $oCat->init(true)->set('categoryid', $aSubField['value'] ? : 0);
                $sCat = '';
                foreach ($oCat->getCategoryPath() as $oParentCat) {
                    $sCat = $oParentCat->get('categoryname') . ' &gt; ' . $sCat;
                }

                $aSubField['values'][$aSubField['value']] = substr($sCat, 0, -6);
            }
        }
    }

    protected function variationmatchingField(&$aField) {
        $aField['ajax'] = array(
            'selector' => '#' . $this->getField('primarycategory', 'id'),
            'trigger' => 'change',
            'field' => array(
                'type' => 'shopattributes',
            ),
        );
    }

    protected function getShopAttributes() {
        if ($this->shopAttributes == null) {
            $this->shopAttributes = MLFormHelper::getShopInstance()->getPrefixedAttributeList();
        }

        return $this->shopAttributes;
    }

    protected function getCategoryAttributes($sCategoryId, $blOnlyLists = false) {
        $aAttributes = $this->getFromApi('GetCategoryAttributes', array('CategoryId' => $sCategoryId));
        $aResult = array();
        if ($aAttributes) {
            foreach ($aAttributes as $aAttribute) {
                if ((isset($aAttribute['tags']['fixed']) && $aAttribute['tags']['fixed'] == true)
                        || ($blOnlyLists && empty($aAttribute['values']))) {
                    continue;
                }

                $sKey = $aAttribute['id'];
                $aResult[$sKey]['name'] = $aAttribute['name'];
                $aResult[$sKey]['type'] = $aAttribute['value_type'];
                $aResult[$sKey]['values'] = isset($aAttribute['values']) === true ? $aAttribute['values'] : null;
                $aResult[$sKey]['required'] = isset($aAttribute['tags']['required']) && $aAttribute['tags']['required'] == true;
                if (isset($aAttribute['value_max_length'])) {
                    $aResult[$sKey]['max_length'] = $aAttribute['value_max_length'];
                }
            }
        }

        return $aResult;
    }

    protected function getCategoryInfo($sCategoryId) {
        $sCategoryInfo = $this->getFromApi('GetCategory', array('CategoryId' => $sCategoryId));
        return $sCategoryInfo;
    }

    private function getFromApi($actionName, $aData = array()) {
        try {
            $aResponse = MagnaConnector::gi()->submitRequestCached(array('ACTION' => $actionName, 'DATA' => $aData));
            if ($aResponse['STATUS'] == 'SUCCESS' && isset($aResponse['DATA']) && is_array($aResponse['DATA'])) {
                return $aResponse['DATA'];
            }
        } catch (MagnaException $e) {
            // TODO: Add to error log
        }

        return array();
    }

    private function saveMatchedAttributes() {
        $oList = $this->oPrepareList->getList();
        $oItem = current($oList);
        $aAttrList = null;
        if (is_object($oItem) && $aAttrList = $oItem->get('attributes')) {
            foreach ($aAttrList as $aAttributes) {
                foreach ($aAttributes as $aKey => $aMatch) {
                    if ($aMatch['Code'] == 'aamatchaa' && isset($aMatch['Values']) === true && is_array($aMatch['Values']) === true) {
                        MLDatabase::factory('mercadolivre_matchedAttributes')
                            ->set('MercadoAttributeID', $aKey)
                            ->set('ShopAttributeID', $aMatch['MatchAttribute'])
                            ->set('Matching', json_encode($aMatch['Values']))
                            ->save();
                    }
                }
            }
        }
    }
}
