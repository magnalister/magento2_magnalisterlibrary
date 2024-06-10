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

MLSetting::gi()->add('check24_config_account', array(
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
                'name' => 'ftpserver',
                'type' => 'string',
            ),
            array(
                'name' => 'mppassword',
                'type' => 'password',
                'savevalue' => '__saved__'
            ),
            array(
                'name' => 'port',
                'type' => 'string',
            ),
            array(
                'name' => 'csvurl',
                'type' => 'information',
            )
        )
    )
), false);


MLSetting::gi()->add('check24_config_prepare', array(
    'upload' => array(
        'fields' => array(
            array(
                'name' => 'checkin.status',
                'type' => 'bool',
            ),
            array(
                'name' => 'lang',
                'type' => 'select',
            ),
            array(
                'name' => 'imagesize',
                'type' => 'select',
                'default' => '1000'
            ),
            array(
                'name' => 'quantity',
                'type' => 'selectwithtextoption',
                'subfields' => array(
                    'select' => array('name' => 'quantity.type', 'type' => 'select'),
                    'string' => array('name' => 'quantity.value', 'type' => 'string')
                )
            ),
            array(
                'name' => 'shippingtime',
                'type' => 'select'
            ),
            array(
                'name' => 'shippingcost',
                'type' => 'string'
            ),
            array(
                'name' => 'delivery',
                'type' => 'selectwithtextoption',
                'subfields' => array (
                    'select' => array(
                        'name' => 'deliverymode',
                        'type' => 'select',
                        'values' => array(
                            '' => array(
                                'title' => '-',
                                'textoption' => false
                            ),
                            'Paket' => array(
                                'title' => '{#i18n:check24_deliverymode_paket#}',
                                'textoption' => false
                            ),
                            'Warensendung' => array(
                                'title' => '{#i18n:check24_deliverymode_warensendung#}',
                                'textoption' => false
                            ),
                            'Spedition' => array(
                                'title' => '{#i18n:check24_deliverymode_spedition#}',
                                'textoption' => false
                            ),
                            'Sperrgut' => array(
                                'title' => '{#i18n:check24_deliverymode_sperrgut#}',
                                'textoption' => false
                            ),
                            'EigeneAngaben' => array(
                                'title' => '{#i18n:check24_deliverymode_eigene_angaben#}',
                                'textoption' => true
                            )
                        ),
                    ),
                    'string' => array(
                        'name' => 'deliverymodetext',
                        'type' => 'string'
                    ),
                )
            ),
            array(
                'name' => 'two_men_handling',
                'type' => 'string',
            ),
            array(
                'name' => 'installation_service',
                'type' => 'select',
            ),
            array(
                'name' => 'removal_old_item',
                'type' => 'select',
            ),
            array(
                'name' => 'removal_packaging',
                'type' => 'select',
            ),
            array(
                'name' => 'available_service_product_ids',
                'type' => 'string',
            ),
            array(
                'name' => 'logistics_provider',
                'type' => 'string',
            ),
            array(
                'name' => 'custom_tariffs_number',
                'type' => 'string',
            ),
            array(
                'name' => 'return_shipping_costs',
                'type' => 'string',
            ),
        ),
    ),
), false);

MLSetting::gi()->add('check24_config_price', array(
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
                'name' => 'exchangerate_update',
                'type' => 'bool',
            ),
        )
    )
), false);

MLSetting::gi()->add('check24_config_sync', array(
    'sync' => array(
        'fields' => array(
            array(
                'name' => 'stocksync.tomarketplace',
                'type' => 'select',/*
                'type' => 'addon_select',
                'addonsku' => 'FastSyncInventory',*/
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

MLSetting::gi()->add('check24_config_orderimport', array(
    'importactive' => array(
        'fields' => array(
            array(
                'name' => 'importactive',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'import' => array('name' => 'import', 'type' => 'radio', ),
                    'preimport.start' => array('name' => 'preimport.start', 'type' => 'datepicker'),
                ),
            ),
            array(
                'name' => 'customergroup',
                'type' => 'select',
            ),
            array(
                'name' => 'orderimport.shop',
                'type' => 'select',
            ),
            array(
                'name' => 'orderstatus.open',
                'type' => 'select',
            ),
            'orderimport.shippingmethod' => array(
                'name' => 'orderimport.shippingmethod',
                'type' => 'string',
                'default' => 'Check24',
                'expert' => true,
            ),
            'orderimport.paymentmethod' =>'{#setting:formfields__orderimport.paymentmethod#}',
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
), false);


MLSetting::gi()->add('check24_config_emailtemplate', array(
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
                'default' => '{#i18n:check24_config_account_emailtemplate_sender#}',
            ),
            array(
                'name' => 'mail.originator.adress',
                'type' => 'string',
                'default' => '{#i18n:check24_config_account_emailtemplate_sender_email#}',
            ),
            array(
                'name' => 'mail.subject',
                'type' => 'string',
                'default' => '{#i18n:check24_config_account_emailtemplate_subject#}',
            ),
            array(
                'name' => 'mail.content',
                'type' => 'configMailContentContainer',
                'default' => '{#i18n:check24_config_account_emailtemplate_content#}',
            ),
            array(
                'name' => 'mail.copy',
                'type' => 'radio',
                'default' => true,
            ),
        ),
    ),
), false);
