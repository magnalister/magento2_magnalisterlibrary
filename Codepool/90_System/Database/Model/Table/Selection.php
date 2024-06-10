<?php
 class ML_Database_Model_Table_Selection extends ML_Database_Model_Table_Abstract {
     protected $sTableName = 'magnalister_selection' ;
     protected $aFields = array(
         'pID'              =>array(
             'isKey' => true,
             'Type' => 'int(20) unsigned','Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment'=>'' ),
         'data'             =>array(
             'Type' => 'text',            'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment'=>'' ),
         'mpID'             =>array(
             'isKey' => true,
             'Type' => 'int(8) unsigned', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment'=>'' ),
         'selectionname'    =>array(
             'isKey' => true,
             'Type' => 'varchar(50)',     'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment'=>'' ),
         'session_id'       =>array(
             'isKey' => true,
             'Type' => 'varchar(64)',     'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment'=>'' ),
         'expires'          =>array(
             'isExpirable' => true,
             'Type' => 'datetime',        'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment'=>'' ),
     );
     protected $aTableKeys=array(
         'selection'    => array('Non_unique' => '0', 'Column_name' => 'pID, mpID, selectionname, session_id'),
         'expires'      => array('Non_unique' => '1', 'Column_name' => 'expires'),
         'session_id'   => array('Non_unique' => '1', 'Column_name' => 'session_id'),
     );
     protected function runOncePerRequest() {
         // make expires of actual session in future 
          MLDatabase::factorySelectClass()
                  ->update(
                          $this->getTableName(), 
                          array(
                              $this->sExpirableFieldName => date('Y-m-d H:i:s' , time()+ $this->getSessionMaxLifeTime())
                              )
                          )
                  ->where("session_id='" . MLShop::gi()->getSessionId() . "'")
                 ->doUpdate();
         // delte entries which are not in magna-products
         $oProduct= MLProduct::factory();
          MLDatabase::factorySelectClass() 
                  ->delete($this->getTableName())
                  ->from( $this->getTableName())
                  ->join(
                 $oProduct->getTableName().' on pid=id',  ML_Database_Model_Query_Select::JOIN_TYPE_LEFT)
             ->where('id is null')                  
                 ->doDelete();
          // delete all expired entries
          MLDatabase::factorySelectClass()
              ->delete('')
              ->from($this->getTableName())
              ->where("expires <'".date('Y-m-d H:i:s')."'")
              ->doDelete();
         parent::runOncePerRequest();
         return $this;
    }
     protected function setDefaultValues() {
         try {
             $sId = MLRequest::gi()->get('mp') ;
             if ( is_numeric($sId) ) {
                 $this->set('mpid' , $sId) ;
             }
         }
         catch ( Exception $oEx ) {
             
         }
         $this->set('session_id' , MLShop::gi()->getSessionId()) ;
         return $this ;
     }
     public function save() {
         $this->set($this->sExpirableFieldName, date('Y-m-d H:i:s' , time()+ $this->getSessionMaxLifeTime()));
         parent::save();
     }
     public function loadByProduct($oProduct, $sSelectionName){
         $this->set('pid',$oProduct->get('id'))->set('selectionname',$sSelectionName);
         return $this;
     }
     
     protected function getSessionMaxLifeTime(){
         $iMaxLifeTime = (int)ini_get("session.gc_maxlifetime");
         if($iMaxLifeTime <= 0){
             $iMaxLifeTime = 300;
         } elseif($iMaxLifeTime > 1000000) { // for great session max life time we couldn't insert converted date into database
             $iMaxLifeTime = 1000000;
         }
         return $iMaxLifeTime;
     }
}
