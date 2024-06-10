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

MLI18n::gi()->metro_config_general_autosync = 'Automatische Synchronisierung per CronJob (empfohlen)';
MLI18n::gi()->metro_config_general_nosync = 'keine Synchronisierung';
MLI18n::gi()->metro_config_account_title = 'Zugangsdaten';
MLI18n::gi()->metro_config_account_prepare = 'Artikelvorbereitung';
MLI18n::gi()->metro_config_account_price = 'Preisberechnung';
MLI18n::gi()->metro_config_account_sync = 'Preis und Lager';
MLI18n::gi()->metro_config_account_orderimport = 'Bestellungen';
MLI18n::gi()->metro_config_invoice = 'Rechnungen';
MLI18n::gi()->metro_config_account_emailtemplate = 'Promotion-E-Mail Template';
MLI18n::gi()->metro_config_account_producttemplate = 'Produkt Template';

MLI18n::gi()->{'formfields_metro_freightforwarding_values'} = array(
    'true' => 'Ja',
    'false' => 'Nein',
);
MLI18n::gi()->{'formfields_metro__orderstatus.accepted'} = array(
    'label' => 'Bestellung akzeptiert  mit',
    'help' => '',
);

MLI18n::gi()->{'formgroups_legend_quantity'} = 'Lager';

MLI18n::gi()->metro_configform_orderstatus_sync_values = array(
    'auto' => '{#i18n:metro_config_general_autosync#}',
    'no' => '{#i18n:metro_config_general_nosync#}',
);
MLI18n::gi()->metro_configform_sync_values = array(
    'auto' => '{#i18n:metro_config_general_autosync#}',
    //'auto_fast' => 'Schnellere automatische Synchronisation cronjob (auf 15 Minuten)',
    'no' => '{#i18n:metro_config_general_nosync#}',
);
MLI18n::gi()->metro_configform_stocksync_values = array(
    'rel' => 'Bestellung reduziert Shop-Lagerbestand (empfohlen)',
    'no' => '{#i18n:metro_config_general_nosync#}',
);
MLI18n::gi()->metro_configform_pricesync_values = array(
    'auto' => '{#i18n:metro_config_general_autosync#}',
    'no' => '{#i18n:metro_config_general_nosync#}',
);

MLI18n::gi()->metro_configform_orderimport_payment_values = array(
    'textfield' => array(
        'title' => 'Aus Textfeld',
        'textoption' => true
    ),
    'matching' => array(
        'title' => 'Automatische Zuordnung',
    ),
);

MLI18n::gi()->metro_configform_orderimport_shipping_values = array(
    'textfield' => array(
        'title' => 'Aus Textfeld',
        'textoption' => true
    ),
    'matching' => array(
        'title' => 'Automatische Zuordnung',
    ),
);

MLI18n::gi()->add('metro_config_account', array(
    'legend' => array(
        'account' => 'Zugangsdaten',
        'tabident' => 'Tab'
    ),
    'field' => array(
        'tabident' => array(
            'label' => '{#i18n:ML_LABEL_TAB_IDENT#}',
            'help' => '{#i18n:ML_TEXT_TAB_IDENT#}'
        ),
        'clientkey' => array(
            'label' => 'METRO-Client-Key',
            'help' => 'Geben Sie hier den “METRO-Client-Key” ein.<br>Aktuell können Sie diesen ausschließlich beim METRO Marktplatz Seller-Support anfordern. Schreiben Sie dazu eine E-Mail an: seller@metro-marketplace.eu',
        ),
        'secretkey' => array(
            'label' => 'METRO-Secret-Key',
            'help' => 'Geben Sie hier den “METRO-Secret-Key” ein.<br>Aktuell können Sie diesen ausschließlich beim METRO Marktplatz Seller-Support anfordern. Schreiben Sie dazu eine E-Mail an: seller@metro-marketplace.eu',
        ),
        'shippingdestination' => array(
            'label' => 'METRO Site',
            'help' => 'METRO Vorgabe: Aktuell ist keine Cross Border Trade möglich.',
            'hint' => 'Auf welchem METRO Marktplatz Land sollen Ihre Produkte verkauft werden',
        ),
        'shippingorigin' => array(
            'label' => 'Versand aus',
            'help' => 'METRO Vorgabe: Aktuell ist keine Cross Border Trade möglich.',
            'hint' => 'Aus welchem Land werden Ihre Produkte verschickt',
        ),
    ),
), false);


