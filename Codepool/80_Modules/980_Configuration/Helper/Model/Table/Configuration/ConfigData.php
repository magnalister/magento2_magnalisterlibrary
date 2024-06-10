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
MLFilesystem::gi()->loadClass('Form_Helper_Model_Table_ConfigData_Abstract');

class ML_Configuration_Helper_Model_Table_Configuration_ConfigData extends ML_Form_Helper_Model_Table_ConfigData_Abstract {

    protected $blValidPassPhrase = null;
    protected function checkPassPhrase() {
        if ($this->blValidPassPhrase === null) {
            $sPassPhrase = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.passphrase')->get('value');
            $this->blValidPassPhrase = !empty($sPassPhrase) && is_string($sPassPhrase);
        }
        return $this->blValidPassPhrase;
    }
 
    public function general_passphraseField(&$aField) {
        $sPassPhrase = $aField['value'];

        if (empty($sPassPhrase)) {    
            try {
                $partner = '?partner='.MLSetting::gi()->get('magnaPartner');
            } catch (MLSetting_Exception $oEx) {
                $partner = '';
            }
                /* Hier die bunte Startseite */
            try {
                $partner = '?partner='.MLSetting::gi()->get('magnaPartner');
            } catch (MLSetting_Exception $oEx) {
                $partner = '';
            }
            MLMessage::gi()->addNotice(sprintf(MLI18n::gi()->ML_NOTICE_PLACE_PASSPHRASE, $partner));
        }
    }
    
    public function general_manufacturerField(&$aField) {
        if ($this->checkPassPhrase()) {
            $aField['values'] = MLFormHelper::getShopInstance()->getManufacturer();
        } else {
            $aField = array();
        }
    }

    public function general_manufacturerpartnumberField(&$aField) {
        if ($this->checkPassPhrase()) {
            $aField['values'] = MLFormHelper::getShopInstance()->getManufacturerPartNumber();
        } else {
            $aField = array();
        }
    }

    public function general_eanField(&$aField) {
        if ($this->checkPassPhrase()) {
            $aField['values'] = MLFormHelper::getShopInstance()->getEan();
        } else {
            $aField = array();
        }
    }

    public function general_upcField(&$aField) {
        if ($this->checkPassPhrase()) {
            $aField['values'] = MLFormHelper::getShopInstance()->getUpc();
        } else {
            $aField = array();
        }
    }

    public function general_inventar_productstatusField(&$aField) {
        if (!$this->checkPassPhrase()) {
            $aField = array();
        }
    }

    public function general_trigger_checkoutprocess_inventoryupdateField(&$aField) {
        if (!$this->checkPassPhrase()) {
            $aField = array();
        } else {//support old json format if it is saved with old configuration
            $aField['value'] = is_array($aField['value']) ? current($aField['value']) : $aField['value'];
        }
    }

    public function general_editorField(&$aField) {
        if (!$this->checkPassPhrase()) {
            $aField = array();
        }
    }

    public function general_order_informationField(&$aField) {
        if (!$this->checkPassPhrase()) {
            $aField = array();
        } else {//support old json format if it is saved with old configuration
            $aField['value'] = is_array($aField['value']) ? current($aField['value']) : $aField['value'];
        }
    }

    public function general_stats_backwardsField(&$aField) {
        if (!$this->checkPassPhrase()) {
            $aField = array();
        }
    }

    public function general_keytypeField(&$aField) {
        if (!$this->checkPassPhrase()) {
            $aField = array();
        }
    }

    /**
     * For attribute matching you should implement this function
     * It has no functionality in global configuration
     * @param $aField
     * @return mixed
     */
    public function primaryCategoryField(&$aField) {

    }

    public function general_cronfronturlField(&$aField) {
        if (!$this->checkPassPhrase()) {
            $aField = array();
        } else {
            $aField['value'] = empty($aField['value']) ? MLHttp::gi()->getFrontendDoUrl() : $aField['value'];
        }
        $aField['default'] = MLHttp::gi()->getFrontendDoUrl();
    }
}
