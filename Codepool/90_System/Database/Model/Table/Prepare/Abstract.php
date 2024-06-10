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
abstract class ML_Database_Model_Table_Prepare_Abstract extends ML_Database_Model_Table_Abstract {

    /**
     * field name for join magnalister_product.id
     * @return string
     */
    public function getProductIdFieldName() {
        return 'products_id';
    }

    /**
     * field name for marketplaceid
     * @return string
     */
    public function getMarketplaceIdFieldName() {
        return 'mpid';
    }
    
    /**
     * field name for prepared-status
     * @return string
     */
    public function getPreparedStatusFieldName() {
        return 'verified';
    }
    
    /**
     * possible values array(key=>translated) of $this->getPreparedFieldName()
     * @return array
     */
    public function getPreparedFieldFilterValues () {
        return MLI18n::gi()->get(ucfirst(MLModule::gi()->getMarketPlaceName()) . '_Productlist_Filter_aPreparedStatus');
    }
    /**
     * array of translated values for productlists
     * @return array
     */
    public function getPreparedProductListValues () {
        return MLI18n::gi()->getGlobal(ucfirst(MLModule::gi()->getMarketPlaceName()) . '_Productlist_Cell_aPreparedStatus');
    }
    
    /**
     * field value for successfully prepared item of $this->getPreparedFieldName()
     * @return string
     */
    public function getIsPreparedValue () {
        return 'OK';
    }
    
    /**
     * field name for prepared-type if exists
     * @return string|null
     */
    public function getPreparedTypeFieldName () {
        return null;
    }
    
    /**
     * field name for prepared-timestamp
     * @return string
     */
    public function getPreparedTimestampFieldName () {
        return 'preparedts';
    }

    public function isVariationMatchingSupported() {
        return false;
    }

    public function getPrimaryCategoryFieldName() {
        return 'PrimaryCategory';
    }

    public function getShopVariationFieldName() {
        return 'ShopVariation';
    }
}
