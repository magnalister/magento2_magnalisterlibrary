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

MLI18n::gi()->hood_prepare_features = array(
    'boldtitle' => 'Fettschrift in Artikellisten',
    'backgroundcolor' => 'Hintergrundfarbe in Artikellisten',
    'gallery' => 'Galerie Premium in Artikellisten',
    'category' => 'Top Angebot in Kategorie und Suche',
    'homepage' => 'Top-Angebot auf der Startseite',
    'homepageimage' => 'Top-Angebot mit Bild auf der Startseite',
    'xxlimage' => 'Mit der Option XXL-Foto werden Ihre Bilder noch detaillierter dargestellt',
    'noads' => 'Keine Werbung einblenden (bei Gold und Platin Shop immer aktiv und kostenlos)',
);

MLI18n::gi()->hood_prepare_apply = 'Neue Produkte erstellen';
MLI18n::gi()->ml_hood_no_conditions_applicable_for_cat = 'Diese Kategorie erlaubt keine Angabe des Artikelzustands.';
MLI18n::gi()->ml_hood_prepare_form_category_notvalid = 'Diese Kategorie ist ungültig';
MLI18n::gi()->add('hood_prepare_apply_form', array(
    'legend' => array(
        'details' => 'Artikeldetails',
        'pictures' => 'Einstellungen f&uuml;r Bilder',
        'auction' => 'Auktionseinstellungen',
        'categories' => 'Hood.de-Kategorie',
        'variationmatching' => array('Hood.de Attribut', 'Attribut- und Attributswert-Matching'),
        'variationmatchingoptional' => array('Hood.de Optionale Attribute', 'Attribut- und Attributswert-Matching'),
        'variationmatchingcustom' => array('Hood.de Maßgeschneidert Attribute', 'Attribut- und Attributswert-Matching'),
        'shipping' => 'Versand',
    ),
    'field' => array(
        'title' => array(
            'label' => 'Produktname',
            'hint' => 'Titel max. 85 Zeichen<br />Erlaubte Platzhalter:<br />#BASEPRICE# - Grundpreis<br />Bitte dazu den <span style="color:#e31a1c;">Info-Text in der Konfiguration</span> (bei Template Produktname) beachten.',
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
        'manufacturer' => array(
            'label' => 'Artikel Hersteller',
            'hint' => '',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Artikel Hersteller immer aktuell aus Web-Shop &uuml;bernehmen',
                )
            )
        ),
        
        'manufacturerpartnumber' => array(
            'label' => 'Modellnummer',
            'hint' => '',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Modellnummer immer aktuell aus Web-Shop &uuml;bernehmen',
                )
            )
   
        ),
        
        
        'images' => array(
            'label' => 'Hood.de-Bild',
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
                Sollten Sie Variantenbilder an Ihren Artikel gepflegt haben, werden diese mit Aktivierung von "Bilderpaket" zu Hood.de übermittelt.<br>
                Hierbei läßt Hood.de nur eine zu verwendende Varianten-Ebene zu (wählen Sie z. B. "Farbe", so zeigt Hood.de jeweils ein anderes Bild an, wenn der Käufer eine andere Farbe auswählt).<br>
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
        'shortdescription' => array(
            'label' => 'Kurzbeschreibung',
            'hint' => 'Maximal 500 Zeichen',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Kurzbeschreibung immer aktuell aus Web-Shop &uuml;bernehmen',
                )
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
        'buyitnowprice' => array(
            'optional' => array(
                'select' => array(
                    'true' => 'Sofortkaufen aktivieren',
                    'false' => 'Kein Sofortkaufen',
                )
            )
        ),
        'listingtype' => array(
            'label' => 'Art der Auktion',
            'hint' => 'Art der Auktion',
        ),
        'listingduration' => array(
            'label' => 'Laufzeit',
            'hint' => 'Dauer der Auktion',
        ),
      
        'paymentmethods' => array(
            'label' => 'Zahlungsarten',
            'hint' => 'Angebotene Zahlungsarten',
            'help' => 'Voreinstellung f&uuml;r Zahlungsarten (Mehrfach-Auswahl mit Strg+Klick). Auswahl nach Vorgabe von Hood.de.',
        ),
        'conditiontype' => array(
            'label' => 'Artikelzustand',
            'hint' => 'Zustand des Artikels (wird in den meisten Kategorien bei Hood.de angezeigt)',
        ),
        'privatelisting' => array(
            'label' => 'Privat-Listing',
            'hint' => 'Wenn aktiv, kann die Käufer / Bieterliste nicht von Dritten eingesehen werden <span style="color:#e31a1c">kostenpflichtig</span>',
            'valuehint' => 'Käufer / Bieterliste nicht öffentlich',
        ),
        
        'hitcounter' => array(
            'label' => 'Besucherz&auml;hler',
            'hint' => '',
        ),
        'starttime' => array(
            'label' => 'Startzeit<br />(falls vorbelegt)',
            'hint' => 'Im Normalfall ist ein Hood.de-Artikel sofort nach dem Hochladen aktiv. Aber wenn Sie dieses Feld füllen, erst ab Startzeit (<span style="color:#e31a1c">kostenpflichtig</span>).',
        ),
         'noidentifierflag' => array(
            'label' => 'Sonderanfertigung',
            'hint' => 'Diese Einstellung erlaubt es, Artikel ohne EAN, ISBN, MPN oder Marke zu listen. <span style="color:#e31a1c">Bitte nur in Ausnahmefällen verwenden. Ein generelles Setzen kann zur Sperrung des Hood.de Accounts führen.</span>.',
        ),
        
         'age' => array(
            'label' => 'Altersbeschränkung',
            'hint' => '',
   
        ),
         'fsk' => array(
            'label' => 'FSK',
            'hint' => '',
   
        ),
         'usk' => array(
            'label' => 'USK',
            'hint' => '',
   
        ),
        'features' => array(
            'label' => 'Zusatzoptionen',
            'hint' => '<span style="color:#e31a1c">Kostenpflichtig auf Hood.de</span>',
        ),
       
        'categories' => array(
            'label' => 'Hood.de-Kategorie',
            'hint' => '',
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
            'label' => 'Hood.de Store Kategorie',
            'hint' => 'W&auml;hlen',
        ),
        'storecategory2' => array(
            'label' => 'Sekundäre Store Kategorie',
            'hint' => 'W&auml;hlen',
        ),
        'storecategory3' => array(
            'label' => 'Dritte Store Kategorie',
            'hint' => 'W&auml;hlen',
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
                    'labelNegativ' => 'Zeit bis Versand immer aus Hood.de-Konfiguration nehmen',
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
            'label' => 'Hood.de Kategorie',
        ),
        'variationgroups.value' => array(
            'label' => '1. Marktplatz-Kategorie:',
        ),
        'webshopattribute' => array(
            'label' => 'Web-Shop Attribut',
        ),
        'attributematching' => array(
            'matching' => array(
                'titlesrc' => 'Shop-Wert',
                'titledst' => 'Hood.de-Wert',
            ),
        ),
    )
), false);

