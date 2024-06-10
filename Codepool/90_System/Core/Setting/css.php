<?php
/**
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
 * $Id$
 *
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
if (ML::isInstalled()) {
    MLSetting::gi()->add('aCss',array(
        'core.css?%s',//%s=clientversion
        'magnalister.css?%s',//%s=clientversion
        'magnalister2.css?%s',//%s=clientversion
        'magnalister.mlbtn.css?%s',//%s=clientversion
        'magnalister.modal.css?%s',
        'magnalister.translation.modal.css?%s',
        'jqueryui/jquery-ui-1.9.1.custom.css?%s',
    ), true);
} else {
    MLSetting::gi()->add('aInstallCss',array(
        'core.css?%s',//%s=clientversion
        'magnalister.modal.css?%s'
    ), true);
}

