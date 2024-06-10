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

MLSetting::gi()->add('ebay_config_account', array(    
    'tabident' => array(
        'legend' => array(
            'classes' => array(''),
        ),
        'fields' => array(
            'tabident' => array(
                'name' => 'tabident',
                'type' => 'string',
            ),
        ),
    ),
    'account' => array(
        'fields' => array(
            'username' => array(
                'name' => 'username',
                'type' => 'string',
            ),
            'token' => array(
                'name' => 'token',
                'type' => 'ebay_token',
            ),
            'site' => array(
                'name' => 'site',
                'type' => 'select'
            ),
            'currency' => array(
                'name' => 'currency',
                'type' => 'ajax'
            ),
        ),
    )
), false);


MLSetting::gi()->add('ebay_config_prepare', array(
    'location'=> array(
        'fields' => array(
            'postalcode' => array(
                'name' => 'postalcode',
                'type' => 'string',
            ),
            'location' => array(
                'name' => 'location',
                'type' => 'string',
            ),
            'country' => array(
                'name' => 'country',
                'type' => 'select',
            ),
        )
    ),
    'prepare' => array(
        'fields' => array(
            'prepare.status' => array(
                'name' => 'prepare.status',
                'type' => 'bool',
            ),
            'mwst' => array(
                'name' => 'mwst',
                'type' => 'string',
            ),
            'setalways' => array (
                'name' => 'mwst.always',
                'type' => 'bool',
            ),
            'conditionid' => array(
                'name' => 'conditionid',
                'type' => 'select',
            ),
            'lang' => array(
                'name' => 'lang',
                'type' => 'select',
            ),
            'topten' => array(
                'name' => 'topten',
                'type' => 'topten',
                'default' => 30,
                'expert' => true,
            ),
        ),
    ),
    'fixedprice' => array(
        'fields' => array(
            'fixed.quantity' => array(
                'name' => 'fixed.quantity',
                'type' => 'selectwithtextoption',
                'subfields' => array(
                    'select' => array('name' => 'fixed.quantity.type', 'type' => 'select'),
                    'string' => array('name' => 'fixed.quantity.value', 'type' => 'string')
                )
            ),
            'maxquantity' => array(
                'name' => 'maxquantity',
                'type' => 'string',
            ),
            'fixed.duration' => array(
                'name' => 'fixed.duration',
                'type' => 'select',
                'default' => 'GTC',
            ),
            'ebayplus' => array(
                'name' => 'ebayplus',
                'type' => 'bool',
            ),
        ),
    ),
    'chineseprice' => array(
        'fields' => array(
            'chinese.quantity' => array(
                'name' => 'chinese.quantity',
                'type' => 'information',
            ),
            'chinese.duration' => array(
                'name' => 'chinese.duration',
                'type' => 'select',
            ),
        )
    ),
    'pictures' => array(
        'fields' => array(
            'imagesize' => array(
                'name' => 'imagesize',
                'type' => 'select',
            ),
            'gallerytype' => array(
                'name' => 'gallerytype',
                'type' => 'select',
                'default' => 'Gallery',
            ),
            'picturepack' => array(
                'name' => 'picturepack',
                'type' => 'addon_bool',
                'addonsku' => 'EbayPicturePack',
            ),
            'variationdimensionforpictures' => array(
                'name' => 'variationdimensionforpictures',
            ),
        ),
    ),
    'payment' => array(
        'fields' => array(
            'paymentsellerprofile' => array(
                'name' => 'paymentsellerprofile',
                'type' => 'select'
            ),
            'paymentmethods' => array(
                'name' => 'paymentmethods',
                'type' => 'multipleselect',
            ),
            'paypaladdress' => array(
                'name' => 'paypal.address',
                'type' => 'string',
            ),
            'paymentinstructions' => array(
                'name' => 'paymentinstructions',
                'type' => 'text',
            ),
        ),
    ),
    'shipping' => array(
        'fields' => array(
            'shippingsellerprofile' => array(
                'name' => 'shippingsellerprofile',
                'type' => 'select'
            ),
            'shippinglocalcontainer' => array(
                'name' => 'shippinglocalcontainer',
                'type' => 'ebay_shippingcontainer'
            ),
            'dispatchtimemax' => array(
                'name' => 'dispatchtimemax',
                'type' => 'select',
                'default' => '3',
            ),
            'shippinginternationalcontainer' => array(
                'name' => 'shippinginternationalcontainer',
                'type' => 'optional',
                'optional' => array(
                    'editable' => true,
                    'name' => 'shippinginternational',
                    'field' => array(
                        'type' => 'ebay_shippingcontainer'
                    )
                )
            ),
        ),
    ),
    'returnpolicy' => array(
        'fields' => array(
            'returnsellerprofile' => array(
                'name' => 'returnsellerprofile',
                'type' => 'select'
            ),
            'returnpolicy.returnsaccepted' => array(
                'name' => 'returnpolicy.returnsaccepted',
                'type' => 'select',
            ),
            'returnswithin' => array(
                'name' => 'returnpolicy.returnswithin',
                'type' => 'select',
            ),
            'returnpolicy.shippingcostpaidby' => array(
                'name' => 'returnpolicy.shippingcostpaidby',
                'type' => 'select',
            ),
            'returnpolicy.description' => array(
                'name' => 'returnpolicy.description',
                'type' => 'text',
            ),
        ),
    ),
    'misc' => array(
        'fields' => array(
            'usevariations' => array(
                'name' => 'usevariations',
                'type' => 'bool',
                'default' => true
            ),
            'usePrefilledInfo' => array(
                'name' => 'useprefilledinfo',
                'type' => 'bool',
                'expert' => true,
            ),
            'privatelisting' => array(
                'name' => 'privatelisting',
                'type' => 'bool',
            ),
            'restrictedtobusiness' => array(
                'name' => 'restrictedtobusiness',
                'type' => 'bool',
            ),
        ),
    ),
    'upload' => array(
        'fields' => array(
            'productfield.brand' => array(
                'name' => 'productfield.brand',
                'type' => 'select',
            ),
            'productfield.tecdocktype' => array(
                'name' => 'productfield.tecdocktype',
                'type' => 'select',
                'expert' => true,
            ),
        )



    ),
), false);

