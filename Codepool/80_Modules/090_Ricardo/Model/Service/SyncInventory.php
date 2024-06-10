<?php
class ML_Ricardo_Model_Service_SyncInventory extends ML_Modul_Model_Service_SyncInventory_Abstract {
    public function execute() {
        include_once MLFilesystem::getOldLibPath('php/modules/ricardo/crons/RicardoSyncInventory.php');
        $oModul = new RicardoSyncInventory($this->oModul->getMarketplaceId(), $this->oModul->getMarketplaceName());
        $oModul->process();
        return $this;
    }
}
