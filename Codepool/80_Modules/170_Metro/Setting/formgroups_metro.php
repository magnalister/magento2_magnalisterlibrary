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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

/**
 * all groups using form-fields and includes i18n for legend directly
 */

MLSetting::gi()->add('formgroups_metro__account', array(
    'legend' => array('i18n' => '{#i18n:formgroups_metro__account#}',),
    'fields' => array(
        'clientkey' => array(
            'i18n' => '{#i18n:formfields_metro__clientkey#}',
            'name' => 'clientkey',
            'type' => 'string',
        ),
        'secretkey' => array(
            'i18n' => '{#i18n:formfields_metro__secretkey#}',
            'name' => 'secretkey',
            'type' => 'password',
            'savevalue' => '__saved__',
        ),
        'shippingdestination' => array(
            'i18n' => '{#i18n:formfields_metro__shippingdestination#}',
            'name' => 'shippingdestination',
            'type' => 'select',
            'values' => array(
                'DE_MAIN' => 'METRO MARKETS {#i18n:ML_COUNTRY_GERMANY#}',
                'ES_MAIN' => 'METRO MARKETS {#i18n:ML_COUNTRY_SPAIN#}',
                'IT_MAIN' => 'METRO MARKETS {#i18n:ML_COUNTRY_ITALY#}',
                'PT_MAIN' => 'METRO MARKETS {#i18n:ML_COUNTRY_PORTUGAL#}',
                'NL_MAIN' => 'METRO MARKETS {#i18n:ML_COUNTRY_NETHERLANDS#}',
                'FR_MAIN' => 'METRO MARKETS {#i18n:ML_COUNTRY_FRANCE#}',
            ),
            'default' => 'DE_MAIN',
        ),
        'shippingorigin' => array(
            'i18n' => '{#i18n:formfields_metro__shippingorigin#}',
            'name' => 'shippingorigin',
            'type' => 'select',
            'values' => array(
                'DE_MAIN' => '{#i18n:ML_COUNTRY_GERMANY#}',
                'ES_MAIN' => '{#i18n:ML_COUNTRY_SPAIN#}',
                'IT_MAIN' => '{#i18n:ML_COUNTRY_ITALY#}',
                'PT_MAIN' => '{#i18n:ML_COUNTRY_PORTUGAL#}',
                'NL_MAIN' => '{#i18n:ML_COUNTRY_NETHERLANDS#}',
                'FR_MAIN' => '{#i18n:ML_COUNTRY_FRANCE#}',
            ),
            'default' => 'DE_MAIN',
        ),
    ),
));

MLSetting::gi()->add('formgroups_metro__prepare', array(
    'legend' => array('i18n' => '{#i18n:formgroups_metro__prepare#}'),
    'fields' => array(
        'prepare.status' => '{#setting:formfields__prepare.status#}',
        'processingtime' => '{#setting:formfields_metro__processingtime#}',
        'maxprocessingtime' => '{#setting:formfields_metro__maxprocessingtime#}',
        'businessmodel' => '{#setting:formfields_metro__businessmodel#}',
        'freightforwarding' => '{#setting:formfields_metro__freightforwarding#}',
    ),
));

MLSetting::gi()->add('formgroups_metro__shipping', array(
    'legend' => array('i18n' => 'Shipping'),
    'fields' => array(
        'shippingprofile' => array(
            'i18n' => '{#i18n:formfields_metro__shippingprofile#}',
            'name' => 'shippingprofile',
            'type' => 'duplicate',
            'duplicate' => array(
                'radiogroup' => 'default',
                'field' => array('type' => 'subFieldsContainer')
            ),
            'subfields' => array(
                array('name' => 'shippingprofile.name', 'type' => 'string'),
                array('name' => 'shippingprofile.cost', 'type' => 'string'),
            )
        ),
        'shippinggroup' => array(
            'name' => 'shipping.group',
            'type' => 'duplicate',
            'duplicate' => array(
                'radiogroup' => 'default',
                'field' => array('type' => 'subFieldsContainer')
            ),
            'subfields' => array(
                array('name' => 'shipping.group.name', 'type' => 'string'),
            )
        ),
    ),
));

MLSetting::gi()->add('formgroups_metro__importactive', array(
    'legend' => array('i18n' => '{#i18n:formgroups_metro__importactive#}'),
    'fields' => array(
        'importactive' => '{#setting:formfields__importactive#}',
        'customergroup' => '{#setting:formfields__customergroup#}',
        'orderimport.shop' => '{#setting:formfields__orderimport.shop#}',
        'orderstatus.open' => '{#setting:formfields__orderstatus.open#}',

    )
));
MLSetting::gi()->add('formgroups_metro__quantity', array(
    'legend' => array('i18n' => '{#i18n:formgroups_legend_quantity#}'),
    'fields' => array(
        'quantity' => '{#setting:formfields__quantity#}',
        'maxquantity' => '{#setting:formfields__maxquantity#}',
    )
));

