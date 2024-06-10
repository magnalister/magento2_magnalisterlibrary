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
    MLSetting::gi()->add('formfields__'.$sIdealoDirectBuyFieldName.'__cssclasses', array('mljs-directbuy', ));
}


/**
 * all fields include i18n directly
 */
MLSetting::gi()->add('formfields_googleshopping', array(
    'access.token' => array(
        'i18n' => '{#i18n:formfields_googleshopping__access.token#}',
        'name' => 'googleshoppingtoken',
        'type' => 'googleshopping_token',
    ),
    'access.clientid' => array(
        'i18n' => '{#i18n:formfields_googleshopping__access.clientid#}',
        'name' => 'googleshopping.merchantid',
        'type' => 'string',
    ),
    'shop.targetcountry' => array(
        'i18n' => '{#i18n:formfields_googleshopping__shop.targetcountry#}',
        'name' => 'googleshopping.targetcountry',
        'type' => 'select',
    ),
    'shop.currencies' => array(
        'i18n' => '{#i18n:formfields_googleshopping__shop.currencies#}',
        'name' => 'googleshopping.currency',
        'type' => 'select'
    ),
    'prepare.imagesize' => array(
        'i18n' => '{#i18n:formfields_googleshopping__prepare.imagesize#}',
        'name' => 'prepareimagesize',
        'type' => 'select',
        'values'=> array(
            '75x75' => '75 x 75',
            '170x135' => '170 x 135',
            '570xN' => '570 x N',
            'fullxfull' => 'full x full',
        ),
    ),
    'prepare.language' => array(
        'i18n' => '{#i18n:formfields_googleshopping__prepare.language#}',
        'name' => 'languagematching',
        'help' => 'Description for product language matching.',
        'type' => 'googleshopping_language_matching',
        'subfields' => array(
            'Web-shop' => array(
                'name' => 'lang',
                'type' => 'select',
            ),
            'Google Shopping' => array(
            	'i18n' => '{#i18n:formfields_googleshopping__prepare.googleshopping.language#}',
                'name' => 'googleshopping.language',
                'type' => 'select',
            ),
        ),
    ),
    'category' => array(
        'i18n' => '{#i18n:formfields_googleshopping__category#}',
        'name' => 'category',
        'type' => 'googleshopping_categories',
        'subfields' => array(
            'primary' => array('name' => 'primarycategory', 'type' => 'categoryselect', 'cattype' => 'marketplace'),
        ),
    ),
    'subheader.shipping' => array(
        'i18n' => '{#i18n:formfields_googleshopping__subheader.shipping#}',
        'name' => 'subheader.shipping',
        'type' => 'subHeader',
        'fullwidth' => true,
        'showdesc' => false,
    ),
    'shippingtemplate' => array(
        'i18n' => '{#i18n:formfields_googleshopping__shippingtemplate#}',
        'name' => 'shippingtemplate',
        'type' => 'select',
    ),
    'shippingtemplateprepare' => array(
        'i18n' => '{#i18n:formfields_googleshopping__shippingtemplateprepare#}',
        'name' => 'shippingtemplate',
        'type' => 'select',
    ),
    'shippingtemplatetitle' => array(
        'i18n' => '{#i18n:formfields_googleshopping__shippingtemplatetitle#}',
        'name' => 'shippingtemplatetitle',
        'type' => 'string',
    ),
    'shippingtemplatecountry' => array(
        'i18n' => '{#i18n:formfields_googleshopping__shippingtemplatecountry#}',
        'name' => 'shippingtemplatecountry',
        'type' => 'select',
    ),
    'shippingtemplatecurrencyvalue' => array(
        'i18n' => '{#i18n:formfields_googleshopping__shippingtemplatecurrencyvalue#}',
        'name' => 'shippingtemplatecurrencyvalue',
        'type' => 'select',
    ),
    'shippingtemplatetime' => array(
        'i18n' => '{#i18n:formfields_googleshopping__shippingtemplatetime#}',
        'name' => 'shippingtemplatetime',
        'type' => 'select',
    ),
    'shippingtemplateprimarycost' => array(
        'i18n' => '{#i18n:formfields_googleshopping__shippingtemplateprimarycost#}',
        'name' => 'shippingtemplateprimarycost',
        'type' => 'string',
    ),
    'shippingtemplatesecondarycost' => array(
        'i18n' => '{#i18n:formfields_googleshopping__shippingtemplatesecondarycost#}',
        'name' => 'shippingtemplatesecondarycost',
        'type' => 'string',
    ),
    'shippingtemplatesend' => array(
        'i18n' => '{#i18n:formfields_googleshopping__shippingtemplatesend#}',
        'name' => 'shippingtemplatesend',
        'type' => 'googleshopping_shippingtemplatesave',
    ),
    'customattribute1' => array(
        'i18n' => '{#i18n:formfields_googleshopping__customattribute1#}',
        'name' => 'customattribute1',
        'type' => 'subFieldsContainer',
        'subfields' => array(
            'name' => array(
                'name' => 'custom1name',
                'i18n' => '{#i18n:formfields_googleshopping__fixed.custom1name#}',
                'type' => 'string'
            ),
            'type' => array(
                'name' => 'custom1type',
                'i18n' => '{#i18n:formfields_googleshopping__fixed.custom1type#}',
                'type' => 'string'
            ),
            'value' => array(
                'name' => 'custom1value',
                'i18n' => '{#i18n:formfields_googleshopping__fixed.custom1value#}',
                'type' => 'string'
            ),
        )
    ),
    'checkout.token' => array(
        'i18n' => array('label' => '', ),
        'name' => 'checkout.token',
        'type' => 'string',
    ),
    'checkout' => array(
        'i18n' => '{#i18n:formfields_googleshopping__checkout#}',
        'name' => 'checkout',
        'type' => 'bool',
        'cssclasses' => array('mljs-directbuy', ),
    ),
    'checkoutenabled' => array(
            'i18n' => '{#i18n:formfields_googleshopping__checkoutenabled#}',
            'name' => 'checkoutenabled',
            'type' => 'hidden',
    ),
    'shippingcountry' => array(
        'i18n' => '{#i18n:formfields_googleshopping__shippingcountry#}',
        'name' => 'shippingcountry',
        'type' => 'select',
    ),
    'shippingmethodandcost' => array(
        'i18n' => '{#i18n:formfields_googleshopping__shippingmethodandcost#}',
        'name' => 'shippingmethodandcost',
        'type' => 'selectwithtextoption',
        'cssClasses' => array('autoWidth'),
        'subfields' => array(
            'select' => '{#setting:formfields_googleshopping__shippingcostmethod#}',
            'string' => '{#setting:formfields_googleshopping__shippingcost#}',
        ),
    ),
    'shippingcostmethod' => array(
        'i18n' => array('label' => ''),
        'name' => 'shippingcostmethod',
        'type' => 'select',
        'values' => array(
            '__ml_lump' => array(
                'textoption' => true,
                'title' => '{#i18n:formfields_googleshopping__shippingcostmethod__values____ml_lump#}'
            ),
            '__ml_weight' => array(
                'textoption' => false,
                'title' => '{#i18n:formfields_googleshopping__shippingcostmethod__values____ml_weight#}'
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
        'i18n' => '{#i18n:formfields_googleshopping__subheader.d#}',
        'type' => 'subHeader',
        'name' => 'subheader.d',
        'fullwidth' => true,
        'showdesc' => false,
    ),
    'paymentmethod' => array(
        'i18n' => '{#i18n:formfields_googleshopping__paymentmethod#}',
        'name' => 'paymentmethod',
        'type' => 'multipleselect',
        'values' => '{#i18n:formfields_googleshopping__paymentmethod__values#}',
    ),
    'access.inventorypath' => array(
        'i18n' => '{#i18n:formfields_googleshopping__access.inventorypath#}',
        'name' => 'access.inventorypath',
        'type' => 'information',
    ),
    'shippingmethod' => array(
        'i18n' => '{#i18n:formfields_googleshopping__shippingmethod#}',
        'name' => 'shippingmethod',
        'type' => 'select',
        'values' => '{#i18n:formfields_googleshopping__shippingmethod__values#}',
        'cssclasses' => array('mljs-directbuy', ),
    ),
    'shippingtime' => array(
        'i18n' => '{#i18n:formfields_googleshopping__shippingtime#}',
        'name' => 'shippingtime',
        'type' => 'shippingtime',
//        'type' => 'selectwithtextoption',
        'subfields' => array(
            'select' => '{#setting:formfields_googleshopping__shippingtimetype#}',
            'string' => '{#setting:formfields_googleshopping__shippingtimevalue#}',
        ),
    ),
    'shippingtimetype' => array(
        'i18n' => array(
            'label' => '',
            'values' => '{#i18n:formfields_googleshopping__shippingtimetype__values#}'
        ),
        'name' => 'shippingtimetype',
        'type' => 'select',
    ),
    'shippingtimevalue' => array(
        'i18n' => array('label' => '', ),
        'name' => 'shippingtimevalue',
        'type' => 'string',
    ),
    'shippingtimeproductfield' => array(
        'i18n' => '{#i18n:formfields_googleshopping__shippingtimeproductfield#}',
        'name' => 'shippingtimeproductfield',
        'type' => 'select',
        'expert' => true,
    ),
    'fixed.price' => array(
        'i18n' => '{#i18n:formfields_googleshopping__fixed.price#}',
        'name' => 'fixed.price',
        'type' => 'subFieldsContainer',
        'subfields' => array(
            'addkind' => array(
                'name' => 'price.addkind',
                'i18n' => '{#i18n:formfields_googleshopping__fixed.price.addkind#}',
                'type' => 'select'
            ),
            'factor' => array(
                'name' => 'price.factor',
                'i18n' => '{#i18n:formfields_googleshopping__fixed.price.factor#}',
                'type' => 'string'
            ),
            'signal' => array(
                'name' => 'price.signal',
                'i18n' => '{#i18n:formfields_googleshopping__fixed.price.signal#}',
                'type' => 'string'
            ),
        ),
    ),
    'prepare_title' => array(
        'i18n' => '{#i18n:formfields_googleshopping__prepare_title#}',
        'name' => 'title',
        'type' => 'string',
        'singleproduct' => true,
    ),
    'prepare_description' => array(
        'i18n' => '{#i18n:formfields_googleshopping__prepare_description#}',
        'name' => 'description',
        'type' => 'wysiwyg',
        'singleproduct' => true,
    ),
    'prepare_image' => array(
        'i18n' => '{#i18n:formfields_googleshopping__prepare_image#}',
        'name' => 'Image',
        'type' => 'imagemultipleselect',
        'singleproduct' => true,
    ),
    'prepare_link' => array(
        'i18n' => '{#i18n:formfields_googleshopping__prepare_link#}',
        'name' => 'link',
        'type' => 'string',
    ),
    'prepare_channel' => array(
        'i18n' => '{#i18n:formfields_googleshopping__prepare_channel#}',
        'name' => 'channel',
        'type' => 'select',
        'values' => array(
            'online' => 'Online',
            'local' => 'Local'
        )
    ),
    'prepare_price' => array(
        'i18n' => '{#i18n:formfields_googleshopping__prepare_price#}',
        'name' => 'price',
        'type' => 'hidden',
    ),
    'prepare_brand' => array(
        'i18n' => '{#i18n:formfields_googleshopping__prepare_brand#}',
        'name' => 'brand',
        'type' => 'string'
    ),
    'prepare_condition' => array(
        'i18n' => '{#i18n:formfields_googleshopping__prepare_condition#}',
        'name' => 'condition',
        'type' => 'select',
        'values' => array(
            'new' => 'New',
            'refurbished' => 'Refurbished',
            'used' => 'Used'
        )
    ),
    'prepare_variationgroups' => array(
        'label' => '{#i18n:formfields_googleshopping__prepare_variationgroups#}',
        'name' => 'variationgroups',
        'type' => 'googleshopping_categories',
        'subfields' => array(
            'variationgroups.value' => array('name' => 'variationgroups.value', 'type' => 'categoryselect', 'cattype' => 'marketplace', 'value' => null),
        ),
    ),
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
    'orderimport.paymentstatus' => array(
        //'i18n' => '{#i18n:formfields_googleshopping__orderstatus.status#}',
        'name' => 'orderimport.paymentstatus',
        'type' => 'select',
        'cssclasses' => array('mljs-directbuy', ),
    ),
    'orderstatus.cancelreason' => array(
        'i18n' => '{#i18n:formfields_googleshopping__orderstatus.cancelreason#}',
        'name' => 'orderstatus.cancelreason',
        'type' => 'select',
        'cssclasses' => array('mljs-directbuy', ),
    ),
    'orderstatus.cancelcomment' => array(
        'i18n' => '{#i18n:formfields_googleshopping__orderstatus.cancelcomment#}',
        'name' => 'orderstatus.cancelcomment',
        'type' => 'string',
        'cssclasses' => array('mljs-directbuy', ),
    ),

));
