<?php
if (!class_exists('ML', false))
    throw new Exception();
$aValues = isset($aValues) ? $aValues : (isset($aField['values']) ? $aField['values'] : array());
$sValue = isset($sValue) ? $sValue : (isset($aField['value']) ? $aField['value'] : '');

foreach ($aValues as $sOptionKey => $sOptionValue) {
    if (is_array($sOptionValue) && !empty($sOptionValue['optGroupClass'])) {
        $sOptGroupClass = $sOptionValue['optGroupClass'];
        unset($sOptionValue['optGroupClass']);
        ?>
        <optgroup label="<?php echo $sOptionKey; ?>" class="<?php echo $sOptGroupClass; ?>">
            <?php $this->includeType($aField, array('aValues' => $sOptionValue, 'sValue' => $sValue)); ?>
        </optgroup>
    <?php } else {
        // array_merge is intentional because we want "clone" of original field
        // since we are in a loop and upper includeType call expects original field!
        $aOption = array(
            'selected' => is_array($sValue) ? array_key_exists($sOptionKey, $sValue) : (string)$sValue === (string)$sOptionKey,
            'key' => $sOptionKey,
            'value' => isset($sOptionValue['name']) ? $sOptionValue['name'] : $sOptionValue,
            'dataType' => isset($sOptionValue['type']) ? $sOptionValue['type'] : '',
        );


        /*
         * The option view is used a lot, the function includeType takes some more time to find correct option view, because we have
         * only one option view, it is faster to call it directly.
         * If you want to override option view, override current view at first
         */
        include dirname(__FILE__).'/../select/option.php';
//        $optoinField = array_merge($aField, array('type' => 'select_option'));
//        $this->includeType($optoinField, array(
//            'aOption' => array(
//                'selected' => is_array($sValue) ? array_key_exists($sOptionKey, $sValue) : (string) $sValue === (string) $sOptionKey,
//                'key' => $sOptionKey,
//                'value' => is_array($sOptionValue) && array_key_exists('name', $sOptionValue) ? $sOptionValue['name'] : $sOptionValue,
//                'dataType' => is_array($sOptionValue) && array_key_exists('type', $sOptionValue) ? $sOptionValue['type'] : '',
//            ),
//        ));
    }
}
