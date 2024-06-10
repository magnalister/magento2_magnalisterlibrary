<?php

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

class ML_Tools_Controller_Main_Tools_Do_Shop extends ML_Core_Controller_Abstract {
    protected $aParameters = array('controller');

    public static function getTabActive() {
        $aActions = MLShop::gi()->getShopCronActions();
        return count($aActions) > 0;
    }
}