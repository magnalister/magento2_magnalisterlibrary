<?php
MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_DeletedAbstract');
class ML_Etsy_Controller_Etsy_Listings_Deleted extends ML_Listings_Controller_Widget_Listings_DeletedAbstract {
    protected $aParameters=array('controller');
    
     public static function getTabTitle () {
        return MLI18n::gi()->get('ML_GENERIC_DELETED');
    }
    public static function getTabActive() {
        return MLModul::gi()->isConfigured();
    }
    
}