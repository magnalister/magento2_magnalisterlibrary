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

class ML_Metro_Controller_Metro_Listings_Deleted extends ML_Listings_Controller_Widget_Listings_InventoryAbstract {

    protected $aParameters = array('controller');

    public function __construct() {
        parent::__construct();
        $this->additionalParameters['ONLY_DELETED'] = true;
    }


    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_GENERIC_DELETED');
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
                'Getter' => 'getSKU',
                'Field' => null,
            ),
            'Title' => array(
                'Label' => $oI18n->ML_LABEL_SHOP_TITLE,
                'Sorter' => null,
                'Getter' => 'getItemShopTitle',
                'Field' => null,
            ),
            'Category' => array(
                'Label' => $oI18n->ML_LABEL_CATEGORY_PATH,
                'Sorter' => null,
                'Getter' => 'getCategoryPath',
                'Field' => null,
            ),
            'Price' => array(
                'Label' => $oI18n->ML_GENERIC_OLD_PRICE,
                'Sorter' => null,
                'Getter' => 'getItemPrice',
                'Field' => null,
            ),
            'DateDeleted' => array(
                'Label' => $oI18n->ML_GENERIC_DELETEDDATE,
                'Sorter' => 'dateadded',
                'Getter' => 'getItemDateDeleted',
                'Field' => null,
            )
        );
    }

    public function prepareData() {
        $result = $this->getInventory();
        if (($result !== false) && !empty($result['DATA'])) {
            $this->aData = $result['DATA'];
            foreach ($this->aData as &$item) {
                $item['SKU'] = html_entity_decode(fixHTMLUTF8Entities($item['SKU']));
                $item['aProductData'] = unserialize($item['ProductData']);
                $item['ItemTitle'] = fixHTMLUTF8Entities($item['aProductData']['Title']);
                $item['Currency'] = 'EUR'; //always EUR for now
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
                    $item['ShopTitle'] = $oProduct->getName();
                    $item['editUrl'] = $oProduct->getEditLink();
                    $item['category'] = $oProduct->getCategoryPath();
                } catch (Exception $oExc) {
                    $item['ShopQuantity'] = $item['ArticleSKU'] = $item['category'] = $item['ShopPrice'] = $item['ShopTitle'] = '&mdash;';
                    $item['ProductsID'] = 0;
                    $item['editUrl'] = '';
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
                        'ShippingCost' => array('optional' => array('active' => true))
                    ), 'value');
                    $item['ShippingCost'] = $aPrepareData['ShippingCost'];
                } catch (Exception $oExcc) {
                    $item['ShippingCost'] = 0.00;
                }
            }
            unset($result);
        }
    }

    protected function getItemShopTitle($item) {
        return '<td>' . $item['ShopTitle'] . '</td>';
    }

    protected function getCategoryPath($item) {
        return '<td>' . $item['category'] . '</td>';
    }

    protected function getItemDateDeleted($item) {
        return '<td>' . date("d.m.Y", $item['LastSync']) . ' &nbsp;&nbsp;<span class="small">' . date("H:i:s", $item['LastSync']) . '</span></td>';
    }

    protected function getItemPrice($item) {
        $renderedMpPrice = ((isset($item['Currency']) && isset($item['Price']) && 0 != $item['Price'])
            ? MLPrice::factory()->format($item['Price'], $item['Currency']) : '&mdash;');
        return '<td>' . $renderedMpPrice . '</td>';
    }
}
