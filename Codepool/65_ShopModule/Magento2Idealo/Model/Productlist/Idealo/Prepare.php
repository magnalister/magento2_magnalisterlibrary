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
 * $Id$
 *
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Magento2_Model_ProductList_Abstract');
class ML_Magento2Idealo_Model_ProductList_Idealo_Prepare extends ML_Magento2_Model_ProductList_Abstract{
    protected function executeFilter(){
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
    protected function executeList(){
        $this->oList
            ->image()
            ->product()
        ;
        $sValue = MLDatabase::factory('config')->set('mpid',0)->set('mkey','general.manufacturerpartnumber')->get('value');
        if(!empty($sValue)){
            $this->oList->magentoAttribute($sValue,true,MLI18n::gi()->get('Productlist_Header_Field_sManufacturerpartnumber'));
        }
        $sValue = MLDatabase::factory('config')->set('mpid',0)->set('mkey','general.ean')->get('value');
        if(!empty($sValue)){
            $this->oList->magentoAttribute($sValue,true,MLI18n::gi()->get('Productlist_Header_Field_sEan'));
        }
        $this->oList
            ->priceShop()
            ->priceMarketplace()
            ->preparedStatus();
    }
    public function getSelectionName() {
        return 'match';
    }
}