<?php
/**
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
 * $Id$
 *
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLFilesystem::gi()->loadClass('Modul_Model_Table_Categories_Abstract');
class ML_Check24_Model_Table_Check24_CategoriesStore extends ML_Modul_Model_Table_Categories_Abstract {

    protected $sTableName = 'magnalister_check24_categories_store';
    
    public function init($blForce = false) {
        parent::init($blForce);
        if (!isset($this->aFields['mpid'])) {
            $this->aFields['mpid'] = array(
                'isKey' => true,
                'Type' => 'int(8)', 'Null' => 'NO', 'Default' => '0', 'Extra' => '', 'Comment' => ''
            );
        }
        return $this;
    }
    
    protected function setDefaultValues() {
        $this->set('mpid', MLModule::gi()->getMarketPlaceId());
        return $this;
    }
    
    protected function getChildCategoriesRequest() {
        $aRequest = parent::getChildCategoriesRequest();
        $aRequest['ACTION'] = 'GetStoreCategories';
        return $aRequest;
    }
    
}
