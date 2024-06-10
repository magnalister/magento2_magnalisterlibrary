(function($) {
    $(document).ready(function() {
        var interval;
        $('#devBar>.magnaTabs2>ul>li>a').hover(
            function () {
                clearInterval(interval);
                if (!$('#devBar').hasClass('static')) {
                    $('#devBar>.devContent>*').hide();
                    $('#devBar>.devContent>' + $(this).attr('href')).show();
                    if($('#devBar>.devContent').attr('data-style')){
                        $('#devBar>.devContent').attr('style',$('#devBar>.devContent').attr('data-style'));
                    }
                }
            },
            function () {
                clearInterval(interval);
                if (!$('#devBar').hasClass('static')) {
                    interval = setInterval(function() {
                        if ($('#devBar>.devContent:hover').length === 0) {
                            $('#devBar>.devContent>*').hide();
                            $('#devBar>.devContent').attr('data-style',$('#devBar>.devContent').attr('style'));
                            $('#devBar>.devContent').removeAttr('style');
                            clearInterval(interval);
                        }
                    }, 300);
                }
            }
        );
        $('#devBar').on('click','.magnaTabs2>ul>li>a',function () {
            if ($(this).closest('.magnamain').attr('id') === 'devBar' ){
                if ($('#devBar').hasClass('static')) {
                    if ('#' + $('#devBar>.devContent>*:visible').attr('id') === $(this).attr('href')) {
                        $('#devBar').removeClass('static');
                    }
                    $('#devBar>.devContent>*').hide();
                    $('#devBar>.devContent>' + $(this).attr('href')).show();
                } else {
                    clearInterval(interval);
                    $('#devBar').addClass('static');
                }
                $('#devBar>.magnaTabs2>ul>li').removeClass('selected');
                if ($('#devBar').hasClass('static')) {
                    $(this).parent().addClass('selected');
                }
            }else{
                $(this).closest('ul').find('li').removeClass('selected');
                $(this).closest('li').addClass('selected');
                $(this).closest('.magnamain').find('.devContent>*').hide();
                $(this).closest('.magnamain').find('.devContent>'+$(this).attr('href')).show().find('li.selected>a').trigger('click');
                $(this).closest('.magnamain').find('.devContent>'+$(this).attr('href')+' .magnaTabs2').each(function(){
                    if($(this).find('li.selected').length===0){
                        $(this).find('li:first>a').trigger('click');
                    }
                });
            }
            return false;
        });
        $('#devBar').on('click','#debug-ajax>.magnaTabs2>ul>li>a>sup',function () {
            var e=$(this).closest('.magnaTabs2');
            $(this).closest('.magnamain').find('.devContent>'+$(this).parent().attr('href')).remove();
            $(this).closest('li').remove();
            e.find('li:first>a').trigger('click')
        });
        $('#devBar a[href="#devBar-ajax"]').dblclick(function () {
            $('#devBar #devBar-ajax a>sup').trigger('click');
            
        });
        $( document ).ajaxComplete(function ( event, xhr, settings ) {
            if(
                $('#debug-ajax>.magnaTabs2>ul>li.selected').length===0
            ){
                $('#debug-ajax>.magnaTabs2>ul>li:last>a').trigger('click');
            }
            if ($('#debug-ajax>.magnaTabs2>ul>li').length > 50) {//max n ajax-tabs - browser memory
                var eLi=$('#debug-ajax>.magnaTabs2>ul>li');
                for (var i in eLi) {
                    var eCurrentLi=$(eLi[i]);
                    if (!eCurrentLi.hasClass('selected')) {
                        $(eCurrentLi.find('a').attr('href')).remove();
                        eCurrentLi.remove();
                       break;
                    }
                }
            }
        });
    });
})(jqml);