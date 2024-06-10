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

class ML_Hood_Controller_Hood_Config_Prepare extends ML_Form_Controller_Widget_Form_ConfigAbstract {

    public static function getTabTitle() {
        return MLI18n::gi()->get('hood_config_account_prepare');
    }

    public static function getTabActive() {
        return self::calcConfigTabActive(__class__, false);
    }

    public function render() {
        if (!MLHttp::gi()->isAjax()) {
            MLSetting::gi()->add('aCss', 'magnalister.hoodshippingservice.css', true);
        }
        parent::render();
    }

    public function paymentMethodsField(&$aField) {

        $aField['values'] = MLModul::gi()->getPaymentOptions();
    }

    public function paypal_addressField(&$aField) {

    }

    public function paymentInstructionsField(&$aField) {

    }

    public function shippingLocalContainerField(&$aField) {

    }

    public function shippingInternationalContainerField(&$aField) {

    }

    protected function _shippingField(&$aField) {
        $aField['type'] = 'duplicate';
        $aField['duplicate']['field']['type'] = 'hood_shippingcontainer_shipping';
    }

    public function shippingLocalField(&$aField) {
        $aField['values'] = MLModul::gi()->getLocalShippingServices();
        $this->_shippingField($aField);
    }

    public function shippingInternationalField(&$aField) {
        $aField['values'] = array_merge(array('' => MLI18n::gi()->get('sHoodNoInternationalShipping')), MLModul::gi()->getInternationalShippingServices());
        $this->_shippingField($aField);
    }

    protected function _shippingDiscountField(&$aField) {
        $aField['type'] = 'bool';
    }

    public function dispatchTimeMaxField(&$aField) {

    }

}
