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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_InventoryAbstract');

class ML_PriceMinister_Controller_PriceMinister_Listings_Inventory extends ML_Listings_Controller_Widget_Listings_InventoryAbstract
{
    protected $aParameters = array('controller');

    public static function getTabTitle()
    {
        return MLI18n::gi()->get('ML_GENERIC_INVENTORY');
    }

    public static function getTabActive()
    {
        return MLModule::gi()->isConfigured();
    }

    public static function getTabDefault()
    {
        return true;
    }

    public function prepareData() {
        parent::prepareData();

        foreach ($this->aData as &$item) {
            $item['ShopProductTitleShort'] = '&mdash;';
            $item['ShopQuantity'] = '&mdash;';
            $item['ShopProductTitle'] = '';
            $item['editUrl'] = '';
            $item['ProductUrl'] = 'http://www.priceminister.com/offer/buy/' . $item['ProductId'];

            $oProduct = MLProduct::factory()->getByMarketplaceSKU($item['SKU']);
            if ($oProduct->exists()) {
                $sTitle = $oProduct->getName();
                $item['ShopProductTitleShort'] = (strlen($sTitle) > $this->aSetting['maxTitleChars'] + 2) ?
                    (fixHTMLUTF8Entities(substr($sTitle, 0, $this->aSetting['maxTitleChars'])).'&hellip;') :
                    fixHTMLUTF8Entities($sTitle);
                $item['ShopProductTitle'] = $sTitle;
                $item['editUrl'] = $oProduct->getEditLink();
                $item['ShopQuantity'] = $oProduct->getStock();
            }
        }
    }

    protected function getFields()
    {
        $oI18n = MLI18n::gi();
        return array(
            'SKU' => array(
                'Label' => $oI18n->PRICEMINISTER_ML_LABEL_ARTICLE_SKU,
                'Sorter' => 'sku',
                'Getter' => 'getSku',
                'Field' => null,
            ),
            'getShopProductTitle' => array(
                'Label' => ML_LABEL_SHOP_TITLE,
                'Sorter' => null,
                'Getter' => 'getShopProductTitle',
                'Field' => null,
            ),
            'Title' => array(
                'Label' => $oI18n->PRICEMINISTER_ML_LABEL_ARTICLE_NAME,
                'Sorter' => 'title',
                'Getter' => 'getTitle',
                'Field' => null,
            ),
            'ProductId' => array(
                'Label' => $oI18n->priceminister_label_item_id,
                'Sorter' => 'productid',
                'Getter' => 'getProductId',
                'Field' => null,
            ),
            'ShopPrice' => array(
                'Label' => $oI18n->PRICEMINISTER_ML_LABEL_ARTICLE_SHOP_PREIS,
                'Sorter' => 'price',
                'Getter' => 'getItemPrice',
                'Field' => null,
            ),
            'Quantity' => array(
                'Label' => $oI18n->PRICEMINISTER_ML_LABEL_ARTICLE_MARKETPLACE_QUANTITY,
                'Sorter' => 'quantity',
                'Getter' => 'getQuantities',
                'Field' => null,
            ),
            'LastSync' => array(
                'Label' => $oI18n->ML_GENERIC_LASTSYNC,
                'Sorter' => 'lastsync',
                'Getter' => 'getItemLastSyncTime',
                'Field' => null,
            ),
            'Status' => array(
                'Label' => MLI18n::gi()->priceminister_inventory_listing_status,
                'Sorter' => null,
                'Getter' => 'getStatus',
                'Field' => null,
            ),
        );
    }

    protected function getSku($item)
    {
        $html = '<td>'.$item['SKU'].'</td>';
        if (!empty($item['editUrl'])) {
            $html = '<td><div class="product-link" ><a class="ml-js-noBlockUi" href="'.$item['editUrl'].'" target="_blank" title="'.MLI18n::gi()->ML_LABEL_EDIT.'">'.$item['SKU'].'</a></div></td>';
        }

        return $html;
    }

    protected function getShopProductTitle($item)
    {
        return '<td title="'.fixHTMLUTF8Entities($item['ShopProductTitle'], ENT_COMPAT).'">'.$item['ShopProductTitleShort'].'</td>';
    }

    protected function getProductId($item)
    {
        if (empty($item['ProductId'])) {
            return '<td>&mdash;</td>';
        }
        $addStyle = empty($item['ShopProductTitle']) ? 'style="color:#fe1109;"' : '';
        return '<td><a '. $addStyle .' href="'.$item['ProductUrl'].'" target="_blank">'.$item['ProductId'].'</a></td>';
    }

    protected function getItemStartTime($item)
    {
        $item['StartTime'] = strtotime($item['StartTime']);
        return '<td>' . date("d.m.Y", $item['StartTime']) . ' &nbsp;&nbsp;<span class="small">' . date("H:i", $item['StartTime']) . '</span>' . '</td>';
    }