MLSetting::gi()->add('ebay_config_price', array(
        'fixedprice' => array(
            'fields' => array(
                'fixed.price' => array(
                    'name' => 'fixed.price',
                    'type' => 'subFieldsContainer',
                    'subfields' => array(
                        'addkind' => array('name' => 'fixed.price.addkind', 'type' => 'select'),
                        'factor' => array('name' => 'fixed.price.factor', 'type' => 'string'),
                        'signal' => array('name' => 'fixed.price.signal', 'type' => 'string')
                    )
                ),
                'fixed.priceoptions' => array(
                    'name' => 'fixed.priceoptions',
                    'type' => 'subFieldsContainer',
                    'subfields' => array(
                        'group' => array('name' => 'fixed.price.group', 'type' => 'select'),
                        'usespecialoffer' => array('name' => 'fixed.price.usespecialoffer', 'type' => 'bool'),
                    ),
                ),
                'strikepriceoptions' => array(
                    'name' => 'strikepriceoptions',
                    'type' => 'subFieldsContainer',
                    'subfields' => array(
                        'group' => array('name' => 'strikeprice.group', 'type' => 'select'),
                        'kind' => array('name' => 'strikeprice.kind', 'type' => 'select'),
                        'active' => array('name' => 'strikeprice.active', 'type' => 'bool'),
                    ),
                ),
            ),
        ),
        'chineseprice' => array(
            'fields' => array(
                'chinese.price' => array(
                    'name' => 'chinese.price',
                    'type' => 'subFieldsContainer',
                    'subfields' => array(
                        'addkind' => array('name' => 'chinese.price.addkind', 'type' => 'select'),
                        'factor' => array('name' => 'chinese.price.factor', 'type' => 'string'),
                        'signal' => array('name' => 'chinese.price.signal', 'type' => 'string')
                    )
                ),
                'chinese.buyitnow.price' => array(
                    'name' => 'chinese.buyitnow.price',
                    'type' => 'subFieldsContainer',
                    'subfields' => array(
                        'addkind' => array('name' => 'chinese.buyitnow.price.addkind', 'type' => 'select'),
                        'factor' => array('name' => 'chinese.buyitnow.price.factor', 'type' => 'string'),
                        'signal' => array('name' => 'chinese.buyitnow.price.signal', 'type' => 'string'),
                        'use' => array('name' => 'buyitnowprice', 'type' => 'bool'),
                    )
                ),
                'chinese.priceoptions' => array(
                    'name' => 'chinese.priceoptions',
                    'type' => 'subFieldsContainer',
                    'subfields' => array(
                        'group' => array('name' => 'chinese.price.group', 'type' => 'select'),
                        'usespecialoffer' => array('name' => 'chinese.price.usespecialoffer', 'type' => 'bool'),
                    ),
                ),
            )
        ),

        'price' => array(
            'fields' => array(
                'bestofferenabled' => array(
                    'name' => 'bestofferenabled',
                    'type' => 'bool',
                ),
                'exchangerate_update' => array(
                    'name' => 'exchangerate_update',
                    'type' => 'bool',
                ),
            )
        )
), false);


