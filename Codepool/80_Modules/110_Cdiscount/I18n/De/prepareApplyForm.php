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

MLI18n::gi()->add('cdiscount_prepare_apply_form',array(
    'legend' => array(
        'details' => 'Produktdetails',
        'categories' => 'Kategorie',
        'variationmatching' => array('{#i18n:attributes_matching_required_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingoptional' => array('{#i18n:attributes_matching_optional_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingcustom' => array('{#i18n:attributes_matching_custom_attributes#}', '{#i18n:attributes_matching_title#}'),
        'unit' => 'Allgemeine Einstellungen',
    ),
    'field' => array(
        'variationgroups' => array(
            'label' => 'Cdiscount Kategorien',
        ),
        'variationthemecode' => array(
            'label' => 'Variations <span class="bull">•</span>',
        ),
        'variationthemealldata' => array(
            'label' => '',
        ),
        'variationgroups.value' => array(
            'label' => '1. Marktplatz-Kategorie:',
            'catinfo' => 'Info: Für die hellgrau-markierten Kategorien sind Sie von Cdiscount nicht freigeschaltet. Bitte wenden Sie sich zur Freischaltung direkt an Cdiscount.',
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
        'title' => array(
            'label' => 'Titel',
            'hint' => 'Titel max. 132 Zeichen',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Titel immer aktuell aus Web-Shop verwenden',
                ),
            ),
        ),
        'subtitle' => array(
            'label' => 'Warenkorb/Rechnungs-Titel',
            'hint' => 'Titel der im Warenkorb und auf der Rechnung angezeigt wird (max. 30 Zeichen)',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Warenkorb/Rechnungs-Titel immer aktuell aus Web-Shop verwenden',
                ),
            ),
        ),
        'description' => array(
            'label' => 'Beschreibung',
            'hint'  => 'Maximal 420 Zeichen.',
            'help'  => 'The product description must describe the product. It appears at the top of the product sheet under the wording. It must not content offers data. (Guarantuee, price, shipping, packaging...), html code or others codes.',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Beschreibung immer aktuell aus Web-Shop verwenden',
                ),
            ),
        ),
        'marketingdescription' => array(
            'label' => 'Marketing Beschreibung',
            'hint'  => 'Maximal 5000 Zeichen.',
            'help'  => 'Die Marketingbeschreibung muss das Produkt beschreiben. Sie erscheint in der Registerkarte "Présentation produit". Sie darf keine Angebotsdaten enthalten (Garantie, Preis, Versand, Verpackung ...). HTML-Code ist erlaubt.',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Marketing Beschreibung immer aktuell aus Web-Shop verwenden',
                ),
            ),
        ),
        'images' => array(
            'label' => 'Produktbilder',
            'hint' => 'Seitens Cdiscount wird der Upload von maximal 4 Bildern pro Artikel zugelassen.<br/><br/>Dar&uuml;ber hinaus gilt: F&uuml;r jede hochgeladene Variante sind ebenfalls maximal vier Bilder erlaubt.',
            'optional' => array(
                'checkbox' => array(
                    'labelNegativ' => 'Bilder immer aktuell aus Web-Shop verwenden',
                ),
            )
        ),
        'price' => array(
            'label' => 'Preis',
        ),
        'itemcondition' => array(
            'label' => 'Zustand',
        ),
        'preparationtime' => array(
            'label' => 'Preparation Time (in days 1-10)',
            'help' => 'Preparation time for deliver product. it must be in days between 1 and 10.',
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
        'comment' => array(
            'label' => 'Hinweise zu Ihrem Artikel',
            'hint'  => 'Maximal 200 Zeichen.',
        ),
    ),
)
,false);

