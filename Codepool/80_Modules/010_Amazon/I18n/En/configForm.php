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

MLI18n::gi()->amazon_config_carrier_other = 'Other';
MLI18n::gi()->{'amazon_config_general_mwstoken_help'} = 'Amazon requires authentication to transfer data via magnalister. Once you have successfully requested your Token, this value will be auto-populated.<br>
<br>';
MLI18n::gi()->{'amazon_config_general_autosync'} = 'Automatic synchronization with CronJob (recommended)';
MLI18n::gi()->{'amazon_config_general_nosync'} = 'No synchronization';
MLI18n::gi()->{'amazon_config_account_title'} = 'Login Details';
MLI18n::gi()->{'amazon_config_account_prepare'} = 'Item Preparation';
MLI18n::gi()->{'amazon_config_account_price'} = 'Price Calculation';
MLI18n::gi()->{'amazon_configform_orderstatus_sync_values__auto'} = '{#i18n:amazon_config_general_autosync#}';
MLI18n::gi()->{'amazon_configform_orderstatus_sync_values__no'} = '{#i18n:amazon_config_general_nosync#}';
MLI18n::gi()->{'amazon_configform_sync_values__auto'} = '{#i18n:amazon_config_general_autosync#}';
MLI18n::gi()->{'amazon_configform_sync_values__no'} = '{#i18n:amazon_config_general_nosync#}';
MLI18n::gi()->{'amazon_configform_stocksync_values__rel'} = 'Orders (except for FBA orders) reduce Shop inventory (recommended)';
MLI18n::gi()->{'amazon_configform_stocksync_values__fba'} = 'Orders (including FBA orders) reduce Shop inventory';
MLI18n::gi()->{'amazon_configform_stocksync_values__no'} = '{#i18n:amazon_config_general_nosync#}';
MLI18n::gi()->{'amazon_configform_pricesync_values__auto'} = '{#i18n:amazon_config_general_autosync#}';
MLI18n::gi()->{'amazon_configform_pricesync_values__no'} = '{#i18n:amazon_config_general_nosync#}';
MLI18n::gi()->{'amazon_configform_orderimport_payment_values__textfield__title'} = 'From textfield';
MLI18n::gi()->{'amazon_configform_orderimport_payment_values__textfield__textoption'} = '1';
MLI18n::gi()->{'amazon_configform_orderimport_payment_values__Amazon__title'} = 'Amazon';
MLI18n::gi()->{'amazon_configform_orderimport_shipping_values__textfield__title'} = 'From textfield';
MLI18n::gi()->{'amazon_configform_orderimport_shipping_values__textfield__textoption'} = '1';
MLI18n::gi()->{'amazon_config_account_sync'} = 'Synchronization';
MLI18n::gi()->{'amazon_config_account_orderimport'} = 'Order Import';
MLI18n::gi()->{'amazon_config_account_emailtemplate'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'amazon_config_account_shippinglabel'} = 'Buy Shipping Services';
MLI18n::gi()->{'amazon_config_account_vcs'} = 'Invoices | VCS';
MLI18n::gi()->{'amazon_config_account_bopis'} = 'Click & Collect in store';
MLI18n::gi()->{'amazon_config_account_emailtemplate_sender'} = 'Example Shop';
MLI18n::gi()->{'amazon_config_account_emailtemplate_sender_email'} = 'example@onlineshop.com';
MLI18n::gi()->{'amazon_config_account_emailtemplate_subject'} = 'Your Order from #SHOPURL#';
MLI18n::gi()->{'amazon_config_account_emailtemplate_content'} = ' <style><!--
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

MLI18n::gi()->{'amazon_config_amazonvcsinvoice_invoicenumberoption_values_magnalister'} = 'Create invoice numbers via magnalister';
MLI18n::gi()->{'amazon_config_amazonvcsinvoice_reversalinvoicenumberoption_values_magnalister'} = 'Create reversal invoice numbers via magnalister';

MLI18n::gi()->{'amazon_config_tier_error'} = 'Configuration for B2B Quantity Discount Tier {#TierNumber#} is not valid!';

MLI18n::gi()->{'amazon_config_how_to_authorize_magnalister_header'} = 'Authorize magnalister for Amazon';
MLI18n::gi()->{'amazon_config_how_to_authorize_magnalister_body'} = '
    To use magnalister in conjunction with Amazon your consent is required.<br />
    <br />
    By authorizing magnalister in your Seller Central portal, you allow us to interact with your Amazon store. 
    Specifically, this means: retrieve orders, upload products, synchronize inventory and much more.
    <br />
    <br />
    To authorize magnalister, please perform the following steps:<br />
    <ol>
        <li>After you select the Amazon site and click Request Token, a window to Amazon will open right after this hint window. Please log in there.</li>
        <li>Follow the instructions on Amazon itself and complete Authorization.</li>
        <li>Click afterwards on "Continue to article preparation"</li>.
    </ol>
    <br />
    <strong>Important:</strong> After you have applied for your token, you are not allowed to change their Amazon site. Should you mistakenly a 
    wrong Amazon Site and have already applied for your token, please select the correct site and apply for a new token.<br />
    <br />
    <strong>Note:</strong> magnalister can process non-personal data transmitted to and from Amazon for internal statistical purposes.
';

MLI18n::gi()->{'amazon_config_account__legend__account'} = 'Login Details';
MLI18n::gi()->{'amazon_config_account__legend__tabident'} = 'Tab';
MLI18n::gi()->{'amazon_config_account__field__tabident__label'} = '{#i18n:ML_LABEL_TAB_IDENT#}';
MLI18n::gi()->{'amazon_config_account__field__tabident__help'} = '{#i18n:ML_TEXT_TAB_IDENT#}';
MLI18n::gi()->{'amazon_config_account__field__username__label'} = 'Seller Central E-Mail Address';
MLI18n::gi()->{'amazon_config_account__field__username__hint'} = '';
MLI18n::gi()->{'amazon_config_account__field__password__label'} = 'Seller Central Password';
MLI18n::gi()->{'amazon_config_account__field__password__help'} = 'Enter your current Amazon password in order to log into your Seller Central account.';
MLI18n::gi()->{'amazon_config_account__field__mwstoken__label'} = 'MWS Token';
MLI18n::gi()->{'amazon_config_account__field__mwstoken__help'} = '{#i18n:amazon_config_general_mwstoken_help#}';
MLI18n::gi()->{'amazon_config_account__field__spapitoken__label'} = 'SP-API Token';
MLI18n::gi()->{'amazon_config_account__field__spapitoken__help'} = 'To request a new Amazon token, please click the button.<br>
                        If no window to Amazon pops up when you click the button, you may have a pop-up blocker active.<br><br>
                        The token is necessary to post and manage items on Amazon through electronic interfaces such as the magnalister.<br>
                        From then on, follow the instructions on the Amazon page to apply for the token and connect your online store to Amazon via magnalister.';
