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

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

class ML_Tools_Controller_Main_Tools_Products_Image extends ML_Core_Controller_Abstract {

    protected $aParameters = array('controller');
    protected $iDefaultChunkSize = 100;

    /** @var ML_Productlist_Model_ProductList_Abstract */
    protected $oList;
    protected $sImagePath = '';
    protected $mReturnInfo;

    protected $aMpProductIdField = array(
        'ebay' => 'products_id',
        'amazon' => 'productsid',
        'idealo' => 'products_id',
    );
    public function __construct() {
        $this->oList = MLProductList::gi('all');
        parent::__construct();
    }

    protected function getSku() {
        try {
            $sku = MLRequest::gi()->get('sku');
        } catch (MLRequest_Exception $oEx) {
            $sku = '';
        }

        return $sku;
    }

    protected function getChunksPerPage() {
        try {
            $iChunks = MLRequest::gi()->get('chunksize');
        } catch (MLRequest_Exception $oEx) {
            $iChunks = $this->iDefaultChunkSize;
        }
        $iChunks = (int) $iChunks;
        return $iChunks;
    }

    protected function getPage() {
        try {
            $iPage = MLRequest::gi()->get('page');
        } catch (Exception $ex) {
            $iPage = 0;
        }
        return $iPage;
    }

    protected function getPlatform() {
        try {
            $sPlatform = MLRequest::gi()->get('platform');
        } catch (Exception $ex) {
            $sPlatform = null;
        }
        return $sPlatform;
    }
    
    protected function getSizeValue() {
        try {
            $sSize = MLRequest::gi()->get('imagesizes');
        } catch (Exception $ex) {
            $sSize = '30,40,60,500';
        }
        return $sSize;
    }

    protected function fallbackModeChecked() {
        try {
            $blChecked = (MLRequest::gi()->get('fallbackmode') == 'true');
        } catch (Exception $ex) {
            $blChecked = false;
        }
        return $blChecked;
    }
    
    protected function oldChecked() {
        try {
            $blChecked = (MLRequest::gi()->get('oldimage') == 'old');
        } catch (Exception $ex) {
            $blChecked = false;
        }
        return $blChecked;
    }

    protected function getCreatedImage() {
        return $this->mReturnInfo;
    }

    public function callAjaxCreateImage() {
        $iPage = (int) $this->getPage();
        $iCount = (int) $this->getChunksPerPage();
        $iFrom = $iPage * $iCount;
        MLSetting::gi()->add('aAjax', array('debuging' => array($iPage, $iCount, $iFrom)));
        $this->oList->setLimit($iFrom, $iCount);
        
        if (MLCache::gi()->exists('Model_Image__BrokenImageResize')) {
            $aImage = MLCache::gi()->get('Model_Image__BrokenImageResize');
            
            try {
                $sUrl = MLImage::gi()->getFallBackUrl($aImage['sSrc'], $aImage['sDst'], $aImage['iMaxWidth'], $aImage['iMaxHeight']);
                $this->mReturnInfo .= 'destination : '.$aImage['sDst'].'<br>source : '.$aImage['sSrc'].'<br>url : '.$sUrl.'<br><iframe  src="'.$sUrl.'"></iframe><br>';
                               
                MLDatabase::getTableInstance('image')
                        ->set('sourcePath', $aImage['sSrc'])
                        ->set('destinationPath', $aImage['sDst'])
                        ->set('skipCheck', true)
                        ->save()
                ;
            } catch (Exception $oEx) {
                // not implemented MLImage::getFallBackUrl() is shopspecific
            }
            MLCache::gi()->delete('Model_Image__BrokenImageResize');
        } else if (MLRequest::gi()->data('sku') != '') {
            $oProduct = MLProduct::factory()->getByMarketplaceSKU(MLRequest::gi()->data('sku'));
            if ($oProduct->exists()) {
                $this->createALlImage($oProduct);
            }
        } else {
            foreach ($this->oList->getList() as $oProduct) {
                if($oProduct->get('parentid') != 0 ) {
                    $oProduct = $oProduct->getParent();
                }
                /* @var $oProduct ML_Shop_Model_Product_Abstract */
                try {
                    $sPlatform = $this->getPlatform();
                    if($sPlatform != ''){
                        $oQuery = MLDatabase::factorySelectClass()->from('magnalister_'.$sPlatform.'_prepare')->where($this->aMpProductIdField[$sPlatform].' = ' . $oProduct->get('id'));
                        if ($oQuery->getCount() <= 0) {
                            continue;
                        }
                    }
                    $this->createALlImage($oProduct);
                } catch (Exception $oExc) {
                    MLMessage::gi()->addDebug($oExc);
                }
            }
        }
        $iPage += 1;
        $this->fallbackModeChecked();
        $this->render();
        if ($this->getPercent() < 100) {
            MLSetting::gi()->add('aAjax', array('Next' => $this->getCurrentUrl(array(
                    'method' => 'createImage',
                    'page' => $iPage,
                    'chunksize' => $this->getChunksPerPage(),
                    'imagetype' => MLRequest::gi()->data('imagetype'),
                    'imagesizes' => MLRequest::gi()->data('imagesizes'),
                    'oldimage' => MLRequest::gi()->data('oldimage'),
                    'platform' => $this->getPlatform(),
                    'fallbackmode' => MLRequest::gi()->data('fallbackmode'),
            ))));
        }
    }