MLSetting::gi()->add('ebay_config_sync', array(
    'sync' => array(
        'fields' => array(
            'stocksync.tomarketplace' => array(
                'name' => 'stocksync.tomarketplace',
                'type' => 'select',/*
                'type' => 'addon_select',
                'addonsku' => 'FastSyncInventory',*/
            ),
            'stocksync.frommarketplace' => array(
                'name' => 'stocksync.frommarketplace',
                'type' => 'select',
            ),
            'inventorysync.price' => array(
                'name' => 'inventorysync.price',
                'type' => 'select',
            ),
            'synczerostock' => array(
                'name' => 'synczerostock',
                'type' => 'addon_bool',
                'addonsku' => 'EbayZeroStockAndRelisting',
            ),
            'syncrelisting' => array(
                'name' => 'syncrelisting',
                'type' => 'addon_bool',
                'addonsku' => 'EbayZeroStockAndRelisting',
            ),
            'syncproperties' => array(
                'name' => 'syncproperties',
                'type' => 'addon_bool',
                'addonsku' => 'EbayProductIdentifierSync',
            ),
        )
    ),
    'syncchinese' => array(
        'fields' => array(
            'chinese.stocksync.tomarketplace' => array(
                'name' => 'chinese.stocksync.tomarketplace',
                'type' => 'select',
            ),
            'chinese.stocksync.frommarketplace' => array(
                'name' => 'chinese.stocksync.frommarketplace',
                'type' => 'select',
            ),
            'chinese.inventorysync.price' => array(
                'name' => 'chinese.inventorysync.price',
                'type' => 'select',
            ),
        )
    )
), false);

MLSetting::gi()->add('ebay_config_orderimport', array(
    'importactive' => array( 
        'fields' => array(
            'importactive' => array(
                'name' => 'importactive',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'import' => array('name' => 'import', 'type' => 'radio', ),
                    'preimport.start' => array('name' => 'preimport.start', 'type' => 'datepicker'),
                ),
            ),
            'orderimport.blacklisting' => array(
                'name' => 'orderimport.blacklisting',
                'type' => 'bool',
                'default' => false,
                'expert' => true,
            ),
            'customergroup' => array(
                'name' => 'customergroup',
                'type' => 'select',
            ),
            'orderstatus.open' => array(
                'name' => 'orderstatus.open',
                'type' => 'select',
            ),
            'importonlypaid' => array(
                'name'           => 'importonlypaid',
                'type'           => 'ebay_importonlypaid',
                'importonlypaid' => array('disablefields' => array('orderstatus.closed', 'updateable.orderstatus', 'update.orderstatus', 'orderstatus.paid')),
            ),
            'orderstatus.closed' => array(
                'name' => 'orderstatus.closed',
                'type' => 'multipleselect'
            ),
            'orderimport.shop' => array(
                'name' => 'orderimport.shop',
                'type' => 'select',
            ),
            'orderimport.shippingmethod' => array(
                'name' => 'orderimport.shippingmethod',
                'type' => 'selectwithtextoption',
                'subfields' => array(
                    'select' => array('name' => 'orderimport.shippingmethod', 'type' => 'select'),
                    'string' => array('name' => 'orderimport.shippingmethod.name', 'type' => 'string','default' => 'ebay',)
                ),
                'expert' => true,
            ),  
            'orderimport.paymentmethod' => array(
                'name' => 'orderimport.paymentmethod',
                'type' => 'selectwithtextoption',
                'subfields' => array(
                    'select' => array('name' => 'orderimport.paymentmethod', 'type' => 'select'),
                    'string' => array('name' => 'orderimport.paymentmethod.name', 'type' => 'string','default' => 'ebay',)
                ),
                'expert' => true,
            ),
        ),
    ),
    'mwst' => array(
        'fields' => array(
            'mwstfallback' => array(
                'name' => 'mwstfallback',
                'type' => 'string',
                'default' => 19,
            ),
            /*//{search: 1427198983}
            array(
                'name' => 'mwst.shipping',
                'type' => 'string',
                'default' => 19,
            ),
            //*/
        ),
    ),
    'orderupdate' => array(
        'fields' => array(
            'updateableorderstatus' => array(
                'name' => 'updateableorderstatus',
                'type' => 'subFieldsContainer',
                'subfields' => array(
                    'updateableorderstatus' => array('name' => 'updateable.orderstatus', 'type' => 'multipleselect'),
                    'updateorderstatus' => array('name' => 'update.orderstatus', 'type' => 'bool','default'=>true),
                )
            ),
            'orderstatus.paid' => array(
                'name' => 'orderstatus.paid',
                'type' => 'select',
            ),
        ),
    ),
    'orderstatus' => array(
        'fields' => array(
            'orderstatus.sync' => array(
                'i18n' => '{#i18n:formfields__orderstatus.sync#}',
                'name' => 'orderstatus.sync',
                'type' => 'select',
            ),
            'orderstatus.shipped' => array(
                'name' => 'orderstatus.shipped',
                'type' => 'select'
            ),
            'orderstatus.carrier.default' => array(
                'name' => 'orderstatus.carrier.default',
                'type' => 'select'
            ),
            'orderstatus.cancelled' => array(
                'name' => 'orderstatus.cancelled',
                'type' => 'select'
            ),
        ),
    ),
    'orderrefund' => array(
        'fields' => array(
            'orderstatus.refund' => array(
                'name' => 'orderstatus.refund',
                'type' => 'duplicate',
                'duplicate' => array(
                    'field' => array('type' => 'ebay_refund')
                ),
                'norepeat_included' => true,
                'subfields' => array(
                    'status' => array(
                        'name'     => 'refundstatus',
                        'type'     => 'select',
                        'cssclass' => array('ml-form-type-duplicated-norepeat'),
                        'norepeat' => true
                    ),
                    'reason' => array(
                        'name' => 'refundreason',
                        'type' => 'select',
                    ),
                    'comment' => array(
                        'name' => 'refundcomment',
                        'type' => 'text',
                    ),
                ),
            ),
        ),
    )
), false);


