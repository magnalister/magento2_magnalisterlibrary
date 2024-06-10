(function($) {
    $(document).ready( function() {
        $('.ml-plist').each(function() {
            var eList = $(this);
            //filter
            eList.find('form.js-mlFilter').change(function() {
                //$.blockUI(blockUILoading);
                $(this).submit();
            });
            // grouped table
            var iWaitForAjax=0;
            eList.find('table.ml-plist-table>tbody').each(function() {
                var self = $(this);//current tbody element
                //hide show
                self.on('click','tr.main .switch',function() {
                    var mainSwitch = $(this);
                    if (mainSwitch.find('a').length === 0) {
                        if (self.find('tr.child').is(':hidden')) {
                            mainSwitch.html('&#x25b2;');
                            self.find('tr.child').show();
                            self.find('tr.ml-h-separator').show();
                        } else {
                            mainSwitch.html('&#x25bc;');
                            self.find('tr.child').hide();
                            self.find('tr.ml-h-separator').hide();
                        }
                    } else {
                        var sUrl=mainSwitch.find('a').attr('href');
                        $.blockUI(blockUILoading);
                        $.ajax({
                            url: sUrl,
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                $.unblockUI();
                            },
                            error: function() {
                                $.unblockUI();
                            }
                        });
                        return false;
                    }
                });
                // checkboxes
                self.on('change',"tr.main th input.js-mlFilter-activeRowCheckBox[type='checkbox']", function() {
                    $.blockUI(blockUILoading);
                    var blCheck = $(this).is(':checked');
                    self.find("tr.child td input.js-mlFilter-activeRowCheckBox[type='checkbox']").attr('checked', blCheck);
                    var oCurrentRow = ($(this).parentsUntil('tr.main').parent());
                    sendRow(oCurrentRow);
                    var iInterval = window.setInterval(function() {
                        if (iWaitForAjax === 0) {
                            window.clearInterval(iInterval);
                            $.unblockUI();
                        }
                    }, 400);
                });
                self.on('change',"tr.child td input.js-mlFilter-activeRowCheckBox[type='checkbox']", function(event, data) {
                    if (typeof data === 'undefined' || data.parent !== false) {//setting parent
                        self.find("tr.main th input.js-mlFilter-activeRowCheckBox[type='checkbox']").attr(
                            'checked',
                            self.find("tr.child td input.js-mlFilter-activeRowCheckBox[type='checkbox']").length
                            ===
                            self.find("tr.child td input.js-mlFilter-activeRowCheckBox[type='checkbox']:checked").length
                        );
                    }
                    var oCurrentRow = ($(this).parentsUntil(self.find('tr.child')).parent());
                    sendRow(oCurrentRow);
                });
                self.on('change','tr.child :input', function() {
                    var oCheckBox = $(this).parentsUntil('tr.child').parent().find("td input[type='checkbox']");
                    if (this.tagName.toLowerCase() === 'select') {
                        var sVal = $(this).val();
                        $(this).find("option").removeAttr('selected');
                        $(this).find("option[value='"+sVal+"']").attr('selected','selected');
                    }
                    if (oCheckBox[0] != this) {
                        oCheckBox.attr('checked',true);
                        oCheckBox.trigger('change');
                    }
                });
                
            var sendRow = function(oCurrentRow){
                    var oForm = jqml("<form action=\""+oCurrentRow.attr('data-actiontopform')+"\" method=\"post\">");
                    var blChild = false;
                    self.find('tr.child').each(function() {
                        if (blChild === false && this === oCurrentRow[0]) {
                            blChild = true;
                        }
                    });
                    oForm.append(oCurrentRow.find(':input').clone());
                    $.ajax({
                        url: oForm.attr("action"),
                        type: oForm.attr("method"),
                        data: oForm.serialize(),
                        dataType: 'json',
                        success: function(data) {
                            iWaitForAjax--;
                        },
                        beforeSend: function() {
                            iWaitForAjax++;
                        }
                    });
                }
            });
            //select-action
            eList.find('.actionTop form').change(function (event) {
                $(this).trigger('submit');
            });
        });
    });
})(jqml);