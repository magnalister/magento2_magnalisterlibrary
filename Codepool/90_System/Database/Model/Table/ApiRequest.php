<?php

 class ML_Database_Model_Table_ApiRequest extends ML_Database_Model_Table_Abstract {

     protected $sTableName = 'magnalister_apirequests' ;
//     protected $sExpirableFieldName='expires';
//     protected $aKeys = array ('data') ;
     protected $aFields = array(
         'id'       =>array(
             'Type' => 'int(11)',  'Null' => 'NO', 'Default' => NULL, 'Extra' => 'auto_increment', 'Comment'=>''  ),
         'data'     =>array(
             'isKey' => true,
             'Type' => 'text',     'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment'=>''  ),
         'expires'  =>array(
             'isExpirable' => true,
             'Type' => 'datetime', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment'=>'' ),
     );
     protected $aTableKeys=array(
         'PRIMARY'    => array('Non_unique' => '0', 'Column_name' => 'id'),
     );
     protected function runOncePerRequest(){
         parent::runOncePerRequest();
         //execute requests 
         foreach($this->getList()->getList() as $oRequest){
             try {
                 if(class_exists('MagnaConnector')){
                    MagnaConnector::gi()->submitRequest($oRequest->get('data'));
                 }                 
             } catch (MagnaException $e) {
                //echo print_m($e->getErrorArray());
             }
             $oRequest->delete();
         }
         return $this;
     }
     protected function setDefaultValues() {
         return $this;
     }
     
    public function save() {
        $this->set('expires', date('Y-m-d H:i:s', time() +  60 * 60 * 24));
        return parent::save();
    }

 }
