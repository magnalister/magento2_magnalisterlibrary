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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Database_Model_Table_Prepare_Abstract');

class ML_Hood_Model_Table_Hood_Prepare extends ML_Database_Model_Table_Prepare_Abstract {

    protected $sTableName = 'magnalister_hood_prepare';

    protected $aFields = array(
        'products_id' => array(
            'isKey' => true,
            'Type' => 'int(11)', 'Null' => self::IS_NULLABLE_NO, 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
        'PreparedTS' => array(
            'isInsertCurrentTime' => true,
            'Type' => 'datetime', 'Null' => self::IS_NULLABLE_YES, 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
        'StartTime' => array(
            'Type' => 'datetime', 'Null' => self::IS_NULLABLE_YES, 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
        'mpID' => array(
            'isKey' => true,
            'Type' => 'int(11) unsigned', 'Null' => self::IS_NULLABLE_NO, 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
        'Title' => array(
            'Type' => 'varchar(85)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'Subtitle' => array(
            'Type' => 'varchar(55)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'Manufacturer' => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'ManufacturerPartNumber' => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_YES, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'ShortDescription' => array(
            'Type' => 'longtext', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'Description' => array(
            'Type' => 'longtext', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'Images' => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'ConditionType' => array(
            'Type' => 'varchar(25)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'Price' => array(
            'Type' => 'decimal(15,4)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'BuyItNowPrice' => array(
            'Type' => 'decimal(15,4)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'currencyID' => array(
            'Type' => 'varchar(3)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 'EUR', 'Extra' => '', 'Comment' => ''
        ),
        'PrimaryCategory' => array(
            'Type' => 'int(10)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''
        ),
        'PrimaryCategoryName' => array(
            'Type' => 'varchar(128)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'SecondaryCategory' => array(
            'Type' => 'int(10)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'SecondaryCategoryName' => array(
            'Type' => 'varchar(128)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'StoreCategory' => array(
            'Type' => 'bigint(11)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'StoreCategory2' => array(
            'Type' => 'bigint(11)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'StoreCategory3' => array(
            'Type' => 'bigint(11)', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'PrimaryCategoryAttributes' => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'SecondaryCategoryAttributes' => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'ShopVariation' => array(
            'Type' => 'longtext', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'VariationThemeBlacklist' => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
        'FSK' => array(
            'Type' => 'tinyint(4)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '-1', 'Extra' => '', 'Comment' => ''
        ),
        'USK' => array(
            'Type' => 'tinyint(4)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '-1', 'Extra' => '', 'Comment' => ''
        ),
        'Features' => array(
            'Type' => 'text', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'ListingType' => array(
            'Type' => "enum('Chinese','FixedPriceItem','StoresFixedPrice')", 'Null' => self::IS_NULLABLE_NO, 'Default' => 'FixedPriceItem', 'Extra' => '', 'Comment' => ''
        ),
        'ListingDuration' => array(
            'Type' => 'varchar(10)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'PrivateListing' => array(
            'Type' => "enum('0','1')", 'Null' => self::IS_NULLABLE_NO, 'Default' => '0', 'Extra' => '', 'Comment' => ''
        ),
        'PaymentMethods' => array(
            'Type' => 'longtext', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'ShippingLocal' => array(
            'Type' => 'longtext', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'ShippingInternational' => array(
            'Type' => 'longtext', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'noidentifierflag' => array(
            'Type' => 'varchar(10)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '0', 'Extra' => '', 'Comment' => ''
        ),
        'Verified' => array(
            'Type' => "enum('OK','ERROR','OPEN')", 'Null' => self::IS_NULLABLE_NO, 'Default' => 'OPEN', 'Extra' => '', 'Comment' => ''
        ),
        'Transferred' => array(
            'Type' => 'tinyint(1)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '0', 'Extra' => '', 'Comment' => ''
        ),
        'deletedBy' => array(
            'Type' => "enum('','empty','Sync','Button','expired','notML')", 'Null' => self::IS_NULLABLE_NO, 'Default' => 'empty', 'Extra' => '', 'Comment' => ''
        ),
        'topPrimaryCategory' => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'topSecondaryCategory' => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'topStoreCategory' => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'topStoreCategory2' => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'topStoreCategory3' => array(
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
        )
    );

    protected $aTableKeys = array(
        'UniqueEntry' => array('Non_unique' => '0', 'Column_name' => 'mpID, products_id'),
    );

    public function __construct() {
        parent::__construct();
    }

    /**
     * Price was before possible as "frozen-price". Now Price is null, if not chinese
     * set Price to null, if not chinese
     * @deprecated since 3488
     */
    protected function runOnceSession() {
        if (MLDatabase::getDbInstance()->tableExists($this->sTableName)) {
            MLDatabase::getDbInstance()->update($this->getTableName(), array('Price' => null), array('ListingType' => 'Chinese'));
            MLDatabase::getDbInstance()->update($this->getTableName(), array('Price' => null), array('ListingType' => 'FixedPriceItem'));
            MLDatabase::getDbInstance()->update($this->getTableName(), array('Price' => null), array('ListingType' => 'StoresFixedPrice'));
        }
        parent::runOnceSession();
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

    public function save() {
        foreach (array('primarycategory', 'secondarycategory') as $sCatType) {
            if ($this->get($sCatType) !== null) {
                $this->set($sCatType.'name', MLDatabase::factory('hood_categoriesmarketplace')->set('categoryid', $this->get($sCatType))->getCategoryPath(false));
            }
        }
        parent::save();
    }

    public function set($sName, $mValue) {
        $sName = strtolower($sName);
        if ($sName == 'starttime' && $mValue !== null) {
            $iTime = strtotime(str_replace('/', '-', $mValue));
            $mValue = empty($iTime) ? null : date('Y-m-d H:i:s', $iTime);
        } elseif (in_array($sName, array('price', 'buyitnowprice')) && $mValue !== null) {
            $mValue = (float)str_replace(',', '.', $mValue);
        }
        if (
            $mValue !== NULL
            && in_array($sName, array('primarycategory', 'secondarycategory', 'storecategory', 'storecategory2', 'storecategory3'))
        ) {
            $this->set('top'.$sName, $mValue);
        }
        return parent::set($sName, $mValue);
    }

    public function getVariantCount($mProduct) {
        $iMasterProductId = (int)(
        $mProduct instanceof ML_Database_Model_Table_Abstract ? $mProduct->get('id') : $mProduct
        );
        $sSql = "
            SELECT COUNT(*)
            FROM magnalister_products p
            INNER JOIN magnalister_hood_prepare s ON p.id = s.products_id
            WHERE     p.parentid = '".$iMasterProductId."'
                  AND s.mpid = '".MLRequest::gi()->get('mp')."'
                  AND s.verified = 'OK'
        ";
        return MLDatabase::getDbInstance()->fetchOne($sSql);
    }

    /**
     * field name for prepared-type if exists
     * @return string|null
     */
    public function getPreparedTypeFieldName() {
        return 'listingtype';
    }

    public function isVariationMatchingSupported() {
        return true;
    }

    protected function getTopCategories($sClass, $sField) {
        $aCats = array();
        $oCat = MLDatabase::factory($sClass);
        /* @var $oCat ML_Modul_Model_Table_Categories_Abstract */
        $query = "
            SELECT ".$sField."
            FROM ".$this->sTableName." prepare
            INNER JOIN ".MLDatabase::factory('product')->getTableName()." product on product.id = prepare.products_id
            INNER JOIN ".$oCat->getTableName()." cat on cat.categoryid = ".$sField."
            WHERE prepare.mpid = ".MLModul::gi()->getMarketPlaceId()."
            GROUP BY ".$sField."
            ORDER BY count(".$sField.")/count(product.parentid)+count(distinct product.parentid)-1 desc
            LIMIT 10
        ";

        foreach (MLDatabase::getDbInstance()->fetchArray($query, true) as $iCatId) {
            $oCat->init(true)->set('categoryid', $iCatId);
            $sCat = '';
            foreach ($oCat->getCategoryPath() as $oParentCat) {
                $sCat = $oParentCat->get('categoryname').' &gt; '.$sCat;
            }

            $aCats[$iCatId] = substr($sCat, 0, -6);
        }

        return $aCats;
    }

    public function getTopPrimaryCategory() {
        return $this->getTopCategories('hood_categoriesmarketplace', 'topprimarycategory');
    }

    public function getTopSecondaryCategory() {
        return $this->getTopCategories('hood_categoriesmarketplace', 'topsecondarycategory');
    }

    public function getTopStoreCategory() {
        return $this->getTopCategories('hood_categoriesstore', 'topstorecategory');
    }

    public function getTopStoreCategory2() {
        return $this->getTopCategories('hood_categoriesstore', 'topstorecategory2');
    }

    public function getTopStoreCategory3() {
        return $this->getTopCategories('hood_categoriesstore', 'topstorecategory3');
    }
}
