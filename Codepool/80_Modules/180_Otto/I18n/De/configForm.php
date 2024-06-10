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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLI18n::gi()->otto_config_account_title = 'Zugangsdaten';
MLI18n::gi()->add('otto_config_account', array(
    'legend' => array(
        'account' => 'Zugangsdaten',
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
    'label' => 'Steuern',
    'help' => 'Sie müssen mindestens eine VAT im Shopsystem definiert haben.',
    'hint' => '',
    'matching' => array(
        'titlesrc' => 'Shop-Steuerklassen',
        'titledst' => 'OTTO-Steuer-Codes',
    )
));
MLI18n::gi()->otto_config_account_prepare = 'Artikelvorbereitung';
MLI18n::gi()->add('otto_config_prepare', array(
    'legend' => array(
        'prepare' => 'Artikelvorbereitung',
        'pictures' => 'Einstellungen f&uuml;r Bilder',
        'shipping' => 'Versand',
        'upload' => 'Artikel hochladen: Voreinstellungen',
    ),
), false);

MLI18n::gi()->otto_config_account_sync = 'Preis und Lager';
MLI18n::gi()->otto_config_account_orderimport = 'Bestellungen';
MLI18n::gi()->otto_config_account_orderimport_returntrackingkey_title = 'Retouren-Sendungsnummer';
MLI18n::gi()->{'otto_config_free_text_attributes_opt_group'} = 'Zusatzfelder';
MLI18n::gi()->{'otto_config_free_text_attributes_opt_group_value'} = 'magnalister fügt ein Feld unter “Bestell-Details” in den Bestellungen hinzu';
MLI18n::gi()->otto_config_account_orderimport_returntrackingkey_info = 'Für den Standard-Versandservice ist auf dem OTTO-Marktplatz das Feld "Retouren-Sendungsnummer" erforderlich. Da das Shopsystem solche Felder nicht als Standardoption anbietet, müssen wir es an das benutzerdefinierte Felder anpassen.';

MLI18n::gi()->{'otto_config_carrier_option_group_marketplace_carrier'} = 'Vom Marktplatz unterstützte Versanddienstleister:';
MLI18n::gi()->{'otto_config_carrier_option_group_additional_option'} = 'Zusätzliche Option:';
MLI18n::gi()->{'otto_config_carrier_option_matching_option'} = 'Matchen der vom Marktplatz unterstützten Versanddienstleister mit den im Shop-System definierten Versanddienstleister';
MLI18n::gi()->{'otto_config_carrier_matching_title_marketplace_carrier'} = 'Vom Marketplace unterstützte Versanddienstleister';
MLI18n::gi()->{'otto_config_carrier_matching_title_shop_carrier'} = 'Im Shop-System definierte Versanddienstleister (Versandoptionen)';
MLI18n::gi()->{'formgroups_legend_quantity'} = 'Lager';

MLI18n::gi()->{'otto_config_order__legend__orderstatusimport'} = 'Status der Bestellung: Import (Marktplatz zum Shop)';
MLI18n::gi()->{'otto_config_order__legend__paymentandshipping'} = 'Zahlungs- und Versandservice der Bestellungen';
MLI18n::gi()->{'otto_config_order__legend__orderstatus'} = 'Status der Bestellung: Synchronisation (Shop zum Marktplatz)';

MLI18n::gi()->{'sOtto_automatically'} = '-- Automatisch zuordnen --';

MLI18n::gi()->{'otto_config_matching_options'} = 'Matching Options';
MLI18n::gi()->{'otto_config_matching_shop_values'} = 'Shop Values';
MLI18n::gi()->{'otto_config_matching_otto_values'} = 'OTTO Market Values';

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