MLI18n::gi()->{'amazon_config_account__field__merchantid__label'} = 'Merchant ID';
MLI18n::gi()->{'amazon_config_account__field__merchantid__help'} = '{#i18n:amazon_config_general_mwstoken_help#}';
MLI18n::gi()->{'amazon_config_account__field__marketplaceid__label'} = 'Marketplace ID';
MLI18n::gi()->{'amazon_config_account__field__marketplaceid__help'} = '{#i18n:amazon_config_general_mwstoken_help#}';
MLI18n::gi()->{'amazon_config_account__field__site__label'} = 'Amazon Site';
MLI18n::gi()->{'amazon_config_prepare__legend__prepare'} = 'Prepare Items';
MLI18n::gi()->{'amazon_config_prepare__legend__machingbehavior'} = 'Matching Behaviour';
MLI18n::gi()->{'amazon_config_prepare__legend__apply'} = 'Create New Products';
MLI18n::gi()->{'amazon_config_prepare__legend__shipping'} = 'Shipping';
MLI18n::gi()->{'amazon_config_prepare__legend__upload'} = 'Upload Items: Presets ';
MLI18n::gi()->{'amazon_config_prepare__legend__shippingtemplate'} = 'Seller Shipping Groups';
MLI18n::gi()->{'amazon_config_prepare__field__itemcondition__label'} = 'Item Condition';
MLI18n::gi()->{'amazon_config_prepare__field__prepare.status__label'} = 'Status Filter';
MLI18n::gi()->{'amazon_config_prepare__field__prepare.status__valuehint'} = 'Only show active items';
MLI18n::gi()->{'amazon_config_prepare__field__checkin.status__label'} = 'Status Filter';
MLI18n::gi()->{'amazon_config_prepare__field__checkin.status__valuehint'} = 'Only show active items';
MLI18n::gi()->{'amazon_config_prepare__field__lang__label'} = 'Item Description';
MLI18n::gi()->{'amazon_config_prepare__field__internationalshipping__label'} = 'International Shipping';
MLI18n::gi()->{'amazon_config_prepare__field__internationalshipping__hint'} = 'If the Seller Shipping Groups are enabled, this setting is ignored.';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching__label'} = 'Match New';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching__valuehint'} = 'Overwrite products already matched by multi- and automatching. ';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching__help'} = 'By activating this, already matched products will be overwritten by new matching ***';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching.itemsperpage__label'} = 'Results';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching.itemsperpage__help'} = 'Here you can determine how many products will be shown per page of multimatching. <br/>
A higher number will mean longer loading times (e.g. 50 results will take around 30 seconds). ';
MLI18n::gi()->{'amazon_config_prepare__field__multimatching.itemsperpage__hint'} = 'per page of multimatching';
MLI18n::gi()->{'amazon_config_prepare__field__prepare.manufacturerfallback__label'} = 'Alternative Manufacturer';
MLI18n::gi()->{'amazon_config_prepare__field__prepare.manufacturerfallback__help'} = 'If a product has no manufacturer assigned, the alternative manufacturer will be used here.<br />
You can also match the general \'Manufacturer\' to your attributes under \'Global Configurations\' > \'Product Attributes\'. ';
MLI18n::gi()->{'amazon_config_prepare__field__quantity__label'} = 'Inventory Item Count';
MLI18n::gi()->{'amazon_config_prepare__field__quantity__help'} = 'Please enter how much of the inventory should be available on the marketplace.<br/>
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
MLI18n::gi()->{'amazon_config_prepare__field__maxquantity__label'} = 'Limitation for Number of Items';
MLI18n::gi()->{'amazon_config_prepare__field__maxquantity__help'} = 'Here you can limitate the number of items published on Amazon.<br /><br />
<strong>Example:</strong>
For “number of items” you select “take inventory from shop” and enter “20” in this field. While upload number of items will be taken from available inventory but not more then 20. The inventory synchronisation (if activated) will adapt the Amazon-number of items to the shop-inventory as long as the shop-inventory is less then 20. If there are more then 20 items in the inventory, the Amazon number of items is set to 20.<br /><br />
Please insert “0” or let this field blank if you do not want a limitation.<br /><br />
<strong>Hint:</strong>
If the “number of items” option is “global (from the right field)”, limitation has no effect.
';
MLI18n::gi()->{'amazon_config_prepare__field__leadtimetoship__label'} = 'Handling time (in days)';
MLI18n::gi()->{'amazon_config_prepare__field__leadtimetoship__help'} = 'The elapsed time between when the buyer places the order until you hand the order over to your carrier.<br>If no value is entered, the handling time will be set at 1-2 working days. Use this field if the handling time is more that 2 working days.';
MLI18n::gi()->{'amazon_config_prepare__field__checkin.skuasmfrpartno__label'} = 'Manufacturer-Part-Number';
MLI18n::gi()->{'amazon_config_prepare__field__checkin.skuasmfrpartno__help'} = 'SKU will be used as Manufacturer-Part-Number.';
MLI18n::gi()->{'amazon_config_prepare__field__checkin.skuasmfrpartno__valuehint'} = 'Use the SKU as Manufacturer-Part-Number';
MLI18n::gi()->{'amazon_config_prepare__field__imagesize__label'} = 'Image Size';
MLI18n::gi()->{'amazon_config_prepare__field__imagesize__help'} = '<p>Please enter the pixel width for the image as should appear on the Marketplace. The height will be automatically matched based on the original aspect ratio.</p>
<p>The source files will be processed from the image folder {#setting:sSourceImagePath#}, and will be stored in the folder {#setting:sImagePath#} with the selected pixel width for use on the Marketplace.</p>';
MLI18n::gi()->{'amazon_config_prepare__field__imagesize__hint'} = 'Saved under {#setting:sImagePath#}';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template.active__label'} = 'Use Amazon Shipping Templates';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template.active__help'} = 'Seller can generate templates with different shipping services / methods specially for personal commercial needs and use cases. Different templates of shipping methods with different shipping conditions and shipping fees can be chosen for different regions. 

If a seller generates an offer out of his products, he has to choose one of his shipping templates for the product. That shipping procedure of this template is then used to show the shipping option for the product on the website.';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template__label'} = 'Seller Shipping Templates';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template__hint'} = 'A specific shipping procedures group that will be set for a seller specific offer. The Seller Shipping Group is generated and administered by the seller in the user interface for shipping services.';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template__help'} = 'Seller can generate groups with different shipping services / methods specially for personal commercial needs and use cases. Different groups of shipping methods with different shipping conditions and shipping fees can be chosen for different regions. 

If a seller generates an offer out of his products, he has to choose one of his shipping condition groups for the product. That shipping procedure of this template is then used to show the shipping option for the product on the website.';
MLI18n::gi()->{'amazon_config_prepare__field__shipping.template.name__label'} = 'Seller Shipping Template Name';
MLI18n::gi()->{'amazon_config_price__field__b2bactive__label'} = 'Using Amazon B2B';
MLI18n::gi()->{'amazon_config_price__field__b2bactive__help'} = '
<p>As an Amazon seller, you can enhance your Amazon account by adding business functionalities. This enables you to market your products to both individual consumers and business clients (with displayed tax rates).</p>
<p>To avail of these features, your account must be enabled for "Amazon Business". You can enable this feature through your Amazon Seller Central account.</p>
<p>Please note that <strong>having an enabled Amazon Business account and the activation here are essential prerequisites</strong> for utilizing the capabilities described below. Moreover, you must be registered as a "Professional Seller" with Amazon.</p>
<p>Additional Information:</p>
<ul>
<li>You can find guidance on importing Amazon B2B orders by clicking on the info icon under "Order Import" -&gt; "Activate Import".<br><br></li>
<li>The settings described below are intended for the global configuration of your Amazon B2B setup. You may make adjustments at the product level later during the item preparation phase.</li>
</ul>';
MLI18n::gi()->{'amazon_config_price__field__b2bactive__notification'} = '
<p>In order to use Amazon Business features you need to have your Amazon account activated for this. 
<b>Please make sure that your account is enabled for Amazon Business services.</b> 
Otherwise, you might experience errors during upload if this option is enabled.</p>
<p>To upgrade your account, please follow instructions on <a href="https://sellercentral.amazon.de/business/b2bregistration" target="_blank">this page</a>.</p>';
MLI18n::gi()->{'amazon_config_price__field__b2bactive__values__true'} = '{#i18n:ML_BUTTON_LABEL_YES#}';
MLI18n::gi()->{'amazon_config_price__field__b2bactive__values__false'} = '{#i18n:ML_BUTTON_LABEL_NO#}';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code__label'} = 'Business Tax Class Matching';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code__help'} = '
<p>Align the tax rates configured in your shop system with those prescribed by Amazon Business. This ensures that the correct sales tax rates are displayed to Amazon buyers during the checkout process. Additionally, this tax class matching allows for the generation of accurate sales tax invoices, which can then be provided to B2B buyers.</p>
<p>The tax rates from your shop system are shown in the left column. To carry out the matching, select the appropriate Amazon tax rate from the dropdown menus in the right column.</p>
<p>For an explanation of the tax rates set by Amazon, refer to the help section in Amazon Seller Central under "Sales Tax Rates and Product Tax Codes."</p>
<p><strong>Note</strong>: You can also configure tax matchings at the category level in the next menu item, which will override the settings made here.</p>
';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code__matching__titlesrc'} = 'Shop Tax Classes';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code__matching__titledst'} = 'Amazon Business Tax Codes';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_container__label'} = 'Business Tax Class Matching - for Amazon Categories';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_container__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_container__help'} = '
<p>In this section, you can align your shop\'s tax rates with Amazon Business tax rates based on specific Amazon categories, such as "Hardware" or "Clothing." Use the "+" icon to add multiple categories as needed.</p>
<p><strong>Important Note</strong>: Tax rates matched on a category basis will take precedence over any tax rates individually matched in the previous settings.</p>
';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_specific__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_specific__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_specific__matching__titlesrc'} = 'Shop Tax Classes';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_specific__matching__titledst'} = 'Amazon Business Tax Classes';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_category__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.tax_code_category__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2bsellto__label'} = 'Sales Options';
MLI18n::gi()->{'amazon_config_price__field__b2bsellto__help'} = '
<p>You have the following choices:</p>
<ul>
<li><strong>B2B and B2C</strong>: Products uploaded via magnalister are visible on Amazon to both business-to-business (B2B) and business-to-consumer (B2C) buyers.<br><br></li>
<li><strong>B2B only</strong>: Products uploaded via magnalister are visible on Amazon solely to B2B buyers.</li>
</ul>
<p><strong>Note</strong>: During the product preparation process, you can adjust these settings at the individual product level.</p>
';
MLI18n::gi()->{'amazon_config_price__field__b2bsellto__values__b2b_b2c'} = 'B2B and B2C';
MLI18n::gi()->{'amazon_config_price__field__b2bsellto__values__b2b_only'} = 'B2B only';
MLI18n::gi()->{'amazon_config_price__field__b2b.price__label'} = 'Business Price';
MLI18n::gi()->{'amazon_config_price__field__b2b.price__help'} = '
<p>In this section, you can specify either a percentage-based or a fixed increase or decrease to the "Business Price" that appears on Amazon, which is displayed exclusively to B2B customers.</p>
<p>Furthermore, you have the option to customize the decimal places for the Business Price. For example, you can enter "99" in the designated field to ensure that all Amazon Business prices end with ".99" (e.g., &euro;2.99).</p>
';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.addkind__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.addkind__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.factor__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.factor__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.signal__label'} = 'Decimal Amount';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.signal__hint'} = 'Decimal Amount';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.signal__help'} = 'This textfield shows the decimal value that will appear in the item price on Amazon.<br/><br/>
        <strong>Example:</strong> <br>
        Value in textfeld: 99 <br>
        Original price: 5.58 <br>
        Final amount: 5.99 <br><br>
        This function is useful when marking the price up or down***. <br>
        Leave this field empty if you do not wish to set any decimal amount. <br>
        The format requires a maximum of 2 numbers.';
