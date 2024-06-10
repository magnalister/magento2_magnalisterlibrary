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
 * (c) 2010 - 2018 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Etsy_Model_Service_SyncInventory extends ML_Modul_Model_Service_SyncInventory_Abstract {

    /**
     * In the case of Etsy, further information is transferred here,
     * e.g. whether zero stock management has been activated in the plugin.
     *
     * @param $aUpdate
     */
    protected function extendUpdateItemDataForItem(&$aUpdate) {
        $aUpdate['HandleZeroStock'] = (MLModul::gi()->getConfig('stocksync.tomarketplace') == 'auto_zero_stock');
    }

    /**
     * Check if stock should be synchronized or not
     * @return bool
     */
    protected function stockSyncIsEnabled() {
        $sStockSync = MLModul::gi()->getConfig('stocksync.tomarketplace');
        $blSync = ($sStockSync == 'auto') || ($sStockSync === 'auto_zero_stock');
        return $blSync;
    }
}
