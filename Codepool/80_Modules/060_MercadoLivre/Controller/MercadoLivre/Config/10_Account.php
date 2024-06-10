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
MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_ConfigAbstract');

class ML_MercadoLivre_Controller_MercadoLivre_Config_Account extends ML_Form_Controller_Widget_Form_ConfigAbstract {

//    protected $blValidateAuthKeys = false;
    
    public static function getTabTitle() {
        return MLI18n::gi()->get('mercadolivre_config_account_title');
    }
    
    public static function getTabActive () {
        return self::calcConfigTabActive(__class__, true);
    }
    
    public function getTokenField(&$aField) {
        $aField['url'] = str_replace('http:', 'https:', MLSetting::gi()->get('sDefaultApiUrl'))
            . '/MarketPlaces/MercadoLivre/Callback/Auth/'
            . 'index.php?mpId=' . MLModule::gi()->getMarketPlaceId();
    }
	
	public function resetAction($blExecute = true) {
		return parent::resetAction($blExecute);
	}
    
    public function saveAction($blExecute = true) {
        if ($blExecute) {
			$siteDetails = $this->oConfigHelper->getSiteDetails();
			//$locale = explode('_', $siteDetails['Locale']);
			$this->saveConfig('lang', 1/*$locale[0]*/);
			$this->saveConfig('currency', $siteDetails['DefaultCurrencyId']);
			$this->saveConfig('site.currencies', $siteDetails['Currencies']);
			$this->saveConfig('site.listing_types', $siteDetails['ListingTypes']);
        }
		
        return parent::saveAction($blExecute);
    }
    
    private function saveConfig($sKey, $sValue) {
        MLDatabase::factory('config')
            ->set('mpId', MLModule::gi()->getMarketPlaceId())
            ->set('mkey', $sKey)
            ->set('value', $sValue)
            ->save();
    }
}
