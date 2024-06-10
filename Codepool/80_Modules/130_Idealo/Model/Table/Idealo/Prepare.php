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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Database_Model_Table_Prepare_Abstract');

class ML_Idealo_Model_Table_Idealo_Prepare extends ML_Database_Model_Table_Prepare_Abstract {

    protected $sTableName = 'magnalister_idealo_prepare';

    protected $aFields = array(
        'mpID' => array(
            'isKey' => true,
            'Type' => 'int(11) unsigned', 'Null' => self::IS_NULLABLE_NO, 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
        'products_id' => array(
            'isKey' => true,
            'Type' => 'int(11)', 'Null' => self::IS_NULLABLE_NO, 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
        'PreparedTS' => array(
            'isInsertCurrentTime' => true,
            'Type' => 'datetime', 'Null' => self::IS_NULLABLE_YES, 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
        'Verified' => array(
            'Type' => "enum('OK','ERROR','OPEN','EMPTY')", 'Null' => self::IS_NULLABLE_NO, 'Default' => 'OPEN', 'Extra' => '', 'Comment' => ''
        ),
        'Title' => array(
            'Type' => 'varchar(255)', 'Null' => self::IS_NULLABLE_YES, 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
        'Description' => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
        'Image' => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
        'Checkout' => array( //@depricated no used anymore
            'Type' => "tinyint(1)", 'Null' => self::IS_NULLABLE_YES, 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
        'PaymentMethod' => array(
            'Type' => 'varchar(124)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'ShippingCost' => array(
            'Type' => 'decimal(15,4)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 1, 'Extra' => '', 'Comment' => ''
        ),
        'ShippingCostMethod' => array(
            'Type' => 'varchar(20)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'ShippingTime' => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
        'FulFillmentType' => array( //@depricated no used anymore
            'Type' => 'varchar(32)', 'Null' => self::IS_NULLABLE_YES, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'TwoManHandlingFee' => array( //@depricated no used anymore
            'Type' => 'varchar(16)', 'Null' => self::IS_NULLABLE_YES, 'Default' => '0.00', 'Extra' => '', 'Comment' => ''
        ),
        'DisposalFee' => array( //@depricated no used anymore
            'Type' => 'varchar(16)', 'Null' => self::IS_NULLABLE_YES, 'Default' => '0.00', 'Extra' => '', 'Comment' => ''
        ),
    );
    protected $aTableKeys = array(
        'UniqueEntry' => array('Non_unique' => '0', 'Column_name' => 'mpID, products_id'),
    );

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

}
