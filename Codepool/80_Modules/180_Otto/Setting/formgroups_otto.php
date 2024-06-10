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

MLSetting::gi()->add('formgroups_otto__account', array(
    'legend' => array('i18n' => '{#i18n:formgroups_otto__account#}',),
    'fields' => array(
        'token' => array(
            'i18n' => '{#i18n:formfields_otto__token#}',
            'name' => 'token',
            'type' => 'otto_token',
        ),
    ),
));

MLSetting::gi()->add('formgroups_otto__prepare', array(
    'legend' => array('i18n' => '{#i18n:formgroups_otto__prepare#}'),
    'fields' => array(
        'prepare.status' => '{#setting:formfields__prepare.status#}',
        'vat' => '{#setting:formfields_otto__vat#}',
        'delivery' => '{#setting:formfields_otto__delivery#}'
    ),
));

MLSetting::gi()->add('formgroups_otto__importactive', array(
    'legend' => array('i18n' => '{#i18n:formgroups_otto__importactive#}'),
    'fields' => array(
        'importactive' => '{#setting:formfields__importactive#}',
        'customergroup' => '{#setting:formfields__customergroup#}',
        'orderimport.shop' => '{#setting:formfields__orderimport.shop#}',
        'orderstatus.open' => '{#setting:formfields__orderstatus.open#}',
    )
));

MLSetting::gi()->add('formgroups_otto__quantity', array(
    'legend' => array('i18n' => '{#i18n:formgroups_legend_quantity#}'),
    'fields' => array(
        'quantity' => '{#setting:formfields__quantity#}',
        'maxquantity' => '{#setting:formfields__maxquantity#}',
    )
));

MLSetting::gi()->add('formgroups_otto__upload', array(
    'legend' => array('i18n' => '{#i18n:formgroups_otto__upload#}'),
    'fields' => array(
        'checkin.status' => '{#setting:formfields__checkin.status#}',
        'lang' => '{#setting:formfields_otto__lang#}',
        'imagesize' => '{#setting:formfields_otto__imagesize#}',
    ),
));

MLSetting::gi()->add('formgroups_otto__orderimport', array(
    'legend' => array('i18n' => '{#i18n:formgroups__orderimport#}'),
    'fields' => array(
        'importactive' => '{#setting:formfields__importactive#}',
        'customergroup' => '{#setting:formfields__customergroup#}',
        'orderimport.shop' => '{#setting:formfields__orderimport.shop#}',
    ),
));

MLSetting::gi()->add('formgroups_otto__orderstatusimport', array(
    'legned' => array('i18n' => '{#i18n:formgroups_otto__orderstatusimport#}'),
    'fields' => array(
        'orderstatus.open' => '{#setting:formfields_otto__orderstatus.open#}',
    ),
));

MLSetting::gi()->add('formgroups_otto_paymentandshipping', array(
    'legned' => array('i18n' => '{#i18n:formgroups_otto__paymentandshipping#}'),
    'fields' => array(
        'orderimport.paymentmethod' => '{#setting:formfields_otto__orderimport.paymentmethod#}',
        'orderimport.shippingmethod' => '{#setting:formfields_otto__orderimport.shippingmethod#}',
    ),
));

MLSetting::gi()->add('formgroups_otto__orderstatus', array(
    'legend' => array('i18n' => '{#i18n:formgroups_otto__orderstatus#}'),
    'fields' => array(
        'orderstatus.sync' => '{#setting:formfields__orderstatus.sync#}',
        'orderstatus.standardshipping' => '{#setting:formfields_otto__orderstatus.sendcarrier#}',
        'orderstatus.forwardershipping' => '{#setting:formfields_otto__orderstatus.forwardercarrier#}',
        'orderstatus.shippedaddress' => '{#setting:formfields_otto__orderstatus.shippedaddress#}',
        'orderstatus.returncarrier' => '{#setting:formfields_otto__orderstatus.returncarrier#}',
        'orderstatus.returntrackingkey' => '{#setting:formfields_otto__orderstatus.returntrackingkey.select#}',
        'orderstatus.canceled' => '{#setting:formfields__orderstatus.canceled#}',
    ),
));

MLSetting::gi()->add('formgroups_otto_paymentandshipping', array(
    'legned' => array('i18n' => '{#i18n:formgroups_otto__paymentandshipping#}'),
    'fields' => array(),
));

// prepare
MLSetting::gi()->add('formgroups_otto__prepare_details', array(
        'legend' => array('i18n' => '{#i18n:formgroups_otto__prepare_details#}'),
        'fields' => array(
            'TitleDisabled' => '{#setting:formfields_otto__prepare_title_disabled#}',
            'Description' => '{#setting:formfields_otto__prepare_description#}',
            'Image' => '{#setting:formfields_otto__prepare_image#}',
        ),
    )
);

MLSetting::gi()->add('formgroups_otto__prepare_general', array(
        'legend' => array('i18n' => '{#i18n:formgroups_otto__prepare_general#}'),
        'fields' => array(
            'delivery' => '{#setting:formfields_otto__delivery#}',
        ),
    )
);


//TODO add view for prepare form
MLSetting::gi()->add('formgroups_otto__prepare_category', array(
        'legend' => array('i18n' => '{#i18n:formgroups_otto__prepare_category#}'),
        'fields' => array(
            'category' => '{#setting:formfields_otto__prepare_category#}',
        ),
    )
);

MLSetting::gi()->add('formgroups_otto__prepare_action', array(
    'legend' => array(
        'classes' => array(
            /*'mlhidden',*/
        ),
    ),
    'row' => array(
        'template' => 'action-row-row-row',
    ),
    'fields' => array(
        'saveaction' => '{#setting:formfields_otto__prepare_saveaction#}',
        'resetaction' => '{#setting:formfields_otto__prepare_resetaction#}',
    ),
));
MLSetting::gi()->add('formgroups_otto__prepare_variationmatching', array(
    'type' => 'ajaxfieldset',
    'field' => array(
        'name' => 'variationmatching',
        'type' => 'ajax',
    ),
));
MLSetting::gi()->add('formgroups_otto__prepare_category_independent_attributes', array(
        'type' => 'fieldotto',
        'field' => array(
            'name' => 'prepare_category_independent_attributes',
        ),
    )
);
MLSetting::gi()->add('formgroups_otto__prepare_variations', array(
    'legend' => array('i18n' => '{#i18n:formgroups_otto__prepare_variations#}'),
    'fields' => array(
        'variationgroups' => '{#setting:formfields_otto__prepare_variationgroups#}',
    ),
));
