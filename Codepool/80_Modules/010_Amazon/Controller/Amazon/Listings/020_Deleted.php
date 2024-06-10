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
MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_DeletedAbstract');
class ML_Amazon_Controller_Amazon_Listings_Deleted extends ML_Listings_Controller_Widget_Listings_DeletedAbstract {

    protected $aParameters = array('controller');

    public $delFromDate;
    public $deToDate;

    public function __construct() {
        parent::__construct();
        $aPost = MLHttp::gi()->getRequest();
        $this->aSetting['maxTitleChars'] = 40;

        $this->delFromDate = mktime(0, 0, 0, date('n'), 1, date('Y'));
        $this->deToDate = mktime(23, 59, 59, date('n'), date('j'), date('Y'));

        if (isset($aPost['date']['from'])) {
            $this->delFromDate = strtotime($aPost['date']['from']);
        }

        if (isset($aPost['date']['to'])) {
            $this->deToDate = strtotime($aPost['date']['to']);
            $this->deToDate += 24 * 60 * 60 - 1;
        }
    }

    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_GENERIC_DELETED');
    }

    public static function getTabActive() {
        return MLModule::gi()->isConfigured();
    }

    public function initAction(){
        if (array_key_exists('GetErrorLog', $this->aPostGet) && preg_match('/^[0-9]*$/', $this->aPostGet['GetErrorLog'])) {
            $request = array();
            $request['ACTION'] = 'GetErrorLog';
            $request['BATCHID'] = $this->aPostGet['GetErrorLog'];

            try {
                $result = MagnaConnector::gi()->submitRequest($request);
                echo print_m($result, 'GetErrorLog');
            } catch (MagnaException $e) {
                echo print_m($e);
            }
        }
    }

    public function prepareData() {
        $this->aData = $this->getDeteltedItems();
    }

    public function getFields() {
        return array(
            'Title' => array(
                'Label' => ML_LABEL_SHOP_TITLE,
                'Sorter' => null,
                'Field' => 'ShopItemName',
            ),
            'ASIN' => array(
                'Label' => ML_AMAZON_LABEL_ASIN,
                'Sorter' => null,
                'Getter' => 'getASINLink',
                'Field' => null,
            ),
            'Price' => array(
                'Label' => ML_AMAZON_LABEL_AMAZON_PRICE,
                'Sorter' => null,
                'Getter' => 'getItemPrice',
                'Field' => null,
            ),
            'Quantity' => array(
                'Label' => ML_AMAZON_LABEL_QUANTITY,
                'Sorter' => null,
                'Getter' => 'getQuantities',
                'Field' => null,
            ),
            'timestamp' => array(
                'Label' => ML_GENERIC_DELETEDDATE,
                'Sorter' => null,
                'Getter' => 'getItemDateAdded',
                'Field' => null
            ),
            'Status' => array(
                'Label' => ML_GENERIC_STATUS,
                'Sorter' => null,
                'Getter' => 'getStatus',
                'Field' => null,
            )
        );
    }

    protected function getASINLink($item) {
        if (empty($item['ASIN'])) {
            return '<td>&mdash</td>';
        }

        $aItem = MLModule::gi()->amazonLookUp($item['ASIN']);
        if(empty($aItem) || !isset($aItem[0]['URL']) || empty($aItem[0]['URL']) || strpos($aItem[0]['URL'], $aItem[0]['ASIN']) === false){
            $sUrl =  "http://www.amazon.de/gp/offer-listing/" ;
        }else{
            $sUrl = str_replace($aItem[0]['ASIN'],'',$aItem[0]['URL']) ;
        }

        return
            '<td>
                <a href="'.$sUrl.$item['ASIN'].'" '. 'title="'.$this->__('ML_AMAZON_LABEL_PRODUCT_IN_AMAZON').'"
                 class="ml-js-noBlockUi" '.
            'target="_blank">'.$item['ASIN'].'</a>
            </td>';
    }

    protected function getItemPrice($item) {
        $item['Currency'] = isset($item['Currency']) ? $item['Currency'] : $this->sCurrency;
        return '<td>'.MLPrice::factory()->format($item['Price'], $item['Currency']).'</td>';
    }

    protected function getQuantities($item) {
        return '<td>' . $item['ShopQuantity'] . ' / ' . $item['Quantity'] . '</td>';
    }

    protected function getItemDateAdded($item) {
        if (empty($item['DateAdded'])) {
            return '<td>&mdash</td>';
        }

        return '<td>'.date("d.m.Y", $item['DateAdded']).' &nbsp;&nbsp;<span class="small">'.date("H:i", $item['DateAdded']).'</span>'.'</td>';
    }

    protected function getStatus($item) {
        return '<td title="' . $this->__('ML_GENERIC_DELETED') . '">
        <img src="' . MLHttp::gi()->getResourceUrl('images/status/green_dot.png') . '" alt="' . $this->__('ML_GENERIC_DELETED') . '"/></td>';
    }

    private function getDeteltedItems() {
        try {
            $result = MagnaConnector::gi()->submitRequest(array(
                'ACTION' => 'GetDeletedItemsForDateRange',
                'BEGIN' => date('Y-m-d H:i:s', $this->delFromDate),
                'END' => date('Y-m-d H:i:s', $this->deToDate),
            ));
        } catch (MagnaException $e) {
            return false;
        }

        if (!array_key_exists('DATA', $result) || empty($result['DATA'])) {
            return array();
        }

        foreach ($result['DATA'] as &$item) {
            $item['DateAdded'] = strtotime($item['DateAdded'] . ' +0000');
            $oProduct = MLProduct::factory();
            if (!($oProduct->getByMarketplaceSKU($item['SKU'])->exists() || $oProduct->getByMarketplaceSKU($item['SKU'], true)->exists()) && !empty($item['ASIN'])) {
                $iPIDbyASIN = MLDatabase::factory('amazon_prepare')->getByIdentifier($item['ASIN'], 'asin');
                $oProduct->set('id', $iPIDbyASIN);
            }

            if ($oProduct->exists()) {
                $item['ShopItemName'] = $oProduct->getName();
                $item['ShopItemNameShort'] = (
                (strlen($item['ShopItemName']) > $this->aSetting['maxTitleChars'] + 2) ?
                    (fixHTMLUTF8Entities(substr($item['ShopItemName'], 0, $this->aSetting['maxTitleChars']), ENT_COMPAT) . '&hellip;') :
                    fixHTMLUTF8Entities($item['ShopItemName'], ENT_COMPAT)
                );
                $item['ShopItemName'] = fixHTMLUTF8Entities($item['ShopItemName'], ENT_COMPAT);

                $item['ShopQuantity'] = $oProduct->getStock();
            } else {
                $item['ShopItemName'] = $item['ShopItemNameShort'] = '&mdash;';
                $item['ShopQuantity'] = '&mdash;';
            }
        }

        return $result['DATA'];
    }
}