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

/**
 * all groups using form-fields and includes i18n for legend directly
 */
MLSetting::gi()->add('formgroups_hood', array(
    'account' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_hood__account#}',),
        'fields' => array(
            'mpusername' => '{#setting:formfields_hood__mpusername#}',
            'apikey' => '{#setting:formfields_hood__apikey#}',
        ),
    ),
    'checkoutenabled' => array(
        'legend' => array(
            'i18n' => '',
            'classes' => array('mlhidden'),
        ),
        'fields' => array(
            'checkoutenabled' => '{#setting:formfields_idealo__checkoutenabled#}',
        ),
    ),
    'prepare' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_hood__prepare#}'),
        'fields' => array(
            'mwst' => '{#setting:formfields_hood__mwst#}',
            'forcefallback' => '{#setting:formfields_hood__forcefallback#}',
            'conditiontype' => '{#setting:formfields_hood__conditiontype#}',
            'lang' => '{#setting:formfields__lang#}',
            'shippingTime.min' => '{#setting:formfields_hood__shippingTime.min#}',
            'shippingTime.max' => '{#setting:formfields_hood__shippingTime.max#}',
        ),
    ),
    'prepare_fixedprice' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_hood__fixedprice#}'),
        'fields' => array(
            'fixed.quantity' => '{#setting:formfields_hood__fixed.quantity#}',
            'maxquantity' => '{#setting:formfields__maxquantity#}',
            'prepare_fixed.duration' => '{#setting:formfields_hood__fixed.duration#}',
        ),
    ),
    'prepare_chineseprice' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_hood__chineseprice#}'),
        'fields' => array(
            'chinese.quantity' => '{#setting:formfields_hood__chinese.quantity#}',
            'chinese.duration' => '{#setting:formfields_hood__chinese.duration#}',
        ),
    ),
    'payment' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_hood__payment#}'),
        'fields' => array(
            'paymentmethods' => '{#setting:formfields_hood__paymentmethods#}',
        ),
    ),
    'shipping' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_hood__shipping#}'),
        'fields' => array(
            'shippinglocalcontainer' => '{#setting:formfields_hood__shippinglocalcontainer#}',
            'shippinginternationalcontainer' => '{#setting:formfields_hood__shippinginternationalcontainer#}',
        ),
    ),
    'misc' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_hood__misc#}'),
        'fields' => array(
            'usevariations' => '{#setting:formfields_hood__usevariations#}',
        ),
    ),
    'price_fixedprice' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_hood__fixedprice#}'),
        'fields' => array(
            'fixed.price' => '{#setting:formfields_hood__fixed.price#}',
            'fixed.priceoptions' => '{#setting:formfields_hood__fixed.priceoptions#}',
        ),
    ),
    'price_chineseprice' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_hood__chineseprice#}'),
        'fields' => array(
            'chinese.price' => '{#setting:formfields_hood__chinese.price#}',
            'chinese.buyitnow.price' => '{#setting:formfields_hood__chinese.buyitnow.price#}',
            'chinese.priceoptions' => '{#setting:formfields_hood__chinese.priceoptions#}',
        )
    ),
    'price' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_hood__price#}'),
        'fields' => array(
            'exchangerate_update' => '{#setting:formfields_hood__exchangerate_update#}',
        )
    ),
    'syncchinese' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_hood__syncchinese#}'),
        'fields' => array(
            'chinese.stocksync.tomarketplace' => '{#setting:formfields_hood__chinese.stocksync.tomarketplace#}',
            'chinese.inventorysync.price' => '{#setting:formfields_hood__chinese.inventorysync.price#}',
        )
    ),
    'importactive' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_hood__importactive#}'),
        'fields' => array(
            'importactive' => '{#setting:formfields__importactive#}',
            'customergroup' => '{#setting:formfields__customergroup#}',
            'orderimport.shop' => '{#setting:formfields__orderimport.shop#}',
            'orderstatus.open' => '{#setting:formfields__orderstatus.open#}',

        )
    ),

    'upload' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_idealo__upload#}'),
        'fields' => array(
            'subheader.pd' => '{#setting:formfields_idealo__subheader.pd#}',
            'checkin.status' => '{#setting:formfields__checkin.status#}',
            'lang' => '{#setting:formfields__lang#}',
            'quantity' => '{#setting:formfields__quantity#}',
            'subheader.d' => '{#setting:formfields_idealo__subheader.d#}',
            'maxquantity' => '{#setting:formfields__maxquantity#}',
        ),
    ),
    'orderstatus' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_hood__orderstatus#}'),
        'fields' => array(
            'orderstatus.sync' => '{#setting:formfields__orderstatus.sync#}',
            'orderstatus.shipped' => '{#setting:formfields__orderstatus.shipped#}',
            'orderstatus.canceled.notock' => array(
                'name' => 'orderstatus.canceled.nostock',
                'type' => 'select'
            ),
            'orderstatus.canceled.revoked' => array(
                'name' => 'orderstatus.canceled.revoked',
                'type' => 'select'
            ),
            'orderstatus.canceled.nopayment' => array(
                'name' => 'orderstatus.canceled.nopayment',
                'type' => 'select'
            ),
            'orderstatus.canceled.defect' => array(
                'name' => 'orderstatus.canceled.defect',
                'type' => 'select'
            ),
            'orderstatus.sendmail' => '{#setting:formfields_hood__orderstatus.sendmail#}',

        ),
    ),
    // prepare
    'prepare_details' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_idealo__prepare_details#}'),
        'fields' => array(
            'title' => '{#setting:formfields_idealo__prepare_title#}',
            'Description' => '{#setting:formfields_idealo__prepare_description#}',
            'Image' => '{#setting:formfields_idealo__prepare_image#}',
        ),
    ),
    'prepare_general' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_idealo__prepare_general#}'),
        'fields' => array(
            'subheader.pd' => '{#setting:formfields_idealo__subheader.pd#}',
            'paymentmethod' => '{#setting:formfields_idealo__paymentmethod#}',
            'shippingcountry' => '{#setting:formfields_idealo__shippingcountry#}',
            'shippingmethodandcost' => '{#setting:formfields_idealo__shippingmethodandcost#}',
            'shippingtime' => '{#setting:formfields_idealo__shippingtime#}',
            'subheader.d' => '{#setting:formfields_idealo__subheader.d#}',
            'checkout' => '{#setting:formfields_idealo__checkout#}',
            'shippingmethods' => '{#setting:formfields_idealo__shippingmethod#}',
        ),
    ),
));
