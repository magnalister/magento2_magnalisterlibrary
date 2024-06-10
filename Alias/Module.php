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
 * Shortcut to use ../80_Module/<module name>/Model/Modul.php of current modules, also needed for secure refactoring
 */
class MLModule {
    
    /**
     * Returns the instance of the marketplace module model.
     * @return ML_Modul_Model_Modul_Abstract|object|ML_Amazon_Model_Modul
     */
    public static function gi() {  
        return ML::gi()->instance('model_modul', array('Modul_Model_Modul_Abstract'));
    }

    /**
     * @return ML_Form_Helper_Model_Table_PrepareData_Abstract|object
     * @throws Exception
     */
    public static function getPrepareDataHelper() {
        return ML::gi()->instance('helper_model_table_' . MLModule::gi()->getMarketPlaceName() . '_preparedata');

    }
    
}