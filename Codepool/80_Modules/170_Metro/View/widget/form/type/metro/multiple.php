<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<?php
/**
 * this view is used to display feature in prepare for like amazon bullet point
 */
MLSetting::gi()->add('aCss', array('magnalister.metro.prepare.css'), true); ?>
<?php for ($i = 0; $i < $aField['metro_multiple']['max']; ++$i) {
    $aMyField = $this->getSubField($aField);
    $aMyField['cssclasses'][] = 'metroMultiple';
    $aMyField['name'] .= '['.$i.']';
    $aMyField['value'] = isset($aField['value'][$i]) ? $aField['value'][$i] : '';
    $this->includeType($aMyField);
}
