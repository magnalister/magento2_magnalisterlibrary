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

require_once(DIR_MAGNALISTER_MODULES.'magnacompatible/crons/MagnaCompatibleSyncInventory.php');

class HitmeisterSyncInventory extends MagnaCompatibleSyncInventory {
	public function __construct($mpID, $marketplace) {
		parent::__construct($mpID, $marketplace);
	}

	protected function calcNewQuantity() {
		if ($this->config['QuantityType'] == 'infinity') {
			return -1;
		}
		return parent::calcNewQuantity();
	}
	
	public function process() {
		parent::process();
	}

    protected function getPriceObject($sType = null){
        return MLModule::gi()->getPriceObject($sType);
    }

    // Update MinimumPrice, if enabled & different
    protected function updateCustomFields(&$data) {
        if (!$this->oProduct->exists() || !$this->syncPrice) {
            return;
        }
        if (    MLModule::gi()->getConfig('minimumpriceautomatic') !== '2'
             || MLModule::gi()->getConfig('price.lowest.addkind')  === null) {
            return;
        }
        try {
            $minimumPrice = $this->oProduct->getSuggestedMarketplacePrice($this->getPriceObject('lowest'));
            $minimumPrice = number_format($minimumPrice, 4, '.', '');
            if (($minimumPrice > 0) && ((float) $this->cItem['MinimumPrice'] != $minimumPrice)) {
                $this->log("\n\t" .
                    'Minimum Price changed (old: ' . $this->cItem['MinimumPrice'] . '; new: ' . $minimumPrice . ')'
                );
                $data['MinimumPrice'] = $minimumPrice;
            } else {
                $this->log("\n\t" .
                    'Minimum Price not changed (' . $minimumPrice . ')'
                );
            }
        }  catch (Exception $oExc){
                $this->log("\n\t" .$oExc->getMessage());
        }
    }

    protected function getStockConfig() {
        return MLModule::gi()->getStockConfig();
    }

    protected function uploadItems() {
        return true;
    }

}
