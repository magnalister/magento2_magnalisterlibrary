<?php

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

class ML_Tools_Controller_Main_Tools_Setting extends ML_Core_Controller_Abstract {
    protected $aParameters=array('controller');
    public function getData() {
        $aOut=array();
        foreach (array_keys(MLSetting::gi()->get('aServiceVars')) as $sKey) {
            try {
                $aOut[$sKey] = MLSetting::gi()->get($sKey);
            } catch(Exception $oEx) {
                
            }
        }
        return $aOut;
    }
    public function isChanged() {
        $aSessionSetting = MLSession::gi()->get('setting');
        return is_array($aSessionSetting) ? count($aSessionSetting)>0 : false;
    }


}