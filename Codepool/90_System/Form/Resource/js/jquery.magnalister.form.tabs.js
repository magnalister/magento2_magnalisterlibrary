(function ($) {
    $("document").ready(function () {
        $(".ml-js-tab-container").each(function () {
            var controllElements = $(this).find(">.ml-js-tab-container-control > a");
            var contentElements = $(this).find(">.ml-js-tab-container-content > div");
            contentElements.find(".ml-js-toInfo").hide();
            controllElements.on('click', function (event) {
                event.preventDefault();
                controllElements.removeClass('active');
                contentElements.hide();
                var infoTextElement = contentElements.andSelf()
                    .find($(this).addClass("active").attr("href"))
                    .show().addClass("active")
                    .find(".ml-js-toInfo")
                ;
                if (infoTextElement.length) {
                    $(this).closest('tr.js-field').find('td.info').html(infoTextElement.html());
                }
            });
            var interval = window.setInterval(function () {// wait till tinymce's are rendered
                if (
                    typeof tinyMCE === 'undefined'
                    || contentElements.find(".mceEditor").length >= contentElements.find("textarea.tinymce").length
                ) {
                    controllElements.first().trigger('click');
                    window.clearInterval(interval);
                }
            }, 300);
        });
    });
})(jqml);