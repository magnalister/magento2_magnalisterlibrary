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

/**
 * select all products
 * amazon-config:
 *  - amazon.lang isset
 * magnalister.selectionname == 'match
 */
class ML_GoogleShopping_Model_ProductList_GoogleShopping_Prepare_Match_Auto extends ML_Productlist_Model_ProductList_Abstract {
    protected $aList = null;
    protected $iCountTotal = 0;
    protected $iCountPerPage = 20;
    protected $aMixedData = array();
    protected $iOffset = 0;

    public function additionalRows(ML_Shop_Model_Product_Abstract $oProduct) {
        return array();
    }

    public function getFilters() {
        return array();
    }

    public function getHead() {
        return array();
    }

    public function getList() {
        if ($this->aList === null) {
            $this->aList = array();
            $sSql = "
                SELECT %s
                  FROM magnalister_selection s,
                       magnalister_products p
                 WHERE     s.pID = p.ID
                       AND s.session_id = '".MLShop::gi()->getSessionId()."'
                       AND s.selectionname = 'match'
                       AND mpid = '" . MLModule::gi()->getMarketPlaceId() . "'
            ";
            $this->iCountTotal = MLDatabase::getDbInstance()->fetchOne(sprintf($sSql, ' count(distinct p.ParentId) '));
            foreach (MLDatabase::getDbInstance()->fetchArray(sprintf($sSql, ' distinct p.ParentId ')." limit ".$this->iOffset.", ".$this->iCountPerPage) as $aRow) {
                $this->aList[$aRow['ParentId']] = MLProduct::factory()->set("id", $aRow['ParentId'])->load();
            }
        }
        return new ArrayIterator($this->aList);
    }

    public function setLimit($iFrom, $iCount) {
        $this->iOffset = $iFrom;
        $this->iCountPerPage = $iCount;
        return $this;
    }

    public function getMasterIds($blPage = false) {
        $this->getList();
        return array_keys($this->aList);
    }

    public function getStatistic() {
        $this->getList();
        $aOut = array(
            'blPagination' => false,
            'iCountPerPage' => $this->iCountPerPage,
            'iCurrentPage' => 0,
            'iCountTotal' => $this->iCountTotal,
            'aOrder' => array(
                'name' => '',
                'direction' => ''
            )
        );
        return $aOut;
    }

    public function setFilters($aFilter) {
        if (is_array($aFilter) && isset($aFilter['iOffset'])) {
            $this->iOffset = (int) $aFilter['iOffset'];
        }
        return $this;
    }

    public function getMixedData(ML_Shop_Model_Product_Abstract $oProduct, $sKey) {
        return $oProduct->getModulField($sKey, substr($sKey, 0, strpos($sKey, '.')) == 'general');
    }

    public function variantInList(ML_Shop_Model_Product_Abstract $oProduct) {
        return (
               MLDatabase::factory('selection')->loadByProduct($oProduct, 'match')->get('expires') === null
            || !$this->getMixedData($oProduct, 'general.ean')
        ) ? false : true;
    }
}
