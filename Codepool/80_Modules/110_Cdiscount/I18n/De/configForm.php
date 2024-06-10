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

MLI18n::gi()->cdiscount_config_use_shop_value = 'Vom Shop übernehmen';
MLI18n::gi()->cdiscount_config_account_title = 'Zugangsdaten';
MLI18n::gi()->cdiscount_config_account_prepare = 'Artikelvorbereitung';
MLI18n::gi()->cdiscount_config_account_price = 'Preisberechnung';
MLI18n::gi()->cdiscount_config_account_sync = 'Synchronisation';
MLI18n::gi()->cdiscount_config_account_orderimport = 'Bestellimport';
MLI18n::gi()->cdiscount_config_account_producttemplate = 'Produkt Template';

MLI18n::gi()->cdiscount_config_checkin_badshippingtime = 'Die Lieferzeit muss eine Zahl zwischen 1 und 10 sein.';
MLI18n::gi()->cdiscount_config_checkin_badshippingcost = 'Das Feld für die Versandkosten muss nummerisch sein.';
MLI18n::gi()->cdiscount_config_checkin_shippingmatching = 'Das Versandzeiten Matching wird von diesem Shop-System nicht unterstützt.';
MLI18n::gi()->cdiscount_config_checkin_manufacturerfilter = 'Das manufacturer filter wird von diesem Shop-System nicht unterstützt.';
MLI18n::gi()->cdiscount_config_account_emailtemplate = '{#i18n:configform_emailtemplate_legend#}';
MLI18n::gi()->cdiscount_config_account_emailtemplate_sender = 'Beispiel-Shop';
MLI18n::gi()->cdiscount_config_account_emailtemplate_sender_email = 'beispiel@onlineshop.de';
MLI18n::gi()->cdiscount_config_account_emailtemplate_subject = 'Ihre Bestellung bei #SHOPURL#';
MLI18n::gi()->cdiscount_config_account_emailtemplate_content = '
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

MLI18n::gi()->cdiscount_configform_orderimport_payment_values = array(
    'textfield' => array(
        'title' => 'Aus Textfeld',
        'textoption' => true
    ),
    'Cdiscount' => array(
        'title' => 'Cdiscount',
    ),
);

MLI18n::gi()->cdiscount_configform_orderimport_shipping_values = array(
    'textfield' => array(
        'title' => 'Aus Textfeld',
        'textoption' => true
    ),
    'matching' => array(
        'title' => 'Vom Marktplatz übernehmen',
    ),
);

MLI18n::gi()->add('cdiscount_config_account', array(
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
            'label' => 'API-User',
            'help' =>   '',
        ),
        'mppassword' => array(
            'label' => 'API-Passwort',
            'help' => '',
        ),
    ),
), false);

