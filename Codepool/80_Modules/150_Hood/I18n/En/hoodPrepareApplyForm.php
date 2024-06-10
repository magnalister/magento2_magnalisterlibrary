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

MLI18n::gi()->{'hood_prepare_apply'} = 'Prepare Items';
MLI18n::gi()->{'ml_hood_no_conditions_applicable_for_cat'} = 'This Category doesn&apos;t allow to choose an Item Condition';
MLI18n::gi()->{'ml_hood_prepare_form_category_notvalid'} = 'this category is not valid';
MLI18n::gi()->{'hood_prepare_apply_form__legend__details'} = 'Item Details';
MLI18n::gi()->{'hood_prepare_apply_form__legend__pictures'} = 'Image settings';
MLI18n::gi()->{'hood_prepare_apply_form__legend__auction'} = 'Auction Settings';
MLI18n::gi()->{'hood_prepare_apply_form__legend__categories'} = 'Hood.de Category';
MLI18n::gi()->{'hood_prepare_apply_form__field__categories__label'}='Hood.de Category';
MLI18n::gi()->{'hood_prepare_apply_form__legend__primarycategory_attributes'} = 'Attributes for Main Category';
MLI18n::gi()->{'hood_prepare_apply_form__legend__secondarycategory_attributes'} = 'Attributes for Secondary Category';
MLI18n::gi()->{'hood_prepare_apply_form__legend__shipping'} = 'Shipping';
MLI18n::gi()->{'hood_prepare_apply_form__field__title__label'} = 'Product Name';
MLI18n::gi()->{'hood_prepare_apply_form__field__title__hint'} = 'Title, max. 85 characters.<br />Placeholders allowed:<br />#BASEPRICE#<br />Please note the <span style="color:#e31a1c;">Info Text in the Configuration</span> (on Template Product name).';
MLI18n::gi()->{'hood_prepare_apply_form__field__title__optional__checkbox__labelNegativ'} = 'Always use product title from web-shop';
MLI18n::gi()->{'hood_prepare_apply_form__field__subtitle__label'} = 'Subtitle';
MLI18n::gi()->{'hood_prepare_apply_form__field__subtitle__hint'} = 'Subtitle, max. 55 characters <span style="color:#e31a1c">requires payment</span> ';
MLI18n::gi()->{'hood_prepare_apply_form__field__subtitle__optional__select__false'} = 'Don\'t transfer to Hood.de';
MLI18n::gi()->{'hood_prepare_apply_form__field__subtitle__optional__select__true'} = 'Transfer to Hood.de';
MLI18n::gi()->{'hood_prepare_apply_form__field__manufacturer__label'}='Manufacturer';
MLI18n::gi()->{'hood_prepare_apply_form__field__manufacturer__optional__checkbox__labelNegativ'} = 'Always use product title from web-shop';
MLI18n::gi()->{'hood_prepare_apply_form__field__manufacturerpartnumber__label'}='model number';
MLI18n::gi()->{'hood_prepare_apply_form__field__manufacturerpartnumber__optional__checkbox__labelNegativ'} = 'Always use product title from web-shop';
MLI18n::gi()->{'hood_prepare_apply_form__field__shortdescription__label'}='Short description';
MLI18n::gi()->{'hood_prepare_apply_form__field__shortdescription__optional__checkbox__labelNegativ'} = 'Always use product title from web-shop';
MLI18n::gi()->{'hood_prepare_apply_form__field__images__label'} = 'Hood.de-Picture';
MLI18n::gi()->{'hood_prepare_apply_form__field__images__hint'} = 'Main Image (URL)';

MLI18n::gi()->{'hood_prepare_apply_form__field__images__optional__checkbox__labelNegativ'} = 'use all images';
MLI18n::gi()->{'hood_prepare_apply_form__field__variationdimensionforpictures__label'} = 'Variation Dimension for Images';
MLI18n::gi()->{'hood_prepare_apply_form__field__variationdimensionforpictures__help'} = 'If you have variation images stored along with your product data, the Picture Pack will submit them to Hood.de with the product upload.<br />
                Hood.de allows only one variation dimension: If you take e.g. color, the main picture on Hood.de&apos;s product page will change whenever the buyer chooses an other color.<br /><br />
                This setting here is the default value. You can change it in the preparation form for each product.<br />
                If you want to change it afterwards, you have to prepare and upload the product anew.';