    protected function getPercent() {
        if (MLRequest::gi()->data('sku') != '') {
            return 100;
        } else {
            if (MLHttp::gi()->isAjax()) {
                $aStatistic = $this->oList->getStatistic();
                $iPage = (int) $this->getPage();
                $iCount = (int) $this->getChunksPerPage();
                $iFrom = $iPage * $iCount;
                $fPercent = (($iFrom + $iCount) / $aStatistic['iCountTotal']) * 100;
            } else {
                $fPercent = 0;
            }
            $fPercent = $fPercent > 100 ? 100 : $fPercent;
            return number_format($fPercent, 2);
        }
    }

    protected function getSize($sSize) {
        $iWidth = $iHeight = $sSize;
        if (strpos($sSize, '_') !== false) {
            $aArray = explode('_', $sSize);
            if (count($aArray) < 2 || !is_numeric($aArray[0]) || !is_numeric($aArray[1])) {
                throw new Exception('size is not proper');
            } else {
                return $aArray;
            }
        }

        return array($iWidth, $iHeight);
    }
    
    protected function getInfo() {
        if (MLRequest::gi()->data('sku') != '') {
            return "100";
        } else {
            $aStatistic = $this->oList->getStatistic();
            $iTotal = $aStatistic['iCountTotal'];
            if (MLHttp::gi()->isAjax()) {
                $iPage = (int) $this->getPage();
                $iCount = (int) $this->getChunksPerPage();
                $iFrom = $iPage * $iCount;
                $iCurrent = $iFrom + $iCount;
                $iCurrent = $iCurrent > $aStatistic['iCountTotal'] ? $aStatistic['iCountTotal'] : $iCurrent;
            } else {
                $iCurrent = 0;
            }
            return $iCurrent . ' / ' . $iTotal;
        }
    }

    protected function createALlImage(ML_Shop_Model_Product_Abstract $oProduct) {
        $aImages = $oProduct->getImages();
        if (!is_array($aImages)) {
            return;
        }
        if ($this->fallbackModeChecked()) {
            $this->mReturnInfo = '';
        }else{
            $this->mReturnInfo = array();
        }
        $aSizes = explode(',', MLRequest::gi()->data('imagesizes'));
        $sType = MLRequest::gi()->data('imagetype');
        $sSku = $oProduct->get('marketplaceidentsku');
        if ($this->oldChecked() && method_exists($oProduct, 'getOldImages')) {// very old method to create images
            foreach ($oProduct->getOldImages() as $sImagePath) {
                try{
                    foreach ($aSizes as $sSize) {
                        list($iWidth, $iHeight) = $this->getSize($sSize);
                        $mReturnInfo = MLImage::gi()->resizeImage($sImagePath, $sType, $iWidth, $iHeight);
                        $this->mReturnInfo[$sSku][] = $mReturnInfo;
                    }
                }  catch (Exception $oExc){
                     $this->mReturnInfo[$sSku][] = $oExc->getMessage();
                }
            }
        }else{
            foreach ($oProduct->getImages() as $sImagePath) {
                try{
                    foreach ($aSizes as $sSize) {
                        list($iWidth, $iHeight) = $this->getSize($sSize);
                        $mReturnInfo = MLImage::gi()->resizeImage($sImagePath, $sType, $iWidth, $iHeight);
                        $this->mReturnInfo[$sSku][] = $mReturnInfo;
                    }
                }  catch (Exception $oExc){
                     $this->mReturnInfo[$sSku][] = $oExc->getMessage();
                }
            }
        }
    }


}
