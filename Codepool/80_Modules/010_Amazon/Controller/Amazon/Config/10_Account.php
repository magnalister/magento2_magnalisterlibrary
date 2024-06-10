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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_ConfigAbstract');

class ML_Amazon_Controller_Amazon_Config_Account extends ML_Form_Controller_Widget_Form_ConfigAbstract {

    public static function getTabTitle() {
        return MLI18n::gi()->get('amazon_config_account_title');
    }

    public static function getTabActive() {
        return self::calcConfigTabActive(__class__, true);
    }

    public function saveAction($blExecute = true) {
        $merchantDetails = MLModule::gi()->getMerchantDetails(true);
        MLMessage::gi()->addDebug('merchantDetails', $merchantDetails);

        // Set Module Config
        MLModule::gi()->setConfig('merchantid', isset($merchantDetails['MWSMerchantID']) ? $merchantDetails['MWSMerchantID'] : "");
        MLModule::gi()->setConfig('marketplaceid', isset($merchantDetails['MWSMarketplaceID']) ? $merchantDetails['MWSMarketplaceID'] : "");
        MLModule::gi()->setConfig('site', isset($merchantDetails['MWSSite']) ? $merchantDetails['MWSSite'] : "");
        MLModule::gi()->setConfig('spapitoken', isset($merchantDetails['AccessToken']) ? '__saved__' : "");

        if ($blExecute) {
            MLModule::gi()->setConfig('currency', $this->getCurrencyOfAmazonSite());
        }
        return parent::saveAction($blExecute);
    }

    /**
     * @return string
     * @throws Exception
     */
    protected function getCurrencyOfAmazonSite() {
        $merchantDetails = MLModule::gi()->getMerchantDetails();
        if (isset($merchantDetails['MWSSite'])) {
            $aCurrencies = MLModule::gi()->getCurrencies();
            if (isset($merchantDetails['MWSSite'])) {
                return $aCurrencies[$merchantDetails['MWSSite']];
            } else if (isset($this->aRequestFields['site'])) {
                return $aCurrencies[$this->aRequestFields['site']];
            }
        }
        throw new Exception('There is a problem to get the currency of Amazon');
    }

    /**
     * Get Token Link back from magnalister API
     *
     * @return void
     */
    protected function callAjaxGetTokenCreationLink() {
        try {
            $result = MagnaConnector::gi()->submitRequest(array(
                'ACTION' => 'GetTokenCreationLink',
                'DATA' => array('Site' => MLRequest::gi()->data('site'))
            ));
            $iframeURL = $result['DATA']['tokenCreationLink'];

            MLSetting::gi()->add(
                'aAjax', array(
                    'iframeUrl' => $iframeURL,
                    'error' => '',
                )
            );
        } catch (MagnaException $e) {
            MLMessage::gi()->addDebug($e);
            MLSetting::gi()->add(
                'aAjax', array(
                    'iframeUrl' => '',
                    'error' => $e->getMessage(),
                )
            );
        }
    }
}
