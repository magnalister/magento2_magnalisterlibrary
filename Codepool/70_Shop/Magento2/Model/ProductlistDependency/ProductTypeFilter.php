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
MLFilesystem::gi()->loadClass('ProductList_Model_ProductListDependency_SelectFilter_Abstract');
class ML_Magento2_Model_ProductListDependency_ProductTypeFilter extends ML_ProductList_Model_ProductListDependency_SelectFilter_Abstract {

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
                ->where('`e`.`type_id` = \''.$sFilterValue .'\'')
                ->distinct(true);
        }
    }

    /**
     * key => value for status
     * @return array
     */
    protected function getFilterValues() {
        if ($this->aFilterValues === null) {
            $this->aFilterValues = array(
                '' => array(
                    'value' => '',
                    'label' => sprintf(MLI18n::gi()->get('Productlist_Filter_sEmpty'), MLI18n::gi()->get('Magento2_Productlist_Filter_sProductType')),
                ),
                'configurable' => array(
                    'value' => 'configurable',
                    'label' =>  MLI18n::gi()->get('Magento2_Productlist_Filter_sConfigurable'),
                ),
                'simple' => array(
                    'value' => 'simple',
                    'label' =>  MLI18n::gi()->get('Magento2_Productlist_Filter_sSimple'),
                ),
                'downloadable' => array(
                    'value' => 'downloadable',
                    'label' => MLI18n::gi()->get('Magento2_Productlist_Filter_sDownloadable'),
                ),
                'virtual' => array(
                    'value' => 'virtual',
                    'label' => MLI18n::gi()->get('Magento2_Productlist_Filter_sVirtual'),
                ),
            );
        }

        return $this->aFilterValues;
    }
}
