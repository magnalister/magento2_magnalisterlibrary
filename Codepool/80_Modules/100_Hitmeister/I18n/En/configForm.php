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

MLI18n::gi()->{'hitmeister_config_account_title'} = 'Login Details';
MLI18n::gi()->{'hitmeister_config_country_title'} = 'Countries';
MLI18n::gi()->{'hitmeister_config_account_prepare'} = 'Item Preparation';
MLI18n::gi()->{'hitmeister_config_account_priceandstock'} = 'Price and Stock';
MLI18n::gi()->{'hitmeister_config_account_sync'} = 'Synchronization';
MLI18n::gi()->{'hitmeister_config_account_orderimport'} = 'Order Import';
MLI18n::gi()->{'hitmeister_config_invoice'} = 'Invoices';
MLI18n::gi()->{'hitmeister_config_checkin_badshippingcost'} = 'Shipping cost must be a number.';
MLI18n::gi()->{'hitmeister_config_checkin_shippingmatching'} = 'Matching of shipping times is not supported by this shop-system.';
MLI18n::gi()->{'hitmeister_config_checkin_manufacturerfilter'} = 'Filter for manufacturer is not supported by this shop-system.';
MLI18n::gi()->{'hitmeister_config_account__legend__account'} = 'Login Details';
MLI18n::gi()->{'hitmeister_config_account__legend__tabident'} = 'Tab';
MLI18n::gi()->{'hitmeister_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'hitmeister_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'hitmeister_config_account__field__clientkey__label'} = 'ClientKey';
MLI18n::gi()->{'hitmeister_config_account__field__clientkey__help'} = 'Please find the API-Key in your Kaufland account. Therefore please login on Kaufland and select <b>Kaufland API</b> in the bottom left menu under <b>Additional features</b>.';
MLI18n::gi()->{'hitmeister_config_account__field__secretkey__label'} = 'SecretKey';
MLI18n::gi()->{'hitmeister_config_account__field__mpusername__label'} = 'Username';
MLI18n::gi()->{'hitmeister_config_account__field__mppassword__label'} = 'Password';
MLI18n::gi()->{'hitmeister_config_country__legend__country'} = 'Countries';
MLI18n::gi()->{'hitmeister_config_country__field__site__label'} = 'Kaufland Country-specific Site';
MLI18n::gi()->{'hitmeister_config_country__field__site__help'} = '<p>This section allows you to choose which Kaufland country site magnalister should connect to. To do this, we utilize the information provided in your Kaufland account.</p><p><strong>Entries that appear grayed out</strong> indicate that the corresponding Kaufland country site is not yet activated within your Kaufland account. You\'ll be able to select and configure these sites for magnalister only after they have been fully set up in your Kaufland account.</p>';
MLI18n::gi()->{'hitmeister_config_country__field__site__alert__*__title'} = 'New Country Site selected';
MLI18n::gi()->{'hitmeister_config_country__field__site__alert__*__content'} = '<p>You have selected a different Kaufland site. This will affect other options, as the Kaufland country sites may offer different currencies as well as payment and shipping methods. Articles are then set to the new country site and only synchronized there, orders are also only imported from there.</p><p><strong>Should the new setting be adopted?</strong></p>';
MLI18n::gi()->{'hitmeister_config_country__field__currency__label'} = 'Currency';
MLI18n::gi()->{'hitmeister_config_country__field__currency__help'} = '<p>The currency in which items are listed on Kaufland is determined by the “Kaufland Country-specific Site” setting.</p>';
MLI18n::gi()->{'hitmeister_config_prepare__legend__prepare'} = 'Prepare Items';
MLI18n::gi()->{'hitmeister_config_prepare__legend__upload'} = 'Upload Items: Presets';
MLI18n::gi()->{'hitmeister_config_prepare__field__prepare.status__label'} = 'Status Filter';
MLI18n::gi()->{'hitmeister_config_prepare__field__prepare.status__valuehint'} = 'Only transfer active items';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.status__label'} = 'Status Filter';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.status__valuehint'} = 'Only transfer active items';
MLI18n::gi()->{'hitmeister_config_prepare__field__lang__label'} = 'Item Description';
MLI18n::gi()->{'hitmeister_config_prepare__field__imagepath__label'} = 'Image Path';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemcondition__label'} = 'Item Condition';
MLI18n::gi()->{'hitmeister_config_prepare__field__handlingtime__label'} = 'Handling Time';
MLI18n::gi()->{'hitmeister_config_prepare__field__handlingtime__help'} = 'Pre-settings for handling time (the time needed to prepare the goods for shipment). This can still be adapted in the item preparation.';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemcountry__label'} = 'Article is sent from ';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemcountry__help'} = 'Please select a country from which the article is sent. Default setting is the country from your shop.';
MLI18n::gi()->{'hitmeister_config_prepare__field__shippinggroup__label'} = 'Shipping Group';
MLI18n::gi()->{'hitmeister_config_prepare__field__shippinggroup__help'} = 'Kaufland Shipping Groups contain information about shipping.';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemsperpage__label'} = 'Results';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemsperpage__help'} = 'Here you define how many articles should be shown in the multi-matching. <br/> Higher quantity also means higher loading-times (eg.: 50 articles > 30 seconds).';
MLI18n::gi()->{'hitmeister_config_prepare__field__itemsperpage__hint'} = 'per page of multimatching';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.variationtitle__label'} = 'Variant info in the product title';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.variationtitle__help'} = 'Activate this setting if you want detailed information such as size, color or type to be included in the title of your product variants on the Kaufland marketplace.<br /><br />That makes it easier for the buyer to differentiate.<br /><br /><strong>Example:</strong><br />Title: Nike T-Shirt<br />Variant: Size S <br /><br />Resulting in title: "Nike T-Shirt - Size S"';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.variationtitle__valuehint'} = 'Add variant information to product title';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.quantity__label'} = 'Inventory Item Count';
MLI18n::gi()->{'hitmeister_config_prepare__field__checkin.quantity__help'} = 'Please enter how much of the inventory should be available on the marketplace.<br/>
                        <br/>
