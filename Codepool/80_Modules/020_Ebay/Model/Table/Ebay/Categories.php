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

require_once MLFilesystem::getOldLibPath('php/modules/ebay/ebayFunctions.php');

MLFilesystem::gi()->loadClass('Modul_Model_Table_Categories_Abstract');

class ML_Ebay_Model_Table_Ebay_Categories extends ML_Modul_Model_Table_Categories_Abstract {
    const iEbayLiveTime = 86400;//24 * 60 * 60

    protected $sTableName = 'magnalister_ebay_categories';

    protected $aFields = array(
        'CategoryID' => array(
            'isKey' => true,
            'Type' => 'bigint(11)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''),
        'SiteID' => array(
            'isKey' => true,
            'Type' => 'int(4)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 77, 'Extra' => '', 'Comment' => ''),
        'CategoryName' => array(
            'Type' => 'varchar(128)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''),
        'CategoryPath' => array(
            'Type' => 'varchar(500)', 'Null' => self::IS_NULLABLE_YES, 'Default' => '', 'Extra' => '', 'Comment' => ''),
        'CategoryLevel' => array(
            'Type' => 'int(3)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 1, 'Extra' => '', 'Comment' => ''),
        'ParentID' => array(
            'Type' => 'bigint(11)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''),
        'LeafCategory' => array(
            'Type' => 'tinyint(4)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 1, 'Extra' => '', 'Comment' => ''),
        'B2BVATEnabled' => array(
            'Type' => 'tinyint(4)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''),
        'StoreCategory' => array(
            'isKey' => true,
            'Type' => 'tinyint(4)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''),
        'Attributes' => array(
            'Type' => 'int(11)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''),
        'ImportOrUpdateTime' => array(
            'Type' => 'datetime', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''),
    );

    protected $aTableKeys = array(
        'PRIMARY' => array('Non_unique' => '0', 'Column_name' => 'CategoryID, SiteID, StoreCategory'),
    );

    /**
     *
     * @var bool $blEbayBatchmode if true, no check by loading
     */
    protected static $blLoadFromApi = true;


    public function __construct() {
        parent::__construct();
    }

    protected function setDefaultValues() {
        $this->set('storecategory', 0);
        return $this;
    }

    public function set($sName, $mValue) {
        if (strtolower($sName) == 'storecategory') {
            if ($mValue == 0) {
                parent::set('siteid', MLModule::gi()->getEbaySiteId());
            } else {
                parent::set('siteid', MLModule::gi()->getMarketPlaceId());
            }
        } elseif (strtolower($sName) == 'siteid') {
            if ($mValue == MLModule::gi()->getMarketPlaceId()) {
                parent::set('storecategory', 1);
            } else {
                parent::set('storecategory', 0);
            }
        }
        return parent::set($sName, $mValue);
    }

    public function variationsEnabled() {
        if ($this->get('categoryid') == 0) {
            $blOut = false;
        } else {
            try {
                $aResponse = MagnaConnector::gi()->submitRequestCached(array(
                    'ACTION' => 'VariationsEnabled',
                    'DATA' => array(
                        'CategoryID' => $this->get('categoryid'),
                        'Site' => MLModule::gi()->getConfig('site')
                    ),
                ), self::iEbayLiveTime);
                if (
                    isset($aResponse['DATA']['VariationsEnabled'])
                    && ('true' == (string)$aResponse['DATA']['VariationsEnabled'])
                ) {
                    $blOut = true;
                } else {
                    $blOut = false;
                }
            } catch (MagnaException $e) {
                echo $e->getMessage();
                $blOut = false;
            }
        }
        return $blOut;
    }

    public function productRequired() {
        if ($this->get('categoryid') == 0) {
            $blOut = false;
        } else {
            try {
                $aResponse = MagnaConnector::gi()->submitRequest(array(
                    'ACTION' => 'ProductRequired',
                    'DATA' => array(
                        'CategoryID' => $this->get('categoryid'),
                        'Site' => MLModule::gi()->getConfig('site')),
                ));
                if (
                    isset($aResponse['DATA']['ProductRequiredEnabled']) &&
                    (
                        ('Required' == (string)$aResponse['DATA']['ProductRequiredEnabled']) ||
                        ('Enabled' == (string)$aResponse['DATA']['ProductRequiredEnabled'])
                    )
                ) {
                    $blOut = true;
                }
            } catch (MagnaException $e) {
                $blOut = false;
            }
        }
        return $blOut;
    }

    public function getConditionValues() {
        if ($this->get('categoryid') == 0) {
            $blOut = false;
        } else {
            try {
                $aResponse = MagnaConnector::gi()->submitRequestCached(array(
                    'ACTION' => 'GetConditionValues',
                    'DATA' => array(
                        'CategoryID' => $this->get('categoryid'),
                        'Site' => MLModule::gi()->getConfig('site')
                    ),
                ), self::iEbayLiveTime);
                if (
                    isset($aResponse['DATA']['ConditionValues'])
                    && (is_array($aResponse['DATA']['ConditionValues']))
                ) {
                    $blOut = $aResponse['DATA']['ConditionValues'];
                } else {
                    $blOut = false;
                }
            } catch (MagnaException $e) {
                echo $e->getMessage();
                $blOut = false;
            }
        }
        return $blOut;
    }

    public function getConditionPolicies() {
        if ($this->get('categoryid') == 0) {
            $blOut = false;
        } else {
            try {
                $aResponse = MagnaConnector::gi()->submitRequestCached(array(
                    'ACTION' => 'GetConditionPolicies',
                    'DATA' => array(
                        'CategoryID' => $this->get('categoryid'),
                        'Site' => MLModule::gi()->getConfig('site')
                    ),
                ), self::iEbayLiveTime);
                if (
                    isset($aResponse['DATA']['ConditionPolicies'])
                    && (is_array($aResponse['DATA']['ConditionPolicies']))
                    && (!empty($aResponse['DATA']['ConditionPolicies']))
                ) {
                    $blOut = $aResponse['DATA']['ConditionPolicies'];
                } else {
                    $blOut = false;
                }
            } catch (MagnaException $e) {
                echo $e->getMessage();
                $blOut = false;
            }
        }
        return $blOut;
    }

    /**
     * eBey use old stuff, so it is overridden
     * @param bool $blHtml
     * @return array|mixed|string
     * @throws Exception
     */
    public function getCategoryPath($blHtml = true) {
        $sSeparator = $blHtml ? '&nbsp;<span class="cp_next">&gt;</span>&nbsp;' : ' > ';
        $sPath = '';
        $categoryPath = $this->get('CategoryPath');
        if (!empty($categoryPath)) {
            $categoryPath = MLDatabase::getDbInstance()->escape((!empty($categoryPath) ? $categoryPath . '_' : '') . $this->get('CategoryID'));
            $aIds = explode('_', $categoryPath);
            if (is_array($aIds)) {
                $aCategoryNames = MLDatabase::getDbInstance()->fetchArray('
SELECT `CategoryName` FROM `' . $this->sTableName . '` 
WHERE `CategoryID` IN (' . implode(',', $aIds) . ') AND `SiteID` = ' . ((int)$this->get('siteid')) . '
ORDER BY FIELD(`CategoryID`,' . implode(',', $aIds) . ');', true);
                $sPath = implode($sSeparator, $aCategoryNames);
            }
        } else {
            $sCatId = $this->get('categoryid');
            $sStoreId = $this->get('storecategory');
            $sSideId = $this->get('siteid');

            do {
                $oModel = new self;
                $oModel
                    ->set('categoryid', $sCatId)
                    ->set('storecategory', $sStoreId)
                    ->set('siteid', $sSideId);

                if (!$oModel->exists()) {
                    $oModel->getChildCategories(true);
                } elseif ((int)$oModel->get('parentid') === 0 && (int)$oModel->get('categoryid') !== 0) { // first level categories are always loaded after expiration, but children of first level should be loaded anyway
                    $oModel->getChildCategories(true);
                }
                $sPath = $oModel->get('categoryname') . ($sPath === '' ? '' : $sSeparator . $sPath);

                $sCatId = $oModel->get('parentid');
            } while ((int)$oModel->get('parentid') !== 0);

            if ($sPath === '') {
                $sPath = MLI18n::gi()->ml_ebay_prepare_form_category_notvalid;
            }
        }
        return $sPath;
    }

    public function getAttributes() {
        if ($this->get('storecategory') == 1) {//store dont have attributes
            return array();
        } elseif ($this->get('categoryid') == 0) {
            return array();
        } else {
            $aRequest = array(
                "SUBSYSTEM" => "eBay",
                'MARKETPLACEID' => MLModule::gi()->getMarketPlaceId(),
                'DATA' => array(
                    'CategoryID' => $this->get('categoryid'),
                    'FormStructure' => true,
                    'Site' => MLModule::gi()->getConfig('site')
                )
            );
            try {
                $aRequest['ACTION'] = 'GetItemSpecifics';
                $aSpecifics = MagnaConnector::gi()->submitRequestCached($aRequest, self::iEbayLiveTime);
            } catch (MagnaException $e) {
                $aSpecifics['STATUS'] = 'ERROR';
                $aSpecifics['DATA'] = array();
            }
            if ($aSpecifics['STATUS'] == 'SUCCESS' && count($aSpecifics['DATA'])) {
                return $aSpecifics['DATA'];
            } else {
                try {
                    $aRequest['ACTION'] = 'GetAttributes';
                    $aAttributes = MagnaConnector::gi()->submitRequestCached($aRequest, self::iEbayLiveTime);
                    if ($aAttributes['STATUS'] == 'SUCCESS' && count($aAttributes['DATA'])) {
                        return $aAttributes['DATA'];
                    } else {
                        return array();
                    }
                } catch (MagnaException $e) {
                    return array();
                }
            }
        }
    }

    /**
     * @return string root >kategorie > till > current
     * */
    public function getClickPath($separator = ' > ') {
        // Since previous version of eBay code had getCategoryPath totally differently defined
        // here we just need to call parent getCategoryPath method and leave rest of the method same as in base class
        foreach (parent::getCategoryPath() as $oParentCat) {
            $aTitles[] = $oParentCat->get('categoryname');
        }

        if (isset($aTitles)) {
            $aTitles = array_reverse($aTitles);
            return implode($separator, $aTitles) . (count($aTitles) == 0 ? '' : $separator);
        }

        return '';
    }

    public function getCategoryPathArray() {
        return parent::getCategoryPath();
    }

    protected static $isStoreCategoryLoaded = false;

    public function getChildCategories($blForce = false, $bPurge = false) {

        if ((int)$this->get('storecategory') !== 1) {
            $oChildModel = new $this;
            $oChildModel->set('parentid', $this->get('categoryid'));
            $oChildModel->set('siteid', MLModule::gi()->getEbaySiteId());
            $oChildList = $oChildModel->getList();
            $oChildList->getQueryObject()->orderBy('CategoryName');

            if ($blForce || $oChildList->getCountTotal() == 0) {
                $aCategories = MLDatabase::getDbInstance()->fetchArray("
                    SELECT CategoryID, SiteID
                      FROM `magnalister_ebay_categories`
                     WHERE      ParentID = '" . $this->get('categoryid') . "'
                            AND SiteId = '" . MLModule::gi()->getEbaySiteId() . "'
                ");

                if (is_array($aCategories) && count($aCategories) > 0) {
                    // Workaround when returned category id is the same as parent category id
                    foreach ($aCategories as $iChildCat => $aChildCat) {
                        if (isset($aChildCat['CategoryID']) && $this->compareCategoryIds($aChildCat['CategoryID'], $this->get('categoryid'))) {
                            foreach ($aChildCat as $sKey => $sValue) {
                                $this->set($sKey, $sValue);
                            }
                            unset($aCategories[$iChildCat]);
                        }
                    }
                    if (count($aCategories) > 0) {
                        foreach ($aCategories as $aChildCat) {
                            $oChildList->add($aChildCat);
                        }
                    }
                }
            }

            if (!$blForce) {
                return $oChildList;
            }
            // drop toptenCategoryPaths for new categories(expires == +1 day -2 sec.)
            $sNewCatsSql = "
                SELECT CategoryID, SiteID
                  FROM `magnalister_ebay_categories`
                 WHERE UNIX_TIMESTAMP(ImportOrUpdateTime) > UNIX_TIMESTAMP() + 86398
            ";
            $aNewCats = MLDatabase::getDbInstance()->fetchArray($sNewCatsSql);
            if (empty($aNewCats)) {
                return $oChildList;
            }
            $aCachedPaths = MLModule::gi()->getConfig('toptenCategoryPaths');
            if (!empty($aCachedPaths)) {
                foreach ($aNewCats as $aNewCat) {
                    foreach ($aCachedPaths as $iCachedPathNo => $aCachedPath) {
                        if ($aCachedPath['categoryid'] == $aNewCat['CategoryID']
                            && $aCachedPath['siteid'] == $aNewCat['SiteID'])
                            unset($aCachedPaths[$iCachedPathNo]);
                    }
                }
            }
            if (!empty($aCachedPaths)) {
                MLModule::gi()->setConfig('toptenCategoryPaths', $aCachedPaths);
            }
            return $oChildList;
        } else {
            return MLDatabase::factory('ebay_categories')
                ->set('storecategory', '1')
                ->set('siteid', MLModule::gi()->getMarketPlaceId())
                ->set('parentid', $this->get('categoryid'))->getList();
        }

    }

    static protected $aTopTenEbayCategories = null;
    static protected $aTopTenStoreCategories = null;

    /**
     * @param $sType
     * @param array $aConfig
     * @return array
     * @throws Exception
     */
    public function getTopTenCategories($sType, $aConfig = array()) {
        $sType = strtolower($sType);
        $blStoreCat = strpos($sType, 'topstorecategory') === 0;

        $mCategories = null;

        if ($blStoreCat) {
            $mCategories = &self::$aTopTenStoreCategories;
        } else {
            $mCategories = &self::$aTopTenEbayCategories;
        }

        if ($mCategories === null) {
            if ($blStoreCat) {
                try {
                    $aStoreData = MagnaConnector::gi()->submitRequestCached(array('ACTION' => 'HasStore'));
                } catch (MagnaException $e) {
                    echo print_m($e->getErrorArray(), 'Error');
                }
                if (!$aStoreData['DATA']['Answer'] == 'True') {
                    throw new Exception('noStore');
                }
            }
            $sTopTenCatSql = $this->getTopTenQuery($sType);

            $aTopTenCatSql = MLDatabase::getDbInstance()->fetchArray($sTopTenCatSql, true);
            $aTopTenCatIds = array();
            asort($aTopTenCatSql);
            $iMax = MLModule::gi()->getConfig('topten');
            $iMax = $iMax === null ? 30 : (int)$iMax;
            foreach ($aTopTenCatSql as $iCatId) {
                $oCategory = MLDatabase::factory('ebay_categories')->set('categoryid', $iCatId)->set('storecategory', (int)$blStoreCat);
                $iMax--;
                if ($iMax < 0) {
                    break;
                }
                $aTopTenCatIds[$iCatId] = $oCategory->getCategoryPath();
                if (empty($aTopTenCatIds[$iCatId])) {
                    unset($aTopTenCatIds[$iCatId]);
                    MLDatabase::getDbInstance()->query("UPDATE `magnalister_ebay_prepare` SET `{$sType}`=0 WHERE `{$sType}`='" . $iCatId . "' AND mpID='" . MLModule::gi()->getMarketPlaceId() . "'");//better siteid instead mpid
                }
            }
            asort($aTopTenCatIds);
            $mCategories = $aTopTenCatIds;
        }

        return $mCategories;
    }

    protected function getTopTenQuery($sType) {
        return "
            SELECT DISTINCT `{$sType}`
            FROM `magnalister_ebay_prepare` 
            WHERE `{$sType}` <> 0 and mpID = '" . MLModule::gi()->getMarketPlaceId() . "'
            GROUP BY `{$sType}` 
            ORDER BY count( `{$sType}` ) DESC
            " . (
            (int)MLModule::gi()->getConfig('topten') !== 0
                ? 'LIMIT ' . (int)MLModule::gi()->getConfig('topten')
                : ''
            );
    }
}
