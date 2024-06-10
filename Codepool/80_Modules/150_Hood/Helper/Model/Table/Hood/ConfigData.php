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

class ML_Hood_Helper_Model_Table_Hood_ConfigData extends ML_Form_Helper_Model_Table_ConfigData_Abstract {

    public function hitcounterField(&$aField) {
        $aField['values'] = MLI18n::gi()->hood_configform_prepare_hitcounter_values;
    }

    public function dispatchtimemaxField(&$aField) {
        $aField['values'] = MLI18n::gi()->hood_configform_prepare_dispatchtimemax_values;
    }

    public function fixed_durationField(&$aField) {
        $aField['values'] = MLFormHelper::getModulInstance()->getListingFixedDurations();
    }

    public function chinese_durationField(&$aField) {
        $aField['values'] = MLFormHelper::getModulInstance()->getListingChineseDurations();
    }

    public function orderstatus_closedField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getOrderStatusValues();
    }

    public function updateable_orderstatusField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getOrderStatusValues();
    }


    public function orderstatus_paidField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getOrderStatusValues();
    }

    public function orderstatus_carrier_defaultField(&$aField) {
        $aField['values'] = MLFormHelper::getModulInstance()->getCarrier();
    }

    public function inventorysync_priceField(&$aField) {
        $aField['values'] = MLI18n::gi()->get('hood_configform_pricesync_values');

    }

    public function stocksync_toMarketplaceField(&$aField) {
        $aField['values'] = MLI18n::gi()->get('hood_configform_sync_values');
    }

    public function stocksync_fromMarketplaceField(&$aField) {
        $aField['values'] = MLI18n::gi()->get('hood_configform_stocksync_values');
    }

    public function chinese_stocksync_toMarketplaceField(&$aField) {
        $aField['values'] = MLI18n::gi()->get('hood_configform_sync_chinese_values');
    }

    public function chinese_stocksync_fromMarketplaceField(&$aField) {
        $aField['values'] = MLI18n::gi()->get('hood_configform_stocksync_values');
    }

    public function chinese_inventorysync_priceField(&$aField) {
        $aField['values'] = MLI18n::gi()->get('hood_configform_pricesync_values');
    }

    /**
     * Gets Laguage list of amazon for config form.
     */
    public function langField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getDescriptionValues();
    }

    public function ConditionTypeField(&$aField) {
        $aField['values'] = MLModul::gi()->getConditionValues();
    }

    public function fixed_price_addKindField(&$aField) {
        $this->price_addKindField($aField);
    }

    public function fixed_price_factorField(&$aField) {
        $this->price_factorField($aField);
    }

    public function fixed_price_signalField(&$aField) {
        $this->price_signalField($aField);
    }

    public function fixed_price_groupField(&$aField) {
        $this->price_groupField($aField);
    }

    public function fixed_quantity_typeField(&$aField) {
        $this->quantity_typeField($aField);
    }

    public function fixed_quantity_valueField(&$aField) {
        $aField['value'] = isset($aField['value']) ? trim($aField['value']) : 0;
        if (MLModul::gi()->getConfig('fixed.quantity.type') != 'stock' && (string)((int)$aField['value']) != $aField['value']) {
            $this->addError($aField, MLI18n::gi()->get('configform_quantity_value_error'));
        }
    }


    public function chinese_price_addKindField(&$aField) {
        $this->price_addKindField($aField);
    }

    public function chinese_price_factorField(&$aField) {
        $this->price_factorField($aField);
    }

    public function chinese_price_signalField(&$aField) {
        $this->price_signalField($aField);
    }

    public function chinese_price_groupField(&$aField) {
        $this->price_groupField($aField);
    }

    public function chinese_buyitnow_price_addKindField(&$aField) {
        $this->price_addKindField($aField);
    }

    public function chinese_buyitnow_price_factorField(&$aField) {
        $this->price_factorField($aField);
    }

    public function chinese_buyitnow_price_signalField(&$aField) {
        $this->price_signalField($aField);
    }

    public function chinese_buyitnow_price_groupField(&$aField) {
        $this->price_groupField($aField);
    }

    public function chinese_quantity_typeField(&$aField) {
        $this->quantity_typeField($aField);
    }

    public function chinese_quantity_valueField(&$aField) {
        $aField['value'] = isset($aField['value']) ? trim($aField['value']) : 0;
        if (MLModul::gi()->getConfig('chinese.quantity.type') != 'stock' && (string)((int)$aField['value']) != $aField['value']) {
            $this->addError($aField, MLI18n::gi()->get('configform_quantity_value_error'));
        }
    }
        
    public function orderstatus_canceled_nostockField(&$aField) {
        $this->orderstatus_canceledField($aField);

        $aField['values'] = array('' => MLI18n::gi()->get('ML_LABEL_DONT_USE')) + $aField['values'];
    }

    public function orderstatus_canceled_defectField(&$aField) {
        $this->orderstatus_canceledField($aField);

        $aField['values'] = array('' => MLI18n::gi()->get('ML_LABEL_DONT_USE')) + $aField['values'];
    }

    public function orderstatus_canceled_revokedField(&$aField) {
        $this->orderstatus_canceledField($aField);

        $aField['values'] = array('' => MLI18n::gi()->get('ML_LABEL_DONT_USE')) + $aField['values'];
    }

    public function orderstatus_canceled_nopaymentField(&$aField) {
        $this->orderstatus_canceledField($aField);

        $aField['values'] = array('' => MLI18n::gi()->get('ML_LABEL_DONT_USE')) + $aField['values'];
    }

    public function orderimport_shippingmethodField (&$aField) {
        if(method_exists(MLFormHelper::getShopInstance(), 'getShippingMethodValues')){
            $aField['values'] = MLFormHelper::getShopInstance()->getShippingMethodValues();
        } else {
            $aField['values'] = MLI18n::gi()->get('hood_configform_orderimport_shipping_values');
        }
    }

    public function orderimport_paymentmethodField(&$aField) {
        $aField['values'] = MLI18n::gi()->get('hood_configform_orderimport_payment_values');
    }

    public function inventory_importField(&$aField) {
        $aField['values'] = MLI18n::gi()->hood_config_sync_inventory_import;
    }

    public function mail_sendField(&$aField) {
        $aField['values'] = array(
            "true" => MLI18n::gi()->get('ML_BUTTON_LABEL_YES'),
            "false" => MLI18n::gi()->get('ML_BUTTON_LABEL_NO'));
    }

    public function mail_copyField(&$aField) {
        $aField['values'] = array(
            "true" => MLI18n::gi()->get('ML_BUTTON_LABEL_YES'),
            "false" => MLI18n::gi()->get('ML_BUTTON_LABEL_NO'));
    }

    public function importField(&$aField) {
        $aField['value'] = isset($aField['value']) && in_array($aField['value'], array('true', 'false')) ? $aField['value'] : 'true';
        $aField['values'] = array('true' => MLI18n::gi()->get('ML_BUTTON_LABEL_YES'), 'false' => MLI18n::gi()->get('ML_BUTTON_LABEL_NO'));
    }

    public function productfield_brandField(&$aField) {
        $aField['values'] = MLFormHelper::getShopInstance()->getBrand();
    }

    public function variationDimensionForPicturesField(&$aField) {
        if (MLShop::gi()->addonBooked('HoodPicturePack')) {
            $aField['type'] = 'select';
            $aField['values'] = array();
            foreach (MLFormHelper::getShopInstance()->getPossibleVariationGroupNames() as $iKey => $sValue) {
                $aField['values'][$iKey] = $sValue;
            }
        }
    }

    public function primaryCategoryField(&$aField) {
        $aRequest = MLRequest::gi()->data();
        if (MLModul::gi()->getMarketPlaceName().':'.MLModul::gi()->getMarketPlaceId().'_prepare_variations' === $aRequest['controller']) {
            $aField['values'] = MLDatabase::factory(MLModul::gi()->getMarketPlaceName() . '_variantmatching')->getTopPrimaryCategories();
        } else {
            $aField['values'] = MLDatabase::factory( MLModul::gi()->getMarketPlaceName() . '_prepare')->getTopPrimaryCategories();
        }
    }

    public function secondaryCategoryField(&$aField) {
        $aField['values'] = MLDatabase::factory('hood_prepare')->getTopSecondaryCategories();
    }

    public function shopCategoryField(&$aField) {
        $aField['values'] = MLDatabase::factory('hood_prepare')->getTopStoreCategories();
    }


    public function shopCategory2Field(&$aField) {
        $aField['values'] = MLDatabase::factory('hood_prepare')->getTopStoreCategories();
    }

    public function shopCategory3Field(&$aField) {
        $aField['values'] = MLDatabase::factory('hood_prepare')->getTopStoreCategories();
    }
}
