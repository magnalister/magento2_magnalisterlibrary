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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
/**
 * @see formfiled.php
 */
MLI18n::gi()->add('formfields_metro', array(
    'prepare_title' => array(
        'label' => 'Titel<span class="bull">•</span>',
        'hint' => 'Maximal 150 Zeichen',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'immer aktuell aus Web-Shop verwenden',
            ),
        )
    ),
    'prepare_description' => array(
        'label' => 'Beschreibung<span class="bull">•</span>',
        'hint' => 'Detaillierte und informative Beschreibung des Produkts mit seinen Spezifikationen und Eigenschaften. Angebotsdetails, Versand- oder Shopinformationen wie Preise, Lieferbedingungen, etc. sind nicht erlaubt. Bitte beachten Sie, dass es nur eine Produktdetailseite pro Produkt gibt, die von allen Verkäufern, die dieses Produkt anbieten, geteilt wird. Fügen Sie keine Hyperlinks, Bilder oder Videos hinzu.<br><br>Folgende HTML-Tags sind erlaubt: P, B, BR, A, UL, OL, LI, SPAN<br><br>Maximal 4000 Zeichen',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'immer aktuell aus Web-Shop verwenden',
            ),
        )
    ),
    'prepare_shortdescription' => array(
        'label' => 'Kurzbeschreibung',
        'hint' => 'Kurze Beschreibung des Produkts mit einer Zusammenfassung der wichtigsten Produkteigenschaften.<br><br>Maximal 150 Zeichen',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'immer aktuell aus Web-Shop verwenden',
            ),
        )
    ),
    'prepare_image' => array(
        'label' => 'Produktbilder<span class="bull">•</span>',
        'hint' => 'Maximal 10 Produktbilder',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'immer aktuell aus Web-Shop verwenden',
            ),
        )
    ),
    'prepare_gtin' => array(
        'label'    => 'GTIN (Global Trade Item Number)',
        'hint'     => 'Zum Beispiel: EAN, ISBN, ...<br><br>Maximal 14 Zeichen<br>Sie müssen hier eine GTIN hinterlegen, wenn Sie bei “Hersteller” und “Herstellerartikelnummer” keinen Wert eintragen.',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'immer aktuell aus Web-Shop verwenden',
            ),
        )
    ),
    'prepare_manufacturer' => array(
        'label'    => 'Hersteller',
        'hint'     => 'Maximal 100 Zeichen <br>Wenn Sie unter “GTIN” nichts eintragen, müssen Sie hier einen Hersteller hinterlegen.',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'immer aktuell aus Web-Shop verwenden',
            ),
        )
    ),
    'prepare_manufacturerpartnumber' => array(
        'label'    => 'Herstellerartikelnummer',
        'hint'     => 'Maximal 100 Zeichen <br>Wenn Sie unter “GTIN” nichts eintragen, müssen Sie hier eine Herstellerartikelnummer (MPN) hinterlegen.',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'immer aktuell aus Web-Shop verwenden',
            ),
        )
    ),
    'prepare_brand' => array(
        'label' => 'Marke',
        'hint' => 'Maximal 100 Zeichen',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'immer aktuell aus Web-Shop verwenden',
            ),
        )
    ),
    'prepare_feature' => array(
        'label' => 'Wichtige Merkmale',
        'hint' => 'Maximal 200 Zeichen je Merkmal',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'immer aktuell aus Web-Shop verwenden',
            ),
        )
    ),
    'prepare_msrp' => array(
        'label' => 'Unverbindliche Preisempfehlung des Herstellers',
        'hint' => '',
    ),
    'prepare_saveaction' => array(
        'name' => 'saveaction',
        'type' => 'submit',
        'value' => 'save',
        'position' => 'right',
    ),
    'prepare_resetaction' => array(
        'name' => 'resetaction',
        'type' => 'submit',
        'value' => 'reset',
        'position' => 'left',
    ),
    'processingtime' => array(
        'label' => 'Min. Lieferzeit in Werktagen',
        'help' => 'Tragen Sie hier ein, wie viele Werktage mindestens vom Zeitpunkt der Bestellung durch den Kunden es bis zum Erhalt des Pakets dauert',
    ),
    'maxprocessingtime' => array(
        'label' => 'Max. Lieferzeit in Werktagen',
        'help' => 'Tragen Sie hier ein, wie viele Werktage maximal vom Zeitpunkt der Bestellung durch den Kunden es bis zum Erhalt des Pakets dauert',
    ),
    'freightforwarding'              => array(
        'label' => 'Lieferung per Spedition',
        'hint' => 'Geben Sie an, ob Ihr Produkt per Spedition versendet wird.',
    ),
    'businessmodel'                  => array(
        'label' => 'Käufergruppe festlegen',
        'hint' => '',
    ),
    'shippingprofile'                => array(
        'label' => 'Versandkosten-Profile',
        'hint'  => '',
    ),
    'shippinggroup'                => array(
        'label' => 'Verkäuferversandgruppe',
        'hint'  => '',
    ),
    'orderstatus.carrier'            => array(
        'label' => 'Spediteur',
        'help'  => 'Vorausgew&auml;hlter Spediteur beim Best&auml;tigen des Versandes nach METRO.',
    ),
    'orderstatus.cancellationreason' => array(
        'label' => 'Bestellung stornieren - Grund',
        'hint'  => 'Um eine Bestellung auf METRO zu stornieren muss ein Grund angebeben werden',
    ),
    'volumeprices_enable' => array(
        'label' => 'Staffelpreise',
        'help' => '
            <p>Staffelpreise dienen dazu, K&auml;ufer Rabatte bei der Abnahme h&ouml;herer St&uuml;ckzahlen zu bieten. Um Staffelpreise zu konfigurieren, haben Sie in magnalister folgende Optionen:</p>
            <p><br></p>
            <ol>
                <li>
                    <p>Aus nachfolgender Konfiguration verwenden<br><br>W&auml;hlen Sie diese Option, wenn Sie <strong>im magnalister Plugin</strong> f&uuml;r alle Produkte, die Sie auf den METRO Marktplatz hochladen, Staffelpreis-Rabatte einrichten m&ouml;chten.<br><br>Bei Auswahl der Option erscheint eine Liste, in der Sie im ersten Schritt w&auml;hlen k&ouml;nnen, welche Art von Staffelpreis-Rabatt Sie gew&auml;hren m&ouml;chten:</p>
                    <ol style="list-style-type: lower-alpha;">
                        <li>
                            <p>Prozentualer Preis-Auf-/Abschlag<br><br>Tragen Sie hier f&uuml;r die jeweilige St&uuml;ckzahl einen prozentualen Rabatt ein (z. B. ab 2 St&uuml;ck -&gt; &ldquo;5&rdquo; f&uuml;r 5 Prozent Rabatt). Der von magnalister zu METRO &uuml;bertragene Preis bei Abnahme von 2 St&uuml;ck wird dann um 5 % gemindert.<br><br>METRO gibt die Staffelungsm&ouml;glichkeiten der Preise vor. Eine Staffelung ist zwischen 2 und 5 St&uuml;ck m&ouml;glich, dar&uuml;ber hinaus k&ouml;nnen Sie unter &ldquo;Ab A St&uuml;ck&rdquo; und &ldquo;Ab B St&uuml;ck&rdquo; eigene Staffelungen eintragen (z. B. 15 % Rabatt ab einer Abnahme von 10 St&uuml;ck).<br><br>Au&szlig;erdem k&ouml;nnen Sie &uuml;ber &ldquo;Nachkommastelle&rdquo; die Preisanzeige im Cent-Bereich manipulieren. Weitere Infos dazu finden Sie im Info-Icon neben &ldquo;Nachkommastelle&rdquo;.</p>
                        </li>
                        <li>
                            <p>Fixer Preis-Auf-/Abschlag<br><br>Diese Option funktioniert analog zu a. Statt eines prozentualen Abschlags k&ouml;nnen Sie hier einen fixen Euro-Betrag eintragen (z. B. Ab 2 St&uuml;ck -&gt; &ldquo;5&rdquo; f&uuml;r 5 Euro Rabatt).</p>
                        </li>
                        <li>
                            <p>Kundengruppe<br><br>In Ihrem Shopsystem haben Sie die M&ouml;glichkeit, Artikel bestimmten Kundengruppen zuzuteilen. Innerhalb der Kundengruppen k&ouml;nnen Sie dann Anpassungen am Preis vornehmen. Hinterlegen Sie in magnalister bei einer bestimmten Staffelung (z. B. &ldquo;Ab 5 St&uuml;ck&rdquo;) eine Kundengruppe, so werden die Preiseinstellungen der Kundengruppe auf diese Staffel angewendet.</p>
                        </li>
                    </ol>
                </li>
                <li>
                    <p>Aus Web-Shop &uuml;bernehmen<br><br>Einige Shopsysteme bieten selbst Staffelpreis-Optionen an. Wenn Sie in magnalister &ldquo;Aus Web-Shop &uuml;bernehmen&rdquo; w&auml;hlen, k&ouml;nnen Sie die Staffelpreis-Einstellungen <strong>aus einer Shop-Kundengruppe</strong> &uuml;bernehmen.</p>
                </li>
                <li>
                    <p>Nicht verwenden<br><br>Wenn Sie keine Staffelpreise auf METRO anbieten m&ouml;chten, w&auml;hlen Sie diese Option.<br><br><br></p>
                </li>
            </ol>
            <p><strong>Wichtig:</strong></p>
            <p>Der Staffelpreis muss niedriger sein als der Standardpreis des Produkts, andernfalls werden die Angebote von METRO abgelehnt.</p>
        ',
        'hint' => '<span style="color: red">Achtung wichtiger Hinweis: Versandkostenaufschläge wirken sich nicht auf die Staffelpreise aus</span>'
    ),
    'volumeprices_enable_useconfig' => 'Aus nachfolgender Konfiguration verwenden',
    'volumeprices_enable_webshop' => 'Aus Web-Shop übernehmen',
    'volumeprices_enable_dontuse' => 'Nicht verwenden',
    'volumepriceswebshoppriceoptions' => array(
        'label' => 'Preis-Optionen',
        'help' => 'Geben Sie einen prozentualen oder fest definierten Preis Auf- oder Abschlag an. Abschlag mit vorgesetztem Minus-Zeichen.',
        'hint' => '<span style="color: red">Die Funktion "Nachkommastelle" hat nur Auswirkungen auf den Bruttopreis.</span>'
    ),
    'volumeprices_price2' => array(
        'label' => 'Ab 2 Stück',
        'hint' => '',
        'help' => '
            Wird die Option "Auf / Abschlag" gewählt, egal ob prozentual oder als Festwert, wird die unter "Preisberechnung" gewählte "Preis"-Einstellung ignoriert, die "Preisoptionen" (wie z.B. Kundengruppe, Sonderpreise) bleiben jedoch aktiv.<br>
            <br>
            Bei Auswahl der Option "Kundengruppe" werden die unter "Preisberechnung" gewählten Einstellungen "Preis" und "Preisoption (inkl. Sonderpreisoption)" ignoriert - und nur der Kundengruppenpreis wird übertragen.
        ',
    ),
    'volumeprices_price3' => array(
        'label' => 'Ab 3 Stück',
        'hint' => '',
        'help' => '
            Wird die Option "Auf / Abschlag" gewählt, egal ob prozentual oder als Festwert, wird die unter "Preisberechnung" gewählte "Preis"-Einstellung ignoriert, die "Preisoptionen" (wie z.B. Kundengruppe, Sonderpreise) bleiben jedoch aktiv.<br>
            <br>
            Bei Auswahl der Option "Kundengruppe" werden die unter "Preisberechnung" gewählten Einstellungen "Preis" und "Preisoption (inkl. Sonderpreisoption)" ignoriert - und nur der Kundengruppenpreis wird übertragen.
        ',
    ),
    'volumeprices_price4' => array(
        'label' => 'Ab 4 Stück',
        'hint' => '',
        'help' => '
            Wird die Option "Auf / Abschlag" gewählt, egal ob prozentual oder als Festwert, wird die unter "Preisberechnung" gewählte "Preis"-Einstellung ignoriert, die "Preisoptionen" (wie z.B. Kundengruppe, Sonderpreise) bleiben jedoch aktiv.<br>
            <br>
            Bei Auswahl der Option "Kundengruppe" werden die unter "Preisberechnung" gewählten Einstellungen "Preis" und "Preisoption (inkl. Sonderpreisoption)" ignoriert - und nur der Kundengruppenpreis wird übertragen.
        ',
    ),
    'volumeprices_price5' => array(
        'label' => 'Ab 5 Stück',
        'hint' => '',
        'help' => '
            Wird die Option "Auf / Abschlag" gewählt, egal ob prozentual oder als Festwert, wird die unter "Preisberechnung" gewählte "Preis"-Einstellung ignoriert, die "Preisoptionen" (wie z.B. Kundengruppe, Sonderpreise) bleiben jedoch aktiv.<br>
            <br>
            Bei Auswahl der Option "Kundengruppe" werden die unter "Preisberechnung" gewählten Einstellungen "Preis" und "Preisoption (inkl. Sonderpreisoption)" ignoriert - und nur der Kundengruppenpreis wird übertragen.
        ',
    ),
    'volumeprices_priceA' => array(
        'label' => 'Ab A Stück',
        'hint' => '',
        'help' => '
            Wird die Option "Auf / Abschlag" gewählt, egal ob prozentual oder als Festwert, wird die unter "Preisberechnung" gewählte "Preis"-Einstellung ignoriert, die "Preisoptionen" (wie z.B. Kundengruppe, Sonderpreise) bleiben jedoch aktiv.<br>
            <br>
            Bei Auswahl der Option "Kundengruppe" werden die unter "Preisberechnung" gewählten Einstellungen "Preis" und "Preisoption (inkl. Sonderpreisoption)" ignoriert - und nur der Kundengruppenpreis wird übertragen.
        ',
    ),
    'volumeprices_priceB' => array(
        'label' => 'Ab B Stück',
        'hint' => '',
        'help' => '
            Wird die Option "Auf / Abschlag" gewählt, egal ob prozentual oder als Festwert, wird die unter "Preisberechnung" gewählte "Preis"-Einstellung ignoriert, die "Preisoptionen" (wie z.B. Kundengruppe, Sonderpreise) bleiben jedoch aktiv.<br>
            <br>
            Bei Auswahl der Option "Kundengruppe" werden die unter "Preisberechnung" gewählten Einstellungen "Preis" und "Preisoption (inkl. Sonderpreisoption)" ignoriert - und nur der Kundengruppenpreis wird übertragen.
        ',
    ),
));

MLI18n::gi()->add('metro_prepare_form', array(
    'field' => array(
        'variationgroups'       => array(
            'label' => 'Marktplatz-Kategorie<span class="bull">•</span>',
            'hint'  => '',
        ),
        'variationgroups.value' => array(
            'label' => 'Marktplatz-Kategorie:',
        ),
    ),
), false);
