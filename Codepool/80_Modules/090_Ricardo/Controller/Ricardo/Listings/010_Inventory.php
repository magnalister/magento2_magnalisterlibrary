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
 * $Id$
 *
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_InventoryAbstract');

class ML_Ricardo_Controller_Ricardo_Listings_Inventory extends ML_Listings_Controller_Widget_Listings_InventoryAbstract {
    protected $aParameters = array('controller');

    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_GENERIC_INVENTORY');
    }

    public static function getTabActive() {
        return MLModul::gi()->isConfigured();
    }

    /*
    public function prepareData() {
        $result = $this->getInventory();

        if (($result !== false) && !empty($result['DATA'])) {
            $this->aData = $result['DATA'];
            foreach ($this->aData as &$item) {
                $item['MarketplaceTitle'] = $item['Title'];

                $oProduct = MLProduct::factory()->getByMarketplaceSKU($item['SKU']);

                if ($oProduct->exists()) {
                    $item['Title'] = $oProduct->getName();
                } else {
                    $item['Title'] = '&mdash;';
                }

                if ($item['SKU'] === $item['ItemId']) {
                    $item['SKU'] = '&mdash;';
                }
            }
            unset($result);
        }
    }*/

    /**
     * Overridden method, because of asynchronous upload concept, here parameter EXTRA is added
     *
     * @return bool
     */
    protected function getInventory() {
        try {
            $request = array(
                'ACTION' => 'GetInventory',
                'LIMIT' => $this->aSetting['itemLimit'],
                'OFFSET' => $this->iOffset,
                'ORDERBY' => $this->aSort['order'],
                'SORTORDER' => $this->aSort['type'],
                'EXTRA' => 'ShowPending'
            );
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

    protected function getFields() {
        $oI18n = MLI18n::gi();
        return array(
            'SKU' => array(
                'Label' => $oI18n->ML_LABEL_SKU,
                'Sorter' => 'sku',
                'Getter' => null,
                'Field' => 'SKU'
            ),
            'Title' => array(
                'Label' => $oI18n->ML_LABEL_SHOP_TITLE,
                'Sorter' => null,
                'Getter' => null,
                'Field' => 'Title',
            ),
            'MarketplaceTitle' => array(
                'Label' => $oI18n->ricardo_inventory_listing_marketplaceTitle,
                'Sorter' => null,
                'Getter' => null,
                'Field' => 'MarketplaceTitle',
            ),
            'ItemId' => array(
                'Label' => $oI18n->ricardo_inventory_listing_itemId,
                'Sorter' => 'ItemId',
                'Getter' => 'getItemId',
                'Field' => null
            ),
            'Price' => array(
                'Label' => $oI18n->ML_LABEL_SHOP_PRICE.' / '.MLModule::gi()->getMarketPlaceName(false).' '.$oI18n->ML_GENERIC_PRICE,
                'Sorter' => 'price',
                'Getter' => 'getItemPrice',
                'Field' => null
            ),
            'Quantity' => array(
                'Label' => $oI18n->ML_LABEL_QUANTITY,
                'Sorter' => 'quantity',
                'Getter' => 'getQuantities',
                'Field' => null,
            ),
            'BidCount' => array(
                'Label' => $oI18n->ricardo_inventory_listing_bid_count,
                'Sorter' => null,
                'Getter' => 'getBidCount',
                'Field' => null,
            ),
            'LastSync' => array(
                'Label' => $oI18n->ML_LAST_SYNC,
                'Sorter' => null,
                'Getter' => 'getItemLastSyncTime',
                'Field' => null
            ),
            'StartEndDate' => array(
                'Label' => $oI18n->ML_LABEL_EBAY_LISTINGTIME,
                'Sorter' => 'startenddate',
                'Getter' => 'getStartEndDate',
                'Field' => null
            ),
            /*
            'Status' => array(
                'Label' => $oI18n->ricardo_inventory_listing_status,
                'Getter' => 'getStatus',
                'Field' => null
            ),*/
        );
    }

    protected function getSortOpt() {
        if (isset($this->aPostGet['sorting'])) {
            $sorting = $this->aPostGet['sorting'];
        } else {
            $sorting = 'blabla'; // fallback for default
        }
        //ToDo
        $sortFlags = array(
            'sku' => 'SKU',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'dateadded' => 'DateAdded',
            'startenddate' => 'StartEndDate'
        );
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

    /**
     * If auction has bids, renders text 'Auction with bids'.
     *
     * @param array $item Item from listing table
     * @return string Rendered table cell.
     */

    protected function getItemLastSyncTime($item) {
        if ($item['BidCount'] > 0 && $item['BuyingMode'] === 'auction') {
            return '<td title="'.MLI18n::gi()->ricardo_inventory_listing_auction_has_bids_tooltip.'">'.MLI18n::gi()->ricardo_inventory_listing_auction_has_bids.'</td>';
        }

        if ($item['LastSync'] === '0000-00-00 00:00:00') {
            $item['LastSync'] = 0;
        } else {
            $item['LastSync'] = strtotime($item['LastSync']);
        }

        if ($item['LastSync'] <= 0) {
            return '<td>-</td>';
        }

        return '<td>'.date("d.m.Y", $item['LastSync']).' &nbsp;&nbsp;<span class="small">'.date("H:i", $item['LastSync']).'</span></td>';
    }

    protected function getItemId($item) {
        if (empty($item['ItemUrl']) === true) {
            return '<td>'.$item['ItemId'].'</td>';
        }

        return '<td><a href="'.$item['ItemUrl'].'" target="_blank">'.$item['ItemId'].'</a></td>';
    }


    protected function getStartEndDate($item) {
        if ($item['StartTime'] === '0000-00-00 00:00:00') {
            $startTime = '-';
        } else {
            $startTimeUnixTs = strtotime($item['StartTime']);
            $startTime = date("d.m.Y", $startTimeUnixTs).' &nbsp;&nbsp;<span class="small">'.date("H:i", $startTimeUnixTs).'</span>';
        }

        if ($item['EndDate'] === '0000-00-00 00:00:00') {
            $endTime = '-';
        } else {
            $endTimeUnixTs = strtotime($item['EndDate']);
            $endTime = date("d.m.Y", $endTimeUnixTs).' &nbsp;&nbsp;<span class="small">'.date("H:i", $endTimeUnixTs).'</span>';
        }

        return "<td>$startTime<br>$endTime</td>";
    }

    /**
     * Prints indicators in inventory table
     * @param $item
     * @return string
     */
    protected function getStatus($item) {
        $html = '<td>';
        $status = $item['Status'];
        $itemId = $item['ItemId'];
        if ($status == 'active') {
            $html .= '<div class="semaphore-base semaphoreGreen"></div>';
        } elseif ($status == 'pending' && $itemId == '') {
            $html .= '<div class="semaphore-base semaphoreGray"></div>';
        } elseif ($status == 'pending' && $itemId != '') {
            $html .= '<div class="semaphore-base semaphoreBlue"></div>';
        }

        return $html.'</td>';
    }

    protected function getQuantities($item) {
        $oProduct = MLProduct::factory()->getByMarketplaceSKU($item['SKU']);
        if ($oProduct->exists()) {
            $shopQuantity = $oProduct->getStock();
        } else {
            $shopQuantity = '&mdash;';
        }

        return '<td>'.$shopQuantity.' / '.$item['Quantity'].'</td>';
    }

    protected function getBidCount($item) {
        if ($item['BuyingMode'] === 'buy_it_now') {
            $item['BidCount'] = '&mdash;';
        }

        return '<td>' . $item['BidCount'] . '</td>';
    }

    protected function getItemPrice($item) {
        $item['Currency'] = isset($item['Currency']) && $item['Currency'] != '' ? $item['Currency'] : $this->sCurrency;
        return '<td>' . MLPrice::factory()->format($item['Price'], $item['Currency'], false) . '</td>';
    }

    protected function postDelete() {
        MagnaConnector::gi()->submitRequest(array(
            'ACTION' => 'UploadItems'
        ));
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
                    'SKU' => $sSku,
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

            if ($result['STATUS'] == 'SUCCESS') {
                $oDb = MLDatabase::getDbInstance();
                if ($oDb->batchinsert(
                        'magnalister_listings_deleted', $aInsertData
                    ) != true
                ) {
                    MLMessage::gi()->addWarn($oDb->getLastError());
                }
                $this->postDelete();
            }
        } else if (isset($this->aPostGet['listing']['import'])) {
            try {
                $result = MagnaConnector::gi()->submitRequest(array(
                    'ACTION' => 'ImportInventory'
                ));

                MLModul::gi()->setConfig('inventory.import', time());
            } catch (MagnaException $e) {
                $result = array(
                    'STATUS' => 'ERROR'
                );
            }
        }

        $this->getSortOpt();

        if (isset($this->aPostGet['page']) && ctype_digit($this->aPostGet['page'])) {
            $this->iOffset = ($this->aPostGet['page'] - 1) * $this->aSetting['itemLimit'];
        } else {
            $this->iOffset = 0;
        }
    }
}
