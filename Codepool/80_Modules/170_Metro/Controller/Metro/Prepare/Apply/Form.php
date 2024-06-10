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

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_PrepareWithVariationMatchingAbstract');

class ML_Metro_Controller_Metro_Prepare_Apply_Form extends ML_Form_Controller_Widget_Form_PrepareWithVariationMatchingAbstract {

    /** @var ML_Metro_Helper_Model_Table_Metro_PrepareData $oPrepareHelper */
    protected $oPrepareHelper = null;

    public function processingTimeField(&$aField) {
        ML::gi()->instance('helper_model_table_metro_configdata')->processingTimeField($aField);
    }

    /**
     * Set values for MaxProcessing Time field
     *
     * @param $aField
     * @return void
     */
    public function maxprocessingTimeField(&$aField) {
        ML::gi()->instance('helper_model_table_metro_configdata')->processingTimeField($aField);
    }

    public function businessModelField(&$aField) {
        ML::gi()->instance('helper_model_table_metro_configdata')->businessModelField($aField);
    }

    protected function currencyIdField(&$aField) {
        $aField['value'] = MLModul::gi()->getConfig('currency');
    }

    protected function shippingProfileField(&$aField) {
        $aDefaultTemplate = MLModul::gi()->getConfig('shippingprofile');
        $aTemplateName = MLModul::gi()->getConfig('shippingprofile.name');
        $aTemplateCost = MLModul::gi()->getConfig('shippingprofile.cost');
        $aField['type'] = 'select';
        $aField['autooptional'] = false;
        foreach ($aDefaultTemplate as $iKey => $sValue) {
            $aField['values'][] = $aTemplateName[$iKey].' ('.number_format((float)$aTemplateCost[$iKey], 2, '.', '').' Euro)';
        }
    }

    protected function shippingGroupField(&$aField) {
        $aDefaultGroup = MLModule::gi()->getConfig('shipping.group');
        $aGroupName = MLModule::gi()->getConfig('shipping.group.name');
        $aField['type']='select';
        $aField['autooptional'] = false;
        foreach ($aDefaultGroup as $iKey => $sValue) {
             $aField['values'][]= $aGroupName[$iKey];
        }       
    }

     protected function titleField(&$aField) {
        $aField['type'] = 'string';
        $aField['maxlength'] = 150;
    }

}
