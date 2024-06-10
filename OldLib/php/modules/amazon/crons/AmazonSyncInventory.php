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

if (!defined('_ML_INSTALLED'))
    throw new Exception('Direct Access to this location is not allowed.');

require_once(DIR_MAGNALISTER_MODULES.'magnacompatible/crons/MagnaCompatibleSyncInventory.php');
require_once(DIR_MAGNALISTER_MODULES.'amazon/amazonFunctions.php');

class AmazonSyncInventory extends MagnaCompatibleSyncInventory {
    private $bopisStoresConfig = array();

    protected function getPriceObject(){
        //$oProduct=$this->oProduct;// amazon dont need it
        return MLModule::gi()->getPriceObject();
    }

	protected function updateCustomFields(&$data) {
        $shopData = MLShop::gi()->getShopInfo();
        if ($this->oProduct->exists() && $shopData['DATA']['IsBopisPilot'] === 'yes') {
            //if (isset($this->cItem['BopisStoresQuantity'])) {
            $storeQuantityUpdate = $this->updateBopisStoresQuantity(empty($data));

            if ($storeQuantityUpdate !== false) {
                $data['BopisStoresQuantity'] = $storeQuantityUpdate;
                $this->log("\n\t" .
                    'BOPIS Stores Quantity updated...'
                );
            }
        }

		if (empty($data)) {
			return;
		}

        // Set shipping time
        $data['ShippingTime'] = amazonGetLeadtimeToShip($this->mpID, $this->cItem['pID']);


		if (isset($this->cItem['BusinessPrice'])) {
			$pU = $this->updateBusinessPrice();
			if ($pU !== false) {
				$data['BusinessPrice'] = $pU;
			}
		}
	}

    protected function getStockConfig() {
        return MLModule::gi()->getStockConfig();
    }

	protected function updateBusinessPrice() {
		if (!$this->oProduct->exists() || !$this->syncPrice) {
			return false;
		} else {
			$data = false;
			try{
				$price = $this->oProduct->getSuggestedMarketplacePrice($this->getBusinessPriceObject());
				if (($price > 0) && ((float) $this->cItem['BusinessPrice'] != $price)) {
					$this->log("\n\t" .
						'Business price changed (old: ' . $this->cItem['Price'] . '; new: ' . $price . ')'
					);
					$data = $price;
				} else {
					$this->log("\n\t" .
						'Business price not changed (' . $price . ')'
					);
				}
			}  catch (Exception $oExc){
				$this->log("\n\t" .$oExc->getMessage());
			}

			return $data;
		}
	}

	/**
	 * Configures price-object
	 * @return ML_Shop_Model_Price_Interface
	 */
	private function getBusinessPriceObject() {
		$sKind = MLModule::gi()->getConfig('b2b.price.addkind');
		if (isset($sKind)) {
			$fFactor = (float)MLModule::gi()->getConfig('b2b.price.factor');
			$iSignal = MLModule::gi()->getConfig('b2b.price.signal');
			$iSignal = $iSignal === '' ? null : (int)$iSignal;
			$blSpecial = (boolean)MLModule::gi()->getConfig('b2b.price.usespecialoffer');
			$sGroup = MLModule::gi()->getConfig('b2b.price.group');
			$oPrice = MLPrice::factory()->setPriceConfig($sKind, $fFactor, $iSignal, $sGroup, $blSpecial);
		} else {
			$oPrice = $this->getPriceObject();
		}

		return $oPrice;
	}

    /**
     * Check if a quantity of one or more BOPIS stores has been changed
     *  if so update stock of the changed store quantities (could also remove existing store quantities)
     *
     * @return bool|array
     */
    private function updateBopisStoresQuantity($submitStoreStockAnyways) {
        $return = array();

        // load configuration
        if (empty($this->bopisStoresConfig)) {
            $configStore = MLModule::gi()->getConfig('bopis.stockmanagement.store');
            $quantityConfigType = MLModule::gi()->getConfig('bopis.stockmanagement.quantity.type');
            $quantityConfigValue = MLModule::gi()->getConfig('bopis.stockmanagement.quantity.value');

            foreach ($configStore as $index => $store) {
                $this->bopisStoresConfig[$store] = array(
                    'type' => $quantityConfigType[$index],
                    'value' => $quantityConfigValue[$index],
                );
            }
        }

        $preparedProduct = MLDatabase::factory('amazon_prepare')->set('productsid', $this->oProduct->get('id'));

        $bopisStores = $preparedProduct->get('BopisStores');

        // no stores selected or not prepared
        if (empty($bopisStores) || $bopisStores == 'null') {
            //if store stock was returned from API set them all to 0
            if (isset($this->cItem['BopisStoresQuantity']) && is_array($this->cItem['BopisStoresQuantity'])) {
                // iterate through all Bopis stores
                foreach ($this->cItem['BopisStoresQuantity'] as $storeId => $storeQuantity) {
                    // only update when provided quantity is greater than 0
                    if ($storeQuantity > 0) {
                        $return[$storeId] = 0;
                    }
                }

                return $return;
            }

            return false;
        }

        // used to hold stock for stores but when no changes are we not submit any stock
        $cacheStock = array();
        $useCache = false;

        if (is_string($bopisStores)) {
            $bopisStores = explode(',', $bopisStores);
        }

        // Compare all stores and quantity settings, if something has changed return array of data
        foreach ($bopisStores as $storeId) {
            $stock = $this->oProduct->getSuggestedMarketplaceStock(
                $this->bopisStoresConfig[$storeId]['type'],
                $this->bopisStoresConfig[$storeId]['value'],
                isset($this->bopisStoresConfig[$storeId]['max']) ? $this->bopisStoresConfig[$storeId]['max'] : null
            );

            // when store is not configured
            if (!array_key_exists($storeId, $this->bopisStoresConfig)) {
                $stock = 0;
            }

            // when normal quantity is changed we also provide store stock
            if ($submitStoreStockAnyways) {
                $return[$storeId] = $stock;
            } else {
                $cacheStock[$storeId] = $stock;
            }

            // ToDo: Check if store is enabled if not submit 0 stock (optional)

            // when store is newly prepared or not store stock is on marketplace
            if (!isset($this->cItem['BopisStoresQuantity']) || !array_key_exists($storeId, $this->cItem['BopisStoresQuantity'])) {
                $useCache = true;
            } elseif ($this->cItem['BopisStoresQuantity'][$storeId] != $stock) { // when stock has changed for at least one store
                $useCache = true;
            }

        }

        // when changes should happen by stock cache
        if ($useCache) {
            $return = array_merge($return, $cacheStock);
        }

        // no changes
        if (empty($return)) {
            return false;
        }

        return $return;

    }
}
