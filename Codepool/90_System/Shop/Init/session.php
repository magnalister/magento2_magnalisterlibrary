<?php
if(MLSetting::gi()->get('blCleanRunOncePerSession')){
    MLSession::gi()->set('runOncePerSession', array());
}