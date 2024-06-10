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

class ML_Cdiscount_Model_Table_Cdiscount_Prepare extends ML_Database_Model_Table_Prepare_Abstract {

    protected $sTableName = 'magnalister_cdiscount_prepare';

    protected $aFields = array(
        'mpID' => array(
            'isKey' => true,
            'Type' => 'int(11) unsigned', 'Null' => self::IS_NULLABLE_NO, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'products_id' => array(
            'isKey' => true,
            'Type' => 'int(11)', 'Null' => self::IS_NULLABLE_NO, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'EAN' => array(
            'Type' => 'varchar(30)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'PrimaryCategory' => array(
            'Type' => 'varchar(15)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'TopPrimaryCategory' => array(
            'Type' => 'varchar(15)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'Title' => array(
            'Type' => 'varchar(132)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'Subtitle' => array(
            'Type' => 'varchar(132)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'Description' => array(
            'Type' => 'varchar(420)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'MarketingDescription' => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'Images' => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'ItemCondition' => array(
            'Type' => 'varchar(60)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'ShopVariation' => array(
            'Type' => 'longtext', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'PreparationTime' => array(
            'Type' => 'smallint(3) unsigned', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''
        ),
        'ShippingProfileName' => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'ShippingFee' => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'ShippingFeeAdditional' => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'ShippingFeeStandard' => array(
            'Type' => 'float(6)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''
        ),
        'ShippingFeeTracked' => array(
            'Type' => 'float(6)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''
        ),
        'ShippingFeeRegistered' => array(
            'Type' => 'float(6)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''
        ),
        'ShippingFeeExtraStandard' => array(
            'Type' => 'float(6)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''
        ),
        'ShippingFeeExtraTracked' => array(
            'Type' => 'float(6)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''
        ),
        'ShippingFeeExtraRegistered' => array(
            'Type' => 'float(6)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''
        ),
        'Comment' => array(
            'Type' => 'varchar(200)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'PrepareType' => array(
            'Type' => "enum('manual','auto','apply')", 'Null' => self::IS_NULLABLE_NO, 'Default' => 'manual', 'Extra' => '', 'Comment'=>''
        ),
        'Verified' => array(
            'Type' => "enum('OK','ERROR','OPEN','EMPTY')", 'Null' => self::IS_NULLABLE_NO, 'Default' => 'OPEN', 'Extra' => '', 'Comment' => ''
        ),
        'PreparedTS'   => array (
            'isInsertCurrentTime' => true,
            'Type' => 'datetime', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'variation_theme' => array(
            'Type' => 'varchar(200)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
    );

    protected $aTableKeys = array(
        'UniqueEntry' => array('Non_unique' => '0', 'Column_name' => 'mpID, products_id'),
    );

    public function set($sName, $mValue) {
        $sName = strtolower($sName);
        if ($mValue !== NULL && in_array($sName, array('primarycategory')) ) {
            $this->set('top' . $sName, $mValue);
        }

        return parent::set($sName, $mValue);
    }

    public function getTopPrimaryCategories() {
        $aCats = array();
        $sField = 'primarycategory';
        $oCat = MLDatabase::factory('cdiscount_categoriesmarketplace');
        $sQuery = "
            SELECT $sField
            FROM " . $this->sTableName . " prepare
            INNER JOIN " . MLDatabase::factory('product')->getTableName() . " product on product.id = prepare.products_id
            INNER JOIN " . $oCat->getTableName() . " cat on cat.categoryid = " . $sField . "
            WHERE prepare.mpid = " . MLModule::gi()->getMarketPlaceId() . "
            GROUP BY $sField
            ORDER BY count($sField)/count(product.parentid)+count(distinct product.parentid)-1 desc
            LIMIT 10
        ";

        foreach (MLDatabase::getDbInstance()->fetchArray($sQuery, true) as $iCatId) {
            $oCat->init(true)->set('categoryid', $iCatId);
            $sCat = '';
            foreach ($oCat->getCategoryPath() as $oParentCat) {
                $sCat = $oParentCat->get('categoryname') . ' &gt; ' . $sCat;
            }

            $aCats[$iCatId] = substr($sCat, 0, -6);
        }

        return $aCats;
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

    public function isVariationMatchingSupported() {
        return true;
    }
}
