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

MLSetting::gi()->add('ricardo_config_account', array(
    'tabident' => array(
        'legend' => array(
            'classes' => array(''),
        ),
        'fields' => array(
            array(
                'name' => 'tabident',
                'type' => 'string',
            ),
        ),
    ),
    'account' => array(
        'fields' => array(
            array(
                'name' => 'mpusername',
                'type' => 'string',
            ),
            array(
                'name' => 'mppassword',
                'type' => 'password',
                'savevalue' => '__saved__'
            ),
            array(
                'name' => 'token',
                'type' => 'ricardo_token',
            ),
            array(
                'name' => 'apilang',
                'type' => 'select',
            ),
        ),
    ),
), false);


MLSetting::gi()->add('ricardo_config_prepare', array(
    'prepare' => array(
        'fields' => array(
            array(
                'name' => 'prepare.status',
                'type' => 'bool',
            ),
            array(
                'name' => 'listinglangs',
                'type' => 'checkboxforlangs',
                'isdynamic' => 'false',
            ),
            array(
                'name' => 'langs',
                'type' => 'matching',
            ),
            array(
                'name' => 'descriptiontemplate',
                'type' => 'select',
            ),
            array(
                'name' => 'articlecondition',
                'type' => 'select',
            ),
            array(
                'name' => 'buyingmode',
                'type' => 'select',
                'default' => 'buy_it_now',
            ),
            array(
                'name' => 'priceforauction',
                'type' => 'string',
                'default' => 1.00
            ),
            array(
                'name' => 'priceincrement',
                'type' => 'string',
                'default' => 0.05
            ),
            array(
                'name' => 'duration',
                'type' => 'select'
            ),
            array(
                'name' => 'maxrelistcountfield',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'apilang' => array(
                        'name' => 'maxrelistcount',
                        'type' => 'ajax',
                    ),
                )
            ),
            array(
                'name' => 'warranty',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'warrantycondition' => array(
                        'name' => 'warrantycondition',
                        'type' => 'select',
                    ),
                    'warrantydescription' => array(
                        'name' => 'warrantydescription',
                        'type' => 'ajax'
                    ),
                )
            ),
            array(
                'name' => 'payment',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'paymentmethods' => array(
                        'name' => 'paymentmethods',
                        'type' => 'multipleselect',
                    ),
                    'paymentdescription' => array(
                        'name' => 'paymentdescription',
                        'type' => 'ajax'
                    ),
                )
            ),
            array(
                'name' => 'imagesize',
                'type' => 'select',
                'default' => '500',
                'i18n' => array(
                    'label' => '{#i18n:form_config_orderimport_imagesize_lable#}',
                    'help' => '{#i18n:form_config_orderimport_imagesize_help#}',
                    'hint' => '{#i18n:form_config_orderimport_imagesize_hint#}'
                ),
            ),
            array(
                'name' => 'delivery',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'deliverycondition' => array(
                        'name' => 'deliverycondition',
                        'type' => 'ajax',
                    ),
                    'deliverypackage' => array(
                        'name' => 'deliverypackage',
                        'type' => 'ajax'
                    ),
                    'deliverydescription' => array(
                        'name' => 'deliverydescription',
                        'type' => 'ajax'
                    ),
                    'deliverycost' => array(
                        'name' => 'deliverycost',
                        'type' => 'price',
                        'currency' => 'CHF'
                    ),
                    'cumulative' => array(
                        'name' => 'cumulative',
                        'type' => 'bool',
                    ),
                )
            ),
            array(
                'name' => 'availabilityfield',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'apilang' => array(
                        'name' => 'availability',
                        'type' => 'select',
                    ),
                )
            ),
            array(
                'name' => 'firstpromotion',
                'type' => 'select',
            ),
            array(
                'name' => 'secondpromotion',
                'type' => 'select',
            ),
            array(
                'name' => 'checkin.showlimitationwarning',
                'type' => 'bool',
                'default' => true,
            )
        )
    ),
    'upload' => array(
        'fields' => array(
            array(
                'name' => 'checkin.status',
                'type' => 'bool',
            ),
            array(
                'name' => 'checkin.quantity',
                'type' => 'selectwithtextoption',
                'subfields' => array(
                    'select' => array(
                        'name' => 'quantity.type',
                        'default' => 'stock'
                    ),
                    'string' => array('name' => 'quantity.value'),
                )
            ),
        ),
    ),
), false);

