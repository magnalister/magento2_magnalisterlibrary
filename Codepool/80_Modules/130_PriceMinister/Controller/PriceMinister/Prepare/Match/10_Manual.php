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

class ML_PriceMinister_Controller_PriceMinister_Prepare_Match_Manual extends ML_Form_Controller_Widget_Form_PrepareWithVariationMatchingAbstract {
    protected $aParameters = array('controller');
    protected $aMPAttributes;
    protected $missingCategories;

    public function construct() {
        parent::construct();
        $this->oPrepareHelper->bIsSinglePrepare = $this->oSelectList->getCountTotal() === '1';
        $this->oPrepareHelper->oSelectList = $this->oSelectList;
    }

    public function render() {
        ob_start();
        $this->getFormWidget();
        $sHtmlForm = ob_get_contents();
        ob_end_clean();

        $this->renderTitle($this->oPrepareHelper->totalPages, $this->oPrepareHelper->currentPage);
        echo $sHtmlForm;
        return $this;
    }

    public function getRequestField($sName = null, $blOptional = false) {
        if (count($this->aRequestFields) == 0) {
            $this->aRequestFields = $this->getRequest($this->sFieldPrefix);
            $this->aRequestFields = is_array($this->aRequestFields) ? $this->aRequestFields : array();
        }

        return parent::getRequestField($sName, $blOptional);
    }

    protected function itemConditionField(&$aField) {
        $aField['values'] = $this->callApi('GetItemConditions');
    }

    protected function getSelectionNameValue() {
        return 'match';
    }

    protected function triggerBeforeFinalizePrepareAction() {
        $this->oPrepareList->set('ItemTitle', '');
        $this->oPrepareList->set('ean', '');
        $this->oPrepareList->set('verified', 'OK');
        if (MLRequest::gi()->data('matching_nextpage') !== null) {
            $this->oPrepareHelper->currentPage = MLRequest::gi()->data('matching_nextpage');
        } else {
            $this->oPrepareHelper->currentPage = 1;
        }

        if (MLRequest::gi()->data('matching_totalpages') !== null) {
            $this->oPrepareHelper->totalPages = MLRequest::gi()->data('matching_totalpages');
        } else {
            $this->oPrepareHelper->totalPages = 1;
        }

        $isAttributePrepared = true;
        $prepareItems = $this->oPrepareList->getList();
        $newPrepareList = array();
        $aMatch = MLRequest::gi()->data('match');
        $aMatching = MLRequest::gi()->data('matching');
        foreach ($aMatch as $key => $itemID) {
            if ($itemID !== 'false') {
                $prepareItems['['.$key.']']->set('ItemTitle', $aMatching[$key]['title']);
                $prepareItems['['.$key.']']->set('MPProductId', $itemID);

                if ($this->oPrepareHelper->bIsSinglePrepare) {
                    $attributeMatchingSuccess = parent::triggerBeforeFinalizePrepareAction();
                    if (isset($attributeMatchingSuccess) && !$attributeMatchingSuccess) {
                        $isAttributePrepared = false;
                        $prepareItems['['.$key.']']->set('verified', 'ERROR');
                    }
                } else {
                    $shopVariation = $this->getMatchedVariations($aMatching[$key]['category_id']);
                    $prepareItems['['.$key.']']->set('TopPrimaryCategory', $aMatching[$key]['category_id']);
                    $prepareItems['['.$key.']']->set('PrimaryCategory', $aMatching[$key]['category_id']);

                    if (empty($shopVariation)) {
                        $this->missingCategories[$aMatching[$key]['category_name']] = $aMatching[$key]['category_name'];
                        $prepareItems['['.$key.']']->set('verified', 'ERROR');
                    } else {
                        $prepareItems['['.$key.']']->set('ShopVariation', $shopVariation);
                    }
                }

                $newPrepareList['['.$key.']'] = $prepareItems['['.$key.']']->data();
            }
        }

        $this->oPrepareList->reset();

        foreach ($newPrepareList as $value) {
            $this->oPrepareList->add($value);
        }

        $this->oPrepareList->set('preparetype', 'manual');

        if (!$isAttributePrepared || ($this->oPrepareHelper->currentPage !== 'null') && ($this->oPrepareHelper->currentPage - 1 !== $this->oPrepareHelper->totalPages)) {
            return false;
        }

        return true;
    }

