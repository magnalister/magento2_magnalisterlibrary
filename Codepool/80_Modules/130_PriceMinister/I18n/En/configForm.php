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

MLI18n::gi()->{'priceminister_config_account_title'} = 'Login Details';
MLI18n::gi()->{'priceminister_config_account_prepare'} = 'Item Preparation';
MLI18n::gi()->{'priceminister_config_account_price'} = 'Price calculation';
MLI18n::gi()->{'priceminister_config_account_sync'} = 'Synchronization';
MLI18n::gi()->{'priceminister_config_account_orderimport'} = 'Order Import';
MLI18n::gi()->{'priceminister_config_checkin_badshippingcost'} = 'Shipping costs must be numeric.';
MLI18n::gi()->{'priceminister_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'priceminister_config_account_emailtemplate_sender'} = 'Example Shop';
MLI18n::gi()->{'priceminister_config_account_emailtemplate_sender_email'} = 'Promotion E-Mail Template';
MLI18n::gi()->{'priceminister_config_account_emailtemplate_subject'} = 'Your order at #SHOPURL#';
MLI18n::gi()->{'priceminister_config_account_producttemplate'} = 'Product Template';
MLI18n::gi()->{'priceminister_config_account_emailtemplate_content'} = '<style><!--
body {
    font: 12px sans-serif;
}
table.ordersummary {
        width: 100%;
        border: 1px solid #e8e8e8;
}
table.ordersummary td 
        padding: 3px 5px;
}
table.ordersummary thead td {
        background: #cfcfcf;
        color: #000;
        font-weight: bold;
        text-align: center;
}
table.ordersummary thead td.name {
        text-align: left;
}
table.ordersummary tbody tr.even td {
        background: #e8e8e8;
        color: #000;
}
table.ordersummary tbody tr.odd td {
        background: #f8f8f8;
        color: #000;
}
table.ordersummary td.price,
table.ordersummary td.fprice {
        text-align: right;
        white-space: nowrap;
}
table.ordersummary tbody td.qty {
        text-align: center;
}
--></style>
<p>Hello #FIRSTNAME# #LASTNAME#,</p>
<p>Thank you for your order! The following items were purchased via #MARKETPLACE#:</p>
#ORDERSUMMARY#
<p>Shipping costs are included.</p>
<p>&nbsp;</p>
<p>Sincerely,</p>
<p>Your Online Shop Team</p>';
MLI18n::gi()->{'priceminister_config_producttemplate_content'} = '<p>#TITLE#</p><p>#ARTNR#</p><p>#SHORTDESCRIPTION#</p><p>#PICTURE1#</p><p>#PICTURE2#</p><p>#PICTURE3#</p><p>#DESCRIPTION#</p>';
MLI18n::gi()->{'priceminister_config_orderstatus_autoacceptance'} = 'Please note: You have deacivated the automatic order confirmation. PriceMinister doesn&apos;t provide the shipping costs for not confirmed orders, therefore the PriceMinister orders will be created in your shop without shipping costs. We recommend to activate the automatic order confirmation.';
MLI18n::gi()->{'priceminister_config_account__legend__account'} = 'Login Details';
MLI18n::gi()->{'priceminister_config_account__legend__tabident'} = 'Tab';
MLI18n::gi()->{'priceminister_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'priceminister_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'priceminister_config_account__field__username__label'} = 'Username';
MLI18n::gi()->{'priceminister_config_account__field__token__label'} = 'API Token';
MLI18n::gi()->{'priceminister_config_account__field__token__help'} = 'Go to the <a href="https://www.priceminister.com/usersecure?action=usrwstokenaccess" target="_blank">page</a> and get your token.';
MLI18n::gi()->{'priceminister_config_prepare__legend__prepare'} = 'Item Preparation';
MLI18n::gi()->{'priceminister_config_prepare__legend__upload'} = 'Item Upload';
MLI18n::gi()->{'priceminister_config_prepare__field__prepare.status__label'} = 'Status filter';
MLI18n::gi()->{'priceminister_config_prepare__field__prepare.status__valuehint'} = 'Only transfer active items';
MLI18n::gi()->{'priceminister_config_prepare__field__lang__label'} = 'Item description';
MLI18n::gi()->{'priceminister_config_prepare__field__identifier__label'} = 'Identifier';
MLI18n::gi()->{'priceminister_config_prepare__field__checkin.status__label'} = 'Status filter';
MLI18n::gi()->{'priceminister_config_prepare__field__checkin.status__valuehint'} = 'Only transfer active items';
MLI18n::gi()->{'priceminister_config_prepare__field__checkin.quantity__label'} = 'Stock quantity';
MLI18n::gi()->{'priceminister_config_prepare__field__checkin.quantity__help'} = 'Please specify the quantity of products to be available on the marketplace.<br />
<br />
 To omit oversales, you can select <i>use quantity from shop, less the value from the last field</i><br />
