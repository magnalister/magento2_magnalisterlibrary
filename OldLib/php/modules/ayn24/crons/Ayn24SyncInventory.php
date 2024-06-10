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

class Ayn24SyncInventory extends MagnaCompatibleSyncInventory {

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
    
    /* No upload */
    protected function uploadItems() {
        return true;
    }
}
