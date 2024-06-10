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

abstract class ML_Productlist_Controller_Widget_ProductList_Selection extends ML_Productlist_Controller_Widget_ProductList_Abstract {

    protected $aParameters = array('controller');

    public function __construct() {
        parent::__construct();
        $aFilter = $this->oRequest->data('filter');
        if (isset($aFilter['meta']['selection'])) {
            $aSelection = explode('_', $aFilter['meta']['selection']);
            if (count($aSelection) == 2) {
                if ($aSelection[1] == 'page') {
                    $aIds = $this->getProductList()->getMasterIds(true); 
                    if (MLHttp::gi()->isAjax()) {
                        MLSetting::gi()->add('aAjax', array('Redirect' => $this->getCurrentUrl())); 
                    }
                } elseif ($aSelection[1] == 'filter') {
                    if (MLHttp::gi()->isAjax()) {
                        $aStatistic = $this->getProductList()->getStatistic();
                        $iFrom = 0;
                        $iCount = 100; // if its to high, we have fast-cgi problems, perhaps make some output (spaces) after while and flush() them directly
                         if ($this->oRequest->data('selectionlimit') !== null) {
                             list($iFrom, $iCount) = explode('_', $this->oRequest->data('selectionlimit'));
                         }
                        if ($aStatistic['iCountTotal'] > $iCount && $aStatistic['iCountTotal'] > ($iFrom + $iCount)) {
                            MLSetting::gi()->add('aAjax', array(
                                'Next' => $this->getCurrentUrl(array(
                                    'filter'         => $aFilter,
                                    'selectionlimit' => ($iFrom + $iCount)."_".$iCount,
                                ))
                            ));
                        } else {
                            MLSetting::gi()->add('aAjax', array('Redirect' => $this->getCurrentUrl()));
                        }
                        $aIds = $this->getProductList()->setLimit($iFrom,$iCount)->getMasterIds(true);
                    } else {
                        $aIds = $this->getProductList()->getMasterIds();
                    }
                } else {
                    $aIds = null;
                    if (MLHttp::gi()->isAjax()) {
                        MLSetting::gi()->add('aAjax', array('Redirect' => $this->getCurrentUrl())); 
                    }
                }
                if ($aSelection[0] == 'sub') {//delete, we dont need to check article for errors   
                    $this->deleteProductsFromSelection($aIds);   
                }elseif ($aIds !== null) {// have ids but no (delete)query => add items
                    $this->addProductsToSelection($aIds);
                }
            }
        }
    }

    /**
     * @return bool
     */
    public static function getTabActive() {
        return MLModule::gi()->isConfigured();
    }

    /**
     * @return mixed
     * @throws MLAbstract_Exception
     */
    public static function getTabTitle() {
        return MLI18n::gi()->get('ML_GENERIC_PREPARE');
    }

    /**
     * @return bool
     */
    public static function getTabDefault() {
        return true;
    }

    /**
     * @param ML_Shop_Model_Product_Abstract $oProduct
     * @return ML_Shop_Model_Price_Interface
     */
    public function getPriceObject(\ML_Shop_Model_Product_Abstract $oProduct) {
        return MLModule::gi()->getPriceObject();
    }

