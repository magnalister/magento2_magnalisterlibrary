<?php
class ML_MercadoLivre_Model_Service_SyncInventory extends ML_Modul_Model_Service_SyncInventory_Abstract {
    public function execute() {
        include_once MLFilesystem::getOldLibPath('php/modules/mercadolivre/crons/MercadoLivreSyncInventory.php');
        $oModul = new MercadoLivreSyncInventory($this->oModul->getMarketplaceId(), $this->oModul->getMarketplaceName());
        $oModul->process();
        return $this;
    }
}
