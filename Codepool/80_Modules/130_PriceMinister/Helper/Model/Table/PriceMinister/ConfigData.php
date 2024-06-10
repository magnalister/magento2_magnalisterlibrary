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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Form_Helper_Model_Table_ConfigData_Abstract');

class ML_PriceMinister_Helper_Model_Table_PriceMinister_ConfigData extends ML_Form_Helper_Model_Table_ConfigData_Abstract {

    public function siteIdField(&$aField) {
        $aSites = $this->callApi(array('ACTION' => 'GetSites'), 60);
        $aField['type'] = 'select';
        $aField['values'] = array();
        $aField['values'][] = MLI18n::gi()->get('ML_AMAZON_LABEL_APPLY_PLEASE_SELECT');
        foreach ($aSites as $aSite) {
            $aField['values'][$aSite['id']] = $aSite['name'];
        }
    }

    public function getSiteDetails() {
        return $this->callApi(array('ACTION' => 'GetSiteDetails'), 60);
    }

    public function primaryCategoryField(&$aField) {
        $aRequest = MLRequest::gi()->data();
        if (MLModule::gi()->getMarketPlaceName() . ':' . MLModule::gi()->getMarketPlaceId() . '_prepare_variations' === $aRequest['controller']) {
            $aField['values'] = MLDatabase::factory(MLModule::gi()->getMarketPlaceName() . '_variantmatching')->getTopPrimaryCategories();
        } else {
            $aField['values'] = MLDatabase::factory(MLModule::gi()->getMarketPlaceName() . '_prepare')->getTopPrimaryCategories();
        }
    }

    public function listingTypeField(&$aField) {
        $listingTypes = MLModule::gi()->getConfig('site.listing_types');
        $aField['values'][''] = ML_AMAZON_LABEL_APPLY_PLEASE_SELECT;
        if ($listingTypes) {
            foreach ($listingTypes as $code => $name) {
                $aField['values'][$code] = $name;
            }
        }
    }

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
    
    public function itemConditionField(&$aField) {
        $aField['values'] = $this->callApi(array('ACTION' => 'GetItemConditions'), 60);
    }

    public function orderstatus_carrierField(&$aField) {
        $aField['values'] = $this->callApi(array('ACTION' => 'GetCarriers'), 60);
    }

    public function orderstatus_acceptedField (&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getOrderStatusValues();
    }

    public function orderstatus_refusedField (&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getOrderStatusValues();
    }

    public function orderstatus_autoacceptanceField(&$aField) {
        if ($aField['value'] == false) {
            MLMessage::gi()->addWarn(MLI18n::gi()->get('priceminister_config_orderstatus_autoacceptance'));
        }
    }

    /**
     * @param $aField
     * @throws MLAbstract_Exception
     */
    public function orderimport_shippingfromcountryField(&$aField) {
        $countries = $this->callApi(array('ACTION' => 'GetCountries'), 86400);

        if (!empty($countries)) {
            foreach ($countries as $id => $country) {
                $aField['values'][$id] = $country;
            }
        } else {
            MLMessage::gi()->addWarn(MLI18n::gi()->get('ML_ERROR_API'));
            $aField['values'][] = MLI18n::gi()->get('ML_ERROR_UNKNOWN');
            $aField['values']['249'] = 'France';
            $aField['values']['276'] = 'Germany';
        }
    }
}
