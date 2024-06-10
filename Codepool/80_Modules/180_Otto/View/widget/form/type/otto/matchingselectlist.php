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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

if (!empty($aField['values']) && is_array($aField['values'])) {
        $firstValue = reset($aField['values']);
        if (!empty($firstValue['Marketplace'])) { // !empty(reset($aField['values'])['Marketplace']) is not supported by PHP 5.3

    $marketplaceDataType = isset($aField['marketplaceDataType']) ? $aField['marketplaceDataType'] : 'text';
?>
<span id="spanMatchingTable" style="padding-right:2em;">
    <div style="font-weight: bold; background-color: #e9e9e9">
        <?php echo MLI18n::gi()->get($marketplaceName . '_prepare_variations_matching_table'); ?>
    </div>
    <table id="<?php echo $sSelector ?>_button_matched_table" style="width:100%; background-color: #e9e9e9">
        <tbody>
        <?php
        $i = 1;
        foreach ($aField['values'] as $sKey => $aValue) {
            //Initialising only some variables before showing attribute dropdowns
            $valueDeletedFromMp = false;
            $checkDeletedFromMp = false === strpos(strtolower($marketplaceDataType), 'text');

            $shopKey = !empty($aValue['Shop']['Key']) ? $aValue['Shop']['Key'] : '';
            $shopValue = $aValue['Shop']['Value'];
            $mpKey = !empty($aValue['Marketplace']['Key']) ? $aValue['Marketplace']['Key'] : '';
            $mpValue = $aValue['Marketplace']['Value'];
            $valueDeletedFromMp = !isset($aField['valuesdst']['values'][$aValue['Marketplace']['Key']]);

            // check if value is deleted from marketplace
        if ($mpKey !== 'manual' && $mpKey !== 'notmatch' && $valueDeletedFromMp && $checkDeletedFromMp) {
            ?>
            <tr class="error">
                <td style="width: 35%">
                    <?php echo $shopValue; ?>
                </td>
                <td style="width: 35%">
                    <?php echo MLI18n::gi()->get($marketplaceName . '_varmatch_attribute_value_deleted_from_mp') ?>
                </td>
                <td colspan="2" style="border: none">
                    <?php if ($tabType === 'variations') {
                        ?>
                        <button type="submit" value="<?php echo $sLast ?>"
                                id="<?php echo $marketplaceName ?>_prepare_variations_field_saveaction"
                                class="mlbtn action delete-matched-value" name="ml[action][saveaction]">+</button>
                    <?php } else {
                        ?>
                        <button type="submit" value="<?php echo $sLast ?>"
                                id="<?php echo $marketplaceName ?>_prepare_apply_form_field_prepareaction"
                                class="mlbtn action delete-matched-value" name="ml[action][prepareaction]">+</button>
                    <?php } ?>
                </td>
            </tr>
                <?php
        continue;
        }

        $aNewFieldShopKey = array(
            'type' => 'hidden',
            'id' => $sSelector . '_shop_key_' . $i,
            'name' => $aField['name'] . '[' . $i . '][Shop][Key]',
            'value' => $aValue['Shop']['Key']
        );
        $aNewFieldShopValue = array(
            'type' => 'hidden',
            'id' => $sSelector . '_shop_value_' . $i,
            'name' => $aField['name'] . '[' . $i . '][Shop][Value]',
            'value' => $aValue['Shop']['Value']
        );

        $aNewFieldMarketplaceKey = array(
            'type' => 'hidden',
            'id' => $sSelector . '_marketplace_key_' . $i,
            'name' => $aField['name'] . '[' . $i . '][Marketplace][Key]',
            'value' => $aValue['Marketplace']['Key']
        );
        $aNewFieldMarketplaceValue = array(
            'type' => 'hidden',
            'id' => $sSelector . '_marketplace_value_' . $i,
            'name' => $aField['name'] . '[' . $i . '][Marketplace][Value]',
            'value' => $aValue['Marketplace']['Value']
        );
        $aNewFieldMarketplaceInfo = array(
            'type' => 'hidden',
            'id' => $sSelector . '_marketplace_info_' . $i,
            'name' => $aField['name'] . '[' . $i . '][Marketplace][Info]',
            'value' => $aValue['Marketplace']['Info']
        );
        $aSelectMarketplaceValue = array(
            'type' => 'otto_brand_select',
            'name' => '',// it doesn't need any name for this form input, this field-value will be never used in the process of saving attribute-value, using it makes post query difficult to read
            'id' => $sSelector . '_marketplace_value_select_' . $i,
            'i18n' => array(),
            'value' => $mpKey,
            'values' => array(),
            'cssclasses' => array()
        );

        if($aField['notMatchIsSupported']){
            $aSelectMarketplaceValue['values'] += array('notmatch' => MLI18n::gi()->form_type_matching_select_notmatch,);
        }
        $aSelectMarketplaceValue['values'] += array('freetext' => MLI18n::gi()->get($marketplaceName . '_prepare_variations_free_text'),);

        if($aSelectMarketplaceValue['value'] !== 'notmatch'){
            $aSelectMarketplaceValue['values'] = array(
                $mpKey => $aValue['Marketplace']['Info']
            )
                +
                $aSelectMarketplaceValue['values'];
        }
        ?>

            <tr class="brand-page<?php echo ceil(($sKey+1) / 10); ?>" style="display: none">
                <td style="width: 35%; padding-top: 10px;">
                    <?php
                    /*
                     * After user match a shop-value with mp-value
                     * 2 column will be appeared in bottom of that
                     * left column is Shop-Values
                     * right column is marketplace-value that should sent to the Marketplace
                     * here we display one row of shop-value
                     */
                    $this->includeType($aNewFieldShopKey);
                    $this->includeType($aNewFieldShopValue);
                    echo $shopValue;
                    ?>
                </td>
                <td style="width: 35%" >
                    <?php
                    //here we display one of the row of marketplace-value
                    $this->includeType($aNewFieldMarketplaceKey);
                    $this->includeType($aNewFieldMarketplaceValue);
                    $this->includeType($aNewFieldMarketplaceInfo);
                    $this->includeView('widget_form_type_otto_matched_brand_select2', [
                        'aField' => $aSelectMarketplaceValue, 
                        'marketplaceName' => $marketplaceName, 
                        'sSelector' => $sSelector,
                        'tabType' => $tabType,
                        'sLast' => $sLast,
                        'sName' => $sName
                    ]);
                    ?>
                </td>
                <td id="free_text_extra_<?php echo $sSelector . '_marketplace_value_' . $i ?>"
                    style="border: none; display: none;">
                    <input type="hidden" disabled="disabled" id="hidden_<?php echo $sSelector . '_marketplace_value_' . $i ?>"
                           name="<?php echo 'ml[field]' . $sName . '[' . $i . '][Marketplace][Key]' ?>" value="manual">
                    <input type="text" id="text_for_upload_<?php echo $sSelector . '_marketplace_value_' . $i ?>"
                           style="width:100%;">
                </td>
                <td style="border: none">
                    <?php if ($tabType === 'variations') {
                        ?>
                        <button type="button" value="<?php echo $sLast ?>" class="mlbtn action delete-matched-value"
                                id="<?php echo $sSelector . '_button_delete' . $i ?>"
                                name="ml[action][saveaction]">-</button>
                        <button type="submit" value="<?php echo $sLast ?>" class="mlbtn action"
                                id="<?php echo $sSelector . '_button_add' . $i ?>"
                                name="ml[action][saveaction]">+</button>
                    <?php } else {
                        ?>
                        <button type="button" value="<?php echo $sLast ?>" class="mlbtn action delete-matched-value"
                                id="<?php echo $sSelector . '_button_delete' . $i ?>"
                                name="ml[action][prepareaction]">-</button>
                        <button type="submit" value="<?php echo $sLast ?>" class="mlbtn action"
                                id="<?php echo $sSelector . '_button_add' . $i ?>"
                                name="ml[action][prepareaction]">+</button>
                    <?php } ?>
                </td>
            </tr>

            <script>
                (function ($) {
                    <?php $sName = str_replace('field', '', $aField['name']); ?>
                    var selectEl = $('<?php echo '#' . $sSelector . '_marketplace_value_select_' . $i ?>');
                    $('select[name="<?php echo 'ml[field]' . $sName .
                        '[0][Shop][Key]';?>"] option[value="<?php echo $shopKey ?>"]').hide();

                    $('#<?php echo $sSelector . '_button_add' . $i?>').hide();
                    var previous = {};
                    selectEl.on('focus', function () {
                            // Store the current value on focus and on change
                            previous['<?php echo $sSelector . '_marketplace_value_' . $i?>'] = $(this).val();
                    }).change(function () {
                        if ($(this).val() === "freetext") {
                            $('#<?php echo $sSelector . '_button_delete' . $i?>').hide();
                            $('#<?php echo $sSelector . '_button_add' . $i?>').show();
                            $("td #free_text_extra_<?php echo $sSelector . '_marketplace_value_' . $i?>").show();
                            $("#hidden_<?php echo $sSelector . '_marketplace_value_' . $i?>").removeAttr("disabled");
                        } else if(typeof previous['<?php echo $sSelector . '_marketplace_value_' . $i?>'] !== 'undefined' && previous['<?php echo $sSelector . '_marketplace_value_' . $i?>'] !== $(this).val() && $(this).val() === "notmatch"){
                            $('#<?php echo $sSelector . '_button_delete' . $i?>').hide();
                            $('#<?php echo $sSelector . '_button_add' . $i?>').show();
                            $("td #free_text_extra_<?php echo $sSelector . '_marketplace_value_' . $i?>").hide();
                            $("#hidden_<?php echo $sSelector . '_marketplace_value_' . $i?>").attr("disabled", "disabled");
                            $('#<?php echo $sSelector . '_marketplace_value_' . $i?>').val($(this).val());
                            $('#<?php echo $sSelector . '_marketplace_key_' . $i?>').val($(this).val());
                        } else {
                            $('#<?php echo $sSelector . '_button_delete' . $i?>').show();
                            $('#<?php echo $sSelector . '_button_add' . $i?>').hide();
                            $("td #free_text_extra_<?php echo $sSelector . '_marketplace_value_' . $i?>").hide();
                            $("#hidden_<?php echo $sSelector . '_marketplace_value_' . $i?>").attr("disabled", "disabled");
                        }
                    }).trigger("change");

                    <?php if ($blDisableFreeText) { ?>
                    selectEl.find('option[value="freetext"]').attr('disabled', 'disabled');
                    <?php } ?>

                    $("#text_for_upload_<?php echo $sSelector . '_marketplace_value_' . $i?>").change(function () {
                        var textVal = $("#text_for_upload_<?php echo $sSelector . '_marketplace_value_' . $i?>").val();
                        $('#<?php echo $sSelector . '_marketplace_value_' . $i?>').val(textVal);
                    });
                })(jqml);
            </script>
            <?php $i++;
        } ?>
        </tbody>
    </table>
        <!-- Pagination -->
        <?php $this->includeView('widget_form_type_otto_otto_brands_pagination', ['aField' => $aField, 'paginationPerPage' => 10]); ?>
        <!-- End Pagination -->
</span>
<?php
        }
    }
?>

