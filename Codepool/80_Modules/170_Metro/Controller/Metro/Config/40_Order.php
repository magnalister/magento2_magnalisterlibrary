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

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_ConfigAbstract');

class ML_Metro_Controller_Metro_Config_Order extends ML_Form_Controller_Widget_Form_ConfigAbstract {
    public static function getTabTitle() {
        return MLI18n::gi()->get('metro_config_account_orderimport');
    }

    public static function getTabActive() {
        return self::calcConfigTabActive(__class__, false);
    }

    public function __construct() {
        foreach (array('SyncOrderStatus', 'SyncInventory', 'ImportOrders') as $sSync) {
            /*
             * sSyncOrderStatusUrl, sSyncInventoryUrl, sImportOrdersUrl
             */
            try {
                MLSetting::gi()->get('s'.$sSync.'Url');
            } catch (Exception $ex) {
                MLSetting::gi()->{'s'.$sSync.'Url'} = MLHttp::gi()->getFrontendDoUrl(array('do' => $sSync, 'auth' => md5(MLShop::gi()->getShopId().trim(MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.passphrase')->get('value')))));
            }

        }
        parent::__construct();
    }

}
