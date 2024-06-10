(function($) {
    $(document).ready(function() {
        if($('.magna #devBar').length > 0) {
            $('.magnalisterForm').on('dblclick', 'tr.headline', function(event) {
                if(document.selection && document.selection.empty) {
                    document.selection.empty();
                } else if (window.getSelection) {
                    var sel = window.getSelection();
                    sel.removeAllRanges();
                }
                var eRow=$(this);  
                var eRows=eRow.nextUntil('tr.headline').not('tr.spacer');
                // if(eRows.is(':hidden')){
                //     eRow.css('opacity',1);
                //     eRows.show();
                // }else{
                //     eRow.css('opacity',.7);
                //     eRows.hide();
                // }
            });
        }
        $(".magnalisterForm .ml-js-not-editable td.input").block({css: {}, message: "", overlayCSS: {cursor: "default", background: "none"}});
        // copy main-submit button as first-submit-button (hidden element) to set default-focus (eg. return key) on main action
        var eAction = $('.magnalisterForm tr.action > td');
        eAction.prepend(eAction.find('.mlbtn.action').first().clone().css({display: "none"}));
        //seralize form
        $(".magnalisterForm ").on("submit", function (event) {
            event.preventDefault();
            var clickButton = $(this).find("[data-clicked='true']");
            mlSerializer.submitSerializedForm($(this), {[clickButton.attr('name')]: clickButton.val()});
            return false;
        });
    });
})(jqml);