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

MLI18n::gi()->{'idealo_config_account_title'} = 'Login Details';
MLI18n::gi()->{'idealo_config_account_prepare'} = 'Item Preparation';
MLI18n::gi()->{'idealo_config_account_price'} = 'Price Calculation';
MLI18n::gi()->{'idealo_config_account_sync'} = 'Synchronization';
MLI18n::gi()->{'idealo_config_account_orderimport'} = 'Order Import';
MLI18n::gi()->{'idealo_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'idealo_config_message_no_csv_table_yet'} = 'No CSV sheet created yet: Please trigger an article first. You will find the CSV-path after that here.';
MLI18n::gi()->{'idealo_methods_not_available'} = 'Please add and save the direct-buy-token in "Login Data" first.';
MLI18n::gi()->{'idealo_configform_orderimport_payment_values__textfield__title'} = 'From textfield';
MLI18n::gi()->{'idealo_configform_orderimport_payment_values__textfield__textoption'} = '1';
MLI18n::gi()->{'idealo_configform_orderimport_payment_values__matching__title'} = '{#i18n:marketplace_configuration_orderimport_payment_method_from_marketplace#}';

MLI18n::gi()->idealo_switching_to_moapiv2_popup_title = 'Switch to idealo Direct Buy Merchant Order API v2';
MLI18n::gi()->idealo_switching_to_moapiv2_popup_text = 'Since January 01, 2021 magnalister supports the idealo Direktkauf Merchant Order API v2. The Merchant Order API v1 will be deactivated soon.
<br><br>
Please generate a "Client ID" and a "Client Password" in your idealo Business Account and enter the data in the magnalister idealo configuration under „Login  Data" -> "idealo Direktkauf".
<br><br>
Find instructions for the switchover in the info icon next to "Use idealo Checkout (“Direktkauf”)".
';