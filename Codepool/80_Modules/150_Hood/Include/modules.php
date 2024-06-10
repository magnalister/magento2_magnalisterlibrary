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
    'hood' => array(
        'title' => '{#i18n:sModuleNameHood#}',
        'logo' => 'hood',
        'displayAlways' => false,
        'requiredConfigKeys' => array(
            'mpusername',
            'apikey',
            'lang',
            'template.name',
            'usevariations',
            'mwstfallback',
            'fixed.price.addkind',
            'fixed.price.group',
            'chinese.price.addkind',
            'chinese.price.group',
            'orderimport.shop',
            'stocksync.tomarketplace',
        ),
        'authKeys' => array(
            'apikey' => 'KEY',
            'mpusername' => 'MPUSERNAME',
        ),
        'settings' => array(
            'defaultpage' => 'prepare',
            'subsystem' => 'hood',
            'currency' => '__depends__',
            'hasOrderImport' => true,
        ),
        'type' => 'marketplace',
    )
));