MLSetting::gi()->add('ricardo_config_price', array(
    'price' => array(
        'fields' => array(
            array(
                'name' => 'price',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'addkind' => array('name' => 'price.addkind', 'type' => 'select'),
                    'factor' => array('name' => 'price.factor', 'type' => 'string'),
                    'signal' => array('name' => 'price.signal', 'type' => 'string')
                )
            ),
            array(
                'name' => 'priceoptions',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'group' => array('name' => 'price.group', 'type' => 'select'),
                    'usespecialoffer' => array('name' => 'price.usespecialoffer', 'type' => 'bool'),
                ),
            ),
            array(
                'name' => 'mwst',
                'type' => 'string',
                'expert' => true,
            ),
            array(
                'name' => 'exchangerate_update',
                'type' => 'bool',
            ),
        )
    )
), false);

MLSetting::gi()->add('ricardo_config_sync', array(
    'sync' => array(
        'fields' => array(
            array(
                'name' => 'stocksync.tomarketplace',
                'type' => 'select',/*
                'type' => 'addon_select',
                'addonsku' => 'FastSyncInventory',
                 */
            ),
            array(
                'name' => 'stocksync.frommarketplace',
                'type' => 'select',
            ),
            array(
                'name' => 'inventorysync.price',
                'type' => 'select',
            ),
        )
    )
), false);

MLSetting::gi()->add('ricardo_config_orderimport', array(
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
                'name' => 'orderstatus.open',
                'type' => 'select',
            ),
            'orderimport.shippingmethod' => array(
                'name' => 'orderimport.shippingmethod',
                'type' => 'string',
                'default' => 'Ricardo',
                'expert' => true,
            ),
            'orderimport.paymentmethod' =>'{#setting:formfields__orderimport.paymentmethod#}',
            array(
                'name' => 'customergroup',
                'type' => 'select',
            ),
            array(
                'name' => 'orderimport.shop',
                'type' => 'select',
            ),
        ),
    ),
    'mwst' => array(
        'fields' => array(
            array(
                'name' => 'mwst.fallback',
                'type' => 'string',
            ),
            /*//{search: 1427198983}
            array(
                'name' => 'mwst.shipping',
                'type' => 'string',
            ),
            //*/
        ),
    ),
    'orderstatus' => array(
        'fields' => array(
            array(
                'i18n' => '{#i18n:formfields__orderstatus.sync#}',
                'name' => 'orderstatus.sync',
                'type' => 'select',
            ),
            array(
                'name' => 'orderstatus.shipped',
                'type' => 'select'
            ),
        ),
    )
), false);

MLSetting::gi()->add('ricardo_config_producttemplate', array(
    'product' => array(
        'fields' => array(
            array(
                'name' => 'template.name',
                'type' => 'string',
                'default' => '#TITLE#',
            ),
            array(
                'name' => 'template.content',
                'default' => '{#i18n:ricardo_config_producttemplate_content#}',
                'resetdefault' => '{#i18n:ricardo_config_producttemplate_content#}',
                'type' => 'wysiwyg',
            ),
        ),
    ),
), false);

MLSetting::gi()->add('ricardo_config_emailtemplate', array(
    'mail' => array(
        'fields' => array(
            array(
                'name' => 'mail.send',
                'type' => 'radio',
                'default' => false,
            ),
            array(
                'name' => 'mail.originator.name',
                'type' => 'string',
                'default' => '{#i18n:ricardo_config_account_emailtemplate_sender#}',
            ),
            array(
                'name' => 'mail.originator.adress',
                'type' => 'string',
                'default' => '{#i18n:ricardo_config_account_emailtemplate_sender_email#}',
            ),
            array(
                'name' => 'mail.subject',
                'type' => 'string',
                'default' => '{#i18n:ricardo_config_account_emailtemplate_subject#}',
            ),
            array(
                'name' => 'mail.content',
                'type' => 'configMailContentContainer',
                'default' => '{#i18n:ricardo_config_account_emailtemplate_content#}',
            ),
            array(
                'name' => 'mail.copy',
                'type' => 'radio',
                'default' => true,
            ),
        ),
    ),
), false);
