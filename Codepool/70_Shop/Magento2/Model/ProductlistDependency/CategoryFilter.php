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


MLFilesystem::gi()->loadClass('Shop_Model_ProductListDependency_CategoryFilter_Abstract');

class ML_Magento2_Model_ProductListDependency_CategoryFilter extends ML_Shop_Model_ProductListDependency_CategoryFilter_Abstract {

    /**
     * key=>value for filtering (eg. validation and form-select)
     * @var array|null
     */
    protected $aFilterValues = null;

    /**
     * all categories
     * @var array|null
     */
    protected $aCategories = null;

    /**
     * @param ML_Database_Model_Query_Select $mQuery
     * @return void
     * @throws Exception
     */
    public function manipulateQuery($mQuery) {
        $sFilterValue = $this->getFilterValue();

        if (
            !empty($sFilterValue)
            && $sFilterValue != 1 //root-category
            && array_key_exists($sFilterValue, $this->getFilterValues())
        ) {
            $aCats = array();
            foreach ($this->getMagentoCategories() as $aCat) {
                if (preg_match('/\/'.$sFilterValue.'\//', '/'.$aCat['path'].'/')) {
                    $aCats[] = $aCat['entity_id'];
                }
            }
            if (empty($aCats)) {
                $mQuery->getSelectSql()->where('false');
            } else {
                $mQuery->getSelectSql()->join(
                    array('catalog_category_product' => MLMagento2Alias::getMagento2Db()->getTableName('catalog_category_product')),
                    'catalog_category_product.product_id = e.entity_id',
                    array()
                )->where('catalog_category_product.category_id IN (\''.implode("', '", $aCats).'\')');
            }
        }
    }

    /**
     * key=>value for categories
     * @return array
     */
    protected function getFilterValues()
    {
        if ($this->aFilterValues === null) {
            $iStoreId = MLModule::gi()->getConfig('lang');
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $storeObj = $objectManager->create('Magento\Store\Model\StoreManagerInterface');
            try {
                $iRootCat = $storeObj->getStore($iStoreId)->getRootCategoryId();
            } catch (Mage_Core_Model_Store_Exception $oEx) {//store not exists
                $iRootCat = $storeObj->getStore()->getRootCategoryId();
            }
            $aCats = $this->getMagentoCategories();
            $aSort = array();
            foreach ($aCats as $aCurrent) {
                if ($iRootCat == $aCurrent['entity_id']) {
                    $sFilterKey = '_' . $aCurrent['path'];
                }
                $aSort['_' . $aCurrent['path']] = array(
                    'value' => $aCurrent['entity_id'],
                    'label' => str_repeat('&nbsp;&nbsp;', substr_count($aCurrent['path'], '/')) . ($aCurrent['entity_id'] == 1 ? sprintf(MLI18n::gi()->get('Productlist_Filter_sEmpty'), MLI18n::gi()->get('Productlist_Filter_sCategory')) : $aCurrent['name']),
                );
            }
            ksort($aSort);
            $aFilterValues = array();
            foreach ($aSort as $sKey => $aValue) {
                if (
                    substr($sKey, 0, strlen($sFilterKey)) == $sFilterKey ||
                    $sKey == '_1'//root
                ) {
                    $aFilterValues[$aValue['value']] = $aValue;
                }
            }
            $this->aFilterValues = $aFilterValues;
        }

        return $this->aFilterValues;
    }

    /**
     * gets all categories
     * @param array|null $aCats nested cats
     * @return array
     */
    protected function getMagentoCategories()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $Categorymodel = $objectManager->create('Magento\Catalog\Model\Category');
        if ($this->aCategories === null) {
            $this->aCategories = $Categorymodel->getTreeModelInstance()->load()->getCollection()->exportToArray();
        }
        return $this->aCategories;
    }

        /**
     * some wrong subcategory, that is not deleted correctly by Prestashop made problem for default category filter
     * so we always set Root category as default
     * @return string
     */
    public function getFilterValue() {
        $sValue = parent::getFilterValue();
        if ($sValue === null) {
            if (array_key_exists('1', $this->getFilterValues())) {
                return '1';
            }
        } else {
            return $sValue;
        }
    }

}