MLI18n::gi()->{'amazon_config_price__field__b2b.priceoptions__label'} = 'Business Price Options';
MLI18n::gi()->{'amazon_config_price__field__b2b.priceoptions__help'} = '
<p>In this section, you can set Business prices according to customer groups defined in your shop. For instance, if you have established a customer group like "Shop Customers" for an item, the prices associated with this group will be adopted and synchronized. If you want the special prices that are attached to a product to be transmitted to Amazon, make sure to select the option "Also Use Special Prices."</p>
';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.group__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.group__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__b2b.price.usespecialoffer__label'} = 'Use special offer prices';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttype__label'} = 'Tiered Pricing Calculation';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttype__help'} = '
<p>Tiered pricing offers discounted rates to business customers purchasing in bulk. Sellers who are part of the Amazon Business Seller Program can set specific minimum quantities ("Quantity") and associated discounts ("Discount").</p>
<p>In the "Tiered Pricing Calculation" section, you have the following options:</p>
<ul>
    <li><strong>Do Not Use</strong>: This option deactivates the Amazon Business tiered pricing feature.<br><br></li>
    <li><strong>Percentage</strong>: Apply a percentage-based discount to the established tiered prices (e.g., 10% discount for 100 units, 15% discount for 500 units, etc.).</li>
</ul>
<p>Enter your specific pricing tiers in the fields labeled "Tiered Price Level 1 - 5". Here\'s an example of how to set up <strong>percentage</strong> discounts:</p>
<table>
    <tr>
        <td>Tiered Price Level 1</td>
        <td>Quantity: 100</td>
        <td>Discount: 10</td>
    </tr>
    <tr>
        <td>Tiered Price Level 2</td>
        <td>Quantity: 500</td>
        <td>Discount: 15</td>
    </tr>
    <tr>
        <td>Tiered Price Level 3</td>
        <td>Quantity: 1000</td>
        <td>Discount: 25</td>
    </tr>
</table>
<p><strong>Additional Notes</strong>:&nbsp;</p>
<ul>
    <li>In magnalister product preparation, there\'s another tiered pricing option: "<strong>Fixed</strong>". This feature lets you set fixed price reductions or increases for each product individually (e.g., &euro;10 discount for 100 units, &euro;50 discount for 500 units, etc.).<br><br></li>
    <li>If you need to override the general Amazon Business settings defined for the Amazon Marketplace in the setup of specific products, you can do so during the product preparation phase.</li>
</ul>
';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttype__values__'} = 'Do not use';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttype__values__percent'} = 'Percent';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier1__label'} = 'Quantity Discount Tier 1';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier1__help'} = 'The discount must be greater than 0';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier2__label'} = 'Quantity Discount Tier 2';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier3__label'} = 'Quantity Discount Tier 3';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier4__label'} = 'Quantity Discount Tier 4';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier5__label'} = 'Quantity Discount Tier 5';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier1quantity__label'} = 'Quantity';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier2quantity__label'} = 'Quantity';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier3quantity__label'} = 'Quantity';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier4quantity__label'} = 'Quantity';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier5quantity__label'} = 'Quantity';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier1discount__label'} = 'Discount';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier2discount__label'} = 'Discount';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier3discount__label'} = 'Discount';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier4discount__label'} = 'Discount';
MLI18n::gi()->{'amazon_config_price__field__b2bdiscounttier5discount__label'} = 'Discount';
MLI18n::gi()->{'amazon_config_price__legend__price'} = 'Price Calculation';
MLI18n::gi()->{'amazon_config_price__legend__b2b'} = 'Amazon Business (B2B)';
MLI18n::gi()->{'amazon_config_price__field__price__label'} = 'Price';
MLI18n::gi()->{'amazon_config_price__field__price__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__price__help'} = 'Please enter a price markup or markdown, either in percentage or fixed amount. Use a minus sign (-) before the amount to denote markdown.';
MLI18n::gi()->{'amazon_config_price__field__price.addkind__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.addkind__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.factor__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.factor__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.signal__label'} = 'Decimal Amount';
MLI18n::gi()->{'amazon_config_price__field__price.signal__hint'} = 'Decimal Amount';
MLI18n::gi()->{'amazon_config_price__field__price.signal__help'} = 'This textfield shows the decimal value that will appear in the item price on Amazon.<br/><br/>
                <strong>Example:</strong> <br />
Value in textfeld: 99 <br />
                Original price: 5.58 <br />
                Final amount: 5.99 <br /><br />
This function is useful when marking the price up or down***. <br/>
Leave this field empty if you do not wish to set any decimal amount. <br/>
The format requires a maximum of 2 numbers.
This function is useful when marking the price up or down***. ';
MLI18n::gi()->{'amazon_config_price__field__priceoptions__label'} = 'Price Options';
MLI18n::gi()->{'amazon_config_price__field__priceoptions__help'} = '{#i18n:configform_price_field_priceoptions_help#}';
MLI18n::gi()->{'amazon_config_price__field__priceoptions__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.group__label'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.group__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__price.usespecialoffer__label'} = 'Use special offer prices';
MLI18n::gi()->{'amazon_config_price__field__price.usespecialoffer__hint'} = '';
MLI18n::gi()->{'amazon_config_price__field__exchangerate_update__label'} = 'Exchange Rate';
MLI18n::gi()->{'amazon_config_price__field__exchangerate_update__hint'} = 'Automatically update exchange rate';
MLI18n::gi()->{'amazon_config_price__field__exchangerate_update__help'} = '{#i18n:form_config_orderimport_exchangerate_update_help#}';
MLI18n::gi()->{'amazon_config_price__field__exchangerate_update__alert'} = '{#i18n:form_config_orderimport_exchangerate_update_alert#}';
MLI18n::gi()->{'amazon_config_sync__legend__sync'} = 'Inventory Synchronization';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.tomarketplace__label'} = 'Stock Sync to Marketplace';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.tomarketplace__hint'} = '';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.tomarketplace__help'} = '<dl>
            <dt>Automatic Synchronization via CronJob (recommended)</dt>
                    <dd>Current Amazon stock will be synchronized with shop stock every 4 hours, beginning at 0.00am (depending on configuration).<br>Values will be transferred from the database, including the changes that occur through an ERP or similar.<br><br>
