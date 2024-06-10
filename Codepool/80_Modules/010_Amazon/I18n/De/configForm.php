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

MLI18n::gi()->amazon_config_carrier_other = 'Andere';
MLI18n::gi()->amazon_config_general_mwstoken_help = '
Bitte tragen Sie hier Ihre die Amazon Marktplatz-ID ein, welche Sie auf dem jeweiligen Amazon Marketplace beantragen können.<br>
<br>
Eine Anleitung, um den MWS Token zu beantragen finden Sie unter dem folgenden FAQ Artikel:<br>
<a href="https://otrs.magnalister.com/otrs/public.pl?Action=PublicFAQZoom;ItemID=997" title="Amazon MWS" target="_blank">Wie beantragt man den Amazon MWS Token?</a>';
MLI18n::gi()->amazon_config_general_autosync = 'Automatische Synchronisierung per CronJob (empfohlen)';
MLI18n::gi()->amazon_config_general_nosync = 'keine Synchronisierung';
MLI18n::gi()->amazon_config_account_title = 'Zugangsdaten';
MLI18n::gi()->amazon_config_account_prepare = 'Artikelvorbereitung';
MLI18n::gi()->amazon_config_account_price = 'Preisberechnung';
MLI18n::gi()->amazon_configform_orderstatus_sync_values = array(
    'auto' => '{#i18n:amazon_config_general_autosync#}',
    'no' => '{#i18n:amazon_config_general_nosync#}',
);
MLI18n::gi()->amazon_configform_sync_values = array(
    'auto' => '{#i18n:amazon_config_general_autosync#}',
    //'auto_fast' => 'Schnellere automatische Synchronisation cronjob (auf 15 Minuten)',
    'no' => '{#i18n:amazon_config_general_nosync#}',
);
MLI18n::gi()->amazon_configform_stocksync_values = array(
    'rel' => 'Bestellung (keine FBA-Bestellung) reduziert Shop-Lagerbestand (empfohlen)',
    'fba' => 'Bestellung (auch FBA-Bestellung) reduziert Shop-Lagerbestand',
    'no' => '{#i18n:amazon_config_general_nosync#}',
);
MLI18n::gi()->amazon_configform_pricesync_values = array(
    'auto' => '{#i18n:amazon_config_general_autosync#}',
    'no' => '{#i18n:amazon_config_general_nosync#}',
);
MLI18n::gi()->amazon_configform_orderimport_payment_values = array(    
    'textfield' => array(
        'title' => 'Aus Textfeld',
        'textoption' => true
    ),
    'Amazon' => array(
        'title' => 'Amazon',
    ),
);

MLI18n::gi()->amazon_configform_orderimport_shipping_values = array(
    'textfield' => array(
        'title' => 'Aus Textfeld',
        'textoption' => true
    ),
);
MLI18n::gi()->amazon_config_account_sync = 'Synchronisation';
MLI18n::gi()->amazon_config_account_orderimport = 'Bestellimport';
MLI18n::gi()->amazon_config_account_emailtemplate = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->amazon_config_account_shippinglabel = 'Versandentgelt';
MLI18n::gi()->amazon_config_account_vcs = 'Rechnungen | VCS';
MLI18n::gi()->amazon_config_account_bopis = 'Click & Collect in store';
MLI18n::gi()->amazon_config_account_emailtemplate_sender = 'Beispiel-Shop';
MLI18n::gi()->amazon_config_account_emailtemplate_sender_email = 'beispiel@onlineshop.de';
MLI18n::gi()->amazon_config_account_emailtemplate_subject = 'Ihre Bestellung bei #SHOPURL#';
MLI18n::gi()->amazon_config_account_emailtemplate_content = '
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
MLI18n::gi()->amazon_config_tier_error = 'Amazon Business (B2B): Konfiguration f&uuml;r die B2B Staffelpreis-Ebene {#TierNumber#} is nicht korrekt!';

MLI18n::gi()->{'amazon_config_how_to_authorize_magnalister_header'} = 'magnalister für Amazon autorisieren';
MLI18n::gi()->{'amazon_config_how_to_authorize_magnalister_body'} = '
    Um magnalister in Verbindung mit Amazon zu nutzen, brauchen wir Ihre Zustimmung.<br />
    <br />
    Mit der Autorisierung von magnalister in Ihrem Seller Central Portal, erlauben Sie uns mit Ihrem Amazon Shop zu interagieren. 
    Das heißt konkret: Bestellungen abzufragen, Produkte hochzuladen, Bestände zu synchronisieren und vieles mehr.
    <br />
    <br />
    Um magnalister zu autorisieren führen Sie bitte folgende Schritte durch:<br />
    <ol>
        <li>Nachdem Sie die Amazon Site ausgewählt und auf Token beantragen geklickt haben, öffnet sich nach diesem Hinweisfenster gleich ein Fenster zu Amazon. Loggen Sie sich dort bitte ein.</li>
        <li>Folgen Sie den Anweisungen auf Amazon selbst und schließen Sie die Autorisierung ab.</li>
        <li>Klicken Sie im Anschluss auf "Weiter zur Artikelvorbereitung"</li>
    </ol>
    <br />
    <strong>Wichtig:</strong> Nachdem Sie Ihren Token beantragt haben, dürfen Sie ihre Amazon Site nicht mehr ändern. Sollten Sie fälschlicherweise eine 
    falsche Amazon Site gewählt und Ihren Token bereits beantragt haben, wählen Sie die korrekte Site aus und beantragen Sie bitte einen neuen Token.<br />
    <br />
    <strong>Hinweis:</strong> magnalister kann die an und von Amazon übermittelten nicht-personenbezogenen Daten für interne statistische Zwecke verarbeiten.
';

MLI18n::gi()->{'amazon_config_amazonvcsinvoice_invoicenumberoption_values_magnalister'} = 'Rechnungsnummern über magnalister erzeugen';
MLI18n::gi()->{'amazon_config_amazonvcsinvoice_reversalinvoicenumberoption_values_magnalister'} = 'Stornorechnungsnummer über magnalister erzeugen';
MLI18n::gi()->add('amazon_config_account', array(
    'legend' => array(
        'account' => 'Zugangsdaten',
        'tabident' => 'Tab'
    ),
    'field' => array(
        'tabident' => array(
            'label' => '{#i18n:ML_LABEL_TAB_IDENT#}',
            'help' => '{#i18n:ML_TEXT_TAB_IDENT#}'
        ),
        'username' => array(
            'label' => 'Seller Central E-Mail-Adresse',
            'hint' => '',
        ),
        'password' => array(
            'label' => 'Seller Central Kennwort',
            'help' => 'Tragen Sie hier Ihr aktuelles Amazon-Passwort ein, mit dem Sie sich auch auf Ihrem Seller-Central-Account einloggen.',
        ),
        'spapitoken' => array(
            'label' => 'Amazon-Token',
            'help' => 'Um einen neuen Amazon-Token zu beantragen, klicken Sie bitte auf den Button.<br>
                        Sollte kein Fenster zu Amazon aufgehen, wenn Sie auf den Button klicken, haben Sie womöglich einen Pop-Up Blocker aktiv.<br><br>
                        Der Token ist notwendig, um &uuml;ber elektronische	Schnittstellen wie den magnalister Artikel auf Amazon einzustellen und zu verwalten.<br>
                        Folgen Sie von da an den Anweisungen auf der Amazon Seite, um den Token zu beantragen und Ihren Online-Shop &uuml;ber magnalister mit Amazon zu verbinden.',
        ),
        'mwstoken' => array(
            'label' => 'MWS Token',
            'help' => '{#i18n:amazon_config_general_mwstoken_help#}',
        ),
        'merchantid' => array(
            'label' => 'H&auml;ndler-ID',
            'help' => '{#i18n:amazon_config_general_mwstoken_help#}',
        ),
        'marketplaceid' => array(
            'label' => 'Marktplatz-ID',
            'help' => '{#i18n:amazon_config_general_mwstoken_help#}',
        ),
        'site' => array(
            'label' => 'Amazon Site',
        ),
    ),
), false);


