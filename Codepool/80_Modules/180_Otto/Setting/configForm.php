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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLSetting::gi()->add('otto_config_account', array(
    'tabident' => '{#setting:formgroups__tabident#}',
    'account' => '{#setting:formgroups_otto__account#}',
), false);

MLSetting::gi()->add('otto_config_prepare', array(
    'prepare' => '{#setting:formgroups_otto__prepare#}',
    'upload' => '{#setting:formgroups_otto__upload#}',
), false);

MLSetting::gi()->add('otto_config_priceandstock', array(
    'price' => '{#setting:formgroups__genericprice#}',
    'quantity' => '{#setting:formgroups_otto__quantity#}',
    'sync' => '{#setting:formgroups__sync#}',
), false);

MLSetting::gi()->add('otto_config_order', array(
    'orderimport' => '{#setting:formgroups_otto__orderimport#}',
    'mwst' => '{#setting:formgroups__mwst#}',
    'orderstatusimport' => '{#setting:formgroups_otto__orderstatusimport#}',
    'paymentandshipping' => '{#setting:formgroups_otto_paymentandshipping#}',
    'orderstatus' => '{#setting:formgroups_otto__orderstatus#}',
), false);

MLSetting::gi()->add('otto_config_sync', array(
    'sync' => '{#setting:formgroups__sync#}',
), false);

MLSetting::gi()->add('otto_config_emailtemplate', array(
    'mail' => '{#setting:formgroups__mail#}',
), false);
