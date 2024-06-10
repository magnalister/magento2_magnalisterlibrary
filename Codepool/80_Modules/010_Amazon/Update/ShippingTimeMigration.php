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

MLFilesystem::gi()->loadClass('Core_Update_Abstract');

/**
 * puts data from magnalister_amazon_prepare.ApplyData to specific columns and brings images to new format
 */
class ML_Amazon_Update_ShippingTimeMigration extends ML_Core_Update_Abstract {

    public function needExecution() {
        $aConfig = MLDatabase::factorySelectClass()->select('`value`')->from('magnalister_config')->where("mpid = '0' AND mkey = 'AmazonShippingTimeMigrationV2'")->getResult();
        return !isset($aConfig[0]['value']);
    }

    public function execute() {
        try {
            if (MLDatabase::getDbInstance()->tableExists('magnalister_amazon_prepare')) {
                MLDatabase::getDbInstance()->update('magnalister_amazon_prepare',
                    array('ShippingTime' => '-'),
                    array('ShippingTime' => '0')
                );
                MLDatabase::getDbInstance()->insert('magnalister_config', array('mpid' => 0, 'mkey' => 'AmazonShippingTimeMigrationV2', 'value' => 1));
            }
        } catch (\Exception $ex) {
            MLMessage::gi()->addDebug($ex);
        }
        return parent::execute();
    }

}