MLI18n::gi()->add('amazon_config_prepare', array(
    'legend' => array(
        'prepare' => 'Artikelvorbereitung',
        'machingbehavior' => 'Matchingverhalten',
        'apply' => 'Neue Produkte erstellen',
        'shipping' => 'Versandeinstellungen',
        'upload' => 'Artikel hochladen: Voreinstellungen',
        'shippingtemplate' => 'Verk&auml;uferversandgruppen',
    ),
    'field' => array(
        'prepare.status' => array(
            'label' => 'Statusfilter',
            'valuehint' => 'nur aktive Artikel anzeigen',
        ),
        'checkin.status' => array(
            'label' => 'Statusfilter',
            'valuehint' => 'nur aktive Artikel anzeigen',
        ),
        'lang' => array(
            'label' => 'Artikelbeschreibung',
        ),
        'itemcondition' => array(
            'label' => 'Artikelzustand',
        ),
        'internationalshipping' => array(
            'label' => 'Versandeinstellungen für gematchte Produkte',
            'hint' => 'Wenn die Verkäuferversandgruppen aktiviert sind wird diese Einstellung ignoriert',
        ),
        'multimatching' => array(
            'label' => 'Neu matchen',
            'valuehint' => 'Bereits gematchte Produkte beim Multi- und Automatching &uuml;berschreiben.',
            'help' => 'Sollten Sie diese Einstellung aktivieren, werden die bereits gematcheten Produkte durch das neue Matching &uuml;berschrieben.'
        ),
        'multimatching.itemsperpage' => array(
            'label' => 'Ergebnisse',
            'help' => 'Hier k&ouml;nnen Sie festlegen, wie viele Produkte pro Seite beim Multimatching angezeigt werden sollen. <br/>
					Je h&ouml;her die Anzahl, desto h&ouml;her auch die Ladezeit (bei 50 Ergebnissen ca. 30 Sekunden).',
            'hint' => 'pro Seite beim Multimatching',
        ),
        'prepare.manufacturerfallback' => array(
            'label' => 'Alternativ-Hersteller',
            'help' => 'Falls ein Produkt keinen Hersteller hinterlegt hat, wird der hier angegebene Hersteller verwendet.<br />
                        Unter „Globale Konfiguration“ > „Produkteigenschaften“ k&ouml;nnen Sie auch generell „Hersteller“ auf Ihre Attribute matchen.
                    ',
        ),
        'quantity' => array(
            'label' => 'St&uuml;ckzahl Lagerbestand',
            'help' => 'Geben Sie hier an, wie viel Lagermenge eines Artikels auf dem Marktplatz verf&uuml;gbar sein soll.<br/>
                        <br/>
                        Um &Uuml;berverk&auml;ufe zu vermeiden, k&ouml;nnen Sie den Wert<br/>
                        "Shop-Lagerbestand &uuml;bernehmen abzgl. Wert aus rechtem Feld" aktivieren.<br/>
                        <br/>
                        <strong>Beispiel:</strong> Wert auf "2" setzen. Ergibt &#8594; Shoplager: 10 &#8594; Amazon-Lager: 8<br/>
                        <br/>
                        <strong>Hinweis:</strong>Wenn Sie Artikel, die im Shop inaktiv gesetzt werden, unabh&auml;ngig der verwendeten Lagermengen<br/>
                        auch auf dem Marktplatz als Lager "0" behandeln wollen, gehen Sie bitte wie folgt vor:<br/>
                        <ul>
                        <li>Synchronisation des Inventars" > "Lagerver&auml;nderung Shop" auf "automatische Synchronisation per CronJob" einstellen</li>
                        <li>"Globale Konfiguration" > "Produktstatus" > "Wenn Produktstatus inaktiv ist, wird der Lagerbestand wie 0 behandelt" aktivieren</li>
                        </ul>',
        ),
        'maxquantity' => array(
            'label' => 'St&uuml;ckzahl-Begrenzung',
            'help' => 'Hier k&ouml;nnen Sie die St&uuml;ckzahlen der auf Amazon eingestellten Artikel begrenzen.<br /><br />'.
                '<strong>Beispiel:</strong> Sie stellen bei "St&uuml;ckzahl" ein "Shop-Lagerbestand &uuml;bernehmen", und tragen hier 20 ein. Dann werden beim Hochladen so viel St&uuml;ck eingestellt wie im Shop vorhanden, aber nicht mehr als 20. Die Lagersynchronisierung (wenn aktiviert) gleicht die Amazon-St&uuml;ckzahl an den Shopbestand an, solange der Shopbestand unter 20 St&uuml;ck ist. Wenn im Shop mehr als 20 St&uuml;ck auf Lager sind, wird die Amazon-St&uuml;ckzahl auf 20 gesetzt.<br /><br />'.
                'Lassen Sie dieses Feld leer oder tragen Sie 0 ein, wenn Sie keine Begrenzung w&uuml;nschen.<br /><br />'.
                '<strong>Hinweis:</strong> Wenn die "St&uuml;ckzahl"-Einstellung "Pauschal (aus rechtem Feld)" ist, hat die Begrenzung keine Wirkung.',
        ),
        'leadtimetoship' => array(
            'label' => 'Bearbeitungszeit (in Tagen)',
            'help' => 'Die Zeit, die zwischen der Bestellaufgabe durch den Käufer bis zur Übergabe der Sendung vom Verkäufer an den Transporteur vergeht.<br>
					Sofern Sie hier keinen Wert angeben, bel&auml;uft sich die Bearbeitungszeit standardm&auml;&szlig;ig auf 1-2 Werktage.
					Verwenden Sie dieses Feld, wenn die Bearbeitungszeit f&uuml;r einen Artikel mehr als zwei Werktage betr&auml;gt.',
        ),
        'checkin.skuasmfrpartno' => array(
            'label' => 'Herstellerartikelnummer',
            'help' => 'SKU wird als Herstellerartikelnummer &uuml;bertragen.',
            'valuehint' => 'SKU wird als Herstellerartikelnummer verwenden',
        ),
        'imagesize' => array(
            'label' => 'Bildgr&ouml;&szlig;e',
            'help' => '<p>Geben Sie hier die Pixel-Breite an, die Ihr Bild auf dem Marktplatz haben soll.
Die H&ouml;he wird automatisch dem urspr&uuml;nglichen Seitenverh&auml;ltnis nach angepasst.</p>
<p>
Die Quelldateien werden aus dem Bildordner {#setting:sSourceImagePath#} verarbeitet und mit der hier gew&auml;hlten Pixelbreite im Ordner {#setting:sImagePath#}  f&uuml;r die &Uuml;bermittlung zum Marktplatz abgelegt.</p>',
            'hint' => 'Gespeichert unter: {#setting:sImagePath#}'
        ),
        'shipping.template.active' => array(
            'label' => 'Verk&auml;uferversandgruppen nutzen',
            'help' => 'Verk&auml;ufer k&ouml;nnen eine Gruppe mit verschiedenen Versandeinstellungen erstellen, je nach gesch&auml;ftlichen Erfordernissen und Anwendungsf&auml;llen. F&uuml;r verschiedene Regionen k&ouml;nnen unterschiedliche Gruppen von Versandeinstellungen gew&auml;hlt werden, mit unterschiedlichen Versandbedingungen und &ndash;geb&uuml;hren f&uuml;r die jeweilige Region. Wenn der Verk&auml;ufer ein Produkt als Angebot erstellt, muss der Verk&auml;ufer eine seiner angelegten Gruppen von Versandeinstellungen f&uuml;r das jeweilige Produkt festlegen. Die Versandeinstellungen dieser Gruppe werden dann genutzt, um die jeweils g&uuml;ltige Versandoption je Produkt auf der Website anzuzeigen.',
        ),
        'shipping.template' => array(
            'label' => 'Verk&auml;uferversandgruppen',
            'hint' => 'Eine bestimmte Gruppe von Versandeinstellungen, die verk&auml;uferspezifisch f&uuml;r ein Angebot festgelegt wird. Die Verk&auml;uferversandgruppe wird in der Benutzeroberfl&auml;che f&uuml;r Versandeinstellungen vom Verk&auml;ufer erstellt und verwaltet.',
            'help' => 'Verk&auml;ufer k&ouml;nnen eine Gruppe mit verschiedenen Versandeinstellungen erstellen, je nach gesch&auml;ftlichen Erfordernissen und Anwendungsf&auml;llen. F&uuml;r verschiedene Regionen k&ouml;nnen unterschiedliche Gruppen von Versandeinstellungen gew&auml;hlt werden, mit unterschiedlichen Versandbedingungen und &ndash;geb&uuml;hren f&uuml;r die jeweilige Region. Wenn der Verk&auml;ufer ein Produkt als Angebot erstellt, muss der Verk&auml;ufer eine seiner angelegten Gruppen von Versandeinstellungen f&uuml;r das jeweilige Produkt festlegen. Die Versandeinstellungen dieser Gruppe werden dann genutzt, um die jeweils g&uuml;ltige Versandoption je Produkt auf der Website anzuzeigen.',
        ),
        'shipping.template.name' => array(
            'label' => 'Verk&auml;uferversandgruppen Bezeichnung',
        ),
    )
), false);

MLI18n::gi()->add('amazon_config_price', array(
    'legend' => array(
        'price' => 'Preisberechnung',
        'b2b' => 'Amazon Business (B2B)',
    ),
    'field' => array(
        'price' => array(
            'label' => 'Preis',
            'hint' => '',
            'help' => 'Geben Sie einen prozentualen oder fest definierten Preis Auf- oder Abschlag an. Abschlag mit vorgesetztem Minus-Zeichen.'
        ),
        'price.addkind' => array(
            'label' => '',
            'hint' => '',
        ),
        'price.factor' => array(
            'label' => '',
            'hint' => '',
        ),
        'price.signal' => array(
            'label' => 'Nachkommastelle',
            'hint' => 'Nachkommastelle',
            'help' => '
                Dieses Textfeld wird beim &Uuml;bermitteln der Daten zu Amazon als Nachkommastelle an Ihrem Preis &uuml;bernommen.<br/><br/>
                <strong>Beispiel:</strong> <br />
                Wert im Textfeld: 99 <br />
                Preis-Ursprung: 5.58 <br />
                Finales Ergebnis: 5.99 <br /><br />
                Die Funktion hilft insbesondere bei prozentualen Preis-Auf-/Abschl&auml;gen.<br/>
                Lassen Sie das Feld leer, wenn Sie keine Nachkommastelle &uuml;bermitteln wollen.<br/>
                Das Eingabe-Format ist eine ganzstellige Zahl mit max. 2 Ziffern.
            '
        ),
        'priceoptions' => array(
            'label' => 'Preisoptionen',
            'help' => '{#i18n:configform_price_field_priceoptions_help#}',
            'hint' => '',
        ),
        'price.group' => array(
            'label' => '',
            'hint' => '',
        ),
        'price.usespecialoffer' => array(
            'label' => 'auch Sonderpreise verwenden',
            'hint' => '',
            
        ),
        'exchangerate_update' => array(
            'label' => 'Wechselkurs',
            'hint' => 'Wechselkurs automatisch aktualisieren',
            'help' => '{#i18n:form_config_orderimport_exchangerate_update_help#}',
            'alert' => '{#i18n:form_config_orderimport_exchangerate_update_alert#}',
        ),
        'b2bactive' => array(
            'label' => 'Amazon B2B verwenden',
            'help' => '
                <p>Als Amazon H&auml;ndler haben Sie die M&ouml;glichkeit, Ihren Amazon-Account um Business-Funktionen zu erweitern. Sie k&ouml;nnen dann ihre Artikel sowohl an End- als auch an Gesch&auml;ftskunden (mit ausgewiesenen Steuersatz) verkaufen.</p>
                <p>Dazu muss Ihr Account f&uuml;r &ldquo;Amazon Business&rdquo; freigeschaltet werden. Die Freischaltung k&ouml;nnen Sie in Ihrem Amazon Seller Central Account vornehmen.</p>
                <p>Bitte beachten Sie, dass ein freigeschalteter Amazon Business Account&nbsp;<strong>sowie die Aktivierung hier Grundvoraussetzungen</strong> f&uuml;r die Nutzung der nachfolgenden Funktionen sind. Dar&uuml;ber hinaus m&uuml;ssen Sie als &ldquo;Professional Seller&rdquo; bei Amazon registriert sein.</p>
                <p>Weitere Infos:</p>
                <ul>
                <li>Hinweise zum Import von Amazon B2B Bestellungen finden Sie im Info Icon unter &ldquo;Bestellimport&rdquo; -&gt; &ldquo;Import aktivieren&rdquo;.<br><br></li>
                <li>Die nachfolgenden Einstellungen dienen zur globalen Konfiguration von Amazon B2B. Sie k&ouml;nnen sp&auml;ter in der Artikelvorbereitung &Auml;nderungen auf Produktebene vornehmen.</li>
                </ul>
            ',
            'notification' => '<p>Um Amazon Business zu nutzen, brauchen Sie eine Aktivierung in Ihrem Amazon-Konto. <b>Bitte stellen Sie sicher, dass Ihr Amazon Konto f&uuml;r Amazon Business freigeschaltet ist.</b> Andernfalls wird das Hochladen von B2B-Artikeln zu Fehlern f&uuml;hren.</p><p>Um Ihr Konto f&uuml;r Amazon Business freizuschalten, folgen Sie bitte der Anleitung unter <a href="https://sellercentral.amazon.de/business/b2bregistration" target="_blank">diesem Link</a>.</p>',
            'values' => array(
                'true' => '{#i18n:ML_BUTTON_LABEL_YES#}',
                'false' => '{#i18n:ML_BUTTON_LABEL_NO#}',
            ),
        ),
        'b2b.tax_code' => array(
            'label' => 'Business Steuerklassen-Matching',
            'hint' => '',
            'matching' => array(
                'titlesrc' => 'Shop Steuers&auml;tze',
                'titledst' => 'Amazon Business Steuers&auml;tze',
            ),
            'help' => '
                <p>Matchen Sie die in Ihrem Shopsystem angelegten Steuers&auml;tze mit den von Amazon Business vorgegebenen Steuers&auml;tzen. Dies dient einerseits dazu, dass Amazon K&auml;ufern w&auml;hrend des Bestellvorgangs die korrekten Umsatzsteuers&auml;tze angezeigt werden. Andererseits k&ouml;nnen mithilfe des Steuerklassen-Matchings korrekte Umsatzsteuer-Rechnungen generiert und B2B-K&auml;ufern zur Verf&uuml;gung gestellt werden.</p>
                <p>In der linken Spalte werden dazu die im Shopsystem hinterlegten Steuers&auml;tze angezeigt. Um das Matching vorzunehmen, w&auml;hlen Sie den entsprechenden Amazon Steuersatz aus den Dropdown-Listen in der rechten Spalte.</p>
                <p>Eine Erl&auml;uterung der von Amazon vorgegebenen Steuers&auml;tze finden Sie im Amazon Seller Central im Hilfebereich unter &ldquo;Umsatzsteuers&auml;tze und Produktsteuercodes&rdquo;.</p>
                <p><strong>Hinweis:</strong> Im n&auml;chsten Men&uuml;punkt k&ouml;nnen Sie auch Steuermatchings auf Kategorieebene vornehmen, die Vorrang vor den hier getroffenen Einstellungen haben.</p>
            '
        ),
        'b2b.tax_code_container' => array(
            'label' => 'Business Steuerklassen-Matching - f&uuml;r Kategorie',
            'hint' => '',
            'help' => '
                <p>Hier k&ouml;nnen Sie auf Basis von Amazon Kategorien (z. B. &ldquo;Baumarkt&rdquo; oder &ldquo;Bekleidung&rdquo;) Shop-Steuers&auml;tze mit Amazon Business Steuers&auml;tzen matchen. &Uuml;ber das &ldquo;+&rdquo;-Symbol k&ouml;nnen Sie beliebig viele Kategorien hinzuf&uuml;gen.</p>
                <p><strong>Wichtiger Hinweis:</strong> Auf Kategorieebene gematchte Steuers&auml;tze haben Vorrang vor Steuers&auml;tzen, die Sie im Men&uuml;punkt zuvor individuell gematched haben.</p>
            '
        ),
        'b2b.tax_code_specific' => array(
            'label' => '',
            'hint' => '',
            'matching' => array(
                'titlesrc' => 'Shop Steuers&auml;tze',
                'titledst' => 'Amazon Business Steuers&auml;tze',
            )
        ),
        'b2b.tax_code_category' => array(
            'label' => '',
            'hint' => '',
        ),
        'b2bsellto' => array(
            'label' => 'Verkauf an',
            'help' => '
                <p>Hier haben Sie folgende Auswahlm&ouml;glichkeiten:</p>
                <ul>
                <li><strong>B2B und B2C</strong>: Per magnalister hochgeladene Produkte sind auf Amazon f&uuml;r B2B- und B2C-K&auml;ufer sichtbar.<br><br></li>
                <li><strong>Nur B2B</strong>: Per magnalister hochgeladene Produkte sind auf Amazon ausschlie&szlig;lich f&uuml;r B2B-K&auml;ufer sichtbar.</li>
                </ul>
                <p><strong>Hinweis</strong>: In der Produktvorbereitung haben Sie die M&ouml;glichkeit, diese Einstellung auf Artikelebene nachtr&auml;glich zu &auml;ndern.</p>
            ',
            'values' => array(
                'b2b_b2c' => 'B2B und B2C',
                'b2b_only' => 'Nur B2B',
            ),
        ),
        'b2b.price' => array(
            'label' => 'Business Preis',
            'help' => '
                <p>Hier k&ouml;nnen Sie einen prozentualen oder fixen Preis-Aufschlag oder -Abschlag f&uuml;r den <strong>auf Amazon angezeigten &ldquo;Business Preis&rdquo;</strong> (wird ausschlie&szlig;lich B2B-Kunden angezeigt) definieren.</p>
                <p>Dar&uuml;ber hinaus k&ouml;nnen Sie die Nachkommastellen beim Business Preis anpassen (geben Sie z. B. in das Feld &ldquo;99&rdquo; ein, wenn Sie m&ouml;chten, dass alle Amazon Business Preise mit dem Nachkommastellenwert &ldquo;,99&rdquo; angezeigt werden. Beispiel: 2,99 Euro)</p>
            ',
        ),
        'b2b.price.addkind' => array(
            'label' => '',
            'hint' => '',
        ),
        'b2b.price.factor' => array(
            'label' => '',
            'hint' => '',
        ),
        'b2b.price.signal' => array(
            'label' => 'Nachkommastelle',
            'hint' => 'Nachkommastelle',
            'help' => '
                Dieses Textfeld wird beim &Uuml;bermitteln der Daten zu Amazon als Nachkommastelle an Ihrem Preis &uuml;bernommen.<br/><br/>
                <strong>Beispiel:</strong> <br />
                Wert im Textfeld: 99 <br />
                Preis-Ursprung: 5.58 <br />
                Finales Ergebnis: 5.99 <br /><br />
                Die Funktion hilft insbesondere bei prozentualen Preis-Auf-/Abschl&auml;gen.<br/>
                Lassen Sie das Feld leer, wenn Sie keine Nachkommastelle &uuml;bermitteln wollen.<br/>
                Das Eingabe-Format ist eine ganzstellige Zahl mit max. 2 Ziffern.
            '
        ),
        'b2b.priceoptions' => array(
            'label' => 'Business Preisoptionen',
            'help' => '
                <p>Hier k&ouml;nnen Sie Business-Preise auf Basis von Shop-Kundengruppen &uuml;bermitteln. Haben Sie im Shop am Artikel z. B. "Shopkunden" als Kundengruppe angelegt, werden die Preise aus dieser Kundengruppe &uuml;bernommen und synchronisiert. Haken Sie &ldquo;auch Sonderpreise verwenden&rdquo; an, wenn Sie m&ouml;chten, dass die am Artikel hinterlegten Sonderpreise an Amazon &uuml;bermittelt werden.</p>
            ',
        ),
        'b2b.price.group' => array(
            'label' => '',
            'hint' => '',
        ),
        'b2b.price.usespecialoffer' => array(
            'label' => 'auch Sonderpreise verwenden',
        ),
        'b2bdiscounttype' => array(
            'label' => 'Staffelpreis-Berechnung',
            'help' => '
                <p>Staffelpreise sind erm&auml;&szlig;igte Preise, die f&uuml;r Gesch&auml;ftskunden beim Kauf gr&ouml;&szlig;erer St&uuml;ckzahlen verf&uuml;gbar sind. Verk&auml;ufer, die am Amazon Business Seller Programm teilnehmen, k&ouml;nnen entsprechende Mindestmengen (&rdquo;St&uuml;ckzahl&rdquo;) und Preisabschl&auml;ge (&ldquo;Rabatt&rdquo;) definieren.</p>
                <p>Unter &ldquo;Staffelpreis-Berechnung&rdquo; haben Sie nun folgende Auswahlm&ouml;glichkeiten:</p>
                <ul>
                    <li><strong>Nicht verwenden</strong>: Deaktiviert die Amazon Business Staffelpreis-Option<br><br></li>
                    <li><strong>Prozent</strong>: Es wird ein prozentualer Preisabschlag auf die definierten Staffelpreise angewendet (z. B. ab 100 Stk. -&gt; 10 % Rabatt, ab 500 Stk. -&gt; 15 % Rabatt usw.)</li>
                </ul>
                <p>Die gew&uuml;nschten Preisstaffeln lassen sich nun in den Feldern &ldquo;Staffelpreis Ebene 1 - 5&rdquo; eintragen. Beispiel f&uuml;r eine prozentuale <strong>Rabattstaffel</strong>:</p>
                <table>
                    <tr>
                        <td>Staffelpreis Ebene 1</td>
                        <td>St&uuml;ckzahl: 100</td>
                        <td>Rabatt: 10</td>
                    </tr>
                    <tr>
                        <td>Staffelpreis Ebene 2</td>
                        <td>St&uuml;ckzahl: 500</td>
                        <td>Rabatt: 15</td>
                    </tr>
                    <tr>
                        <td>Staffelpreis Ebene 3</td>
                        <td>St&uuml;ckzahl: 1000</td>
                        <td>Rabatt: 25</td>
                    </tr>
                </table>
                <p><strong>Weitere Hinweise</strong>:&nbsp;</p>
                <ul>
                    <li>In der magnalister Produktvorbereitung steht Ihnen bei den Staffelpreisen eine weitere Option zur Verf&uuml;gung: &ldquo;<strong>Fixed</strong>&rdquo;. Dar&uuml;ber k&ouml;nnen Sie individuell f&uuml;r jedes vorzubereitende Produkt pauschale Preisaufschl&auml;ge oder -abschl&auml;ge definieren (z. B. ab 100 Stk. -&gt; 10 Euro Rabatt, ab 500 Stk. -&gt; 50 Euro Rabatt usw.).<br><br></li>
                    <li>M&ouml;chten Sie f&uuml;r einzelne Produkte, die in der Amazon Marktplatz-Konfiguration allgemein definierten Amazon Business Einstellungen nicht anwenden, k&ouml;nnen Sie diese in der Produktvorbereitung jederzeit &uuml;berschreiben.</li>
                </ul>
            ',
            'values' => array(
                '' => 'Nicht verwenden',
                'percent' => 'Prozent',
            ),
        ),
        'b2bdiscounttier1' => array(
            'label' => 'Staffelpreis Ebene 1',
            'help' => 'Der Rabatt muss größer als 0 sein'
        ),
        'b2bdiscounttier2' => array(
            'label' => 'Staffelpreis Ebene 2',
        ),
        'b2bdiscounttier3' => array(
            'label' => 'Staffelpreis Ebene 3',
        ),
        'b2bdiscounttier4' => array(
            'label' => 'Staffelpreis Ebene 4',
        ),
        'b2bdiscounttier5' => array(
            'label' => 'Staffelpreis Ebene 5',
        ),
        'b2bdiscounttier1quantity' => array(
            'label' => 'St&uuml;ckzahl',
        ),
        'b2bdiscounttier2quantity' => array(
            'label' => 'St&uuml;ckzahl',
        ),
        'b2bdiscounttier3quantity' => array(
            'label' => 'St&uuml;ckzahl',
        ),
        'b2bdiscounttier4quantity' => array(
            'label' => 'St&uuml;ckzahl',
        ),
        'b2bdiscounttier5quantity' => array(
            'label' => 'St&uuml;ckzahl',
        ),
        'b2bdiscounttier1discount' => array(
            'label' => 'Rabatt',
        ),
        'b2bdiscounttier2discount' => array(
            'label' => 'Rabatt',
        ),
        'b2bdiscounttier3discount' => array(
            'label' => 'Rabatt',
        ),
        'b2bdiscounttier4discount' => array(
            'label' => 'Rabatt',
        ),
        'b2bdiscounttier5discount' => array(
            'label' => 'Rabatt',
        )
    ),
), false);


MLI18n::gi()->add('amazon_config_sync',  array(
    'legend' => array(
        'sync' => 'Synchronisation des Inventars',
    ),
    'field' => array(
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
            'label' => 'Lagerver&auml;nderung Amazon',
            'hint' => '',
            'help' => '
                Wenn z. B. bei {#setting:currentMarketplaceName#} ein Artikel 3 mal gekauft wurde, wird der Lagerbestand im Shop um 3 reduziert.<br />
                <br />
                <strong>Wichtig:</strong> Diese Funktion läuft nur, wenn Sie den Bestellimport aktiviert haben!
            ',
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
    ),
), false);

MLI18n::gi()->add('amazon_config_orderimport', array(
    'legend' => array(
        'importactive' => 'Bestellimport',
        'mwst' => 'Mehrwertsteuer',
        'orderstatus' => 'Synchronisation des Bestell-Status vom Shop zu Amazon',
    ),
    'field' => array(
        'orderstatus.shipped' => array(
            'label' => 'Versand best&auml;tigen mit',
            'hint' => '',
            'help' => 'Setzen Sie hier den Shop-Status, der auf Amazon automatisch den Status "Versand best&auml;tigen" setzen soll.',
        ),
        'orderstatus.canceled' => array(
            'label' => 'Bestellung stornieren mit',
            'hint' => '',
            'help' => '
                Setzen Sie hier den Shop-Status, der auf  Amazon automatisch den Status "Bestellung stornieren" setzen soll. <br/><br/>
                Hinweis: Teilstorno ist hier&uuml;ber nicht m&ouml;glich. Die gesamte Bestellung wird &uuml;ber diese Funktion storniert
                und dem K&auml;ufer gutgeschrieben.
            ',
        ),
        'orderimport.shop' => array(
            'label' => '{#i18n:form_config_orderimport_shop_lable#}',
            'hint' => '',
            'help' => '{#i18n:form_config_orderimport_shop_help#}',
        ),
        'orderimport.paymentmethod' => array(
            'label' => 'Zahlart der Bestellungen',
            'help' => 'Zahlart, die allen Amazon-Bestellungen zugeordnet wird. Standard: "Amazon".<br><br>
				           Diese Einstellung ist wichtig f&uuml;r den Rechnungs- und Lieferscheindruck und f&uuml;r die nachtr&auml;gliche
				           Bearbeitung der Bestellung im Shop sowie einige Warenwirtschaften.',
            'hint' => '',
        ),
        'orderimport.shippingmethod' => array(
            'label' => 'Versandart der Bestellungen',
            'help' => 'Versandart, die allen Amazon-Bestellungen zugeordnet wird. Standard: "Amazon".<br><br>
				           Diese Einstellung ist wichtig f&uuml;r den Rechnungs- und Lieferscheindruck und f&uuml;r die nachtr&auml;gliche
				           Bearbeitung der Bestellung im Shop sowie einige Warenwirtschaften.',
           'hint' => '',
        ),
        'mwstfallback' => array(
            'label' => 'MwSt. Shop-fremder Artikel',
            'hint' => 'Steuersatz, der f&uuml;r Shop-fremde Artikel bei Bestellimport verwendet wird in %.',
            'help' => '
                Sollte der Artikel im Web-Shop nicht gefunden werden, verwendet magnalister den hier hinterlegten Steuersatz, da die Marktpl&auml;tze beim Bestellimport keine Angabe zur Mehrwertsteuer machen.<br />
                <br />
                Weitere Erl&auml;uterungen:<br />
                Grunds&auml;tzlich verh&auml;lt sich magnalister beim Bestellimport bei der Berechnung der Mehrwertsteuer so wie das Shop-System selbst.<br />
                <br />
                Damit die Mehrwertsteuer pro Land automatisch ber&uuml;cksichtigt werden kann, muss der gekaufte Artikel mit seinem des Nummernkreis (SKU) im Web-Shop gefunden werden.<br />
                magnalister verwendet dann die im Web-Shop konfigurierten Steuerklassen.
            ',
        ),
        /*//{search: 1427198983}
        'mwst.shipping' => array(
            'label' => 'MwSt. Versandkosten',
            'hint' => 'Steuersatz f&uuml;r Versandkosten in %.',
            'help' => '
                Amazon &uuml;bermittelt nicht den Steuersatz der Versandkosten, sondern nur die Brutto-Preise. Daher muss der Steuersatz zur korrekten Berechnung der Mehrwertsteuer f&uuml;r die Versandkosten hier angegeben werden. Falls Sie mehrwertsteuerbefreit sind, tragen Sie in das Feld 0 ein.
            ',
        ),
        //*/
        'importactive' => array(
            'label' => 'Import aktivieren',
            'hint' => '',
            'help' => '
                <p>Wenn die Funktion aktiviert ist, werden Bestellungen voreingestellt st&uuml;ndlich importiert.</p>
                <p>Einen manuellen Import k&ouml;nnen Sie ansto&szlig;en, indem Sie den entsprechenden Funktionsbutton rechts in der Kopfzeile von magnalister anklicken.</p>
                <p>Zus&auml;tzlich k&ouml;nnen Sie den Bestellimport (ab Tarif Flat - maximal viertelst&uuml;ndlich) auch durch einen eigenen CronJob ansto&szlig;en, indem Sie folgenden Link zu Ihrem Shop aufrufen:<br><em>{#setting:sImportOrdersUrl#}<br><br></em></p>
                <p><strong>Mehrwertsteuer:</strong></p>
                <p>Die Steuers&auml;tze f&uuml;r den Bestellimport k&ouml;nnen f&uuml;r die L&auml;nder, mit denen Sie handeln, nur korrekt ermittelt werden, wenn Sie die entsprechenden Mehrwertsteuers&auml;tze im Web-Shop gepflegt haben und die gekauften Artikel anhand der SKU im Web-Shop identifiziert werden k&ouml;nnen.<br>Wenn der Artikel nicht im Web-Shop gefunden wird, verwendet magnalister den unter "Bestellimport" &gt; "MwSt. Shop-fremder Artikel" hinterlegten Steuersatz als "Fallback".<br><br></p>
                <p><strong>Hinweis f&uuml;r Rechnungsstellung und Amazon B2B Bestellungen</strong> (setzt Teilnahme am Amazon Business-Verk&auml;uferprogramm voraus):</p>
                <p>Amazon &uuml;bergibt f&uuml;r den Bestellimport keine Umsatzsteuer-Identnummer. Somit kann magnalister zwar die B2B-Bestellungen im Web-Shop anlegen, jedoch sind formell korrekte Rechnungsstellungen somit nicht immer m&ouml;glich.</p>
                <p>Es besteht jedoch die Option, dass Sie die Umsatzsteuer-IDs &uuml;ber Ihre Amazon Seller Central abrufen und manuell in Ihre Shop-/ bzw. Warenwirtschaftssysteme nachpflegen. Auch k&ouml;nnen Sie den f&uuml;r B2B Bestellungen von Amazon angebotenen Rechnungsservice nutzen, der alle rechtlich relevanten Daten auf den Belegen an Ihre Kunden bereith&auml;lt.</p>
                <p>Sie erhalten als am Amazon Business-Verk&auml;uferprogramm teilnehmender H&auml;ndler alle f&uuml;r die Bestellungen notwendigen Unterlagen inkl. Umsatzsteuer-IDs in Ihrer Seller Central unter dem Punkt "Berichte" &gt; "Steuerdokumente". Wann die IDs zur Verf&uuml;gung stehen, h&auml;ngt von Ihrem B2B Vertrag mit Amazon ab (entweder nach 3 oder 30 Tagen).</p>
                <p>Sollten Sie f&uuml;r FBA angemeldet sein, erhalten Sie die Umsatzsteuer-IDs auch unter dem Punkt "Versand durch Amazon" im Reiter "Berichte".<br><br></p>
                <p><strong>Hinweis f&uuml;r den Bestellimport von Amazon FBA-Bestellungen</strong></p>
                <p>Sie haben die M&ouml;glichkeit, den Import von Amazon FBA-Bestellungen zu unterbinden. Dazu &ouml;ffnen Sie die Experteneinstellungen ganz unten. Unter &ldquo;Bestellimport&rdquo; -&gt; &ldquo;FBA Bestellimport&rdquo; k&ouml;nnen Sie den Import deaktivieren.</p>
                <p><strong>Wichtig:</strong> Trotz deaktiviertem FBA-Bestellimport wird die Anzahl der FBA-Bestellungen in magnalister im Hintergrund festgehalten und zu Ihrem Listing-Kontingent hinzugerechnet. Damit beugen wir einem m&ouml;glichen Missbrauch des magnalister Plugins f&uuml;r Amazon FBA vor.</p>
            '
        ),
        'import' => array(
            'label' => '',
            'hint' => '',
        ),
        'preimport.start' => array(
            'label' => 'erstmalig ab Zeitpunkt',
            'hint' => 'Startzeitpunkt',
            'help' => 'Startzeitpunkt, ab dem die Bestellungen erstmalig importiert werden sollen. Bitte beachten Sie, dass dies nicht beliebig weit in die Vergangenheit m&ouml;glich ist, da die Daten bei Amazon h&ouml;chstens einige Wochen lang vorliegen.',
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
                Der Status, den eine von Amazon neu eingegangene Bestellung im Shop automatisch bekommen soll.<br />
                Sollten Sie ein angeschlossenes Mahnwesen verwenden, ist es empfehlenswert, den Bestellstatus auf "Bezahlt" zu setzen (Konfiguration → Bestellstatus).
            ',
        ),
        'orderimport.fbablockimport' => array(
            'label' => 'FBA Bestellimport',
            'valuehint' => 'FBA Bestellungen nicht importieren',
            'help' => '
                <p><strong>Bestellungen &uuml;ber Amazon FBA nicht importieren</strong></p>
                <p>Sie haben die M&ouml;glichkeit, den Import von FBA Bestellungen in Ihren Shop zu unterbinden.</p>
                <p>Setzen Sie daf&uuml;r das H&auml;kchen und der Bestellimport wird f&uuml;r ab sofort exklusive der FBA Bestellungen stattfinden.</p>
                <p>Sollten Sie den Haken wieder entfernen, so werden neue FBA Bestellungen wie gewohnt importiert.</p>
                <p><strong>Wichtige Hinweise:</strong></p>
                <ul>
                    <li>Sollten Sie diese Funktion aktivieren, stehen Ihnen alle anderen FBA Funktionen im Rahmen des Bestellimports f&uuml;r diese Zeit nicht zur Verf&uuml;gung.<br><br></li>
                    <li>Trotz deaktiviertem FBA-Bestellimport wird die Anzahl der FBA-Bestellungen in magnalister im Hintergrund festgehalten und zu Ihrem Listing-Kontingent hinzugerechnet. Damit beugen wir einem m&ouml;glichen Missbrauch des magnalister Plugins f&uuml;r Amazon FBA vor.</li>
                </ul>
            ',
        ),
        'orderstatus.fba' => array(
            'label' => 'Status f&uuml;r FBA-Bestellungen',
            'hint' => '',
            'help' => 'Funktion nur f&uuml;r H&auml;ndler, die am Programm "Versand durch Amazon (FBA)" teilnehmen: <br/>Definiert wird der Bestellstatus, 
				           den eine von Amazon importierte FBA-Bestellung im Shop automatisch bekommen soll. <br/><br/>
				           Sollten Sie ein angeschlossenes Mahnwesen verwenden, ist es empfehlenswert, den Bestellstatus auf "Bezahlt" zu setzen (Konfiguration &rarr; 
						   Bestellstatus).',
        ),
        'orderimport.fbapaymentmethod' => array(
            'label' => 'Zahlart der Bestellungen (FBA)',
            'help' => 'Zahlart, die allen Amazon-Bestellungen zugeordnet wird, die durch Amazon versendet werden. Standard: "Amazon".<br><br>
                        Diese Einstellung ist wichtig f&uuml;r den Rechnungs- und Lieferscheindruck und f&uuml;r die nachtr&auml;gliche
                        Bearbeitung der Bestellung im Shop sowie einige Warenwirtschaften.',
            'hint' => '',
        ),
        'orderimport.fbashippingmethod' => array(
            'label' => 'Versandart der Bestellungen (FBA)',
            'help' => 'Versandart, die allen Amazon-Bestellungen zugeordnet wird, die durch Amazon versendet werden. Standard: "amazon".<br><br>
				           Diese Einstellung ist wichtig f&uuml;r den Rechnungs- und Lieferscheindruck und f&uuml;r die nachtr&auml;gliche
				           Bearbeitung der Bestellung im Shop sowie einige Warenwirtschaften.',
            'hint' => '',
        ),
        'orderstatus.carrier'=>array(
            'label' => 'Transportunternehmen',
            'help' => '',
            'hint' => 'Wählen Sie hier das Transportunternehmen (Versanddienstleister), das allen Amazon Bestellungen standardmäßig zugeordnet wird. Eine Angabe ist seitens Amazon verpflichtend. Weitere Details siehe Info-Icon.',
        ),
        'orderstatus.cancelled' => array(
            'label' => 'Bestellung stornieren mit',
            'hint' => '',
            'help' => 'Setzen Sie hier den Shop-Status, der auf Amazon automatisch den Status "Bestellung stornieren" setzen soll. <br/><br/>
                Hinweis: Teilstorno wird &uuml;ber die API von Amazon nicht angeboten. Die gesamte Bestellung wird &uuml;ber diese Funktion storniert
                und dem K&auml;ufer gutgeschrieben.',
        ),
        'orderimport.amazonpromotionsdiscount' => array(
            'label' => 'Amazon Werbeaktion',
            'help' => '<p>Sie haben die Möglichkeit, im Amazon Seller Central Werbeaktionen in Form von Produkt- oder Versandrabatten anzulegen. Wird ein Produkt auf Amazon mit einem entsprechenden Rabatt verkauft, so berücksichtigt magnalister dies beim Bestellimport:</p>
                <p>Dabei werden Produkt- und Versandrabatt im Rahmen des Bestellimports jeweils als eigene Produktpositionen an der Bestellung im Webshop hinterlegt.</p>
                <p>Hierzu legt magnalister die Bestellposition mit der vordefinierten Artikelnummer (SKU) an, die hier im rechten Eingabefeld hinterlegt ist. Standardmäßig haben wir folgende SKUs vordefiniert:</p>
                <ul>
                    <li>Produktrabatte: “__AMAZON_DISCOUNT__”</li>
                    <li>Versandrabatte:  “__AMAZON_SHIPPING_DISCOUNT__”</li>
                </ul>
                <p>Sie können diese SKUs jederzeit überschreiben und eigene Bezeichnungen hinterlegen.</p>
                <p><strong>Wichtiger Hinweis:</strong> Stellen Sie bei der Vergabe eigener SKUs sicher, dass diese nicht identisch zu SKUs bestehender Shop-Produkte sind, da sonst an diesen Produkten ungewollt der Bestand beim Bestellimport einer Werbeaktion reduziert wird.</p>',
        ),
        'orderimport.amazonpromotionsdiscount.products_sku' => array(
            'label' => 'Produktrabatt Artikelnummer',
        ),
        'orderimport.amazonpromotionsdiscount.shipping_sku' => array(
            'label' => 'Versandrabatt Artikelnummer',
        ),
    ),
), false);

MLI18n::gi()->add('amazon_config_emailtemplate', array(
    'legend' => array(
        'guidelines' => 'Amazon Kommunikationsrichtlinien',
        'mail' => '{#i18n:configform_emailtemplate_legend#}',
    ),
    'field' => array(
        'orderimport.amazoncommunicationrules.blacklisting' => array(
            'label' => 'Amazon Kommunikationsrichtlinien',
            'valuehint' => 'Amazon Richtlinien einhalten und E-Mails an Amazon Käufer vermeiden',
            'help' => '<p><strong>Amazon Richtlinien einhalten und E-Mails an Amazon K&auml;ufer vermeiden</strong></p>
                <p></p>
                <p>Die Amazon Kommunikationsrichtlinien untersagen den Versand von E-Mail-Benachrichtigungen (z. B. Bestellbest&auml;tigung, Versandbest&auml;tigung) au&szlig;erhalb der Amazon Plattform von Verk&auml;ufer zu K&auml;ufer.&nbsp;<br><br>Wenn der Haken bei &ldquo;Amazon Richtlinien einhalten und E-Mails an Amazon K&auml;ufer vermeiden&rdquo; gesetzt ist, &auml;ndert magnalister die Amazon-E-Mail Adresse dahin ab, dass sie ung&uuml;ltig und nicht mehr zustellbar wird. Die Amazon Kommunikationsrichtlinien w&auml;ren damit eingehalten, selbst wenn Ihr Shopsystem automatisch E-Mails an K&auml;ufer versendet.</p>
                <p>M&ouml;chten Sie trotz geltender Amazon Kommunikationsrichtlinien den Versand von E-Mails aus dem Shopsystem oder magnalister vornehmen, so entfernen Sie den Haken.</p>
                <p><strong>Wichtiger Hinweis:</strong>&nbsp;Der direkte Versand von E-Mail-Benachrichtigungen von Verk&auml;ufer zu K&auml;ufer kann dazu f&uuml;hren, dass Sie von Amazon gesperrt werden. Wir raten daher davon ab, die Standard-Einstellung zu deaktivieren und &uuml;bernehmen keine Haftung f&uuml;r eventuell entstehende Sch&auml;den.</p>
                <p><strong>Wie funktioniert das Unterdr&uuml;cken von E-Mails durch magnalister genau?</strong><br><br></p>
                <p>Wird der E-Mail-Versand von Ihrem Shopsystem oder magnalister angesto&szlig;en, setzt magnalister den Prefix &ldquo;blacklisted&quot; vor die E-Mail-Adresse des Amazon K&auml;ufers, sodass die E-Mail nicht ankommt (Beispiel: blacklisted-max-mustermann@amazon.de). Sie erhalten infolgedessen eine Unzustellbarkeitsbenachrichtigung (sog. Mailer Daemon) von Ihrem Mailserver. <br><br>Das betrifft sowohl E-Mails, die vom Shopsystem verschickt werden, als auch die Bestellbest&auml;tigung, die Sie im n&auml;chsten Abschnitt (&ldquo;E-Mail an K&auml;ufer&rdquo;) aktivieren k&ouml;nnen.</p>
            ',
        ),
        'mail.send' => array(
            'label' => '{#i18n:configform_emailtemplate_field_send_label#}',
            'help' => '<p><strong>E-Mail bei Bestelleingang an K&auml;ufer versenden?</strong></p>
                <p>Hier k&ouml;nnen Sie einstellen, ob Sie E-Mail-Benachrichtigungen (z. B. Bestellbest&auml;tigungen) aus magnalister heraus an Amazon K&auml;ufer versenden m&ouml;chten. Weiter unten k&ouml;nnen Sie dann die E-Mail-Details anpassen.</p>
                <p><strong>Wichtiger Hinweis:</strong> Die Amazon Kommunikationsrichtlinien untersagen eine direkte Kommunikation in Form von E-Mail-Benachrichtigungen von Verk&auml;ufer zu K&auml;ufer. Um nicht Gefahr zu laufen, von Amazon gesperrt zu werden, raten wir davon ab, E-Mails aus magnalister oder Ihrem Shopsystem heraus an den Amazon K&auml;ufer zu senden und &uuml;bernehmen keine Haftung f&uuml;r eventuell entstehende Sch&auml;den.</p>
                <p><strong>Achtung:</strong> M&ouml;chten Sie dennoch E-Mails an K&auml;ufer aus magnalister heraus versenden, m&uuml;ssen Sie zuerst den Haken weiter oben bei &ldquo;Amazon Richtlinien einhalten und E-Mails an Amazon K&auml;ufer vermeiden&rdquo; entfernen.</p>
            ',
            'modal' => array(
                'true' => '<p><strong>Wichtiger Hinweis zu den Amazon Kommunikationsrichtlinien</strong></p>
                    <p>Bitte beachten Sie, dass die Amazon Kommunikationsrichtlinien eine direkte Kommunikation in Form von E-Mail-Benachrichtigungen von Verkäufer und Käufer untersagen.</p>
                    <p>Wenn Sie Ihre Kunden trotzdem über Bestelleingänge per E-Mail informieren möchten, dann müssen Sie gleichzeitig den Haken zu “Amazon Richtlinien einhalten und E-Mails an Amazon Käufer vermeiden” <strong>entfernen</strong>.</p>
                    <p>Bestätigen Sie bitte, dass Sie diese Änderung vornehmen möchten:</p>
                    <p><strong>Ok</strong>: Ja, Ich möchte den Haken entfernen und E-Mails an Amazon Käufer senden</p>
                    <p><strong>Abbrechen</strong>: Nein, ich möchte mich an die Amazon Kommunikationsrichtlinien halten </p>
                '
            )
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
                        <dd>E-Mail Adresse des K&auml;ufers</dd>
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

MLI18n::gi()->add('amazon_config_shippinglabel', array(
    'legend' => array(
        'shippingaddresses' => 'Versandadressen {#i18n:Amazon_Productlist_Apply_Requiered_Fields#}',
        'shippingservice' => 'Versandeinstellungen',
        'shippinglabel' => 'Versandoptionen',
    ),
    'field' => array(
        'shippinglabel.address' => array(
            'label' => 'Versandadresse'
        ),
        'shippinglabel.address.name' => array(
            'label' => 'Name<span class="bull">&bull;</span>'
        ),
        'shippinglabel.address.company' => array(
            'label' => 'Firmenname'
        ),
        'shippinglabel.address.streetandnr' => array(
            'label' => 'Straße und Hausnummer<span class="bull">&bull;</span>'
        ),
        'shippinglabel.address.city' => array(
            'label' => 'Stadt<span class="bull">&bull;</span>'
        ),
        'shippinglabel.address.state' => array(
            'label' => 'Bundesland / Kanton'
        ),
        'shippinglabel.address.zip' => array(
            'label' => 'Postleitzahl<span class="bull">&bull;</span>'
        ),
        'shippinglabel.address.country' => array(
            'label' => 'Land<span class="bull">&bull;</span>'
        ),
        'shippinglabel.address.phone' => array(
            'label' => 'Telefonnummer<span class="bull">&bull;</span>'
        ),
        'shippinglabel.address.email' => array(
            'label' => 'E-Mail-Adresse<span class="bull">&bull;</span>'
        ),
        'shippingservice.carrierwillpickup' => array(
            'label' => 'Paket Abholung',
            'default' => 'false',
        ),
        'shippingservice.deliveryexperience' => array(
            'label' => 'Versandbedingung',
        ),
        'shippinglabel.fallback.weight' => array(
            'label' => 'Alternativ Gewicht',
            'help' => ' Falls ein Produkt kein Gewicht hinterlegt hat, wird der hier angegebene Wert verwendet.',
        ),
        'shippinglabel.weight.unit' => array(
            'label' => 'Maßeinheit Gewicht',
        ),
        'shippinglabel.size.unit' => array(
            'label' => 'Maßeinheit Gr&ouml;ße',
        ),
        'shippinglabel.default.dimension' => array(
            'label' => 'Benutzerdefinierte Paketgr&ouml;ßen',
        ),
        'shippinglabel.default.dimension.text' => array(
            'label' => 'Bezeichnung',
        ),
        'shippinglabel.default.dimension.length' => array(
            'label' => 'L&auml;nge',
        ),
        'shippinglabel.default.dimension.width' => array(
            'label' => 'Breite',
        ),
        'shippinglabel.default.dimension.height' => array(
            'label' => 'H&ouml;he',
        ),
    ),
), false);

MLI18n::gi()->add('amazon_config_vcs', array(
    'legend' => array(
        'amazonvcs' => 'Rechnungsübermittlung und Amazon VCS-Programm',
        'amazonvcsinvoice' => 'Daten für die Rechnungserzeugung durch magnalister',
    ),
    'field' => array(
        'amazonvcs.option' => array(
            'label' => 'Im Seller Central vorgenommene VCS-Einstellungen',
            'values' => array(
                'off' => 'Ich nehme nicht am Amazon VCS-Programm teil',
                'vcs' => 'Amazon Einstellung: Amazon erstellt meine Rechnungen',
                'vcs-lite' => 'Amazon Einstellung: Ich lade meine eigenen Rechnungen zu Amazon hoch',
            ),
            'hint' => 'Die hier eingestellte Option sollte Ihrer Auswahl im Amazon VCS-Programm (Eingabe im Amazon Seller Central) entsprechen.',
            'help' => '
                Bitte wählen Sie hier aus, ob und in welcher Form Sie bereits am Amazon VCS-Programm teilnehmen. Die Grundeinrichtung nehmen Sie im Seller Central vor.
                <br>
                Seitens magnalister stehen Ihnen drei Optionen zur Verfügung:
                <ol>
                    <li>
                        Ich nehme nicht am Amazon VCS-Programm teil<br>
                        <br>
                        Wenn Sie sich gegen eine Teilnahme am Amazon VCS-Programm entschlossen haben, wählen Sie diese Option. Sie können unter “Rechnungsübermittlung” dennoch wählen, ob und wie Sie Ihre Rechnungen zu Amazon hochladen möchten. Allerdings profitieren Sie dann nicht mehr von den Vorteilen des VCS-Programms (z.B. Verkäufer-Abzeichen und besseres Ranking).<br>
                        <br>
                    </li>
                    <li>
                        Amazon Einstellung: Amazon erstellt meine Rechnungen<br>
                        <br>
                        Die Rechnungserstellung und Umsatzsteuerberechnung erfolgt vollständig auf Amazons Seite im Rahmen des VCS-Programms. Die Konfiguration dazu nehmen Sie im Seller Central vor.<br>
                        <br>
                    </li>
                    <li>
                        Amazon Einstellung: Ich lade meine eigenen Rechnungen zu Amazon hoch<br>
                        <br>
                        Wählen Sie diese Option, wenn Sie entweder vom Shopsystem oder von magnalister erstellte Rechnungen (konkrete Auswahl im Feld “Rechnungsübermittlung”) zu Amazon hochladen möchten. Amazon übernimmt dann nur die Umsatzsteuerberechnung. Auch diese Auswahl erfolgt zuerst in der Seller Central.<br>
                        <br>
                    </li>
                </ol>
                <br>
                Wichtige Hinweise:
                <ul>
                    <li>Sofern Sie Option 1 oder 3 wählen, prüft magnalister bei jedem Bestellimport, ob eine Rechnung für eine von magnalister importierte Amazon Bestellung vorliegt. Ist dies der Fall, überträgt magnalister die Rechnung innerhalb von 60 Minuten an Amazon. Im Falle von Option 3 geschieht dies, sobald die Bestellung im Webshop den Versendet-Status erhalten hat.<br><br></li>
                </ul>
            '
        ),
        'amazonvcs.invoice'                      => array(
            'label' => 'Rechnungsübermittlung',
            'values' => array(
                'off'     => 'Rechnungen nicht zu Amazon übermitteln',
                'webshop' => 'Im Webshop erstellte Rechnungen werden zu Amazon übermittelt',
                'magna'   => 'Rechnungserstellung und -übermittlung erfolgt durch magnalister',
                'erp'     => 'Im Drittanbieter-System (z. B. ERP) erstellte Rechnungen werden zu Amazon übermittelt',
            ),
            'help' => '
                Hier können Sie wählen, ob und wie Sie Ihre Rechnungen zu Amazon übermitteln möchten. Zur Auswahl stehen folgende Optionen:
                <ol>
                    <li>
                        <p>Rechnungen nicht zu Amazon übermitteln</p>
                        <p>Wählen Sie diese Option, werden Ihre Rechnungen nicht zu Amazon übermittelt. Heißt: Sie organisieren die Bereitstellung von Rechnungen selbst.</p>
                    </li>
                    <li>
                        <p>Im Webshop erstellte Rechnungen werden zu Amazon übermittelt</p>
                        <p>Sofern Ihr Shopsystem über die Möglichkeit verfügt, Rechnungen zu erstellen, können Sie diese zu Amazon hochladen.</p>
                    </li>
                    <li>
                        <p>Von Drittanbieter-Systemen (z. B. ERP-System) erstellte Rechnungen werden zu Amazon übermittelt</p>
                        <p>Rechnungen, die Sie mit Ihrem Drittanbieter-System (z. B. ERP) erstellen, können Sie auf Ihren Webshop-Server hochladen, von magnalister abrufen und zu METRO hochladen lassen. Nähere Infos erscheinen nach Auswahl dieser Option im Info-Icon unter “Einstellungen für die Übermittlung von Rechnungen, die aus einem Drittanbieter-System [...]”.</p>
                    </li>
                    <li>
                        <p>magnalister soll die Rechnungserstellung übernehmen und zu Amazon übermitteln</p>
                        <p>Wählen Sie diese Option, wenn magnalister die Erstellung und Übermittlung von Rechnung für Sie übernehmen soll. Füllen Sie dazu die Felder unter “Daten für die Rechnungserzeugung durch magnalister” aus. Die Übertragung erfolgt alle 60 Min.</p>
                    </li>  
                </ol>
            ',
        ),
        'amazonvcsinvoice.invoicedir'            => array(
            'label'      => 'Übermittelte Rechnungen',
            'buttontext' => 'Anzeigen',
        ),
        'amazonvcsinvoice.language'              => array(
            'label' => 'Sprache der Rechnungen',
        ),
        'amazonvcsinvoice.mailcopy'              => array(
            'label' => 'Rechnungskopie an',
            'hint'  => 'Tragen Sie hier Ihre E-Mail-Adresse ein, um eine Kopie der hochgeladenen Rechnung per Mail zu erhalten.',
        ),
        'amazonvcsinvoice.invoiceprefix'         => array(
            'label'   => 'Präfix Rechnungsnummer',
            'hint'    => 'Wenn Sie hier ein Präfix eintragen, wird es vor die Rechnungsnummer gesetzt. Beispiel: R10000. Von magnalister generierte Rechnungen beginnen mit der Nummer 10000.',
            'default' => 'R', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
        ),
        'amazonvcsinvoice.reversalinvoiceprefix' => array(
            'label' => 'Präfix Stornorechnung',
            'hint' => 'Wenn Sie hier ein Präfix eintragen, wird es vor die Stornorechnungsnummer gesetzt. Beispiel: S20000. Von magnalister generierte Stornorechnungen beginnen mit der Nummer 20000.',
            'default' => 'S', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
        ),
        'amazonvcsinvoice.companyadressleft'     => array(
            'label' => 'Firmenadresse Anschriftfeld (links)',
            'default' => 'Ihr Name, Ihre Strasse 1, 12345 Ihr Ort', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
        ),
        'amazonvcsinvoice.companyadressright'    => array(
            'label' => 'Adresse Informationsblock rechts',
            'default' => "Ihr Name\nIhre Strasse 1\n\n12345 Ihr Ort", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
        ),
        'amazonvcsinvoice.headline' => array(
            'label' => 'Überschrift Rechnung',
            'default' => 'Ihre Rechnung', //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
        ),
        'amazonvcsinvoice.invoicehintheadline' => array(
            'label' => 'Überschrift Rechnungshinweise',
            'default' => "Rechnungshinweis", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
        ),
        'amazonvcsinvoice.invoicehinttext' => array(
            'label' => 'Hinweistext',
            'hint' => 'Leer lassen wenn kein Hinweistext auf der Rechnung erscheinen sollen',
            'default' => "Ihr Hinweistext für die Rechnung", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
        ),
        'amazonvcsinvoice.footercell1' => array(
            'label' => 'Fußzeile Spalte 1',
            'default' => "Ihr Name\nIhre Strasse 1\n\n12345 Ihr Ort", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
        ),
        'amazonvcsinvoice.footercell2' => array(
            'label' => 'Fußzeile Spalte 2',
            'default' => "Ihre Telefonnummer\nIhre Faxnummer\nIhre Homepage\nIhre E-Mail", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
        ),
        'amazonvcsinvoice.footercell3' => array(
            'label' => 'Fußzeile Spalte 3',
            'default' => "Ihre Steuernummer\nIhre Ust. ID. Nr.\nIhre Gerichtsbarkeit\nIhre Informationen", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
        ),
        'amazonvcsinvoice.footercell4' => array(
            'label' => 'Fußzeile Spalte 4',
            'default' => "Zusätzliche\nInformationen\nin der vierten\nSpalte", //@see ML_Amazon_Controller_Amazon_Config_VCS -> useI18nDefault
        ),
        'amazonvcsinvoice.preview' => array(
            'label' => 'Rechnungsvorschau',
            'buttontext' => 'Vorschau',
            'hint' => 'Hier können Sie sich eine Vorschau Ihrer Rechnung mit den von Ihnen hinterlegten Daten anzeigen lassen.',
        ),
    ),
), false);

// New Shipment Options
MLI18n::gi()->{'amazon_config_carrier_option_group_marketplace_carrier'} = 'Von Amazon vorgeschlagene Transportunternehmen';
MLI18n::gi()->{'amazon_config_carrier_option_group_additional_option'} = 'Zusätzliche Optionen';
MLI18n::gi()->{'amazon_config_carrier_option_matching_option_carrier'} = 'Von Amazon vorgeschlagene Transportunternehmen mit Versanddienstleistern aus Webshop Versandkosten-Modul matchen';
MLI18n::gi()->{'amazon_config_carrier_option_matching_option_shipmethod'} = 'Lieferservice mit Einträgen aus Webshop Versandkosten-Modul matchen';
MLI18n::gi()->{'amazon_config_carrier_option_database_option'} = 'Datenbank Matching';
MLI18n::gi()->{'amazon_config_carrier_option_orderfreetextfield_option'} = 'magnalister fügt ein Freitextfeld in den Bestelldetails hinzu';
MLI18n::gi()->{'amazon_config_carrier_option_freetext_option_carrier'} = 'Transportunternehmen pauschal aus Textfeld übernehmen';
MLI18n::gi()->{'amazon_config_carrier_option_freetext_option_shipmethod'} = 'Lieferservice pauschal aus Textfeld übernehmen';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier.freetext__label'} = 'Transportunternehmen:';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.carrier.freetext__placeholder'} = 'Tragen Sie hier ein Transportunternehmen ein';
MLI18n::gi()->{'amazon_config_carrier_matching_title_marketplace_carrier'} = 'Von Amazon vorgeschlagenes Transportunternehmen';
MLI18n::gi()->{'amazon_config_carrier_matching_title_marketplace_shipmethod'} = 'Manuelle Eingabe eines Lieferservice';
MLI18n::gi()->{'amazon_config_carrier_matching_title_shop_carrier'} = 'Versanddienstleister aus Webshop Versandkosten-Modul';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod__label'} = 'Lieferservice (Versandart / Versandmethode)';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod__hint'} = 'Wählen Sie hier den Lieferservice (Versandart / Versandmethode), der allen Amazon Bestellungen standardmäßig zugeordnet wird. Eine Angabe ist seitens Amazon verpflichtend. Weitere Details siehe Info-Icon.';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod.freetext__label'} = 'Lieferservice:';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shipmethod.freetext__placeholder'} = 'Tragen Sie hier einen Lieferservice ein';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress__label'} = 'Versand bestätigen und Absenderadresse festlegen';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress__help'} = '
Wählen Sie unter “Bestellstatus” den Webshop-Status aus, mit dem der Versand der Ware bestätigt werden soll.<br>
<br>
Rechts daneben können Sie die Adresse eintragen, von der die Ware versendet wird. Das bietet sich an, wenn die Versandadresse von der in Amazon hinterlegten Standard-Adresse abweichen soll (z. B. bei Versand aus einem externen Warenlager).<br>
<br>
Wenn Sie die Adressfelder leer lassen, verwendet Amazon die Absenderadresse, die Sie in Ihren Amazon Versandeinstellungen (Seller Central) angegeben haben.
';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.name__label'} = 'Name des Lagerstandortes';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.line1__label'} = 'Adresse (Zeile 1)';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.line2__label'} = 'Adresse (Zeile 2)';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.line3__label'} = 'Adresse (Zeile 3)';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.city__label'} = 'Stadt';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.county__label'} = 'Bezirk';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.stateorregion__label'} = 'Bundesland';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.postalcode__label'} = 'Postleitzahl';
MLI18n::gi()->{'amazon_config_orderimport__field__orderstatus.shippedaddress.countrycode__label'} = 'Land';

