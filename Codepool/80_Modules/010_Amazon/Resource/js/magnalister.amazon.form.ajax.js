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
        function fireAjaxRequest(eElement, ajaxAdditional) {
            mlShowLoading();
            var eForm = eElement.parentsUntil('form').parent(),
                aData = jqml(eForm).serializeArray(),
                aAjaxData = $.parseJSON(eElement.attr('data-ajax')),
                aAjaxController = $.parseJSON(eElement.attr('data-ajax-controller')),
                i;

            for (i in aAjaxData) {
                if (aAjaxData[i]['value'] === null) {
                    aAjaxData[i]['value'] = ajaxAdditional;
                }

                aData.push(aAjaxData[i]);
            }
            aData = mlSerializer.prepareSerializedDataForAjax(aData);
            eElement.hide('slide', {direction: 'right'});
            $.ajax({
                url: eForm.attr("action"),
                type: eForm.attr("method"),
                data: aData,
                complete: function(jqXHR, textStatus) {
                    var eRow;
                    try {// need it for ebay-categories and attributes, cant do with global ajax, yet
                        var oJson = $.parseJSON(data);
                        var content = oJson.content;
                        eElement.html(content);
                    } catch (oExeception) {
                    }

                    eRow = eElement.parentsUntil('.js-field').parent();
                    if (eElement.text() !== '') {
                        eRow.show();
                    } else {
                        eRow.hide();
                    }

                    initAjaxForm(eElement, true);
                    updateExistingAjaxFormTrigger(eElement);
                    mlHideLoading();

                    eElement.show('slide', {direction: 'right'});

                    if (aAjaxController.autoTriggerOnLoad) {
                        jqml(eElement).find(aAjaxController.autoTriggerOnLoad.selector).trigger(aAjaxController.autoTriggerOnLoad.trigger);
                    }

                    jqml(".magnalisterForm select.optional").trigger("change");
                }
            });
        }

        function updateExistingAjaxFormTrigger(searcSelectorsOnlyInEl) {
            var eElements = jqml('.magnalisterForm'),
                els = eElements.find('.magnalisterAjaxForm').andSelf();

            els.each(function() {
                var eElement = jqml(this),
                    aAjaxController = $.parseJSON(eElement.attr('data-ajax-controller'));

                if (aAjaxController !== null) {
                    jqml(searcSelectorsOnlyInEl).find(aAjaxController.selector).on(aAjaxController.trigger, function(event) {
                        fireAjaxRequest(eElement, event.ajaxAdditional);
                    });

                    if (eElement.attr('data-ajax-trigger') === 'true') {
                        // only trigger by first load
                        eElement.attr('data-ajax-trigger', 'false');
                        fireAjaxRequest(eElement);
                    }
                }
            });
        }

        function initAjaxForm(eElements, onlyChildren) {
            var els = eElements.find('.magnalisterAjaxForm');
            if (!onlyChildren) {
                els = els.andSelf();
            }

            els.each(function() {
                var eElement = jqml(this),
                    aAjaxController = $.parseJSON(eElement.attr('data-ajax-controller')),
                    selectors = null;

                if (aAjaxController !== null) {
                    if (eElement.find(aAjaxController.selector).length === 0) {
                        selectors = jqml(eElements).find(aAjaxController.selector);
                        selectors.on(aAjaxController.trigger, function(event) {
                            fireAjaxRequest(eElement, event.ajaxAdditional);
                        });
                    } else {
                        selectors = jqml(eElement);
                        selectors.on(aAjaxController.trigger, jqml('.magnalisterForm').find(aAjaxController.selector), function(event) {
                            fireAjaxRequest(eElement, event.ajaxAdditional);
                        });
                    }

                    if (eElement.attr('data-ajax-trigger') === 'true') {
                        // only trigger by first load
                        eElement.attr('data-ajax-trigger', 'false');
                        fireAjaxRequest(eElement);
                    }
                }
            });
        }

        initAjaxForm(jqml('.magnalisterForm'));
    });
})(jqml);
