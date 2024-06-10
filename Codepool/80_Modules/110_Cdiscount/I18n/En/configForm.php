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

MLI18n::gi()->{'cdiscount_config_use_shop_value'} = 'Take over from Shop';
MLI18n::gi()->{'cdiscount_config_account_title'} = 'Login Details';
MLI18n::gi()->{'cdiscount_config_account_prepare'} = 'Item Preparation';
MLI18n::gi()->{'cdiscount_config_account_price'} = 'Price Calculation';
MLI18n::gi()->{'cdiscount_config_account_sync'} = 'Synchronization';
MLI18n::gi()->{'cdiscount_config_account_orderimport'} = 'Order Import';
MLI18n::gi()->{'cdiscount_config_account_producttemplate'} = 'Product Template';
MLI18n::gi()->{'cdiscount_config_checkin_badshippingtime'} = 'Shipping time must be a number from 1 to 10.';
MLI18n::gi()->{'cdiscount_config_checkin_badshippingcost'} = 'Shipping cost must be a number.';
MLI18n::gi()->{'cdiscount_config_checkin_shippingmatching'} = 'Matching of shipping times is not supported by this shop-system.';
MLI18n::gi()->{'cdiscount_config_checkin_manufacturerfilter'} = 'The manufacturer filter is not supported by this shop-system';
MLI18n::gi()->{'cdiscount_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'cdiscount_config_account_emailtemplate_sender'} = 'Example Shop';
MLI18n::gi()->{'cdiscount_config_account_emailtemplate_sender_email'} = 'example@onlineshop.com';
MLI18n::gi()->{'cdiscount_config_account_emailtemplate_subject'} = 'Your Order from #SHOPURL#';
MLI18n::gi()->{'cdiscount_config_account_emailtemplate_content'} = '<style>
        <!--body { font: 12px sans-serif; }
        table.ordersummary { width: 100%; border: 1px solid #e8e8e8; }
        table.ordersummary td { padding: 3px 5px; }
        table.ordersummary thead td { background: #cfcfcf; color: #000; font-weight: bold; text-align: center; }
        table.ordersummary thead td.name { text-align: left; }
        table.ordersummary tbody tr.even td { background: #e8e8e8; color: #000; }
        table.ordersummary tbody tr.odd td { background: #f8f8f8; color: #000; }
        table.ordersummary td.price, table.ordersummary td.fprice { text-align: right; white-space: nowrap; }
        table.ordersummary tbody td.qty { text-align: center; }-->
    </style>
    <p>Hello #FIRSTNAME# #LASTNAME#,</p>
    <p>Thank you for your order! The following items were ordered via #MARKETPLACE#:</p>
    #ORDERSUMMARY#
    <p>Shipping costs are included.</p>
    <p>You\\\'ll find more great offers in our shop at <strong>#SHOPURL#</strong>.</p>
    <p>&nbsp;</p>
    <p>Sincerely,</p>
    <p>Your Online Shop Team</p>';
MLI18n::gi()->{'cdiscount_configform_orderimport_payment_values__textfield__title'} = 'From text-field';
MLI18n::gi()->{'cdiscount_configform_orderimport_payment_values__textfield__textoption'} = '1';
MLI18n::gi()->{'cdiscount_configform_orderimport_payment_values__Cdiscount__title'} = 'Cdisocunt';
MLI18n::gi()->{'cdiscount_configform_orderimport_shipping_values__textfield__title'} = 'From text-field';
MLI18n::gi()->{'cdiscount_configform_orderimport_shipping_values__textfield__textoption'} = '1';
MLI18n::gi()->{'cdiscount_configform_orderimport_shipping_values__matching__title'} = 'Take over from Marketplace';
MLI18n::gi()->{'cdiscount_config_account__legend__account'} = 'Login Details';
MLI18n::gi()->{'cdiscount_config_account__legend__tabident'} = 'Tab';
MLI18n::gi()->{'cdiscount_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'cdiscount_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'cdiscount_config_account__field__mpusername__label'} = 'API-Username';
MLI18n::gi()->{'cdiscount_config_account__field__mpusername__help'} = '';
MLI18n::gi()->{'cdiscount_config_account__field__mppassword__label'} = 'API-Password';
MLI18n::gi()->{'cdiscount_config_account__field__mppassword__help'} = '';
MLI18n::gi()->{'cdiscount_config_prepare__legend__prepare'} = 'Prepare Items';
MLI18n::gi()->{'cdiscount_config_prepare__legend__upload'} = 'Articel upload: Pre-Settings';
MLI18n::gi()->{'cdiscount_config_prepare__field__prepare.status__label'} = 'Status filter';
MLI18n::gi()->{'cdiscount_config_prepare__field__prepare.status__valuehint'} = 'Only take active article';
MLI18n::gi()->{'cdiscount_config_prepare__field__checkin.status__label'} = 'Status filter';
MLI18n::gi()->{'cdiscount_config_prepare__field__checkin.status__valuehint'} = 'Only take active article';
MLI18n::gi()->{'cdiscount_config_prepare__field__lang__label'} = 'Article description';
MLI18n::gi()->{'cdiscount_config_prepare__field__imagepath__label'} = 'Picture path';
MLI18n::gi()->{'cdiscount_config_prepare__field__marketingdescription__label'} = 'Marketing description';
MLI18n::gi()->{'cdiscount_config_prepare__field__marketingdescription__help'} = 'The marketing description must describe the product. It appears in the tab "Présentation produit". It must not contain offers data (Guarantee, price, shipping, packaging ...). HTML code is allowed. Description cannot exceed 5000 characters.';
MLI18n::gi()->{'cdiscount_config_prepare__field__standarddescription__label'} = 'Description';
MLI18n::gi()->{'cdiscount_config_prepare__field__standarddescription__help'} = 'The product description must describe the product. It appears at the top of the product sheet under the wording. It must not contain offers data. (Guarantee, price, shipping, packaging...), html code or others codes. Description cannot exceed 420 characters.';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemcondition__label'} = 'Condition';
MLI18n::gi()->{'cdiscount_config_prepare__field__preparationtime__label'} = 'Preparation Time (in days 1-10)';
MLI18n::gi()->{'cdiscount_config_prepare__field__preparationtime__help'} = 'Preparation time for deliver product. it must be in days between 1 and 10.';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_standard__label'} = 'Shipping Standard';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_standard__help'} = 'Standard way of shipping.<br>
				            Additional shipping fee is when you allow to apply cheaper
				            shipping fees if the customer orders several products
				            in the same order.';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_tracked__label'} = 'Shipping Tracked';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_tracked__help'} = 'Tracked way of shipping.<br>
				            Additional shipping fee is when you allow to apply cheaper
				            shipping fees if the customer orders several products
				            in the same order.';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_registered__label'} = 'Shipping Registered';
MLI18n::gi()->{'cdiscount_config_prepare__field__shipping_time_registered__help'} = 'Registered way of shipping.<br>
				            Additional shipping fee is when you allow to apply cheaper
				            shipping fees if the customer orders several products
				            in the same order.';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingprofile__label'} = 'Shipping-Profile';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingprofile__help'} = 'Create your shipping profiles here. <br>
                            You can specify different shipping costs for each profile (example: 4.95) and define a default profile. 
                            The specified shipping costs will be added to the item price during the product upload, as goods can only be uploaded on the CDiscount Marketplace free of shipping costs.';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingfee__label'} = 'Shipping fee (€)';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingfeeadditional__label'} = 'Additional shipping fee (€)';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingprofilename__label'} = 'Name of the Shipping-Profile';
