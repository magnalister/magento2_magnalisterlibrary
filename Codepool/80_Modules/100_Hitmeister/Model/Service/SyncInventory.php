<?php
class ML_Hitmeister_Model_Service_SyncInventory extends ML_Modul_Model_Service_SyncInventory_Abstract {
    public function execute() {
        include_once MLFilesystem::getOldLibPath('php/modules/hitmeister/crons/HitmeisterSyncInventory.php');
        $oModul = new HitmeisterSyncInventory($this->oModul->getMarketplaceId(), $this->oModul->getMarketplaceName());
        $oModul->process();
        return $this;
    }
}
