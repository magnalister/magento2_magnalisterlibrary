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

class ML_Magnalister_Controller_Main_Content_Welcome extends ML_Core_Controller_Abstract {

    protected function getMarketing() {
        $sKey = strtoupper(__CLASS__) . '__marketing_'.MLLanguage::gi()->getCurrentIsoCode();
        $sContent = MLCache::gi()->exists($sKey) ? MLCache::gi()->get($sKey) : '';
        if (!MLCache::gi()->exists($sKey)) {
            try {
                $this->callAjaxGetMarketing();
                $sContent = MLCache::gi()->get($sKey);
            } catch (Exception $oEx) { // cache not actualized
                
            }
        }
        $sContent = str_replace("{#sConfigurationUrl#}", MLHttp::gi()->getUrl(array('controller' => 'configuration')), $sContent);
        return $sContent;
    }
    
    protected function callAjaxGetMarketing(){
        $mWarnings = '';
        $sKey = strtoupper(__CLASS__) . '__marketing_'.MLLanguage::gi()->getCurrentIsoCode();
        $sConfigured = MLDatabase::factory('config')->set('mpId', 0)->set('mkey', 'general.keytype')->get('value') != null ? '1' : '0' ;
        $sUrl = MLSetting::gi()->get('sApiRelatedUrl') . 'Marketing/' .
            '?shop=' . MLShop::gi()->getShopNameForMarketingContent() . '&' .
            'build=' . MLSetting::gi()->get('sClientBuild').'&'.
            'lang='.MLLanguage::gi()->getCurrentIsoCode().'&'.
            'configured='.$sConfigured;
        $sContent = MLHelper::getRemote()->fileGetContents($sUrl, $mWarnings, 1);
        if ($sContent !== false || $mWarnings !== '') {            
           MLCache::gi()->set($sKey, $sContent);
        } else {
            throw new Exception('Can\'t load URL.', 1444735220);
        }
    }

}
