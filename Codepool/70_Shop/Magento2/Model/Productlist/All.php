<?php
MLFilesystem::gi()->loadClass('Magento2_Model_ProductList_Abstract');
class ML_Magento2_Model_ProductList_All extends ML_Magento2_Model_ProductList_Abstract{

    protected function executeFilter() {
        return $this;
    }

    protected function executeList() {

    }

    public function getSelectionName() {

    }

}
