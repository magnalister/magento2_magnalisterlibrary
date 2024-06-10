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
class ML_ProductList_Model_ProductListDependency_LastPreparedFilter extends ML_ProductList_Model_ProductListDependency_SelectFilter_Abstract {
    
    protected $aFilterValues = null;
        
    /**
     * render current filter form-field
     * @param ML_Core_Controller_Abstract $oController
     * @param string $sFilterName
     * @return string rendered HTML
     */
    public function renderFilter(ML_Core_Controller_Abstract $oController, $sFilterName) {
        return $oController->includeViewBuffered('widget_productlist_filter_select_snippet', array('aFilter' => array(
            'name' => $sFilterName,
            'value' => $this->getFilterValue(),
            'values' => $this->getFilterValues()
        )));
    }
    
    /**
     * Return possible values for filtering
     * @return array array('filter-value' => 'translated-filter-value')
     */
    protected function getFilterValues() {
        if ($this->aFilterValues === null) {
            $aValues = array(
                'all' => array('value' => 'all', 'label' => MLI18n::gi()->get('Productlist_Filter_aLastPrepared_all')),
            );
            $sField = MLDatabase::getPrepareTableInstance()->getPreparedTimestampFieldName();
            $aField = MLDatabase::getPrepareTableInstance()->getTableInfo($sField);
            $sSql = "
                SELECT DISTINCT DATE_FORMAT(".$sField.", '%Y-%m-%d %H:%i')
                FROM ".MLDatabase::getPrepareTableInstance()->getTableName()."
                WHERE " . MLDatabase::getPrepareTableInstance()->getMarketplaceIdFieldName() . "='" . MLModule::gi()->getMarketPlaceId() . "'
                ".($aField['Default'] !== null ? "AND ".$sField." != '".$aField['Default']."'" : '')."
                ORDER BY ".$sField." DESC
                LIMIT 100
            ";
            foreach (MLDatabase::getDbInstance()->fetchArray($sSql, true) as $sDateTime) {
                $aValues[$sDateTime] = array('value' => $sDateTime, 'label' => date (MLI18n::gi()->get('Productlist_Filter_aLastPrepared_dateFormat'), strtotime($sDateTime)));
            }
            $this->aFilterValues = $aValues;
        }
        return $this->aFilterValues;
    }
    
    /**
     * returns array with in or not in ident-type query-values
     * @return array array('in' => (array||null), 'notIn' => (array||null)) if null, filter-part is not active
     */
    public function getMasterIdents() {
        $sValue = $this->getFilterValue();
        if ($sValue !== 'all' && in_array($sValue, array_keys($this->getFilterValues()))) {
            $sProductTable = MLProduct::factory()->getTableName();
            // get masterarticles which have prepared variants
            $sSql = "
                SELECT master.".(
                MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.keytype')->get('value') == 'pID'
                    ? 'productsid'
                    : 'productssku'
                )."
                FROM ".MLDatabase::getPrepareTableInstance()->getTableName()." prepare
                INNER JOIN ".$sProductTable." variant ON prepare.".MLDatabase::getPrepareTableInstance()->getProductIdFieldName()." = variant.id
                INNER JOIN ".$sProductTable." master ON variant.parentid = master.id
                WHERE DATE_FORMAT(prepare.".MLDatabase::getPrepareTableInstance()->getPreparedTimestampFieldName().", '%Y-%m-%d %H:%i') = '".MLDatabase::getDbInstance()->escape($sValue)."'
                AND prepare.".MLDatabase::getPrepareTableInstance()->getMarketplaceIdFieldName()." = '".MLModule::gi()->getMarketPlaceId()."'
                GROUP BY master.id
            ";
            return array(
                'in' => MLDatabase::getDbInstance()->fetchArray($sSql, true),
                'notIn' => null,
            );
        } else {
            return array(
                'in' => null, 
                'notIn' => null
            );
        }
    }
    
    /**
     * check if variant is in filter or not
     * @param ML_Shop_Model_Product_Abstract $oProduct
     * @return boolean
     */
    public function variantIsActive(ML_Shop_Model_Product_Abstract $oProduct) {
        $sValue = $this->getFilterValue();
        if ($sValue !== 'all' && in_array($sValue, array_keys($this->getFilterValues()))) {
            return MLDatabase::getDbInstance()->fetchOne("
                SELECT COUNT(*)
                  FROM ".MLDatabase::getPrepareTableInstance()->getTableName()."
                 WHERE     " . MLDatabase::getPrepareTableInstance()->getMarketplaceIdFieldName() . " = '" . MLModule::gi()->getMarketPlaceId() . "'
                       AND DATE_FORMAT(".MLDatabase::getPrepareTableInstance()->getPreparedTimestampFieldName().", '%Y-%m-%d %H:%i') = '".MLDatabase::getDbInstance()->escape($sValue)."'
                       AND ".MLDatabase::getPrepareTableInstance()->getProductIdFieldName()." = '".(int)$oProduct->get('id')."'
            ") > 0 ? true : false;
        }
        return true;
    }

}