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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Hitmeister_Model_Modul extends ML_Modul_Model_Modul_Abstract {

    public function getMarketPlaceName($blIntern = true) {
        return $blIntern ? 'hitmeister' : MLI18n::gi()->get('sModuleNameHitmeister');
    }

    public function getConfig($sName = null) {
        $mReturn = parent::getConfig($sName);

        if (    $sName == 'currency'
             && empty($mReturn)
        ) {
            // Fallback
            $mReturn = 'EUR';
        }
        
        if ($sName === null) {// merge
            $mReturn = MLHelper::getArrayInstance()->mergeDistinct($mReturn, array(
                'lang' => parent::getConfig('lang'),
                'currency' => $this->getConfig('currency'),
            ));
        }
        
        return $mReturn;
    }

    public function getStockConfig($sType = null) {
        return array(
            'type' => $this->getConfig('quantity.type'),
            'value' => $this->getConfig('quantity.value')
        );
    }
    
    /**
     * @return array('configKeyName'=>array('api'=>'apiKeyName', 'value'=>'currentSantizedValue'))
     */
    protected function getConfigApiKeysTranslation() {
        $aConfig = $this->getConfig();
        $sDate = $aConfig['preimport.start'];
        //magento tip to find empty date
        $sDate = (preg_replace('#[ 0:-]#', '', $sDate) === '') ? date('Y-m-d') : $sDate;
        $sDate = date('Y-m-d', strtotime($sDate));
        $sSync = $this->getConfig('stocksync.tomarketplace');
        $sMinimumPrice = $this->getConfig('minimumpriceautomatic');
        return array_merge(
            array(
                'site'=>array('api' => 'Access.Site', 'value' => ($this->getConfig('site'))),
                'import'                  => array('api' => 'Orders.Import', 'value' => ($this->getConfig('import') ? 'true' : 'false')),
                'preimport.start'         => array('api' => 'Orders.Import.Start', 'value' => $sDate),
                'stocksync.tomarketplace' => array('api' => 'Callback.SyncInventory', 'value' => isset($sSync) ? $sSync : 'no'),
                'minimumpriceautomatic' => array('api' => 'Price.MinimumPriceAutomatic', 'value' => $sMinimumPrice === '0' ? '0' : '1'),
            ), $this->getInvoiceAPIConfigParameter()
        );
    }
    
    public function isMultiPrepareType(){
        return true;
    }

    public function getCarriers(){
        try {
            $aResponse = MagnaConnector::gi()->submitRequestCached(array('ACTION' => 'GetOrderStatusData'), 60);
            if ($aResponse['STATUS'] == 'SUCCESS' && isset($aResponse['DATA']) && is_array($aResponse['DATA'])) {
                return $aResponse['DATA']['CarrierCodes'];
            }else{
                return array();
            }
        } catch (MagnaException $e) {
            return array();
        }

    }

    /** 
     * configures price-object
     * special case 'lowest' (minimumprice), otherwise default
     * @return ML_Shop_Model_Price_Interface
     */
    public function getPriceObject($sType = null, $aSettings = null) {
        if (    empty($sType)
             || ($sType !== 'lowest')
        ) {
            return parent::getPriceObject();
        }
        $this->aPrice['lowest'] =  MLPrice::factory();

        // "signal" must be null if none set
        $sSignal = (string)$this->getConfig('price.lowest.signal');
        if (empty($sSignal)) $sSignal = null;

        $this->aPrice['lowest']->setPriceConfig(
            $this->getConfig('price.lowest.addkind'),
            $this->getConfig('price.lowest.factor'),
            $sSignal,
            $this->getConfig('price.lowest.group'),
            $this->getConfig('price.lowest.usespecialoffer')
       );
       return $this->aPrice['lowest'];
    }

    /**
     * @inheritDoc
     */
    public function submitFirstTrackingNumber() {
        return false;
    }

    public function isConfigured() {
        $bReturn = parent::isConfigured();
        $sCurrency = $this->getConfig('currency');

        if (empty($sCurrency)) {
        // Fallback
            $this->setConfig('currency', 'EUR');
        }

        if (!empty($sCurrency) && !in_array($sCurrency, array_keys(MLCurrency::gi()->getList()))) {
            MLMessage::gi()->addWarn(sprintf(MLI18n::gi()->ML_GENERIC_ERROR_CURRENCY_NOT_IN_SHOP , $sCurrency));
        }
        return $bReturn;
    }
}
