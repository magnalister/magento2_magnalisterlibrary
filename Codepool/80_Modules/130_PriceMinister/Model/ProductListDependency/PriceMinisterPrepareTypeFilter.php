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
class ML_PriceMinister_Model_ProductListDependency_PriceMinisterPrepareTypeFilter extends ML_Productlist_Model_ProductListDependency_Abstract {
    
    /**
     * Return possible values for filtering
     * @return array array('filter-value' => 'translated-filter-value')
     */
    protected function getFilterValues () {
        $aValues = array();
        foreach (
            array( 'apply' => 'apply',
            'match' => 'match'
        ) as $sFilterKey => $sFilterValue){
            $aValues[$sFilterKey] = array('value' => $sFilterKey, 'label' => $sFilterValue);
        }
        return $aValues;
    }
        
    /**
     * render current filter form-field
     * @param ML_Core_Controller_Abstract $oController
     * @param string $sFilterName
     * @return string rendered HTML
     */
    public function renderFilter(ML_Core_Controller_Abstract $oController, $sFilterName) {
        return '';
    }
    
    public function setFilterValue($sValue) {
        if (in_array($sValue, array_keys($this->getFilterValues()))) {
            parent::setFilterValue($sValue);
        }
        return $this;
    }


    /**
     * check if variant is in filter or not
     * @param ML_Shop_Model_Product_Abstract $oProduct
     * @return boolean
     */
    public function variantIsActive(ML_Shop_Model_Product_Abstract $oProduct) {
        $sValue = $this->getConfig('PrepareType');
        $sCompare = ($sValue === 'match') ? "'apply'" : "'manual' , 'auto'";
        return MLDatabase::getDbInstance()->fetchOne("
            SELECT COUNT(*)
              FROM ".MLDatabase::getPrepareTableInstance()->getTableName()." prepare
             WHERE     prepare." . MLDatabase::getPrepareTableInstance()->getMarketplaceIdFieldName() . " = '" . MLModule::gi()->getMarketPlaceId() . "'
                   AND prepare.PrepareType in (".$sCompare.")
                   AND prepare.".MLDatabase::getPrepareTableInstance()->getProductIdFieldName()." = '".(int)$oProduct->get('id')."'
        ") > 0 ? false : true;
    }



    /**
     * returns array with in or not in ident-type query-values
     * @return array array('in' => (array||null), 'notIn' => (array||null)) if null, filter-part is not active
     */
    public function getMasterIdents() {
        $sValue = $this->getConfig('PrepareType');
        $sCompare = $sValue === 'match' ? "'apply'" : "'manual' , 'auto'";
        $sProductTable = MLProduct::factory()->getTableName();
        // get masterarticles which have no/missing prepared variant
        $sSql = "
                SELECT master." . (
                MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.keytype')->get('value') == 'pID' ? 'productsid' : 'productssku'
                ) . "
                FROM " . MLDatabase::getPrepareTableInstance()->getTableName() . " prepare
                INNER JOIN " . $sProductTable . " variant ON prepare." . MLDatabase::getPrepareTableInstance()->getProductIdFieldName() . " = variant.id
                INNER JOIN " . $sProductTable . " master ON variant.parentid = master.id
                WHERE prepare.PrepareType in( " . $sCompare . ")
                AND prepare." . MLDatabase::getPrepareTableInstance()->getMarketplaceIdFieldName() . "='" . MLModule::gi()->getMarketPlaceId() . "'
                GROUP BY master.id
            ";
        return array(
            'in' => null,
            'notIn' => MLDatabase::getDbInstance()->fetchArray($sSql, true),
        );
    }

}
