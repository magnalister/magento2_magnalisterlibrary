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

MLI18n::gi()->add('amazon_prepare_apply_form', array(
    'legend'=>array(
        'category' => 'Kategorie',
        'details' => 'Details',
        'variations' => 'Hauptkategorie von Amazon ausw&auml;hlen',
        'attributes' => 'Attributsnamen von Amazon ausw&auml;hlen',
        'variationmatching' => array('{#i18n:attributes_matching_required_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingoptional' => array('{#i18n:attributes_matching_optional_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingcustom' => array('{#i18n:attributes_matching_custom_attributes#}', '{#i18n:attributes_matching_title#}'),
        'moredetails' => 'Weitere Details (Empfohlen)',
        'common' => 'Allgemeine Einstellungen',
        'b2b' => 'Amazon Business (B2B)',
    ),
    'field' => array(
        'variationthemecode' => array(
            'label' => 'Varianten-Design <span class="bull">•</span>',
            'hint' => '',
        ),
        'variationthemealldata' => array(
            'label' => '',
        ),
        'variationgroups.value' => array(
            'label' => 'Hauptkategorie <span class="bull">•</span>',
        ),
        'producttype' => array(
            'label' => 'Unterkategorie <span class="bull">•</span>',
            'hint' => '(Produkttyp)',
        ),
        'browsenodes' => array(
            'label' => 'Browsenodes <span class="bull">•</span>',
            'hint' => '',
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
        'itemtitle'=>array(
            'label' => 'Produktname <span class="bull">•</span>',
            'hint' => '',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Artikelbeschreibung immer aktuell aus Web-Shop verwenden',
                ),
            ),
        ),
        'manufacturer' => array(
            'label' => 'Artikelhersteller <span class="bull">•</span>',
            'hint' => 'Hersteller des Produktes',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Artikelhersteller immer aktuell aus Web-Shop verwenden',
                ),
            ),
        ),
        'brand' => array(
            'label' => 'Marke <span class="bull">•</span>',
            'hint' => 'Marke oder Hersteller des Produktes',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Marke oder Hersteller immer aktuell aus Web-Shop verwenden',
                ),
            ),
        ),
        'manufacturerpartnumber' => array(
            'label' => 'Modellnummer <span class="bull">•</span>',
            'hint' => 'Geben Sie die Modellnummer des Herstellers für das Produkt an.',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Modellnummer immer aktuell aus Web-Shop verwenden',
                ),
            ),
        ),
        'ean' => array(
            'hint' => 'Nicht relevant, wenn an den Varianten {#Type#} hinterlegt ist',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => '{#Type#} immer aktuell aus Web-Shop verwenden',
                ),
            ),
        ),
        'images' => array(
            'label' => 'Produktbilder',
            'hint' => 'Maximal 9 Produktbilder',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Bilder immer aktuell aus Web-Shop verwenden',
                ),
            ),
        ),
        'bulletpoints' => array(
            'label' => 'Bulletpoints',
            'hint' => 'Key-Features des Artikels (z. B. "Vergoldete Armaturen", "Extrem edles Design")<br /><br />Diese Daten werden aus {#i18n:sAmazon_product_bolletpoints_fieldName#} gezogen und müssen dort mit Kommas getrennt sein.<br />Maximal je 500 Zeichen.',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Bulletpoints immer aktuell aus Web-Shop verwenden (Metadescription)',
                ),
            ),
        ),
        'description' => array(
            'label' => 'Produktbeschreibung',
            'hint' => 'Maximal 2000 Zeichen. Einige HTML-Tags und deren Attribute sind erlaubt. Diese Zählen zu den 2000 Zeichen dazu.',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Produktbeschreibung immer aktuell aus Web-Shop verwenden',
                ),
            ),
        ),
        'keywords' => array(
            'label' => 'Allgemeine Schlüsselwörter',
            'help' => '<h3>Produkt-Ranking mit Amazon Schlüsselwörtern optimieren</h3>
<br>
Allgemeine Schlüsselwörter dienen zur Optimierung des Rankings und zur besseren Filterbarkeit auf Amazon. Sie werden während des magnalister Produkt-Uploads unsichtbar am Produkt hinterlegt.
<br><br>
<h2>Optionen für die Übergabe von Allgemeinen Schlüsselwörtern</h2>
1. Keywords immer aktuell aus Web-Shop verwenden (Metakeywords): 
<br><br>
Dabei werden die Schlüsselwörter aus dem Metakeywords-Feld des jeweiligen Produktes im Web-Shop gezogen und an Amazon übermittelt.
<br><br>
2. Allgemeine Schlüsselwörter in magnalister manuell eintragen: 
<br><br>
Wenn Sie nicht die am Web-Shop-Produkt hinterlegten Metakeywords übernehmen möchten, können Sie eigene Schlüsselwörter in diesem Freitextfeld eintragen.
<br><br>
<b>Wichtige Hinweise:</b>
<br><ul>
<li>Wenn Sie Schlüsselwörter manuell eintragen, trennen Sie sie mit einem Leerzeichen (nicht mit Komma!) und achten Sie darauf, dass Sie insgesamt 250 Bytes (Faustregel: 1 Zeichen = 1 Byte. Ausnahme: Sonderzeichen wie Ä, Ö, Ü = 2 Byte) nicht überschreiten.
</li><li>
Wenn im Metakeywords-Feld des Web-Shop-Produkts die Keywords kommagetrennt vorliegen, wandelt magnalister beim Produkt-Upload die Kommas automatisch in Leerzeichen um. Auch hier gilt die Begrenzung auf 250 Bytes.
</li><li>
Wird die zulässige Byte-Zahl überschritten, gibt Amazon nach dem Produkt-Upload möglicherweise eine Fehlermeldung zurück, die Sie im magnalister Fehler-Log einsehen können (Wartezeit bis zu 60 Minuten).
</li><li>
Übergabe von Platinum-Keywords: Sofern Sie Amazon Platin-Händler sind, informieren Sie den magnalister Support darüber. Wir schalten dann die Übergabe der Platinum-Keywords frei. Dabei greift magnalister auf die Allgemeinen Schlüsselbegriffe zurück und übermittelt diese 1:1 an Amazon. Allgemeine Schlüsselbegriffe und Platinum-Keywords sind also identisch.
</li><li>
Abweichende Platinum-Keywords übermitteln: Nutzen Sie das magnalister Attributs-Matching in der Produktvorbereitung. Wählen Sie dafür aus der Liste der verfügbaren Amazon Attribute “Platinum-Schlüsselwörter 1-5” und matchen Sie das entsprechende Webshop-Attribut.
</li><li>
Neben Allgemeinen Schlüsselwörtern gibt es weitere Amazon-relevante Keywords (z.B. Thesaurus Attributschlüsselwörter, Zielgruppen-Keywords oder Themenschlüsselwörter), die Sie ebenfalls über das Attributs-Matching an Amazon übergeben können.
</li></ul>
',
            'hint' => 'Bei manueller Eingabe zu beachten:
<br><br>
Einzelne Schlüsselwörter mit Leerzeichen (nicht mit Komma!) trennen
<br><br>
Alle Schlüsselwörter zusammen dürfen nicht größer als 250 Bytes sein (1 Zeichen = 1 Byte. Ausnahme: Sonderzeichen wie Ä, Ö, Ü = 2 Byte)
',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Keywords immer aktuell aus Web-Shop verwenden (Metakeywords)',
                ),
            ),
        ),
        'shippingtime' => array(
            'label' => 'Bearbeitungszeit (in Tagen)',
            'hint' => 'Die Zeit, die zwischen der Bestellaufgabe durch den Käufer bis zur Übergabe der Sendung vom Verkäufer an den Transporteur vergeht.',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Immer Wert aus Konfiguration nehmen',
                ),
            ),
        ),
        'shippingtemplate' => array(
            'label' => 'Verk&auml;uferversandgruppe',
            'hint' => 'Unter &quot;Konfiguration -&gt; Artikelvorbereitung&quot; k&ouml;nnen Sie die verschiedenen Versandgruppen anlegen'
        ),
        'bopisstores' => array(
            'label' => 'Produkt für "Click & Collect in store" aktivieren',
            'hint' => 'Bitte wählen Sie die Ladengeschäfte aus bei welchen Sie dieses Produkt für "Click & Collect in store" aktivieren wollen'
        ),
        'b2bactive' => array(
            'label' => 'Amazon B2B verwenden',
            'help' => 'Wenn aktiviert, k&ouml;nnen Artikel f&uuml;r den Business-to-Business Verkauf an Amazon &uuml;bermittelt werden, wie unten konfiguriert. <b>Bitte stellen Sie sicher, dass Ihr Amazon Konto f&uuml;r Amazon Business freigeschaltet ist.</b> Andernfalls wird das Hochladen von B2B-Artikeln zu Fehlern f&uuml;hren.',
            'help_matching' => 'Wenn aktiviert, werden die Einstellungen <br> aus der Konfiguration übernommen.',
            'notification' => 'Um Amazon Business zu nutzen, brauchen Sie eine Aktivierung in Ihrem Amazon-Konto.  <b>Bitte stellen Sie sicher, dass Ihr Amazon Konto f&uuml;r Amazon Business freigeschaltet ist.</b> Andernfalls wird das Hochladen von B2B-Artikeln zu Fehlern f&uuml;hren.<br>Um Ihr Konto f&uuml;r Amazon Business freizuschalten, folgen Sie bitte der Anleitung unter <a href="https://sellercentral.amazon.de/business/b2bregistration" target="_blank">diesem Link</a>.',
            'disabledNotification' => 'Um Amazon Business zu nutzen, aktivieren Sie es bitte zuerst in der Konfiguration.',
            'values' => array(
                'true' => 'Ja',
                'false' => 'Nein',
            ),
        ),
        'b2bsellto' => array(
            'label' => 'Verkaufen an',
            'help' => 'Wenn <i>B2B Only</i> ausgew&auml;hlt, werden hochgeladene Produkte nur f&uuml;r Gesch&auml;ftskunden sichtbar sein. Andernfalls sowohl f&uuml;r Gesch&auml;fts- als auch Privatkunden.',
            'values' => array(
                'b2b_b2c' => 'B2B und B2C',
                'b2b_only' => 'B2B Only',
            ),
        ),
        'b2bdiscounttype' => array(
            'label' => 'Staffelpreis-Berechnung',
            'help' => '<b>Staffelpreise</b><br>
                      Staffelpreise sind erm&auml;&szlig;igte Preise, die f&uuml;r Gesch&auml;ftskunden beim Kauf
                      gr&ouml;&szlig;erer St&uuml;ckzahlen verf&uuml;gbar sind. Verk&auml;ufer, die am Amazon 
                      Business Seller Program teilnehmen, k&ouml;nnen entsprechende Mindestmengen
                      und Preisabschl&auml;ge definieren.<br><br>
                      <b>Beispiel</b>:
                      F&uuml;r ein Produkt, das 100 &euro; kostet, k&ouml;nnten folgende
                      Prozent-Abschl&auml;ge (f&uuml;r Gesch&auml;ftskunden) definiert werden:
                      <table><tr>
                          <th style="background-color: #ddd;">Mindestmenge</th>
                          <th style="background-color: #ddd;">Abschlag</th>
                          <th style="background-color: #ddd;">Endpreis pro St&uuml;ck</th>
                      <tr><td>5 (oder mehr)</td><td style="text-align: right;">10</td><td style="text-align: right;">$90</td></tr>
                      <tr><td>8 (oder mehr)</td><td style="text-align: right;">12</td><td style="text-align: right;">$88</td></tr>
                      <tr><td>12 (oder mehr)</td><td style="text-align: right;">15</td><td style="text-align: right;">$85</td></tr>
                      <tr><td>20 (oder mehr)</td><td style="text-align: right;">20</td><td style="text-align: right;">$80</td></tr>
                      </table>',
            'values' => array(
                '' => 'Nicht verwenden',
                'percent' => 'Prozent',
                'fixed' => 'Fixed',
            ),
        ),
        'b2bdiscounttier1' => array(
            'label' => 'Staffelpreis Ebene 1',
        ),
        'b2bdiscounttier2' => array(
            'label' => 'Staffelpreis Ebene 2',
        ),
        'b2bdiscounttier3' => array(
            'label' => 'Staffelpreis Ebene 3',
        ),
        'b2bdiscounttier4' => array(
            'label' => 'Staffelpreis Ebene 4',
        ),
        'b2bdiscounttier5' => array(
            'label' => 'Staffelpreis Ebene 5',
        ),
        'b2bdiscounttier1quantity' => array(
            'label' => 'St&uuml;ckzahl',
        ),
        'b2bdiscounttier2quantity' => array(
            'label' => 'St&uuml;ckzahl',
        ),
        'b2bdiscounttier3quantity' => array(
            'label' => 'St&uuml;ckzahl',
        ),
        'b2bdiscounttier4quantity' => array(
            'label' => 'St&uuml;ckzahl',
        ),
        'b2bdiscounttier5quantity' => array(
            'label' => 'St&uuml;ckzahl',
        ),
        'b2bdiscounttier1discount' => array(
            'label' => 'Rabatt',
        ),
        'b2bdiscounttier2discount' => array(
            'label' => 'Rabatt',
        ),
        'b2bdiscounttier3discount' => array(
            'label' => 'Rabatt',
        ),
        'b2bdiscounttier4discount' => array(
            'label' => 'Rabatt',
        ),
        'b2bdiscounttier5discount' => array(
            'label' => 'Rabatt',
        ),
    ),
), false);

