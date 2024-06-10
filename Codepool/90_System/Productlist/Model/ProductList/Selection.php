<?php

abstract class ML_Productlist_Model_ProductList_Selection extends ML_Productlist_Model_ProductList_Abstract {
    public function isSelected(ML_Shop_Model_Product_Abstract $oProduct) {
        $i = MLDatabase::getDbInstance()->fetchOne("
            SELECT COUNT(*)
              FROM magnalister_selection s 
             WHERE     s.pid = '".$oProduct->get('id')."'
                   AND s.mpID = '" . MLModule::gi()->getMarketPlaceId() . "'
                   AND s.selectionname = '".$this->getSelectionName()."'
                   AND s.session_id = '".MLShop::gi()->getSessionId()."'
        ");
        return $i > 0;
    }

    protected function getAdditemListData($iFrom, $iCount) {
        $aList = array();
        $sSql = "
            SELECT %s
              FROM magnalister_selection s, 
                   magnalister_products p 
             WHERE     s.pID = p.ID
                   AND s.session_id = '".MLShop::gi()->getSessionId()."'
                   AND s.selectionname = 'checkin'
                   AND mpid = '" . MLModule::gi()->getMarketPlaceId() . "'
        ";
        $iCountTotal = MLDatabase::getDbInstance()->fetchOne(sprintf($sSql, ' COUNT(DISTINCT p.ParentId) '));
        foreach (MLDatabase::getDbInstance()->fetchArray(sprintf($sSql, ' DISTINCT p.ParentId ')." LIMIT ".$iFrom.", ".$iCount) as $aRow) {
            $oProduct = MLProduct::factory()->set("id", $aRow['ParentId']);
            if ($oProduct->exists()) {
                $aList[$aRow['ParentId']] = $oProduct;
            }
        }
        return array(
            'List' => $aList,
            'CountTotal' => $iCountTotal,
        );
    }

    abstract public function getSelectionName();
}