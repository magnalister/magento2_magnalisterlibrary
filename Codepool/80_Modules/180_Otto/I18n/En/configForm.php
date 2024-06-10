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

MLI18n::gi()->otto_config_account_title = 'Access Data';
MLI18n::gi()->add('otto_config_account', array(
    'legend' => array(
        'account' => 'Access Data',
        'tabident' => 'Tab'
    ),
    'field' => array(
        'tabident' => array(
            'label' => '{#i18n:ML_LABEL_TAB_IDENT#}',
            'help' => '{#i18n:ML_TEXT_TAB_IDENT#}'
        ),
        'token' => array(
            'label' => 'OTTO API-Token'
        ),
    ),
), false);
MLI18n::gi()->add('otto_config_prepare__field__vat', array(
    'label' => 'VAT',
    'help' => 'You must have at least one VAT defined in the shop system',
    'hint' => '',
    'matching' => array(
        'titlesrc' => 'Shop Tax Classes',
        'titledst' => 'OTTO Market Tax Codes',
    )
));
MLI18n::gi()->otto_config_account_prepare = 'Product Preparation';
MLI18n::gi()->add('otto_config_prepare', array(
    'legend' => array(
        'prepare' => 'Product Preparation',
        'pictures' => 'Einstellungen f&uuml;r Bilder',
        'shipping' => 'Shipping',
        'upload' => 'Product Upload',
    ),
    'field' => array(
        'freightforwarding' => array(
            'label' => 'Lieferung per Spedition',
            'help' => '',
        ),
        'processingtime' => array(
            'label' => 'Processing time',
            'help' => 'Enter here how many working days it takes from the time of the order by the customer until the package is received',
        ),
        'shippingtype' => array(
            'label' => 'Shipping type',
            'help' => 'Enter the shipping type. Available values PARCEL and FORWARDER',
        ),
    )
), false);

MLI18n::gi()->otto_config_account_sync = 'Price and Stock';
MLI18n::gi()->otto_config_account_orderimport = 'Orders';
MLI18n::gi()->otto_config_account_orderimport_returntrackingkey_title = 'Return Tracking Key';
MLI18n::gi()->{'otto_config_free_text_attributes_opt_group'} = 'Free text fields';
MLI18n::gi()->{'otto_config_free_text_attributes_opt_group_value'} = 'Match it to magnalister free text field on specific order';
MLI18n::gi()->otto_config_account_orderimport_returntrackingkey_info = 'For Standard Shipping Service "Return Tracking Key" is required filed on OTTO Market marketplace. Since shop system does not provide such fields as standard option we need to match it to custom filed.';

MLI18n::gi()->{'otto_config_carrier_option_group_marketplace_carrier'} = 'Select Marketplace Supported Carrier:';
MLI18n::gi()->{'otto_config_carrier_option_group_additional_option'} = 'Additional option:';
MLI18n::gi()->{'otto_config_carrier_option_matching_option'} = 'Match marketplace supported carrier with carriers defined in shop-system';
MLI18n::gi()->{'otto_config_carrier_matching_title_marketplace_carrier'} = 'Marketplace supported carriers';
MLI18n::gi()->{'otto_config_carrier_matching_title_shop_carrier'} = 'Carriers defined in the shop-system (shipping module)';

MLI18n::gi()->{'formgroups_legend_quantity'} = 'Stock';
MLI18n::gi()->{'formfields__price__label'} = 'Price';

// added labels becaouse of warning on WooCommerce
MLI18n::gi()->{'formfields__price.addkind__label'} = '';
MLI18n::gi()->{'formfields__price.factor__label'} = '';
MLI18n::gi()->{'formfields__price.signal__label'} = '';

