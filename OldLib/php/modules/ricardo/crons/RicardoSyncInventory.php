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
if (!defined('_ML_INSTALLED'))
    throw new Exception('Direct Access to this location is not allowed.');

require_once(DIR_MAGNALISTER_MODULES . 'magnacompatible/crons/MagnaCompatibleSyncInventory.php');

class RicardoSyncInventory extends MagnaCompatibleSyncInventory {

    protected function getPriceObject(){
        return MLModule::gi()->getPriceObject();
    }

    protected function getStockConfig() {
        return MLModule::gi()->getStockConfig();
    }
	
	protected function initConfig() {
        $ckeys = $this->getConfigKeys();
        foreach ($ckeys as $k => $o) {
            $this->config[$k] = getDBConfigValue($o['key'], $this->mpID);
            /* Not found, try global config. */
            if ($this->config[$k] === null) {
                $this->config[$k] = getDBConfigValue($o['key'], 0);
            }
            /* Still not found. Use default. */
            if ($this->config[$k] === null) {
                $this->config[$k] = isset($o['default']) ? $o['default'] : null;
            }
        }
    }
    
    protected function updatePrice() {
        if (!$this->oProduct->exists() || !$this->syncPrice) {
            return false;
        } else {
            $data = false;
            try{
                $price = $this->oProduct->getSuggestedMarketplacePrice($this->getPriceObject());
                if (($price > 0) && ((float) $this->cItem['Price'] != $price)) {
                    $this->log("\n\t" .
                        'Price changed (old: ' . $this->cItem['Price'] . '; new: ' . $price . ')'
                    );
                    $data = $price;
                } else {
                    $this->log("\n\t" .
                        'Price not changed (' . $price . ')'
                    );
                }
            }  catch (Exception $oExc){
                $this->log("\n\t" .$oExc->getMessage());
            }
            return $data;
        }
    }
    
    protected function updateQuantity() {
        if (!$this->syncStock) {
            return false;
        }
        
        $data = false;
        $curQty = $this->calcNewQuantity();

        if (!isset($this->cItem['Quantity'])) {
            $this->cItem['Quantity'] = 0;
        }

        if (isset($this->cItem['Quantity']) && ($this->cItem['Quantity'] != $curQty)) {
            $data = array (
				'Mode' => 'SET',
				'Value' => (int)$curQty,
				'IncreaseQuantity' => false
			);
			
			if ((int)$curQty > (int)$this->cItem['Quantity'] && $this->config['StockSync'] === 'auto_reduce') {
				$data['IncreaseQuantity'] = true;
			}
            
            $this->log("\n\t" .
                'Quantity changed (old: ' . $this->cItem['Quantity'] . '; new: ' . $curQty . ')'
            );
        } else {
            $this->log("\n\t" .
                'Quantity not changed (' . $curQty . ')'
            );
        }
        return $data;
    }
    
    protected function updateItem() {
        @set_time_limit(180);
        $this->identifySKU();
        if ((int) $this->cItem['pID'] <= 0) {
            $this->log("\n" .
                    'SKU: ' . $this->cItem['SKU'] . ' (' . $this->cItem['Title'] . ') not found'
            );
            return;
        } else {
            $this->log("\n" .
                'SKU: ' . $this->cItem['SKU'] . ' (' . $this->cItem['Title'] . ') found (' .
                'pID: ' . $this->cItem['pID'] . '; aID: ' . $this->cItem['aID'] .
            ')');
        }

        $data = array();

        $qU = $this->updateQuantity();
        if ($qU !== false) {
            $data['NewQuantity'] = $qU;
        }

        $pU = $this->updatePrice();
        if ($pU !== false) {
            $data['Price'] = $pU;
            $data['IncreasePrice'] = false;
            if ($pU > $this->cItem['Price'] && $this->config['PriceSync'] === 'auto_reduce') {
                $data['IncreasePrice'] = true;
            }
        }

        $this->updateCustomFields($data);

        $mpID = $this->mpID;
        $marketplace = $this->marketplace;
        /* {Hook} "SyncInventory_UpdateItem": Runs during the inventory synchronization from your shop to the marketplace.<br>
           Variables that can be used:
           <ul><li>$this->mpID: The ID of the marketplace.</li>
               <li>$this->marketplace: The name of the marketplace.</li>
               <li>$data (array): The content of the changes of one product (used to generate the <code>UpdateItem</code> request).<br>
                   Supported are <span class="tt">Price</span> and <span class="tt">Quantity</span>
               </li>
               <li>$this->cItem (array): The current product from the marketplaces inventory including some identification information.
                   <ul><li>SKU: Article number of marketplace</li>
                       <li>pID: products_id of product</li>
                       <li>aID: attributes_id of product</li>
                   </ul>
               </li>
          </ul>
          <p>Notice: It is only possible to modify products that have been identified by the magnalister plugin!</p>
          Example:
          <pre>// For amazon set the quantity of the product with the SKU blabla123 to be always 5
if (($this->marketplace == 'amazon') && ($this->cItem['SKU'] == 'blabla123')) {
    $data['Quantity'] = 5;
}</pre>
        */
        if (($hp = magnaContribVerify('SyncInventory_UpdateItem', 1)) !== false) {
            require($hp);
        }

        if (!empty($data)) {
            $data['SKU'] = $this->cItem['SKU'];
            $this->stockBatch[] = $data;
        }
    }
    
    protected function isAutoSyncEnabled() {
		$this->syncStock = ($this->config['StockSync'] == 'auto') || ($this->config['StockSync'] == 'auto_reduce') || ($this->config['StockSync'] == 'auto_fast');
		$this->syncPrice = ($this->config['PriceSync'] == 'auto') || ($this->config['PriceSync'] == 'auto_reduce');
		
		//$this->syncStock = $this->syncPrice = true;

		if (!($this->syncStock || $this->syncPrice)) {
			$this->log('== '.$this->marketplace.' ('.$this->mpID.'): no autosync =='."\n");
			return false;
		}
		$this->log(
			'== '.$this->marketplace.' ('.$this->mpID.'): '.
			'Sync stock: '.($this->syncStock ? 'true' : 'false').'; '.
			'Sync price: '.($this->syncPrice ? 'true' : 'false')." ==\n"
		);
		return true;
	}
}
