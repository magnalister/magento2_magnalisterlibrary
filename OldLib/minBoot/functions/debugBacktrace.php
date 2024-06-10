<?php
function debugBacktrace($iMaxDeph=9999){
    $aBacktrace=debug_backtrace();
    $sLibPath=MLFilesystem::getLibPath();
    $iLibLength=strlen($sLibPath);
    $aOut=array();
    foreach($aBacktrace as $iCount=>$aValue){
        if($iCount!=0){/*don't need myself*/
            if(
                    substr($aValue['file'],0,$iLibLength)!=$sLibPath // not ml - from shopsystem
                    ||
                    $iCount==$iMaxDeph
            ){
                break;
            }
            $aOut[]=array('file'=>$aValue['file'],'line'=>$aValue['line'],'function'=>(isset($aValue['class']) ?$aValue['class']:'').' :: '.(isset($aValue['function']) ?$aValue['function']:'').'()');
        }
    }
    return $aOut;
}