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
class ML_Etsy_Update_MoveDataToNewColumns extends ML_Core_Update_Abstract {

    // keys in array are the old field configuration names and values are the new filed names
    protected $aChangedConfigKeys = array(
        'shippingtemplatetitle' => 'shippingprofiletitle',
        'shippingtemplatecountry' => 'shippingprofileorigincountry',
        'shippingtemplateprimarycost' => 'shippingprofileprimarycost',
        'shippingtemplatesecondarycost' => 'shippingprofilesecondarycost',
        'shippingtemplateminprocessingdays' => 'shippingprofileminprocessingtime',
        'shippingtemplatemaxprocessingdays' => 'shippingprofilemaxprocessingtime',
        'shippingtemplatemindeliverytime' => 'shippingprofilemindeliverydays',
        'shippingtemplatemaxdeliverytime' => 'shippingprofilemaxdeliverydays',
        'shippingtemplateoriginpostalcode' => 'shippingprofileoriginpostalcode',
        'shippingtemplatesend' => 'shippingprofilesend',
        'shippingtemplate' => 'shippingprofile',
    );

    public function execute() {
        $oDB = MLDatabase::getDbInstance();
        if ($oDB->tableExists('magnalister_etsy_prepare')) {
            // when column ShippingProfile no exists yet add it first
            if (!$oDB->columnExistsInTable('ShippingProfile', 'magnalister_etsy_prepare')) {
                $oDB->query("
                    ALTER TABLE `magnalister_etsy_prepare` ADD `ShippingProfile` TEXT NOT NULL DEFAULT '' COMMENT 'New column for Etsy V3 API' AFTER `ShippingTemplate`;
                ");
            }

            // only migrate data while column ShippingTemplate exists
            if ($oDB->columnExistsInTable('ShippingTemplate', 'magnalister_etsy_prepare')) {
                $oDB->query("
                    UPDATE `magnalister_etsy_prepare` 
                       SET `ShippingProfile` = `ShippingTemplate`, `ShippingTemplate` = ''
                     WHERE     `ShippingProfile` = '' 
                           AND `ShippingTemplate` IS NOT NULL
                ");
            }
        }

        foreach (MLShop::gi()->getMarketplaces() as $iMarketPlace => $sMarketplace) {
            if ($sMarketplace === 'etsy' && $oDB->tableExists('magnalister_config')) {
                foreach ($this->aChangedConfigKeys as $oldConfigName => $newConfigName) {
                    $oOldConfigDb = MLDatabase::factorySelectClass();
                    $aConfig = $oOldConfigDb->from('magnalister_config')->where("mpid = '".$iMarketPlace."' AND mkey = '".$oldConfigName."'")->getRowResult();

                    if (isset($aConfig['value']) && !empty($aConfig['value'])) {
                        $oNewConfigDb = MLDatabase::factorySelectClass();
                        $aNewConfig = $oNewConfigDb->from('magnalister_config')->where("mpid = '".$iMarketPlace."' AND mkey = '".$newConfigName."'")->getRowResult();
                        if (!isset($aNewConfig['value'])) {
                            $oDB->insert('magnalister_config', array('mpid' => $iMarketPlace, 'mkey' => $newConfigName, 'value' => $aConfig['value']));
                        }

                        // delete old config data
                        $oOldConfigDb->delete('magnalister_config')->doDelete();
                    }
                }
            }
        }

        return parent::execute();
    }
}
