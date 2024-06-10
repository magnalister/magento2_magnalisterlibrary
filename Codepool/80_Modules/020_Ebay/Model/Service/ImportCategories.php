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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Ebay_Model_Service_ImportCategories extends ML_Modul_Model_Service_ImportCategories_Abstract {

    protected $sTableName = 'magnalister_ebay_categories';

    protected $iExpiresLiveTime = 0;
    protected $aTableColumns = array(
        'CategoryID',
        'SiteID',
        'CategoryName',
        'CategoryLevel',
        'ParentID',
        'LeafCategory',
        'B2BVATEnabled',
        'StoreCategory',
        'ImportOrUpdateTime'
    );

    protected function extendCategoryData(&$dCategories, $timestamp) {
        foreach ($dCategories as &$dCategory) {
            $dCategory['ImportOrUpdateTime'] = $timestamp;
            if ($dCategory['CategoryID'] === $dCategory['ParentID']) {
                $dCategory['ParentID'] = 0;
            }
            unset($dCategory['Expires']);
        }
    }

    protected function deleteOldCategories($timestamp) {
        MLDatabase::getDbInstance()->query('DELETE FROM `'.$this->sTableName.'` WHERE ImportOrUpdateTime < "'.$timestamp.'" AND SiteID = "'.MLModule::gi()->getEbaySiteId().'"');
    }

    protected function getGetCategoriesRequest() {
        $aRequest = array(
            'ACTION' => 'GetListOfAllCategories',
            'OFFSET' => (ctype_digit(MLRequest::gi()->data('offset'))) ? (int)MLRequest::gi()->data('offset') : 0,
            'LIMIT' => ((int)MLRequest::gi()->data('maxitems') > 0) ? (int)MLRequest::gi()->data('maxitems') : $this->iImportCategoriesLimit,
        );
        if ((int)MLRequest::gi()->data('steps') > 0) {
            $aRequest['steps'] = (int)MLRequest::gi()->data('steps');
        }

        return $aRequest;
    }

    protected function createCategoriesPath() {
        $this->log('set parent' . "\n\n", self::LOG_LEVEL_LOW);
        $oDB = MLDatabase::getDbInstance();
        $categories = $oDB->fetchArray("SELECT `CategoryID` FROM `" . $this->sTableName . '`');

        $this->log('category number:' . count($categories) . "\n\n", self::LOG_LEVEL_LOW);
        if (is_array($categories)) {
            foreach ($categories as $category) {
                $categoryId = $category['CategoryID'];
                $parentIds = $this->fetchParentIds($categoryId);
                $oDB->update($this->sTableName, [
                    'CategoryPath' => $parentIds
                ], [
                    'CategoryID' => $categoryId
                ]);
            }
        }
    }


    protected function fetchParentIds($categoryId) {
        $parentIdString = '';
        while ($categoryId != 0) {
            if ($row = MLDatabase::getDbInstance()->fetchRow("SELECT `CategoryID`, `ParentID` FROM " . $this->sTableName . " WHERE CategoryID = " . (int)$categoryId)) {
                $parentId = $row['ParentID'];
                // Prepend the current parent ID to the string
                $parentIdString = $parentId . ($parentIdString ? '_' . $parentIdString : '');
                $categoryId = $parentId; // Move up the hierarchy
            } else {
                // No parent found, break the loop
                break;
            }
        }
        return $parentIdString;
    }

}