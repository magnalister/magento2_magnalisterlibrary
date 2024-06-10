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

MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_InventoryAbstract');

class ML_Metro_Controller_Metro_Listings_Inventory extends ML_Listings_Controller_Widget_Listings_InventoryAbstract {

    protected $aParameters = array('controller');

    public function __construct() {
        parent::__construct();
        $this->saveDeletedLocally = false;
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
                'Label' => $oI18n->ML_LABEL_METRO_TITLE,
                'Sorter' => 'itemtitle',
                'Getter' => 'getItemMetroTitle',
                'Field' => null,
            ),
            'MetroId' => array(
                'Label' => $oI18n->ML_LABEL_METRO_ITEM_ID,
                'Sorter' => null,
                'Getter' => 'getMetroLink',
                'Field' => null,
            ),
            'Price' => array(
                'Label' => $oI18n->ML_LABEL_SHOP_PRICE.' / '.MLModule::gi()->getMarketPlaceName(false).' '.$oI18n->ML_GENERIC_PRICE.
                    '<br>'.$oI18n->ML_LABEL_SHOP_PRICE_NETTO.' / '.MLModule::gi()->getMarketPlaceName(false).' '.$oI18n->ML_LABEL_NETTO.'-'.$oI18n->ML_GENERIC_PRICE,
                'Sorter' => 'NetPrice',
                'Getter' => 'getItemPrice',
                'Field' => null,
            ),
            'Quantity' => array(
                'Label' => $this->__('ML_STOCK_SHOP_STOCK_METRO') . '<br />' . $this->__('ML_LAST_SYNC'),
                'Sorter' => null,
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
                'Label' => $oI18n->ML_GENERIC_STATUS,
                'Sorter' => null,
                'Getter' => 'getStatus',
                'Field' => null,
            )
        );
    }

    protected function getSKU($item) {
        $html = '<td>' . $item['SKU'] . '</td>';
        if (!empty($item['editUrl'])) {
            $html = '<td><div class="product-link" ><a class="ml-js-noBlockUi" href="' . $item['editUrl'] . '" target="_blank" title="' . MLI18n::gi()->ML_LABEL_EDIT . '">' . $item['SKU'] . '</a></div></td>';
        }

        return $html;
    }

    protected function getStatus($item) {
        if ('active' == $item['StatusProduct'] && 'active' == $item['StatusOffer']) {
            return '<td>'.MLI18n::gi()->ML_GENERIC_STATUS_ACTIVE.'</td>';
        } elseif ('waiting' == $item['StatusProduct'] && ('waiting' == $item['StatusOffer'] || 'creating' == $item['StatusOffer'])) {
            return '<td>'.MLI18n::gi()->ML_GENERIC_STATUS_PRODUCT_IS_CREATED.'</td>';
        } elseif ('waiting' == $item['StatusProduct'] && 'active' == $item['StatusOffer']) {
            return '<td>'.MLI18n::gi()->ML_GENERIC_STATUS_PRODUCT_IS_UPDATED.'</td>';
        } elseif ('active' == $item['StatusProduct'] && 'waiting' == $item['StatusOffer']) {
            return '<td>'.MLI18n::gi()->ML_GENERIC_STATUS_OFFER_IS_UPDATED.'</td>';
        } elseif ('active' == $item['StatusProduct'] && 'creating' == $item['StatusOffer']) {
            return '<td>'.MLI18n::gi()->ML_GENERIC_STATUS_OFFER_IS_CREATED.'</td>';
        } elseif ('pending_delete' == $item['StatusOffer']) {
            return '<td>'.MLI18n::gi()->ML_METRO_STATUS_PRODUCT_IS_PENDING_DELETE.'</td>';
        } else {
            return '<td>&mdash;</td>';
        } 
    }

    protected function getMetroLink($item) {
        #return '<td><a class="ml-js-noBlockUi" href="' . $item['SiteUrl'] . '?ViewItem&item=' . $item['ItemID'] . '" target="_blank">' . $item['ItemID'] . '</a></td>';
        return '<td>' . $item['MetroId'] . '</td>';
    }

    protected function manipulateSortParameter($aSort) {
        $aSort['itemtitle'] = 'ItemTitle';
        return $aSort;
    }

    protected function getItemDateAdded($item) {
        return '<td>' . date("d.m.Y", $item['DateAdded']) . ' &nbsp;&nbsp;<span class="small">' . date("H:i", $item['DateAdded']) . '</span></td>';
    }

    public function prepareData() {
        $result = $this->getInventory();
        if (($result !== false) && !empty($result['DATA'])) {
            $this->aData = $result['DATA'];
            foreach ($this->aData as &$item) {
                $item['SKU'] = html_entity_decode(fixHTMLUTF8Entities($item['SKU']));
                $item['aProductData'] = unserialize($item['ProductData']);
                $item['ItemTitle'] = !empty($item['ProductData']) ? fixHTMLUTF8Entities($item['aProductData']['Title']) : '';
                $item['Currency'] = 'EUR'; //always EUR for now
                $item['DateAdded'] = strtotime($item['DateAdded']);
                $item['LastSync'] = strtotime($item['DateUpdated']);

                $oProduct = MLProduct::factory();

                try {
                    /* @var $oProduct ML_Shop_Model_Product_Abstract */
                    if (
                        !$oProduct->getByMarketplaceSKU($item['SKU'])->exists() && !$oProduct->getByMarketplaceSKU($item['SKU'], true)->exists()
                    ) {
                        throw new Exception;
                    }
                    $item['ProductsID'] = $oProduct->get('productsid');
                    $item['ShopQuantity'] = $oProduct->getStock();
                    $item['ShopPrice'] = $oProduct->getShopPrice();
                    $item['ShopNetPrice'] = $oProduct->getShopPrice(false);
                    $item['Tax'] = $oProduct->getTax();
                    $item['ShopTitle'] = $oProduct->getName();
                    $item['editUrl'] = $oProduct->getEditLink();
                } catch (Exception $oExc) {
                    $item['ShopQuantity'] = $item['ShopPrice'] = $item['ShopTitle'] = '&mdash;';
                    $item['ProductsID'] = 0;
                    $item['editUrl'] = '';
                    $item['ShopPrice'] = '&mdash;';
                    MLMessage::gi()->addDebug($oExc);
                }
                // determine shipping cost
                try {
                    /** @var ML_Metro_Helper_Model_Table_Metro_PrepareData $oPrepareHelper */
                    $oPrepareHelper = MLHelper::gi('Model_Table_Metro_PrepareData');

                    $oPrepareHelper
                        ->setPrepareList(null)
                        ->setProduct($oProduct)
                        ->setMasterProduct($oProduct);

                    $aPrepareData = $oPrepareHelper->getPrepareData(array(
                        'ShippingCost' => array('optional' => array('active' => true)),
                    ), 'value');
                    $item['ShippingCost'] = $aPrepareData['ShippingCost'];

                    // Shipping costs are not numeric or empty
                    if (!is_numeric($item['ShippingCost'])) {
                        throw new Exception();
                    }

                    // remove tax from ShippingCost to get NetShippingCost
                    $item['NetShippingCost'] = round(((float)$item['ShippingCost'] / ((100 + (float)$item['Tax']) / 100)), 2);

                } catch (Exception $oExcc) {
                    $item['ShippingCost'] = 0.00;
                    $item['NetShippingCost'] = 0.00;
                }
            }
            unset($result);
        }
    }

    protected function getItemPrice($item) {
        $renderedShopPrice = (isset($item['Currency']) && isset($item['ShopPrice']) && 0 != $item['ShopPrice']) ? MLPrice::factory()->format($item['ShopPrice'], $item['Currency']) : '&mdash;';
        $renderedMpPrice = ((isset($item['Currency']) && isset($item['Price']) && 0 != $item['Price'])
        ? MLPrice::factory()->format($item['Price'], $item['Currency'])
          . '<span class="small">('.MLI18n::gi()->ML_LABEL_INCL.' '.MLPrice::factory()->format($item['ShippingCost'], $item['Currency']).' '.MLI18n::gi()->ML_GENERIC_SHIPPING.')</span>'
        : '&mdash;');

        $renderedShopNetPrice = (isset($item['Currency']) && isset($item['ShopNetPrice']) && 0 != $item['ShopNetPrice']) ? MLPrice::factory()->format($item['ShopNetPrice'], $item['Currency']) : '&mdash;';
        $renderedMpNetPrice = ((isset($item['Currency']) && isset($item['NetPrice']) && 0 != $item['NetPrice'])
            ? MLPrice::factory()->format($item['NetPrice'], $item['Currency'])
            . '<span class="small">('.MLI18n::gi()->ML_LABEL_INCL.' '.MLPrice::factory()->format($item['NetShippingCost'], $item['Currency']).' '.MLI18n::gi()->ML_GENERIC_SHIPPING.')</span>'
            : '&mdash;');

        return '<td>'.$renderedShopPrice.' / '.$renderedMpPrice.'<br>'.$renderedShopNetPrice.' / '.$renderedMpNetPrice.'</td>';
    }

    protected function getItemShopTitle($item) {
        return '<td>' . $item['ShopTitle'] . '<br />'. (isset($item['ShopVarText']) ?'<span class="small">' .  $item['ShopVarText'] . '</span>': '').'</td>';
    }

    protected function getItemMetroTitle($item) {
        return '<td title="' . fixHTMLUTF8Entities($item['ItemTitle'], ENT_COMPAT) . '">' . $item['ItemTitle'] . '</td>';
    }

    protected function getQuantities($item) {
        return '<td>' . $item['ShopQuantity'] . ' / ' . $item['Quantity'] . '<br />' . date("d.m.Y", $item['LastSync']) . ' &nbsp;&nbsp;<span class="small">' . date("H:i", $item['LastSync']) . '</span></td>';
    }


    public function render() {
        $this->includeView('widget_listings_inventory');
        return $this;
    }
}