    protected function getItemLastSyncTime($item)
    {
        if (empty($item['LastSync'])) {
            return '<td>&mdash;</td>';
        }

        $item['LastSync'] = strtotime($item['LastSync']);
        if ($item['LastSync'] < strtotime('2001-01-01')) {
            return '<td>&mdash;</td>';
        }

        return '<td>' . date("d.m.Y", $item['LastSync']) . ' &nbsp;&nbsp;<span class="small">' . date("H:i", $item['LastSync']) . '</span>' . '</td>';
    }

    protected function getQuantities($item)
    {
        return '<td>' . $item['ShopQuantity'] . ' / ' . $item['Quantity'] . '</td>';
    }

    protected function getStatus($item)
    {
        if (isset($item['Status']) === false){
            $status = '<td>&mdash;</td>';
        } else{
            $status = "<td>{$item['Status']}</td>";
        }

        return $status;
    }

    protected function getSortOpt()
    {
        if (isset($this->aPostGet['sorting'])){
            $sorting = $this->aPostGet['sorting'];
        } else{
            $sorting = 'blabla'; // fallback for default
        }
        //ToDo
        $sortFlags = array(
            'sku' => 'SKU',
            'productid' => 'ProductId',
            'title' => 'ItemTitle',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'lastsync' => 'LastSync',
        );
        $order = 'ASC';
        if (strpos($sorting, '-asc') !== false){
            $sorting = str_replace('-asc', '', $sorting);
        } else if (strpos($sorting, '-desc') !== false){
            $order = 'DESC';
            $sorting = str_replace('-desc', '', $sorting);
        }

        if (array_key_exists($sorting, $sortFlags)){
            $this->aSort['order'] = $sortFlags[$sorting];
            $this->aSort['type'] = $order;
        } else{
            $this->aSort['order'] = 'LastSync';
            $this->aSort['type'] = 'DESC';
        }
    }

    protected function getInventory()
    {
        try{
            $request = array(
                'ACTION' => 'GetInventory',
                'LIMIT' => $this->aSetting['itemLimit'],
                'OFFSET' => $this->iOffset,
                'ORDERBY' => $this->aSort['order'],
                'SORTORDER' => $this->aSort['type'],
                'EXTRA' => 'ShowPending',
            );
            if (!empty($this->search)){
                $request['SEARCH'] = $this->search;
            }
            $result = MagnaConnector::gi()->submitRequest($request);
            $this->iNumberofitems = (int)$result['NUMBEROFLISTINGS'];
            return $result;
        } catch (MagnaException $e){
            return false;
        }
    }

    public function initAction()
    {
        if (isset($this->aPostGet['SKUs']) && is_array($this->aPostGet['SKUs'])
            && isset($this->aPostGet['action']) && $this->aPostGet['action'] == 'delete'
        ){
            $_SESSION['POST_TS'] = $this->aPostGet['timestamp'];

            $aInsertData = array();
            $aDeleteItemsData = array();
            foreach ($this->aPostGet['SKUs'] as $sSku){
                $oProduct = MLProduct::factory()->getByMarketplaceSKU($sSku);

                $aDetails = unserialize(str_replace('\\"', '"', $this->aPostGet['details'][$sSku]));
                $iProductId = $sProductSku = '';
                if ($oProduct->exists()){
                    $iProductId = $oProduct->get('MarketplaceIdentId');
                    $sProductSku = $oProduct->get('MarketplaceIdentSku');
                } else{
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

            try{
                $result = MagnaConnector::gi()->submitRequest(array(
                    'ACTION' => 'DeleteItems',
                    'DATA' => $aDeleteItemsData
                ));
                /** @todo create helper if need  call_user_func(ucfirst($this->marketplace) . 'Helper::processCheckinErrors', $result, $this->iMpId); */
            } catch (MagnaException $e){
                $result = array(
                    'STATUS' => 'ERROR'
                );
            }

            if ($result['STATUS'] == 'SUCCESS'){
                $oDb = MLDatabase::getDbInstance();
                if ($oDb->batchinsert(
                        'magnalister_listings_deleted', $aInsertData
                    ) != true
                ){
                    MLMessage::gi()->addWarn($oDb->getLastError());
                }
                $this->postDelete();
            }
        } else if (isset($this->aPostGet['listing']['import'])){
            try{
                MagnaConnector::gi()->submitRequest(array(
                    'ACTION' => 'ImportInventory'
                ));
                MLModule::gi()->setConfig('inventory.import', time());
            } catch (MagnaException $e){
            }
        }

        $this->getSortOpt();

        if (isset($this->aPostGet['page']) && ctype_digit($this->aPostGet['page'])){
            $this->iOffset = ($this->aPostGet['page'] - 1) * $this->aSetting['itemLimit'];
        } else{
            $this->iOffset = 0;
        }
    }
}
