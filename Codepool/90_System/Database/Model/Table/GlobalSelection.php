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
MLFilesystem::gi()->loadClass('Database_Model_Table_Prepare_Abstract');
class ML_Database_Model_Table_GlobalSelection extends ML_Database_Model_Table_Abstract {

    protected $sTableName = 'magnalister_global_selection';
    protected $aFields = array(
        'mpID'           => array(
             'isKey' => true,
             'Type' => 'int(8) unsigned',   'Null' => 'NO', 'Default' => NULL,'Extra' => '',              'Comment'=>'marketplaceid'
        ),
        'elementId'       => array(
             'isKey' => true,
             'Type' => 'varchar(100)',       'Null' => 'NO', 'Default' => NULL,'Extra' => '',              'Comment'=>''
        ),
        'selectionname'    =>array(
            'isKey' => true,
            'Type' => 'varchar(50)',     'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment'=>'' 
         ),
        'data'   => array (
            'Type' => 'text',               'Null' => 'NO', 'Default' => NULL,'Extra' => '',              'Comment'=>''
        ), 
        'session_id'       =>array(
             'isKey' => true,
             'Type' => 'varchar(64)',     'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment'=>'' ),
    );
    protected $aTableKeys = array(
        'UC_mp_order_id'=> array('Non_unique' => '0', 'Column_name' => 'mpID, elementId, session_id, selectionname'),
    );

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
    
}