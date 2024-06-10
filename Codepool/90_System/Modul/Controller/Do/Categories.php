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
class ML_Modul_Controller_Do_Categories extends ML_Core_Controller_Abstract {

    protected $aParameters = array('controller');
    
    /**
     * @todo request type (store or mp)
     */
    public function callAjaxGetChildCategories () {
        $sType = MLRequest::gi()->get('type');
        if (MLRequest::gi()->get('parentid') == '0') {
            MLDatabase::getDbInstance()->query("TRUNCATE TABLE " . MLDatabase::factory(MLModule::gi()->getMarketPlaceName() . '_categories' . $sType)->getTableName());
        }
        $this->includeView('do_categories_childcategories', array('sParentId' => MLRequest::gi()->get('parentid'), 'sType' => $sType));
    }
    
    public function render() {
        return $this;
    }
    
}
