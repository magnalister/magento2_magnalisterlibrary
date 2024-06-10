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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLI18n::gi()->add('amazon_prepare_variations', array(
    'legend' => array(
        'variations' => 'Choose Main Category from Amazon',
        'attributes' => 'Select Amazon attribute name',
        'variationmatching' => array('{#i18n:attributes_matching_required_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingoptional' => array('{#i18n:attributes_matching_optional_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingcustom' => array('{#i18n:attributes_matching_custom_attributes#}', '{#i18n:attributes_matching_title#}'),
        'action' => '{#i18n:form_action_default_legend#}',
    ),
    'field' => array(
        'variationgroups.value' => array(
            'label' => 'Main Category',
        ),
        'customidentifier' => array(
            'label' => 'Sub-Category',
        ),
        'deleteaction' => array(
            'label' => '{#i18n:ML_BUTTON_LABEL_DELETE#}',
        ),
        'groupschanged' => array(
            'label' => '',
        ),
        'attributename' => array(
            'label' => 'Attribute Names',
        ),
        'attributenameajax' => array(
            'label' => '',
        ),
        'webshopattribute' => array(
            'label' => '{#i18n:attributes_matching_web_shop_attribute#}',
        ),
        'saveaction' => array(
            'label' => 'SAVE AND CLOSE',
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

MLI18n::gi()->{'amazon_prepare_apply_form__legend__category'} = 'Category';
MLI18n::gi()->{'amazon_prepare_apply_form__legend__details'} = 'Details';
MLI18n::gi()->{'amazon_prepare_apply_form__legend__variations'} = 'Choose category for Amazon';
MLI18n::gi()->{'amazon_prepare_apply_form__legend__attributes'} = 'Select Amazon attribute name';
MLI18n::gi()->{'amazon_prepare_apply_form__legend__variationmatching__0'} = '{#i18n:attributes_matching_required_attributes#}';
MLI18n::gi()->{'amazon_prepare_apply_form__legend__variationmatching__1'} = '{#i18n:attributes_matching_title#}';
MLI18n::gi()->{'amazon_prepare_apply_form__legend__variationmatchingoptional__0'} = '{#i18n:attributes_matching_optional_attributes#}';
MLI18n::gi()->{'amazon_prepare_apply_form__legend__variationmatchingoptional__1'} = '{#i18n:attributes_matching_title#}';
MLI18n::gi()->{'amazon_prepare_apply_form__legend__variationmatchingcustom__0'} = '{#i18n:attributes_matching_custom_attributes#}';
MLI18n::gi()->{'amazon_prepare_apply_form__legend__variationmatchingcustom__1'} = '{#i18n:attributes_matching_title#}';
MLI18n::gi()->{'amazon_prepare_apply_form__legend__moredetails'} = 'Further Details (recommended)';
MLI18n::gi()->{'amazon_prepare_apply_form__legend__common'} = 'Overall settings';
MLI18n::gi()->{'amazon_prepare_apply_form__legend__b2b'} = 'Amazon Business (B2B)';
MLI18n::gi()->{'amazon_prepare_apply_form__field__variationthemecode__label'} = 'Variations <span class="bull">•</span>';
MLI18n::gi()->{'amazon_prepare_apply_form__field__variationthemealldata__label'} = '';
MLI18n::gi()->{'amazon_prepare_apply_form__field__variationgroups.value__label'} = 'Main Category <span class="bull">•</span>';
MLI18n::gi()->{'amazon_prepare_apply_form__field__producttype__label'} = 'Subcategory <span class="bull">•</span>';
MLI18n::gi()->{'amazon_prepare_apply_form__field__producttype__hint'} = '(Product Type)';
MLI18n::gi()->{'amazon_prepare_apply_form__field__browsenodes__label'} = 'Browsenodes <span class="bull">•</span>';
MLI18n::gi()->{'amazon_prepare_apply_form__field__browsenodes__hint'} = '';
MLI18n::gi()->{'amazon_prepare_apply_form__field__webshopattribute__label'} = '{#i18n:attributes_matching_web_shop_attribute#}';
MLI18n::gi()->{'amazon_prepare_apply_form__field__attributematching__matching__titlesrc'} = '{#i18n:attributes_matching_shop_value#}';
MLI18n::gi()->{'amazon_prepare_apply_form__field__attributematching__matching__titledst'} = '{#i18n:attributes_matching_marketplace_value#}';
MLI18n::gi()->{'amazon_prepare_apply_form__field__itemtitle__label'} = 'Product Name <span class="bull">•</span>';
MLI18n::gi()->{'amazon_prepare_apply_form__field__itemtitle__hint'} = '';
MLI18n::gi()->{'amazon_prepare_apply_form__field__itemtitle__optional__checkbox__labelNegativ'} = 'Always use product description from web-shop';
MLI18n::gi()->{'amazon_prepare_apply_form__field__manufacturer__label'} = 'Product Manufacturer <span class="bull">•</span>';
MLI18n::gi()->{'amazon_prepare_apply_form__field__manufacturer__hint'} = 'Product Manufacturer';
MLI18n::gi()->{'amazon_prepare_apply_form__field__manufacturer__optional__checkbox__labelNegativ'} = 'Always use the manufacturer from web-shop';
MLI18n::gi()->{'amazon_prepare_apply_form__field__brand__label'} = 'Brand <span class="bull">•</span>';
MLI18n::gi()->{'amazon_prepare_apply_form__field__brand__hint'} = 'Brand or Manufacturer';
MLI18n::gi()->{'amazon_prepare_apply_form__field__brand__optional__checkbox__labelNegativ'} = 'Always use Brand or Manufacturer from the shop';
MLI18n::gi()->{'amazon_prepare_apply_form__field__manufacturerpartnumber__label'} = 'Model Number';
MLI18n::gi()->{'amazon_prepare_apply_form__field__manufacturerpartnumber__hint'} = 'Please insert the Manufacturer\'s Part Number';
MLI18n::gi()->{'amazon_prepare_apply_form__field__manufacturerpartnumber__optional__checkbox__labelNegativ'} = 'Always use the Model Number from the shop';
MLI18n::gi()->{'amazon_prepare_apply_form__field__ean__hint'} = 'Not relevant if {#Type#} is set in the Variations';
MLI18n::gi()->{'amazon_prepare_apply_form__field__ean__optional__checkbox__labelNegativ'} = 'Always use {#Type#} from the shop';
MLI18n::gi()->{'amazon_prepare_apply_form__field__images__label'} = 'Product Pictures';
MLI18n::gi()->{'amazon_prepare_apply_form__field__images__hint'} = 'Up to 9 Product Pictures';
MLI18n::gi()->{'amazon_prepare_apply_form__field__images__optional__checkbox__labelNegativ'} = 'Always use Product Pictures from the shop';
MLI18n::gi()->{'amazon_prepare_apply_form__field__bulletpoints__label'} = 'Bullet Points';
MLI18n::gi()->{'amazon_prepare_apply_form__field__bulletpoints__hint'} = 'Key features of the product (e.g. "gold plated taps")<br /><br />These data are taken from the {#i18n:sAmazon_product_bolletpoints_fieldName#}, and must be comma separated.<br />Up to 500 characters each.';
MLI18n::gi()->{'amazon_prepare_apply_form__field__bulletpoints__optional__checkbox__labelNegativ'} = 'Always use Bullet Points from the shop (Meta Description)';
MLI18n::gi()->{'amazon_prepare_apply_form__field__description__label'} = 'Product Description';
MLI18n::gi()->{'amazon_prepare_apply_form__field__description__hint'} = 'Amazon allows here up to 2000 characters (plain text only, no HTML)';
MLI18n::gi()->{'amazon_prepare_apply_form__field__description__optional__checkbox__labelNegativ'} = 'Always use Product Description from the shop';
MLI18n::gi()->{'amazon_prepare_apply_form__field__keywords__label'} = 'General Keywords';
MLI18n::gi()->{'amazon_prepare_apply_form__field__keywords__help'} = '
<h3>Optimize product ranking with Amazon keywords</h3>
<br>
General keywords are used to optimize the ranking and for better filterability on Amazon. They are stored with the product invisibly, when uploaded.
<br><br>
<h2>Options for the Submission of General Keywords</h2>

1. Always use up-to-date keywords from the web shop (meta keywords): 
<br><br>
Here, the keywords are taken from the meta keywords field of the corresponding product in the web shop and submitted to Amazon.
<br><br>
2. Manually enter general keywords in magnalister 
<br><br>
If you do not want to use the meta keywords stored in the web shop product, you can enter your own keywords in the empty text field provided by magnalister.
<br><br>
<b>Important Notes:</b>
<ul><li>
If you enter keywords manually, separate them with a space (not a comma!). The maximum length of all keywords (rule of thumb: 1 character = 1 byte. Exception: special characters such as Ä, Ö, Ü = 2 bytes) may not exceed 250 bytes.
</li><li>
If the keywords of your web shop product are separated by commas, magnalister automatically converts these commas into spaces when uploading the product. The limitation to 250 bytes also applies here.
</li><li>
If the allowed byte count is exceeded, Amazon may return an error message after the product upload, which can be viewed in the magnalister error log. Please note that it can take up to 60 minutes until error messages are displayed in the magnalister error log.
</li><li>
Submission of Platinum Keywords: Transfer of Platinum Keywords: If you are an Amazon Platinum seller, please inform the magnalister support about it. We will then activate the submission of Platinum keywords. magnalister uses the general keywords and adopts them 1:1. General keywords and Platinum keywords are therefore identical.
</li><li>
If you want to transfer Platinum keywords to Amazon that differ from the "General Keywords", use the magnalister attribute matching under "Prepare Items" -> "Create New Products" -> "Amazon Optional Attributes". To do so, select "Platinum keywords 1-5" from the list of available Amazon attributes and match the corresponding web shop attribute.
</li><li>
In addition to general keywords, there are other Amazon-relevant keywords (e.g. thesaurus attribute keywords, target group keywords or topic keywords), which you can also be submitted to Amazon via attribute matching.
</li></ul>
';
MLI18n::gi()->{'amazon_prepare_apply_form__field__keywords__hint'} = 'Separate single keywords with spaces (not comma!)
<br><br>
All keywords together may not exceed 250 bytes (1 character = 1 byte. Exception: special characters like Ä, Ö, Ü = 2 bytes)
';
MLI18n::gi()->{'amazon_prepare_apply_form__field__keywords__optional__checkbox__labelNegativ'} = 'Always use the Keywords from the shop (Meta Keywords)';
MLI18n::gi()->{'amazon_prepare_apply_form__field__shippingtime__label'} = 'Handling time (in days)';
MLI18n::gi()->{'amazon_prepare_apply_form__field__shippingtime__hint'} = 'The elapsed time between when the buyer places the order until you hand the order over to your carrier.';
MLI18n::gi()->{'amazon_prepare_apply_form__field__shippingtime__optional__checkbox__labelNegativ'} = 'Always use the Configuration value';
MLI18n::gi()->{'amazon_prepare_apply_form__field__shippingtemplate__label'} = 'Seller Shipping Group';
MLI18n::gi()->{'amazon_prepare_apply_form__field__shippingtemplate__hint'} = 'You can define the Seller Shipping Groups in Configuration -&gt;Item Preparation';
MLI18n::gi()->{'amazon_prepare_apply_form__field__bopisstores__label'} = 'Activate product for "Click & Collect in store"';
MLI18n::gi()->{'amazon_prepare_apply_form__field__bopisstores__hint'} = 'Please select the stores where you want to activate this product for "Click & Collect in store".';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bactive__label'} = 'Use Amazon B2B';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bactive__help'} = 'If enabled, specific settings below will be used when uploading product to Amazon. <b>Please make sure that your account is enabled for Amazon Business services.</b> Otherwise, you might experience errors during upload if this option is enabled.';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bactive__help_matching'} = 'If enabled, the settings set in <br> the configurations will be used.';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bactive__notification'} = 'In order to use Amazon Business features you need to have your 
Amazon account activated for this. <b>Please make sure that your account is enabled for Amazon Business services.</b> 
Otherwise, you might experience errors during upload if this option is enabled.
<br>To upgrade your account, please follow instructions on 
<a href="https://sellercentral.amazon.de/business/b2bregistration" target="_blank">this page</a>.';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bactive__disabledNotification'} = 'In order to use Amazon Business features you need to enable it first in configuration.';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bactive__values__true'} = 'Yes';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bactive__values__false'} = 'No';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bsellto__label'} = 'Sell to';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bsellto__help'} = 'If <i>B2B Only</i> is selected, uploaded products with this option will be visible only for 
        Business customers on Amazon. Otherwise, products will be available for both regular and business customers.';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bsellto__values__b2b_b2c'} = 'B2N and B2C';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bsellto__values__b2b_only'} = 'B2 Only';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttype__label'} = 'Quantity Discount Type';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttype__help'} = '<b>Quantity Discount</b><br>
        Quantity Discount represents tiered discounts available to Amazon Business Customers 
        for higher-volume purchases. Sellers in the Amazon Business Seller Program specify tiers 
        for Quantity Pricing. Option "percent" means that specify percent of discount will be applied 
        to purchases that include specified quantity.<br><br>
        <b>Example</b>: 
        If product costs $100 and discount type is "Percent", applied discounts for <b>business customers</b>
        could be set like this: 
        <table><tr>
            <th style="background-color: #ddd;">Quantity</th>
            <th style="background-color: #ddd;">Discount</th>
            <th style="background-color: #ddd;">Final price per product</th>
        <tr><td>5 (or more)</td><td style="text-align: right;">10</td><td style="text-align: right;">$90</td></tr>
        <tr><td>8 (or more)</td><td style="text-align: right;">12</td><td style="text-align: right;">$88</td></tr>
        <tr><td>12 (or more)</td><td style="text-align: right;">15</td><td style="text-align: right;">$85</td></tr>
        <tr><td>20 (or more)</td><td style="text-align: right;">20</td><td style="text-align: right;">$80</td></tr>
        </table>';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttype__values__'} = 'Do not use';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttype__values__percent'} = 'Percent';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttype__values__fixed'} = 'Fixed';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttier1__label'} = 'Quantity Discount Tier 1';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttier2__label'} = 'Quantity Discount Tier 2';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttier3__label'} = 'Quantity Discount Tier 3';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttier4__label'} = 'Quantity Discount Tier 4';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttier5__label'} = 'Quantity Discount Tier 5';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttier1quantity__label'} = 'Quantity';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttier2quantity__label'} = 'Quantity';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttier3quantity__label'} = 'Quantity';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttier4quantity__label'} = 'Quantity';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttier5quantity__label'} = 'Quantity';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttier1discount__label'} = 'Discount';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttier2discount__label'} = 'Discount';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttier3discount__label'} = 'Discount';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttier4discount__label'} = 'Discount';
