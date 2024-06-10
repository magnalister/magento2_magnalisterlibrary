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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLI18n::gi()->{'configform_quantity_values__stock__title'} = 'Transfer shop inventory';
MLI18n::gi()->{'configform_quantity_values__stock__textoption'} = '';
MLI18n::gi()->{'configform_quantity_values__stocksub__title'} = 'Transfer shop inventory minus value from the right field';
MLI18n::gi()->{'configform_quantity_values__stocksub__textoption'} = '1';
MLI18n::gi()->{'configform_quantity_values__lump__title'} = 'Flat amount (from the right field)';
MLI18n::gi()->{'configform_quantity_values__lump__textoption'} = '1';
MLI18n::gi()->{'configform_price_addkind_values__percent'} = 'Markup/Markdown of x% of Shop price';
MLI18n::gi()->{'configform_price_addkind_values__addition'} = 'Markup/Markdown Shop price by x';
MLI18n::gi()->{'configform_sync_value_auto'} = 'Automatic synchronization via CronJob (recommended)';
MLI18n::gi()->{'configform_sync_value_fast'} = 'Faster automatic synchronization (CronJob to 15 minutes)';
MLI18n::gi()->{'configform_sync_value_no'} = 'No synchronization';
MLI18n::gi()->{'configform_sync_values__auto'} = '{#i18n:configform_sync_value_auto#}';
MLI18n::gi()->{'configform_sync_values__no'} = '{#i18n:configform_sync_value_no#}';
MLI18n::gi()->{'configform_fast_sync_values__auto'} = '{#i18n:configform_sync_value_auto#}';
MLI18n::gi()->{'configform_fast_sync_values__no'} = '{#i18n:configform_sync_value_no#}';
MLI18n::gi()->{'configform_stocksync_values__rel'} = 'Orders reduce Shop inventory (recommended)';
MLI18n::gi()->{'configform_stocksync_values__no'} = '{#i18n:configform_sync_value_no#}';
MLI18n::gi()->{'configform_price_field_priceoptions_help'} = 'With this function you can transfer different prices to the marketplace and synchronize them automatically.<br />
<br />
Select a customer group from your webshop using the dropdown on the right.<br />
<br />
If you do not enter a price in the new customer group, the default price from the webshop will be used automatically. This makes it very easy to enter a different price even for just a few items. The other price configurations are also applied.<br />
<br />
<b>Example:</b>
<ul>
<li>Create a customer group in your webshop, e.g. "{#setting:currentMarketplaceName#} customers".</li>
<li>In your webshop, add the wanted prices to the new customer group\'s items.</li>
<ul>';
MLI18n::gi()->{'configform_emailtemplate_legend'} = 'E-Mail to Buyer';
MLI18n::gi()->{'configform_emailtemplate_field_send_label'} = 'Email to buyer upon order receipt';
MLI18n::gi()->{'configform_emailtemplate_field_send_help'} = 'Should an email be sent from your Shop to customers?';
MLI18n::gi()->{'generic_prepareform_day'} = 'day';
MLI18n::gi()->{'orderstatus_carrier_defaultField_value_shippingname'} = 'Pass shipping method as carrier';
MLI18n::gi()->{'configform_price_field_strikeprice_help'} = '
The {#setting:currentMarketplaceName#} Strike Price feature provides promotional prices or suggested retail prices (MSRP). A crossed out price is displayed next to the final sales price.<br /><br />
<b>Important Notes:</b><br />
<ul>
<li>If the strike price is lower than the sales price, no strike price will be submitted.</li>
<li>Strike prices are displayed in the product listings in the magnalister plugin with a red crossed out price next to the sales price.</li>
<li>According to {#setting:currentMarketplaceName#} rules, the original price must have actually been used earlier in the webshop or on {#setting:currentMarketplaceName#}, or be an MSRP from the manufacturer.</li>
</ul>';
MLI18n::gi()->{'configform_price_field_strikeprice_label'} = 'Crossed Out {#setting:currentMarketplaceName#} Price (Strike Price)';
MLI18n::gi()->{'configform_price_field_priceoptions_kind_label'} = 'The Crossed Out Price on {#setting:currentMarketplaceName#} Equals';
MLI18n::gi()->{'configform_price_field_priceoptions_label'} = 'Sales Price from Customer Group';
MLI18n::gi()->{'marketplace_configuration_orderimport_payment_method_from_marketplace'} = 'Apply the payment method submitted by the marketplace';
