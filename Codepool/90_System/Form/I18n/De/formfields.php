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
    'checkin.status'            => array(
        'label'     => 'Statusfilter',
        'valuehint' => 'nur aktive Artikel &uuml;bernehmen',
        'help'      => 'Im Web-Shop können Sie Artikel aktiv oder inaktiv setzen. Je nach Einstellung hier werden nur aktive Artikel beim Produkte hochladen angezeigt.',
    ),
    'lang'                      => array(
        'label' => 'Artikelbeschreibung',
    ),
    'prepare.status'            => array(
        'label'     => '{#i18n:formfields__checkin.status__label#}',
        'valuehint' => '{#i18n:formfields__checkin.status__valuehint#}',
        'help'      => 'Im Web-Shop können Sie Artikel aktiv oder inaktiv setzen. Je nach Einstellung hier werden nur aktive Artikel beim Produkte vorbereiten angezeigt.',
    ),
    'tabident'                  => array(
        'label' => '{#i18n:ML_LABEL_TAB_IDENT#}',
        'help'  => '{#i18n:ML_TEXT_TAB_IDENT#}',
    ),
    'stocksync.tomarketplace'   => array(
        'label' => 'Lagerveränderung vom Shop',
        'help'  => '
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
        'label' => 'Bestellimport von {#setting:currentMarketplaceName#}',
        'help'  => '
            Wenn z. B. bei {#setting:currentMarketplaceName#} ein Artikel 3 mal gekauft wurde, wird der Lagerbestand im Shop um 3 reduziert.<br />
            <br />
            <strong>Wichtig:</strong> Diese Funktion läuft nur, wenn Sie den Bestellimport aktiviert haben!
        ',
    ),
    'inventorysync.price'       => array(
        'label' => 'Artikelpreis',
        'help'  => '
            <dl>
                <dt>Automatische Synchronisierung per CronJob (empfohlen)</dt>
                <dd>
                    Mit der Funktion "Automatische Synchronisierung" wird der im Webshop hinterlegte Preis an den {#setting:currentMarketplaceName#}-Marktplatz übermittelt (sofern in magnalister konfiguriert, mit Preisauf- oder abschlägen). Synchronisiert wird alle 4 Stunden (Startpunkt: 0:00 Uhr nachts).
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
    'mail.send'                 => array(
        'label' => 'E-Mail versenden?',
        'help'  => 'Soll von Ihrem Shop eine E-Mail an den K&auml;ufer gesendet werden um Ihren Shop zu promoten?',
    ),
    'mail.originator.name'      => array(
        'label'   => 'Absender Name',
        'default' => 'Beispiel-Shop',
    ),
    'mail.originator.adress'    => array(
        'label'   => 'Absender E-Mail Adresse',
        'default' => 'beispiel@onlineshop.de',
    ),
    'mail.subject'              => array(
        'label'   => 'Betreff',
        'default' => 'Ihre Bestellung bei #SHOPURL#',
    ),
    'mail.content'              => array(
        'label'   => 'E-Mail Inhalt',
        'hint'    => '
            Liste verf&uuml;gbarer Platzhalter f&uuml;r Betreff und Inhalt:
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
                <dd>
                    Zusammenfassung der gekauften Artikel. Sollte extra in einer Zeile stehen.<br>
                    <i>Kann nicht im Betreff verwendet werden!</i>
                </dd>
                <dt>#MARKETPLACE#</dt>
                <dd>Name dieses Marketplaces</dd>
                <dt>#SHOPURL#</dt>
                <dd>URL zu Ihrem Shop</dd>
                <dt>#ORIGINATOR#</dt>
                <dd>Absender Name</dd>
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
<p>Hallo #FIRSTNAME# #LASTNAME#,</p>
<p>vielen Dank f&uuml;r Ihre Bestellung! Sie haben &uuml;ber #MARKETPLACE# in unserem Shop folgendes bestellt:</p>
#ORDERSUMMARY#
<p>Zuz&uuml;glich etwaiger Versandkosten.</p>
<p>&nbsp;</p>
<p>Mit freundlichen Gr&uuml;&szlig;en,</p>
<p>Ihr Online-Shop-Teamff</p>'
    ),
    'mail.copy'                 => array(
        'label' => 'Kopie an Absender',
        'help'  => 'Die Kopie wird an die Absender E-Mail Adresse gesendet.',
    ),
    'quantity'                  => array(
        'label' => 'Lagerbestand',
        'help'  => '
            Geben Sie hier an, wie viel Lagermenge eines Artikels auf {#setting:currentMarketplaceName#} verfügbar sein soll.<br />
            <br />
            Um Überverkäufe zu vermeiden, können Sie den Wert<br />
            "Shop-Lagerbestand übernehmen abzgl. Wert aus rechtem Feld" aktivieren.<br />
            <br />
            <strong>Beispiel:</strong> Wert auf "2" setzen. Ergibt → Shoplager: 10 → {#setting:currentMarketplaceName#}-Lager: 8<br />
            <br />
            Hinweis:Wenn Sie Artikel, die im Shop inaktiv gesetzt werden, unabhängig der verwendeten Lagermengen auch auf dem Marktplatz als Lager "0" behandeln wollen, gehen Sie bitte wie folgt vor:<br />
            <br />
            <ul>
                <li>"Synchronisation des Inventars" > "Lagerveränderung Shop" auf "automatische Synchronisation per CronJob" einstellen</li>
                <li>"Globale Konfiguration" > "Produktstatus" > "Wenn Produktstatus inaktiv ist, wird der Lagerbestand wie 0 behandelt" aktivieren</li>
            </ul>
        ',
    ),
    'maxquantity'               => array(
        'label' => 'Stückzahl-Begrenzung',
        'help'  => '
            Hier k&ouml;nnen Sie die St&uuml;ckzahlen der auf {#setting:currentMarketplaceName#} eingestellten Artikel begrenzen.<br /><br />
            <strong>Beispiel:</strong> Sie stellen bei "St&uuml;ckzahl" ein "Shop-Lagerbestand &uuml;bernehmen", und tragen hier 20 ein. Dann werden beim Hochladen so viel St&uuml;ck eingestellt wie im Shop vorhanden, aber nicht mehr als 20. Die Lagersynchronisierung (wenn aktiviert) gleicht die {#setting:currentMarketplaceName#}-St&uuml;ckzahl an den Shopbestand an, solange der Shopbestand unter 20 St&uuml;ck ist. Wenn im Shop mehr als 20 St&uuml;ck auf Lager sind, wird die {#setting:currentMarketplaceName#}-St&uuml;ckzahl auf 20 gesetzt.<br /><br />
            Lassen Sie dieses Feld leer oder tragen Sie 0 ein, wenn Sie keine Begrenzung w&uuml;nschen.<br /><br />
            <strong>Hinweis:</strong> Wenn die "St&uuml;ckzahl"-Einstellung "Pauschal (aus rechtem Feld)" ist, hat die Begrenzung keine Wirkung.
        ',
    ),
    'price'                     => array(
        'label' => 'Preis',
        'help'  => 'Geben Sie einen prozentualen oder fest definierten Preis Auf- oder Abschlag an. Abschlag mit vorgesetztem Minus-Zeichen.'
    ),
    'price.signal'              => array(
        'label' => 'Nachkommastelle',
        'help'  => '
                Dieses Textfeld wird beim &Uuml;bermitteln der Daten zu {#setting:currentMarketplaceName#} als Nachkommastelle an Ihrem Preis &uuml;bernommen.<br/><br/>
                <strong>Beispiel:</strong> <br />
                Wert im Textfeld: 99 <br />
                Preis-Ursprung: 5.58 <br />
                Finales Ergebnis: 5.99 <br /><br />
                Die Funktion hilft insbesondere bei prozentualen Preis-Auf-/Abschl&auml;gen.<br/>
                Lassen Sie das Feld leer, wenn Sie keine Nachkommastelle &uuml;bermitteln wollen.<br/>
                Das Eingabe-Format ist eine ganzstellige Zahl mit max. 2 Ziffern.
            ',
    ),
    'price.addkind'             => array(
        'label' => '',
    ),
    'price.factor'              => array(
        'label' => '',
    ),
    'priceoptions'              => array(
        'label' => 'Verkaufspreis aus Kundengruppe',
        'help'  => '{#i18n:configform_price_field_priceoptions_help#}',
    ),
    'price.usespecialoffer'     => array(
        'label' => 'auch Sonderpreise verwenden',
    ),
    'exchangerate_update'       => array(
        'label'     => 'Wechselkurs',
        'valuehint' => 'Wechselkurs automatisch aktualisieren',
        'help'      => '{#i18n:form_config_orderimport_exchangerate_update_help#}',
        'alert'     => '{#i18n:form_config_orderimport_exchangerate_update_alert#}',
    ),

    'importactive'                                    => array(
        'label' => 'Import aktivieren',
        'help'  => '
            Sollen Bestellungen aus {#setting:currentMarketplaceName#} importiert werden?<br />
            <br />
            Wenn die Funktion aktiviert ist, werden Bestellungen voreingestellt stündlich importiert.<br />
            <br />
            Einen manuellen Import können Sie anstoßen, indem Sie den entsprechenden Funktionsbutton "Bestellungen importieren" oben rechts im magnalister Plugin anklicken.<br />
            <br />
            Zusätzlich können Sie den Bestellimport (ab Tarif Flat - maximal viertelstündlich) auch durch einen eigenen CronJob anstoßen, indem Sie folgenden Link zu Ihrem Shop aufrufen:
            <i>{#setting:sImportOrdersUrl#}</i><br />
            <br />
            Eigene CronJob-Aufrufe durch Kunden, die nicht im Tarif Flat sind, oder die häufiger als viertelstündlich laufen, werden geblockt.
        ',
    ),
    'preimport.start'                                 => array(
        'label' => 'erstmalig ab Zeitpunkt',
        'hint'  => 'Startzeitpunkt',
        'help'  => 'Startzeitpunkt, ab dem die Bestellungen erstmalig importiert werden sollen. Bitte beachten Sie, dass dies nicht beliebig weit in die Vergangenheit möglich ist, da die Daten bei {#setting:currentMarketplaceName#} höchstens einige Wochen lang vorliegen.',
    ),
    'customergroup'                                   => array(
        'label' => 'Kundengruppe',
        'help'  => 'Kundengruppe, zu der Kunden bei neuen Bestellungen zugeordnet werden sollen.',
    ),
    'orderimport.shop'                                => array(
        'label' => '{#i18n:form_config_orderimport_shop_lable#}',
        'help'  => '{#i18n:form_config_orderimport_shop_help#}',
    ),
    'orderstatus.open'                                => array(
        'label' => 'Bestellstatus im Shop',
        'help'  => '
            Der Status, den eine von {#setting:currentMarketplaceName#} neu eingegangene Bestellung im Shop automatisch bekommen soll.<br />
            Sollten Sie ein angeschlossenes Mahnwesen verwenden, ist es empfehlenswert, den Bestellstatus auf "Bezahlt" zu setzen (Konfiguration → Bestellstatus).
        ',
    ),
    'orderimport.shippingmethod'                      => array(
        'label' => 'Versandart der Bestellungen',
        'help'  => '
            Versandart, die allen {#setting:currentMarketplaceName#}-Bestellungen zugeordnet wird. Standard: "{#setting:currentMarketplaceName#}".<br>
            <br>
            Diese Einstellung ist wichtig f&uuml;r den Rechnungs- und Lieferscheindruck und f&uuml;r die nachtr&auml;gliche Bearbeitung der Bestellung im Shop sowie einige Warenwirtschaften.
        ',
    ),
    'orderimport.paymentmethod'                       => array(
        'label' => 'Zahlart der Bestellungen',
        'help'  => '
            Zahlart, die allen {#setting:currentMarketplaceName#}-Bestellungen zugeordnet wird. Standard: "{#i18n:marketplace_configuration_orderimport_payment_method_from_marketplace#}".<br /><br />
            Diese Einstellung ist wichtig für den Rechnungs- und Lieferscheindruck und für die nachträgliche Bearbeitung der Bestellung im Shop sowie einige Warenwirtschaften.
        ',
    ),
    'mwst.fallback'                                   => array(
        'label' => 'MwSt. Shop-fremder Artikel',
        'hint'  => 'Steuersatz, der f&uuml;r Shop-fremde Artikel bei Bestellimport verwendet wird in %.',
        'help'  => '
            Wenn beim Bestellimport die Artikelnummer eines Kaufs im Web-Shop nicht erkannt wird, kann die Mehrwertsteuer nicht berechnet werden.<br />
            Als Lösung wird der hier angegebene Wert in Prozent bei allen Produkten hinterlegt, deren Mehrwertsteuersatz beim Bestellimport aus {#setting:currentMarketplaceName#} nicht bekannt ist.
        ',
    ),
    'orderstatus.sync'                           => array(
        'label' => 'Status Synchronisierung',
        'help'  => '
            <dl>
                <dt>Automatische Synchronisierung per CronJob (empfohlen)</dt>
                <dd>
                    Die Funktion "Automatische Synchronisierung per CronJob" übermittelt alle 2 Stunden den aktuellen Versendet-Status zu {#setting:currentMarketplaceName#}.<br/>
                    Dabei werden die Status-Werte aus der Datenbank geprüft und übernommen, auch wenn die Änderungen durch z.B. eine Warenwirtschaft nur in der Datenbank erfolgten.<br/><br/>
                    Sie können auch den entsprechenden Funktionsbutton "Bestellstatus synchronisieren" oben rechts im magnalister Plugin anklicken, um den Status sofort zu &uuml;bergeben.<br/><br/>
                    Zusätzlich können Sie den Bestellstatus-Abgleich (ab Tarif Flat - maximal viertelstündlich) auch durch einen eigenen CronJob anstoßen, indem Sie folgenden Link zu Ihrem Shop aufrufen: <br/><br/>
                    <i>{#setting:sSyncOrderStatusUrl#}</i><br/>
                    <br/>
                    <br/>
                    Eigene CronJob-Aufrufe durch Kunden, die nicht im Tarif Flat sind, oder die häufiger als viertelstündlich laufen, werden geblockt.<br />
                </dd>
            </dl>
        ',
    ),
    'orderstatus.shipped'                        => array(
        'label' => 'Versand bestätigen mit',
        'help'  => 'Setzen Sie hier den Shop-Status, der auf {#setting:currentMarketplaceName#} automatisch den Status "Versendet" setzen soll.',
    ),
    'orderstatus.carrier.default'                => array(
        'label' => 'Spediteur',
        'help'  => 'Vorausgew&auml;hlter Spediteur beim Best&auml;tigen des Versandes nach {#setting:currentMarketplaceName#}.',
    ),
    'orderstatus.canceled'                       => array(
        'label' => 'Bestellung stornieren mit',
        'help'  => '
            Wählen Sie hier den Shop-Status, der zu {#setting:currentMarketplaceName#} automatisch den Status "Bestellung storniert" übermitteln soll.<br />
            <br />
            <strong>Hinweis:</strong> Teilstorno ist hierüber nicht möglich. Die gesamte Bestellung wird über diese Funktion storniert.
        ',
    ),
    'config_uploadInvoiceOption'                 => array(
        'label' => 'Optionen zur Rechnungsübermittlung',
        'help'  => '<p>Hier können Sie wählen, ob und wie Sie Ihre Rechnungen zu {#setting:currentMarketplaceName#} übermitteln möchten. Zur Auswahl stehen folgende
    Optionen:</p>

<ol>
    <li>
        <p>Rechnungen nicht zu {#setting:currentMarketplaceName#} übermitteln</p>
        <p>Wählen Sie diese Option, werden Ihre Rechnungen nicht zu {#setting:currentMarketplaceName#} übermittelt. Heißt: Sie organisieren die
            Bereitstellung von Rechnungen selbst.</p>
    </li>
    
    {#i18n:formfields_config_uploadInvoiceOption_help_webshop#}
    {#i18n:formfields_config_uploadInvoiceOption_help_erp#}

    <li><p>magnalister soll die Rechnungserstellung übernehmen und zu {#setting:currentMarketplaceName#} übermitteln</p>

        <p>Wählen Sie diese Option, wenn magnalister die Erstellung und Übermittlung von Rechnung für Sie übernehmen
            soll.
            Füllen Sie dazu die Felder unter “Daten für die Rechnungserzeugung durch magnalister” aus. Die Übertragung
            erfolgt
            alle 60 Min.</p>
    </li>
</ol>',
    ),
    'config_invoice_invoiceDir'                  => array(
        'label'      => 'Übermittelte Rechnungen',
        'buttontext' => 'Anzeigen',
    ),
    'config_invoice_mailCopy'                    => array(
        'label' => 'Rechnungskopie an',
        'help'  => 'Tragen Sie hier Ihre E-Mail-Adresse ein, um eine Kopie der hochgeladenen Rechnung per Mail zu erhalten.',
    ),
    'config_invoice_invoiceNumberPrefix'         => array(
        'label'   => 'Präfix Rechnungsnummer',
        'hint'    => 'Wenn Sie hier ein Präfix eintragen, wird es vor die Rechnungsnummer gesetzt. Beispiel: R10000. Von magnalister generierte Rechnungen beginnen mit der Nummer 10000.',
        'default' => 'R', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_reversalInvoiceNumberPrefix' => array(
        'label'   => 'Präfix Stornorechnung',
        'hint'    => 'Wenn Sie hier ein Präfix eintragen, wird es vor die Stornorechnungsnummer gesetzt. Beispiel: S20000. Von magnalister generierte Stornorechnungen beginnen mit der Nummer 20000.',
        'default' => 'S', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_invoiceNumberOption'         => array(
        'label' => '',
    ),
    'config_invoice_reversalInvoiceNumberOption' => array(
        'label' => '',
    ),
    'config_invoice_invoiceNumber'               => array(
        'label' => 'Rechnungsnummer',
        'help'  => '<p>
Wählen Sie hier, ob Sie Ihre Rechnungsnummern von magnalister erzeugen lassen möchten oder ob diese aus einem {#i18n:shop_order_attribute_name#} übernommen werden sollen.
</p><p>
<b>Rechnungsnummern über magnalister erzeugen</b>
</p><p>
magnalister generiert bei der Rechnungserstellung fortlaufende Rechnungsnummern. Sie können ein Präfix definieren, das vor die Rechnungsnummer gesetzt wird. Beispiel: R10000.
</p><p>
Hinweis: Von magnalister erstellte Rechnungen beginnen mit der Nummer 10000.
</p><p>
<b>Rechnungsnummern mit {#i18n:shop_order_attribute_name#} matchen</b>
</p><p>
Bei der Rechnungserstellung wird der Wert aus dem von Ihnen ausgewählten {#i18n:shop_order_attribute_name#} übernommen.
</p><p>
{#i18n:shop_order_attribute_creation_instruction#}
</p><p>
<b>Wichtig:</b><br/> magnalister erzeugt und übermittelt die Rechnung, sobald die Bestellung als versendet markiert wird. Bitte achten Sie darauf, dass zu diesem Zeitpunkt das Freitextfeld gefüllt sein muss, da sonst ein Fehler erzeugt wird (Ausgabe im Tab “Fehlerlog”).
<br/><br/>
Nutzen Sie das Freitextfeld-Matching, ist magnalister nicht für die korrekte, fortlaufende Erstellung von Rechnungsnummern verantwortlich.
</p>
',
    ),
    'config_invoice_reversalInvoiceNumber'       => array(
        'label' => 'Stornorechnungsnummer',
        'help'  => '<p>
Wählen Sie hier, ob Sie Ihre Stornorechnungsnummer von magnalister erzeugen lassen möchten oder ob diese aus einem {#i18n:shop_order_attribute_name#} übernommen werden sollen.
</p><p>
<b>Stornorechnungsnummer über magnalister erzeugen</b>
</p><p>
magnalister generiert bei der Rechnungserstellung fortlaufende Stornorechnungsnummer. Sie können ein Präfix definieren, das vor die Rechnungsnummer gesetzt wird. Beispiel: R10000.
</p><p>
Hinweis: Von magnalister erstellte Rechnungen beginnen mit der Nummer 10000.
</p><p>
<b>Stornorechnungsnummer mit {#i18n:shop_order_attribute_name#} matchen</b>
</p><p>
Bei der Rechnungserstellung wird der Wert aus dem von Ihnen ausgewählten {#i18n:shop_order_attribute_name#} übernommen.
</p><p>
{#i18n:shop_order_attribute_creation_instruction#}
</p><p>
<b>Wichtig:</b><br/> magnalister erzeugt und übermittelt die Rechnung, sobald die Bestellung als versendet markiert wird. Bitte achten Sie darauf, dass zu diesem Zeitpunkt das Freitextfeld gefüllt sein muss, da sonst ein Fehler erzeugt wird (Ausgabe im Tab “Fehlerlog”).
<br/><br/>
Nutzen Sie das Freitextfeld-Matching, ist magnalister nicht für die korrekte, fortlaufende Erstellung von Stornorechnungsnummer verantwortlich.
</p>
',
    ),
    'config_invoice_invoiceNumberPrefixValue'         => array(
        'label' => 'Präfix Rechnungsnummer',
    ),
    'config_invoice_reversalInvoiceNumberPrefixValue' => array(
        'label' => 'Präfix Rechnungsnummer',
    ),
    'config_invoice_invoiceNumberMatching'            => array(
        'label' => 'Shopware-Bestellung-Freitextfelder',
    ),
    'config_invoice_reversalInvoiceNumberMatching'    => array(
        'label' => 'Shopware-Bestellung-Freitextfelder',
    ),
    'config_invoice_companyAddressLeft'               => array(
        'label'   => 'Firmenadresse Anschriftfeld (links)',
        'default' => 'Ihr Name, Ihre Strasse 1, 12345 Ihr Ort', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_companyAddressRight'              => array(
        'label'   => 'Adresse Informationsblock rechts',
        'default' => "Ihr Name\nIhre Strasse 1\n\n12345 Ihr Ort", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_headline'                         => array(
        'label'   => 'Überschrift Rechnung',
        'default' => 'Ihre Rechnung', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_invoiceHintHeadline'              => array(
        'label'   => 'Überschrift Rechnungshinweise',
        'default' => "Rechnungshinweis", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_invoiceHintText'                  => array(
        'label'   => 'Hinweistext',
        'hint'    => 'Leer lassen wenn kein Hinweistext auf der Rechnung erscheinen sollen',
        'default' => "Ihr Hinweistext für die Rechnung", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_footerCell1'                      => array(
        'label'   => 'Fußzeile Spalte 1',
        'default' => "Ihr Name\nIhre Strasse 1\n\n12345 Ihr Ort", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_footerCell2'    => array(
        'label'   => 'Fußzeile Spalte 2',
        'default' => "Ihre Telefonnummer\nIhre Faxnummer\nIhre Homepage\nIhre E-Mail", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_footerCell3'    => array(
        'label'   => 'Fußzeile Spalte 3',
        'default' => "Ihre Steuernummer\nIhre Ust. ID. Nr.\nIhre Gerichtsbarkeit\nIhre Informationen", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_footerCell4'    => array(
        'label'   => 'Fußzeile Spalte 4',
        'default' => "Zusätzliche\nInformationen\nin der vierten\nSpalte", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
    ),
    'config_invoice_preview'        => array(
        'label'      => 'Rechnungsvorschau',
        'buttontext' => 'Vorschau',
        'hint'       => 'Hier können Sie sich eine Vorschau Ihrer Rechnung mit den von Ihnen hinterlegten Daten anzeigen lassen.',
    ),
    'erpInvoiceSource'              => array(
        'label'      => 'Quell-Ordner für Rechnungen (Server-Pfad)',
        'help'       => '
<p>Wählen Sie hier den Server-Pfad zum Ordner aus, in den Sie die Rechnungen aus Ihrem Drittanbieter-System (z. B. ERP)
    als PDF hochladen.</p>

<p>
    <b>Wichtiger Hinweis:</b> <br>
<p>Damit magnalister eine PDF-Rechnung einer Shop-Bestellung zuordnen kann, müssen die PDF-Dateien nach einem der
    beiden folgenden Muster benannt werden:</p>
<ol>
    <li><p>Benennung nach der Shop-Bestellung</p>

        <p>Muster: #nummer-der-shop-bestellung#.pdf</p>

        <p>Beispiel: <br>
            Nummer der Shop-Bestellung: 12345678<br>
            Rechnungs-PDF sollte lauten: 12345678.pdf</p>
    </li>
    <li>
        <p>Benennung nach der Shop-Bestellung + Rechnungsnummer aus ERP-System</p>

        <p>Muster: #nummer-der-shop-bestellung#_#rechnungsnummer#.pdf</p>

        <p>Beispiel:<br>
            Nummer der Shop-Bestellung: 12345678<br>
            Rechnungsnummer aus ERP: 9876543<br>
            Rechnungs-PDF sollte lauten: 12345678_9876543.pdf</p>
    </li>
</ol>
</p>
',
        'hint'       => '',
        'buttontext' => '{#i18n:form_text_choose#}',

    ),
    'erpInvoiceDestination'         => array(
        'label'      => 'Ziel-Ordner für an {#setting:currentMarketplaceName#} übermittelte Rechnungen (Server-Pfad)',
        'help'       => '<p>Nachdem magnalister eine Rechnung aus dem Quell-Ordner an {#setting:currentMarketplaceName#} hochgeladen hat, wird diese in den Ziel-Ordner verschoben. So können Sie nachvollziehen, welche Rechnungen bereits an {#setting:currentMarketplaceName#} übermittelt wurden.</p>

<p>Wählen Sie hier den Server-Pfad zum Ziel-Ordner aus, in den die an {#setting:currentMarketplaceName#} hochgeladenen Rechnungen verschobenen werden sollen.</p>

<p><b>Wichtiger Hinweis:</b> Wenn Sie keinen abweichenden Ziel-Ordner für an {#setting:currentMarketplaceName#} hochgeladene Rechnungen auswählen, können Sie nicht erkennen, welche Rechnungen bereits zu {#setting:currentMarketplaceName#} hochgeladen wurden.</p>',
        'hint'       => '',
        'buttontext' => '{#i18n:form_text_choose#}',
    ),
    'erpReversalInvoiceSource'                   => array(
        'label'      => 'Quell-Ordner für Gutschriften (Server-Pfad)',
        'help'       => '<p>Wählen Sie hier den Server-Pfad zum Ordner aus, in dem die Gutschriften aus Ihrem Drittanbieter-System (z. B. ERP) als PDFs gespeichert werden.</p>

<p>
    <b>Wichtiger Hinweis:</b> <br>
<p>Damit magnalister eine PDF-Gutschrift einer Shop-Bestellung zuordnen kann, müssen die PDF-Dateien nach einem der beiden folgenden Muster benannt werden:</p>
<ol>
    <li><p>Benennung nach der Shop-Bestellung</p>

        <p>Muster: #nummer-der-shop-bestellung#.pdf</p>

        <p>Beispiel: <br>
            Nummer der Shop-Bestellung: 12345678<br>
            Gutschrifts-PDF sollte lauten: 12345678.pdf</p>
    </li>
    <li>
        <p>Benennung nach der Shop-Bestellung + Nummer der Gutschrift aus ERP-System</p>

        <p>Muster:  #nummer-der-shop-bestellung#_#nummer-der-gutschrift#.pdf</p>

        <p>Beispiel:<br>
            Nummer der Shop-Bestellung: 12345678<br>
            Nummer der Gutschrift aus ERP: 9876543<br>
            Gutschrifts-PDF sollte lauten: 12345678_9876543.pdf</p>
    </li>
</ol>
</p>',
        'hint'       => '',
        'buttontext' => '{#i18n:form_text_choose#}',
    ),
    'erpReversalInvoiceDestination'              => array(
        'label'      => 'Ziel-Ordner für an {#setting:currentMarketplaceName#} übermittelte Gutschriften (Server-Pfad)',
        'help'       => '<p>Nachdem magnalister eine Gutschrift aus dem Quell-Ordner an {#setting:currentMarketplaceName#} hochgeladen hat, wird diese in den Ziel-Ordner verschoben. So können Sie nachvollziehen, welche Gutschriften bereits an {#setting:currentMarketplaceName#} übermittelt wurden.</p>

<p>Wählen Sie hier den Server-Pfad zum Ziel-Ordner aus, in den die an {#setting:currentMarketplaceName#} hochgeladenen Gutschriften verschobenen werden sollen.</p>

<p><b>Wichtiger Hinweis:</b> Wenn Sie keinen abweichenden Ziel-Ordner für an {#setting:currentMarketplaceName#} hochgeladene Gutschriften auswählen, können Sie nicht erkennen, welche Gutschriften bereits zu {#setting:currentMarketplaceName#} hochgeladen wurden.</p>',
        'hint'       => '',
        'buttontext' => '{#i18n:form_text_choose#}',

    ),
));
MLI18n::gi()->{'formfields_config_invoice_invoiceNumberOption_values_magnalister'} = 'Rechnungsnummern über magnalister erzeugen';
MLI18n::gi()->{'formfields_config_invoice_invoiceNumberOption_values_matching'} = 'Rechnungsnummern mit Freitextfeld matchen';

MLI18n::gi()->add('formfields_uploadInvoiceOption_values', array(
    'off'     => 'Rechnungen nicht zu {#setting:currentMarketplaceName#} übermitteln',
    'webshop' => 'Im Webshop erstellte Rechnungen werden zu {#setting:currentMarketplaceName#} übermittelt',
    'erp'     => 'Im Drittanbieter-System (z. B. ERP) erstellte Rechnungen werden zu {#setting:currentMarketplaceName#} übermittelt',
    'magna'   => 'Rechnungserstellung und -übermittlung erfolgt durch magnalister',
));

MLI18n::gi()->{'formfields_config_uploadInvoiceOption_help_erp'} = '<li><p>Von Drittanbieter-Systemen (z. B. ERP-System) erstellte Rechnungen werden zu {#setting:currentMarketplaceName#} übermittelt</p>

            <p>Rechnungen, die Sie mit Ihrem Drittanbieter-System (z. B. ERP) erstellen, können Sie auf Ihren Webshop-Server
            hochladen, von magnalister abrufen und zu {#setting:currentMarketplaceName#} hochladen lassen. Nähere Infos erscheinen nach Auswahl
                dieser
            Option
            im Info-Icon unter “Einstellungen für die Übermittlung von Rechnungen, die aus einem Drittanbieter-System
                [...]”.</p></li>';
MLI18n::gi()->{'formfields_config_uploadInvoiceOption_help_webshop'} = '<li><p>Im Webshop erstellte Rechnungen werden zu {#setting:currentMarketplaceName#} übermittelt</p>

    <p>Sofern Ihr Shopsystem über die Möglichkeit verfügt Rechnungen zu erstellen, werden diese automatisch alle
            60 Minuten zu {#setting:currentMarketplaceName#} hochgeladen.</p></li>';
