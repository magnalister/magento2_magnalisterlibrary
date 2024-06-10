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

MLSetting::gi()->add('aModules', array(
    'amazon' => array(
        'title'                         => '{#i18n:sModuleNameAmazon#}',
        'logo'                          => 'amazon',
        'displayAlways'                 => true,
        'requiredConfigKeys'            => array(
            'site',
            'lang',
            'mwstfallback',
            'quantity.type',
            'leadtimetoship',
            'price.addkind',
            'import',
            'orderstatus.open',
            'orderstatus.fba',
            'orderstatus.sync',
            'orderstatus.cancelled',
            'stocksync.tomarketplace',
            'stocksync.frommarketplace',
            'mail.send',
            'orderimport.shop',
        ),
        'configKeysNeedsShopValidation' => array(
            'price.group',
            'b2b.price.group',
        ),
        'authKeys'                      => array(
            'site' => 'SITE',
        ),
        'settings'                      => array(
            'defaultpage'    => 'prepare',
            'subsystem'      => 'Amazon',
            'currency'       => '__depends__',
            'hasOrderImport' => true,
        ),
        'type'                          => 'marketplace',
    ),
));
