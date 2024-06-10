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
MLI18n::gi()->{'idealo_config_carrier_option_group_shopfreetextfield_option_carrier'} = 'Transportunternehmen aus einem Webshop-Freitextfeld (Bestellungen) wählen';

MLI18n::gi()->idealo_config_account_title = 'Zugangsdaten';
MLI18n::gi()->idealo_config_account_prepare = 'Artikelvorbereitung';
MLI18n::gi()->idealo_config_account_price = 'Preisberechnung';
MLI18n::gi()->idealo_config_account_sync = 'Synchronisation';
MLI18n::gi()->idealo_config_account_orderimport = 'Bestellimport';
MLI18n::gi()->idealo_config_account_emailtemplate = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->idealo_config_message_no_csv_table_yet = 'Noch keine CSV-Tabelle erstellt: Bitte stellen Sie zuerst Artikel ein. Danach finden Sie hier den CSV-Pfad.';
MLI18n::gi()->idealo_methods_not_available = 'Bitte hinterlegen und speichern Sie erst den Direktkauf-Token unter „Bestellimport > Zugangsdaten für Idealo Direktkauf"';

MLI18n::gi()->idealo_configform_orderimport_payment_values = array(
    'textfield' => array(
        'title' => 'Aus Textfeld',
        'textoption' => true
    ),
    'matching' => array(
        'title' => '{#i18n:marketplace_configuration_orderimport_payment_method_from_marketplace#}',
    ),
);

MLI18n::gi()->idealo_switching_to_moapiv2_popup_title = 'Umstellung auf idealo Direktkauf Merchant Order API v2';
MLI18n::gi()->idealo_switching_to_moapiv2_popup_text = 'Seit 01.01.2021 unterstützt magnalister die idealo Direktkauf Merchant Order API v2. Die Merchant Order API v1 wird bald abgeschaltet.
<br><br>
Bitte generieren Sie in Ihrem idealo Business Account eine “Client ID” und ein “Client Passwort” und tragen Sie die Daten in der magnalister idealo Konfiguration unter “Zugangsdaten” -> “idealo Direktkauf” ein.
<br><br>
Eine Anleitung zur Umstellung finden Sie im Info-Icon neben “idealo Direktkauf verwenden”.
';