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

(function ($) {
    jqml(document).ready(function () {
        jqml('input:radio[name="ml[field][bopis.array.capabilities.operationalconfiguration.usefrommaster]"]')
            .add('input:radio[name="ml[field][bopis.array.capabilities.pickupchannel.operationalconfiguration.usefrommaster]"]')
            .change(function () {
                    bopisHideOrShowSubfields(this)
                }
            );

        jqml('input:radio[name="ml[field][bopis.array.capabilities.issupported]"]')
            .add('input:radio[name="ml[field][bopis.array.capabilities.pickupchannel.issupported]"]')
            .change(function () {
                    bopisHideOrShowSubfields(this, true)
                }
            );

        /**
         * Provide input radio box to hide parent divs close to the element (yes - no radiobuttons)
         * @param field
         */
        function bopisHideOrShowSubfields(field, swapLogic, speed) {
            if (swapLogic === undefined) {
                swapLogic = false;
            }
            if (speed === undefined) {
                speed = 400;
            }

            var hideOnValue = 'yes';
            var showOnValue = 'no';

            // when swapping logic - it do it hide on no instead of yes
            if (swapLogic) {
                hideOnValue = 'no';
                showOnValue = 'yes';
            }
            jqml(field).each(function(){
            if (jqml(this).is(':checked') && jqml(this).val() === hideOnValue) {
                jqml(this).parent().parent().parent().children('div').each(function (index) {
                    // never hide the first one
                    if (index > 0) {
                        $(this).hide(speed);
                    }
                });
            } else if (jqml(this).is(':checked') && jqml(this).val() === showOnValue) {
                jqml(this).parent().parent().parent().children('div').show(speed);
            }
            });
        }
        bopisHideOrShowSubfields('input:radio[name="ml[field][bopis.array.capabilities.issupported]"]:checked', true, 0);
        bopisHideOrShowSubfields('input:radio[name="ml[field][bopis.array.capabilities.pickupchannel.issupported]"]:checked', true, 0);

        bopisHideOrShowSubfields('input:radio[name="ml[field][bopis.array.capabilities.operationalconfiguration.usefrommaster]"]:checked', false, 0);
        bopisHideOrShowSubfields('input:radio[name="ml[field][bopis.array.capabilities.pickupchannel.operationalconfiguration.usefrommaster]"]:checked', false, 0);


    });
})(jqml);