MLI18n::gi()->add('amazon_prepare_variations', array(
    'legend' => array(
        'variations' => 'Hauptkategorie von Amazon ausw&auml;hlen',
        'attributes' => 'Attributsnamen von Amazon ausw&auml;hlen',
        'variationmatching' => array('{#i18n:attributes_matching_required_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingoptional' => array('{#i18n:attributes_matching_optional_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingcustom' => array('{#i18n:attributes_matching_custom_attributes#}', '{#i18n:attributes_matching_title#}'),
        'action' => '{#i18n:form_action_default_legend#}',
    ),
    'field' => array(
        'variationgroups.value' => array(
            'label' => 'Hauptkategorie',
        ),
        'customidentifier' => array(
            'label' => 'Unterkategorie',
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

MLI18n::gi()->amazon_varmatch_define_name = 'Bitte geben Sie einen Bezeichner ein.';
MLI18n::gi()->amazon_varmatch_ajax_error = 'Ein Fehler ist aufgetreten.';
MLI18n::gi()->amazon_varmatch_all_select = '{#i18n:attributes_matching_option_all#}';
MLI18n::gi()->amazon_varmatch_please_select = '{#i18n:attributes_matching_option_please_select#}';
MLI18n::gi()->amazon_varmatch_auto_matchen = '{#i18n:attributes_matching_option_auto_match#}';
MLI18n::gi()->amazon_varmatch_reset_matching = '{#i18n:attributes_matching_option_reset_matching#}';
MLI18n::gi()->amazon_varmatch_delete_custom_title = 'Varianten-Matching-Gruppe l&ouml;schen';
MLI18n::gi()->amazon_varmatch_delete_custom_content = 'Wollen Sie die eigene Gruppe wirklich l&ouml;schen?<br />Alle zugeh&ouml;rigen Variantenmatchings werden dann ebenfalls gel&ouml;scht.';
MLI18n::gi()->amazon_varmatch_attribute_changed_on_mp = '{#i18n:attributes_matching_attribute_value_changed_from_marketplace_message#}';
MLI18n::gi()->amazon_varmatch_attribute_different_on_product = '{#i18n:attributes_matching_attribute_matched_different_global_message#}';
MLI18n::gi()->amazon_varmatch_attribute_deleted_from_mp = '{#i18n:attributes_matching_attribute_deleted_from_marketplace_message#}';
MLI18n::gi()->amazon_varmatch_attribute_deleted_from_shop = '{#i18n:attributes_matching_attribute_deleted_from_shop_message#}';
MLI18n::gi()->amazon_varmatch_attribute_value_deleted_from_mp = '{#i18n:attributes_matching_attribute_value_deleted_from_marketplace_message#}';
MLI18n::gi()->amazon_varmatch_attribute_value_deleted_from_shop = 'Dieses Attribut wurde von shop gel&ouml;scht oder ge&auml;ndert. Matchings dazu wurden daher aufgehoben. Bitte matchen Sie bei Bedarf erneut auf ein geeignetes shop Attribut.';
MLI18n::gi()->amazon_varmatch_already_matched = '{#i18n:attributes_matching_already_matched#}';

MLI18n::gi()->amazon_category_attribut = '{#i18n:attributes_matching_marketplace_attribute#}';
MLI18n::gi()->amazon_shop_attribut = '{#i18n:attributes_matching_title#}';
MLI18n::gi()->amazon_web_shop_attribut = '{#i18n:attributes_matching_web_shop_attribute#}';
MLI18n::gi()->amazon_shop_select = '{#i18n:attributes_matching_shop_value#}';
MLI18n::gi()->amazon_marketplace_select = '{#i18n:attributes_matching_marketplace_value#}';
MLI18n::gi()->amazon_prepareform_max_length_part1 = 'Max length of';
MLI18n::gi()->amazon_prepareform_max_length_part2 = 'attribute is';
MLI18n::gi()->amazon_prepareform_category = 'Category attribute is mandatory.';
MLI18n::gi()->amazon_prepareform_title = 'Bitte geben Sie einen Titel an.';
MLI18n::gi()->amazon_prepareform_description = 'Bitte geben Sie eine Artikelbeschreibung an.';
MLI18n::gi()->amazon_prepareform_category_attribute = ' (Kategorie Attribut) ist erforderlich und kann nicht leer sein.';
MLI18n::gi()->amazon_category_no_attributes= 'Es sind keine Attribute f&uuml;r diese Kategorie vorhanden.';
MLI18n::gi()->amazon_prepare_variations_title = '{#i18n:attributes_matching_tab_title#}';
MLI18n::gi()->amazon_prepare_variations_groups = 'Amazon Gruppen';
MLI18n::gi()->amazon_prepare_variations_groups_custom = 'Eigene Gruppen';
MLI18n::gi()->amazon_prepare_variations_groups_new = 'Eigene Gruppe anlegen';
MLI18n::gi()->amazon_prepare_match_variations_no_selection = '{#i18n:attributes_matching_matching_variations_no_category_selection#}';
MLI18n::gi()->amazon_prepare_match_variations_custom_ident_missing = 'Bitte w&auml;hlen Sie Bezeichner.';
MLI18n::gi()->amazon_prepare_match_variations_attribute_missing = 'Bitte w&auml;hlen Sie Attributsnamen.';
MLI18n::gi()->amazon_prepare_match_variations_category_missing = 'Bitte w&auml;hlen Sie Variantengruppe.';
MLI18n::gi()->amazon_prepare_match_variations_not_all_matched = 'Bitte weisen Sie allen amazon Attributen ein Shop-Attribut zu.';
MLI18n::gi()->amazon_prepare_match_notice_not_all_auto_matched = 'Es konnten nicht alle ausgewählten Werte gematcht werden. Nicht-gematchte Werte werden weiterhin in den DropDown-Feldern angezeigt. Bereits gematchte Werte werden in der Produktvorbereitung berücksichtigt.';
MLI18n::gi()->amazon_prepare_match_variations_saved = '{#i18n:attributes_matching_prepare_variations_saved#}';
MLI18n::gi()->amazon_prepare_variations_saved = '{#i18n:attributes_matching_matching_variations_saved#}';
MLI18n::gi()->amazon_prepare_variations_reset_success = 'Das Matching wurde aufgehoben.';
MLI18n::gi()->amazon_prepare_match_variations_delete = 'Wollen Sie die eigene Gruppe wirklich l&ouml;schen? Alle zugeh&ouml;rigen Variantenmatchings werden dann ebenfalls gel&ouml;scht.';
MLI18n::gi()->amazon_error_checkin_variation_config_empty = 'Variationen sind nicht konfiguriert.';
MLI18n::gi()->amazon_error_checkin_variation_config_cannot_calc_variations = 'Es konnten keine Variationen errechnet werden.';
MLI18n::gi()->amazon_error_checkin_variation_config_missing_nameid = 'Es konnte keine Zuordnung f&uuml;r das Shop Attribut "{#Attribute#}" bei der gew&auml;hlten Ayn24 Variantengruppe "{#MpIdentifier#}" f&uuml;r den Varianten Artikel mit der SKU "{#SKU#}" gefunden werden.';
MLI18n::gi()->amazon_prepare_variations_free_text = '{#i18n:attributes_matching_option_free_text#}';
MLI18n::gi()->amazon_prepare_variations_additional_category = '{#i18n:attributes_matching_additional_category#}';
MLI18n::gi()->amazon_prepare_variations_error_text = '{#i18n:attributes_matching_attribute_required_error#}';
MLI18n::gi()->amazon_prepare_variations_error_empty_custom_attribute_name = '{#i18n:form_action_default_empty_custom_attribute_name#}';
MLI18n::gi()->amazon_prepare_variations_error_maximal_number_custom_attributes_exceeded = '{#i18n:form_action_default_maximal_number_custom_attributes_exceeded#}';
MLI18n::gi()->amazon_prepare_variations_theme_mandatory_error = 'Bitte wählen Sie das Varianten-Design.';
MLI18n::gi()->amazon_prepare_variations_error_duplicated_custom_attribute_name = '{#i18n:form_action_default_duplicated_custom_attribute_name#}';
MLI18n::gi()->amazon_prepare_variations_error_missing_value = '{#i18n:attributes_matching_attribute_required_missing_value#}';
MLI18n::gi()->amazon_prepare_variations_error_free_text = '{#i18n:attributes_matching_attribute_free_text_error#}';
MLI18n::gi()->amazon_prepare_variations_matching_table = '{#i18n:attributes_matching_table_matched_headline#}';
MLI18n::gi()->amazon_prepare_variations_manualy_matched = '{#i18n:attributes_matching_type_manually_matched#}';
MLI18n::gi()->amazon_prepare_variations_auto_matched = '{#i18n:attributes_matching_type_auto_matched#}';
MLI18n::gi()->amazon_prepare_variations_free_text_add = '{#i18n:attributes_matching_type_free_text#}';
MLI18n::gi()->amazon_prepare_variations_reset_info = '{#i18n:attributes_matching_reset_matching_message#}';
MLI18n::gi()->amazon_prepare_variations_change_attribute_info = '{#i18n:attributes_matching_change_attribute_info#}';
MLI18n::gi()->amazon_prepare_variations_additional_attribute_label = '{#i18n:attributes_matching_custom_attributes#}';
MLI18n::gi()->amazon_prepare_variations_separator_line_label = '{#i18n:attributes_matching_option_separator#}';
MLI18n::gi()->amazon_prepare_variations_mandatory_fields_info = '{#i18n:attributes_matching_mandatory_fields_info#}';
MLI18n::gi()->amazon_prepare_variations_category_without_attributes_info = '{#i18n:attributes_matching_category_without_attributes_message#}';
MLI18n::gi()->amazon_prepare_variations_choose_mp_value = '{#i18n:attributes_matching_option_marketplace_value#}';
MLI18n::gi()->amazon_prepare_variations_notice = '{#i18n:attributes_matching_prepared_different_notice#}';
MLI18n::gi()->amazon_prepare_variations_already_matched = '{#i18n:attributes_matching_already_matched#}';
MLI18n::gi()->amazon_prepare_variations_multiselect_hint = '{#i18n:attributes_matching_multi_select_hint#}';