MLI18n::gi()->{'formfields__price__hint'} = '<span style="color: red">The shipping surcharge selected under "Article preparation" is added to the price defined here</span>';
MLI18n::gi()->{'formfields__price__help'} = 'Enter a percentage or fixed price surcharge or discount. Discount with a minus sign in front.<br><br><span style="color: red">The shipping surcharge selected under "Article preparation" is added to the price defined here</span>';
MLI18n::gi()->{'formfields__stocksync.tomarketplace__help'} = '
            Hint: idealo supports only "available" and "not available" for your offers.<br />
            <br />
            Stock shop > 0 = availible on {#i18n:sModuleNameOtto#}<br />
            Stock shop < 1 = not avilible on {#i18n:sModuleNameOtto#}<br />
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
';

MLI18n::gi()->add('otto_config_order', array(
    'legend' => array(
        'orderimport' => 'Basic Order Settings',
        'mwst' => 'VAT',
        'orderstatusimport' => 'Order Status: Import (Marketplace to Shop)',
        'orderstatus' => 'Order Status: Synchronisation (Shop to Marketplace)',
        'paymentandshipping' => 'Payment and Shipping Service of the Orders'
    ),
    'field' => array(
        'importactive' => array(
            'label' => 'Activate Import',
            // 'hint' => 'Please note: Orders from the OTTO marketplace are automatically accepted when they are handed over to the web shop (order import).',
        ),
    )
));
MLI18n::gi()->{'sOtto_automatically'} = '-- allocate automatically --';

MLI18n::gi()->{'otto_config_matching_options'} = 'Matching Options';
MLI18n::gi()->{'otto_config_matching_shop_values'} = 'Shop Values';
MLI18n::gi()->{'otto_config_matching_otto_values'} = 'OTTO Values';

/*----- Remove below -------*/
MLI18n::gi()->otto_config_general_autosync = 'Automatische Synchronisierung per CronJob (empfohlen)';
MLI18n::gi()->otto_config_general_nosync = 'keine Synchronisierung';
MLI18n::gi()->otto_config_account_price = 'Preisberechnung';
MLI18n::gi()->otto_config_account_emailtemplate = 'Promotion-E-Mail Template';
MLI18n::gi()->otto_config_account_producttemplate = 'Produkt Template';

MLI18n::gi()->otto_configform_orderstatus_sync_values = array(
    'auto' => '{#i18n:otto_config_general_autosync#}',
    'no' => '{#i18n:otto_config_general_nosync#}',
);
MLI18n::gi()->otto_configform_sync_values = array(
    'auto' => '{#i18n:otto_config_general_autosync#}',
    'no' => '{#i18n:otto_config_general_nosync#}',
);
MLI18n::gi()->otto_configform_stocksync_values = array(
    'rel' => 'Bestellung reduziert Shop-Lagerbestand (empfohlen)',
    'no' => '{#i18n:otto_config_general_nosync#}',
);
MLI18n::gi()->otto_configform_pricesync_values = array(
    'auto' => '{#i18n:otto_config_general_autosync#}',
    'no' => '{#i18n:otto_config_general_nosync#}',
);

MLI18n::gi()->otto_configform_orderimport_payment_values = array(
    'textfield' => array(
        'title' => 'Aus Textfeld',
        'textoption' => true
    ),
    'matching' => array(
        'title' => 'Automatische Zuordnung',
    ),
);

MLI18n::gi()->otto_configform_orderimport_shipping_values = array(
    'textfield' => array(
        'title' => 'Aus Textfeld',
        'textoption' => true
    ),
    'matching' => array(
        'title' => 'Automatische Zuordnung',
    ),
);

MLI18n::gi()->otto_config_sync_inventory_import = array(
    'true' => 'Ja',
    'false' => 'Nein'
);

MLI18n::gi()->otto_config_account_emailtemplate_sender = 'Beispiel-Shop';
MLI18n::gi()->otto_config_account_emailtemplate_sender_email = 'beispiel@onlineshop.de';
MLI18n::gi()->otto_config_account_emailtemplate_subject = 'Ihre Bestellung bei #SHOPURL#';
MLI18n::gi()->otto_config_producttemplate_content = '<p>#TITLE#</p>'.
    '<p>#ARTNR#</p>'.
    '<p>#SHORTDESCRIPTION#</p>'.
    '<p>#PICTURE1#</p>'.
    '<p>#PICTURE2#</p>'.
    '<p>#PICTURE3#</p>'.
    '<p>#DESCRIPTION#</p>';
MLI18n::gi()->otto_config_emailtemplate_content = '
 <style><!--
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
<p>Hallo #FIRSTNAME# #LASTNAME#,</p>
<p>vielen Dank f&uuml;r Ihre Bestellung! Sie haben &uuml;ber #MARKETPLACE# in unserem Shop folgendes bestellt:</p>
#ORDERSUMMARY#
<p>Zuz&uuml;glich etwaiger Versandkosten.</p>
<p>&nbsp;</p>
<p>Mit freundlichen Gr&uuml;&szlig;en,</p>
<p>Ihr Online-Shop-Team</p>';

MLI18n::gi()->{'formfields__importactive__hint'} = '';
