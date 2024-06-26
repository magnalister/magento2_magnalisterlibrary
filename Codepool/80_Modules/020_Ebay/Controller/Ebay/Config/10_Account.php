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
MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_ConfigAbstract');
class ML_Ebay_Controller_Ebay_Config_Account extends ML_Form_Controller_Widget_Form_ConfigAbstract {

    public static function getTabTitle() {
        return MLI18n::gi()->get('ebay_config_account_title');
    }

    public static function getTabActive() {
        return self::calcConfigTabActive(__class__, true);
    }

    protected function callAjaxGetTokenCreationLink() {
        switch ($this->getRequest('what')) {
            case 'token':
                $sAction = 'GetTokenCreationLink';
                break;
            case 'oauth.token':
                $sAction = 'GetOauthTokenCreationLink';
                break;
            default :
                $sAction = '';
        }
        try {
            $result = MagnaConnector::gi()->submitRequest(array(
                'ACTION' => $sAction
            ));
            $iframeURL = $result['DATA']['tokenCreationLink'];
            MLSetting::gi()->add(
                'aAjax', array(
                    'iframeUrl' => $iframeURL,
                    'error'     => '',
                )
            );
        } catch (MagnaException $e) {
            MLSetting::gi()->add(
                'aAjax', array(
                    'iframeUrl' => '',
                    'error'     => $e->getMessage(),
                )
            );
        }
    }

}
