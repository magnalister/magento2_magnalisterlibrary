<?php
MLFilesystem::gi()->loadClass('Core_Controller_Abstract');
class ML_Magnalister_Controller_Main_Head_Header extends ML_Core_Controller_Abstract{
    protected function getButtons(){
        return MLSetting::gi()->get('aButtons');
    }
}
