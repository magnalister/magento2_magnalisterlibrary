<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
    <input type="hidden" name="<?php echo MLHTTP::gi()->parseFormFieldName('matching_nextpage') ?>" value="<?php echo $this->oPrepareHelper->currentPage == $this->oPrepareHelper->totalPages ? 'null' : $this->oPrepareHelper->currentPage + 1 ?>"/>
    <input type="hidden" name="<?php echo MLHTTP::gi()->parseFormFieldName('matching_totalpages') ?>" value="<?php echo $this->oPrepareHelper->totalPages ?>"/>
    <div id="productDetailContainer" class="dialog2" title="<?php echo ML_LABEL_DETAILS ?>"></div>
<?php foreach ($this->oPrepareHelper->currentChunk as $aProduct) : ?>
    <table class="matching">
        <tbody class="product">
        <tr>
            <th colspan="5">
                <div class="title">
                    <span class="darker"><?php echo ML_LABEL_SHOP_TITLE ?>:</span>
                    <?php echo $aProduct['Title'] ?>&nbsp;&nbsp;
                    <span>
                        [<span style="color: #000;"><?php echo ML_LABEL_ARTICLE_NUMBER ?></span>: <?php echo $aProduct['Model'] ?>,
                        <span style="color: #000;"><?php echo ML_LABEL_SHOP_PRICE_BRUTTO ?></span>: <?php echo $aProduct['Price'] ?>]
                    </span>
                </div>
                <input type="hidden" name="<?php echo MLHTTP::gi()->parseFormFieldName('matching['.$aProduct['Id'].'][title]') ?>"
                       id="match_title_<?php echo $aProduct['Id'] ?>"/>
                <input type="hidden" name="<?php echo MLHTTP::gi()->parseFormFieldName('matching['.$aProduct['Id'].'][ean]') ?>"
                       id="match_ean_<?php echo $aProduct['Id'] ?>"/>
                <input type="hidden" name="<?php echo MLHTTP::gi()->parseFormFieldName('match['.$aProduct['Id'].']') ?>" value="false">
                <input type="hidden" name="<?php echo MLHTTP::gi()->parseFormFieldName('model['.$aProduct['Id'].']') ?>" value="<?php echo $aProduct['Model'] ?>">
                <div id="productDetails_<?php echo $aProduct['Id'] ?>" class="productDescBtn" title="<?php echo ML_LABEL_DETAILS ?>"><?php echo ML_LABEL_DETAILS ?></div>
            </th>
        </tr>
    </tbody>
    <tbody class="headline">
        <tr>
            <th class="input"><?php echo ML_LABEL_CHOOSE ?></th>
            <th class="title"><?php echo MLI18n::gi()->hitmeister_label_title ?></th>
            <th class="productGroup"><?php echo MLI18n::gi()->hitmeister_category ?></th>
            <th class="asin"><?php echo MLI18n::gi()->hitmeister_label_item_id ?></th>
        </tr>
    </tbody>
    <tbody class="options" id="matchingResults_<?php echo $aProduct['Id'] ?>">
        <?php echo $this->getSearchResultsHtml($aProduct) ?>
    </tbody>
    <tbody class="func">
        <tr>
            <td colspan="5">
                <div><?php echo MLI18n::gi()->hitmeister_search_by_title ?>: <input type="text" id="newSearch_<?php echo $aProduct['Id'] ?>" value="<?php echo isset($aProduct['SearchCriteria']) && $aProduct['SearchCriteria'] === 'Title' ? $aProduct['Title'] : ''; ?>">
                    <input type="button" value="OK" id="newSearchGo_<?php echo $aProduct['Id'] ?>"></div>
                <div><?php echo MLI18n::gi()->hitmeister_search_by_ean ?>: <input type="text" id="newEAN_<?php echo $aProduct['Id'] ?>" value="<?php echo isset($aProduct['SearchCriteria']) && $aProduct['SearchCriteria'] === 'EAN' ? $aProduct['EAN'] : ''; ?>">
                    <input type="button" value="OK" id="newEANGo_<?php echo $aProduct['Id'] ?>"></div>
            </td>
        </tr>
    </tbody>
    <!--<tr class="spacer"><td colspan="4"></td></tr>-->
    <script type="text/javascript">/*<![CDATA[*/
        var productDetailJson_<?php echo $aProduct['Id'] ?> = <?php echo $this->renderDetailView($aProduct); ?>

        jqml('#productDetails_<?php echo $aProduct['Id'] ?>').click(function() {
            myConsole.log(productDetailJson_<?php echo $aProduct['Id'] ?>);
            jqml('#productDetailContainer').html(productDetailJson_<?php echo $aProduct['Id'] ?>.content).jDialog({
                width: "75%",
                title: productDetailJson_<?php echo $aProduct['Id'] ?>.title
            });
        });
        jqml('#newSearchGo_<?php echo $aProduct['Id'] ?>').click(function() {
            newSearch = jqml('#newSearch_<?php echo $aProduct['Id'] ?>').val();
            if (jqml.trim(newSearch) != '') {
                jqml.blockUI({ message: blockUIMessage, css: blockUICSS });
                myConsole.log(newSearch);
                jqml.ajax({
                    type: 'POST',
                    url: '<?php echo $this->getCurrentUrl() ?>',

                    data: ({
                        <?php foreach (MLHttp::gi()->getNeededFormFields() as $key => $value) {
                            echo "'".$key."': '".addslashes($value)."',\n";
                        }
                        ?>
                        '<?php echo MLHTTP::gi()->parseFormFieldName('method') ?>': 'ItemSearchByTitle',
                        '<?php echo MLHTTP::gi()->parseFormFieldName('ajax') ?>': true,
                        '<?php echo MLHTTP::gi()->parseFormFieldName('productID') ?>': <?php echo $aProduct['Id'] ?>,
                        '<?php echo MLHTTP::gi()->parseFormFieldName('search') ?>': newSearch
                    }),
                    dataType: "json",
                    success: function(data) {
                        jqml('#matchingResults_<?php echo $aProduct['Id'] ?>').html(data[0]);
                        if (function_exists("initRadioButtons")) {
                            initRadioButtons('#matchingResults_<?php echo $aProduct['Id'] ?>');
                        }
                        jqml.unblockUI();
                    },
                    error: function() {
                        jqml.unblockUI();
                    }
                });
            }
        });
        jqml('#newSearch_<?php echo $aProduct['Id'] ?>').keypress(function(event) {
            if (event.keyCode == '13') {
                event.preventDefault();
                jqml('#newSearchGo_<?php echo $aProduct['Id'] ?>').click();
            }
        });
        jqml('#newEANGo_<?php echo $aProduct['Id'] ?>').click(function() {
            newEAN = jqml('#newEAN_<?php echo $aProduct['Id'] ?>').val();
            if (jqml.trim(newEAN) != '') {
                myConsole.log(newEAN);
                jqml.blockUI({ message: blockUIMessage, css: blockUICSS });
                jqml.ajax({
                    type: 'POST',
                    url: '<?php echo $this->getCurrentUrl() ?>',
                    data: ({
                        '<?php echo MLHTTP::gi()->parseFormFieldName('method') ?>': 'ItemSearchByEAN',
                        '<?php echo MLHTTP::gi()->parseFormFieldName('ajax') ?>': true,
                        '<?php echo MLHTTP::gi()->parseFormFieldName('productID') ?>': <?php echo $aProduct['Id'] ?>,
                        '<?php echo MLHTTP::gi()->parseFormFieldName('ean') ?>': newEAN
                    }),
                    dataType: "json",
                    success: function(data) {
                        jqml('#matchingResults_<?php echo $aProduct['Id'] ?>').html(data[0]);
                        if (function_exists("initRadioButtons")) {
                            initRadioButtons('#matchingResults_<?php echo $aProduct['Id'] ?>');
                        }
                        jqml.unblockUI();
                    },
                    error: function() {
                        jqml.unblockUI();
                    }
                });
            }
        });
        jqml('#newEAN_<?php echo $aProduct['Id'] ?>').keypress(function(event) {
            if (event.keyCode == '13') {
                event.preventDefault();
                jqml('#newEANGo_<?php echo $aProduct['Id'] ?>').click();
            }
        });

        jqml('#hitmeister_prepare_match_manual_fieldset_manualmatching').on('change', 'input:radio', function() {
            var me = jqml(this);
            var productId = me.attr('data-id');
            jqml('#match_title_' + productId).val(jqml('#title_' + me.attr('id')).attr('data-id'));
            jqml('#match_ean_' + productId).val(me.attr('data-ean'));
        });

        function initRadioButtons(context) {
            jqml(context + " input[type='radio']:checked").trigger('change');
        }

        jqml('input:radio:checked').trigger('change');
    /*]]>*/
    </script>
</table>
<?php endforeach ?>