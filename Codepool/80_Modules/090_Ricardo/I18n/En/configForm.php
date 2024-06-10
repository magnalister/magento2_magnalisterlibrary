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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLI18n::gi()->{'ricardo_config_account_title'} = 'Login Details';
MLI18n::gi()->{'ricardo_config_account_prepare'} = 'Item Preparation';
MLI18n::gi()->{'ricardo_config_account_price'} = 'Price Calculation';
MLI18n::gi()->{'ricardo_config_account_sync'} = 'Synchronization';
MLI18n::gi()->{'ricardo_config_account_orderimport'} = 'Order Import';
MLI18n::gi()->{'ricardo_config_checkin_badshippingcost'} = 'Shipping cost must be a number.';
MLI18n::gi()->{'ricardo_config_account_producttemplate'} = 'Product Template';
MLI18n::gi()->{'ricardo_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'ricardo_config_account_emailtemplate_sender'} = 'Example Shop';
MLI18n::gi()->{'ricardo_config_account_emailtemplate_sender_email'} = 'example@onlineshop.com';
MLI18n::gi()->{'ricardo_config_account_emailtemplate_subject'} = 'Your Order from #SHOPURL#';
MLI18n::gi()->{'ricardo_config_prepare_maxrelistcount_sellout'} = 'until sold out';
MLI18n::gi()->{'ricardo_config_account_emailtemplate_content'} = '    <style>
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
    <p>You\'ll find more great offers in our shop at <strong>#SHOPURL#</strong>.</p>
    <p>&nbsp;</p>
    <p>Sincerely,</p>
    <p>Your Online Shop Team</p>
';
MLI18n::gi()->{'ricardo_config_producttemplate_content'} = '<p>#TITLE#<br>#VARIATIONDETAILS#</p><p>#ARTNR#</p><p>#SHORTDESCRIPTION#</p><p>#PICTURE1#</p><p>#PICTURE2#</p><p>#PICTURE3#</p><p>#DESCRIPTION#</p>';
MLI18n::gi()->{'ricardo_config_account_defaulttemplate'} = 'No template';
MLI18n::gi()->{'ricardo_configform_sync_values__auto'} = 'Automatic synchronization via CronJob (only reduction)';
MLI18n::gi()->{'ricardo_configform_sync_values__auto_reduce'} = 'Automatic synchronization via CronJob (redutction and increase)';
MLI18n::gi()->{'ricardo_configform_sync_values__no'} = '{#i18n:configform_sync_value_no#}';
MLI18n::gi()->{'ricardo_label_sync_quantity'} = 'Activate Ricardo Stock-reduction and increase';
MLI18n::gi()->{'ricardo_text_quantity'} = 'Ricardo generally don’t allow stock-increase for running offers.<br>
To anyhow make an automatic adaption possible, magnalister finishes a running offer in the background and will trigger it new with changed stock quantity as soon as this function is actived.<br><br>
Ricardo may charge slotting fees for that!<br>
magnalister does not assume liability for the fees.</br><br>
Please confirm that you read and understand this information by clicking “accept” or undo the action without activating that function.
';
MLI18n::gi()->{'ricardo_label_sync_price'} = 'Activate Ricardo Stock-reduction and increase';
MLI18n::gi()->{'ricardo_text_price'} = 'Ricardo generally don’t allow price-increase for running offers.<br>
To anyhow make an automatic adaption possible, magnalister finishes a running offer in the background and will trigger it new with changed price as soon as this function is actived.<br><br>
Ricardo may charge slotting fees for that!<br>
magnalister does not assume liability for the fees.</br><br>
Please confirm that you read and understand this information by clicking “accept” or undo the action without activating that function.
';
MLI18n::gi()->{'ricardo_config_error_price_signal'} = 'Prices on Ricardo must be specified in Swiss franc. Please also adapt the price (last decimal number) so that it is 0 (eg. 12.40) or 5 (eg. 12.45). The lowest amount possible is 5 Rappen (0.00 CHF). Click the info-icon "number after decimal point" for more details.';
MLI18n::gi()->{'ricardo_config_account__legend__account'} = 'Login Details';
MLI18n::gi()->{'ricardo_config_account__legend__tabident'} = 'Tab';
MLI18n::gi()->{'ricardo_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'ricardo_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'ricardo_config_account__field__mpusername__label'} = 'Username';
MLI18n::gi()->{'ricardo_config_account__field__mppassword__label'} = 'Password';
MLI18n::gi()->{'ricardo_config_account__field__token__label'} = 'Ricardo Token';
MLI18n::gi()->{'ricardo_config_account__field__token__help'} = 'To apply for a new Ricardo token, please click the button.<br>
If this does not open Ricardo in a new window, please deactivate your popup blocker.<br><br>
The token is needed to allow you to access Ricardo via the magnalister interface.<br>
Please follow the steps in the Ricardo window to apply for a token and connect your online Shop with Ricardo via magnalister.';
MLI18n::gi()->{'ricardo_config_account__field__apilang__label'} = 'Interface language';
MLI18n::gi()->{'ricardo_config_account__field__apilang__hint'} = 'For triggered values and error messages';
MLI18n::gi()->{'ricardo_config_account__field__apilang__values__de'} = 'German';
MLI18n::gi()->{'ricardo_config_account__field__apilang__values__fr'} = 'French';
MLI18n::gi()->{'ricardo_config_prepare__legend__prepare'} = 'Prepare Items';
MLI18n::gi()->{'ricardo_config_prepare__legend__upload'} = 'Upload Items: Presets';
MLI18n::gi()->{'ricardo_config_prepare__field__prepare.status__label'} = 'Status Filter';
MLI18n::gi()->{'ricardo_config_prepare__field__prepare.status__valuehint'} = 'Only transfer active items';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.status__label'} = 'Status Filter';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.status__valuehint'} = 'Only transfer active items';
MLI18n::gi()->{'ricardo_config_prepare__field__listinglangs__label'} = 'Listings language';
MLI18n::gi()->{'ricardo_config_prepare__field__langs__label'} = 'Item Description';
MLI18n::gi()->{'ricardo_config_prepare__field__langs__hint'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__langs__matching__titlesrc'} = 'Ricardo language';
MLI18n::gi()->{'ricardo_config_prepare__field__langs__matching__titledst'} = 'Shop language';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.quantity__label'} = 'Inventory Item Count';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.quantity__help'} = 'Please enter how much of the inventory should be available on the marketplace.<br/>
                        <br/>
