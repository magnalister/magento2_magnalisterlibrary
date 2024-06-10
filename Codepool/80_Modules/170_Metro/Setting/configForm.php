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

MLSetting::gi()->add('metro_config_account', array(
    'tabident' => '{#setting:formgroups__tabident#}',
    'account' => '{#setting:formgroups_metro__account#}',
), false);

MLSetting::gi()->add('metro_config_prepare', array(
    'prepare' => '{#setting:formgroups_metro__prepare#}',
    'shipping' => '{#setting:formgroups_metro__shipping#}',
    'upload' => '{#setting:formgroups_metro__upload#}',
), false);

MLSetting::gi()->add('metro_config_priceandstock', array(
    'quantity' => '{#setting:formgroups_metro__quantity#}',
    'price' => '{#setting:formgroups__genericprice#}',
    'sync' => '{#setting:formgroups__sync#}',
    'volumeprices' => '{#setting:formgroups_metro__volumeprices#}',
), false);

MLSetting::gi()->add('metro_config_order', array(
    'orderimport' => '{#setting:formgroups__orderimport#}',
    'mwst'        => '{#setting:formgroups__mwst#}',
    'orderstatus' => '{#setting:formgroups_metro__orderstatus#}',
), false);

MLSetting::gi()->add('metro_config_sync', array(
    'sync' => '{#setting:formgroups__sync#}',
), false);

MLSetting::gi()->add('metro_config_emailtemplate', array(
    'mail' => '{#setting:formgroups__mail#}',
), false);

MLSetting::gi()->add('metro_config_invoice', array(
    'invoice' => '{#setting:formgroups_metro__invoice#}',
    'erpInvoice'   => '{#setting:formgroups_metro__erpInvoice#}',
    'magnaInvoice' => '{#setting:formgroups_metro__magnaInvoice#}',
), false);


