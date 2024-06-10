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

/**
 * shortcut for handling service correlating classes, also needed for secure refactoring
 */
class MLService {

    /**
     * Returns the instance of the ImportOrders service model.
     * @return ML_Modul_Model_Service_ImportOrders_Abstract|object
     */
    public static function getImportOrdersInstance() {
        return ML::gi()->instance('model_service_importorders', array(
            'Modul_Model_Service_Abstract',
            'Modul_Model_Service_importorders_Abstract'
        ));
    }

    /**
     * Returns the instance of the SyncInventory service model.
     * @return ML_Modul_Model_Service_SyncInventory_Abstract|object
     */
    public static function getSyncInventoryInstance() {
        return ML::gi()->instance('model_service_syncinventory', array(
            'Modul_Model_Service_Abstract',
            'Modul_Model_Service_SyncInventory_Abstract'
        ));
    }

    /**
     * Returns the instance of the ImportCategories service model.
     * @return ML_Modul_Model_Service_ImportCategories_Abstract|object
     */
    public static function getImportCategoriesInstance() {
        return ML::gi()->instance('model_service_importcategories', array(
            'Modul_Model_Service_Abstract',
            'Modul_Model_Service_ImportCategories_Abstract',
        ));
    }

    /**
     * Returns the instance of the SyncProductIdentifiersInstance service model.
     * @return ML_Modul_Model_Service_SyncOrderStatus_Abstract|object
     */
    public static function getSyncProductIdentifiersInstance () {
        return ML::gi()->instance('model_service_syncproductidentifiers', array(
            'Modul_Model_Service_Abstract',
            'Modul_Model_Service_SyncInventory_Abstract'
        ));
    }

    /**
     * Returns the instance of the SyncOrderStatus service model.
     * @return ML_Modul_Model_Service_SyncOrderStatus_Abstract|object
     */
    public static function getSyncOrderStatusInstance() {
        return ML::gi()->instance('model_service_syncorderstatus', array(
            'Modul_Model_Service_Abstract',
            'Modul_Model_Service_SyncOrderStatus_Abstract'
        ));
    }

    /**
     * Returns the instance of the UpdateOrders service model.
     * @return ML_Modul_Model_Service_Abstract|object
     */
    public static function getUpdateOrdersInstance() {
        return ML::gi()->instance('model_service_updateorders', array(
            'Modul_Model_Service_Abstract',
            'Modul_Model_Service_ImportOrders_Abstract',
        ));
    }

    /**
     * Returns the instance of the AddItems service model.
     * @return ML_Modul_Model_Service_AddItems_Abstract|object
     */
    public static function getAddItemsInstance() {
        return ML::gi()->instance('model_service_additems', array(
            'Modul_Model_Service_Abstract',
            'Modul_Model_Service_AddItems_Abstract'
        ));
    }

    /**
     * Return the instance of the UploadInvoices service model
     * @return ML_Modul_Model_Service_Abstract|ML_Modul_Model_Service_UploadInvoices_Abstract|object
     */
    public static function getUploadInvoices () {
        return ML::gi()->instance('model_service_uploadinvoices', array(
            'Modul_Model_Service_Abstract',
        ));
    }

    /**
     *
     * @param
     */
    public static function getOrderStatusUpdateInstance() {
        return ML::gi()->instance('model_service_orderstatusupdate', array(
            'Modul_Model_Service_Abstract',
            'Modul_Model_Service_OrderStatusUpdate_Abstract'
        ));
    }


    /**
     * @return ML_Modul_Model_Service_Abstract|object
     */
    public static function getUploadInvoicesInstance() {
        return ML::gi()->instance('model_service_uploadinvoices',
            array(
                'Modul_Model_Service_Abstract',
            ));
    }

}
