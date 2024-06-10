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
 * (c) 2010 - 2015 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

class ML_Tools_Controller_Main_Tools_Filesystem_Cache extends ML_Core_Controller_Abstract {
    protected $aParameters=array('controller');
    protected $blShowList = false;
    public function __construct() {
        parent::__construct();
        if (MLRequest::gi()->data("delete") !== null) {
            if (MLRequest::gi()->data("selected") !== null) {
                foreach (MLRequest::gi()->data("selected") as $sCache) {
                    MLCache::gi()->delete($sCache);
                }
            }
            if (MLRequest::gi()->data("sessionselected") !== null) {
                foreach (MLRequest::gi()->data("sessionselected") as $sSession) {
                    MLSession::gi()->delete($sSession);
                }
            }
        }else if(MLRequest::gi()->data("deleteallcache") !== null ){
            MLCache::gi()->flush();            
        }else if(MLRequest::gi()->data("deleteallsession") !== null ){
            MLSession::gi()->flush();            
        }
        $this->blShowList = (MLRequest::gi()->data("showlist") !== null );
    }
    
    public function cacheList(){
        return MLCache::gi()->getList();
    }
    
    public function sessionList(){
        return MLSession::gi()->data();
    }
}