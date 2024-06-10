<?php
try{
    MLSetting::gi()->set('aAjax', array());//ajax stuff for api
}catch(Exception $oEx){
}
try{
    MLSetting::gi()->set('aAjaxPlugin', array());//ajax stuff only used in plugin
}catch(Exception $oEx){
}
