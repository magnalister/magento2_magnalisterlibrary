<?php
/**
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
* (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLI18n::gi()->add('formfields__stocksync.tomarketplace', array('help' => '
<p>Hier stellen Sie ein, ob und wie magnalister Lagerbestands&auml;nderungen in Ihrem Webshop an Etsy &uuml;bertragen soll:</p>
<p>1. Keine Synchronisation</p>
<p>Der Lagerbestand wird nicht von Ihrem Webshop zu Etsy synchronisiert.</p>
<p>2. Automatische Synchronisierung <strong>mit</strong> Null-Bestand (empfohlen)</p>
<p>Der Lagerbestand wird automatisch von Ihrem Webshop zu Etsy synchronisiert. Das gilt auch f&uuml;r Produkte mit Lagerbest&auml;nden &lt; 1. Diese werden auf inaktiv gestellt und automatisch reaktiviert, sobald der Lagerbestand wieder &gt; 0 ist.</p>
<p><strong>Wichtiger Hinweis:</strong> Bei Etsy fallen durch die Reaktivierung von Artikeln Geb&uuml;hren an.</p>
<p>3. Automatische Synchronisierung <strong>ohne</strong> Null-Bestand</p>
<p>Der Lagerbestand wird nur dann automatisch synchronisiert, wenn er &gt; 0 ist. Artikel werden auf Etsy <strong>nicht automatisch reaktiviert</strong> - auch wenn Sie im Webshop wieder auf Lager sind. Dadurch werden intransparente Geb&uuml;hren verhindert.</p>
<p><strong>Allgemeine Hinweise:</strong></p>
<ul>
<li>Artikelvarianten: Die automatische Lagerbestands-Synchronisation von Artikelvarianten (auch bei einem Bestand &lt; 1) ist bei Etsy geb&uuml;hrenfrei, solange mindestens noch eine Variante am Produkt &gt; 0 ist.<br /><br /></li>
<li>Einzelne inaktive Produkte k&ouml;nnen Sie manuell reaktivieren, indem Sie den Lagerbestand im Webshop &gt; 0 setzen und den Produkt-Upload &uuml;ber die magnalister Schnittstelle erneut ansto&szlig;en.<br /><br /></li>
<li>Die automatische Lagerbestands-Synchronisation findet alle 4 Stunden per CronJob statt. Der Zyklus beginnt t&auml;glich um 0:00 Uhr. Die Werte aus der Datenbank werden gepr&uuml;ft und &uuml;bernommen, auch wenn die &Auml;nderungen durch z.B. eine Warenwirtschaft nur in der Datenbank erfolgten.<br /><br /></li>
<li>Zus&auml;tzlich k&ouml;nnen Sie den Lagerabgleich (ab Tarif Flat - maximal viertelst&uuml;ndlich) auch durch einen eigenen CronJob ansto&szlig;en, indem Sie folgenden Link zu Ihrem Shop aufrufen:<br /><br />{#setting:sSyncInventoryUrl#}<br /><br />Eigene CronJob-Aufrufe durch Kunden, die nicht im Tarif Flat sind, oder die h&auml;ufiger als viertelst&uuml;ndlich laufen, werden geblockt.<br /><br /></li>
<li>Einen manuellen Abgleich k&ouml;nnen Sie ansto&szlig;en, indem Sie den entsprechenden Funktionsbutton in der Kopfzeile oben rechts anklicken.<br /><br /></li>
<li>Weitere Informationen zu den Etsy Geb&uuml;hren finden Sie im <a href="https://help.etsy.com/hc/en-us/articles/360000344908">Etsy Help Center</a><br /><br /></li>
</ul>
<p>&nbsp;</p>
'));

MLI18n::gi()->add('formfields_etsy', array(
    'shippingprofiletitle'             => array(
        'label' => 'Versandgruppen Titel<span class="bull">&bull;</span>',
    ),
    'shippingprofileorigincountry'           => array(
        'label' => 'Herkunftsland<span class="bull">&bull;</span>',
        'help'  => 'Land, aus dem das Produkt versendet wird',
    ),
    'shippingprofiledestinationcountry'           => array(
        'label' => 'Destination country',
        'help'  => 'Country where the listing is shipped',
    ),
    'shippingprofiledestinationregion'           => array(
        'label' => 'Destination region',
        'help'  => 'Region where the listing is shipped available values (inside EU, Outside EU and none)',
    ),
    'shippingprofileprimarycost'       => array(
        'label' => 'Primärkosten<span class="bull">&bull;</span>',
        'help'  => 'Die Versandkosten für diesen Artikel, wenn er allein versandt wird.',
    ),
    'shippingprofilesecondarycost'     => array(
        'label' => 'Sekundäre Kosten<span class="bull">&bull;</span>',
        'help'  => 'Die Versandkosten für diesen Artikel, wenn er mit einem anderen Artikel verschickt wird.',
    ),
    'shippingprofileminprocessingtime' => array(
        'label' => 'Mindestdauer der Bearbeitung<span class="bull">&bull;</span>',
        'help'  => 'Die Mindestdauer für die Bearbeitung des Angebots.',
    ),
    'shippingprofilemaxprocessingtime' => array(
        'label' => 'Höchstdauer der Bearbeitung<span class="bull">&bull;</span>',
        'help'  => 'Die Höchstdauer der Bearbeitung des Angebots.',
    ),
    'shippingprofilemindeliverydays'   => array(
        'label' => 'Mindestdauer der Lieferung<span class="bull">&bull;</span>',
        'help'  => 'Die Mindestdauer für die Zustellung der Ware.',
    ),
    'shippingprofilemaxdeliverydays'   => array(
        'label' => 'Höchstdauer der Lieferung<span class="bull">&bull;</span>',
        'help'  => 'Die Höchstdauer für die Lieferung in Tagen.',
    ),
    'shippingprofileoriginpostalcode'  => array(
        'label' => 'Postleitzahl des Versandortes<span class="bull">&bull;</span>',
        'help'  => 'Die Postleitzahl des Ortes, von dem aus das Angebot versandt wird (nicht unbedingt eine Zahl)',
    ),
    'shippingprofilesend'              => array(
        'label' => 'Versandgruppe erstellen',
    ),
    'whomade'                           => array(
        'values' => array(
            'i_did'        => 'Ich war\'s',
            'collective'   => 'Ein Mitglied meines Shops',
            'someone_else' => 'Eine andere Firma oder Person',
        ),
    ),
    'whenmade'                          => array(
        'values' => array(
            'made_to_order' => 'Produktion auf Bestellung',
            '2020_'.date('Y') => '2020-'.date('Y'),
            '2010_2019' => '2010-2019',
            '2004_2009' => '2004-2009',
            'before_2004' => 'Vor 2004',
            '2000_2003' => '2000-2003',
            '1990s' => '1990ern',
            '1980s' => '1980ern',
            '1970s' => '1970ern',
            '1960s' => '1960ern',
            '1950s' => '1950ern',
            '1940s' => '1940ern',
            '1930s' => '1930ern',
            '1920s' => '1920ern',
            '1910s' => '1910ern',
            '1900s' => '1900er',
            '1800s' => '1800er',
            '1700s' => '1700er',
            'before_1700' => 'Vor 1700'
        ),
    ),
    'issupply' => array(
        'values' => array(
            'false' => 'Ein fertiges Produkt',
            'true' => 'Zubehör oder ein Werkzeug, um etwas herzustellen',
        ),
    ),
    'access.token' => array(
        'label' => 'Etsy Token',
    ),
    'shop.language' => array(
        'label' => 'Etsy Sprache',
        'values' => array(
            'de' => 'Deutsch',
            'en' => 'English',
            'es' => 'Español',
            'fr' => 'Français',
            'it' => 'Italiano',
            'ja' => '日本語',
            'nl' => 'Nederlands',
            'pl' => 'Polski',
            'pt' => 'Português',
            'ru' => 'Русский',
        ),
    ),
    'shop.currency' => array(
        'label' => 'Etsy Währung',
        'values' => array(
            'EUR' => '€ Euro',
            'USD' => '$ US-Dollar',
            'CAD' => '$ Kanadischer Dollar',
            'GBP' => '£ Britische Pfund',
            'AUD' => '$ Australischer Dollar',
            'DDK' => 'kr Dänische Krone',
            'HKD' => '$ Honkong-Dollar',
            'NZD' => '$ Neuseeländischer Dollar',
            'NOK' => 'kr Norwegische Krone',
            'SGD' => '$ Singapur-Dollar',
            'SEK' => 'kr Schwedische Krone',
            'CHF' => 'Schweizer Franken',
            'TWD' => 'NT$ Neuer Taiwan-Dollar',
        ),
    ),
    'prepare.imagesize' => array(
        'label' => 'Bildgr&ouml;&szlig;e',
        'help' => '<p>Geben Sie hier die Pixel-Breite an, die Ihr Bild auf dem Marktplatz haben soll.
            Die H&ouml;he wird automatisch dem urspr&uuml;nglichen Seitenverh&auml;ltnis nach angepasst.</p>
            <p>Die Quelldateien werden aus dem Bildordner {#setting:sSourceImagePath#} verarbeitet und mit der hier gew&auml;hlten Pixelbreite im Ordner {#setting:sImagePath#}  f&uuml;r die &Uuml;bermittlung zum Marktplatz abgelegt.</p>',
        'hint' => 'Gespeichert unter: {#setting:sImagePath#}'
    ),
    'prepare.whomade' => array(
        'label' => 'Wer hat es gemacht?',
    ),
    'prepare.whenmade' => array(
        'label' => 'Wann hast du es gemacht?',
    ),
    'prepare.issupply' => array(
        'label' => 'Was ist es?',
    ),
    'fixed.price' => array(
        'label' => 'Preis',
        'help' => 'Geben Sie einen prozentualen oder fest definierten Preis Auf- oder Abschlag an. Abschlag mit vorgesetztem Minus-Zeichen.'
    ),
    'fixed.price.addkind' => array(
        'label' => '',
    ),
    'fixed.price.factor' => array(
        'label' => '',
    ),
    'fixed.price.signal' => array(
        'label' => 'Nachkommastelle',
        'hint' => 'Nachkommastelle',
        'help' => '
                Dieses Textfeld wird beim &Uuml;bermitteln der Daten zu Etsy als Nachkommastelle an Ihrem Preis &uuml;bernommen.<br/><br/>
                <strong>Beispiel:</strong> <br />
                Wert im Textfeld: 99 <br />
                Preis-Ursprung: 5.58 <br />
                Finales Ergebnis: 5.99 <br /><br />
                Die Funktion hilft insbesondere bei prozentualen Preis-Auf-/Abschl&auml;gen.<br/>
                Lassen Sie das Feld leer, wenn Sie keine Nachkommastelle &uuml;bermitteln wollen.<br/>
                Das Eingabe-Format ist eine ganzstellige Zahl mit max. 2 Ziffern.
            '
    ),
    'prepare.language' => array(
        'label' => 'Sprache',
    ),
    'shippingprofile' => array(
        'label' => 'Standard Versandgruppe',
        'hint' => '<button id="shippingprofileajax" class="mlbtn action add-matching" value="Secondary_color" style="display: inline-block; width: 45px;">+</button>',
    ),
    'prepare_title' => array(
        'label' => 'Titel',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'Titel immer aktuell aus Web-Shop verwenden',
            )
        ),
    ),
    'prepare_description' => array(
        'label' => 'Beschreibung',
        'help' => 'Die maximale Anzahl der Zeichen beträgt 63000.',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'Artikelbeschreibung immer aktuell aus Web-Shop verwenden',
            )
        ),
    ),
    'prepare_image' => array(
        'label' => 'Produktbilder',
        'help' => 'Maximal können 10 Bilder eingestellt werden.<br/>Maximal zulässige Bildgröße ist 3000 x 3000 px.',
        'hint' => 'Maximal 10 Bilder',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'Bilder immer aktuell aus Web-Shop verwenden',
            )
        ),
    ),
    'category' => array(
        'label' => 'Kategorie',
    ),
    'prepare_price' => array(
        'label' => 'Preis',
        'help' => 'Minimaler Artikelpreis auf Etsy ist 0.17£.',
    ),
    'prepare_quantity' => array(
        'label' => 'Bestand',
        'help' => 'Der Bestand für ein Produkt darf nicht größe als 999 sein.',
    ),
    'orderstatus.shipping' => array(
        'label' => 'Shipping provider'
    )
));
