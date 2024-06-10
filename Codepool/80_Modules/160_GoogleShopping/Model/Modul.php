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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_GoogleShopping_Model_Modul extends ML_Modul_Model_Modul_Abstract {
    public function getMarketPlaceName($blIntern = true) {
        return $blIntern ? 'googleshopping' : MLI18n::gi()->get('sModuleNameGoogleShopping');
    }

    public function isConfigured() {
        $bReturn = parent::isConfigured();
        
        return $bReturn;
    }
    
    protected function getDefaultConfigValues() {
        return array_merge(parent::getDefaultConfigValues(), array('customersync' => 1));
    }
     
    public function getStockConfig($sType = null) {
        return array(
            'type'=>$this->getConfig('quantity.type'),
            'value'=>$this->getConfig('quantity.value')
        );
    }

    /**
     * @return array('configKeyName'=>array('api'=>'apiKeyName', 'value'=>'currentSantizedValue'))
     */
    protected function getConfigApiKeysTranslation() {
        $sDate = $this->getConfig('preimport.start');
        //magento tip to find empty date
        $sDate = (preg_replace('#[ 0:-]#', '', $sDate) ==='') ? date('Y-m-d') : $sDate;
        $sDate = date('Y-m-d', strtotime($sDate));
        $sSync = $this->getConfig('stocksync.tomarketplace');
        return array(
            'import' => array('api' => 'Orders.Import', 'value' => ($this->getConfig('import') ? 'true' : 'false')),
            'preimport.start' => array('api' => 'Orders.Import.Start', 'value' => $sDate),
            'stocksync.tomarketplace' => array('api' => 'Callback.SyncInventory', 'value' => isset($sSync) ? $sSync : 'no'),
            'order.importonlypaid' => array('api' => 'Orders.ImportOnlyPaid', 'value' => ($this->getConfig('order.importonlypaid') ? 'true' : 'false')),
            'merchantid' => array('api' => 'Access.MerchantId', 'value' => $this->getConfig('googleshopping.merchantid')),
        );
    }
    
    public function getItemSpecifics($sCategory) {
        $aOut=array();
        try {
            $aRequest = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetItemSpecifics',
                'DATA' => array(
                    'CategoryID' => $sCategory,
                    'Langugage' => MLModule::gi()->getConfig('lang'),
                ),
                'CATEGORYID' => $sCategory
            ));
        } catch (MagnaException $e) {
        }
        if (isset($aRequest['DATA'])) {
            $aOut=$aRequest['DATA'];
        } else {
            $aOut= array();
        }
        return $aOut;
    }

    public function tokenAvailable($blResetCache = false) {
        $sCacheKey = strtoupper(__class__).'__'.$this->getMarketPlaceId().'_googleshoppingtoken';
        $oCache = MLCache::gi();
        if ($blResetCache) {
            $oCache->delete($sCacheKey);
        }
        if (!$oCache->exists($sCacheKey) || !((bool)$oCache->get($sCacheKey))) {
            $blToken = false;
            try {
                $result = MagnaConnector::gi()->submitRequest(array(
                    'ACTION' => 'CheckIfTokenAvailable'
                ));
                if ('true' == $result['DATA']['TokenAvailable']) {
                    $this->setConfig('token', '__saved__');
                    $this->setConfig('token.expires', $result['DATA']['TokenExpirationTime']);
                    $blToken = true;
                }
            } catch (MagnaException $e) {
            }
            $oCache->set($sCacheKey, $blToken, 60 * 15);
        }
        return (bool)$oCache->get($sCacheKey);
    }
}
