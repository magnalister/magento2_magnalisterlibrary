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

(function($) {
    jqml(document).ready(function() {
        var zeichenLimit = 2000;
        function checkCharLimit(tArea) {
            if (tArea.val().length > zeichenLimit) {
                tArea.val(tArea.val().substr(0, zeichenLimit));
            }
            jqml('#charsLeft').html(zeichenLimit - tArea.val().length);
        }
        jqml(document).ready(function() {
            jqml('#item_note').keydown(function(event) {
                myConsole.log('event.which: ' + event.which);
                if ((jqml(this).val().length >= zeichenLimit) &&
                        (event.which != 46) && // del
                        (event.which != 8) && // backspace
                        ((event.which < 37) || (event.which > 40)) // arrow-keys*/
                        ) {
                    myConsole.log('prevent');
                    event.preventDefault();
                }
                return true;
            }).keyup(function(event) {
                checkCharLimit(jqml(this));
                return true;
            });

            checkCharLimit(jqml('#item_note'));
        });
    });
})(jqml);