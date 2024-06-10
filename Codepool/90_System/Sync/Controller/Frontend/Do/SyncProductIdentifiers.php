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

class ML_Sync_Controller_Frontend_Do_SyncProductIdentifiers extends ML_Core_Controller_Abstract {

    public function renderAjax() {//@todo in future renderAjax could be more clear
        try {
            $this->execute();
            $aAjax = MLSetting::gi()->get('aAjax');
            if(empty($aAjax)){
                throw new Exception;
            }
        } catch(Exception $oEx){//if there is no data to be sync or if there is an error
            MLSetting::gi()->add('aAjax', array('success' => true));
        }        
        if(MLHttp::gi()->isAjax()){            
            if(MLSetting::gi()->sMainController === null){//after $this->execute sMainController is null, so we reset again , 
                MLSetting::gi()->set('sMainController',  get_class($this));
            }
            $this->finalizeAjax();
        }
    }

    public function render() {
        $this->execute();
    }
    
    protected function out($sStr){
        if(!MLHttp::gi()->isAjax()){//in ajax call in pluin we break maxitems and steps of each request so we don't need echo
            echo $sStr;
        }
        return $this;
    }
    public function execute(){
        $iStartTime=microtime(true);
        try{
            $this->out( 
                '#######################################'."\n##\n".
                '## '.(
                    defined('ML_LABEL_SYNC_INVENTORY_LOG') 
                    ? ML_LABEL_SYNC_INVENTORY_LOG 
                    : 'Begin of protocoll: InventorySync Shop > Marketplace'
		))
            ;
            if ($this->oRequest->data('continue')!==null) {
                $this->out( (
                        defined('ML_LABEL_SYNC_CONTINUE_MODE')
                        ? ' ('.ML_LABEL_SYNC_CONTINUE_MODE.')'
                        : ' (in continue mode)'
                ));
            }
            $this->out( "\n##\n".'#######################################'."\n");
            require_once MLFilesystem::getOldLibPath('php/callback/callbackFunctions.php');
            $sMessage='';
            $iRequestMp=  MLRequest::gi()->data('mpid');
            foreach(magnaGetInvolvedMarketplaces() as $sMarketPlace){
                foreach(magnaGetInvolvedMPIDs($sMarketPlace) as $iMarketPlace){
                    if($iRequestMp===null||$iRequestMp==$iMarketPlace){
                        ML::gi()->init(array('mp'=>$iMarketPlace));
                        try{
                            $oService=  MLService::getSyncProductIdentifiersInstance();
                            if (function_exists('ml_debug_out')){
                                ml_debug_out("\n\n\n#####\n## Sync $sMarketPlace ($iMarketPlace) with class ".  get_class($oService)."\n##\n");
                            }
                            $oService->execute();
                            $sMessage.=$sMarketPlace.' ('.$iMarketPlace.'), ';
                        }catch(MLAbstract_Exception $oEx){ // not implemented
                            $this->out("\n{#" . base64_encode(json_encode(array_merge(array('Marketplace' => MLModule::gi()->getMarketPlaceName(), 'MPID' => MLModule::gi()->getMarketPlaceId(),), array('Complete' => 'true',)))) . "#}\n\n");
                        }catch (Exception $oEx) {
                            $this->out( $oEx->getMessage());
                        }
                    }
                }
             }
            
            
        }catch(Exception $oEx){
//            $this->out( $oEx->getMEssage().'<br />');
            
        }
//        MLMessage::gi()->addInfo(
//            '<strong>'.date(MLI18n::gi()->get('sDateTimeFormat'),time()).'</strong><br />'.
//            MLI18n::gi()->get('sInventorySyncByService').' '.
//            substr($sMessage,0,-2).'.'
//        );
        $this->out( "\n\nComplete (".microtime2human(microtime(true) - $iStartTime).").\n");
    }
}