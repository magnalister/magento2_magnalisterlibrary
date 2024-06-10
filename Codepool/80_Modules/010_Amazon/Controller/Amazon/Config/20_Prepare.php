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

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_ConfigAbstract');
class ML_Amazon_Controller_Amazon_Config_Prepare extends ML_Form_Controller_Widget_Form_ConfigAbstract
{
    public static function getTabTitle()
    {
        return MLI18n::gi()->get('amazon_config_account_prepare');
    }

    public static function getTabTitleTranslationData()
    {
        return MLI18n::gi()->getTranslationData('amazon_config_account_prepare');
    }

    public static function getTabActive()
    {
        return self::calcConfigTabActive(__class__, false);
    }

    public function b2bdiscounttier1quantityField(&$aField) {
        $this->validateB2BDiscountTier($aField, '', '1', true);
    }

    public function b2bdiscounttier2quantityField(&$aField) {
        $this->validateB2BDiscountTier($aField, 'b2bdiscounttier1quantity', '2', true);
    }

    public function b2bdiscounttier3quantityField(&$aField) {
        $this->validateB2BDiscountTier($aField, 'b2bdiscounttier2quantity', '3', true);
    }

    public function b2bdiscounttier4quantityField(&$aField) {
        $this->validateB2BDiscountTier($aField, 'b2bdiscounttier3quantity', '4', true);
    }

    public function b2bdiscounttier5quantityField(&$aField) {
        $this->validateB2BDiscountTier($aField, 'b2bdiscounttier4quantity', '5', true);
    }

    public function b2bdiscounttier1discountField(&$aField) {
        $this->validateB2BDiscountTier($aField, '', '1');
    }

    public function b2bdiscounttier2discountField(&$aField) {
        $this->validateB2BDiscountTier($aField, 'b2bdiscounttier1discount', '2');
    }

    public function b2bdiscounttier3discountField(&$aField) {
        $this->validateB2BDiscountTier($aField, 'b2bdiscounttier2discount', '3');
    }

    public function b2bdiscounttier4discountField(&$aField) {
        $this->validateB2BDiscountTier($aField, 'b2bdiscounttier3discount', '4');
    }

    public function b2bdiscounttier5discountField(&$aField) {
        $this->validateB2BDiscountTier($aField, 'b2bdiscounttier4discount', '5');
    }

    /**
     * Adds error if quantity discount tier configuration is not set properly.
     * Field is invalid if it is different than zero and less than value for corresponding field in previous tier,
     * or only one of quantity and discount field in the same tier is not set.
     *
     * @param array $aField Field to validate
     * @param string $prevFieldId ID of corresponding field in previous tier
     * @param int $tierNumber Current tier number
     * @param bool $quantityField TRUE if current field is quantity field
     */
    private function validateB2BDiscountTier(&$aField, $prevFieldId, $tierNumber, $quantityField = false) {
        $value = !empty($aField['value']) ? $aField['value'] : 0;
        $previousValue = null;
        if (!empty($prevFieldId)) {
            $previousValue = $this->getField($prevFieldId, 'value');
            $previousValue = !empty($previousValue) ? $previousValue : 0;
        }
        $tierType = $this->getField('b2bdiscounttype', 'value');

        if ($this->getField('b2bactive', 'value') == 'true' && !empty($tierType)) {
            if (!$quantityField) {
                // Quantity and discount fields should be set either both or none.
                // Check it for discount field only to prevent circular reference and because quantity field is already rendered.
                $quantityId = str_replace($tierNumber.'discount', $tierNumber.'quantity', strtolower($aField['name']));
                $quantityValue = $this->getField($quantityId, 'value');
                if (($value == 0 && $quantityValue != 0) || ($value != 0 && $quantityValue == 0)) {
                    MLMessage::gi()->addError(MLI18n::gi()->get('amazon_config_tier_error', array('TierNumber' => $tierNumber)));
                    $aField['cssclasses'][] = 'ml-error';
                }
            }

            if ($previousValue !== null && ($value > 0 && ($previousValue == 0 || $value <= $previousValue))) {
                MLMessage::gi()->addError(MLI18n::gi()->get('amazon_config_tier_error', array('TierNumber' => $tierNumber - 1)));
            } elseif ($value < 0) {
                MLMessage::gi()->addError(MLI18n::gi()->get('amazon_config_tier_error', array('TierNumber' => $tierNumber)));
                $aField['cssclasses'][] = 'ml-error';
            }
        }
    }
}