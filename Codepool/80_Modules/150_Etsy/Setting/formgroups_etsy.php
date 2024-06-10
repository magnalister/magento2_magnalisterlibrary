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
 * $Id$
 *
 * (c) 2010 - 2018 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

/**
 * all groups using form-fields and includes i18n for legend directly
 */
MLSetting::gi()->add('formgroups_etsy', array(
    'account' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_etsy__account#}',),
        'fields' => array(
            'access.token' => '{#setting:formfields_etsy__access.token#}',
            'shop.language' => '{#setting:formfields_etsy__shop.language#}',
            'shop.currency' => '{#setting:formfields_etsy__shop.currency#}',
        ),
    ),
    'prepare' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_etsy__prepare#}'),
        'fields' => array(
            'whomade' => '{#setting:formfields_etsy__prepare.whomade#}',
            'whenmade' => '{#setting:formfields_etsy__prepare.whenmade#}',
            'issupply' => '{#setting:formfields_etsy__prepare.issupply#}',
            'language' => '{#setting:formfields_etsy__prepare.language#}',
            'imagesize' => '{#setting:formfields_etsy__prepare.imagesize#}',
        ),
    ),
    'shipping' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_etsy__shipping#}'),
        'fields' => array(
            'shippingprofile' => '{#setting:formfields_etsy__shippingprofile#}',
        ),
    ),
    'upload' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_etsy__upload#}'),
        'fields' => array(
            'quantity' => '{#setting:formfields__quantity#}',
            'maxquantity' => '{#setting:formfields__maxquantity#}',
        ),
    ),
    'shippingprofile' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_etsy__shippingprofile#}'),
        'fields' => array(
            'shippingprofiletitle'             => '{#setting:formfields_etsy__shippingprofiletitle#}',
            'shippingprofileorigincountry'     => '{#setting:formfields_etsy__shippingprofileorigincountry#}',
            'shippingprofiledestinationcountry'=> '{#setting:formfields_etsy__shippingprofiledestinationcountry#}',
//             Removed because we can provide destination country or destination region not both (we can later implement with disabling)
//            'shippingprofiledestinationregion'=> '{#setting:formfields_etsy__shippingprofiledestinationregion#}',
            'shippingprofileprimarycost'       => '{#setting:formfields_etsy__shippingprofileprimarycost#}',
            'shippingprofilesecondarycost'     => '{#setting:formfields_etsy__shippingprofilesecondarycost#}',
            'shippingprofileminprocessingtime' => '{#setting:formfields_etsy__shippingprofileminprocessingtime#}',
            'shippingprofilemaxprocessingtime' => '{#setting:formfields_etsy__shippingprofilemaxprocessingtime#}',
            'shippingprofilemindeliverydays'   => '{#setting:formfields_etsy__shippingprofilemindeliverydays#}',
            'shippingprofilemaxdeliverydays'   => '{#setting:formfields_etsy__shippingprofilemaxdeliverydays#}',
            'shippingprofileoriginpostalcode'  => '{#setting:formfields_etsy__shippingprofileoriginpostalcode#}',
            'shippingprofilesend'              => '{#setting:formfields_etsy__shippingprofilesend#}',
        ),
    ),
    'orderstatus' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_etsy__orderstatus#}'),
        'fields' => array(
            'orderstatus.sync' => '{#setting:formfields__orderstatus.sync#}',
            'orderstatus.shipping' => '{#setting:formfields_etsy__orderstatus.shipping#}',
            'orderstatus.shipped' => '{#setting:formfields__orderstatus.shipped#}',
        ),
    ),
    'comparisonprice' => array(
        'legend' => array('i18n' => '{#i18n:formgroups__comparisonprice#}'),
        'fields' => array(
            'fixed.price' => '{#setting:formfields_etsy__fixed.price#}',
            'priceoptions' => '{#setting:formfields__priceoptions#}',
        ),
    ),
    'prepare_details' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_etsy__prepare_details#}'),
        'fields' => array(
            'Title' => '{#setting:formfields_etsy__prepare_title#}',
            'Description' => '{#setting:formfields_etsy__prepare_description#}',
            'Image' => '{#setting:formfields_etsy__prepare_image#}',
        ),
    ),
    'prepare_general' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_etsy__prepare_general#}'),
        'fields' => array(
            'whomade' => '{#setting:formfields_etsy__prepare.whomade#}',
            'whenmade' => '{#setting:formfields_etsy__prepare.whenmade#}',
            'issupply' => '{#setting:formfields_etsy__prepare.issupply#}',
            'price' => '{#setting:formfields_etsy__prepare_price#}',
            'quantity' => '{#setting:formfields_etsy__prepare_quantity#}',
            'shippingprofile' => '{#setting:formfields_etsy__shippingprofile#}',
        ),
    ),
    'prepare_shippingprofile' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_etsy__shippingprofile#}'),
        'fields' => array(
            'shippingprofiletitle'             => '{#setting:formfields_etsy__shippingprofiletitle#}',
            'shippingprofileorigincountry'     => '{#setting:formfields_etsy__shippingprofileorigincountry#}',
            'shippingprofiledestinationcountry'=> '{#setting:formfields_etsy__shippingprofiledestinationcountry#}',
//            Removed because we can provide destination country or destination region not both (we can later implement with disabling)
//            'shippingprofiledestinationregion'=> '{#setting:formfields_etsy__shippingprofiledestinationregion#}',
            'shippingprofileprimarycost'       => '{#setting:formfields_etsy__shippingprofileprimarycost#}',
            'shippingprofilesecondarycost'     => '{#setting:formfields_etsy__shippingprofilesecondarycost#}',
            'shippingprofileminprocessingtime' => '{#setting:formfields_etsy__shippingprofileminprocessingtime#}',
            'shippingprofilemaxprocessingtime' => '{#setting:formfields_etsy__shippingprofilemaxprocessingtime#}',
            'shippingprofilemindeliverydays'   => '{#setting:formfields_etsy__shippingprofilemindeliverydays#}',
            'shippingprofilemaxdeliverydays'   => '{#setting:formfields_etsy__shippingprofilemaxdeliverydays#}',
            'shippingprofileoriginpostalcode'  => '{#setting:formfields_etsy__shippingprofileoriginpostalcode#}',
            'shippingprofilesend'              => '{#setting:formfields_etsy__shippingprofilesend#}',
        ),
    ),
    'prepare_variations' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_etsy__prepare_variations#}'),
        'fields' => array(
            'variationgroups' => '{#setting:formfields_etsy__prepare_variationgroups#}',
        ),
    ),
    'prepare_variationmatching' => array(
        'legend' => array('template' => 'two-columns'),
        'type' => 'ajaxfieldset',
        'field' => array(
            'name' => 'variationmatching',
            'type' => 'ajax',
        ),
    ),
    'prepare_action' => array(
        'legend' => array(
            'classes' => array(
              /*  'mlhidden',*/
            ),
        ),
        'row' => array(
            'template' => 'action-row-row-row',
        ),
        'fields' => array(
            'saveaction' => '{#setting:formfields_etsy__prepare_saveaction#}',
            'resetaction' => '{#setting:formfields_etsy__prepare_resetaction#}',
        ),
    ),
));
