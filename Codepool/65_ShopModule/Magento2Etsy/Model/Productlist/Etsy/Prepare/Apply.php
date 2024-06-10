<?php

MLFilesystem::gi()->loadClass('Magento2_Model_ProductList_Abstract');

class ML_Magento2Etsy_Model_ProductList_Etsy_Prepare_Apply extends ML_Magento2_Model_ProductList_Abstract {

	protected function executeFilter() {
        $this->oFilter
            ->registerDependency('searchfilter')
            ->registerDependency('categoryfilter')
            ->limit()
            ->registerDependency('preparestatusfilter')
            ->registerDependency('marketplacesyncfilter')
            ->registerDependency('productstatusfilter')
            ->registerDependency('manufacturerfilter')
            ->registerDependency('producttypefilter');

        return $this;
    }

    public function getSelectionName() {
        return 'apply';
    }

}
