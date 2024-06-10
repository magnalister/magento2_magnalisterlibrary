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
* (c) 2010 - 2018 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLFilesystem::gi()->loadClass('Modul_Model_Table_Categories_Abstract');
class ML_Etsy_Model_Table_Etsy_CategoriesMarketplace extends ML_Modul_Model_Table_Categories_Abstract {

    protected $sTableName = 'magnalister_etsy_categories_marketplace';
    
    public function init($blForce = false) {
        parent::init($blForce);
        if (!isset($this->aFields['Language'])) {
            $this->aFields['Language'] = array(
                'isKey' => true,
                'Type' => 'varchar(2)', 'Null' => 'NO', 'Default' => '', 'Extra' => '', 'Comment' => ''
            );
            $this->aFields['Selectable'] = array(
                'Type' => 'tinyint(4)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 1, 'Extra' => '', 'Comment' => ''
            );
        }
        return $this;
    }
    
    protected function setDefaultValues() {
        return $this->set('Language', MLModul::gi()->getConfig('shop.language'));
    }
    
    protected function getChildCategoriesRequest() {
        $aRequest = parent::getChildCategoriesRequest();
        $aRequest['DATA']['Language'] = $this->get('Language');
        return $aRequest;
    }
    
}
