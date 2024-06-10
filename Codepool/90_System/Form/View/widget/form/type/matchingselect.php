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
// Called from: View/widget/form/type/attributematch.php
/* @var $aField array */
if (!class_exists('ML', false))
    throw new Exception();
$marketplaceName = MLModule::gi()->getMarketPlaceName();

$sUseShopValuesName = str_replace('[Values]', '', $aField['name']);
$sName = str_replace('field', '', $aField['name']);
$sNameWithoutValue = str_replace('[Values]', '', $sName);
$aNameWithoutValue = explode('][', $sNameWithoutValue);
$sFirst = substr($aNameWithoutValue[0], 1);
$sLast = end($aNameWithoutValue);
$sLast = substr($sLast, 0, -1);
$sSelector = MLFormHelper::getPrepareAMCommonInstance()->getSelector($this->aFields, $sFirst, $aNameWithoutValue, $sLast, $aField);
$blDisableFreeText = $aField['valuesdst']['from_mp'];

// Getting type of tab (is it variation tab or apply form)
$sChangedSelector = ' ' . $sSelector;
$ini = strpos($sChangedSelector, $marketplaceName . '_prepare_');
if ($ini == 0) return '';
$ini += strlen($marketplaceName . '_prepare_');
$len = strpos($sChangedSelector, '_field', $ini) - $ini;
$tabType = substr($sChangedSelector, $ini, $len);
$useShopValuesFieldId = null;
if (!$blDisableFreeText) {
    $useShopValuesFieldId = rtrim($sSelector, '_code') . '_useshopvalues';
    $useShopValuesField = array(
        'i18n' => array('valuehint' => MLI18n::gi()->AttributeMatching_AutoMatching_UseShopValue),
        'id' => $useShopValuesFieldId,
        'name' => $sUseShopValuesName . '[UseShopValues]' ,
        'type' => 'bool',
        'value' => isset($aField['useShopValues']) ? $aField['useShopValues'] : true
    );
    $this->includeType($useShopValuesField);
}
?>
<span>
    <table style="width:100%;margin-top: 15px">
        <?php if (!empty($aField['i18n']['matching']['titlesrc']) || !empty($aField['i18n']['matching']['titledst'])) { ?>
        <thead>
            <th style="width: 35%; border-right: 1px solid #dadada;"><?php echo $aField['i18n']['matching']['titlesrc']; ?></th>
            <th style="width: 35%; border-right: 1px solid #dadada;"><?php echo $aField['i18n']['matching']['titledst']; ?></th>
        </thead>
        <?php } ?>
        <tbody>
                <tr>
                    <td style="width: 35%">
                        <?php
                        $aSelect = array(
                            'name' => $aField['name'] . '[0][Shop][Key]',
                            'type' => 'select',
                            'i18n' => array(),
                            'values' => $aField['valuessrc'],
                            'value' => 'noselection'
                        );

                        $aMultiSelect = array(
                            'name' => $aField['name'] . '[0][Shop][Key]',
                            'id' => $aField['name'] . '[ShopMultiSelect]',
                            'classes' => array('mlhidden', 'mlMultipleSelect'),
                            'type' => 'multipleselect',
                            'i18n' => array(),
                            'values' => $aField['valuessrc'],
                            'value' => array(),
                        );

                        $aHidden = array(
                            'type' => 'hidden',
                            'id' => $sSelector . '_hidden_shop_value',
                            'name' => $aField['name'] . '[0][Shop][Value]'
                        );

                        if (isset($aField['error']) && $aField['error'] == true) {
                            $aSelect['cssclass'] = 'error';
                            $aMultiSelect['cssclass'] = 'error';
                        }

                        $aNewArray = array(
                            'noselection' => MLI18n::gi()->get('form_type_matching_select_optional'),
                            'all' => MLI18n::gi()->get('form_type_matching_select_all'),
                            'multiSelect' =>  MLI18n::gi()->get('form_type_matching_multi_select'),
                            'separator_line_3' => MLI18n::gi()->get($marketplaceName . '_prepare_variations_separator_line_label'),
                        );
                        foreach ($aSelect['values'] as $sSelectKey => $sSelectValue) {
                            $aNewArray[$sSelectKey] = $sSelectValue;
                        }

                        if (is_array($aField['values'])) {
                            foreach ($aField['values'] as $aValue) {
                                if (isset($aValue['Shop']['Key']) && !is_array($aValue['Shop']['Key'])) {
                                    unset($aNewArray[$aValue['Shop']['Key']]);
                                }
                            }
                        }
                        
                        $aSelect['values'] = $aNewArray;
                        $this->includeType($aSelect);
                        $this->includeType($aHidden);

                        $shopDataType = isset($aField['shopDataType']) ? $aField['shopDataType'] : 'text';
                        $isShopMultiSelect = MLHelper::gi('Model_Service_AttributesMatching')->isMultiSelectType($shopDataType);
                        ?>
                        <div id="multiselect_shop_<?php echo $sLast ?>" style="width: 100%">
                            <?php
                            if ($isShopMultiSelect) {
                                $this->includeType($aMultiSelect);
                            }
                            ?>
                        </div>
                    </td>
                    <td style="width: 35%">
                        <?php
                            $aSelect = array(
                                'name' => $aField['name'] . '[0][Marketplace][Key]',
                                'type' => 'select',
                                'i18n' => array(),
                                'values' => $aField['valuesdst']['values'],
                                'value' => 'noselection'
                            );

                            $aMultiSelect = array(
                                'name' => $aField['name'] . '[0][Marketplace][Key]',
                                'id' => $aField['name'] . '[MarketPlaceMultiSelect]',
                                'classes' => array('mlhidden', 'mlMultipleSelect'),
                                'type' => 'multipleselect',
                                'i18n' => array(),
                                'values' => $aField['valuesdst']['values'],
                                'value' => array(),
                                'limit' => isset($aField['limit']) ? $aField['limit'] : null,
                            );

                            $aHidden = array(
                                'type' => 'hidden',
                                'id' => $sSelector . '_hidden_marketplace_value',
                                'name' => $aField['name'] . '[0][Marketplace][Value]'
                            );

                            if (isset($aField['error']) && $aField['error'] == true) {
                                $aSelect['cssclass'] = 'error';
                                $aMultiSelect['cssclass'] = 'error';
                            }

                            // Changed because in previous implementation array keys are recreated.
                            $aNewArray = array(
                                'noselection' => MLI18n::gi()->get('form_type_matching_select_optional'),
                            );
                            if($aField['notMatchIsSupported']){
                                $aNewArray += array(
                                    'notmatch' => MLI18n::gi()->get('form_type_matching_select_notmatch'),
                                );
                            }
                            $aNewArray +=  array(
                                'auto' => MLI18n::gi()->get('form_type_matching_select_auto'),
                                'reset' => MLI18n::gi()->get('form_type_matching_select_reset'),
                                'manual' => MLI18n::gi()->get('form_type_matching_select_manual'),
                                'multiSelect' =>  MLI18n::gi()->get('form_type_matching_multi_select'),
                                'separator_line_3' => MLI18n::gi()->get($marketplaceName . '_prepare_variations_separator_line_label'),
                            );

                            foreach ($aSelect['values'] as $sSelectKey => $sSelectValue) {
                                $aNewArray[$sSelectKey] = $sSelectValue;
                            }

                            $aSelect['values'] = $aNewArray;
                            $this->includeType($aSelect);
                            $this->includeType($aHidden);

                            $marketplaceDataType = isset($aField['marketplaceDataType']) ? $aField['marketplaceDataType'] : 'text';
                            $isMPMultiSelect = MLHelper::gi('Model_Service_AttributesMatching')->isMultiSelectType($marketplaceDataType);

                            if ($blDisableFreeText) { ?>
                                <script>
                                    (function($) {
                                        $('#<?php echo $sSelector . '_hidden_marketplace_value';?>').parent().find('select option[value="manual"]').attr('disabled', 'disabled');
                                    })(jqml);
                                </script>
                            <?php }
                        ?>
                        <div id="multiselect_marketplace_<?php echo $sLast ?>" style="width: 100%">
                            <?php
                            if ($isMPMultiSelect) {
                                $this->includeType($aMultiSelect);
                            }
                            ?>
                        </div>
                    </td>
                    <td id="freetext_<?php echo $sLast?>" style="border: none; display: none;">
                        <input type="text" name="ml[field]<?php echo $sName ?>[FreeText]" style="width:100%;">
                    </td>
                    <td style="border: none">
                        <?php if ($tabType === 'variations') {
                            $id = $marketplaceName . '_prepare_variations_field_saveaction';
                        ?>
                            <button type="submit" value="<?php echo $sLast ?>" id="<?php echo $marketplaceName ?>_prepare_variations_field_saveaction"
                                    class="mlbtn action" name="ml[action][saveaction]">+</button>
                        <?php } else {
                            $id = $marketplaceName . '_prepare_apply_form_field_prepareaction';
                        ?>
                            <button type="submit" value="<?php echo $sLast ?>" id="<?php echo $marketplaceName ?>_prepare_apply_form_field_prepareaction"
                                    class="mlbtn action" name="ml[action][prepareaction]">+</button>
                        <?php } ?>
                    </td>
                </tr>
        </tbody>
    </table>

    <?php
    $namesForSelect2 = array();
    $namePart = substr($aField['name'], 5);
    $namesForSelect2[] = 'ml[field]' . $namePart . '[0][Marketplace][Key]';
    $namesForSelect2[] = 'ml[field]' . $namePart . '[0][Shop][Key]';

    ?>
    <script type="text/javascript">/*<![CDATA[*/
        (function($) {
            jqml(document).ready( function() {

                var selectNames = <?php echo json_encode($namesForSelect2) ?>

                jqml.each(selectNames, function (index, value) {
                    jqml('select[name="'+value+'"]').select2({
                        width: 'resolve'
                    });
                })

                // jump to last clicked +/- button on prepare form
                jqml("button[name='ml[action][prepareaction]']").click(function(){
                        var divId = jqml(this).closest('div').attr('id');
                        var action = jqml('#<?php echo $marketplaceName ?>_prepare_apply_form').attr('action');
                        jqml('#<?php echo $marketplaceName ?>_prepare_apply_form').attr('action', action.replace('#' + divId, '') + '#' + divId);
                    });

                // jump to last clicked +/- button on attributes matching form
                jqml("button[name='ml[action][saveaction]']").click(function(){
                        var divId = jqml(this).closest('div').attr('id');
                        var action = jqml('#<?php echo $marketplaceName ?>_prepare_variations').attr('action');
                        jqml('#<?php echo $marketplaceName ?>_prepare_variations').attr('action', action.replace('#' + divId, '') + '#' + divId);
                    });
            });
        })(jqml);
    /*]]>*/</script>
