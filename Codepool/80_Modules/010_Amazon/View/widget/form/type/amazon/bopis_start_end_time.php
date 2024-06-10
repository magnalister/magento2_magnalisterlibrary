<?php
 if (!class_exists('ML', false))
     throw new Exception();

$currentField = $aField;
$currentField['type'] = 'subFieldsContainer';
$currentField['incolumn'] = false;

//default values only for monday to friday
$startDefault = '09:00';
$endDefault = '17:00';
if (    strpos($currentField['realname'], 'saturday') !== false
    || strpos($currentField['realname'], 'sunday') !== false
) {
    $startDefault = '';
    $endDefault = '';
}

$currentField['subfields'] = array(
    array(
        'name' => $currentField['realname'].'.startTime',
        'type' => 'string',
        'placeholder' => '09:00',
        'default' => $startDefault,
    ),
    array(
        'name' => $currentField['realname'].'.endTime',
        'type' => 'string',
        'placeholder' => '17:00',
        'default' => $endDefault,
    ),
);

foreach ($currentField['subfields'] as &$aSubfield) {
    $aSubfield = $this->getField($aSubfield);
}

$this->includeType($currentField);
