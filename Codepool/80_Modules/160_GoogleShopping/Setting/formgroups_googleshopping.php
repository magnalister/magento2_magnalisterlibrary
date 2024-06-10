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
MLSetting::gi()->add('formgroups_googleshopping', array(
    'account' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_googleshopping__account#}',),
        'fields' => array(
            'access.clientid' => '{#setting:formfields_googleshopping__access.clientid#}',
            'access.token' => '{#setting:formfields_googleshopping__access.token#}',
            'shop.targetcountry' => '{#setting:formfields_googleshopping__shop.targetcountry#}',
            'shop.currencies' => '{#setting:formfields_googleshopping__shop.currencies#}',
        ),
    ),
    'prepare' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_googleshopping__prepare#}'),
        'fields' => array(
            'status' => '{#setting:formfields__prepare.status#}',
            'language' => '{#setting:formfields_googleshopping__prepare.language#}',
        ),
    ),
    'shipping' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_googleshopping__shipping#}'),
        'fields' => array(
            'shippingtemplate' => '{#setting:formfields_googleshopping__shippingtemplate#}',
        ),
    ),
    'prepare_shippingtemplate' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_googleshopping__prepare_shippingtemplate#}'),
        'fields' => array(
            'shippingtemplatetitle' => '{#setting:formfields_googleshopping__shippingtemplatetitle#}',
            'shippingtemplatecountry' => '{#setting:formfields_googleshopping__shippingtemplatecountry#}',
            'shippingtemplateprimarycost' => '{#setting:formfields_googleshopping__shippingtemplateprimarycost#}',
            'shippingtemplatecurrencyvalue' => '{#setting:formfields_googleshopping__shippingtemplatecurrencyvalue#}',
            'shippingtemplatetime' => '{#setting:formfields_googleshopping__shippingtemplatetime#}',
            'shippingtemplatesend' => '{#setting:formfields_googleshopping__shippingtemplatesend#}',
        ),
    ),
    'comparisonprice' => array(
        'legend' => array('i18n' => '{#i18n:formgroups__comparisonprice#}'),
        'fields' => array(
            'fixed.price' => '{#setting:formfields_googleshopping__fixed.price#}',
            'priceoptions' => '{#setting:formfields__priceoptions#}',
        ),
    ),
    'prepare_details' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_googleshopping__prepare_details#}'),
        'fields' => array(
            'Title' => '{#setting:formfields_googleshopping__prepare_title#}',
            'Description' => '{#setting:formfields_googleshopping__prepare_description#}',
            'Image' => '{#setting:formfields_googleshopping__prepare_image#}',
            'Condition' => '{#setting:formfields_googleshopping__prepare_condition#}',
            'ShippingTemplate' => '{#setting:formfields_googleshopping__shippingtemplateprepare#}',
        ),
    ),
    'prepare_general' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_googleshopping__prepare_general#}'),
        'fields' => array(
            'shippingtemplate' => '{#setting:formfields_googleshopping__shippingtemplate#}',
        ),
    ),
    'prepare_categories' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_googleshopping__prepare_variations#}'),
        'fields' => array(
            'category' => '{#setting:formfields_googleshopping__category#}',
       ),
    ),
    'orderstatus' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_googleshopping__orderstatus#}'),
        'fields' => array(
            'orderstatus.sync' => '{#setting:formfields__orderstatus.sync#}',
            'orderstatus.shipped' => '{#setting:formfields__orderstatus.shipped#}',
            'orderstatus.canceled' => '{#setting:formfields__orderstatus.canceled#}',
        ),
    ),
    'prepare_variations' => array(
        'legend' => array('i18n' => '{#i18n:formgroups_googleshopping__prepare_variations#}'),
        'fields' => array(
            'variationgroups' => '{#setting:formfields_googleshopping__prepare_variationgroups#}',
        ),
    ),
    'prepare_variationmatching' => array(
        'legend' => array( 'template' => 'two-columns'),
        'type' => 'ajaxfieldset',
        'field' => array(
            'name' => 'variationmatching',
            'type' => 'ajax',
        ),
    ),
    'prepare_action' => array(
        'legend' => array(
            'classes' => array(
                'mlhidden',
            ),
        ),
        'row' => array(
            'template' => 'action-row-row-row',
        ),
        'fields' => array(
            'saveaction' => '{#setting:formfields_googleshopping__prepare_saveaction#}',
            'resetaction' => '{#setting:formfields_googleshopping__prepare_resetaction#}',
        ),
    ),
));
