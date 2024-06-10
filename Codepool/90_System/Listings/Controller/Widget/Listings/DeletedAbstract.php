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

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

abstract class ML_Listings_Controller_Widget_Listings_DeletedAbstract extends ML_Core_Controller_Abstract {

    protected $marketplace = '';
    protected $aSetting = array();
    protected $aPostGet = array();
    private $sort = array();
    protected $sCurrency = '';
    private $numberofitems = 0;
    protected $aData = array();
    protected $iOffset = 0;
    
    public function __construct() {
        parent::__construct();
        $this->aPostGet = MLRequest::gi()->data();
        $this->marketplace = MLModule::gi()->getMarketPlaceName();
        $aConfig = MLModule::gi()->getConfig();
        $this->aSetting['maxTitleChars'] = 40;
        $this->aSetting['itemLimit'] = 50;
        $this->aSetting['language'] = $aConfig['lang'];
        $this->sCurrency = $aConfig['currency'];   
    }

    public function initAction(){
        /* Delete Log */
        if (
                isset($this->aPostGet['action']) && $this->aPostGet['action'] == 'delete' && isset($this->aPostGet['delIDs']) && !empty($this->aPostGet['delIDs']) && is_array($this->aPostGet['delIDs'])
        ) {
            foreach ($this->aPostGet['delIDs'] as $id) {
                $ids[] = (int) $id;
            }
            $ids = array_unique($ids);
            MLDatabase::getDbInstance()->query("
						DELETE FROM `magnalister_listings_deleted`
						 WHERE id IN ('" . implode("', '", $ids) . "')
					");
        }
        $this->getSortOpt();
    }
    
    public function prepareData() {
        $oSelect = MLDatabase::factorySelectClass();
		$oSelect->from('magnalister_listings_deleted');
        $oSelect->where('mpID = ' . MLModule::gi()->getMarketPlaceId());
		
        $this->numberofitems = (int) $oSelect->getCount();
        $this->pages = ceil($this->numberofitems / $this->aSetting['itemLimit']);
        $this->currentPage = 1;

        if (isset($this->aPostGet['page']) && ctype_digit($this->aPostGet['page']) && (1 <= (int) $this->aPostGet['page']) && ((int) $this->aPostGet['page'] <= $this->pages)) {
            $this->currentPage = (int) $this->aPostGet['page'];
        }

        $this->iOffset = ($this->currentPage - 1) * $this->aSetting['itemLimit'];
        $this->aData = $oSelect
                ->limit($this->iOffset, $this->aSetting['itemLimit'])
                ->orderBy(" {$this->sort['order']} {$this->sort['type']} ")
                ->getResult()
        ;
        foreach ($this->aData as &$aRow) {
            $aRow['categorypath'] = '';
            $oProduct = MLProduct::factory()->getByMarketplaceSKU($aRow['productsSku']);
            if ($oProduct->exists()) {
                $aRow['categorypath'] = $oProduct->getCategoryPath();
                $aRow['title'] = $oProduct->getName();
            }
        }
    }

    protected function getSortOpt() {
        $sorting = isset($this->aPostGet['sorting']) ? $this->aPostGet['sorting'] : '';
        switch ($sorting) {
            case 'title-asc':
                $this->sort['order'] = 'productsSku';
                $this->sort['type'] = 'ASC';
                break;
            case 'title-desc':
                $this->sort['order'] = 'productsSku';
                $this->sort['type'] = 'DESC';
                break;
            case 'timestamp-asc':
                $this->sort['order'] = 'timestamp';
                $this->sort['type'] = 'ASC';
                break;
            case 'timestamp-desc':
            default:
                $this->sort['order'] = 'timestamp';
                $this->sort['type'] = 'DESC';
                break;
        }
    }

    abstract public static function getTabTitle();

    public function getFields() {
        return array(
            'Title' => array(
                'Label' => ML_LABEL_SHOP_TITLE,
                'Sorter' => 'title',
                'Field' => null,
            ),
            'Category' => array(
                'Label' => ML_LABEL_CATEGORY_PATH,
                'Sorter' => null,
                'Field' => 'Category'
            ),
            'Price' => array(
                'Label' => ML_GENERIC_OLD_PRICE,
                'Sorter' => null,
                'Field' => null
            ),
            'timestamp' => array(
                'Label' => ML_GENERIC_DELETEDDATE,
                'Sorter' => 'timestamp',
                'Field' => null
            ),
        );
    }

    /**
     * Returns the Marketplace Title
     *
     * @return mixed|string
     */
    public function getShopTitle() {
        try {
            $aModules = MLSetting::gi()->get('aModules');
            if (isset($aModules[$this->marketplace]['title'])) {
                $title = $aModules[$this->marketplace]['title'];
            } elseif (!isset($aModules[$this->marketplace]['settings']['subsystem'])) {
                throw new Exception;
            } else {
                $title = $aModules[$this->marketplace]['settings']['subsystem'];
            }
            return $title;
        } catch (Exception $exc) {
            return $this->marketplace;
        }
    }

    public function getData(){
        return $this->aData;
    }

    public function getNumberOfItems(){
        return $this->numberofitems;
    }

    public function getOffset(){
        return $this->iOffset;
    }
    
    protected function isSearchable() {
        return false;
    }

    protected function getCurrentPage() {
        return $this->currentPage;
    }

    protected function getTotalPage() {/** @todo calculate total page */
        return $this->pages;
    }

    public function getEmptyDataLabel() {
        return 'ML_GENERIC_NO_DELETED_ITEMS_YET';
    }

}
