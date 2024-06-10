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

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');
/**
 * controller which makes minimal output, installs plugin
 */
class ML_Core_Controller_Install extends ML_Core_Controller_Abstract {
    
    /**
     * constructor, sets variables, prepare min settings 
     * @return ML_Core_Controller_Install
     */
    public function __construct() {
        if (MLSetting::gi()->get('blSaveMode')) {
            MLMessage::gi()->addFatal(MLI18n::gi()->get('ML_TEXT_GENERIC_SAFE_MODE'));
        }
        MLSetting::gi()->aCss = array();
        MLSetting::gi()->aJs = array();
        MLSetting::gi()->aBodyClasses = array();
        return parent::__construct();
    }
}