MLI18n::gi()->{'cdiscount_config_prepare__field__shippingprofilecost__label'} = 'Shipping Surcharge';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemcountry__label'} = 'Article will be sent from ';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemcountry__help'} = 'Please select the country the article is sent from. Default is the country from your shop';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemsperpage__label'} = 'Results';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemsperpage__help'} = 'Here you define how many articles should be shown in the multi-matching. <br/> Higher quantity also means higher loading-times (eg.: 50 articles > 30 seconds).';
MLI18n::gi()->{'cdiscount_config_prepare__field__itemsperpage__hint'} = 'per Page within multi-matching';
MLI18n::gi()->{'cdiscount_config_prepare__field__checkin.quantity__label'} = 'Quantitiy Stock';
MLI18n::gi()->{'cdiscount_config_prepare__field__checkin.quantity__help'} = 'Please enter how much of the inventory should be available on the marketplace.<br/>
                        <br/>
You can change the individual item count directly under \'Upload\'. In this case it is recommended that you turn off automatic<br/>
synchronization under \'Synchronization of Inventory\' > \'Stock Sync to Marketplace\'.<br/>
                        <br/>
To avoid overselling, you can activate \'Transfer shop inventory minus value from the right field\'.
                        <br/>
<strong>Example:</strong> Setting the value at 2 gives &#8594; Shop inventory: 10 &#8594; Cdiscount  inventory: 8<br/>
                        <br/>
                        <strong>Please note:</strong>If you want to set an inventory count for an item in the Marketplace to \'0\', which is already set as Inactive in the Shop, independent of the actual inventory count, please proceed as follows:<br/>
                        <ul>
                        <li>\'Synchronize Inventory"> Set "Edit Shop Inventory" to "Automatic Synchronization with CronJob"</li>
                        <li>"Global Configuration" > "Product Status" > Activate setting "If product ';
