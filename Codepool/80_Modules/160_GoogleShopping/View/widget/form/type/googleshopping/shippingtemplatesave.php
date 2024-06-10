<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<input class="mlbtn action" type="button" value="<?php echo $this->__('ML_GOOGLESHOPPING_BUTTON_SAVE_SHIPPING_TEMPLATE') ?>" id="saveTemplate"/>
<script type="text/javascript">/*<![CDATA[*/
    jqml(document).ready(function () {
        jqml('#googleshopping_config_prepare_fieldset_prepare_shippingtemplate').hide();
        jqml('#shippingtemplateajax').click(function (e) {
            e.preventDefault();
            jqml('#googleshopping_config_prepare_fieldset_prepare_shippingtemplate').toggle('slow', function () {
                if (jqml(this).is(':visible')) {
                    jqml('#shippingtemplateajax').html('-');
                } else {
                    jqml('#shippingtemplateajax').html('+');
                }
            });
        });

        jqml('#saveTemplate').click(function () {
            var title = jqml('#googleshopping_config_prepare_field_shippingtemplatetitle');
            var originCountry = jqml('#googleshopping_config_prepare_field_shippingtemplatecountry');
            var primaryCost = jqml('#googleshopping_config_prepare_field_shippingtemplateprimarycost');
            var currencyValue = jqml('#googleshopping_config_prepare_field_shippingtemplatecurrencyvalue');
            var secondaryCost = jqml('#googleshopping_config_prepare_field_shippingtemplatetime');
            jqml.blockUI(blockUILoading);
            jqml.post('<?php echo MLHttp::gi()->getCurrentUrl(array('method' => 'SaveShippingTemplate')) ?>',
                {
                    '<?php echo MLSetting::gi()->get('sRequestPrefix')?>':
                        {
                            title: title.val(),
                            originCountry: originCountry.val(),
                            primaryCost: primaryCost.val(),
                            currencyValue: currencyValue.val(),
                            secondaryCost: secondaryCost.val()
                        }
                }
            ).done(function (data) {
                alert("You successfully create delivery profile.");
                jqml.post('<?php echo MLHttp::gi()->getUrl(array('controller' => 'main_tools_filesystem_cache', 'deleteallcache' => true)); ?>')
                    .done(function () {
                        location.reload();
                    });
                title.val("");
                primaryCost.val("");
                currencyValue.val("");
                secondaryCost.val("");
                jqml.unblockUI();
            }).fail(function (data) {
                alert("FATAL ERROR!");
            });
        });
    });
    /*]]>*/</script>
