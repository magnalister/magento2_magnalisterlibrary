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

MLFilesystem::gi()->loadClass('Productlist_Controller_Widget_ProductList_Abstract');

class ML_Amazon_Controller_Amazon_Prepare_Match_Manual extends ML_Productlist_Controller_Widget_ProductList_Abstract {
    protected $blRenderVariants = true;
    protected $aParameters = array('controller');
    //protected $aParameters = array('mp', 'mode', 'view', 'execute');

    public function __construct() {
        parent::__construct();
        $aStatistic = $this->getProductList()->getStatistic();
        if ($aStatistic['iCountTotal'] == 0 && !MLSetting::gi()->blPreventRedirect) {
            MLHttp::gi()->redirect($this->getParentUrl());
        }
    }

    protected function callAjaxAmazonItemSearch() {
        $oRequest = MLRequest::gi();
        $oProduct = MLProduct::factory()->set('id', $oRequest->data('id'));
        if (!in_array($oRequest->data('search'), array(null, ''))) {
            $sName = $oRequest->data('search');
            $sEan = null;
        } else {
            $sName = $oProduct->getName();
            $sEan = $oProduct->getModulField('general.ean', true);
        }
        $sContent = $this->includeViewBuffered(
            'widget_productlist_list_variantarticleadditional_amazon_itemsearch',
            array(
                'oProduct'    => $oProduct,
                'aAdditional' => array('aAmazonResult' => MLModule::gi()->performItemSearch(null, $sEan, $sName))
            )
        );
        MLSetting::gi()->add(
            'aAjax', array(
                'content' => $sContent,
                'success' => true,
                'error'   => '',
            )
        );
    }

    /**
     * @return ML_Amazon_Helper_Model_Table_Amazon_Prepare_Product|Object
     */
    protected function getPrepareProductHelper() {
        return MLHelper::gi('Model_Table_Amazon_Prepare_Product');
    }

    public function callAjaxUpdate() {
        $aRequest = $this->getRequest();
        //        new dBug($aRequest);
        $aData = json_decode(str_replace("\\\"", "'", str_replace("'", '"', $aRequest['data'])), true);
        $oProduct = MLProduct::factory()->set('id', $aRequest['id'])->load();

        if (is_array($aData) && array_key_exists('LowestPrice', $aData) && !is_numeric($aData['LowestPrice'])) {
            $aData['LowestPrice'] = null;
        }

        if (is_array($aData)) {//have amazon data
            // convert BOPIS stores field to json array
            if (array_key_exists('BopisStores', $aRequest['amazonProperties']) && !empty($aRequest['amazonProperties']['BopisStores'])) {
                if (is_string($aRequest['amazonProperties']['BopisStores'])) {
                    $stores = explode(',', $aRequest['amazonProperties']['BopisStores']);
                } else {
                    $stores = $aRequest['amazonProperties']['BopisStores'];
                }

                $aRequest['amazonProperties']['BopisStores'] = json_encode($stores);
            }

            $this->getPrepareProductHelper()->manual($oProduct,
                array_merge($aRequest['amazonProperties'],
                    array(
                        'aidentid'    => $aData['ASIN'],
                        'lowestprice' => $aData['LowestPrice']
                    )
                ))->getTableModel()->save();
        }
        MLSetting::gi()->add(
            'aAjax', array(
                'success' => true,
                'error'   => '',
            )
        );
        if (!MLSetting::gi()->blPreventRedirect) {
            MLDatabase::factory('selection')->set('pid', $oProduct->get('id'))->getList()->getQueryObject()->doDelete();
        }
    }

    public function getPriceObject(ML_Shop_Model_Product_Abstract $oProduct) {
        return MLModule::gi()->getPriceObject();
    }

    public function isSingleMatching() {
        return count($this->getProductList()->getMasterIds()) == 1;
    }
    
    public function getCurrentProduct(){
        $oTable = MLDatabase::factory('selection')->set('selectionname', 'match');
        $oSelectList = $oTable->getList();
        /* @var $oSelectList ML_Database_Model_List */
        $aResult = $oSelectList->getQueryObject()->init('aSelect')->select('parentid')->join(array('magnalister_products','p','pid = p.id'))->getResult();
        $sParent = null;
        foreach ($aResult as $aRow){//show shippingtime , condition and ... if it is single preparation
            if($sParent !== null && $sParent != $aRow['parentid']){
                return null;
            }
            $sParent = $aRow['parentid'];
        }
        $aList = $oTable->getList()->getList();
        $oProduct = MLProduct::factory()->set('id', current($aList)->get('pid'));
        $aPreparedData = MLHelper::gi('Model_Service_Product')->addVariant($oProduct)->getData();
        return current($aPreparedData);
    }
    
    public function getMarketplacePrice($oProduct) {
        if ($oProduct->get('parentid') == 0) {
            if ($oProduct->isSingle()) {
                $oProduct = $this->getFirstVariant($oProduct);
            } else {
                return array(
                    array(
                        'price' => '&dash;'
                    )
                );
            }
        }
        return array(
            array(
                'price' => $oProduct->getSuggestedMarketplacePrice($this->getPriceObject($oProduct), true, true)
            )
        );
    }

    
}
