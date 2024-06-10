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
MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_PrepareWithVariationMatchingAbstract');

class ML_Etsy_Controller_Etsy_Prepare_Apply_Form extends ML_Form_Controller_Widget_Form_PrepareWithVariationMatchingAbstract {

    protected function shippingProfileField(&$aField) {
        $shippingProfiles = $this->callApi('GetShippingProfiles');
        foreach ($shippingProfiles['ShippingProfiles'] as $shippingProfile) {
            $aField['values'][$shippingProfile['shippingProfileId'].''] = $shippingProfile['title'];
        }
    }

    protected function callGetCategoryDetails($sCategoryId) {
        return MLModule::gi()->getCategoryDetails($sCategoryId);
    }

    public function callAjaxSaveShippingProfile() {
        try {
            MLModule::gi()->saveShippingProfile();
            MLCache::gi()->flush();
            $aField = $this->getField('shippingprofile');
            $aField['type'] = 'select';//type seems missing from getField
            $sField = $this->includeTypeBuffered($aField);
            MLMessage::gi()->addSuccess(MLI18n::gi()->ML_LABEL_SAVED_SUCCESSFULLY);
            MLSetting::gi()->add('aAjaxPlugin', array(
                'dom' => array(
                    '#etsy_prepare_apply_form_field_shippingprofile' => $sField,
                ),
            ));
        } catch (MagnaException $e) {
            MLMessage::gi()->addError($e->getMessage());
        } catch (Exception $e) {
            MLMessage::gi()->addDebug($e);
        }
    }

}
