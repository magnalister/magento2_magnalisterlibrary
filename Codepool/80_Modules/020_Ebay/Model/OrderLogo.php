<?php
class ML_Ebay_Model_OrderLogo{
    
    public function getLogo(ML_Shop_Model_Order_Abstract $oModel) {
        $aData = $oModel->get('data');
        if (isset($aData['eBayPlus'])) {
             return 'ebay_orderview_plus.png';
        } else {
            return 'ebay_orderview.png';
        }
    }
}