    protected function triggerBeforeFinalizePrepareActionAjax() {
        $this->oPrepareList->set('verified', 'ERROR');

        $aMatching = $this->getRequest('field');
        $sIdentifier = isset($aMatching['variationgroups.value']) ? $aMatching['variationgroups.value'] : '';

        if (empty($sIdentifier) && !empty($aMatching['variationgroups'])) {
            $aCache = array_keys($aMatching['variationgroups']);
            $sIdentifier = array_shift($aCache);
            unset($aCache);
        }

        if (isset($aMatching['variationgroups'])) {
            $aMatching = $aMatching['variationgroups'][$sIdentifier];

            if ($sIdentifier === 'new') {
                $sIdentifier = $aMatching['variationgroups.code'];
                unset($aMatching['variationgroups.code']);
            }

            $aErrors = array();
            foreach ($aMatching as $key => &$value) {
                if (isset($value['Required'])) {
                    $value['Required'] = (bool)$value['Required'];
                }

                $value['Error'] = false;

                if ($value['Code'] == '' || empty($value['Values'])) {
                    unset($aMatching[$key]);
                    continue;
                }

                if (!is_array($value['Values']) || !isset($value['Values']['FreeText'])) {
                    continue;
                }

                $sInfo = self::getMessage('_prepare_variations_manualy_matched');
                $sFreeText = $value['Values']['FreeText'];
                unset($value['Values']['FreeText']);

                if ($value['Values']['0']['Shop']['Key'] === 'noselection' || $value['Values']['0']['Marketplace']['Key'] === 'noselection') {
                    unset($value['Values']['0']);

                    foreach ($value['Values'] as $k => &$v) {
                        if (empty($v['Marketplace']['Info']) || $v['Marketplace']['Key'] === 'manual') {
                            $v['Marketplace']['Info'] = $v['Marketplace']['Value'].self::getMessage('_prepare_variations_free_text_add');
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
                        unset($value['Values']['0']);
                        continue;
                    }

                    $value['Values']['0']['Marketplace']['Value'] = $sFreeText;
                }

                if ($value['Values']['0']['Marketplace']['Key'] === 'auto') {
                    $this->autoMatch($sIdentifier, $key, $value);
                    continue;
                }

                $this->checkNewMatchedCombination($value['Values']);
                if ($value['Values']['0']['Shop']['Key'] === 'all') {
                    $newValue = array();
                    $i = 0;
                    foreach ($this->getShopAttributeValues($value['Code']) as $keyAttribute => $valueAttribute) {
                        $newValue[$i]['Shop']['Key'] = $keyAttribute;
                        $newValue[$i]['Shop']['Value'] = $valueAttribute;
                        $newValue[$i]['Marketplace']['Key'] = $value['Values']['0']['Marketplace']['Key'];
                        $newValue[$i]['Marketplace']['Value'] = $value['Values']['0']['Marketplace']['Key'];
                        $newValue[$i]['Marketplace']['Info'] = $value['Values']['0']['Marketplace']['Value'].$sInfo;
                        $i++;
                    }

                    $value['Values'] = $newValue;
                } else {
                    foreach ($value['Values'] as $k => &$v) {
                        if (empty($v['Marketplace']['Info'])) {
                            $v['Marketplace']['Info'] = $v['Marketplace']['Value'].$sInfo;
                        }

                        $v['Marketplace']['Value'] = $v['Marketplace']['Key'];
                    }
                }
            }

            $sMatching = json_encode($aMatching);
            $this->oPrepareList->set('shopvariation', $sMatching);
            $this->oPrepareList->set('primarycategory', $sIdentifier);

            if (!empty($aErrors)) {
                foreach ($aErrors as $sError) {
                    MLMessage::gi()->addError($sError);
                }

                $this->oPrepareList->reset();
                return false;
            } else if (empty($aErrors)) {
                $this->oPrepareList->save();
                MLMessage::gi()->addSuccess(self::getMessage('_prepare_match_variations_saved'));
            }
        }

        return true;
    }

    protected function callAjaxItemSearchByKW() {
        $aProduct = array(
            'Id' => $this->getRequest('productID'),
            'Results' => $this->oPrepareHelper->searchOnPriceMinister($this->getRequest('search'), 'KW')
        );

        MLSetting::gi()->add('aAjax', $this->getSearchResultsHtml($aProduct));
    }

    protected function callAjaxItemSearchByEAN() {
        $aProduct = array(
            'Id' => $this->getRequest('productID'),
            'Results' => $this->oPrepareHelper->searchOnPriceMinister($this->getRequest('ean'), 'EAN')
        );

        MLSetting::gi()->add('aAjax', $this->getSearchResultsHtml($aProduct));
    }

    protected function callAjaxItemSearchByCategory() {
        $aProduct = array(
            'Id' => $this->getRequest('productID'),
            'Results' => $this->oPrepareHelper->searchOnPriceMinister($this->getRequest('cat'), 'Category')
        );

        MLSetting::gi()->add('aAjax', $this->getSearchResultsHtml($aProduct));
    }

    protected function callAjaxItemSearchByPMProductId() {
        $aProduct = array(
            'Id' => $this->getRequest('productID'),
            'Results' => $this->oPrepareHelper->searchOnPriceMinister($this->getRequest('pmpid'), 'productids')
        );

        MLSetting::gi()->add('aAjax', $this->getSearchResultsHtml($aProduct));
    }

    protected function callAjaxAdvertAttrForCategory() {
        ob_start();
        $this->includeView('widget_form_type_variations', array('mParentValue' => $this->getRequest('category_id')));
        $html = ob_get_contents();
        ob_end_clean();

        MLSetting::gi()->add('aAjax', $html);
    }

    protected function callAjaxPrepareAdvertAttribute() {

        $a = array();

        $iPid = $this->oSelectList->get('pid');
        $this->oProduct = MLProduct::factory()->set('id', reset($iPid));
        $aCols = array_keys($this->oPrepareList->getModel()->getTableInfo());
        $aRow = $this->oPrepareHelper
            ->setProduct($this->oProduct)
            ->setPrepareList(null)//only values from request, and single entree from db
            ->getPrepareData($aCols);

        $aData = array();
        foreach ($aRow as $sField => $aCollumn) {
            $aData[$sField] = $aCollumn['value'];
        }

        $this->oPrepareList->add($aData);

        $this->triggerBeforeFinalizePrepareActionAjax();
        $this->callAjaxAdvertAttrForCategory();
    }

    protected function callGetCategoryDetails($sCategoryId) {
        return MagnaConnector::gi()->submitRequest(array(
            'ACTION' => 'GetCategoryDetails',
            'DATA' => array('CategoryID' => $sCategoryId, 'OnlyAdvert' => 'true'),
        ));
    }

    /**
     * Gets marketplace attributes for selected category (variation group).
     * Since Priceminister has subcategories as an attribute to parent category, this is removed
     * because it can confuse user.
     *
     * @param string $sVariationValue
     * @return array
     */
    public function getMPVariationAttributes($sVariationValue) {
        $result = parent::getMPVariationAttributes($sVariationValue);
        $this->removeCatAttributes($result, $sVariationValue);

        return $result;
    }

    /**
     * Get attributes that represent subcategories. These attributes are rendered separately
     * because they could confuse user if they are rendered inside attributes matching.
     *
     * @param string $categoryId Identifier of a category to get subcategories.
     * @return array
     */
    protected function getCategoryAttributes($categoryId) {
        $response = MagnaConnector::gi()->submitRequest(array('ACTION' => 'GetCategoryAttributes', 'DATA' => array('CategoryID' => $categoryId)));
        $result = !empty($response['DATA']) ? $response['DATA'] : array();

        // Get MP attributes because that call will prepare attributes as they should be rendered.
        // Do not call $this->getMPVariationAttributes method because it will cause circular reference (stack overflow).
        $mpAttributes = parent::getMPVariationAttributes($categoryId);
        $catAttributes = array();
        foreach ($mpAttributes as $key => $attribute) {
            if (in_array($key, $result)) {
                $catAttributes[$key] = $attribute;
            }
        }

        return $catAttributes;
    }

    /**
     * Removes attributes that represent subcategories from supplied array of attributes.
     * @param array $attributes
     * @param string $sIdentifier Category identifier
     */
    private function removeCatAttributes(&$attributes, $sIdentifier) {
        $aCategoryAttributes = $this->getCategoryAttributes($sIdentifier);
        foreach ($attributes as $key => $attribute) {
            if (isset($aCategoryAttributes[$key])) {
                unset($attributes[$key]);
            }
        }
    }

    public function triggerBeforeField(&$aField) {
        $aResultHelper = $this->oPrepareHelper->getField($aField['name']);
        $aResultHelper = array_change_key_case($aResultHelper, CASE_LOWER);
        $aField = array_merge($aField, $aResultHelper);

        $sName = $aField['realname'];
        if ($sName === 'variationgroups.value') {
            return;
        }

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

    public function getSearchResultsHtml($aProduct) {
        if (is_array($aProduct['Results']) === false || count($aProduct['Results']) === 0) {
            $aProduct['Results'] = array();
        }

        $iCheckedProductId = count($aProduct['Results']) > 0 ? $aProduct['Results'][0]['productid'] : null;

        foreach ($aProduct['Results'] as $aResult) {
            if (isset($aResult['ean_match']) && $aResult['ean_match'] === true) {
                $iCheckedProductId = $aResult['productid'];
                break;
            }
        }

        ob_start();
        ?>
        <?php foreach ($aProduct['Results'] as $aResult) : ?>
            <?php if (empty($aResult['category_name'])) {
                continue;
            }
            ?>
            <tr class="odd last">
                <td class="input">
                    <input type="radio" name="match[<?= $aProduct['Id'] ?>]" data-id="<?= $aProduct['Id'] ?>"
                           id="match_<?= $aProduct['Id'].'_'.$aResult['productid'] ?>"
                           value="<?= $aResult['productid'] ?>" <?= $iCheckedProductId === $aResult['productid'] ? 'checked' : '' ?>
                           data-ean="<?= isset($aResult['eans']) ? reset($aResult['eans']) : '' ?>">
                </td>
                <td class="title">
                    <label
                            for="match_<?= $aProduct['Id'].'_'.$aResult['productid'] ?>"
                            data-id="<?= fixHTMLUTF8Entities($aResult['headline'], ENT_COMPAT, 'UTF-8') ?>"
                            id="title_match_<?= $aProduct['Id'].'_'.$aResult['productid'] ?>"><?= $aResult['headline'] ?></label>
                </td>
                <td class="productGroup" id="category_match_<?= $aProduct['Id'].'_'.$aResult['productid'] ?>"
                    data-id="<?= $aResult['alias'] ?>" data-name="<?= $aResult['category_name'] ?>">
                    <?= $aResult['category_name'] ?>
                </td>
                <td class="asin">
                    <a href="<?= $aResult['url'] ?>"
                       title="<?= MLI18n::gi()->get('priceminister_label_product_at_priceminister'); ?>" target="_blank"
                       onclick="
                               (function(url) {
                               f = window.open(url, '<?= MLI18n::gi()->get('priceminister_label_product_at_priceminister'); ?>', 'width=1017, height=600, resizable=yes, scrollbars=yes');
                               f.focus();
                               })(this.href);
                               return false;">
                        <?= $aResult['productid'] ?>
                    </a>
                </td>
            </tr>
            <?php if ($this->oPrepareHelper->bIsSinglePrepare) { ?>
                <tr>
                    <td colspan="5" class="attributematching" id="attributematching_<?= $aResult['productid'] ?>"></td>
                </tr>
            <?php } ?>
        <?php endforeach ?>
        <tr class="last noItem">
            <td class="input"><input type="radio" name="match[<?= $aProduct['Id'] ?>]"
                                     id="match_<?= $aProduct['Id'] ?>_false"
                                     value="false" <?= $iCheckedProductId === null ? 'checked' : '' ?>></td>
            <td class="title italic"><label
                        for="match_<?= $aProduct['Id'] ?>_false"><?= MLI18n::gi()->priceminister_label_not_matched ?></label>
            </td>
            <td class="productGroup">&nbsp;</td>
            <td class="asin">&nbsp;</td>
        </tr>
        <?php

        $sHtml = ob_get_contents();
        ob_end_clean();

        return $sHtml;
    }

    public function renderDetailView($aProduct) {
        $iWidth = 60;
        $iHeight = 60;
        $sHtml = '';

        ob_start();
        ?>

        <table class="matchingDetailInfo">
            <tbody>
            <?php if (empty($aProduct['Manufacturer']) === false) : ?>
                <tr>
                    <th class="smallwidth"><?= ML_GENERIC_MANUFACTURER_NAME ?>:</th>
                    <td><?= $aProduct['Manufacturer'] ?></td>
                </tr>
            <?php endif ?>
            <?php if (empty($aProduct['Model']) === false) : ?>
                <tr>
                    <th class="smallwidth"><?= ML_GENERIC_MODEL_NUMBER ?>:</th>
                    <td><?= $aProduct['Model'] ?></td>
                </tr>
            <?php endif ?>
            <?php if (empty($aProduct['EAN']) === false || (SHOPSYSTEM != 'oscommerce')) : ?>
                <tr>
                    <th class="smallwidth"><?= ML_GENERIC_EAN ?>:</th>
                    <td><?= empty($aProduct['EAN']) === true ? '&nbsp;' : $aProduct['EAN'] ?></td>
                </tr>
            <?php endif ?>
            <?php if (empty($aProduct['Description']) === false) : ?>
                <tr>
                    <td style="border: 2px solid transparent;"></td>
                </tr>
                <tr>
                    <th colspan="2"><?= ML_GENERIC_MY_PRODUCTDESCRIPTION ?></th>
                </tr>
                <tr class="desc">
                    <td colspan="2">
                        <div class="mlDesc"><?= $aProduct['Description'] ?></div>
                    </td>
                </tr>
            <?php endif ?>
            <?php if (empty($aProduct['Images']) === false) : ?>
                <tr>
                    <th colspan="2"><?= ML_LABEL_PRODUCTS_IMAGES ?></th>
                </tr>
                <tr class="images">
                    <td colspan="2">
                        <div class="main">
                            <?php foreach ($aProduct['Images'] as $sImagePath) : ?>
                                <table>
                                    <tbody>
                                    <tr>
                                        <td style="width: <?= $iWidth ?>px; height: <?= $iHeight ?>px; display: inline-block;">
                                            <?= $this->getProductImageThumb($sImagePath, $iWidth, $iHeight) ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            <?php endforeach ?>
                        </div>
                    </td>
                </tr>
            <?php endif ?>
            </tbody>
        </table>

        <?php
        $sHtml .= ob_get_contents();
        ob_end_clean();

        return json_encode(array(
            'title' => ML_LABEL_DETAILS_FOR.': '.$aProduct['Title'],
            'content' => $sHtml,
        ));
    }

    private function getProductImageThumb($sImagePath, $iWidth, $iHeight) {
        try {
            $aUrl = MLImage::gi()->resizeImage($sImagePath, 'products', $iWidth, $iHeight);
            return "<img width='$iWidth' height='$iHeight' src='{$aUrl['url']}'>";
        } catch (Exception $e) {
            return 'X';
        }
    }

    public function prepareAction($blExecute = true) {
        if ($blExecute) {
            try {
                $oProductBackup = $this->oProduct;
                $aCols = array_keys($this->oPrepareList->getModel()->getTableInfo());
                $blError = false;
                $this->missingCategories = array();
                foreach ($this->oSelectList->get('pid') as $sProductsId) {
                    try {
                        $this->oProduct = MLProduct::factory()->set('id', $sProductsId);
                        if ($this->oProduct->exists()) {
                            $aRow = $this->oPrepareHelper
                                ->setProduct($this->oProduct)
                                ->setPrepareList(null)//only values from request, and single entree from db
                                ->getPrepareData($aCols);

//                            MLMessage::gi()->addDebug(__LINE__.':'.microtime(true), array($aRow));
                            try {
                                $this->oCurrentPrepared = $this->oPrepareList->getByKey('['.$sProductsId.']');
                                foreach ($aRow as $sField => $aCollumn) {
                                    $this->oCurrentPrepared->set($sField, $aCollumn['value']);
                                }
                            } catch (Exception $oEx) {
                                $aData = array();
                                foreach ($aRow as $sField => $aCollumn) {
                                    $aData[$sField] = $aCollumn['value'];
                                }
                                $this->oPrepareList->add($aData);
                            }

                        } else {//shop-product dont exists
                            try {
                                $this->oPrepareList->getByKey('['.$sProductsId.']')->delete();
                            } catch (Exception $oEx) {//already deleted?
                            }
                            try {
                                $this->oSelectList->getByKey('['.$sProductsId.']')->delete();
                            } catch (Exception $oEx) {//already deleted?
                            }
                            $blError = true;
                        }
                    } catch (Exception $oEx) {
                        MLMessage::gi()->addDebug($oEx);
                        $blError = true;
                    }
                }
                if ($blError) {
                    $this->oPrepareList->reset();
                    $this->oSelectList->reset();
                }
                $blRedirect = $this->triggerBeforeFinalizePrepareAction();
                if (!empty($this->missingCategories)) {
                    MLMessage::gi()->addError(MLI18n::gi()->get('priceminister_not_matched_category').' '.implode(', ', $this->missingCategories));
                }

                if ($this->getRequest('saveToConfig') == 'true' && $blRedirect) {
                    $this->oPrepareHelper->saveToConfig();
                }
                if (method_exists($this->oPrepareList->getModel(), 'getPreparedTimestampFieldName')) {
                    // one request = one timestamp, needed for filtering in productlists
                    $this->oPrepareList->set($this->oPrepareList->getModel()->getPreparedTimestampFieldName(), date('Y-m-d H:i:s'));
                }

                $this->oPrepareList->save();
                $this->aRequestFields = array();
                $this->aRequestOptional = array();
                $this->oProduct = $oProductBackup;
                $this->oPrepareHelper
                    ->setRequestFields($this->aRequestFields)
                    ->setRequestOptional($this->aRequestOptional)
                    ->setPrepareList($this->oPrepareList)
                    ->setProduct($this->oProduct);
                if ($blRedirect) {
                    MLHttp::gi()->redirect($this->getParentUrl());
                }
            } catch (Exception $oEx) {
                MLMessage::gi()->addError($oEx);
            }
            return $this;
        } else {
            $label = MLI18n::gi()->get('form_action_prepare_and_next');
            if ($this->oPrepareHelper->currentPage == $this->oPrepareHelper->totalPages) {
                $label = MLI18n::gi()->get('form_action_prepare');
            }

            return array(
                'aI18n' => array('label' => $label),
                'aForm' => array(
                    'type' => 'submit',
                    'position' => 'right',
                )
            );
        }
    }

    public function renderTitle($totalPages = 1, $currentPage = 1) {
        $html = '<h2>'.MLI18n::gi()->get(
                $this->oPrepareHelper->bIsSinglePrepare ?
                    'PriceMinister_Productlist_Match_Manual_Title_Single' :
                    'PriceMinister_Productlist_Match_Manual_Title_Multi'
            );

        if ($totalPages > 1) {
            $html .= '<span class="small right successBox" style="margin-top: -13px; font-size: 12px !important;">
                '.ML_LABEL_STEP.' '.$currentPage.' von '.$totalPages.
                '</span>';
        }

        $html .= '</h2>';
        echo $html;
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
        return empty($aData) ? '' : $aData['ShopVariation'];
    }

}
