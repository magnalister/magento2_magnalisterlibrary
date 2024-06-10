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
/**
 * select all products 
 * hitmeister-config: 
 *  - hitmeister.lang isset
 * magnalister.selectionname=='match
 */
class ML_Hitmeister_Model_ProductList_Hitmeister_Prepare_Match_Manual extends ML_Productlist_Model_ProductList_Abstract {
    protected $aList=null;
    protected $iCountTotal=0;
    protected $aMixedData=array();
    protected $iFrom=0;
    protected $iCount=5;
    public function additionalRows(ML_Shop_Model_Product_Abstract $oProduct) {
        return array('hitmeister_itemsearch');
    }

    public function getFilters() {
         return array();
    }

    public function getHead() {
        $aHead=array();
        $aHead['image']=array(
            'title'=>'',
            'type'=>'image'
        );
        $aHead['product']=array(
            'title'=>  MLI18n::gi()->get('Productlist_Header_sProduct'),
            'type'=>'product'
        );
        $sValue = MLDatabase::factory('config')->set('mpid',0)->set('mkey','general.manufacturerpartnumber')->get('value');
        if(!empty($sValue)){
            $aHead['general.manufacturerpartnumber']=array(
                'title'=>  MLI18n::gi()->get('Productlist_Header_Field_sManufacturerpartnumber'),
                'type'=>'simpleText'
            );
        }
        $sValue = MLDatabase::factory('config')->set('mpid',0)->set('mkey','general.ean')->get('value');
        if(!empty($sValue)){
             $aHead['general.ean']=array(
                'title'=>MLI18n::gi()->get('Productlist_Header_Field_sEan'),
                'type'=>'simpleText'
            );
        }
        $aHead['priceshop']=array(
            'title'=>  MLI18n::gi()->get('Productlist_Header_sPriceShop'),
            'type'=>'priceshop'
        );
        $aHead['pricemarketplace']=array(
            'title'=> sprintf(MLI18n::gi()->get('Productlist_Header_sPriceMarketplace'), MLModul::gi()->getMarketPlaceName(false)),
            'type'=>'pricemarketplace'
        );
        return $aHead;
    }

    public function getList() {
        if($this->aList===null){
            $iFrom=$this->iFrom;
            $iCount=$this->iCount;
            $this->aList=array();
            $sSql="
                select %s
                from 
                    magnalister_selection s, 
                    magnalister_products p 
                where 
                    s.pID=p.ID
                    and
                    s.session_id='".MLShop::gi()->getSessionId()."'
                    and
                    s.selectionname='match'
                    and
                    mpid='".MLModul::gi()->getMarketPlaceId()."'
            ";
            $this->iCountTotal= MLDatabase::getDbInstance()->fetchOne(sprintf($sSql,' distinct count(p.ParentId) '));
            foreach(MLDatabase::getDbInstance()->fetchArray(sprintf($sSql,' distinct p.ParentId ')." limit ".$iFrom.", ".$iCount) as $aRow){
                $this->aList[$aRow['ParentId']]=MLProduct::factory()->set("id",$aRow['ParentId'])->load();
            }
        }
        return new ArrayIterator($this->aList);
    }
    public function getMasterIds($blPage = false) {
        $this->getList();
        return array_keys($this->aList);
    }

    public function getStatistic() {
        $this->getList();
        $aOut= array(
            'blPagination'=>false,
            'iCountPerPage'=>5,
            'iCurrentPage'=>0,
            'iCountTotal'=>$this->iCountTotal,
            'aOrder'=>array(
                'name'=>'',
                'direction'=>''
            )
        );
        return $aOut;
    }

    public function setFilters($aFilter) {
        return $this;
    }

    public function getMixedData(ML_Shop_Model_Product_Abstract $oProduct, $sKey) {
        return $oProduct->getModulField($sKey, substr($sKey,0,  strpos($sKey, '.'))=='general');
    }

    public function variantInList(ML_Shop_Model_Product_Abstract $oProduct) {
        return MLDatabase::factory('selection')->loadByProduct($oProduct, 'match')->get('expires')===null?false:true;
    }

    public function setLimit($iFrom, $iCount) {
        $this->iFrom=$iFrom;
        $this->iCount=$iCount;
        return $this;
    }
}