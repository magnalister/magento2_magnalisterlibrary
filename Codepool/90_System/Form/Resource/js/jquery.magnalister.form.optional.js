(function($) {
    $(document).ready(function(){
        $(".magnalisterForm").on("change", "select.optional", function(event) {
            var self = $(this);
            var eElement = self.parent().parent().find(">span.optional");
            if (self.val() === "true" || self.hasClass('editable')) {
                eElement.switchClass("hidden", "visible");
                eElement.unblock();
            } else {
                eElement.block({css: {}, message: "", overlayCSS: {cursor: "default", background: "none"}});
                eElement.switchClass("visible", "hidden");
                //deactivate all childs
                eElement.find("select.optional").val("false").trigger("change");
            }
            if (eElement.find("div.optional-default").length) {
                var sShow = self.val() === "true" ? "div.optional-field" : "div.optional-default";
                var sHide = self.val() !== "true" ? 'div.optional-field' : "div.optional-default";
                // cant hide it completely for height of tinymce
                eElement.find(sShow).removeAttr("style").find(":input").attr("disabled", false);
                eElement.find(sHide).css({position: "absolute", left: "-10000px"}).find(":input").attr("disabled", true);
            }
        });
        $(".magnalisterForm").on("change", 'input[type="checkbox"].optional', function(event) {
            var self = $(this);
            var blPositive = self.val() === "true";
            var sVal = ((self.is(":checked") && blPositive) || (!self.is(":checked") && !blPositive)) ? "true" : "false";
            self.siblings("select.optional").val(sVal).trigger("change");
        });
        $(".magnalisterForm select.optional").trigger("change");
    });
})(jqml);