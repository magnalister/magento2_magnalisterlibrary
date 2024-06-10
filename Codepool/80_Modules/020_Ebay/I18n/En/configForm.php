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

MLI18n::gi()->{'ebay_config_general_autosync'} = 'Automatic synchronization via CronJob (recommended)';
MLI18n::gi()->{'ebay_config_general_nosync'} = 'No synchronization';
MLI18n::gi()->{'ebay_config_account_title'} = 'Login Details';
MLI18n::gi()->{'ebay_config_account_prepare'} = 'Item Preparation';
MLI18n::gi()->{'ebay_config_account_price'} = 'Price Calculation';
MLI18n::gi()->{'ebay_config_account_sync'} = 'Synchronization';
MLI18n::gi()->{'ebay_config_account_orderimport'} = 'Order Import';
MLI18n::gi()->{'ebay_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'ebay_config_account_producttemplate'} = 'Product Template';
MLI18n::gi()->{'ebay_configform_prepare_gallerytype_values__None'} = 'None';
MLI18n::gi()->{'ebay_configform_prepare_gallerytype_values__Gallery'} = 'Gallery';
MLI18n::gi()->{'ebay_configform_prepare_gallerytype_values__Plus'} = 'Plus';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__0'} = 'Same day';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__1'} = '1 day';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__2'} = '2 days';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__3'} = '3 days';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__4'} = '4 days';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__5'} = '5 days';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__6'} = '6 days';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__7'} = '7 days';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__10'} = '10 days';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__15'} = '15 days';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__20'} = '20 days';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__30'} = '30 days';
MLI18n::gi()->{'ebay_configform_prepare_dispatchtimemax_values__40'} = '40 days';
MLI18n::gi()->{'ebay_configform_price_chinese_quantityinfo'} = 'For auctions, the quantity can only be set to 1. ';
MLI18n::gi()->{'ebay_configform_account_sitenotselected'} = 'Please choose the eBay Site first';
MLI18n::gi()->{'ebay_configform_orderstatus_sync_values__auto'} = '{#i18n:ebay_config_general_autosync#}';
MLI18n::gi()->{'ebay_configform_orderstatus_sync_values__no'} = '{#i18n:ebay_config_general_nosync#}';
MLI18n::gi()->{'ebay_configform_sync_values__auto'} = '{#i18n:ebay_config_general_autosync#}';
MLI18n::gi()->{'ebay_configform_sync_values__no'} = '{#i18n:ebay_config_general_nosync#}';
MLI18n::gi()->{'ebay_configform_stocksync_values__rel'} = 'Orders reduce Shop inventory (recommended)';
MLI18n::gi()->{'ebay_configform_stocksync_values__no'} = '{#i18n:ebay_config_general_nosync#}';
MLI18n::gi()->{'ebay_configform_pricesync_values__auto'} = '{#i18n:ebay_config_general_autosync#}';
MLI18n::gi()->{'ebay_configform_pricesync_values__no'} = '{#i18n:ebay_config_general_nosync#}';
MLI18n::gi()->{'ebay_configform_sync_chinese_values__auto'} = '{#i18n:ebay_config_general_autosync#}';
MLI18n::gi()->{'ebay_configform_sync_chinese_values__no'} = '{#i18n:ebay_config_general_nosync#}';
MLI18n::gi()->{'ebay_configform_orderimport_payment_values__textfield__title'} = 'From textfield';
MLI18n::gi()->{'ebay_configform_orderimport_payment_values__textfield__textoption'} = '1';
MLI18n::gi()->{'ebay_configform_orderimport_payment_values__matching__title'} = 'Automatic allocation';
MLI18n::gi()->{'ebay_configform_orderimport_shipping_values__textfield__title'} = 'From textfield';
MLI18n::gi()->{'ebay_configform_orderimport_shipping_values__textfield__textoption'} = '1';
MLI18n::gi()->{'ebay_configform_orderimport_shipping_values__matching__title'} = 'Automatic allocation';
MLI18n::gi()->{'configform_strikeprice_kind_values__OldPrice'} = 'old price';
/*MLI18n::gi()->{'configform_strikeprice_kind_values__OldeBayPrice'} = 'old eBay price';*/
MLI18n::gi()->{'configform_strikeprice_kind_values__ManufacturersPrice'} = 'Manufacturer\'s MRSP';
MLI18n::gi()->{'ebay_config_price__field__strikeprice.active__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__strikeprice.active__valuehint'} = 'Activate Strike Prices';
MLI18n::gi()->{'ebay_config_price__field__strikeprice.active__alert'} = '<span style="color:#e31a1c;font-weight:bold">Activate Strike Prices</span><br /><br /><b>Please note:</b>Strike prices are only available on eBay for merchants with <b>premium</b> or <b>platinum</b> stores (for more details on the different eBay store options, see the eBay help pages).<br /><br />If you do not use an eBay plan that includes strike through prices and you still try to upload strike price items, <b>eBay will reject these items with an error message.</b>';
MLI18n::gi()->{'ebay_config_price__field__strikepriceoptions__label'} = '{#i18n:configform_price_field_strikeprice_label#}';
MLI18n::gi()->{'ebay_config_price__field__strikepriceoptions__help'} = '{#i18n:configform_price_field_strikeprice_help#}';
MLI18n::gi()->{'ebay_config_price__field__strikeprice.group__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__strikeprice.kind__label'} = '{#i18n:configform_price_field_priceoptions_kind_label#}';
MLI18n::gi()->{'ebay_config_price__field__strikeprice.kind__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__strikeprice.kind__help'} = '<span style="color:#e31a1c;font-weight:bold">The Crossed Out Price on eBay Equals the Manufacturer\'s MSRP</span><br /><br />If the crossed out price is the manufacturer\'s MSRP and you want to display this information on eBay, enable the option.';
MLI18n::gi()->{'ebay_configform_refund_reasons_values__BUYER_CANCEL'} = 'The buyer has cancelled the order.';
MLI18n::gi()->{'ebay_configform_refund_reasons_values__SELLER_CANCEL'} = 'The seller has cancelled the order.';
MLI18n::gi()->{'ebay_configform_refund_reasons_values__ITEM_NOT_RECEIVED'} = 'The buyer has not received the item(s)';
MLI18n::gi()->{'ebay_configform_refund_reasons_values__BUYER_RETURN'} = 'The buyer has returned the item(s) due to goodwill of the seller or because they were “not as described”';
MLI18n::gi()->{'ebay_configform_refund_reasons_values__ITEM_NOT_AS_DESCRIBED'} = 'The buyer has claimed the item(s) as "not as described"';
MLI18n::gi()->{'ebay_configform_refund_reasons_values__OTHER_ADJUSTMENT'} = 'The refund was requested by the buyer without giving a reason';
MLI18n::gi()->{'ebay_config_account_emailtemplate_sender'} = 'Example Shop';
MLI18n::gi()->{'ebay_config_account_emailtemplate_sender_email'} = 'example@onlineshop.com';
MLI18n::gi()->{'ebay_config_account_emailtemplate_subject'} = 'Your Order from #SHOPURL#';
MLI18n::gi()->{'ebay_config_producttemplate_content'} = '<p>#TITLE#</p><p>#ARTNR#</p><p>#SHORTDESCRIPTION#</p><p>#PICTURE1#</p><p>#PICTURE2#</p><p>#PICTURE3#</p><p>#DESCRIPTION#</p>';
MLI18n::gi()->{'ebay_config_producttemplate_mobile_content'} = '#TITLE#<br />
#ARTNR#<br />
#SHORTDESCRIPTION#<br />
#DESCRIPTION#';
MLI18n::gi()->{'ebay_config_emailtemplate_content'} = ' <style><!--
body {
    font: 12px sans-serif;
}
table.ordersummary {
	width: 100%;
	border: 1px solid #e8e8e8;
}
table.ordersummary td {
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
MLI18n::gi()->{'ebay_config_account__legend__account'} = 'Login Details';
MLI18n::gi()->{'ebay_config_account__legend__tabident'} = 'Tab';
MLI18n::gi()->{'ebay_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'ebay_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'ebay_config_account__field__username__label'} = 'eBay Username';
MLI18n::gi()->{'ebay_config_account__field__username__help'} = 'Please enter your eBay username.';
MLI18n::gi()->{'ebay_config_account__field__username__hint'} = '';
MLI18n::gi()->{'ebay_config_account__field__token__label'} = 'eBay Token';
MLI18n::gi()->{'ebay_config_account__field__token__help'} = 'To apply for a new eBay token, please click the button.<br>
If this does not open eBay in a new window, please deactivate your popup blocker.<br><br>
The token is needed to allow you to access eBay via the magnalister interface.<br>
Please follow the steps in the eBay window to apply for a token and connect your online Shop with eBay via magnalister.';
MLI18n::gi()->{'ebay_config_account__field__site__label'} = 'eBay Site';
MLI18n::gi()->{'ebay_config_account__field__site__help'} = 'For which country should your products be listed?';
MLI18n::gi()->{'ebay_config_account__field__currency__label'} = 'Currency';
MLI18n::gi()->{'ebay_config_account__field__currency__help'} = 'The currency that your eBay items will be listed under. Please choose a currency corresponding to the specific eBay site.';
MLI18n::gi()->{'ebay_config_prepare__legend__prepare'} = 'Prepare Items';
MLI18n::gi()->{'ebay_config_prepare__legend__location__title'} = 'Location';
MLI18n::gi()->{'ebay_config_prepare__legend__location__info'} = 'Please enter the location of your Shop. This will be visible as the Seller Address on eBay.';
MLI18n::gi()->{'ebay_config_prepare__legend__pictures'} = 'Image Settings';
MLI18n::gi()->{'ebay_config_prepare__legend__payment'} = '<b>Settings for Payment Methods</b>';
MLI18n::gi()->{'ebay_config_prepare__legend__returnpolicy'} = '<b>Return Policy</b>';
MLI18n::gi()->{'ebay_config_prepare__legend__shipping'} = 'Shipping';
MLI18n::gi()->{'ebay_config_prepare__legend__misc'} = '<b>Miscellaneous</b>';
MLI18n::gi()->{'ebay_config_prepare__legend__upload'} = 'Item Upload Presets';
MLI18n::gi()->{'ebay_config_prepare__legend__fixedprice'} = '<b>Option for Fixed-Price Listings</b>';
MLI18n::gi()->{'ebay_config_prepare__legend__chineseprice'} = '<b>Auction Settings</b>';
MLI18n::gi()->{'ebay_config_prepare__field__prepare.status__label'} = 'Status Filter';
MLI18n::gi()->{'ebay_config_prepare__field__prepare.status__valuehint'} = 'Only show active items';
MLI18n::gi()->{'ebay_config_prepare__field__postalcode__label'} = 'Postcode';
MLI18n::gi()->{'ebay_config_prepare__field__postalcode__help'} = 'Please enter the location of your Shop. This will be visible as the Seller Address on eBay. ';
MLI18n::gi()->{'ebay_config_prepare__field__location__label'} = 'City';
MLI18n::gi()->{'ebay_config_prepare__field__country__label'} = 'Country';
MLI18n::gi()->{'ebay_config_prepare__field__mwst__label'} = 'VAT';
MLI18n::gi()->{'ebay_config_prepare__field__mwst.always__label'} = '&quot;VAT included&quot; always show';
MLI18n::gi()->{'ebay_config_prepare__field__mwst__help'} = '<p>Here you can set the default value for VAT (percentage), which will be shown in your eBay listings. You can adjust the VAT rate later for each product individually in the magnalister product preparation.</p>
                        <p><b>Important:</b><br/>Please only fill in this field if you charge VAT.</p>';
MLI18n::gi()->{'ebay_config_prepare__field__mwst__hint'} = 'VAT rate in %';
MLI18n::gi()->{'ebay_config_prepare__field__conditionid__label'} = 'Item Condition';
MLI18n::gi()->{'ebay_config_prepare__field__conditionid__help'} = 'Item Condition presets (for eBay categories that require or provide the option for this). Not every description is valid for every category; after choosing the category please ensure the Item Condition is correct. ';
MLI18n::gi()->{'ebay_config_prepare__field__lang__label'} = 'Language';
MLI18n::gi()->{'ebay_config_prepare__field__lang__help'} = 'Language for item names and descriptions. Your Shop allows names and descriptions to be given in more than one language; for uploading to eBay, one language must be selected. 
Error reports from eBay will also be made in the selected language.';
MLI18n::gi()->{'ebay_config_prepare__field__dispatchtimemax__label'} = 'Lead Time';
MLI18n::gi()->{'ebay_config_prepare__field__dispatchtimemax__help'} = 'Maximum amount of time required before the item is shipped. This will be visible on eBay.';
MLI18n::gi()->{'ebay_config_prepare__field__topten__label'} = 'Category Quick-Selection';
MLI18n::gi()->{'ebay_config_prepare__field__topten__help'} = 'Show the Quick Select Category under Prepare Items.';
MLI18n::gi()->{'ebay_config_prepare__field__gallerytype__label'} = 'Gallery Images';
MLI18n::gi()->{'ebay_config_prepare__field__gallerytype__help'} = '<b>Gallery Images</b><br /><br />
                Gallery images appear in the search result list on eBay. This improves the visibility of your items, and thus also the potential selling outcome.<br /><br />
                <b>Gallery Plus</b><br /><br />
                Gallery Plus means a  pop-up window with a bigger view of the item, when the customer points with the mouse on the item within the search result list. Please note that the image size must be <b>at least 800x800 px</b>.<br /><br />
                <b>eBay Fees</b><br /><br />
                &quot;Gallery Plus&quot; is <span style="color:#e31a1c">subject to fee on eBay</span> in some categories! RedGecko GmbH does not care responsibility for any eBay fees caused.<br /><br />
                <b>Further information</b><br /><br />
                Please refer to the <a href="http://pages.ebay.com/help/sell/gallery-upgrade.html" target="_blank">eBay help pages</a> for further information.';
MLI18n::gi()->{'ebay_config_prepare__field__gallerytype__hint'} = 'Gallery<br />("Plus" can be <span style="color:#e31a1c">subject of fee</span> in some categories)';
MLI18n::gi()->{'ebay_config_prepare__field__gallerytype__alert__Plus__title'} = 'Please note';
MLI18n::gi()->{'ebay_config_prepare__field__gallerytype__alert__Plus__content'} = 'Gallery Plus means a  pop-up window with a bigger view of the item, when the customer points with the mouse on the item within the search result list. Please note that the image size must be <b>at least 800x800 px</b>.<br /><br />The usage of <b>Gallery Plus</b> can <span style="color:#e31a1c">cause extra fees</span> in some eBay categories. See <a href="http://pages.ebay.com/help/sell/gallery-upgrade.html" target="_blank">eBay help page</a> for details.<br /><br />RedGecko GmbH is not responsible for any costs caused.';
MLI18n::gi()->{'ebay_config_prepare__field__variationdimensionforpictures__label'} = 'Picture Pack Variation dimension';
MLI18n::gi()->{'ebay_config_prepare__field__variationdimensionforpictures__help'} = 'If you have variation images stored along with your product data, the Picture Pack will submit them to eBay with the product upload.<br />
                eBay allows only one variation dimension: If you take e.g. color, the main picture on eBay&apos;s product page will change whenever the buyer chooses an other color.<br /><br />
                This setting here is the default value. You can change it in the preparation form for each product.<br />
                If you want to change it afterwards, you have to prepare and upload the product anew.';
MLI18n::gi()->{'ebay_config_prepare__field__paymentsellerprofile__label'} = 'frame conditions: Payment methods';
MLI18n::gi()->{'ebay_config_prepare__field__paymentsellerprofile__help'} = 'You use the “frame conditions for offers” function on eBay. That means that payment-, shipping- and reshipment conditions can’t be chosen individually. Conditions are now taken from the eBay profile.<br /><br />
Please select the prefared profile for payment conditions. This is mandantory. You can select a different profile in the item preparation if you have several profiles on eBay.
';
MLI18n::gi()->{'ebay_config_prepare__field__paymentsellerprofile__help_subfields'} = '<b>Hint:</b><br />
This field is not editable since you are using the eBay frame-conditions. Please use the selection-field
<b>frame condition: Payment methods</b> to determine the profile for payment conditions.';
MLI18n::gi()->{'ebay_config_prepare__field__paymentmethods__label'} = 'Payment Methods';
MLI18n::gi()->{'ebay_config_prepare__field__paymentmethods__help'} = 'Preferences for payment methods ( multi-select with Ctrl+click).<br /><br />Here you can select the payment methods provided by eBay.<br /><br />If you use „eBay Managed Payments", eBay will not provide any further information about the payment method used by the buyer.';
MLI18n::gi()->{'ebay_config_prepare__field__paypal.address__label'} = 'PayPal E-Mail Address';
MLI18n::gi()->{'ebay_config_prepare__field__paypal.address__help'} = 'The emails address provided to eBay for PayPal payments. This is required to upload eBay store items.';
MLI18n::gi()->{'ebay_config_prepare__field__paymentinstructions__label'} = 'Payment Instructions';
MLI18n::gi()->{'ebay_config_prepare__field__paymentinstructions__help'} = 'Please enter text here that should appear in the item page under \'Seller\'s Payment Instructions\'***. Maximum 500 characters (text only, no HTML). ';
MLI18n::gi()->{'ebay_config_prepare__field__shippingsellerprofile__label'} = 'frame conditions: Shipment';
MLI18n::gi()->{'ebay_config_prepare__field__shippingsellerprofile__help'} = '<b>Selection of frame-condition-profile for shipment</b><br /><br />
You use the “frame conditions for offers” function on eBay. That means that payment-, shipping- and reshipment conditions can’t be chosen individually. Conditions are now taken from the eBay profile.<br /><br />
Please select the prefared profile for shipping conditions. This is mandantory. You can select a different profile in the item preparation if you have several profiles on eBay.';
MLI18n::gi()->{'ebay_config_prepare__field__shippingsellerprofile__help_subfields'} = '<b>Hint:</b><br />
This field is not editable since you are using the eBay frame-conditions. Please use the selection-field
<b>frame condition: shipping methods</b> to determine the profile for shipping conditions.';
MLI18n::gi()->{'ebay_config_prepare__field__shippinglocalcontainer__label'} = 'Domestic Shipping';
MLI18n::gi()->{'ebay_config_prepare__field__shippinglocalcontainer__help'} = 'Please choose one or more shipping methods to set as standard. <br /><br />Enter a number under Shipping Costs (without currency specification), or "=WEIGHT" to set the shipping costs according to the item weight.
<div class="ui-dialog-titlebar ">
<span>Discount for Combination Payment and Shipping***</span>
Profile selection for shipping discount. Profiles can be set in your eBay account, under My eBay > Member Account > Settings > Shipping Settings<br /><br />
Here you can also set the rules for special shipping prices (for example, maximum shipping price per order, or free shipping if the item cost is above a certain amount).<br /><br />
<b>Please Note:</b><br />
Order imports will be subject to the rules that are chosen here (we do not receive the information on item settings from eBay).***';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternationalcontainer__label'} = 'International Shipping';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternationalcontainer__help'} = 'Please choose shipping methods to set as standard (or select none).<div class="ui-dialog-titlebar ">
<span>Discount for Combination Payment and Shipping***</span>
Profile selection for shipping discount. Profiles can be set in your eBay account, under My eBay > Member Account > Settings > Shipping Settings<br /><br />
Here you can also set the rules for special shipping prices (for example, maximum shipping price per order, or free shipping if the item cost is above a certain amount).<br /><br />
<b>Please Note:</b><br />
Order imports will be subject to the rules that are chosen here (we do not receive the information on item settings from eBay).***';
MLI18n::gi()->{'ebay_config_prepare__field__shippinglocal__cost'} = 'Shipping Costs';
MLI18n::gi()->{'ebay_config_prepare__field__shippinglocalprofile__option'} = '{#NAME#} ({#AMOUNT#} per additional item)';
MLI18n::gi()->{'ebay_config_prepare__field__shippinglocalprofile__optional__select__false'} = 'Don&apos;t use Shipping Profile';
MLI18n::gi()->{'ebay_config_prepare__field__shippinglocalprofile__optional__select__true'} = 'Use Shipping Profile';
MLI18n::gi()->{'ebay_config_prepare__field__shippinglocaldiscount__label'} = 'Use special shipping price rules';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternationaldiscount__label'} = 'Use special shipping price rules';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternational__cost'} = 'Shipping Costs';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternational__optional__select__false'} = 'Don\'t ship internationally';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternational__optional__select__true'} = 'Ship internationally';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternationalprofile__option'} = '{#NAME#} ({#AMOUNT#} per additional item)';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternationalprofile__notavailible'} = 'Only when `<i>International Shipping</i>` is activated.';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternationalprofile__optional__select__false'} = 'Don&apos;t use Shipping Profile';
MLI18n::gi()->{'ebay_config_prepare__field__shippinginternationalprofile__optional__select__true'} = 'Use Shipping Profile';
MLI18n::gi()->{'ebay_config_prepare__field__returnsellerprofile__label'} = 'frame conditions: Reshipment';
MLI18n::gi()->{'ebay_config_prepare__field__returnsellerprofile__help'} = '<b>Selection of frame-condition-profile for reshipment</b><br /><br />
You use the “Frame conditions for offers” function on eBay. That means that payment-, shipping- and reshipment conditions can’t be individually chosen. Conditions are now taken from the eBay profile.<br /><br />
Please select the prefared profile for reshipment conditions. This is mandantory. You can select a different profile in the item preparation if you have several profiles on eBay.
';
MLI18n::gi()->{'ebay_config_prepare__field__returnsellerprofile__help_subfields'} = '<b>Hint:</b><br />
This field is not editable since you are using the eBay frame-conditions. Please use the selection-field
<b>frame condition: reshipment</b> to determine the profile for reshipment conditions.';
MLI18n::gi()->{'ebay_config_prepare__field__returnpolicy.returnsaccepted__label'} = 'Returns Accepted';
MLI18n::gi()->{'ebay_config_prepare__field__returnpolicy.returnswithin__label'} = 'Returns Within ';
MLI18n::gi()->{'ebay_config_prepare__field__returnpolicy.returnswithin__help'} = 'Time period within which returns will be accepted.';
MLI18n::gi()->{'ebay_config_prepare__field__returnpolicy.shippingcostpaidby__label'} = 'Return Shipping Costs';
MLI18n::gi()->{'ebay_config_prepare__field__returnpolicy.description__label'} = 'Return Policy: Further Details';
MLI18n::gi()->{'ebay_config_prepare__field__returnpolicy.description__help'} = 'Please enter here details of your return policy. Maximum 5,000 characters (text only, no HTML).';
MLI18n::gi()->{'ebay_config_prepare__field__usevariations__label'} = 'Variations';
MLI18n::gi()->{'ebay_config_prepare__field__usevariations__help'} = 'Products that are available with variations (such as size or colour) in your Shop will be transferred with these variations to eBay.<br /><br /> The Quantity setting will then apply to each individual variation.<br /><br />
<b>Example:</b> If you have 8 of an item in blue, 5 in green and 2 in black, under Quantity you have selected "Transfer Shop inventory minus value from the right field", and entered "2" in the field, the item will them be available as 6 in blue and 3 in green.<br /><br /><b>Please note:</b>It may occur that a variation you are using (such as size or colour) will also appear in the Attribute Selection for the category. In this case your variation will be used instead of the attribute.';
MLI18n::gi()->{'ebay_config_prepare__field__usevariations__valuehint'} = 'Transfer variations';
MLI18n::gi()->{'ebay_config_prepare__field__useprefilledinfo__label'} = 'Product Information';
MLI18n::gi()->{'ebay_config_prepare__field__useprefilledinfo__help'} = 'Function activated: Show the eBay product information, if found. Only applicable if EAN is used.';
MLI18n::gi()->{'ebay_config_prepare__field__useprefilledinfo__valuehint'} = 'show eBay prefilled Product information';
MLI18n::gi()->{'ebay_config_prepare__field__privatelisting__label'} = 'Private Listings';
MLI18n::gi()->{'ebay_config_prepare__field__privatelisting__help'} = 'Activate this setting to mark listings as \'Private\'. This will make your buyer/bidder list not publicly visible. <span style="color:#e31a1c">requires payment</span> ';
MLI18n::gi()->{'ebay_config_prepare__field__privatelisting__hint'} = '{#i18n:ebay_prepare_apply_form__field__privatelisting__hint#}';
MLI18n::gi()->{'ebay_config_prepare__field__privatelisting__valuehint'} = 'Make buyer/bidder list private';
MLI18n::gi()->{'ebay_config_prepare__field__restrictedtobusiness__label'} = 'Restrict to Business';
MLI18n::gi()->{'ebay_config_prepare__field__restrictedtobusiness__help'} = 'Only business customers are allowed to buy the items.';
MLI18n::gi()->{'ebay_config_prepare__field__restrictedtobusiness__valuehint'} = 'Items can be bought only by business customers';
MLI18n::gi()->{'ebay_config_prepare__field__imagesize__label'} = 'Image Size';
MLI18n::gi()->{'ebay_config_prepare__field__imagesize__help'} = '<p>Please enter the pixel width for the image as should appear on the Marketplace. The height will be automatically matched based on the original aspect ratio.</p>
<p>The source files will be processed from the image folder {#setting:sSourceImagePath#}, and will be stored in the folder {#setting:sImagePath#} with the selected pixel width for use on the Marketplace.</p>';
MLI18n::gi()->{'ebay_config_prepare__field__imagesize__hint'} = 'Saved under: {#setting:sImagePath#}';
MLI18n::gi()->{'ebay_config_prepare__field__picturepack__label'} = 'Picture Pack';
MLI18n::gi()->{'ebay_config_prepare__field__picturepack__help'} = '                <b>Picture Pack</b><br /><br />
                By activation of the feature &quot;Picture Pack&quot;, you can submit up to 12 pictures for each item. The buyer can view the images in a bigger size and zoom parts of the picture. No special settings on your eBay accounts required.<br /><br />
                <b>Variation Images</b><br /><br />
                If you have variation pictures for an item, they can also be transferred to eBay (up to 12 images per variation).<br /><br />
                <b>Note</b><br /><br />
                magnalister can only process the data your shop system provides. If you shop system doesn&apos;t support variation images, this feature isn&apos;t available in magnalister.<br /><br />
                <b>&quot;Supersized pictures&quot; and und &quot;Zoom&quot;</b><br /><br />
                Please use pictures of a sufficient size to talke advantage of the features &quot;Supersized pictures&quot; and und &quot;Zoom&quot;. If a picture is too small (less than <b>1000px</b> on the longest side), it will be used, but you will see a warning in the Error Log view of magnalister.<br /><br />
                <b>Usage of https addresses for pictures (safe URL&apos;s)</b><br /><br />
                eBay doesn&apos;t allow safe URL&apos;s for pictures, if given directly as address in the item data. Our Picture Pack uses the eBay Picture Service to store pictures, so that safe URL&apos;s are supported.<br /><br />
                <b>Processing duration</b><br /><br />
                With the Picture Pack, pictures are first uploaded to eBay, and then attached to the respective item. This can take 2-5 seconds per image, depending on the image size.<br /><br />
                To have a reasonable processing speed on the shop part, the data are buffered on the magnalister server. Possible error messages from eBay can be seen in magnalister&apos;s Error Log, only when the upload to eBay is completed.<br /><br />
                <b>Update of Pictures on eBay</b><br /><br />
                With the Picture Pack, you need just to change the picture in your shop and upload the Item again to make the change visible on eBay.<br />
                Without it, a picture on eBay changes only if you change the URL of the picture (and then upload the Item).<br /><br />
                <b>Possible fees in eBay part</b><br /><br />
                The usage of Picture Pack is free for the eBay sites Germany and Austria. For other countries, please refer to the eBay help pages or the eBay support of the respective country.<br /><br />
                RedGecko GmbH does not care responsibility for any eBay fees caused.';
MLI18n::gi()->{'ebay_config_prepare__field__picturepack__valuehint'} = 'activate Picture Pack';
MLI18n::gi()->{'ebay_config_prepare__field__productfield.brand__label'} = 'Brand';
MLI18n::gi()->{'ebay_config_prepare__field__productfield.tecdocktype__label'} = 'TecDoc KType';
MLI18n::gi()->{'ebay_config_prepare__field__productfield.tecdocktype__help'} = '<strong>For Motor parts only</strong><br /><br />
                If you store the TecDoc KType in your Shop`s database, and you want to use it also for eBay listings, 
                choose the database table and column where the KType is stored.<br /><br />
                The KType will be then (if existent for the given item) transferred to eBay,
                 so that the item can be found easily on the basis of the TecDoc compatibility list.';
MLI18n::gi()->{'ebay_config_prepare__field__fixed.quantity__label'} = 'Number of items';
MLI18n::gi()->{'ebay_config_prepare__field__fixed.quantity__help'} = 'Please enter how much of the inventory should be available on the marketplace.<br/>
                        <br/>
You can change the individual item count directly under \'Upload\'. In this case it is recommended that you turn off automatic<br/>
synchronization under \'Synchronization of Inventory\' > \'Stock Sync to Marketplace\'.<br/>
                        <br/>
To avoid overselling, you can activate \'Transfer shop inventory minus value from the right field\'.
                        <br/>
<strong>Example:</strong> Setting the value at 2 gives &#8594; Shop inventory: 10 &#8594; eBay  inventory: 8<br/>
                        <br/>
                        <strong>Please note:</strong>If you want to set an inventory count for an item in the Marketplace to \'0\', which is already set as Inactive in the Shop, independent of the actual inventory count, please proceed as follows:<br/>
                        <ul>
                        <li>\'Synchronize Inventory"> Set "Edit Shop Inventory" to "Automatic Synchronization with CronJob"</li>
                        <li>"Global Configuration" > "Product Status" > Activate setting "If product ';
MLI18n::gi()->{'ebay_config_prepare__field__maxquantity__label'} = 'Limitation for Number of Items';
MLI18n::gi()->{'ebay_config_prepare__field__maxquantity__help'} = 'Here you can limitate the number of items published on eBay.<br /><br />
<strong>Example:</strong>
For “number of items” you select “take inventory from shop” and enter “20” in this field. While upload number of items will be taken from available inventory but not more then 20. The inventory synchronisation (if activated) will adapt the eBay-number of items to the shop-inventory as long as the shop-inventory is less then 20. If there are more then 20 items in the inventory, the eBay number of items is set to 20.<br /><br />
Please insert “0” or let this field blank if you do not want a limitation.<br /><br />
<strong>Hint:</strong>
If the “number of items” option is “global (from the right field)”, limitation has no effect.
';
MLI18n::gi()->{'ebay_config_prepare__field__chinese.quantity__label'} = 'Number of Items';
MLI18n::gi()->{'ebay_config_prepare__field__fixed.duration__label'} = 'Listings Duration';
MLI18n::gi()->{'ebay_config_prepare__field__fixed.duration__help'} = 'Preparation for the duration of fixed-price-listings. The configuration can be changed in the item preparation.';
MLI18n::gi()->{'ebay_config_prepare__field__ebayplus__label'} = 'eBay Plus';
MLI18n::gi()->{'ebay_config_prepare__field__ebayplus__valuehint'} = 'Publish article with eBay Plus';
MLI18n::gi()->{'ebay_config_prepare__field__ebayplus__help'} = '<a href="http://verkaeuferportal.ebay.de/ebay-plus" target="_blank">eBay Plus</a> can be activated via the eBay account if eBay unlocked the function for you. This feature is only offered for eBay Germany at the moment.<br /><br />
The here found checkbox is a presetting for the upload via magnalister. It can be clicked when eBay Plus is active in your account. It has no influence on the presetting for eBay articles (this can only be activated via your eBay account).<br /><br />
If the checkbox is not selectable even though you activated the function on eBay, please save your configuration ones (magnalister recalls the recent configuration from eBay at this connection).<br /><br />
<b>Hint:</b>
<ul>
<li>Additional conditions must be complied for eBay Plus listings:
1 month reshipment period, possibility of paypal-payment, a <a href="http://verkaeuferportal.ebay.de/versand-bei-ebay-plus" target="_blank">shipping method that is accredited by eBay</a>.
We do <b>not get replay</b> from eBay if those conditions are correct. You have to take care yourself for that. </li>
<li>
Please allow purchase order change (via order synchronisation) or use the function &quotonly import orders that are marked paid&quot (vie order import). The eBay plus label is not transmitted with the first order note. It will be transmitted soon as the buyer selected payment and shipping methods.</li>
<li>
It sometimes appeares that eBay plus orders are transmitted without authorized payment methods. An advance notice will be shown in the detailed order-view in such cases.</li></ul>
';
MLI18n::gi()->{'ebay_config_prepare__field__chinese.duration__label'} = 'Duration of the Online-auction';
MLI18n::gi()->{'ebay_config_prepare__field__chinese.duration__help'} = 'Presetting for auction duration. This setting can be changed in the item preparation.';
MLI18n::gi()->{'ebay_config_price__legend__price'} = 'Price Calculation';
MLI18n::gi()->{'ebay_config_price__legend__fixedprice'} = '<b>Settings for Fixed Price Listings</b>';
MLI18n::gi()->{'ebay_config_price__legend__chineseprice'} = '<b>Auction Settings</b>';
MLI18n::gi()->{'ebay_config_price__field__fixed.price__label'} = 'Sales Price Adjustment';
MLI18n::gi()->{'ebay_config_price__field__fixed.price__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__fixed.price__help'} = 'Please enter a price markup or markdown, either in percentage or fixed amount. Use a minus sign (-) before the amount to denote markdown.';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.addkind__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.addkind__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.factor__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.factor__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.signal__label'} = 'Decimal Amount';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.signal__hint'} = 'Decimal Amount';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.signal__help'} = 'This textfield shows the decimal value that will appear in the item price on eBay.<br/><br/>
                <strong>Example:</strong> <br />
Value in textfeld: 99 <br />
                Original price: 5.58 <br />
                Final amount: 5.99 <br /><br />
This function is useful when marking the price up or down***. <br/>
Leave this field empty if you do not wish to set any decimal amount. <br/>
The format requires a maximum of 2 numbers.';
MLI18n::gi()->{'ebay_config_price__field__fixed.priceoptions__label'} = 'Sales Price from Customer Group';
MLI18n::gi()->{'ebay_config_price__field__fixed.priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'ebay_config_price__field__fixed.priceoptions__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.group__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.group__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.price__label'} = 'Start Price';
MLI18n::gi()->{'ebay_config_price__field__chinese.price__help'} = 'Please enter a price markup or markdown, either in percentage or fixed amount. Use a minus sign (-) before the amount to denote markdown. \'Fixed Price\' means that the value entered here will be directly transferred (for example, if you want to always use a start price of 1 euro). ';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.addkind__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.addkind__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.factor__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.factor__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.signal__label'} = 'Decimal Amount';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.signal__hint'} = 'Decimal Amount';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.signal__help'} = 'This textfield shows the decimal value that will appear in the item price on eBay.<br/><br/>
                <strong>Example:</strong> <br />
Value in textfeld: 99 <br />
                Original price: 5.58 <br />
                Final amount: 5.99 <br /><br />
This function is useful when marking the price up or down***. <br/>
Leave this field empty if you do not wish to set any decimal amount. <br/>
The format requires a maximum of 2 numbers.';
MLI18n::gi()->{'ebay_config_price__field__chinese.priceoptions__label'} = 'Price from Customer Group';
MLI18n::gi()->{'ebay_config_price__field__chinese.priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'ebay_config_price__field__chinese.priceoptions__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.group__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.group__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price__label'} = 'Buy It Now Price';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price__help'} = 'Please enter a price markup or markdown, either in percentage or fixed amount. Use a minus sign (-) before the amount to denote markdown.<br/>
The Buy It Now price must be at least 40&#37; greater than the start price.';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price.addkind__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price.addkind__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price.factor__label'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price.factor__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price.signal__label'} = 'Decimal Amount';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price.signal__hint'} = 'Decimal Amount';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.price.signal__help'} = 'This textfield shows the decimal value that will appear in the item price on eBay.<br/><br/>
                <strong>Example:</strong> <br />
Value in textfeld: 99 <br />
                Original price: 5.58 <br />
                Final amount: 5.99 <br /><br />
This function is useful when marking the price up or down***. <br/>
Leave this field empty if you do not wish to set any decimal amount. <br/>
The format requires a maximum of 2 numbers.';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.priceoptions__label'} = 'Price Options';
MLI18n::gi()->{'ebay_config_price__field__chinese.buyitnow.priceoptions__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__buyitnowprice__label'} = 'Activate Buy It Now Price';
MLI18n::gi()->{'ebay_config_price__field__buyitnowprice__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.usespecialoffer__label'} = 'Use Webshop Special Price as Marketplace Sales Price';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.usespecialoffer__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__fixed.price.usespecialoffer__help'} = '<span style="color:#e31a1c;font-weight:bold">Use Webshop Special Price as Marketplace Sales Price</span><br /><br />Activate this option if you want to use special prices from your webshop as sales prices on eBay. If you have made any changes under "Sales Price Adjustment", these will be additionally taken into account.';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.usespecialoffer__label'} = 'Use Webshop Special Price as Marketplace Sales Price';
MLI18n::gi()->{'ebay_config_price__field__chinese.price.usespecialoffer__hint'} = '';
MLI18n::gi()->{'ebay_config_price__field__bestofferenabled__label'} = 'Best Offer';
MLI18n::gi()->{'ebay_config_price__field__bestofferenabled__help'} = 'Activate this function to allow buyers to suggest their own best price for items.<br /><br />
This setting is only valid for \'basic\' items (no variations). If variations are present, this setting will not apply.';
MLI18n::gi()->{'ebay_config_price__field__bestofferenabled__valuehint'} = 'Activate Best Offer (only applies to items without variations)';
MLI18n::gi()->{'ebay_config_price__field__exchangerate_update__label'} = 'Exchange Rate';
MLI18n::gi()->{'ebay_config_price__field__exchangerate_update__valuehint'} = 'Automatically update exchange rate';
MLI18n::gi()->{'ebay_config_price__field__exchangerate_update__help'} = '{#i18n:form_config_orderimport_exchangerate_update_help#}';
MLI18n::gi()->{'ebay_config_price__field__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
MLI18n::gi()->{'ebay_config_sync__legend__syncchinese'} = '<b>Auction Settings</b>';
MLI18n::gi()->{'ebay_config_sync__legend__sync__title'} = 'Inventory Synchronization';
MLI18n::gi()->{'ebay_config_sync__legend__sync__info'} = 'Determine which product attributes from your Shop should be automatically updated on eBay.<br /><br /><b>Settings for Fixed-Price Listings</b>';
MLI18n::gi()->{'ebay_config_sync__field__synczerostock__label'} = 'Synchronizing Zero Stocks';
MLI18n::gi()->{'ebay_config_sync__field__synczerostock__help'} = 'Sold out offers are usually closed on eBay. If you relist and assign a new eBay offer number, your product ranking will be lost.
<br /><br />
In order to automatically end your sold out items on eBay and offer them again after replenishment without losing your product ranking, magnalister supports with this feature the eBay option "out of stock" for "valid until revoked" offers.
<br /><br />
In addition to this feature, please activate the option "No longer in stock" in "My eBay" > "Seller settings" directly in your eBay account.
<br /><br />
Please note that the function only affects "Valid until revoked" offers.
<br /><br />
Read more about this topic on the eBay help pages (search term "out of stock").';
MLI18n::gi()->{'ebay_config_sync__field__synczerostock__valuehint'} = 'Enable Zero Stock Synchronization';
MLI18n::gi()->{'ebay_config_sync__field__syncrelisting__label'} = 'Auto Relisting';
MLI18n::gi()->{'ebay_config_sync__field__syncrelisting__help'} = '
With activation of this function, your items will be automatically put back on eBay if:
<ul>
<li>Your offer ends without a bid being placed</li>
<li>Cancel the transaction </li>
<li>You end your offer prematurely</li>
<li>the item was not sold or</li>
<li>the buyer did not pay for the item.</li>
</ul>

Note that eBay allows a maximum of 2 re-listings. 
<br />
Read more about this topic on the eBay help pages (search term "Relist item").';
MLI18n::gi()->{'ebay_config_sync__field__syncrelisting__valuehint'} = 'Enable Auto-Relisting';
MLI18n::gi()->{'ebay_config_sync__field__syncproperties__label'} = 'EAN, MPN & Manufacuter Sync';
MLI18n::gi()->{'ebay_config_sync__field__syncproperties__help'} = 'If you activate the EAN &amp; MPN Synchronisation, you can transfer the corresponding values by one click (using the new synchronisation button left from the order import button) to eBay.<br />
<br />
                           This will also synchronise items not listed on magnalister. The eBay inventory count will be given by the item number, as long as it is identical on both eBay and your web shop (compare at &ldquo;magnalister&rdquo; > &ldquo;eBay&rdquo; > &ldquo;Inventory&rdquo;). The very first synchronisation of this can take up to 24 hours.<br />
                           <br />
                           For <b>Variations</b>, the EAN of the master item is used, if no EAN for the variation is found in the shop database (the most shop systems of the OsCommerce family can&apos;t handle variation EAN&apos;s). If there&apos;s no EAN for the master item, and not all the variations have EAN&apos;s, one of the existing EAN&apos;s will be used also for the remaining variations of the item. If you have the &quot;EAN &amp; MPN Synchronisation&quot; AddOn booked, the values are completed also during the &quot;normal&quot; Price- and Stock Synchronization.<br />
                           <br />
                           *In the EAN field you can also enter the ISBN or UPC. magnalister will automatically recognise which identification number you have provided.<br /><br />
                           <b>Important</b> for osCommerce: Install EAN expansion<br />
                           osCommerce has by default no field for EAN. Please contact us for details, how to extend the shop database and forms, so that the EAN can be handled.<br /><br />
                           <b>Tips:</b><br />
                           eBay allows you to transfer placeholder numbers for EAN and MPN instead of the real number. Products with these placeholder numbers will be ranked lower on eBay, meaning they won&rsquo;t be found as easily.<br />
                           <br />
                           magnalister transfers these eBay placeholder numbers for items where no EAN or MPN have been found, in order to allow you to make changes to existing items.<br />';
MLI18n::gi()->{'ebay_config_sync__field__syncproperties__valuehint'} = 'Activate EAN, MPN & Manufacuter Sync';
MLI18n::gi()->{'ebay_config_sync__field__stocksync.tomarketplace__label'} = 'Stock Sync to Marketplace';
MLI18n::gi()->{'ebay_config_sync__field__stocksync.tomarketplace__hint'} = '';
MLI18n::gi()->{'ebay_config_sync__field__stocksync.tomarketplace__help'} = '<dl>
            <dt>Automatic Synchronization via CronJob (recommended)</dt>
                    <dd>Current eBay stock will be synchronized with shop stock every 4 hours, beginning at 0.00am (with ***, depending on configuration).<br>Values will be transferred from the database, including the changes that occur through an ERP or similar.<br><br>
Manual comparison can be activated by clicking the corresponding button in the magnalister header (left of the shopping cart).<br><br>
Additionally, you can activate the stock comparison through CronJon (flat tariff - maximum every 4 hours) with the link:<br>
            <i>{#setting:sSyncInventoryUrl#}</i><br>
Some CronJob requests may be blocked, if they are made through customers not on the flat tariff or if the request is made more than once every 4 hours. 
</dd>
                    <b>Note:</b> The settings in ‘Configuration’, ‘Adjusting Procedure’ and ‘Inventory Item Count’ will be taken into account.';
MLI18n::gi()->{'ebay_config_sync__field__stocksync.frommarketplace__label'} = 'Stock Sync from Marketplace';
MLI18n::gi()->{'ebay_config_sync__field__stocksync.frommarketplace__hint'} = '';
MLI18n::gi()->{'ebay_config_sync__field__stocksync.frommarketplace__help'} = 'If, for example, an item is purchased 3 times on eBay, the Shop inventory will be reduced by 3.<br /><br />
<strong>Important:</strong>This function will only work if you have Order Imports activated!';
MLI18n::gi()->{'ebay_config_sync__field__inventorysync.price__label'} = 'Item Price';
MLI18n::gi()->{'ebay_config_sync__field__inventorysync.price__hint'} = '';
MLI18n::gi()->{'ebay_config_sync__field__inventorysync.price__help'} = '<dl>
            <dt>Automatic Synchronization via CronJob (recommended)</dt>
                    <dd>The function ‘Automatic Synchronization’ synchronizes the eBay price with the Shop price every 4 hours, beginning at 0.00am (with ***, depending on configuration).<br>Values will be transferred from the database, including the changes that occur through an ERP or similar.<br><br>
Manual comparison can be activated by clicking the corresponding button in the magnalister header (left of the shopping cart).<br><br>
Additionally, you can activate the stock comparison through CronJon (flat tariff - maximum every 4 hours) with the link:<br>
            <i>{#setting:sSyncInventoryUrl#}</i><br>
Some CronJob requests may be blocked, if they are made through customers not on the flat tariff or if the request is made more than once every 4 hours. 
</dd>
                    <b>Note:</b> The settings in ‘Configuration’, ‘Adjusting Procedure’ and ‘Inventory Item Count’ will be taken into account.
';
MLI18n::gi()->{'ebay_config_sync__field__chinese.stocksync.tomarketplace__label'} = 'Stock Sync to Marketplace';
MLI18n::gi()->{'ebay_config_sync__field__chinese.stocksync.tomarketplace__help'} = '<dl>
                                <dt>Automatic synchronisation by CronJob (recommended)</dt>
                                    <dd>The function "Automatic Synchronisation by CronJob" checks the shop stock every 4 hours, and deletes eBay Auctions for Items which are no longer available in the shop.<br /><br />
                                        By this procedure, the database values are checked for changes. The new data will be submitted, also when the changes had been set
                                        by an inventory management system.<br><br>
                                        You can manually synchronize stock changes, by clicking the assigned button in the magnalister-header, next left to the ant-logo.<br><br>
                                        Additionally, you can synchronize stock changes, by setting a own cronjob to your following shop-link:<br>
                                        <i>http://www.YourShop.com/magnaCallback.php?do=SyncInventory</i><br><br>
                                        Setting an own cronjob is permitted for customers within the service plan "Flat", only.<br><br>
                                        Own cronjob-calls, exceeding a quarter of an hour, or calls from customers, who are not within the service plan "Flat", will be blocked.                                             
                                <dt>Order / stock quantity reduction</dt>
                                    <dd>If the stock is decreased to 0 by an Order in the shop, or by by editing the item in shop, the resp. eBay auction is deleted.
                                    <br>Changes within the database only (e.g. by an inventory management system), will <b>not</b> be captured and submitted!</dd>
                            </dl><br>
                            <b>Notice:</b> <ul><li>As soon as Bids have been made for an Auction, it cannot be deleted.</li></ul>';
MLI18n::gi()->{'ebay_config_sync__field__chinese.stocksync.frommarketplace__label'} = 'Stock Sync from Marketplace';
MLI18n::gi()->{'ebay_config_sync__field__chinese.stocksync.frommarketplace__help'} = 'For example, if an item is purchased three times on eBay, the Shop inventory will be reduced by 3.';
MLI18n::gi()->{'ebay_config_sync__field__chinese.inventorysync.price__label'} = 'Item Price';
MLI18n::gi()->{'ebay_config_sync__field__chinese.inventorysync.price__help'} = '<dl>
                                <dt>Automatic Synchronisation by CronJob</dt>
                                    <dd>The function "Automatic Synchronisation by CronJob" equalizes the current _#_platformName_#_-price with the shop-price every 4 hours (starts at 0 pm).<br /><br />
                                        By this procedure, the database values are checked for changes. The new data will be submitted, also when the changes had been set
                                        by an inventory management system.<br/><br/>
                                        You can manually synchronize price changes, by clicking the assigned button in the magnalister-header, next left to the ant-logo.<br/><br/>
                                        Additionally, you can synchronize price changes, by setting a own cronjob to your following shop-link:<br/>
                                        <i>http://www.YourShop.com/magnaCallback.php?do=SyncInventory</i><br/><br/>
                                        Setting an own cronjob is permitted for customers within the service plan "Flat", only.<br/><br/>
                                        Own cronjob-calls, exceeding a quarter of an hour, or calls from customers, who are not within the service plan "Flat", will be blocked.                                             
                            </dl><br/>
                            <b>Notices:</b><ul><li>Settings in "Configuration" &rarr; "Price Calculation" will be provided.</li>
                            <li>As soon as Bids have been made for an Auction, no changes are alowed.</li></ul>';
MLI18n::gi()->{'ebay_config_orderimport__legend__importactive'} = 'Order Import';
MLI18n::gi()->{'ebay_config_orderimport__legend__mwst'} = 'VAT';
MLI18n::gi()->{'ebay_config_orderimport__legend__orderupdate__title'} = 'Order Status Synchronization';
MLI18n::gi()->{'ebay_config_orderimport__legend__orderupdate__info'} = '';
MLI18n::gi()->{'ebay_config_orderimport__legend__orderstatus'} = 'Order Status Synchronization between Shop and eBay';
MLI18n::gi()->{'ebay_config_orderimport__legend__orderrefund'} = 'eBay Managed Payments: Initiate order refund';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.shipped__label'} = 'Confirm Shipping With';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.shipped__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.shipped__help'} = 'Please set the Shop Status that should trigger the \'Shipping Confirmed\' status on eBay.';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.canceled__label'} = 'Undo Confirm Shipment when';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.canceled__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.canceled__help'} = 'Set the state of the order in your shop, which shall undo the  &apos;sent&apos; state on eBay. <br/><br/>
                           Note: This only means that the order state on eBay is no longer &apos;sent&apos;. It doesn&apos;t mean that the order is cancelled.';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.cancelled__label'} = 'Undo Confirm Shipment with';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.cancelled__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.cancelled__help'} = 'Please set the Shop Status that should withdraw the Sent status on eBay.<br/><br/>

Note: Part cancellations are not possible with the eBay API. This function will cancel the complete order and refund the buyer.';
MLI18n::gi()->{'ebay_config_orderimport__field__importonlypaid__label'} = 'Import Only „Paid“-marked Orders';
MLI18n::gi()->{'ebay_config_orderimport__field__importonlypaid__help'} = '<p>By activating this function, orders from eBay are only being imported, when they are marked on eBay as „Paid“ .
In case of PayPal orders, this happens automatically. In case of money transfer, the order must be set on eBay as „Paid“ accordingly.
</p><p>
<strong>Benefit:</strong>
The imported order is not changeable any more, since it is completed.
Data like shipping address and shipping costs are being submitted from 1:1 as ordered. Surveillance of changes and updating in the online store is not necessary anymore.</p>';
MLI18n::gi()->{'ebay_config_orderimport__field__importonlypaid__alert'} = '<p>By activating this function, orders from eBay are only being imported, when they are marked on eBay as „Paid“ .
In case of PayPal orders, this happens automatically. In case of money transfer, the order must be set on eBay as „Paid“ accordingly.
</p><p>
<strong>Benefit:</strong>
The imported order is not changeable any more, since it is completed.
Data like shipping address and shipping costs are being submitted from 1:1 as ordered. Surveillance of changes and updating in the online store is not necessary anymore.</p>';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.closed__label'} = 'End Order Summary***';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.closed__help'} = 'If an order is set to one of the chosen order statuses, new orders from this customer will not be added to this.<br />
If you do not want an order summary, please select every status.***';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.blacklisting__label'} = 'Suppress eBay Shipping Notification';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.blacklisting__valuehint'} = 'Blacklist eBay\'s customer e-mail address';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.blacklisting__help'} = '
<b>Avoid Shipping Notifications to eBay Buyers</b><br />
<br />
The option “Blacklist eBay\'s customer e-mail address” is used to suppress e-mails that are sent from the shopping system (for orders imported via magnalister). This means that they will not reach the eBay buyer.<br />
<br />
Important notes:
<ul>
    <li>Blacklisting is deactivated by default. If activated, you will receive a mailer daemon (information from the mail server that the email could not be delivered) the moment the shopping system sends an email to the eBay buyer.<br /><br /></li>
    <li>magnalister only puts the prefix "blacklisted-" in front of the eBay e-mail address (e.g. blacklisted-12345@eBay.de). If you still want to contact the eBay buyer, simply remove the prefix "blacklisted-".</li>
</ul>
';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.paymentmethod__label'} = 'Payment Methods';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.paymentmethod__help'} = '<p>Payment method that will apply to all orders imported from eBay. Standard: “Automatic Allocation”</p>
<p>
If you choose “Automatic Allocation”, magnalister will accept the payment method chosen by the buyer on eBay.</p>
<p>
Additional payment methods can be added to the list via Shopware > Settings > Payment Methods, then activated here.</p>
<p>
This setting is necessary for the invoice and shipping notice, and for editing orders later in the Shop or via ERP.</p>';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.paymentmethod__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.shippingmethod__label'} = 'Shipping Service of the Orders';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.shippingmethod__help'} = 'Shipping method that will apply to all orders imported from eBay. Standard: “Marketplace”<br><br>
This setting is necessary for the invoice and shipping notice, and for editing orders later in the Shop or via ERP.';
MLI18n::gi()->{'ebay_config_orderimport__field__orderimport.shippingmethod__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__mwstfallback__label'} = 'VAT on Non-Shop*** Items';
MLI18n::gi()->{'ebay_config_orderimport__field__mwstfallback__hint'} = 'The tax rate to apply to non-Shop items on order imports, in %.';
MLI18n::gi()->{'ebay_config_orderimport__field__mwstfallback__help'} = 'If an item is not entered via magnalister, the VAT cannot be calculated. <br />
The percentage value entered here will be taken as the VAT rate for all orders imported to eBay.';
MLI18n::gi()->{'ebay_config_orderimport__field__importactive__label'} = 'Activate Import';
MLI18n::gi()->{'ebay_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__importactive__help'} = 'Import orders from the Marketplace? <br/><br/>When activated, orders will be automatically imported every hour.<br><br>
Manual import can be activated by clicking the corresponding button in the magnalister header (left of the shopping cart).<br><br>Additionally, you can activate the stock comparison through CronJon (flat tariff*** - maximum every 4 hours) with the link:<br>
            <i>{#setting:sImportOrdersUrl#}</i><br>
Some CronJob requests may be blocked, if they are made through customers not on the flat tariff*** or if the request is made more than once every 4 hours. ';
MLI18n::gi()->{'ebay_config_orderimport__field__updateableorderstatus__label'} = 'Update Order Status When';
MLI18n::gi()->{'ebay_config_orderimport__field__updateableorderstatus__help'} = 'Order statuses that can be triggered by eBay payments. 
If the order has a different status, this cannot be changed by an eBay payment.<br /><br />
If you don\'t wish any status changes based on eBay payment, please deactivate the checkbox.<br /><br />
<b>Please note:</b>The status of summarised orders will only be changed when paid in full.';
MLI18n::gi()->{'ebay_config_orderimport__field__updateable.orderstatus__label'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__updateable.orderstatus__help'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__update.orderstatus__label'} = 'Activate Status Update';
MLI18n::gi()->{'ebay_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__import__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__preimport.start__label'} = 'Start import from';
MLI18n::gi()->{'ebay_config_orderimport__field__preimport.start__hint'} = 'Start time';
MLI18n::gi()->{'ebay_config_orderimport__field__preimport.start__help'} = 'The date from which orders will start being imported. Please note that it is not possible to set this too far in the past, as the data only remains available on eBay for a few weeks.***';
MLI18n::gi()->{'ebay_config_orderimport__field__customergroup__label'} = 'Customer Group';
MLI18n::gi()->{'ebay_config_orderimport__field__customergroup__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__customergroup__help'} = 'The customer group that customers from new orders should be sorted into.';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.open__label'} = 'Order Status in Shop';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.open__help'} = 'In your online store this info determines the order status that is automatically assigned to every new order that arrives from eBay.
<br><br>
Please note that both paid and unpaid eBay orders are imported.
<br><br>
However, when using the function "Import only „Paid“-marked orders", you can choose to import only paid eBay orders into your online store.
<br><br>
For paid eBay orders, you can set your own order status a little bit further down, under "Order Status Synchronization" > "Order Status for Paid eBay Orders".
<br><br>
<b>Note for your dunning process:</b>
<br><br>
If you are using an inventory management and/or invoicing tool connected to your online store, it is recommended to adjust the order status so that your inventory  management/invoicing tool can process the order according to your business process.';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.paid__label'} = 'Order Status For Paid eBay Orders';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.paid__help'} = 'Sometimes eBay orders are paid by the customer with delay.
<br><br>
In order to separate unpaid orders from paid orders, you can choose your own online store order status for paid eBay orders.
<br><br>
If orders imported from eBay have not yet been paid, the order status you defined above under "Order Import" > "Order Status in Shop" will be applied.
<br><br>
If above you have activated  "Import only „Paid“-marked orders", the "Order status in the Shop" from above will also be used. The feature is then grayed out.
';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.carrier.default__label'} = 'Carrier';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.carrier.default__help'} = 'Preselected carriers available in Confirm Shipping on eBay';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.refund__label'} = 'Initiate refund with';
MLI18n::gi()->{'ebay_config_orderimport__field__orderstatus.refund__help'} = '
<p>With this function you can initiate a refund for imported eBay orders. The requirement for this is participating in „eBay Managed Payments”.</p>

<p>For each refund reason given by eBay you can define a webshop order status ("+" button) and assign a comment. This comment will be sent to the buyer and eBay.</p>
<p>
<strong>“Shop order status”</strong><br>
Select an order status from your web shop that will initiate a refund to the buyer.
</p>
<p>
<strong>“Reason for refund”</strong><br>
Select a refund reason given by eBay here.
“Remarks for the refund”
</p><p>
					
Enter a comment, which is transmitted together with the refund to the buyer and eBay.
</p>
<p>

<strong>Important notes:</strong><br>
<ul>
<li>
Most shop systems are not able to split one order into multiple items and provide the correct refund amounts. Therefore partial refunds cannot be processed via magnalister.
</li><li>
Solution: A partial refund should be made directly in the eBay Seller Hub. You can find a direct link to your order in the eBay Seller Hub in the magnalister order details.
</li>
</ul>
</p>';



MLI18n::gi()->{'ebay_config_orderimport__field__refundstatus__firstoption'} = array('--' => 'Select an option ...')  ;
MLI18n::gi()->{'ebay_config_orderimport__field__refundstatus__label'} = 'Shop order status';
MLI18n::gi()->{'ebay_config_orderimport__field__refundreason__label'} = 'Reason for refund';
MLI18n::gi()->{'ebay_config_orderimport__field__refundcomment__label'} = 'Remarks for the refund';
MLI18n::gi()->{'ebay_config_emailtemplate__legend__mail'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.send__label'} = '{#i18n:configform_emailtemplate_field_send_label#}';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.send__help'} = '{#i18n:configform_emailtemplate_field_send_help#}';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.originator.name__label'} = 'Sender Name';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.originator.adress__label'} = 'Sender E-Mail Address';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.subject__label'} = 'Subject';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.content__label'} = 'E-Mail Content';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.content__hint'} = 'List of available placeholders for Subject and Content:
<dl>
                <dt>#MARKETPLACEORDERID#</dt>
                        <dd>Marketplace Order Id</dd>
                <dt>#FIRSTNAME#</dt>
                        <dd>Buyer\'s first name</dd>
                <dt>#LASTNAME#</dt>
                        <dd>Buyer\'s last name</dd>
                <dt>#EMAIL#</dt>
                        <dd>Buyer\'s email address</dd>
                <dt>#PASSWORD#</dt>
                        <dd>Buyer\'s password for logging into your Shop. Only for customers that are automatically assigned passwords – otherwise the placeholder will be replaced with ‘(as known)’***.</dd>
                <dt>#ORDERSUMMARY#</dt>
                        <dd>Summary of the purchased items. Should be written on a separate line. <br/><i>Cannot be used in the Subject!</i></dd>
                <dt>#ORIGINATOR#</dt>
                        <dd>Sender name</dd>
        </dl>';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.copy__label'} = 'Copy to Sender';
MLI18n::gi()->{'ebay_config_emailtemplate__field__mail.copy__help'} = 'A copy will be sent to the sender email address.';
MLI18n::gi()->{'ebay_config_producttemplate__legend__product__title'} = 'Product Template';
MLI18n::gi()->{'ebay_config_producttemplate__legend__product__info'} = 'Template for Product Description on eBay. (You can change the Editor under \'Global Configurations\' > \'Expert Settings\'.)***';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.name__label'} = 'Product Name Template ';
// For shopify this help is overwritten, if you change something here, also change it in 60_ShopModule_Shopify/ShopifyEbay/I18n/En/configForm.php
MLI18n::gi()->{'ebay_config_producttemplate__field__template.name__help'} = '<dl>
                            <dt>Name of the product on eBay</dt>
                             <dd>Decide how to name the product on eBay.
                                 The placeholder <b>#TITLE#</b> will be replaced by the shop\'s product name,
                                 <b>#BASEPRICE#</b> by the price per unit, provided the data exists in the shop.</dd>
                            <dt>Please note:</dt>
                             <dd>The placeholder <b>#BASEPRICE#</b> is mostly not needed, as we submit base prices automatically to eBay, if filled in the Shop and allowed for the eBay category.</dd>
                             <dd>Use this placeholder, if you have non-metric Units (which eBay doesn\'t provide), or if you want to display base prices also in categories where eBay doesn\'t provide it.</dd>
                             <dd>If you use this placeholder, please <b>disable the price synchronization</b>. The Item Title cannot be changed on eBay, and therefore, when the price changes, the base price within the title would no longer conform to it.</dd>
                             <dd><b>#BASEPRICE#</b> is replaced while uploading the product to eBay.</dd>
<dd>eBay cannot handle <b>different base prices for Variations</b>. Therefore, we add it to the Variation titles.</dd>
<dd>Example:
<br />&nbsp;Variation group: fill quantity<ul>
<li>Variation: 0,33 l (3 EUR / l)</li>
<li>Variation: 0.5 l (2.50 EUR / l)</li>
<li>etc.</li></ul></dd>
<dd>In this case, please <b>disable the price synchronization</b> (because the Variation titles cannot be changed on eBay).</dd>
                            </dl>';
// For shopify this hint is overwritten, if you change something here, also change it in 60_ShopModule_Shopify/ShopifyEbay/I18n/En/configForm.php
MLI18n::gi()->{'ebay_config_producttemplate__field__template.name__hint'} = 'Placeholder: #TITLE# - Product name; #BASEPRICE# - Baseprice';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.mobile.active__label'} = 'Activate Mobile Template';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.mobile.active__help'} = '';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.mobile.active__hint'} = '<a href="http://pages.ebay.com/sell/itemdescription/customizeyoursummary.html" target="_blank">Further information about Mobile Descriptions on eBay</a>';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.mobile.active__alert'} = '<div title="Caution">The mobile description summary is shown also within the main description. With the placeholder #MOBILEDESCRIPTION# you can specify, at which place it will be shown.<br/><br/>Please don&apos;t use the same placeholders in the main description and the mobile description. Otherwise we filter out these placeholders from the main description, to omit double content.</div>';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.mobile.content__label'} = 'Mobile Template';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.mobile.content__hint'} = '                Available placeholders for the Mobile Item Description:
                <dl>
                    <dt>#TITLE#</dt><dd>Product name (title)</dd>
                    <dt>#ARTNR#</dt><dd>Articla number from the shop</dd>
                    <dt>#PID#</dt><dd>Products ID</dd>
                    <dt>#SHORTDESCRIPTION#</dt><dd>Short Description from Shop</dd>
                    <dt>#DESCRIPTION#</dt><dd>Description from Shop</dd>
                    <dt>#WEIGHT#</dt><dd>Product Weight</dd>
                </dl>
            ';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.mobile.content__hint2'} = '<span>Notes</span><span style="color: #000;" >:</span><ul><li>No HTML is allowed, except lists and linebreaks. Other HTML elements will be filtered out. The allowed length is up to 800 characters.</li>
                                        <li>The short description for mobile will be displayed inside the main description. Please omit the usage of the same placeholders in both, otherwise we will filter out the concerned placeholders from the main description, to prevent double content.</li></ul>';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.content__label'} = 'Product Description Template';
MLI18n::gi()->{'ebay_config_producttemplate__field__template.content__hint'} = 'List of available placeholders for Content:
<dl>
    <dt>#TITLE#</dt>
            <dd>Product Name (Title)</dd>
    <dt>#ARTNR#</dt>
            <dd>Item Number in Shop</dd>
    <dt>#PID#</dt>
            <dd>Product ID in Shop</dd>
    <!--<dt>#PRICE#</dt>
            <dd>Price</dd>
    <dt>#VPE#</dt>
            <dd>Price per packing unit</dd>-->
    <dt>#SHORTDESCRIPTION#</dt>
            <dd>Short description from the Shop</dd>
    <dt>#DESCRIPTION#</dt>
            <dd>Description from the Shop</dd>
    <dt>#MOBILEDESCRIPTION#</dt>
            <dd>Short description for mobile devices (if defined)</dd>
    <dt>#PICTURE1#</dt>
            <dd>First product image</dd>
    <dt>#PICTURE2# etc.</dt>
            <dd>Second product image; with #PICTURE3#, #PICTURE4# etc, you can transfer as many pictures as you have available in your Shop.</dd></dl>';
