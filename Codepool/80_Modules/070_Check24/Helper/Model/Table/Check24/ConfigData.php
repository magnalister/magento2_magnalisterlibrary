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
MLFilesystem::gi()->loadClass('Form_Helper_Model_Table_ConfigData_Abstract');

class ML_Check24_Helper_Model_Table_Check24_ConfigData extends ML_Form_Helper_Model_Table_ConfigData_Abstract {
    
    public function productTypeField(&$aField) {
        $aField['values'] = $this->callApi(array('ACTION' => 'GetProductTypes'), 12 * 12 * 60);
    }
    
    public function returnPolicyField (&$aField) {
        $aResponse = $this->callApi(array('ACTION' => 'GetReturnPolicies'), 1 * 60 * 60);
        $aPolicies = array();
        foreach ($aResponse as $aPolicy) {
            $aPolicies[$aPolicy['Id']] = $aPolicy['Title'];
        }
        $aField['values'] = $aPolicies;
    }
    
    public function langField (&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getDescriptionValues();
    }
    
    public function shippingTimeField(&$aField) {
        $aField['values'] = array_slice(range(0, 30), 1, null, true);
    }

	public function installation_serviceField (&$aField) {
		$aField['values'] = array (
                    '' => '-',
                    'ja' => 'ja');
    }

	public function removal_old_itemField (&$aField) {
		$aField['values'] = array (
                    '' => '-',
                    'ja' => 'ja');
    }

	public function removal_packagingField (&$aField) {
		$aField['values'] = array (
                    '' => '-',
                    'ja' => 'ja');
    }

    
    public function csvUrlField(&$aField) {
        $response = $this->callApi(array('ACTION' => 'GetInventoryFileUrl'), 1 * 1 * 60);
        $aField['value'] = $response['URL'];
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

    /**
     * For attribute matching you should implement this function
     * Check24 use another method to manage category
     * @param $aField
     * @return mixed
     */
    public function primaryCategoryField(&$aField) {

    }

    public function imagesizeField(&$aField) {
        $startSize = 500;
        $maxSize = 2500;

        $aField['values'] = array();

        for ($i = $startSize; $i <= $maxSize; $i += 100) {
            $aField['values'][(string)$i] = $i."px";
        }
    }
}
