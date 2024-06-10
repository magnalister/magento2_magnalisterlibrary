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

MLI18n::gi()->add('priceminister_prepare_apply_form', array(
    'legend' => array(
        'details' => 'Produktdetails',
        'categories' => 'Kategorie',
        'variationmatching' => array('{#i18n:attributes_matching_required_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingoptional' => array('{#i18n:attributes_matching_optional_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingcustom' => array('{#i18n:attributes_matching_custom_attributes#}', '{#i18n:attributes_matching_title#}'),
        'subcategories' => 'PriceMinister Subcategories',
        'advert' => 'Allgemeine Einstellungen',
    ),
    'field' => array(
        'variationgroups' => array(
            'label' => 'PriceMinister Kategorien',
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
        'itemtitle' => array(
            'label' => 'Titel',
            'hint' => 'Titel max. 200 Zeichen<br>Erlaubte Platzhalter: <br> #BASEPRICE# - Grundpreis',
        ),
        'description' => array(
            'label' => 'Beschreibung',
            'hint'  => 'Maximal 4000 Zeichen.<br>Liste verf&uuml;gbarer Platzhalter f&uuml;r die Produktbeschreibung:<dl><dt>#TITLE#</dt><dd>Produktname (Titel)</dd><dt>#ARTNR#</dt><dd>Artikelnummer</dd><dt>#PID#</dt><dd>Produkt-ID</dd><dt>#SHORTDESCRIPTION#</dt><dd>Kurzbeschreibung aus dem Shop</dd><dt>#DESCRIPTION#</dt><dd>Beschreibung aus dem Shop</dd><dt>#PICTURE1#</dt><dd>erstes Produktbild</dd><dt>#PICTURE2# etc.</dt><dd>zweites Produktbild, mit #PICTURE3#, #PICTURE4# usw. können weitere Bilder übermittelt werden, so viele wie im Shop vorhanden.</dd></dl>',
        ),
        'images' => array(
            'label' => 'Produktbilder',
            'hint'  => 'Maximum 10 images. Images should be at least 480x640 in resolution.',
        ),
        'price' => array(
            'label' => 'Preis',
        ),
        'itemcondition' => array(
            'label' => 'Zustand',
        ),
        'ean' => array(
            'label' => 'EAN',
        ),
    ),
), false);

MLI18n::gi()->add('priceminister_prepare_variations', array(
    'legend' => array(
        'variations' => 'Kategorie von PriceMinister ausw&auml;hlen',
        'attributes' => 'Attributsnamen von PriceMinister ausw&auml;hlen',
        'variationmatching' => array('{#i18n:attributes_matching_required_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingoptional' => array('{#i18n:attributes_matching_optional_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingcustom' => array('{#i18n:attributes_matching_custom_attributes#}', '{#i18n:attributes_matching_title#}'),
        'action' => '{#i18n:form_action_default_legend#}',
    ),
    'field' => array(
        'variationgroups' => array(
            'label' => 'PriceMinister Kategorie',
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
            'label' => '{#i18n:priceminister_varmatch_reset_matching#}',
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

MLI18n::gi()->priceminister_prepareform_max_length_part1 = 'Maxpriceminister';
MLI18n::gi()->priceminister_prepareform_max_length_part2 = 'attribute is';
MLI18n::gi()->priceminister_prepareform_category = 'PriceMinister Kategorien is mandatory.';
MLI18n::gi()->priceminister_prepare_form_itemtitle = 'Title attribute is mandatory, and must be between 5 and 64 characters';
MLI18n::gi()->priceminister_prepare_form_description = 'Description attribute is mandatory, and must be between 10 and 4000 characters';
MLI18n::gi()->priceminister_prepareform_category_attribute = ' category attribute is mandatory.';
MLI18n::gi()->priceminister_prepare_variations_title = '{#i18n:attributes_matching_tab_title#}';
MLI18n::gi()->priceminister_prepare_apply = 'Neue Produkte erstellen';
MLI18n::gi()->priceminister_category_no_attributes = 'There are no attributes for this category.';
MLI18n::gi()->priceminister_prepare_variations_choose_mp_value = '{#i18n:attributes_matching_option_marketplace_value#}';
MLI18n::gi()->priceminister_prepare_variations_separator_line_label = '{#i18n:attributes_matching_option_separator#}';
MLI18n::gi()->priceminister_prepare_variations_free_text = '{#i18n:attributes_matching_option_free_text#}';
MLI18n::gi()->priceminister_prepare_variations_mandatory_fields_info = '{#i18n:attributes_matching_mandatory_fields_info#}';
MLI18n::gi()->priceminister_prepare_variations_category_without_attributes_info = '{#i18n:attributes_matching_category_without_attributes_message#}';
MLI18n::gi()->priceminister_prepare_variations_error_text = '{#i18n:attributes_matching_attribute_required_error#}';
MLI18n::gi()->priceminister_prepare_variations_error_empty_custom_attribute_name = '{#i18n:form_action_default_empty_custom_attribute_name#}';
MLI18n::gi()->priceminister_prepare_variations_error_maximal_number_custom_attributes_exceeded = '{#i18n:form_action_default_maximal_number_custom_attributes_exceeded#}';
MLI18n::gi()->priceminister_prepare_variations_error_duplicated_custom_attribute_name = '{#i18n:form_action_default_duplicated_custom_attribute_name#}';
MLI18n::gi()->priceminister_prepare_variations_error_missing_value = '{#i18n:attributes_matching_attribute_required_missing_value#}';
MLI18n::gi()->priceminister_prepare_variations_error_free_text = '{#i18n:attributes_matching_attribute_free_text_error#}';
MLI18n::gi()->priceminister_prepare_variations_matching_table = '{#i18n:attributes_matching_table_matched_headline#}';
MLI18n::gi()->priceminister_prepare_variations_notice = '{#i18n:attributes_matching_prepared_different_notice#}';
MLI18n::gi()->priceminister_prepare_match_notice_not_all_auto_matched = 'Es konnten nicht alle ausgewählten Werte gematcht werden. Nicht-gematchte Werte werden weiterhin in den DropDown-Feldern angezeigt. Bereits gematchte Werte werden in der Produktvorbereitung berücksichtigt.';
MLI18n::gi()->priceminister_prepare_match_variations_saved = '{#i18n:attributes_matching_prepare_variations_saved#}';
MLI18n::gi()->priceminister_prepare_variations_saved = '{#i18n:attributes_matching_matching_variations_saved#}';
MLI18n::gi()->priceminister_prepare_variations_reset_success = 'Das Matching wurde aufgehoben.';
MLI18n::gi()->priceminister_prepareform_title = 'Bitte geben Sie einen Titel an.';
MLI18n::gi()->priceminister_prepareform_description = 'Bitte geben Sie eine Artikelbeschreibung an.';
MLI18n::gi()->priceminister_prepare_variations_manualy_matched = '{#i18n:attributes_matching_type_manually_matched#}';
MLI18n::gi()->priceminister_prepare_variations_free_text_add = '{#i18n:attributes_matching_type_free_text#}';
MLI18n::gi()->priceminister_prepare_variations_change_attribute_info = '{#i18n:attributes_matching_change_attribute_info#}';
MLI18n::gi()->priceminister_varmatch_attribute_different_on_product = '{#i18n:attributes_matching_attribute_matched_different_global_message#}';
MLI18n::gi()->priceminister_prepare_variations_auto_matched = '{#i18n:attributes_matching_type_auto_matched#}';
MLI18n::gi()->priceminister_varmatch_attribute_deleted_from_mp = '{#i18n:attributes_matching_attribute_deleted_from_marketplace_message#}';
MLI18n::gi()->priceminister_varmatch_attribute_deleted_from_shop = '{#i18n:attributes_matching_attribute_deleted_from_shop_message#}';
MLI18n::gi()->priceminister_varmatch_attribute_value_deleted_from_mp = '{#i18n:attributes_matching_attribute_value_deleted_from_marketplace_message#}';
MLI18n::gi()->priceminister_varmatch_attribute_value_deleted_from_shop = 'Dieses Attribut wurde von shop gel&ouml;scht oder ge&auml;ndert. Matchings dazu wurden daher aufgehoben. Bitte matchen Sie bei Bedarf erneut auf ein geeignetes shop Attribut.';
MLI18n::gi()->priceminister_varmatch_attribute_changed_on_mp = '{#i18n:attributes_matching_attribute_value_changed_from_marketplace_message#}';
MLI18n::gi()->priceminister_prepare_variations_already_matched = '{#i18n:attributes_matching_already_matched#}';
MLI18n::gi()->priceminister_prepare_variations_reset_info = '{#i18n:attributes_matching_reset_matching_message#}';
MLI18n::gi()->priceminister_varmatch_reset_matching = '{#i18n:attributes_matching_option_reset_matching#}';
MLI18n::gi()->priceminister_prepare_variations_multiselect_hint = '{#i18n:attributes_matching_multi_select_hint#}';