    /**
     * get count of selected master-articles
     * @return int
     * @throws MLAbstract_Exception
     */
    public function getSelectedCount () {
        return $this->oDB->fetchOne("
            SELECT count(distinct v.parentid)
            FROM magnalister_selection s
            INNER JOIN magnalister_products v on s.pid = v.id
            WHERE 
                s.mpid='" . (int)$this->oRequest->get('mp') . "'
                AND s.selectionname='" . $this->getProductList()->getSelectionName() . "'
                AND s.session_id='" . $this->oDB->escape(MLShop::gi()->getSessionId()) . "'
        ");
    }
    
    public function countSelectedVariants($mProduct) {
        $iMasterProductId = (int)(
            $mProduct instanceof ML_Database_Model_Table_Abstract
            ? $mProduct->get('id')
            : $mProduct
        );
        $sSql = "
            SELECT COUNT(*) 
            FROM magnalister_products p
            INNER JOIN magnalister_selection s ON p.id = s.pid
            WHERE     p.parentid = '".$iMasterProductId."'
                  AND s.mpid = '".$this->oDB->escape($this->oRequest->get('mp'))."'
                  AND s.selectionname = '".$this->getProductList()->getSelectionName()."'
                  AND s.session_id = '".$this->oDB->escape(MLShop::gi()->getSessionId())."'
        ";
        return $this->oDB->fetchOne($sSql);
    }

    protected function callAjaxDeleteFromSelection() {
        $iProductId =  $this->oRequest->get('pid');
        $oProduct = MLDatabase::factory('product')->set('id',$iProductId);
        $this->deleteProductsFromSelection(array($oProduct));
        if ($oProduct->get('parentid') == 0) {
            try {
                $this->oRequest->get('render');
                $this->callAjaxRenderProduct(false);
            } catch (Exception $oEx) {
            }
        }
        $this->includeView('widget_productlist_action_selection_selectionoption', array(
            'sName' => MLI18n::gi()->get(
                'Productlist_Cell_aToMagnalisterSelection_selectedArticlesCountInfo', 
                 array('count' => $this->getSelectedCount())
            )
        ));
        return $this;
    }

    /**
     * @param array $aProducts (values = int?product-id:ML_Shop_Model_Product)
     * @param null $aProducts delete complete selection
     * @return \ML_Productlist_Controller_Widget_ProductList_Selection
     */
    protected function deleteProductsFromSelection($aProducts=null) {
        $oQuery =
            MLDatabase::factory('selection')->set(
                'selectionname',
                 $this->getProductList()->getSelectionName()
            )->getList()
            ->getQueryObject()
        ;
        $aIds = array();
        if ($aProducts !== null) {
            foreach ($aProducts as $oProduct) {//check parent id if model
                $aIds[] = is_object($oProduct) ? $oProduct->get('id') : $oProduct;
            }
            
        }
        if (!empty($aIds)) {// we dont care of master or variant just delete from selection
            $oQuery->where("
                (
                    pID in (select id from magnalister_products where parentid in('".implode("', '",$aIds)."'))
                    || pID in ('".implode("', '",$aIds)."')
                 )
            ");
        }
        
        MLMessage::gi()->addDebug(sprintf(MLI18n::gi()->get('Productlist_Message_sDeleteProducts'), $oQuery->doDelete()));
        return $this;
    }

    /**
     * @param array $aProducts (values = int?product-id:ML_Shop_Model_Product)
     * @param array $aData data-field of selection
     * @return \ML_Productlist_Controller_Widget_ProductList_Selection
     */
    protected function addProductsToSelection($aProducts, $aData = array()) {
        $aVariantIds = array();
        foreach ($aProducts as $oProduct) {
            $oProduct = is_object($oProduct)?$oProduct:MLProduct::factory()->set('id',$oProduct);
            if ($oProduct->get('parentid')==0) {
                $aMessages = array();
                $aMasterProductMessages = MLMessage::gi()->getObjectMessages($oProduct);
                if(count($aMasterProductMessages) > 0){
                    foreach($aMasterProductMessages as $sMessage){
                        $aMessages[$sMessage] = isset($aMessages[$sMessage])?$aMessages[$sMessage]+1:1;
                    }
                    continue;
                }
                if(count($aMasterProductMessages) == 0){//master dont have error we check variants
                    $aVariants=$this->getProductList()->getVariants($oProduct);//$oProduct->getVariants();
                    foreach($aVariants as $oVariant){
                        if (count(MLMessage::gi()->getObjectMessages($oVariant))>0) {//variant have message
                            foreach(MLMessage::gi()->getObjectMessages($oVariant) as $sMessage){
                                $aMessages[$sMessage] = isset($aMessages[$sMessage])?$aMessages[$sMessage]+1:1;
                            }
                        }
                    }
                }
                if (count($aMessages) == 0) {//any message now?
                    foreach($aVariants as $oVariant){
                        $aVariantIds[] = $oVariant->get('id');
                    }
                }
            } else {
                $blSelectable=false;
                if (count(MLMessage::gi()->getObjectMessages($oProduct)) == 0) {//variant dont have error
                    $blSelectable = $this->productSelectable($oProduct,false);// adding message
                }
                if ($blSelectable && count(MLMessage::gi()->getObjectMessages($oProduct)) == 0) {
                    $aVariantIds[] = $oProduct->get('id');
                }
            }
        }

        foreach ($aMessages as $message => $count) {
            MLMessage::gi()->addWarn($message);
        }

        if (!empty($aVariantIds)) {
            $sSelectionName=$this->getProductList()->getSelectionName();
            $oModel = MLDatabase::factory('selection');
            foreach ($aVariantIds as $sId) {
                $oModel->init()->set('selectionname', $sSelectionName)->set('pid', $sId)->set('data', $aData)->save();
            }
            MLMessage::gi()->addDebug(sprintf(MLI18n::gi()->get('Productlist_Message_sEditProducts'), count($aVariantIds)));
        }
        return $this;
    }

    protected function callAjaxAddToSelection() {
        $iProductId =  $this->oRequest->get('pid');
        $aData=$this->getRequest('selection');
        $oProduct = MLProduct::factory()->set('id',$iProductId);
        $this->addProductsToSelection(array($oProduct), isset($aData['data']) && is_array($aData['data']) ? $aData['data'] : array());
        if ($oProduct->get('parentid') == 0) {
            try{
                $this->oRequest->get('render');
                $this->callAjaxRenderProduct(false);
            } catch (Exception $oEx){
            }
        }
        $this->includeView('widget_productlist_action_selection_selectionoption', array(
            'sName' => MLI18n::gi()->get(
                'Productlist_Cell_aToMagnalisterSelection_selectedArticlesCountInfo', 
                 array('count' => $this->getSelectedCount())
            )
        ));

        return $this;
    }

    /**
     * checks if product is selectable
     * @param ML_Shop_Model_Product_Abstract $oProduct can be master or variant
     * @param bool $blForRender selectable for rendering(checkbox), if false for selectlist(table)
     */
    public function productSelectable(\ML_Shop_Model_Product_Abstract $oProduct, $blRender) {
        return !$blRender || $oProduct->get('parentid') == 0;
    }

    /**
     * @return $this|ML_Core_Controller_Abstract
     * @throws Exception
     */
    public function getProductListWidget() {
        try {
            if ($this->isCurrentController()) {
                return parent::getProductListWidget();
            }
            return $this->getChildController('form')->render();
        } catch (Exception $oExc) {
            MLMessage::gi()->addDebug($oExc);
            if ($oExc->getCode() == 1550742082) {
                MLMessage::gi()->addFatal($oExc);
                return $this;
            }
            MLHttp::gi()->redirect($this->getParentUrl(), 302, array('Exception'=>$oExc->getCode().':'.$oExc->getMessage() . "\n" . $oExc->getTraceAsString()));
        }

        return $this;
    }

}
