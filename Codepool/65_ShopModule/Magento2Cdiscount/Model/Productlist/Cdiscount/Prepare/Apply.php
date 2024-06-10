<?php

MLFilesystem::gi()->loadClass('Magento2_Model_ProductList_Abstract');

/**
 * select all products 
 * hitmeister-config: 
 *  - cdiscount.lang isset
 *  - amzon.prepare.ean !=''
 */
class ML_Magento2Cdiscount_Model_ProductList_Cdiscount_Prepare_Apply extends ML_Magento2_Model_ProductList_Abstract {

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
