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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
(function($) {
    var helper = {
        displayJsError : function(){
            if(! $('#recursiveAjaxDialog').length){
                if($('.ml-modal .ml-js-mlMessages').length){
                    $('.ml-modal .ml-js-mlMessages').html(window.ml_global_i18n.global_error);
                } else {
                    alert(window.ml_global_i18n.global_error.replace(/<(?:.|\n)*?>/gm, ''));
                }
            }
        },
        jsonDecode : function(data){
            try {
                return $.parseJSON(helper.base64decode(data));
            } catch (oException) {
                try{
                    return $.parseJSON(data);
                }catch(e){
                    helper.displayJsError();
                }
            }
        },
        base64decode : function(response) {
            var startpos = response.lastIndexOf("{#"), 
                endpos = response.slice(startpos).lastIndexOf("#}")
            ;
            if ( startpos === -1 || endpos === -1){
                throw ("no lastbase");
            }
            var data = response.slice(startpos + 2, startpos + endpos);
            /* @var string data last "{#(.*)#}" of response */
            if (!data) {
                return data;
            }
            var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
            var o1, o2, o3, h1, h2, h3, h4, bits, i = 0, ac = 0, dec = "", tmp_arr = [];
            data += "";
            do {
                h1 = b64.indexOf(data.charAt(i++));
                h2 = b64.indexOf(data.charAt(i++));
                h3 = b64.indexOf(data.charAt(i++));
                h4 = b64.indexOf(data.charAt(i++));
                bits = h1 << 18 | h2 << 12 | h3 << 6 | h4;
                o1 = bits >> 16 & 0xff;
                o2 = bits >> 8 & 0xff;
                o3 = bits & 0xff;
                if (h3 === 64) {
                    tmp_arr[ac++] = String.fromCharCode(o1);
                } else if (h4 === 64) {
                    tmp_arr[ac++] = String.fromCharCode(o1, o2);
                } else {
                    tmp_arr[ac++] = String.fromCharCode(o1, o2, o3);
                }
            } while (i < data.length);
            dec = tmp_arr.join("");
            return dec;
        },
        manipulateDom: function(config, color){
            var element, content, action;
            for (var selector in config) {
                if (config[selector] === null) {
                    continue;
                }
                element = $(".magna "+selector);
                if (element.length > 0) {
                    if (typeof config[selector] === "object") {
                        content = config[selector].content;
                        action = config[selector].action;
                    }else{
                        content = config[selector];
                        action = "html";
                    }
                    switch(action){
                        case "appendifnotexists" :
                        case "append" : {
                            var blBottom = element.scrollTop() + 20 >= element.get(0).scrollHeight - element.height();                            
                            if (action === "append" || element.html().indexOf($("<div>"+content+"</div>").html()) === -1) { // make as element to have propper html
                                element.append(content);
                            }
                            if (blBottom && element.get(0).scrollHeight > element.height()){
                                element.scrollTop(element.get(0).scrollHeight);
                            }
                            break;
                        }
                        case "prepend" : {
                            element.prepend(content);
                            break;
                        }
                        case 'setvalue': {
                            element.val(content);
                            break;
                        }
                        default : {
                            element.html(content);
                        }
                    }
                    if (typeof color !== "undefined" && typeof element.effect !== "undefined") {
                        if ($.inArray(element.prop("tagName"), ["TABLE", "TBODY", "THEAD", "TR"]) !== -1) {
                            element = element.find("td, th");
                        }
                        element.effect("highlight", {color : color}, 3000);
                    }
                }
            }
        },
        ajax : function(url, type, data, ml){
            if (typeof url !== "undefined") {
                $.extend(data, $('[data-mlNeededFormFields]').data('mlneededformfields'), {
                    "ml[ajax]" : "true", 
                    "ml[unique]" : ((new Date()).getTime())+':'+(Math.random()+'').replace(/^0\.0*/, '') // cache-fix
                });
                console.dir(data);
                console.dir(ml);
                $.ajax({
                    url : url.replace(/^https?:/, window.location.protocol),//protocol should match by current page protocol
                    type : type,
                    data : data,
                    ml : ml,
                    error : function(jqXHR, textStatus, errorThrown ) {
                        console.log(textStatus+": "+errorThrown);
                        if (typeof ml.retryOnError !== 'undefined' && ml.retryOnError) {
                            console.log("retry...");
                            $.ajax({
                                url : url.replace(/^https?:/, window.location.protocol),//protocol should match by current page protocol
                                type : type,
                                data : data,
                                ml : ml,
                                error : function(jqXHR, textStatus, errorThrown ) {
                                    console.log(textStatus+": "+errorThrown);
                                    helper.displayJsError();
                                }
                            });
                        }
                    }
                });
            }
        }
    };
    $(document).ready( function() {
        $.ajaxSetup({
            dataFilter: function(data, dataType){
                try{
                    data = helper.base64decode(data);
                }catch(oEx){
                    //no base64 ({#(.*)#})
                }
                return data;
            }    
        });
        
        /**
         * register to submit button click function, to add
         * them parameter to ajax-request, jquery dont do it in serialize
         */
        $(".magna").on("click", "form [type=submit]", function(){
            $(this).attr("data-clicked", "true");
        });
        
        /**
         * register to all elements with class global-ajax ajax-request
         */
        $(".magna").on("click submit", ".global-ajax", function(event) {
            var element = $(this);
            var data = {};
            var ml = {};
            if (typeof element.data('ml-global-ajax') !== "undefined") {
                var aConfig = element.data('ml-global-ajax');
                if (typeof aConfig.triggerAfterSuccess !== "undefined") {
                    if (aConfig.triggerAfterSuccess === "currentUrl") {
                        ml.triggerAfterSuccess = function() {
                            document.location = document.location;
                        }
                    }
                }
                if (typeof aConfig.retryOnError !== "undefined") {
                    ml.retryOnError = aConfig.retryOnError;
                }
            }
            if (event.type === "submit" && element.prop("tagName") === 'FORM') { 
                //serializeArray return all data as an array with integer index and whole element object
                //but here we need an array with index that made by name of element 
                //using just serializeArray was problematic 
                //http://stackoverflow.com/questions/1184624/convert-form-data-to-js-object-with-jquery#answer-17784656
                element.serializeArray().map(function(x){data[x.name] = x.value;}); 
                var eClickElement=$(this).find("[data-clicked]");
                if (eClickElement.attr('name')) {
                    $.extend(data, {name : eClickElement.attr('name'), value : eClickElement.val()});
                    eClickElement.removeAttr('data-clicked');
                }
                helper.ajax(element.attr("action"), element.attr("method"), data, ml);
                return false;
            } else if (event.type === "click" && element.prop("tagName") === 'A') {
                helper.ajax(element.attr("href"), "get", data, ml);
                return false;
            } else {
                return true;
            }
        });
        /**
         * manipulates dom by ajax-result
         */
        $(document).ajaxSuccess(function( event, xhr, settings, data ) {
            var ml = { //ml own setting, will be same in all requests
                triggerAfterSuccess : function(){ // will be triggered on recursive success, if there is no 'Next' or 'Redirect' response
                }
            };
            $.extend(ml, settings.ml);
            try {
                var oJson = helper.jsonDecode(xhr.responseText);
                if (typeof oJson === "object" && oJson) {
                    if (
                        typeof oJson.plugin !== "undefined"
                        && typeof oJson.plugin.dom !== "undefined"
                    ) {
                        var color;
                        if(typeof oJson.success !== "undefined"){
                            color = oJson.success ? "#cfc" : "#900";
                        }
                        helper.manipulateDom(oJson.plugin.dom, color);
                    }
                    if (typeof oJson.Next !== "undefined") {
                        helper.ajax(oJson.Next, settings.type, {}, settings.ml);
                    } else if (typeof oJson.Redirect !== "undefined") {
                        document.location = oJson.Redirect;
                    } else if (
                        typeof oJson.success !== "undefined"
                        && oJson.success === true
                    ) {
                        ml.triggerAfterSuccess();
                    }
                }
            } catch(oException) {
                console.log(oException); 
            }
        });
    });
})(jqml);