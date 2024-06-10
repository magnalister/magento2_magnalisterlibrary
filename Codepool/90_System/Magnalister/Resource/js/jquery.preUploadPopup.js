(function($) {
    var settings;
    
    function preUploadPopup(form) {
        var dialogHtml =    '<div id="getitemsfeedialog" class="ml-modal dialog2" title="Information"></div>' + 
                            '<span id="getitemsfeedialogcontent" style="display: none">' + settings.message + '</span>';

        $('#getitemsfeedialog').remove();
        $('#getitemsfeedialogcontent').remove();
                            
        $('html').append(dialogHtml);
        var d = jqml('#getitemsfeedialogcontent').html();

        jqml('#getitemsfeedialog').html(d).jDialog({
            width: (d.length > 1000) ? '700px' : '500px',
            buttons: [
                {
                    id: 'getitemsfeedialog-ok',
                    text: settings.i18n.ok,
                    click: function() {
                        jqml(this).dialog('close');
                        settings.addItems(form);
                    }
                },
                {
                    id: 'getitemsfeedialog-abort',
                    text: settings.i18n.abort,
                    click: function() {
                        jqml(this).dialog('close');
                    }
                }
            ]
        });


    }

    $.fn.configureUploadPopup = function(options) {
        var defaults = {
            addItems: function() {
                alert('Method addItems must be defined.');
            },
            message: null,
            method: 'preUploadPopup',
            i18n: {
                ok: 'Ok',
                abort: 'Abort'
            }
        };

        settings = $.extend({}, defaults, options);

        var form = this.closest('form');

        preUploadPopup(form);
    };
})(jqml)
