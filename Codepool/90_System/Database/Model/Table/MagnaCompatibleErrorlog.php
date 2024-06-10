<?php

class ML_Database_Model_Table_MagnaCompatibleErrorlog extends ML_Database_Model_Table_Abstract {
    
    protected $sTableName = 'magnalister_magnacompat_errorlog';
    
    protected $aFields = array(
        'id' => array(
            'Type' => 'int(11)',
            'Null' => 'NO',
            'Default' => NULL,
            'Extra' => 'auto_increment',
            'Comment' => ''
        ),
        'mpID' => array(
            'isKey' => true,
            'Type' => 'int(11)',
            'Null' => 'NO',
            'Default' => '0',
            'Extra' => '',
            'Comment' => ''
        ),
        'origin' => array(
            'isKey' => false,
            'Type' => 'varchar(50)',
            'Null' => 'NO',
            'Default' => '',
            'Extra' => '',
            'Comment' => ''
        ),
        'dateadded' => array(
            'isKey' => false,
            'Type' => 'datetime',
            'Null' => self::IS_NULLABLE_YES,
            'Default' => NULL,
            'Extra' => '',
            'Comment' => ''
        ),
        'errormessage' => array(
            'isKey' => false,
            'Type' => 'text',
            'Null' => 'NO',
            'Default' => NULL,
            'Extra' => '',
            'Comment' => ''
        ),
        'additionaldata' => array(
            'isKey' => false,
            'Type' => 'longtext',
            'Null' => 'NO',
            'Default' => NULL,
            'Extra' => '',
            'Comment' => ''
        )
    );
    
    protected $aTableKeys = array(
        'PRIMARY' => array('Non_unique' => '0', 'Column_name' => 'id'),
        'mpID'    => array('Non_unique' => '1', 'Column_name' => 'mpID'),
    );
    
    protected function setDefaultValues() {
        return $this;
    }
    
}
