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
class ML_Hitmeister_Update_AddHandlingTime extends ML_Core_Update_Abstract {

    protected $aHandlingTimeByShippingTime = array (
            'a' => 1,
            'b' => 1,
            'c' => 4,
            'd' => 7,
            'e' => 11,
            'f' => 15,
            'g' => 29,
            'h' => 21,
            'i' => 50,
            'j' => 4,
    );

    public function execute() {
        $oDB = MLDatabase::getDbInstance();
        if ($oDB->tableExists('magnalister_hitmeister_prepare')) {
            // when column HandlingTime no exists yet add it first
            if (!$oDB->columnExistsInTable('HandlingTime', 'magnalister_hitmeister_prepare')) {
                $oDB->query("
                    ALTER TABLE `magnalister_hitmeister_prepare` ADD `HandlingTime` INT(2) NOT NULL DEFAULT 3 COMMENT '' AFTER `ShippingTime`
                ");
                foreach ($this->aHandlingTimeByShippingTime as $sShippingTime => $iHandlingTime) {
                    $oDB->query("
                        UPDATE `magnalister_hitmeister_prepare`
                           SET HandlingTime = ".$iHandlingTime."
                         WHERE ShippingTime = '".$sShippingTime."'
                    ");
                } 
            }
        }

        foreach (MLShop::gi()->getMarketplaces() as $iMarketPlace => $sMarketplace) {
            if ($sMarketplace === 'hitmeister' && $oDB->tableExists('magnalister_preparedefaults')) {
                $aDefaultConfigRow = $oDB->fetchRow(
                    'SELECT `values`, `id`
                       FROM `magnalister_preparedefaults`
                      WHERE mpid = '.$iMarketPlace.'
                        AND `name`= \'defaultconfig\'
                        ORDER BY `id` DESC LIMIT 1'
                );

                $aDefaultConfig = array();
                // when there are default config values
                if ($aDefaultConfigRow !== false) {
                    $aDefaultConfig = json_decode($aDefaultConfigRow['values'], true);
                }

                if (    array_key_exists('shippingtime', $aDefaultConfig)
                     && !array_key_exists('handlingtime', $aDefaultConfig)
                ) {
                    $newHandlingTime = 2; // fallback value
                    if (isset($this->aHandlingTimeByShippingTime[$aDefaultConfig['shippingtime']])) {
                        $newHandlingTime = $this->aHandlingTimeByShippingTime[$aDefaultConfig['shippingtime']];
                    }
                    $aDefaultConfig['handlingtime'] = $newHandlingTime;
                    $jDefaultConfig = json_encode($aDefaultConfig);
                    $oDB->update('magnalister_preparedefaults', array(
                        'values' => $jDefaultConfig,
                    ), array(
                        'mpid' => $iMarketPlace,
                        'name' => 'defaultconfig',
                        'id' => $aDefaultConfigRow['id'],
                    ));
                }
            }
        }
        return parent::execute();
    }
}