MLI18n::gi()->{'cdiscount_config_price__legend__price'} = 'Price Calculation';
MLI18n::gi()->{'cdiscount_config_price__field__usevariations__label'} = 'Variations';
MLI18n::gi()->{'cdiscount_config_price__field__usevariations__help'} = 'Option activated: Products that are available in various variation (like size or color) in the shop will be transmitted to Cdiscount in this way.<br /><br />
 
The option “Item quantity” will be used for any Variation.<br /><br />
 
<b>Example:</b>
You have 8 article “blue”, 5 “green” and 2 “black”, under Quantity “take stock quantity minus value from the field right” and the value 2 in that field. The article will be transmitted 6 times blue and 3 times green.
<br /><br /><b>Hint:</b> 
It is possible that Variations you use (eg. Size or color) will also be shown in the attributes-selection for the category. In such case your variation is used, not the attributes value.
';
MLI18n::gi()->{'cdiscount_config_price__field__usevariations__valuehint'} = 'Transmit variations';
MLI18n::gi()->{'cdiscount_config_price__field__price__label'} = 'Price';
MLI18n::gi()->{'cdiscount_config_price__field__price__help'} = 'Please enter a price markup or markdown, either in percentage or fixed amount. Use a minus sign (-) before the amount to denote markdown.';
MLI18n::gi()->{'cdiscount_config_price__field__price.addkind__label'} = '';
MLI18n::gi()->{'cdiscount_config_price__field__price.factor__label'} = '';
MLI18n::gi()->{'cdiscount_config_price__field__price.signal__label'} = 'Place after decimal point';
MLI18n::gi()->{'cdiscount_config_price__field__price.signal__hint'} = 'Place after decimal point';
MLI18n::gi()->{'cdiscount_config_price__field__price.signal__help'} = 'This textfield will be taken as position after decimal point for transmitted data to Cdiscount.<br><br>
                <strong>Example:</strong><br>
value in textfield: 99<br>
                price origin: 5.58<br>
                final result: 5.99<br><br>
