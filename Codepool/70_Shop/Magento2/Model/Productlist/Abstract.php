<?php
/*
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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

abstract class ML_Magento2_Model_ProductList_Abstract extends ML_Productlist_Model_ProductList_ShopAbstract {
    protected $sPrefix = 'ml_';

    /**
     * filter
     * @var ML_Magento2_Helper_Model_ProductList_Filter $oFilter
     */
    protected $oFilter = null;

    /**
     * list/result
     * @var ML_Magento2_Helper_Model_ProductList_List $oList
     */
    protected $oList = null;
    protected $sOrder = '';

    /**
     * @var ML_Database_Model_Query_Select $oSelectQuery
     */
    protected $oSelectQuery = null;

    /*
     * \Magento\Catalog\Model\ResourceModel\Product\Collection $oCollection
     */
    protected $oCollection=null;

    public function __construct()
    {
        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection */
        $productCollection = MLMagento2Alias::ObjectManagerProvider('Magento\Catalog\Model\ResourceModel\Product\Collection');
        /** Apply filters here */
        $productCollection->addFinalPrice();
        $aConfig = MLModule::gi()->getConfig();
        $iStoreId = (int)(isset($aConfig['lang']) ? $aConfig['lang'] : 0);

        $productCollection->setStore($iStoreId);
        $productCollectionFactory = MLMagento2Alias::ObjectManagerProvider('\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
        /** @var Magento\Catalog\Model\ResourceModel\Product\Collection\Interceptor $collection */
        $collection = MLMagento2Alias::ObjectManagerProvider('Magento\Catalog\Model\ResourceModel\Product\Collection');

        try {
            $productCollection = $productCollectionFactory->create();
            /*$productCollection
                ->joinField(
                    'store_id',
                    $collection->getTable('catalog_category_product_index'),
                    'store_id',
                    'product_id=entity_id',
                    '{{table}}.store_id = '.$iStoreId,
                    'left'
                )->addAttributeToSelect('*');*/
            $productCollection->getSelect()->distinct(true)->joinLeft($productCollection->getTable('catalog_product_relation') . ' as t', 'e.entity_id = t.child_id')->where('t.child_id IS NULL');
        } catch (Exception $oExc) {

        }

        // SQL query that filters out all single products that are in configurable products:
        // SELECT `e`.*, `at_store_id`.`store_id` FROM `catalog_product_entity` AS `e`
        // LEFT JOIN `catalog_category_product_index` AS `at_store_id` ON (at_store_id.`product_id`=e.entity_id) AND (at_store_id.store_id = 1)
        // WHERE entity_id NOT IN (SELECT child_id FROM catalog_product_relation WHERE parent_id IN (SELECT entity_id FROM catalog_product_entity WHERE type_id = 'configurable'))


        //MLMessage::gi()->addError($mQuery->getSelect()->__toString());
        $this->oCollection = $productCollection;
        $this->oFilter = MLHelper::gi('model_productlist_filter')
            ->clear()
            ->setCollection($productCollection)
            ->setPrefix($this->sPrefix)
        ;

        $this->initList();
        $this->oList
            ->clear()
            ->setCollection($productCollection);
    }

    protected function initList()
    {
        $this->oList = MLHelper::gi('model_productlist_list');
    }

    public function setFilters($aFilter)
    {
        if(is_array($aFilter)){
            $this->oFilter
                ->setFilter($aFilter)
                ->setPage(isset($aFilter['meta']['page'])?$aFilter['meta']['page']:0)
                ->setOffset(isset($aFilter['meta']['offset'])?$aFilter['meta']['offset']:0)
                ->setOrder(isset($aFilter['meta']['order'])?$aFilter['meta']['order']:'');
        }
        $this->sOrder = isset($aFilter['meta']['order'])?$aFilter['meta']['order']:'';
        $start = microtime(true);
        $this->executeList();
        MLMessage::gi()->addDebug('magento 2 magnalister product list execute list',array(microtime(true)-$start));
        $start = microtime(true);
        $this->executeFilter();
        MLMessage::gi()->addDebug('magento 2 magnalister product list execute Filter',array(microtime(true)-$start));
        return $this;
    }

    public function getFilters()
    {
        return $this->oFilter->getOutput();
    }

    public function getStatistic()
    {
        return $this->oFilter->getStatistic();
    }

    public function getMasterIds($blPage = false)
    {
        $aIds = array();
        $productRepository = MLMagento2Alias::ObjectManagerProvider('\Magento\Catalog\Model\ProductRepository');
        if ($blPage) {
            foreach ($this->oCollection->getData() as $aProduct) {
                $aIds[] = MLProduct::factory()->loadByShopProduct(
                    $productRepository->getById($aProduct['entity_id'])
                )->get('id');
            }
        } else {
            foreach ($this->oCollection->getAllIds() as $iShopId) {
                $aIds[] = MLProduct::factory()->loadByShopProduct(
                    $productRepository->getById($iShopId)
                )->get('id');
            }
        }

        return $aIds;
    }

    abstract protected function executeFilter();

    public function getHead()
    {
        return $this->oList->getHeader();
    }

    /**
     *
     * @var array
     */
    protected $aListOfProduct = null;

    public function getList()
    {
        return new ArrayIterator($this->getArrayList());
    }

    public function getArrayList()
    {
        if ($this->aListOfProduct === null) {
            $this->aListOfProduct = $this->oList->getList();
        }
        return $this->aListOfProduct;
    }

    public function additionalRows(ML_Shop_Model_Product_Abstract $oProduct)
    {
        return array();
    }

    public function getMixedData(ML_Shop_Model_Product_Abstract $oProduct, $sKey)
    {
        return $this->oList->getMixedData($oProduct, $sKey);
    }

    public function variantInList(ML_Shop_Model_Product_Abstract $oProduct)
    {
        return $this->oFilter->variantInList($oProduct);
    }

    public function setLimit($iFrom, $iCount)
    {
        if (isset($this->oCollection)) {
            $this->oCollection->getSelect()->limit($iFrom, $iCount);
        }
        return $this;
    }

}