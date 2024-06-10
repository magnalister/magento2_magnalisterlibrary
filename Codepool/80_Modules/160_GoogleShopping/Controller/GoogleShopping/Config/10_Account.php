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

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_ConfigAbstract');

class ML_GoogleShopping_Controller_GoogleShopping_Config_Account extends ML_Form_Controller_Widget_Form_ConfigAbstract {

    /**
     * Show title on tab
     *
     * @return mixed
     * @throws MLAbstract_Exception
     */
    public static function getTabTitle() {
        return MLI18n::gi()->get('googleshopping_config_account_title');
    }

    /**
     * @return bool
     */
    public static function getTabActive() {
        return self::calcConfigTabActive(__class__, true);
    }

    /**
     * Send ajax request for token creation link
     */
    public function renderAjax() {
        if ($this->getRequest('what') === 'GetTokenCreationLink') {
            try {
                $result = MagnaConnector::gi()->submitRequest(array(
                    'ACTION' => 'GetTokenCreationLink',
                    'client_id' => $this->getRequest('client_id'),
                    'client_secret' => $this->getRequest('client_secret')
                ));
                $iframeURL = $result['DATA']['tokenCreationLink'];
            } catch (MagnaException $e) {
                $iframeURL = $e->getMessage();
            }
        } else {
            parent::renderAjax();
        }
    }

    public function saveAction($blExecute = true)
    {
        $oParent = parent::saveAction($blExecute);

        if ($blExecute) {
            $sTargetCountry = $this->getRequestField('googleshopping.targetcountry');
            if (MLModule::gi()->getConfig('googleshopping.targetcountry') !== $sTargetCountry) {
                MLDatabase::factory('config')->set('mpid', MLModule::gi()->getMarketPlaceId())->set('mkey', 'googleshopping.language')->delete();
            }
        }

        return $oParent;
    }

}
