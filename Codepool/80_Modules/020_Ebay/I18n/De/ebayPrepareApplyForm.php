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

MLI18n::gi()->ml_ebay_note_product_required_short ='<b>Hinweis</b>: F&uuml;r diese Kategorie ist eine Angabe der eBay Produkt ID Pflicht, Details siehe Info-Icon.';
MLI18n::gi()->ml_ebay_note_product_required ='eBay verlangt f&uuml;r diese Kategorie eine Zuordnung zu auf eBay existierenden Produkten (Matching) anhand einer ePID.<ul><li>magnalister f&uuml;hrt dieses Matching automatisch anhand der EAN durch.</li><li>Sollte im eBay-Katalog noch kein passendes Produkt und ePID erkannt werden, wird es automatisch nach dem Hochladen als neues Produkt bei eBay beantragt. &Uuml;berpr&uuml;fen Sie den Status danach im Inventar-Reiter und auch dem Fehlerlog.</li></ul>';
MLI18n::gi()->ebay_prepare_apply = 'Neue Produkte erstellen';
MLI18n::gi()->ml_ebay_no_conditions_applicable_for_cat = 'Diese Kategorie erlaubt keine Angabe des Artikelzustands.';
MLI18n::gi()->ml_ebay_prepare_form_category_notvalid = 'Diese Kategorie ist ungültig';
MLI18n::gi()->add('ebay_prepare_apply_form', array(
    'legend' => array(
        'details' => 'Artikeldetails',
        'pictures' => 'Einstellungen f&uuml;r Bilder',
        'auction' => 'Auktionseinstellungen',
        'category' => 'eBay-Kategorie',
        'variationmatching' => array('{#i18n:attributes_matching_required_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingoptional' => array('{#i18n:attributes_matching_optional_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingcustom' => array('{#i18n:attributes_matching_custom_attributes#}', '{#i18n:attributes_matching_title#}'),
        'shipping' => 'Versand',
        'mwst' => 'Mehrwertsteuer',
    ),
    'field' => array(
        'title' => array(
            'label' => 'Produktname',
            'hint' => 'Titel max. 80 Zeichen<br />Erlaubte Platzhalter:<br />#BASEPRICE# - Grundpreis<br />Bitte dazu den <span style="color:#e31a1c;">Info-Text in der Konfiguration</span> (bei Template Produktname) beachten.',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Artikelname immer aktuell aus Web-Shop &uuml;bernehmen',
                )
            )
        ),
        'subtitle' => array(
            'label' => 'Untertitel',
            'hint' => 'Untertitel max. 55 Zeichen <span style="color:#e31a1c">kostenpflichtig</span>',
            'optional' => array(
                'select' => array(
                    'false' => 'Nicht &Uuml;bertragen',
                    'true' => '&Uuml;bertragen',
                )
            )
        ),
        'pictureurl' => array(
            'label' => 'eBay-Bild',
            'hint' => 'Bilder',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Bilder immer aus Webshop übernehmen',
                )
            )
        ),
        'variationdimensionforpictures' => array(
            'label' => 'Bilderpaket Varianten-Ebene',
            'help' => '
                Sollten Sie Variantenbilder an Ihren Artikel gepflegt haben, werden diese mit Aktivierung von "Bilderpaket" zu eBay übermittelt.<br>
                Hierbei läßt eBay nur eine zu verwendende Varianten-Ebene zu (wählen Sie z. B. "Farbe", so zeigt eBay jeweils ein anderes Bild an, wenn der Käufer eine andere Farbe auswählt).<br>
                Sie können in der Produkt-Vorbereitung jederzeit den hier hinterlegten Standard-Wert für die getroffene Auswahl individuell abändern.<br><br>
                Nachträgliche Änderungen bedürfen einer Anpassung der Vorbereitung und eine erneute Übermittlung der betroffenen Produkte.
            ',
        ),
        'variationpictures' => array(
            'label' => 'Varianten Bilder',
            'hint' => '',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'immer alle Variantenbilder aus Webshop übernehmen',
                )
            ),
        ),
        'gallerytype' => array(
            'label' => 'Galerie-Bilder',
            'help' => '
                <b>Galerie-Bilder</b><br>
                <br>
				Mit Aktivieren dieser Funktion werden in der eBay Suchergebnis-Liste Ihre Angebote mit einem kleinen Vorschaubild platziert. Dies erhöht Ihre Verkaufschancen maßgeblich, da Käufer Angebote ohne Galeriebilder in der Regel weniger aufrufen.<br>
                <br>
				<b>Galerie Plus</b>
                <br>
                <br>
				Durch Aktivierung der Galerie Plus Bilder öffnet sich ein Fenster mit einer vergrößerten Darstellung des Galeriebildes, wenn der Käufer in den Suchergebnissen mit der Maus auf Ihr Angebot zeigt. Bitte beachten Sie, dass die Bilder <b>mindestens 800x800 px</b> groß sein müssen.<br>
                <br>
				<b>Besonderheit "Kleidung &amp; Accessoires"</b><br>
                <br>
				Wenn Sie einen Artikel in der Kategorie "Kleidung &amp; Accessoires" einstellen und Galerie oder Galerie Plus auswählen, bieten Sie den Käufern auf der Suchergebnisseite die Möglichkeit zum "Schnellen Überblick". Galerie Plus muss nicht zusätzlich in Ihrem eBay-Account aktiviert werden.<br>
                <br>
				<b>eBay-Gebühren</b><br>
                <br>
				Durch Nutzung von "Galerie Plus" können im Hintergrund <span style="color:#e31a1c">zusätzliche Gebühren von eBay</span> erhoben werden! RedGecko GmbH übernimmt für die anfallenden Gebühren keine Haftung.<br>
                <br>
				<b>Weitere Infos</b><br>
                <br>
				Besuchen Sie für weitere Infos zu dem Thema die <a href="http://pages.ebay.de/help/sell/gallery-upgrade.html" target="_blank">eBay Hilfeseiten</a>.
            ',
            'hint' => 'Galerie-Einstellung<br />("Plus" in einigen Kategorien <span style="color:#e31a1c">kostenpflichtig</span>)',
            'alert' => array(
                'Plus' => array(
                    'title' => 'Galerie Plus',
                    'content' => '
                        Mit der Zusatzoption <b>Galerie Plus</b> erscheint Ihr Artikelfoto als vergrößertes Vorschaubild in den Suchergebnissen und in der Galerie.<br>
                        <br>
                        Die hochgeladenen Fotos müssen mindestens 800 x 800 Pixel groß sein.<br>
                        <br>
                        Dadurch können im Hintergrund  <span style="color:#e31a1c;">zusätzliche Gebühren</span> von eBay erhoben werden!<br>
                        <br>Weitere Infos dazu finden Sie auf den <a href="http://pages.ebay.de/help/sell/gallery-upgrade.html" target="_blank">eBay Hilfeseiten</a>.<br>
                        <br>
                        RedGecko GmbH übernimmt für die anfallenden Gebühren keine Haftung.<br>
                        <br>
                        Bitte bestätigen Sie mit "Ok", die Information zur Kenntnis genommen zu haben, oder brechen ab, ohne die Funktion zu aktivieren.
                    '
                ),
            )
        ),
        'description' => array(
            'label' => 'Beschreibung',
            'hint' => 'Liste verf&uuml;gbarer Platzhalter f&uuml;r die Produktbeschreibung:'
            . '<dl>'
            . '<dt>#TITLE#</dt>'
            . '<dd>Produktname (Titel)</dd>'
            . '<dt>#ARTNR#</dt>'
            . '<dd>Artikelnummer</dd>'
            . '<dt>#PID#</dt>'
            . '<dd>Produkt-ID</dd>'
            . '<dt>#SHORTDESCRIPTION#</dt>'
            . '<dd>Kurzbeschreibung aus dem Shop</dd>'
            . '<dt>#DESCRIPTION#</dt>'
            . '<dd>Beschreibung aus dem Shop</dd>'
            . '<dt>#MOBILEDESCRIPTION#</dt>'
            . '<dd>Kurzbeschreibung f&uuml;r mobile Ger&auml;te, falls hinterlegt</dd><dt>#PICTURE1#</dt>'
            . '<dd>erstes Produktbild</dd>'
            . '<dt>#PICTURE2# etc.</dt>'
            . '<dd>zweites Produktbild, mit #PICTURE3#, #PICTURE4# usw. können weitere Bilder übermittelt werden, so viele wie im Shop vorhanden.</dd>'
            . '</dl>',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Artikelbeschreibung immer aktuell aus Web-Shop verwenden',
                )
            )
        ),
        'descriptionmobile' => array(
            'label' => 'Mobile Beschreibung',
            'hint' => '
                Liste verf&uuml;gbarer Platzhalter f&uuml;r die Produktbeschreibung:
                <dl>
                    <dt>#TITLE#</dt><dd>Produktname (Titel)</dd>
                    <dt>#ARTNR#</dt><dd>Artikelnummer im Shop</dd>
                    <dt>#PID#</dt><dd>Produkt ID im Shop</dd>
                    <dt>#SHORTDESCRIPTION#</dt><dd>Kurzbeschreibung aus dem Shop</dd>
                    <dt>#DESCRIPTION#</dt><dd>Beschreibung aus dem Shop</dd>
                    <dt>#WEIGHT#</dt><dd>Produktgewicht</dd>
                </dl>
            ',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Artikelbeschreibung immer aktuell aus Web-Shop verwenden',
                )
            ),
            'hint2' => '<b>Hinweis</b>:<br />An HTML-Elementen sind nur Zeilenumbrüche und Listen erlaubt, alles andere wird herausgefiltert.'
        ),
        'pricecontainer' => array(
            'label' => 'eBay Preis',
            'hint' => 'Preis für eBay',
        ),
        'buyitnowprice' => array(
            'optional' => array(
                'select' => array(
                    'true' => 'Sofortkaufen aktivieren',
                    'false' => 'Kein Sofortkaufen',
                )
            )
        ),
        'site' => array(
            'label' => 'eBay-Site',
            'hint' => 'eBay-Marketplace, auf dem Sie einstellen.',
        ),
        'listingtype' => array(
            'label' => 'Art der Auktion',
            'hint' => 'Art der Auktion',
        ),
        'listingduration' => array(
            'label' => 'Laufzeit',
            'hint' => 'Dauer der Auktion',
        ),
        'strikeprice' => array (
            'label' => 'Streichpreise',
            'hint'  => 'Streichpreise',
        ),
        'paymentsellerprofile' => array(
            'label' => 'Rahmenbedingungen: Zahlungsarten',
            'help' => '
                <b>Auswahl des Rahmenbedingungen-Profils für Zahlungsarten</b><br /><br />
                Sie verwenden die Funktion "Rahmenbedingungen für Ihre Angebote" auf eBay. Das bedeutet, dass Zahlungs-, Versand-, und Rücknahmeoptionen nicht mehr einzeln gewählt werden können, sondern von den Angaben im jeweiligen Profil auf eBay bestimmt werden.<br /><br />
                Bitte wählen Sie hier das das bevorzugte Profil für die Zahlungsbedingungen. Dies ist die Vorgabe. Wenn Sie auf eBay mehrere Profile angelegt haben, kann in der Vorberetung ein abweichendes Profil gewählt werden.
            ',
            'help_subfields' => '
                <br>
                <br>
                <b>Hinweis</b>:<br />
                Dieses Feld ist nicht editierbar, da Sie die eBay Rahmenbedingungen nutzen. Bitte verwenden Sie das Auswahlfeld
                <b>Rahmenbedingungen: Zahlungsarten</b>
                um das Profil für die Zahlungsbedingungen festzulegen.
            '
        ),
        'paymentmethods' => array(
            'label' => 'Zahlungsarten',
            'hint' => 'Angebotene Zahlungsarten',
            'help' => 'Voreinstellungen f&uuml;r Zahlungsarten (Mehrfach-Auswahl mit Strg+Klick). Wählen Sie hier die von eBay zur Verfügung gestellten Zahlungsarten aus.<br /><br />Wenn Sie "Zahlungsabwicklung durch eBay" nutzen, werden von eBay keine weiteren Informationen zur vom Käufer genutzten Zahlart bereitgestellt.',
        ),
        'conditionid' => array(
            'label' => 'Artikelzustand',
            'hint' => 'Zustand des Artikels (wird in den meisten Kategorien bei eBay angezeigt)',
        ),
        'conditiondescriptors' => array(
            'label' => 'Angaben zum Artikelzustand',
            'hint' => 'Zusätzliche Angaben zum Artikelzustand (für einige Kategorien)',
        ),
        'conditiondescription' => array(
            'label' => 'Beschreibung des Zustands',
            'hint' => 'Zusätzliche Angaben zum Artikelzustand. Nicht angezeigt bei Zuständen wie "Neu" oder "Neu mit ..."',
        ),
        'privatelisting' => array(
            'label' => 'Privat-Listing',
            'hint' => 'Wenn aktiv, kann die Käufer / Bieterliste nicht von Dritten eingesehen werden <span style="color:#e31a1c">kostenpflichtig</span>',
            'valuehint' => 'Käufer / Bieterliste nicht öffentlich',
        ),
        'bestofferenabled' => array(
            'label' => 'Preisvorschlag',
            'hint' => 'Wenn aktiv, können Käufer eigene Preise vorschlagen',
            'valuehint' => 'Preisvorschlag aktivieren (gilt nur f&uuml;r Artikel ohne Varianten)',
        ),
        'ebayplus' => array(
            'label' => 'eBay Plus',
            'hint' => 'Nur verfügbar, wenn dieses Feature auf eBay freigeschaltet und aktiviert ist',
            'valuehint' => '\'eBay Plus\' aktivieren',
        ),

        'starttime' => array(
            'label' => 'Startzeit<br />(falls vorbelegt)',
            'hint' => 'Im Normalfall ist ein eBay-Artikel sofort nach dem Hochladen aktiv. Aber wenn Sie dieses Feld füllen, erst ab Startzeit (<span style="color:#e31a1c">kostenpflichtig</span>).',
        ),
        'primarycategory' => array(
            'label' => 'Prim&auml;rkategorie',
            'hint' => 'W&auml;hlen',
        ),
        'secondarycategory' => array(
            'label' => 'Sekund&aumlrkategorie',
            'hint' => 'W&auml;hlen',
        ),
        'storecategory' => array(
            'label' => 'eBay Store Kategorie',
            'hint' => 'W&auml;hlen',
        ),
        'storecategory2' => array(
            'label' => 'Sekundäre Store Kategorie',
            'hint' => 'W&auml;hlen',
        ),
        'shippingsellerprofile' => array(
            'label' => 'Rahmenbedingungen: Versand',
            'help' => '
                <b>Auswahl des Rahmenbedingungen-Profils für den Versand</b><br /><br />
                Sie verwenden die Funktion "Rahmenbedingungen für Ihre Angebote" auf eBay. Das bedeutet, dass Zahlungs-, Versand-, und Rücknahmeoptionen nicht mehr einzeln gewählt werden können, sondern von den Angaben im jeweiligen Profil auf eBay bestimmt werden.<br /><br />
                Bitte wählen Sie hier das bevorzugte Profil für die Versandbedingungen. Dies ist die Vorgabe. Wenn Sie auf eBay mehrere Profile angelegt haben, kann in der Vorberetung ein abweichendes Profil gewählt werden.
            ',
            'help_subfields' => '
                <b>Hinweis</b>:<br />
                Dieses Feld ist nicht editierbar, da Sie die eBay Rahmenbedingungen nutzen. Bitte verwenden Sie das Auswahlfeld
                <b>Rahmenbedingungen: Versand</b>
                um das Profil für die Versandbedingungen festzulegen.
            '
        ),
        'shippinglocalcontainer' => array(
            'label' => 'Versand Inland',
            'hint' => 'Angebotene inl&auml;ndische Versandarten<br /><br />Angabe "=GEWICHT" bei den Versandkosten setzt diese gleich dem Artikelgewicht.',
        ),
        'shippinginternationalcontainer' => array(
            'label' => 'Versand Ausland',
            'hint' => 'Angebotene ausländische Versandarten',
        ),

        'shippinglocal' => array(
            'cost' => 'Versandkosten'
        ),
        'shippinglocalprofile' => array(
            'option' => '{#NAME#} ({#AMOUNT#} je weiteren Artikel)',
            'optional' => array(
                'select' => array(
                    'false' => 'Versandprofil nicht anwenden',
                    'true' => 'Versandprofil anwenden',
                )
            )
        ),
        'shippinglocaldiscount' => array(
            'label' => 'Regeln f&uuml;r Versand zum Sonderpreis anwenden'
        ),
        'shippinginternationaldiscount' => array(
            'label' => 'Regeln f&uuml;r Versand zum Sonderpreis anwenden'
        ),
        'shippinginternational' => array(
            'cost' => 'Versandkosten',
            'optional' => array(
                'select' => array(
                    'false' => 'Nicht ins Ausland versenden',
                    'true' => 'Ins Ausland Versenden',
                )
            )
        ),
        'dispatchtimemax' => array(
            'label' => 'Zeit bis Versand',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Zeit bis Versand immer aus eBay-Konfiguration nehmen',
                )
            )
        ),
        'shippinginternationalprofile' => array(
            'option' => '{#NAME#} ({#AMOUNT#} je weiteren Artikel)',
            'notavailible' => 'Nur wenn `<i>Versand Ausland</i>` aktiv ist.',
            'optional' => array(
                'select' => array(
                    'false' => 'Versandprofil nicht anwenden',
                    'true' => 'Versandprofil anwenden',
                )
            )
        ),
        'variationgroups' => array(
            'label' => '{#i18n:attributes_matching_category_title#}',
        ),
        'variationgroups.value' => array(
            'label' => '1. Marktplatz-Kategorie:',
        ),
        'webshopattribute' => array(
            'label' => '{#i18n:attributes_matching_web_shop_attribute#}',
        ),
        'attributematching' => array(
            'matching' => array(
                'titlesrc' => '{#i18n:attributes_matching_shop_value#}',
                'titledst' => '{#i18n:attributes_matching_marketplace_value#}',
            ),
        ),
        'mwst' => array(
            'label' =>'Mehrwertsteuersatz',
            'help'=>'<p>Legen Sie hier den individuellen Mehrwertsteuersatz (in Prozent) für diesen Artikel fest. Als Standardsatz wird in dieses Feld der unter “Konfiguration” -> “Artikelvorbereitung” -> “Mehrwertsteuer” festgelegte Wert übernommen. Lassen Sie das Feld leer, so wird keine Mehrwertsteuer an eBay übertragen.</p>
<p><b>Wichtig:</b><br/>
Bitte füllen Sie dieses Feld nur aus, wenn Sie umsatzsteuerpflichtig sind (schließt z.B. Kleinunternehmer nach § 19 UstG aus).</p>',
            'hint' => 'Mehrwertsteuersatz für dieses Produkt in %',
        ),
    )
), false);

