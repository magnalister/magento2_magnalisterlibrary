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
MLFilesystem::gi()->loadClass('Database_Model_Table_VariantMatching_Abstract');

class ML_Ebay_Model_Table_Ebay_VariantMatching extends ML_Database_Model_Table_VariantMatching_Abstract {

    protected $sTableName = 'magnalister_ebay_variantmatching';

    protected $aTableKeys = array(
        'UniqueEntry' => array('Non_unique' => '0', 'Column_name' => 'mpID, Identifier'),
    );

    public function getTopPrimaryCategories() {
        return $this->getLastModifiedCategories(MLModule::gi()->getMarketPlaceName() . '_categories', 'Identifier', 'ModificationDate');
    }

    protected function getLastModifiedCategories($sClass, $sField, $orderBy) {
        $oCat = MLDatabase::factory($sClass);
        /* @var $oCat ML_Modul_Model_Table_Categories_Abstract */
        $query = "
            SELECT ".$sField."
            FROM ".$this->sTableName." prepare
            INNER JOIN ".$oCat->getTableName()." cat on cat.categoryid = ".$sField."
            WHERE prepare.mpid = " . MLModule::gi()->getMarketPlaceId() . "
            GROUP BY ".$sField."
            ORDER BY ".$orderBy." desc
            LIMIT 10
        ";

        $aTopTenCatIds = array();
        $aTopTenCatSql = MLDatabase::getDbInstance()->fetchArray($query, true);
        asort($aTopTenCatSql);
        $iMax = 20; // If all categories are expired we couldn't load all topten categories from ebay, it takes a lot of time and limit it each request to load 10 category
        foreach ($aTopTenCatSql as $iCatId) {
            $oCategory = MLDatabase::factory('ebay_categories')->set('categoryid', $iCatId);
            if (!$oCategory->exists()) {
                $iMax--;
            }
            if ($iMax === 0) {
                break;
            }
            $aTopTenCatIds[$iCatId] = $oCategory->getCategoryPath();
        }
        asort($aTopTenCatIds);
        $mCategories = $aTopTenCatIds;

        return $mCategories;
    }
}
