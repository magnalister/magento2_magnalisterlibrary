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

MLSetting::gi()->add('hood_config_account', array(
    'tabident' => '{#setting:formgroups__tabident#}',
    'account' => '{#setting:formgroups_hood__account#}',
), false);


MLSetting::gi()->add('hood_config_prepare', array(
    'prepare' => '{#setting:formgroups_hood__prepare#}',
    'fixedprice' => '{#setting:formgroups_hood__prepare_fixedprice#}',
    'chineseprice' => '{#setting:formgroups_hood__prepare_chineseprice#}',
    'pictures' => array(
        'fields' => array(
            array(
                'name' => 'imagesize',
                'type' => 'select',
            ),
        ),
    ),
    'payment' => '{#setting:formgroups_hood__payment#}',
    'shipping' => '{#setting:formgroups_hood__shipping#}',
    'misc' => '{#setting:formgroups_hood__misc#}',
), false);

MLSetting::gi()->add('hood_config_price', array(
    'fixedprice' => '{#setting:formgroups_hood__price_fixedprice#}',
    'chineseprice' => '{#setting:formgroups_hood__price_chineseprice#}',
    'price' => '{#setting:formgroups_hood__price#}',

), false);


MLSetting::gi()->add('hood_config_sync', array(
    'sync' => '{#setting:formgroups__sync#}',
    'syncchinese' => '{#setting:formgroups_hood__syncchinese#}',
), false);

MLSetting::gi()->add('hood_config_orderimport', array(
    'importactive' => array(
        'fields' => array(
            array(
                'name' => 'importactive',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'import' => array('name' => 'import', 'type' => 'radio',),
                    'preimport.start' => array('name' => 'preimport.start', 'type' => 'datepicker'),
                ),
            ),
            array(
                'name' => 'customergroup',
                'type' => 'select',
            ),
            'orderstatus.open' => array(
                'name' => 'orderstatus.open',
                'type' => 'select',
            ),
            'importonlypaid' => array(
                'name' => 'importonlypaid',
                'type' => 'bool',
            ),
            array(
                'name' => 'orderimport.shop',
                'type' => 'select',
            ),
            'orderimport.shippingmethod' => array(
                'name' => 'orderimport.shippingmethod',
                'type' => 'selectwithtextoption',
                'subfields' => array(
                    'select' => array('name' => 'orderimport.shippingmethod', 'type' => 'select'),
                    'string' => array('name' => 'orderimport.shippingmethod.name', 'type' => 'string', 'default' => 'hood',)
                ),
                'expert' => true,
            ),
            'orderimport.paymentmethod' => array(
                'name' => 'orderimport.paymentmethod',
                'type' => 'selectwithtextoption',
                'subfields' => array(
                    'select' => array('name' => 'orderimport.paymentmethod', 'type' => 'select'),
                    'string' => array('name' => 'orderimport.paymentmethod.name', 'type' => 'string', 'default' => 'hood',)
                ),
                'expert' => true,
            ),
        ),
    ),
    'mwst' => array(
        'fields' => array(
            array(
                'name' => 'mwstfallback',
                'type' => 'string',
                'default' => 19,
            ),
        ),
    ),
    'orderstatus' => '{#setting:formgroups_hood__orderstatus#}',
), false);


MLSetting::gi()->add('hood_config_emailtemplate', array(
    'mail' => '{#setting:formgroups__mail#}'
), false);


MLSetting::gi()->add('hood_config_producttemplate', array(
    'product' => array(
        'fields' => array(
            array(
                'name' => 'template.name',
                'type' => 'string',
                'default' => '#TITLE#',
            ),
            array(
                'name' => 'template.content',
                'type' => 'wysiwyg',
                'default' => '{#i18n:hood_config_producttemplate_content#}',
                'resetdefault' => '{#i18n:hood_config_producttemplate_content#}',
                // 'fullwidth' => true,
            ),
        ),
    ),
), false);
