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
if (!class_exists('ML', false))
    throw new Exception();
$marketplaceName = MLModule::gi()->getMarketPlaceName();
$sName = str_replace('field', '', $aField['name']);

// Getting type of tab (is it variation tab or apply form)
$selectorArray = explode('_button', $aField['id']);
$selector = $selectorArray[0];
$selector = $this->aFields[strtolower($selector)]['id'];

$sChangedSelector = ' ' . $selector;
$ini = strpos($sChangedSelector, $marketplaceName . '_prepare_');
if ($ini == 0) return '';
$ini += strlen($marketplaceName . '_prepare_');
$len = strpos($sChangedSelector, '_field', $ini) - $ini;
$tabType = substr($sChangedSelector, $ini, $len);
$buttonValue = isset($aField['value']) ? $aField['value'] : '0';

if ($tabType === 'variations') {
    $id = $marketplaceName . '_prepare_variations_field_saveaction';
} else {
    $id = $marketplaceName . '_prepare_apply_form_field_prepareaction';
}

?>

<button type="button" value="<?php echo $buttonValue ?>" class="mlbtn action"
    <?php echo isset($aField['id']) ? 'id="' . $aField['id'] . '"' : '' ?>
    name="<?php echo MLHTTP::gi()->parseFormFieldName($aField['name']); ?>"
>-</button>

<?php echo isset($aField['i18n']['info']) ? '<span>' . $aField['i18n']['info'] . '</span>' : '' ?>
<script>
    (function ($) {
        $('button[name="<?php echo MLHTTP::gi()->parseFormFieldName($aField['name']);?>"]').click(function () {
            var d = '<?php echo addslashes(MLI18n::gi()->get($marketplaceName . '_prepare_variations_reset_info')) ?>';
            $('<div class="ml-modal dialog2" title="<?php echo addslashes(MLI18n::gi()->get('ML_LABEL_INFO')) ?>"></div>').html(d).jDialog({
                width: (d.length > 1000) ? '700px' : '500px',
                buttons: {
                    Cancel: {
                        'text': <?php echo json_encode(MLI18n::gi()->get('ML_BUTTON_LABEL_ABORT')); ?>,
                        click: function () {
                            $(this).dialog('close');
                        }
                    },
                    Ok: {
                        'text': <?php echo json_encode(MLI18n::gi()->get('ML_BUTTON_LABEL_OK')); ?>,
                        click: function () {
                            var select = $('select[name="ml[field]<?php echo $sName ?>[Code]"]'),
                                form = select.closest('form'),
                                button = $('#<?php echo $id ?>'),
                                buttonInput = $('<input type="hidden">').attr('name', button.attr('name')).val('<?php echo $buttonValue ?>');

                            select.val('');
                            mlSerializer.submitSerializedForm(form, {[button.attr('name')]:'0'});
                            form
                                .append(buttonInput)
                                .submit();
                            $(this).dialog('close');
                        }
                    }
                }
            });
        });
    })(jqml);
</script>
