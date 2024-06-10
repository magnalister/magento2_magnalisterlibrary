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

MLSetting::gi()->add('hitmeister_config_account', array(
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
                'name' => 'clientkey',
                'type' => 'string',
            ),
            array(
                'name' => 'secretkey',
                'type' => 'password',
                'savevalue' => '__saved__'
            ),
        ),
    ),
), false);

MLSetting::gi()->add('hitmeister_config_country', [
    'country' => [
        'fields' => [
            'site' => [
                'name' => 'site',
                'type' => 'select'
            ],
            'currency' => [
                'name' => 'currency',
                'type' => 'information'
            ],
        ]
    ]
], false);

MLSetting::gi()->add('hitmeister_config_prepare', array(
    'prepare' => array(
        'fields' => array(
            array(
                'name' => 'prepare.status',
                'type' => 'bool',
            ),
            array(
                'name' => 'lang',
                'type' => 'select',
            ),
             array(
                'name' => 'imagepath',
                'type' => 'string',
                'expert' => true,
            ),
            array(
                'name' => 'itemcondition',
                'type' => 'select',
            ),
            array(
                'name' => 'handlingtime',
                'type' => 'select',
            ),
            array(
                'name' => 'itemcountry',
                'type' => 'select',
            ),
            array(
                'name' => 'shippinggroup',
                'type' => 'select',
            ),
            array(
                'name' => 'itemsperpage',
                'type' => 'string',
                'default' => 10,
            ),
        )
    ),
    'upload' => array(
        'fields' => array(
            array(
                'name' => 'checkin.status',
                'type' => 'bool',
            ),
            array(
                'name' => 'checkin.variationtitle',
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

MLSetting::gi()->add('hitmeister_config_priceandstock', array(
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
    ),
    'price.lowest' => array(
        'fields' => array(
            array(
                'name' => 'minimumpriceautomatic',
                'type' => 'select',
                'default' => true,
            ),
            array(
                'name' => 'price.lowest',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'addkind' => array('name' => 'price.lowest.addkind', 'type' => 'select'),
                    'factor' => array('name' => 'price.lowest.factor', 'type' => 'string'),
                    'signal' => array('name' => 'price.lowest.signal', 'type' => 'string')
                )
            ),
            array(
                'name' => 'priceoptions.lowest',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'group' => array('name' => 'price.lowest.group', 'type' => 'select'),
                    'usespecialoffer' => array('name' => 'price.lowest.usespecialoffer', 'type' => 'bool'),
                ),
            ),
        )
    ),
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

MLSetting::gi()->add('hitmeister_config_orderimport', array(
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
                'name' => 'orderstatus.open',
                'type' => 'select',
            ),
            array(
                'name' => 'orderstatus.fbk',
                'type' => 'select',
            ),
            array(
                'name' => 'customergroup',
                'type' => 'select',
            ),
            array(
                'name' => 'orderimport.shop',
                'type' => 'select',
            ),
            'orderimport.shippingmethod' => array(
                'name'      => 'orderimport.shippingmethod',
                'type'      => 'selectwithtextoption',
                'subfields' => array(
                    'select' => array('name' => 'orderimport.shippingmethod', 'type' => 'select'),
                    'string' => array('name' => 'orderimport.shippingmethod.name', 'type' => 'string', 'default' => '{#setting:currentMarketplaceName#}',)
                ),
                'expert'    => true,
            ),
        ),
    ),
    'mwst' => array(
        'fields' => array(
            array(
                'name' => 'mwst.fallback',
                'type' => 'string',
            ),
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
            array(
                'name' => 'orderstatus.carrier',
                'type' => 'select'
            ),
            array(
                'name' => 'orderstatus.cancelled',
                'type' => 'select'
            ),
            //            array(
            //                'name' => 'orderstatus.carrier',
            //                'type' => 'select'
            //            ),
            array(
                'name' => 'orderstatus.cancelreason',
                'type' => 'select'
            ),
        ),
    )
), false);

MLSetting::gi()->add('hitmeister_config_invoice', array(
    'invoice' => array(
        'legend' => array('i18n' => '{#i18n:config_headline_uploadinvoiceoption#}'),
        'fields' =>
            array(
                'uploadInvoiceOption' => '{#setting:formfields__config_uploadinvoiceoption#}',
            ),
    ),
    'erpInvoice'   => array(
        'legend'     => array('i18n' => '{#i18n:formgroups__config_erpInvoice#}'),
        'fields'     => array(
            'erpInvoiceSource'      => '{#setting:formfields__config_erpInvoiceSource#}',
            'erpInvoiceDestination' => '{#setting:formfields__config_erpInvoiceDestination#}',
        ),
        'cssclasses' => array('ml-erpInvoice')
    ),
    'magnaInvoice' => '{#setting:formgroups__config_magnaInvoice#}',
), false);
