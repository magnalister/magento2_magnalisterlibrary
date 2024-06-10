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

MLFilesystem::gi()->loadClass('Productlist_Controller_Widget_ProductList_UploadAbstract');

class ML_PriceMinister_Controller_PriceMinister_Checkin extends ML_Productlist_Controller_Widget_ProductList_UploadAbstract {

    public function getStock(ML_Shop_Model_Product_Abstract $oProduct) {
        $aStockConf = MLModule::gi()->getStockConfig();

        $checkinListingType = MLModule::gi()->getConfig('checkin.listingtype');

        if ($checkinListingType === 'free') {
            return 1;
        } else {
            return $oProduct->getSuggestedMarketplaceStock($aStockConf['type'], $aStockConf['value']);
        }
    }

    public function getConditions(ML_Shop_Model_Product_Abstract $oProduct) {
        $catSettings = $this->getGategorySettings($oProduct);
        if ($catSettings !== null) {
            $checkinItemCondition = MLModule::gi()->getConfig('checkin.itemcondition');
            $itemConditions = array();

            foreach ($catSettings['ItemConditions'] as $itemCondition) {
                $itemConditions[$itemCondition] = $itemCondition === $checkinItemCondition;
            }

            return $itemConditions;
        }

        return array();
    }

    public function isConditionAllowed(ML_Shop_Model_Product_Abstract $oProduct) {
        $catSettings = $this->getGategorySettings($oProduct);
        return !($catSettings !== null && count($catSettings['ItemConditions']) === 1 && current($catSettings['ItemConditions']) === 'not_allowed');
    }

    public function getListingTypes() {
        $listingTypes = MLModule::gi()->getConfig('site.listing_types');

        $checkinListingType = MLModule::gi()->getConfig('checkin.listingtype');
        $availableListingTypes = array();

        foreach ($listingTypes as $value => $name) {
            $availableListingTypes[$value] = array(
                'Name' => $name,
                'IsDefault' => $value === $checkinListingType
            );
        }

        return $availableListingTypes;
    }

    private function getGategorySettings(ML_Shop_Model_Product_Abstract $oProduct) {
        $oModel = MLDatabase::factory('priceminister_prepare')->set('products_id', $oProduct->get('id'));
        if ($oModel->exists()) {
            $cat = $oModel->get('PrimaryCategory');
            $catSettings = $this->callApi(array('ACTION' => 'GetCategory', 'DATA' => array('CategoryID' => $cat)), 1 * 60 * 60);
            return $catSettings;
        } else {
            return null;
        }
    }

    protected function callApi($aRequest, $iLifeTime) {
        try {
            $aResponse = MagnaConnector::gi()->submitRequestCached($aRequest, $iLifeTime);
            if ($aResponse['STATUS'] == 'SUCCESS' && isset($aResponse['DATA']) && is_array($aResponse['DATA'])) {
                return $aResponse['DATA'];
            } else {
                return array();
            }
        } catch (MagnaException $e) {
            return array();
        }
    }

}
