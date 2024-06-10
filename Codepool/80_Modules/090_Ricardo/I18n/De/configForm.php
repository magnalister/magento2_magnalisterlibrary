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

MLI18n::gi()->ricardo_config_account_title = 'Zugangsdaten';
MLI18n::gi()->ricardo_config_account_prepare = 'Artikelvorbereitung';
MLI18n::gi()->ricardo_config_account_price = 'Preisberechnung';
MLI18n::gi()->ricardo_config_account_sync = 'Synchronisation';
MLI18n::gi()->ricardo_config_account_orderimport = 'Bestellimport';
MLI18n::gi()->ricardo_config_checkin_badshippingcost = 'Die Versandkosten muss eine Zahl sein.';
MLI18n::gi()->ricardo_config_account_producttemplate = 'Produkt Template';
MLI18n::gi()->ricardo_config_account_emailtemplate = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->ricardo_config_account_emailtemplate_sender = 'Beispiel-Shop';
MLI18n::gi()->ricardo_config_account_emailtemplate_sender_email = 'beispiel@onlineshop.de';
MLI18n::gi()->ricardo_config_account_emailtemplate_subject = 'Ihre Bestellung bei #SHOPURL#';
MLI18n::gi()->ricardo_config_prepare_maxrelistcount_sellout = 'Bis ausverkauft';
MLI18n::gi()->ricardo_config_account_emailtemplate_content = '
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
MLI18n::gi()->ricardo_config_producttemplate_content =
'<p>#TITLE#<br>'.
'#VARIATIONDETAILS#</p>'.
'<p>#ARTNR#</p>'.
'<p>#SHORTDESCRIPTION#</p>'.
'<p>#PICTURE1#</p>'.
'<p>#PICTURE2#</p>'.
'<p>#PICTURE3#</p>'.
'<p>#DESCRIPTION#</p>';
MLI18n::gi()->ricardo_config_account_defaulttemplate = 'Keine Template';
MLI18n::gi()->ricardo_configform_sync_values = array(
    'auto' => 'Automatische Synchronisierung per CronJob (nur Reduzierung)',
                /*
                'auto_fast' => 'Schnellere automatische Synchronisation cronjob (auf 15 Minuten)',
                */
    'auto_reduce' => 'Automatische Synchronisierung per CronJob (Reduzierung und Erh&ouml;hung)',
    'no' => '{#i18n:configform_sync_value_no#}',
);
MLI18n::gi()->ricardo_label_sync_quantity = 'Aktivierung Ricardo Lager-Reduzierung und -Erh&ouml;hung';
MLI18n::gi()->ricardo_text_quantity = 'Ricardo l&auml;sst grunds&auml;tzlich keine Lagererh&ouml;hung f&uuml;r laufende Angebote zu.<br>
Um dennoch eine automatische Anpassung m&ouml;glich zu machen, beendet magnalister im Hintergrund ein laufendes Angebot und stellt es mit dem erh&ouml;hten Lagerbestand neu ein, sobald diese Funktion aktiviert wird.<br>
<br>
Bitte best&auml;tigen Sie durch "akzeptieren", die Information zur Kenntnis genommen zu haben, oder brechen ab, ohne die Funktion zu aktivieren.';
MLI18n::gi()->ricardo_label_sync_price = 'Aktivierung Ricardo Artikelpreis-Reduzierung und -Erh&ouml;hung';
MLI18n::gi()->ricardo_text_price = 'Ricardo l&auml;sst grunds&auml;tzlich keine Preiserh&ouml;hung f&uuml;r laufende Angebote zu.<br>
Um dennoch eine automatische Anpassung m&ouml;glich zu machen, beendet magnalister im Hintergrund ein laufendes Angebot und stellt es mit dem erh&ouml;hten Preis neu ein, sobald diese Funktion aktiviert wird.<br>
<br>
Bitte best&auml;tigen Sie durch "akzeptieren", die Information zur Kenntnis genommen zu haben, oder brechen ab, ohne die Funktion zu aktivieren.';
MLI18n::gi()->ricardo_config_error_price_signal = 'Preise auf Ricardo sind in Schweizer Franken anzugeben. Bitte passen Sie den Preis (letzte Dezimalzahl) außerdem so an, dass er entweder auf 0 (bspw. 12,40) oder 5 (bspw. 12,45) endet. Der kleinstmögliche Betrag liegt bei 5 Rappen (0.05 CHF). Das Info-Icon für “Nachkommastelle” für weitere Details klicken';

