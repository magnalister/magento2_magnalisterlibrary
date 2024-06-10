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
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
(function($) {
    $(document).ready( function() {
        function TranslationDialog(element, initialData) {
            var self = this,
                wrapperEl = $(element),
                url = [location.protocol, '//', location.host, location.pathname].join(''),
                modalContentTemplate = '\
                    <div class="errorBox"></div> \
                    <form method="post" action="' + url + '"> \
                        <input type="hidden" name="ml[method]" value="save">\
                        <input type="hidden" name="ml[translation][missing_key]" id="ml_translation_missing_key" value="true">\
                        <table class="attributesTable" style="width: 700px"> \
                        <tbody> \
                            <tr class="js-field"> \
                                <th><label for="ml_translation_language">Language</label></th> \
                                <td class="input"><span id="ml_translation_language"></span></td> \
                            </tr> \
                            <tr class="js-field"> \
                                <th><label for="ml_translation_default_text">Default text</label></th> \
                                <td class="input"><span id="ml_translation_default_text"></span></td> \
                            </tr> \
                            <tr class="js-field ml_translation_current_text"> \
                                <th><label for="ml_translation_current_text">Current text</label></th> \
                                <td class="input"><span id="ml_translation_current_text"></span></td> \
                            </tr> \
                            <tr class="js-field"> \
                                <th><label for="ml_translation_new_text">New text</label></th> \
                                <td class="input"> \
                                    <textarea class="fullwidth tinymce" rows="40" name="ml[translation][text]" id="ml_translation_new_text"></textarea>\
                                </td> \
                            </tr> \
                            <tr class="spacer"><td colspan="4"></td></tr> \
                        </tbody> \
                        <tbody> \
                            <tr class="headline"><td colspan="4"><h4>Advanced info</h4></td></tr> \
                            <tr class="js-field"> \
                                <th><label for="ml_translation_key">Key</label></th> \
                                <td class="input"> \
                                    <input type="hidden" name="ml[translation][key]" id="ml_translation_key_input"> \
                                    <span id="ml_translation_key"></span> \
                                </td> \
                            </tr> \
                            <tr class="js-field"> \
                                <th><label for="ml_translation_source">Location</label></th> \
                                <td class="input"> \
                                    <input type="hidden" name="ml[translation][source]" id="ml_translation_source_input"> \
                                    <span id="ml_translation_source"></span> \
                                </td> \
                            </tr> \
                            <tr class="spacer"><td colspan="4"></td></tr> \
                        </tbody> \
                        </table>\
                    </form>\
                ';

            initialData = initialData || $.parseJSON(wrapperEl.find('.data').html());

            function bootstrap() {
                bootstrapContent();
                bootstrapDialog();
            }

            function bootstrapContent() {
                if (wrapperEl.find('form').length === 0) {
                    wrapperEl.append($(modalContentTemplate));
                    wrapperEl.find('form').submit(self.saveAndClose.bind(self));
                }

                self.reset();
            }

            function bootstrapDialog() {
                wrapperEl.dialog($.extend({
                    open: onOpen,
                    close: onClose
                }, self.getModalParameters()));

                wrapperEl.parents('.ui-dialog').find('.ui-dialog-titlebar')
                    .append(wrapperEl.find('.ml-js-ui-dialog-titlebar-additional')
                    .addClass('ml-ui-dialog-titlebar-additional'));
            }

            function onOpen() {
                tinyMCE.init({
                    mode : "exact",
                    elements: "ml_translation_new_text",
                    theme: "advanced",
                    skin : "o2k7",
                    skin_variant : "silver",
                    forced_root_block : '',
                    plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
                    theme_advanced_buttons1 : "undo,redo,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,outdent,indent,|,link,unlink,|,formatselect,fontselect,fontsizeselect",
                    theme_advanced_buttons2 : "",
                    theme_advanced_buttons3 : "",
                    theme_advanced_toolbar_location : "top",
                    theme_advanced_toolbar_align : "left",
                    theme_advanced_statusbar_location : "bottom",
                    theme_advanced_resizing : true,
                    theme_advanced_resize_horizontal : false
                });
            }

            function onClose() {
                tinyMCE.remove(tinyMCE.get('ml_translation_new_text'));
                wrapperEl.find('form').off('submit').remove();
            }

            function resetPlaceholdersContent() {
                wrapperEl.find('.js-field.ml_translation_placeholder').remove();
                if (!initialData.placeholders) {
                    return;
                }

                var placeholderKey,
                    placeholderIndex = 0,
                    placeholdersTemplate = [];

                for (placeholderKey in initialData.placeholders) {
                    if (initialData.placeholders.hasOwnProperty(placeholderKey)) {
                        placeholdersTemplate.push(
                            '<tr class="js-field ml_translation_placeholder">',
                            '<th><label for="ml_translation_placeholder_'+ placeholderIndex +'">' + placeholderKey + '</label></th>',
                            '<td class="input"><span id="ml_translation_placeholder_'+ placeholderIndex +'">' + initialData.placeholders[placeholderKey] + '</span></td>',
                            '</tr>'
                        );
                        placeholderIndex++;
                    }
                }

                $(placeholdersTemplate.join('')).insertBefore(wrapperEl.find('.js-field.ml_translation_current_text'));
            }

            function beforeSave() {
                tinyMCE.triggerSave();
                wrapperEl.find('.errorBox').hide();
            }

            self.saveAndClose = function saveAndClose(event) {
                event.preventDefault();

                beforeSave();

                self.sendSaveRequest(function () {
                    self.close();
                    document.location = document.location;
                });
            };

            self.save = function save(event) {
                event.preventDefault();

                beforeSave();

                self.sendSaveRequest();
            };

            self.sendSaveRequest = function sendSaveRequest(success) {
                $.blockUI(blockUILoading);
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: {
                        "ml[translation][key]": wrapperEl.find('#ml_translation_key_input').val(),
                        "ml[translation][source]": wrapperEl.find('#ml_translation_source_input').val(),
                        "ml[translation][text]": wrapperEl.find('#ml_translation_new_text').val(),
                        "ml[translation][missing_key]": wrapperEl.find('#ml_translation_missing_key').val(),
                        "ml[controller]": "do_i18n",
                        "ml[method]": "save",
                        "ml[ajax]" : "true",
                        "ml[unique]" : ((new Date()).getTime())+':'+(Math.random()+'').replace(/^0\.0*/, '')
                    },
                    success: function(response) {
                        var data = $.parseJSON(response);

                        if (data.success) {
                            if ($.isFunction(success)) {
                                success.call(self, data);
                            }
                            return;
                        }

                        if (data.error) {
                            wrapperEl.find('.errorBox').html(data.error).show();
                        }
                    },
                    error: function() {
                        wrapperEl.find('.errorBox').html('An unexpected error occurred. Please try again later.').show();
                    },
                    complete: function() {
                        $.unblockUI();
                    }
                });
            };

            self.close = function close() {
                wrapperEl.dialog("close");
                wrapperEl.dialog("destroy");
            };

            /**
             * Reset dialog form fields to initial or dialogData data
             *
             * @param dialogData Optional new dialog initialization data
             */
            self.reset = function reset(dialogData) {
                if (dialogData) {
                    initialData = dialogData;
                } else {
                    dialogData = initialData;
                }

                wrapperEl.find('.errorBox').hide();

                wrapperEl.find('#ml_translation_language').html(dialogData.language);
                wrapperEl.find('#ml_translation_default_text').html(dialogData.default_text);
                wrapperEl.find('#ml_translation_current_text').html(dialogData.text);
                wrapperEl.find('#ml_translation_key').html(dialogData.key);
                wrapperEl.find('#ml_translation_source').html(dialogData.source);

                wrapperEl.find('#ml_translation_key_input').val(dialogData.key);
                wrapperEl.find('#ml_translation_source_input').val(dialogData.source);
                wrapperEl.find('#ml_translation_new_text').val(dialogData.text);
                wrapperEl.find('#ml_translation_missing_key').val(dialogData.missing_key);

                if (tinyMCE.get('ml_translation_new_text')) {
                    tinyMCE.get('ml_translation_new_text').load();
                }

                resetPlaceholdersContent();
            };

            bootstrap();
        }

        TranslationDialog.prototype = {
            getModalParameters: function getModalParameters() {
                var self = this;
                return {
                    modal: true,
                    width: 'auto',
                    minHeight: 100,
                    dialogClass: "ml-translate-dialog",
                    title: "Change translation",
                    buttons: [
                        {
                            text: "Save data",
                            class: "mlbtn right action",
                            click: self.saveAndClose.bind(self)
                        },
                        {
                            text: "Reset",
                            class: "mlbtn right" ,
                            click: self.reset.bind(self, null)
                        },
                        {
                            text: "cancel",
                            class: "mlbtn left",
                            click: self.close.bind(self)
                        }
                    ]
                };
            }
        };


        function MultikeyTranslationDialog(element, translationKeysData) {
            var self = this,
                wrapperEl = $(element),
                translationKeys = [],
                activeKey,
                keySelectorEl,
                keySelectorTemplate = [
                    '<tr class="js-field">',
                        '<th><label for="ml_translation_key_selector">Translate</label></th>',
                        '<td class="input"><select name="ml_translation_key_selector" id="ml_translation_key_selector""></select></td>',
                    '</tr>'
                ].join('');

            function bootstrap() {
                setActiveKey();
                setKeySelectorTemplate();

                bootstrapParent();
                insertSelectorInContent();

                attachEventHandlers();
            }

            function setActiveKey() {
                for (var key in translationKeysData) {
                    if (translationKeysData.hasOwnProperty(key)) {
                        translationKeys.push(key);
                    }
                }

                if (translationKeys.length) {
                    activeKey = translationKeys[0];
                }
            }

            function setKeySelectorTemplate() {
                var keyOptionsTemplate = [];
                for (var i = 0; i < translationKeys.length; i++) {
                    keyOptionsTemplate.push('<option value="'+translationKeys[i]+'">'+translationKeysData[translationKeys[i]].text+'</option>');
                }

                keySelectorTemplate = [
                    '<tr class="js-field">',
                        '<th><label for="ml_translation_key_selector">Translate</label></th>',
                        '<td class="input">',
                            '<select name="ml_translation_key_selector" id="ml_translation_key_selector"">',
                                keyOptionsTemplate.join(''),
                            '</select>',
                        '</td>',
                    '</tr>'
                ].join('');
            }

            function bootstrapParent() {
                TranslationDialog.call(self, wrapperEl, translationKeysData[activeKey] || {});
            }

            function insertSelectorInContent() {
                if (wrapperEl.find('form').length) {
                    keySelectorEl = wrapperEl.find('.attributesTable').children(':first-child').prepend(
                        $(keySelectorTemplate)
                    ).find('#ml_translation_key_selector');

                    keySelectorEl.val(activeKey);
                }
            }

            function attachEventHandlers() {
                keySelectorEl.change(onKeySelectorChange);
            }

            function onKeySelectorChange() {
                activeKey = keySelectorEl.val();
                self.reset(translationKeysData[activeKey]);
            }

            bootstrap();
        }

        MultikeyTranslationDialog.prototype = Object.create(TranslationDialog.prototype, {
            getModalParameters: {
                value: function getModalParameters() {
                    var self = this,
                        parameters = TranslationDialog.prototype.getModalParameters.apply(self, arguments);

                    parameters.buttons[0].text = 'Save & close';
                    parameters.buttons.splice(1, 0, {
                        text: "Save",
                        class: "mlbtn right action",
                        click: self.save.bind(self)
                    });

                    return parameters;
                }
            }
        });

        MultikeyTranslationDialog.prototype.constructor = MultikeyTranslationDialog;


        $(".magna").on("click", "[data-ml-translate-modal]", function(event) {
            var wrapperEl, translationData, modal;
            
            wrapperEl = $(this).attr("data-ml-translate-modal");
            translationData = $.parseJSON($(wrapperEl).find('.data').html());

            if (translationData && translationData.translationKeys) {
                modal = new MultikeyTranslationDialog(wrapperEl, translationData.translationKeys);
            } else {
                modal = new TranslationDialog(wrapperEl, translationData);
            }

            event.preventDefault();
            event.stopPropagation();
            return false;
        });

        $("table.globalTranslate").on("click", "tr.headline", function() {
            $(this).closest("table.globalTranslate").find("tr.js-field").toggle();
        });
    });
})(jqml);