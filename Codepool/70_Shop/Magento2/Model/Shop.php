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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */


use Magento\Framework\Config\ConfigOptionsListConstants;

class ML_Magento2_Model_Shop extends ML_Shop_Model_Shop_Abstract {

    protected static $sSession;
    public function getShopSystemName() {
        return 'magento2';
    }

    public function getDBRestrictedTypes() {
        return array(
            'enum' => 'varchar(30)',
            'time' => 'datetime'
        );
    }

    public function getDbConnection() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $sMlConnection = $objectManager->get('\Magento\Framework\App\ResourceConnection')->getConnection()->getConfig();
        $sMlConnection['database'] = $sMlConnection['dbname'];
        $sMlConnection['user'] = $sMlConnection['username'];
        return $sMlConnection;
    }

    public function initializeDatabase () {
        MLDatabase::getDbInstance()->query($this->getDbConnection()['initStatements']);
        return $this;
    }

    public function getOrderSatatistic($sDateBack) {
        return MLDatabase::factorySelectClass()
            ->select(array('mgo.`created_at`', 'mlo.`platform`'))
            ->from(MLMagento2Alias::getMagento2Db()->getTableName('sales_order'), 'mgo')
            ->join(array('magnalister_orders', 'mlo', 'mgo.`entity_id` = mlo.`current_orders_id`'), ML_Database_Model_Query_Select::JOIN_TYPE_LEFT)
            ->where("mgo.`created_at` BETWEEN '$sDateBack' AND NOW()")
            ->getResult();
    }

    public function getSessionId() {
        return md5(session_id());
    }

    public function getProductsWithWrongSku() {
        return array();
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

    public function getDBCollationTableInfo() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection */
        $productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\Collection');
        return array(
            'table' => $productCollection->getTable('catalog_product_entity'),
            'field' => 'sku',
        );
    }

    public function getShopVersion() {
        try {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            return $objectManager->create(\Magento\Framework\App\ProductMetadataInterface::class)->getVersion();
        } catch (\Exception $ex) {
            return '';
        }
    }
}
