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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLSetting::gi()->add('aModules', array(
    'ebay' => array(
        'title' => '{#i18n:sModuleNameEbay#}',
        'logo' => 'ebay',
        'displayAlways' => true,
        'requiredConfigKeys'            => array(
            'username',
            'token',
            'site',
            'currency',
            'lang',
            'template.name',
            'postalcode',
            'location',
            'country',
            'usevariations',
            'mwstfallback',
            'fixed.price.addkind',
            'fixed.price.group',
            'chinese.price.addkind',
            'chinese.price.group',
            'orderimport.shop',
            'stocksync.tomarketplace'
        ),
        'authKeys'                      => array(
            'username' => 'USERNAME',
        ),
        'configKeysNeedsShopValidation' => array(
            'fixed.price.group',
            'strikeprice.group',
            'chinese.price.group',
        ),
        'settings'                      => array(
            'defaultpage'    => 'prepare',
            'subsystem'      => 'eBay',
            'currency'       => '__depends__',
            'hasOrderImport' => true,
        ),
        'type'                          => 'marketplace',
    )
));