MLI18n::gi()->add('cdiscount_config_prepare', array(
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
        'lang' => array(
            'label' => 'Artikelbeschreibung',
        ),
        'marketingdescription' => array(
            'label' => 'Marketing description',
            'help' => 'The marketing description must describe the product. It appears in the tab "Présentation produit". It must not content offers data (guarantee, price, shipping, packaging ...). HTML code is allowed. Description cannot exceed 5000 characters.',
        ),
        'standarddescription' => array(
            'label' => 'Description',
            'help' => 'The product description must describe the product. It appears at the top of the product sheet under the wording. It must not content offers data. (Guarantuee, price, shipping, packaging...), html code or others codes. Description cannot exceed 420 characters.',
        ),
        'itemcondition' => array(
            'label' => 'Zustand',
        ),


        //
        //---------- Shipping, pending translation
        //
        'preparationtime' => array(
            'label' => 'Vorbereitungszeit für den Versand (in Tagen 1-10)',
            'help' => 'Vorbereitungszeit für die Auslieferung des Produkts. Sie muss in Tagen zwischen 1 und 10 angegeben werden.',
        ),
        'shipping_time_standard' => array(
            'label' => 'Shipping Standard',
            'help' => 'Standard way of shipping.<br>
				            Additional shipping fee is when you allow to apply cheaper
				            shipping fees if the customer orders several products
				            in the same order.',
        ),
        'shipping_time_tracked' => array(
            'label' => 'Shipping Tracked',
            'help' => 'Tracked way of shipping.<br>
				            Additional shipping fee is when you allow to apply cheaper
				            shipping fees if the customer orders several products
				            in the same order.'
        ),
        'shipping_time_registered' => array(
            'label' => 'Shipping Registered',
            'help' => 'Registered way of shipping.<br>
				            Additional shipping fee is when you allow to apply cheaper
				            shipping fees if the customer orders several products
				            in the same order.'
        ),
        'shippingfee' => array(
            'label' => 'Versandgebühr (€)',
        ),
        'shippingfeeadditional' => array(
            'label' => 'Zusätzliche Versandgebühren (€)',
        ),
        'shippingprofilename' => array(
            'label' => 'Name des Versandprofils',
        ),
        'shippingprofilecost' => array(
            'label' => 'Versandzuschlag',
        ),
        'shippingprofile' => array(
            'label' => 'Versandprofil',
            'help' => ' Erstellen Sie hier Ihre Versandprofile. <br>
                        Sie können für jedes Profil unterschiedliche Versandkosten festlegen (Beispiel: 4,95) und ein Standardprofil definieren. 
                        Die angegebenen Versandkosten werden beim Produkt-Upload auf den Artikelpreis aufgeschlagen, da Waren auf dem CDiscount Marketplace nur versandkostenfrei hochgeladen werden können.'
        ),

        //
        // --------------- End of shipping translation
        //

        'itemcountry' => array(
            'label' => 'Artikel wird versandt aus',
            'help' => 'Bitte w&auml;hlen Sie aus welchem Land Sie versenden. Im Normalfall ist es das Land in dem Ihr Shop liegt.'
        ),
        'itemsperpage' => array(
            'label' => 'Ergebnisse',
            'help' => 'Hier k&ouml;nnen Sie festlegen, wie viele Produkte pro Seite beim Multimatching angezeigt werden sollen. <br\/>Je h&ouml;her die Anzahl, desto h&ouml;her auch die Ladezeit (bei 50 Ergebnissen ca. 30 Sekunden).',
            'hint' => 'pro Seite beim Multimatching',
        ),
        'checkin.quantity' => array(
            'label' => 'St&uuml;ckzahl Lagerbestand',
            'help' => 'Geben Sie hier an, wie viel Lagermenge eines Artikels auf dem Marktplatz verf&uuml;gbar sein soll.<br>
                <br>
                Um &Uuml;berverk&auml;ufe zu vermeiden, k&ouml;nnen Sie den Wert<br>
                "<i>Shop-Lagerbestand &uuml;bernehmen abzgl. Wert aus rechtem Feld</i>" aktivieren.<br>
                <br>
                <strong>Beispiel:</strong> Wert auf "<i>2</i>" setzen. Ergibt &#8594; Shoplager: 10 &#8594; Cdiscount-Lager: 8<br>
                <br>
                <strong>Hinweis:</strong>Wenn Sie Artikel, die im Shop inaktiv gesetzt werden, unabh&auml;ngig der verwendeten Lagermengen<br>
                auch auf dem Marktplatz als Lager "<i>0</i>" behandeln wollen, gehen Sie bitte wie folgt vor:<br>
                <ul>
                <li>"<i>Synchronisation des Inventars</i>" > "<i>Lagerver&auml;nderung Shop</i>" auf "<i>automatische Synchronisation per CronJob" einstellen</i></li>
                <li>"<i>Globale Konfiguration" > "<i>Produktstatus</i>" > "<i>Wenn Produktstatus inaktiv ist, wird der Lagerbestand wie 0 behandelt" aktivieren</i></li>
                </ul>',
        ),
    ),
), false);