MLI18n::gi()->add('ricardo_config_account', array(
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
            'label' => 'Mitgliedsname',
        ),
        'mppassword' => array(
            'label' => 'Passwort',
        ),
        'token' => array(
            'label' => 'Ricardo-Token',
            'help' => 'Um einen neuen Ricardo-Token zu beantragen, klicken Sie bitte auf den Button.<br>
                        Sollte kein Fenster zu Ricardo aufgehen, wenn Sie auf den Button klicken, haben Sie einen Pop-Up Blocker aktiv.<br><br>
                        Der Token ist notwendig, um &uuml;ber elektronische	Schnittstellen wie den magnalister Artikel auf Ricardo einzustellen und zu verwalten.<br>
                        Folgen Sie von da an den Anweisungen auf der Ricardo Seite, um den Token zu beantragen und Ihren Online-Shop &uuml;ber magnalister mit Ricardo zu verbinden.',
        ),
        'apilang' => array(
			'label' => 'Interface Sprache',
			'hint' => 'F&uuml;r abgerufenene Werte und Fehlermeldungen',
            'values' => array(
				'de' => 'Deutsch',
				'fr' => 'Franz&ouml;sisch',
			),
        ),
    ),
), false);

MLI18n::gi()->add('ricardo_config_prepare', array(
    'legend' => array(
        'prepare' => 'Artikelvorbereitung',
        'upload' => 'Artikel hochladen: Voreinstellungen'
    ),
    'field' => array(
        'prepare.status' => array(
            'label' => 'Statusfilter',
            'valuehint' => 'nur aktive Artikel &uuml;bernehmen',
        ),
        'checkin.status' => array(
            'label' => 'Statusfilter',
            'valuehint' => 'nur aktive Artikel &uuml;bernehmen',
        ),
        'listinglangs' => array(
            'label' => 'Angebotssprache',
        ),
		'langs' => array(
			'label' => 'Artikelbeschreibung',
			'hint' => '',
			'matching' => array(
				'titlesrc' => 'Ricardo Sprache',
				'titledst' => 'Shop Sprache',
			)
		),
		'checkin.quantity' => array(
            'label' => 'St&uuml;ckzahl Lagerbestand',
            'help' => 'Geben Sie hier an, wie viel Lagermenge eines Artikels auf dem Marktplatz verf&uuml;gbar sein soll.<br>
                <br>
                Um &Uuml;berverk&auml;ufe zu vermeiden, k&ouml;nnen Sie den Wert<br>
                "<i>Shop-Lagerbestand &uuml;bernehmen abzgl. Wert aus rechtem Feld</i>" aktivieren.<br>
                <br>
                <strong>Beispiel:</strong> Wert auf "<i>2</i>" setzen. Ergibt &#8594; Shoplager: 10 &#8594; Ricardo-Lager: 8<br>
                <br>
                <strong>Hinweis:</strong>Wenn Sie Artikel, die im Shop inaktiv gesetzt werden, unabh&auml;ngig der verwendeten Lagermengen<br>
                auch auf dem Marktplatz als Lager "<i>0</i>" behandeln wollen, gehen Sie bitte wie folgt vor:<br>
                <ul>
                <li>"<i>Synchronisation des Inventars</i>" > "<i>Lagerver&auml;nderung Shop</i>" auf "<i>automatische Synchronisation per CronJob" einstellen</i></li>
                <li>"<i>Globale Konfiguration" > "<i>Produktstatus</i>" > "<i>Wenn Produktstatus inaktiv ist, wird der Lagerbestand wie 0 behandelt" aktivieren</i></li>
                </ul>',
        ),
		'descriptiontemplate' => array(
			'label' => 'Angebots-Vorlage',
		),
		'articlecondition' => array(
			'label' => 'Zustand des Produkts',
		),
		'buyingmode' => array(
			'label' => 'Kauf-Modus',
		),
		'priceforauction' => array(
			'label' => 'Auktion Startpreis (CHF)',
		),
		'priceincrement' => array(
			'label' => 'Auktion Erh&ouml;hungsschritt (CHF)',
		),
        'duration' => array(
            'label' => 'Dauer',
        ),
		'maxrelistcountfield' => array(
			'label' => 'Angebot reaktivieren',
		),
		'maxrelistcount' => array(
			'label' => 'Wie h&auml;ufig soll Ihr Angebot reaktiviert werden?',
		),
		'warranty' => array(
			'label' => 'Garantie',
		),
		'warrantycondition' => array(
			'label' => '',
		),
		'warrantydescription' => array(
			'label' => '',
		),
		'payment' => array(
			'label' => 'Zahlungsart',
            'hint' => ' Angebotene Zahlungsarten',
		),
		'paymentmethods' => array(
			'label' => ''
		),
		'paymentdescription' => array(
			'label' => ''
		),
		'delivery' => array(
			'label' => 'Versandart',
		),
		'deliverycondition' => array(
			'label' => '',
		),
		'deliverypackage' => array(
			'label' => '',
		),
		'deliverydescription' => array(
			'label' => '',
		),
		'deliverycost' => array(
			'label' => 'Versandkosten',
		),
        'cumulative' => array(
            'label' => '',
            'valuehint' => 'Separate Lieferkosten für jeden einzelnen Artikel ',
        ),
		'availabilityfield' => array(
			'label' => 'Lieferzeit',
		),
		'availability' => array(
			'label' => 'Verf&uuml;gbarkeit des Artikels nach Zahlungseingang',
		),
		'firstpromotion' => array(
			'label' => 'Promotion-Paket',
            'hint' => '<span style="color:#e31a1c;">Promotions sind nicht kostenlos. Bitte &uuml;berpr&uuml;fen Sie die Preise auf Ricardo.</span>',
		),
		'secondpromotion' => array(
			'label' => 'Startseite',
            'hint' => '<span style="color:#e31a1c;">Promotions sind nicht kostenlos. Bitte &uuml;berpr&uuml;fen Sie die Preise auf Ricardo.</span>',
		),
        'checkin.showlimitationwarning' => array(
            'label' => 'Ricardo Angebotslimits vor Hochladen anzeigen',
            'help' => 'Bitte beachten Sie, dass Sie nicht mehr als 100 Angebote gleichzeitig auf Ricardo veröffentlichen können. Darüber hinaus darf der Lagerbestand für jeden veröffentlichten Artikel nicht größer als 999 Stück sein.
<br><br>
            Wenn Sie diese Option aktivieren, erhalten Sie vor jedem Produkt-Upload einen Hinweis zu den Ricardo Angebots-Limits'
        )
    ),
), false);