MLSetting::gi()->add('formgroups_metro__upload', array(
    'legend' => array('i18n' => '{#i18n:formgroups_metro__upload#}'),
    'fields' => array(
        'checkin.status' => '{#setting:formfields__checkin.status#}',
        'lang' => '{#setting:formfields__lang#}',
    ),
));
MLSetting::gi()->add('formgroups_metro__orderstatus', array(
    'legend' => array('i18n' => '{#i18n:formgroups_metro__orderstatus#}'),
    'fields' => array(
        'orderstatus.sync' => '{#setting:formfields__orderstatus.sync#}',
        'orderstatus.shipped' => '{#setting:formfields__orderstatus.shipped#}',
        'orderstatus.carrier' => '{#setting:formfields_metro__orderstatus.carrier#}',
        'orderstatus.canceled' => '{#setting:formfields__orderstatus.canceled#}',
        'orderstatus.cancellationreason' => '{#setting:formfields_metro__orderstatus.cancellationreason#}',
        //'orderstatus.accepted' => array(
        //    'i18n' => '{#i18n:formfields_metro__orderstatus.accepted#}',
        //    'name' => 'orderstatus.accepted',
        //    'type' => 'select',
        //),
    ),
));

// prepare
MLSetting::gi()->add('formgroups_metro__prepare_details', array(
        'legend' => array('i18n' => '{#i18n:formgroups_metro__prepare_details#}'),
        'fields' => array(
            'Title' => '{#setting:formfields_metro__prepare_title#}',
            'Shortdescription' => '{#setting:formfields_metro__prepare_shortdescription#}',
            'Description' => '{#setting:formfields_metro__prepare_description#}',
            'Image' => '{#setting:formfields_metro__prepare_image#}',
            'GTIN' => '{#setting:formfields_metro__prepare_gtin#}',
            'Manufacturer' => '{#setting:formfields_metro__prepare_manufacturer#}',
            'ManufacturerPartNumber' => '{#setting:formfields_metro__prepare_manufacturerpartnumber#}',
            'Brand' => '{#setting:formfields_metro__prepare_brand#}',
            'Feature' => '{#setting:formfields_metro__prepare_feature#}',
            'ManufacturersSuggestedRetailPrice' => '{#setting:formfields_metro__prepare_msrp#}',
        ),
    )
);

MLSetting::gi()->add('formgroups_metro__prepare_general', array(
        'legend' => array('i18n' => '{#i18n:formgroups_metro__prepare_general#}'),
        'fields' => array(
            'processingtime' => '{#setting:formfields_metro__processingtime#}',
            'maxprocessingtime' => '{#setting:formfields_metro__maxprocessingtime#}',
            'businessmodel' => '{#setting:formfields_metro__businessmodel#}',
            'freightforwarding' => '{#setting:formfields_metro__freightforwarding#}',
            'ShippingProfile' => '{#setting:formfields_metro__shippingprofile#}',
            'ShippingGroup' => '{#setting:formfields_metro__shippinggroup#}',
        ),
    )
);

MLSetting::gi()->add('formgroups_metro__prepare_category', array(
        'legend' => array('i18n' => '{#i18n:formgroups_metro__prepare_category#}'),
        'fields' => array(
            'category' => '{#setting:formfields_metro__prepare_category#}',
        ),
    )
);

MLSetting::gi()->add('formgroups_metro__prepare_action', array(
    'legend' => array(
        'classes' => array(
            /*'mlhidden',*/
        ),
    ),
    'row' => array(
        'template' => 'action-row-row-row',
    ),
    'fields' => array(
        'saveaction' => '{#setting:formfields_metro__prepare_saveaction#}',
        'resetaction' => '{#setting:formfields_metro__prepare_resetaction#}',
    ),
));

MLSetting::gi()->add('formgroups_metro__prepare_variationmatching', array(
    'legend' => array('template' => 'two-columns'),
    'type' => 'ajaxfieldset',
    'field' => array(
        'name' => 'variationmatching',
        'type' => 'ajax',
    ),
));

MLSetting::gi()->add('formgroups_metro__prepare_variations', array(
    'legend' => array('i18n' => '{#i18n:formgroups_metro__prepare_variations#}'),
    'fields' => array(
        'variationgroups' => '{#setting:formfields_metro__prepare_variationgroups#}',
    ),
));

MLSetting::gi()->add('formgroups_metro__invoice',
    array(
        'legend' => array('i18n' => '{#i18n:config_headline_uploadinvoiceoption#}'),
        'fields' =>
            array(
                'uploadInvoiceOption' => '{#setting:formfields__config_uploadinvoiceoption#}',
            ),
    )
);

MLSetting::gi()->set('formgroups_metro__erpInvoice', '{#setting:formgroups__config_erpInvoice#}');
MLSetting::gi()->set('formgroups_metro__magnaInvoice', '{#setting:formgroups__config_magnaInvoice#}');

MLSetting::gi()->add('formgroups_metro__volumeprices', array(
    'legend' => array('i18n' => '{#i18n:formgroups_metro__volumeprices#}'),
    'fields' => array(
        'enable' => '{#setting:formfields_metro__VolumepricesEnable#}',
        'webshopcustomergroup' => '{#setting:formfields_metro__VolumepricesWebshopCustomerGroup#}',
        'webshoppriceoptions' => '{#setting:formfields_metro__VolumepricesWebshopPriceOptions#}',
        'price2' => '{#setting:formfields_metro__VolumepricePrice2#}',
        'price3' => '{#setting:formfields_metro__VolumepricePrice3#}',
        'price4' => '{#setting:formfields_metro__VolumepricePrice4#}',
        'price5' => '{#setting:formfields_metro__VolumepricePrice5#}',
        'priceA' => '{#setting:formfields_metro__VolumepricePriceA#}',
        'priceB' => '{#setting:formfields_metro__VolumepricePriceB#}',
    )
));
