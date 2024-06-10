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
 * Shortcut for handling exceptions, also needed for secure refactoring
 */
class MLException {
    
    /**
     * Generates an exception instance based of its name.
     * @param string $sException name of exception
     * @return Exception|ML_Core_Exception_Update
     */
    public static function factory($sException, $sMessage = '', $iCode = 0, $oPrevious = null) {
        $sCurrentClassName=  MLFilesystem::gi()->loadClass('exception_'.$sException);
        if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
        	return new $sCurrentClassName($sMessage, $iCode, $oPrevious);        	
        }else{
        	return new $sCurrentClassName($sMessage, $iCode);         	
        }
    }
    
}