MLI18n::gi()->add('ricardo_config_price', array(
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
				<strong>Wichtige Information:</strong><br><br>
				Preise auf Ricardo sind in Schweizer Franken anzugeben. Bitte passen Sie den Preis (letzte Dezimalzahl) so an, dass er entweder auf 0 (bspw. 12,40) oder 5 (bspw. 12,45) endet. Der kleinstmögliche Betrag liegt bei 5 Rappen (0.05 CHF). Bitte passen Sie den Preis entweder direkt in Ihrem Web-Shop an, oder nutzen Sie die Funktion “Nachkommastelle”:<br><br>
				Wenn unter „Preisberechnung“ > „Nachkommastelle“ kein Wert eingetragen wurde, oder wenn Ihr Produktpreis nicht auf “0” oder “5” endet, ändert magnalister beim Produkt-Upload oder bei der Preis-Synchronisation die letzte Nachkommastelle automatisch auf “5” ab.<br><br>
				<strong>Anpassung der Funktion “Nachkommastelle”:</strong><br><br>
				Wenn Sie die letzte Nachkommastelle immer und automatisiert auf „5“ oder „0“ runden lassen wollen, so tragen Sie den gewünschten Wert entsprechend hier ein.<br><br>
				Sie können auch die gesamte Nachkommastelle ändern lassen, indem Sie beide Nachkommastellen wie gewünscht hinterlegen (also „45“, ergibt z.B. 12.45 EUR)<br><br>
				Beispiel 1:<br> 
				Wert im Textfeld: 99<br> 
				Preis-Ursprung: 5.58<br>
				Finales Ergebnis: 5.99<br><br>				
				Beispiel 2:<br>
				Wert im Textfeld: 9<br> 
				Preis-Ursprung: 11.23<br> 
				Finales Ergebnis: 11.29<br><br> 				
				Die Funktion hilft insbesondere in Kombination mit der Funktion für prozentualen Preis-Auf-/Abschlägen.<br><br>				
				Lassen Sie das Feld leer, wenn Sie keine angepasste Nachkommastelle übermitteln wollen. Das Eingabe-Format ist eine ganzstellige Zahl mit max. 2 Ziffern.
            ',
        ),
        'priceoptions' => array(
            'label' => 'Preisoptionen',
            'help' => '{#i18n:configform_price_field_priceoptions_help#}',
        ),
        'price.group' => array(
            'label' => '',
        ),
        'price.usespecialoffer' => array(
            'label' => 'auch Sonderpreise verwenden',
        ),
        'mwst' => array(
            'label' => 'Mehrwertsteuer',
            'help' => 'H&ouml;he der Mehrwertsteuer, die beim Artikelupload zu Ricardo ber&uuml;cksichtigt wird. Wenn kein Wert eingetragen wurde, wird der Standard-Mehrwertsteuersatz des Web-Shops &uuml;bernommen.',
            'hint' => '&nbsp;Steuersatz, der beim Artikelupload verwendet wird (in %).',
        ),
        'exchangerate_update' => array(
            'label' => 'Wechselkurs',
            'valuehint' => 'Wechselkurs automatisch aktualisieren',
            'help' => '{#i18n:form_config_orderimport_exchangerate_update_help#}',
            'alert' => '{#i18n:form_config_orderimport_exchangerate_update_alert#}',
        ),
    ),
), false);