<br /><strong>Example:</strong>Value set to "<i>2</i>" means, if the stock in your shop is 10, the stock on PriceMinister will be 8.<br />';
MLI18n::gi()->{'priceminister_config_prepare__field__itemcondition__label'} = 'Item condition';
MLI18n::gi()->{'priceminister_config_prepare__field__itemsperpage__label'} = 'Results';
MLI18n::gi()->{'priceminister_config_prepare__field__itemsperpage__help'} = 'Specify how much Items are shown on one page in Multi Matching. <br />Note: Higher numbers cause also higher response times.';
MLI18n::gi()->{'priceminister_config_prepare__field__itemsperpage__hint'} = 'per page in Multi Matching';
MLI18n::gi()->{'priceminister_config_price__legend__price'} = 'Price calculation';
MLI18n::gi()->{'priceminister_config_price__field__price__label'} = 'Price';
MLI18n::gi()->{'priceminister_config_price__field__price__help'} = 'Enter a percent or a constant defined addition or reduction to the price. You can enter a reduction by adding a minus in front of the value.';
MLI18n::gi()->{'priceminister_config_price__field__price.addkind__label'} = '';
MLI18n::gi()->{'priceminister_config_price__field__price.factor__label'} = '';
MLI18n::gi()->{'priceminister_config_price__field__price.signal__label'} = 'Threshold Price';
MLI18n::gi()->{'priceminister_config_price__field__price.signal__hint'} = 'Threshold Price';
MLI18n::gi()->{'priceminister_config_price__field__price.signal__help'} = 'The threshold price will be used as the position after the decimal point on transmission to PriceMinister.<br/><br/>
                                                           <strong>Example:</strong> <br />
                                                                   value in description field: 99 <br />
                                                                   origin of the price: 5.58 <br />
                                                                   final result: 5.99 <br /><br />
                                                           This function helps in particular for percentaged additions and reductions.<br/>
                                                           Is the field empty, no threshold price will be transmitted.<br/>
                                                           The input format is a natural number with a maximum of two digits.';
