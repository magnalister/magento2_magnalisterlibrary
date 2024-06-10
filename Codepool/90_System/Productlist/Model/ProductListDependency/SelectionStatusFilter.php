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
class ML_ProductList_Model_ProductListDependency_SelectionStatusFilter extends ML_ProductList_Model_ProductListDependency_SelectFilter_Abstract {
    
    protected $aFilterValues = null;
    
        
    
    /**
     * Return possible values for filtering
     * @return array array('filter-value' => 'translated-filter-value')
     */
    protected function getFilterValues () {
        if ($this->aFilterValues === null) {
            $aValues = array();
            foreach (MLI18n::gi()->get('Productlist_Filter_aSelectionStatus') as $sFilterKey => $sFilterValue) {
                $aValues[$sFilterKey] = array('value' => $sFilterKey, 'label' => $sFilterValue);
            }
            $this->aFilterValues = $aValues;
        }
        return $this->aFilterValues;
    }


    /**
     * returns array with in or not in ident-type query-values
     * @return array array('in' => (array||null), 'notIn' => (array||null)) if null, filter-part is not active
     */
    public function getMasterIdents () {
        $sValue = $this->getFilterValue();
        if ( in_array($sValue, array( 'selected','notselected'))) {
            $sProductTable = MLProduct::factory()->getTableName();
            $selectionname = $this->getConfig('selectionname');
            $sSql = MLDatabase::getTableInstance('selection')->set('selectionname', $selectionname)->getList()->getQueryObject()->select(
                    "master.".(
                            MLDatabase::factory('config')->set('mpid',0)->set('mkey','general.keytype')->get('value') == 'pID' 
                            ? 'productsid' 
                            : 'productssku'
                        )
                    )
                    ->join(array($sProductTable, "variant", "pid = variant.id"), ML_Database_Model_Query_Select::JOIN_TYPE_INNER)
                    ->join(array($sProductTable, "master", "variant.parentid = master.id"), ML_Database_Model_Query_Select::JOIN_TYPE_INNER)->getQuery(false);
            // get masterarticles which have no/missing prepared variant
            $sSql = str_replace('*,', '', $sSql);
            if($sValue == 'selected'){
                $aReturn = array(
                    'in' => MLDatabase::getDbInstance()->fetchArray($sSql, true),
                    'notIn' => null,
                );
            }else{
                $aReturn = array(
                    'in' => null,
                    'notIn' => MLDatabase::getDbInstance()->fetchArray($sSql, true),
                );
            }
        } else {
            $aReturn = array(
                'in' => null,
                'notIn' => null,
            );
        }
        return $aReturn;
    }
    
}
