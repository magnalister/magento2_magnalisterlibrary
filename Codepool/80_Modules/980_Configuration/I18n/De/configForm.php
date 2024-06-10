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

MLI18n::gi()->add('configuration', array(
    'legend' => array(
        'general' => 'Allgemeine Einstellungen',
        'sku' => 'Synchronisation Nummernkreise',
        'stats' => 'Statistiken',
        'orderimport' => 'Bestellimport',
        'crontimetable' => 'Sonstiges',
        'articlestatusinventory' => 'Inventar',
        'productfields' => 'Produkteigenschaften',
    ),
    'field' => array(
        'general.passphrase' => array(
            'label' => 'PassPhrase',
            'help' => 'Die PassPhrase erhalten Sie nach der Registrierung auf www.magnalister.com.',
        ),
        'general.keytype' => array(
            'label'  => 'Bitte w&auml;hlen Sie',
            'help'   => 'Je nach Auswahl wird die Artikelnummer vom Shop als SKU auf dem Marktplatz verwendet, oder die Product ID
                                              des Shops als Marktplatz-SKU verwendet, um das Produkt bei Lagersynchronisation und Bestellimporten zuordnen zu k&ouml;nnen.<br/><br/>
                                              Diese Funktion wirkt sich ma&szlig;geblich bei der Weiterverarbeitung 
                                              &uuml;ber eine Warenwirtschaft, sowie bei Abgleich der Shop- und Marktplatz-Inventare aus.<br /><br />
                                              <strong>Vorsicht!</strong> Die Synchronisation der Lagermengen und -Preise h&auml;ngt von dieser Einstellung ab. Wenn Sie bereits Artikel hochgeladen haben, sollten Sie diese Einstellung <strong>nicht mehr &auml;ndern</strong>, sonst k&ouml;nnen die "alten" Artikel nicht mehr synchronisiert werden.',
            'values' => array(
                'pID'   => 'Product ID (Shop) = SKU (Marktplatz)<br>',
                'artNr' => 'Artikelnummer (Shop) = SKU (Marktplatz)'
            ),
            'alert'  => array(
                'pID'   => '{#i18n:sChangeKeyAlert#}',
                'artNr' => '{#i18n:sChangeKeyAlert#}'
            ),
        ),
        'general.stats.backwards' => array(
            'label' => 'Monate zur&uuml;ck',
            'help' => 'Wie viele Monate soll die Statistik zur&uuml;ck reichen?',
            'values' => array(
                '0' => '1 Monat',
                '1' => '2 Monate',
                '2' => '3 Monate',
                '3' => '4 Monate',
                '4' => '5 Monate',
                '5' => '6 Monate',
                '6' => '7 Monate',
                '7' => '8 Monate',
                '8' => '9 Monate',
                '9' => '10 Monate',
                '10' => '11 Monate',
                '11' => '12 Monate',
                '12' => '13 Monate',
                '13' => '14 Monate',
            ),
        ),
        'general.order.information' => array(
            'label' => 'Bestellinformation',
            'valuehint' => 'Bestellnummer, Marktplatzname und Bestellnachricht des Käufers (falls vorhanden) im Kundenkommentar speichern',
            'help' => 'Wenn Sie die Funktion aktivieren, wird die Marktplatz-Bestellnummer, der Marktplatzname und, soweit übermittelt, die Nachricht des Käufers, nach dem Bestellimport im Kundenkommentar gespeichert.<br />
                Der Kundenkommentar kann in vielen Systemen auf der Rechnung &uuml;bernommen werden, so dass der Endkunde somit automatisch Information erhält, woher die Bestellung urspr&uuml;nglich stammt.<br />
                Auch k&ouml;nnen Sie damit Erweiterungen f&uuml;r weitere statistische Umsatz-Auswertungen programmieren lassen.<br />
                <b>Wichtig:</b> Einige Warenwirtschaften importieren keine Bestellungen, bei denen der Kundenkommentar gesetzt ist. Wenden Sie sich für weitere Fragen dazu bitte direkt an Ihren WaWi-Anbieter.',
        ),
        'general.editor'                                  => array(
            'label' => 'Editor',
            'help' => 'Editor f&uuml;r Artikelbeschreibungen, Templates und E-Mails an Käufer.<br /><br />
                                <strong>TinyMCE Editor:</strong><br />Verwenden Sie einen komfortablen Editor, der fertig formatiertes HTML anzeigt und z.B. Bild-Pfade in der 
                                Artikelbeschreibung automatisch korrigiert.<br /><br />
                                <strong>Einfaches Textfeld, lokale Links erweitern:</strong><br />Verwenden Sie ein einfaches Textfeld. Sinnvoll in F&auml;llen wenn der TinyMCE Editor ungewollte &Auml;nderungen der eingegebenen Templates bewirkt
                                (wie z.B. in dem eBay-Produkt-Template).<br />
                                Bilder oder Links, deren Adressen nicht mit <strong>http://</strong>,
                                <strong>javascript:</strong>, <strong>mailto:</strong> oder <strong>#</strong> anfangen,
                                werden jedoch um die Shop-Adresse erweitert.<br /><br />
                                <strong>Einfaches Textfeld, Daten direkt &uuml;bernehmen:</strong><br />Es werden keine Adressen erweitert oder sonstige &Auml;nderungen am eingegebenen Text vorgenommen.',
            'values' => array(
                'tinyMCE' => 'TinyMCE Editor<br>',
                'none' => 'Einfaches Textfeld, lokale Links erweitern<br>',
                'none_none' => 'Einfaches Textfeld, Daten direkt &uuml;bernehmen'
            ),
        ),
        'general.cronfronturl'                            => array(
            'label' => 'Base CRON Url',
            'help'  => 'Diese URL wird automatisch aus den Einstellungen des Shopsystems errechnet und aufgerufen, um die Inventarsynchronisation, den Bestellimport und ... von magnalister-Servern durchzuführen. Nur wenn die aktuelle URL nicht aufrufbar ist, können Sie die URL hier ändern. Um die URL auf das Original zurückzusetzen, leeren Sie die Eingabe und speichern Sie die Konfiguration.',
        ),
        'general.inventar.productstatus'                  => array(
            'label'  => 'Produktstatus',
            'help'   => 'Sie k&ouml;nnen mit dieser Funktion bestimmen, ob Artikel, die im Web-Shop auf "<i>Inaktiv</i>" gesetzt werden, auch auf dem Marktplatz beendet (eBay),<br/>
                                                        oder ebenfalls "inaktiv" gesetzt werden (&uuml;brige).<br/>
                                                        <br/>
                                                        Damit diese Funktion wirksam wird, aktivieren Sie bitte auch im jeweiligen Marktplatz Modul unter<br/>
                                                        "<i>Synchronisation des Inventars</i>" > "<i>Lagerver&auml;nderung Shop</i>" ><br/>
                                                        "<i>automatische Synchronisation per CronJob</i>".<br/>',
            'values' => array(
                'true'  => 'Wenn Produktstatus inaktiv ist, wird der Lagerbestand wie 0 behandelt<br>',
                'false' => 'Immer den aktuellen Lagerbestand nutzen'
            ),
        ),
        'general.manufacturer'                            => array(
            'label' => 'Hersteller',
            'help' => 'W&auml;hlen Sie hier das Produkt-Attribut / Freitextfeld, in dem der Hersteller-Name des Produkts gespeichert wird.
            Die Attribute / Freitextfelder definieren Sie direkt &uuml;ber Ihre Web-Shop Verwaltung.',
        ),
        'general.manufacturerpartnumber'                  => array(
            'label' => 'Hersteller-Modellnummer',
            'help' => 'W&auml;hlen Sie hier die Artikel-Eigenschaft / Freitextfeld, in dem die Hersteller-Modellnummer des Produkts gespeichert wird.
                Die Artikel-Eigenschaften / Freitextfelder definieren Sie direkt &uuml;ber Ihre Web-Shop Verwaltung.',
        ),
        'general.ean' => array(
            'label' => 'EAN',
            'help' => 'European Article Number<br/><br/>
                                                   <b>Hinweis:</b> Diese Daten werden nicht &uuml;berpr&uuml;ft. Sollten Sie fehlerhaft sein, wird es zu Datenbankfehlern kommen!',
        ),
        'general.upc' => array(
            'label' => 'UPC',
            'help' => 'Universal Product Code<br/><br/>
                                                   <b>Hinweis:</b> Diese Daten werden nicht &uuml;berpr&uuml;ft. Sollten Sie fehlerhaft sein, wird es zu Datenbankfehlern kommen!',
        ),
    ),
));
