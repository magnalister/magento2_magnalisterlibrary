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
 * $Id$
 *
 * (c) 2010 - 2018 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLI18n::gi()->Ebay_Product_Matching = 'Produkt Matching';
MLI18n::gi()->Ebay_Productlist_Match_Manual_Button_Save='Matching speichern und Produkt vorbereiten';

MLI18n::gi()->Ebay_Productlist_Itemsearch_Select='Ausw&auml;hlen';
MLI18n::gi()->Ebay_Productlist_Itemsearch_Title='eBay Titel';
MLI18n::gi()->Ebay_Productlist_Itemsearch_SkuOfManufacturer='Art.-Nr. des Herstellers';
MLI18n::gi()->Ebay_Productlist_Itemsearch_Barcode='Barcode (EAN, UPC oder ISBN)';
MLI18n::gi()->Ebay_Productlist_Itemsearch_Epid='ePID';

MLI18n::gi()->Ebay_Productlist_Itemsearch_Search_Free='Neue Suchanfrage';
MLI18n::gi()->Ebay_Productlist_Itemsearch_Search_EPID='ePID Direkteingabe';

MLI18n::gi()->Ebay_Productlist_Itemsearch_CreateNewProduct='Neues Produkt im eBay Katalog beantragen';
MLI18n::gi()->Ebay_Productlist_Itemsearch_DontMatch='Nicht matchen';
MLI18n::gi()->Ebay_Productlist_Itemsearch_DontMatch_Warning ='Für Produktvarianten gilt hinsichtlich des Produkt Matchings mit dem eBay Katalog folgende Unterscheidung:
<br><br>
1. In der Produktvariante ist ein EAN Code hinterlegt<br><br>

Dann versucht magnalister anhand der EAN ein passendes eBay <br>
Katalogprodukt zu matchen. Ist dieser Vorgang erfolgreich, wird <br>
die Variante mit einer ePID verknüpft und auf eBay veröffentlicht.<br>
<br>
Wenn über die EAN kein Katalogprodukt eindeutig zugeordnet<br>
werden kann, beantragt magnalister die Variante automatisch zur<br>
Aufnahme im eBay Katalog. Genehmigt eBay die Variante, wird sie automatisch auf dem Marktplatz veröffentlicht.<br>
<br>
2. In der Produktvariante ist kein EAN Code hinterlegt<br>
<br>
Dann ist kein Produkt Matching mit dem eBay Katalog möglich und es wird eine Fehlermeldung von eBay zurückgegeben. Diese finden Sie in Reiter “Inventar” -> “Error-Log”.
';
        
MLI18n::gi()->Ebay_Productlist_Cell_aPreparedStatus__OK__title='Erfolgreich vorbereitete';
MLI18n::gi()->Ebay_Productlist_Cell_aPreparedStatus__ERROR__title='Fehlerhaft vorbereitete';
MLI18n::gi()->Ebay_Productlist_Cell_aPreparedStatus__OPEN__title='Vorbereitete ungepr&uuml;ft';

MLI18n::gi()->Ebay_Productlist_Filter_aPreparedStatus__OK='Erfolgreich vorbereitete';
MLI18n::gi()->Ebay_Productlist_Filter_aPreparedStatus__ERROR='Fehlerhaft vorbereitete';
//MLI18n::gi()->Ebay_Productlist_Filter_aPreparedStatus__OPEN='Vorbereitete ungepr&uuml;ft';
MLI18n::gi()->Productlist_Filter_aMarketplaceSync__notTransferred = 'Zeige seit mind. 1 Jahr nicht auf {#marketplace#} eingestellte';

MLI18n::gi()->Ebay_Productlist_Cell_aPreparedType__Matched = 'ePID Produkt<br /><span class="small">(Katalogpflicht)</span>';
MLI18n::gi()->Ebay_Productlist_Cell_aPreparedType__NotMatched = 'Eigene Daten<br /><span class="small">(keine Katalogpflicht)</span>';

MLI18n::gi()->Ebay_Productlist_Cell_aPreparedType__Chinese='Steigerungsauktion (Chinese)';
MLI18n::gi()->Ebay_Productlist_Cell_aPreparedType__FixedPriceItem='Festpreis';
MLI18n::gi()->Ebay_Productlist_Cell_aPreparedType__StoresFixedPrice='Festpreis (eBay Store)';
MLI18n::gi()->Ebay_Productlist_Header_sPreparedListingType='Art der Auktion';
MLI18n::gi()->Ebay_Productlist_Header_sPreparedType='Vorbereitungsart';
MLI18n::gi()->Ebay_Productlist_Prepare_sResetValuesButton = 'Vorbereitung (teilweise) aufheben';
MLI18n::gi()->Ebay_Productlist_Prepare_aResetValues = array(
    'buttons' => array(
        'ok' => 'ok',
        'abort' => 'abbrechen',
    ),
    'checkboxes' => array(
        'title' => 'Vorbereitung für den Titel aufheben',
        'subtitle' => 'Vorbereitung für den Untertitel aufheben',
        'description' => 'Vorbereitung für die Artikelbeschreibung aufheben',
        'pictures' => 'Vorbereitung der selektierten Bilder aufheben',
        'strikeprices' => 'Vorbereitung f&uuml;r Streichpreise aufheben<br />',
        'unprepare' => 'Vorbereitung komplett aufheben',
    )
);
MLI18n::gi()->Ebay_Productlist_Matching_sResetValuesButton = 'Vorbereitung (teilweise) aufheben';
MLI18n::gi()->Ebay_Productlist_Matching_aResetValues = array(
    'buttons' => array(
        'ok' => 'ok',
        'abort' => 'abbrechen',
    ),
    'checkboxes' => array(
        'matching' => 'Matching aufheben',
        'unprepare' => 'Vorbereitung komplett aufheben',
    )
);
MLI18n::gi()->Ebay_Productlist_Upload_ShippingFee_Notice_Title = "Information";
MLI18n::gi()->Ebay_Productlist_Upload_ShippingFee_Notice_Content = "eBay berechnet je nach Vertrag Gebühren pro Listing oder bei Verwendung von Zusatzfunktionen wie „Untertitel“.
Das &Uuml;bermitteln der Produkte l&ouml;st solche Geb&uuml;hren aus.
Pr&uuml;fen Sie Ihren eBay-Tarif, um ungewollte Geb&uuml;hren zu vermeiden.";