</span>
<?php
    if (!empty($aField['values']) && is_array($aField['values'])) {
        $firstValue = reset($aField['values']);
        if (!empty($firstValue['Marketplace'])) { // !empty(reset($aField['values'])['Marketplace']) is not supported by PHP 5.3
?>
<span id="spanMatchingTable" style="padding-right:2em;">
    <div style="font-weight: bold;">
        <?php echo MLI18n::gi()->get($marketplaceName . '_prepare_variations_matching_table'); ?>
    </div>
    <table id="<?php echo $sSelector ?>_button_matched_table" style="width:100%;">
        <tbody>
        <?php
        $i = 1;
        foreach ($aField['values'] as $sKey => $aValue) {
            //Initialising only some variables before showing attribute dropdowns
            $valueDeletedFromMp = false;
            $checkDeletedFromMp = false === strpos(strtolower($marketplaceDataType), 'text');

            // We cant use $isShopMultiSelect here because attribute type can be multi select but values can still be matched 1-1
            // For example user can auto match all values and add one multiple matching to that list of 1-1 matches
            $isShopMultiValue = !empty($aValue['Shop']['Key']) && is_array($aValue['Shop']['Key']);
            $isMpMultiValue = !empty($aValue['Marketplace']['Key']) && is_array($aValue['Marketplace']['Key']);

            $shopKey = !empty($aValue['Shop']['Key']) ? $aValue['Shop']['Key'] : '';
            $shopValue = $aValue['Shop']['Value'];
            $mpKey = !empty($aValue['Marketplace']['Key']) ? $aValue['Marketplace']['Key'] : '';
            $mpValue = $aValue['Marketplace']['Value'];

            if ($isShopMultiValue) {
                // If multi value for shop is sent key and value will be arrays. Everywhere where they were used
                // as string now their value will be imploded to string.
                $shopKey = implode($aValue['Shop']['Key'], ',');
                $shopValue = implode($aValue['Shop']['Value'], ',');
            }

            if ($isMpMultiValue) {
                // If multi value for shop is sent key and value will be arrays. Everywhere where they were used
                // as string now their value will be imploded to string.
                $mpKey = implode($aValue['Marketplace']['Key'], ',');
                $mpValue = implode($aValue['Marketplace']['Value'], ',');

                // New condition for detecting deleted values from marketplace when multi mp value is sent. Now every string
                // from array will be compared.
                $missingShopValueKeys = array_diff_key(array_flip($aValue['Marketplace']['Key']), $aField['valuesdst']['values']);
                $valueDeletedFromMp = count($missingShopValueKeys) > 0;
            } else {
                $valueDeletedFromMp = !isset($aField['valuesdst']['values'][$aValue['Marketplace']['Key']]);
            }

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

        if ($isShopMultiValue) {
            $aNewFieldShopKey = array(
                'name' => $aField['name'] . '[' . $i . '][Shop][Key]',
                'id' => $sSelector . '_shop_key_' . $i,
                'classes' => array('mlhidden'),
                'type' => 'multipleselect',
                'i18n' => array(),
                'values' => $aField['valuessrc'],
                'value' => $aValue['Shop']['Key']
            );

            $aNewFieldShopValue['value'] = htmlspecialchars(json_encode($aValue['Shop']['Value']));
        }

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
            'type' => 'select',
            'name' => '',// it doesn't need any name for this form input, this field-value will be never used in the process of saving attribute-value, using it makes post query difficult to read
            'id' => $sSelector . '_marketplace_value_select_' . $i,
            'i18n' => array(),
            'value' => $mpKey,
            'values' => array(),
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

        if ($isMpMultiValue) {
            $aNewFieldMarketplaceKey = array(
                'name' => $aField['name'] . '[' . $i . '][Marketplace][Key]',
                'id' => $aField['name'] . '[MarketPlaceMultiSelect]',
                'classes' => array('mlhidden'),
                'type' => 'multipleselect',
                'i18n' => array(),
                'values' => $aField['valuesdst']['values'],
                'value' => $aValue['Marketplace']['Key']
            );

            $aNewFieldMarketplaceValue['value'] = htmlspecialchars(json_encode($aValue['Marketplace']['Value']));
        }
        ?>

            <tr>
                <td style="width: 39.75%">
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
                <td style="width: 39.75%">
                    <?php

                    //here we display one of the row of marketplace-value
                    $this->includeType($aNewFieldMarketplaceKey);
                    $this->includeType($aNewFieldMarketplaceValue);
                    $this->includeType($aNewFieldMarketplaceInfo);
                    $this->includeType($aSelectMarketplaceValue);
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
</span>
<?php
        }
    }
?>

<script>
    (function($) {
        var isShopMultiSelect = <?php echo json_encode($isShopMultiSelect); ?>,
            isMPMultiSelect = <?php echo json_encode($isMPMultiSelect); ?>,
            useShopValueId = <?php echo json_encode($useShopValuesFieldId) ?>;

        $(document).ready(function() {
            $('select option[value="separator_line_3"]').attr('disabled', 'disabled');

            if (!isShopMultiSelect) {
                $('[name="ml[field]<?php echo $sName ?>[0][Shop][Key]"]').find('[value="multiSelect"]').attr('disabled', 'disabled');
            }

            if (!isMPMultiSelect) {
                $('[name="ml[field]<?php echo $sName ?>[0][Marketplace][Key]"]').find('[value="multiSelect"]').attr('disabled', 'disabled');
            }

            if (useShopValueId !== null) {
                var useShopValueSelector = $("#" + useShopValueId);
                if(useShopValueSelector.prop('checked')) {
                    useShopValuesDropdownManipulation(true)
                }
                useShopValueSelector.change(function () {
                    if(this.checked) {
                        useShopValuesDropdownManipulation(true)
                    } else {
                        useShopValuesDropdownManipulation(false)
                    }
                });
            }
        });

        $('[name="ml[field]<?php echo $sName ?>[0][Shop][Key]"]').on('change', function() {
            var val = $('[name="ml[field]<?php echo $sName ?>[0][Shop][Key]"] option:selected').html(),
                shopValue = $('[name="ml[field]<?php echo $sName ?>[0][Shop][Value]"]');

            shopValue.val(val);
            $('td #multiselect_shop_<?php echo $sLast ?>').find('select').hide();

            if ($(this).val() === 'multiSelect') {
                var shopMultiSelect = $('div #multiselect_shop_<?php echo $sLast ?>').find('select');

                shopMultiSelect.show();
                $(shopMultiSelect).change(function() {
                    // When value is changed in shop multi select, value should be formed as array and serialized.
                    // Then it should be set in hidden input for shop value as value.
                    $(shopValue).val(JSON.stringify(formatMultiValues(this)));
                });
            }
        }).trigger('change');

        $('[name="ml[field]<?php echo $sName ?>[0][Marketplace][Key]"]').on('change', function() {
            var val = $('[name="ml[field]<?php echo $sName ?>[0][Marketplace][Key]"] option:selected').html(),
                key = $('[name="ml[field]<?php echo $sName ?>[0][Marketplace][Key]"] option:selected').val(),
                oldValue = $('[name="ml[field]<?php echo $sName ?>[0][Marketplace][Key]"]').defaultValue,
                mpValue = $('[name="ml[field]<?php echo $sName ?>[0][Marketplace][Value]"]');
            if ($(this).val() === 'notmatch') {
                mpValue.val(key);
            } else {
                mpValue.val(val);
            }
            if ($(this).val() === 'reset') {
                var d = '<?php echo addslashes(MLI18n::gi()->get($marketplaceName . '_prepare_variations_reset_info')) ?>';
                $('<div class="ml-modal dialog2" title="<?php echo addslashes(MLI18n::gi()->get('ML_LABEL_INFO')) ?>"></div>').html(d).jDialog({
                    width: (d.length > 1000) ? '700px' : '500px',
                    buttons: {
                        Cancel: {
                            'text': '<?php echo addslashes(MLI18n::gi()->get('ML_BUTTON_LABEL_ABORT')); ?>',
                            click: function() {
                                $('[name="ml[field]<?php echo $sName ?>[0][Marketplace][Key]"]').val(oldValue);
                                $(this).dialog('close');
                            }
                        },
                        Ok: {
                            'text': '<?php echo addslashes(MLI18n::gi()->get('ML_BUTTON_LABEL_OK')); ?>',
                            click: function() {
                                var form = $('[name="ml[field]<?php echo $sName ?>[0][Marketplace][Key]"]').closest('form'),
                                    button = $('#<?php echo $id?>'),
                                    input = $('<input type="hidden">').attr('name', button.attr('name')).val(button.val());

                                form.append(input).submit();
                                // this does not work for some reason...
                                // $('#<?php echo $id?>').trigger('click');
                                $(this).dialog('close');
                            }
                        }
                    }
                });
            }

            if ($(this).val() === 'manual') {
                $('td #freetext_<?php echo $sLast?>').show();
            } else {
                $('td #freetext_<?php echo $sLast?>').hide();
            }

            $('div #multiselect_marketplace_<?php echo $sLast?>').find('select').hide();

            if ($(this).val() === 'multiSelect') {
                var mpMultiSelect = $('div #multiselect_marketplace_<?php echo $sLast ?>').find('select').show();
                $(mpMultiSelect).change(function() {
                    // When value is changed in shop multi select, value should be formed as array and serialized.
                    // Then it should be set in hidden input for shop value as value.
                    $(mpValue).val(JSON.stringify(formatMultiValues(this)));
                });
            }
        });

        // Helper function for forming values array both for shop and marketplace attributes.
        function formatMultiValues(self) {
            var allCheckedValues = [];

            $.each($(self).find('option:checked'), function(index, element) {
                allCheckedValues.push($(element).text());
            });

            return allCheckedValues;
        }

        function useShopValuesDropdownManipulation(checked){
            var shopAttributeSelect = $('select[name="ml[field]<?php echo $sName ?>[0][Shop][Key]"]'),
                marketplaceAttributeSelect = $('select[name="ml[field]<?php echo $sName ?>[0][Marketplace][Key]"]'),
                matchTableSelect =  $('#<?php echo $sSelector ?>_button_matched_table select'),
                matchTableButton =  $('#<?php echo $sSelector ?>_button_matched_table button');

            if (checked) {
                shopAttributeSelect.val('all').trigger('change')
                marketplaceAttributeSelect.val("auto").trigger('change')
                shopAttributeSelect.prop('disabled', true)
                marketplaceAttributeSelect.prop('disabled', true)
                $('button#<?php echo $id ?>[value="<?php echo $sLast ?>"]').prop('disabled', true)
                matchTableSelect.prop('disabled', true)
                matchTableButton.prop('disabled', true)
                shopAttributeSelect.next('.select2-container').addClass('ml-disableElement');
                marketplaceAttributeSelect.next('.select2-container').addClass('ml-disableElement');
                matchTableSelect.addClass('ml-disableElement');
                shopAttributeSelect.next('.select2-container').find('.select2-selection').addClass('ml-transparentBackground');
                marketplaceAttributeSelect.next('.select2-container').find('.select2-selection').addClass('ml-transparentBackground');
            } else {
                shopAttributeSelect.val('noselection').trigger('change')
                marketplaceAttributeSelect.val('noselection').trigger('change')
                marketplaceAttributeSelect.prop('disabled', false)
                shopAttributeSelect.prop('disabled', false)
                $('button#<?php echo $id ?>[value="<?php echo $sLast ?>"]').prop('disabled', false)
                matchTableSelect.prop('disabled', false)
                matchTableButton.prop('disabled', false)
                shopAttributeSelect.next('.select2-container').removeClass('ml-disableElement');
                marketplaceAttributeSelect.next('.select2-container').removeClass('ml-disableElement');
                matchTableSelect.removeClass('ml-disableElement');
                shopAttributeSelect.next('.select2-container').find('.select2-selection').removeClass('ml-transparentBackground');
                marketplaceAttributeSelect.next('.select2-container').find('.select2-selection').removeClass('ml-transparentBackground');
            }
        }
    })(jqml);
</script>

