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
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLI18n::gi()->add('mercadolivre_prepare_form',array(
	'legend' => array(
        'details' => 'Produktdetails',
        'categories' => 'MercadoLivre Kategorien',
        'variationmatching' => array('{#i18n:attributes_matching_required_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingoptional' => array('{#i18n:attributes_matching_optional_attributes#}', '{#i18n:attributes_matching_title#}'),
        'variationmatchingcustom' => array('{#i18n:attributes_matching_custom_attributes#}', '{#i18n:attributes_matching_title#}'),
        'configmatching' => 'MercadoLivre Config',
    ),
    'field' => array(
		'categories' => array(
            'label' => 'MercadoLivre Kategorien',
        ),
        'primarycategory' => array(
            'label' => '1. Marktplatz-Kategorie:',
        ),
		'currency' => array(
            'label' => 'Currency',
        ),
		'itemcondition' => array(
            'label' => 'Item condition',
        ),
		'listingtype' => array(
            'label' => 'Listing type',
        ),
		'buyingmode' => array(
            'label' => 'Buying mode',
        ),
		'shippingmode' => array(
            'label' => 'Shipping mode',
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
    ),
),false);

MLI18n::gi()->mercadolivre_prepareform_max_length_part1 = 'Max length of';
MLI18n::gi()->mercadolivre_prepareform_max_length_part2 = 'attribute is';
MLI18n::gi()->mercadolivre_prepareform_reqired_fieds = '<p><b>Hinweis:</b> Die mit <span class="bull">•</span> markierten Felder sind Pflichtfelder und müssen ausgefüllt werden.</p>';
