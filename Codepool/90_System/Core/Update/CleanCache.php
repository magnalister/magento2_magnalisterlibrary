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
MLFilesystem::gi()->loadClass('Core_Update_Abstract');
/**
 * clean cache-folder, also old one
 */
class ML_Core_Update_CleanCache extends ML_Core_Update_Abstract {
    
    public function execute() {
        MLCache::gi()->flush();
        if (file_exists(MLFilesystem::getLibPath('writable'))) {
            $this->rm(MLFilesystem::getLibPath('writable'));
        }
        return $this;
    }
    
    /**
     * removes file or dir (recursivly) if it is not possible, no problem, just hd-space
     * @param string $sPath
     */
    protected function rm($sPath) {
        if (is_dir($sPath)) {
            foreach (MLFilesystem::gi()->glob($sPath.'/*') as $sSubPath) {
                $this->rm($sSubPath);
            }
            try {
                @rmdir($sPath);
            } catch (Exception $oEx) {
            }
        } else {
            try {
                @unlink($sPath);
            } catch (Exception $oEx) {
            }
        }
    }
}
