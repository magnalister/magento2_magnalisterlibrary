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

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

class ML_Sync_Controller_Frontend_Do_UploadInvoices extends ML_Core_Controller_Abstract {

    public function renderAjax() {
        $this->execute();
    }

    public function render() {
        $this->execute(); 
    }

    public function execute() {
        $iStartTime = microtime(true);
        MLHelper::gi('stream')->activateOutput()->deeper('Start: '.$this->getIdent().($this->oRequest->data('continue') !== null ? " -> continue mode" : ''));
        try {
            $sMessage = '';
            $iRequestMp = MLRequest::gi()->data('mpid');
            $aTabIdents = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.tabident')->get('value');
            foreach (MLHelper::gi('Marketplace')->magnaGetInvolvedMarketplaces() as $sMarketPlace) {
                foreach (MLHelper::gi('Marketplace')->magnaGetInvolvedMPIDs($sMarketPlace) as $iMarketPlace) {

                    if ($iRequestMp === null || $iRequestMp == $iMarketPlace) {
                        ML::gi()->init(array('mp' => $iMarketPlace));
                        $sMarketPlaceText = 'Marketplace: '.$sMarketPlace.' ('.(isset($aTabIdents[$iMarketPlace]) && $aTabIdents[$iMarketPlace] != '' ? $aTabIdents[$iMarketPlace].' - ' : '').$iMarketPlace.')';
                        MLHelper::gi('stream')->deeper($sMarketPlaceText.' -> start upload');
                        try {
                            if (MLModule::gi()->isConfigured()) {
                                try {
                                    $oService = $this->getService();
                                    $oService->execute();
                                    $sMessage .= $sMarketPlace.' ('.$iMarketPlace.'), ';
                                    MLHelper::gi('stream')->higher($sMarketPlaceText.' -> end upload');

                                } catch (MLAbstract_Exception $oEx) {
                                    if(MLSetting::gi()->blDebug) {
                                        MLHelper::gi('stream')->higher(__LINE__ . ':' . microtime(true) . $oEx->getMessage() . $oEx->getFile() . $oEx->getLine() . $oEx->getTraceAsString());
                                    }
                                    MLHelper::gi('stream')->higher($sMarketPlaceText.' -> end upload, not implemented', false);
                                }
                            } else {
                                MLHelper::gi('stream')->higher($sMarketPlaceText.' -> end upload, not configured', false);
                            }
                        } catch (Exception $oEx) {
                            if(MLSetting::gi()->blDebug) {
                                MLHelper::gi('stream')->higher(__LINE__ . ':' . microtime(true) . $oEx->getMessage() . $oEx->getFile() . $oEx->getLine() . $oEx->getTraceAsString());
                            }
                            MLHelper::gi('stream')->higher($sMarketPlaceText.' -> end upload, not implemented', false);
                        }
                    }
                }
            }
        } catch (Exception $oEx) {
            if(MLSetting::gi()->blDebug) {
                MLHelper::gi('stream')->higher(__LINE__ . ':' . microtime(true) . $oEx->getMessage() . $oEx->getFile() . $oEx->getLine() . $oEx->getTraceAsString());
            }
            MLHelper::gi('stream')->stream($oEx->getMEssage());
        }
        MLHelper::gi('stream')->streamCommand(array('Complete' => 'true'));
        //        MLMessage::gi()->addInfo(
        //            '<strong>'.date(MLI18n::gi()->get('sDateTimeFormat'),time()).'</strong><br />'.
        //            MLI18n::gi()->get('sInventorySyncByService').' '.
        //            substr($sMessage,0,-2).'.'
        //        );
        MLHelper::gi('stream')->higher("Complete (".microtime2human(microtime(true) - $iStartTime).")");
    }

    protected function getService() {
        return MLService::getUploadInvoices();
    }
}