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

class ML_Ebay_Update_NewConfigChange extends ML_Core_Update_Abstract {

    public function execute() {
        $blInit = false; 
        $oDB = MLDatabase::getDbInstance();
        foreach (MLShop::gi()->getMarketplaces() as $iMarketPlace => $sMarketplace) {
           
            if (
                    $sMarketplace == 'ebay' 
                    && $oDB->tableExists('magnalister_preparedefaults') 
                    && $oDB->tableExists('magnalister_config')
                    && $oDB->tableExists('magnalister_ebay_prepare')
                ) {
                $oSelectPrepareDefault = MLDatabase::factorySelectClass() ;
                $oSelectConfig = MLDatabase::factorySelectClass() ;
                $aPrepareDefault = $oSelectPrepareDefault->select('`values`')->from('magnalister_preparedefaults')->where("mpid = '".$iMarketPlace."' AND name = 'defaultconfig' ")->getResult();
                 
                $aConfig = $oSelectConfig->select('`value`')->from('magnalister_config')->where("mpid = '".$iMarketPlace."' AND mkey = 'dispatchtimemax'")->getResult();
                if(
                    !empty($aPrepareDefault)
                        &&
                    !empty($aConfig)
                        &&
                    strpos($aPrepareDefault[0]['values'], 'dispatchtimemax') === false
                ){
                    $aNewPrepareDefault = MLHelper::getEncoderInstance()->decode($aPrepareDefault[0]['values']);
                    $aNewPrepareDefault["dispatchtimemax"] = $aConfig[0]["value"];
                    $oSelectPrepareDefault->update('magnalister_preparedefaults', array('`values`'=>MLHelper::getEncoderInstance()->encode($aNewPrepareDefault)))->doUpdate();
//                    MLMessage::gi()->addError(MLDatabase::getDbInstance()->getLastQuery(),'',false);
                    $oSelectConfig->delete('magnalister_config')->doDelete();
//                    MLMessage::gi()->addError(MLDatabase::getDbInstance()->getLastQuery(),'',false);
                }
                if (!$blInit) {
                    $blInit = true;
                    $oDB->update('magnalister_ebay_prepare', array('DispatchTimeMax' => null), array('DispatchTimeMax' => ''));
                }
            }
        }
        return parent::execute();
    }

}
