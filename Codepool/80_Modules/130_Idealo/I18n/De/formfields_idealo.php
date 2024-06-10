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

// example for overwriting global element
MLI18n::gi()->add('formfields__quantity', array('help' => '{#setting:currentMarketplaceName#} kennt nur Lagermenge "Verfügbar" oder "Nicht verfügbar". Geben Sie hierüber an, ob Lagermenge entsprechend Ihres Shop-Lagerbestandes auf {#setting:currentMarketplaceName#} verfügbar sein soll.<br><br>Um Überverkäufe zu vermeiden, können Sie den Wert "Shop-Lagerbestand übernehmen und abzgl. "Wert aus rechtem Feld" aktivieren.<br><br><b>Beispiel:</b> Wert auf "2" setzen. Ergibt → Shoplager: 2 → {#setting:currentMarketplaceName#}-Lager: Artikel nicht verfügbar (0).<br><br> <b>Hinweis:</b> Wenn Sie Artikel, die im Shop inaktiv gesetzt werden, unabhängig der verwendeten Lagermengen auch auf {#setting:currentMarketplaceName#} als Lager "0" behandeln wollen, gehen Sie bitte wie folgt vor:<br><ul><li>"Synchronisation des Inventars" &gt; "Lagerveränderung Shop" auf "automatische Synchronisation per CronJob" einstellen</li><li>"Globale Konfiguration" &gt; "Produktstatus" &gt; "Wenn Produktstatus inaktiv ist, wird der Lagerbestand wie 0 behandelt" aktivieren</li></ul>'));
MLI18n::gi()->add('formfields__stocksync.tomarketplace', array(
    'help' => '
    <strong>Hinweis:</strong> Da {#setting:currentMarketplaceName#} nur "verfügbar" oder "nicht verfügbar" für Ihre Angebote kennt, wird hierbei berücksichtigt:<br>
    <br>
    <ul>
        <li>Lagermenge Shop &gt; 0 = verfügbar auf {#setting:currentMarketplaceName#}</li>
        <li>Lagermenge Shop &lt; 1 = nicht auf {#setting:currentMarketplaceName#} verfügbar</li>
    </ul>
    <br>
    <strong>Funktion:</strong><br>
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
    <strong>Hinweis:</strong> Die Einstellungen unter "Konfiguration" → "Einstellvorgang" ...<br>
    <br>
    → "Bestelllimit pro Kalendertag" und<br>
    → "Stückzahl Lagerbestand" für die ersten beiden Optionen.<br><br>… werden berücksichtigt.
'
));

MLI18n::gi()->add('formfields_idealo', array(
    'shippingcountry'                 => array(
        'label' => 'Versand nach',
    ),
    'shippingmethodandcost'           => array(
        'label' => 'Versandkosten',
        'help'  => 'Tragen Sie hier die pauschalen Versandkosten für Ihre Artikel in Euro ein. In der Produktvorbereitung können Sie die Werte für die ausgewählten Artikel individuell speichern.',
    ),
    'shippingcostmethod'              => array(
        'values' => array(
            '__ml_lump'   => MLI18n::gi()->ML_COMPARISON_SHOPPING_LABEL_LUMP,
            '__ml_weight' => 'Versandkosten = Artikel-Gewicht',
        ),
    ),
    'paymentmethod'                   => array(
        'label'  => 'Zahlungsart <span class="bull">•</span>',
        'help'   => '
            Geben Sie hier die gewünschten Standard-Zahlungsarten für das Preisvergleichs-Portal an (Mehrfachauswahl möglich).<br />
            Sie können die Zahlungsarten unter "Produkte vorbereiten" jederzeit individuell für die vorzubereitenden Produkte anpassen.<br />
        ',
        'values' => array(
            'PAYPAL'     => 'PayPal',
            'CREDITCARD' => 'Kreditkarte',
            'SOFORT'     => 'Sofort&uuml;berweisung',
            'PRE'       => 'Vorkasse',
            'COD'       => 'Nachnahme',
            'BANKENTER' => 'Bankeinzug',
            'BILL'      => 'Rechnung',
            'GIROPAY'   => 'Giropay',
            'CLICKBUY'  => 'Click&Buy',
            'SKRILL'    => 'Skrill',
        ),
    ),
    'access.inventorypath'            => array(
        'label' => 'Pfad zu Ihrer CSV-Tabelle',
    ),
    'shippingtime'                    => array(
        'label'    => 'Versandzeit',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => 'immer aus Konfiguration übernehmen',
            ),
        )
    ),
    'shippingtimetype'                => array(
        'values' => array(
            '__ml_lump'   => array('title' => 'Pauschal (aus rechtem Feld)',),
            'immediately' => array('title' => 'sofort lieferbar',),
            '4-6days'     => array('title' => 'ca. 4-6 Werktage',),
            '1-2days'     => array('title' => 'ab Zahlungseingang innerhalb 1-2 Werktagen beim Kunden',),
            '2-3days'     => array('title' => '2-3 Tage',),
            '4weeks'      => array('title' => 'Lieferzeit: 4 Wochen',),
            '24h'         => array('title' => 'versandfertig in 24 Stunden',),
            '1-3days'     => array('title' => 'sofort lieferbar, 1 - 3 Werktage',),
            '3days'       => array('title' => 'versandfertig in 3 Tagen',),
            '3-5days'     => array('title' => '3-5 Werktage',),
        ),
    ),
    'shippingtimeproductfield'        => array(
        'label' => 'Versandzeit (Matching)',
        'help'  => '
            Über das Versandzeit-Matching können Sie am Artikel hinterlegte Attribute als Versandzeit automatisiert zu {#setting:currentMarketplaceName#} hochladen.<br />
            In der DropDown-Auswahl sehen Sie alle Attribute, die aktuell für Artikeln definiert sind. Sie können jederzeit neue Attribute über die Shop-Verwaltung hinzufügen und verwenden.
        ',
    ),
    'campaignlink' => array(
        'label' => 'Kampagnenlink',
        'help' => 'Um ein Kampagnenlink anzulegen, der sich speziell nachverfolgen lässt, geben Sie bitte eine Zeichenkette ohne Sonderzeichen (z. B. Umlaute, Interpunktionszeichen und Leerzeichen) ein, wie zum Beispiel "allesmussraus".',
    ),
    'prepare_title' => array(
        'label' => 'Titel',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => '{#i18n:ML_PRODUCTPREPARATION_ALWAYS_USE_FROM_WEBSHOP#}',
            ),
        )
    ),
    'prepare_description' => array(
        'label' => 'Beschreibung',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => '{#i18n:ML_PRODUCTPREPARATION_ALWAYS_USE_FROM_WEBSHOP#}',
            ),
        )
    ),
    'prepare_image' => array(
        'label' => 'Produktbilder',
        'hint' => 'Maximal 3 Produktbilder ',
        'optional' => array(
            'checkbox' => array(
                'labelNegativ' => '{#i18n:ML_PRODUCTPREPARATION_ALWAYS_USE_FROM_WEBSHOP#}',
            ),
        )
    ),
    'currency' => array(
        'label' => 'Währung',
        'hint' => '',
    ),
));
