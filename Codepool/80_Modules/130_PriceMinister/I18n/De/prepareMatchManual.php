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
 * (c) 2010 - 2015 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLI18n::gi()->add('priceminister_prepare_match_manual',
    array(
        'legend' => array(
            'unit' => 'Allgemeine Einstellungen',
            'manualmatching' => 'Matching',
            'variationmatching' => array('{#i18n:attributes_matching_required_attributes#}', '{#i18n:attributes_matching_title#}'),
            'variationmatchingoptional' => array('{#i18n:attributes_matching_optional_attributes#}', '{#i18n:attributes_matching_title#}'),
            'variationmatchingcustom' => array('{#i18n:attributes_matching_custom_attributes#}', '{#i18n:attributes_matching_title#}'),
            'subcategories' => 'PriceMinister Subcategories',
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
            'itemcondition' => array(
                'label' => 'Zustand',
            ),
            'comment' => array(
                'label' => 'Hinweise zu Ihrem Artikel',
            ),
        ),
    ),
    false
);

MLI18n::gi()->form_action_prepare_and_next = 'Speichern und weiter';
MLI18n::gi()->priceminister_label_product_at_priceminister = 'Produkt bei PriceMinister';
MLI18n::gi()->priceminister_not_matched_category = 'In order to perform product matching for selected products, please first match category attributes in "Varianten Matching" tab for following categories:';
