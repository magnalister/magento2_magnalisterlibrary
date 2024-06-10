<?php
 if (!class_exists('ML', false))
     throw new Exception();

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
        'name' => $currentField['realname'].'.contactDetails',
        'type' => 'amazon_bopis_contact_details',
    ),
    array(
        'name' => $currentField['realname'].'.monday',
        'type' => 'amazon_bopis_start_end_time',
    ),
    array(
        'name' => $currentField['realname'].'.tuesday',
        'type' => 'amazon_bopis_start_end_time',
    ),
    array(
        'name' => $currentField['realname'].'.wednesday',
        'type' => 'amazon_bopis_start_end_time',
    ),
    array(
        'name' => $currentField['realname'].'.thursday',
        'type' => 'amazon_bopis_start_end_time',
    ),
    array(
        'name' => $currentField['realname'].'.friday',
        'type' => 'amazon_bopis_start_end_time',
    ),
    array(
        'name' => $currentField['realname'].'.saturday',
        'type' => 'amazon_bopis_start_end_time',
    ),
    array(
        'name' => $currentField['realname'].'.sunday',
        'type' => 'amazon_bopis_start_end_time',
    ),
//    array(
//        'name' => $currentField['realname'].'.throughputConfig',
//        'type' => 'subFieldsContainer',
//        'incolumn' => true,
//        'subfields' => array(
//            array(
//                'name' => $currentField['realname'].'.throughputConfig.value',
//                'type' => 'string'
//            ),
//            array(
//                'name' => $currentField['realname'].'.throughputConfig.timeUnit',
//                'type' => 'select'
//            ),
//        ),
//    )
));

foreach ($currentField['subfields'] as &$aSubfield) {
    $aSubfield = $this->getField($aSubfield);
}

$this->includeType($currentField);