You can change the individual item count directly under \'Upload\'. In this case it is recommended that you turn off automatic<br/>
synchronization under \'Synchronization of Inventory\' > \'Stock Sync to Marketplace\'.<br/>
                        <br/>
To avoid overselling, you can activate \'Transfer shop inventory minus value from the right field\'.
                        <br/>
<strong>Example:</strong> Setting the value at 2 gives &#8594; Shop inventory: 10 &#8594; Kaufland inventory: 8<br/>
                        <br/>
                        <strong>Please note:</strong>If you want to set an inventory count for an item in the Marketplace to \'0\', which is already set as Inactive in the Shop, independent of the actual inventory count, please proceed as follows:<br/>
                        <ul>
                        <li>\'Synchronize Inventory"> Set "Edit Shop Inventory" to "Automatic Synchronization with CronJob"</li>
                        <li>"Global Configuration" > "Product Status" > Activate setting "If product status is inactive, treat inventory count as 0"</li>
                        </ul>';
MLI18n::gi()->{'hitmeister_config_priceandstock__legend__price'} = 'Price Calculation';
MLI18n::gi()->{'hitmeister_config_priceandstock__legend__price.lowest'} = 'Minimum Price Calculation';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price__label'} = 'Price';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price__help'} = 'Please enter a price markup or markdown, either in percentage or fixed amount. Use a minus sign (-) before the amount to denote markdown.';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.addkind__label'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.factor__label'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.signal__label'} = 'Decimal Amount';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.signal__hint'} = 'Decimal Amount';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.signal__help'} = 'This textfield shows the decimal value that will appear in the item price on Kaufland.<br/><br/>
                <strong>Example:</strong> <br />
Value in textfeld: 99 <br />
                Original price: 5.58 <br />
                Final amount: 5.99 <br /><br />
