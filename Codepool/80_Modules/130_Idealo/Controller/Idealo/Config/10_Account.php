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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_ConfigAbstract');

class ML_Idealo_Controller_Idealo_Config_Account extends ML_Form_Controller_Widget_Form_ConfigAbstract {

    public function __construct() {
        parent::__construct();
    }

    public static function getTabTitle() {
        return MLI18n::gi()->get('idealo_config_account_title');
    }

    public static function getTabActive() {
        return self::calcConfigTabActive(__class__, true);
    }

    protected function callAjaxDontShowWarning() {
        MLDatabase::factorySelectClass()->from('magnalister_config')
            ->where("mkey = 'checkout.token' AND mpid='".((int)MLModul::gi()->getMarketPlaceId())."'")
            ->update('magnalister_config', array('mkey' => 'OLD_checkout.token'))->doUpdate();
        MLSetting::gi()->add(
            'aAjax', array(
                'success' => true,
                'error'   => '',
            )
        );
        return true;

    }
}