Manual comparison can be activated by clicking the corresponding button in the magnalister header (left of the shopping cart).<br><br>
Additionally, you can activate the stock comparison through CronJon (flat tariff - maximum every 4 hours) with the link:<br>
            <i>{#setting:sSyncInventoryUrl#}</i><br>
Some CronJob requests may be blocked, if they are made through customers not on the flat tariff or if the request is made more than once every 4 hours. 
</dd>
                    </dl>
                    <b>Note:</b> The settings in \'Configuration\', \'Adjusting Procedure\' and \'Inventory Item Count\' will be taken into account.';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.frommarketplace__label'} = 'Stock Sync from Marketplace';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.frommarketplace__hint'} = '';
MLI18n::gi()->{'amazon_config_sync__field__stocksync.frommarketplace__help'} = 'Example: If an item is purchased 3 times on Amazon, the Shop inventory will be reduced by 3.<br /><br />
				           <strong>Important:</strong> This function only applies if you have activated Order Imports!';
MLI18n::gi()->{'amazon_config_sync__field__inventorysync.price__label'} = 'Item Price';
MLI18n::gi()->{'amazon_config_sync__field__inventorysync.price__hint'} = '';
MLI18n::gi()->{'amazon_config_sync__field__inventorysync.price__help'} = '<dl>
            <dt>Automatic Synchronization via CronJob (recommended)</dt>
                    <dd>The function \'Automatic Synchronization\' synchronizes the Amazon price with the Shop price every 4 hours, beginning at 0.00am (depending on configuration).<br>Values will be transferred from the database, including the changes that occur through an ERP or similar.<br><br>
Manual comparison can be activated by clicking the corresponding button in the magnalister header (left of the shopping cart).<br><br>
Additionally, you can activate the stock comparison through CronJon (flat tariff - maximum every 4 hours) with the link:<br>
            <i>{#setting:sSyncInventoryUrl#}</i><br>
Some CronJob requests may be blocked, if they are made through customers not on the flat tariff or if the request is made more than once every 4 hours. 
</dd>
                    </dl>
                    <b>Note:</b> The settings in \'Configuration\', \'Adjusting Procedure\' and \'Inventory Item Count\' will be taken into account.';
MLI18n::gi()->{'amazon_config_orderimport__legend__importactive'} = 'Order Import';
MLI18n::gi()->{'amazon_config_orderimport__legend__mwst'} = 'VAT';
MLI18n::gi()->{'amazon_config_orderimport__legend__orderstatus'} = 'Order Status Synchronization Between Shop and Amazon';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipped__label'} = 'Confirm Shipping With';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipped__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipped__help'} = 'Please set the Shop Status that should trigger the \'Shipping Confirmed\' status on Amazon.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.canceled__label'} = 'Cancel Order With';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.canceled__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.canceled__help'} = 'Here you set the shop status which will set the Amazon order status to „cancel order“. <br/><br/>
Note: partial cancellation is not possible in this setting. The whole order will be cancelled with this function und credited tot he customer';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shop__label'} = '{#i18n:form_config_orderimport_shop_lable#}';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shop__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shop__help'} = '{#i18n:form_config_orderimport_shop_help#}';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.paymentmethod__label'} = 'Payment Methods';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.paymentmethod__help'} = '<p>Payment method that will apply to all orders imported from Amazon. Standard: "Amazon"</p>
<p>
This setting is necessary for the invoice and shipping notice, and for editing orders later in the Shop or via ERP.</p>';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.paymentmethod__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shippingmethod__label'} = 'Shipping Service of the Orders';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shippingmethod__help'} = 'Shipping methods that will be assigned to all Amazon orders. Standard: "Marketplace"<br><br>
This setting is necessary for the invoice and shipping notice, and for editing orders later in the Shop or via ERP.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.shippingmethod__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__mwstfallback__label'} = 'VAT on Non-Shop Items';
MLI18n::gi()->{'amazon_config_orderimport__field__mwstfallback__hint'} = 'The tax rate to apply to Non-Shop items on order imports, in %.';
MLI18n::gi()->{'amazon_config_orderimport__field__mwstfallback__help'} = 'If an item is not entered in the web-shop, magnalister uses the VAT from here since marketplaces give no details to VAT within the order import.<br />
<br />
Further explanation:<br />
Basically, magnalister calculates the VAT the same way the shop-system does itself.<br />
VAT per country can only be considered if the article can be found in the web-shop with his number range (SKU).<br />
magnalister uses the configured web-shop-VAT-classes.
';
MLI18n::gi()->{'amazon_config_orderimport__field__importactive__label'} = 'Activate Import';
MLI18n::gi()->{'amazon_config_orderimport__field__importactive__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__importactive__help'} = '
<p>Orders will be imported on an hourly base if the function is activated.</p>
<p>Via clicking the Function-Button in the headline up right you can manually import the orders.</p>
<p>You also have the possibility to do the Order Import using a Cronjob (every quarter of an hour in the Flat tariff) by clicking the following Link:<br><em>{#setting:sImportOrdersUrl#}<br></em></p>
<p><strong>VAT:</strong></p>
<p>The taxe rates for the order import for the countries can only be calculated correct if you deposited the concerning tax rates in your web-shop and if the bought articles can be identified in the web shop on the basis of the SKU.</p>
<p>magnalister uses the under "Order Import" &gt; "VAT shop-external article" assigned tax rate as "fallback" if the article can not be found in the web-shop</p>
<p><strong></strong></p>
<p><strong>Hint for Amazon B2B Orders and billing</strong> (requires participation in Amazon Business Programm):</p>
<p>Amazon does not transmit tax ID numbers for the order import. magnalister consequently can generate the B2B-orders in the web-shop but it won\'t be possible to create formally correct invoicings at all time.</p>
<p>You have the option to trigger the taxe ID number manually via your Amazon Seller Central and can then maintain it manually in your shop- or ERP-system.</p>
<p>You can also use the invoicing service for B2B orders from Amazon. All legal relevant data are thereby prepared on the proof for the customer.</p>
<p>All order-relevant data incl. taxe IDs can be found in the Seller Central under "Reports" &gt; "Tax Documents" if you participate in the Amazon Business Seller Program. The time for IDs to be available depends on your B2B contract with Amazon (Either after 3 or after 30 days).</p>
<p>Tax IDs can also be found under "Shippment by Amazon" &gt; slider: "Reports" if you are registered for FBA.<br><br></p>
<p><strong>Note for importing Amazon FBA orders</strong></p>
<p>You have the option to block the import of Amazon FBA orders. To do this, open the expert settings at the bottom. Under "Order import" -&gt; "FBA Order import," you can disable the import.</p>
<p><strong>Important:</strong> Despite the disabled FBA order import, the number of FBA orders in magnalister will be recorded in the background and added to your listing contingent. This prevents possible abuse of the magnalister plugin for Amazon FBA.</p>
';
MLI18n::gi()->{'amazon_config_orderimport__field__import__label'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__import__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__preimport.start__label'} = 'Start import from';
MLI18n::gi()->{'amazon_config_orderimport__field__preimport.start__hint'} = 'Start Date';
MLI18n::gi()->{'amazon_config_orderimport__field__preimport.start__help'} = 'The date from which orders will start being imported. Please note that it is not possible to set this too far in the past, as the data only remains available on Amazon for a few weeks.***';
MLI18n::gi()->{'amazon_config_orderimport__field__customergroup__label'} = 'Customer Group';
MLI18n::gi()->{'amazon_config_orderimport__field__customergroup__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__customergroup__help'} = 'The customer group that customers from new orders should be sorted into.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.open__label'} = 'Order Status in Shop';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.open__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.open__help'} = 'The status that should be transferred automatically to the Shop after a new order on Amazon. <br />
If you are using a connected dunning process***, it is recommended to set the Order Status to ‘Paid’ (‘Configuration’ > ‘Order Status’).
';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.fba__label'} = 'FBA Order Status';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.fba__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.fba__help'} = 'This function is only relevant for sellers participating in \'Fulfilment by Amazon (FBA)\': <br/>The order status will be defined as an FBA-order, and the status will be transferred automatically to your shop.
If you are using a connected dunning process***, it is recommended to set the Order Status to \'Paid\' (\'Configuration\' > \'Order Status\').';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbablockimport__label'} = 'FBA Order Import';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbablockimport__valuehint'} = 'Don\'t import FBA orders';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbablockimport__help'} = '
    <p><strong>Do not import orders via Amazon FBA</strong></p>
    <p>You have the option to prevent the import of FBA orders into your store.</p>
    <p>Select the checkbox to activate this feature and the order import will exclude any FBA orders.</p>
    <p>If you remove the check again, new FBA orders will be imported as usual.</p>
    <p><strong>Important notes:</strong></p>
    <ul>
        <li>Should you activate this function, all other FBA functions within the framework of the order import are not available to you for this time.<br><br></li>
        <li>Despite the disabled FBA order import, the number of FBA orders in magnalister will be recorded in the background and added to your listing contingent. This prevents possible abuse of the magnalister plugin for Amazon FBA.</li>
    </ul>