You can change the individual item count directly under \'Upload\'. In this case it is recommended that you turn off automatic<br/>
synchronization under \'Synchronization of Inventory\' > \'Stock Sync to Marketplace\'.<br/>
                        <br/>
To avoid overselling, you can activate \'Transfer shop inventory minus value from the right field\'.
                        <br/>
<strong>Example:</strong> Setting the value at 2 gives &#8594; Shop inventory: 10 &#8594; Amazon inventory: 8<br/>
                        <br/>
                        <strong>Please note:</strong>If you want to set an inventory count for an item in the Marketplace to \'0\', which is already set as Inactive in the Shop, independent of the actual inventory count, please proceed as follows:<br/>
                        <ul>
                        <li>\'Synchronize Inventory"> Set "Edit Shop Inventory" to "Automatic Synchronization with CronJob"</li>
                        <li>"Global Configuration" > "Product Status" > Activate setting "If product status is inactive, treat inventory count as 0"</li>
                        </ul>';
MLI18n::gi()->{'ricardo_config_prepare__field__descriptiontemplate__label'} = 'Offer language';
MLI18n::gi()->{'ricardo_config_prepare__field__articlecondition__label'} = 'Item Condition';
MLI18n::gi()->{'ricardo_config_prepare__field__buyingmode__label'} = 'Buying mode';
MLI18n::gi()->{'ricardo_config_prepare__field__priceforauction__label'} = 'Starting Price for Auction (CHF)';
MLI18n::gi()->{'ricardo_config_prepare__field__priceincrement__label'} = 'Auction Price Increment (CHF)';
MLI18n::gi()->{'ricardo_config_prepare__field__duration__label'} = 'Duration';
MLI18n::gi()->{'ricardo_config_prepare__field__maxrelistcountfield__label'} = 'Reactivate offer';
MLI18n::gi()->{'ricardo_config_prepare__field__maxrelistcount__label'} = 'How often shall the offer be reactivated?';
MLI18n::gi()->{'ricardo_config_prepare__field__warranty__label'} = 'Warranty';
MLI18n::gi()->{'ricardo_config_prepare__field__warrantycondition__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__warrantydescription__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__payment__label'} = 'Payment';
MLI18n::gi()->{'ricardo_config_prepare__field__payment__hint'} = 'Accepted payment methods';
MLI18n::gi()->{'ricardo_config_prepare__field__paymentmethods__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__paymentdescription__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__delivery__label'} = 'Shipping type';
MLI18n::gi()->{'ricardo_config_prepare__field__deliverycondition__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__deliverypackage__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__deliverydescription__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__deliverycost__label'} = 'Shipping costs';
MLI18n::gi()->{'ricardo_config_prepare__field__cumulative__label'} = '';
MLI18n::gi()->{'ricardo_config_prepare__field__cumulative__valuehint'} = 'seperate shipping costs for each article';
MLI18n::gi()->{'ricardo_config_prepare__field__availabilityfield__label'} = 'Shipping Time';
MLI18n::gi()->{'ricardo_config_prepare__field__availability__label'} = 'Article availability after payment receipt';
MLI18n::gi()->{'ricardo_config_prepare__field__firstpromotion__label'} = 'Promotion Package';
MLI18n::gi()->{'ricardo_config_prepare__field__firstpromotion__hint'} = '<span style="color:#e31a1c;">Promotions are not for free. Please check prices on Ricardo.</span>';
MLI18n::gi()->{'ricardo_config_prepare__field__secondpromotion__label'} = 'Homepage';
MLI18n::gi()->{'ricardo_config_prepare__field__secondpromotion__hint'} = '<span style="color:#e31a1c;">Promotions are not for free. Please check prices on Ricardo.</span>';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.showlimitationwarning__label'} = 'Show Ricardo offer limit prior to uploading';
MLI18n::gi()->{'ricardo_config_prepare__field__checkin.showlimitationwarning__help'} = 'Please note that Ricardo has generally limited every merchant to 100 simultaneous offers, however, Ricardo can customize this limit individually for every merchant. Prior to uploading, please check whether your products are exceeding this limit. At the earliest, you can check your error log 30 minutes after uploading.<br>If you activate this option, you will receive an information regarding Ricardo’s offer limit each time you upload a product.';
MLI18n::gi()->{'ricardo_config_price__legend__price'} = 'Price Calculation';
MLI18n::gi()->{'ricardo_config_price__field__price__label'} = 'Price';
MLI18n::gi()->{'ricardo_config_price__field__price__help'} = 'Please enter a price markup or markdown, either in percentage or fixed amount. Use a minus sign (-) before the amount to denote markdown.';
MLI18n::gi()->{'ricardo_config_price__field__price.addkind__label'} = '';
MLI18n::gi()->{'ricardo_config_price__field__price.factor__label'} = '';
MLI18n::gi()->{'ricardo_config_price__field__price.signal__label'} = 'Decimal Amount';
MLI18n::gi()->{'ricardo_config_price__field__price.signal__hint'} = 'Decimal Amount';
MLI18n::gi()->{'ricardo_config_price__field__price.signal__help'} = 'This textfield shows the decimal value that will appear in the item price on Ricardo.<br/><br/>
                <strong>Example:</strong> <br />
