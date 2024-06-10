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

class ML_GoogleShopping_Controller_GoogleShopping_Config_Prepare extends ML_Form_Controller_Widget_Form_ConfigAbstract {
    public static function getTabTitle() {
        return MLI18n::gi()->get('googleshopping_config_account_prepare');
    }
    
    public static function getTabActive() {
        return self::calcConfigTabActive(__class__, false);
    }

    public function callAjaxSaveShippingTemplate() {
        $results = array(
            'title'             => MLRequest::gi()->data('title'),
            'origin_country_id' => MLRequest::gi()->data('originCountry'),
            'currency' => MLRequest::gi()->data('currencyValue'),
            'primary_cost'      => MLRequest::gi()->data('primaryCost'),
            'secondary_cost'    => MLRequest::gi()->data('secondaryCost')
        );
        try {
            $result = MagnaConnector::gi()->submitRequest(array(
                'ACTION' => 'SaveShippingTemplate',
                'DATA'   => $results
            ));
        } catch (MagnaException $e) {
            MLMessage::gi()->addDebug($e);
        }
    }


    public function saveAction($blExecute = true)
    {
        $oParent = parent::saveAction($blExecute);

        if ($this->getRequestField('googleshopping.language') == '0') {
            unset($this->aRequestFields['googleshopping.language']);
        }
        return $oParent;
    }
}
