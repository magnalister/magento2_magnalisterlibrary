<?php
if (!class_exists('ML', false))
    throw new Exception();
$blValue = array_key_exists('value', $aField) && in_array($aField['value'], array('true', 1, true));
?>
<span class="nowrap">
    <?php if (!array_key_exists('htmlvalue', $aField)) { ?>
        <input id="<?php echo $aField['id'] ?>_hidden" type="hidden" name="<?php echo MLHTTP::gi()->parseFormFieldName($aField['name']) ?>" value="0" />
    <?php } ?>
    <input id="<?php echo $aField['id'] ?>" type="checkbox" name="<?php echo MLHTTP::gi()->parseFormFieldName($aField['name']) ?>" 
           <?php echo $blValue ? 'checked="checked"' : '' ?> value="<?php echo array_key_exists('htmlvalue', $aField) ? $aField['htmlvalue'] : 1 ?>" />
           <?php if (isset($aField['i18n']['valuehint'])) { ?>
        <label for="<?php echo $aField['id'] ?>"><?php echo $aField['i18n']['valuehint'] ?></label>
    <?php } ?>
</span>  
<?php if (isset($aField['i18n']['alert'])) { ?>
    <script type="text/javascript">/*<![CDATA[*/
        (function ($) {
            $(document).ready(function () {
                $('<?php echo '#' . $aField['id'] ?>').click(function () {
                    if ($(this).prop('checked')) {
                        $('<div title="<?php echo addslashes($aField['i18n']['alert']['headline']) ?>" class="addon_<?php echo $aField['addonsku']; ?>"><?php echo str_replace(array("\n", "\r","'"), array('','',"\\'"), '<div class="ml-addAddonError"></div>'.$aField['i18n']['alert']['content']) ?></div>').dialog({
                            modal: true,
                            width: '600px',
                            close: function(){
                                $('<?php echo '#' . $aField['id'] ?>').prop('checked', false);
                            },
                            buttons: {
                                "abort": {
                                    text: "<?php echo str_replace('"', '\"', $this->__('ML_BUTTON_LABEL_ABORT')); ?>",
                                    class: "abort",
                                    click: function () {
                                        $(this).dialog("close");
                                    }
                                },
                                "<?php echo str_replace('"', '\"', $this->__('ML_BUTTON_LABEL_ACCEPT_COSTS')); ?>": function () {
                                    var self = $(this);
                                    $(this).find('.ml-addAddonError').html('');
                                    $.blockUI(blockUILoading);
                                    $.ajax('<?php echo $this->getCurrentUrl(); ?>', {
                                        data: {"<?php echo MLHttp::gi()->parseFormFieldName('method'); ?>": "addAddon", "<?php echo MLHttp::gi()->parseFormFieldName($this->sAjaxPrefix.'[addonsku]') ?>": "<?php echo $aField['addonsku']; ?>"},
                                        dataType : "json",
                                        success : function (data) {
                                            if (typeof data.success === "undefined" || !data.success) {
                                                $.unblockUI();
                                                $('<?php echo '#' . $aField['id'] ?>').prop('checked', false);
                                            } else {
                                                $.unblockUI();
                                                self.dialog("option", "close", function(){});
                                                self.dialog("option", "closeOnEscape", false);
                                                $('.addon_<?php echo $aField['addonsku']; ?>').parent().find('.ui-dialog-titlebar-close').remove();
                                                self.dialog("option", "buttons", {"<?php echo str_replace('"', '\"', $this->__('ML_BUTTON_LABEL_OK')); ?>": function () {
                                                    $(this).dialog("close");
                                                    $('#<?php echo $this->getIdent() ?>').find('[name="<?php echo MLHttp::gi()->parseFormFieldName('action[saveaction]') ?>"]').trigger('click');
                                                }});
                                            }
                                        }
                                    });
                                }
                            }
                        });
                    }
                });
            });
        })(jqml);
    /*]]>*/</script>
<?php } ?>