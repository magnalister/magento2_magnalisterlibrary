(function($) {
    jqml.fn.jDialog = function(parameters, okFunction) {
        if (okFunction == undefined) {
            okFunction = function() {
            };
        }
        if (parameters == undefined) {
            parameters = {};
        }
        parameters = jqml.extend({
            modal: true,
            width: 500,
            minHeight: 100,
            buttons: {
                OK: function() {
                    jqml(this).dialog('close');
                    okFunction();
                }
            }
        }, parameters);
        jqml(this).dialog(parameters);
    }
    jqml(document).ready(function() {

        var bgC = jqml('#content').css('background-color');
        if (bgC.length > 1) {
            jqml('td.boxCenter').css({
                'background-color': bgC
            });
        }
//        $('#globalButtonBox a').click(function() {
//            $.blockUI(blockUILoading);
//        });
    });
    jqml.fn.jDialog = function(parameters, okFunction) {
        if (okFunction == undefined) {
            okFunction = function() {
            };
        }
        if (parameters == undefined) {
            parameters = {};
        }
        parameters = jqml.extend({
            modal: true,
            width: 500,
            minHeight: 100,
            buttons: {
                OK: function() {
                    jqml(this).dialog('close');
                    okFunction();
                }
            }
        }, parameters);
        jqml(this).dialog(parameters);
    }
})(jqml);