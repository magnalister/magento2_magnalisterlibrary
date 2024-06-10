(function($) {
    /**
     * response:{
     *      success:(bool),
     *      error:(bool),
     *      offset:(int),//next request
     *      info:{
     *          current:(int),
     *          total:(int)
     *      }
     *      //additional values can be used by fRequest()
     */
    var blJSError = false;
    var sJsonMessage = '';
    var aStatistic = [];
    var blError, fPercent, fMainPercent, eDialog, eMainElement, async2sync, iTimeStart, iCurrentStep, iSuccessCount;
    var oOptions={
        iInterval            : 500,
        sOffset             : 'offset',
        sAddParam           : '',
        aSteps              : [
//            {sKey:'step',sValue:1,sI18n:'step 1'},
//            {sKey:'step',sValue:2,sI18n:'step 2'},
//            {sKey:'step',sValue:3,sI18n:'step 3'}
        ]
        ,
        oI18n               : {
            sTitle          : null, 
            sProcess        : '',
            sError          : '',
            sErrorLabel     : '',
            sSuccess        : '',
            sSuccessLabel   : '',
            sContent        : '',
            sInfo           : ''
        },
        onResponse          : function(requestData){//user-func after each response
        },
        onProgessBarClick   : function(iStep,iChunk,oRequestData){//click on progressbar
        },
        onFinalize          : function(){//after last chunk
            if(!blError && oOptions.oFinalButtons.oSuccess.length===0){//autoexec
                oMethods.execute();
            }
        },
        oFinalButtons       : {
            oError      : [
                {text:'Ok',click:function(){oMethods.execute();}}
            ],
            oSuccess    : [
//                {text:'success',click:function(){alert('success');}}
            ]
        },
        oDialog             : {
            buttons     : [
//                {text:'ever',click:function(){alert('ever');}}
            ], 
            beforeClose : function(){
                window.clearInterval(async2sync);
                eDialog.find('[data-interval]').each(function(){
                    window.clearInterval($(this).attr('data-interval'));
                });
                blError=true;
                blNext=false;
            }
        },
        blDebug : false,
        sDebugLoopParam : '' //additional paramert, to add to request of loop is clicked
    };      
    var oMethods={
        execute:function(){
            var eElement=oMethods.getMainElement();
                jqml.blockUI(blockUILoading);
                if(eElement.prop('tagName')==='FORM'){
                    eElement[0].submit();
                }else{
                    window.location.href=eElement.attr('href');
                }
        },
        buttonExists: function (button, buttonArray) {
            return buttonArray.some(function (item) {
                return item.class === button.class && item.text === button.text; // Check for similarity based on the 'class' field
            });
        },
        error:function(bl){
            if(typeof bl !=='undefined'){
                blError=bl;
                if(eDialog.find(".successBoxBlue").is(':hidden') || blJSError){//already finished
                    oMethods.finalize();
                }
            }
            return blError;
        },
        content:function(s){
            var eContent=eDialog.find('.content');
            if(typeof s !=='undefined'){
                if(s===''){
                    eContent.removeClass('ui-widget-content');
                }else{
                    eContent.addClass('ui-widget-content');
                }
                eContent.html(s);
            }
            return eContent;
        },
        percent:function(f){
            if(typeof f !=='undefined'){
                var setPercent=function(f,eCurrentStep){
                    if(eCurrentStep.length!==0){
                        var eBar=eCurrentStep.find('.progressPercent');
                        var eText=eCurrentStep.find(".progressBar");
                        var iDuration = new Date().getTime() - iTimeStart;
                        var fOldPercent=eBar.html().replace('%','');
                        var fDiff=f-fOldPercent;
                        if(typeof eCurrentStep.attr('data-percent')!=='undefined' && eCurrentStep.attr('data-percent')<f){//only higher percents
                            window.clearInterval(parseInt(eCurrentStep.attr('data-interval')));
                            eCurrentStep.removeAttr('data-interval');
                        }
                        if(typeof eCurrentStep.attr('data-interval')==='undefined'){
                            var setPercent=window.setInterval(function(){
                                var currentPercent=parseInt(eBar.html().replace('%',''))+1;
                                currentPercent=currentPercent>100?100:currentPercent;
                                f=f>100?100:f;
                                currentPercent=currentPercent>f?f:currentPercent;
                                eBar.html(Math.round(currentPercent)+'%');
                                eText.css('width', currentPercent + "%");
                                if(currentPercent>=f){
                                    eCurrentStep.removeAttr('data-interval');
                                    window.clearInterval(setPercent);
                                    if((eCurrentStep.hasClass('main') || eDialog.find('.progressPercent').length === 1)&&f===100){
                                        oMethods.finalize();
                                    }
                                };
                            },iDuration/fDiff);
                            eCurrentStep.attr('data-percent',f);
                            eCurrentStep.attr('data-interval',setPercent);
                        }
                    }
                };
                fPercent=f>100?100:f;
                setPercent(f,eDialog.find('.progressBarContainer.step-'+iCurrentStep));
                if(oOptions.aSteps.length===0){
                    fMainPercent=fPercent;
                }else{
                    var f0=(100/oOptions.aSteps.length)*iCurrentStep;
                    var f100=(100/oOptions.aSteps.length)*(iCurrentStep+1);
                    fMainPercent=f0+((f100-f0)*fPercent/100);
                }
                setPercent(fMainPercent,eDialog.find('.progressBarContainer.main'));
            }
            return fPercent;
        },
        finalize:function(){
            var blDebugPlay=false;
            if(async2sync!==null){
                window.clearInterval(async2sync);
                blDebugPlay=true;
                async2sync=null;
            }
            eDialog.find('.debug-ajax>.next').attr('disabled', false);
            eDialog.find('.debug-ajax>.play').attr('disabled', false);
            eDialog.find('.debug-ajax>.loop').attr('disabled', true);
            eDialog.find(".successBoxBlue").css("display", "none");
            if( typeof aStatistic.success !== "undefinded") {
                var str = (oOptions.oI18n.sSuccess + "").replace("{1}", aStatistic.success+"").replace("{2}", aStatistic.total+"");
                str += sJsonMessage;
                eDialog.find(".infoBox").html( str +"<br>" +eDialog.find(".infoBox").html());
            }
            if(!blError ){
                eDialog.parent().find("button.button-success").css('display','inline-block');
                eDialog.find(".errorBox").css("display", "none");
                eDialog.find(".successBox").css("display", "block");
            }else{
                eDialog.parent().find("button.button-error").css('display','inline-block');
                eDialog.find(".successBox").css("display", "none");
                eDialog.find(".errorBox").css("display", "block");
            }
            if(blJSError){
                eDialog.find(".infoBox").css("display", "none");
            }else{
                eDialog.find(".infoBox").css("display", "block");
            }
                
            eDialog.parent().find('.ui-dialog-buttonpane').css('display','block');
            if(eDialog.parent().find('.ui-dialog-buttonpane button:visible').length===0){
                eDialog.parent().find('.ui-dialog-buttonpane').css('display','none'); 
            }
            if(!oOptions.blDebug||blDebugPlay){
                oOptions.onFinalize(blError);
            }
        },
        getMainElement:function(){
            return eMainElement;
        },
        init:function(options){
            return this.each(function() {
                $.extend(true,oOptions, options);
                blError=false;
                fPercent=0.00;
                fMainPercent=0.00;
                async2sync=null;
                iCurrentStep=0;
                iSuccessCount = 0;
                iTimeStart=new Date().getTime();
                var aRequestData=[];
                var iOffset = 0;
                var blNext = true;
                eMainElement=$(this);
                while(eMainElement.prop('tagName')!=='FORM'&& eMainElement.prop('tagName')!=='A'){
                    eMainElement=eMainElement.parent();
                }
                oOptions.oI18n.sTitle = eMainElement.attr('title');
                eDialog=(function(){
                    $('#recursiveAjaxDialog').remove();
                    var sHtml = "<div id=\"recursiveAjaxDialog\" class=\"dialog2\" title=\""+oOptions.oI18n.sTitle+"\">"+ 
                                "   <p class=\"successBoxBlue\">"+oOptions.oI18n.sProcess+"</p>"+
                                "   <p class=\"successBox\" style=\"display:none\">"+oOptions.oI18n.sSuccessLabel+"</p>"+
                                "   <p class=\"errorBox\" style=\"display:none\"></p>"+
                                "   <p class=\"requestErrorBox\" style=\"display:none\"></p>";
                    if (typeof oOptions.oI18n.sInfo !== '' ){
                        sHtml += "  <p class=\"infoBox\" style=\"display:none\">" + oOptions.oI18n.sInfo + "</p>";
                    }

                    var fProgressBarTemplate=function(sClassName){
                        var sI18n='';
                        if(sClassName!=='main'){
                            sI18n="<span style='line-height:100%;font-size:.9em;position:absolute;left:.5em;top:0.2em;bottom:0;overflow:visible;white-space:nowrap'>"+oOptions.aSteps[sClassName].sI18n+"</span>";
                            sClassName='step-'+sClassName;
                        }
                        return (
                            "   <div class=\"progressBarContainer "+sClassName+"\" style=\"margin-bottom:1em;\">"+
                            "       <div class=\"progressBar\">"+sI18n+"</div>"+
                            "       <div class=\"progressPercent\">"+oMethods.percent()+"%</div>"+
                            "   </div>"
                        );
                    }
                    if(oOptions.aSteps.length!==1){
                        sHtml+=fProgressBarTemplate('main');
                    }
                    if(oOptions.aSteps.length!==0){
                        for(var i=0;i<oOptions.aSteps.length;i++){
                            sHtml+=fProgressBarTemplate(i);
                        }
                    }
                    if(oOptions.blDebug){
                        sHtml +="<div class=\"debug-ajax\">" ;
                        if (oOptions.sDebugLoopParam!=='') {
                            sHtml += "   <button class=\"button loop\" title=\"loop\"></button>";
                        }
                        sHtml +=
                                "   <button class=\"button next\" title=\"next\"></button>"+
                                "   <button class=\"button play\" title=\"play\"></button>"+
                                "   <button class=\"button pause\" title=\"pause\" disabled=\"disabled\"></button>"+
                                "   <div class=\"ui-dialog-buttonpane ui-widget-content ui-helper-clearfix\">\n" +
                                "</div>"
                        ;
                    }
                    sHtml+= "   <div class=\"ui-helper-clearfix content\"></div>"+
                            "</div>"
                    ;

                    $('html').append(sHtml);
                    var eDialog=$('#recursiveAjaxDialog');
                    eDialog.find(".successBoxBlue").css("display", "block");
                    eDialog.find(".successBox").css("display", "none");
                    eDialog.find(".errorBox").css("display", "none");
                    eDialog.find('.progressPercent').click(function(e){
                        var x = e.pageX - $(this).offset().left;
                        var width=$(this).width();
                        var percent=x*100/width;
                        var eContainer=$(this).parents(".progressBarContainer");
                        if(eContainer.hasClass('main')){
                            for(var iData=0;iData<aRequestData.length;iData++){
                                if(aRequestData[iData].mainPercent>=percent){
                                    oOptions.onProgessBarClick($.extend(true,{chunk:parseInt(iData)}, aRequestData[iData]));
                                    break;
                                }
                            }
                        }else{
                            for(var i=0;i<oOptions.aSteps.length;i++){
                                if(eContainer.hasClass('step-'+i)){
                                    for(var iData=0;iData<aRequestData.length;iData++){
                                        if(aRequestData[iData].percent>=percent&&i===aRequestData[iData].step){
                                            oOptions.onProgessBarClick($.extend(true,{chunk:parseInt(iData)}, aRequestData[iData]));
                                            break;
                                        }
                                    }
                                    break;
                                }
                            }
                        }
                    });
                    if(eDialog.is(":hidden")){
                        for(var sButtonSet in oOptions.oFinalButtons){
                            for(var i=0;i<oOptions.oFinalButtons[sButtonSet].length;i++){
                                oOptions.oFinalButtons[sButtonSet][i].class="button-"+(sButtonSet==='oError'?'error':'success');
                                oOptions.oFinalButtons[sButtonSet][i].style="display:none";
                                if (oMethods.buttonExists(oOptions.oFinalButtons[sButtonSet][i], oOptions.oDialog.buttons) === false) {
                                    oOptions.oDialog.buttons.push(oOptions.oFinalButtons[sButtonSet][i]);
                                }
                            }
                        }
                        if(oOptions.blDebug) {// let user do interactions with debug-bar
                            $.extend( $.ui.dialog.overlay, {
                                events: ''
                            });
                        }
                        eDialog.jDialog(oOptions.oDialog);
                        if(eDialog.parent().find('.ui-dialog-buttonpane button:visible').length===0){
                           eDialog.parent().find('.ui-dialog-buttonpane').css('display','none'); 
                        }
                    }
                    return eDialog;
                })();
                oMethods.content(oOptions.oI18n.sContent);
                oMethods.percent(0,0);
                var fAjax = function() {
                    if(blNext){
                        blNext=false;
                        iTimeStart=new Date().getTime();
                        var sUrl;
                        var sType;
                        var sData;
                        if(eMainElement.prop('tagName')==='FORM'){
                            sUrl=eMainElement.attr("action");
                            sType=eMainElement.attr("method");
                            sData=eMainElement.serialize() + "&"+oOptions.sOffset+"=" + iOffset+ (oOptions.sAddParam===''?'':'&'+oOptions.sAddParam);
                        }else{//A
                            sUrl=eMainElement.attr("href");
                            sType=eMainElement.attr("get");
                            sData=oOptions.sOffset+"=" + iOffset+ (oOptions.sAddParam===''?'':'&'+oOptions.sAddParam);
                        }
                        if(oOptions.aSteps.length>0){
                            sData+='&'+oOptions.aSteps[iCurrentStep].sKey+"="+oOptions.aSteps[iCurrentStep].sValue;
                        }
                        sUrl = sUrl.replace(/^https?:/, window.location.protocol);//protocol should match by current page protocol
                        $.ajax({
                            url: sUrl,
                            type: sType,
                            data: sData,
                            error: function (jqXHR, textStatus, errorThrown) {
                                var json = [];
                                json = {
                                        offset:0,
                                        info:{total:0},
                                        error:true,
                                    };
                                blJSError = true;
                                oMethods.error(true);
                                eDialog.find(".requestErrorBox").html(eDialog.find(".requestErrorBox").html() +   '<br />Status: ' + jqXHR.status + "<br />Error: " + jqXHR.statusText + "<br>" + oOptions.oI18n.sError).css("display", "block");
                                aRequestData.push({step: iCurrentStep, percent: oMethods.percent(), mainPercent: fMainPercent, response: json, request: {url: sUrl, type: sType, data: sData}});
                            },
                            success: function(data) {
                                if(async2sync===null){
                                    eDialog.find('.debug-ajax>.next').attr('disabled', false);
                                    eDialog.find('.debug-ajax>.play').attr('disabled', false);
                                    eDialog.find('.debug-ajax>.loop').attr('disabled', false);
                                }
                                try{
                                    var json = $.parseJSON( data );oOptions.onResponse(data);
                                }catch(err){
                                    var base64decode=function(data){
                                        var b64="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
                                        var o1,o2,o3,h1,h2,h3,h4,bits,i=0,ac=0,dec="",tmp_arr=[];
                                        if(!data){
                                            return data;
                                        } 
                                        data+='';
                                        do{
                                            h1=b64.indexOf(data.charAt(i++));
                                            h2=b64.indexOf(data.charAt(i++));
                                            h3=b64.indexOf(data.charAt(i++));
                                            h4=b64.indexOf(data.charAt(i++));
                                            bits=h1<<18|h2<<12|h3<<6|h4;
                                            o1=bits>>16&0xff;
                                            o2=bits>>8&0xff;
                                            o3=bits&0xff;
                                            if(h3==64){
                                                tmp_arr[ac++]=String.fromCharCode(o1);
                                            }else if(h4==64){
                                                tmp_arr[ac++]=String.fromCharCode(o1,o2);
                                            }else{
                                                tmp_arr[ac++]=String.fromCharCode(o1,o2,o3);
                                            }
                                        }while(i<data.length);
                                        dec=tmp_arr.join('');
                                        return dec;
                                    }
                                    var extractLastMarker=function(c){
                                        var startpos=c.lastIndexOf('{#'),endpos=c.slice(startpos).lastIndexOf('#}');
                                        return c.slice(startpos+2,startpos+endpos);
                                    }
                                    var json={};
                                    try {
                                        var m=extractLastMarker(data);
                                        b=JSON.parse(base64decode(m));
                                        if(typeof b.Complete!='undefined' && b.Complete=='true'){
                                           json.success=true;
                                        }else if(b.Done==b.Total){
                                           json.success=true;
                                        }else{
                                            json={
                                                offset:b.Done,
                                                info:{total:b.Total}
                                            };
                                        }
                                    } catch(e){
                                        json={
                                                offset:0,
                                                info:{total:0},
                                                error:true,
                                            };
                                        blJSError = true;
                                        eDialog.find(".requestErrorBox").html(eDialog.find(".requestErrorBox").html() +  "<br />Json Encoding Error" + "<br>" + oOptions.oI18n.sError).css("display", "block");
                                    }
                                }
                                var eContent = oMethods.content();
                                if (eContent.html() === '') {
                                    eContent.removeClass('ui-widget-content');
                                } else {
                                    eContent.addClass('ui-widget-content');
                                }
                                if (typeof json.error !== "undefined" && json.error === true) {
                                    oMethods.error(true);
                                }
                                if (
                                        (typeof json.success !== "undefined" && json.success === true)
                                        ||
                                        (typeof json.Complete !== "undefined" && json.Complete === "true")
                                ) {
                                    iTimeStart=new Date().getTime();
                                    if (iCurrentStep + 1 === oOptions.aSteps.length || oOptions.aSteps.length === 0) {
                                        oMethods.percent(100);
                                        iOffset = 0;
                                    } else {
                                        oMethods.percent(100);
                                        iOffset = 0;
                                        iCurrentStep++;
                                        oMethods.percent(0);
                                        blNext = true;
                                    }
                                } else {
                                    oMethods.percent(json.offset / json.info.total * 100);
                                    iOffset = json.offset;
                                    blNext = true;
                                }
//                                alert(JSON.stringify(json,null,'\t')/*.replace(/\n/g,'<br>').replace(/\t/g,'&nbsp;&nbsp;&nbsp;')*/);
                                if (typeof json.error === "undefined" || json.error === false) {
                                    iSuccessCount ++;
                                }
                                if(typeof json.info !== "undefined" && typeof json.info.total !== "undefined" && json.info.total > 0){
                                    aStatistic = { 
                                        total : json.info.total,
                                        success : iSuccessCount
                                    };
                                    if(typeof json.message !== "undefined"){
                                        sJsonMessage = json.message;
                                    }
                                        
                                }
                                if (typeof json.success === "undefined" || json.success === false) {
                                    aRequestData.push({step: iCurrentStep, percent: oMethods.percent(), mainPercent: fMainPercent, response: json, request: {url: sUrl, type: sType, data: sData}});
                                }
                            }
                        });
                    }
                };
                if(!oOptions.blDebug){
                    async2sync=window.setInterval(function(){
                        fAjax(); 
                    },oOptions.iInterval);
                }else{
                    eDialog.find('.debug-ajax>.next').click(function() {
                        if (eDialog.find(".successBoxBlue").is(':hidden')) {
                            oOptions.onFinalize(blError);
                        } else {
                            eDialog.find('.debug-ajax>.next').attr('disabled',true);
                            eDialog.find('.debug-ajax>.play').attr('disabled',true);
                            eDialog.find('.debug-ajax>.loop').attr('disabled', true);
                            fAjax();
                        }
                    });
                    eDialog.find('.debug-ajax>.loop').click(function() {
                        var sOrg = oOptions.sAddParam;
                        oOptions.sAddParam += "&"+oOptions.sDebugLoopParam;
                        eDialog.find('.debug-ajax>.next').trigger('click');
                        oOptions.sAddParam = sOrg;
                    });
                    eDialog.find('.debug-ajax>.play').click(function() {
                        eDialog.find('.debug-ajax>.next').attr('disabled',true);
                        if(eDialog.find(".successBoxBlue").is(':hidden')){
                            oOptions.onFinalize(blError);
                        } else {
                            eDialog.find('.debug-ajax>.next').attr('disabled',true);
                            eDialog.find('.debug-ajax>.play').attr('disabled',true);
                            eDialog.find('.debug-ajax>.loop').attr('disabled', true);
                            eDialog.find('.debug-ajax>.pause').attr('disabled',false);
                            async2sync=window.setInterval(function(){
                                fAjax(); 
                            },oOptions.iInterval);
                        }
                    });
                    eDialog.find('.debug-ajax>.pause').click(function() {
                        if(async2sync!==null){
                            window.clearInterval(async2sync);
                            async2sync=null;
                        }
                        eDialog.find('.debug-ajax>.pause').attr('disabled',true);
                        eDialog.find('.debug-ajax>.next').attr('disabled',true);
                        eDialog.find('.debug-ajax>.play').attr('disabled',true);
                        eDialog.find('.debug-ajax>.loop').attr('disabled', true);
                    });
                }
            });
        }
        
    };
    $.fn.magnalisterRecursiveAjax= function(method){
        if ( oMethods[method] ) {
            return oMethods[ method ].apply( this, Array.prototype.slice.call( arguments, 1 ));
        } else if ( typeof method === 'object' || ! method ) {
            oMethods.init.apply( this, arguments );
        } else {
            alert( 'Method ' +  method + ' does not exist on jqml.magnalisterRecursiveAjax' );
        }
    };
})(jqml);