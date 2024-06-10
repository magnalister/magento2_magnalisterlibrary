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

class ML_Guide_Controller_Guide extends ML_Core_Controller_Abstract {

    protected function getHelp() {
        $sKey = strtoupper(__CLASS__) . '__guide_'.MLLanguage::gi()->getCurrentIsoCode();
        $sContent = MLCache::gi()->exists($sKey) ? MLCache::gi()->get($sKey) : '';
        if (!MLCache::gi()->exists($sKey)) {
            try {
                $this->callAjaxGetHelp();
                $sContent = MLCache::gi()->get($sKey);
            } catch (Exception $oEx) { // cache not actualized
                
            }
        }
        return $sContent;
    }
    
    protected function callAjaxGetHelp(){
        $mWarnings = '';
        $sKey = strtoupper(__CLASS__) . '__guide_'.MLLanguage::gi()->getCurrentIsoCode();
        $sContent = MLHelper::gi('remote')->fileGetContents(
            MLSetting::gi()->get('sApiRelatedUrl') . 'Help/' .
            '?shop=' . MLShop::gi()->getShopSystemName() . '&' .
            'build=' . MLSetting::gi()->get('sClientBuild').'&'.
            'lang='.MLLanguage::gi()->getCurrentIsoCode(), 
            $mWarnings, 
            10
        );
        if ($sContent !== false || $mWarnings !== '') {
            $sContent = $sContent;
            MLCache::gi()->set($sKey, $sContent);
        } else {
            throw new Exception('Can\'t load URL.', 1444735220);
        }
    }

}

#<?php
#MLFilesystem::gi()->loadClass('Core_Controller_Abstract');
#class ML_Guide_Controller_Guide extends ML_Core_Controller_Abstract{
#
#}
