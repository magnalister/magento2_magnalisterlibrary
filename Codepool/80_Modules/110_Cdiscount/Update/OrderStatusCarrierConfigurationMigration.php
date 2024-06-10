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

MLFilesystem::gi()->loadClass('Core_Update_Abstract');

class ML_Cdiscount_Update_OrderStatusCarrierConfigurationMigration extends ML_Core_Update_Abstract {

    public function execute() {
        try {
            if (MLDatabase::getDbInstance()->tableExists('magnalister_config')) {
                $aListOfMarketplaces = MLHelper::gi('marketplace')->magnaGetIDsByMarketplace('cdiscount');

                // Check if we have any Cdiscount marketplaces
                if (is_array($aListOfMarketplaces)) {
                    foreach ($aListOfMarketplaces as $sMarketplaceId) {
                        $oModel = MLDatabase::factory('config')->set('mpID', $sMarketplaceId)->set('mkey', 'orderstatus.shipmethod.matching');
                        $mOldValue = $oModel->get('value');

                        if ($mOldValue !== null) {
                            // List is based on found values by customers
                            $newValues = array(
                                'Envoi Standard' => 'STD',
                                'Envoi Suivi' => 'TRK',
                                'Recommandé' => 'REG',
                                'Mondial Relay' => 'REL',
                                'Livraison devant chez vous' => 'LV1',
                                'Express' => 'EXP',
                            );

                            foreach ($mOldValue as &$value) {
                                if (array_key_exists($value['marketplaceCarrier'], $newValues)) {
                                    $value['marketplaceCarrier'] = $newValues[$value['marketplaceCarrier']];
                                }
                            }

                            MLDatabase::factory('config')
                                ->set('mpID', $sMarketplaceId)
                                ->set('mkey', 'orderstatus.shipmethod.matching')
                                ->set('value', $mOldValue)
                                ->save();
                        }

                        // put default carrier
                        $oModel = MLDatabase::factory('config')->set('mpID', $sMarketplaceId)->set('mkey', 'orderstatus.carrier.default');
                        $mOldValue = $oModel->get('value');

                        if ($mOldValue !== null) {
                            MLDatabase::factory('config')
                                ->set('mpID', $sMarketplaceId)
                                ->set('mkey', 'orderstatus.carrier.select')
                                ->set('value', $mOldValue)
                                ->save();

                            $oModel->delete();
                        }
                    }
                }
            }
        } catch (\Exception $ex) {
            MLMessage::gi()->addDebug($ex);
        }
        return parent::execute();
    }

}
