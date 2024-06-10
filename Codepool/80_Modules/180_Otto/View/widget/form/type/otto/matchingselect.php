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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

 if (!class_exists('ML', false))
     throw new Exception();
$marketplaceName = MLModul::gi()->getMarketPlaceName();

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
$brandCurrentPage = 1;
?>
<span>
    <table style="width:100%;margin-top: 15px">
        <tbody>
            <tr>
                <td style="border: 1px solid #dadada"><strong><?php echo addslashes(MLI18n::gi()->get($marketplaceName . '_prepare_variations_shop_value')) ?></strong></td>
                <td style="border: 1px solid #dadada"><strong><?php echo addslashes(MLI18n::gi()->get($marketplaceName . '_prepare_variations_otto_value')) ?></strong></td>
                <td style="border: none; display: none;"></td>
                <td style="border: none; display: none;"></td>
            </tr>
                <tr>
                    <td style="width: 35%">
                        <?php $this->includeView('widget_form_type_otto_s_brand_select2', [
                            'aField' => $aField, 
                            'marketplaceName' => $marketplaceName, 
                            'sSelector' => $sSelector,
                            'tabType' => $tabType,
                            'sLast' => $sLast,
                            'sName' => $sName,
                            'shopKey' => isset($shopKey) ? $shopKey : '',
                            'blDisableFreeText' => $blDisableFreeText
                        ]); ?>
                    </td>

                    <td style="width: 35%">
                        <?php $this->includeView('widget_form_type_otto_mp_brand_select2_refresh', [
                            'aField' => $aField, 
                            'marketplaceName' => $marketplaceName, 
                            'sSelector' => $sSelector,
                            'tabType' => $tabType,
                            'sLast' => $sLast,
                            'sName' => $sName,
                            'blDisableFreeText' => $blDisableFreeText
                        ]); ?>
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
</span>
<!-- Brand list -->
    <?php 
        $this->includeView('widget_form_type_otto_matchingselectlist', [
            'aField' => $aField, 
            'marketplaceName' => $marketplaceName, 
            'sSelector' => $sSelector,
            'tabType' => $tabType,
            'sLast' => $sLast,
            'sName' => $sName,
            'shopKey' => isset($shopKey) ? $shopKey : '',
            'blDisableFreeText' => $blDisableFreeText,
            'marketplaceDataType' => isset($marketplaceDataType) ? $marketplaceDataType : '',
        ]); 
    ?>
<!-- End Brand list -->

<script>
    (function($) {

        $('[name="ml[field]<?php echo $sName ?>[0][Shop][Key]"]').on('change', function() {
            var val = $('[name="ml[field]<?php echo $sName ?>[0][Shop][Key]"] option:selected').html(),
                shopValue = $('[name="ml[field]<?php echo $sName ?>[0][Shop][Value]"]');

            shopValue.val(val);
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

            $('td #freetext_<?php echo $sLast?>').hide();
        });
    })(jqml);


    jqml(document).ready(function() {
        jqml('#refreshBrands').click(function(){
            jqml.blockUI(blockUILoading);
            jqml.get( "<?php echo $this->getCurrentUrl(['ajax' => 'true', 'method' => 'RefreshBrands']); ?>", function( data ) {
                location.reload();
            });
        });
    });
</script>

