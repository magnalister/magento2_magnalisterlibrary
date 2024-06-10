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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLSetting::gi()->add('aModules', array(
    'check24' => array(
        'title' => '{#i18n:sModuleNameCheck24#}',
        'logo' => 'check24',
        'type' => 'marketplace',
        'displayAlways' => false,
        'requiredConfigKeys' => array(
            'lang',
            'quantity.type',
            'price.addkind',
            'price.factor',
            'exchangerate_update',
            'import',
            'orderstatus.open',
            'mwst.fallback',
            'stocksync.frommarketplace',
            'stocksync.tomarketplace',
            'inventorysync.price',
            'orderimport.shop',
        ),
        'authKeys' => array(
            'mpusername' => 'MPUSERNAME',
            'mppassword' => 'MPPASSWORD',
            'port' => 'PORT',
            'ftpserver' => 'FTPSERVER'
        ),
        'settings' => array(
            'defaultpage' => 'checkin',
            'subsystem' => 'Check24',
            'currency' => 'EUR',
            'hasOrderImport' => true,
        ),
    ),
));
