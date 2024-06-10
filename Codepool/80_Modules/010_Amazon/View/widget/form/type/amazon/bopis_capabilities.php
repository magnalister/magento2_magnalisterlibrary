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
    //                            array(
    //                                'name' => 'bopis.capabilities.returnLocation',
    //                                'type' => 'subFieldsContainer',
    //                                'incolumn' => true,
    //                                'subfields' => array(
    //                                    array(
    //                                        'name' => 'bopis.capabilities.returnLocation.address',
    //                                        'type' => 'amazon_bopis_address',
    //                                    ),
    //                                    array(
    //                                        'name' => 'bopis.capabilities.returnLocation.contactDetails',
    //                                        'type' => 'amazon_bopis_contactDetails',
    //                                    ),
    //                                ),
    //                            ),
    //                            array(
    //                                'name' => 'bopis.capabilities.deliveryChannel',
    //                                'type' => 'subFieldsContainer',
    //                                'incolumn' => true,
    //                                'subfields' => array(
    //                                    array(
    //                                        'name' => 'bopis.capabilities.deliveryChannel.isSupported',
    //                                        'type' => 'radio',
    //                                        'values' => array(
    //                                            'yes' => 'Yes',
    //                                            'no' => 'No',
    //                                        ),
    //                                        'default' => 'no',
    //                                    ),
    //                                    array(
    //                                        'name' => 'bopis.capabilities.deliveryChannel.operationalConfiguration',
    //                                        'type' => 'amazon_bopis_operationalConfiguration',
    //                                    ),
    //                                ),
    //                            ),


$currentField = $aField;
$currentField['type'] = 'subFieldsContainer';
$currentField['incolumn'] = true;
$currentField['subfields'] = array(
    array(
        'name' => $currentField['realname'].'.issupported',
        'type' => 'radio',
        'values' => array(
            'yes' => MLI18n::gi()->get('ML_BUTTON_LABEL_YES'),
            'no' => MLI18n::gi()->get('ML_BUTTON_LABEL_NO'),
        ),
        'default' => 'yes',
    ),
    array(
        'name' => $currentField['realname'].'.operationalconfiguration',
        'type' => 'amazon_bopis_operational_configuration',
    ),
    array(
        'name' => $currentField['realname'].'.pickupchannel',
        'type' => 'amazon_bopis_capabilities_pickup_channel',
    ),
);
foreach ($currentField['subfields'] as &$aSubfield) {
    $aSubfield = $this->getField($aSubfield);
}

$this->includeType($currentField);