/** BOPIS */
MLI18n::gi()->add('amazon_config_bopis', array(
    'legend' => array(
        'stores' => '"Click & Collect in store" Filialen',
    ),
), false);

MLI18n::gi()->{'amazon_config_bopis__legend__products'} = 'Filialen Bestandsverwaltung';
MLI18n::gi()->{'amazon_config_bopis__legend__orders'} = 'Bestellstatus Synchronisation';
MLI18n::gi()->{'amazon_config_bopis__legend__orderimport'} = '{#i18n:amazon_config_account_orderimport#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.open__label'} = 'Status für "Click & Collect in store"-Bestellungen';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.open__help'} = 'Definiert wird der Bestellstatus, den eine von Amazon importierte "Click & Collect in store"-Bestellung im Shop automatisch bekommen soll.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.readyforpickup__label'} = 'Abholbereit';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.readyforpickup__help'} = 'Setzen Sie hier den Shop-Status, der auf Amazon automatisch den Status "Abholbereit" setzen soll.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.pickedup__label'} = 'Abgeholt';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.pickedup__help'} = 'Setzen Sie hier den Shop-Status, der auf Amazon automatisch den Status "Abgeholt" setzen soll.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.refund__label'} = 'Rückerstattung';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.orderstatus.refund__help'} = 'Setzen Sie hier den Shop-Status, der auf Amazon automatisch den eine Rückerstattung auslösen soll.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.refund.reason__label'} = 'Grund für die Rückerstattung';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.refund.reason__help'} = 'Wählen Sie hier eine standardmäßige Begründung für Rückerstattungen aus, welche dann im Falle der Cronjob-Synchronisation bei einer Rückerstattung ausgewählt wird.';
MLI18n::gi()->{'amazon_bopis.refund.reason_NoInventory'} = 'Kein Bestand';
MLI18n::gi()->{'amazon_bopis.refund.reason_CustomerReturn'} = 'Kunde hat das Produkt zurückgegeben';
MLI18n::gi()->{'amazon_bopis.refund.reason_GeneralAdjustment'} = 'Generelle Anpassung';
MLI18n::gi()->{'amazon_bopis.refund.reason_CouldNotShip'} = 'Kann nicht versendet werden';
MLI18n::gi()->{'amazon_bopis.refund.reason_DifferentItem'} = 'Falsches Produkt';
MLI18n::gi()->{'amazon_bopis.refund.reason_Abandoned'} = 'Abgebrochen / Aufgegeben';
MLI18n::gi()->{'amazon_bopis.refund.reason_CustomerCancel'} = 'Kunde hat storniert';
MLI18n::gi()->{'amazon_bopis.refund.reason_PriceError'} = 'Preisfehler';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stores__label'} = '"Click & Collect in store" Filialen hinzufügen oder aktualisieren';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.status__label'} = 'Filiale in Betrieb?';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.status__hint'} = 'Wenn das Kästchen nicht angekreuzt ist, bedeutet dies, dass die Filiale vorübergehend oder dauerhaft geschlossen ist.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stockmanagement__label'} = 'Lagerbestand';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stockmanagement__help'} = '
    Geben Sie hier an, wie viel Lagermenge eines Artikels für die jeweilige Filiale verf&uuml;gbar sein sollen.<br/>
    <br/>
    Um &Uuml;berverk&auml;ufe zu vermeiden, k&ouml;nnen Sie den Wert<br/>
    "<i>Shop-Lagerbestand &uuml;bernehmen abzgl. Wert aus rechtem Feld</i>" aktivieren.<br/>
    <br/>
    <strong>Beispiel:</strong> Wert auf "<i>2</i>" setzen. Ergibt &#8594; Shoplager: 10 &#8594; Store-Lager: 8<br/>
    <br/>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stockmanagement.store__label'} = 'Filiale';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.stockmanagement.quantity__label'} = 'Inventar der Filiale';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode__label'} = 'Filialen-Schlüssel<br>(Supply Source Code)<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode__help'} = 'Bitte legen sie einen Filialen-Schlüssel (Supply Source Code) für ihre Filiale fest. <br> Dieser wird genutzt um Ihre Filiale zu identifizieren, deshalb muss er <strong>einzigartig</strong> sein und kann nicht mehr geändert werden.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode_creation_error__label'} = 'Aus den unten aufgeführten Gründen konnten wir die Filiale nicht erstellen';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode_update_error__label'} = 'Aus den unten aufgeführten Gründen konnten wir die Filiale nicht aktualisieren';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.supplysourcecode_creationAndUpdate_error__label'} = 'Wir konnten die Filiale für Sie anlegen, allerding war es uns aufgrund der untenstehenden Fehler nicht möglich die Filiale zu aktualisieren';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.alias__label'} = '{#i18n:amazon_bopis_storename#}<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.alias__help'} = 'Dies wird dem Käufer in relevanten Anwendungsfällen angezeigt. Das Format muss "Name der Filiale - Straße - Postleitzahl" lauten.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.alias__placeholder'} = 'Name der Filiale - Straße - Postleitzahl';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.address__label'} = 'Adresse der Filiale<span class="bull">•</span>';
