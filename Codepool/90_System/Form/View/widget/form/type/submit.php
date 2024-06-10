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

$addConfirm = !empty($aField['i18n']['confirmtext']);
if ($addConfirm) {
    $sType = 'button';
} else {
    $sType = 'submit';
}
$sName = MLHttp::gi()->parseFormFieldName($aField['name']);
?>
<button type="<?php echo $sType ?>" value="1" id="<?php echo $aField['id'] ?>" class="mlbtn<?php echo $sCssClassAdd; ?>"
        name="<?php echo $sName?>"
        <?php echo ((isset($aField['disabled']) && $aField['disabled']) ? ' disabled="disabled"' : '') ?>>
    <?php echo $aField['i18n']['label']?>
</button>
<?php if ($addConfirm) {?>
<script>
    (function ($) {
        $('#<?php echo $aField['id']?>').click(function () {
            var message = '<?php echo addslashes($aField['i18n']['confirmtext']) ?>',
                $btn = $(this);
            $('<div class="ml-modal dialog2" title="<?php echo addslashes($aField['i18n']['label']) ?>"></div>').html(message).jDialog({
                width: (message.length > 1000) ? '700px' : '500px',
                buttons: {
                    "<?php echo str_replace('"', '\"', MLI18n::gi()->ML_BUTTON_LABEL_ABORT); ?>": function () {
                        $(this).dialog('close');
                    },
                    "<?php echo str_replace('"', '\"', MLI18n::gi()->ML_BUTTON_LABEL_OK); ?>": function () {
                        var form = $btn.closest('form');
                        mlSerializer.submitSerializedForm(form, {"<?php echo $sName ?>":'1'});
                    }
                }
            });
        });
    })(jqml);
</script>
<?php }?>