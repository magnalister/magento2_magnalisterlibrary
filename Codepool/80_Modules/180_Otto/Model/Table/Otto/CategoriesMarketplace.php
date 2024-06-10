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

MLFilesystem::gi()->loadClass('Modul_Model_Table_Categories_Abstract');

class ML_Otto_Model_Table_Otto_CategoriesMarketplace extends ML_Modul_Model_Table_Categories_Abstract {

    protected $sTableName = 'magnalister_otto_categories_marketplace';

    protected $aFields = array(
        'CategoryID' => array(
            'isKey' => true,
            'Type' => 'varchar(50)', 'Null' => 'NO', 'Default' => 0, 'Extra' => '', 'Comment' => ''
        ),
        'CategoryName' => array(
            'Type' => 'varchar(128)', 'Null' => 'NO', 'Default' => '', 'Extra' => '', 'Comment' => ''
        ),
        'ParentID' => array(
            'Type' => 'varchar(50)', 'Null' => 'NO', 'Default' => 0, 'Extra' => '', 'Comment' => ''
        ),
        'LeafCategory' => array(
            'Type' => 'tinyint(4)', 'Null' => 'NO', 'Default' => 1, 'Extra' => '', 'Comment' => ''
        ),
        'ImportOrUpdateTime' => array(
            'Type' => 'datetime', 'Null' => self::IS_NULLABLE_YES, 'Default' => NULL, 'Extra' => '', 'Comment' => ''
        ),
    );

    protected function setDefaultValues() {
    }

    protected function getChildCategoriesRequest () {

    }

    public function getCategoryPath() {
        $aParents = array();

        if ($this->exists() && $this->get('CategoryID') !== '0') {
            $oParent = clone $this;
            $iParentId = $oParent->get('ParentID');
            $aParents[] = $oParent->init(true)->set('CategoryID', $iParentId);
        }

        return $aParents;
    }
}
