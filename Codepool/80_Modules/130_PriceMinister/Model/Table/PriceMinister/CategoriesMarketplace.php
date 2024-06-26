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
MLFilesystem::gi()->loadClass('Modul_Model_Table_Categories_Abstract');

class ML_PriceMinister_Model_Table_PriceMinister_CategoriesMarketplace extends ML_Modul_Model_Table_Categories_Abstract {

    protected $sTableName = 'magnalister_priceminister_categories_marketplace';
    protected $aTableKeys = array(
        'PRIMARY' => array('Non_unique' => '0', 'Column_name' => 'CategoryID'),
        'KEY' => array('Non_unique' => '1', 'Column_name' => 'ParentID'),
    );

    public function init($blForce = false) {
        parent::init($blForce);
        if (!isset($this->aFields['AttributeTypes'])) {
            $this->aFields['AttributeTypes'] = array(
                'Type' => 'varchar(32)', 'Null' => self::IS_NULLABLE_NO, 'Default' => '', 'Extra' => '', 'Comment' => ''
            );
        }

        if (!isset($this->aFields['ListingAllowed'])) {
            $this->aFields['ListingAllowed'] = array(
                'Type' => 'tinyint(1)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''
            );
        }

        if (!isset($this->aFields['Selectable'])) {
            $this->aFields['Selectable'] = array(
                'Type' => 'tinyint(1)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 1, 'Extra' => '', 'Comment' => ''
            );
        }

        $this->aFields['CategoryID'] = array(
            'isKey' => true,
            'Type' => 'varchar(64)', 'Null' => self::IS_NULLABLE_NO, 'Default' => 0, 'Extra' => '', 'Comment' => ''
        );
        return $this;
    }

    protected function setDefaultValues() {
    }
}
