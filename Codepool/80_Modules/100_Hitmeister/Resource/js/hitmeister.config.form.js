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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

(function ($) {
    $(document).ready(function () {
        $('#hitmeister_config_price_field_minimumpriceautomatic').on('change', function () {
            if ($(this).val() === '2') {
                $(this).parent().parent().next().show();
                $(this).parent().parent().next().next().show();
            } else {
                $(this).parent().parent().next().hide();
                $(this).parent().parent().next().next().hide();
            }
        });

function changeCurrencyOnSiteChange() {
    // All EU + EFTA + GB (for the future), EUR is default
    let sites = ['bg', 'cz', 'ch', 'dk', 'hu', 'is', 'no', 'pl', 'ro', 'se', 'uk', 'gb'];
    let currencies = ['BGN', 'CZK', 'CHF', 'DKK', 'HUF', 'ISK', 'NOK', 'PLN', 'RON', 'SEK', 'GBP', 'GBP'];
    var i = 0 ;
    var currencyFound = false ;
    while (sites[i] != undefined) {
        if ($('#hitmeister_config_account_field_site').val() === sites[i]) {
            $('#hitmeister_config_account_field_site').parent().parent().next().children(":first").next().next().html(currencies[i]);
            currencyFound = true ;
            break;
        }
        i++;
    }
    if (currencyFound == false) {
        $('#hitmeister_config_account_field_site').parent().parent().next().children(":first").next().next().html('EUR');
    }
    // Timeout needed, cos on('change') doesn't catch the event when we click "abort"
    // on the alert and the site goes back to previous
    setTimeout(function() { changeCurrencyOnSiteChange(); }, 500);
}

        $('#hitmeister_config_account_field_site').on('change', function () {
              changeCurrencyOnSiteChange() ;
        });
    });
})(jqml);

