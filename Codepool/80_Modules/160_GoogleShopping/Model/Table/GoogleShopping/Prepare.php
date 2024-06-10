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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Database_Model_Table_Prepare_Abstract');

class ML_GoogleShopping_Model_Table_GoogleShopping_Prepare extends ML_Database_Model_Table_Prepare_Abstract {
    protected $aFields = array(
        'mpID' => array(
            'isKey' => true,
            'Type' => 'int(11) unsigned', 'Null' => 'NO', 'Default' => null, 'Extra' => '', 'Comment'=>''
        ),
        'products_id' => array(
            'isKey' => true,
            'Type' => 'int(11)', 'Null' => 'NO', 'Default' => null, 'Extra' => '', 'Comment'=>''
        ),
        'PreparedTS'   => array(
            'isInsertCurrentTime' => true,
            'Type' => 'datetime', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment'=>''
        ),
        'channel' => array(
            'Type' => 'varchar(6)', 'Null' => 'NO', 'Default' => 'online', 'Extra' => '', 'Comment'=>''
        ),
        'title' => array(
            'Type' => 'varchar(60)', 'Null' => 'NO', 'Default' => null, 'Extra' => '', 'Comment'=>''
        ),
        'offerId' => array(
            'Type' => 'varchar(255)', 'Null' => 'NO', 'Default' => null, 'Extra' => '', 'Comment'=>''
        ),
        'brand' => array(
            'Type' => 'varchar(255)', 'Null' => 'NO', 'Default' => null, 'Extra' => '', 'Comment'=>''
        ),
        'condition' => array(
            'Type' => 'varchar(30)', 'Null' => 'NO', 'Default' => null, 'Extra' => '', 'Comment'=>''
        ),
        'link' => array(
            'Type' => 'text', 'Null' => 'NO', 'Default' => null, 'Extra' => '', 'Comment'=>''
        ),
        'description' => array(
            'Type' => 'text', 'Null' => 'NO', 'Default' => null, 'Extra' => '', 'Comment'=>''
        ),
        'availability' => array(
            'Type' => 'varchar(64)', 'Null' => 'NO', 'Default' => null, 'Extra' => '', 'Comment'=>''
        ),
        'Verified' => array(
            'Type' => 'enum(\'OK\',\'ERROR\',\'OPEN\',\'EMPTY\')', 'Null' => 'YES', 'Default' => 'OPEN', 'Extra' => '', 'Comment'=>''
        ),
        'PrepareType' => array(
            'Type' => 'enum(\'manual\',\'auto\',\'apply\')', 'Null' => 'NO', 'Default' => null, 'Extra' => '', 'Comment'=>''
        ),
        'Primarycategory' => array(
            'Type' => 'text', 'Null' => 'NO', 'Default' => null, 'Extra' => '', 'Comment'=>''
        ),
        'PrimaryCategoryName' => array(
            'Type' => 'text', 'Null' => 'NO', 'Default' => null, 'Extra' => '', 'Comment'=>''
        ),
        'Image' => array(
            'Type' => 'text', 'Null' => 'NO', 'Default' => null,'Extra' => '', 'Comment'=>''
        ),
        'ShopVariation' => array(
            'Type' => 'longtext', 'Null' => 'NO', 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
        'CustomAttributes' => array(
            'Type' => 'text', 'Null' => 'NO', 'Default' => null, 'Extra' => '', 'Comment' => ''
        ),
    );

    protected $sTableName = 'magnalister_googleshopping_prepare';
    protected $aTableKeys=array(
        'UniqueEntry' => array('Non_unique' => '0', 'Column_name' => 'mpID, products_id'),
    );

    public function set($sName, $mValue) {
        $sName= strtolower($sName);
        if (
            $mValue !== null
            && in_array($sName, array('Primarycategory'))
        ) {
            $this->set($sName, $mValue);
        }
        return parent::set($sName, $mValue);
    }

    protected function getTopCategories($sClass, $sField) {
        $aCats = array();

        $oCat = MLDatabase::factory($sClass);
        $sQuery = "
            SELECT $sField
            FROM ".$this->sTableName." prepare
            INNER JOIN ".MLDatabase::factory('product')->getTableName()." product on product.id = prepare.products_id
            INNER JOIN ".$oCat->getTableName()." cat on cat.categoryid = ".$sField."
            WHERE prepare.mpid = " . MLModule::gi()->getMarketPlaceId() . "
            GROUP BY $sField
            ORDER BY count($sField)/count(product.parentid)+count(distinct product.parentid)-1 desc
            LIMIT 10
        ";

        foreach (MLDatabase::getDbInstance()->fetchArray($sQuery, true) as $iCatId) {
            $oCat->init(true)->set('categoryid', $iCatId);
            $sCat = '';
            foreach ($oCat->getCategoryPath() as $oParentCat) {
                $sCat = $oParentCat->get('categoryname').' &gt; '.$sCat;
            }

            $aCats[$iCatId] = substr($sCat, 0, -6);
        }

        return $aCats;
    }

    public function getTopPrimaryCategories() {
        return $this->getTopCategories('googleshopping_categoriesmarketplace', 'Primarycategory');
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

    public function getPreparedTypeFieldName() {
        return 'PrepareType';
    }

    public function isVariationMatchingSupported() {
        return true;
    }

    /**
     * Resolving the problem with correct insert of primary category name
     * in table magnalister_googleshopping_prepare
     *
     * @return $this|ML_Database_Model_Table_Prepare_Abstract
     * @throws Exception
     */
    protected function insert() {
        if (!$this->allKeysExists()) {
            throw new Exception('not all keys are set'.$this->getMissingKeysInfo());
        } else {
            if ($this->sInsertCurrentTimeFieldName != '' && empty($this->aData[$this->sInsertCurrentTimeFieldName])) {

                $this->set($this->sInsertCurrentTimeFieldName, date('Y-m-d H:i:s'));
            }
            $aData = array();
            $aKeys = array_keys(array_change_key_case($this->aFields, CASE_LOWER));

            //insert correct category name
            $this->aData['primarycategoryname'] = $this->retrieveValidCategoryName();


            foreach (array_keys($this->aData) as $sKey) {
                if (in_array(strtolower($sKey), $aKeys)) {
                    $aData[$sKey] = $this->aData[$sKey];
                }
            }

            MLDatabase::getDbInstance()->insert($this->sTableName, $aData) ;
            return $this;
        }
    }

    /**
     * Resolving the problem with correct update of primary category name
     * in table magnalister_googleshopping_prepare
     *
     * @return $this|ML_Database_Model_Table_Prepare_Abstract
     * @throws Exception
     */
    protected function update() {
        if (!$this->allKeysExists()) {
            throw new Exception('not all keys are set'.$this->getMissingKeysInfo()) ;
        } else {
            $aData = array();
            $aKeys = array_keys(array_change_key_case($this->aFields, CASE_LOWER));

            //insert correct category name
            $this->aData['primarycategoryname'] = $this->retrieveValidCategoryName();

            foreach (array_keys($this->aData) as $sKey) {
                if (in_array(strtolower($sKey), $aKeys)) {
                    $aData[$sKey] = $this->aData[$sKey];
                }
            }
            MLDatabase::getDbInstance()->update($this->sTableName, $aData, $this->buildWhere());
            $this->aOrginData = $this->aData;
            return $this;
        }
    }

    /**
     *
     * Helper function for retrieving correct category name
     * for inserting and updating products while preparing
     *
     * @return string
     */
    protected  function retrieveValidCategoryName(){

        //get the name of primary category for google shopping via category key
        $primaryCategory = MLDatabase::getDbInstance()->fetchArray(
            'SELECT * FROM magnalister_googleshopping_categories_marketplace WHERE CategoryID= ' . $this->aData['primarycategory']);
        $primaryCategoryName = $primaryCategory[0]['CategoryName'];

        $categoryParentId = $primaryCategory[0]['ParentID'];
        //checking for parent categories
        while($categoryParentId){
            //check for Parent category
            $parentCategory =  MLDatabase::getDbInstance()->fetchArray(
                'SELECT * FROM magnalister_googleshopping_categories_marketplace WHERE CategoryID= ' . $categoryParentId);
            //add the parent category name
            $primaryCategoryName .= ' < ' . $parentCategory[0]['CategoryName'];
            if(!$parentCategory[0]['ParentID'])
                break;
            $categoryParentId = $parentCategory[0]['ParentID'];

        }

        return $primaryCategoryName;

    }
}