MLI18n::gi()->add('hood_prepare_variations', array(
    'legend' => array(
        'variations' => 'Kategorie von Hood.de ausw&auml;hlen',
        'attributes' => 'Attributsnamen von Hood.de ausw&auml;hlen',
        'variationmatching' => array('Hood.de Attribut', 'Attribut- und Attributswert-Matching'),
        'variationmatchingoptional' => array('Hood.de Optionale Attribute', 'Attribut- und Attributswert-Matching'),
        'variationmatchingcustom' => array('Hood.de Maßgeschneidert Attribute', 'Attribut- und Attributswert-Matching'),
        'action' => '{#i18n:form_action_default_legend#}',
    ),
    'field' => array(
        'variationgroups' => array(
            'label' => 'Hood.de Kategorie',
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
            'label' => 'Web-Shop Attribut',
        ),
        'saveaction' => array(
            'label' => 'SPEICHERN UND SCHLIESSEN',
        ),
        'resetaction' => array(
            'label' => '{#i18n:hood_varmatch_reset_matching#}',
            'confirmtext' => '{#i18n:attributes_matching_reset_matching_message#}',
        ),
        'attributematching' => array(
            'matching' => array(
                'titlesrc' => 'Shop-Wert',
                'titledst' => 'Hood.de-Wert',
            ),
        ),
    ),
), false);

