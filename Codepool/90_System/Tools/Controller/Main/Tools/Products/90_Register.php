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

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

class ML_Tools_Controller_Main_Tools_Products_Register extends ML_Core_Controller_Abstract {
    protected $aParameters = array('controller');
    
    protected $iDefaultChunkSize = 5;
    
    protected $oList;
    
    public function __construct() {
        $this->oList = MLProductList::gi('all');
        parent::__construct();
    }
    
    protected function getChunksPerPage () {
        try {
            $iChunks = MLRequest::gi()->get('chunksize');
        } catch (MLRequest_Exception $oEx) {
            $iChunks = $this->iDefaultChunkSize;
        }
        $iChunks = (int)$iChunks;
        return $iChunks;
    }
    
    protected function getPage(){
        try {
            $iPage = MLRequest::gi()->get('page');
        } catch (Exception $ex) {
            $iPage = 0;
        }
        return $iPage;
    }
    
    public function callAjaxRegisterProducts () {
        $iPage = (int)$this->getPage();
        $iCount = (int)$this->getChunksPerPage();
        $iFrom = $iPage * $iCount;
        MLSetting::gi()->add('aAjax', array('debuging'=>array($iPage,$iCount,$iFrom)));
        $this->oList->setLimit($iFrom, $iCount);
        foreach ($this->oList->getList() as $oProduct) {
            /* @var $oProduct ML_Shop_Model_Product_Abstract */
            $oProduct->getVariants();
        }
        $this->render();
        if ($this->getPercent() < 100) {
            MLSetting::gi()->add('aAjax', array('Next' => $this->getCurrentUrl(array(
                'method' => 'registerProducts', 
                'page' => $iPage+1, 
                'chunksize' => $this->getChunksPerPage()
            ))));
        }
    }
    
    protected function getPercent () {
        if (MLHttp::gi()->isAjax()) {
            $aStatistic = $this->oList->getStatistic();
            $iPage = (int)$this->getPage();
            $iCount = (int)$this->getChunksPerPage();
            $iFrom = $iPage * $iCount;
            $fPercent = (($iFrom+$iCount)/$aStatistic['iCountTotal'])*100;
        } else {
            $fPercent = 0;
        }
        $fPercent = $fPercent > 100 ? 100 : $fPercent;
        return number_format($fPercent, 2);
    }
    
    protected function getInfo () {
        $aStatistic = $this->oList->getStatistic();
        $iTotal = $aStatistic['iCountTotal'];
        if (MLHttp::gi()->isAjax()) {
            $iPage = (int)$this->getPage();
            $iCount = (int)$this->getChunksPerPage();
            $iFrom = $iPage * $iCount;
            $iCurrent = $iFrom+$iCount;
            $iCurrent = $iCurrent > $aStatistic['iCountTotal'] ? $aStatistic['iCountTotal'] : $iCurrent;
        } else {
            $iCurrent = 0;
        }
        return $iCurrent.' / '.$iTotal;
    }
    
}