Value in textfeld: 99 <br />
                Original price: 5.58 <br />
                Final amount: 5.99 <br /><br />
This function is useful when marking the price up or down***. <br/>
Leave this field empty if you do not wish to set any decimal amount. <br/>
The format requires a maximum of 2 numbers.Example:';
MLI18n::gi()->{'ricardo_config_price__field__priceoptions__label'} = 'Price Options';
MLI18n::gi()->{'ricardo_config_price__field__priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'ricardo_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'ricardo_config_price__field__price.usespecialoffer__label'} = 'Use special offer prices';
MLI18n::gi()->{'ricardo_config_price__field__mwst__label'} = 'VAT';
MLI18n::gi()->{'ricardo_config_price__field__mwst__help'} = 'VAT amount that is considered in the article-upload to Ricardo. Standard web-shop-VAT will be taken if you leave this field open.';
MLI18n::gi()->{'ricardo_config_price__field__mwst__hint'} = '&nbsp; VAT amount that is considered in the article-upload (in %).';
MLI18n::gi()->{'ricardo_config_price__field__exchangerate_update__label'} = 'Exchange Rate';
MLI18n::gi()->{'ricardo_config_price__field__exchangerate_update__valuehint'} = 'Automatically update exchange rate';
MLI18n::gi()->{'ricardo_config_price__field__exchangerate_update__help'} = '{#i18n:form_config_orderimport_exchangerate_update_help#}';
MLI18n::gi()->{'ricardo_config_price__field__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
MLI18n::gi()->{'ricardo_config_sync__legend__sync'} = 'Inventory Synchronization';
MLI18n::gi()->{'ricardo_config_sync__field__stocksync.tomarketplace__label'} = 'Stock Sync to Marketplace';
MLI18n::gi()->{'ricardo_config_sync__field__stocksync.tomarketplace__help'} = '
            With the function Automatic Synchronization via CronJob (recommended)
                    Current Ricardo stock will be synchronized with shop stock every 4 hours, beginning at 0.00am (with ***, depending on configuration).<br>Values will be transferred from the database, including the changes that occur through an ERP or similar.<br><br>
Manual comparison can be activated by clicking the corresponding button in the magnalister header (left of the shopping cart).<br><br>
Additionally, you can activate the stock comparison through CronJon (flat tariff*** - maximum every 4 hours) with the link:<br>
            <i>{#setting:sSyncInventoryUrl#}</i><br>

Some CronJob requests may be blocked, if they are made through customers not on the flat tariff*** or if the request is made more than once every 4 hours.
<br><br>
                    <b>Note:<br>Ricardo has an availablity limit. Please make sure that the stock of each article you are offering on the Ricardo marketplace does not exceed 999 units</b><br> The settings in \'Configuration\' ,&rarr; ‘Article upload:preset’  &rarr; ‘Stock quantity’ will the taken into account.';
MLI18n::gi()->{'ricardo_config_sync__field__stocksync.frommarketplace__label'} = 'Stocke change Ricardo';
MLI18n::gi()->{'ricardo_config_sync__field__stocksync.frommarketplace__help'} = 'If, for example, an item is purchased 3 times on Ricardo, the Shop inventory will be reduced by 3.<br /><br />
<strong>Important:</strong>This function will only work if you have Order Imports activated!';
MLI18n::gi()->{'ricardo_config_sync__field__inventorysync.price__label'} = 'Item Price';
MLI18n::gi()->{'ricardo_config_sync__field__inventorysync.price__help'} = '<p> Current Ricardo price  will be synchronized with shop stock every 4 hours, beginning at 0.00am (with ***, depending on configuration)<br>
Values will be transferred from the database, including the changes that occur through an ERP or similar.<br><br>
<b>Hint:</b> The settings in \'Configuration\', \'price calculation\' will be taken into account.
';
MLI18n::gi()->{'ricardo_config_orderimport__legend__importactive'} = 'Order Import';
MLI18n::gi()->{'ricardo_config_orderimport__legend__mwst'} = 'VAT';
MLI18n::gi()->{'ricardo_config_orderimport__legend__orderstatus'} = 'Synchronization of the order status from shop to Ricardo';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderimport.shippingmethod__label'} = 'Shipping Service of the Orders';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderimport.shippingmethod__help'} = 'Shipping methods that will be assigned to all Ricardo orders. Standard: "Ricardo"<br><br>
This setting is necessary for the invoice and shipping notice, and for editing orders later in the Shop or via ERP.';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderstatus.shipped__label'} = 'Confirm Shipping With';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderstatus.shipped__help'} = 'Select the shop status that will automatically set the Ricardo status to "confirm shipment".';
MLI18n::gi()->{'ricardo_config_orderimport__field__mwst.fallback__label'} = 'VAT on Non-Shop*** Items';
MLI18n::gi()->{'ricardo_config_orderimport__field__mwst.fallback__hint'} = 'The tax rate to apply to non-Shop items on order imports, in %.';
MLI18n::gi()->{'ricardo_config_orderimport__field__mwst.fallback__help'} = 'If an item is not entered in the web-shop, magnalister uses the VAT from here since marketplaces give no details to VAT within the order import.<br />
<br />
Further explanation:<br />
Basically, magnalister calculates the VAT the same way the shop-system does itself.<br />
VAT per country can only be considered if the article can be found in the web-shop with his number range (SKU).<br />
magnalister uses the configured web-shop-VAT-classes.
';
MLI18n::gi()->{'ricardo_config_orderimport__field__importactive__label'} = 'Activate Import';
MLI18n::gi()->{'ricardo_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'ricardo_config_orderimport__field__importactive__help'} = 'Import orders from the Marketplace? <br/><br/>When activated, orders will be automatically imported every hour.<br><br>
Manual import can be activated by clicking the corresponding button in the magnalister header (left of the shopping cart).<br><br>Additionally, you can activate the stock comparison through CronJon (flat tariff*** - maximum every 4 hours) with the link:<br>
            <i>{#setting:sImportOrdersUrl#}</i><br>
Some CronJob requests may be blocked, if they are made through customers not on the flat tariff*** or if the request is made more than once every 4 hours. 
';
MLI18n::gi()->{'ricardo_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'ricardo_config_orderimport__field__preimport.start__label'} = 'First from date';
MLI18n::gi()->{'ricardo_config_orderimport__field__preimport.start__hint'} = 'Start Date';
MLI18n::gi()->{'ricardo_config_orderimport__field__preimport.start__help'} = 'The date from which orders will start being imported. Please note that it is not possible to set this too far in the past, as the data only remains available on Ricardo for a few weeks.***';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderstatus.open__label'} = 'Order Status in Shop';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'ricardo_config_orderimport__field__orderstatus.open__help'} = 'The status that should be transferred automatically to the Shop after a new order on DaWanda. <br />
If you are using a connected dunning process***, it is recommended to set the Order Status to ‘Paid’ (‘Configuration’ > ‘Order Status’).
';
MLI18n::gi()->{'ricardo_config_orderimport__field__customergroup__label'} = 'Customer Group';
MLI18n::gi()->{'ricardo_config_orderimport__field__customergroup__help'} = 'The customer group that customers from new orders should be sorted into. ';
MLI18n::gi()->{'ricardo_config_producttemplate__legend__product__title'} = 'Product template';
MLI18n::gi()->{'ricardo_config_producttemplate__legend__product__info'} = 'Template for product description on Ricardo. (You can switch the editor via "Global Configuration" > "Expert configurations")';
MLI18n::gi()->{'ricardo_config_producttemplate__field__template.name__label'} = 'Template product name';
MLI18n::gi()->{'ricardo_config_producttemplate__field__template.name__help'} = '<dl>
                <dt>Product name on Ricardo</dt>
                 <dd>Configuration: How the product is named on Ricardo.
                     The placeholder <b>#TITLE#</b> will replaced by the product name from the shop,
                     <b>#BASEPRICE#</b>by price per unit, as far as deposited in the shop.</dd>
                <dt>Please note:</dt>
                 <dd><b>#BASEPRICE#</b>will be replaced with the product upload because it can be changed in the item preparation.</dd>
                 <dd>Since the base price is a fix value in the titel that can not be updated, the price shouldn’t be changed. This would lead to wrong prices.<br />
                    You can use this placeholder on your own risk. In this case we suggest to  <b>turn off the price sync.</b> (Configuration in the magnalister Ricardo synchronization).</dd>
                <dt>Important:</dt>
                 <dd>Please note that Ricardo limits the length for the title to 60 signs. magnalister cuts the title while the product upload to the maximum length.</dd>
            </dl>';
MLI18n::gi()->{'ricardo_config_producttemplate__field__template.content__label'} = 'Product Description Template';
MLI18n::gi()->{'ricardo_config_producttemplate__field__template.content__hint'} = 'List of available place holders for product description:<dl><dt>#TITLE#</dt><dd>Product name (Titel)</dd><dt>#ARTNR#</dt><dd>Article number from the shop</dd><dt>#PID#</dt><dd>Products ID</dd><!--<dt>#PRICE#</dt><dd>Price</dd><dt>#VPE#</dt><dd>Price per packaging unit</dd>--><dt>#SHORTDESCRIPTION#</dt><dd>Short Description from Shop</dd><dt>#DESCRIPTION#</dt><dd>Description from Shop</dd><dt>#WEIGHT#</dt><dd>Products weight</dd><dt>#PICTURE1#</dt><dd>First Product-Image</dd><dt>#PICTURE2# etc.</dt><dd>Second Product-Image; with #PICTURE3#, #PICTURE4# etc. More Images can be sent, as many as available in the shop.</dd></dl>#SHORTDESCRIPTION#';
MLI18n::gi()->{'ricardo_config_emailtemplate__legend__mail'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.send__label'} = '{#i18n:configform_emailtemplate_field_send_label#}';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.send__help'} = '{#i18n:configform_emailtemplate_field_send_help#}';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.originator.name__label'} = 'Sender Name';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.originator.adress__label'} = 'Sender E-Mail Address';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.subject__label'} = 'Subject';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.content__label'} = 'E-Mail Content';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.content__hint'} = 'List of available placeholders for Subject and Content:
<dl>
                    <dt>#FIRSTNAME#</dt>
                    <dd>Buyer\'s first name</dd>
                    <dt>#LASTNAME#</dt>
                    <dd>Buyer\'s last name</dd>
                    <dt>#EMAIL#</dt>
                    <dd>Buyer\'s email address</dd>
                    <dt>#PASSWORD#</dt>
                    <dd>Buyer’s password for logging in to your Shop. Only for customers that are automatically assigned passwords – otherwise the placeholder will be replaced with ‘(as known)’***.</dd>
                    <dt>#ORDERSUMMARY#</dt>
                    <dd>Summary of the purchased items. Should be written on a separate line. <br/><i>Cannot be used in the Subject!</i>
                    </dd>
                    <dt>#MARKETPLACE#</dt>
                    <dd>Marketplace Name</dd>
                    <dt>#SHOPURL#</dt>
                    <dd>Your Shop URL</dd>
                    <dt>#ORIGINATOR#</dt>
                    <dd>Sender Name</dd>
                    <dt>#USERNAME#</dt>
                    <dd>Buyer User Name</dd>        
                    <dt>#MARKETPLACEORDERID#</dt>
                    <dd>Ricardo Order Id</dd>
                </dl>';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.copy__label'} = 'Copy to Sender';
MLI18n::gi()->{'ricardo_config_emailtemplate__field__mail.copy__help'} = 'A copy will be sent to the sender email address.';
