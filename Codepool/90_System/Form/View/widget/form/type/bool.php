<?php
if (!class_exists('ML', false))
    throw new Exception();
$blValue = array_key_exists('value', $aField) && in_array($aField['value'], array('true', 1, true));
?>
<span class="nowrap ml-translate-toolbar-wrapper">
    <?php if (!array_key_exists('htmlvalue', $aField)) { ?>
        <input id="<?php echo $aField['id'] ?>_hidden" type="hidden" name="<?php echo MLHTTP::gi()->parseFormFieldName($aField['name']) ?>" value="0" />
    <?php } ?>
    <input id="<?php echo $aField['id'] ?>" type="checkbox" name="<?php echo MLHTTP::gi()->parseFormFieldName($aField['name']) ?>" 
           <?php echo $blValue ? 'checked="checked"' : '' ?> 
           <?php echo isset($aField['disabled']) && $aField['disabled'] ? 'disabled="disabled"' : '' ?>
           value="<?php echo array_key_exists('htmlvalue', $aField) ? $aField['htmlvalue'] : 1 ?>"
           class="<?php echo isset($aField['cssclasses']) ? implode(' ', $aField['cssclasses']) : '' ?>">
           <?php if (isset($aField['i18n']['valuehint'])) { ?>
               <label for="<?php echo $aField['id'] ?>"<?php echo ((isset($aField['required']) && $aField['value'] !== null) ? ' class="ml-error"' : ''); ?>><?php echo $aField['i18n']['valuehint'] ?></label>
               <?php if (MLI18n::gi()->isTranslationActive()) { ?>
                   <div class="ml-translate-toolbar">
                        <a href="#" title="Translate label" class="translate-label abutton" <?php echo 'data-ml-translate-modal="#modal-tr-' . str_replace('.', '\\.', $aField['id']) . '-valuehint"'; ?>>&nbsp;</a>
                        <div class="ml-modal-translate dialog2" id="modal-tr-<?php echo str_replace('.', '\\.', $aField['id']) ?>-valuehint">
                            <script type="text/plain" class="data"><?php echo json_encode(MLI18n::gi()->getTranslationData($aField['id'] . '_valuehint')); ?></script>
                        </div>
                    </div>
               <?php } ?>
           <?php } ?>
</span>  
<?php if (isset($aField['i18n']['alert'])) { 
    $oI18n = MLI18n::gi()?>
    <script type="text/javascript">/*<![CDATA[*/
        (function ($) {
            $(document).ready(function () {
                $('<?php echo '#' . $aField['id'] ?>').click(function (event, rec) {
                    if (typeof rec !== 'undefined' && rec) {
                        return true;
                    } else {
                        var blProp = $(this).prop('checked');//actual state
                        if (!blProp) {
                            return true;
                        } else {
                            var checkbox = $(this);
                            $('<div><?php echo str_replace(array("\n", "\r","'"), array('','',"\\'"), $aField['i18n']['alert']) ?></div>').dialog({
                                modal: true,
                                width: '600px',
                                buttons: {
                                    "<?php echo str_replace('"', '\"', $oI18n->ML_BUTTON_LABEL_ABORT); ?>": function () {
                                        $(this).dialog("close");
                                    },
                                    "<?php echo str_replace('"', '\"', $oI18n->ML_BUTTON_LABEL_OK); ?>": function () {
                                        $(this).dialog("close");
                                        checkbox.trigger('click', true);
                                    }
                                }
                            });
                            return false;
                        }
                    }
                });
            });
        })(jqml);
        /*]]>*/</script>
<?php
}