';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbapaymentmethod__label'} = 'Payment Method of FBA Orders';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbapaymentmethod__help'} = 'Payment method for Amazon Orders, which are fulfilled (sent) by Amazon (FBA). Standard: "amazon".<br><br>
				           This setting is important for bills and shipping notes, the subsequent processing of the order inside the shop, and for some ERPs.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbapaymentmethod__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbashippingmethod__label'} = 'Shipping Service of the Orders (FBA)';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbashippingmethod__help'} = 'Shipping method for Amazon Orders, which are fulfilled (sent) by Amazon (FBA). Standard: "amazon".<br><br>
				           This setting is important for bills and shipping notes, the subsequent processing of the order inside the shop, and for some ERPs.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.fbashippingmethod__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier__label'} = 'Shipping Carrier';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier__help'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier__hint'} = 'Select the shipping carrier that is assigned to all Amazon orders by default. This information is obligatory by Amazon. For more details see info icon.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.cancelled__label'} = 'Cancel order with';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.cancelled__hint'} = '';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.cancelled__help'} = 'Please set the Shop Status that should trigger the ‘Order Cancelled’ status on Amazon.<br/><br/>
Note: Part cancellations are not possible with the Amazon API. This function will cancel the complete order and refund the buyer.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.amazonpromotionsdiscount__label'} = 'Amazon Promotion';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.amazonpromotionsdiscount__help'} = '<p>In Amazon Seller Central, you have the option to create promotions as product or shipping discounts. If a product is sold on Amazon with a corresponding discount, magnalister takes this into account during the order import:</p>
<p>In the process, the product and shipping discount are each stored as separate product items on the order in the online store as part of the order import.</p>
<p>For this purpose, magnalister creates the order item with a predefined article number (SKU), which you can find in the right input field. By default we have predefined the following SKUs:</p>
<ul>
    <li>Product discounts: "__AMAZON_DISCOUNT__"</li>
    <li>Shipping discounts: "__AMAZON_SHIPPING_DISCOUNT__"</li>
</ul>
<p>You can overwrite these SKUs at any time and define your own labels. </p>
<p><strong>Important note</strong>: When assigning your own SKUs, make sure that they are not identical to SKUs of existing store products, otherwise the stock on these products will be unintentionally reduced when importing orders for a promotion.</p>
';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.amazonpromotionsdiscount.products_sku__label'} = 'Product Discount Item number';
MLI18n::gi()->{'amazon_config_orderimport__field__orderimport.amazonpromotionsdiscount.shipping_sku__label'} = 'Shipping Discount Item number';
MLI18n::gi()->{'amazon_config_emailtemplate__field__orderimport.amazoncommunicationrules.blacklisting__label'} = 'Amazon Communication Guidelines';
MLI18n::gi()->{'amazon_config_emailtemplate__field__orderimport.amazoncommunicationrules.blacklisting__valuehint'} = 'Comply with Amazon Guidelines and avoid sending emails to Amazon buyers';
MLI18n::gi()->{'amazon_config_emailtemplate__field__orderimport.amazoncommunicationrules.blacklisting__help'} = '
<p>Amazon mandates that all communication between sellers and buyers, including email notifications like order confirmations or shipping updates, must occur within its platform.</p>
<p>When the "Comply with Amazon Guidelines and avoid sending emails to Amazon buyers" setting is enabled, magnalister will alter the Amazon email address to an invalid one, preventing delivery. This adjustment ensures your shop\'s compliance with Amazon\'s communication rules, even if your system is set up to automatically email buyers.</p>
<p>Should you choose to send emails directly from your shop system or magnalister, contrary to Amazon\'s guidelines, please deselect this option.</p>
<p><strong>Caution:</strong> Directly emailing buyers can lead to suspension from Amazon. We strongly recommend maintaining the default setting to prevent any potential issues, for which we cannot be held responsible.<br><br></p>
<p></p>
<p><strong>How does magnalister effectively suppress emails?</strong></p>
<p>Whenever an email is triggered by either your shop system or magnalister, magnalister modifies the Amazon buyer\'s email address by adding a "blacklisted" prefix, ensuring the email fails to reach its destination (for instance: blacklisted-max-mustermann@amazon.de). Consequently, you\'ll be alerted with a bounce-back notification (known as Mailer Daemon) from your email server.</p>
<p>This suppression mechanism affects all types of emails, including those dispatched by your shop system and the order confirmations, which you have the option to activate in the following section labeled &ldquo;E-Mail to Buyer&rdquo;.</p>
';
MLI18n::gi()->{'amazon_config_emailtemplate__legend__mail'} = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->{'amazon_config_emailtemplate__legend__guidelines'} = 'Amazon Communication Guidelines';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.send__label'} = '{#i18n:configform_emailtemplate_field_send_label#}';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.send__help'} = '
<p><strong>Send emails to buyers upon order receipt?</strong></p>
<p>Here, you can decide whether to dispatch email notifications, such as order confirmations, directly from magnalister to Amazon customers. You\'ll also find an option to tailor these email communications further down.</p>
<p><strong>Critical advisory:</strong> Direct email communication, including notifications from seller to buyer, contravenes Amazon\'s communication guidelines. To prevent the possibility of facing an Amazon suspension, we strongly recommend against sending emails from either magnalister or your shop system to Amazon purchasers. We will not be liable for any adverse consequences that may arise.</p>
<p><strong>Attention:</strong> If you intend to proceed with sending emails to buyers via magnalister, ensure you first deselect the option &ldquo;Comply with Amazon Guidelines and avoid sending emails to Amazon buyers&rdquo; found earlier in the settings.</p>
';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.send__modal__true'} = '
<p><strong>Critical advisory regarding Amazon&rsquo;s Communication Guidelines</strong></p>
<p>It&rsquo;s essential to understand that Amazon&rsquo;s communication guidelines forbid any direct email exchanges between sellers and buyers.</p>
<p>However, if you choose to notify your customers about their orders via email, it&rsquo;s imperative to first uncheck the &ldquo;Comply with Amazon Guidelines and avoid sending emails to Amazon buyers&rdquo; option.</p>
<p>Kindly confirm your decision to proceed with this adjustment:</p>
<p><strong>{#i18n:ML_BUTTON_LABEL_OK#}:</strong> Yes, I wish to deselect the option and initiate email communication with Amazon buyers.</p>
<p><strong>{#i18n:ML_BUTTON_LABEL_ABORT#}:</strong> No, I prefer to comply with Amazon&rsquo;s communication standards.</p>
';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.originator.name__label'} = 'Sender Name';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.originator.adress__label'} = 'Sender E-Mail Address';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.subject__label'} = 'Subject';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.content__label'} = 'E-Mail Content';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.content__hint'} = 'List of available placeholders for Subject and Content:
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
                        <dd>Buyer\'s password for logging in to your Shop. Only for customers that are automatically assigned passwords – otherwise the placeholder will be replaced with \'(as known)\'***.</dd>
                <dt>#ORDERSUMMARY#</dt>
                        <dd>Summary of the purchased items. Should be written on a separate line. <br/><i>Cannot be used in the Subject!</i></dd>
                <dt>#ORIGINATOR#</dt>
                        <dd>Sender name</dd>
        </dl>';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.copy__label'} = 'Copy to Sender';
