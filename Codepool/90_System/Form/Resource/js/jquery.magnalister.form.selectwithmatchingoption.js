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

(function ($) {
    jqml(document).ready(function () {
        console.log('enabled');
        jqml('.magnalisterForm').on('change', '.ml-selectwithmatchingoption .ml-translate-toolbar-wrapper select', function () {
            var selectValue = jqml(this).val();

            // Matching
            var parentOfSelect = jqml(this).parents('.ml-selectwithmatchingoption');
            var matchingOptionValue = parentOfSelect.data("matching");
            parentOfSelect = parentOfSelect.parent();

            if (selectValue === matchingOptionValue) {
                parentOfSelect.find('.ml-duplicatematchingoption-' + matchingOptionValue).css("display","block");
            } else {
                parentOfSelect.find('.ml-duplicatematchingoption-' + matchingOptionValue).css("display","none");
            }

            // all other options
            parentOfSelect.find('div[class^=ml-selectwithmatchingoption]').each(function() {
                var optionValue = jqml(this).attr('class').replace('ml-selectwithmatchingoption-', '');
                if (selectValue === optionValue) {
                    parentOfSelect.find('.ml-selectwithmatchingoption-' + optionValue).css("display", "block");
                } else {
                    parentOfSelect.find('.ml-selectwithmatchingoption-' + optionValue).css("display", "none");
                }
            });
        });

        jqml('.magnalisterForm .ml-selectwithmatchingoption .ml-translate-toolbar-wrapper select').trigger('change');
    });
})(jqml);