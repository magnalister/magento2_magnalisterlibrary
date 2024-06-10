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

MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_ListingAbstract');

abstract class ML_Listings_Controller_Widget_Listings_InventoryAbstract extends ML_Listings_Controller_Widget_Listings_ListingAbstract {
    
    protected $sSynchMessages = '';
    protected $blHasDeleteTable = true;
    protected $marketplace = '';
    protected $aPostGet = array();
    protected $aSetting = array();
    protected $iMpId = 0;
    protected $aSort = array(
        'type' => null,
        'order' => null
    );
    protected $iOffset = 0;
    protected $aData = array();
    protected $iNumberofitems = 0;
    protected $search = '';
    protected $sCurrency = '';
    protected $sDeleteKey = 'SKU';
    protected $saveDeletedLocally = true;
    protected $additionalParameters = array();

    public function __construct() {
        parent::__construct();
        $this->setCurrentState();
        $this->aPostGet = $this->getRequest();
        $this->marketplace = MLModule::gi()->getMarketPlaceName();
        $this->iMpId = MLModule::gi()->getMarketPlaceId();
        $aConfig = MLModule::gi()->getConfig();
        $this->aSetting['maxTitleChars'] = 40;
        if(MLSetting::gi()->iInventoryViewProductLimit !== null){
            $this->aSetting['itemLimit'] = MLSetting::gi()->iInventoryViewProductLimit;
        } else {
            $this->aSetting['itemLimit'] = 50;
        }
        
        $this->aSetting['language'] = $aConfig['lang'];
        $this->sCurrency = $aConfig['currency'];


        if (array_key_exists('tfSearch', $this->aPostGet) && !empty($this->aPostGet['tfSearch'])) {
            $this->search = $this->aPostGet['tfSearch'];
        }
        /** @todo        if (isset($this->aPostGet['refreshStock'])) {
         * $classFile = DIR_MAGNALISTER_MODULES . strtolower($this->marketplace) . '/crons/' . ucfirst($this->marketplace) . 'SyncInventory.php';
         * if (file_exists($classFile)) {
         * require_once($classFile);
         * $className = ucfirst($this->marketplace) . 'SyncInventory';
         * if (class_exists($className)) {
         * @set_time_limit(60 * 10);
         * $ic = new $className($this->iMpId, $this->marketplace);
         * $ic->process();
         * }
         * }
         * } */
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

    public function getUrlParams() {
        return $this->aPostGet;
    }

    public function prepareData() {
        $result = $this->getInventory();
        if (($result !== false) && !empty($result['DATA'])) {
            $this->aData = $result['DATA'];
            foreach ($this->aData as &$item) {
                $sTitle = isset($item['Title']) ? $item['Title'] : (isset($item['ItemTitle']) ? $item['ItemTitle'] : '');
                $item['Title'] = $sTitle;
                $item['TitleShort'] = (strlen($sTitle) > $this->aSetting['maxTitleChars'] + 2) ?
                    (fixHTMLUTF8Entities(substr($sTitle, 0, $this->aSetting['maxTitleChars'])).'&hellip;') :
                    fixHTMLUTF8Entities($sTitle);
                $item['DateAdded'] = ((isset($item['DateAdded'])) ? strtotime($item['DateAdded']) : '');
                $oProduct = MLProduct::factory()->getByMarketplaceSKU($item['SKU']);
                $item['ShopQuantity'] = $oProduct->exists() ? $oProduct->getStock() : '&mdash;';
                $sShopPrice = '&mdash;';
                try {
                    if ($oProduct->exists()) {
                        $sShopPrice = $oProduct->getShopPrice();
                    }
                } catch (Exception $e) {
                    $sShopPrice = '&mdash;';
                    MLMessage::gi()->addDebug($e);
                }
                $item['ShopPrice'] = $sShopPrice;
                $item['editUrl'] = $oProduct->exists() ? $oProduct->getEditLink() : '';
                $item['ShopTitle'] = $oProduct->exists() ? $oProduct->getName() : '';
            }
            unset($result);
        }
    }

    protected function getInventory() {
        try {
            $request = $this->manipulateInventoryRequest(array(
                'ACTION' => 'GetInventory',
                'LIMIT' => $this->aSetting['itemLimit'],
                'OFFSET' => $this->iOffset,
                'ORDERBY' => $this->aSort['order'],
                'SORTORDER' => $this->aSort['type']
            ));
            $request = array_merge($request, $this->additionalParameters);
            if (!empty($this->search)) {
                $request['SEARCH'] = $this->search;
            }
            $result = MagnaConnector::gi()->submitRequest($request);            
            $this->iNumberofitems = (int)$result['NUMBEROFLISTINGS'];
            return $result;
        } catch (MagnaException $e) {
            return false;
        }
    }
    
    protected function manipulateInventoryRequest($request){
        return $request;
    }
    
    protected function addShopData($aData){
        return $aData;
    }


    public function initAction() {
        if (   isset($this->aPostGet['SKUs']) && is_array($this->aPostGet['SKUs'])
            && isset($this->aPostGet['action']) && $this->aPostGet['action'] == 'delete'
        ) {
            $_SESSION['POST_TS'] = $this->aPostGet['timestamp'];

            $aInsertData = array();
            $aDeleteItemsData = array();
            foreach ($this->aPostGet['SKUs'] as $sSku) {
                $oProduct = MLProduct::factory()->getByMarketplaceSKU($sSku);

                $iProductId = $sProductSku = '';
                if ($oProduct->exists()) {
                    $iProductId = $oProduct->get('MarketplaceIdentId');
                    $sProductSku = $oProduct->get('MarketplaceIdentSku');
                } else {
                    $sProductSku = $sSku;
                }

                if (isset($this->aPostGet['details'])) {
                    $aDetails = unserialize(str_replace('\\"', '"', $this->aPostGet['details'][$sSku]));
                }
                $aInsertData[] = array(
                    'mpID'        => $this->iMpId,
                    'productsId'  => $iProductId,
                    'productsSku' => $sProductSku,
                    'price'       => isset($aDetails['Price']) ? $aDetails['Price'] : '',
                    'timestamp'   => date('Y-m-d H:i:s')
                );

                $aDeleteItemsData[] = array(
                    $this->sDeleteKey => $sSku,
                );
            }

            try {
                $result = MagnaConnector::gi()->submitRequest(array(
                    'ACTION' => 'DeleteItems',
                    'DATA' => $aDeleteItemsData
                ));
                /** @todo create helper if need  call_user_func(ucfirst($this->marketplace) . 'Helper::processCheckinErrors', $result, $this->iMpId); */
            } catch (MagnaException $e) {
                $result = array(
                    'STATUS' => 'ERROR'
                );
            }

            if ($this->saveDeletedLocally && $result['STATUS'] == 'SUCCESS') {
                if($this->blHasDeleteTable){
                    $oDb = MLDatabase::getDbInstance();
                    if ($oDb->batchinsert(
                            'magnalister_listings_deleted', $aInsertData
                        ) != true
                    ) {
                        MLMessage::gi()->addWarn($oDb->getLastError());
                    }
                }
                $this->postDelete();
            }
        }

        $this->getSortOpt();

        if (isset($this->aPostGet['page']) && ctype_digit($this->aPostGet['page'])) {
            $this->iOffset = ($this->aPostGet['page'] - 1) * $this->aSetting['itemLimit'];
        } else {
            $this->iOffset = 0;
        }
    }

    protected function postDelete() { /* Nix :-) */
    }

    protected function isSearchable() {
        return true;
    }

    abstract public static function getTabTitle();

    protected function getFields() {
        return array(
            'SKU' => array(
                'Label' => MLI18n::gi()->ML_LABEL_SKU,
                'Sorter' => 'sku',
                'Getter' => 'getSku',
                'Field' => null
            ),
            'ItemID' => array(
                'Label' => MLI18n::gi()->ML_MAGNACOMPAT_LABEL_MP_ITEMID,
                'Sorter' => 'itemid',
                'Getter' => null,
                'Field' => 'ItemID',
            ),
            'Title' => array(
                'Label' => MLModule::gi()->getMarketPlaceName(false) . '&nbsp;' . MLI18n::gi()->ML_LABEL_TITLE,
                'Sorter' => null,
                'Getter' => 'getTitle',
                'Field' => null,
            ),
            'ShopTitle' => array(
                'Label' => MLI18n::gi()->ML_LABEL_SHOP_TITLE,
                'Sorter' => null,
                'Getter' => 'getShopProductName',
                'Field' => null,
            ),
            'Price' => array(
                'Label' => MLI18n::gi()->ML_LABEL_SHOP_PRICE.' / '.MLModule::gi()->getMarketPlaceName(false).' '.MLI18n::gi()->ML_GENERIC_PRICE,
                'Sorter' => 'price',
                'Getter' => 'getItemPrice',
                'Field' => null
            ),
            'Quantity' => array(
                'Label' => 'Shop-' . MLI18n::gi()->ML_LABEL_QUANTITY . ' / ' . MLModule::gi()->getMarketPlaceName(false),
                'Sorter' => 'quantity',
                'Getter' => 'getQuantities',
                'Field' => null,
            ),
            'DateAdded' => array(
                'Label' => MLI18n::gi()->ML_GENERIC_CHECKINDATE,
                'Sorter' => 'dateadded',
                'Getter' => 'getItemDateAdded',
                'Field' => null
            ),
        );
    }

    protected function getSortOpt() {
        if (isset($this->aPostGet['sorting'])) {
            $sorting = $this->aPostGet['sorting'];
        } else {
            $sorting = 'blabla'; // fallback for default
        }
        $sortFlags = $this->manipulateSortParameter(array(
            'sku' => 'SKU',
            'meinpaketid' => 'MeinpaketID',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'dateadded' => 'DateAdded',
            'starttime' => 'StartTime'
        ));
        $order = 'ASC';
        if (strpos($sorting, '-asc') !== false) {
            $sorting = str_replace('-asc', '', $sorting);
        } else if (strpos($sorting, '-desc') !== false) {
            $order = 'DESC';
            $sorting = str_replace('-desc', '', $sorting);
        }

        if (array_key_exists($sorting, $sortFlags)) {
            $this->aSort['order'] = $sortFlags[$sorting];
            $this->aSort['type'] = $order;
        } else {
            $this->aSort['order'] = 'DateAdded';
            $this->aSort['type'] = 'DESC';
        }
    }
    
    protected function manipulateSortParameter($aSort){
        return $aSort;
    }
    
    public function getEmptyDataLabel() {
        return (empty($this->search) ? ML_GENERIC_NO_INVENTORY : ML_LABEL_NO_SEARCH_RESULTS);
    }

    protected function getCurrentPage() {
        if (isset($this->aPostGet['page']) && (1 <= (int)$this->aPostGet['page']) && ((int)$this->aPostGet['page'] <= $this->getTotalPage())) {
            return (int)$this->aPostGet['page'];
        }

        return 1;
    }

    protected function getTotalPage() {
        return ceil($this->iNumberofitems / $this->aSetting['itemLimit']);
    }

    public function getData() {
        return $this->aData;
    }


    public function getNumberOfItems() {
        return $this->iNumberofitems;
    }

    public function getOffset() {
        return $this->iOffset;
    }

    protected function getTitle($item) {
        return '<td title="'.fixHTMLUTF8Entities((isset($item['Title'])?$item['Title']:''), ENT_COMPAT).'">'.$item['TitleShort'].'</td>';
    }
    
    protected function getShopProductName($item){        
        return '<td title="'.fixHTMLUTF8Entities($item['ShopTitle'], ENT_COMPAT).'">'.$item['ShopTitle'].'</td>';
    }


    protected function getItemPrice($item) {
        $item['Currency'] = isset($item['Currency']) && $item['Currency'] != '' ? $item['Currency'] : $this->sCurrency;
        $renderedShopPrice = (!empty($item['ShopPrice']) && $item['ShopPrice'] !== '&mdash;') ? MLPrice::factory()->format($item['ShopPrice'], $item['Currency'], false) : '&mdash;';
        return '<td>' . $renderedShopPrice . ' / ' . ( !empty($item['Price']) ? MLPrice::factory()->format($item['Price'], $item['Currency'], false) : '&mdash;') . '</td>';
    }

    protected function getItemDateAdded($item) {
        return '<td>'.date("d.m.Y", $item['DateAdded']).' &nbsp;&nbsp;<span class="small">'.date("H:i", $item['DateAdded']).'</span>'.'</td>';
    }
    
    protected function getIcon($item){
        return '';
    }
    
    protected function getSynchMessage(){
        return $this->sSynchMessages;
    }
    
    protected function getQuantities($item) {
        return '<td>'.$item['ShopQuantity'].' / '.$item['Quantity'].'</td>';
    }
    
    protected function getSKU($item) {
        $addStyle = (empty($item['TitleShort']) || $item['TitleShort'] === '&mdash;') ? 'color:#e31e1c;' : '';
        $html = '<td>' . $item['SKU'] . '</td>';
        if (!empty($item['editUrl'])) {
            $html = '<td><div class="product-link" ><a style="'. $addStyle .'" class="ml-js-noBlockUi" href="' . $item['editUrl'] . '" target="_blank" title="' . MLI18n::gi()->ML_LABEL_EDIT . '">' . $item['SKU'] . '</a></div></td>';
        }

        return $html;
    }

}
