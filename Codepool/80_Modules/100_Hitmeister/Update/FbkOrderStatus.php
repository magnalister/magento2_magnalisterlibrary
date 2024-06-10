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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Core_Update_Abstract');

class ML_Hitmeister_Update_FbkOrderStatus extends ML_Core_Update_Abstract {
    public function execute() {
        $oDB = MLDatabase::getDbInstance();

        foreach (MLShop::gi()->getMarketplaces() as $iMarketPlace => $sMarketplace) {
            if ($sMarketplace === 'hitmeister' && $oDB->tableExists('magnalister_config')) {

                $oEntryExists = MLDatabase::factorySelectClass();
                $count = $oEntryExists->from('magnalister_config')->where("mpID = '".$iMarketPlace."' AND mkey = 'orderstatus.fbk'")->getCount();

                if ((int)$count === 0) {
                    $oSelectConfig = MLDatabase::factorySelectClass();
                    $aConfigs = $oSelectConfig->from('magnalister_config')->where("mpID = '".$iMarketPlace."' AND mkey = 'orderstatus.open'")->getResult();

                    if (!empty($aConfigs)) {
                        foreach ($aConfigs as $aConfig) {
                            $oDB->insert('magnalister_config', array(
                                'mpID' => $aConfig['mpID'],
                                'mkey' => 'orderstatus.fbk',
                                'value' => $aConfig['value']
                            ));
                        }
                    }
                }
            }
        }
        return parent::execute();
    }
}
