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
MLSetting::gi()->add('aModules', array(
    'cdiscount' => array(
        'title' => '{#i18n:sModuleNameCdiscount#}',
        'logo' => 'cdiscount',
        'type' => 'marketplace',
        'displayAlways' => false,
        'requiredConfigKeys' => array(
            'mpusername',
            'mppassword',
            'prepare.status',
            'lang',
            //'itemsperpage',
            'checkin.status',
            'quantity.type',
            'price.addkind',
            'price.factor',
            //'price.usespecialoffer',
            'exchangerate_update',
            'preimport.start',
            'customergroup',
            'import',
            'orderstatus.open',
            'orderstatus.sync',
            'orderstatus.shipped',
            'mwst.fallback',
            'stocksync.frommarketplace',
            'stocksync.tomarketplace',
            'inventorysync.price',
        ),
        'authKeys' => array(
            'mpusername' => 'MPUSERNAME',
            'mppassword' => 'MPPASSWORD',
        ),
        'settings' => array(
            'defaultpage' => 'checkin',
            'subsystem' => 'Cdiscount',
            'currency' => 'EUR',
            'hasOrderImport' => true,
        ),
    ),
));