MLI18n::gi()->add('metro_config_prepare', array(
    'legend' => array(
        'prepare' => 'Artikelvorbereitung',
        'pictures' => 'Einstellungen f&uuml;r Bilder',
        'shipping' => 'Versand',
        'upload' => 'Artikel hochladen: Voreinstellungen',
    ),
    'field' => array(
        'processingtime' => array(
            'label' => 'Min. Lieferzeit in Werktagen',
            'help' => 'Tragen Sie hier ein, wie viele Werktage mindestens vom Zeitpunkt der Bestellung durch den Kunden es bis zum Erhalt des Pakets dauert',
        ),
        'maxprocessingtime' => array(
            'label' => 'Max. Lieferzeit in Werktagen',
            'help' => 'Tragen Sie hier ein, wie viele Werktage maximal vom Zeitpunkt der Bestellung durch den Kunden es bis zum Erhalt des Pakets dauert',
        ),
        'businessmodel' => array(
            'label' => 'Käufergruppe festlegen',
            'help' => 'Ordnen Sie das Produkt einer Käufergruppe zu:<br>
                <ul>
                    <li>B2C und B2B: Produkt richtet sich an beide Käufergruppen</li>
                    <li>B2B: Produkt richtet sich an gewerbliche Endkunden</li>
                </ul>
                ',
        ),
        'freightforwarding' => array(
            'label' => 'Lieferung per Spedition',
            'help' => 'Geben Sie an, ob Ihr Produkt per Spedition versendet wird.',
        ),
        'shippingprofile' => array(
            'label' => 'Versandkosten-Profile',
            'help' => 'Legen Sie hier ihre Versandkosten-Profile an. Sie können für jedes Profil unterschiedliche Versandkosten angeben (Beispiel: 4.95) und ein Standard-Profil bestimmen. Die angegebenen Versandkosten werden beim Produkt-Upload zum Artikelpreis hinzugerechnet, da Waren auf dem METRO Marktplatz ausschließlich versandkostenfrei eingestellt werden können.',
            'hint' => '<span style="color: red">Der hier definierte Versandkostenaufschlag addiert sich zu der "Preisberechung" (Reiter: "Preis und Lager")</span><br><br>Bitte verwenden Sie den Punkt (.) als Trennzeichen für Dezimalstellen.',
        ),
        'shippingprofile.name' => array(
            'label' => 'Name des Versandkosten-Profils',
        ),
        'shippingprofile.cost' => array(
            'label' => 'Versandkostenaufschlag (Brutto)',
        ),
        'shipping.group' => array(
            'label' => 'Verk&auml;uferversandgruppen',
            'hint' => 'Eine bestimmte Gruppe von Versandeinstellungen, die verk&auml;uferspezifisch f&uuml;r ein Angebot festgelegt wird. Die Verk&auml;uferversandgruppe wird in der Benutzeroberfl&auml;che f&uuml;r Versandeinstellungen vom Verk&auml;ufer erstellt und verwaltet.',           
            'help' => 'Verk&auml;ufer k&ouml;nnen eine Gruppe mit verschiedenen Versandeinstellungen erstellen, je nach gesch&auml;ftlichen Erfordernissen und Anwendungsf&auml;llen. F&uuml;r verschiedene Regionen k&ouml;nnen unterschiedliche Gruppen von Versandeinstellungen gew&auml;hlt werden, mit unterschiedlichen Versandbedingungen und &ndash;geb&uuml;hren f&uuml;r die jeweilige Region.<br /><br /> Wenn der Verk&auml;ufer ein Produkt als Angebot erstellt, kann er eine seiner angelegten Gruppen von Versandeinstellungen f&uuml;r das jeweilige Produkt festlegen. Die Versandeinstellungen dieser Gruppe werden dann genutzt, um die jeweils g&uuml;ltige Versandoption je Produkt auf der Website anzuzeigen.<br /><br /><strong>Wichtig:</strong> Kopieren Sie die Versandgruppen-Namen aus Ihrem METRO Account in die entsprechenden Felder hier. Nur diese werden verwendet. Die Bezeichnung dient hier nur dazu, sie in der Produktvorbereitung anzuzeigen.<br /><br />F&uuml;r Details zum Anlegen der Versandgruppen siehe <a href="https://developer.metro-selleroffice.com/docs/offer-data/shipping/" target="_blank">METRO Dokumentation</a>',
        ),  
        'shipping.group.name' => array(
            'label' => 'Verk&auml;uferversandgruppen Bezeichnung',
        ),
        'shipping.group.id' => array(
            'label' => 'Verk&auml;uferversandgruppen ID',
        ),
    )
), false);

MLI18n::gi()->add('formgroups_metro', array(
    'orderstatus' => 'Synchronisation des Bestell-Status vom Shop zu METRO',
));

MLI18n::gi()->{'formfields__price__hint'} = '<span style="color: red">Zu dem hier definierten Preis addiert sich der unter "Artikelvorbereitung" ausgewählte Versandkostenaufschlag</span>';
MLI18n::gi()->{'formfields__price__help'} = 'Geben Sie einen prozentualen oder fest definierten Preis Auf- oder Abschlag an. Abschlag mit vorgesetztem Minus-Zeichen.<br><br><span style="color: red">Zu dem hier definierten Preis addiert sich der unter "Artikelvorbereitung" ausgewählte Versandkostenaufschlag</span>';
MLI18n::gi()->{'formfields__importactive__hint'} = 'Bitte beachten Sie: Bestellungen vom METRO Marktplatz werden automatisch mit der Übergabe an den Webshop (Bestellimport) akzeptiert.';
