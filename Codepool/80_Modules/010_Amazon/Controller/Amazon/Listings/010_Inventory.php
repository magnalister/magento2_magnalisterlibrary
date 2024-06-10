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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_InventoryAbstract');

class ML_Amazon_Controller_Amazon_Listings_Inventory extends ML_Listings_Controller_Widget_Listings_InventoryAbstract {

    protected $aParameters = array('controller');

    private $add = array();
    private $updatedelete = array();
    private $getPendingItemsCalled = false;
    private $businessFeature;

    public function __construct() {
        parent::__construct();
        if (array_key_exists('businessFeature', $this->aPostGet) && !empty($this->aPostGet['businessFeature'])) {
            $this->businessFeature = $this->aPostGet['businessFeature'];
        }
    }

    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_GENERIC_INVENTORY');
    }

    public static function getTabActive() {
        return MLModule::gi()->isConfigured();
    }

    public static function getTabDefault() {
        return true;
    }

    public function prepareData() {
        $result = $this->getInventory();
        if (empty($this->add) && empty($this->updatedelete)) {
            $this->getPendingItems();
        }

        if (!empty($this->add)) {
            foreach ($this->add as $item) {
                if ($item['Mode'] == 'PURGE') {
                    $result['DATA'] = array();
                }
                $item = array_merge(array(
                    'pID' => magnaSKU2pID($item['SKU']),
                    'ItemTitle' => '&mdash;',
                    'Type' => 'add',
                ), $item);

                $this->addProductFromShopDetails($item);

                $item['DateAdded'] = strtotime($item['DateAdded'].' +0000');
                $this->aData[] = $item;
            }
        }

        if (($result !== false) && !empty($result['DATA'])) {
            foreach ($result['DATA'] as $item) {
                if (array_key_exists($item['SKU'], $this->add)) {
                    continue;
                }

                $item['Type'] = 'regular';
                $sTitle = isset($item['Title']) ? $item['Title'] : (isset($item['ItemTitle']) ? $item['ItemTitle'] : '&mdash;');
                $item['ItemTitleShort'] = (strlen($sTitle) > $this->aSetting['maxTitleChars'] + 2) ?
                    (fixHTMLUTF8Entities(substr($sTitle, 0, $this->aSetting['maxTitleChars'])).'&hellip;') :
                    fixHTMLUTF8Entities($sTitle);
                $item['DateAdded'] = ((isset($item['DateAdded'])) ? $item['DateAdded'] : '');

                $this->addProductFromShopDetails($item);

                if (array_key_exists($item['SKU'], $this->updatedelete)) {
                    $tItem = $this->updatedelete[$item['SKU']];
                    if (!empty($tItem['Price'])) {
                        $item['Price'] = $tItem['Price'];
                    }
                    if (!empty($tItem['Quantity'])) {
                        $item['Quantity'] = $tItem['Quantity'];
                    }
                    $item['Type'] = strtolower($tItem['Mode']);
                }

                $this->aData[] = $item;
            }
            unset($result);
        }
    }

    private function addProductFromShopDetails(&$item) {
        $item['ShopProductTitleShort'] = '&mdash;';
        $item['ShopQuantity'] = '&mdash;';
        $item['ShopProductTitle'] = '&mdash;';
        $item['editUrl'] = '';
        $item['exits'] = false;

        $oProduct = MLProduct::factory()->getByMarketplaceSKU($item['SKU']);
        if ($oProduct->exists()) {
            $item['exits'] = true;
            $sTitle = $oProduct->getName();
            $item['ShopProductTitleShort'] = (strlen($sTitle) > $this->aSetting['maxTitleChars'] + 2) ?
                (fixHTMLUTF8Entities(substr($sTitle, 0, $this->aSetting['maxTitleChars'])).'&hellip;') :
                fixHTMLUTF8Entities($sTitle);
            $item['ShopProductTitle'] = $sTitle;
            $item['editUrl'] = $oProduct->getEditLink();
            $item['ShopQuantity'] = $oProduct->getStock();
            try {
                $item['ShopPrice'] = $oProduct->getShopPrice();
            } catch (Exception $e) {
                $item['ShopPrice'] = '&mdash;';
                MLMessage::gi()->addDebug($e);
            }
        }
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
                'Getter' => null,
                'Field' => 'ShopProductTitle',
            ),
            'MarketplaceTitle' => array(
                'Label' => $oI18n->ML_AMAZON_LABEL_TITLE,
                'Sorter' => 'title',
                'Getter' => null,
                'Field' => 'ItemTitle',
            ),
            'ASIN' => array(
                'Label' => $oI18n->ML_AMAZON_LABEL_ASIN,
                'Sorter' => 'asin',
                'Getter' => 'getASINLink',
                'Field' => null,
            ),
            'Price' => array(
                'Label' => $oI18n->ML_AMAZON_LABEL_AMAZON_PRICE,
                'Sorter' => 'price',
                'Getter' => 'getItemPrice',
                'Field' => null,
            ),
            'BusinessPrice' => array(
                'Label' => $oI18n->ML_AMAZON_LABEL_BUSINESS_PRICE,
                'Sorter' => 'businessprice',
                'Getter' => 'getBusinessPrice',
                'Field' => null,
            ),
            'Quantity' => array(
                'Label' => $oI18n->ML_AMAZON_LABEL_QUANTITY,
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
            'BusinessFeature' => array(
                'Label' => $oI18n->ML_AMAZON_LABEL_BUSINESS_FEATURE,
                'Sorter' => null,
                'Getter' => 'getBusinessFeature',
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

    protected function getSortOpt() {
        if (isset($this->aPostGet['sorting'])) {
            $sorting = $this->aPostGet['sorting'];
        } else {
            $sorting = 'blabla'; // fallback for default
        }
        //ToDo
        $sortFlags = array(
            'sku' => 'SKU',
            'asin' => 'ASIN',
            'title' => 'Title',
            'price' => 'Price',
            'businessprice' => 'BusinessPrice',
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

    protected function getSKU($item) {
        $addStyle = (empty($item['ItemTitle']) || $item['ItemTitle'] === '&mdash;' && $item['SKU'] !== '&mdash;') ? 'color:#e31e1c;' : '';
        $html = '<td>'.$item['SKU'].'</td>';
        if (!empty($item['editUrl'])) {
            $html = '<td><div class="product-link" ><a style="'. $addStyle .'" class="ml-js-noBlockUi" href="'.$item['editUrl'].'" target="_blank" title="'.MLI18n::gi()->ML_LABEL_EDIT.'">'.$item['SKU'].'</a></div></td>';
        }

        return $html;
    }

    protected function getASINLink($item) {
        if (empty($item['ASIN'])) {
            return '<td>&mdash;</td>';
        }

        $countryCodeToDomain = array(
            'JP' => 'co.jp',
            'US' => 'com',
            'TR' => 'com.tr',
            'AU' => 'com.au',
            'ES' => 'es',
            'UK' => 'co.uk',
            'FR' => 'fr',
            'DE' => 'de',
            'IT' => 'it',
            'CA' => 'ca',
            'NL' => 'nl',
            'SE' => 'se',
            'PL' => 'pl',
            'SG' => 'sg',
        );
        $country = MLModule::gi()->getConfig('site');
        if(isset($countryCodeToDomain[$country])) {
            $sUrl = "https://www.amazon.".$countryCodeToDomain[$country]."/dp/".$item['ASIN'];
        } else {
            $sUrl = "https://www.amazon.de/dp/".$item['ASIN'];
        }
        return
            '<td>
                <a href="'.$sUrl.'" '.'title="'.$this->__('ML_AMAZON_LABEL_PRODUCT_IN_AMAZON').'"
                 class="ml-js-noBlockUi" '.
            'target="_blank">'.$item['ASIN'].'</a>
            </td>';
    }

    /**
     * If for whatever reason we need to retrieve the ASIN Link from the API again, this can be used to batch process
     *
     * @param $asins
     * @return array
     */
    protected function getASINLinks($asins) {
        $asinLinks = array();
        $aItems = MLModule::gi()->amazonLookUp($asins);
        foreach ($aItems as $item) {

            if (!isset($item['ASIN'])) {
                continue;
            }
            if (empty($item) || !isset($item['URL']) || empty($item['URL']) || strpos($item['URL'], $item['ASIN']) === false) {
                $sUrl = "http://www.amazon.de/gp/offer-listing/".$item['ASIN'];
            } else {

                $sUrl = $item['URL'];
            }
            $asinLinks[$item['ASIN']] = '<td>
                <a href="'.$sUrl.'" '.'title="'.$this->__('ML_AMAZON_LABEL_PRODUCT_IN_AMAZON').'"
                 class="ml-js-noBlockUi" '.
                'target="_blank">'.$item['ASIN'].'</a>
            </td>';
        }
        return $asinLinks;
    }

    protected function getQuantities($item) {
        return '<td>'.$item['ShopQuantity'].' / '.$item['Quantity'].'</td>';
    }

    protected function getItemDateAdded($item) {
        if (empty($item['DateAdded'])) {
            return '<td>&mdash;</td>';
        }

        $timestamp = strtotime($item['DateAdded']);
        if ($timestamp < strtotime("2001-01-01")) {
            return '<td>&mdash;</td>';
        }

        return '<td>'.date("d.m.Y", $timestamp).' &nbsp;&nbsp;<span class="small">'.date("H:i", $timestamp).'</span></td>';
    }

    protected function getStatus($item) {
        switch ($item['Type']) {
            case 'add':
                {
                    $html = '
						<td title="'.$this->__('ML_AMAZON_LABEL_ADD_WAIT').'"><img src="'.MLHttp::gi()->getResourceUrl('images/status/grey_dot.png').'" alt="'.$this->__('ML_AMAZON_LABEL_ADD_WAIT').'"/></td>';
                    break;
                }
            case 'update':
                {
                    $html = '
						<td title="'.$this->__('ML_AMAZON_LABEL_EDIT_WAIT').'"><img src="'.MLHttp::gi()->getResourceUrl('images/status/blue_dot.png').'" alt="'.$this->__('ML_AMAZON_LABEL_EDIT_WAIT').'"/></td>';
                    break;
                }
            case 'delete':
            case 'sysdelete':
                {
                    $html = '
						<td title="'.$this->__('ML_AMAZON_LABEL_DELETE_WAIT').'"><img src="'.MLHttp::gi()->getResourceUrl('images/status/red_dot.png').'" alt="'.$this->__('ML_AMAZON_LABEL_DELETE_WAIT').'"/></td>';
                    break;
                }
            default:
                {
                    $html = '
						<td title="'.$this->__('ML_AMAZON_LABEL_IN_INVENTORY').'"><img src="'.MLHttp::gi()->getResourceUrl('images/status/green_dot.png').'" alt="'.$this->__('ML_AMAZON_LABEL_IN_INVENTORY').'"/></td>';
                }
        }

        return $html;
    }

    protected function getBusinessPrice($item) {
        if (!isset($item['BusinessPrice']) || empty($item['BusinessPrice'])) {
            return '<td>&mdash;</td>';
        }

        $item['Currency'] = isset($item['Currency']) ? $item['Currency'] : $this->sCurrency;
        return '<td>'.MLPrice::factory()->format($item['BusinessPrice'], $item['Currency']).'</td>';
    }

    protected function getBusinessFeature($item) {
        $bB2B = true;
        $bB2C = true;
        if (!isset($item['BusinessPrice']) || empty($item['BusinessPrice'])) {
            $bB2B = false;
        }
        if (!isset($item['Price']) || empty($item['Price'])) {
            $bB2C = false;
        }

        if ($bB2B && $bB2C) {
            $sKey = 'AMAZON_BUSINESS_B2B_B2C';
        } elseif ($bB2B) {
            $sKey = 'AMAZON_BUSINESS_B2B';
        } else {
            $sKey = 'AMAZON_BUSINESS_STANDARD';
        }

        return '<td>'.MLI18n::gi()->get($sKey).'</td>';
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
                MagnaConnector::gi()->submitRequest(array(
                    'ACTION' => 'ImportInventory'
                ));
                MLModule::gi()->setConfig('inventory.import', time());
            } catch (MagnaException $e) {
            }
        } else if (isset($this->aPostGet['listing']['refresh'])) {
            try {
                $oService = MLService::getSyncInventoryInstance();
                if (function_exists('ml_debug_out')) {
                    ml_debug_out("\n\n\n#####\n## Sync Amazon ($this->iMpId) with class ".get_class($oService)."\n##\n");
                }
                $oService->execute();
            } catch (MLAbstract_Exception $oEx) { // not implemented
                $this->out("\n{#" . base64_encode(json_encode(array_merge(array('Marketplace' => MLModule::gi()->getMarketPlaceName(), 'MPID' => MLModule::gi()->getMarketPlaceId(),), array('Complete' => 'true',)))) . "#}\n\n");
            } catch (Exception $oEx) {
                $this->out($oEx->getMessage());
            }
        } else if (array_key_exists('GetErrorLog', $this->aPostGet) && preg_match('/^[0-9]*$/', $this->aPostGet['GetErrorLog'])) {
            $request = array();
            $request['ACTION'] = 'GetErrorLog';
            $request['BATCHID'] = $this->aPostGet['GetErrorLog'];

            try {
                $result = MagnaConnector::gi()->submitRequest($request);
                echo print_m($result, 'GetErrorLog');
            } catch (MagnaException $e) {

            }
        }

        $this->getSortOpt();

        if (isset($this->aPostGet['page']) && ctype_digit($this->aPostGet['page'])) {
            $this->iOffset = ($this->aPostGet['page'] - 1) * $this->aSetting['itemLimit'];
        } else {
            $this->iOffset = 0;
        }
    }

    protected function getInventory() {
        try {
            $request = array(
                'ACTION' => 'GetInventory',
                'LIMIT' => $this->aSetting['itemLimit'],
                'OFFSET' => $this->iOffset,
                'ORDERBY' => $this->aSort['order'],
                'SORTORDER' => $this->aSort['type']
            );

            if (!empty($this->search)) {
                $request['SEARCH'] = $this->search;
            }

            if (!empty($this->businessFeature)) {
                $request['FILTERBUSINESS'] = $this->businessFeature;
            }

            #echo print_m($request);
            $result = MagnaConnector::gi()->submitRequest($request);
            if ($result['LATESTCHANGE']) {
                $latestReport = strtotime($result['LATESTCHANGE'].' +0000');
                MLModule::gi()->setConfig('inventory.import', $latestReport);
            }
            if ($result['LATESTREPORT']) {
                $latestReport = strtotime($result['LATESTREPORT'].' +0000');
                if (MLModule::gi()->getConfig('inventory.import') != $latestReport) {
                    $this->getPendingItems();
                }

                MLModule::gi()->setConfig('inventory.import', $latestReport);
            }
            $this->iNumberofitems = (int)$result['NUMBEROFLISTINGS'];
            return $result;

        } catch (MagnaException $e) {
            return array();
        }
    }

    private function getPendingItems() {
        //*
        if ($this->getPendingItemsCalled) {
            return;
        }
        //*/
        $this->getPendingItemsCalled = true;

        /* Gibt es neue Listings? */
        $this->add = array();
        $this->updatedelete = array();
        $request = array(
            'ACTION' => 'GetPendingItems',
        );

        if (!empty($this->businessFeature)) {
            $request['FILTERBUSINESS'] = $this->businessFeature;
        }

        try {
            $result = MagnaConnector::gi()->submitRequest($request);
        } catch (MagnaException $e) {
            $result = array('DATA' => false);
        }
        #echo print_m($result);
        if (is_array($result['DATA']) && !empty($result['DATA'])) {
            foreach ($result['DATA'] as $item) {
                /* Get some more informations */
                if (($item['Mode'] == 'ADD') || ($item['Mode'] == 'PURGE')) {
                    $oMLProduct = MLProduct::factory();
                    if ($oMLProduct->getByMarketplaceSKU($item['SKU'])->exists() || $oMLProduct->getByMarketplaceSKU($item['SKU'], true)->exists()) {
                        $item['ShopItemName'] = strip_tags($oMLProduct->getName());
                    } else {
                        $item['ShopItemName'] = '--';
                    }
                    unset($item['BatchID']);
                    $this->add[$item['SKU']] = $item;
                } else {
                    unset($item['BatchID']);
                    $this->updatedelete[$item['SKU']] = $item;
                }
            }
        }
    }
}
