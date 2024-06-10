<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<input class="mlbtn action text" type="button" value="<?php echo $this->__('ML_ETSY_BUTTON_SAVE_SHIPPING_TEMPLATE') ?>"
       id="saveTemplate"/>
<script type="text/javascript">/*<![CDATA[*/

    function getAlertBox(message, type) {
        return '<div class="' + type + 'Box">' +
            '   <table style="width:100%;border-spacing: 0;">' +
            '       <tbody class="hideChild">' +
            '          <tr>' +
            '              <th colspan="7">' + message +
               '                   <a role="button" class="ml-js-noBlockUi close-message" href="#" style="">' +
               '                      <span class="close-message-icon">close</span>' +
               '                   </a>' +
               '              </th>' +
               '         </tr>' +
               '      </tbody>' +
               '   </table>' +
               '</div>';
    }

    function getNoticeBox(message) {
        return getAlertBox(message, 'notice');
    }

    function getSuccessBox(message) {
        return getAlertBox(message, 'success');
    }

    function getErrorBox(message) {
        return getAlertBox(message, 'error');
    }


    jqml(document).ready(function () {

        jqml('#saveTemplate').click(function (e) {

            e.preventDefault();

            var title = jqml("[name='ml[field][shippingprofiletitle]']");
            var originCountry = jqml("[name='ml[field][shippingprofileorigincountry]']");
            var destinationCountry = jqml("[name='ml[field][shippingprofiledestinationcountry]']");
            var destinationRegion = jqml("[name='ml[field][shippingprofiledestinationregion]']");
            var primaryCost = jqml("[name='ml[field][shippingprofileprimarycost]']");
            var secondaryCost = jqml("[name='ml[field][shippingprofilesecondarycost]']");
            var minProcessingTime = jqml("[name='ml[field][shippingprofileminprocessingtime]']");
            var maxProcessingTime = jqml("[name='ml[field][shippingprofilemaxprocessingtime]']");
            var minDeliveryDays = jqml("[name='ml[field][shippingprofilemindeliverydays]']");
            var maxDeliveryDays = jqml("[name='ml[field][shippingprofilemaxdeliverydays]']");
            var originPostalCode = jqml("[name='ml[field][shippingprofileoriginpostalcode]']");

            jqml.blockUI(blockUILoading);
            jqml.post('<?php echo MLHttp::gi()->getCurrentUrl(array('method' => 'SaveShippingProfile')) ?>',
                {
                    '<?php echo MLSetting::gi()->get('sRequestPrefix')?>': {
                        title: title.val(),
                        originCountry: originCountry.val(),
                        destinationCountry: destinationCountry.val(),
                        destinationRegion: destinationRegion.val(),
                        primaryCost: primaryCost.val(),
                        secondaryCost: secondaryCost.val(),
                        minProcessingTime: minProcessingTime.val(),
                        maxProcessingTime: maxProcessingTime.val(),
                        minDeliveryDays: minDeliveryDays.val(),
                        maxDeliveryDays: maxDeliveryDays.val(),
                        originPostalCode: originPostalCode.val()
                    }
                }
            ).done(function (response) {
                window.scrollTo(0, 0);
                jqml.unblockUI(blockUILoading);
                jqml('#shippingprofileajax').click();
            }).fail(function () {
                message.empty().append(getErrorBox('Server error'));
                jqml.unblockUI(blockUILoading);
            });
        });

        jqml('#etsy_config_prepare_fieldset_shippingprofile').hide();
        jqml('#etsy_prepare_apply_form_fieldset_shippingprofile').hide();
        jqml('#shippingprofileajax').click(function (e) {
            e.preventDefault();
            jqml('#etsy_config_prepare_fieldset_shippingprofile').toggle('slow', function () {
                if (jqml(this).is(':visible')) {
                    jqml('#shippingprofileajax').html('-');
                } else {
                    jqml('#shippingprofileajax').html('+');
                }
            });
        });
        jqml('#shippingprofileajax').click(function (e) {
            e.preventDefault();
            jqml('#etsy_prepare_apply_form_fieldset_shippingprofile').toggle('slow', function () {
                if (jqml(this).is(':visible')) {
                    jqml('#shippingprofileajax').html('-');
                } else {
                    jqml('#shippingprofileajax').html('+');
                }
            });
        });
    });
    /*]]>*/</script>