MLI18n::gi()->{'priceminister_config_price__field__priceoptions__label'} = 'Price from the customer group';
MLI18n::gi()->{'priceminister_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'priceminister_config_price__field__price.usespecialoffer__label'} = 'Use also special prices';
MLI18n::gi()->{'priceminister_config_price__field__exchangerate_update__label'} = 'Exchange Rate';
MLI18n::gi()->{'priceminister_config_price__field__exchangerate_update__valuehint'} = 'Automatic Exchange Rate Update';
MLI18n::gi()->{'priceminister_config_price__field__exchangerate_update__help'} = '{#i18n:form_config_orderimport_exchangerate_update_help#}';
MLI18n::gi()->{'priceminister_config_price__field__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
MLI18n::gi()->{'priceminister_config_sync__legend__sync'} = 'Synchronization of Stock';
MLI18n::gi()->{'priceminister_config_sync__field__stocksync.tomarketplace__label'} = 'Stock Changes in the Shop';
MLI18n::gi()->{'priceminister_config_sync__field__stocksync.tomarketplace__help'} = '<dl>
            <dt>Automatic Synchronization via CronJob (recommended)</dt>
                    <dd>Current PriceMinister stock will be synchronized with shop stock every 4 hours, beginning at 0.00am (with ***, depending on configuration).<br>Values will be transferred from the database, including the changes that occur through an ERP or similar.<br><br>
Manual comparison can be activated by clicking the corresponding button in the magnalister header (left of the shopping cart).<br><br>
Additionally, you can activate the stock comparison through CronJon (flat tariff*** - maximum every 4 hours) with the link:<br>
            <i>{#setting:sSyncInventoryUrl#}</i><br>

Some CronJob requests may be blocked, if they are made through customers not on the flat tariff*** or if the request is made more than once every 4 hours.
</dd>
                        
                    </dl>
                    <b>Note:</b> The settings in \'Configuration\' ,&rarr; ‘Article upload:preset’  &rarr; ‘Stock quantity’ will the taken into account.';
MLI18n::gi()->{'priceminister_config_sync__field__stocksync.frommarketplace__label'} = 'Stock Changes on PriceMinister';
MLI18n::gi()->{'priceminister_config_sync__field__stocksync.frommarketplace__help'} = 'If, for example, an item is purchased 3 times on PriceMinister, the Shop inventory will be reduced by 3.<br /><br />
<strong>Important:</strong>This function will only work if you have Order Imports activated!';
MLI18n::gi()->{'priceminister_config_sync__field__inventorysync.price__label'} = 'Item Price';
MLI18n::gi()->{'priceminister_config_sync__field__inventorysync.price__help'} = '<p> Current PriceMinister price  will be synchronized with shop stock every 4 hours, beginning at 0.00am (with ***, depending on configuration)<br>
Values will be transferred from the database, including the changes that occur through an ERP or similar.<br><br>
<b>Hint:</b> The settings in \'Configuration\', \'price calculation\' will be taken into account.
';
MLI18n::gi()->{'priceminister_config_orderimport__legend__importactive'} = 'Order Import';
MLI18n::gi()->{'priceminister_config_orderimport__legend__mwst'} = 'VAT';
MLI18n::gi()->{'priceminister_config_orderimport__legend__orderstatus'} = 'Synchronization of the Order status from the shop to PriceMinister';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shippingfromcountry__label'} = 'Order will be shipped from';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.autoacceptance__label'} = 'Automatic order confirmation';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.autoacceptance__valuehint'} = 'automatic order confirmation';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.autoacceptance__help'} = 'PriceMinister doesn&apos;t provide the shipping costs for not confirmed orders. If you don&apos;t activate automatic order confirmation, the PriceMinister orders will be created in your shop without shipping costs. We recommend to activate this function.';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.accepted__label'} = 'Accept order with';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.accepted__hint'} = '<span style="color:#e31a1c;">Please read info for more explanation.</span>';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.accepted__help'} = 'Before confirming shipment, please select default value for accepting order on PriceMinister.<br/><br/><b>IMPORTANT:</b><br/><br/> 
                        This acceptation must be done within 2 days after receiving order, otherwise your account on PriceMinister will be disabled.';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.refused__label'} = 'Refuse order with';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.refused__hint'} = '<span style="color:#e31a1c;">Please read info for more explanation.</span>';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.refused__help'} = 'Please select default value for refusing order on PriceMinister after receiving one in your shop.<br/><br/><b>IMPORTANT:</b><br/><br/> 
                        This refusal must be done within 2 days after receiving order, otherwise your account on PriceMinister will be disabled.';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.shipped__label'} = 'Set order as sent with';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.shipped__help'} = 'Select the order status in the shop to set the order to sent on PriceMinister.';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.canceled__label'} = 'Cancel order with';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.canceled__help'} = 'Select the order status in the shop to set the order to cancelled on PriceMinister.<br/><br/>
