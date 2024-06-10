<?php
/**
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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

// example for overwriting global element (add css-class to form-field)
foreach (array(
             'stocksync.frommarketplace', 'mail.send', 'mail.originator.name',
             'mail.originator.adress', 'mail.subject', 'mail.content', 'mail.copy',
             'importactive', 'import', 'preimport.start', 'customergroup',
             'orderimport.shop', 'orderstatus.open', 'orderimport.shippingmethod',
             'orderimport.paymentmethod', 'maxquantity', 'mwst.fallback',
             'orderstatus.sync', 'orderstatus.shipped', 'orderstatus.carrier.default',
             'orderstatus.canceled',
         ) as $sIdealoDirectBuyFieldName) {
    MLSetting::gi()->add('formfields__'.$sIdealoDirectBuyFieldName.'__cssclasses', array('mljs-directbuy',));
}

/**
 * all fields include i18n directly
 */
MLSetting::gi()->add('formfields_hood', array(
    'idealotoken' => array(
        'i18n' => '{#i18n:formfields_idealo__idealotoken#}',
        'name' => 'idealotoken',
        'type' => 'subFieldsContainer',
        'subfields' => array(
            'checkout.token' => '{#setting:formfields_idealo__checkout.token#}',
        ),
    ),
    'checkout.token' => array(
        'i18n' => array('label' => '',),
        'name' => 'checkout.token',
        'type' => 'string',
    ),
    'checkout' => array(
        'i18n' => '{#i18n:formfields_idealo__checkout#}',
        'name' => 'checkout',
        'type' => 'bool',
        'cssclasses' => array('mljs-directbuy',),
    ),
    'checkoutenabled' => array(
        'i18n' => '{#i18n:formfields_idealo__checkoutenabled#}',
        'name' => 'checkoutenabled',
        'type' => 'hidden',
    ),
    'shippingcountry' => array(
        'i18n' => '{#i18n:formfields_idealo__shippingcountry#}',
        'name' => 'shippingcountry',
        'type' => 'select',
    ),
    'shippingmethodandcost' => array(
        'i18n' => '{#i18n:formfields_idealo__shippingmethodandcost#}',
        'name' => 'shippingmethodandcost',
        'type' => 'selectwithtextoption',
        'cssClasses' => array('autoWidth'),
        'subfields' => array(
            'select' => '{#setting:formfields_idealo__shippingcostmethod#}',
            'string' => '{#setting:formfields_idealo__shippingcost#}',
        ),
    ),
    'shippingcostmethod' => array(
        'i18n' => array('label' => ''),
        'name' => 'shippingcostmethod',
        'type' => 'select',
        'values' => array(
            '__ml_lump' => array(
                'textoption' => true,
                'title' => '{#i18n:formfields_idealo__shippingcostmethod__values____ml_lump#}'
            ),
            '__ml_weight' => array(
                'textoption' => false,
                'title' => '{#i18n:formfields_idealo__shippingcostmethod__values____ml_weight#}'
            ),
        ),
    ),
    'shippingcost' => array(
        'i18n' => array('label' => ''),
        'name' => 'shippingcost',
        'type' => 'string',
        'default' => '0.00',
    ),
    'subheader.d' => array(
        'i18n' => '{#i18n:formfields_idealo__subheader.d#}',
        'type' => 'subHeader',
        'name' => 'subheader.d',
        'fullwidth' => true,
        'showdesc' => false,
    ),
    'subheader.pd' => array(
        'i18n' => '{#i18n:formfields_idealo__subheader.pd#}',
        'name' => 'subheader.pd',
        'type' => 'subHeader',
        'fullwidth' => true,
        'showdesc' => false,
    ),
    'paymentmethods' => array(
        'i18n' => '{#i18n:formfields_hood__paymentmethods#}',
        'name' => 'paymentmethods',
        'type' => 'multipleselect',
        'values' => '{#i18n:formfields_hood__paymentmethods__values#}',
    ),
    'mpusername' => array(
        'i18n' => '{#i18n:formfields_hood__mpusername#}',
        'name' => 'mpusername',
        'type' => 'string',
    ),
    'apikey' => array(
        'i18n' => '{#i18n:formfields_hood__apikey#}',
        'name' => 'apikey',
        'type' => 'password',
        'savevalue' => '__saved__',
    ),
    'mwst' => array(
        'i18n' => '{#i18n:formfields_hood__mwst#}',
        'name' => 'mwst',
        'type' => 'string',
    ),
    'forcefallback' => array(
        'i18n' => '{#i18n:formfields_hood__forcefallback#}',
        'name' => 'forcefallback',
        'type' => 'bool',
        'default' => true,
    ),
    'orderstatus.sendmail' => array(
        'i18n' => '{#i18n:formfields_hood__orderstatus.sendmail#}',
        'name' => 'orderstatus.sendmail',
        'type' => 'bool'
    ),
    'conditiontype' => array(
        'i18n' => '{#i18n:formfields_hood__conditiontype#}',
        'name' => 'conditiontype',
        'type' => 'select',
    ),
    'shippingTime.min' => array(
        'i18n' => '{#i18n:formfields_hood__shippingTime.min#}',
        'name' => 'shippingTime.min',
        'type' => 'string',
    ),
    'shippingTime.max' => array(
        'i18n' => '{#i18n:formfields_hood__shippingTime.max#}',
        'name' => 'shippingTime.max',
        'type' => 'string',
    ),
    'fixed.quantity' => array(
        'i18n' => '{#i18n:formfields_hood__fixed.quantity#}',
        'name' => 'fixed.quantity',
        'type' => 'selectwithtextoption',
        'subfields' => array(
            'select' => '{#setting:formfields_hood__fixed.quantity.type#}',
            'string' => '{#setting:formfields_hood__fixed.quantity.value#}',
        )
    ),
    'fixed.quantity.type' => array(
        'i18n' => array(
            'label' => '',
            'values' => '{#i18n:formfields_hood__fixed.quantity.type__values#}'
        ),
        'name' => 'fixed.quantity.type',
        'type' => 'select',
    ),
    'fixed.quantity.value' => array(
        'i18n' => array('label' => '',),
        'name' => 'fixed.quantity.value',
        'type' => 'string',
    ),
    'fixed.duration' => array(
        'i18n' => '{#i18n:formfields_hood__fixed.duration#}',
        'name' => 'fixed.duration',
        'type' => 'select'
    ),
    'chinese.quantity' => array(
        'i18n' => '{#i18n:formfields_hood__chinese.quantity#}',
        'name' => 'chinese.quantity',
        'type' => 'selectwithtextoption',
        'subfields' => array(
            'select' => '{#setting:formfields_hood__chinese.quantity.type#}',
            'string' => '{#setting:formfields_hood__chinese.quantity.value#}',
        )
    ),
    'chinese.quantity.type' => array(
        'i18n' => array(
            'label' => '',
            'values' => '{#i18n:formfields_hood__chinese.quantity.type__values#}'
        ),
        'name' => 'chinese.quantity.type',
        'type' => 'select',
    ),
    'chinese.quantity.value' => array(
        'i18n' => array('label' => '',),
        'name' => 'chinese.quantity.value',
        'type' => 'string',
    ),
    'chinese.duration' => array(
        'i18n' => '{#i18n:formfields_hood__chinese.duration#}',
        'name' => 'chinese.duration',
        'type' => 'select',
    ),
    'shippinglocalcontainer' => array(
        'i18n' => '{#i18n:formfields_hood__shippinglocalcontainer#}',
        'name' => 'shippinglocalcontainer',
        'type' => 'hood_shippingcontainer',
    ),
    'shippinginternationalcontainer' => array(
        'i18n' => '{#i18n:formfields_hood__shippinginternationalcontainer#}',
        'name' => 'shippinginternationalcontainer',
        'type' => 'optional',
        'optional' => array(
            'editable' => true,
            'name' => 'shippinginternational',
            'field' => array(
                'type' => 'hood_shippingcontainer'
            )
        )
    ),
    'usevariations' => array(
        'i18n' => '{#i18n:formfields_hood__usevariations#}',
        'name' => 'usevariations',
        'type' => 'bool',
        'default' => true
    ),
    'fixed.price' => array(
        'i18n' => '{#i18n:formfields_hood__fixed.price#}',
        'name' => 'fixed.price',
        'type' => 'subFieldsContainer',
        'subfields' => array(
            'addkind' => '{#setting:formfields_hood__fixed.price.addkind#}',
            'factor' => '{#setting:formfields_hood__fixed.price.factor#}',
            'signal' => '{#setting:formfields_hood__fixed.price.signal#}',
        )
    ),
    'fixed.price.addkind' => array(
        'i18n' => '{#i18n:formfields_hood__fixed.price.addkind#}',
        'name' => 'fixed.price.addkind',
        'type' => 'select'
    ),
    'fixed.price.factor' => array(
        'i18n' => '{#i18n:formfields_hood__fixed.price.factor#}',
        'name' => 'fixed.price.factor',
        'type' => 'string'
    ),
    'fixed.price.signal' => array(
        'i18n' => '{#i18n:formfields_hood__fixed.price.signal#}',
        'name' => 'fixed.price.signal',
        'type' => 'string'
    ),
    'fixed.priceoptions' => array(
        'i18n' => '{#i18n:formfields_hood__fixed.priceoptions#}',
        'name' => 'fixed.priceoptions',
        'type' => 'subFieldsContainer',
        'subfields' => array(
            'group' => '{#setting:formfields_hood__fixed.price.group#}',
            'usespecialoffer' => '{#setting:formfields_hood__fixed.price.usespecialoffer#}',
        ),
    ),
    'fixed.price.group' => array(
        'i18n' => '{#i18n:formfields_hood__fixed.price.group#}',
        'name' => 'fixed.price.group',
        'type' => 'select'),
    'fixed.price.usespecialoffer' => array(
        'i18n' => '{#i18n:formfields_hood__fixed.price.usespecialoffer#}',
        'name' => 'fixed.price.usespecialoffer',
        'type' => 'bool'),
    'chinese.price' => array(
        'i18n' => '{#i18n:formfields_hood__chinese.price#}',
        'name' => 'chinese.price',
        'type' => 'subFieldsContainer',
        'subfields' => array(
            'addkind' => '{#setting:formfields_hood__chinese.price.addkind#}',
            'factor' => '{#setting:formfields_hood__chinese.price.factor#}',
            'signal' => '{#setting:formfields_hood__chinese.price.signal#}',
        )
    ),
    'chinese.price.addkind' => array(
        'i18n' => '{#i18n:formfields_hood__chinese.price.addkind#}',
        'name' => 'chinese.price.addkind',
        'type' => 'select'
    ),
    'chinese.price.factor' => array(
        'i18n' => '{#i18n:formfields_hood__chinese.price.factor#}',
        'name' => 'chinese.price.factor',
        'type' => 'string'
    ),
    'chinese.price.signal' => array(
        'i18n' => '{#i18n:formfields_hood__chinese.price.signal#}',
        'name' => 'chinese.price.signal',
        'type' => 'string'
    ),
    'chinese.buyitnow.price' => array(
        'i18n' => '{#i18n:formfields_hood__chinese.buyitnow.price#}',
        'name' => 'chinese.buyitnow.price',
        'type' => 'subFieldsContainer',
        'subfields' => array(
            'addkind' => '{#setting:formfields_hood__chinese.buyitnow.price.addkind#}',
            'factor' => '{#setting:formfields_hood__chinese.buyitnow.price.factor#}',
            'signal' => '{#setting:formfields_hood__chinese.buyitnow.price.signal#}',
            'use' => '{#setting:formfields_hood__buyitnowprice#}',
        )
    ),
    'chinese.buyitnow.price.addkind' => array(
        'i18n' => '{#i18n:formfields_hood__chinese.buyitnow.price.addkind#}',
        'name' => 'chinese.buyitnow.price.addkind',
        'type' => 'select'
    ),
    'chinese.buyitnow.price.factor' => array(
        'i18n' => '{#i18n:formfields_hood__chinese.buyitnow.price.factor#}',
        'name' => 'chinese.buyitnow.price.factor',
        'type' => 'string'
    ),
    'chinese.buyitnow.price.signal' => array(
        'i18n' => '{#i18n:formfields_hood__chinese.buyitnow.price.signal#}',
        'name' => 'chinese.buyitnow.price.signal',
        'type' => 'string'
    ),
    'buyitnowprice' => array(
        'i18n' => '{#i18n:formfields_hood__buyitnowprice#}',
        'name' => 'buyitnowprice', 'type' => 'bool'),
    'chinese.priceoptions' => array(
        'i18n' => '{#i18n:formfields_hood__chinese.priceoptions#}',
        'name' => 'chinese.priceoptions',
        'type' => 'subFieldsContainer',
        'subfields' => array(
            'group' => '{#setting:formfields_hood__chinese.price.group#}',
            'usespecialoffer' => '{#setting:formfields_hood__chinese.price.usespecialoffer#}',
        ),
    ),
    'chinese.price.group' => array(
        'i18n' => '{#i18n:formfields_hood__chinese.price.group#}',
        'name' => 'chinese.price.group',
        'type' => 'select'
    ),
    'chinese.price.usespecialoffer' => array(
        'i18n' => '{#i18n:formfields_hood__chinese.price.usespecialoffer#}',
        'name' => 'chinese.price.usespecialoffer',
        'type' => 'bool'
    ),
    'exchangerate_update' => array(
        'i18n' => '{#i18n:formfields_hood__exchangerate_update#}',
        'name' => 'exchangerate_update',
        'type' => 'bool',
    ),
    'chinese.stocksync.tomarketplace' => array(
        'i18n' => '{#i18n:formfields_hood__chinese.stocksync.tomarketplace#}',
        'name' => 'chinese.stocksync.tomarketplace',
        'type' => 'select',
    ),
    'chinese.inventorysync.price' => array(
        'i18n' => '{#i18n:formfields_hood__chinese.inventorysync.price#}',
        'name' => 'chinese.inventorysync.price',
        'type' => 'select',
        'default' => 'no',
    ),
    'shippingtimevalue' => array(
        'i18n' => array('label' => '',),
        'name' => 'shippingtimevalue',
        'type' => 'string',
    ),
    'shippingtimeproductfield' => array(
        'i18n' => '{#i18n:formfields_idealo__shippingtimeproductfield#}',
        'name' => 'shippingtimeproductfield',
        'type' => 'select',
        'expert' => true,
    ),
    'orderstatus.cancelreason' => array(
        'i18n' => '{#i18n:formfields_idealo__orderstatus.cancelreason#}',
        'name' => 'orderstatus.cancelreason',
        'type' => 'select',
        'cssclasses' => array('mljs-directbuy',),
    ),
    'orderstatus.cancelcomment' => array(
        'i18n' => '{#i18n:formfields_idealo__orderstatus.cancelcomment#}',
        'name' => 'orderstatus.cancelcomment',
        'type' => 'string',
        'cssclasses' => array('mljs-directbuy',),
    ),
    'prepare_title' => array(
        'i18n' => '{#i18n:formfields_idealo__prepare_title#}',
        'name' => 'Title',
        'type' => 'string',
        'singleproduct' => true,
    ),
    'prepare_description' => array(
        'i18n' => '{#i18n:formfields_idealo__prepare_description#}',
        'name' => 'Description',
        'type' => 'wysiwyg',
        'singleproduct' => true,
    ),
    'prepare_image' => array(
        'i18n' => '{#i18n:formfields_idealo__prepare_image#}',
        'name' => 'Image',
        'type' => 'imagemultipleselect',
        'singleproduct' => true,
    ),
));