MLI18n::gi()->add('ebay_prepare_variations', array(
    'legend' => array(
        'variations' => 'Kategorie von eBay ausw&auml;hlen',
        'attributes' => 'Attributsnamen von eBay ausw&auml;hlen',
        'variationmatching' => array('{#i18n:attributes_matching_required_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingoptional' => array('{#i18n:attributes_matching_optional_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingcustom' => array('{#i18n:attributes_matching_custom_attributes#}', '{#i18n:attributes_matching_title#}'),
        'action' => '{#i18n:form_action_default_legend#}',
    ),
    'field' => array(
        'variationgroups' => array(
            'label' => '{#i18n:attributes_matching_category_title#}',
        ),
        'variationgroups.value' => array(
            'label' => '1. Marktplatz-Kategorie:',
        ),
        'deleteaction' => array(
            'label' => '{#i18n:ML_BUTTON_LABEL_DELETE#}',
        ),
        'groupschanged' => array(
            'label' => '',
        ),
        'attributename' => array(
            'label' => 'Attributsnamen',
        ),
        'attributenameajax' => array(
            'label' => '',
        ),
        'customidentifier' => array(
            'label' => 'Bezeichner',
        ),
        'webshopattribute' => array(
            'label' => '{#i18n:attributes_matching_web_shop_attribute#}',
        ),
        'saveaction' => array(
            'label' => 'Speichern und schliessen',
        ),
        'resetaction' => array(
            'label' => '{#i18n:amazon_varmatch_reset_matching#}',
            'confirmtext' => '{#i18n:attributes_matching_reset_matching_message#}',
        ),
        'attributematching' => array(
            'matching' => array(
                'titlesrc' => '{#i18n:attributes_matching_shop_value#}',
                'titledst' => '{#i18n:attributes_matching_marketplace_value#}',
            ),
        ),
    ),
), false);

MLI18n::gi()->ebay_prepareform_max_length_part1 = 'Max length of';
MLI18n::gi()->ebay_prepareform_max_length_part2 = 'attribute is';
MLI18n::gi()->ebay_prepareform_category = 'Category attribute is mandatory.';
MLI18n::gi()->ebay_prepareform_title = 'Bitte geben Sie einen Titel an.';
MLI18n::gi()->ebay_prepareform_description = 'Bitte geben Sie eine Artikelbeschreibung an.';
MLI18n::gi()->ebay_prepareform_category_attribute = ' (Kategorie Attribute) ist erforderlich und kann nicht leer sein.';
MLI18n::gi()->ebay_category_no_attributes = 'Es sind keine Attribute f&uuml;r diese Kategorie vorhanden.';
MLI18n::gi()->ebay_prepare_variations_title = '{#i18n:attributes_matching_tab_title#}';
MLI18n::gi()->ebay_prepare_variations_groups = 'eBay Gruppen';
MLI18n::gi()->ebay_prepare_variations_groups_custom = 'Eigene Gruppen';
MLI18n::gi()->ebay_prepare_variations_groups_new = 'Eigene Gruppe anlegen';
MLI18n::gi()->ebay_prepare_match_variations_no_selection = '{#i18n:attributes_matching_matching_variations_no_category_selection#}';
MLI18n::gi()->ebay_prepare_match_variations_custom_ident_missing = 'Bitte w&auml;hlen Sie Bezeichner.';
MLI18n::gi()->ebay_prepare_match_variations_attribute_missing = 'Bitte w&auml;hlen Sie Attributsnamen.';
MLI18n::gi()->ebay_prepare_match_variations_not_all_matched = 'Bitte weisen Sie allen eBay Attributen ein Shop-Attribut zu.';
MLI18n::gi()->ebay_prepare_match_notice_not_all_auto_matched = 'Es konnten nicht alle ausgewählten Werte gematcht werden. Nicht-gematchte Werte werden weiterhin in den DropDown-Feldern angezeigt. Bereits gematchte Werte werden in der Produktvorbereitung berücksichtigt.';
MLI18n::gi()->ebay_prepare_match_variations_saved = '{#i18n:attributes_matching_prepare_variations_saved#}';
MLI18n::gi()->ebay_prepare_variations_saved = '{#i18n:attributes_matching_matching_variations_saved#}';
MLI18n::gi()->ebay_prepare_match_variations_delete = 'Wollen Sie die eigene Gruppe wirklich l&ouml;schen? Alle zugeh&ouml;rigen Variantenmatchings werden dann ebenfalls gel&ouml;scht.';
MLI18n::gi()->ebay_error_checkin_variation_config_empty = 'Variationen sind nicht konfiguriert.';
MLI18n::gi()->ebay_error_checkin_variation_config_cannot_calc_variations = 'Es konnten keine Variationen errechnet werden.';
MLI18n::gi()->ebay_error_checkin_variation_config_missing_nameid = 'Es konnte keine Zuordnung f&uuml;r das Shop Attribut "{#Attribute#}" bei der gew&auml;hlten Ayn24 Variantengruppe "{#MpIdentifier#}" f&uuml;r den Varianten Artikel mit der SKU "{#SKU#}" gefunden werden.';
MLI18n::gi()->ebay_prepare_variations_free_text = '{#i18n:attributes_matching_option_free_text#}';
MLI18n::gi()->ebay_prepare_variations_additional_category = '{#i18n:attributes_matching_additional_category#}';
MLI18n::gi()->ebay_prepare_variations_error_text = '{#i18n:attributes_matching_attribute_required_error#}';
MLI18n::gi()->ebay_prepare_variations_error_empty_custom_attribute_name = '{#i18n:form_action_default_empty_custom_attribute_name#}';
MLI18n::gi()->ebay_prepare_variations_error_maximal_number_custom_attributes_exceeded = '{#i18n:form_action_default_maximal_number_custom_attributes_exceeded#}';
MLI18n::gi()->ebay_prepare_variations_theme_mandatory_error = 'Bitte wählen Sie das Varianten-Design.';
MLI18n::gi()->ebay_prepare_variations_error_missing_value = '{#i18n:attributes_matching_attribute_required_missing_value#}';
MLI18n::gi()->ebay_prepare_variations_error_free_text = '{#i18n:attributes_matching_attribute_free_text_error#}';
MLI18n::gi()->ebay_prepare_variations_matching_table = '{#i18n:attributes_matching_table_matched_headline#}';
MLI18n::gi()->ebay_prepare_variations_manualy_matched = '{#i18n:attributes_matching_type_manually_matched#}';
MLI18n::gi()->ebay_prepare_variations_auto_matched = '{#i18n:attributes_matching_type_auto_matched#}';
MLI18n::gi()->ebay_prepare_variations_free_text_add = '{#i18n:attributes_matching_type_free_text#}';
MLI18n::gi()->ebay_prepare_variations_reset_info = '{#i18n:attributes_matching_reset_matching_message#}';
MLI18n::gi()->ebay_prepare_variations_change_attribute_info = '{#i18n:attributes_matching_change_attribute_info#}';
MLI18n::gi()->ebay_prepare_variations_additional_attribute_label = '{#i18n:attributes_matching_custom_attributes#}';
MLI18n::gi()->ebay_prepare_variations_separator_line_label = '{#i18n:attributes_matching_option_separator#}';
MLI18n::gi()->ebay_prepare_variations_mandatory_fields_info = '{#i18n:attributes_matching_mandatory_fields_info#}';
MLI18n::gi()->ebay_prepare_variations_already_matched = '{#i18n:attributes_matching_already_matched#}';
MLI18n::gi()->ebay_prepare_variations_category_without_attributes_info = '{#i18n:attributes_matching_category_without_attributes_message#}';
MLI18n::gi()->ebay_prepare_variations_error_duplicated_custom_attribute_name = '{#i18n:form_action_default_duplicated_custom_attribute_name#}';
MLI18n::gi()->ebay_prepare_variations_choose_mp_value = '{#i18n:attributes_matching_option_marketplace_value#}';
MLI18n::gi()->ebay_prepare_variations_notice = '{#i18n:attributes_matching_prepared_different_notice#}';
MLI18n::gi()->ebay_varmatch_attribute_changed_on_mp = '{#i18n:attributes_matching_attribute_value_changed_from_marketplace_message#}';
MLI18n::gi()->ebay_varmatch_attribute_different_on_product = '{#i18n:attributes_matching_attribute_matched_different_global_message#}';
MLI18n::gi()->ebay_varmatch_attribute_deleted_from_mp = '{#i18n:attributes_matching_attribute_deleted_from_marketplace_message#}';
MLI18n::gi()->ebay_varmatch_attribute_value_deleted_from_mp = '{#i18n:attributes_matching_attribute_value_deleted_from_marketplace_message#}';
MLI18n::gi()->ebay_varmatch_attribute_deleted_from_shop = '{#i18n:attributes_matching_attribute_deleted_from_shop_message#}';

MLI18n::gi()->ebay_varmatch_define_name = 'Bitte geben Sie einen Bezeichner ein.';
MLI18n::gi()->ebay_varmatch_ajax_error = 'Ein Fehler ist aufgetreten.';
MLI18n::gi()->ebay_varmatch_all_select = '{#i18n:attributes_matching_option_all#}';
MLI18n::gi()->ebay_varmatch_please_select = '{#i18n:attributes_matching_option_please_select#}';
MLI18n::gi()->ebay_varmatch_auto_matchen = '{#i18n:attributes_matching_option_auto_match#}';
MLI18n::gi()->ebay_varmatch_reset_matching = '{#i18n:attributes_matching_option_reset_matching#}';
MLI18n::gi()->ebay_varmatch_delete_custom_title = 'Varianten-Matching-Gruppe l&ouml;schen';
MLI18n::gi()->ebay_varmatch_delete_custom_content = 'Wollen Sie die eigene Gruppe wirklich l&ouml;schen?<br />Alle zugeh&ouml;rigen Variantenmatchings werden dann ebenfalls gel&ouml;scht.';

MLI18n::gi()->ebay_prepare_variations_multiselect_hint = '{#i18n:attributes_matching_multi_select_hint#}';
MLI18n::gi()->ebay_prepare_verfiyproduct_error_1605109425 = 'Fehler bei der Validierung der Produkte: Das Produkt (SKU: {#sku#}) hat keine gültigen Varianten.';