MLI18n::gi()->{'hood_prepare_apply_form__field__variationpictures__label'} = 'Variation Images';
MLI18n::gi()->{'hood_prepare_apply_form__field__variationpictures__hint'} = '';
MLI18n::gi()->{'hood_prepare_apply_form__field__variationpictures__optional__checkbox__labelNegativ'} = 'use all variation images';
MLI18n::gi()->{'hood_prepare_apply_form__field__description__label'} = 'Description';
MLI18n::gi()->{'hood_prepare_apply_form__field__description__hint'} = 'List of available place holders for product description:<dl><dt>#TITLE#</dt><dd>Product name (Titel)</dd><dt>#ARTNR#</dt><dd>Article number from the shop</dd><dt>#PID#</dt><dd>Products ID</dd><!--<dt>#PRICE#</dt><dd>Price</dd><dt>#VPE#</dt><dd>Price per packaging unit</dd>--><dt>#SHORTDESCRIPTION#</dt><dd>Short Description from Shop</dd><dt>#DESCRIPTION#</dt><dd>Description from Shop</dd><dt>#WEIGHT#</dt><dd>Products weight</dd><dt>#PICTURE1#</dt><dd>First Product-Image</dd><dt>#PICTURE2# etc.</dt><dd>Second Product-Image; with #PICTURE3#, #PICTURE4# etc. More Images can be sent, as many as available in the shop.</dd></dl>';
MLI18n::gi()->{'hood_prepare_apply_form__field__description__optional__checkbox__labelNegativ'} = 'Always use product description from web-shop';
MLI18n::gi()->{'hood_prepare_apply_form__field__buyitnowprice__optional__select__true'} = 'Activate Buy It Now';
MLI18n::gi()->{'hood_prepare_apply_form__field__buyitnowprice__optional__select__false'} = 'Disable Buy It Now';
MLI18n::gi()->{'hood_prepare_apply_form__field__site__label'} = 'Hood.de Site';
MLI18n::gi()->{'hood_prepare_apply_form__field__site__hint'} = 'The Hood.de marketplace you wish to install.';
MLI18n::gi()->{'hood_prepare_apply_form__field__listingtype__label'} = 'Listing Type';
MLI18n::gi()->{'hood_prepare_apply_form__field__listingtype__hint'} = 'Listing type';
MLI18n::gi()->{'hood_prepare_apply_form__field__listingduration__label'} = 'Listing Duration';
MLI18n::gi()->{'hood_prepare_apply_form__field__listingduration__hint'} = 'Duration of the listing';
MLI18n::gi()->{'hood_prepare_apply_form__field__paymentmethods__label'} = 'Payment Methods';
MLI18n::gi()->{'hood_prepare_apply_form__field__paymentmethods__hint'} = 'Accepted payment methods';
MLI18n::gi()->{'hood_prepare_apply_form__field__paymentmethods__help'} = 'Presetting for payment mehtods (Multi-select with CTRL+click). Selection specifications from Hood.de.';
MLI18n::gi()->{'hood_prepare_apply_form__field__conditiontype__label'} = 'Item Condition';
MLI18n::gi()->{'hood_prepare_apply_form__field__conditiontype__hint'} = 'Condition of item (will be displayed in most Hood.de categories)';
MLI18n::gi()->{'hood_prepare_apply_form__field__privatelisting__label'} = 'Private Listing';
MLI18n::gi()->{'hood_prepare_apply_form__field__privatelisting__hint'} = 'When activated, the buyer/bidder list cannot be seen by third parties <span style="color:#e31a1c">requires payment</span> ';
MLI18n::gi()->{'hood_prepare_apply_form__field__privatelisting__valuehint'} = 'Activate Private Listing';
MLI18n::gi()->{'hood_prepare_apply_form__field__hitcounter__label'} = 'Enable Hit Counter';
MLI18n::gi()->{'hood_prepare_apply_form__field__hitcounter__hint'} = '';
MLI18n::gi()->{'hood_prepare_apply_form__field__starttime__label'} = 'Start Time<br />(If allocated)';
MLI18n::gi()->{'hood_prepare_apply_form__field__starttime__hint'} = 'An item on Hood.de is normally active immediately after uploading. Fill out this field to only make it available after the set start time (<span style="color:#e31a1c">requires payment</span>).';
MLI18n::gi()->{'hood_prepare_apply_form__field__boldtitle__label'} = 'Bold font in article lists';
MLI18n::gi()->{'hood_prepare_apply_form__field__backgroundcolor__label'} = 'Background color in article lists';
MLI18n::gi()->{'hood_prepare_apply_form__field__gallery__label'} = 'Gallery Premium in article lists';
MLI18n::gi()->{'hood_prepare_apply_form__field__category__label'} = 'Top offer in category and search';
MLI18n::gi()->{'hood_prepare_apply_form__field__homepage__label'} = 'Top offer on the home page';
MLI18n::gi()->{'hood_prepare_apply_form__field__homepageimage__label'} = 'Top offer with picture on the home page';
MLI18n::gi()->{'hood_prepare_apply_form__field__xxlimage__label'} = 'With the XXL photo option your images will be displayed in even more detail';
MLI18n::gi()->{'hood_prepare_apply_form__field__noads__label'} = 'Do not show ads (always active and free for Gold and Platinum Shop)';
MLI18n::gi()->{'hood_prepare_apply_form__field__age__label'} = 'Age Limit';
MLI18n::gi()->{'hood_prepare_apply_form__field__noidentifierflag__label'} = 'Special model';
MLI18n::gi()->{'hood_prepare_apply_form__field__fsk__label'} = 'FSK';
MLI18n::gi()->{'hood_prepare_apply_form__field__usk__label'} = 'USK';
MLI18n::gi()->{'hood_prepare_apply_form__field__features__label'} = 'Additional options';
MLI18n::gi()->{'hood_prepare_apply_form__field__features__hint'} = '<span style="color:#e31a1c">Features are chargeable on Hood.de</span>';
MLI18n::gi()->{'hood_prepare_apply_form__field__primarycategory__label'} = 'Primary Category';
MLI18n::gi()->{'hood_prepare_apply_form__field__primarycategory__hint'} = 'Select';
MLI18n::gi()->{'hood_prepare_apply_form__field__secondarycategory__label'} = 'Secondary Category';
MLI18n::gi()->{'hood_prepare_apply_form__field__secondarycategory__hint'} = 'Select';
MLI18n::gi()->{'hood_prepare_apply_form__field__storecategory__label'} = 'Hood.de Store Category';
MLI18n::gi()->{'hood_prepare_apply_form__field__storecategory__hint'} = 'Select';
MLI18n::gi()->{'hood_prepare_apply_form__field__storecategory2__label'} = 'Secondary Store Category';
MLI18n::gi()->{'hood_prepare_apply_form__field__storecategory2__hint'} = 'Select';
MLI18n::gi()->{'hood_prepare_apply_form__field__storecategory3__label'} = 'third Store Category';
MLI18n::gi()->{'hood_prepare_apply_form__field__storecategory3__hint'} = 'Select';
MLI18n::gi()->{'hood_prepare_apply_form__field__shippinglocalcontainer__label'} = 'Domestic Shipping';
MLI18n::gi()->{'hood_prepare_apply_form__field__shippinglocalcontainer__hint'} = 'Offered domestic shipping options<br /><br />Inputting "=GEWICHT" in the Shipping Costs sets this based on the item weight.';
MLI18n::gi()->{'hood_prepare_apply_form__field__shippinginternationalcontainer__label'} = 'International Shipping';
MLI18n::gi()->{'hood_prepare_apply_form__field__shippinginternationalcontainer__hint'} = 'Offered international shipping options';
MLI18n::gi()->{'hood_prepare_apply_form__field__shippinglocal__cost'} = 'Shipping Costs';
MLI18n::gi()->{'hood_prepare_apply_form__field__shippinglocalprofile__option'} = '{#NAME#} ({#AMOUNT#} per additional item)';
MLI18n::gi()->{'hood_prepare_apply_form__field__shippinglocalprofile__optional__select__false'} = 'Don\'t use shipping profile';
MLI18n::gi()->{'hood_prepare_apply_form__field__shippinglocalprofile__optional__select__true'} = 'Use shipping profile';
MLI18n::gi()->{'hood_prepare_apply_form__field__shippinglocaldiscount__label'} = 'Use rules for special price shipping';
MLI18n::gi()->{'hood_prepare_apply_form__field__shippinginternationaldiscount__label'} = 'Use rules for special price shipping';
MLI18n::gi()->{'hood_prepare_apply_form__field__shippinginternational__cost'} = 'Shipping Costs';
MLI18n::gi()->{'hood_prepare_apply_form__field__shippinginternational__optional__select__false'} = 'Don\'t ship internationally';
MLI18n::gi()->{'hood_prepare_apply_form__field__shippinginternational__optional__select__true'} = 'Ship internationally';
MLI18n::gi()->{'hood_prepare_apply_form__field__dispatchtimemax__label'} = 'Dispatch Time';
MLI18n::gi()->{'hood_prepare_apply_form__field__dispatchtimemax__optional__checkbox__labelNegativ'} = 'Always use dispatch time from Hood.de configurations';
MLI18n::gi()->{'hood_prepare_apply_form__field__shippinginternationalprofile__option'} = '{#NAME#} ({#AMOUNT#} per additional item)';
MLI18n::gi()->{'hood_prepare_apply_form__field__shippinginternationalprofile__notavailible'} = 'Only when `<i>International Shipping</i>` is active.';
MLI18n::gi()->{'hood_prepare_apply_form__field__shippinginternationalprofile__optional__select__false'} = 'Don\'t use shipping profile';
MLI18n::gi()->{'hood_prepare_apply_form__field__shippinginternationalprofile__optional__select__true'} = 'Use shipping profile';

