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
 * (c) 2010 - 2018 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLFilesystem::gi()->loadClass('Magento2_Helper_Model_ProductList_List');

class ML_Magento2Ebay_Helper_Model_ProductList_List extends ML_Magento2_Helper_Model_ProductList_List {

    public function preparedType($sTypeVariant = null) {
        if ($this->oLoadedProduct === null) {
            $this->aFields[] = __function__;
            $this->aHeader[__function__] = array(
                'title' => $this->oI18n->get('Ebay_Productlist_Header_sPreparedType'),
                'type' => 'preparedType'
            );
            return $this;
        }
    }

    public function auctionType($sTypeVariant = null) {
        if ($this->oLoadedProduct === null) {
            $this->aFields[] = __function__;
            $this->aHeader[__function__] = array(
                'title' => $this->oI18n->get('Ebay_Productlist_Header_sPreparedListingType'),
                'type' => 'auctionType'
            );
            return $this;
        }
    }

}
