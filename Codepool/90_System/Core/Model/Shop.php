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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

/**
 * A dummy class that fulfills the interface for the shop systems.
 * All methods are empty.
 * @deprecated real model_shop will deployed
 */
class ML_Core_Model_Shop extends ML_Shop_Model_Shop_Abstract {
    /**
     * Gets the name of the shop system.
     * @return string
     */
    public function getShopSystemName() {
        return '';
    }
    
    /**
     * Returns the database connection details.
     * @return array 
     *     Format: array('host' => string, 'user' => string, 'password' => string, 'database' => string, persistent => bool)
     */
    public function getDbConnection() {
        return array();
    }

    /**
     * Get a list of products with missing or double assigned SKUs.
     * @return array
     */
    public function getProductsWithWrongSku() {
        return array();
    }

    /**
     * Returns statistic information of orders.
     * @param string $sDateBack 
     *     Beginning date to get order info up to now.
     * @return array
     */
    public function getOrderSatatistic($sDateBack) {
        return array();
    }
    
    /**
     * Returns the current session id.
     * @return ?string
     */
    public function getSessionId() {
        return null;
    }

    /**
     * Loads the default config.
     */
    public function setDefaultConfig() {
        
    }
    
    /**
     * will be triggered after plugin update for shop-spec. stuff
     * eg. clean shop-cache
     * @param bool $blExternal if true external files (outside of plugin-folder) was updated
     * @return $this
     */
    public function triggerAfterUpdate($blExternal) {
        return $this;
    }

    /**
     * initialize database like charset etc.
     * @return $this
     */
    public function initializeDatabase() {
        return $this;
    }

    /**
     * get table name and field name to get collation of shop database
     * @return array
     */
    public function getDBCollationTableInfo() {
        return array(
            'table'=> 'magnalister_config',
            'field'=> 'value',
        );
    }
}
