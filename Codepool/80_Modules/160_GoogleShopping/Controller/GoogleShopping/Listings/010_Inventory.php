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

MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_InventoryAbstract');

class ML_GoogleShopping_Controller_GoogleShopping_Listings_Inventory extends ML_Listings_Controller_Widget_Listings_InventoryAbstract {
    protected $aParameters=array('controller');
    
    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_GENERIC_INVENTORY');
    }
    public static function getTabActive() {
        return MLModule::gi()->isConfigured();
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
                'Getter' => 'getTitle',
                'Field' => null,
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
                'Label' => MLI18n::gi()->googleshopping_inventory_listing_status,
                'Sorter' => null,
                'Getter' => 'getStatus',
                'Field' => null,
            )
        );
    }

    protected function getStatus($item) {
        if ($item['Status'] == 'Pending') {
            $status = 'Pending';
        } elseif ($item['Status'] === 'Active') {
            $status = MLI18n::gi()->googleshopping_inventory_listing_status_active;
        } else {
            $status = MLI18n::gi()->googleshopping_inventory_listing_status_pending_new;
        }

        return '<td>'.$status.'</td>';
    }

    protected function getItemDateAdded($item) {
        return '<td>'.date("d.m.Y", $item['DateAdded']).' &nbsp;&nbsp;<span class="small">'.date("H:i", $item['DateAdded']).'</span>'.'</td>';
    }

    protected function getItemDateUpdated($item) {
        $item['DateUpdated'] = strtotime($item['DateUpdated']);
        if ($item['DateUpdated'] < 0) {
            return '<td>-</td>';
        }
        return '<td>'.date("d.m.Y", $item['DateUpdated']).' &nbsp;&nbsp;<span class="small">'.date("H:i", $item['DateUpdated']).'</span>'.'</td>';
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
            $this->iNumberofitems = (int)$result['NUMBEROFLISTINGS'];
            return $result;
        } catch (MagnaException $e) {
            return false;
        }
    }

    protected function postDelete() {
        MagnaConnector::gi()->submitRequest(array(
            'ACTION' => 'UploadItems'
        ));
    }
}
