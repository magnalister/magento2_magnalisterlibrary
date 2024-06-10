<?php
MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_InventoryAbstract');

class ML_Etsy_Controller_Etsy_Listings_Inventory extends ML_Listings_Controller_Widget_Listings_InventoryAbstract {
    protected $aParameters = array('controller');

    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_GENERIC_INVENTORY');
    }

    public static function getTabActive() {
        return MLModul::gi()->isConfigured();
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
            'ShopTitle' => array(
                'Label' => $oI18n->ML_LABEL_SHOP_TITLE,
                'Sorter' => null,
                'Getter' => 'getShopProductTitle',
                'Field' => null,
            ),
            'EtsyTitle' => array(
                'Label' => 'Etsy Titel',
                'Sorter' => null,
                'Getter' => 'getTitle',
                'Field' => null,
            ),
            'ListingId' => array(
                'Label' => $oI18n->ML_ETSY_LABEL_LISTINGID,
                'Sorter' => null,
                'Getter' => 'getListingId',
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
                'Getter' => null,
                'Field' => 'Quantity',
            ),
            'DateAdded' => array(
                'Label' => $oI18n->ML_GENERIC_CHECKINDATE,
                'Sorter' => 'dateadded',
                'Getter' => 'getItemDateAdded',
                'Field' => null
            ),
            'DateUpdated' => array(
                'Label' => $oI18n->ML_GENERIC_LASTSYNC,
                'Sorter' => null,
                'Getter' => 'getItemDateUpdated',
                'Field' => null
            ),
            'Status' => array(
                'Label' => $oI18n->ML_GENERIC_STATUS,
                'Sorter' => null,
                'Getter' => 'getStatus',
                'Field' => null
            ),
        );
    }

    protected function getItemDateAdded($item) {
        return '<td>'.date("d.m.Y", $item['DateAdded']).' &nbsp;&nbsp;<span class="small">'.date("H:i", $item['DateAdded']).'</span>'.'</td>';
    }

    protected function getItemDateUpdated($item) {
        $sDateUpdated = strtotime($item['DateUpdated']);
        if ($sDateUpdated < 0 || empty($item['DateUpdated'])) {
            return '<td>-</td>';
        }
        return '<td>'.date("d.m.Y", $sDateUpdated).' &nbsp;&nbsp;<span class="small">'.date("H:i", $sDateUpdated).'</span>'.'</td>';
    }

    protected function getListingId($item) {
        if ($item['ListingId'] == 0) {
            return '<td>&mdash;</td>';
        } elseif (empty($item['Data']['Url'])) {
            return '<td>'.$item['ListingId'].'</td>';
        }
        $addStyle = (empty($item['ShopTitle']) || $item['ShopTitle'] === '&mdash;') ? 'color:#e31e1c;' : '';
        return '<td><a style="'. $addStyle .'" class="ml-js-noBlockUi" href="'.$item['Data']['Url'].'" target="_blank">'.$item['ListingId'].'</a></td>';
    }

    protected function getStatus($item) {
        $status = '-';

        if ($item['Status'] === 'active') {
            $status = MLI18n::gi()->etsy_inventory_listing_status_active;
        } else if ($item['Status'] === 'inactive') {
            $status = MLI18n::gi()->etsy_inventory_listing_status_inactive;
        }  else if ($item['Status'] === 'expired') {
            $status = MLI18n::gi()->etsy_inventory_listing_status_expired;
        }  else if ($item['Status'] === 'draft') {
            $status = MLI18n::gi()->etsy_inventory_listing_status_draft;
        } else if ($item['Status'] === 'sold_out') {
            $status = MLI18n::gi()->etsy_inventory_listing_status_sold_out;
        } else if ($item['Status'] === 'add') {
            $status = MLI18n::gi()->etsy_inventory_listing_status_new;
        }

        return '<td>'.$status.'</td>';
    }

    public function getShopProductTitle($item) {
        $title = '--';
        $oProduct = MLProduct::factory()->getByMarketplaceSKU($item['SKU']);
        if ($oProduct->exists()) {
            $title = $oProduct->getName();
        }
        return '<td>'.$title.'</td>';
    }

    public function prepareData() {
        parent::prepareData();
        foreach ($this->aData as &$item) {
            if (!empty($item['Data'])) {
                $item['Data'] = json_decode($item['Data'], true);
            }
        }
    }

    protected function getInventory() {
        try {
            $request = array(
                'ACTION' => 'GetInventory',
                'LIMIT' => $this->aSetting['itemLimit'],
                'OFFSET' => $this->iOffset,
                'ORDERBY' => $this->aSort['order'],
                'SORTORDER' => $this->aSort['type'],
            );

            if (!empty($this->search)) {
                $request['SEARCH'] = $this->search;
            }
            $result = MagnaConnector::gi()->submitRequest($request);

            $this->iNumberofitems = (int)$result['NUMBEROFLISTINGS'] + 1;

            return $result;
        } catch (MagnaException $e) {
            return false;
        }
    }
}
