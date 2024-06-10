<?php
/*
 * 888888ba                 dP  .88888.                    dP
 * 88    `8b                88 d8'   `88                   88
 * 88aaaa8P' .d8888b. .d888b88 88        .d8888b. .d8888b. 88  .dP  .d8888b.
 * 88   `8b. 88ooood8 88'  `88 88   YP88 88ooood8 88'  `"" 88888"   88'  `88
 * 88     88 88.  ... 88.  .88 Y8.   .88 88.  ... 88.  ... 88  `8b. 88.  .88
 * dP     dP `88888P' `88888P8  `88888'  `88888P' `88888P' dP   `YP `88888P'
 *
 *                            m a g n a l i s t e r
 *                                        boost your Online-Shop
 *
 *   -----------------------------------------------------------------------------
 *   @author magnalister
 *   @copyright 2010-2022 RedGecko GmbH -- http://www.redgecko.de
 *   @license Released under the MIT License (Expat)
 *   -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Modul_Model_Table_Categories_Abstract');

class ML_Hood_Model_Table_Hood_CategoriesStore extends ML_Modul_Model_Table_Categories_Abstract {

    protected $sTableName = 'magnalister_hood_categories_store';
    static protected $blIsChildCategoriesFetched = false;

    public function init($blForce = false) {
        parent::init($blForce);
        if (!isset($this->aFields['mpid'])) {
            $this->aFields['mpid'] = array(
                'isKey' => true,
                'Type' => 'int(8)', 'Null' => 'NO', 'Default' => '0', 'Extra' => '', 'Comment' => ''
            );
        }
        return $this;
    }

    protected function setDefaultValues() {
        $this->set('mpid', MLModule::gi()->getMarketPlaceId());
        return $this;
    }

    protected function getChildCategoriesRequest() {
        $aRequest = parent::getChildCategoriesRequest();
        $aRequest['ACTION'] = 'GetStoreCategories';
        return $aRequest;
    }

    protected static $aCategoryCache = array();

    /**
     * This cache solution is developed and tested for Hood to improve performance and reduce consuming memory and loading time,
     * it could be tested and used for other marketplaces later
     * @param bool $blForce
     * @return mixed
     * @throws Exception
     */
    public function getChildCategories($blForce = false) {
        $sCacheKey = MLModule::gi()->getMarketPlaceName().'_'.$this->get('categoryid');
        if (!isset(self::$aCategoryCache[$sCacheKey])) {
            self::$aCategoryCache[$sCacheKey] = $this->getChildCategoriesPrime();
        }
        return self::$aCategoryCache[$sCacheKey];
    }

    /**
     * Get All store category from API and pupulate the table if it is neccessary, and return the current category
     */
    public function getChildCategoriesPrime() {
        $this->getPopulateChildCategoriesFromAPI();
        $oChildModel = new $this;
        $oChildModel->set('parentid', $this->get('categoryid'));
        $oChildList = $oChildModel->getList();
        $oChildList->getQueryObject()->orderBy('CategoryName');
        return $oChildList;
    }

    /**
     * Populate child categories in category store table
     * @throws Exception
     */
    public function getPopulateChildCategoriesFromAPI() {
        if (self::$blIsChildCategoriesFetched === false) {
            $this->emptyTheTable();
            $oChildModel = new $this;
            $oChildModel->set('parentid', $this->get('categoryid'));
            foreach ($this->getKeys(true) as $sKey) {
                if (
                    $sKey !== 'categoryid' //set as parent id
                    && !isset($oChildModel->aData[$sKey])
                ) {
                    $oChildModel->set($sKey, $this->get($sKey));
                }
            }
            try {
                $aRequest = $this->getChildCategoriesRequest();
                $aResponse = MagnaConnector::gi()->submitRequest($aRequest);

                if (
                    isset($aResponse['STATUS']) && $aResponse['STATUS'] == 'SUCCESS'
                    && isset($aResponse['DATA']) && is_array($aResponse['DATA']) && count($aResponse['DATA']) > 0
                ) {
                    // Workaround when returned category id is the same as parent category id
                    foreach ($aResponse['DATA'] as $aChildCat) {
                        $oChild = new $oChildModel;
                        foreach ($aChildCat as $sKey => $sValue) {
                            $oChild->set($sKey, $sValue);
                        }
                        $oChild->save();
                    }
                }
                self::$blIsChildCategoriesFetched = true;
            } catch (MagnaException $oEx) {
                MLMessage::gi()->addDebug($oEx);
                throw new Exception();
            }
        }
    }

}
