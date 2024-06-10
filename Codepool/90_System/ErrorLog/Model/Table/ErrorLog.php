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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_ErrorLog_Model_Table_ErrorLog extends ML_Database_Model_Table_Abstract {

    protected $sTableName = 'magnalister_errorlog';
	
    protected $aFields = array (
        'id' => array (
			'isKey' => true,
            'Type' => 'int(10) unsigned', 'Null' => 'NO', 'Default' => NULL, 'Extra' => 'auto_increment', 'Comment'=>''
        ),
        'mpID' => array (
            'Type' => 'int(8) unsigned', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment'=>''
        ),
        'BatchId' => array (
            'Type' => 'int(11) unsigned', 'Null' => 'YES', 'Default' => NULL, 'Extra' => '', 'Comment'=>''
        ),
        'products_id' => array (
            'Type' => 'int(11) unsigned', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment'=>''
        ),
        'products_model' => array (
            'Type' => 'varchar(64)', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment'=>''
        ),
        'dateadded' => array (
            'isInsertCurrentTime' => true,
            'Type' => 'datetime', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment'=>''
        ),
        'errormessage' => array (
            'Type' => 'text', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment'=>''
        ),
        'errorrecommendation' => array (
            'Type' => 'text', 'Null' => 'YES', 'Default' => NULL, 'Extra' => '', 'Comment'=>''
        ),
        'data' => array (
            'Type' => 'longtext', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment'=>''
        ),
        'md5' => array(
            'Type' => 'varchar(32)', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment'=> 'search index'
        ),
    );
	
    protected $aTableKeys = array(
        'PRIMARY' => array('Non_unique' => '0', 'Column_name' => 'id'),
        'search_md5' => array('Non_unique' => '1', 'Column_name' => 'md5'),
    );

    public function addError($productId, $sku, $message, $data) {
        $sMd5 = md5(json_encode($data).$message);
        $this->set('md5', $sMd5);
        $this->aKeys = array('md5');
        if(!$this->exists()) {
            $this->aKeys = array('id');
            $this->setDefaultValues();
            $this->set('id', null); //auto increment
            $this->set('products_id', $productId);
            $this->set('products_model', $sku);
            $this->set('errormessage', $message);
            $this->set('dateadded', date('Y-m-d H:i:s'));
            $this->set('data', $data);
            $this->save();
        } else {            
            $this->set('dateadded', date('Y-m-d H:i:s'));
            $this->save();
        }
    }

    public function addApiError($aError) {
        $sSku = $this->getSku($aError);

        if ($sSku !== null) {
            $oProduct = MLProduct::factory()->getByMarketplaceSKU($sSku, true);
            $iProductId = 0;
            if (!$oProduct->exists()) {
                $oProduct = MLProduct::factory()->getByMarketplaceSKU($sSku);
            }
            if ($oProduct->exists()) {
                $iProductId = $oProduct->get('id');
            }
            $sErrorMessage = $aError['ERRORMESSAGE'];
            if(isset($aError['PLACEHOLDER'])){//comparison shopping
                $sErrorMessage .= '('.$aError['PLACEHOLDER'].')';
            }

            $this->addError($iProductId, $sSku, $sErrorMessage, $aError);
        } else {
            $this->addError(0, 0, $aError['ERRORMESSAGE'], $aError);
        }
    }

    protected function setDefaultValues() {
        try {
            $sId = MLRequest::gi()->get('mp');
            if (is_numeric($sId)) {
                $this->set('mpid', $sId);
            }
        } catch (Exception $oEx) {
            
        }
        return $this;
    }
       
    protected function getSku($aError){
        $sSku = null;
        if(isset($aError['ERRORDATA']['SKU'])) {
            $sSku = $aError['ERRORDATA']['SKU'];
        } elseif (isset($aError['DETAILS']['SKU'])) {
            $sSku = $aError['DETAILS']['SKU'];
        } elseif(isset($aError['SKUS']) && isset($aError['SKUS'][0])){//comparison shopping
            $sSku = $aError['SKUS'][0];
        }
        return $sSku;
    }
    
}
