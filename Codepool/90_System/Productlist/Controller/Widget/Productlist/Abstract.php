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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');
abstract class ML_Productlist_Controller_Widget_ProductList_Abstract extends ML_Core_Controller_Abstract {
    /**
     * render actual variants
     * @var bool $blRenderVariants
     */
    protected $blRenderVariants = false;
    /**
     * calclulates error of actual variants, variants will be loaded
     * @var bool $blRenderVariantsError
     */
    protected $blRenderVariantsError = false;
    /**
     * @var ML_Productlist_Model_ProductList_Abstract
     */
    protected $oList=null;
    /**
     * @throws Exception list ist not possible
     * @return string
     */
    protected function getListName(){
        return $this->getIdent();
    }
    /**
     * render product html
     * @param bool $blRenderVariants should variants rendered too... if master?
     * @return array
     */
    protected function callAjaxRenderProduct($blRenderVariants=true){
        $iProductId =  $this->oRequest->get('pid');
        $blRenderVariantsBackup = $this->blRenderVariants;
        $this->blRenderVariants = $blRenderVariants;
        $blRenderVariantsErrorBackup = $this->blRenderVariantsError;
        $this->blRenderVariantsError = true;
        $oProduct = MLProduct::factory()->set('id',$iProductId);
        MLSetting::gi()->add('aAjaxPlugin', array('dom' => array('#productlist-master-'.$oProduct->get('id') => $this->includeViewBuffered('widget_productlist_list_article', array('oList' => $this->getProductList(), 'oProduct' => $oProduct)))));
        $this->blRenderVariants = $blRenderVariantsBackup;
        $this->blRenderVariantsError = $blRenderVariantsErrorBackup;
        if (count(MLMessage::gi()->getObjectMessages($oProduct)) != 0) {//product have error
            MLSetting::gi()->add('aAjaxPlugin', array('success'=> false ));
        }
        return $this;
    }
    
    public function callAjaxDependency () {
        try {
            MLProductList::dependencyInstance($this->oRequest->get('dependency'))->callAjax();
        } catch (Exception $oEx) {
        }
        return $this;
    }

    /**
     * sets productlist filter by request or session
     * save possible filters to session
     * @return $this
     */
    protected function setFilter(){
        $aRequestFilter=$this->oRequest->data('filter');
        $sIdent = MLModule::gi()->getMarketPlaceId() . '_' . $this->getIdent();
        $aFilters=array();
        if($aRequestFilter!==null){
            $aFilters[$sIdent]=$aRequestFilter;
        }
        $sSessionKey = 'PRODUCTLIST__filter_' . $sIdent . '.json';
        $aSessionFilter = MLSession::gi()->get($sSessionKey);
        if(is_array($aSessionFilter)){
            foreach($aSessionFilter as $sController=>$aFilter){
                if(substr($sIdent, 0, strlen($sController))==$sController&&!isset($aFilters[$sController])){
                    $aFilters[$sController]=$aFilter;
                }
                if(
                    (
                        $aRequestFilter===null
                        ||
                        count($aRequestFilter)==1 && isset($aRequestFilter['meta'])
                    )
                    && $sController==$sIdent
                ){
                    if(isset($aRequestFilter['meta'])){
                        $aFilter['meta']=$aRequestFilter['meta'];
                    }
                    $aRequestFilter=$aFilter;
                }
            }
        }
        MLSession::gi()->set($sSessionKey, $aFilters);
        $this->getProductList()->setFilters($aRequestFilter);
        return $this;
    }


    public function __construct(){
        parent::__construct();
        $oModul = MLModule::gi();
        if ($oModul->getConfig('currency') !== null && (boolean)$oModul->getConfig('exchangerate_update')) {
            try {
                MLCurrency::gi()->updateCurrencyRate($oModul->getConfig('currency'));
            } catch(Exception $oEx) {}
        }
        MLSetting::gi()->add('productListProfile_'.$this->getIdent(), array('construct' => microtime(true)));
        $this->getProductList();//ML_Filesystem_Exception
        $this->setFilter();
    }

    /**
     * @return ML_Productlist_Model_ProductList_Abstract
     * @throws Exception
     */
    public function getProductList(){
        if($this->oList===null){
            $this->oList=MLProductList::gi($this->getListName());
        }
        return $this->oList;
    }