This function is usefull for percentage markups and markdowns.<br>
Leave this field open if you don’t want to transmit a position after decimal point.<br> The input format is an integral number with a maximum of 2 digits.
';
MLI18n::gi()->{'cdiscount_config_price__field__priceoptions__label'} = 'Price options';
MLI18n::gi()->{'cdiscount_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'cdiscount_config_price__field__price.usespecialoffer__label'} = 'also use special prices';
MLI18n::gi()->{'cdiscount_config_price__field__exchangerate_update__label'} = 'Exchange rate';
MLI18n::gi()->{'cdiscount_config_price__field__exchangerate_update__valuehint'} = 'Automatic update of exchange rate';
MLI18n::gi()->{'cdiscount_config_price__field__exchangerate_update__help'} = '{#i18n:form_config_orderimport_exchangerate_update_help#}';
MLI18n::gi()->{'cdiscount_config_price__field__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
MLI18n::gi()->{'cdiscount_config_sync__legend__sync'} = 'Stock Sync';
MLI18n::gi()->{'cdiscount_config_sync__field__stocksync.tomarketplace__label'} = 'Stock change shop';
MLI18n::gi()->{'cdiscount_config_sync__field__stocksync.tomarketplace__help'} = '<dl>
            <dt>Automatic Synchronization via CronJob (recommended)</dt>
                    <dd>Current Cdiscount stock will be synchronized with shop stock every 4 hours, beginning at 0.00am (with ***, depending on configuration).<br>Values will be transferred from the database, including the changes that occur through an ERP or similar.<br><br>
Manual comparison can be activated by clicking the corresponding button in the magnalister header (left of the shopping cart).<br><br>
Additionally, you can activate the stock comparison through CronJon (flat tariff*** - maximum every 4 hours) with the link:<br>
            <i>{#setting:sSyncInventoryUrl#}</i><br>

Some CronJob requests may be blocked, if they are made through customers not on the flat tariff*** or if the request is made more than once every 4 hours.
</dd>
                        
                    </dl>
                    <b>Note:</b> The settings in \'Configuration\' ,&rarr; ‘Article upload:preset’  &rarr; ‘Stock quantity’ will the taken into account.';
MLI18n::gi()->{'cdiscount_config_sync__field__stocksync.frommarketplace__label'} = 'Stock change Cdiscount';
MLI18n::gi()->{'cdiscount_config_sync__field__stocksync.frommarketplace__help'} = 'If, for example, an item is purchased 3 times on Cdiscount, the Shop inventory will be reduced by 3.<br /><br />
<strong>Important:</strong>This function will only work if you have Order Imports activated!';
MLI18n::gi()->{'cdiscount_config_sync__field__inventorysync.price__label'} = 'Article Price';
MLI18n::gi()->{'cdiscount_config_sync__field__inventorysync.price__help'} = '<p> Current Cdiscount price  will be synchronized with shop stock every 4 hours, beginning at 0.00am (with ***, depending on configuration)<br>
Values will be transferred from the database, including the changes that occur through an ERP or similar.<br><br>
<b>Hint:</b> The settings in \'Configuration\', \'price calculation\' will be taken into account.
';
MLI18n::gi()->{'cdiscount_config_orderimport__legend__importactive'} = 'Order Import';
MLI18n::gi()->{'cdiscount_config_orderimport__legend__mwst'} = 'VAT';
MLI18n::gi()->{'cdiscount_config_orderimport__legend__orderstatus'} = 'Synchronization of the order status from shop to Cdiscount';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.shipped__label'} = 'Confirm shipping with';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.shipped__help'} = 'Select the shop status that will automatically set the Cdiscount status to "confirm shipment".';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.carrier.default__label'} = 'Carrier';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.carrier.default__help'} = 'Pre-selected carrier with confirmation of distribution to Cdiscount.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.cancelled__label'} = 'Cancel order with';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.cancelled__help'} = 'Here you set the shop status which will set the MercadoLivre order status to „cancel order“. <br/><br/>
Note: partial cancellation is not possible in this setting. The whole order will be cancelled with this function und credited tot he customer
';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.autoacceptance__label'} = 'Auto acceptance of orders';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.autoacceptance__valuehint'} = '(Recommended) Regardless you accept this field you will be able to reject order at any moment.Click help icon for more info.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.autoacceptance__help'} = 'If auto acceptance remain unchecked You will
            have to go to your Cdiscount seller profile (Link: <a href = "https://seller.cdiscount.com/Orders.html">https://seller.cdiscount.com/Orders.html</a>) and to manually accept orders.
            After that step, you can update order status to \'cancel shipment\' or \'confirm shipment\' via magnalister plugin.
            If this field remain checked, orders will be accepted automatically(Besides that seller will be able to reject them in any moment).';
MLI18n::gi()->{'cdiscount_config_orderimport__field__mwst.fallback__label'} = 'VAT shop external article';
MLI18n::gi()->{'cdiscount_config_orderimport__field__mwst.fallback__hint'} = 'tax rate that is used in the order import for shop-external article in %.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__mwst.fallback__help'} = 'The VAT can not be determinded if the article is not transmitted via magnalister.<br />
Solution: The here inserted %-value will be assigned to all products where no VAT is known while the order import from Cdiscount.
';
MLI18n::gi()->{'cdiscount_config_orderimport__field__importactive__label'} = 'Activate Import';
MLI18n::gi()->{'cdiscount_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'cdiscount_config_orderimport__field__importactive__help'} = 'Import orders from the Marketplace? <br/><br/>When activated, orders will be automatically imported every hour.<br><br>
Manual import can be activated by clicking the corresponding button in the magnalister header (left of the shopping cart).<br><br>Additionally, you can activate the stock comparison through CronJon (flat tariff*** - maximum every 4 hours) with the link:<br>
            <i>{#setting:sImportOrdersUrl#}</i><br>
Some CronJob requests may be blocked, if they are made through customers not on the flat tariff*** or if the request is made more than once every 4 hours. 
';
MLI18n::gi()->{'cdiscount_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'cdiscount_config_orderimport__field__preimport.start__label'} = 'first from date';
MLI18n::gi()->{'cdiscount_config_orderimport__field__preimport.start__hint'} = 'Start time';
MLI18n::gi()->{'cdiscount_config_orderimport__field__preimport.start__help'} = 'Start time for first import of orders. Please note that this is not possible for a random time in the past. Data are utmost available for one week on Cdiscount.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.open__label'} = 'Order status in the shop';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.open__help'} = 'The status that should be transferred automatically to the Shop after a new order on DaWanda. <br />
If you are using a connected dunning process***, it is recommended to set the Order Status to ‘Paid’ (‘Configuration’ > ‘Order Status’).
';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.paymentmethod__label'} = 'Payment Methods';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.paymentmethod__help'} = '<p>Payment method that will apply to all orders imported from Cdiscount. Standard: “Cdiscount”</p>

This setting is necessary for the invoice and shipping notice, and for editing orders later in the Shop or via ERP.</p>';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.shippingmethod__label'} = 'Shipping Service of the Orders';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderimport.shippingmethod__help'} = 'Shipping methods that will be assigned to all Cdiscount orders. Standard: "Cdiscount"<br><br>
This setting is necessary for the invoice and shipping notice, and for editing orders later in the Shop or via ERP.';
MLI18n::gi()->{'cdiscount_config_orderimport__field__customergroup__label'} = 'Customer Group';
MLI18n::gi()->{'cdiscount_config_orderimport__field__customergroup__help'} = 'The customer group that customers from new orders should be sorted into.';
MLI18n::gi()->{'cdiscount_config_emailtemplate__legend__mail'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.send__label'} = '{#i18n:configform_emailtemplate_field_send_label#}';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.send__help'} = '{#i18n:configform_emailtemplate_field_send_help#}';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.originator.name__label'} = 'Sender\'s name';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.originator.adress__label'} = 'Sender\'s E-Mail-address';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.subject__label'} = 'Subject';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.content__label'} = 'E-Mail content';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.content__hint'} = 'Available place-holder for subject and content:
<dl>
                    <dt>#MARKETPLACEORDERID#</dt>
                        <dd>Marketplace Order Id</dd>
                    <dt>#FIRSTNAME#</dt>
                    <dd>Buyer’s first name</dd>
                    <dt>#LASTNAME#</dt>
                    <dd>Buyer’s last name</dd>
                    <dt>#EMAIL#</dt>
                    <dd>E-Mail address of the buyer</dd>
                    <dt>#PASSWORD#</dt>
                    <dd>Customer’s password for login to your shop. Only for customers which are added new automatically. Otherwise the place-holder is replaced by ‘(as known)’.</dd>
                    <dt>#ORDERSUMMARY#</dt>
                    <dd>Summary of bought articles. Should be in an extra row.<br><i>Can’t be used in the subject!</i>
                    </dd>
                    <dt>#MARKETPLACE#</dt>
                    <dd>Name of the marketplace</dd>
                    <dt>#SHOPURL#</dt>
                    <dd>URL to your Shop</dd>
                    <dt>#ORIGINATOR#</dt>
                    <dd>Senders Name</dd>
                </dl>';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.copy__label'} = 'Copy to Sender';
MLI18n::gi()->{'cdiscount_config_emailtemplate__field__mail.copy__help'} = 'Copy will be sent to sender\'s E-Mail-address';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.carrier__label'} = 'Shipping Carrier';
MLI18n::gi()->{'cdiscount_config_orderimport__field__orderstatus.carrier__help'} = '';
