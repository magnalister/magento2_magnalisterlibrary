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

//
MLSetting::gi()->add('configuration', array(
    'general' => array(
        'fields' => array(
            'pass' => array(
                'name' => 'general.passphrase',
                'type' => 'string',
            ),
        ),
    ),
    'sku' => array(
        'fields' => array(
            'sku' => array(
                'name' => 'general.keytype',
                'type' => 'radio',
                'alertvalue' => array('pID', 'artNr'),
                'inputCellStyle' => 'line-height: 1.5em;',
                'separator' => '<br/>',
                'default' => 'artNr',
            )
        )
    ),
    'stats' => array(
        'fields' => array(
            'back' => array(
                'name' => 'general.stats.backwards',
                'type' => 'select',
                'default' => '5',
            ),
        ),
    ),
    'orderimport' => array(
        'fields' => array(
            'orderinformation' => array(
                'type' => 'bool',
                'name' => 'general.order.information',
                'default' => array(
                    'val' => false
                )
            ),
        ),
    ),
    'cronTimeTable' => array(
        'fields' => array(
            'editor'           => array(
                'name'           => 'general.editor',
                'type'           => 'radio',
                'expert'         => true,
                'inputCellStyle' => 'line-height: 1.5em;',
                'separator'      => '<br/>',
                'default'        => 'tinyMCE',
            ),
            'cronfronturl '    => array(
                'name'   => 'general.cronfronturl',
                'type'   => 'string',
                'expert' => true,
            ),
        ),
    ),
    'articleStatusInventory' => array(
        'fields' => array(
            'statusIsZero' => array(
                'name' => 'general.inventar.productstatus',
                'type' => 'radio',
                'default' => 'false',
            )
        )
    ),
    'productfields' => array(
        'fields' => array(
            'manufacturer' => array(
                'name' => 'general.manufacturer',
                'type' => 'select',
            ),
            'mfnpartno' => array(
                'name' => 'general.manufacturerpartnumber',
                'type' => 'select',
            ),
            'EAN' => array(
                'name' => 'general.ean',
                'type' => 'select',
            ),
            'UPC' => array(
                'name' => 'general.upc',
                'type' => 'select',
            ),
        ),
    ),
        )
);
