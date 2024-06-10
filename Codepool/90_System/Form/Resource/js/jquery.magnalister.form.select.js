/**
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
 * $Id$
 *
 * (c) 2010 - 2015 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
(function ($) {
    $(document).ready(function () {
        $(".magnalisterForm select[data-ml-alert]").each(function () {
            // set loaded value as old value
            $(this).data('ml-oldvalue', $(this).val());
        });
        $(".magnalisterForm").on("change", "select", function (event) {
            var self = $(this);
            /**
             * get data-ml-alert from selected option
             * @var oAlert
             * @example <option data-ml-alert='{"title": "alert title", "content": "alert content"}'>
             */
            var oAlert = self.find(':selected').data('ml-alert');
            if (typeof oAlert !== 'undefined') {
                /**
                 * get button titles from current select element
                 * @var oButtons
                 * @example <select data-ml-alert='{"ok": "ok-button-title", "abort": "abort-button-title"}'>
                 */
                var oButtons = self.data('ml-alert');
                $('<div class="dialog2" title="' + oAlert.title + '">' + oAlert.content + '</div>').dialog({
                    modal: true,
                    width: (window.innerWidth > 1000) ? '580px' : '500px',
                    buttons: [
                        {
                            text: oButtons.abort,
                            click: function () {
                                $(this).dialog("close");
                                self.val(self.data('ml-oldvalue'));
                            }
                        },
                        {
                            text: oButtons.ok,
                            click: function () {
                                $(this).dialog("close");
                                self.data('ml-oldvalue', self.val());
                            }
                        }
                    ]
                });
            } else {
                self.data('ml-oldvalue', self.val());
            }
        });
    });
})(jqml);
