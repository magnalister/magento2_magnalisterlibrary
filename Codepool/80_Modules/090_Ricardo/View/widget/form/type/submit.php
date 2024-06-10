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
if (!class_exists('ML', false))
    throw new Exception();
?>
<?php if (
    isset($aField['hiddenifdisabled']) && $aField['hiddenifdisabled']
    && isset($aField['disabled']) && $aField['disabled']
) {
    $aField['type'] = 'hidden';
    $this->includeType($aField);
}
if (isset($aField['realname']) && in_array($aField['realname'], array('prepareaction', 'saveaction'))) {
    $sCssClassAdd = ' action text';
} else {
    $sCssClassAdd = '';
}
?>
<button type="submit" value="1" id="<?php echo $aField['id'] ?>" class="mlbtn<?php echo $sCssClassAdd; ?>" 
        name="<?php echo MLHttp::gi()->parseFormFieldName($aField['name'])?>"
        <?php echo ((isset($aField['disabled']) && $aField['disabled']) ? ' disabled="disabled"' : '') ?>>
    <?php echo $aField['i18n']['label']?>
</button>

<?php if ($aField['id'] === 'ricardo_config_sync_field_saveaction') :?>
<div id="infodiagSyncQuantity" class="dialog2" title="<?php echo MLI18n::gi()->ricardo_label_sync_quantity ?>"></div>
<span id="textQuantity" style="display: none"><?php echo MLI18n::gi()->ricardo_text_quantity ?></span>

<div id="infodiagSyncPrice" class="dialog2" title="<?php echo MLI18n::gi()->ricardo_label_sync_price ?>"></div>
<span id="textPrice" style="display: none"><?php echo MLI18n::gi()->ricardo_text_price ?></span>
<script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            $("#ricardo_config_sync_field_stocksync_tomarketplace").change(function(){
                var oldValue = $('#ricardo_config_sync_field_stocksync_tomarketplace').defaultValue;
                if ($('#ricardo_config_sync_field_stocksync_tomarketplace').val() === 'auto_reduce') {
                    var d = $('#textQuantity').html();
                    $('#infodiagSyncQuantity').html(d).jDialog({
                        width: (d.length > 1000) ? '700px' : '500px',
                        buttons: {
                            '<?php echo ML_BUTTON_LABEL_ABORT; ?>': function() {
                                $(this).dialog('close');
                                $('#ricardo_config_sync_field_stocksync_tomarketplace').val(oldValue);
                            },
                            '<?php echo ML_BUTTON_LABEL_ACCEPT; ?>': function() {
                                $(this).dialog('close');
                            }
                        }
                    });
                }
            });
            $("#ricardo_config_sync_field_inventorysync_price").change(function(){
                var oldValue = $('#ricardo_config_sync_field_inventorysync_price').defaultValue;
                if ($('#ricardo_config_sync_field_inventorysync_price').val() === 'auto_reduce') {
                    var d = $('#textPrice').html();
                    $('#infodiagSyncPrice').html(d).jDialog({
                        width: (d.length > 1000) ? '700px' : '500px',
                        buttons: {
                            '<?php echo ML_BUTTON_LABEL_ABORT; ?>': function() {
                                $(this).dialog('close');
                                $('#ricardo_config_sync_field_inventorysync_price').val(oldValue);
                            },
                            '<?php echo ML_BUTTON_LABEL_ACCEPT; ?>': function() {
                                $(this).dialog('close');
                            }
                        }
                    });
                }
            });
        });
    })(jqml);
</script>
<?php endif; ?>