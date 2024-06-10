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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLI18n::gi()->add('ricardo_prepare_form',array(
    'legend' => array(
        'language' => 'Sprache',
        'details' => 'Produktdetails',
        'templates' => 'Angebots-Vorlagen',
        'categories' => 'Kategorie',
        'price' => 'Preis & Dauer',
        'shipping' => 'Versand',
        'promotion' => 'Promotion',
        'other' => 'Weitere Eigenschaften'
    ),
    'field' => array(
        'categories' => array(
            'label' => 'Ricardo Kategorien',
        ),
        'primarycategory' => array(
            'label' => '1. Marktplatz-Kategorie:',
        ),
        'articlecondition' => array(
            'label' => 'Zustand des Produkts',
        ),
        'listinglangs' => array(
            'label' => 'Angebotsprache',
        ),
        'langde' => array(
            'label' => 'DE',
        ),
        'langfr' => array(
            'label' => 'FR',
        ),
        'detitle' => array(
            'label' => 'Titel (Deutsch)',
            'hint' => 'Titel max. 60 Zeichen <br> Erlaubte Platzhalter: <br> #BASEPRICE# - Grundpreis',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Artikelname immer aktuell aus Web-Shop &uuml;bernehmen',
                )
            ),
        ),
        'desubtitle' => array(
            'label' => 'Untertitel (Deutsch)',
            'hint' => 'Untertitel max. 60 Zeichen kostenpflichtig',
            'optional' => array(
                'select' => array(
                    'false' => 'Nicht &Uuml;bertragen',
                    'true' => '&Uuml;bertragen',
                )
            ),
        ),
        'dedescription' => array(
            'label' => 'Beschreibung (Deutsch)',
            'hint'  => 'Liste verf&uuml;gbarer Platzhalter f&uuml;r die Produktbeschreibung:<dl><dt>#TITLE#</dt><dd>Produktname (Titel)</dd><dt>#VARIATIONDETAILS#</dt><dd>Da Ricardo keine Varianten unterstützt, übermittelt magnalister Varianten als einzelne Artikel zu Ricardo. Nutzen Sie diesen Platzhalter, um die Varianten-Details in Ihrer Artikelbeschreibung anzuzeigen</dd><dt>#ARTNR#</dt><dd>Artikelnummer</dd><dt>#PID#</dt><dd>Produkt-ID</dd><dt>#SHORTDESCRIPTION#</dt><dd>Kurzbeschreibung aus dem Shop</dd><dt>#DESCRIPTION#</dt><dd>Beschreibung aus dem Shop</dd><dt>#PICTURE1#</dt><dd>erstes Produktbild</dd><dt>#PICTURE2# etc.</dt><dd>zweites Produktbild, mit #PICTURE3#, #PICTURE4# usw. können weitere Bilder übermittelt werden, so viele wie im Shop vorhanden.</dd></dl>',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Artikelbeschreibung immer aktuell aus Web-Shop verwenden',
                )
            ),
        ),
        'frtitle' => array(
            'label' => 'Titel (Franz&ouml;sisch)',
            'hint' => 'Titel max. 60 Zeichen <br> Erlaubte Platzhalter: <br> #BASEPRICE# - Grundpreis',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Artikelname immer aktuell aus Web-Shop &uuml;bernehmen',
                )
            ),
        ),
        'frsubtitle' => array(
            'label' => 'Untertitel (Franz&ouml;sisch)',
            'hint' => 'Untertitel max. 60 Zeichen kostenpflichtig',
            'optional' => array(
                'select' => array(
                    'false' => 'Nicht &Uuml;bertragen',
                    'true' => '&Uuml;bertragen',
                )
            ),
        ),
        'frdescription' => array(
          'label' => 'Beschreibung (Franz&ouml;sisch)',
            'hint'  => 'Liste verf&uuml;gbarer Platzhalter f&uuml;r die Produktbeschreibung:<dl><dt>#TITLE#</dt><dd>Produktname (Titel)</dd><dt>#VARIATIONDETAILS#</dt><dd>Da Ricardo keine Varianten unterstützt, übermittelt magnalister Varianten als einzelne Artikel zu Ricardo. Nutzen Sie diesen Platzhalter, um die Varianten-Details in Ihrer Artikelbeschreibung anzuzeigen</dd><dt>#ARTNR#</dt><dd>Artikelnummer</dd><dt>#PID#</dt><dd>Produkt-ID</dd><dt>#SHORTDESCRIPTION#</dt><dd>Kurzbeschreibung aus dem Shop</dd><dt>#DESCRIPTION#</dt><dd>Beschreibung aus dem Shop</dd><dt>#PICTURE1#</dt><dd>erstes Produktbild</dd><dt>#PICTURE2# etc.</dt><dd>zweites Produktbild, mit #PICTURE3#, #PICTURE4# usw. können weitere Bilder übermittelt werden, so viele wie im Shop vorhanden.</dd></dl>',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Artikelbeschreibung immer aktuell aus Web-Shop verwenden',
                )
            ),
        ),
        'images' => array(
            'label' => 'Produktbilder',
            'hint' => 'Maximal 5 Produktbilder<br>Entgegen den von Ricardo erlaubten 10 Bildern je Artikel, schr&auml;nkt magnalister auf 5 Produktbilder ein, um die erlaubte Datenmenge von 20 MByte pro Artikel&uuml;bermittlung nicht zu &ouml;berschreiten.',
        ),
        'descriptiontemplate' => array(
          'label' => 'Angebots-Vorlagen',
        ),
        'warranty' => array(
            'label' => 'Garantie',
        ),
        'warrantycondition' => array(
            'label' => '',
        ),
        'warrantyconditionajax' => array(
            'label' => '',
        ),
        'warrantydescription' => array(
            'label' => '',
        ),
        'buyingmode' => array(
            'label' => 'Auktionstyp',
            'hint' => ' Art der Auktion',
        ),
        'price' => array(
            'label' => 'Preis',
        ),
        'fixpriceajax' => array(
            'label' => '',
        ),
        'fixprice' => array(
            'label' => '',
        ),
        'enablebuynowpriceajax' => array(
            'label' => '',
            'valuehint' => '',
        ),
        'enablebuynowprice' => array(
            'label' => '',
            'valuehint' => '',
        ),
        'auction' => array(
            'label' => '',
        ),
        'priceajax' => array(
            'label' => '',
        ),
        'priceforauction' => array(
            'label' => 'Startpreis',
        ),
        'priceincrement' => array(
            'label' => 'Erh&ouml;hungsschritt',
        ),
        'durationcontainer' => array(
            'label' => 'Dauer',
            'hint' => 'Dauer der Auktion',
        ),
        'duration' => array(
            'label' => '',
        ),
        'startdate' => array(
            'label' => 'Start date',
        ),
        'endtime' => array(
            'label' => '',
        ),
        'enddate' => array(
            'label' => 'Endzeit',
        ),
        'maxrelistcountcontainer' => array(
            'label' => 'Angebot reaktivieren',
        ),
        'maxrelistcount' => array(
            'label' => 'Wie h&auml;ufig soll Ihr Angebot reaktiviert werden?',
        ),
        'payment' => array(
            'label' => 'Zahlungsart',
            'hint' => ' Angebotene Zahlungsarten',
        ),
        'paymentmethods' => array(
            'label' => '',
        ),
        'paymentmethodsajax' => array(
            'label' => ''
        ),
        'paymentdescription' => array(
            'label' => '',
        ),
        'delivery' => array(
            'label' => 'Versandart',
        ),
        'deliverycondition' => array(
            'label' => '',
        ),
        'deliveryconditionajax' => array(
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
        'availabilitycontainer' => array(
            'label' => 'Lieferzeit',
        ),
        'availability' => array(
            'label' => 'Verf&uuml;gbarkeit des Artikels nach Zahlungseingang',
        ),
        'promotion' => array(
            'label' => 'Promotion',
        ),
        'firstpromotion' => array(
            'label' => 'Promotion-Paket',
            'hint' => '<span style="color:#e31a1c;">Promotions sind nicht kostenlos. Bitte &uuml;berpr&uuml;fen Sie die Preise auf Ricardo.</span>',
        ),
        'secondpromotion' => array(
            'label' => 'Startseite',
            'hint' => '<span style="color:#e31a1c;">Promotions sind nicht kostenlos. Bitte &uuml;berpr&uuml;fen Sie die Preise auf Ricardo.</span>',
        ),
    ),
),false);

