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

class ML_Hitmeister_Controller_Hitmeister_Listings_Inventory extends ML_Listings_Controller_Widget_Listings_InventoryAbstract {
    protected $aParameters = array('controller');

    public function __construct() {
        parent::__construct();

        if (empty($this->sCurrency)) {
            $this->sCurrency = MLModule::gi()->getConfig('currency');
        }
    }

    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_GENERIC_INVENTORY');
    }

    public static function getTabActive() {
        return MLModul::gi()->isConfigured();
    }

    public function prepareData() {
        $result = $this->getInventory();

        if (($result !== false) && !empty($result['DATA'])) {
            $this->aData = $result['DATA'];
            foreach ($this->aData as &$item) {
                if (isset($item['Title'])) {
                    $item['MarketplaceTitle'] = $item['Title'];
                }

                $oProduct = MLProduct::factory()->getByMarketplaceSKU($item['SKU']);

                $item['Title'] = '&mdash;';
                $item['editUrl'] = '';
                $item['ShopQuantity'] = '&mdash;';
                if ($oProduct->exists()) {
                    $item['Title'] = $oProduct->getName();
                    $item['editUrl'] = $oProduct->getEditLink();
                    $item['ShopQuantity'] = $oProduct->getStock();
                    try {
                        $item['ShopPrice'] = $oProduct->getShopPrice();
                    } catch (\Exception $ex) {
                        //if the price is 0.00 in Shopware
                        $item['ShopPrice'] = '&mdash;';
                        MLMessage::gi()->addDebug($ex);
                    }
                }

                if (isset($item['ItemId']) && $item['SKU'] === $item['ItemId']) {
                    $item['SKU'] = '&mdash;';
                }
            }
            unset($result);
        }
    }

    protected function getFields() {
        $oI18n = MLI18n::gi();
        return array(
            'SKU' => array(
                'Label' => $oI18n->ML_LABEL_SKU,
                'Sorter' => 'sku',
                'Getter' => 'getSku',
                'Field' => null,
            ),
            'Title' => array(
                'Label' => $oI18n->ML_LABEL_SHOP_TITLE,
                'Sorter' => null,
                'Getter' => null,
                'Field' => 'Title',
            ),
            'MarketplaceTitle' => array(
                'Label' => MLI18n::gi()->hitmeister_label_title,
                'Sorter' => 'title',
                'Getter' => null,
                'Field' => 'MarketplaceTitle',
            ),
            'UnitId' => array(
                'Label' => $oI18n->ML_MAGNACOMPAT_LABEL_MP_ITEMID,
                'Sorter' => null,
                'Getter' => 'getLink',
                'Field' => null,
            ),
            'EAN' => array(
                'Label' => $oI18n->ML_LABEL_EAN,
                'Sorter' => 'EAN',
                'Getter' => null,
                'Field' => 'EAN',
            ),
            'Price' => array(
                'Label' => $this->__('ML_LABEL_SHOP_PRICE_NETTO').' / '.$oI18n->Hitmeister_Productlist_Label_Price,
                'Sorter' => 'price',
                'Getter' => 'getItemPrice',
                'Field' => null,
            ),
            'Quantity' => array(
                'Label' => MLI18n::gi()->hitmeister_inventory_listing_quantity,
                'Sorter' => 'quantity',
                'Getter' => 'getQuantities',
                'Field' => null,
            ),
            'DateAdded' => array(
                'Label' => $oI18n->ML_GENERIC_CHECKINDATE,
                'Sorter' => 'dateadded',
                'Getter' => 'getItemDateAdded',
                'Field' => null,
            ),
            'Status' => array(
                'Label' => MLI18n::gi()->hitmeister_inventory_listing_status,
                'Sorter' => null,
                'Getter' => 'getStatus',
                'Field' => null,
            )
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
            'ean' => 'EAN',
            'title' => 'Title',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'dateadded' => 'DateAdded',
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

    protected function getLink($item) {
        if (empty($item['UnitId'])) {
            return '<td>&mdash;</td>';
        }
        $addStyle = ($item['Title'] === '&mdash;' && $item['SKU'] !== '&mdash;') ? 'color:#e31e1c;' : '';
        return '
        <td>
            <a style=" '.$addStyle.'" href="'.$item['ProductUrl'].'" target="_blank">'.$item['UnitId'].'</a>
        </td>';
    }

    protected function getSku($item) {
        $addStyle = ($item['Title'] === '&mdash;' && $item['SKU'] !== '&mdash;') ? 'color:#e31e1c;' : '';
        $html = '<td>'.$item['SKU'].'</td>';
        if (!empty($item['editUrl'])) {
            $html = '<td><div class="product-link" ><a class="ml-js-noBlockUi" style="' . $addStyle . '" href="'.$item['editUrl'].'" target="_blank" title="'.MLI18n::gi()->ML_LABEL_EDIT.'">'.$item['SKU'].'</a></div></td>';
        }

        return $html;
    }

    protected function getQuantities($item) {
        return '<td>' . $item['ShopQuantity'] . ' / ' . $item['Quantity'] . '</td>';
    }

    protected function getItemDateAdded($item) {
        if (empty($item['DateAdded'])) {
            return '<td>&mdash;</td>';
        }
        
        $timestamp = strtotime($item['DateAdded']);
        return '<td>'.date("d.m.Y", $timestamp).' &nbsp;&nbsp;<span class="small">'.date("H:i", $timestamp).'</span>'.'</td>';
    }

    protected function getStatus($item) {
        if (isset($item['Status']) === false) {
            $status = '-';
        } else if ($item['Status'] === 'Active') {
            $status = MLI18n::gi()->hitmeister_inventory_listing_status_active;
        } else if ($item['Status'] === 'UpdateItem' || $item['Status'] === 'WaitingUpdateItem') {
            $status = MLI18n::gi()->hitmeister_inventory_listing_status_pending_update;
        } else {
            $status = MLI18n::gi()->hitmeister_inventory_listing_status_pending_new;
        }

        return '<td>'.$status.'</td>';
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