This function is useful when marking the price up or down***. <br/>
Leave this field empty if you do not wish to set any decimal amount. <br/>
The format requires a maximum of 2 numbers.';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__priceoptions__label'} = 'Price Calculation';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__priceoptions__help'} = '{#i18n:configform_priceandstock_field_priceoptions_help#}';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.group__label'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.usespecialoffer__label'} = 'Use special offer prices';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__minimumpriceautomatic__label'} = 'Minimum Price Automatic';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__minimumpriceautomatic__valuehint'} = 'Set minimum price';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__minimumpriceautomatic__values'} = array (
     '0' => 'Minimum Price = Normal Price',
     '1' => 'Minimum Prices as set on Kaufland',
     '2' => 'Configure Minimum Prices'
);
MLI18n::gi()->{'hitmeister_config_priceandstock__field__minimumpriceautomatic__help'} = 'If unchecked, the minimum price transmitted to Kaufland will be set to the price in your shop.';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__exchangerate_update__label'} = 'Exchange Rate';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__exchangerate_update__valuehint'} = 'Automatically update exchange rate';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__exchangerate_update__help'} = '{#i18n:form_config_orderimport_exchangerate_update_help#}';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
###
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest__label'} = 'Minimum Price';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest__help'} = 'Please enter a price markup or markdown, either in percentage or fixed amount. Use a minus sign (-) before the amount to denote markdown.';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.addkind__label'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.factor__label'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.signal__label'} = 'Decimal Amount';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.signal__hint'} = 'Decimal Amount';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.signal__help'} = 'This textfield shows the decimal value that will appear in the item price on Kaufland.<br/><br/>
                <strong>Example:</strong> <br />
Value in textfeld: 99 <br />
                Original price: 5.58 <br />
                Final amount: 5.99 <br /><br />
This function is useful when marking the price up or down***. <br/>
Leave this field empty if you do not wish to set any decimal amount. <br/>
The format requires a maximum of 2 numbers.';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__priceoptions.lowest__label'} = 'Price Calculation';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__priceoptions.lowest__help'} = '{#i18n:configform_priceandstock_field_priceoptions_help#}';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.group__label'} = '';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__price.lowest.usespecialoffer__label'} = 'Use special offer prices';
###
MLI18n::gi()->{'hitmeister_config_priceandstock__legend__sync'} = 'Inventory Synchronization';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__stocksync.tomarketplace__label'} = 'Stock Sync to Marketplace';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__stocksync.tomarketplace__help'} = '<dl>
            <dt>Automatic Synchronization via CronJob (recommended)</dt>
                    <dd>Current Kaufland stock will be synchronized with shop stock every 4 hours, beginning at 0.00am (with ***, depending on configuration).<br>Values will be transferred from the database, including the changes that occur through an ERP or similar.<br><br>
Manual comparison can be activated by clicking the corresponding button in the magnalister header (left of the shopping cart).<br><br>
Additionally, you can activate the stock comparison through CronJon (flat tariff*** - maximum every 4 hours) with the link:<br>
            <i>{#setting:sSyncInventoryUrl#}</i><br>

Some CronJob requests may be blocked, if they are made through customers not on the flat tariff*** or if the request is made more than once every 4 hours.
</dd>
                        
                    </dl>
                    <b>Note:</b> The settings in \'Configuration\' ,&rarr; ‘Article upload:preset’  &rarr; ‘Stock quantity’ will the taken into account.';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__stocksync.frommarketplace__label'} = 'Stock Sync to Marketplace';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__stocksync.frommarketplace__help'} = 'If, for example, an item is purchased 3 times on Kaufland, the Shop inventory will be reduced by 3.<br /><br />
