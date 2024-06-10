<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
    <select name="<?php echo MLHTTP::gi()->parseFormFieldName($aField['name']); ?>" <?php echo isset($aField['id']) ? 'id="'.$aField['id'].'"' : '' ?>
        <?php
        if (
            isset($aField['cssclass'])
            || (isset($aField['required']) && empty($aField['value']))
        ) {
            echo 'class="';
            echo isset($aField['cssclass']) ? $aField['cssclass'] : '';
            if (isset($aField['required']) && empty($aField['value'])) {
                echo isset($aField['cssclass']) ? ' ' : '';
                echo 'ml-error';
            }
            echo '"';
        }
        ?>
            style="width:100%;">
        <?php
        $aField['type']='select_optgroup';
        $this->includeType($aField);
        ?>
    </select>
<?php if (isset($aField['i18n']['alert'])) { ?>
    <script type="text/javascript">/*<![CDATA[*/
        (function ($) {
            $(document).ready(function () {
                var previousValue;
                $('<?php echo '#' . $aField['id'] ?>').on('focus', function () {
                    previousValue = this.value;
                }).change(function () {
                    if ($(this).val() === 'auto_fast') {
                        var currentComponent = $('<?php echo '#' . $aField['id'] ?>');
                        $('<div title="<?php echo $aField['i18n']['alert']['headline'] ?>" class="addon_<?php echo $aField['addonsku']; ?>"><?php echo str_replace(array("\n", "\r","'"), array('','',"\\'"), '<div class="ml-addAddonError"></div>'.$aField['i18n']['alert']['content']) ?></div>').dialog({
                            modal: true,
                            width: '600px',
                            close: function(){
                                currentComponent.val(previousValue);
                            },
                            buttons: {
                                "abort": {
                                    text: "<?php echo str_replace('"', '\"', $this->__('ML_BUTTON_LABEL_ABORT')); ?>",
                                    class "abort",
                                    click: function () {
                                        currentComponent.val(previousValue);
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
                                                previousValue = $(currentComponent).val();
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