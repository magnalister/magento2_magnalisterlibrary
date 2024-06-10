<?php
if (!defined('TABLE_MAGNA_CONFIG')) {
    define('TABLE_MAGNA_CONFIG', 'magnalister_config');
    define('TABLE_MAGNA_SESSION', 'magnalister_session');
    define('TABLE_MAGNA_SELECTION', 'magnalister_selection');
    define('TABLE_MAGNA_SELECTION_TEMPLATES', 'magnalister_selection_templates');
    define('TABLE_MAGNA_SELECTION_TEMPLATE_ENTRIES', 'magnalister_selection_template_entries');
    define('TABLE_MAGNA_ORDERS', 'magnalister_orders');
    define('TABLE_MAGNA_VARIATIONS', 'magnalister_variations');
    define('TABLE_MAGNA_CS_DELETEDLOG', 'magnalister_cs_deletedlog');
    define('TABLE_MAGNA_YATEGO_CATEGORIES', 'magnalister_yatego_categories');
    define('TABLE_MAGNA_YATEGO_CUSTOM_CATEGORIES', 'magnalister_yatego_custom_categories');
    define('TABLE_MAGNA_YATEGO_CATEGORYMATCHING', 'magnalister_yatego_categorymatching');
    define('TABLE_MAGNA_EBAY_CATEGORIES', 'magnalister_ebay_categories');
    define('TABLE_MAGNA_EBAY_PROPERTIES', 'magnalister_ebay_properties');
    define('TABLE_MAGNA_EBAY_LISTINGS', 'magnalister_ebay_listings');
    define('TABLE_MAGNA_EBAY_DELETEDLOG', 'magnalister_ebay_deletedlog');
    define('TABLE_MAGNA_TECDOC', 'magnalister_tecdoc');
    define('TABLE_MAGNA_API_REQUESTS', 'magnalister_api_requests');
    define('TABLE_MAGNA_MEINPAKET_CATEGORYMATCHING', 'magnalister_meinpaket_categorymatching');
    define('TABLE_MAGNA_MEINPAKET_CATEGORIES', 'magnalister_meinpaket_categories');
    define('TABLE_MAGNA_COMPAT_CATEGORYMATCHING', 'magnalister_magnacompat_categorymatching');
    define('TABLE_MAGNA_COMPAT_CATEGORIES', 'magnalister_magnacompat_categories');
    define('TABLE_MAGNA_COMPAT_DELETEDLOG', 'magnalister_magnacompat_deletedlog');
    define('TABLE_MAGNA_HITMEISTER_PREPARE', 'magnalister_hitmeister_prepare');
    define('TABLE_MAGNA_PRICEMINISTER_PREPARE', 'magnalister_priceminister_prepare');
    define('TABLE_MAGNA_ERRORLOG', 'magnalister_errorlog');

    define('MAGNADB_ENABLE_LOGGING', false);
}
MLDatabase::factory('apirequest');
MLDatabase::factory('config');
MLDatabase::factory('order');
MLDatabase::factory('preparedefaults');
MLDatabase::factory('selection');
MLDatabase::factory('MagnaCompatibleErrorlog');
MLDatabase::factory('globalselection');