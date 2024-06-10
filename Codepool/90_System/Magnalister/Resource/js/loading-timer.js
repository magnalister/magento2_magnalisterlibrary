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
(function ($) {
    jqml(window).bind("pageshow", function (event) {
        if (event.originalEvent.persisted) {
            jqml.unblockUI();
        }
    })
    jqml(document).ready(function () {
        jqml("div.magna").on("click submit", "a:not(.abutton, .breadcrumb), form", function (event) {
            var isSafari = /^((?!chrome).)*safari/i.test(navigator.userAgent);
            //isSafari = true; // for testing safari default = commented
            var e = jqml(this);
            if (
                    (e.prop("tagName") === "A" && event.type !== "click") // wrong event
                    || (e.prop("tagName") === "FORM" && event.type !== "submit") // wrong event
                    || e.hasClass(".ml-js-noBlockUi") //noblock
                    || e.closest(".ml-js-noBlockUi").length !== 0 //noblock (because parent)
                    || e.attr('target') === '_blank'
                    ) {
                console.log("unbind (" + e.prop("tagName") + "->" + event.type + ")");
                e.unbind(event);
                return true;
            } else if (event.type === "click") {
                console.log(e.prop("tagName") + "->" + event.type + (isSafari ? "(safari)" : ""));
                if (isSafari) { // Same here.
                    event.preventDefault();
                    var sHref = e.attr("href");
                    jqml.blockUI(jqml.extend(blockUILoading, {
                        onBlock: function () {
                            document.location.href = sHref;
                        }
                    }));
                    return false;
                } else {
                    setTimeout(function () {
                        jqml.blockUI(blockUILoading);
                    }, 1000);
                    return true;
                }
            } else {
                console.log(e.prop("tagName") + "->" + event.type + (isSafari ? "(safari)" : ""));
                if (isSafari) { // Normally you'd expect IE here, but this time Safai is like WTF!
                    event.preventDefault();
                    // Pass the information which button has been pressed. For some forms it is important
                    var eClicked = e.find("[data-clicked='true']");
                    if (
                            eClicked.length
                            && eClicked.attr("name")
                            ) {
                        e.append(jqml("<input>").attr({
                            type: "hidden",
                            name: eClicked.attr("name"),
                            value: eClicked.attr("value")
                        }));
                    }
                    jqml.blockUI(jqml.extend(blockUILoading, {
                        onBlock: function () {
                            e[0].submit();// e[0] => dont trigger jquery again
                        }
                    }));
                    return false;
                } else {
                    setTimeout(function () {
                        jqml.blockUI(blockUILoading);
                    }, 1000);
                    return true;
                }
            }
        });
    });
    
})(jqml);

    function mlShowLoading(){
        jqml.blockUI(blockUILoading);
        numberOfLoading ++;
//        alert(numberOfLoading);
    }
    
    function mlHideLoading(){
        numberOfLoading --;
//        alert(numberOfLoading);
        if(numberOfLoading <= 0){
            jqml.unblockUI();
        }
    }