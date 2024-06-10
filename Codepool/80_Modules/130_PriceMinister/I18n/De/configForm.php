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

MLI18n::gi()->priceminister_config_account_title = 'Zugangsdaten';
MLI18n::gi()->priceminister_config_account_prepare = 'Artikelvorbereitung';
MLI18n::gi()->priceminister_config_account_price = 'Preisberechnung';
MLI18n::gi()->priceminister_config_account_sync = 'Inventarsynchronisation';
MLI18n::gi()->priceminister_config_account_orderimport = 'Bestellimport';
MLI18n::gi()->priceminister_config_checkin_badshippingcost = 'Das Feld für die Versandkosten muss nummerisch sein.';
MLI18n::gi()->priceminister_config_account_emailtemplate = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->priceminister_config_account_emailtemplate_sender = 'Beispiel-Shop';
MLI18n::gi()->priceminister_config_account_emailtemplate_sender_email = 'beispiel@onlineshop.de';
MLI18n::gi()->priceminister_config_account_emailtemplate_subject = 'Ihre Bestellung bei #SHOPURL#';
MLI18n::gi()->priceminister_config_account_producttemplate = 'Produkt Template';
MLI18n::gi()->priceminister_config_account_emailtemplate_content = '
    <style>
        <!--body { font: 12px sans-serif; }
        table.ordersummary { width: 100%; border: 1px solid #e8e8e8; }
        table.ordersummary td { padding: 3px 5px; }
        table.ordersummary thead td { background: #cfcfcf; color: #000; font-weight: bold; text-align: center; }
        table.ordersummary thead td.name { text-align: left; }
        table.ordersummary tbody tr.even td { background: #e8e8e8; color: #000; }
        table.ordersummary tbody tr.odd td { background: #f8f8f8; color: #000; }
        table.ordersummary td.price, table.ordersummary td.fprice { text-align: right; white-space: nowrap; }
        table.ordersummary tbody td.qty { text-align: center; }-->
    </style>
    <p>Hallo #FIRSTNAME# #LASTNAME#,</p>
    <p>vielen Dank f&uuml;r Ihre Bestellung! Sie haben &uuml;ber #MARKETPLACE# in unserem Shop folgendes bestellt:</p>
    #ORDERSUMMARY#
    <p>Zuz&uuml;glich etwaiger Versandkosten.</p>
    <p>Weitere interessante Angebote finden Sie in unserem Shop unter <strong>#SHOPURL#</strong>.</p>
    <p>&nbsp;</p>
    <p>Mit freundlichen Gr&uuml;&szlig;en,</p>
    <p>Ihr Online-Shop-Team</p>
';
MLI18n::gi()->priceminister_config_producttemplate_content =
    '<p>#TITLE#</p>'.
    '<p>#ARTNR#</p>'.
    '<p>#SHORTDESCRIPTION#</p>'.
    '<p>#PICTURE1#</p>'.
    '<p>#PICTURE2#</p>'.
    '<p>#PICTURE3#</p>'.
    '<p>#DESCRIPTION#</p>';
MLI18n::gi()->priceminister_config_orderstatus_autoacceptance = 'Bitte beachten: Sie haben die Automatische Bestellbest&auml;tigung deaktiviert. Da PriceMinisters API die Versandkosten f&uuml;r nicht-best&auml;tigte Bestellungen nicht bereitstellt, werden Bestellungen ohne Versandkosten in Ihrem Web-Shop angelegt. Wir empfehlen daher die Bestellbest&auml;tigung zu aktivieren.';

MLI18n::gi()->add('priceminister_config_account', array(
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
            'label' => 'Benutzername',
        ),
        'token' => array(
            'label' => 'API Token',
            'help' => 'Go to the <a href="https://www.priceminister.com/usersecure?action=usrwstokenaccess" target="_blank">page</a> and get your token.'
        ),
    ),
), false);

MLI18n::gi()->add('priceminister_config_prepare', array(
    'legend' => array(
        'prepare' => 'Artikelvorbereitung',
        'upload' => 'Artikel hochladen: Voreinstellungen'
    ),
    'field' => array(
        'prepare.status' => array(
            'label' => 'Statusfilter',
            'valuehint' => 'nur aktive Artikel &uuml;bernehmen',
        ),
        'lang' => array(
            'label' => 'Artikelbeschreibung',
        ),
        'identifier' => array(
            'label' => 'Identifier',
        ),
        'checkin.status' => array(
            'label' => 'Statusfilter',
            'valuehint' => 'nur aktive Artikel übernehmen',
        ),
        'checkin.quantity' => array(
            'label' => 'St&uuml;ckzahl Lagerbestand',
            'help' => 'Geben Sie hier an, wie viel Lagermenge eines Artikels auf dem Marktplatz verf&uuml;gbar sein soll.<br>
                <br>
                Um &Uuml;berverk&auml;ufe zu vermeiden, k&ouml;nnen Sie den Wert<br>
                "<i>Shop-Lagerbestand &uuml;bernehmen abzgl. Wert aus rechtem Feld</i>" aktivieren.<br>
                <br>
                <strong>Beispiel:</strong> Wert auf "<i>2</i>" setzen. Ergibt &#8594; Shoplager: 10 &#8594; PriceMinister-Lager: 8<br>
                <br>
                <strong>Hinweis:</strong>Wenn Sie Artikel, die im Shop inaktiv gesetzt werden, unabh&auml;ngig der verwendeten Lagermengen<br>
                auch auf dem Marktplatz als Lager "<i>0</i>" behandeln wollen, gehen Sie bitte wie folgt vor:<br>
                <ul>
                <li>"<i>Synchronisation des Inventars</i>" > "<i>Lagerver&auml;nderung Shop</i>" auf "<i>automatische Synchronisation per CronJob" einstellen</i></li>
                <li>"<i>Globale Konfiguration" > "<i>Produktstatus</i>" > "<i>Wenn Produktstatus inaktiv ist, wird der Lagerbestand wie 0 behandelt" aktivieren</i></li>
                </ul>',
        ),
        'itemcondition' => array(
            'label' => 'Artikelzustand',
            'hint' => 'Werte werden vom Marktplatz bereitgestellt',
        ),
        'itemsperpage' => array(
            'label' => 'Ergebnisse',
            'help' => 'Hier k&ouml;nnen Sie festlegen, wie viele Produkte pro Seite beim Multimatching angezeigt werden sollen. <br\/>Je h&ouml;her die Anzahl, desto h&ouml;her auch die Ladezeit (bei 50 Ergebnissen ca. 30 Sekunden).',
            'hint' => 'pro Seite beim Multimatching',
        ),
    ),
), false);

MLI18n::gi()->add('priceminister_config_price', array(
    'legend' => array(
        'price' => 'Preisberechnung',
    ),
    'field' => array(
        'price' => array(
            'label' => 'Preis',
            'help' => 'Geben Sie einen prozentualen oder fest definierten Preis Auf- oder Abschlag an. Abschlag mit vorgesetztem Minus-Zeichen.'
        ),
        'price.addkind' => array(
            'label' => '',
        ),
        'price.factor' => array(
            'label' => '',
        ),
        'price.signal' => array(
            'label' => 'Nachkommastelle',
            'hint' => 'Nachkommastelle',
            'help' => '
                Dieses Textfeld wird beim &Uuml;bermitteln der Daten zu PriceMinister als Nachkommastelle an
                Ihrem Preis &uuml;bernommen.<br><br>
                <strong>Beispiel:</strong><br>
                Wert im Textfeld: 99<br>
                Preis-Ursprung: 5.58<br>
                Finales Ergebnis: 5.99<br><br>
                Die Funktion hilft insbesondere bei prozentualen Preis-Auf-/Abschl&auml;gen.<br>
                Lassen Sie das Feld leer, wenn Sie keine Nachkommastelle &uuml;bermitteln wollen.<br>
                Das Eingabe-Format ist eine ganzstellige Zahl mit max. 2 Ziffern.
            ',
        ),
        'priceoptions' => array(
            'label' => 'Preisoptionen',
        ),
        'price.group' => array(
            'label' => '',
        ),
        'price.usespecialoffer' => array(
            'label' => 'auch Sonderpreise verwenden',
        ),
        'exchangerate_update' => array(
            'label' => 'Wechselkurs',
            'valuehint' => 'Wechselkurs automatisch aktualisieren',
            'help' => '{#i18n:form_config_orderimport_exchangerate_update_help#}',
            'alert' => '{#i18n:form_config_orderimport_exchangerate_update_alert#}',
        ),
    ),
), false);

MLI18n::gi()->add('priceminister_config_sync', array(
    'legend' => array(
        'sync' => 'Synchronisation des Inventars',
    ),
    'field' => array(
        'stocksync.tomarketplace' => array(
            'label' => 'Lagerveränderung Shop',
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
            'label' => 'Lagerveränderung PriceMinister',
            'help' => '
                Wenn z. B. bei PriceMinister ein Artikel 3 mal gekauft wurde, wird der Lagerbestand im Shop um 3 reduziert.<br><br>
                <strong>Wichtig:</strong> Diese Funktion l&auml;uft nur, wenn Sie den Bestellimport aktiviert haben!
            ',
        ),
        'inventorysync.price' => array(
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
                <strong>Hinweis:</strong> Die Einstellungen unter "Konfiguration" → "Preisberechnung" werden berücksichtigt.
            ',
        ),
    ),
), false);

MLI18n::gi()->add('priceminister_config_orderimport', array(
    'legend' => array(
        'importactive' => 'Bestellimport',
        'mwst' => 'Mehrwertsteuer',
        'orderstatus' => 'Synchronisation des Bestell-Status vom Shop zu PriceMinister',
    ),
    'field' => array(
        'orderimport.shop' => array(
            'label' => '{#i18n:form_config_orderimport_shop_lable#}',
            'hint' => '',
            'help' => '{#i18n:form_config_orderimport_shop_help#}',
        ),
        'orderimport.shippingfromcountry' => array(
            'label' => 'Bestellung wird verschickt aus',
        ),
        'orderstatus.autoacceptance' => array(
            'label' => 'Automatische Bestellbest&auml;tigung',
            'valuehint' => 'automatische Bestellbest&auml;tigung',
            'help' => 'Da die PriceMinister API die Versandkosten f&uuml;r nicht-best&auml;tigte Bestellungen nicht bereitstellt, werden Bestellungen ohne Versandkosten in Ihrem Web-Shop angelegt, wenn die Funktion deaktiviert ist. Wir empfehlen daher die Automatische Bestellbest&auml;tigung zu aktivieren.',
        ),
        'orderstatus.accepted' => array(
            'label' => 'Bestellung akzeptieren mit',
            'hint' => '<span style="color:#e31a1c;">Bitte lesen Sie die Hilfe im Info-Icon für weitere Erklärungen.</span>',
            'help' => 'Bevor Sie den Versand bestätigen, wählen Sie bitte den Bestellstatus für die Auftragsannahme auf PriceMinister.<br/><br/>
                       <b>WICHTIG:</b><br/><br/> 
                       Eine Annahme oder Ablehnung der Bestellung muss innerhalb von 2 Tagen nach Erhalt der Bestellung erfolgen, ansonsten wird Ihr Konto auf PriceMinister deaktiviert.',
        ),
        'orderstatus.refused' => array(
            'label' => 'Bestellung ablehnen mit',
            'hint' => '<span style="color:#e31a1c;">Bitte lesen Sie die Hilfe im Info-Icon für weitere Erklärungen.</span>',
            'help' => 'Bitte wählen Sie einen Shop-Bestellstatus, um die Bestellung auf PriceMinister zu abzulehnen.<br/><br/>
                       <b>WICHTIG:</b><br/><br/> 
                        Eine Annahme oder Ablehnung der Bestellung muss innerhalb von 2 Tagen nach Erhalt der Bestellung erfolgen, ansonsten wird Ihr Konto auf PriceMinister deaktiviert.',
        ),
        'orderstatus.shipped' => array(
            'label' => 'Versand best&auml;tigen mit',
            'help' => 'Setzen Sie hier den Shop-Status, der auf PriceMinister automatisch den Status "Versand best&auml;tigen" setzen soll.',
        ),
        'orderstatus.canceled' => array(
            'label' => 'Bestellung stornieren mit',
            'help' => ' Setzen Sie hier den Shop-Status, der auf  PriceMinister automatisch den Status "Bestellung stornieren" setzen soll. <br/><br/>
                Hinweis: Teilstorno ist hier&uuml;ber nicht m&ouml;glich. Die gesamte Bestellung wird &uuml;ber diese Funktion storniert
                und dem K&auml;ufer gutgeschrieben.',
        ),
        'orderstatus.comment' => array(
            'label' => 'Bestellung stornieren Grund',
            'help' => ' Der Grund warum die Bestellung storniert wird.',
        ),
        'orderstatus.carrier' => array(
            'label' => 'Spediteur',
            'help' => 'Vorausgew&auml;hlter Spediteur beim Best&auml;tigen des Versandes nach PriceMinister.',
        ),
        'mwst.fallback' => array(
            'label' => 'MwSt. Shop-fremder Artikel',
            'hint' => 'Steuersatz, der f&uuml;r Shop-fremde Artikel bei Bestellimport verwendet wird in %.',
            'help' => '
                Wenn der Artikel nicht &uuml;ber magnalister eingestellt wurde, kann die Mehrwertsteuer nicht ermittelt werden.<br />
                Als L&ouml;sung wird der hier angegebene Wert in Prozent bei allen Produkten hinterlegt, deren 
                Mehrwertsteuersatz beim Bestellimport aus PriceMinister nicht bekannt ist.
            ',
        ),
        'importactive' => array(
            'label' => 'Import aktivieren',
            'hint' => '',
            'help' => '
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
        'import' => array(
            'label' => '',
        ),
        'preimport.start' => array(
            'label' => 'erstmalig ab Zeitpunkt',
            'hint' => 'Startzeitpunkt',
            'help' => 'Startzeitpunkt, ab dem die Bestellungen erstmalig importiert werden sollen. Bitte beachten Sie, '
                . 'dass dies nicht beliebig weit in die Vergangenheit m&ouml;glich ist, da die Daten bei PriceMinister '
                . 'h&ouml;chstens einige Wochen lang vorliegen.',
        ),
        'customergroup' => array(
            'label' => 'Kundengruppe',
            'help' => 'Kundengruppe, zu der Kunden bei neuen Bestellungen zugeordnet werden sollen.',
        ),
        'orderstatus.open' => array(
            'label' => 'Bestellstatus im Shop',
            'help' => '
                Der Status, den eine von PriceMinister neu eingegangene Bestellung im Shop automatisch bekommen soll.<br>
                Sollten Sie ein angeschlossenes Mahnwesen verwenden, ist es empfehlenswert, 
                den Bestellstatus auf "Bezahlt" zu setzen (Konfiguration → Bestellstatus).
            ',
        ),
        'orderimport.shippingmethod' => array(
            'label' => 'Versandart der Bestellungen',
            'help' => 'Versandart, die allen PriceMinister-Bestellungen zugeordnet wird. Standard: "PriceMinister".<br><br>'
                . 'Diese Einstellung ist wichtig f&uuml;r den Rechnungs- und Lieferscheindruck und f&uuml;r '
                . 'die nachtr&amul;gliche Bearbeitung der Bestellung im Shop sowie einige Warenwirtschaften.',
        ),
    ),
), false);

MLI18n::gi()->add('priceminister_config_producttemplate', array(
    'legend' => array(
        'product' => array(
            'title' => 'Produkt-Template',
            'info' => 'Template f&uuml;r die Produktbeschreibung auf PriceMinister. (Sie k&ouml;nnen den Editor unter "Globale Konfiguration" > "Experteneinstellungen" umschalten.)',
        )
    ),
    'field' => array(
        'template.name' => array(
            'label' => 'Template Produktname',
            'help' => '
            <dl>
                <dt>Name des Produkts auf PriceMinister</dt>
                 <dd>Einstellung, wie das Produkt auf PriceMinister hei&szlig;en soll.
                     Der Platzhalter <b>#TITLE#</b> wird automatisch durch den Produktnamen aus dem Shop ersetzt,
                     <b>#BASEPRICE#</b> durch Preis pro Einheit, soweit f&uuml;r das betreffende Produkt im Shop hinterlegt.</dd>
                <dt>Bitte beachten Sie:</dt>
                 <dd><b>#BASEPRICE#</b> wird erst beim Hochladen zu PriceMinister ersetzt, denn bei der Vorbereitung kann der Preis noch ge&auml;ndert werden.</dd>
                 <dd>Da der Grundpreis ein fester Wert in dem Titel ist und nicht aktualisiert werden kann, sollte der Preis nicht ge&auml;ndert werden, denn dies w&uuml;rde zu falschen Preisangaben f&uuml;hren.<br />
                    Sie k&ouml;nnen den Platzhalter auf eigenen Gefahr verwenden, wir empfehlen aber in dem Fall, <b>die Preissynchronisation auszuschalten</b> (Einstellung in der magnalister PriceMinister Konfiguration).</dd>
                <dt>Wichtig:</dt>
                 <dd>Bitte beachten Sie, dass seitens PriceMinister die Titel-L&auml;nge auf maximal 40 Zeichen beschr&auml;nkt ist. magnalister schneidet den Titel mit mehr als 40 Zeichen w&auml;hrend des Produkt-Uploads entsprechend ab.</dd>
            </dl>
            ',
        ),
        'template.content' => array(
            'label' => 'Template Produktbeschreibung',
            'hint' => '
                Liste verf&uuml;gbarer Platzhalter f&uuml;r die Produktbeschreibung:
                <dl>
                        <dt>#TITLE#</dt>
                                <dd>Produktname (Titel)</dd>
                        <dt>#ARTNR#</dt>
                                <dd>Artikelnummer im Shop</dd>
                        <dt>#PID#</dt>
                                <dd>Products ID im Shop</dd>
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

MLI18n::gi()->add('priceminister_config_emailtemplate', array(
    'legend' => array(
        'mail' => '{#i18n:configform_emailtemplate_legend#}',
    ),
    'field' => array(
        'mail.send' => array(
            'label' => '{#i18n:configform_emailtemplate_field_send_label#}',
            'help' => '{#i18n:configform_emailtemplate_field_send_help#}',
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
                    <dd>Password des K&auml;ufers zum Einloggen in Ihren Shop. Nur bei Kunden, die dabei 
                        automatisch angelegt werden, sonst wird der Platzhalter durch \'(wie bekannt)\' ersetzt.</dd>
                    <dt>#ORDERSUMMARY#</dt>
                    <dd>Zusammenfassung der gekauften Artikel. Sollte extra in einer Zeile stehen.<br>
                        <i>Kann nicht im Betreff verwendet werden!</i>
                    </dd>
                    <dt>#MARKETPLACE#</dt>
                    <dd>Name dieses Marketplaces</dd>
                    <dt>#SHOPURL#</dt>
                    <dd>URL zu Ihrem Shop</dd>
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
