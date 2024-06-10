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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('ErrorLog_Controller_Widget_ErrorLog_Abstract');

class ML_GoogleShopping_Controller_GoogleShopping_ErrorLog extends ML_ErrorLog_Controller_Widget_ErrorLog_Abstract {

    /**
     * @return mixed
     */
    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_GENERIC_ERRORLOG');
    }

    /**
     * @return bool
     */
    public static function getTabActive() {
        return MLModule::gi()->isConfigured();
    }

    /**
     * @return $this|ML_Core_Controller_Abstract
     */
    public function render() {
        $this->getErrorLogWidget();
        return $this;
    }
}