MLI18n::gi()->add('cdiscount_prepare_variations', array(
    'legend' => array(
        'variations' => 'Variantengruppe von Cdiscount ausw&auml;hlen',
        'attributes' => 'Attributsnamen von Cdiscount ausw&auml;hlen',
        'variationmatching' => array('{#i18n:attributes_matching_required_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingoptional' => array('{#i18n:attributes_matching_optional_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingcustom' => array('{#i18n:attributes_matching_custom_attributes#}', '{#i18n:attributes_matching_title#}'),
        'action' => '{#i18n:form_action_default_legend#}',
    ),
    'field' => array(
        'variationgroups' => array(
            'label' => 'Variantengruppe',
        ),
        'variationgroups.value' => array(
            'label' => '1. Marktplatz-Kategorie:',
            'catinfo' => 'Info: Für die hellgrau-markierten Kategorien sind Sie von Cdiscount nicht freigeschaltet. Bitte wenden Sie sich zur Freischaltung direkt an Cdiscount.',
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
            'label' => '{#i18n:cdiscount_varmatch_reset_matching#}',
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

MLI18n::gi()->cdiscount_prepareform_max_length_part1 = 'Max length of';
MLI18n::gi()->cdiscount_prepareform_max_length_part2 = 'attribute is';
MLI18n::gi()->cdiscount_prepareform_category = 'Bitte wählen Sie eine Kategorie aus.';
MLI18n::gi()->cdiscount_prepareform_title = 'Bitte geben Sie einen Titel an.';
MLI18n::gi()->cdiscount_prepareform_subtitle = 'Bitte geben Sie einen Warenkorb/Rechnungs-Titel an.';
MLI18n::gi()->cdiscount_prepareform_description = 'Bitte geben Sie eine Artikelbeschreibung an.';
MLI18n::gi()->cdiscount_prepareform_category_attribute = ' (Kategorie Attribute) ist erforderlich und kann nicht leer sein.';
MLI18n::gi()->cdiscount_category_no_attributes= 'Es sind keine Attribute f&uuml;r diese Kategorie vorhanden.';
MLI18n::gi()->cdiscount_prepare_variations_title = '{#i18n:attributes_matching_tab_title#}';
MLI18n::gi()->cdiscount_prepare_variations_groups = 'Cdiscount Gruppen';
MLI18n::gi()->cdiscount_prepare_variations_groups_custom = 'Eigene Gruppen';
MLI18n::gi()->cdiscount_prepare_variations_groups_new = 'Eigene Gruppe anlegen';
MLI18n::gi()->cdiscount_prepare_match_variations_no_selection = '{#i18n:attributes_matching_matching_variations_no_category_selection#}';
MLI18n::gi()->cdiscount_prepare_match_variations_custom_ident_missing = 'Bitte w&auml;hlen Sie Bezeichner.';
MLI18n::gi()->cdiscount_prepare_match_variations_attribute_missing = 'Bitte w&auml;hlen Sie Attributsnamen.';
MLI18n::gi()->cdiscount_prepare_match_variations_category_missing = 'Bitte w&auml;hlen Sie Variantengruppe.';
MLI18n::gi()->cdiscount_prepare_match_variations_not_all_matched = 'Bitte weisen Sie allen Cdiscount Attributen ein Shop-Attribut zu.';
MLI18n::gi()->cdiscount_prepare_match_notice_not_all_auto_matched = 'Es konnten nicht alle ausgewählten Werte gematcht werden. Nicht-gematchte Werte werden weiterhin in den DropDown-Feldern angezeigt. Bereits gematchte Werte werden in der Produktvorbereitung berücksichtigt.';
MLI18n::gi()->cdiscount_prepare_match_variations_saved = '{#i18n:attributes_matching_prepare_variations_saved#}';
MLI18n::gi()->cdiscount_prepare_variations_saved = '{#i18n:attributes_matching_matching_variations_saved#}';
MLI18n::gi()->cdiscount_prepare_variations_reset_success  = 'Das Matching wurde aufgehoben.';
MLI18n::gi()->cdiscount_prepare_match_variations_delete = 'Wollen Sie die eigene Gruppe wirklich l&ouml;schen? Alle zugeh&ouml;rigen Variantenmatchings werden dann ebenfalls gel&ouml;scht.';
MLI18n::gi()->cdiscount_error_checkin_variation_config_empty = 'Variationen sind nicht konfiguriert.';
MLI18n::gi()->cdiscount_error_checkin_variation_config_cannot_calc_variations = 'Es konnten keine Variationen errechnet werden.';
MLI18n::gi()->cdiscount_error_checkin_variation_config_missing_nameid = 'Es konnte keine Zuordnung f&uuml;r das Shop Attribut "{#Attribute#}" bei der gew&auml;hlten Ayn24 Variantengruppe "{#MpIdentifier#}" f&uuml;r den Varianten Artikel mit der SKU "{#SKU#}" gefunden werden.';
MLI18n::gi()->cdiscount_prepare_variations_free_text = '{#i18n:attributes_matching_option_free_text#}';
MLI18n::gi()->cdiscount_prepare_variations_additional_category = '{#i18n:attributes_matching_additional_category#}';
MLI18n::gi()->cdiscount_prepare_variations_error_text = '{#i18n:attributes_matching_attribute_required_error#}';
MLI18n::gi()->cdiscount_prepare_variations_error_empty_custom_attribute_name = '{#i18n:form_action_default_empty_custom_attribute_name#}';
MLI18n::gi()->cdiscount_prepare_variations_error_maximal_number_custom_attributes_exceeded = '{#i18n:form_action_default_maximal_number_custom_attributes_exceeded#}';
MLI18n::gi()->cdiscount_prepare_variations_theme_mandatory_error = 'Please choose variations option';
MLI18n::gi()->cdiscount_prepare_variations_error_duplicated_custom_attribute_name = '{#prepare_variations_theme_mandatory_error#}';
MLI18n::gi()->cdiscount_prepare_variations_error_missing_value = '{#i18n:attributes_matching_attribute_required_missing_value#}';
MLI18n::gi()->cdiscount_prepare_variations_error_free_text = '{#i18n:attributes_matching_attribute_free_text_error#}';
MLI18n::gi()->cdiscount_prepare_variations_matching_table = '{#i18n:attributes_matching_table_matched_headline#}';
MLI18n::gi()->cdiscount_prepare_variations_manualy_matched = '{#i18n:attributes_matching_type_manually_matched#}';
MLI18n::gi()->cdiscount_prepare_variations_auto_matched = '{#i18n:attributes_matching_type_auto_matched#}';
MLI18n::gi()->cdiscount_prepare_variations_free_text_add = '{#i18n:attributes_matching_type_free_text#}';
MLI18n::gi()->cdiscount_prepare_variations_reset_info = '{#i18n:attributes_matching_reset_matching_message#}';
MLI18n::gi()->cdiscount_prepare_variations_change_attribute_info = '{#i18n:attributes_matching_change_attribute_info#}';
MLI18n::gi()->cdiscount_prepare_variations_additional_attribute_label = '{#i18n:attributes_matching_custom_attributes#}';
MLI18n::gi()->cdiscount_prepare_variations_separator_line_label = '{#i18n:attributes_matching_option_separator#}';
MLI18n::gi()->cdiscount_prepare_variations_mandatory_fields_info = '{#i18n:attributes_matching_mandatory_fields_info#}';
MLI18n::gi()->cdiscount_prepare_variations_category_without_attributes_info = '{#i18n:attributes_matching_category_without_attributes_message#}';
MLI18n::gi()->cdiscount_prepare_variations_mandatory_fields_popup = 'Size and color attributes are mandatory for Cdiscount variations.<br> If you want your item to be uploaded as item with variations, please provide both size and color. <br>Otherwise if one of these two attributes is missing, your variations will be uploaded as separate items with attribute list in item title (e.g. Item title "Nike T-Shirt Size: M").';

MLI18n::gi()->cdiscount_prepare_variations_choose_mp_value = '{#i18n:attributes_matching_option_marketplace_value#}';
MLI18n::gi()->cdiscount_prepare_variations_notice = '{#i18n:attributes_matching_prepared_different_notice#}';
MLI18n::gi()->cdiscount_varmatch_attribute_changed_on_mp = '{#i18n:attributes_matching_attribute_value_changed_from_marketplace_message#}';
MLI18n::gi()->cdiscount_varmatch_attribute_different_on_product = '{#i18n:attributes_matching_attribute_matched_different_global_message#}';
MLI18n::gi()->cdiscount_varmatch_attribute_deleted_from_mp = '{#i18n:attributes_matching_attribute_deleted_from_marketplace_message#}';
MLI18n::gi()->cdiscount_varmatch_attribute_deleted_from_shop = '{#i18n:attributes_matching_attribute_deleted_from_shop_message#}';
MLI18n::gi()->cdiscount_varmatch_attribute_value_deleted_from_mp = '{#i18n:attributes_matching_attribute_value_deleted_from_marketplace_message#}';
MLI18n::gi()->cdiscount_varmatch_attribute_value_deleted_from_shop = 'Dieser Attributswert wurde von shop gelöscht oder geändert.';
MLI18n::gi()->cdiscount_prepare_variations_already_matched = '{#i18n:attributes_matching_already_matched#}';

MLI18n::gi()->cdiscount_varmatch_define_name = 'Bitte geben Sie einen Bezeichner ein.';
MLI18n::gi()->cdiscount_varmatch_ajax_error = 'Ein Fehler ist aufgetreten.';
MLI18n::gi()->cdiscount_varmatch_all_select = '{#i18n:attributes_matching_option_all#}';
MLI18n::gi()->cdiscount_varmatch_please_select = '{#i18n:attributes_matching_option_please_select#}';
MLI18n::gi()->cdiscount_varmatch_auto_matchen = '{#i18n:attributes_matching_option_auto_match#}';
MLI18n::gi()->cdiscount_varmatch_reset_matching = '{#i18n:attributes_matching_option_reset_matching#}';
MLI18n::gi()->cdiscount_varmatch_delete_custom_title = 'Varianten-Matching-Gruppe l&ouml;schen';
MLI18n::gi()->cdiscount_prepare_variations_multiselect_hint = '{#i18n:attributes_matching_multi_select_hint#}';
