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

MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_InventoryAbstract');

class ML_Ebay_Controller_Ebay_Listings_Inventory extends ML_Listings_Controller_Widget_Listings_InventoryAbstract {

    protected $sDeleteKey = 'ItemID';
    protected $pendingItems = array();
    protected $aParameters = array('controller');
    protected $priceBrutto;
    protected $blHasDeleteTable = false;

    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_GENERIC_INVENTORY');
    }

    protected function manipulateInventoryRequest($request) {
        $request['EXTRA'] = 'ShowPending';
        return $request;
    }

    public function __construct() {
        parent::__construct();
        if (MLModule::gi()->getGetNumberOfNewErrors() > 0) {
            MLMessage::gi()->addWarn(MLI18n::gi()->sEbayErrorLast5Minute, array(), true, '.ml-js-ebay-matching-warning-after5min');
        }
        $this->aSetting['maxTitleChars'] = 80;
        $this->priceBrutto = !(defined('PRICE_IS_BRUTTO') && (PRICE_IS_BRUTTO == 'false'));
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
                'Label' => $oI18n->ML_LABEL_EBAY_TITLE,
                'Sorter' => 'itemtitle',
                'Getter' => 'getItemEbayTitle',
                'Field' => null,
            ),
            'eBayId' => array(
                'Label' => $oI18n->ML_LABEL_EBAY_ITEM_ID,
                'Sorter' => null,
                'Getter' => 'getEBayLink',
                'Field' => null,
            ),
