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

class ML_Sync_Controller_Frontend_Do_SyncOrderStatus extends ML_Core_Controller_Abstract {

    public function renderAjax() {//@todo in future renderAjax could be more clear
        try {
            $this->execute();
            $aAjax = MLSetting::gi()->get('aAjax');
            if (empty($aAjax)) {
                throw new Exception;
            }
        } catch (Exception $oEx) {//if there is no data to be sync or if there is an error
            MLSetting::gi()->add('aAjax', array('success' => true));
        }
        if (MLHttp::gi()->isAjax()) {
            $this->finalizeAjax();
        }
    }

    public function render() {
        $this->execute();
    }

    public function execute() {
        $iStartTime = microtime(true);

        if (!MLHttp::gi()->isAjax()) {
            MLHelper::gi('stream')->activateOutput();
        }

        MLHelper::gi('stream')->deeper('Start: '.$this->getIdent().($this->oRequest->data('continue') !== null ? " -> continue mode" : ''));
        try {
            require_once MLFilesystem::getOldLibPath('php/callback/callbackFunctions.php');
            $sMessage = '';
            $iRequestMp = MLRequest::gi()->data('mpid');
            $aTabIdents = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.tabident')->get('value');
            foreach (magnaGetInvolvedMarketplaces() as $sMarketPlace) {
                foreach (magnaGetInvolvedMPIDs($sMarketPlace) as $iMarketPlace) {
                    if ($iRequestMp === null || $iRequestMp == $iMarketPlace) {
                        ML::gi()->init(array('mp' => $iMarketPlace));
                        $sMarketPlaceText = 'Marketplace: '.$sMarketPlace.' ('.(isset($aTabIdents[$iMarketPlace]) && $aTabIdents[$iMarketPlace] != '' ? $aTabIdents[$iMarketPlace].' - ' : '').$iMarketPlace.')';
                        MLHelper::gi('stream')->deeper($sMarketPlaceText.' -> start sync');
                        try {
                            $oService = MLService::getSyncOrderStatusInstance();
                            $oService->execute();
                            $sMessage .= $sMarketPlace.' ('.$iMarketPlace.'), ';
                            MLHelper::gi('stream')->higher($sMarketPlaceText.' -> end sync');
                        } catch (Exception $oEx) {//module doesn't exists
                            if (MLSetting::gi()->blDebug) {
                                MLHelper::gi('stream')->stream('Exception Message: "' . $oEx->getMessage() . '"');
                                MLHelper::gi('stream')->stream('Exception File: "' . $oEx->getFile() . '"');
                                MLHelper::gi('stream')->stream('Exception Line: "' . $oEx->getLine() . '"');
                                MLHelper::gi('stream')->stream('Exception Backtrace: "' . $oEx->getTraceAsString() . '"');
                            }
                            MLHelper::gi('stream')->higher($sMarketPlaceText . ' -> end sync, not implemented', false);
                        }
                    }
                }
            }
        } catch (Exception $oEx) {
            MLHelper::gi('stream')->stream($oEx->getMEssage());
        }

        if (MLHttp::gi()->isAjax()) {
            $iStep = MLService::getSyncOrderStatusInstance()->getOrderPerRequest();
            $iOffset = (int)MLModule::gi()->getConfig('orderstatussyncoffset');
            $iTotal = MLOrder::factory()->getOutOfSyncOrdersArray(0, true);
            if ($iTotal <= $iOffset + $iStep) {
                $blFinished = true;
                $iOffset = 0;
            } else {
                $blFinished = false;
                $iOffset = $iOffset + $iStep;
            }
            MLModule::gi()->setConfig('orderstatussyncoffset', $iOffset);
            MLSetting::gi()->add(
                'aAjax',
                array(
                    'success' => $blFinished,
                    'error' => '',
                    'offset' => $iOffset,
                    'info' => array(
                        'total' => $iTotal,
                        'current' => $iOffset,
                        'purge' => false,
                    ),
                )
            );
        } else {
            MLModule::gi()->setConfig('orderstatussyncoffset', 0);
            MLHelper::gi('stream')->streamCommand(array('Complete' => 'true'));
            MLHelper::gi('stream')->higher("Complete (".microtime2human(microtime(true) - $iStartTime).")");
            if(MLDatabase::getDbInstance()->getLastError() !== '') {
                MLHelper::gi('stream')->stream('Last SQL error: "'.MLDatabase::getDbInstance()->getLastError().'"');
            }
        }
    }
}