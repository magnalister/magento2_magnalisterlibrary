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

class ML_Database_Model_Table_Order extends ML_Database_Model_Table_Abstract {

     protected $sTableName = 'magnalister_orders' ;

     protected $aFields = array(
         'orders_id'                => array(
             'Type' => 'varchar(32)', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment' => 'orders-id for sync with magnalister'
         ),
         'current_orders_id'        => array(
             'isKey' => true,
             'Type'  => 'varchar(32)', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment' => 'orders-id for relation to shop'
         ),
         'data'                     => array(
             'Type' => 'text', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment' => ''
         ),
         'orderData'                => array(
             'Type' => 'text', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment' => ''
         ),
         'internaldata'             => array(
             'Type' => 'longtext', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment' => ''
         ),
         'special'                  => array(
             'Type' => 'varchar(100)', 'Null' => 'YES', 'Default' => NULL, 'Extra' => '', 'Comment' => ''
         ),
         'platform'                 => array(
             'Type' => 'varchar(20)', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment' => ''
         ),
         'mpID'                     => array(
             'Type' => 'int(8)', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment' => ''
         ),
         'status'                   => array(
             'Type' => 'varchar(32)', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment' => ''
         ),
         'insertTime' => array(
             'Type'                => 'datetime',
             'Null'                => self::IS_NULLABLE_YES,
             'Default'             => NULL,
             'Extra'               => '',
             'Comment'             => '',
             'isInsertCurrentTime' => true,
         ),
         'order_status_sync_last_check_date' => array(
             'Type'                => 'datetime',
             'Null'                => self::IS_NULLABLE_YES,
             'Default'             => NULL,
             'Extra'               => '',
             'Comment'             => '',
             'isInsertCurrentTime' => true,
         ),
         'order_exists_in_shop' => array(
             'Type'                => 'int(1)',
             'Null'                => self::IS_NULLABLE_NO,
             'Default'             => 1,
             'Extra'               => '',
             'Comment'             => '',
         ),
         'logo'                     => array(
             'Type' => 'varchar(50)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
         ),
         'shopAdditionalOrderField' => array(
             'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
         ),
     );

     protected $aTableKeys = array(
         'PRIMARY'              => array('Non_unique' => '0', 'Column_name' => 'orders_id'),
         'platform'             => array('Non_unique' => '1', 'Column_name' => 'platform'),
         'current_orders_id'    => array('Non_unique' => '1', 'Column_name' => 'current_orders_id'),
         'special'              => array('Non_unique' => '1', 'Column_name' => 'special'),
     );

     protected function setDefaultValues() {
         try{
            $oModul=MLModule::gi();
            $this->set('mpid', $oModul->getMarketPlaceId())->set('platform',$oModul->getMarketPlaceName());
         }catch(Exception $oEx){
             
         }
         return $this;
     }

     public function save() {
        if (!isset($this->aData['internaldata']) ){
            $this->set('internaldata', '');
        }
        return parent::save();
     }

 }
