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
 * shortcut for handling productlist class, also needed for secure refactoring
 */
class MLProductList {
    
    /**
     * Returns the instance of the product list model based on its name.
     * @param string $sListName
     * @return ML_Productlist_Model_ProductList_Abstract
     */
    public static function gi($sListName) {
        $sListName='model_productlist_'.$sListName;
        return ML::gi()->instance($sListName, array(
            'Productlist_Model_ProductList_Abstract', 
            'Productlist_Model_ProductList_Selection',
            'Productlist_Model_ProductList_ShopAbstract')
        );
    }
    
    /**
     * Returns the instance of productlistdependency model based on its name.
     * @param string $sDependencyName
     * @return ML_Productlist_Model_ProductListDependency_Abstract
     */
    public static function dependencyInstance ($sDependencyName) {
        return ML::gi()->instance('model_productlistdependency_'.$sDependencyName, array('Productlist_Model_ProductListDependency_Abstract'));
    }
    
}
