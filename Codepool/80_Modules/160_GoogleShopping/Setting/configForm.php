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
 * all tabs using form-groups
 */
MLSetting::gi()->add('googleshopping_config_account', array(
    'tabident' => '{#setting:formgroups__tabident#}',
    'account' => '{#setting:formgroups_googleshopping__account#}',
), false);

MLSetting::gi()->add('googleshopping_config_prepare', array(
    'prepare' => '{#setting:formgroups_googleshopping__prepare#}',
    'shipping' => '{#setting:formgroups_googleshopping__shipping#}',
    'prepare_shippingtemplate' => '{#setting:formgroups_googleshopping__prepare_shippingtemplate#}',
), false);

MLSetting::gi()->add('googleshopping_config_price', array(
    'price' => '{#setting:formgroups_googleshopping__comparisonprice#}'
), false);

MLSetting::gi()->add('googleshopping_config_orderimport', array(
    'orderimport' => '{#setting:formgroups_googleshopping__orderimport#}',
    'mwst' => '{#setting:formgroups__mwst#}',
    'orderstatus' => '{#setting:formgroups_googleshopping__orderstatus#}',
), false);

MLSetting::gi()->add('googleshopping_config_sync', array(
    'sync' => '{#setting:formgroups__sync#}',
), false);

MLSetting::gi()->add('googleshopping_config_orderimport1', array(
    'dummy' => array(
        'fields' => array(
            array(
                'name' => 'dummy',
                'type' => 'dummy',
            ),
        ),
    ),
), true);
