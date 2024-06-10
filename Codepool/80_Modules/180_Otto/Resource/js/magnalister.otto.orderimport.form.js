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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

(function(jqml) {
    function enableFields(b, activateImport = false) {
        if (b === true) {
            // issue with duplicate button - do not enable duplicate minus button
           jqml("#otto_config_order :input:not(button.mlbtn.fullfont.mlbtnMinus)").prop("disabled", b ? false : true);

            //issue with enabling duplicate - minus button need to reload to sett correct disable value
            if (activateImport) {
               jqml('#otto_config_order').submit();
            }
        } else {
            //we need to disable all fields
           jqml("#otto_config_order :input").prop("disabled", b ? false : true);
        }
        // issue with duplicate button - do not enable duplicate button minus and plus
       jqml("#otto_config_order_field_import_1, #otto_config_order_field_import_0, button:not(button.mlbtn.fullfont.mlbtnMinus):not(button.mlbtn.fullfont.mlbtnPlus)").prop("disabled", false);

    }

   jqml(document).ready(function() {
       jqml('#otto_config_order_field_import_1').click(function() {
            mlShowLoading();
            enableFields(Boolean(Number(jqml(this).val())), true);
        });
       jqml('#otto_config_order_field_import_1, #otto_config_order_field_import_0').click(function() {
            enableFields(Boolean(Number(jqml(this).val())))
        });

        if (jqml("#otto_config_order_field_import_1").is(':checked')) {
            enableFields(true);
        }

        if (jqml("#otto_config_order_field_import_0").is(':checked')) {
            enableFields(false);
        }
    })
})(jqml);