MLI18n::gi()->{'amazon_prepare_apply_form__field__b2bdiscounttier5discount__label'} = 'Discount';
MLI18n::gi()->{'amazon_varmatch_define_name'} = 'Please enter the identifier';
MLI18n::gi()->{'amazon_varmatch_ajax_error'} = 'An error occured';
MLI18n::gi()->{'amazon_varmatch_all_select'} = '{#i18n:attributes_matching_option_all#}';
MLI18n::gi()->{'amazon_varmatch_please_select'} = '{#i18n:attributes_matching_option_please_select#}';
MLI18n::gi()->{'amazon_varmatch_auto_matchen'} = '{#i18n:attributes_matching_option_auto_match#}';
MLI18n::gi()->{'amazon_varmatch_reset_matching'} = '{#i18n:attributes_matching_option_reset_matching#}';
MLI18n::gi()->{'amazon_varmatch_delete_custom_title'} = 'Delete variation-matching-group';
MLI18n::gi()->{'amazon_varmatch_delete_custom_content'} = 'Do you really want to delete the group?<br /> All corresponding variation matchings will be deleted as well.';
MLI18n::gi()->{'amazon_varmatch_attribute_changed_on_mp'} = '{#i18n:attributes_matching_attribute_value_changed_from_marketplace_message#}';
MLI18n::gi()->{'amazon_varmatch_attribute_different_on_product'} = '{#i18n:attributes_matching_attribute_matched_different_global_message#}';
MLI18n::gi()->{'amazon_varmatch_attribute_deleted_from_mp'} = '{#i18n:attributes_matching_attribute_deleted_from_marketplace_message#}';
MLI18n::gi()->{'amazon_varmatch_attribute_value_deleted_from_mp'} = '{#i18n:attributes_matching_attribute_value_deleted_from_marketplace_message#}';
MLI18n::gi()->{'amazon_varmatch_already_matched'} = '{#i18n:attributes_matching_already_matched#}';
MLI18n::gi()->{'amazon_category_attribut'} = '{#i18n:attributes_matching_marketplace_attribute#}';
MLI18n::gi()->{'amazon_shop_attribut'} = '{#i18n:attributes_matching_title#}';
MLI18n::gi()->{'amazon_web_shop_attribut'} = '{#i18n:attributes_matching_web_shop_attribute#}';
MLI18n::gi()->{'amazon_shop_select'} = '{#i18n:attributes_matching_shop_value#}';
MLI18n::gi()->{'amazon_marketplace_select'} = '{#i18n:attributes_matching_marketplace_value#}';
MLI18n::gi()->{'amazon_prepareform_max_length_part1'} = 'Max length of';
MLI18n::gi()->{'amazon_prepareform_max_length_part2'} = 'attribute is';
MLI18n::gi()->{'amazon_prepareform_category'} = 'Category attribute is mandatory.';
MLI18n::gi()->{'amazon_prepareform_title'} = 'Please enter a title';
MLI18n::gi()->{'amazon_prepareform_description'} = 'Please insert an article description';
MLI18n::gi()->{'amazon_prepareform_category_attribute'} = '(Categorie attribute) is mandantory and can not be unfilled.';
MLI18n::gi()->{'amazon_category_no_attributes'} = 'No attributes available for this category';
MLI18n::gi()->{'amazon_prepare_variations_title'} = '{#i18n:attributes_matching_tab_title#}';
MLI18n::gi()->{'amazon_prepare_variations_groups'} = 'Amazon groups';
MLI18n::gi()->{'amazon_prepare_variations_groups_custom'} = 'Own groups ';
MLI18n::gi()->{'amazon_prepare_variations_groups_new'} = 'Set own group';
MLI18n::gi()->{'amazon_prepare_match_variations_no_selection'} = '{#i18n:attributes_matching_matching_variations_no_category_selection#}';
MLI18n::gi()->{'amazon_prepare_match_variations_custom_ident_missing'} = 'Please select identifier';
MLI18n::gi()->{'amazon_prepare_match_variations_attribute_missing'} = 'Please select attribute-names';
MLI18n::gi()->{'amazon_prepare_match_variations_category_missing'} = 'Please select variation-groups';
MLI18n::gi()->{'amazon_prepare_match_variations_not_all_matched'} = 'Please allocate a shop attribute to all Amazon attributes';
MLI18n::gi()->{'amazon_prepare_match_notice_not_all_auto_matched'} = 'Could not match all selected values. Not-matched values will still be displayed in the drop-down-menu. Values that are already matched will be considered in the item preparation.';
MLI18n::gi()->{'amazon_prepare_match_variations_saved'} = '{#i18n:attributes_matching_prepare_variations_saved#}';
MLI18n::gi()->{'amazon_prepare_variations_saved'} = '{#i18n:attributes_matching_matching_variations_saved#}';
MLI18n::gi()->{'amazon_prepare_variations_reset_success'} = 'Matching has been reseted.';
MLI18n::gi()->{'amazon_prepare_match_variations_delete'} = 'Do you really want to delete the group?<br /> All corresponding variation matchings will be deleted as well.';
MLI18n::gi()->{'amazon_error_checkin_variation_config_empty'} = 'variations are not configured';
MLI18n::gi()->{'amazon_error_checkin_variation_config_cannot_calc_variations'} = 'Could not calculate any variations.';
MLI18n::gi()->{'amazon_error_checkin_variation_config_missing_nameid'} = 'Allocation for the shop attribute "{#Attribute#}"could not be found in the Ayn24 variant-group "{#MpIdentifier#}" for the variant article with the sku"{#SKU#}.';
MLI18n::gi()->{'amazon_prepare_variations_free_text'} = '{#i18n:attributes_matching_option_free_text#}';
MLI18n::gi()->{'amazon_prepare_variations_additional_category'} = '{#i18n:attributes_matching_additional_category#}';
MLI18n::gi()->{'amazon_prepare_variations_error_text'} = '{#i18n:attributes_matching_attribute_required_error#}';
MLI18n::gi()->{'amazon_prepare_variations_error_missing_value'} = '{#i18n:attributes_matching_attribute_required_missing_value#}';
MLI18n::gi()->{'amazon_prepare_variations_error_free_text'} = '{#i18n:attributes_matching_attribute_free_text_error#}';
MLI18n::gi()->{'amazon_prepare_variations_matching_table'} = '{#i18n:attributes_matching_table_matched_headline#}';
MLI18n::gi()->{'amazon_prepare_variations_manualy_matched'} = '{#i18n:attributes_matching_type_manually_matched#}';
MLI18n::gi()->{'amazon_prepare_variations_auto_matched'} = '{#i18n:attributes_matching_type_auto_matched#}';
MLI18n::gi()->{'amazon_prepare_variations_free_text_add'} = '{#i18n:attributes_matching_type_free_text#}';
MLI18n::gi()->{'amazon_prepare_variations_reset_info'} = '{#i18n:attributes_matching_reset_matching_message#}';
MLI18n::gi()->{'amazon_prepare_variations_change_attribute_info'} = '{#i18n:attributes_matching_change_attribute_info#}';
MLI18n::gi()->{'amazon_prepare_variations_additional_attribute_label'} = '{#i18n:attributes_matching_custom_attributes#}';
MLI18n::gi()->{'amazon_prepare_variations_separator_line_label'} = '{#i18n:attributes_matching_option_separator#}';
MLI18n::gi()->{'amazon_prepare_variations_mandatory_fields_info'} = '{#i18n:attributes_matching_mandatory_fields_info#}';
MLI18n::gi()->{'amazon_prepare_variations_category_without_attributes_info'} = '{#i18n:attributes_matching_category_without_attributes_message#}';
MLI18n::gi()->{'amazon_prepare_variations_choose_mp_value'} = '{#i18n:attributes_matching_option_marketplace_value#}';
MLI18n::gi()->{'amazon_prepare_variations_notice'} = '{#i18n:attributes_matching_prepared_different_notice#}';
MLI18n::gi()->{'amazon_prepare_variations_already_matched'} = '{#i18n:attributes_matching_already_matched#}';
MLI18n::gi()->{'amazon_varmatch_attribute_deleted_from_shop'} = '{#i18n:attributes_matching_attribute_deleted_from_shop_message#}';
MLI18n::gi()->{'amazon_varmatch_attribute_value_deleted_from_shop'} = 'Dieses Attribut wurde von shop gel&ouml;scht oder ge&auml;ndert. Matchings dazu wurden daher aufgehoben. Bitte matchen Sie bei Bedarf erneut auf ein geeignetes shop Attribut.';
MLI18n::gi()->{'amazon_prepare_variations_error_empty_custom_attribute_name'} = '{#i18n:form_action_default_empty_custom_attribute_name#}';
MLI18n::gi()->{'amazon_prepare_variations_error_maximal_number_custom_attributes_exceeded'} = '{#i18n:form_action_default_maximal_number_custom_attributes_exceeded#}';
MLI18n::gi()->{'amazon_prepare_variations_theme_mandatory_error'} = 'Please select the variant design.';
MLI18n::gi()->{'amazon_prepare_variations_error_duplicated_custom_attribute_name'} = '{#i18n:form_action_default_duplicated_custom_attribute_name#}';
MLI18n::gi()->{'amazon_prepare_variations_multiselect_hint'} = '{#i18n:attributes_matching_multi_select_hint#}';
