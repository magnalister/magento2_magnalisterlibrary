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

if (!class_exists('ML', false))
    throw new Exception();
$aValues = isset($aValues) ? $aValues : (isset($aField['values']) ? $aField['values'] : array());
$sValue = isset($sValue) ? $sValue : (isset($aField['value']) ? $aField['value'] : '');


// performance: cache rendered-options in settings (only current request) for dont renderer them multiple times
$sRenderedOptions = 'rendered_form_select_options_'.md5(json_encode(array('value' => $sValue, 'values' => $aValues,)));
try {
    echo MLSetting::gi()->get($sRenderedOptions);
} catch (MLSetting_Exception $oEx) {
    ob_start();
    foreach ($aValues as $sOptionKey => $sOptionValue) {
        if (is_array($sOptionValue)) {
            $sOptGroupClass = '';
            if (!empty($sOptionValue['optGroupClass'])) {
                $sOptGroupClass = $sOptionValue['optGroupClass'];
                unset($sOptionValue['optGroupClass']);
            }
            ?>
            <optgroup label="<?php echo $sOptionKey; ?>" class="<?php echo $sOptGroupClass; ?>">
                <?php $this->includeType($aField, array('aValues' => $sOptionValue, 'sValue' => $sValue)); ?>
            </optgroup>
        <?php } else {
            if (array_key_exists('multiple', $aField) && $aField['multiple']) {
                $blSelected = in_array($sOptionKey, (array)$sValue);
            } else {
                $blSelected = is_array($sValue) === false && (string) $sValue === (string) $sOptionKey;
            }
            $aOption = array(
                'selected' => $blSelected,
                'key'      => $sOptionKey,
                'value'    => $sOptionValue,
                'disabled' => isset($aField['disableditems']) && in_array($sOptionKey, $aField['disableditems'], true)
            );
            /*
             * The option view is used a lot, the function includeType takes some more time to find correct option view, because we have
             * only one option view, it is faster to call it directly.
             * If you want to override option view, override current view at first
             */
            include dirname(__FILE__).'/option.php';
//            $this->includeType(array_merge($aField, array('type' => 'select_option')), array('aOption' => array(
//                'selected' => $blSelected,
//                'key' => $sOptionKey,
//                'value' => $sOptionValue
//            )));
        }
    }
    MLSetting::gi()->set($sRenderedOptions, ob_get_contents());
    ob_end_clean();
    echo MLSetting::gi()->get($sRenderedOptions);
}