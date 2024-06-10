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
class ML_Ricardo_Model_Service_AddItems extends ML_Modul_Model_Service_AddItems_Abstract {

    /**
     * Overridden method, because of asynchronous upload concept,
     * since cron will fire the action for product upload to MP, method uploadItems is not needed.
     *
     * @return $this
     */
    public function uploadItems() {
        return $this;
    }

    protected function getProductArray() {
        /* @var $oHelper ML_Ricardo_Helper_Model_Service_Product */
        $oHelper = MLHelper::gi('Model_Service_Product');
        $aMasterProducts = array();
        foreach ($this->oList->getList() as $oProduct) {
            $sParentSku = $oProduct->getMarketPlaceSku();
            $oHelper->setProduct($oProduct);
            foreach ($this->oList->getVariants($oProduct) as $oVariant) {
                /* @var $oVariant ML_Shop_Model_Product_Abstract */
                if ($this->oList->isSelected($oVariant)) {
                    $oHelper->resetData();
                    $aMasterProducts[$oVariant->get('id')] = $oHelper->setVariant($oVariant)->getData();
                    $aMasterProducts[$oVariant->get('id')]['ParentSKU'] = $sParentSku;
                }
            }
        }

        return $aMasterProducts;
    }

    public function getItemsFeeData() {
        /* @var $oHelper ML_Ricardo_Helper_Model_Service_ItemsFee */
        $oHelper = MLHelper::gi('Model_Service_ItemsFee');
        $aMasterProducts = array();
        foreach ($this->oList->getList() as $oProduct) {
            foreach ($this->oList->getVariants($oProduct) as $oVariant) {
                /* @var $oVariant ML_Shop_Model_Product_Abstract */
                if ($this->oList->isSelected($oVariant)) {
                    $oHelper->resetData();
                    $aMasterProducts[$oVariant->get('id')] = $oHelper->setVariant($oVariant)->getData();
                }
            }
        }

        return $aMasterProducts;
    }
}
