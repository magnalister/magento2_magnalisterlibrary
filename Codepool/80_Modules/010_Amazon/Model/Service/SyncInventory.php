<?php

class ML_Amazon_Model_Service_SyncInventory extends ML_Modul_Model_Service_SyncInventory_Abstract {
    public function execute() {
        include_once MLFilesystem::getOldLibPath('php/modules/amazon/crons/AmazonSyncInventory.php');
        $oModul=new AmazonSyncInventory($this->oModul->getMarketplaceId(),  $this->oModul->getMarketplaceName());
        $oModul->process();
        return $this;
    }
}