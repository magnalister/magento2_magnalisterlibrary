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

MLFilesystem::gi()->loadClass('Productlist_Controller_Widget_ProductList_Selection');

abstract class ML_Productlist_Controller_Widget_ProductList_UploadAbstract extends ML_Productlist_Controller_Widget_ProductList_Selection {

    protected $aPrepare = array();

    public function getPrepareData(ML_Shop_Model_Product_Abstract $oProduct){
        if(!isset($this->aPrepare[$oProduct->get('id')])){
            $sMpName = MLModule::gi()->getMarketPlaceName();
            $this->aPrepare[$oProduct->get('id')]=MLDatabase::factory($sMpName.'_prepare')->set('productsid',$oProduct->get('id'));
        }
        return $this->aPrepare[$oProduct->get('id')];
    }
    
    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_GENERIC_CHECKIN');
    }

    protected function addItems($blPurge) {
        $oList = $this->getProductList()->setAdditemMode(true);
        $mOffset = $this->getRequest('offset');
        $iOffset = ($mOffset === null) ? 0 : $mOffset;
        $iLimit = 1;//min from list
        $oList->setLimit(0, $iLimit);//offset is 0, because uploaded products will be deleted from selections
        $aStatistic = $oList->getStatistic();
        $iTotal =  (int)$aStatistic['iCountTotal'];
        $oService =  MLService::getAddItemsInstance();
        try {
            $oService->setProductList($oList)->setPurge($blPurge)->execute();
            $blSuccess = true;
        } catch (Exception $oEx) {//more
            MLMessage::gi()->addDebug($oEx);
            $blSuccess = false;
        }
        
        // In case selection list is empty, send back success response.
        if ($oList->getList()->count() === 0) {
            MLSetting::gi()->add(
                'aAjax', array(
                    'success' => true,
                    'error' => '',
                    'offset' => 0,
                    'info' => array(
                        'total' => 0,
                        'current' => 0,
                        'purge' => false,
                    ),
                )
            );
            
            return $this;
        }
        
        if ($oService->haveError()) {
            $sMessage = '';
            foreach ($oService->getErrors() as $sServiceMessage) {
                $sMessage .= '<div>' . $sServiceMessage . '</div>';
            }
            $this->showErrorInPopupProgressBar($sMessage);
        }
        if ($this->getRequest('saveSelection') != 'true') {
            MLSetting::gi()->add(
                'aAjax',
                array(
                    'success' => $blSuccess,
                    'error' => $oService->haveError() ,
                    'offset' => $iOffset+count($oList->getMasterIds(true)),
                    'info' => array(
                        'total' => $iTotal+$iOffset,
                        'current' => $iOffset+count($oList->getMasterIds(true)),
                        'purge' => ($blPurge && $iOffset == 0),
                    ),
                )
            );
            $oSelection = MLDatabase::factory('selection');
            foreach ($oList->getList() as $oProduct) {
                foreach ($oList->getVariants($oProduct) as $oChild) {
                    $oSelection->init()->loadByProduct($oChild,'checkin')->delete();
                }
            }
        } else {
            MLSetting::gi()->add(
                'aAjax',
                array(
                    'success' => false,
                    'error' => $oService->haveError() ,
                    'offset' => $iOffset,
                    'info' => array(
                        'total' => $iTotal+$iOffset,
                        'current' => $iOffset,
                        'purge' => $blPurge,
                    ),
                )
            );
        }
        return $this;
    }

    public function getStock(ML_Shop_Model_Product_Abstract $oProduct) {
        $aStockConf = MLModule::gi()->getStockConfig();
        $iMax = isset($aStockConf['max']) && $aStockConf['max'] > 0 ? $aStockConf['max'] : null;
        return $oProduct->getSuggestedMarketplaceStock($aStockConf['type'], $aStockConf['value'], $iMax);
    }
    
    protected function callAjaxCheckinAdd() {
        return $this->addItems(false);
        
    }
    protected function callAjaxCheckinPurge() {
        return $this->addItems(true);
    }
    
    public function render(){
        $this->getProductListWidget();
        return $this;
    }

    public function getProductListWidget() {
        $sListName = $this->getListName();
        if (strpos($sListName, 'checkin') !== false && count($this->getProductList()->getMasterIds(true))==0) {//only check current page
            MLMessage::gi()->addInfo(MLI18n::gi()->get('Productlist_No_Prepared_Products', array('marketplace' => MLModule::gi()->getMarketPlaceName(false))));
        }
        parent::getProductListWidget();
    }

}
