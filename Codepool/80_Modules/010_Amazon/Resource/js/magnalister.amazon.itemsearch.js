/*
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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

(function($) {
    jqml(document).ready( function() {
        var iTriggered=0;
        jqml('.ml-amazon-itemsearch').each(function(){
            var eSelf=jqml(this);
            var eTable=eSelf.find('table');
            var eForm=eSelf.find('form');//including radio and search
            var eAjaxReplace=eSelf.find('.js-row-action');//table-body
            var eRadios=eAjaxReplace.find("input[type='radio']");//loaded via ajax
            eRadios.change(function(){
                eTable.trigger('mouseout');
            })
//            var oBlock={message:'',overlayCSS:blockUILoading.overlayCSS};
            eForm.submit(function(event,sSelector){
                var sAddParameter='';
                if(
                        typeof sSelector !=='undefined'
                ){
                    jqml(sSelector).each(function(){
                       var e=jqml(this);
                       sAddParameter+='&'+e.attr('name')+"="+e.val();
                   })
                }
                var eForm=jqml(this);
                eSelf.find('.content').block(blockUILoading);
                jqml(".actionBottom [type='submit']").attr('disabled','disabled');
                iTriggered=iTriggered+1;
                $.ajax({
                    url:eForm.attr('action'),
                    type:eForm.attr('method'),
                    data:eForm.serialize()+sAddParameter,
                    dataType:'json',
                    success:function(response){
                        if(response.success==true){
                            eSelf.css('background-color','inherit');
                            eAjaxReplace.html(response.content);
                            eRadios=eAjaxReplace.find("input[type='radio']");
                            eTable.trigger('mouseout');
                            eRadios.change(function(){
                                eTable.trigger('mouseout');
                            })
                        }else{
                            eSelf.css('background-color','#990000');
                            eSelf.attr('title',response.error);
                        }
                        eSelf.find('.content').unblock();
                        if(iTriggered>0){
                            iTriggered--;
                        }
                        if(iTriggered==0){
                            jqml(".actionBottom [type='submit']").removeAttr('disabled');
                        }
                    },
                    error:function(){
                        eSelf.find('.content').unblock();
                        if(iTriggered>0){
                            iTriggered--;
                        }
                        if(iTriggered==0){
                            jqml(".actionBottom [type='submit']").removeAttr('disabled');
                        }
                    }
                });
                return false;
            });
            //sending all hidden forms by load
            eAjaxReplace.each(function(){
                if(jqml(this).hasClass('startform')){
                        jqml(this).parentsUntil('form').trigger('submit');
                }
            });
        });
            jqml(".actionBottom [type='submit']").click(function(){
                var eForm=jqml(this.form);
                jqml('.js-row-action').parentsUntil('form').trigger('submit','#additionalParams :input');
                    var iInterval=window.setInterval(function(){
                        if(iTriggered===0){
                            window.clearInterval(iInterval);
                            window.setTimeout(function () {
                                mlSubmitAmazonManualMatchingForm(eForm)
                            }, 3000);
                        }
                    },400);
                return false;
            });
    })
})(jqml);