MLI18n::gi()->add('cdiscount_config_price', array(
    'legend' => array(
        'price' => 'Preisberechnung',
    ),
    'field' => array(
        'usevariations' => array(
            'label' => 'Varianten',
            'help' => 'Funktion aktiviert: Produkte, die in mehreren Varianten (wie Gr&ouml;&szlig;e oder Farbe) im Shop vorhanden sind, werden auch so an Cdiscount &uuml;bermittelt.<br /><br /> Die Einstellung "St&uuml;ckzahl" wird dann auf jede einzelne Variante angewendet.<br /><br /><b>Beispiel:</b> Sie haben einen Artikel 8 mal in blau, 5 mal in gr&uuml;n und 2 mal in schwarz, unter St&uuml;ckzahl "Shop-Lagerbestand &uuml;bernehmen abzgl. Wert aus rechtem Feld", und den Wert 2 in dem Feld. Der Artikel wird dann 6 mal in blau und 3 mal in gr&uuml;n &uuml;bermittelt.<br /><br /><b>Hinweis:</b> Es kommt vor, da&szlig; etwas das Sie als Variante verwenden (z.B. Gr&ouml;&szlig;e oder Farbe) ebenfalls in der Attribut-Auswahl f&uuml;r die Kategorie erscheint. In dem Fall wird Ihre Variante verwendet, und nicht der Attributwert.',
            'valuehint' => 'Varianten &uuml;bermitteln'
        ),
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
                Dieses Textfeld wird beim &Uuml;bermitteln der Daten zu Cdiscount als Nachkommastelle an
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

MLI18n::gi()->add('cdiscount_config_sync', array(
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
                <strong>Hinweis:</strong> Die Einstellungen unter "Konfiguration" → "Artikelvorbereitung" → "Stückzahl Lagerbestand" werden berücksichtigt.
            ',
        ),
        'stocksync.frommarketplace' => array(
            'label' => 'Lagerver&auml;nderung Cdiscount',
            'help' => '
                Wenn z. B. bei Cdiscount ein Artikel 3 mal gekauft wurde, wird der Lagerbestand im Shop um 3 reduziert.<br><br>
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

MLI18n::gi()->add('cdiscount_config_orderimport', array(
    'legend' => array(
        'importactive' => 'Bestellimport',
        'mwst' => 'Mehrwertsteuer',
        'orderstatus' => 'Synchronisation des Bestell-Status vom Shop zu Cdiscount',
    ),
    'field' => array(
        'orderimport.shop' => array(
            'label' => '{#i18n:form_config_orderimport_shop_lable#}',
            'hint' => '',
            'help' => '{#i18n:form_config_orderimport_shop_help#}',
        ),
        'orderstatus.shipped' => array(
            'label' => 'Versand best&auml;tigen mit',
            'help' => 'Setzen Sie hier den Shop-Status, der auf Cdiscount automatisch den Status "Versand best&auml;tigen" setzen soll.',
        ),
        'orderstatus.shipmethod' => array(
            'label' => 'Versandmethode',
            'help' => 'Wählen Sie die Versandart, die allen Cdiscount-Bestellungen standardmäßig zugewiesen wird.'
        ),
        'orderstatus.carrier.freetext' => array(
            'label' => 'Transportunternehmen:',
            'placeholder' => 'Geben Sie hier Ihre Versandmethode ein'
        ),
        'orderstatus.carrier' => array(
            'label' => 'Transportunternehmen',
            'help' => '
                Wählen Sie hier das Transportunternehmen, das den Cdiscount Bestellungen standardmäßig zugeordnet wird.<br>
                <br>
                Sie haben folgende Optionen:<br>
                <ul>
                    <li>
                        <span class="bold underline">Von Cdiscount vorgeschlagene Transportunternehmen</span>
                        <p>Wählen Sie ein Transportunternehmen aus der Dropdown-Liste. Es werden die Unternehmen angezeigt, die von Cdiscount empfohlen werden.<br>
                            <br>
                            Diese Option bietet sich an, wenn Sie für Cdiscount Bestellungen <strong>immer das gleiche Transportunternehmen nutzen</strong> möchten.
                        </p>
                    </li>
                    <li>
                        <span class="bold underline">Von Cdiscount vorgeschlagene Transportunternehmen mit Versanddienstleistern aus Webshop Versandkosten-Modul matchen</span>
                        <p>Sie können die von Cdiscount empfohlenen Transportunternehmen mit den im Shopware 5 Versandkosten-Modul angelegten Dienstleistern matchen. Über das “+” Symbol können Sie mehrere Matchings vornehmen.<br>
                            <br>
                            Infos, welcher Eintrag aus dem Shopware Versandkosten-Modul beim Cdiscount Bestellimport verwendet wird, entnehmen Sie bitte dem Info Icon unter “Bestellimport” -> “Versandart der Bestellungen”.<br>
                            <br>
                            Diese Option bietet sich an, wenn Sie auf <strong>bestehende Versandkosten-Einstellungen</strong> aus dem <strong>Shopware 5</strong> Versandkosten-Modul zurückgreifen möchten.<br>
                        </p>
                    </li>
                    <li>
                        <span class="bold underline">magnalister fügt ein Freitextfeld in den Bestelldetails hinzu</span>
                        <p>Wenn Sie diese Option wählen, fügt magnalister beim Bestellimport ein Feld in den Bestelldetails bei der PrestaShop Bestellung hinzu. In dieses Feld können Sie das Transportunternehmen eintragen.<br>
                            <br>
                            Diese Option bietet sich an, wenn Sie für Amazon Bestellungen <strong>unterschiedliche Transportunternehmen</strong> nutzen möchten.<br>
                        </p>
                    </li>
                    <li>
                        <span class="bold underline">Transportunternehmen pauschal aus Textfeld übernehmen</span><br>
                        <p>Diese Option bietet sich an, wenn Sie <strong>für alle Cdiscount Bestellungen ein und dasselbe Transportunternehmen manuell hinterlegen</strong> möchten.<br></p>
                    </li>
                </ul>
                <span class="bold underline">Wichtige Hinweise:</span>
                <ul>
                    <li>Die Angabe eines Transportunternehmens ist für Versandbestätigungen bei Cdiscount verpflichtend.<br><br></li>
                    <li>Die Nicht-Übermittlung des Transportunternehmens kann zu einem vorübergehenden Entzug der Verkaufsberechtigung führen.</li>
                </ul>
            ',
        ),
        'orderstatus.cancelled' => array(
            'label' => 'Bestellung stornieren mit',
            'help' => ' Setzen Sie hier den Shop-Status, der auf  MercadoLivre automatisch den Status "Bestellung stornieren" setzen soll. <br/><br/>
                Hinweis: Teilstorno ist hier&uuml;ber nicht m&ouml;glich. Die gesamte Bestellung wird &uuml;ber diese Funktion storniert
                und dem K&auml;ufer gutgeschrieben.',
        ),
        'orderstatus.autoacceptance' => array(
            'label' => 'Automatische Annahme von Bestellungen',
            'valuehint' => '(Empfohlen) Unabhängig davon, ob Sie dieses Einstellung aktivieren, können Sie die Bestellung jederzeit ablehnen. Klicken Sie auf das Hilfesymbol für weitere Informationen.',
            'help' => 'Wenn die automatische Annahme nicht aktiviert ist, müssen Sie zu Ihrem Cdiscount-Verkäuferprofil gehen und Bestellungen manuell annehmen.<br>
                (Link: <a href = "https://seller.cdiscount.com/Orders.html">https://seller.cdiscount.com/Orders.html</a>)<br><br>
            Nach diesem Schritt können Sie den Bestellstatus über das magnalister-Plugin auf "Versand stornieren" oder "Versand bestätigen" aktualisieren.<br>
            Wenn dieses Einstellung aktiviert ist, werden die Bestellungen automatisch angenommen (außer dass der Verkäufer sie jederzeit ablehnen kann).',
        ),
        'mwst.fallback' => array(
            'label' => 'MwSt. Shop-fremder Artikel',
            'hint' => 'Steuersatz, der f&uuml;r Shop-fremde Artikel bei Bestellimport verwendet wird in %.',
            'help' => '
                Wenn der Artikel nicht &uuml;ber magnalister eingestellt wurde, kann die Mehrwertsteuer nicht ermittelt werden.<br />
                Als L&ouml;sung wird der hier angegebene Wert in Prozent bei allen Produkten hinterlegt, deren 
                Mehrwertsteuersatz beim Bestellimport aus Cdiscount nicht bekannt ist.
            ',
        ),
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
                . 'dass dies nicht beliebig weit in die Vergangenheit m&ouml;glich ist, da die Daten bei Cdiscount '
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
        'orderimport.paymentmethod' => array(
            'label' => 'Zahlart der Bestellungen',
            'help' => 'Zahlart, die allen Cdiscount-Bestellungen zugeordnet wird. Standard: "Cdiscount".<br><br>
				           Diese Einstellung ist wichtig f&uuml;r den Rechnungs- und Lieferscheindruck und f&uuml;r die nachtr&auml;gliche
				           Bearbeitung der Bestellung im Shop sowie einige Warenwirtschaften.',
        ),
        'orderimport.shippingmethod' => array(
            'label' => 'Versandart der Bestellungen',
            'help' => 'Versandart, die allen Cdiscount-Bestellungen zugeordnet wird. Standard: "Cdiscount".<br><br>
				           Diese Einstellung ist wichtig f&uuml;r den Rechnungs- und Lieferscheindruck und f&uuml;r die nachtr&auml;gliche
				           Bearbeitung der Bestellung im Shop sowie einige Warenwirtschaften.',
        ),
        'customergroup' => array(
            'label' => 'Kundengruppe',
            'help' => 'Kundengruppe, zu der Kunden bei neuen Bestellungen zugeordnet werden sollen.',
        ),
    ),
), false);

MLI18n::gi()->add('cdiscount_config_emailtemplate', array(
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
