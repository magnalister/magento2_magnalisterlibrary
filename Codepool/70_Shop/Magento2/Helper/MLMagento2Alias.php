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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */


class MLMagento2Alias {

    /**
     * get Magento 2product helper class
     * @return ML_Magento2_Helper_Model_Product|Object
     */
    public static function getProductHelper(){
        return MLHelper::gi('model_product');
    }
    /**
     * get Magento 2 price helper class
     * @return ML_Magento2_Model_Price|Object
     */
    public static function getPriceModel(){
        return MLPrice::factory();
    }
    /**
     * get Magento 2 price helper class
     * @return ML_Magento2_Helper_Model_Price|Object
     */
    public static function getPriceHelper(){
        return MLHelper::gi('model_price');
    }
    /**
     * get Magento 2 shop order helper class
     * @return ML_Magento2_Helper_Model_ShopOrder|Object
     */
    public static function getShopOrderHelper(){
        return MLHelper::gi('model_shoporder');
    }


    /**
     * get Magento 2 shop order helper class
     * @return ML_Magento2_Model_Http|Object
     */
    public static function getHttpModel(){
        return MLHttp::gi();
    }

    /**
     * @return ML_Magento2_Model_Product|ML_Shop_Model_Product_Abstract
     */
    public static function getProductModel(){
        return MLProduct::factory();
    }

    /**
     * @return ML_Magento2_Model_Order
     */
    public static function getOrderModel(): \ML_Magento2_Model_Order {
        return MLOrder::factory();
    }

    /**
     * @return mixed
     */
    public static function getMagentoObjectManager() {
        return \Magento\Framework\App\ObjectManager::getInstance();
    }

    /**
     * @return mixed
     */
    public static function ObjectManagerProvider($class) {
        try {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            return $objectManager->get($class);
        } catch (Exception $exception) {
            MLMessage::gi()->addWarn(MLI18n::gi()->get('magento2_generated_directory_issue'));
            throw new Exception();
        }
    }

    /**
     * @param string $class
     * @return mixed
     * @throws MLAbstract_Exception
     */
    public static function CreateObjectManagerProvider($class) {
        try {
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            return $objectManager->create($class);
        } catch (Exception $exception) {
            MLMessage::gi()->addWarn(MLI18n::gi()->get('magento2_generated_directory_issue'));
            throw new Exception($exception->getMessage(), $exception->getCode());
        }
    }


    /**
     * Returns the Magento 2 database connection
     *
     * @return Magento\Framework\App\ResourceConnection\Interceptor
     * @throws Exception
     */
    public static function getMagento2Db() {
        return MLMagento2Alias::CreateObjectManagerProvider('\Magento\Framework\App\ResourceConnection');
    }

}
