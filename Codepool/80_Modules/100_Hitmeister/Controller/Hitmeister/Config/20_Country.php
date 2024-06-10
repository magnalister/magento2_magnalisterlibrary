<?php
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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_ConfigAbstract');

/**
 * Controller to configure country settings.
 */
class ML_Hitmeister_Controller_Hitmeister_Config_Country extends ML_Form_Controller_Widget_Form_ConfigAbstract {
    /**
     * Return the tab title.
     *
     * @return string
     * @throws MLAbstract_Exception
     */
    public static function getTabTitle() {
        return MLI18n::gi()->get('hitmeister_config_country_title');
    }

    /**
     * Return if the tab is active.
     *
     * @return bool
     * @throws Exception
     */
    public static function getTabActive() {
        return self::calcConfigTabActive(__class__, false);
    }

    public function saveAction($blExecute = true) {
        $ret = parent::saveAction($blExecute);
        // set the currency dependent on site
        if ($blExecute) {
            $aCurrencies = $this->callApi(array('ACTION' => 'GetCurrencies'), 3600);
            MLModule::gi()->setConfig('currency', $aCurrencies[MLModule::gi()->getConfig('site')]);
        }
        return $ret;
    }

    protected function callApi($aRequest, $iLifeTime){
        try {
            $aResponse = MagnaConnector::gi()->submitRequestCached($aRequest, $iLifeTime);
            if ($aResponse['STATUS'] == 'SUCCESS' && isset($aResponse['DATA']) && is_array($aResponse['DATA'])) {
                return $aResponse['DATA'];
            } else {
                return array();
            }
        } catch (MagnaException $e) {
            return array();
        }
    }
}