Note: Only whole orders can be canceled (no partial cancellation).';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.comment__label'} = 'Cancellation reason';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.comment__help'} = 'The reason for the cancellation of the order';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.carrier__label'} = 'Carrier';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.carrier__help'} = 'Default Carrier to set the orders to sent on PriceMinister';
MLI18n::gi()->{'priceminister_config_orderimport__field__mwst.fallback__label'} = 'VAT for Items not known to the shop';
MLI18n::gi()->{'priceminister_config_orderimport__field__mwst.fallback__hint'} = 'VAT rate (in %) to be used in orders for Items which are not known to the shop.';
MLI18n::gi()->{'priceminister_config_orderimport__field__mwst.fallback__help'} = 'If an Item has not been uploaded via magnalister, we don&apos;t know the VAT rate for this item (PriceMinister does not provide this information). For this case, please specify a fallback value here.';
MLI18n::gi()->{'priceminister_config_orderimport__field__importactive__label'} = 'Activate order import';
MLI18n::gi()->{'priceminister_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'priceminister_config_orderimport__field__importactive__help'} = 'Import orders from the Marketplace? <br/><br/>When activated, orders will be automatically imported every hour.<br><br>
Manual import can be activated by clicking the corresponding button in the magnalister header (left of the shopping cart).<br><br>Additionally, you can activate the stock comparison through CronJon (flat tariff*** - maximum every 4 hours) with the link:<br>
            <i>{#setting:sImportOrdersUrl#}</i><br>
Some CronJob requests may be blocked, if they are made through customers not on the flat tariff or if the request is made more than 4 times per hour.
';
MLI18n::gi()->{'priceminister_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'priceminister_config_orderimport__field__preimport.start__label'} = 'Starting at';
MLI18n::gi()->{'priceminister_config_orderimport__field__preimport.start__hint'} = 'Start Time';
MLI18n::gi()->{'priceminister_config_orderimport__field__preimport.start__help'} = 'Start time for first import of orders. Please note that this is not possible for a random time in the past. Data are utmost available for one week on PriceMinister.';
MLI18n::gi()->{'priceminister_config_orderimport__field__customergroup__label'} = 'Customer group';
MLI18n::gi()->{'priceminister_config_orderimport__field__customergroup__help'} = 'Kundengruppe, zu der Kunden bei neuen Bestellungen zugeordnet werden sollen.';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.open__label'} = 'Order status in the shop';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderstatus.open__help'} = 'The status that should be transferred automatically to the Shop after a new order on PriceMinister. <br />
If you are using a connected dunning process***, it is recommended to set the Order Status to ‘Paid’ (‘Configuration’ > ‘Order Status’).
';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shippingmethod__label'} = 'Shipping Service of the Orders';
MLI18n::gi()->{'priceminister_config_orderimport__field__orderimport.shippingmethod__help'} = 'Shipping method for the Orders from PriceMinister. Default is "PriceMinister". <br /><br />This setting concerns the creation of invoices and delivery notes, and it&apos;s important for the further processing in the shop as well as some ERP systems (if used).';
MLI18n::gi()->{'priceminister_config_producttemplate__legend__product__title'} = 'Product Template';
MLI18n::gi()->{'priceminister_config_producttemplate__legend__product__info'} = 'Template for the Product Description (The Editor can be selected in the Global Configuration > Expert Settings)';
MLI18n::gi()->{'priceminister_config_producttemplate__field__template.name__label'} = 'Template Product Name';
MLI18n::gi()->{'priceminister_config_producttemplate__field__template.name__help'} = '<dl>
	<dt>Name of the Product on PriceMinister</dt>
	 <dd>Specify how the Product should be named on PriceMinister.
	     The placeholder <b>#TITLE#</b> will be automatically replaced by the Product name from the shop,
	     <b>#BASEPRICE#</b> by the price per unit, if stored in the Product data.</dd>
	<dt>Please note:</dt>
	 <dd><b>#BASEPRICE#</b> will be replaced while uploading the Product to PriceMinister, as it can change between preparation and upload.</dd>
	 <dd>If you use <b>#BASEPRICE#</b>, we strongly recommend to <b>switch off the price synchronization</b>, because the synchronization cannot change the contents of the Product name, and so changes of the Product price would cause conflicting data on PriceMinister&apos;s Product page.</dd>
	 <dt>Caution:</dt>
	  <dd>Please note that PriceMinister constrains the Title length to 40 characters. Titles over 40 characters will be truncated.</dd>
	</dl>';
MLI18n::gi()->{'priceminister_config_producttemplate__field__template.content__label'} = 'Template Product Description';
MLI18n::gi()->{'priceminister_config_producttemplate__field__template.content__hint'} = 'Placeholders available for the Product description:
	<dl>
                        <dt>#TITLE#</dt>
                                <dd>Product name (Title)</dd>
                        <dt>#ARTNR#</dt>
                                <dd>Item Number in the Shop</dd>
                        <dt>#PID#</dt>
                                <dd>Products ID in the Shop</dd>
                        <!--<dt>#PRICE#</dt>
                                <dd>Price</dd>
                        <dt>#VPE#</dt>
                                <dd>Price per Unit</dd>-->
                        <dt>#SHORTDESCRIPTION#</dt>
                                <dd>Short description from the Shop</dd>
                        <dt>#DESCRIPTION#</dt>
                                <dd>Description from the Shop</dd>
                        <dt>#PICTURE1#</dt>
                                <dd>1st Product picture</dd>
                        <dt>#PICTURE2# etc.</dt>
                                <dd>2nd Product picture; use #PICTURE3#, #PICTURE4# etc. for further pictures (as many as stored in the shop&apos;s product data).</dd>
                </dl>';
MLI18n::gi()->{'priceminister_config_emailtemplate__legend__mail'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.send__label'} = '{#i18n:configform_emailtemplate_field_send_label#}';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.send__help'} = '{#i18n:configform_emailtemplate_field_send_help#}';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.originator.name__label'} = 'Sender name';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.originator.adress__label'} = 'Sender E-Mail address';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.subject__label'} = 'Subject';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.content__label'} = 'E-Mail contents';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.content__hint'} = 'List of available placeholders for Subject and Content:
                <dl>
                    <dt>#MARKETPLACEORDERID#</dt>
                        <dd>Marketplace Order Id</dd>
                    <dt>#FIRSTNAME#</dt>
                    <dd>Buyer&apos;s first name</dd>
                    <dt>#LASTNAME#</dt>
                    <dd>Buyer&apos;s last name</dd>
                    <dt>#EMAIL#</dt>
                    <dd>Buyer&apos;s email address</dd>
                    <dt>#PASSWORD#</dt>
                    <dd>Buyer&apos;s password for logging into your Shop. Only for customers that are automatically assigned passwords – otherwise the placeholder will be replaced with ‘(as known)’***.</dd>
                    <dt>#ORDERSUMMARY#</dt>
                    <dd>Summary of the purchased items. Should be written on a separate line. <br/><i>Cannot be used in the Subject!</i>
                    </dd>
                    <dt>#MARKETPLACE#</dt>
                    <dd>This Marketplace&apos;s name</dd>
                    <dt>#SHOPURL#</dt>
                    <dd>your shop&apos;s URL</dd>
                    <dt>#ORIGINATOR#</dt>
                    <dd>Sender name</dd>
                </dl>';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.copy__label'} = 'CC to sender';
MLI18n::gi()->{'priceminister_config_emailtemplate__field__mail.copy__help'} = 'A copy of the E-Mail will be sent to the origin address.';