MLI18n::gi()->{'amazon_bopis_storename'} = 'Name der Filiale';
MLI18n::gi()->{'amazon_bopis_addressline1'} = 'Adresszeile 1<span class="bull">•</span>';
MLI18n::gi()->{'amazon_bopis_addressline2'} = 'Adresszeile 2';
MLI18n::gi()->{'amazon_bopis_addressline3'} = 'Adresszeile 3';
MLI18n::gi()->{'amazon_bopis_city'} = 'Stadt<span class="bull">•</span>';
MLI18n::gi()->{'amazon_bopis_county'} = 'Landkreis';
MLI18n::gi()->{'amazon_bopis_district'} = 'Bezirk';
MLI18n::gi()->{'amazon_bopis_stateorregion'} = 'Staat oder Region';
MLI18n::gi()->{'amazon_bopis_postalcode'} = 'Postleitzahl<span class="bull">•</span>';
MLI18n::gi()->{'amazon_bopis_country'} = 'Land<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.createstoresuccess'} = 'Die Filiale wurde erfolgreich erstellt - Code:  ';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.updatestoresuccess'} = 'Die Filiale wurde erfolgreich aktualisiert - Code:  ';

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
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.timezone__label'} = 'Zeitzone';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.timezone__hint'} = 'In welcher Zeitzone befindet sich die Filiale?';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.handlingtime__label'} = 'Bearbeitungszeit<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.handlingtime__hint'} = 'Die Bearbeitungszeit beschreibt die Zeitspanne, die Sie benötigen, um den Auftrag zur Abholung bereitzustellen.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.handlingtime__label'} = '{#i18n:amazon_config_bopis__field__bopis.array.configuration.handlingtime__label#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.handlingtime__help'} = '{#i18n:amazon_config_bopis__field__bopis.array.configuration.handlingtime__help#}';
MLI18n::gi()->{'amazon_bopis.handling_time_Days'} = 'Tage';
MLI18n::gi()->{'amazon_bopis.handling_time_Hours'} = 'Stunden';
MLI18n::gi()->{'amazon_bopis.handling_time_Minutes'} = 'Minuten';
MLI18n::gi()->{'amazon_bopis_value'} = 'Wert';
MLI18n::gi()->{'amazon_bopis_timeunit'} = 'Zeiteinheit';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.handlingtime.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.handlingtime.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.handlingtime.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.handlingtime.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_bopis_operationalconfiguration'} = 'Kontaktinformationen und Öffnungszeiten der Filiale<span class="bull">•</span>';
MLI18n::gi()->{'amazon_bopis_operationalconfiguration_hint'} = 'Wenn Sie z.B. samstags oder sonntags nicht geöffnet haben, lassen Sie die beiden Felder für Öffnungszeit und Schließzeit leer.';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration__label'} = '{#i18n:amazon_bopis_operationalconfiguration#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration__hint'} = '{#i18n:amazon_bopis_operationalconfiguration_hint#}';
MLI18n::gi()->{'amazon_bopis_contactdetails'} = 'Kontaktinformationen';
MLI18n::gi()->{'amazon_bopis_email'} = 'Email';
MLI18n::gi()->{'amazon_bopis_phone'} = 'Telefon';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.contactdetails__label'} = '{#i18n:amazon_bopis_contactdetails#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.contactdetails.email__label'} = '{#i18n:amazon_bopis_email#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.contactdetails.phone__label'} = '{#i18n:amazon_bopis_phone#}';
MLI18n::gi()->{'amazon_bopis_monday'} = 'Montag';
MLI18n::gi()->{'amazon_bopis_tuesday'} = 'Dienstag';
MLI18n::gi()->{'amazon_bopis_wednesday'} = 'Mittwoch';
MLI18n::gi()->{'amazon_bopis_thursday'} = 'Donnerstag';
MLI18n::gi()->{'amazon_bopis_friday'} = 'Freitag';
MLI18n::gi()->{'amazon_bopis_saturday'} = 'Samstag';
MLI18n::gi()->{'amazon_bopis_sunday'} = 'Sonntag';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.monday__label'} = '{#i18n:amazon_bopis_monday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.tuesday__label'} = '{#i18n:amazon_bopis_tuesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.wednesday__label'} = '{#i18n:amazon_bopis_wednesday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.thursday__label'} = '{#i18n:amazon_bopis_thursday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.friday__label'} = '{#i18n:amazon_bopis_friday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.saturday__label'} = '{#i18n:amazon_bopis_saturday#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.sunday__label'} = '{#i18n:amazon_bopis_sunday#}';
MLI18n::gi()->{'amazon_bopis_starttime'} = 'Öffnungszeit';
MLI18n::gi()->{'amazon_bopis_endtime'} = 'Schließzeit';
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
MLI18n::gi()->{'amazon_bopis_throughputconfig'} = 'Throughput Konfiguration';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.throughputconfig__label'} = '{#i18n:amazon_bopis_throughputconfig#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.throughputconfig.value__label'} = '{#i18n:amazon_bopis_value#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.configuration.operationalconfiguration.throughputconfig.timeunit__label'} = '{#i18n:amazon_bopis_timeunit#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities__label'} = 'Weitere Einstellungen';
MLI18n::gi()->{'amazon_bopis_issupported'} = 'Wird unterstützt?';
MLI18n::gi()->{'amazon_bopis_usefrommaster'} = 'Von Filiale übernehmen?';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.issupported__label'} = '{#i18n:amazon_bopis_issupported#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.operationalconfiguration__label'} = 'Ausgehende {#i18n:amazon_bopis_operationalconfiguration#}';
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
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.returnlocation.address__label'} = 'Adresse';
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

MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel__label'} = 'Abholkanal';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.issupported__label'} = '{#i18n:amazon_bopis_issupported#}';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.inventoryholdperiod__label'} = 'Haltefrist für den Warenbestand einer "Click & Collect in store"-Bestellung<span class="bull">•</span>';
MLI18n::gi()->{'amazon_config_bopis__field__bopis.array.capabilities.pickupchannel.inventoryholdperiod__help'} = 'Beschreibt, wie lange Sie den Bestand vorhalten, bis Sie den Auftrag stornieren, falls er nicht abgeholt wird.';
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
