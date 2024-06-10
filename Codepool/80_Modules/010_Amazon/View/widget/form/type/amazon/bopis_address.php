<?php
 if (!class_exists('ML', false))
     throw new Exception();

$aField['value'] = null;
$currentField = $aField;
$currentField['type'] = 'subFieldsContainer';
$currentField['incolumn'] = true;
$currentField['subfields'] = array();

if (    array_key_exists('ismaster', $currentField) && $currentField['ismaster'] === false
    || !array_key_exists('ismaster', $currentField)
) {
    $currentField['subfields'] = array(
        array(
            'name' => $currentField['realname'].'.usefrommaster',
            'type' => 'radio',
            'values' => array(
                'yes' => MLI18n::gi()->get('ML_BUTTON_LABEL_YES'),
                'no' => MLI18n::gi()->get('ML_BUTTON_LABEL_NO'),
            ),
            'default' => 'yes',
        ),
    );
}

$currentField['subfields'] = array_merge($currentField['subfields'], array(
    array(
        'name' => $currentField['realname'].'.addressline1',
        'type' => 'string'
    ),
    array(
        'name' => $currentField['realname'].'.addressline2',
        'type' => 'string'
    ),
    array(
        'name' => $currentField['realname'].'.addressline3',
        'type' => 'string'
    ),
    array(
        'name' => $currentField['realname'].'.city',
        'type' => 'string'
    ),
    array(
        'name' => $currentField['realname'].'.county',
        'type' => 'string'
    ),
    array(
        'name' => $currentField['realname'].'.district',
        'type' => 'string'
    ),
    array(
        'name' => $currentField['realname'].'.stateorregion',
        'type' => 'string'
    ),
    array(
        'name' => $currentField['realname'].'.postalcode',
        'type' => 'string'
    ),
    array(
        'name' => $currentField['realname'].'.countrycode',
        'type' => 'select',
        'default' => 'DE'
    ),
    array(
        'name' => $currentField['realname'].'.phone',
        'type' => 'string'
    ),
));
foreach ($currentField['subfields'] as &$aSubfield) {
    $aSubfield = $this->getField($aSubfield);
}
$aField['subfields'] = $currentField['subfields'];
$this->includeType($currentField);
