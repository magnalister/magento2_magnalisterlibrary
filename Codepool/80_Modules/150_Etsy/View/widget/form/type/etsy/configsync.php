<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<?php $this->includeView('widget_form_type_select', get_defined_vars()); ?>

<div id="infoDialogSyncZeroStock" class="dialog2" title="<?php echo MLI18n::gi()->etsy_configform_sync_zerostock_popup_label ?>"></div>
<span id="textSyncZeroStock" style="display: none"><?php echo MLI18n::gi()->etsy_configform_sync_zerostock_popup_text ?></span>

<div id="infoDialogSyncNoZeroStock" class="dialog2" title="<?php echo MLI18n::gi()->etsy_configform_sync_nozerostock_popup_label ?>"></div>
<span id="textSyncNoZeroStock" style="display: none"><?php echo MLI18n::gi()->etsy_configform_sync_nozerostock_popup_text ?></span>

<script type="text/javascript">
    (function ($) {
        $(document).ready(function() {
            var $stockSync = $('#etsy_config_sync_field_stocksync_tomarketplace');
            $stockSync.change(function(){
                var oldValue = $stockSync.defaultValue;

                if ($stockSync.val() === 'auto_zero_stock') {
                    var textStockSync = $('#textSyncZeroStock').html();
                    $('#infoDialogSyncZeroStock').html(textStockSync).jDialog({
                        width: (textStockSync.length > 1000) ? '700px' : '500px',
                        buttons: {
                            '<?php echo addslashes(MLI18n::gi()->get('ML_BUTTON_LABEL_ABORT')); ?>': function() {
                                $(this).dialog('close');
                                $stockSync.val(oldValue);
                            },
                            '<?php echo addslashes(MLI18n::gi()->get('ML_BUTTON_LABEL_ACCEPT')); ?>': function() {
                                $(this).dialog('close');
                            }
                        }
                    });
                } else if ($stockSync.val() === 'auto') {
                    var textNoStockSync = $('#textSyncNoZeroStock').html();
                    $('#infoDialogSyncNoZeroStock').html(textNoStockSync).jDialog({
                        width: (textNoStockSync.length > 1000) ? '700px' : '500px',
                        buttons: {
                            '<?php echo addslashes(MLI18n::gi()->get('ML_BUTTON_LABEL_ABORT')); ?>': function() {
                                $(this).dialog('close');
                                $stockSync.val(oldValue);
                            },
                            '<?php echo addslashes(MLI18n::gi()->get('ML_BUTTON_LABEL_ACCEPT')); ?>': function() {
                                $(this).dialog('close');
                            }
                        }
                    });
                }

            });
        });
    })(jqml);
</script>