MLSetting::gi()->add('ebay_config_emailtemplate', array(
    'mail' => array(
        'fields' => array(
            'mail.send' => array(
                'name' => 'mail.send',
                'type' => 'radio',
                'default' => 'false',
            ),
            'mail.originator.name' => array(
                'name' => 'mail.originator.name',
                'type' => 'string',
                'default' => '{#i18n:ebay_config_account_emailtemplate_sender#}',
            ),
            'mail.originator.adress' => array(
                'name' => 'mail.originator.adress',
                'type' => 'string',
                'default' => '{#i18n:ebay_config_account_emailtemplate_sender_email#}',
            ),
            'mail.subject' => array(
                'name' => 'mail.subject',
                'type' => 'string',
                'default' => '{#i18n:ebay_config_account_emailtemplate_subject#}',
            ),
//            array(
//                'name' => 'mail.content',
//                'type' => 'wysiwyg',
//                'default' => '{#i18n:ebay_config_emailtemplate_content#}',
//                'resetdefault' => '{#i18n:ebay_config_emailtemplate_content#}',
//            ),
            'mail.content' => array(
                'name' => 'mail.content',
                'type' => 'configMailContentContainer',
                'default' => '{#i18n:ebay_config_emailtemplate_content#}',
                'resetdefault' => '{#i18n:ebay_config_emailtemplate_content#}',
            ),
            'mail.copy' => array(
                'name' => 'mail.copy',
                'type' => 'radio',
                'default' => 'true',
            ),
        ),
    ),
), false);


MLSetting::gi()->add('ebay_config_producttemplate', array(
    'product' => array(
        'fields' => array(
            'template.name' => array(
                'name' => 'template.name',
                'type' => 'string',
                'default' => '#TITLE#',
            ),
            'template.mobile.active' => array(
                'name' => 'template.mobile.active',
                'type' => 'radio',
                'default' => 'false',
                'alertvalue' => 'true',
            ),
            'template.tabs' => array(
                 'type' => 'tabs',
                 'name' => 'template.tabs',
                 'subfields' => array(
                     'template.content' => array(
                         'name' => 'template.content',
                         'type' => 'wysiwyg',
                         'default' => '{#i18n:ebay_config_producttemplate_content#}',
                         'resetdefault' => '{#i18n:ebay_config_producttemplate_content#}',
                     ),
                     'template.mobile.content' => array(
                         'name' => 'template.mobile.content',
                         'type' => 'ebay_mobile_template',
                         'default' => '{#i18n:ebay_config_producttemplate_mobile_content#}',
                         'resetdefault' => '{#i18n:ebay_config_producttemplate_mobile_content#}',
                     ),
                 ),
                 'fullwidth' => true,
            ),
        ),
    ),
), false);
