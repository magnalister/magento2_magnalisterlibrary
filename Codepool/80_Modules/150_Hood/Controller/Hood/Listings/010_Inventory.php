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

MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_InventoryAbstract');

class ML_Hood_Controller_Hood_Listings_Inventory extends ML_Listings_Controller_Widget_Listings_InventoryAbstract {

    protected $pendingItems = array();
    protected $aParameters = array('controller');
    protected $priceBrutto;
    protected $blHasDeleteTable = false;
    protected $sDeleteKey = 'AuctionId';

    public function __construct() {
        parent::__construct();
        $this->aSetting['maxTitleChars'] = 85;
        $this->priceBrutto = !(defined('PRICE_IS_BRUTTO') && (PRICE_IS_BRUTTO == 'false'));
    }

    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_GENERIC_INVENTORY');
    }

    protected function getFields() {
        $oI18n = MLI18n::gi();
        return array(
            'SKU' => array(
                'Label' => $oI18n->ML_LABEL_SKU,
                'Sorter' => 'sku',
                'Getter' => 'getSKU',
                'Field' => null,
            ),
            'Title' => array(
                'Label' => $oI18n->ML_LABEL_SHOP_TITLE,
                'Sorter' => null,
                'Getter' => 'getItemShopTitle',
                'Field' => null,
            ),
            'MarketplaceTitle' => array(
                'Label' => $oI18n->ML_LABEL_HOOD_TITLE,
                'Sorter' => 'itemtitle',
                'Getter' => 'getItemHoodTitle',
                'Field' => null,
            ),
            'HoodId' => array(
                'Label' => $oI18n->ML_LABEL_HOOD_ITEM_ID,
                'Sorter' => null,
                'Getter' => 'getHoodLink',
                'Field' => null,
            ),
            'ListingType' => array(
                'Label' => $oI18n->ML_HOOD_LISTINGTYPE,
                'Sorter' => null,
                'Getter' => 'getListingType',
                'Field' => null,
            ),
            'Price' => array(
                'Label' => ($this->priceBrutto ? $this->__('ML_LABEL_SHOP_PRICE_BRUTTO') : $this->__('ML_LABEL_SHOP_PRICE_NETTO')).' / Hood ',
                'Sorter' => 'price',
                'Getter' => 'getItemPrice',
                'Field' => null,
            ),
            'Quantity' => array(
                'Label' => $this->__('ML_STOCK_SHOP_STOCK_HOOD').'<br />'.$this->__('ML_LAST_SYNC'),
                'Sorter' => null,
                'Getter' => 'getQuantities',
                'Field' => null,
            ),
            'DateAdded' => array(
                'Label' => $oI18n->ML_LABEL_HOOD_LISTINGTIME,
                'Sorter' => 'dateadded',
                'Getter' => 'getItemDateAdded',
                'Field' => null,
            ),

        );
    }

    protected function getAuctionId($item) {
        $html = '<td>'.$item['AuctionId'].'</td>';
        if (!empty($item['editUrl'])) {
            $html = '<td><div class="product-link" ><a class="ml-js-noBlockUi" href="'.$item['editUrl'].'" target="_blank" title="'.MLI18n::gi()->ML_LABEL_EDIT.'">'.$item['AuctionId'].'</a></div></td>';
        }

        return $html;
    }

    public function initAction() {
        if (isset($this->aPostGet['SKUs']) && is_array($this->aPostGet['SKUs'])
            && isset($this->aPostGet['action']) && $this->aPostGet['action'] == 'delete'
        ) {
            $_SESSION['POST_TS'] = $this->aPostGet['timestamp'];

            $aInsertData = array();
            $aDeleteItemsData = array();

            foreach ($this->aPostGet['SKUs'] as $sSku) {
                $oProduct = MLProduct::factory()->getByMarketplaceSKU($sSku);

                $aDetails = unserialize(str_replace('\\"', '"', $this->aPostGet['details'][$sSku]));
                $iProductId = $sProductSku = '';
                if ($oProduct->exists()) {
                    $iProductId = $oProduct->get('MarketplaceIdentId');
                    $sProductSku = $oProduct->get('MarketplaceIdentSku');
                } else {
                    $sProductSku = $sSku;
                }

                $aInsertData[] = array(
                    'mpID' => $this->iMpId,
                    'productsId' => $iProductId,
                    'productsSku' => $sProductSku,
                    'price' => $aDetails['Price'],
                    'timestamp' => date('Y-m-d H:i:s')
                );

                $aDeleteItemsData[] = array(
                    $this->sDeleteKey => $sSku,
                );
            }

            try {
                $result = MagnaConnector::gi()->submitRequest(array(
                    'ACTION' => 'DeleteItems',
                    'DATA' => $aDeleteItemsData,
                    'UPLOAD' => true,
                ));
                /** @todo create helper if need  call_user_func(ucfirst($this->marketplace) . 'Helper::processCheckinErrors', $result, $this->iMpId); */
            } catch (MagnaException $e) {
                $result = array(
                    'STATUS' => 'ERROR'
                );
            }

            if ($result['STATUS'] == 'SUCCESS') {
                if ($this->blHasDeleteTable) {
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

    protected function getListingType($item) {
        $aStatusI18n = MLI18n::gi()->get('Hood_listings_status');
        if ($item['ListingType'] == 'classic') {
            $result = MLI18n::gi()->ML_HOOD_LISTINGTYPE_CHINESE;
        } elseif ($item['ListingType'] == 'buyItNow') {
            $result = MLI18n::gi()->ML_HOOD_LISTINGTYPE_FIXEDPRICEITEM;
        } else {
            $result = MLI18n::gi()->ML_HOOD_LISTINGTYPE_STORESFIXEDPRICE;
        }
        return '<td>'.$result.'</td>';
    }

    protected function getHoodLink($item) {
        $addStyle = (empty($item['ShopTitle']) || $item['ShopTitle'] === '&mdash;') ? 'style="color:#e31e1c;"' : '';
        return '<td><a '. $addStyle .' class="ml-js-noBlockUi" href="http://www.hood.de/'.sprintf('%010d', $item['AuctionId']).'.htm" target="_blank">'.$item['AuctionId'].'</a></td>';
    }

    protected function getItemDateAdded($item) {
        return '<td>'.date("d.m.Y", $item['StartTime']).' &nbsp;&nbsp;<span class="small">'.date("H:i", $item['StartTime']).'</span><br />'.('&mdash;' == $item['EndTime'] ? '&mdash;' : date("d.m.Y", $item['EndTime']).' &nbsp;&nbsp;<span class="small">'.date("H:i", $item['EndTime']).'</span>').'</td>';
    }

    public function prepareData() {
        $result = $this->getInventory();
        if (($result !== false) && !empty($result['DATA'])) {
            $this->aData = $result['DATA'];
            foreach ($this->aData as &$item) {
                $item['AuctionId'] = html_entity_decode(fixHTMLUTF8Entities($item['AuctionId']));
                if (isset($item['VariationAttributesText'])) {
                    $item['VariationAttributesText'] = fixHTMLUTF8Entities($item['VariationAttributesText']);
                } else {
                    $item['VariationAttributesText'] = "";
                }

                $item['StartTime'] = strtotime($item['StartTime']);
                $item['EndTime'] = ('1' == $item['ListingDuration'] ? '&mdash;' : strtotime($item['EndTime']));
                $item['LastSync'] = strtotime($item['LastSync']);

                $oProduct = MLProduct::factory();
                try {
                    /* @var $oProduct ML_Shop_Model_Product_Abstract */
                    if (!$oProduct->getByMarketplaceSKU($item['SKU'])->exists()
                        && !$oProduct->getByMarketplaceSKU($item['SKU'], true)->exists()
                    ) {
                        throw new Exception;
                    }

                    $item['ProductsID'] = $oProduct->get('productsid');
                    $item['ShopQuantity'] = $oProduct->getStock();
                    $item['ShopPrice'] = $oProduct->getShopPrice();
                    $item['ShopTitle'] = $oProduct->getName();
                    $item['ShopVarText'] = $oProduct->getName();
                    $item['editUrl'] = $oProduct->getEditLink();
                    $item['Currency'] = MLModul::gi()->getConfig('currency');
                } catch (Exception $oExc) {
                    $item['ShopQuantity'] = $item['ShopPrice'] = $item['ShopTitle'] = '&mdash;';
                    $item['ShopVarText'] = '&nbsp;';
                    $item['ProductsID'] = 0;
                    $item['editUrl'] = '';
                    $item['ShopPrice'] = '&mdash;';
                    MLMessage::gi()->addDebug($oExc);
                }
            }

            unset($result);
        }
    }

    protected function getItemPrice($item) {
        $sCurrency = MLModul::gi()->getConfig('currency');
        $renderedShopPrice = (isset($item['ShopPrice']) && 0 != $item['ShopPrice']) ? MLPrice::factory()->format($item['ShopPrice'], $sCurrency) : '&mdash;';
        return '<td>'.$renderedShopPrice.' / '.(isset($item['Price']) && 0 != $item['Price'] ? MLPrice::factory()->format($item['Price'], $sCurrency) : '&mdash;').'</td>';
    }

    protected function getItemShopTitle($item) {
        return '<td>'.$item['ShopTitle'].'<br /><span class="small">'.$item['ShopVarText'].'</span></td>';
    }

    protected function getItemHoodTitle($item) {

        return '<td>'.$item['Title'].'<br /><span class="small">'.$item['Title'].'</span></td>';
    }

    protected function getQuantities($item) {
        return '<td>'.$item['ShopQuantity'].' / '.$item['Quantity'].'<br />'.date("d.m.Y", $item['LastSync']).' &nbsp;&nbsp;<span class="small">'.date("H:i", $item['LastSync']).'</span></td>';
    }

    protected function getSKU($item) {
        $html = '<td>'.$item['SKU'].'</td>';
        if (!empty($item['editUrl'])) {
            $html = '<td><div class="product-link" ><a class="ml-js-noBlockUi" href="'.$item['editUrl'].'" target="_blank" title="'.MLI18n::gi()->ML_LABEL_EDIT.'">'.$item['SKU'].'</a></div></td>';
        }

        return $html;
    }

    protected function getSynchMessage() {
        if (!empty($this->pendingItems)) {
            foreach ($this->pendingItems as $sKye => $aPendingItems) {
                if (!empty($aPendingItems['itemsCount'])) {
                    $this->sSynchMessages .= '<p class="successBoxBlue"> '.$this->__('ML_HOOD_N_PENDING_UPDATES_TITLE_'.strtoupper($sKye))." "
                        .' '.sprintf(ML_HOOD_N_PENDING_UPDATES_ESTIMATED_TIME_M, $aPendingItems['itemsCount'], $aPendingItems['estimatedWaitingTime'])
                        .'</p>';
                }
            }
        }

        if (!empty($this->pendingItems) && !empty($this->pendingItems['itemsCount'])) {
            $this->sSynchMessages .= '<p class="successBoxBlue">'
                .sprintf($this->__('ML_HOOD_N_PENDING_UPDATES_ESTIMATED_TIME_M'), $this->pendingItems['itemsCount'], $this->pendingItems['estimatedWaitingTime'])
                .'</p>';
        }
        return parent::getSynchMessage();
    }

    public function render() {
        $this->includeView('widget_listings_inventory');
        return $this;
    }

    protected function getPendingFunction($sRequest = 'Items') {
        try {
            $result = MagnaConnector::gi()->submitRequest(array(
                'ACTION' => 'GetPending'.$sRequest,
            ));
        } catch (MagnaException $e) {
            $result = array('DATA' => false);
        }
        $waitingItems = 0;
        $maxEstimatedTime = 0;
        if (is_array($result['DATA']) && !empty($result['DATA'])) {
            foreach ($result['DATA'] as $item) {
                $maxEstimatedTime = max($maxEstimatedTime, $item['EstimatedWaitingTime']);
                $waitingItems += 1;
            }
        }
        $this->pendingItems[$sRequest] = array(
            'itemsCount' => $waitingItems,
            'estimatedWaitingTime' => $maxEstimatedTime
        );
    }

}
