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
       jqml('#magnaSql').keypress(function(event) {
            if (
                    (event.ctrlKey || event.metaKey)//Mac: CMD + Enter or Win: CTRL + Enter (only fx)
                    && 
                    event.which === 13
            ) {
                this.form.submit();
                return false;
            }
        });
       jqml('#magnaSql').focus();
       jqml("#preparedQuerys li.active").each(function() {
           jqml(this).parent().scrollTop($(this).offset().top -jqml(this).parent().offset().top);
        });
       jqml('#preparedQuerys li').bind('click dblclick', function(event) {
           jqml('#preparedQuerys li').removeClass('active');
           jqml(this).addClass('active');
           jqml('#magnaSql').text(decodeURIComponent($(this).attr('data-sql')).replace(/\+/g, ' '));
            if (event.type === 'dblclick') {
               jqml('#magnaSql')[0].form.submit();
            } else {
               jqml('#magnaSql').focus();
            }
        });
    });
})(jqml);