MLI18n::gi()->{'amazon_config_emailtemplate__field__mail.copy__help'} = 'A copy will be sent to the sender email address.';
MLI18n::gi()->{'amazon_config_shippinglabel__legend__shippingaddresses'} = 'Sender Addresses';
MLI18n::gi()->{'amazon_config_shippinglabel__legend__shippingservice'} = 'Shipping Settings';
MLI18n::gi()->{'amazon_config_shippinglabel__legend__shippinglabel'} = 'Shipping Options';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address__label'} = 'Sender Address';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.name__label'} = 'Name';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.company__label'} = 'Company Name';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.streetandnr__label'} = 'Street Name and Number';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.city__label'} = 'City';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.state__label'} = 'Federal State';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.zip__label'} = 'Post Code';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.country__label'} = 'Country';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.phone__label'} = 'Phone Number';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.address.email__label'} = 'E-Mail-Address';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippingservice.carrierwillpickup__label'} = 'Package Pickup';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippingservice.carrierwillpickup__default'} = 'false';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippingservice.deliveryexperience__label'} = 'Shipping Conditions';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.fallback.weight__label'} = 'Alternative Weight';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.fallback.weight__help'} = 'The here set parameter will be taken, if there is no weight parameter specified for a product.';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.weight.unit__label'} = 'Weight Unit';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.size.unit__label'} = 'Size Unit';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.default.dimension__label'} = 'User-Defined Package Sizes';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.default.dimension.text__label'} = 'Description';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.default.dimension.length__label'} = 'Length';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.default.dimension.width__label'} = 'Width';
MLI18n::gi()->{'amazon_config_shippinglabel__field__shippinglabel.default.dimension.height__label'} = 'Height';

// Amazon VCS
MLI18n::gi()->{'amazon_config_vcs__legend__amazonvcs'} = 'Invoice Upload and Amazon VCS program';
MLI18n::gi()->{'amazon_config_vcs__legend__amazonvcsinvoice'} = 'Data for invoice creation by magnalister';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__label'} = 'VCS Settings made in Amazon Seller Central';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__values__off'} = 'I do not participate in the Amazon VCS program';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__values__vcs'} = 'Amazon setting: Amazon creates my invoices';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__values__vcs-lite'} = 'Amazon setting: I upload my own invoices to Amazon';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__hint'} = 'The option set here should match your selection in the Amazon VCS program ( entered in Amazon Seller Central).';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.option__help'} = '
    Please select whether and in how you already participate in the Amazon VCS program. The basic setup is done at Seller Central.
    <br>
    magnalister gives you three options:
    <ol>
        <li>
            I do not participate in the Amazon VCS Program<br>
            <br>
            If you have decided not to participate in the Amazon VCS program, select this option. You can still choose under "Invoice Upload" whether and how you want to upload your invoices to Amazon. However, you will then no longer benefit from the advantages of the VCS program (e.g. seller badge and better ranking).<br>
            <br>
        </li>
        <li>
            Amazon setting: Amazon creates my invoices<br>
            <br>
            Invoicing and VAT calculation is done entirely on Amazon\'s side as part of the VCS program. The configuration for this is done in Seller Central.<br>
            <br>
        </li>
        <li>
            Amazon setting: I upload my own invoices to Amazon<br>
            <br>
            Choose this option if you want to upload invoices created either by the shop system or by magnalister (concrete selection in the field „Invoice Upload"). Amazon then only takes care of the VAT calculation. This selection is also first made in Seller Central.<br>
            <br>
        </li>
    </ol>
    <br>
    Important notes:
    <ul>
        <li>If you choose option 1 or 3, magnalister checks with every order import if there is an invoice for an Amazon order imported by magnalister. If so, magnalister will transfer the invoice to Amazon within 60 minutes. In case of option 3, this happens as soon as the order has received the shipped status in the webshop.<br><br></li>
    </ul>
';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__label'} = 'Invoice Upload';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__values__'} = 'Select an option';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__values__off'} = 'Do not upload invoices to Amazon';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__values__webshop'} = 'Invoices created in the web shop are uploaded to Amazon';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__values__magna'} = 'Invoice generation and upload is done by magnalister';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__values__erp'} = 'Invoices created in the third-party system (e.g. ERP) are uploaded to Amazon';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcs.invoice__help'} = '
    <p>Here you can choose whether and how you want to send your invoices to Amazon. The following options are available:</p>
    <ol>
        <li>
            <p>Do not upload invoices to Amazon</p>
            <p>If this option is selected, your invoices will not be transmitted to Amazon. This means: You organize the distribution of invoices yourself.</p>
        </li>
        <li>
            <p>Invoices created in the web shop are uploaded to Amazon</p>
            <p>If your shop system has the ability to create invoices, you can upload them to Amazon.</p>
        </li>
        <li> 
            <p>Invoices created by third-party systems (e.g. ERP system) are uploaded to Amazon</p>
            <p>Invoices created with your third-party system (e.g. ERP) can be uploaded to your webshop server, retrieved by magnalister and uploaded to Amazon. More information appears after selecting this option in the info icon under "Settings for the transmission of invoices created from a third-party system [...]".</p>
        </li>
        <li>
            <p>Invoice generation and upload is done by magnalister</p>
            <p>Select this option if you want magnalister to handle the creation and upload of invoices for you. To do so, fill in the fields under "Data for invoice creation by magnalister".</p>
        </li> 
    </ol>
';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicedir__label'} = 'Uploaded invoices';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicedir__buttontext'} = 'Show';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.language__label'} = 'Invoice language';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.mailcopy__label'} = 'Mail with copy of invoice to';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.mailcopy__hint'} = 'Enter your email address here in order to receive a copy of the uploaded invoice by email.';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoiceprefix__label'} = 'Prefix invoice number';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoiceprefix__hint'} = 'If you enter a prefix here, it will be placed before the invoice number. Example: R10000. Invoices generated by magnalister start with the number 10000.';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoiceprefix__default'} = 'R';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.reversalinvoiceprefix__label'} = 'Prefix reversal invoice number';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.reversalinvoiceprefix__hint'} = 'If you enter a prefix here, it will be placed before the reversal invoice number. Example: S20000. Reversal invoices generated by magnalister start with the number 20000.';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.reversalinvoiceprefix__default'} = 'S';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.companyadressleft__label'} = 'Company address field (left side)';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.companyadressleft__default'} = 'Your name, Your street 1, 12345 Your town';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.companyadressright__label'} = 'Company address field (right side)';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.companyadressright__default'} = "Your name\nYour street 1\n\n12345 Your town";
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.headline__label'} = 'Heading invoice';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.headline__default'} = 'Your Invoice';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicehintheadline__label'} = 'Heading invoice notes';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicehintheadline__default'} = 'Invoice notes';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicehinttext__label'} = 'Information text';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicehinttext__hint'} = 'Leave blank if no information should appear on the invoice';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.invoicehinttext__default'} = 'Your information text for the invoice';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell1__label'} = 'Footer column 1';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell1__default'} = "Your name\nYour street 1\n\n12345 Your town";
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell2__label'} = 'Footer column 2';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell2__default'} = "Your telephone number\nYour fax number\nYour homepage\nYour e-mail";
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell3__label'} = 'Footer column 3';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell3__default'} = "Your tax number\nYour Ust. ID. No.\nYour jurisdiction\nYour details";
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell4__label'} = 'Footer column 4';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.footercell4__default'} = "Additional\nInformation\nin the fourth\ncolumn";
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.preview__label'} = 'Invoice preview';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.preview__buttontext'} = 'Show';
MLI18n::gi()->{'amazon_config_vcs__field__amazonvcsinvoice.preview__hint'} = 'Here you can display a preview of your invoice with the data you have entered.';

