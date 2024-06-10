<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<?php MLSetting::gi()->add('aCss', array('magnalister.amazon.prepare.css'), true); ?>
<?php for ($i = 0; $i < $aField['amazon_multiple']['max']; ++$i) {
    $aMyField = $this->getSubField($aField);
    $aMyField['cssclasses'][] = 'amazonMultiple';
    $aMyField['name'] .= '['.$i.']';
    $aMyField['value'] = isset($aField['value'][$i]) ? $aField['value'][$i] : '';
    $this->includeType($aMyField);
}