//            'ePID' => array(
//                'Label' => $oI18n->ML_LABEL_EBAY_EPID,
//                'Sorter' => null,
//                'Getter' => 'getEBayEPIDLink',
//                'Field' => null,
//            ),
//            'PrepareKind' => array(
//                'Label' => $oI18n->ML_EBAY_LABEL_PREPARE_KIND,
//                'Sorter' => null,
//                'Getter' => 'getPrepareKind',
//                'Field' => null,
//            ),
            'Price' => array(
                'Label' => ($this->priceBrutto ? $this->__('ML_LABEL_SHOP_PRICE_BRUTTO') : $this->__('ML_LABEL_SHOP_PRICE_NETTO')) . ' / eBay ',
                'Sorter' => 'price',
                'Getter' => 'getItemPrice',
                'Field' => null,
            ),
            'Quantity' => array(
                'Label' => $this->__('ML_STOCK_SHOP_STOCK_EBAY') . '<br />' . $this->__('ML_LAST_SYNC'),
                'Sorter' => null,
                'Getter' => 'getQuantities',
                'Field' => null,
            ),
            'DateAdded' => array(
                'Label' => $oI18n->ML_LABEL_EBAY_LISTINGTIME,
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
        $aStatusI18n = MLI18n::gi()->get('Ebay_listings_status');
        if (!isset($item['Status'])) $item['Status'] = 'active';
        if ($item['Status'] == 'active') {
            //$sStatusColor = '#00f1ba, #00d768';
            $sStatusTitle = $aStatusI18n['active'];
        } elseif (array_key_exists('ItemID', $item) && !empty($item['ItemID'])) {
            //$sStatusColor = '#96bff0, #96b0d0';
            $sStatusTitle = $aStatusI18n['pending_process'];
        } else if ($item['Status'] == 'waiting_catalog') {
            if (isset($item['estimatedTime']) && ('0000-00-00 00:00:00' != $item['estimatedTime'])) {
                $sStatusTitle = $aStatusI18n['waiting_catalog'].'<br />'.$aStatusI18n['est_until'].strtotime($item['estimatedTime']);
            } else {
                $sStatusTitle = $aStatusI18n['waiting_catalog'].'<br />'.$aStatusI18n['est_until'].$aStatusI18n['not_yet_known'];
            }
        } else {
            //$sStatusColor = '#bdbdbd, #5b5b5b';
            $sStatusTitle = $aStatusI18n['pending'];
        }
        //return '<td title="' . $sStatusTitle . '"><div style="border-radius: 5px; height: 10px; margin: auto; width: 10px; color: #FFF;background-image: linear-gradient(to bottom, ' . $sStatusColor . ');">&nbsp;</div>&nbsp;</td>';
        return '<td>'.$sStatusTitle.'</td>';

    }

    protected function getEBayLink($item) {
        $addStyle = (empty($item['ShopTitle']) || $item['ShopTitle'] === '&mdash;') ? 'style="color:#e31e1c;"' : '';
        return '<td><a '. $addStyle .' class="ml-js-noBlockUi" href="' . $item['SiteUrl'] . '?ViewItem&item=' . $item['ItemID'] . '" target="_blank">' . $item['ItemID'] . '</a></td>';
    }

    /* deprecated */
    protected function getEBayEPIDLink($item) {
        if (isset($item['ePID'])) {
            if (isset($item['productWebUrl'])) {
                return '<td><a class="ml-js-noBlockUi" href="'.$item['productWebUrl'].'" target="_blank">'.$item['ePID'].'</a></td>';
            } else {
                return '<td>'.$item['ePID'].'</td>';
            }
        } else {
            return '<td>&mdash;</td>';
        }
    }

    protected function getPrepareKind($item) {
        $aPrepareKindI18n = MLI18n::gi()->get('Ebay_listings_prepareType');
        if (isset($item['Prepared'])) {
             return '<td>'.$aPrepareKindI18n[$item['Prepared']].'</td>';
        } else {
            return '<td>'.$aPrepareKindI18n['notMatched'].'</td>';
        }
    }

    protected function manipulateSortParameter($aSort) {
        $aSort['itemtitle'] = 'ItemTitle';
        return $aSort;
    }

    protected function getItemDateAdded($item) {
        return '<td>' . date("d.m.Y", $item['DateAdded']) . ' &nbsp;&nbsp;<span class="small">' . date("H:i", $item['DateAdded']) . '</span><br />' . ('&mdash;' == $item['DateEnd'] ? '&mdash;' : date("d.m.Y", $item['DateEnd']) . ' &nbsp;&nbsp;<span class="small">' . date("H:i", $item['DateEnd']) . '</span>') . '</td>';
    }

    public function prepareData() {
        $result = $this->getInventory();
        if (($result !== false) && !empty($result['DATA'])) {
            $this->aData = $result['DATA'];
            $this->getPendingFunction('Items');
            $this->getPendingFunction('ProductDetailUpdates');
            foreach ($this->aData as &$item) {
                $item['SKU'] = html_entity_decode(fixHTMLUTF8Entities($item['SKU']));
                $item['ItemTitleShort'] = (strlen($item['ItemTitle']) > $this->aSetting['maxTitleChars'] + 2) ? (fixHTMLUTF8Entities(substr($item['ItemTitle'], 0, $this->aSetting['maxTitleChars'])) . '&hellip;') : fixHTMLUTF8Entities($item['ItemTitle']);
                $item['VariationAttributesText'] = fixHTMLUTF8Entities($item['VariationAttributesText']);

                $item['DateAdded'] = strtotime($item['DateAdded']);
                $item['DateEnd'] = ('1' == $item['GTC'] ? '&mdash;' : strtotime($item['End']));
                $item['LastSync'] = strtotime($item['LastSync']);

                $oProduct = MLProduct::factory();
                try {
                    /* @var $oProduct ML_Shop_Model_Product_Abstract  */
                    if (
                            !$oProduct->getByMarketplaceSKU($item['SKU'])->exists() && !$oProduct->getByMarketplaceSKU($item['SKU'], true)->exists()
                    ) {
                        throw new Exception;
                    }
                    $item['ProductsID'] = $oProduct->get('productsid');
                    // Product may exist, but have no quantity or price
                    try {
                        $item['ShopQuantity'] = $oProduct->getStock();
                    } catch (Exception $oNoQuantityExc) {
                        $item['ShopQuantity'] = '&mdash;';
                    }
                    try {
                        $item['ShopPrice'] = $oProduct->getShopPrice();
                    } catch (Exception $oNoPriceExc) {
                        $item['ShopPrice'] = '&mdash;';
                    }
                    $item['ShopTitle'] = $oProduct->getName();
                    $item['ShopVarText'] = $oProduct->getName();
                    $item['editUrl'] = $oProduct->getEditLink();
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
        $renderedShopPrice = (isset($item['Currency']) && isset($item['ShopPrice']) && 0 != $item['ShopPrice']) ? MLPrice::factory()->format($item['ShopPrice'], $item['Currency']) : '&mdash;';
        if (    (isset($item['ManufacturersPrice']) || isset($item['OldPrice']))
             && (isset($item['Currency']) && isset($item['Price']) && 0 != $item['Price'])) {
                $sMarketplacePrice = MLPrice::factory()->format($item['Price'], $item['Currency']);
                $sStrikePrice = MLPrice::factory()->format((isset($item['ManufacturersPrice'])? $item['ManufacturersPrice'] : $item['OldPrice']), $item['Currency']);
                return '<td>' . $renderedShopPrice . ' / ' . $sMarketplacePrice .'&nbsp;<span style="color:#ff0000;font-size:0.9em">(<span style="text-decoration:line-through">'.$sStrikePrice.'</span>)</span>'. '</td>';
        }
        return '<td>' . $renderedShopPrice . ' / ' . ((isset($item['Currency']) && isset($item['Price']) && 0 != $item['Price']) ? MLPrice::factory()->format($item['Price'], $item['Currency']) : '&mdash;') . '</td>';
    }

    protected function getItemShopTitle($item) {
        return '<td>' . $item['ShopTitle'] . '<br /><span class="small">' . $item['ShopVarText'] . '</span></td>';
    }

    protected function getItemEbayTitle($item) {
        return '<td title="' . fixHTMLUTF8Entities($item['ItemTitle'], ENT_COMPAT) . '">' . $item['ItemTitleShort'] . '<br /><span class="small">' . $item['VariationAttributesText'] . '</span></td>';
    }

    protected function getQuantities($item) {
        return '<td>' . $item['ShopQuantity'] . ' / ' . $item['Quantity'] . '<br />' . date("d.m.Y", $item['LastSync']) . ' &nbsp;&nbsp;<span class="small">' . date("H:i", $item['LastSync']) . '</span></td>';
    }

    protected function getIcon($item) {
        return ('ml' == $item['listedBy']) ? '&nbsp;<img src="' . MLHttp::gi()->getResourceUrl('images/magnalister_11px_icon_color.png') . '" width=11 height=11 />' : '';
    }

    protected function getSynchMessage() {
        if (!empty($this->pendingItems)) {
            foreach ($this->pendingItems as $sKye => $aPendingItems) {
                if (!empty($aPendingItems['itemsCount'])) {
                    $this->sSynchMessages .= '<div class="successBoxBlue"> ' . $this->__('ML_EBAY_N_PENDING_UPDATES_TITLE_' . strtoupper($sKye)) . " "
                            . ' ' . sprintf(ML_EBAY_N_PENDING_UPDATES_ESTIMATED_TIME_M, $aPendingItems['itemsCount'], $aPendingItems['estimatedWaitingTime'])
                            . '</div>';
                }
            }
        }

        if (!empty($this->pendingItems) && !empty($this->pendingItems['itemsCount'])
        ) {
            $this->sSynchMessages .= '<p class="successBoxBlue">'
                    . sprintf($this->__('ML_EBAY_N_PENDING_UPDATES_ESTIMATED_TIME_M'), $this->pendingItems['itemsCount'], $this->pendingItems['estimatedWaitingTime'])
                    . '</p>';
        }
        $this->sSynchMessages .= '<p class="ml-js-ebay-matching-warning-after5min"></p>';
        return parent::getSynchMessage();
    }

    public function render() {
        $this->includeView('widget_listings_inventory');
        return $this;
    }

    protected function getPendingFunction($sRequest = 'Items') {
        try {
            $result = MagnaConnector::gi()->submitRequest(array(
                'ACTION' => 'GetPending' . $sRequest,
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
