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

MLFilesystem::gi()->loadClass('Database_Model_Table_Prepare_Abstract');

class ML_Productlist_Model_Table_MarketplaceSyncFilter extends ML_Database_Model_Table_Prepare_Abstract {

    protected $sTableName = 'magnalister_marketplace_status';
    protected $aFields = array(
        'MagnalisterProductId' => array(
            'isKey' => true,
            'Type'  => 'int(11)', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'ProductsSku'          => array(
            'Type' => 'varchar(256)', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment' => 'Just to tracking product if product data in magnalister table are deleted'
        ),
        'MarketplaceId'        => array(
            'isKey' => true,
            'Type'  => 'int(11) unsigned', 'Null' => 'NO', 'Default' => '0', 'Extra' => '', 'Comment' => ''
        ),
        'Transferred'          => array(
            'Type' => 'tinyint(1)', 'Null' => 'NO', 'Default' => '0', 'Extra' => '', 'Comment' => ''
        ),
        'DeletedBy'            => array(
            'Type' => 'enum(\'\',\'empty\',\'Sync\',\'Button\',\'expired\',\'notML\')', 'Null' => 'NO', 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'UpdatedAt'            => array(
            'isInsertCurrentTime' => true,
            'Type'                => 'datetime', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
    );
    protected $aTableKeys = array(
        'MMUniqueEntry' => array('Non_unique' => '0', 'Column_name' => 'MarketplaceId, MagnalisterProductId'),
    );


    protected function setDefaultValues() {
        try {
            $sId = MLRequest::gi()->get('mp');
            if (is_numeric($sId)) {
                $this->set('MarketplaceId', $sId);
            }
        } catch (Exception $oEx) {

        }
        return $this;
    }

}