MLI18n::gi()->hood_prepareform_max_length_part1 = 'Max length of';
MLI18n::gi()->hood_prepareform_max_length_part2 = 'attribute is';
MLI18n::gi()->hood_prepareform_category = 'Category attribute is mandatory.';
MLI18n::gi()->hood_prepareform_title = 'Bitte geben Sie einen Titel an.';
MLI18n::gi()->hood_prepareform_description = 'Bitte geben Sie eine Artikelbeschreibung an.';
MLI18n::gi()->hood_prepareform_category_attribute = ' (Kategorie Attribute) ist erforderlich und kann nicht leer sein.';
MLI18n::gi()->hood_category_no_attributes= 'Es sind keine Attribute f&uuml;r diese Kategorie vorhanden.';
MLI18n::gi()->hood_prepare_variations_title = 'Attributes Matching';
MLI18n::gi()->hood_prepare_variations_groups = 'Hood.de Gruppen';
MLI18n::gi()->hood_prepare_variations_groups_custom = 'Eigene Gruppen';
MLI18n::gi()->hood_prepare_variations_groups_new = 'Eigene Gruppe anlegen';
MLI18n::gi()->hood_prepare_match_variations_no_selection = '{#i18n:attributes_matching_matching_variations_no_category_selection#}';
MLI18n::gi()->hood_prepare_match_variations_custom_ident_missing = 'Bitte w&auml;hlen Sie Bezeichner.';
MLI18n::gi()->hood_prepare_match_variations_attribute_missing = 'Bitte w&auml;hlen Sie Attributsnamen.';
MLI18n::gi()->hood_prepare_match_variations_not_all_matched = 'Bitte weisen Sie allen Hood.de Attributen ein Shop-Attribut zu.';
MLI18n::gi()->hood_prepare_match_notice_not_all_auto_matched = 'Es konnten nicht alle ausgewählten Werte gematcht werden. Nicht-gematchte Werte werden weiterhin in den DropDown-Feldern angezeigt. Bereits gematchte Werte werden in der Produktvorbereitung berücksichtigt.';
MLI18n::gi()->hood_prepare_match_variations_saved = '{#i18n:attributes_matching_prepare_variations_saved#}';
MLI18n::gi()->hood_prepare_variations_saved = '{#i18n:attributes_matching_matching_variations_saved#}';
MLI18n::gi()->hood_prepare_match_variations_delete = 'Wollen Sie die eigene Gruppe wirklich l&ouml;schen? Alle zugeh&ouml;rigen Variantenmatchings werden dann ebenfalls gel&ouml;scht.';
MLI18n::gi()->hood_error_checkin_variation_config_empty = 'Variationen sind nicht konfiguriert.';
MLI18n::gi()->hood_error_checkin_variation_config_cannot_calc_variations = 'Es konnten keine Variationen errechnet werden.';
MLI18n::gi()->hood_error_checkin_variation_config_missing_nameid = 'Es konnte keine Zuordnung f&uuml;r das Shop Attribut "{#Attribute#}" bei der gew&auml;hlten Ayn24 Variantengruppe "{#MpIdentifier#}" f&uuml;r den Varianten Artikel mit der SKU "{#SKU#}" gefunden werden.';
// Matching
MLI18n::gi()->hood_prepare_variations_free_text = '{#i18n:attributes_matching_option_free_text#}';
MLI18n::gi()->hood_prepare_variations_additional_category = '{#i18n:attributes_matching_additional_category#}';
MLI18n::gi()->hood_prepare_variations_error_text = '{#i18n:attributes_matching_attribute_required_error#}';
MLI18n::gi()->hood_prepare_variations_error_missing_value = '{#i18n:attributes_matching_attribute_required_missing_value#}';
MLI18n::gi()->hood_prepare_variations_error_free_text = '{#i18n:attributes_matching_attribute_free_text_error#}';
MLI18n::gi()->hood_prepare_variations_matching_table = '{#i18n:attributes_matching_table_matched_headline#}';
MLI18n::gi()->hood_prepare_variations_manualy_matched = '{#i18n:attributes_matching_type_manually_matched#}';
MLI18n::gi()->hood_prepare_variations_auto_matched = '{#i18n:attributes_matching_type_auto_matched#}';
MLI18n::gi()->hood_prepare_variations_free_text_add = '{#i18n:attributes_matching_type_free_text#}';
MLI18n::gi()->hood_prepare_variations_reset_info = '{#i18n:attributes_matching_reset_matching_message#}';
MLI18n::gi()->hood_prepare_variations_change_attribute_info = '{#i18n:attributes_matching_change_attribute_info#}';
MLI18n::gi()->hood_prepare_variations_additional_attribute_label = '{#i18n:attributes_matching_custom_attributes#}';
MLI18n::gi()->hood_prepare_variations_separator_line_label = '{#i18n:attributes_matching_option_separator#}';
MLI18n::gi()->hood_prepare_variations_mandatory_fields_info = '{#i18n:attributes_matching_mandatory_fields_info#}';
MLI18n::gi()->hood_prepare_variations_already_matched = '{#i18n:attributes_matching_already_matched#}';
MLI18n::gi()->hood_prepare_variations_category_without_attributes_info = '{#i18n:attributes_matching_category_without_attributes_message#}';
MLI18n::gi()->hood_prepare_variations_error_duplicated_custom_attribute_name = '{#i18n:form_action_default_duplicated_custom_attribute_name#}';
MLI18n::gi()->hood_prepare_variations_choose_mp_value = '{#i18n:attributes_matching_option_marketplace_value#}';
MLI18n::gi()->hood_prepare_variations_notice = '{#i18n:attributes_matching_prepared_different_notice#}';
MLI18n::gi()->hood_varmatch_attribute_changed_on_mp = '{#i18n:attributes_matching_attribute_value_changed_from_marketplace_message#}';
MLI18n::gi()->hood_varmatch_attribute_different_on_product = '{#i18n:attributes_matching_attribute_matched_different_global_message#}';
MLI18n::gi()->hood_varmatch_attribute_deleted_from_mp = '{#i18n:attributes_matching_attribute_deleted_from_marketplace_message#}';
MLI18n::gi()->hood_varmatch_attribute_value_deleted_from_mp = '{#i18n:attributes_matching_attribute_value_deleted_from_marketplace_message#}';
MLI18n::gi()->hood_varmatch_attribute_deleted_from_shop = '{#i18n:attributes_matching_attribute_deleted_from_shop_message#}';

MLI18n::gi()->hood_varmatch_define_name = 'Bitte geben Sie einen Bezeichner ein.';
MLI18n::gi()->hood_varmatch_ajax_error = 'Ein Fehler ist aufgetreten.';
MLI18n::gi()->hood_varmatch_all_select = 'Alle';
MLI18n::gi()->hood_varmatch_please_select = 'Bitte w&auml;hlen...';
MLI18n::gi()->hood_varmatch_auto_matchen = 'Auto-matchen';
MLI18n::gi()->hood_varmatch_reset_matching = 'Matchen aufheben';
MLI18n::gi()->hood_varmatch_delete_custom_title = 'Varianten-Matching-Gruppe l&ouml;schen';
MLI18n::gi()->hood_varmatch_delete_custom_content = 'Wollen Sie die eigene Gruppe wirklich l&ouml;schen?<br />Alle zugeh&ouml;rigen Variantenmatchings werden dann ebenfalls gel&ouml;scht.';

MLI18n::gi()->hood_prepare_variations_multiselect_hint = 'Drücke CMD und wählen alle zur Übermittlung gewünschten Attribute';
