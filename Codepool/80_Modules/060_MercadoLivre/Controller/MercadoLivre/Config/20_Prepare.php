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
MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_ConfigAbstract');

class ML_MercadoLivre_Controller_MercadoLivre_Config_Prepare extends ML_Form_Controller_Widget_Form_ConfigAbstract {

    public static function getTabTitle() {
        return MLI18n::gi()->get('mercadolivre_config_account_prepare');
    }

    public static function getTabActive() {
        return self::calcConfigTabActive(__class__, false);
    }

    public function shippingModeAjaxField(&$aField) {
        $aField['type'] = 'ajax';
        $aField['padding-right'] = 0;
        $aField['breakbefore'] = true;
        $aField['ajax'] = array(
            'selector' => '#' . $this->getField('shippingmode', 'id'),
            'trigger' => 'change',
        );

        $i18n = $this->getFormArray('i18n');
        if ($this->getField('shippingmode', 'value') === 'custom') {
            $aCustomShipping = $this->getField('customshipping');
            $aField['ajax']['field'] = array(
                'type' => 'keyvaluelist',
                'name' => 'customshipping',
                'i18n' => $i18n['field']['customshipping'],
                'value' => $aCustomShipping['value'],
            );
        } else {
            $aField['ajax']['field'] = array(
                'type' => 'information',
                'value' => ' '
            );
        }
    }

    public function customShippingField(&$aField) {
        $aField['value'] = isset($aField['value']) ? $aField['value'] : array();
        if (count($aField['value']) > 0) {
            $blErrorAdded = false;
            foreach ($aField['value'] as $i => &$aPair) {
                if (empty($aPair['key'])) {
                    unset($aField['value'][$i]);
                    continue;
                }
                
                $aPair['value'] = str_replace(',', '.', trim($aPair['value']));
                if ((string)((float)$aPair['value']) != $aPair['value']) {
                    $aPair['error'] = true;
                    if (!$blErrorAdded) {
                        MLMessage::gi()->addError(MLI18n::gi()->get('configform_check_entries_error'));
                        MLMessage::gi()->addError(MLI18n::gi()->get('mercadolivre_config_checkin_badshippingcost'));
                        $blErrorAdded = true;
                    }
                }
            }
        }
    }
}
