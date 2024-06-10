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

class ML_Hitmeister_Model_Table_Hitmeister_CategoriesMarketplace extends ML_Modul_Model_Table_Categories_Abstract {

	protected $sTableName = 'magnalister_hitmeister_categories_marketplace';

    protected function setDefaultValues() {
	}

    protected $aFields = array(
        'CategoryID' => array(
            'isKey' => true,
            'Type' => 'varchar(32)',    'Null' => 'NO', 'Default' => 0,     'Extra' => '', 'Comment' => ''
        ),
        'CategoryName' => array(
            'Type' => 'varchar(128)',   'Null' => 'NO', 'Default' => '',    'Extra' => '', 'Comment' => ''
        ),
        'ParentID' => array(
            'Type' => 'varchar(32)',     'Null' => 'NO', 'Default' => 0,     'Extra' => '', 'Comment' => ''
        ),
        'LeafCategory' => array(
            'Type' => 'tinyint(4)',     'Null' => 'NO', 'Default' => 1,     'Extra' => '', 'Comment' => ''
        ),
        'Selectable' => array(
            'Type' => 'tinyint(4)',     'Null' => 'NO', 'Default' => 1,     'Extra' => '', 'Comment' => ''
        ),
        'Fee' => array(
            'Type' => 'decimal(12,4)',  'Null' => 'NO', 'Default' => 0,     'Extra' => '', 'Comment' => ''
        ),
        'FeeCurrency' => array(
            'Type' => 'char(3)',        'Null' => 'NO', 'Default' => '',     'Extra' => '', 'Comment' => ''
        ),
        'Expires' => array(
            'isExpirable' => true,
            'Type' => 'datetime',       'Null' => self::IS_NULLABLE_YES, 'Default' => NULL,  'Extra' => '', 'Comment' => ''
        ),
    );
}
