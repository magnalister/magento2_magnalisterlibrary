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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLFilesystem::gi()->loadClass('Core_Update_Abstract');

class ML_Ebay_Update_ResetOrderStatus20191206 extends ML_Core_Update_Abstract {

    public function needExecution() {
        $aConfig = MLDatabase::factorySelectClass()->select('`value`')->from('magnalister_config')->where("mpid = '0' AND mkey = 'ResetOrderStatus20191206'")->getResult();
        return !isset($aConfig[0]['value']);
    }

    public function execute() {
        try {
            $this->fillMarketplaceOpenStatus();
            $this->fillMarketplaceCancelStatus();
            $oDB = MLDatabase::getDbInstance();
            if (
                $oDB->tableExists('magnalister_config')
                && $oDB->tableExists('magnalister_orders')
            ) {
                foreach ($this->aOpenStatusCache as $sMarketplaceID => $sStatus) {
                    $sOpenStatus = MLDatabase::getDbInstance()->escape($sStatus);
                    $sCancelStatus = MLDatabase::getDbInstance()->escape($this->aCancelStatusCache[$sMarketplaceID]);

                    MLlog::gi()->add('OrderImport_ResetOrderStatus20191206', MLDatabase::getDbInstance()->fetchArray(
                        'SELECT * FROM `magnalister_orders`
                        WHERE `mpid` = '.((int)$sMarketplaceID).' AND `insertTime` > \'2019-12-05 10:00:00\' AND `insertTime` < \'2019-12-06 11:00:00\' AND status <> '.$sCancelStatus.'
                        '));

                    MLDatabase::getDbInstance()->query('
                        UPDATE `magnalister_orders`
                        SET `status` = '.$sOpenStatus.'
                        WHERE `mpid` = '.((int)$sMarketplaceID).' AND `insertTime` > \'2019-12-05 10:00:00\' AND `insertTime` < \'2019-12-06 11:00:00\' AND status <> '.$sCancelStatus.'
                        ');

                    MLlog::gi()->add('OrderImport_ResetOrderStatus20191206', 'Number of effected orders :'.MLDatabase::getDbInstance()->affectedRows());
                }
            }
            MLDatabase::getDbInstance()->insert('magnalister_config', array('mpid' => 0, 'mkey' => 'ResetOrderStatus20191206', 'value' => 1));
        } catch(Exception $oEx){
            MLMessage::gi()->addDebug($oEx);
        }
        return parent::execute();
    }

    protected $aOpenStatusCache = array();

    protected function fillMarketplaceOpenStatus() {
        $mResult = MLDatabase::getDbInstance()->fetchArray('SELECT `mpid` FROM `magnalister_orders` WHERE `platform` = \'ebay\' AND `insertTime` > \'2019-12-05 10:00:00\' AND `insertTime` < \'2019-12-06 11:00:00\' GROUP BY `mpid`');

        if (is_array($mResult)) {
            foreach ($mResult as $aConfig) {
                $this->aOpenStatusCache[$aConfig['mpid']] = MLDatabase::getDbInstance()->fetchOne('SELECT `value` FROM `magnalister_config` WHERE `mpid` = \'' . ((int)$aConfig['mpid']) . '\' AND `mkey` = \'orderstatus.open\' ');
            }
        }
    }


    protected $aCancelStatusCache = array();

    protected function fillMarketplaceCancelStatus() {
        $mResult = MLDatabase::getDbInstance()->fetchArray('SELECT `mpid` FROM `magnalister_orders` WHERE `platform` = \'ebay\' AND `insertTime` > \'2019-12-05 10:00:00\' AND `insertTime` < \'2019-12-06 11:00:00\' GROUP BY `mpid`');
        if (is_array($mResult)) {
            foreach ($mResult as $aConfig) {
                $this->aCancelStatusCache[$aConfig['mpid']] = MLDatabase::getDbInstance()->fetchOne('SELECT `value` FROM `magnalister_config` WHERE `mpid` = \'' . ((int)$aConfig['mpid']) . '\' AND `mkey` = \'orderstatus.cancelled\' ');
            }
        }
    }

}
