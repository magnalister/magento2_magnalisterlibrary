(function ($) {
    $(document).ready(function () {
        var iTriggered = 0;
        $('.ml-ebay-itemsearch').each(function () {
            var eSelf = $(this);
            var eTable = eSelf.find('table');
            var eForm = eSelf.find('form');//including radio and search
            var eAjaxReplace = eSelf.find('.js-row-action');//table-body
            var eRadios = eAjaxReplace.find("input[type='radio']");//loaded via ajax
            eRadios.change(function () {
                eTable.trigger('mouseout');
            })
//            var oBlock={message:'',overlayCSS:blockUILoading.overlayCSS};
            eForm.each(function () {

                $('.ml-plist-table').on('submit', '#' + $(this).attr('id'), function (event, sSelector) {

                    var sAddParameter = '';
                    if (
                            typeof sSelector !== 'undefined'
                            ) {
                        $(sSelector).each(function () {
                            var e = $(this);
                            sAddParameter += '&' + e.attr('name') + "=" + e.val();
                        })
                    }
                    var eForm = $(this);
                    eSelf.find('.content').block(blockUILoading);
                    $(".actionBottom [type='submit']").attr('disabled', 'disabled');
                    iTriggered = iTriggered + 1;
                    $.ajax({
                        url: eForm.attr('action'),
                        type: eForm.attr('method'),
                        data: eForm.serialize() + sAddParameter,
                        dataType: 'json',
                        success: function (response) {
                            if (response.success == true) {
                                eSelf.css('background-color', 'inherit');
                                eAjaxReplace.html(response.content);
                                eRadios = eAjaxReplace.find("input[type='radio']");
                                eTable.trigger('mouseout');
                                eRadios.change(function () {
                                    eTable.trigger('mouseout');
                                })
                            } else {
                                eSelf.css('background-color', '#990000');
                                eSelf.attr('title', response.error);
                            }
                            eSelf.find('.content').unblock();
                            if (iTriggered > 0) {
                                iTriggered--;
                            }
                            if (iTriggered == 0) {
                                $(".actionBottom [type='submit']").removeAttr('disabled');
                            }
                        },
                        error: function () {
                            eSelf.find('.content').unblock();
                            if (iTriggered > 0) {
                                iTriggered--;
                            }
                            if (iTriggered == 0) {
                                $(".actionBottom [type='submit']").removeAttr('disabled');
                            }
                        }
                    });
                    return false;
                });
            });
            //sending all hidden forms by load
            eAjaxReplace.each(function () {
                if ($(this).hasClass('startform')) {
                    $(this).parentsUntil('form').trigger('submit');
                }
            });
        });
        $(".actionBottom [type='submit']").on('click', function () {
            var eForm = $(this.form);
            $('.js-row-action').parentsUntil('form').trigger('submit', '#additionalParams :input');
            var iInterval = window.setInterval(function () {
                if (iTriggered === 0) {
                    window.clearInterval(iInterval);
                    window.setTimeout(eForm.trigger('submit'), 3000);
                }
            }, 400);
            return false;
        });
    })
})(jqml);
