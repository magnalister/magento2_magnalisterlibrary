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

MLI18n::gi()->add('cdiscount_prepare_match_manual',
    array(
        'legend' => array(
            'unit' => 'Allgemeine Einstellungen',
            'manualmatching' => 'Matching'
        ),
        'field' => array(
            'price' => array(
                'label' => 'Preis',
            ),
            'itemcondition' => array(
                'label' => 'Zustand',
            ),
            'preparationtime' => array(
                'label' => 'Preparation time',
            ),
            'fee' => array(
                'label' => 'Shipping fee',
            ),
            'shippingfeestandard' => array(
                'label' => 'Shipping fee',
            ),
            'shippingfeeextrastandard' => array(
                'label' => 'Additional shipping fee',
            ),
            'shippingfeetracked' => array(
                'label' => 'Shipping fee',
            ),
            'shippingfeeextratracked' => array(
                'label' => 'Additional shipping fee',
            ),
            'shippingfeeregistered' => array(
                'label' => 'Shipping fee',
            ),
            'shippingfeeextraregistered' => array(
                'label' => 'Additional shipping fee',
            ),
            'addfee' => array(
                'label' => 'Additional shipping fee',
            ),
            'shipping_time_standard' => array(
                'label' => 'Standard',
            ),
            'shipping_time_tracked' => array(
                'label' => 'Tracked',
            ),
            'shipping_time_registered' => array(
                'label' => 'Registered',
            ),
            'comment' => array(
                'label' => 'Hinweise zu Ihrem Artikel',
            ),
        ),
    ),
    false
);

MLI18n::gi()->form_action_prepare_and_next = 'Speichern und weiter';
MLI18n::gi()->cdiscount_label_product_at_cdiscount = 'Produkt bei Cdiscount';