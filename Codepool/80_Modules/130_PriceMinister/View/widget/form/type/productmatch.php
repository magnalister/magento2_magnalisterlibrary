<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
    <input type="hidden" name="<?php echo MLHTTP::gi()->parseFormFieldName('matching_nextpage'); ?>"
           value="<?= $this->oPrepareHelper->currentPage == $this->oPrepareHelper->totalPages ? 'null' : $this->oPrepareHelper->currentPage + 1 ?>"/>
    <input type="hidden" name="<?php echo MLHTTP::gi()->parseFormFieldName('matching_totalpages'); ?>" value="<?= $this->oPrepareHelper->totalPages ?>"/>
    <div id="productDetailContainer" class="dialog2" title="<?= ML_LABEL_DETAILS ?>"></div>
<?php foreach ($this->oPrepareHelper->currentChunk as $aProduct) : ?>
    <table class="matching">
        <tbody class="product">
        <tr>
            <th colspan="5">
                <div class="title">
                    <span class="darker"><?= ML_LABEL_SHOP_TITLE ?>:</span>
                    <?= $aProduct['Title'] ?>&nbsp;&nbsp;
                    <span>
                        [<span style="color: #000;"><?= ML_LABEL_ARTICLE_NUMBER ?></span>: <?= $aProduct['Model'] ?>,
                        <span style="color: #000;"><?= ML_LABEL_SHOP_PRICE_BRUTTO ?></span>: <?= $aProduct['Price'] ?>]
                    </span>
                </div>
                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('matching') ?>[<?= $aProduct['Id'] ?>][title]"
                       id="match_title_<?= $aProduct['Id'] ?>"/>
                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('matching') ?>[<?= $aProduct['Id'] ?>][category_id]"
                       id="match_category_id_<?= $aProduct['Id'] ?>"/>
                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('matching') ?>[<?= $aProduct['Id'] ?>][category_name]"
                       id="match_category_name_<?= $aProduct['Id'] ?>"/>
                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('matching') ?>[<?= $aProduct['Id'] ?>][product_id]"
                       id="match_product_id_<?= $aProduct['Id'] ?>"/>
                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('match') ?>[<?= $aProduct['Id'] ?>]" value="false">
                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('model') ?>[<?= $aProduct['Id'] ?>]" value="<?= $aProduct['Model'] ?>">
                <button type="button" value="0" name="<?php echo MLHttp::gi()->parseFormFieldName('action'); ?>[prepareaction]"
                        id="priceminister_prepare_match_manual_form_field_prepareaction" style="display: none"></button>
                <div id="productDetails_<?= $aProduct['Id'] ?>" class="productDescBtn"
                     title="<?= ML_LABEL_DETAILS ?>"><?= ML_LABEL_DETAILS ?></div>
            </th>
        </tr>
        </tbody>
        <tbody class="headline">
        <tr>
            <th class="input"><?= ML_LABEL_CHOOSE ?></th>
            <th class="title"><?= MLI18n::gi()->priceminister_label_title ?></th>
            <th class="productGroup"><?= MLI18n::gi()->priceminister_category ?></th>
            <th class="asin"><?= MLI18n::gi()->priceminister_label_item_id ?></th>
        </tr>
        </tbody>
        <tbody class="options" id="matchingResults_<?= $aProduct['Id'] ?>">
        <?= $this->getSearchResultsHtml($aProduct) ?>
        </tbody>
        <tbody class="func">
        <tr>
            <td colspan="5">
                <div class="ml-product-match">
                    <div>
                        <div><?= MLI18n::gi()->priceminister_search_by_keywords ?>: <input type="text"
                                                                                           id="newSearch_<?= $aProduct['Id'] ?>"
                                                                                           value="<?= isset($aProduct['SearchCriteria']) && $aProduct['SearchCriteria'] === 'KW' ? $aProduct['Title'] : ''; ?>">
                            <input type="button" value="OK" id="newSearchGo_<?= $aProduct['Id'] ?>"></div>
                        <div><?= MLI18n::gi()->priceminister_search_by_ean ?>: <input type="text"
                                                                                      id="newEAN_<?= $aProduct['Id'] ?>"
                                                                                      value="<?= isset($aProduct['SearchCriteria']) && $aProduct['SearchCriteria'] === 'EAN' ? $aProduct['EAN'] : ''; ?>">
                            <input type="button" value="OK" id="newEANGo_<?= $aProduct['Id'] ?>"></div>
                    </div>
                    <div>
                        <div><?= MLI18n::gi()->priceminister_search_by_category ?>: <input type="text"
                                                                                           id="newCat_<?= $aProduct['Id'] ?>">
                            <input type="button" value="OK" id="newCatGo_<?= $aProduct['Id'] ?>"></div>
                        <div><?= MLI18n::gi()->priceminister_search_by_pm_productid ?>: <input type="text"
                                                                                               id="newPMpId_<?= $aProduct['Id'] ?>">
                            <input type="button" value="OK" id="newPMpIdGo_<?= $aProduct['Id'] ?>"></div>
                    </div>


                </div>

            </td>
        </tr>
        </tbody>
        <tr class="spacer">
            <td colspan="4"></td>
        </tr>
        <script type="text/javascript">/*<![CDATA[*/
            (function () {
                var productDetailJson_<?= $aProduct['Id'] ?> = <?php echo $this->renderDetailView($aProduct); ?>,

                    appendFormFields = function (data) {
                        let totalData = {'<?php echo MLSetting::gi()->get('sRequestPrefix')?>': data};
                        <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) {?>
                        totalData['<?php echo $sName;?>'] = '<?php echo $sValue; ?>';
                        <?php } ?>
                        return totalData;
                    };

                jqml('#productDetails_<?= $aProduct['Id'] ?>').click(function () {
                    jqml('#productDetailContainer').html(productDetailJson_<?= $aProduct['Id'] ?>.content).jDialog({
                        width: "75%",
                        title: productDetailJson_<?= $aProduct['Id'] ?>.title
                    });
                });
                jqml('#newSearchGo_<?= $aProduct['Id'] ?>').click(function () {
                    newSearch = jqml('#newSearch_<?= $aProduct['Id'] ?>').val();
                    if (jqml.trim(newSearch) != '') {
                        jqml.blockUI({message: blockUIMessage, css: blockUICSS});
                        jqml.ajax({
                            type: 'POST',
                            url: '<?php echo $this->getCurrentUrl(array('method' => 'ItemSearchByKW', 'ajax' => true)) ?>',
                            data: appendFormFields({
                                'productID': <?= $aProduct['Id'] ?>,
                                'search': newSearch
                            }),
                            dataType: "json",
                            success: function (data) {
                                jqml('#matchingResults_<?= $aProduct['Id'] ?>').html(data[0]);
                                if (function_exists("initRadioButtons")) {
                                    initRadioButtons('#matchingResults_<?= $aProduct['Id'] ?>');
                                } else {
                                    jqml.unblockUI();
                                }
                            },
                            error: function () {
                                jqml.unblockUI();
                            }
                        });
                    }
                });
                jqml('#newSearch_<?= $aProduct['Id'] ?>').keypress(function (event) {
                    if (event.keyCode == '13') {
                        event.preventDefault();
                        jqml('#newSearchGo_<?= $aProduct['Id'] ?>').click();
                    }
                });
                jqml('#newEANGo_<?= $aProduct['Id'] ?>').click(function () {
                    newEAN = jqml('#newEAN_<?= $aProduct['Id'] ?>').val();
                    if (jqml.trim(newEAN) != '') {
                        jqml.blockUI({message: blockUIMessage, css: blockUICSS});
                        jqml.ajax({
                            type: 'POST',
                            url: '<?php echo $this->getCurrentUrl(array('method' => 'ItemSearchByEAN', 'ajax' => true)) ?>',
                            data: appendFormFields({
                                'productID': <?= $aProduct['Id'] ?>,
                                'ean': newEAN
                            }),
                            dataType: "json",
                            success: function (data) {
                                jqml('#matchingResults_<?= $aProduct['Id'] ?>').html(data[0]);
                                if (function_exists("initRadioButtons")) {
                                    initRadioButtons('#matchingResults_<?= $aProduct['Id'] ?>');
                                } else {
                                    jqml.unblockUI();
                                }
                            },
                            error: function () {
                                jqml.unblockUI();
                            }
                        });
                    }
                });
                jqml('#newEAN_<?= $aProduct['Id'] ?>').keypress(function (event) {
                    if (event.keyCode == '13') {
                        event.preventDefault();
                        jqml('#newEANGo_<?= $aProduct['Id'] ?>').click();
                    }
                });

                jqml('#newPMpIdGo_<?= $aProduct['Id'] ?>').click(function () {
                    newSearch = jqml('#newPMpId_<?= $aProduct['Id'] ?>').val();
                    if (jqml.trim(newSearch) != '') {
                        jqml.blockUI({message: blockUIMessage, css: blockUICSS});
                        jqml.ajax({
                            type: 'POST',
                            url: '<?php echo $this->getCurrentUrl(array('method' => 'ItemSearchByPMProductId', 'ajax' => true)) ?>',
                            data: appendFormFields({
                                'productID': <?= $aProduct['Id'] ?>,
                                'pmpid': newSearch
                            }),
                            dataType: "json",
                            success: function (data) {
                                jqml('#matchingResults_<?= $aProduct['Id'] ?>').html(data[0]);
                                if (function_exists("initRadioButtons")) {
                                    initRadioButtons('#matchingResults_<?= $aProduct['Id'] ?>');
                                } else {
                                    jqml.unblockUI();
                                }
                            },
                            error: function () {
                                jqml.unblockUI();
                            }
                        });
                    }
                });
                jqml('#newPMpId_<?= $aProduct['Id'] ?>').keypress(function (event) {
                    if (event.keyCode == '13') {
                        event.preventDefault();
                        jqml('#newPMpIdGo_<?= $aProduct['Id'] ?>').click();
                    }
                });

                jqml('#newCatGo_<?= $aProduct['Id'] ?>').click(function () {
                    newSearch = jqml('#newCat_<?= $aProduct['Id'] ?>').val();
                    if (jqml.trim(newSearch) != '') {
                        jqml.blockUI({message: blockUIMessage, css: blockUICSS});
                        jqml.ajax({
                            type: 'POST',
                            url: '<?php echo $this->getCurrentUrl(array('method' => 'ItemSearchByCategory', 'ajax' => true)) ?>',
                            data: appendFormFields({
                                'productID': <?= $aProduct['Id'] ?>,
                                'cat': newSearch
                            }),
                            dataType: "json",
                            success: function (data) {
                                jqml('#matchingResults_<?= $aProduct['Id'] ?>').html(data[0]);
                                if (function_exists("initRadioButtons")) {
                                    initRadioButtons('#matchingResults_<?= $aProduct['Id'] ?>');
                                } else {
                                    jqml.unblockUI();
                                }
                            },
                            error: function () {
                                jqml.unblockUI();
                            }
                        });
                    }
                });
                jqml('#newCat_<?= $aProduct['Id'] ?>').keypress(function (event) {
                    if (event.keyCode == '13') {
                        event.preventDefault();
                        jqml('#newCatGo_<?= $aProduct['Id'] ?>').click();
                    }
                });

                jqml('#priceminister_prepare_match_manual_fieldset_manualmatching').on('change', 'input:radio', function () {
                    var me = jqml(this);
                    var productId = me.attr('data-id');
                    if (me.val() == 'false') {
                        return;
                    }

                    var selectedProductId = me.val();
                    var categoryId = jqml('#category_' + me.attr('id')).attr('data-id');
                    jqml('#match_category_id_' + productId).val(categoryId);
                    jqml('#match_category_name_' + productId).val(jqml('#category_' + me.attr('id')).attr('data-name'));
                    jqml('#match_title_' + productId).val(jqml('#title_' + me.attr('id')).attr('data-id'));
                    jqml('#match_product_id_' + productId).val(selectedProductId);

                    <?php if($this->oPrepareHelper->bIsSinglePrepare){ ?>
                    jqml.blockUI({message: blockUIMessage, css: blockUICSS});
                    jqml.ajax({
                        type: 'POST',
                        url: '<?php echo $this->getCurrentUrl(array('method' => 'AdvertAttrForCategory', 'ajax' => true)) ?>',
                        data: appendFormFields({
                            'productID': selectedProductId,
                            'category_id': categoryId
                        }),
                        dataType: "json",
                        success: function (data) {
                            jqml('.attributematching').html('');
                            jqml('#attributematching_' + selectedProductId).html(data[0]);
                            jqml.unblockUI();
                        },
                        error: function () {
                            jqml.unblockUI();
                        }
                    });
                });

                jqml(document).on('click', '#priceminister_prepare_match_manual_form_field_prepareaction', function () {
                    var form = jqml(this).closest('form');
                    var formData = jqml(form).serialize();
                    var checked = jqml('input:radio:checked');
                    var productId = checked.attr('data-id');
                    var selectedProductId = jqml('#match_product_id_' + productId).val();
                    var categoryId = jqml('#match_category_id_' + productId).val();
                    jqml.blockUI({message: blockUIMessage, css: blockUICSS});

                    jqml.ajax({
                        type: 'POST',
                        url: '<?php echo $this->getCurrentUrl(array('method' => 'PrepareAdvertAttribute', 'ajax' => true)) ?>',
                        data: appendFormFields({
                            'productID': selectedProductId,
                            'formdata': formData,
                            'category_id': categoryId
                        }),
                        dataType: "json",
                        success: function (data) {
                            jqml('.attributematching').html('');
                            jqml('#attributematching_' + selectedProductId).html(data[0]);
                            jqml.unblockUI();
                        },
                        error: function () {
                            jqml.unblockUI();
                        }
                    });
                    <?php } ?>
                });

                function initRadioButtons(context) {
                    jqml(context + " input[type='radio']:checked").trigger('change');
                    jqml.unblockUI();
                }

                jqml('input:radio:checked').trigger('change');
            })();
            /*]]>*/
        </script>
    </table>
<?php endforeach ?>