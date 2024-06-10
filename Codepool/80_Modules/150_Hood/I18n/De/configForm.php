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

MLI18n::gi()->hood_config_general_autosync = 'Automatische Synchronisierung per CronJob (empfohlen)';
MLI18n::gi()->hood_config_general_nosync = 'keine Synchronisierung';
MLI18n::gi()->hood_config_account_title = 'Zugangsdaten';
MLI18n::gi()->hood_config_account_prepare = 'Artikelvorbereitung';
MLI18n::gi()->hood_config_account_price = 'Preisberechnung';
MLI18n::gi()->hood_config_account_sync = 'Synchronisation';
MLI18n::gi()->hood_config_account_orderimport = 'Bestellimport';
MLI18n::gi()->hood_config_account_emailtemplate = 'Promotion-E-Mail Template';
MLI18n::gi()->hood_config_account_producttemplate = 'Produkt Template';

MLI18n::gi()->hood_configform_prepare_hitcounter_values = array(
    'NoHitCounter' => 'keiner',
    'BasicStyle' => 'einfach',
    'RetroStyle' => 'Retro-Style',
    'HiddenStyle' => 'versteckt',
);
MLI18n::gi()->hood_configform_prepare_dispatchtimemax_values = array(
    '0' => 'am gleichen Tag',
    '1' => '1 Tag',
    '2' => '2 Tage',
    '3' => '3 Tage',
    '4' => '4 Tage',
    '5' => '5 Tage',
    '6' => '6 Tage',
    '7' => '7 Tage',
    '8' => '8 Tage',
    '9' => '9 Tage',
    '10' => '10 Tage',
    '11' => '11 Tage',
    '12' => '12 Tage',
    '13' => '13 Tage',
    '14' => '14 Tage',
    '15' => '15 Tage',
    '16' => '16 Tage',
    '17' => '17 Tage',
    '18' => '18 Tage',
    '19' => '19 Tage',
    '20' => '20 Tage',
    '21' => '21 Tage',
    '22' => '22 Tage',
    '23' => '23 Tage',
    '24' => '24 Tage',
    '25' => '25 Tage',
    '26' => '26 Tage',
    '27' => '27 Tage',
    '28' => '28 Tage',
    '29' => '29 Tage',
    '30' => '30 Tage',
);
MLI18n::gi()->hood_configform_price_chinese_quantityinfo = 'Bei Steigerungsauktionen kann die St&uuml;ckzahl nur genau 1 betragen.';
MLI18n::gi()->hood_configform_account_sitenotselected = 'Bitte erst Hood.de-Site w&auml;hlen';
MLI18n::gi()->hood_configform_orderstatus_sync_values = array(
    'auto' => '{#i18n:hood_config_general_autosync#}',
    'no' => '{#i18n:hood_config_general_nosync#}',
);
MLI18n::gi()->hood_configform_sync_values = array(
    'auto' => '{#i18n:hood_config_general_autosync#}',
    //'auto_fast' => 'Schnellere automatische Synchronisation cronjob (auf 15 Minuten)',
    'no' => '{#i18n:hood_config_general_nosync#}',
);
MLI18n::gi()->hood_configform_stocksync_values = array(
    'rel' => 'Bestellung reduziert Shop-Lagerbestand (empfohlen)',
    'no' => '{#i18n:hood_config_general_nosync#}',
);
MLI18n::gi()->hood_configform_pricesync_values = array(
    'auto' => '{#i18n:hood_config_general_autosync#}',
    'no' => '{#i18n:hood_config_general_nosync#}',
);

MLI18n::gi()->hood_configform_sync_chinese_values = array(
    'auto' => '{#i18n:hood_config_general_autosync#}',
    'no' => '{#i18n:hood_config_general_nosync#}',
);
MLI18n::gi()->hood_configform_orderimport_payment_values = array(
    'textfield' => array(
        'title' => 'Aus Textfeld',
        'textoption' => true
    ),
    'matching' => array(
        'title' => 'Vom Marktplatz übernehmen',
    ),
);

MLI18n::gi()->hood_configform_orderimport_shipping_values = array(
    'textfield' => array(
        'title' => 'Aus Textfeld',
        'textoption' => true
    ),
    'matching' => array(
        'title' => 'Vom Marktplatz übernehmen',
    ),
);

MLI18n::gi()->hood_config_sync_inventory_import = array(
    'true' => 'Ja',
    'false' => 'Nein'
);

MLI18n::gi()->hood_config_account_emailtemplate_sender = 'Beispiel-Shop';
MLI18n::gi()->hood_config_account_emailtemplate_sender_email = 'beispiel@onlineshop.de';
MLI18n::gi()->hood_config_account_emailtemplate_subject = 'Ihre Bestellung bei #SHOPURL#';
MLI18n::gi()->hood_config_producttemplate_content = '<p>#TITLE#</p>' .
        '<p>#ARTNR#</p>' .
        '<p>#SHORTDESCRIPTION#</p>' .
        '<p>#PICTURE1#</p>' .
        '<p>#PICTURE2#</p>' .
        '<p>#PICTURE3#</p>' .
        '<p>#DESCRIPTION#</p>';
MLI18n::gi()->hood_config_emailtemplate_content = '
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

MLI18n::gi()->add('hood_config_account', array(
    'legend' => array(
        'account' => 'Zugangsdaten',
        'tabident' => 'Tab'
    ),
    'field' => array(
        'tabident' => array(
            'label' => '{#i18n:ML_LABEL_TAB_IDENT#}',
            'help' => '{#i18n:ML_TEXT_TAB_IDENT#}'
        ),
        
        'mpusername' => array(
            'label' => 'Hood.de-Mitgliedsname',
            'help' => 'Bitte hier den Hood.de-Usernamen eintragen',
            'hint' => '',
        ),
        'mppassword' => array(
            'label' => 'Hood.de-Passwort',
            'help' => 'Bitte hier das Hood.de-Passwort eintragen',
        ),
             'apikey' => array(
            'label' => 'Hood.de-API Passwort',
            'help' => '',
        ),
        
        'token' => array(
            'label' => 'Hood.de-Token',
            'help' => 'Um einen neuen Hood.de-Token zu beantragen, klicken Sie bitte auf den Button.<br>
                                Sollte kein Fenster zu Hood.de aufgehen, wenn Sie auf den Button klicken, haben Sie einen Pop-Up Blocker aktiv.<br><br>
                                    Der Token ist notwendig, um &uuml;ber elektronische	Schnittstellen wie den magnalister Artikel auf Hood.de einzustellen und zu verwalten.<br>
                                    Folgen Sie von da an den Anweisungen auf der Hood.de Seite, um den Token zu beantragen und Ihren Online-Shop &uuml;ber magnalister mit Hood.de zu verbinden.',
        ),
        'site' => array(
            'label' => 'Hood.de Site',
            'help' => 'Hood.de-L&auml;nderseite, auf der gelistet wird',
        ),
        'currency' => array(
            'label' => 'W&auml;hrung',
            'help' => 'Die W&auml;hrung, in der Artikel auf Hood.de gelistet werden. Bitte w&auml;hlen Sie eine W&auml;hrung passend zur Hood.de-L&auml;nderseite',
        ),
    ),
), false);


