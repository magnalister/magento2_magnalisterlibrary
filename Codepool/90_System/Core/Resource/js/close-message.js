(function($) {
	$(document).ready(function() {
		$(".magna").on("click", ".close-message", function() {
			$(this).closest( "div" ).remove();
            return false;
		});
                
                /*
                 * we hide ml-sw-js-fatalerror message ,because it is not important,customer to see that
                 * we use this message as a fallback if server doesn't have enough memory to resize the image 
                 * -- for some image bigger than 1 MB , php needs a lot of memory ,and magnalister in some laud needs 30 MB of memory , 
                 * and some server face lack of memory in resizing image during magnalister laod , so we resize them by this message in separated proccess--
                 */
                $(".ml-sw-js-fatalerror").parent().hide("slow");
	});
})(jqml);
