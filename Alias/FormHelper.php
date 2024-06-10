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

/**
 * shortcut for handling forms correlating classes, also needed for secure refactoring
 */
class MLFormHelper {
    
    /**
     * Returns the instance of the config form shop model.
     * @return ML_Shop_Model_ConfigForm_Shop_Abstract|ML_Shopware_Model_ConfigForm_Shop|ML_Shopware6_Model_ConfigForm_Shop|ML_Magento_Model_ConfigForm_Shop|ML_Magento2_Model_ConfigForm_Shop|ML_Shopify_Model_ConfigForm_Shop|ML_WooCommerce_Model_ConfigForm_Shop|ML_Prestashop_Model_ConfigForm_Shop
     */
    public static function getShopInstance() {
        return ML::gi()->instance('model_configform_shop', array('Shop_Model_ConfigForm_Shop_Abstract'));
    }
    
    /**
     * Returns the instance of the config form module model.
     * @return ML_Modul_Model_ConfigForm_Modul_Abstract
     */
    public static function getModulInstance() {
        return ML::gi()->instance('model_configform_modul', array('Modul_Model_ConfigForm_Modul_Abstract'));
    }

    /**
     * Returns the instance of the config form shop model.
     * @return ML_Form_Helper_Controller_Widget_Form_PrepareAMCommon
     */
    public static function getPrepareAMCommonInstance() {
        return MLHelper::gi('controller_widget_form_prepareamcommon');
    }

    /**
     * Returns the instance of the config form shop model.
     * @return ML_Form_Helper_Controller_Widget_Form_Config
     */
    public static function getConfigCotrollerHelper() {
        return MLHelper::gi('controller_widget_form_config');
    }
}