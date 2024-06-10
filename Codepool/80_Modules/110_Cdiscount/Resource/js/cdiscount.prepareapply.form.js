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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
(function($) {
    jqml(document).ready(function() {
        const hideUsedDeliveryModes = function () {
            let allSelectedOptions = jqml("*#cdiscount_prepare_apply_form_field_shippingprofilename").find('option:selected').toArray()
            let selectedDeliveryModes = jqml.map(allSelectedOptions, function (option, i) {
                return jqml(option).val()
            });

            // iterate over dropdowns
            jqml("*#cdiscount_prepare_apply_form_field_shippingprofilename").each(function () {
                // selected option from dropdown
                let selectedOption = jqml(this).find('option:selected')[0]

                // iterate over options of each dropdown
                jqml(this).find('option').each(function(i, option) {
                    if (option === selectedOption) {
                        return true
                    }
                    if (in_array(jqml(option).val(), selectedDeliveryModes)){
                        jqml(option).hide()
                    } else {
                        jqml(option).show()
                    }
                });
            });
        };

        let initialNumberOfDeliveryModes = jqml('#cdiscount_prepare_apply_form_field_shippingprofile_duplicate').children().length

        const checkIfDuplicateFinished = function(selector, callback) {
            if (jqml(selector).children().length > initialNumberOfDeliveryModes) {
                callback();
                initialNumberOfDeliveryModes = jqml('#cdiscount_prepare_apply_form_field_shippingprofile_duplicate').children().length
            } else {
                setTimeout(function() {
                    checkIfDuplicateFinished(selector, callback);
                }, 100);
            }
        };

        hideUsedDeliveryModes()
        jqml(document).on('change', '#cdiscount_prepare_apply_form_field_shippingprofilename', function(){hideUsedDeliveryModes()});
        jqml(document).on('click', '.mlbtn.fullfont.mlbtnPlus', function(){checkIfDuplicateFinished('#cdiscount_prepare_apply_form_field_shippingprofile_duplicate', hideUsedDeliveryModes)})
        jqml(document).on('click', '.mlbtn.fullfont.mlbtnMinus', function(){checkIfDuplicateFinished('#cdiscount_prepare_apply_form_field_shippingprofile_duplicate', hideUsedDeliveryModes)})

    })
})(jqml);