MLI18n::gi()->{'hood_prepare_apply_form__legend__variationmatching__0'} = 'hood_prepare_apply_form__legend__variationmatching__0';
MLI18n::gi()->{'hood_prepare_apply_form__legend__variationmatching__1'} = 'hood_prepare_apply_form__legend__variationmatching__1';
MLI18n::gi()->{'hood_prepare_apply_form__legend__variationmatchingoptional__0'} = 'hood_prepare_apply_form__legend__variationmatchingoptional__0';
MLI18n::gi()->{'hood_prepare_apply_form__legend__variationmatchingoptional__1'} = 'hood_prepare_apply_form__legend__variationmatchingoptional__1';
MLI18n::gi()->{'hood_prepare_apply_form__legend__variationmatchingcustom__0'} = 'hood_prepare_apply_form__legend__variationmatchingcustom__0';
MLI18n::gi()->{'hood_prepare_apply_form__legend__variationmatchingcustom__1'} = 'hood_prepare_apply_form__legend__variationmatchingcustom__1';
MLI18n::gi()->{'hood_prepare_apply_form__field__variationgroups__label'} = 'hood_prepare_apply_form__field__variationgroups__label';
MLI18n::gi()->{'hood_prepare_apply_form__field__variationgroups.value__label'} = 'hood_prepare_apply_form__field__variationgroups.value__label';
MLI18n::gi()->{'hood_prepare_apply_form__field__variationgroups.value__catinfo'} = 'hood_prepare_apply_form__field__variationgroups.value__catinfo';
MLI18n::gi()->{'hood_prepare_apply_form__field__webshopattribute__label'} = 'hood_prepare_apply_form__field__webshopattribute__label';
MLI18n::gi()->{'hood_prepare_apply_form__field__attributematching__matching__titlesrc'} = 'hood_prepare_apply_form__field__attributematching__matching__titlesrc';
MLI18n::gi()->{'hood_prepare_apply_form__field__attributematching__matching__titledst'} = 'hood_prepare_apply_form__field__attributematching__matching__titledst';
MLI18n::gi()->hood_prepareform_max_length_part1 = 'Max length of';
MLI18n::gi()->hood_prepareform_max_length_part2 = 'attribute is';
MLI18n::gi()->hood_prepareform_category = 'Category attribute is mandatory.';
MLI18n::gi()->hood_prepareform_title = 'Bitte geben Sie einen Titel an.';
MLI18n::gi()->hood_prepareform_description = 'Bitte geben Sie eine Artikelbeschreibung an.';
MLI18n::gi()->hood_prepareform_category_attribute = ' (Kategorie Attribute) ist erforderlich und kann nicht leer sein.';
MLI18n::gi()->hood_category_no_attributes= 'Es sind keine Attribute f&uuml;r diese Kategorie vorhanden.';
MLI18n::gi()->hood_prepare_variations_title = 'Attributes Matching';
MLI18n::gi()->hood_prepare_variations_groups = 'Hood.de Groups';
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
MLI18n::gi()->hood_varmatch_all_select = 'All';
MLI18n::gi()->hood_varmatch_please_select = 'Please select...';
MLI18n::gi()->hood_varmatch_auto_matchen = 'Auto-matchen';
MLI18n::gi()->hood_varmatch_reset_matching = 'Matchen aufheben';
MLI18n::gi()->hood_varmatch_delete_custom_title = 'Varianten-Matching-Gruppe l&ouml;schen';
MLI18n::gi()->hood_varmatch_delete_custom_content = 'Wollen Sie die eigene Gruppe wirklich l&ouml;schen?<br />Alle zugeh&ouml;rigen Variantenmatchings werden dann ebenfalls gel&ouml;scht.';

MLI18n::gi()->hood_prepare_variations_multiselect_hint = 'Press CMD and select all favored attributes to be submitted';