// New Shipment Options
MLI18n::gi()->{'amazon_config_carrier_option_group_marketplace_carrier'} = 'Shipping Carriers suggested by Amazon';
MLI18n::gi()->{'amazon_config_carrier_option_group_additional_option'} = 'Additional options';
MLI18n::gi()->{'amazon_config_carrier_option_matching_option_carrier'} = 'Match shipping carriers suggested by Amazon with carriers defined in webshop system (shipping module)';
MLI18n::gi()->{'amazon_config_carrier_option_matching_option_shipmethod'} = 'Match shipping method with entries from webshop shipping module';
MLI18n::gi()->{'amazon_config_carrier_option_database_option'} = 'Database Matching';
MLI18n::gi()->{'amazon_config_carrier_option_orderfreetextfield_option'} = 'magnalister adds a free text field in the order details';
MLI18n::gi()->{'amazon_config_carrier_option_freetext_option_carrier'} = 'Generally, apply shipping carrier from text field';
MLI18n::gi()->{'amazon_config_carrier_option_freetext_option_shipmethod'} = 'Generally, apply shipping method from text field';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier.freetext__label'} = 'Shipping Carrier:';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier.freetext__placeholder'} = 'Enter your shipping carrier here';
MLI18n::gi()->{'amazon_config_carrier_matching_title_marketplace_carrier'} = 'Shipping Carrier suggested by Amazon';
MLI18n::gi()->{'amazon_config_carrier_matching_title_marketplace_shipmethod'} = 'Shipping method suggested by Amazon';
MLI18n::gi()->{'amazon_config_carrier_matching_title_shop_carrier'} = 'Shipping carrier defined in webshop system (shipping module)';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod__label'} = 'Shipping Method';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod__hint'} = 'Select the shipping method that is assigned to all Amazon orders by default. This information is obligatory by Amazon. For more details see info icon.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod.freetext__label'} = 'Shipping Method:';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod.freetext__placeholder'} = 'Enter your shipping method here';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress__label'} = 'Confirm shipping and set sender address';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress__help'} = '
Under "Order status", select the webshop status with which the shipment is to be confirmed.<br>
<br>
To the right, you can enter the address from which the items will be shipped. This is useful if the shipping address is to be different from the default address stored in Amazon (e.g. when shipping from an external warehouse).<br>
<br>
If you leave the address fields empty, Amazon will use the sender  address you have specified in your Amazon shipping settings (Seller Central).
';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.name__label'} = 'Warehouse / Storage Name';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.line1__label'} = 'Address Line 1';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.line2__label'} = 'Address Line 2';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.line3__label'} = 'Address Line 3';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.city__label'} = 'City';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.county__label'} = 'County';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.stateorregion__label'} = 'State/Region';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.postalcode__label'} = 'Postal Code';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.countrycode__label'} = 'Country';

/** BOPIS */
MLI18n::gi()->add('amazon_config_bopis', array(
    'legend' => array(
        'stores' => '"Click & Collect in store" Stores',
    ),
), false);

MLI18n::gi()->{'amazon_config_bopis__legend__products'} = 'Store Stock Management';
MLI18n::gi()->{'amazon_config_bopis__legend__orders'} = 'Order Status';
MLI18n::gi()->{'amazon_config_bopis__legend__orderimport'} = '{#i18n:amazon_config_account_orderimport#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.open__label'} = 'Status for "Click & Collect in store" orders';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.open__help'} = 'Defines the order status that a "Click & Collect in store" order imported from Amazon should automatically receive in the store.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.readyforpickup__label'} = 'Ready for Pickup';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.readyforpickup__help'} = 'Set the store status here, which should automatically set the status "Ready For Pickup" on Amazon.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.pickedup__label'} = 'Picked Up';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.pickedup__help'} = 'Set the store status here, which should automatically set the status "Picked Up" on Amazon.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.refund__label'} = 'Refund';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.refund__help'} = 'Set the store status here, which should automatically set the status "Refund" on Amazon.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.refund.reason__label'} = 'Refund Reason';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.refund.reason__help'} = 'Select a default reason for refunds here, which will then be selected in the case of cronjob synchronization when a refund is made.';
MLI18n::gi()->{'amazon_bopis.refund.reason_NoInventory'} = 'No Inventory';
MLI18n::gi()->{'amazon_bopis.refund.reason_CustomerReturn'} = 'Custom Return';
MLI18n::gi()->{'amazon_bopis.refund.reason_GeneralAdjustment'} = 'General Adjustment';
MLI18n::gi()->{'amazon_bopis.refund.reason_CouldNotShip'} = 'Could Not Ship';
MLI18n::gi()->{'amazon_bopis.refund.reason_DifferentItem'} = 'Different Item';
MLI18n::gi()->{'amazon_bopis.refund.reason_Abandoned'} = 'Abandoned';
MLI18n::gi()->{'amazon_bopis.refund.reason_CustomerCancel'} = 'Customer Cancel';
MLI18n::gi()->{'amazon_bopis.refund.reason_PriceError'} = 'Price Error';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stores__label'} = 'Add or update "Click & Collect in store" stores';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.status__label'} = 'Store in operation?';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.status__hint'} = 'If the box is not checked, it means that the store is temporarily or permanently closed.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stockmanagement__label'} = 'Store Stock';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stockmanagement__help'} = '
    Specify here how much stock quantity of an item should be available for the respective store.<br/>
    <br/>
    To avoid overselling, you can set the value<br/>
    "<i>Transfer shop inventory minus value from right field</i>" activate.<br/>
    <br/>
    <strong>Example:</strong> Set value to "<i>2</i>". Results in &#8594; Shop warehouse: 10 &#8594; Store warehouse: 8<br/>
    <br/>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stockmanagement.store__label'} = 'Store';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stockmanagement.quantity__label'} = 'Store Inventory';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode__label'} = 'Supply Source Code<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode__help'} = 'Please set a Supply Source Code for your store.<br>This will be used to identify your store, so it must be <strong>unique</strong> and cannot be changed.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode_creation_error__label'} = 'Due to the reasons listed below, we couldn\'t create the store ';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode_update_error__label'} = 'Due to the reasons listed below, we couldn\'t update the store ';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode_creationAndUpdate_error__label'} = 'We were able to create your store, but due to the reasons listed below, we couldn\'t update the store ';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.alias__label'} = 'Alias<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.alias__help'} = 'This will be displayed to the buyer in relevant use cases. The format must be "store name - street - postal code".';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.alias__placeholder'} = 'Store name - Street - Postcode';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address__label'} = 'Store address<span class="bull">•</span>';
MLI18n::gi()->{'amazon_bopis_storename'} = 'Store Name';
MLI18n::gi()->{'amazon_bopis_addressline1'} = 'Addressline 1<span class="bull">•</span>';
MLI18n::gi()->{'amazon_bopis_addressline2'} = 'Addressline 2';
MLI18n::gi()->{'amazon_bopis_addressline3'} = 'Addressline 3';
MLI18n::gi()->{'amazon_bopis_city'} = 'City<span class="bull">•</span>';
MLI18n::gi()->{'amazon_bopis_county'} = 'County';
MLI18n::gi()->{'amazon_bopis_district'} = 'District';
MLI18n::gi()->{'amazon_bopis_stateorregion'} = 'State or Region';
MLI18n::gi()->{'amazon_bopis_postalcode'} = 'Postalcode<span class="bull">•</span>';
MLI18n::gi()->{'amazon_bopis_country'} = 'Country<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.createstoresuccess'} = 'Successfully created the store with the following supply source code: ';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.updatestoresuccess'} = 'Successfully updated the store with the following supply source code: ';

MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.addressline1__label'} = '{#i18n:amazon_bopis_addressline1#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.addressline2__label'} = '{#i18n:amazon_bopis_addressline2#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.addressline3__label'} = '{#i18n:amazon_bopis_addressline3#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.city__label'} = '{#i18n:amazon_bopis_city#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.county__label'} = '{#i18n:amazon_bopis_county#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.district__label'} = '{#i18n:amazon_bopis_district#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.stateorregion__label'} = '{#i18n:amazon_bopis_stateorregion#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.postalcode__label'} = '{#i18n:amazon_bopis_postalcode#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.countrycode__label'} = '{#i18n:amazon_bopis_country#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.timezone__label'} = 'Timezone<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.timezone__hint'} = 'In which time zone is the store located?';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.handlingtime__label'} = 'Handling Time<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.handlingtime__hint'} = 'The handling time describes the timeperiod it will take you to get the order ready to be picked up';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.handlingtime__label'} = '{#i18n:amazon_config_bopis__field__bopis.array.configuration.handlingtime__label#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.handlingtime__help'} = '{#i18n:amazon_config_bopis__field__bopis.array.configuration.handlingtime__help#}';
MLI18n::gi()->{'amazon_bopis.handling_time_Days'} = 'Days';
MLI18n::gi()->{'amazon_bopis.handling_time_Hours'} = 'Hours';
MLI18n::gi()->{'amazon_bopis.handling_time_Minutes'} = 'Minutes';
MLI18n::gi()->{'amazon_bopis_value'} = 'Value';
MLI18n::gi()->{'amazon_bopis_timeunit'} = 'Time Unit';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.handlingtime.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.handlingtime.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.handlingtime.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.handlingtime.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_bopis_operationalconfiguration'} = 'Contact information and opening hours of the store<span class="bull">•</span>';
MLI18n::gi()->{'amazon_bopis_operationalconfiguration_hint'} = 'For example, if you are not open on Saturdays or Sundays, leave the two fields for opening time and closing time blank.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration__label'} = '{#i18n:amazon_bopis_operationalconfiguration#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration__hint'} = '{#i18n:amazon_bopis_operationalconfiguration_hint#}';
MLI18n::gi()->{'amazon_bopis_contactdetails'} = 'Contact Details';
MLI18n::gi()->{'amazon_bopis_email'} = 'Email';
MLI18n::gi()->{'amazon_bopis_phone'} = 'Phone';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.contactdetails__label'} = '{#i18n:amazon_bopis_contactdetails#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.contactdetails.email__label'} = '{#i18n:amazon_bopis_email#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.contactdetails.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_bopis_monday'} = 'Monday';
MLI18n::gi()->{'amazon_bopis_tuesday'} = 'Tuesday';
MLI18n::gi()->{'amazon_bopis_wednesday'} = 'Wednesday';
MLI18n::gi()->{'amazon_bopis_thursday'} = 'Thursday';
MLI18n::gi()->{'amazon_bopis_friday'} = 'Friday';
MLI18n::gi()->{'amazon_bopis_saturday'} = 'Saturday';
MLI18n::gi()->{'amazon_bopis_sunday'} = 'Sunday';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_bopis_starttime'} = 'Start Time';
MLI18n::gi()->{'amazon_bopis_endtime'} = 'End Time';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.monday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.monday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.tuesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.tuesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.wednesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.wednesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.thursday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.thursday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.friday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.friday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.saturday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.saturday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.sunday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.sunday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_bopis_throughputconfig'} = 'Throughput Config';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.throughputconfig__label'} = '{#i18n:amazon_bopis_throughputconfig#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.throughputconfig.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.throughputconfig.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities__label'} = 'Capabilities';
MLI18n::gi()->{'amazon_bopis_issupported'} = 'Is Supported?';
MLI18n::gi()->{'amazon_bopis_usefrommaster'} = 'Use from Store?';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.issupported__label'} = '{#i18n:amazon_bopis_issupported#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration__label'} = 'Outbound {#i18n:amazon_bopis_operationalconfiguration#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration__hint'} = '{#i18n:amazon_bopis_operationalconfiguration_hint#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.usefrommaster__label'} = '{#i18n:amazon_bopis_usefrommaster#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.throughputconfig__label'} = '{#i18n:amazon_bopis_throughputconfig#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.throughputconfig.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.throughputconfig.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.contactdetails__label'} = '{#i18n:amazon_bopis_contactdetails#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.contactdetails.email__label'} = '{#i18n:amazon_bopis_email#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.contactdetails.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.monday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.monday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.tuesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.tuesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.wednesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.wednesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.thursday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.thursday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.friday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.friday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.saturday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.saturday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.sunday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration.sunday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';

MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation__label'} = 'Return Location';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address__label'} = 'Address';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.usefrommaster__label'} = '{#i18n:amazon_bopis_usefrommaster#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.contactdetails__label'} = '{#i18n:amazon_bopis_contactdetails#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.contactdetails.email__label'} = '{#i18n:amazon_bopis_email#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.contactdetails.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.name__label'} = '{#i18n:amazon_bopis_storename#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.addressline1__label'} = '{#i18n:amazon_bopis_addressline1#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.addressline2__label'} = '{#i18n:amazon_bopis_addressline2#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.addressline3__label'} = '{#i18n:amazon_bopis_addressline3#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.city__label'} = '{#i18n:amazon_bopis_city#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.county__label'} = '{#i18n:amazon_bopis_county#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.district__label'} = '{#i18n:amazon_bopis_district#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.stateorregion__label'} = '{#i18n:amazon_bopis_stateorregion#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.postalcode__label'} = '{#i18n:amazon_bopis_postalcode#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.countrycode__label'} = '{#i18n:amazon_bopis_country#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address.phone__label'} = '{#i18n:amazon_bopis_phone#}';

MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel__label'} = 'Delivery Channel';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.issupported__label'} = '{#i18n:amazon_bopis_issupported#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration__label'} = '{#i18n:amazon_bopis_operationalconfiguration#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration__hint'} = '{#i18n:amazon_bopis_operationalconfiguration_hint#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.usefrommaster__label'} = '{#i18n:amazon_bopis_usefrommaster#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.throughputconfig__label'} = '{#i18n:amazon_bopis_throughputconfig#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.throughputconfig.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.throughputconfig.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.usefrommaster__label'} = '{#i18n:amazon_bopis_usefrommaster#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.contactdetails__label'} = '{#i18n:amazon_bopis_contactdetails#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.contactdetails.email__label'} = '{#i18n:amazon_bopis_email#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.contactdetails.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.monday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.monday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.tuesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.tuesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.wednesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.wednesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.thursday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.thursday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.friday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.friday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.saturday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.saturday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.sunday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.deliverychannel.operationalconfiguration.sunday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';

MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel__label'} = 'Pickup Channel';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.issupported__label'} = '{#i18n:amazon_bopis_issupported#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.inventoryholdperiod__label'} = 'Holding period for the inventory of a "Click & Collect in store" order<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.inventoryholdperiod__help'} = 'Describes how long you will hold the inventory until you cancel the order if not picked up';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.inventoryholdperiod.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.inventoryholdperiod.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration__label'} = '{#i18n:amazon_bopis_operationalconfiguration#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration__hint'} = '{#i18n:amazon_bopis_operationalconfiguration_hint#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.usefrommaster__label'} = '{#i18n:amazon_bopis_usefrommaster#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.throughputconfig__label'} = '{#i18n:amazon_bopis_throughputconfig#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.throughputconfig.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.throughputconfig.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.contactdetails__label'} = '{#i18n:amazon_bopis_contactdetails#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.contactdetails.email__label'} = '{#i18n:amazon_bopis_email#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.contactdetails.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.monday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.monday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.tuesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.tuesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.wednesday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.wednesday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.thursday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.thursday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.friday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.friday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.saturday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.saturday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.sunday.starttime__label'} = '{#i18n:amazon_bopis_starttime#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.operationalconfiguration.sunday.endtime__label'} = '{#i18n:amazon_bopis_endtime#}';