MLI18n::gi()->add('hood_config_prepare', array(
    'legend' => array(
        'prepare' => 'Artikelvorbereitung',
        'location' => array(
            'title' => 'Standort',
            'info' => 'Geben Sie bitte hier den Standort Ihres Shops ein. Dieser ist dann als Verk&auml;uferadresse auf der Artikelseite bei Hood.de sichtbar. '
        ),
        'pictures' => 'Einstellungen f&uuml;r Bilder',
        'payment' => '<b>Einstellungen f&uuml;r Zahlungsarten</b>',
        'shipping' => 'Versand',
        'misc' => '<b>Einstellungen Sonstiges</b>',
        'upload' => 'Artikel hochladen: Voreinstellungen',
        'fixedprice' => '<b>Einstellungen f&uuml;r Festpreis-Listings</b>',
        'chineseprice' => '<b>Einstellungen f&uuml;r Steigerungsauktionen</b>',
    ),
    'field' => array(
        'postalcode' => array(
            'label' => 'PLZ',
            'help' => 'Geben Sie bitte hier den Standort Ihres Shops ein. Dieser ist dann als Verk&auml;uferadresse auf der Artikelseite bei Hood.de sichtbar. '
        ),
        'location' => array(
            'label' => 'Ort',
        ),
        'country' => array(
            'label' => 'Land',
        ),
        'mwst' => array(
            'label' => 'Mehrwertsteuer-Fallback',
            'help' => 'H&ouml;he der Mehrwertsteuer, die bei Hood.de ausgewiesen wird, falls nicht am Artikel hinterlegt. Werte ungleich 0 nur erlaubt, wenn Sie ein gewerbliches Konto bei Hood.de haben.',
            'hint' => '&nbsp;Steuersatz f&uuml;r gewerbliche H&auml;ndler in %',
        ),
        'forcefallback' => array(
            'label' => 'Immer Fallback verwenden',
            'help' => 'Wenn aktiviert, wird immer der Fallback-Wert für die Mehrwertsteuer verwendet, unabhängig davon, was am Artikel hinterlegt ist.',
        ),
        'conditiontype' => array(
            'label' => 'Artikelzustand',
            'help' => 'Voreinstellung f&uuml den Artikelzustand (f&uuml;r Hood.de-Kategorien wo dieser angegeben werden kann oder mu&szlig;). Nicht alle Werte sind f&uuml;r jede Kategorie zul&auml;ssig, ggf. mu&szlig; nach der Wahl der Kategorie der Zustand noch mal korrigiert werden.',
        ),
        'lang' => array(
            'label' => 'Sprache',
            'help' => 'Sprache f&uuml;r Ihre Artikelnamen und Beschreibungen. Ihr Shop erm&ouml;glicht es, 
					Namen und Beschreibungen in mehreren Sprachen zu hinterlegen. F&uuml;r Hood.de-Artikelnamen und Beschreibungen mu&szlig; eine davon ausgew&auml;lt werden.
					In derselben Sprache kommen auch etwaige Fehlermeldungen von Hood.de.',
        ),
         'shippingtime.min' => array(
            'label' => 'Lieferzeit in Tagen (min)',
            'help'  => 'Tragen Sie hier die k&uuml;rzeste Lieferzeit ein (als Zahl). Verwenden Sie 0, wenn Sie am gleichen Tag liefern. Wenn Sie hier keine Zahl eintragen, wird der in Ihrem Hood.de Konto hinterlegte Wert verwendet.'
        ),
         'shippingtime.max' => array(
            'label' => 'Lieferzeit in Tagen (max)',
            'help'  => 'Tragen Sie hier die l&auml;ngste Lieferzeit ein (als Zahl). Verwenden Sie 0, wenn Sie am gleichen Tag liefern. Wenn Sie hier keine Zahl eintragen, wird der in Ihrem Hood.de Konto hinterlegte Wert verwendet.'
        ),
        'dispatchtimemax' => array(
            'label' => 'Zeit bis Versand',
            'help' => 'Maximale Dauer die Sie brauchen, bis Sie den Artikel versenden. Der Wert wird bei Hood.de angezeigt.',
        ),
        'topten' => array(
            'label' => 'Kategorie-Schnellauswahl',
            'help' => 'Anzeigen der Kategorie-Schnellauswahl unter Produkte vorbereiten',
        ),
        'variationdimensionforpictures' => array(
            'label' => 'Bilderpaket Varianten-Ebene',
            'help' => '
                Sollten Sie Variantenbilder an Ihren Artikel gepflegt haben, werden diese mit Aktivierung von "Bilderpaket" zu Hood.de übermittelt.<br>
                Hierbei läßt Hood.de nur eine zu verwendende Varianten-Ebene zu (wählen Sie z. B. "Farbe", so zeigt Hood.de jeweils ein anderes Bild an, wenn der Käufer eine andere Farbe auswählt).<br>
                Sie können in der Produkt-Vorbereitung jederzeit den hier hinterlegten Standard-Wert für die getroffene Auswahl individuell abändern.<br><br>
                Nachträgliche Änderungen bedürfen einer Anpassung der Vorbereitung und eine erneute Übermittlung der betroffenen Produkte.
            ',
        ),
     
        'paymentmethods' => array(
            'label' => 'Zahlungsart',
            'help' => 'Voreinstellung f&uuml;r Zahlungsarten (Mehrfach-Auswahl mit Strg+Klick). Auswahl nach Vorgabe von Hood.de.',
        ),
        'paypal.address' => array(
            'label' => 'PayPal E-Mail-Adresse',
            'help' => 'E-Mail-Adresse, die Sie bei Hood.de f&uuml;r PayPal-Zahlungen angegeben haben. Pflicht, wenn Sie Hood.de-Store-Artikel hochladen.'
        ),
        'paymentinstructions' => array(
            'label' => 'Weitere Angaben zur Kaufabwicklung',
            'help' => 'Geben Sie hier einen Text ein, der am unteren Ende der Artikel-Ansicht unter "Zahlungshinweise des Verk&auml;ufers" erscheint. Erlaubt sind bis zu 500 Zeichen (nur Text, kein HTML).'
        ),
  
        'shippinglocalcontainer' => array(
            'label' => 'Versand Inland',
            'help' => 'Mindestens eine oder mehrere Versandarten ausw&auml;hlen, die standardm&auml;&szlig;ig verwendet werden soll.<br /><br />Bei den Versandkosten k&ouml;nnen Sie eine Zahl eintragen (ohne Angabe der W&auml;hrung) oder "=GEWICHT", um die Versandkosten gleich dem Artikelgewicht zu setzen.',
        ),
        'shippinginternationalcontainer' => array(
            'label' => 'Versand Ausland',
            'help' => 'Keine oder mehrere Versandarten und L&auml;nder ausw&auml;hlen, die standardm&auml;&szlig;ig verwendet werden sollen.',
        ),
        'shippinglocal' => array(
            'cost' => 'Versandkosten'
        ),
        'shippinglocalprofile' => array(
            'option' => '{#NAME#} ({#AMOUNT#} je weiteren Artikel)',
            'optional' => array(
                'select' => array(
                    'false' => 'Versandprofil nicht anwenden',
                    'true' => 'Versandprofil anwenden',
                )
            )
        ),
        'shippinglocaldiscount' => array(
            'label' => 'Regeln f&uuml;r Versand zum Sonderpreis anwenden'
        ),
        'shippinginternationaldiscount' => array(
            'label' => 'Regeln f&uuml;r Versand zum Sonderpreis anwenden'
        ),
        'shippinginternational' => array(
            'cost' => 'Versandkosten',
            'optional' => array(
                'select' => array(
                    'false' => 'Nicht ins Ausland versenden',
                    'true' => 'Ins Ausland Versenden',
                )
            )
        ),
        'shippinginternationalprofile' => array(
            'option' => '{#NAME#} ({#AMOUNT#} je weiteren Artikel)',
            'notavailible' => 'Nur wenn `<i>Versand Ausland</i>` aktiv ist.',
            'optional' => array(
                'select' => array(
                    'false' => 'Versandprofil nicht anwenden',
                    'true' => 'Versandprofil anwenden',
                )
            )
        ),
        'returnsellerprofile' => array(
            'label' => 'Rahmenbedingungen: Rücknahme',
            'help' => '
                <b>Auswahl des Rahmenbedingungen-Profils für Rücknahme</b><br /><br />
                Sie verwenden die Funktion "Rahmenbedingungen für Ihre Angebote" auf Hood.de. Das bedeutet, dass Zahlungs-, Versand-, und Rücknahmeoptionen nicht mehr einzeln gewählt werden können, sondern von den Angaben im jeweiligen Profil auf Hood.de bestimmt werden.<br /><br />
                Bitte wählen Sie hier das bevorzugte Profil für die Rücknahmebedingungen.
            ',
            'help_subfields' => '
                <b>Hinweis</b>:<br />
                Dieses Feld ist nicht editierbar, da Sie die Hood.de Rahmenbedingungen nutzen. Bitte verwenden Sie das Auswahlfeld
                <b>Rahmenbedingungen: Rücknahme</b> um das Profil für die Rücknahmebedingungen festzulegen.
            '
        ),  
        'usevariations' => array(
            'label' => 'Varianten',
            'help' => 'Funktion aktiviert: Produkte, die in mehreren Varianten (wie Gr&ouml;&szlig;e oder Farbe) im Shop vorhanden sind, werden auch so an Hood.de &uuml;bermittelt.<br /><br /> Die Einstellung "St&uuml;ckzahl" wird dann auf jede einzelne Variante angewendet.<br /><br /><b>Beispiel:</b> Sie haben einen Artikel 8 mal in blau, 5 mal in gr&uuml;n und 2 mal in schwarz, unter St&uuml;ckzahl "Shop-Lagerbestand &uuml;bernehmen abzgl. Wert aus rechtem Feld", und den Wert 2 in dem Feld. Der Artikel wird dann 6 mal in blau und 3 mal in gr&uuml;n &uuml;bermittelt.<br /><br /><b>Hinweis:</b> Es kommt vor, da&szlig; etwas das Sie als Variante verwenden (z.B. Gr&ouml;&szlig;e oder Farbe) ebenfalls in der Attribut-Auswahl f&uuml;r die Kategorie erscheint. In dem Fall wird Ihre Variante verwendet, und nicht der Attributwert.',
            'valuehint' => 'Varianten &uuml;bermitteln'
        ),
        'useprefilledinfo' => array(
            'label' => 'Produktinfos',
            'help' => 'Funktion aktiviert: Falls es im Hood.de Katalog zu dem Produkt Detail-Informationen gibt, werden diese auf der Produktseite angezeigt. Dazu muß aber auch die EAN &uuml;bergeben werden.',
            'valuehint' => 'Hood.de Produktinfos anzeigen',
        ),
        'privatelisting' => array(
            'label' => 'Privat-Listings',
            'help' => 'Funktion aktiviert: Listings werden als \'privat\' gekennzeichnet, das hei&szlig;t, die K&auml;ufer- bzw. Bieterliste ist nicht &ouml;ffentlich einsehbar.',
            'valuehint' => 'K&auml;ufer / Bieterliste nicht &ouml;ffentlich',
        ),
        'hitcounter' => array(
            'label' => 'Besucherz&auml;hler',
            'help' => 'Voreinstellung f&uuml den Besucherz&auml;hler f&uuml;r die Listings.',
        ),
        'restrictedtobusiness' => array(
            'label' => 'Nur Gesch&auml;ftskunden',
            'help' => 'Funktion aktiviert: Artikel k&ouml;nnen nur von Gesch&auml;ftskunden gekauft werden.',
            'valuehint' => 'Artikel nur f&uuml;r Gesch&auml;ftskunden kaufbar',
        ),
        'imagesize' => array(
            'label' => 'Bildgr&ouml;&szlig;e',
            'help' => '<p>Geben Sie hier die Pixel-Breite an, die Ihr Bild auf dem Marktplatz haben soll.
Die H&ouml;he wird automatisch dem urspr&uuml;nglichen Seitenverh&auml;ltnis nach angepasst.</p>
<p>
Die Quelldateien werden aus dem Bildordner {#setting:sSourceImagePath#} verarbeitet und mit der hier gew&auml;hlten Pixelbreite im Ordner {#setting:sImagePath#}  f&uuml;r die &Uuml;bermittlung zum Marktplatz abgelegt.</p>',
            'hint' => 'Gespeichert unter: {#setting:sImagePath#}'
        ),
        'picturepack' => array(
            'label' => 'Bilderpaket',
            'help' => '
                <b>Bilderpaket</b><br><br>
				Durch Aktivieren der Funktion "Bilderpaket" können Sie in der Artikelansicht auf Hood.de zusätzlich dem Hauptbild oben links bis zu 12 weitere Bilder anzeigen lassen. Der Käufer kann sich die Bilder größer anzeigen lassen ("XXL-Foto") sowie Ausschnitte zoomen ("Zoom-Funktion"). Besondere Einstellungen in Ihrem Hood.de-Konto sind nicht notwendig.<br><br>
				<b>Variantenbilder</b><br><br>
				Sollten Sie in Ihrem Web-Shop Variantenbilder gepflegt haben, werden diese entsprechend übermittelt (bis zu 12 Bilder pro Variante) und unter dem Hauptbild auf Hood.de angezeigt.<br><br>
				<b>Hinweis</b><br><br>
				magnalister verarbeitet die Basisdaten Ihres Web-Shops. Sollte Ihr Shop-System keine Variantenbilder unterstützen, ist diese Funktion somit auch über magnalister nicht verfügbar.<br><br>
				<b>XXL-Foto und "Zoom" Funktion</b><br><br>
				Um die Features "XXL-Bilder" und "Zoom" nutzen zu können, verwenden Sie bitte möglichst große Bilder. Wenn ein Bild zu klein ist (weniger als <b>1000px</b> auf der längsten Seite), wird es zwar hochgeladen, aber im Fehlerlog erscheint eine Warnung.<br><br>
				<b>Bildübertragung im https-Protokoll (sichere Bild-URLs)</b><br><br>
				Ohne das Bilderpaket gestattet Hood.de keine Verlinkungen Ihrer Bilder auf gesicherte URLs (https://...). Mit Aktivierung wird der Hood.de Picture Service verwendet, bei dem https-Adressen erlaubt sind.<br><br>
				<b>Verarbeitungsdauer</b><br><br>
				Mit Aktivierung der Funktion werden die Bilder beim Hochladen zuerst durch Hood.de verarbeitet und auf den Hood.de Servern gespeichert, bevor die restlichen Produktdaten übermittelt werden. Je nach Bildgröße werden dafür 2-5 Sekunden pro Bild benötigt.<br><br>
				Um die Verarbeitungsdauer auf Shop-Seite zu verkürzen, werden die übermittelten Daten über die magnalister-Server zwischengepuffert. Etwaiges Fehler-Feedback von Hood.de kann erst nach der endgültigen Übergabe an Hood.de angezeigt werden und ist im Fehlerlog zu finden.<br><br>
				<b>Wann werden im Web-Shop geänderte Bilder aktualisiert?</b><br><br>
				Wenn Sie das Hood.de Bilderpaket ausgewählt haben, werden geänderte Bilder beim Hochladen immer aktualisiert.<br>
				Ohne Bilderpaket verlangt Hood.de zum Aktualisieren die Änderung des Bildpfads oder Bildnamen.<br><br>
				<b>Internationale Hood.de-Accounts</b><br><br>
				Je nach Land können die Features seitens Hood.de geringfügig abweichen, ggf kann deren Nutzung auch Kosten verursachen. Informieren Sie sich bitte bei Hood.de direkt, sollten Sie einen Hood.de Account nutzen, der nicht in der Region der DACH-Länder liegt.
            ',
            'valuehint' => 'Bilderpaket aktiv',
        ),
        'productfield.brand' => array(
            'label' => 'Marke',
        ),
        'fixed.quantity' => array(
            'label' => 'St&uuml;ckzahl',
            'help' => 'Geben Sie hier an, wie viel Lagermenge eines Artikels auf dem Marktplatz verf&uuml;gbar sein soll.<br/>' .
            '<br/>' .
            'Um &Uuml;berverk&auml;ufe zu vermeiden, k&ouml;nnen Sie den Wert<br/>' .
            '"Shop-Lagerbestand &uuml;bernehmen abzgl. Wert aus rechtem Feld" aktivieren.<br/>' .
            '<br/>' .
            '<strong>Beispiel:</strong> Wert auf "2" setzen. Ergibt &#8594; Shoplager: 10 &#8594; Hood.de-Lager: 8<br/>' .
            '<br/>' .
            '<strong>Hinweis:</strong> Wenn Sie Angebote zu Artikeln, die im Shop inaktiv gesetzt werden,<br/>' .
            'unabh&auml;ngig der verwendeten Lagermengen auch auf Hood.de beenden wollen, gehen Sie bitte wie folgt vor:<br/>' .
            '<ul>' .
            '<li>Synchronisation des Inventars" > "Lagerver&auml;nderung Shop" auf "automatische Synchronisation per CronJob" einstellen</li>' .
            '<li>"Globale Konfiguration" > "Produktstatus" > "Wenn Produktstatus inaktiv ist, wird der Lagerbestand wie 0 behandelt" aktivieren</li>' .
            '</ul>',
        ),
        'maxquantity' => array(
            'label' => 'St&uuml;ckzahl-Begrenzung',
            'help' => 'Hier k&ouml;nnen Sie die St&uuml;ckzahlen der auf Hood.de eingestellten Artikel begrenzen.<br /><br />' .
            '<strong>Beispiel:</strong> Sie stellen bei "St&uuml;ckzahl" ein "Shop-Lagerbestand &uuml;bernehmen", und tragen hier 20 ein. Dann werden beim Hochladen so viel St&uuml;ck eingestellt wie im Shop vorhanden, aber nicht mehr als 20. Die Lagersynchronisierung (wenn aktiviert) gleicht die Hood.de-St&uuml;ckzahl an den Shopbestand an, solange der Shopbestand unter 20 St&uuml;ck ist. Wenn im Shop mehr als 20 St&uuml;ck auf Lager sind, wird die Hood.de-St&uuml;ckzahl auf 20 gesetzt.<br /><br />' .
            'Lassen Sie dieses Feld leer oder tragen Sie 0 ein, wenn Sie keine Begrenzung w&uuml;nschen.<br /><br />' .
            '<strong>Hinweis:</strong> Wenn die "St&uuml;ckzahl"-Einstellung "Pauschal (aus rechtem Feld)" ist, hat die Begrenzung keine Wirkung.',
        ),
        'chinese.quantity' => array(
            'label' => 'St&uuml;ckzahl',
        ),
        'fixed.duration' => array(
            'label' => 'Dauer des Listings',
            'help' => 'Voreinstellung f&uuml;r die Dauer der Festpreis-Listings. Die Einstellung kann bei der Vorbereitung der Artikel ge&auml;ndert werden.',
        ),
        'chinese.duration' => array(
            'label' => 'Dauer der Auktion',
            'help' => 'Voreinstellung f&uuml;r die Dauer der Auktion. Die Einstellung kann bei der Vorbereitung der Artikel ge&auml;ndert werden.',
        ),
    )
), false);

MLI18n::gi()->add('hood_config_price', array(
    'legend' => array(
        'price' => 'Preisberechnung',
        'fixedprice' => '<b>Einstellungen f&uuml;r Festpreis-Listings</b>',
        'chineseprice' => '<b>Einstellungen f&uuml;r Steigerungsauktionen</b>',
    ),
    'field' => array(
        'fixed.price' => array(
            'label' => 'Preis',
            'hint' => '',
            'help' => 'Geben Sie einen prozentualen oder fest definierten Preis Auf- oder Abschlag an. Abschlag mit vorgesetztem Minus-Zeichen.'
        ),
        'fixed.price.addkind' => array(
            'label' => '',
            'hint' => '',
        ),
        'fixed.price.factor' => array(
            'label' => '',
            'hint' => '',
        ),
        'fixed.price.signal' => array(
            'label' => 'Nachkommastelle',
            'hint' => 'Nachkommastelle',
            'help' => '
                Dieses Textfeld wird beim &Uuml;bermitteln der Daten zu Hood.de als Nachkommastelle an Ihrem Preis &uuml;bernommen.<br/><br/>
                <strong>Beispiel:</strong> <br />
                Wert im Textfeld: 99 <br />
                Preis-Ursprung: 5.58 <br />
                Finales Ergebnis: 5.99 <br /><br />
                Die Funktion hilft insbesondere bei prozentualen Preis-Auf-/Abschl&auml;gen.<br/>
                Lassen Sie das Feld leer, wenn Sie keine Nachkommastelle &uuml;bermitteln wollen.<br/>
                Das Eingabe-Format ist eine ganzstellige Zahl mit max. 2 Ziffern.
            '
        ),
        'fixed.priceoptions' => array(
            'label' => 'Preisoptionen',
            'help' => '{#i18n:configform_price_field_priceoptions_help#}',
            'hint' => '',
        ),
        'fixed.price.group' => array(
            'label' => '',
            'hint' => '',
        ),
        'fixed.duration' => array(
            'label' => 'Dauer des Listings',
            'help' => 'Voreinstellung f&uuml;r die Dauer der Festpreis-Listings. Die Einstellung kann bei der Vorbereitung der Artikel ge&auml;ndert werden.',
        ),
        'chinese.price' => array(
            'label' => 'Startpreis',
            'help' => 'Geben Sie einen prozentualen oder fest definierten Preis Auf- oder Abschlag an. Abschlag mit vorgesetztem Minus-Zeichen. \'Fester Wert\' bedeutet, der hier eingetragene Wert wird direkt &uuml;bernommen (z.B. wenn Sie immer einen Startpreis von 1 Euro verwenden wollen).',
        ),
        'chinese.price.addkind' => array(
            'label' => '',
            'hint' => '',
        ),
        'chinese.price.factor' => array(
            'label' => '',
            'hint' => '',
        ),
        'chinese.price.signal' => array(
            'label' => 'Nachkommastelle',
            'hint' => 'Nachkommastelle',
            'help' => '
                Dieses Textfeld wird beim &Uuml;bermitteln der Daten zu Hood.de als Nachkommastelle an Ihrem Preis &uuml;bernommen.<br/><br/>
                <strong>Beispiel:</strong> <br />
                Wert im Textfeld: 99 <br />
                Preis-Ursprung: 5.58 <br />
                Finales Ergebnis: 5.99 <br /><br />
                Die Funktion hilft insbesondere bei prozentualen Preis-Auf-/Abschl&auml;gen.<br/>
                Lassen Sie das Feld leer, wenn Sie keine Nachkommastelle &uuml;bermitteln wollen.<br/>
                Das Eingabe-Format ist eine ganzstellige Zahl mit max. 2 Ziffern.
            '
        ),
        'chinese.priceoptions' => array(
            'label' => 'Preisoptionen',
            'help' => '{#i18n:configform_price_field_priceoptions_help#}',
            'hint' => '',
        ),
        'chinese.price.group' => array(
            'label' => '',
            'hint' => '',
        ),
        'chinese.buyitnow.price' => array(
            'label' => 'Sofortkauf-Preis',
            'help' => 'Geben Sie einen prozentualen oder fest definierten Preis Auf- oder Abschlag an. Abschlag mit vorgesetztem Minus-Zeichen.<br/>
						Der Sofort-Kaufen Preis muss mindestens 40&#37; h&ouml;her sein, als der Startpreis.',
        ),
        'chinese.buyitnow.price.addkind' => array(
            'label' => '',
            'hint' => '',
        ),
        'chinese.buyitnow.price.factor' => array(
            'label' => '',
            'hint' => '',
        ),
        'chinese.buyitnow.price.signal' => array(
            'label' => 'Nachkommastelle',
            'hint' => 'Nachkommastelle',
            'help' => '
                Dieses Textfeld wird beim &Uuml;bermitteln der Daten zu Hood.de als Nachkommastelle an Ihrem Preis &uuml;bernommen.<br/><br/>
                <strong>Beispiel:</strong> <br />
                Wert im Textfeld: 99 <br />
                Preis-Ursprung: 5.58 <br />
                Finales Ergebnis: 5.99 <br /><br />
                Die Funktion hilft insbesondere bei prozentualen Preis-Auf-/Abschl&auml;gen.<br/>
                Lassen Sie das Feld leer, wenn Sie keine Nachkommastelle &uuml;bermitteln wollen.<br/>
                Das Eingabe-Format ist eine ganzstellige Zahl mit max. 2 Ziffern.
            '
        ),
        'chinese.buyitnow.priceoptions' => array(
            'label' => 'Preisoptionen',
            'hint' => '',
        ),
        'buyitnowprice' => array(
            'label' => 'Sofortkauf-Preis aktiv',
            'hint' => '',
        ),
        'fixed.price.usespecialoffer' => array(
            'label' => 'auch Sonderpreise verwenden',
            'hint' => '',
        ),
        'chinese.price.usespecialoffer' => array(
            'label' => 'auch Sonderpreise verwenden',
            'hint' => '',
        ),
      
        'chinese.duration' => array(
            'label' => 'Dauer der Auktion',
            'help' => 'Voreinstellung f&uuml;r die Dauer der Auktion. Die Einstellung kann bei der Vorbereitung der Artikel ge&auml;ndert werden.',
        ),
   
        'exchangerate_update' => array(
            'label' => 'Wechselkurs',
            'valuehint' => 'Wechselkurs automatisch aktualisieren',
            'help' => '{#i18n:form_config_orderimport_exchangerate_update_help#}',
            'alert' => '{#i18n:form_config_orderimport_exchangerate_update_alert#}',
        ),
    ),
), false);


MLI18n::gi()->add('hood_config_sync', array(
    'legend' => array(
        'syncchinese' => '<b>Einstellungen f&uuml;r Steigerungsauktionen</b>',
        'sync' => array(
            'title' => 'Synchronisation des Inventars',
            'info' => 'Legt fest, welche Produkteigenschaften des Produktes in diesem Shop ebenfalls bei Hood.de automatisch aktualisiert werden sollen.<br /><br /><b>Einstellungen f&uuml;r Festpreis-Listings</b>',
        ),
        'stocksync' => array(
            'title' => 'Hood zu Shop Synchronisation',
          
        )
    ),
    'field' => array(
        'synczerostock' => array(
            'label' => 'Nullbest&auml;nde synchronisieren',
            'help' => 'Ausverkaufte Angebote werden bei Hood.de normalerweise beendet. Durch das Neueinstellen und Vergabe einer neuen Hood.de Angebotsnummer geht dann Ihr Produkt-Ranking verloren.
<br /><br />
Damit Ihre ausverkauften Artikel auf Hood.de automatisch beendet und nach Lagerauff&uuml;llung erneut angeboten werden, ohne dass Ihr Produkt-Ranking verloren geht, unterst&uuml;tzt magnalister mit diesem Feature die Hood.de Option „Nicht mehr vorr&auml;tig“ f&uuml;r „G&uuml;ltig bis auf Widerruf“-Angebote.
<br /><br />
Aktivieren Sie zus&auml;tzlich zu dieser Funktion bitte direkt in Ihrem Hood.de.de-Account die Option „Nicht mehr vorr&auml;tig“ in "Mein Hood.de" > "Verk&auml;ufereinstellungen".
<br /><br />
Beachten Sie, dass die Funktion nur f&uuml;r "G&uuml;ltig bis auf Widerruf“-Angebote" Auswirkungen hat.
<br /><br />
Lesen Sie weitere Hinweise zum dem Thema auf den Hood.de Hilfeseiten (Suchbegriff “Nicht mehr vorr&auml;tig”).
',
            'valuehint' => 'Nullbest&auml;nde synchronisieren aktiv',
        ),
        'syncrelisting' => array(
            'label' => 'Auto-Relisting',
            'help' => 'Mit Aktivierung dieser Funktion werden Ihre Artikel auf Hood.de vollautomatisch wieder eingestellt, wenn:
<ul>
<li>Ihr Angebot endet, ohne dass ein Gebot vorliegt</li>
<li>Sie die Transaktion abbrechen</li>
<li>Sie Ihr Angebot vorzeitig beenden</li>
<li>der Artikel nicht verkauft wurde oder</li>
<li>der K&auml;ufer den Artikel nicht bezahlt hat.</li>
</ul>

Beachten Sie, dass Hood.de maximal 2 Re-Listings zul&auml;sst. 
<br />
Lesen Sie weitere Hinweise zum dem Thema auf den Hood.de Hilfeseiten (Suchbegriff “Artikel wiedereinstellen”).
',
            'valuehint' => 'Auto-Relisting aktiv',
        ),
        'syncproperties' => array(
            'label' => 'EAN, MPN & Hersteller Synchronisation',
            'help' => '<p>Hood.de verlangt in vielen Kategorien f&uuml;r Ihre Artikel die Produktkennzeichnung durch EAN*, MPN (Herstellerartikelnummer) und den Hersteller (Marke). Wenn diese Attribute nicht &uuml;bermittelt werden, hat das Auswirkungen auf Ihr Hood.de-Produkt-Ranking. Auch werden &Auml;nderungen wie Preis- und Lagersynchronisationen f&uuml;r bestehende Angebote seitens Hood.de zur&uuml;ckgewiesen.  
<br /><br />Durch Aktivierung der EAN, MPN und Hersteller Synchronisation k&ouml;nnen Sie entsprechenden Werte per Knopfdruck zu Hood.de &uuml;bermitteln. Verwenden Sie daf&uuml;r den neuen Synchro-Button (erscheint wenn die EAN &amp; MPN Synchronisation gebucht ist) links vom Bestellimport-Button.  
<br /><br />Dabei werden auch Artikel synchronisiert, die nicht &uuml;ber magnalister gelistet wurden und deren Hood.de-Bestandseinheit &uumlber die Artikelnummer sowohl auf Hood.de als auch im Web-Shop identisch ist und damit erkannt werden (vgl. “magnalister” > “Hood.de” > “Inventar”). Die allererste Synchronisation kann dabei bis zu 24 Stunden dauern.
</p><p>
Bei <b>Varianten</b> wird, wenn an der Variante keine EAN hinterlegt ist, die EAN des Hauptartikels verwendet. Falls die EAN an einem Teil der Varianten hinterlegt ist, und die Hauptartikel-EAN nicht, wird eine der hinterlegten EANs genommen und f&uuml;r die restlichen Varianten des Artikels mit verwendet. Die Werte werden auch bei der &quot;normalen&quot; Preis- und Lagersynchronisation nachgetragen, sofern Sie das &quot;EAN &amp; MPN Synchronisation&quot; AddOn gebucht haben.<br />
</p><p>
*Sie k&ouml;nnen &uumlber das EAN-Feld auch ISBN oder UPC &uuml;bermitteln. Der magnalister-Server erkennt automatisch, welcher Bezeichner von Hood.de vorausgesetzt wird.
  </p><p>
  {#i18n:sAddAewShopAttributeInstruction#}
 </p><p>
<strong>Weitere wichtige Hinweise: </strong><br /><br />

Hood.de erlaubt das &uuml;bermitteln von Platzhaltern f&uuml;r EAN und MPN (“Nicht zutreffend”) anstelle der echten Werte. Diese Produkte werden jedoch schlechter auf Hood.de gerankt und daher weniger gut gefunden!  
<br /><br />
magnalister sendet diese Hood.de-Platzhalter f&uuml;r Artikel, an denen keine EAN oder MPN gefunden werden, um zumindest die &Auml;nderung von bestehenden Angeboten zu erm&ouml;glichen.

</p>',
            'valuehint' => 'EAN & MPN Synchronisation aktiv',
        ),
        'stocksync.tomarketplace' => array(
            'label' => 'Lagerver&auml;nderung Shop',
            'hint' => '',
            'help' => '
                <dl>
                    <dt>Automatische Synchronisierung per CronJob (empfohlen)</dt>
                    <dd>
                        Die Funktion "Automatische Synchronisierung" gleicht alle 4 Stunden (beginnt um 0:00 Uhr nachts) den aktuellen {#setting:currentMarketplaceName#}-Lagerbestand an der Shop-Lagerbestand an (je nach Konfiguration ggf. mit Abzug).<br />
                        <br />
                        Dabei werden die Werte aus der Datenbank geprüft und übernommen, auch wenn die Änderungen durch z.B. eine Warenwirtschaft nur in der Datenbank erfolgten.<br />
                        <br />
                        Einen manuellen Abgleich können Sie anstoßen, indem Sie den entsprechenden Funktionsbutton "Preis- und Lagersynchronisation" oben rechts im magnalister Plugin anklicken.<br />
                        Zusätzlich können Sie den Lagerabgleich (ab Tarif Flat - maximal viertelstündlich) auch durch einen eigenen CronJob anstoßen, indem Sie folgenden Link zu Ihrem Shop aufrufen:<br />
                        <i>{#setting:sSyncInventoryUrl#}</i><br />
                        Eigene CronJob-Aufrufe durch Kunden, die nicht im Tarif Flat sind, oder die häufiger als viertelstündlich laufen, werden geblockt.<br />
                    </dd>
                </dl>
                <br />
                <strong>Hinweis:</strong> Die Einstellungen unter "Konfiguration" → "Artikelvorbereitung" → "Stückzahl Lagerbestand" werden berücksichtigt.
            ',
        ),
        'stocksync.frommarketplace' => array(
            'label' => 'Lagerver&auml;nderung Hood.de',
            'hint' => '',
            'help' => 'Wenn z. B. bei Hood.de ein Artikel 3 mal gekauft wurde, wird der Lagerbestand im Shop um 3 reduziert.<br /><br />
				           <strong>Wichtig:</strong> Diese Funktion l&auml;uft nur, wenn Sie den Bestellimport aktiviert haben!',
        ),
        'inventorysync.price' => array(
            'label' => 'Artikelpreis',
            'hint' => '',
            'help' => '
                <dl>
                    <dt>Automatische Synchronisierung per CronJob (empfohlen)</dt>
                    <dd>
                        Mit der Funktion "Automatische Synchronisierung" wird der im Webshop hinterlegte Preis an den {#setting:currentMarketplaceName#}-Marktplatz übermittelt (sofern in magnalister konfiguriert, mit Preisauf- oder abschlägen). Synchronisiert wird alle 4 Stunden (Startpunkt: 0:00 Uhr nachts).<br />
                        Dabei werden die Werte aus der Datenbank geprüft und übernommen, auch wenn die Änderungen durch z.B. eine Warenwirtschaft nur in der Datenbank erfolgten.<br />
                        <br />
                        Einen manuellen Abgleich können Sie anstoßen, indem Sie den entsprechenden Funktionsbutton "Preis- und Lagersynchronisation" oben rechts im magnalister Plugin anklicken.<br />
                        <br />
                        Zusätzlich können Sie den Preisabgleich auch durch einen eigenen CronJob anstoßen, indem Sie folgenden Link zu Ihrem Shop aufrufen:<br />
                        <i>{#setting:sSyncInventoryUrl#}</i><br />
                        Eigene CronJob-Aufrufe durch Kunden, die nicht im Tarif Flat sind, oder die häufiger als viertelstündlich laufen, werden geblockt.<br />
                    </dd>
                </dl>
                <br />
                <strong>Hinweis:</strong> Die Einstellungen unter "Konfiguration" → "Preisberechnung" werden berücksichtigt.
            ',
        ),
        'inventory.import' => array(
            'label' => 'Fremdartikel synchronisieren',
            'help' => 'Sollen Artikel, die nicht &uuml;ber magnalister eingestellt wurden, mit angezeigt und synchronisiert werden? <br/><br/>' .
            'Wenn die Funktion aktiviert ist, werden alle Artikel, die f&uuml;r diesen Hood.de Account bei Hood.de angeboten werden, jede Nacht in die magnalister Datenbank geladen und im Plugin unter \'Listings\' angezeigt.<br/><br/>' .
            'Die Preis- und Lagersynchronisierung funktioniert f&uuml;r diese Artikel auch, soweit die SKU (Bestandseinheit) auf Hood.de mit einer Artikelnummer im Shop &uuml;bereinstimmt.<br/><br/>' .
            'Ausserdem m&uuml;ssen Sie unter "Globaler Konfiguration" > "Synchronisation Nummernkreise" > "Artikelnummer (Shop) = SKU (Marketplace)" eingestellt haben.<br/>' .
            'Bitte achten Sie darauf, dass wenn Sie die Nummernkreise &auml;ndern, diese auf den Marktpl&auml;tzen komplett erneuert werden m&uuml;ssen, um eine korrekte Synchronisation sicher zu stellen.<br/>' .
            'Lassen Sie sich hier ggf. beraten.<br/><br/>' .
            'Diese Funktionalit&auml;t ist momentan nicht f&uuml;r Fremdartikel mit Varianten verf&uuml;gbar.<br/><br/>' .
            '<b>Achtung:</b> Artikel, die zwar &uuml;ber magnalister eingestellt, aber sp&auml;ter auf Hood.de ge-re-listed wurden, erkennt magnalister durch die Vergabe einer neuen Hood.de Angebotsnummer nur noch als Fremdartikel. Schalten Sie diese Funktion also nicht! aus, wenn Sie ge-re-listete Artikel auch automatisch synchronisieren lassen wollen!',
        ),
        'chinese.stocksync.tomarketplace' => array(
            'label' => 'Lagerver&auml;nderung Shop',
            'help' => '<dl>
                <dl>
                    <dt>Automatische Synchronisierung per CronJob (empfohlen)</dt>
                    <dd>
                        Die Funktion "Automatische Synchronisierung" gleicht alle 4 Stunden (beginnt um 0:00 Uhr nachts) den aktuellen {#setting:currentMarketplaceName#}-Lagerbestand an der Shop-Lagerbestand an (je nach Konfiguration ggf. mit Abzug).<br />
                        <br />
                        Dabei werden die Werte aus der Datenbank geprüft und übernommen, auch wenn die Änderungen durch z.B. eine Warenwirtschaft nur in der Datenbank erfolgten.<br />
                        <br />
                        Einen manuellen Abgleich können Sie anstoßen, indem Sie den entsprechenden Funktionsbutton "Preis- und Lagersynchronisation" oben rechts im magnalister Plugin anklicken.<br />
                        Zusätzlich können Sie den Lagerabgleich (ab Tarif Flat - maximal viertelstündlich) auch durch einen eigenen CronJob anstoßen, indem Sie folgenden Link zu Ihrem Shop aufrufen:<br />
                        <i>{#setting:sSyncInventoryUrl#}</i><br />
                        Eigene CronJob-Aufrufe durch Kunden, die nicht im Tarif Flat sind, oder die häufiger als viertelstündlich laufen, werden geblockt.<br />
                    </dd>
                </dl>
                <br />
                <strong>Hinweis:</strong>
                <ul>
                    <li>Sobald auf die Auktion geboten wurde, kann sie nicht mehr gel&ouml;scht werden.</li>
                </ul>
            ',
        ),
        'chinese.stocksync.frommarketplace' => array(
            'label' => 'Lagerver&auml;nderung Hood.de',
            'help' => 'Wenn z. B. bei Hood.de ein Artikel 3 mal gekauft wurde, wird der Lagerbestand im Shop um 3 reduziert.',
        ),
        'chinese.inventorysync.price' => array(
            'label' => 'Artikelpreis',
            'help' => '
                <dl>
                    <dt>Automatische Synchronisierung per CronJob (empfohlen)</dt>
                    <dd>
                        Mit der Funktion "Automatische Synchronisierung" wird der im Webshop hinterlegte Preis an den {#setting:currentMarketplaceName#}-Marktplatz übermittelt (sofern in magnalister konfiguriert, mit Preisauf- oder abschlägen). Synchronisiert wird alle 4 Stunden (Startpunkt: 0:00 Uhr nachts).<br />
                        Dabei werden die Werte aus der Datenbank geprüft und übernommen, auch wenn die Änderungen durch z.B. eine Warenwirtschaft nur in der Datenbank erfolgten.<br />
                        <br />
                        Einen manuellen Abgleich können Sie anstoßen, indem Sie den entsprechenden Funktionsbutton "Preis- und Lagersynchronisation" oben rechts im magnalister Plugin anklicken.<br />
                        <br />
                        Zusätzlich können Sie den Preisabgleich auch durch einen eigenen CronJob anstoßen, indem Sie folgenden Link zu Ihrem Shop aufrufen:<br />
                        <i>{#setting:sSyncInventoryUrl#}</i><br />
                        Eigene CronJob-Aufrufe durch Kunden, die nicht im Tarif Flat sind, oder die häufiger als viertelstündlich laufen, werden geblockt.<br />
                    </dd>
                </dl>
                <br />
                <strong>Hinweise:</strong>
                <ul>
                    <li>Beim Abgleich werden die Einstellungen unter "Konfiguration" &rarr; "Preisberechnung" ber&uuml;cksichtigt.</li>
                   <li>Sobald auf die Auktion geboten wurde, kann der Preis nicht mehr ge&auml;ndert werden.</li>
               </ul>
            ',
        ),
    ),
), false);

MLI18n::gi()->add('hood_config_orderimport', array(
    'legend' => array(
        'importactive' => 'Bestellimport',
        'mwst' => 'Mehrwertsteuer',
        'orderupdate' => array(
            'title' => 'Bestellstatus Synchronisation',
            'info' => '',
        ),
        'orderstatus' => 'Synchronisation des Bestell-Status vom Shop zu Hood.de',
    ),
    'field' => array(
        'orderstatus.shipped' => array(
            'label' => 'Versand best&auml;tigen mit',
            'hint' => '',
            'help' => 'Setzen Sie hier den Shop-Status, der auf Hood.de automatisch den Status "Versand best&auml;tigen" setzen soll.',
        ),
        'orderstatus.canceled.nostock' => array(
            'label' => 'Stornieren (nicht lieferbar)',
            'hint' => '',
            'help' => '
                Stornierungsgrund: Der Artikel ist nicht lieferbar oder nicht auf Lager.<br />
                Wählen Sie in diesem Dropdown-Feld den passenden Status (einstellbar in Ihrem Shopsystem). Dieser Status wird dann im Hood-Account Ihrer Käufer angezeigt.<br /> 
                Die Bestellstatus-Änderung wird ausgelöst, wenn Sie im Shop-Produkt den Status ändern. magnalister synchronisiert den geänderten Status dann automatisch mit Hood.de.  
            ',
        ),
        'orderstatus.canceled.revoked' => array(
            'label' => 'Stornieren (Widerruf durch Käufer)',
            'hint' => '',
            'help' => '
                Stornierungsgrund: Der Käufer hat den Artikel storniert oder möchte ihn nicht mehr kaufen.<br /> 
                Wählen Sie in diesem Dropdown-Feld den passenden Status (einstellbar in Ihrem Shopsystem). Dieser Status wird dann im Hood-Account Ihrer Käufer angezeigt.<br />
                Die Bestellstatus-Änderung wird ausgelöst, wenn Sie im Shop-Produkt den Status ändern. magnalister synchronisiert den geänderten Status dann automatisch mit Hood.de. 
            ',
        ),
        'orderstatus.canceled.nopayment' => array(
            'label' => 'Stornieren (Käufer hat nicht bezahlt)',
            'hint' => '',
            'help' => '
                Stornierungsgrund: Der Käufer bezahlt den Artikel nicht.<br />
                Wählen Sie in diesem Dropdown-Feld den passenden Status (einstellbar in Ihrem Shopsystem). Dieser Status wird dann im Hood-Account Ihrer Käufer angezeigt.<br />
                Die Bestellstatus-Änderung wird ausgelöst, wenn Sie im Shop-Produkt den Status ändern. magnalister synchronisiert den geänderten Status dann automatisch mit Hood.de.
            ',
        ),
        'orderstatus.canceled.defect' => array(
            'label' => 'Stornieren (Artikel mangelhaft / defekt)',
            'hint' => '',
            'help' => '
                Stornierungsgrund: Der Artikel ist mangelhaft oder defekt.<br /> 
                Wählen Sie in diesem Dropdown-Feld den passenden Status (einstellbar in Ihrem Shopsystem). Dieser Status wird dann im Hood-Account Ihrer Käufer angezeigt.<br />
                Die Bestellstatus-Änderung wird ausgelöst, wenn Sie im Shop-Produkt den Status ändern. magnalister synchronisiert den geänderten Status dann automatisch mit Hood.de.
            ',
        ),
        'importonlypaid' => array(
            'label' => 'Nur bezahlt-markierte Bestellungen importieren',
            'help' => '
                <p>Durch Aktivieren der Funktion werden Bestellungen erst dann importiert, wenn Sie auf Hood als „bezahlt“ markiert wurden. F&uuml;r Zahlarten wie PayPal, Amazon Pay oder Sofort&uuml;berweisung erfolgt das automatisch, sonst muss die Zahlung auf Hood entsprechend markiert werden.
                </p>
                <p>
                <strong>Vorteil:</strong>
                Die importierte Bestellung kann sofort versendet werden. Bei PayPal und Amazon Pay steht der Transaktionscode bereit und kann von Ihrer Warenwirtschaft weiterverarbeitet werden.
            </p>
            ',
            'alert' => '
                <p>Durch Aktivieren der Funktion werden Bestellungen erst dann importiert, wenn Sie auf Hood als „bezahlt“ markiert wurden. F&uuml;r Zahlarten wie PayPal, Amazon Pay oder Sofort&uuml;berweisung erfolgt das automatisch, sonst muss die Zahlung auf Hood entsprechend markiert werden.
                </p>
                <p>
                <strong>Vorteil:</strong>
                Die importierte Bestellung kann sofort versendet werden. Bei PayPal und Amazon Pay steht der Transaktionscode bereit und kann von Ihrer Warenwirtschaft weiterverarbeitet werden.
            </p>',
        ),
        'orderstatus.closed' => array(
            'label' => 'Bestellzusammenfassung beenden',
            'help' => 'Wenn Sie eine Bestellung auf einen der hier ausgew&auml;hlten Status setzen, werden neue Bestellungen des gleichen Kunden nicht mehr zu dieser hinzugef&uuml;gt. <br />
                Falls Sie keine Bestellzusammenfassung w&uuml;nschen, markieren Sie hier alle Status.',
        ),
        'orderimport.shop' => array(
            'label' => '{#i18n:form_config_orderimport_shop_lable#}',
            'hint' => '',
            'help' => '{#i18n:form_config_orderimport_shop_help#}',
        ),
        'orderimport.paymentmethod' => array(
            'label' => 'Zahlart der Bestellungen',
            'help' => '<p>Zahlart, die allen Hood.de-Bestellungen beim Bestellimport zugeordnet wird. 
Standard: "Vom Marktplatz übernehmen"</p>
<p>
Wenn Sie „Vom Marktplatz übernehmen" w&auml;hlen, &uuml;bernimmt magnalister die Zahlart, die der K&auml;ufer auf hood.de gew&auml;hlt hat.</p>
<p>
Diese Einstellung ist wichtig f&uuml;r den Rechnungs- und Lieferscheindruck, und f&uuml;r die nachtr&auml;gliche Bearbeitung der Bestellung im Shop, sowie in Warenwirtschaften.</p>',
            'hint' => '',
        ),
        'orderimport.shippingmethod' => array(
            'label' => 'Versandart der Bestellungen',
            'help' => 'Versandart, die allen Hood.de-Bestellungen zugeordnet wird. Standard: "Vom Marktplatz übernehmen".<br><br>
Wenn Sie „Vom Marktplatz übernehmen" w&auml;hlen, &uuml;bernimmt magnalister die Versandart, die der K&auml;ufer auf hood.de gew&auml;hlt hat.<br><br>
Diese Einstellung ist wichtig f&uuml;r den Rechnungs- und Lieferscheindruck und f&uuml;r die nachtr&auml;gliche
Bearbeitung der Bestellung im Shop sowie einige Warenwirtschaften.',
            'hint' => '',
        ),
        'mwstfallback' => array(
            'label' => 'MwSt. Shop-fremder Artikel',
            'hint' => 'Steuersatz, der f&uuml;r Shop-fremde Artikel bei Bestellimport verwendet wird in %.',
            'help' => '
                Wenn der Artikel nicht &uuml;ber magnalister eingestellt wurde, kann die Mehrwertsteuer nicht ermittelt werden.<br />
                Als L&ouml;sung wird der hier angegebene Wert in Prozent bei allen Produkten hinterlegt, deren Mehrwertsteuersatz beim Bestellimport aus Hood.de nicht bekannt ist
            ',
        ),
        /* //{search: 1427198983}
          'mwst.shipping' => array(
          'label' => 'MwSt. Versandkosten',
          'hint' => 'Steuersatz f&uuml;r Versandkosten in %.',
          'help' => '
          Hood.de &uuml;bermittelt nicht den Steuersatz der Versandkosten, sondern nur die Brutto-Preise. Daher muss der Steuersatz zur korrekten Berechnung der Mehrwertsteuer f&uuml;r die Versandkosten hier angegeben werden. Falls Sie mehrwertsteuerbefreit sind, tragen Sie in das Feld 0 ein.
          ',
          ),
          // */
        'importactive' => array(
            'label' => 'Import aktivieren',
            'hint' => '',
            'help' => '
                Sollte der Artikel im Web-Shop nicht gefunden werden, verwendet magnalister den hier hinterlegten Steuersatz, da die Marktpl&auml;tze beim Bestellimport keine Angabe zur Mehrwertsteuer machen.<br />
                <br />
                Weitere Erl&auml;uterungen:<br />
                Grunds&auml;tzlich verh&auml;lt sich magnalister beim Bestellimport bei der Berechnung der Mehrwertsteuer so wie das Shop-System selbst.<br />
                <br />
                Damit die Mehrwertsteuer pro Land automatisch ber&uuml;cksichtigt werden kann, muss der gekaufte Artikel mit seinem des Nummernkreis (SKU) im Web-Shop gefunden werden.<br />
                magnalister verwendet dann die im Web-Shop konfigurierten Steuerklassen.
            '
        ),
        'updateableorderstatus' => array(
            'label' => 'Bestell-&Auml;nderung zulassen wenn',
            'help' => 'Status der Bestellungen, die bei Hood.de-Zahlungen ge&auml;ndert werden d&uuml;rfen.
			                Wenn die Bestellung einen anderen Status hat, wird er bei Hood.de-Zahlungen nicht ge&auml;ndert.<br /><br />
			                Wenn Sie gar keine &Auml;nderung des Bestellstatus bei Hood.de-Zahlung w&uuml;nschen, deaktivieren Sie die Checkbox.',
        ),
        'updateable.orderstatus' => array(
            'label' => '',
            'help' => '',
        ),
        'update.orderstatus' => array(
            'label' => 'Bestell-&Auml;nderung aktiv',
        ),
        'import' => array(
            'label' => '',
            'hint' => '',
        ),
        'preimport.start' => array(
            'label' => 'erstmalig ab Zeitpunkt',
            'hint' => 'Startzeitpunkt',
            'help' => 'Startzeitpunkt, ab dem die Bestellungen erstmalig importiert werden sollen. Bitte beachten Sie, dass dies nicht beliebig weit in die Vergangenheit m&ouml;glich ist, da die Daten bei Hood.de h&ouml;chstens einige Wochen lang vorliegen.',
        ),
        'customergroup' => array(
            'label' => 'Kundengruppe',
            'hint' => '',
            'help' => 'Kundengruppe, zu der Kunden bei neuen Bestellungen zugeordnet werden sollen.',
        ),
        'orderstatus.open' => array(
            'label' => 'Bestellstatus im Shop',
            'hint' => '',
            'help' => '
                Der Status, den eine von Hood.de neu eingegangene Bestellung im Shop automatisch bekommen soll.<br />
                Sollten Sie ein angeschlossenes Mahnwesen verwenden, ist es empfehlenswert, den Bestellstatus auf "Bezahlt" zu setzen (Konfiguration → Bestellstatus).
            ',
        ),
        'orderstatus.paid' => array(
            'label' => 'Hood.de Bezahlt-Status im Shop',
            'help' => 'Der Status, den Bestellung im Shop bekommt, wenn sie bei Hood.de bezahlt wird.<br /><br />
                    <b>Hinweis:</b> Der Status von zusammengefa&szlig;ten Bestellungen wird nur dann ge&auml;ndert, wenn alle Teile bezahlt sind.',
        ),
        'orderstatus.carrier.default' => array(
            'label' => 'Spediteur',
            'help' => 'Vorausgew&auml;hlter Spediteur beim Best&auml;tigen des Versandes nach Hood.de. <br /><br />
                    Damit der Trackingcode zu Hood.de übergeben wird muss ein Spediteur hinterlegt sein.',
        ),
        'orderstatus.sendmail' => array(
            'label' => 'E-Mail Versand',
            'help' => 'Wenn Sie diese Option aktivieren wird der Käufer durch Hood.de per E-Mal über die Statusänderung informiert.',
        ),
        
    ),
), false);

MLI18n::gi()->add('hood_config_emailtemplate', array(
    'legend' => array(
        'mail' => 'E-Mail an Käufer',
    ),
    'field' => array(
        'mail.send' => array(
            'label' => 'E-Mail versenden?',
            'help' => 'Soll von Ihrem Shop eine E-Mail an den K&auml;ufer gesendet werden um Ihren Shop zu promoten?',
        ),
        'mail.originator.name' => array(
            'label' => 'Absender Name',
        ),
        'mail.originator.adress' => array(
            'label' => 'Absender E-Mail Adresse',
        ),
        'mail.subject' => array(
            'label' => 'Betreff',
        ),
        'mail.content' => array(
            'label' => 'E-Mail Inhalt',
            'hint' => 'Liste verf&uuml;gbarer Platzhalter f&uuml;r Betreff und Inhalt:
        <dl>
                <dt>#MARKETPLACEORDERID#</dt>
                        <dd>Marktplatz Bestellnummer</dd>
                <dt>#FIRSTNAME#</dt>
                        <dd>Vorname des K&auml;ufers</dd>
                <dt>#LASTNAME#</dt>
                        <dd>Nachname des K&auml;ufers</dd>
                <dt>#EMAIL#</dt>
                        <dd>e-mail Adresse des K&auml;ufers</dd>
                <dt>#PASSWORD#</dt>
                        <dd>Password des K&auml;ufers zum Einloggen in Ihren Shop. Nur bei Kunden, die dabei automatisch angelegt werden, sonst wird der Platzhalter durch \'(wie bekannt)\' ersetzt.</dd>
                <dt>#ORDERSUMMARY#</dt>
                        <dd>Zusammenfassung der gekauften Artikel. Sollte extra in einer Zeile stehen.<br/><i>Kann nicht im Betreff verwendet werden!</i></dd>
                <dt>#ORIGINATOR#</dt>
                        <dd>Absender Name</dd>
        </dl>',
        ),
        'mail.copy' => array(
            'label' => 'Kopie an Absender',
            'help' => 'Die Kopie wird an die Absender E-Mail Adresse gesendet.',
        ),
    ),
), false);


MLI18n::gi()->add('hood_config_producttemplate', array(
    'legend' => array(
        'product' => array(
            'title' => 'Produkt-Template',
            'info' => 'Template f&uuml;r die Produktbeschreibung auf Hood.de. (Sie k&ouml;nnen den Editor unter "Globale Konfiguration" > "Experteneinstellungen" umschalten.)',
        )
    ),
    'field' => array(
        'template.name' => array(
            'label' => 'Template Produktname',
            // For shopify this help is overwritten, if you change something here, also change it in 60_ShopModule_Shopify/ShopifyHood/I18n/De/configForm.php
            'help' => '<dl>
							<dt>Name des Produkts auf Hood.de</dt>
							 <dd>Einstellung, wie das Produkt auf Hood.de hei&szlig;en soll.
							     Der Platzhalter <b>#TITLE#</b> wird automatisch durch den Produktnamen aus dem Shop ersetzt,
						  		 <b>#BASEPRICE#</b> durch Preis pro Einheit, soweit f&uuml;r das betreffende Produkt im Shop hinterlegt.</dd>
							<dt>Bitte beachten Sie:</dt>
							 <dd>Der Platzhalter <b>#BASEPRICE#</b> ist normalerweise nicht n&ouml;tig, da magnalister die im Shop hinterlegten Grundpreise automatisch &uuml;bertr&auml;gt, soweit die Hood.de Kategorie das vorsieht (vgl. &quot;Produkte vorbereiten&quot; &gt; &quot;Attribute f&uuml;r Prim&auml;r-Kategorie&quot;).</dd>
							 <dd>Wenn Sie den Grundpreis nachtr&auml;glich im Web-Shop hinterlegen, laden Sie den Artikel bitte nochmals hoch, damit die &Auml;nderungen auf Hood.de &uuml;bernommen werden. Die so hochgeladenen Grundpreise werden &uuml;ber die Preisaktualisierung synchron gehalten.</dd>
							 <dd>Nutzen Sie den Platzhalter <b>#BASEPRICE#</b>, wenn Sie nicht-metrische Einheiten verwenden (die Hood.de nicht akzeptiert), oder Grundpreise auch in Kategorien anzeigen wollen, wo Hood.de es nicht vorsieht (und der Gesetzgeber es nicht vorschreibt).</dd>
							 <dd>Falls Sie den Platzhalter <b>#BASEPRICE#</b> verwenden, <b>schalten Sie bitte die Preissynchronisation ab</b>. Der Titel kann auf Hood.de nicht ge&auml;ndert werden, und bei Preis&auml;nderungen w&uuml;rde die Grundpreis-Angabe im Titel dann nicht mehr stimmen.</dd>
							 <dd><b>#BASEPRICE#</b> wird beim Hochladen zu Hood.de ersetzt.</dd>
							 <dd>F&uuml;r <b>Artikel-Varianten</b> unterst&uuml;tzt Hood.de die Grundpreise nicht. Daher h&auml;ngen wir die Grundpreise an Varianten-Titel an.</dd>
							 <dd>Beispiel: <br />&nbsp;Variantengruppe: F&uuml;llmenge<ul><li>Variante: 0,33 l (3 EUR / Liter)</li><li>Variante: 0,5 l (2,50 EUR / Liter)</li><li>usw.</li></ul></dd>
							<dd>In diesem Fall schalten Sie bitte ebenfalls <b>die Preissynchronisation ab</b>,  da Varianten-Titel bei Hood.de nicht ge&auml;ndert werden k&ouml;nnen.</dd>
							</dl>',
            // For shopify this hint is overwritten, if you change something here, also change it in 60_ShopModule_Shopify/ShopifyHood/I18n/De/configForm.php
            'hint' => 'Platzhalter: #TITLE# - Produktname; #BASEPRICE# - Grundpreis',
        ),
        'template.content' => array(
            'label' => 'Standard Template',
            'hint' => '
                Liste verf&uuml;gbarer Platzhalter f&uuml;r die Produktbeschreibung:
                <dl>
                        <dt>#TITLE#</dt>
                                <dd>Produktname (Titel)</dd>
                        <dt>#ARTNR#</dt>
                                <dd>Artikelnummer im Shop</dd>
                        <dt>#PID#</dt>
                                <dd>Produkt ID im Shop</dd>
                        <!--<dt>#PRICE#</dt>
                                <dd>Preis</dd>
                        <dt>#VPE#</dt>
                                <dd>Preis pro Verpackungseinheit</dd>-->
                        <dt>#SHORTDESCRIPTION#</dt>
                                <dd>Kurzbeschreibung aus dem Shop</dd>
                        <dt>#DESCRIPTION#</dt>
                                <dd>Beschreibung aus dem Shop</dd>
                        <dt>#PICTURE1#</dt>
                                <dd>erstes Produktbild</dd>
                        <dt>#PICTURE2# usw.</dt>
                                <dd>zweites Produktbild; mit #PICTURE3#, #PICTURE4# usw. k&ouml;nnen weitere Bilder &uuml;bermittelt werden, so viele wie im Shop vorhanden.</dd>
                </dl>
                ',
        ),
    ),
), false);