MLI18n::gi()->ricardo_prepareform_max_length_part1 = 'Max length of';
MLI18n::gi()->ricardo_prepareform_max_length_part2 = 'attribute is';
MLI18n::gi()->ricardo_prepareform_category = 'Category attribute is mandatory.';
MLI18n::gi()->ricardo_prepareform_title = 'Title attribute is mandatory.';
MLI18n::gi()->ricardo_prepareform_description = 'Description attribute is mandatory.';
MLI18n::gi()->ricardo_prepareform_warranty_description = 'Warranty description attribute is mandatory.';
MLI18n::gi()->ricardo_prepareform_delivery_description = 'Delivery description attribute is mandatory.';
MLI18n::gi()->ricardo_prepareform_payment_description = 'Payment description attribute is mandatory.';
MLI18n::gi()->ricardo_prepareform_setdate = 'Date attribute is mandatory.';
MLI18n::gi()->ricardo_prepareform_labelprice = 'Price will be calculated based on the price config.';
MLI18n::gi()->ricardo_prepareform_labelfixprice = 'Sofort-Kaufen-Preis';
MLI18n::gi()->ricardo_prepareform_valuehintlprice = 'Enable "buy-it-now" price (Price will be calculated based on the price config.)';
MLI18n::gi()->ricardo_prepareform_paymentmethods = 'Invalid payment methods combinations.';
MLI18n::gi()->ricardo_prepareform_defaulttemplate = 'Keine Angebots-Vorlage';
MLI18n::gi()->ricardo_prepareform_days = 'Tage';
MLI18n::gi()->ricardo_after_delete = 'Die Verarbeitung des L&ouml;schvorgangs kann bis zu 15 Minuten dauern.';