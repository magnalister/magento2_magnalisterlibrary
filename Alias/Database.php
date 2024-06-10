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

/**
 * shortcut for handling sql correlating classes, also needed for secure refactoring
 */
class MLDatabase {
    
    /**
     * Returns a table model instance for the requested table name.
     * @param string $sTableName
     * @return ML_Database_Model_Table_Abstract
     */
    public static function factory($sTableName) {
         return ML::gi()->factory('model_table_'.$sTableName, array('Database_Model_Table_Abstract'));
    }
    
    /**
     * Returns a table model instance as singleton for the requested table name.
     * @param string $sTableName
     * @return ML_Database_Model_Table_Abstract|object
     */
    public static function getTableInstance ($sTableName) {
         return ML::gi()->instance('model_table_'.$sTableName, array('Database_Model_Table_Abstract'));
    }

    /**
     * Returns a table model instance as singleton for the mp-specific prepare-table.
     * @return ML_Database_Model_Table_Prepare_Abstract|object
     */
    public static function getPrepareTableInstance () {
        return MLDatabase::getTableInstance(MLModule::gi()->getMarketPlaceName() . '_prepare');
    }

    /**
     * Returns a table model instance as singleton for the mp-specific prepare-table.
     * @return ML_Database_Model_Table_VariantMatching_Abstract|object
     */
    public static function getVariantMatchingTableInstance() {
        return MLDatabase::getTableInstance(MLModule::gi()->getMarketPlaceName().'_variantmatching');
    }

    /**
     * Returns a table model instance as singleton for the mp-specific prepare-table.
     * @return ML_Productlist_Model_Table_MarketplaceSyncFilter|object
     */
    public static function getMarketplaceSyncFilterTableInstance() {
        return MLDatabase::getTableInstance('MarketplaceSyncFilter');
    }

    /**
     * Returns a new query select model instance.
     * @return ML_Database_Model_Query_Select|object
     */
    public static function factorySelectClass() {
        return ML::gi()->factory('model_query_select');
    }

    /**
     * Returns the database class.
     * @return ML_Database_Model_DB|object
     */
    public static function getDbInstance() {
        return ML::gi()->instance('model_db');
    }
    
}
