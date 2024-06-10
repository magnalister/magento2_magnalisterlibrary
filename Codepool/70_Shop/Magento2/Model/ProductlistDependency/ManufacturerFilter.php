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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Shop_Model_ProductListDependency_ManufacturerFilter_Abstract');
class ML_Magento2_Model_ProductListDependency_ManufacturerFilter extends ML_Shop_Model_ProductListDependency_ManufacturerFilter_Abstract {

    /**
     * possible filter values
     * @var null | array key => value
     */
    protected $aFilterValues = null;

    /**
     * @param ML_Database_Model_Query_Select $mQuery
     * @return void
     */
    public function manipulateQuery($mQuery) {

        $sFilterValue = $this->getFilterValue();
        
        if (
            !empty($sFilterValue)
            && array_key_exists($sFilterValue, $this->getFilterValues())
        ) {
            $mQuery->getSelectSql()
                ->joinLeft(
                    array('cm' => MLMagento2Alias::getMagento2Db()->getTableName('catalog_product_entity_int')),
                    'e.entity_id = cm.entity_id',
                    array()
                )
                ->joinLeft(
                    array('em' => 'eav_attribute'), 
                    'cm.attribute_id = em.attribute_id',
                    array()
                )
                ->where('cm.value = \''.$sFilterValue .'\' AND em.attribute_code = \'manufacturer\'');
        }
    }

    /**
     * key => value for manufacturers
     * @return array
     */
    protected function getFilterValues() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        /** @var \Magento\Catalog\Api\Data\ProductAttributeInterface $attribute */
        $attribute = $objectManager->get(\Magento\Catalog\Api\ProductAttributeRepositoryInterface::class)
            ->get('manufacturer');

        foreach ($attribute->getOptions() as $option) {
            $aOut[$option->getValue()] = array(
                'value' => $option->getValue(),
                'label' => $option->getLabel(),
            );
        }

        $aOut[''] = array(
                'value' => '',
                'label' => sprintf(MLI18n::gi()->get('Productlist_Filter_sEmpty'), MLI18n::gi()->get('Magento2_Productlist_Filter_sManufacturer'))
            );

        $this->aFilterValues = $aOut;
        return $this->aFilterValues;
    }
}
