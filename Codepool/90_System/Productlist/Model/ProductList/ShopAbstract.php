<?php
abstract class ML_Productlist_Model_ProductList_ShopAbstract extends ML_Productlist_Model_ProductList_Selection {
    
    const PRODUCTLIST_PREPARE_COLUMNS = 'Productlist_Prepare_Columns';
    const PRODUCTLIST_UPLOAD_COLUMNS = 'Productlist_Upload_Columns';
    const PRODUCTLIST_UPLOAD_NOPREPARETYPE_COLUMNS = 'Productlist_Upload_NoPrepareType_Columns';
    
    protected $sColumnListName = null;
    
    protected function executeList() {
        if ($this->sColumnListName !== null) {
            $aColumnNames = MLSetting::gi()->{$this->aColumnListName};
        } else if ($this->getSelectionName() === 'checkin') {
            if (MLModule::gi()->isMultiPrepareType()) {
                $aColumnNames = MLSetting::gi()->{self::PRODUCTLIST_UPLOAD_COLUMNS};
            } else {
                $aColumnNames = MLSetting::gi()->{self::PRODUCTLIST_UPLOAD_NOPREPARETYPE_COLUMNS};
            }
        } else {
            $aColumnNames = MLSetting::gi()->{self::PRODUCTLIST_PREPARE_COLUMNS};
        }
        foreach ($aColumnNames as $sColumn => $aData) {
            $this->oList->{$sColumn}($aData);
        }
    }

}