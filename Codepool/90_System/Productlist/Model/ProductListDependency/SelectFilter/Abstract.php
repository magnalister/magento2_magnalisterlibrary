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
abstract class ML_ProductList_Model_ProductListDependency_SelectFilter_Abstract extends ML_Productlist_Model_ProductListDependency_Abstract {
    
    /**
     * render form-select for current filter
     * @param \ML_Core_Controller_Abstract $oController
     * @param string $sFilterName
     * @return string
     */
    public function renderFilter(ML_Core_Controller_Abstract $oController, $sFilterName) {
        return $oController->includeViewBuffered('widget_productlist_filter_select_snippet', array(
            'aFilter' => array(
                'name' => $sFilterName,
                'value' => $this->getFilterValue(),
                'values' => $this->getFilterValues(),
            )
        ));
    }
    
    /**
     * validates filter-value
     * @param string $sValue
     * @return \ML_ProductList_Model_ProductListDependency_SelectFilter_Abstract
     */
    public function setFilterValue($sValue) {
        if ($sValue !== null && in_array($sValue, array_keys($this->getFilterValues()))) {
            parent::setFilterValue($sValue);
        }
        return $this;
    }
    
    /**
     * @return array for select (key=>value)
     */
    abstract protected function getFilterValues();
    
}