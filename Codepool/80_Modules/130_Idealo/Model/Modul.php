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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Idealo_Model_Modul extends ML_Modul_Model_Modul_Abstract {
    
     /**
     * constructor prepares MagnaConnector
     */
    public function __construct() {
        parent::__construct();
        MagnaConnector::gi()->setAddRequestsProps(array(
            'SUBSYSTEM' => 'ComparisonShopping',
            'SEARCHENGINE'=> $this->getMarketPlaceName(),
            'MARKETPLACEID' => $this->getMarketPlaceId()
        ));
    }
    /**
     *
     * @var ML_Shop_Model_Price_Interface $oPrice 
     */
    protected $oPrice=null;
    
    public function getMarketPlaceName ($blIntern = true) {
        return $blIntern ? 'idealo' : MLI18n::gi()->get('sModuleNameIdealo');
    }

    public function getConfig($sName = null) {
        if ($sName == 'currency') {
            $mReturn = parent::getConfig('currency');
            if ($mReturn === null) {
                $mReturn = MLCurrency::gi()->getDefaultIso();
            }
        } else {
            // old config
            $mReturn = parent::getConfig($sName);
            $aTranslateOldConf = array(
                'paymentmethod' => 'payment.methods',
            );
            if ($sName === null) {
                $currency = parent::getConfig('currency');
                if ($currency === null) {
                    $currency = MLCurrency::gi()->getDefaultIso();
                }
                $mReturn = MLHelper::getArrayInstance()->mergeDistinct($mReturn, array('currency' => $currency));
                foreach ($aTranslateOldConf as $sNew => $sOld) {
                    if (!array_key_exists($sNew, $mReturn) && array_key_exists($sOld, $mReturn)) {
                        $mReturn[$sNew] = $mReturn[$sOld];
                    }
                }
            } elseif ($mReturn === null && in_array($sName, array_keys($aTranslateOldConf))) {
                $mReturn = parent::getConfig($aTranslateOldConf[$sName]);
            }
        }

        return $mReturn;
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
        $aKeys = array(
            'stocksync.tomarketplace' => array('api' => 'Callback.SyncInventory', 'value' => isset($sSync) ? $sSync : 'no'),
        );

        return $aKeys;
    }
    
    public function getIdealoCSVInfo() {
        try{
            $result = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetCSInfo',
            ));
            if ($result['DATA']['HasUpload'] == 'no') {
                    return  !empty($result['DATA']['CSVPath']) ? $result['DATA']['CSVPath'] : MLI18n::gi()->idealo_config_message_no_csv_table_yet;
            }
        }  catch (Exception $oEx){
            MLMessage::gi()->addError($oEx);
            return '';
        }
    }
    
    public function getStockConfig($sType = null) {
        return array(
            'type' => $this->getConfig('quantity.type'), 
            'value' => $this->getConfig('quantity.value'),
            'max' => null,
        );
    }

}
