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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_ConfigAbstract');
class ML_Ebay_Controller_Ebay_Config_Prepare extends ML_Form_Controller_Widget_Form_ConfigAbstract {
    public static function getTabTitle() {
        return MLI18n::gi()->get('ebay_config_account_prepare');
    }

    public static function getTabActive() {
        return self::calcConfigTabActive(__class__, false);
    }

    public function render() {
        if (!MLHttp::gi()->isAjax()) {
            MLSetting::gi()->add('aCss', 'magnalister.ebayshippingservice.css', true);
        }
        parent::render();
    }

    public function paymentSellerProfileField(&$aField) {
        MLHelper::gi('model_form_type_sellerprofiles')->sellerProfileField($aField, 'payment', true);
    }
    
    public function shippingSellerProfileField(&$aField) {
        MLHelper::gi('model_form_type_sellerprofiles')->sellerProfileField($aField, 'shipping');
    }
    
    public function returnSellerProfileField(&$aField) {
        MLHelper::gi('model_form_type_sellerprofiles')->sellerProfileField($aField, 'return');
    }
    
    public function paymentMethodsField(&$aField) {
        $aField['values'] = MLModule::gi()->getPaymentOptions();
        if (count($aField['values']) == 1) {
            $aField['value'] = current($aField['values']);
            $aField['type'] = 'information';
            unset($aField['values']);
        } else if (
            !MLHelper::gi('model_form_type_sellerprofiles')->manipulateFieldForSellerProfile($aField, $this->getField('paymentSellerProfile'), 'Payment') 
            && !empty($aField['value']) 
            && !is_array($aField['value'])
        ){
            $aField['value'] = MLHelper::getEncoderInstance()->decode($aField['value']);
        }
    }
    
    public function paypal_addressField(&$aField) {
        MLHelper::gi('model_form_type_sellerprofiles')->manipulateFieldForSellerProfile($aField, $this->getField('paymentSellerProfile'), 'Payment');
    }
    
    public function paymentInstructionsField(&$aField) {
        MLHelper::gi('model_form_type_sellerprofiles')->manipulateFieldForSellerProfile($aField, $this->getField('paymentSellerProfile'), 'Payment');
    }
    
    public function shippingLocalContainerField(&$aField) {
        MLHelper::gi('model_form_type_sellerprofiles')->manipulateFieldForSellerProfile($aField, $this->getField('shippingSellerProfile'), 'Shipping');
    }
    
    public function shippingInternationalContainerField(&$aField) {
        MLHelper::gi('model_form_type_sellerprofiles')->manipulateFieldForSellerProfile($aField, $this->getField('shippingSellerProfile'), 'Shipping');
    }
    
    protected function _shippingField(&$aField){
        $aField['type'] = 'duplicate';
        $aField['duplicate']['field']['type'] = 'ebay_shippingcontainer_shipping';
        if (!MLHelper::gi('model_form_type_sellerprofiles')->manipulateShippingFieldForSellerProfile($aField, $this->getField('shippingSellerProfile'))) {
            if(!empty($aField['value']) && !is_array($aField['value'])){
                $aField['value'] = array_values(MLHelper::getEncoderInstance()->decode($aField['value']));
            }
        }
    }
    
    public function shippingLocalField(&$aField) {
        $aField['values'] = MLModule::gi()->getLocalShippingServices();
        $this->_shippingField($aField);
    }
    public function shippingInternationalField(&$aField) {
        $aField['values'] = array_merge(array('' => MLI18n::gi()->get('sEbayNoInternationalShipping')), MLModule::gi()->getInternationalShippingServices());
        $aField['locations'] = MLModule::gi()->getInternationalShippingLocations();
        $this->_shippingField($aField);
    }
    
    protected function _shippingDiscountField(&$aField) {
        $aField['type'] = 'bool';
        MLHelper::gi('model_form_type_sellerprofiles')->manipulateFieldForSellerProfile($aField, $this->getField('shippingSellerProfile'), 'Shipping');
    }
    
    public function shippingLocalDiscountField(&$aField) {
        $this->_shippingDiscountField($aField);
    }
    
    public function shippingInternationalDiscountField(&$aField) {
        $this->_shippingDiscountField($aField);
    }

    public function _shippingProfileField(&$aField) {
        $aProfiles = array();
        $oI18n = MLI18n::gi();
        $oPrice = MLPrice::factory();
        $sCurrency = MLModule::gi()->getConfig('currency');
        if (isset($aField['i18n'])) {
            foreach (MLModule::gi()->getShippingDiscountProfiles() as $sProfil => $aProfil) {
                $aProfiles[$sProfil] = $oI18n->replace(
                    $aField['i18n']['option'], array(
                        'NAME' => $aProfil['name'],
                        'AMOUNT' => $oPrice->format($aProfil['amount'], $sCurrency)
                    )
                );
            }
        }
        $aField['values'] = $aProfiles;
        $aField['type'] = 'optional';
        $aField['optional'] = array(
            'editable' => true,
            'field' => array('type' => 'select')
        );
        MLHelper::gi('model_form_type_sellerprofiles')->manipulateShippingProfileFieldForSellerProfile($aField, $this->getField('shippingSellerProfile'));
    }
    
    public function shippingLocalProfileField(&$aField) {
        $this->_shippingProfileField($aField);
    }

    public function shippingInternationalProfileField(&$aField) {
        $this->_shippingProfileField($aField);
    }
    
    public function dispatchTimeMaxField(&$aField) {
        MLHelper::gi('model_form_type_sellerprofiles')->manipulateFieldForSellerProfile($aField, $this->getField('shippingSellerProfile'), 'shipping');
    }
    
    public function returnpolicy_returnsacceptedField(&$aField) {
        $aField['values'] = MLModule::gi()->geteBaySingleReturnPolicyDetail('ReturnsAccepted');
        MLHelper::gi('model_form_type_sellerprofiles')->manipulateFieldForSellerProfile($aField, $this->getField('returnSellerProfile'), 'return');
    }
    
    public function returnpolicy_returnswithinField(&$aField) {
        $aField['values'] = MLModule::gi()->geteBaySingleReturnPolicyDetail('ReturnsWithin');
        MLHelper::gi('model_form_type_sellerprofiles')->manipulateFieldForSellerProfile($aField, $this->getField('returnSellerProfile'), 'return');
    }
    
    public function returnpolicy_shippingcostpaidbyField(&$aField) {
        $aField['values'] = MLModule::gi()->geteBaySingleReturnPolicyDetail('ShippingCostPaidBy');
        MLHelper::gi('model_form_type_sellerprofiles')->manipulateFieldForSellerProfile($aField, $this->getField('returnSellerProfile'), 'return');
    }
    
    public function returnpolicy_descriptionField(&$aField) {
        MLHelper::gi('model_form_type_sellerprofiles')->manipulateFieldForSellerProfile($aField, $this->getField('returnSellerProfile'), 'return');
    }
    
}
