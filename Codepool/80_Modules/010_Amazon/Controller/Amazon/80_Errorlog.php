<?php

/*
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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLFilesystem::gi()->loadClass('ErrorLog_Controller_Widget_ErrorLog_Abstract');

class ML_Amazon_Controller_Amazon_Errorlog extends ML_ErrorLog_Controller_Widget_ErrorLog_Abstract {
	
    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_GENERIC_ERRORLOG');
    }

    public static function getTabActive() {
        return MLModule::gi()->isConfigured();
    }
    
    public function render(){
        $this->getErrorLogWidget();
        return $this;
    }
    
    protected function processErrorAdditonalData(&$item) {
        $item['ErrorData'] =
            (is_array($item['AdditionalData']) ? $item['AdditionalData'] : array())
            +
            array('batchid' => $item['BatchID'], 'errorcode' => $item['ErrorCode']);
        if (isset($item['ErrorLogURL'])) {
            $item['AdditionalData']['ErrorLogURL'] = $item['ErrorLogURL'];
        }
        //        $data = $item['AdditionalData'];
        //        if (isset($data['AmazonOrderID'])) {
        //            $o = MLDatabase::getDbInstance()->fetchOne('
        //                    SELECT data FROM '.TABLE_MAGNA_ORDERS.'
        //                     WHERE special=\''.MLDatabase::getDbInstance()->escape($data['AmazonOrderID']).'\'
        //            ');
        //            if ($o === false) return;
        //            $o = json_decode($o,true);
        //            if (!is_array($o)) {
        //                    $o = array();
        //            }
        //            $o['ML_ERROR_LABEL'] = 'ML_AMAZON_ERROR_ORDERSYNC_FAILED';
        //            #echo print_m($o);
        //            $o = json_encode($o);
        //            MLDatabase::getDbInstance()->update(TABLE_MAGNA_ORDERS, array('data' => $o), array('special' => $data['AmazonOrderID']));
        //        }
    }
    
    public function getFields() {
        return 
            array(
                'BatchID' => array(
                    'Label' => $this->__('ML_AMAZON_LABEL_BATCHID'),
                    'Field' => 'BatchID',
                ),
                'SKU' => array(
                    'Label' => $this->__('ML_AMAZON_LABEL_ADDITIONAL_DATA'),
                    'Sorter' => 'products_model',
                    'Field' => 'SKU',
                ),
                'ErrorCode' => array(
                    'Label' => $this->__('ML_GENERIC_ERROR_CODE'),
                    'Field' => 'ErrorCode',
                ),
                'ErrorMessage' => array(
                    'Label' => $this->__('ML_GENERIC_ERROR_MESSAGES'),
                    'Sorter' => 'errormessage',
                    'Field' => 'errormessage',
                ),
                'ErrorRecommendation' => array(
                    'Label' => $this->__('ML_GENERIC_ERROR_RECOMMENDATION'),
                    'Field' => 'errorrecommendation',
                ),
                'DateAdded' => array(
                    'Label' => $this->__('ML_GENERIC_CHECKINDATE'),
                    'Sorter' => 'id',
                    'Field' => 'dateadded',
                ),
        );        
    }
    
    public function getBatchid($oErrorlog) {
        $aData = $oErrorlog->get('data');
        echo isset($aData['batchid'])?$aData['batchid']:'';
    }
    
    public function getErrorcode($oErrorlog) {
        $aData = $oErrorlog->get('data');
        echo isset($aData['errorcode'])?$aData['errorcode']:'';
    }
    
}