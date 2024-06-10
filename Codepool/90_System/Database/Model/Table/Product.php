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

class ML_Database_Model_Table_Product extends ML_Database_Model_Table_Abstract {

    protected $sTableName = 'magnalister_products';
//    protected $sBackupTableName = 'magnalister_products_history';
//    protected $aKeys = array('id');

    protected $aFields = array(
        'ID'                    => array(
             'isKey' => true,
             'Type' => 'int(11)',    'Null' => self::IS_NULLABLE_NO, 'Default' => NULL, 'Extra' => 'auto_increment', 'Comment' => ''),
        'ParentId'              => array(
             'Type' => 'int(11)',    'Null' => self::IS_NULLABLE_NO, 'Default' => NULL, 'Extra' => ''              , 'Comment' => ''),
        'ProductsId'            => array(
             'Type' => 'varchar(255)','Null' => self::IS_NULLABLE_NO, 'Default' => NULL, 'Extra' => ''              , 'Comment' => ''),
        'ProductsSku'           => array(
             'Type' => 'varchar(255)','Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => ''              , 'Comment' => ''),
        'MarketplaceIdentId'    => array(
             'Type' => 'varchar(255)','Null' => self::IS_NULLABLE_NO, 'Default' => NULL, 'Extra' => ''              , 'Comment' => ''),
        'MarketplaceIdentSku'   => array(
             'Type' => 'varchar(255)','Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => ''              , 'Comment' => ''),
        'LastUsed'              => array(
             'Type' => 'date',       'Null' => self::IS_NULLABLE_NO, 'Default' => NULL, 'Extra' => ''              , 'Comment' => ''),
        'Data'                  => array(
             'Type' => 'text',       'Null' => self::IS_NULLABLE_NO, 'Default' => NULL, 'Extra' => ''              , 'Comment' => ''),
        'ShopData'              => array(
             'Type' => 'text',       'Null' => self::IS_NULLABLE_NO, 'Default' => NULL, 'Extra' => ''              , 'Comment' => ''),
    );

    protected $aTableKeys = array(
        'PRIMARY'             => array('Non_unique' => '0', 'Column_name' => 'ID'),
        'ParentId'            => array('Non_unique' => '1', 'Column_name' => 'ParentId'),
        'MarketplaceIdentId'  => array('Non_unique' => '1', 'Column_name' => 'MarketplaceIdentId'),
        'MarketplaceIdentSku' => array('Non_unique' => '1', 'Column_name' => 'MarketplaceIdentSku'),
        'ProductsId'          => array('Non_unique' => '1', 'Column_name' => 'ProductsId'),
        'ProductsSku'         => array('Non_unique' => '1', 'Column_name' => 'ProductsSku'),
    );

    protected function setDefaultValues() {
        return $this;
    }

    public function save() {
        if (!$this->load()->blLoaded) {
            $this->set('lastused', date('Y-m-d'));
        }
        return parent::save();
    }

    public function delete() {
        return parent::delete();
    }

}
