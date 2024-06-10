<?php
class ML_Ebay_Model_Service_SyncInventory extends ML_Modul_Model_Service_SyncInventory_Abstract {
    public function execute() {
        MLHelper::gi('Model_Service_SyncInventory')->process();
        return $this;
    }
}