MLI18n::gi()->add('ricardo_config_sync', array(
    'legend' => array(
        'sync' => 'Synchronisation des Inventars',
    ),
    'field' => array(
        'stocksync.tomarketplace' => array(
            'label' => 'Lagerver&auml;nderung Shop',
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
                <strong>Hinweis:</strong>
                <ul
                    <li>Ricardo lässt grundsätzlich keine Lagererhöhung für laufende Angebote zu.
                        Um dennoch eine automatische Anpassung möglich zu machen, beendet magnalister im Hintergrund ein laufendes Angebot und stellt es mit dem erhöhten Lagerbestand neu ein, sobald diese Funktion aktiviert wird.<br><br>
                        <b>Auf Ricardo gilt ein Verfügbarkeitslimit. Bitte achten Sie darauf, dass der Lagerbestand pro Artikel, der auf dem {#setting:currentMarketplaceName#} Marktplatz angeboten werden soll, nicht über 999 Stück liegt.</b><br><br>
                        Wählen Sie "nur Reduzierung", wenn Sie automatische Neueinstellungen vermeiden wollen.</li>
                    <li>Die Einstellungen unter "Konfiguration" → "Einstellvorgang" → "Stückzahl Lagerbestand" werden berücksichtigt.</li>
                </ul>
            ',
        ),
        'stocksync.frommarketplace' => array(
            'label' => 'Lagerver&auml;nderung Ricardo',
            'help' => '
                Wenn z. B. bei Ricardo ein Artikel 3 mal gekauft wurde, wird der Lagerbestand im Shop um 3 reduziert.<br><br>
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
                <strong>Hinweis:</strong>
                <ul>
                    <li>Ricardo lässt grundsätzlich keine Preiserhöhung für laufende Angebote zu.
                        Um dennoch eine automatische Anpassung möglich zu machen, beendet magnalister im Hintergrund ein laufendes Angebot und stellt es mit dem erhöhten Preis neu ein, sobald diese Funktion aktiviert wird.
                        <br><br>
                        Wählen Sie "nur Reduzierung", wenn Sie automatische Neueinstellungen vermeiden wollen.<br><br>
                    </li>
                    <li>Die Einstellungen unter "Konfiguration" → "Preisberechnung" werden berücksichtigt.</li>
                </ul>
            ',
        ),
    ),
), false);

MLI18n::gi()->add('ricardo_config_orderimport', array(
    'legend' => array(
        'importactive' => 'Bestellimport',
        'mwst' => 'Mehrwertsteuer',
        'orderstatus' => 'Synchronisation des Bestell-Status vom Shop zu Ricardo',
    ),
    'field' => array(
        'orderimport.shippingmethod' => array(
            'label' => 'Versandart der Bestellungen',
            'help' => 'Versandart, die allen Ricardo-Bestellungen zugeordnet wird. Standard: "Ricardo".<br><br>'
                . 'Diese Einstellung ist wichtig f&uuml;r den Rechnungs- und Lieferscheindruck und f&uuml;r '
                . 'die nachtr&auml;gliche Bearbeitung der Bestellung im Shop sowie einige Warenwirtschaften.',
        ),
        'orderimport.shop' => array(
            'label' => '{#i18n:form_config_orderimport_shop_lable#}',
            'hint' => '',
            'help' => '{#i18n:form_config_orderimport_shop_help#}',
        ),
        'orderstatus.shipped' => array(
            'label' => 'Versand best&auml;tigen mit',
            'help' => 'Setzen Sie hier den Shop-Status, der auf Ricardo automatisch den Status "Versand best&auml;tigen" setzen soll.',
        ),
        'mwst.fallback' => array(
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
                Ricardo &uuml;bermittelt nicht den Steuersatz der Versandkosten, sondern nur die Brutto-Preise.
                Daher muss der Steuersatz zur korrekten Berechnung der Mehrwertsteuer f&uuml;r die Versandkosten hier 
                angegeben werden. Falls Sie mehrwertsteuerbefreit sind, tragen Sie in das Feld 0 ein.
            ',
        ),
        //*/
        'importactive' => array(
            'label' => 'Import aktivieren',
            'hint' => '',
            'help' => '
                Sollen Bestellungen aus den Marktplatz importiert werden? <br/><br/>Wenn die Funktion aktiviert ist, 
                werden Bestellungen voreingestellt st&uuml;ndlich importiert.<br><br>
				Einen manuellen Import k&ouml;nnen Sie ansto&szlig;en, indem Sie den entsprechenden Funktionsbutton in 
                der Kopfzeile vom magnalister anklicken (oben rechts).<br><br>
				Zus&auml;tzlich k&ouml;nnen Sie den Bestellimport (ab Tarif Flat - maximal viertelst&uuml;ndlich) 
                auch durch einen eigenen CronJob ansto&szlig;en, indem Sie folgenden Link zu Ihrem Shop aufrufen: <br>
    			<i>{#setting:sImportOrdersUrl#}</i><br><br>
    			Eigene CronJob-Aufrufe durch Kunden, die nicht im Tarif Flat sind, oder die h&auml;ufiger als 
                viertelst&uuml;ndlich laufen, werden geblockt.
            ',
        ),
        'import' => array(
            'label' => '',
        ),
        'preimport.start' => array(
            'label' => 'erstmalig ab Zeitpunkt',
            'hint' => 'Startzeitpunkt',
            'help' => 'Startzeitpunkt, ab dem die Bestellungen erstmalig importiert werden sollen. Bitte beachten Sie, '
                . 'dass dies nicht beliebig weit in die Vergangenheit m&ouml;glich ist, da die Daten bei Ricardo '
                . 'h&ouml;chstens einige Wochen lang vorliegen.',
        ),
		'orderstatus.open' => array(
            'label' => 'Bestellstatus im Shop',
            'hint' => '',
            'help' => '
                Der Status, den eine von DaWanda neu eingegangene Bestellung im Shop automatisch bekommen soll.<br />
                Sollten Sie ein angeschlossenes Mahnwesen verwenden, ist es empfehlenswert, den Bestellstatus auf "Bezahlt" zu setzen (Konfiguration → Bestellstatus).
            ',
        ),
        'customergroup' => array(
            'label' => 'Kundengruppe',
            'help' => 'Kundengruppe, zu der Kunden bei neuen Bestellungen zugeordnet werden sollen.',
        ),
    ),
), false);

MLI18n::gi()->add('ricardo_config_producttemplate', array(
    'legend' => array(
        'product' => array(
            'title' => 'Produkt-Template',
            'info' => 'Template f&uuml;r die Produktbeschreibung auf Ricardo. (Sie k&ouml;nnen den Editor unter "Globale Konfiguration" > "Experteneinstellungen" umschalten.)',
        )
    ),
    'field' => array(
        'template.name' => array(
            'label' => 'Template Produktname',
            'help' => '
            <dl>
                <dt>Name des Produkts auf Ricardo</dt>
                 <dd>Einstellung, wie das Produkt auf Ricardo hei&szlig;en soll.
                     Der Platzhalter <b>#TITLE#</b> wird automatisch durch den Produktnamen aus dem Shop ersetzt,
                     <b>#BASEPRICE#</b> durch Preis pro Einheit, soweit f&uuml;r das betreffende Produkt im Shop hinterlegt.</dd>
                <dt>Bitte beachten Sie:</dt>
                 <dd><b>#BASEPRICE#</b> wird erst beim Hochladen zu Ricardo ersetzt, denn bei der Vorbereitung kann der Preis noch ge&auml;ndert werden.</dd>
                 <dd>Da der Grundpreis ein fester Wert in dem Titel ist und nicht aktualisiert werden kann, sollte der Preis nicht ge&auml;ndert werden, denn dies w&uuml;rde zu falschen Preisangaben f&uuml;hren.<br />
                    Sie k&ouml;nnen den Platzhalter auf eigenen Gefahr verwenden, wir empfehlen aber in dem Fall, <b>die Preissynchronisation auszuschalten</b> (Einstellung in der magnalister Ricardo Konfiguration).</dd>
                <dt>Wichtig:</dt>
                 <dd>Bitte beachten Sie, dass seitens Ricardo die Titel-L&auml;nge auf maximal 40 Zeichen beschr&auml;nkt ist. magnalister schneidet den Titel mit mehr als 40 Zeichen w&auml;hrend des Produkt-Uploads entsprechend ab.</dd>
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
                        <dt>#VARIATIONDETAILS#</dt>
                                <dd>Da Ricardo keine Varianten unterstützt, übermittelt magnalister Varianten als einzelne Artikel zu Ricardo. Nutzen Sie diesen Platzhalter, um die Varianten-Details in Ihrer Artikelbeschreibung anzuzeigen</dd>
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

MLI18n::gi()->add('ricardo_config_emailtemplate', array(
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
                    <dt>#USERNAME#</dt>
                    <dd>Käufer Benutzername</dd>
                    <dt>#MARKETPLACEORDERID#</dt>
                    <dd>Ricardo Bestellnummer</dd>
                </dl>',
        ),
        'mail.copy' => array(
            'label' => 'Kopie an Absender',
            'help' => 'Die Kopie wird an die Absender E-Mail Adresse gesendet.',
        ),
    ),
), false);
