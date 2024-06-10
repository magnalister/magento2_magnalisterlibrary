<?php
require_once(MLFilesystem::getOldLibPath('minBoot/classes/BrowserDetect.php'));
$sOs = MLBrowserDetect::gi()->get('Platform');
if ($sOs === 'win') {
    $sOs = 'windows';
}
MLSetting::gi()->set('aBodyClasses', array(
    'jqueryui',
    'magna',
    $sOs,
    MLShop::gi()->getShopSystemName()
));
if (MLBrowserDetect::gi()->compare('Browser', 'msie', '==')) {
    $fMsieVersion = floatval(MLBrowserDetect::gi()->get('BVersion'));
    if ($fMsieVersion < 10) {
        $sRenderengine = 'ielt10';
    } else if ($fMsieVersion < 9) {
        $sRenderengine = 'ielt9';
    } else if ($fMsieVersion < 8) {
        $sRenderengine = 'ielt8';
    }
    if(isset($sRenderengine)){
        MLSetting::gi()->add('aBodyClasses',array($sRenderengine));
    }
}