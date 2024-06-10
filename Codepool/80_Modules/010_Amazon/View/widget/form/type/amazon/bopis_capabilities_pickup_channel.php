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

 if (!class_exists('ML', false))
     throw new Exception();


$currentField = $aField;
$currentField['type'] = 'subFieldsContainer';
$currentField['incolumn'] = true;
$currentField['subfields'] = array(
    array(
        'name' => $currentField['realname'].'.isSupported',
        'type' => 'radio',
        'values' => array(
            'yes' => MLI18n::gi()->get('ML_BUTTON_LABEL_YES'),
            'no' => MLI18n::gi()->get('ML_BUTTON_LABEL_NO'),
        ),
        'default' => 'yes',
    ),
    array(
        'name' => $currentField['realname'].'.inventoryholdperiod',
        'type' => 'amazon_bopis_handling_time',
    ),
    /*
     * Currently only one handling time is supported, therefore we set all handling times to the same time at the moment
        array(
            'name' => $currentField['realname'].'.handlingtime',
            'type' => 'amazon_bopis_handling_time',
        ),
    */
    array(
        'name' => $currentField['realname'].'.operationalconfiguration',
        'type' => 'amazon_bopis_operational_configuration',
    ),
);
foreach ($currentField['subfields'] as &$aSubfield) {
    $aSubfield = $this->getField($aSubfield);
}

$this->includeType($currentField);
