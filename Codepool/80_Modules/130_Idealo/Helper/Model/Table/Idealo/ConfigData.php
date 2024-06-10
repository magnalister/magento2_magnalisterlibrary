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

MLFilesystem::gi()->loadClass('Form_Helper_Model_Table_ConfigData_Abstract');

class ML_Idealo_Helper_Model_Table_Idealo_ConfigData extends ML_Form_Helper_Model_Table_ConfigData_Abstract {
    
    public function access_inventorypathField(&$aField) {
        $aField['value'] = MLModul::gi()->getIdealoCSVInfo();
    }
    
    /**
     * Gets languages for config form.
     * 
     * @param array $aField
     */
    public function shippingTimeField(&$aField) {
        $aField['subfields']['select']['values']['__ml_lump']['textoption'] = true;
        // set key to value.title
        $aChangeKey = array();
        foreach ($aField['subfields']['select']['values'] as $sKey => $aValue) {
            $aChangeKey[$sKey === '__ml_lump' ? '__ml_lump' : $aValue['title']] = $aValue;
        }
        $aField['subfields']['select']['values'] = $aChangeKey;
    }
    
    public function shippingTimeProductFieldField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getShippingTime();
    }
    
    /**
     * Gets languages for config form.
     * 
     * @param array $aField
     */
    public function langField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getDescriptionValues();
    }
    
    public function mail_sendField(&$aField) {
        $aField['values'] = array(
            1 => MLI18n::gi()->get('ML_BUTTON_LABEL_YES'),
            0 => MLI18n::gi()->get('ML_BUTTON_LABEL_NO'));
    }

    public function mail_copyField(&$aField) {
        $aField['values'] = array(
            1 => MLI18n::gi()->get('ML_BUTTON_LABEL_YES'),
            0 => MLI18n::gi()->get('ML_BUTTON_LABEL_NO'));
    }
    
    public function shippingCountryField(&$aField){        
        $aField['values'] = $this->callApi(array(
            'ACTION' => 'GetCountries', 
            'SUBSYSTEM' => 'Core', 
            'DATA' => array(
                'Language' => MLModul::gi()->getConfig('marketplace.lang')
            )
        ), 60 * 60 * 24 * 30);
    }


    public function orderimport_paymentmethodField (&$aField) {
        $aField['values'] = MLI18n::gi()->get('idealo_configform_orderimport_payment_values');
    }

    /**
     * For attribute matching you should implement this function
     * Idealo use another method to manage topten
     * @param $aField
     * @return mixed
     */
    public function primaryCategoryField(&$aField) {
        return;
    }

    public function currencyField(&$aField) {
        foreach (MLCurrency::gi()->getList() as $iso => $currency) {
            $aField['values'][$iso] = $currency['title'];
        }
    }

}
