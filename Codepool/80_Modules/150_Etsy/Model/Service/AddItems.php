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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Etsy_Model_Service_AddItems extends ML_Modul_Model_Service_AddItems_Abstract {
    protected function getProductArray() {
        /* @var $oHelper ML_Etsy_Helper_Model_Service_Product */
        $oHelper = MLHelper::gi('Model_Service_Product');
        $aMasterProducts = array();
        foreach ($this->oList->getList() as $oProduct) {
            /* @var $oProduct ML_Shop_Model_Product_Abstract */
            $oHelper->setProduct($oProduct);
            foreach ($this->oList->getVariants($oProduct) as $oVariant) {
                /* @var $oVariant ML_Shop_Model_Product_Abstract */
                if ($this->oList->isSelected($oVariant)) {
                    $oHelper->resetData();
                    $aData = $oHelper->setVariant($oVariant)->getData();
                    if (empty($aData['CategoryAttributes']) || !$this->variationShouldBeExcluded($aData['CategoryAttributes'])) {
                        $aMasterProducts[$oVariant->get('id')] = $aData;
                    }

                }
            }
        }

        return $aMasterProducts;
    }


    /**
     * check if there is any notmatch value in matched value
     * @param array $aVariation
     * @return bool
     */
    protected function variationShouldBeExcluded(array $aVariation) {
        $blReturn = false;
        if (isset($aVariation['property_values']) && is_array($aVariation['property_values'])) {
            foreach ($aVariation['property_values'] as $aValue) {
                if ($aValue['property_id'] === 'notmatch') {
                    $blReturn = true;
                    break;
                }
            }
        }
        return $blReturn;
    }

    /**
     * remove master with quantity <= 0
     * don't remove variations (When updating, Etsy requires the complete variation matrix; for new Items, our API removes Variations)
     * @return boolean
     */
    protected function checkQuantity() {
        foreach ($this->aData as $sKey => $aItem) {
            if (!array_key_exists('MasterSKU', $aItem)) $aItem['MasterSKU'] = '';
            if (    isset($aItem['Quantity'])
                 && ((int) $aItem['Quantity']) <= 0
                 && $aItem['MasterSKU'] == $aItem['SKU']) { // don't remove variations
                $sMessage = MLI18n::gi()->get('sAddItemProductWithZeroQuantity');
                MLMessage::gi()->addWarn($sMessage, '', false);

                $oProduct = MLProduct::factory()->getByMarketplaceSKU($aItem['SKU'], true);
                if(!$oProduct->existsMlProduct()){//it is possible that we send a variation as master product(if variation is not supported) 
                    $oProduct = MLProduct::factory()->getByMarketplaceSKU($aItem['SKU']);  
                }                  
                $iProductId = $oProduct->get('id');
                MLErrorLog::gi()->addError($iProductId, $aItem['SKU'], $sMessage, array('SKU' => $aItem['SKU']));
                $this->aError[] = $sMessage;
                unset($this->aData[$sKey]);
            } else if (    isset($aItem['Quantity'])
                 && ((int) $aItem['Quantity']) <= 0) { // 0-quantity Variations: Warn
                $sMessage = MLI18n::gi()->get('sAddItemProductWithZeroQuantity');
                MLMessage::gi()->addWarn($sMessage, '', false);
            }
        }
        return !empty($this->aData);
    }
}
