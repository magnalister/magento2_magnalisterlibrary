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

MLI18n::gi()->{'ml_ebay_note_product_required_short'} = '<b>Note</b>: This category requires an eBay product ID. Refer to info icon for details.';
MLI18n::gi()->{'ml_ebay_note_product_required'} = 'For this category, eBay requires that on eBay existing products are matched via an ePID.<ul><li>magnalister automatically takes care of the matching process via UPC/EAN</li><li>If a corresponding offer and ePID cannot be found yet in the eBay catalog, the product will automatically be requested as a new product on eBay. After this process, check the status inside the “inventory” tab as well as in the error log.</li></ul>';
MLI18n::gi()->{'ebay_prepare_apply'} = 'Create New Products';
MLI18n::gi()->{'ml_ebay_no_conditions_applicable_for_cat'} = 'This Category doesn&apos;t allow to choose an Item Condition';
MLI18n::gi()->{'ml_ebay_prepare_form_category_notvalid'} = 'This category is not valid';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__details'} = 'Item Details';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__pictures'} = 'Image Settings';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__auction'} = 'Auction Settings';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__category'} = 'eBay Category';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__variationmatching__0'} = '{#i18n:attributes_matching_required_attributes#}';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__variationmatching__1'} = '{#i18n:attributes_matching_title#}';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__variationmatchingoptional__0'} = '{#i18n:attributes_matching_optional_attributes#}';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__variationmatchingoptional__1'} = '{#i18n:attributes_matching_title#}';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__variationmatchingcustom__0'} = '{#i18n:attributes_matching_custom_attributes#}';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__variationmatchingcustom__1'} = '{#i18n:attributes_matching_title#}';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__shipping'} = 'Shipping';
MLI18n::gi()->{'ebay_prepare_apply_form__legend__mwst'} = 'VAT';
MLI18n::gi()->{'ebay_prepare_apply_form__field__title__label'} = 'Product Name';
MLI18n::gi()->{'ebay_prepare_apply_form__field__title__hint'} = 'Title, max. 80 characters.<br />Placeholders allowed:<br />#BASEPRICE#<br />Please note the <span style="color:#e31a1c;">Info Text in the Configuration</span> (on Template Product name).';
MLI18n::gi()->{'ebay_prepare_apply_form__field__title__optional__checkbox__labelNegativ'} = 'Use always product title from web-shop';
MLI18n::gi()->{'ebay_prepare_apply_form__field__subtitle__label'} = 'Subtitle';
MLI18n::gi()->{'ebay_prepare_apply_form__field__subtitle__hint'} = 'Subtitle, max. 55 characters <span style="color:#e31a1c">requires payment</span> ';
MLI18n::gi()->{'ebay_prepare_apply_form__field__subtitle__optional__select__false'} = 'Don\'t transfer to eBay';
MLI18n::gi()->{'ebay_prepare_apply_form__field__subtitle__optional__select__true'} = 'Transfer to eBay';
MLI18n::gi()->{'ebay_prepare_apply_form__field__pictureurl__label'} = 'eBay-Picture';
MLI18n::gi()->{'ebay_prepare_apply_form__field__pictureurl__hint'} = 'Main Image (URL)';
MLI18n::gi()->{'ebay_prepare_apply_form__field__pictureurl__optional__checkbox__labelNegativ'} = 'use all product images from web shop';
MLI18n::gi()->{'ebay_prepare_apply_form__field__variationdimensionforpictures__label'} = 'Variation Dimension for Images';
MLI18n::gi()->{'ebay_prepare_apply_form__field__variationdimensionforpictures__help'} = 'ebay_prepare_apply_form__field__variationdimensionforpictures__help';
MLI18n::gi()->{'ebay_prepare_apply_form__field__variationpictures__label'} = 'Variation Images';
MLI18n::gi()->{'ebay_prepare_apply_form__field__variationpictures__hint'} = '';
MLI18n::gi()->{'ebay_prepare_apply_form__field__variationpictures__optional__checkbox__labelNegativ'} = 'use all variation images';
MLI18n::gi()->{'ebay_prepare_apply_form__field__gallerytype__label'} = 'Gallery Images';
MLI18n::gi()->{'ebay_prepare_apply_form__field__gallerytype__help'} = '<b>Gallery Image</b><br /><br />
                Gallery images appear in the search result list on eBay. This improves the visibility of your items, and thus also the potential selling outcome.<br /><br />
                <b>Gallery Plus</b><br /><br />
                Gallery Plus means a  pop-up window with a bigger view of the item, when the customer points with the mouse on the item within the search result list. Please note that the image size must be <b>at least 800x800 px</b>.<br /><br />
                <b>eBay Fees</b><br /><br />
                &quot;Gallery Plus&quot; is <span style="color:#e31a1c;">subject to fee on eBay</span> in some categories! RedGecko GmbH does not care responsibility for any eBay fees caused.<br /><br />
                <b>Further information</b><br /><br />
                Please refer to the <a href="http://pages.ebay.com/help/sell/gallery-upgrade.html" target="_blank">eBay help pages</a> for further information.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__gallerytype__hint'} = 'Gallery setting (&quot;Plus&quot; can <span style="color:#e31a1c">cause fees on eBay</span> in some categories)';
MLI18n::gi()->{'ebay_prepare_apply_form__field__gallerytype__alert__Plus__title'} = 'Gallery Plus';
MLI18n::gi()->{'ebay_prepare_apply_form__field__gallerytype__alert__Plus__content'} = 'Gallery Plus means a pop-up window with a bigger view of the item, when the customer points with the mouse on the item within the search result list. Please note that the image size must be <b>at least 800x800 px</b>.<br /><br />
The usage of Gallery Plus can <span style="color:#e31a1c">cause extra fees</span> in some eBay categories. See  <a href="http://pages.ebay.com/help/sell/gallery-upgrade.html" target="_blank">eBay help page</a> for details.<br /><br />RedGecko GmbH is not responsible for any costs caused.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__description__label'} = 'Description';
MLI18n::gi()->{'ebay_prepare_apply_form__field__description__hint'} = 'List of available place holders for product description:<dl><dt>#TITLE#</dt><dd>Product name (Titel)</dd><dt>#ARTNR#</dt><dd>Article number from the shop</dd><dt>#PID#</dt><dd>Products ID</dd><!--<dt>#PRICE#</dt><dd>Price</dd><dt>#VPE#</dt><dd>Price per packaging unit</dd>--><dt>#SHORTDESCRIPTION#</dt><dd>Short Description from Shop</dd><dt>#DESCRIPTION#</dt><dd>Description from Shop</dd><dt>#WEIGHT#</dt><dd>Products weight</dd><dt>#PICTURE1#</dt><dd>First Product-Image</dd><dt>#PICTURE2# etc.</dt><dd>Second Product-Image; with #PICTURE3#, #PICTURE4# etc. More Images can be sent, as many as available in the shop.</dd></dl>';
MLI18n::gi()->{'ebay_prepare_apply_form__field__description__optional__checkbox__labelNegativ'} = 'Use always product description from web-shop';
MLI18n::gi()->{'ebay_prepare_apply_form__field__descriptionmobile__label'} = 'Mobile Description';
MLI18n::gi()->{'ebay_prepare_apply_form__field__descriptionmobile__hint'} = 'Available placeholders for the Mobile Item Description:
                <dl>
                    <dt>#TITLE#</dt><dd>Product name (title)</dd>
                    <dt>#ARTNR#</dt><dd>Articla number from the shop</dd>
                    <dt>#PID#</dt><dd>Products ID</dd>
                    <dt>#SHORTDESCRIPTION#</dt><dd>Short Description from Shop</dd>
                    <dt>#DESCRIPTION#</dt><dd>Description from Shop</dd>
                    <dt>#WEIGHT#</dt><dd>Product Weight</dd>
                </dl>';
MLI18n::gi()->{'ebay_prepare_apply_form__field__descriptionmobile__optional__checkbox__labelNegativ'} = 'Use always product description from web-shop';
MLI18n::gi()->{'ebay_prepare_apply_form__field__descriptionmobile__hint2'} = '<b>Note</b><br />: No HTML is allowed, except lists and linebreaks. Other HTML elements will be filtered out.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__pricecontainer__label'} = 'eBay Price';
MLI18n::gi()->{'ebay_prepare_apply_form__field__pricecontainer__hint'} = 'Price for eBay';
MLI18n::gi()->{'ebay_prepare_apply_form__field__buyitnowprice__optional__select__true'} = 'Activate Buy It Now';
MLI18n::gi()->{'ebay_prepare_apply_form__field__buyitnowprice__optional__select__false'} = 'Disable Buy It Now';
MLI18n::gi()->{'ebay_prepare_apply_form__field__site__label'} = 'eBay Site';
MLI18n::gi()->{'ebay_prepare_apply_form__field__site__hint'} = 'The eBay marketplace you wish to install.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__listingtype__label'} = 'Listing Type';
MLI18n::gi()->{'ebay_prepare_apply_form__field__listingtype__hint'} = 'Listing type';
MLI18n::gi()->{'ebay_prepare_apply_form__field__listingduration__label'} = 'Listing Duration';
MLI18n::gi()->{'ebay_prepare_apply_form__field__listingduration__hint'} = 'Duration of the listing';
MLI18n::gi()->{'ebay_prepare_apply_form__field__strikeprice__label'} = 'Strike Prices';
MLI18n::gi()->{'ebay_prepare_apply_form__field__strikeprice__hint'} = 'Strike Prices';
MLI18n::gi()->{'ebay_prepare_apply_form__field__paymentsellerprofile__label'} = 'Frame conditions: Payment methods';
MLI18n::gi()->{'ebay_prepare_apply_form__field__paymentsellerprofile__help'} = '<b>Selection of frame-condition-profile for payment methods</b><br /><br />
You use the “Frame conditions for offers” function on eBay. That means that payment-, shipping- and reshipment conditions can’t be individually chosen. Conditions are now taken from the eBay profile.<br /><br />
Please select the prefared profile for payment conditions. This is mandantory. You can select a different profile in the item preparation if you have several profiles on eBay.
';
MLI18n::gi()->{'ebay_prepare_apply_form__field__paymentsellerprofile__help_subfields'} = '<b>Hint:</b><br />
This field is not editable since you are using the eBay frame-conditions. Please use the selection-field
<b>frame condition: Payment methods</b> to determine the profile for payment conditions.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__paymentmethods__label'} = 'Payment Methods';
MLI18n::gi()->{'ebay_prepare_apply_form__field__paymentmethods__hint'} = 'Accepted payment methods';
MLI18n::gi()->{'ebay_prepare_apply_form__field__paymentmethods__help'} = 'Preferences for payment methods ( multi-select with Ctrl+click).<br /><br /> Here you can select the payment methods provided by eBay.<br /><br /> If you use „eBay Managed Payments", eBay will not provide any further information about the payment method used by the buyer. ';
MLI18n::gi()->{'ebay_prepare_apply_form__field__conditionid__label'} = 'Item Condition';
MLI18n::gi()->{'ebay_prepare_apply_form__field__conditionid__hint'} = 'Condition of item (will be displayed in most eBay categories)';
MLI18n::gi()->{'ebay_prepare_apply_form__field__conditiondescriptors__label'} = 'Item condition details';
MLI18n::gi()->{'ebay_prepare_apply_form__field__conditiondescriptors__hint'} = 'Additional information about the item condition (for some categories)';
MLI18n::gi()->{'ebay_prepare_apply_form__field__conditiondescription__label'} = 'Description of the Condition';
MLI18n::gi()->{'ebay_prepare_apply_form__field__conditiondescription__hint'} = 'Additional information about the item condition. Not displayed for states like "New" or "New with ...".';
MLI18n::gi()->{'ebay_prepare_apply_form__field__privatelisting__label'} = 'Private Listing';
MLI18n::gi()->{'ebay_prepare_apply_form__field__privatelisting__hint'} = 'When activated, the buyer/bidder list cannot be seen by third parties <span style="color:#e31a1c">requires payment</span> ';
MLI18n::gi()->{'ebay_prepare_apply_form__field__privatelisting__valuehint'} = 'Activate Private Listing';
MLI18n::gi()->{'ebay_prepare_apply_form__field__bestofferenabled__label'} = 'Enable Best Offer';
MLI18n::gi()->{'ebay_prepare_apply_form__field__bestofferenabled__hint'} = 'When active, buyers can offer their best price.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__bestofferenabled__valuehint'} = 'Activate Best Offer (only applies to items without variations)';
MLI18n::gi()->{'ebay_prepare_apply_form__field__ebayplus__label'} = 'eBay Plus';
MLI18n::gi()->{'ebay_prepare_apply_form__field__ebayplus__hint'} = 'only available if this feature is activated on eBay';
MLI18n::gi()->{'ebay_prepare_apply_form__field__ebayplus__valuehint'} = 'activate \'eBay Plus\'';
MLI18n::gi()->{'ebay_prepare_apply_form__field__starttime__label'} = 'Start Time<br />(If allocated)';
MLI18n::gi()->{'ebay_prepare_apply_form__field__starttime__hint'} = 'An item on eBay is normally active immediately after uploading. Fill out this field to only make it available after the set start time (<span style="color:#e31a1c">requires payment</span>).';
MLI18n::gi()->{'ebay_prepare_apply_form__field__primarycategory__label'} = 'Primary Category';
MLI18n::gi()->{'ebay_prepare_apply_form__field__primarycategory__hint'} = 'Select';
MLI18n::gi()->{'ebay_prepare_apply_form__field__secondarycategory__label'} = 'Secondary Category';
MLI18n::gi()->{'ebay_prepare_apply_form__field__secondarycategory__hint'} = 'Select';
MLI18n::gi()->{'ebay_prepare_apply_form__field__storecategory__label'} = 'eBay Store Category';
MLI18n::gi()->{'ebay_prepare_apply_form__field__storecategory__hint'} = 'Select';
MLI18n::gi()->{'ebay_prepare_apply_form__field__storecategory2__label'} = 'Secondary Store Category';
MLI18n::gi()->{'ebay_prepare_apply_form__field__storecategory2__hint'} = 'Select';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippingsellerprofile__label'} = 'Frame conditions: Shipment';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippingsellerprofile__help'} = '<b>Selection of frame-condition-profile for shipment</b><br /><br />
You use the “Frame conditions for offers” function on eBay. That means that payment-, shipping- and reshipment conditions can’t be individually chosen. Conditions are now taken from the eBay profile.<br /><br />
Please select the prefared profile for shipping conditions. This is mandantory. You can select a different profile in the item preparation if you have several profiles on eBay.
';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippingsellerprofile__help_subfields'} = '<b>Hint:</b><br />
This field is not editable since you are using the eBay frame-conditions. Please use the selection-field
<b>frame condition: shipping</b> to determine the profile for shipping conditions.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinglocalcontainer__label'} = 'Domestic Shipping';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinglocalcontainer__hint'} = 'Offered domestic shipping options<br /><br />Inputting "=GEWICHT" in the Shipping Costs sets this based on the item weight.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternationalcontainer__label'} = 'International Shipping';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternationalcontainer__hint'} = 'Offered international shipping options';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinglocal__cost'} = 'Shipping Costs';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinglocalprofile__option'} = '{#NAME#} ({#AMOUNT#} per additional item)';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinglocalprofile__optional__select__false'} = 'Don\'t use shipping profile';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinglocalprofile__optional__select__true'} = 'Use shipping profile';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinglocaldiscount__label'} = 'Use rules for special price shipping';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternationaldiscount__label'} = 'Use rules for special price shipping';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternational__cost'} = 'Shipping Costs';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternational__optional__select__false'} = 'Don\'t ship internationally';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternational__optional__select__true'} = 'Ship internationally';
MLI18n::gi()->{'ebay_prepare_apply_form__field__dispatchtimemax__label'} = 'Dispatch Time';
MLI18n::gi()->{'ebay_prepare_apply_form__field__dispatchtimemax__optional__checkbox__labelNegativ'} = 'Always use dispatch time from eBay configurations';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternationalprofile__option'} = '{#NAME#} ({#AMOUNT#} per additional item)';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternationalprofile__notavailible'} = 'Only when `<i>International Shipping</i>` is active.';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternationalprofile__optional__select__false'} = 'Don\'t use shipping profile';
MLI18n::gi()->{'ebay_prepare_apply_form__field__shippinginternationalprofile__optional__select__true'} = 'Use shipping profile';
MLI18n::gi()->{'ebay_prepare_apply_form__field__variationgroups__label'} = '{#i18n:attributes_matching_category_title#}';
MLI18n::gi()->{'ebay_prepare_apply_form__field__variationgroups.value__label'} = '1. Marketplace Category';
MLI18n::gi()->{'ebay_prepare_apply_form__field__webshopattribute__label'} = '{#i18n:attributes_matching_web_shop_attribute#}';
MLI18n::gi()->{'ebay_prepare_apply_form__field__attributematching__matching__titlesrc'} = '{#i18n:attributes_matching_shop_value#}';
MLI18n::gi()->{'ebay_prepare_apply_form__field__attributematching__matching__titledst'} = '{#i18n:attributes_matching_marketplace_value#}';
MLI18n::gi()->{'ebay_prepare_apply_form__field__mwst__label'} = 'VAT';
MLI18n::gi()->{'ebay_prepare_apply_form__field__mwst__help'} = '<p>Here you can set the individual value for VAT (percentage) for this item. The value defined under "Configuration" -> „Item Preparation" -> „VAT“ will be used as standard value in this field. If you leave the field empty, no VAT will be transferred to eBay.</p>
<p><b>Important:</b><br/>
Please only fill in this field if you charge VAT.</p>';
            MLI18n::gi()->{'ebay_prepare_apply_form__field__mwst__hint'} = 'VAT rate for this product in %';
MLI18n::gi()->{'ebay_prepare_variations__legend__variations'} = 'Select an eBay Category';
MLI18n::gi()->{'ebay_prepare_variations__legend__attributes'} = 'ebay_prepare_variations__legend__attributes';
MLI18n::gi()->{'ebay_prepare_variations__legend__variationmatching__0'} = '{#i18n:attributes_matching_required_attributes#}';
MLI18n::gi()->{'ebay_prepare_variations__legend__variationmatching__1'} = '{#i18n:attributes_matching_title#}';
MLI18n::gi()->{'ebay_prepare_variations__legend__variationmatchingoptional__0'} = 'eBay Optional Attributes';
MLI18n::gi()->{'ebay_prepare_variations__legend__variationmatchingoptional__1'} = '{#i18n:attributes_matching_title#}';
MLI18n::gi()->{'ebay_prepare_variations__legend__variationmatchingcustom__0'} = 'eBay Additional Attributes';
MLI18n::gi()->{'ebay_prepare_variations__legend__variationmatchingcustom__1'} = '{#i18n:attributes_matching_title#}';
MLI18n::gi()->{'ebay_prepare_variations__legend__action'} = '{#i18n:form_action_default_legend#}';
MLI18n::gi()->{'ebay_prepare_variations__field__variationgroups__label'} = 'eBay Category';
MLI18n::gi()->{'ebay_prepare_variations__field__variationgroups.value__label'} = '1. Marktplace-Category';
MLI18n::gi()->{'ebay_prepare_variations__field__deleteaction__label'} = '{#i18n:ML_BUTTON_LABEL_DELETE#}';
MLI18n::gi()->{'ebay_prepare_variations__field__groupschanged__label'} = '';
MLI18n::gi()->{'ebay_prepare_variations__field__attributename__label'} = 'Attributesname';
MLI18n::gi()->{'ebay_prepare_variations__field__attributenameajax__label'} = '';
MLI18n::gi()->{'ebay_prepare_variations__field__customidentifier__label'} = 'Identifier';
MLI18n::gi()->{'ebay_prepare_variations__field__webshopattribute__label'} = '{#i18n:attributes_matching_web_shop_attribute#}';
MLI18n::gi()->{'ebay_prepare_variations__field__saveaction__label'} = 'SAVE AND CLOSE';
MLI18n::gi()->{'ebay_prepare_variations__field__resetaction__label'} = '{#i18n:ebay_varmatch_reset_matching#}';
MLI18n::gi()->{'ebay_prepare_variations__field__resetaction__confirmtext'} = '{#i18n:attributes_matching_reset_matching_message#}';
MLI18n::gi()->{'ebay_prepare_variations__field__attributematching__matching__titlesrc'} = '{#i18n:attributes_matching_shop_value#}';
MLI18n::gi()->{'ebay_prepare_variations__field__attributematching__matching__titledst'} = '{#i18n:attributes_matching_marketplace_value#}';
MLI18n::gi()->{'ebay_prepareform_max_length_part1'} = 'Max length of';
MLI18n::gi()->{'ebay_prepareform_max_length_part2'} = 'attribute is';
MLI18n::gi()->{'ebay_prepareform_category'} = 'Category attribute is mandatory.';
MLI18n::gi()->{'ebay_prepareform_title'} = 'ebay_prepareform_title';
MLI18n::gi()->{'ebay_prepareform_description'} = 'ebay_prepareform_description';
MLI18n::gi()->{'ebay_prepareform_category_attribute'} = 'ebay_prepareform_category_attribute';
MLI18n::gi()->{'ebay_category_no_attributes'} = 'ebay_category_no_attributes';
MLI18n::gi()->{'ebay_prepare_variations_title'} = 'Attributes Matching';
MLI18n::gi()->{'ebay_prepare_variations_groups'} = 'eBay Groups';
MLI18n::gi()->{'ebay_prepare_variations_groups_custom'} = 'ebay_prepare_variations_groups_custom';
MLI18n::gi()->{'ebay_prepare_variations_groups_new'} = 'ebay_prepare_variations_groups_new';
MLI18n::gi()->{'ebay_prepare_match_variations_no_selection'} = '{#i18n:attributes_matching_matching_variations_no_category_selection#}';
MLI18n::gi()->{'ebay_prepare_match_variations_custom_ident_missing'} = 'ebay_prepare_match_variations_custom_ident_missing';
MLI18n::gi()->{'ebay_prepare_match_variations_attribute_missing'} = 'ebay_prepare_match_variations_attribute_missing';
MLI18n::gi()->{'ebay_prepare_match_variations_not_all_matched'} = 'ebay_prepare_match_variations_not_all_matched';
MLI18n::gi()->{'ebay_prepare_match_notice_not_all_auto_matched'} = 'ebay_prepare_match_notice_not_all_auto_matched';
MLI18n::gi()->{'ebay_prepare_match_variations_saved'} = '{#i18n:attributes_matching_prepare_variations_saved#}';
MLI18n::gi()->{'ebay_prepare_variations_saved'} = '{#i18n:attributes_matching_matching_variations_saved#}';
MLI18n::gi()->{'ebay_prepare_match_variations_delete'} = 'ebay_prepare_match_variations_delete';
MLI18n::gi()->{'ebay_error_checkin_variation_config_empty'} = 'ebay_error_checkin_variation_config_empty';
MLI18n::gi()->{'ebay_error_checkin_variation_config_cannot_calc_variations'} = 'ebay_error_checkin_variation_config_cannot_calc_variations';
MLI18n::gi()->{'ebay_error_checkin_variation_config_missing_nameid'} = 'ebay_error_checkin_variation_config_missing_nameid';
MLI18n::gi()->{'ebay_prepare_variations_free_text'} = '{#i18n:attributes_matching_option_free_text#}';
MLI18n::gi()->{'ebay_prepare_variations_additional_category'} = '{#i18n:attributes_matching_additional_category#}';
MLI18n::gi()->{'ebay_prepare_variations_error_text'} = '{#i18n:attributes_matching_attribute_required_error#}';
MLI18n::gi()->{'ebay_prepare_variations_error_empty_custom_attribute_name'} = '{#i18n:form_action_default_empty_custom_attribute_name#}';
MLI18n::gi()->{'ebay_prepare_variations_error_maximal_number_custom_attributes_exceeded'} = '{#i18n:form_action_default_maximal_number_custom_attributes_exceeded#}';
MLI18n::gi()->{'ebay_prepare_variations_theme_mandatory_error'} = 'ebay_prepare_variations_theme_mandatory_error';
MLI18n::gi()->{'ebay_prepare_variations_error_missing_value'} = '{#i18n:attributes_matching_attribute_required_missing_value#}';
MLI18n::gi()->{'ebay_prepare_variations_error_free_text'} = '{#i18n:attributes_matching_attribute_free_text_error#}';
MLI18n::gi()->{'ebay_prepare_variations_matching_table'} = '{#i18n:attributes_matching_table_matched_headline#}';
MLI18n::gi()->{'ebay_prepare_variations_manualy_matched'} = '{#i18n:attributes_matching_type_manually_matched#}';
MLI18n::gi()->{'ebay_prepare_variations_auto_matched'} = '{#i18n:attributes_matching_type_auto_matched#}';
MLI18n::gi()->{'ebay_prepare_variations_free_text_add'} = '{#i18n:attributes_matching_type_free_text#}';
MLI18n::gi()->{'ebay_prepare_variations_reset_info'} = '{#i18n:attributes_matching_reset_matching_message#}';
MLI18n::gi()->{'ebay_prepare_variations_change_attribute_info'} = '{#i18n:attributes_matching_change_attribute_info#}';
MLI18n::gi()->{'ebay_prepare_variations_additional_attribute_label'} = '{#i18n:attributes_matching_custom_attributes#}';
MLI18n::gi()->{'ebay_prepare_variations_separator_line_label'} = '{#i18n:attributes_matching_option_separator#}';
MLI18n::gi()->{'ebay_prepare_variations_mandatory_fields_info'} = '{#i18n:attributes_matching_mandatory_fields_info#}';
MLI18n::gi()->{'ebay_prepare_variations_already_matched'} = '{#i18n:attributes_matching_already_matched#}';
MLI18n::gi()->{'ebay_prepare_variations_category_without_attributes_info'} = '{#i18n:attributes_matching_category_without_attributes_message#}';
MLI18n::gi()->{'ebay_prepare_variations_error_duplicated_custom_attribute_name'} = '{#i18n:form_action_default_duplicated_custom_attribute_name#}';
MLI18n::gi()->{'ebay_prepare_variations_choose_mp_value'} = '{#i18n:attributes_matching_option_marketplace_value#}';
MLI18n::gi()->{'ebay_prepare_variations_notice'} = '{#i18n:attributes_matching_prepared_different_notice#}';
MLI18n::gi()->{'ebay_varmatch_attribute_changed_on_mp'} = '{#i18n:attributes_matching_attribute_value_changed_from_marketplace_message#}';
MLI18n::gi()->{'ebay_varmatch_attribute_different_on_product'} = '{#i18n:attributes_matching_attribute_matched_different_global_message#}';
MLI18n::gi()->{'ebay_varmatch_attribute_deleted_from_mp'} = '{#i18n:attributes_matching_attribute_deleted_from_marketplace_message#}';
MLI18n::gi()->{'ebay_varmatch_attribute_value_deleted_from_mp'} = '{#i18n:attributes_matching_attribute_value_deleted_from_marketplace_message#}';
MLI18n::gi()->{'ebay_varmatch_attribute_deleted_from_shop'} = '{#i18n:attributes_matching_attribute_deleted_from_shop_message#}';
MLI18n::gi()->{'ebay_varmatch_define_name'} = 'ebay_varmatch_define_name';
MLI18n::gi()->{'ebay_varmatch_ajax_error'} = 'ebay_varmatch_ajax_error';
MLI18n::gi()->{'ebay_varmatch_all_select'} = '{#i18n:attributes_matching_option_all#}';
MLI18n::gi()->{'ebay_varmatch_please_select'} = '{#i18n:attributes_matching_option_please_select#}';
MLI18n::gi()->{'ebay_varmatch_auto_matchen'} = '{#i18n:attributes_matching_option_auto_match#}';
MLI18n::gi()->{'ebay_varmatch_reset_matching'} = '{#i18n:attributes_matching_option_reset_matching#}';
MLI18n::gi()->{'ebay_varmatch_delete_custom_title'} = 'ebay_varmatch_delete_custom_title';
MLI18n::gi()->{'ebay_varmatch_delete_custom_content'} = 'ebay_varmatch_delete_custom_content';
MLI18n::gi()->{'ebay_prepare_variations_multiselect_hint'} = '{#i18n:attributes_matching_multi_select_hint#}';
MLI18n::gi()->{'ebay_prepare_verfiyproduct_error_1605109425'} = 'An error has occurred during the validation of the products: The product (SKU: {#sku#}) has no valid variants.';