<strong>Important:</strong>This function will only work if you have Order Imports activated!';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__inventorysync.price__label'} = 'Item Price';
MLI18n::gi()->{'hitmeister_config_priceandstock__field__inventorysync.price__help'} = '<p> Current Kaufland price  will be synchronized with shop stock every 4 hours, beginning at 0.00am (with ***, depending on configuration)<br>
Values will be transferred from the database, including the changes that occur through an ERP or similar.<br><br>
<b>Hint:</b> The settings in \'Configuration\', \'price calculation\' will be taken into account.
';
MLI18n::gi()->{'hitmeister_config_orderimport__legend__importactive'} = 'Order Import';
MLI18n::gi()->{'hitmeister_config_orderimport__legend__mwst'} = 'VAT';
MLI18n::gi()->{'hitmeister_config_orderimport__legend__orderstatus'} = 'Order Status Synchronization Between Shop and Kaufland';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.shipped__label'} = 'Confirm Shipping With';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.shipped__help'} = 'Select the shop status that will automatically set the Kaufland status to "confirm shipment".';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.cancelled__label'} = 'Cancel Order With';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.cancelled__help'} = 'Here you set the shop status which will set the MercadoLivre order status to „cancel order“. <br/><br/>
Note: partial cancellation is not possible in this setting. The whole order will be cancelled with this function und credited tot he customer
';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.carrier__label'} = 'Carrier';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.carrier__help'} = 'Pre-Selected carrier during shipping confirmation to Kaufland';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.cancelreason__label'} = 'Canceling order reason';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.cancelreason__help'} = 'Reason for canceling order.';
MLI18n::gi()->{'hitmeister_config_orderimport__field__mwst.fallback__label'} = 'VAT on Non-Shop*** Items';
MLI18n::gi()->{'hitmeister_config_orderimport__field__mwst.fallback__hint'} = 'The tax rate to apply to non-Shop items on order imports, in %.';
MLI18n::gi()->{'hitmeister_config_orderimport__field__mwst.fallback__help'} = 'If an item is not entered in the web-shop, magnalister uses the VAT from here since marketplaces give no details to VAT within the order import.<br />
<br />
Further explanation:<br />
Basically, magnalister calculates the VAT the same way the shop-system does itself.<br />
VAT per country can only be considered if the article can be found in the web-shop with his number range (SKU).<br />
magnalister uses the configured web-shop-VAT-classes.
';
MLI18n::gi()->{'hitmeister_config_orderimport__field__importactive__label'} = 'Active Import';
MLI18n::gi()->{'hitmeister_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'hitmeister_config_orderimport__field__importactive__help'} = 'Import orders from the Marketplace? <br/><br/>When activated, orders will be automatically imported every hour.<br><br>
Manual import can be activated by clicking the corresponding button in the magnalister header (left of the shopping cart).<br><br>Additionally, you can activate the stock comparison through CronJon (flat tariff*** - maximum every 4 hours) with the link:<br>
            <i>{#setting:sImportOrdersUrl#}</i><br>
Some CronJob requests may be blocked, if they are made through customers not on the flat tariff*** or if the request is made more than once every 4 hours. 
';
MLI18n::gi()->{'hitmeister_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'hitmeister_config_orderimport__field__preimport.start__label'} = 'first from date';
MLI18n::gi()->{'hitmeister_config_orderimport__field__preimport.start__hint'} = 'Start Date';
MLI18n::gi()->{'hitmeister_config_orderimport__field__preimport.start__help'} = 'The date from which orders will start being imported. Please note that it is not possible to set this too far in the past, as the data only remains available on Kaufland for a few weeks.***';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.open__label'} = 'Order Status in Shop';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.open__help'} = 'The status that should be transferred automatically to the Shop after a new order on DaWanda. <br />
If you are using a connected dunning process***, it is recommended to set the Order Status to ‘Paid’ (‘Configuration’ > ‘Order Status’).
';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.fbk__label'} = 'FBK Order Status';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.fbk__hint'} = '';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderstatus.fbk__help'} = 'This function is only relevant for sellers participating in \'Fulfillment by Kaufland (FBK)\': <br/>The order status will be defined as an FBK-order, and the status will be transferred automatically to your shop.
If you are using a connected dunning process***, it is recommended to set the Order Status to \'Paid\' (\'Configuration\' > \'Order Status\').';
MLI18n::gi()->{'hitmeister_config_orderimport__field__customergroup__label'} = 'Customer Group';
MLI18n::gi()->{'hitmeister_config_orderimport__field__customergroup__help'} = 'The customer group that customers from new orders should be sorted into.';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderimport.shippingmethod__label'} = 'Shipping Service of the Orders';
MLI18n::gi()->{'hitmeister_config_orderimport__field__orderimport.shippingmethod__help'} = 'Shipping methods that will be assigned to all Kaufland orders. Standard: "Kaufland"<br><br>
This setting is necessary for the invoice and shipping notice, and for editing orders later in the Shop or via ERP.';

MLI18n::gi()->ML_HITMEISTER_NOT_CONFIGURED_IN_KAUFLAND_DE_ACCOUNT = 'not configured in your Kaufland account';
MLI18n::gi()->ML_HITMEISTER_SYNC_FROM_MARKETPLACE_VALUES = [
    'rel' => 'Orders (except for FBK orders) reduce Shop inventory (recommended)',
    'fbk' => 'Orders (including FBK orders) reduce Shop inventory',
    'no' => 'no synchronisation'
];
