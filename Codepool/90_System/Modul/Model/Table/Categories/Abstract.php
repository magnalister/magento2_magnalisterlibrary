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

MLFilesystem::gi()->loadClass('Database_Model_Table_Abstract');

abstract class ML_Modul_Model_Table_Categories_Abstract extends ML_Database_Model_Table_Abstract {

    const iExpiresLiveTime = 86400;

    protected $aFields = array(
        'CategoryID' => array(
            'isKey' => true,
            'Type' => 'varchar(32)',    'Null' => 'NO', 'Default' => 0,     'Extra' => '', 'Comment' => ''
        ),
        'CategoryName' => array(
            'Type' => 'varchar(128)',   'Null' => 'NO', 'Default' => '',    'Extra' => '', 'Comment' => ''
        ),
        'ParentID' => array(
            'Type' => 'varchar(32)',     'Null' => 'NO', 'Default' => 0,     'Extra' => '', 'Comment' => ''
        ),
        'LeafCategory' => array(
            'Type' => 'tinyint(4)',     'Null' => 'NO', 'Default' => 1,     'Extra' => '', 'Comment' => ''
        ),
        'Expires' => array(
            'isExpirable' => true,
            'Type' => 'datetime',       'Null' => self::IS_NULLABLE_YES, 'Default' => NULL,  'Extra' => '', 'Comment' => ''
        ),
    );

    protected $aTableKeys = array(
        'PRIMARY' => array('Non_unique' => '0', 'Column_name' => 'CategoryID'),
        'KEY' => array('Non_unique' => '1', 'Column_name' => 'ParentID'),
    );

    public function save(){
        $this->set('expires', date('Y-m-d H:i:s', time() + self::iExpiresLiveTime));
        return parent::save();
    }

    protected function getChildCategoriesRequest () {
        return array(
            'ACTION' => 'GetChildCategories',
            'DATA' => array( 'ParentID' => $this->get('categoryid'),)
        );
    }

    /**
     * By memory or time problem in loading child category check Hood cache solution in overriding function of Hood
     * @param bool $blForce - pulls and updates the data anyway
     * @return mixed
     * @throws Exception
     */
    public function getChildCategories($blForce = false) {
        $oChildModel = new $this;
        $oChildModel->set('parentid', $this->get('categoryid'));
        foreach ($this->getKeys(true) as $sKey ) {
            if (
                $sKey !== 'categoryid' //setted as parentid
                && !isset($oChildModel->aData[$sKey])
            ) {
                $oChildModel->set($sKey, $this->get($sKey));
            }
        }

        $oChildList = $oChildModel->getList();
        $oChildList->getQueryObject()->orderBy('CategoryName');

        if ($blForce || $oChildList->getCountTotal() == 0) {
            try {
                $aRequest = $this->getChildCategoriesRequest();
                $aResponse = MagnaConnector::gi()->submitRequest($aRequest);
                if (
                    isset($aResponse['STATUS']) && $aResponse['STATUS'] == 'SUCCESS'
                    && isset($aResponse['DATA']) && is_array($aResponse['DATA']) && count($aResponse['DATA']) > 0
                ) {
					// Workaround when returned category id is the same as parent category id
                    foreach ($aResponse['DATA'] as $iChildCat => $aChildCat) {
                        if (isset($aChildCat['CategoryID']) && $this->compareCategoryIds($aChildCat['CategoryID'], $this->get('categoryid'))) {
                            foreach ($aChildCat as $sKey => $sValue) {
                                $this->set($sKey, $sValue);
                            }

                            $this->save();
                            unset($aResponse['DATA'][$iChildCat]);
                        }
                    }
                    if (count($aResponse['DATA']) > 0) {
                        foreach ($aResponse['DATA'] as $aChildCat) {
                            $oChildList->add($aChildCat);
                        }

                        $oChildList->save();
                        return $this->getChildCategories();
                    }
                }
                return $oChildList; // no categories
            } catch (MagnaException $oEx) {
				MLMessage::gi()->addDebug($oEx);
				throw new Exception();
            }
        } else {
            return $oChildList;
        }
    }

    public function getCategoryPath() {
        $blForce = false;
        $aParents = array();
        if (!$this->exists()) {
            $this->blLoaded = null;
            $blForce = true;
            $this->getChildCategories(true);
        }

        if ($this->get('categoryid') != '0' && $this->exists()) {
            $this->blLoaded = null;
            $oParent = clone $this;
            $aParents[] = $oParent;
            $blWhile = true;
            while($blWhile) {
                $iParentId = $oParent->get('parentid') !== null ? $oParent->get('parentid') : 0;
                $oParent = new $oParent;
                $oParent->init(true)->set('categoryid', $iParentId);
                if (!$oParent->exists() || $blForce) {
                    $oParent->blLoaded = null;
                    $blForce = true;
                    $oParent->getChildCategories(true);
                }
                if ($iParentId == '0') {
                    $blWhile = false;
                } else {
                    $aParents[] = $oParent;
                }
            }
        }

        return $aParents;
    }

    /**
     *@return string root >kategorie > till > current
     * */
    public function getClickPath($separator = ' > ') {
        foreach ($this->getCategoryPath() as $oParentCat) {
            $aTitles[] = $oParentCat->get('categoryname');
        }

        if (isset($aTitles)) {
            $aTitles = array_reverse($aTitles);
            return implode($separator, $aTitles).(count($aTitles) == 0 ? '' : $separator);
        }

        return '';
    }

    /**
     * different marketplaces could have different type of category id (numeric or character), so in some marketplaces this comparison could be overwritten
     * @param mixed $mId1
     * @param mixed $mId2
     * @return boolean
     */
    protected function compareCategoryIds($mId1, $mId2) {
        return $mId1 == $mId2;
    }

    public function emptyTheTable() {
        MLDatabase::getDbInstance()->query('TRUNCATE '.$this->sTableName);
    }
}
