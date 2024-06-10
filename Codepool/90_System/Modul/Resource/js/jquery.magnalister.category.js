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
    var oOptions = {
        
    }
    var oMethods = {
        init : function (options) {
            return this.each(function(){
                $.extend(true, oOptions, options);
                var self = $(this);
                self.find('ul.ml-js-catMatch-tree').on('click', 'a', function(event) {
                    var blLoaded = false;
                    var anchor = $(this);
                    var element = anchor.closest('.ml-js-catMatch-element');
                    var child = element.find('ul.ml-js-catMatch-branch:first');
                    var toggle = element.find('.ml-js-catMatch-toggle:first');
                    if ($.trim(child.html()) !== '') {
                        blLoaded = true;
                    } else {
                        $.blockUI(blockUILoading);
                    }
                    var iInterval = setInterval(//wait for ajax
                        function () {
                            if ($.trim(child.html()) !== '') {
                                $.unblockUI();
                                if (toggle.hasClass('ml-js-catMatch-toggle-plus')) {
                                    toggle.removeClass('ml-js-catMatch-toggle-plus').addClass('ml-js-catMatch-toggle-minus');
                                    child.show('blind');
                                } else {
                                    toggle.removeClass('ml-js-catMatch-toggle-minus').addClass('ml-js-catMatch-toggle-plus');
                                    child.hide('blind');
                                }
                                clearInterval(iInterval);
                            }
                        }, 200
                    );

                    if (toggle.closest('li').hasClass('ml-js-catMatch-element-selectable')) {
                        self.find('input[type=radio]:checked').prop('checked', false);
                        var radio = toggle.find('input[type=radio]');
                        radio.prop('checked', true);
                        self.find('ul.ml-js-catMatch-tree').find('a').css('fontWeight', 'normal');
                        self.find('ul.ml-js-catMatch-tree').find('.ml-js-catMatch-toggle').removeClass('ml-js-catMatch-toggle-tick');
                        var current = toggle.closest('a');
                        while (current = current.parent().closest('.ml-js-catMatch-element')) {//walk tree upstairs
                            if (current.length !== 0) {
                                current.find('.ml-js-catMatch-toggle:first').addClass('ml-js-catMatch-toggle-tick');
                                current.find('.ml-js-catMatch-nameContainer:first>a').css('fontWeight', 'bold');
                            } else {
                                break;
                            }
                        }

                        $(this).closest('table').find('.ml-js-catMatch-visual').html(radio.attr('title'));
                    }

                    return !blLoaded;
                });
                self.find('ul.ml-js-catMatch-tree').on('click', 'label', function(event){
                    var radio = $(this).find('input[type=radio]:checked');
                    var current = radio.closest('label');
                    self.find('ul.ml-js-catMatch-tree').find('label').css('fontWeight', 'normal');
                    self.find('ul.ml-js-catMatch-tree').find('label').css('color', 'black');
                    self.find('ul.ml-js-catMatch-tree').find('.ml-js-catMatch-toggle').removeClass('ml-js-catMatch-toggle-tick');
                    $(this).closest('table').closest('div').parent().find('button').attr('disabled', false);

                    if ($(this).closest('li').hasClass('ml-js-catMatch-element-disabled')) {
                        $(this).css('color', 'red');
                        while(current = current.parent().closest('.ml-js-catMatch-element')) {//walk tree upstairs
                            if (current.length !== 0) {
                                current.find('.ml-js-catMatch-nameContainer:first>a').css('fontWeight', 'bold');
                            } else {
                                break;
                            }
                        }

                        $(this).closest('table').find('.ml-js-catMatch-visual').html('');
                        $(this).closest('table').closest('div').parent().find('button.mlbtnok').attr('disabled', true);
                    } else {
                        $(this).css('fontWeight', 'bold');

                        while(current = current.parent().closest('.ml-js-catMatch-element')) {//walk tree upstairs
                            if (current.length !== 0) {
                                current.find('.ml-js-catMatch-toggle:first').addClass('ml-js-catMatch-toggle-tick');
                                current.find('.ml-js-catMatch-nameContainer:first>a').css('fontWeight', 'bold');
                            } else {
                                break;
                            }
                        }

                        $(this).closest('table').find('.ml-js-catMatch-visual').html(radio.attr('title'));
                    }
                });
            });
        }
    }
    
    $.fn.magnalisterCategory = function(method){
        if ( oMethods[method] ) {
            return oMethods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            oMethods.init.apply( this, arguments );
        } else {
            alert( 'Method ' +  method + ' does not exist on jqml.magnalisterRecursiveAjax' );
        }
    };
    
})(jqml);