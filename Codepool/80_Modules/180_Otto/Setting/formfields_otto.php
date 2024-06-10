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

MLSetting::gi()->add('formfields_otto', array(
    'vat' => array(
        'name' => 'vat',
        'type' => 'matching',
        'required' => true
    ),
    'lang' => array(
        'i18n' => '{#i18n:formfields_otto__lang#}',
        'name' => 'lang',
        'type' => 'select',
        'default' => '',
    ),
    'imagesize' => array(
        'i18n' => '{#i18n:formfields_otto__imagesize#}',
        'name' => 'imagesize',
        'type' => 'select',
        'default' => '2000',
    ),
    'delivery' => array(
        'i18n' => '{#i18n:formfields_otto__delivery#}',
        'name' => 'delivery',
        'type' => 'subFieldsContainer',
        'subfields' => array(
            'deliverytype' => array(
                'i18n' => '{#i18n:formfields_otto__deliverytype#}',
                'name' => 'deliverytype',
                'type' => 'select'
            ),
            'deliverytime' => array(
                'i18n' => '{#i18n:formfields_otto__deliverytime#}',
                'name' => 'deliverytime',
                'type' => 'select'
            ),
        ),
    ),
    'mwst' => array(
        'i18n' => '{#i18n:formfields_otto__mwst#}',
        'name' => 'mwst',
        'type' => 'string',
    ),
    'usevariations' => array(
        'i18n' => '{#i18n:formfields_otto__usevariations#}',
        'name' => 'usevariations',
        'type' => 'bool',
        'default' => true
    ),
    'processingtime' => array(
        'i18n' => '{#i18n:formfields_otto__processingtime#}',
        'name' => 'processingtime',
        'type' => 'select',
    ),
    'shippingtype' => array(
        'i18n' => '{#i18n:formfields_otto__shippingtype#}',
        'name' => 'shippingtype',
        'type' => 'select',
    ),
    'prepare_title_disabled' => array(
        'i18n' => '{#i18n:formfields_otto__prepare_title#}',
        'name' => 'TitleDisabled',
        'type' => 'information',
        'singleproduct' => true,
    ),
    'prepare_description' => array(
        'i18n' => '{#i18n:formfields_otto__prepare_description#}',
        'name' => 'Description',
        'type' => 'wysiwyg',
        'singleproduct' => true,
    ),
    'prepare_image' => array(
        'i18n' => '{#i18n:formfields_otto__prepare_image#}',
        'name' => 'Images',
        'type' => 'imagemultipleselect',
        'singleproduct' => true,
    ),
    'prepare_category' => array(
        'label' => '{#i18n:formfields_otto___prepare_variationgroups#}',
        'name' => 'variationgroups',
        'type' => 'otto_categoryselect',
        'subfields' => array(
            'variationgroups.value' => array(
                'label' => '{#i18n:formfields_otto___prepare_variationgroups#}',
                'name' => 'variationgroups.value',
                'type' => 'otto_categoryselect',
                'cattype' => 'marketplace'
            ),
        ),
    ),
    'orderstatus.open' => array(
        'i18n' => '{#i18n:formfields_otto__orderstatus.open#}',
        'name' => 'orderstatus.open',
        'type' => 'select',
    ),
    'orderstatus.carrier.default' => array(
        'i18n' => '{#i18n:formfields__orderstatus.carrier.default#}',
        'name' => 'orderstatus.carrier.default',
        'type' => 'select',
    ),
    'orderimport.paymentmethod' => array(
        'i18n'      => '{#i18n:formfields__orderimport.paymentmethod#}',
        'name'      => 'orderimport.paymentmethod',
        'type'      => 'selectwithtextoption',
        'subfields' => array(
            'select' => array('name' => 'orderimport.paymentmethod', 'type' => 'select'),
            'string' => array('name' => 'orderimport.paymentmethod.name', 'type' => 'string', 'default' => 'otto',)
        ),
        'expert'    => true,
    ),
    'orderimport.shippingmethod' => array(
        'i18n'      => '{#i18n:formfields__orderimport.shippingmethod#}',
        'name'      => 'orderimport.shippingmethod',
        'type'      => 'selectwithtextoption',
        'subfields' => array(
            'select' => array('name' => 'orderimport.shippingmethod', 'type' => 'select'),
            'string' => array('name' => 'orderimport.shippingmethod.name', 'type' => 'string', 'default' => 'otto',)
        ),
        'expert'    => true,
    ),
    'orderstatus.shippedaddress' => array(
        'i18n' => '{#i18n:formfields_otto__orderstatus.shippedaddress#}',
        'name' => 'orderstatus.shippedaddress',
        'type' => 'duplicate',
        'duplicate' => array(
            'field' => array('type' => 'otto_orderstatus_shipped')
        ),
        'subfields' => array(
            array(
                'i18n' => '{#i18n:formfields_otto__orderstatus.shippedaddress.city#}',
                'name' => 'orderstatus.shippedaddress.city',
                'required' => true,
                'type' => 'string'
            ),
            array(
                'i18n' => '{#i18n:formfields_otto__orderstatus.shippedaddress.code#}',
                'name' => 'orderstatus.shippedaddress.code',
                'type' => 'select'
            ),
            array(
                'i18n' => '{#i18n:formfields_otto__orderstatus.shippedaddress.zip#}',
                'name' => 'orderstatus.shippedaddress.zip',
                'required' => true,
                'type' => 'string'
            ),
        ),
    ),

    'orderstatus.sendcarrier' => array(
        'i18n' => '{#i18n:formfields_otto__orderstatus.standardshipping#}',
        'name' => 'orderstatus.sendcarrier',
        'type' => 'selectwithtmatchingoption',
        'subfields' => array(
            'select' => '{#setting:formfields_otto__orderstatus.sendcarrier.select#}',
            'matching' => '{#setting:formfields_otto__orderstatus.sendcarrier.duplicate#}'
        ),
    ),

    'orderstatus.sendcarrier.select' => array(
        'i18n' => array('label' => '',),
        'name' => 'orderstatus.sendcarrier.select',
        'required' => true,
        'matching' => 'sendCarrierMatching', //must be the same as value defined in ConfigData key value for matching
        'type' => 'am_attributesselect'
    ),

    'orderstatus.sendcarrier.duplicate' => array(
        'i18n' => array('label' => '', ),
        'name' => 'orderstatus.sendcarrier.duplicate',
        'norepeat_included' => true,
        'type' => 'duplicate',
        'duplicate' => array(
            'field' => array(
                'type' => 'subFieldsContainer'
            )
        ),
        'subfields' => array(
            array(
                'i18n' => array('label' => ''),
                'name' => 'orderstatus.sendcarrier.matching',
                'breakbefore' => true,
                'type' => 'matchingcarrier',
                'cssclasses' => array('tableHeadCarrierMatching')

            ),
        ),
    ),

    'orderstatus.forwardercarrier' => array(
        'i18n' => '{#i18n:formfields_otto__orderstatus.forwardershipping#}',
        'name' => 'orderstatus.forwardercarrier',
        'type' => 'selectwithtmatchingoption',
        'subfields' => array(
            'select' => '{#setting:formfields_otto__orderstatus.forwardercarrier.select#}',
            'matching' => '{#setting:formfields_otto__orderstatus.forwardercarrier.duplicate#}'
        ),
    ),

    'orderstatus.forwardercarrier.select' => array(
        'i18n' => array('label' => '',),
        'name' => 'orderstatus.forwardercarrier.select',
        'required' => true,
        'matching' => 'forwardingCarrierMatching', //must be the same as value defined in ConfigData key value for matching
        'type' => 'am_attributesselect'
    ),

    'orderstatus.forwardercarrier.duplicate' => array(
        'i18n' => array('label' => '', ),
        'name' => 'orderstatus.forwardercarrier.duplicate',
        'norepeat_included' => true,
        'type' => 'duplicate',
        'duplicate' => array(
            'field' => array(
                'type' => 'subFieldsContainer'
            )
        ),
        'subfields' => array(
            array(
                'i18n' => array('label' => ''),
                'name' => 'orderstatus.forwardercarrier.matching',
                'breakbefore' => true,
                'type' => 'matchingcarrier',
                'cssclasses' => array('tableHeadCarrierMatching')

            ),
        ),
    ),

    'orderstatus.returncarrier' => array(
        'i18n' => '{#i18n:formfields_otto__return.carrier#}',
        'name' => 'orderstatus.returncarrier',
        'type' => 'selectwithtmatchingoption',
        'subfields' => array(
            'select' => '{#setting:formfields_otto__orderstatus.returncarrier.select#}',
            'matching' => '{#setting:formfields_otto__orderstatus.returncarrier.duplicate#}'
        ),
    ),

    'orderstatus.returncarrier.select' => array(
        'i18n' => array('label' => '',),
        'name' => 'orderstatus.returncarrier.select',
        'required' => true,
        'matching' => 'returnCarrierMatching', //must be the same as value defined in ConfigData key value for matching
        'type' => 'am_attributesselect'
    ),

    'orderstatus.returncarrier.duplicate' => array(
        'i18n' => array('label' => '', ),
        'name' => 'orderstatus.returncarrier.duplicate',
        'norepeat_included' => true,
        'type' => 'duplicate',
        'duplicate' => array(
            'field' => array(
                'type' => 'subFieldsContainer'
            )
        ),
        'subfields' => array(
            array(
                'i18n' => array('label' => ''),
                'name' => 'orderstatus.returncarrier.matching',
                'breakbefore' => true,
                'type' => 'matchingcarrier',
                'cssclasses' => array('tableHeadCarrierMatching')

            ),
        ),
    ),
    'orderstatus.returntrackingkey.select' => array(
        'i18n' => '{#i18n:formfields_otto__return.trackingkey#}',
        'name' => 'orderstatus.returntrackingkey.select',
        'cssclasses' => array('ml-translate-toolbar-wrapper'),
        'type' => 'selectwithtmatchingoption',
            'subfields' => array(
                'select' => '{#setting:formfields_otto__orderstatus.returntrackingkey#}',
                'matching' => ''
            ),
    ),

    'orderstatus.returntrackingkey' => array(
        'i18n' => array('label' => '',),
        'name' => 'orderstatus.returntrackingkey',
        'required' => true,
        'tdclass' => 'borderNone',
        'matching' => 'noMatching',
        'type' => 'select'
    ),


    // 'orderstatus.carrier' => array(
    //     'i18n' => '{#i18n:formfields_otto__orderstatus.carrier#}',
    //     'name' => 'orderstatus.carrier',
    //     'type' => 'select',
    // ),
    'prepare_saveaction' => array(
        'name' => 'saveaction',
        'type' => 'submit',
        'value' => 'save',
        'position' => 'right',
    ),
    'prepare_resetaction' => array(
        'name' => 'resetaction',
        'type' => 'submit',
        'value' => 'reset',
        'position' => 'left',
    ),
    'prepare_variationgroups' => array(
        'label' => '{#i18n:formfields_otto___prepare_variationgroups#}',
        'name' => 'variationgroups',
        'type' => 'otto_categoryselect',
        'subfields' => array(
            'variationgroups.value' => array(
                    'label' => '{#i18n:formfields_otto___prepare_variationgroups#}',
                    'name' => 'variationgroups.value',
                    'type' => 'otto_categoryselect',
                    'cattype' => 'marketplace',
                    'value' => null
                ),
        ),
    ),

    'prepare_category_independent_attributes' => array(
        'i18n' => '',
        'name' => 'prepare_category_independent_attributes',
        'type' => 'fieldotto',
    ),

));
