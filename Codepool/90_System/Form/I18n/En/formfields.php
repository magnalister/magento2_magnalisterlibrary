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

MLI18n::gi()->add('formfields', array(
    'checkin.status' => array(
        'label' => 'Status Filter',
        'valuehint' => 'Only transfer active items',
        'help' => 'Items can be active or inactive in your store.',
    ),
    'lang' => array (
        'label' => 'Item Description',
    ),
    'prepare.status' => array(
        'label' => '{#i18n:formfields__checkin.status__label#}',
        'valuehint' => '{#i18n:formfields__checkin.status__valuehint#}',
        'help' => 'Items can be active or inactive in your store.',
    ),
    'tabident' => array(
        'label' => '{#i18n:ML_LABEL_TAB_IDENT#}',
        'help' => '{#i18n:ML_TEXT_TAB_IDENT#}',
    ),
    'stocksync.tomarketplace'                         => array(
        'label' => 'Stock Sync to Marketplace',
        'help' => '
            Hint: idealo supports only "available" and "not available" for your offers.<br />
            <br />
            Stock shop > 0 = availible on {#i18n:sModuleName#}<br />
            Stock shop < 1 = not avilible on {#i18n:sModuleName#}<br />
            <br />
            <br />
            Function:<br />
            Automatic synchronisation by CronJob (recommended)<br />
            <br />
            <br />
            The function "Automatic Synchronisation by CronJob" checks the shop stock every 4 hours*<br />
            <br />
            <br />
            By this procedure, the database values are checked for changes. The new data will be submitted, also when the changes had been set by an inventory management system.<br />
            <br />
            You can manually synchronize stock changes, by clicking the assigned button in the magnalister-header, next left to the ant-logo.<br />
            <br />
            Additionally, you can synchronize stock changes, by setting a own cronjob to your following shop-link:<br />
            <i>{#setting:sSyncInventoryUrl#}</i><br />
            <br />
            Own cronjob-calls, exceeding a quarter of an hour will be blocked.<br />
            <br />
            <br />
            Hint: The config value "Configuration" → "Presets" ...<br />
            <br />
            → "Orderlimit for one day" and<br />
            → "shop stock"<br />
            will be consided.
        ',
    ),
    'stocksync.frommarketplace' => array(
        'label' => 'Orderimport from {#setting:currentMarketplaceName#}',
        'help' => 'For example: If 3 items are sold on idealo.de, the shop-stock will be reduced by 3 items, too.',
    ),
    'inventorysync.price' => array(
        'label' => 'Price Options',
        'help' => '
            This function allows you to define other prices for idealo. These prices will be used in item upload as well as in the price synchronization.<br />
            <br />
            <ul>
                <li>Use a customer group, or define an own customer group where you place the prices for the marketplace.</li>
                <li>If an item has no price defined for the price group chosen, the default price will be used.</li>
            </ul>
            <br />
            This way, you can change the prices for only a few items without changing the calculation rules for everything.<br />
            The other configuration settings (Markup/Markdown and Decimal amount) apply here as well.
        ',
    ),
    'mail.send' => array(
        'label' => 'Send E-Mail?',
        'help' => 'Should an email be sent from your Shop to customers, to promote your Shop?',
    ),
    'mail.originator.name' => array(
        'label' => 'Sender Name',
        'default' => 'Example-Shop',
    ),
    'mail.originator.adress' => array(
        'label' => 'Sender E-Mail Address',
        'default' => 'example@onlineshop.de',
    ),
    'mail.subject' => array(
        'label' => 'Subject',
        'default' => 'Your order at #SHOPURL#',
    ),
    'mail.content' => array(
        'label' => 'E-Mail Content',
        'hint' => '
            List of available placeholders for Subject and Content:
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
            </dl>
        ',
        'default' => 
'<style><!--
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
<p>Your Online Shop Team</p>
    '),
    'mail.copy' => array(
        'label' => 'Copy to Sender',
        'help' => 'A copy will be sent to the sender email address.',
    ),
    'quantity' => array(
        'label' => 'Inventory Item Stock',
        'help' => '
            Please enter how much of the inventory should be available on the marketplace.<br/>
            <br/>
            You can change the individual item count directly under \'Upload\'. In this case it is recommended that you turn off automatic<br/>
            synchronization under \'Synchronization of Inventory\' > \'Stock Sync to Marketplace\'.<br/>
            <br/>
            To avoid overselling, you can activate \'Transfer shop inventory minus value from the right field\'.
            <br/>
            <strong>Example:</strong> Setting the value at 2 gives &#8594; Shop inventory: 10 &#8594; {#setting:currentMarketplaceName#} inventory: 8<br/>
            <br/>
            <strong>Please note:</strong>If you want to set an inventory count for an item in the Marketplace to \'0\', which is already set as Inactive in the Shop, independent of the actual inventory count, please proceed as follows:<br/>
            <ul>
                <li>\'Synchronize Inventory"> Set "Edit Shop Inventory" to "Automatic Synchronization with CronJob"</li>
                <li>"Global Configuration" > "Product Status" > Activate setting "If product status is inactive, treat inventory count as 0"</li>
            </ul>
        ',
    ),
    'maxquantity' => array(
        'label' => 'Limitation for Inventory Item Stock',
        'help' => '
            Here you can define the maximum amount of stock submitted to {#setting:currentMarketplaceName#}.<br /><br />
            <strong>Example:</strong>
            For “Inventory Item Stock” you select “Transfer shop inventory” and enter “20” in this field. While upload the quantity will be taken from available inventory but not more then 20. The inventory synchronisation (if activated) will adapt the {#setting:currentMarketplaceName#} quantity to the shop-inventory as long as the shop-inventory is less then 20. If there are more then 20 in the inventory, the {#setting:currentMarketplaceName#} quantity is set to 20.<br /><br />
            Please insert “0” or let this field blank if you do not want a limitation.<br /><br />
            <strong>Hint:</strong>
            If the “Inventory Item Stock” option “Flat amount (from the right field)” is selected, limitation has no effect.
        ',
    ),
    'priceoptions' => array(
        'label' => 'Sales Price from Customer Group',
        'help' => '{#i18n:configform_price_field_priceoptions_help#}',
    ),
    'price.usespecialoffer' => array(
        'label' => 'Use special offer prices',
    ),
    'exchangerate_update' => array(
        'label' => 'Exchange Rate',
        'valuehint' => 'Update exchange rate automatically',
        'help' => '{#i18n:form_config_orderimport_exchangerate_update_help#}',
        'alert' => '{#i18n:form_config_orderimport_exchangerate_update_alert#}',
    ),
    'importactive' => array(
        'label' => 'Activate Import',
        'help' => '
            Should orders from {#setting:currentMarketplaceName#} be imported?<br />
            <br />
            Orders are imported automatically every hour as the default setting.<br />
            <br />
            You can adjust the import-time individually, by configuring<br />
            "magnalister admin" → "Global Configuration" → "Orders Import".<br />
            <br />
            You can manually import orders, by clicking the assigned button in the magnalister-header, next left to the ant-logo.<br />
            <br />
            Additionally, you can call order imports by setting a own cronjob to your following shop-link:<br />
            <i>{#setting:sImportOrdersUrl#}</i><br />
            <br />
            Own cronjob-calls, exceeding a quarter of an hour will be blocked.
        ',
    ),
    'preimport.start' => array(
        'label' => 'First-time order-import',
        'hint' => 'Start date',
        'help' => 'The date, an order import will be processed the first time.',
    ),
    'customergroup' => array(
        'label' => 'Customer Group',
        'help' => 'Allocate customers from {#setting:currentMarketplaceName#} to a customer group of the shop.',
    ),
    'orderimport.shop' => array(
        'label' => '{#i18n:form_config_orderimport_shop_lable#}',
        'help' => '{#i18n:form_config_orderimport_shop_help#}',
    ),
    'orderstatus.open' => array(
        'label' => 'Order Status',
        'help' => '
            The status a new order from {#setting:currentMarketplaceName#} gets automatically in the shop.<br />
            If you use an attached dunning process, it is recommended to set the status to "Paid" (configuration → purchase order status).
        ',
    ),
    'orderimport.shippingmethod' => array(
        'label' => 'Shipping Service of the Orders',
        'help' => '
            Shipping method that will apply to all orders imported from {#setting:currentMarketplaceName#}. Standard: “{#setting:currentMarketplaceName#}”<br><br>
            This setting is necessary for the invoice and shipping notice, and for editing orders later in the Shop or via ERP.
        ',
    ),
    'orderimport.paymentmethod' => array(
        'label' => 'Payment Methods',
        'help' => '
            <p>Payment method that will apply to all orders imported from {#setting:currentMarketplaceName#}. Standard: “{#i18n:marketplace_configuration_orderimport_payment_method_from_marketplace#}”</p>
            <p>If you choose “Automatic Allocation”, magnalister will accept the payment method chosen by the buyer on {#setting:currentMarketplaceName#}.</p>
            <p>Additional payment methods can be added to the list via Shopware > Settings > Payment Methods, then activated here.</p>
            <p>This setting is necessary for the invoice and shipping notice, and for editing orders later in the Shop or via ERP.</p>
        ',
    ),
    'mwst.fallback' => array(
        'label' => 'VAT on Non-Shop*** Items',
        'hint' => 'The tax rate to apply to non-Shop items on order imports, in %.',
        'help' => '
            If an item is not entered in the web-shop, magnalister uses the VAT from here since marketplaces give no details to VAT within the order import.<br />
            <br />
            Further explanation:<br />
            Basically, magnalister calculates the VAT the same way the shop-system does itself.<br />
            VAT per country can only be considered if the article can be found in the web-shop with his number range (SKU).<br />
            magnalister uses the configured web-shop-VAT-classes.
        ',
    ),
    'orderstatus.sync'                           => array(
        'label' => 'Status Synchronization',
        'help' => '
            <dl>
                <dt>Automatic Synchronization via CronJob (recommended)</dt>
                <dd>
                    The function \'Automatic Synchronization with CronJob\' transfers the current Sent Status to {#setting:currentMarketplaceName#} every 2 hours.<br/>
                    The status values from the database will be checked and transferred, including when the changes are only made to the database, for example, with an ERP. <br/><br/>
                    To do a manual comparison, which allows you to edit the order directly in the web shop, set the desired status there and then click \'refresh\'.<br/>
                    Click the button in the magnalister header (left of the shopping cart) to transfer the status immediately.<br/><br/>
                    Additionally you can activate the Order Status Comparison through CronJob (flat tariff*** - maximum every 4 hours) with the link: <br/><br/>
                    <i>{#setting:sSyncOrderStatusUrl#}</i><br/><br/>
                    Some CronJob requests may be blocked, if they are made through customers not on the flat tariff*** or if the request is made more than once every 4 hours. 
                </dd>
            </dl>
        ',
    ),
    'orderstatus.shipped'                        => array(
        'label' => 'Confirm Shipping With',
        'help' => 'Please set the Shop Status that should trigger the \'Shipping Confirmed\' status on {#setting:currentMarketplaceName#}.',
    ),
    'orderstatus.carrier.default'                => array (
        'label' => 'Carrier',
        'help'  => 'Pre-selected carrier with confirmation of distribution to {#setting:currentMarketplaceName#}.',
    ),
    'orderstatus.canceled'                       => array(
        'label' => 'Cancel Order With',
        'help'  => '
            Here you set the shop status which will set the {#setting:currentMarketplaceName#} order status to „cancel order“. <br/><br/>
            Note: partial cancellation is not possible in this setting. The whole order will be cancelled with this function und credited tot he customer
        ',
    ),
    'config_uploadInvoiceOption'                      => array(
        'label' => 'Invoice Upload Options',
        'help'  => '<p>Here you can choose whether and how you want to send your invoices to {#setting:currentMarketplaceName#}. The following options are available:</p>

<ol>
    <li><p>Do not upload invoices to {#setting:currentMarketplaceName#}</p>

        <p>If this option is selected, your invoices will not be transmitted to {#setting:currentMarketplaceName#}. This means: You organize the
            distribution of invoices yourself.</p></li>
    {#i18n:formfields_config_uploadInvoiceOption_help_webshop#}
    {#i18n:formfields_config_uploadInvoiceOption_help_erp#}
    <li><p>Invoice generation and upload is done by magnalister</p>

        <p>Select this option if you want magnalister to handle the creation and upload of invoices for you. To do so,
            fill
            in
            the fields under "Data for invoice creation by magnalister". The transmission takes place every 60
            min.</p></li>
</ol>',
    ),
    'config_invoice_invoiceDir'                       => array(
        'label'      => 'Uploaded invoices',
        'buttontext' => 'Show',
    ),
    'config_invoice_mailCopy'                         => array(
        'label' => 'Mail with copy of invoice to',
        'help'  => 'Enter your email address here in order to receive a copy of the uploaded invoice by email.',
    ),
    'config_invoice_invoiceNumberPrefix'              => array(
        'label'   => 'Prefix invoice number',
        'hint'    => 'If you enter a prefix here, it will be placed before the invoice number. Example: R10000. Invoices generated by magnalister start with the number 10000.',
        'default' => 'R', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_reversalInvoiceNumberPrefix'      => array(
        'label'   => 'Prefix reversal invoice number',
        'hint'    => 'If you enter a prefix here, it will be placed before the reversal invoice number. Example: S20000. Reversal invoices generated by magnalister start with the number 20000.',
        'default' => 'S', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_invoiceNumber'                    => array(
        'label' => 'Invoice number',
        'help'  => '<p>
Choose here if you want to have your invoice numbers generated by magnalister or if you want them to be taken from a {#i18n:shop_order_attribute_name#} field.
</p><p>
<b>Create invoice numbers via magnalister</b>
</p><p>
magnalister generates consecutive invoice numbers during the invoice creation. You can define a prefix that is set in front of the invoice number. Example: R10000.
</p><p>
Note: Invoices created by magnalister start with the number 10000.
</p><p>
<b>Match invoice numbers with {#i18n:shop_order_attribute_name#} field</b>
</p><p>
When creating the invoice, the value is taken from the {#i18n:shop_order_attribute_name#} field you selected.
</p><p>
{#i18n:shop_order_attribute_creation_instruction#}
</p><p>
<b>Important:</b><br/> magnalister generates and transmits the invoice as soon as the order is marked as shipped. Please make sure that the free text field is filled, otherwise an error will be caused (see tab "Error Log").
<br/><br/>
If you use free text field matching, magnalister is not responsible for the correct, consecutive creation of invoice numbers.
</p>'
    ),
    'config_invoice_invoiceNumberOption'              => array(
        'label' => '',
    ),
    'config_invoice_reversalInvoiceNumber'            => array(
        'label' => 'Reversal invoice number',
        'help'  => '<p>
Choose here if you want to have your reversal invoice numbers generated by magnalister or if you want them to be taken from a {#i18n:shop_order_attribute_name#} field.
</p><p>
<b>Create reversal invoice numbers via magnalister</b>
</p><p>
magnalister generates consecutive reversal invoice numbers during the invoice creation. You can define a prefix that is set in front of the reversal invoice number. Example: R10000.
</p><p>
Note: Invoices created by magnalister start with the number 10000.
</p><p>
<b>Match reversal invoice numbers with {#i18n:shop_order_attribute_name#} field</b>
</p><p>
When creating the invoice, the value is taken from the {#i18n:shop_order_attribute_name#} field you selected.
</p><p>
{#i18n:shop_order_attribute_creation_instruction#}
</p><p>
<b>Important:</b><br/>magnalister generates and transmits the invoice as soon as the order is marked as shipped. Please make sure that the free text field is filled, otherwise an error will be caused (see tab "Error Log").
<br/><br/>
If you use free text field matching, magnalister is not responsible for the correct, consecutive creation of reversal invoice numbers.
</p>'
    ),
    'config_invoice_reversalInvoiceNumberOption'      => array(
        'label' => '',
    ),
    'config_invoice_invoiceNumberPrefixValue'         => array(
        'label' => 'Prefix invoice number',
    ),
    'config_invoice_reversalInvoiceNumberPrefixValue' => array(
        'label' => 'Prefix reversal invoice number',
    ),
    'config_invoice_invoiceNumberMatching'            => array(
        'label' => 'Shopware order free text field',
    ),
    'config_invoice_reversalInvoiceNumberMatching'    => array(
        'label' => 'Shopware order free text field',
    ),
    'config_invoice_companyAddressLeft'               => array(
        'label'   => 'Company address field (left side)',
        'default' => 'Your name, Your street 1, 12345 Your town', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_companyAddressRight'              => array(
        'label'   => 'Company address field (right side)',
        'default' => "Your name\nYour street 1\n\n12345 Your town", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_headline'                         => array(
        'label'   => 'Heading invoice',
        'default' => 'Your Invoice', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_invoiceHintHeadline'              => array(
        'label'   => 'Heading invoice notes',
        'default' => 'Invoice notes', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_invoiceHintText'                  => array(
        'label'   => 'Information text',
        'hint'    => 'Leave blank if no information should appear on the invoice',
        'default' => 'Your information text for the invoice', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_footerCell1'                      => array(
        'label'   => 'Footer column 1',
        'default' => "Your name\nYour street 1\n\n12345 Your town", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_footerCell2'                      => array(
        'label'   => 'Footer column 2',
        'default' => "Your telephone number\nYour fax number\nYour homepage\nYour e-mail", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_footerCell3'                      => array(
        'label'   => 'Footer column 3',
        'default' => "Your tax number\nYour Ust. ID. No.\nYour jurisdiction\nYour details", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_footerCell4'                      => array(
        'label'   => 'Footer column 4',
        'default' => "Additional\nInformation\nin the fourth\ncolumn", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_preview'                          => array(
        'label'      => 'Invoice preview',
        'buttontext' => 'Show',
        'hint'       => 'Here you can display a preview of your invoice with the data you have entered.',
    ),
    'erpInvoiceSource'                                => array(
        'label'      => 'Source server path for invoices',
        'help'       => '<p>Select the server path to the folder where you upload the invoices from your third-party system (e.g. ERP) as PDF.</p>

    <b>Important note:</b> <br>
<p>In order for magnalister to match a PDF invoice to a web shop order, the PDF files must be named according to one of the two following patterns:</p>
<ol>
    <li><p>Name according to the web shop order</p>

        <p>Pattern: #shop-order-id#.pdf</p>

        <p>Example:  <br>
            Shop order ID: 12345678<br>
            Invoice PDF should be named: 12345678.pdf</p>
    </li>
    <li>
        <p>Name according to the web shop order + invoice number from ERP system</p>

        <p>Pattern: #shop-order-id#_#invoice-number#.pdf</p>

        <p>Example: <br>
            Shop order ID: 12345678<br>
            Invoice number from ERP: 9876543<br>
            Invoice PDF should be named: 12345678_9876543.pdf </p>
    </li>
</ol>',
        'hint'       => '',
        'buttontext' => '{#i18n:form_text_choose#}',

    ),
    'erpInvoiceDestination'                           => array(
        'label'      => 'Destination server path for invoices transmitted to {#setting:currentMarketplaceName#}',
        'help'       => '<p>After magnalister has uploaded an invoice from the source folder to {#setting:currentMarketplaceName#}, it is moved to the destination folder. This allows merchants to track which invoices have already been submitted to {#setting:currentMarketplaceName#}.</p>
<p>Select here the server path to the destination folder where the invoices uploaded to {#setting:currentMarketplaceName#} should be moved to.</p>
<p><b>Important note:</b> If you do not select a different destination folder for invoices uploaded to {#setting:currentMarketplaceName#}, you will not be able to see which invoices have already been uploaded to {#setting:currentMarketplaceName#}.</p>',
        'hint'       => '',
        'buttontext' => '{#i18n:form_text_choose#}',
    ),
    'erpReversalInvoiceSource'                        => array(
        'label'      => 'Source server path for credit notes',
        'help'       => '<p>Select the server path to the folder where the credit notes from your third-party system (e.g. ERP) are stored as PDFs.</p>

    <b>Important note:</b> <br>
<p>In order for magnalister to match a credit note PDF to a web shop order, the PDF files must be named according to one of the two following patterns:</p>
<ol>
    <li><p>Name according to the web shop order</p>

        <p>Pattern: #shop-order-id#.pdf</p>

        <p>Example:  <br>
            Shop order ID: 12345678<br>
            Credit note PDF should be named: 12345678.pdf</p>
    </li>
    <li>
        <p>Name according to the web shop order + credit note  number from ERP system</p>

        <p>Pattern: #shop-order-id#_#credit-note-number#.pdf</p>

        <p>Example: <br>
            Shop order ID: 12345678<br>
            Credit note number from ERP: 9876543<br>
            Credit note PDF should be named: 12345678_9876543.pdf </p>
    </li>
</ol>',
        'hint'       => '',
        'buttontext' => '{#i18n:form_text_choose#}',
    ),
    'erpReversalInvoiceDestination'                   => array(
        'label'      => 'Destination server path for credit notes transmitted to {#setting:currentMarketplaceName#}',
        'help'       => '<p>After magnalister has uploaded a credit note from the source folder to {#setting:currentMarketplaceName#}, it is moved to the destination folder. This allows merchants to track which credit notes have already been submitted to {#setting:currentMarketplaceName#}.</p>
<p>Select here the server path to the destination folder where the credit notes uploaded to {#setting:currentMarketplaceName#} should be moved to.</p>
<p><b>Important note:</b> If you do not select a different destination folder for credit notes uploaded to {#setting:currentMarketplaceName#}, you will not be able to see which credit notes have already been uploaded to {#setting:currentMarketplaceName#}.</p>',
        'hint'       => '',
        'buttontext' => '{#i18n:form_text_choose#}',

    ),
));


MLI18n::gi()->{'formfields_config_invoice_invoiceNumberOption_values_magnalister'} = 'Create invoice numbers via magnalister';
MLI18n::gi()->{'formfields_config_invoice_invoiceNumberOption_values_matching'} = 'Match invoice numbers with {#i18n:shop_order_attribute_name#} field';

MLI18n::gi()->add('formfields_uploadInvoiceOption_values', array(
    'off'     => 'Do not upload invoices to {#setting:currentMarketplaceName#}',
    'webshop' => 'Invoices created in the web shop are uploaded to {#setting:currentMarketplaceName#}',
    'erp'     => 'Invoices created in the third-party system (e.g. ERP) are uploaded to {#setting:currentMarketplaceName#}',
    'magna'   => 'Invoice generation and upload is done by magnalister',
));

MLI18n::gi()->{'formfields_config_uploadInvoiceOption_help_erp'} = '<li><p>Invoices created by third-party systems (e.g. ERP system) are uploaded to {#setting:currentMarketplaceName#}</p>

        <p>Invoices created with your third-party system (e.g. ERP) can be uploaded to your webshop server, retrieved by
            magnalister and uploaded to {#setting:currentMarketplaceName#}. More information appears after selecting this option in the info icon
            under
            "Settings for the transmission of invoices created from a third-party system [...]".</p></li>';
MLI18n::gi()->{'formfields_config_uploadInvoiceOption_help_webshop'} = '<li><p>Invoices created in the web shop are uploaded to {#setting:currentMarketplaceName#}</p>


        <p>If your shop system has the ability to create invoices, they will be automatically uploaded to {#setting:currentMarketplaceName#} every 60
            minutes.</p></li>';
