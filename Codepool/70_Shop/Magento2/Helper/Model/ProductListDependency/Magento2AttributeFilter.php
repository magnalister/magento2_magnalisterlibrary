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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

/**
 * Helper Class for productlistdependency
 * Filter select-attribute from magento
 */
class ML_Magento2_Helper_Model_ProductListDependency_Magento2AttributeFilter {
    
    /**
     * filtervalues for code array($sCode => array(key => value))
     * @var array
     */
    protected $aFilterValues = array();
    
    /**
     * Magento Product Resource
     * @var Mage_Catalog_Model_Resource_Product | null
     */
    protected $oProductResource = null;
    
    /**
     * manipulates $oQuery
     * @param string $sCode
     * @param Mage_Catalog_Model_Resource_Product_Collection $oQuery
     * @param string $sFilterValue
     */
    // public function manipulateQuery() {}
    
    /**
     * gets filterable key/values for attribute-code
     * @param string $sCode
     * @return array key/values eg. for form-select
     */
    public function getFilterValues ($sCode) {
        if (!empty($sCode) && !array_key_exists($sCode, $this->aFilterValues)) {
            $oAttribute = Mage::getResourceModel('eav/entity_attribute_collection')
                ->setEntityTypeFilter($this->getProductResource()->getTypeId())
                ->addFieldToFilter('attribute_code', $sCode) // This can be changed to any attribute code
                ->load(false)
                ->getFirstItem()
                ->setEntity($this->getProductResource())
            ;
            $aFilterValues = array(
                '' => array(
                    'value' => '',
                    'label' => sprintf(MLI18n::gi()->get('Productlist_Filter_sEmpty'), $oAttribute->frontendLabel)
                )
            );
            foreach ($oAttribute->getSource()->getAllOptions(false) as $aValue) {
                if ($aValue['value'] != '') {
                    $aFilterValues[$aValue['value']] = array(
                        'value' => $aValue['value'],
                        'label' => $aValue['label'],
                    );
                }
            }
            $this->aFilterValues[$sCode] = $aFilterValues;
        }
        return array_key_exists($sCode, $this->aFilterValues) ? $this->aFilterValues[$sCode] : array();
    }

    /**
     * gets ProductResource
     * @return Mage_Catalog_Model_Resource_Product 
     */
    protected function getProductResource () {
        if ($this->oProductResource === null) {
            $this->oProductResource = Mage::getModel('catalog/product')->getResource();
        }
        return $this->oProductResource;
    }

}