    /**
     * includes View/widget/productlist.php
     */
    public function getProductListWidget() {
        $oList = $this->getProductList();
        $aDependencies = array();
        foreach ($oList->getFilters() as $oFilter) {
            if (is_object($oFilter)) {
                $aDependencies[get_class($oFilter)] = $oFilter->getFilterValue();
            }
        }
        $aStatistic = $oList->getStatistic();
        MLSetting::gi()->add('productListProfile_'.$this->getIdent(), array('endquery' => microtime(true)));
        $this->includeView('widget_productlist', array('oList' => $oList, 'aStatistic' => $aStatistic));
        MLSetting::gi()->add('productListProfile_'.$this->getIdent(), array('endrender' => microtime(true)));
        $aProfile = MLSetting::gi()->get('productListProfile_'.$this->getIdent());
        MLMessage::gi()->addDebug('ProductList Profile: '.$this->getIdent(), array(
            'time-query' => $aProfile['endquery']-$aProfile['construct'], 
            'time-render' => $aProfile['endrender'] - $aProfile['endquery'] - $aProfile['construct'],
            'statistic' => $aStatistic,
            'dependencies' => $aDependencies,
        ));
    }
    
    public function renderVariants() {
        return $this->blRenderVariants;
    }
    public function renderVariantsError() {
        return $this->blRenderVariantsError||$this->renderVariants();
    }
    
    public function getVariantCount($mProduct) {
        if (!($mProduct instanceof ML_Shop_Model_Product_Abstract)) {
            $mProduct = MLProduct::factory()->set('id',$mProduct);
        }
        return $mProduct->getVariantCount();
    }
    /**
     * gets form action for each row
     * @param $oProduct  ML_Shop_Model_Product_Abstract
     * @return string url
     */ 
    public function getRowAction(ML_Shop_Model_Product_Abstract $oProduct) {
        return $this->getCurrentUrl(array('ajax'=>true,'pid'=>$oProduct->get('id')));
    }
    
    /**
     * configure price for marketplace
     * maybe marketplace have differnt price-configs (eg. ebay) - so price can be depend on prepare-table
     * @param ML_Shop_Model_Product_Abstract $oProduct for seraching in prepare-table
     * @return ML_Shop_Model_Price_Interface
     */
    abstract public function getPriceObject(ML_Shop_Model_Product_Abstract $oProduct);
    
    public function getMarketplacePrice($oProduct) {
        if ($oProduct->get('parentid') == 0) {
            if ($oProduct->isSingle()) {
                $oProduct = $this->getFirstVariant($oProduct);
            } else {
                return array(
                    array(
                        'price' => '&mdash;'
                    )
                );
            }
        }
        $sSql = "
            SELECT COUNT(*)
              FROM ".MLDatabase::getPrepareTableInstance()->getTableName()." prepare
             WHERE     " . MLDatabase::getPrepareTableInstance()->getMarketplaceIdFieldName() . " = '" . MLModule::gi()->getMarketPlaceId() . "'
                   AND ".MLDatabase::getPrepareTableInstance()->getProductIdFieldName()." = ".(int)$oProduct->get('id')."
        ";
        $aResult = $this->oDB->fetchOne($sSql);

        if ($aResult > 0) {
            return array(
                array(
                    'price' => $oProduct->getSuggestedMarketplacePrice($this->getPriceObject($oProduct), true, true)
                )
            );
        } else {
            return array(
                array(
                    'price' => MLI18n::gi()->Productlist_Cell_sNotPreparedYet
                )
            );
        }
    }
    
    protected function getFirstVariant($oProduct){        
        $oVariant = current($oProduct->getVariants());
        if(is_object($oVariant)){
            $oProduct = $oVariant;
        }
        return $oProduct;
    }

    public function getPreparedInfo($oProduct, $sFields = '*') {
        $oPrepareTable = MLDatabase::getPrepareTableInstance();
        $sPrepareTableName = $oPrepareTable->getTableName();
        $sQuery = "
                SELECT ".$sFields."
                  FROM ".$sPrepareTableName." prepare
        ";
        if ($oProduct->get('parentid') == 0) {
            $sQuery .= " 
            INNER JOIN magnalister_products product ON product.id = prepare.".$oPrepareTable->getProductIdFieldName()." AND product.parentid = '".(int)$oProduct->get('id')."'";
        }
        $sQuery .= " 
                 WHERE     `" . $oPrepareTable->getMarketplaceIdFieldName() . "` = '" . MLModule::gi()->getMarketPlaceId() . "'";
        if ($oProduct->get('parentid') > 0) {
            $sQuery .= " 
                       AND prepare.".$oPrepareTable->getProductIdFieldName()." = '".(int)$oProduct->get('id')."'";
        }

        return MLDatabase::getDbInstance()->fetchRow($sQuery);
    }

}
