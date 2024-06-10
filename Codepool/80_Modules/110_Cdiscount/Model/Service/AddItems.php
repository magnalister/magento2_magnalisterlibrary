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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Cdiscount_Model_Service_AddItems extends ML_Modul_Model_Service_AddItems_Abstract {

    protected function getProductArray() {
        $aMasterProducts = $this->indexingProductData();
        $aDataToBeUpload = $this->processingVariationData($aMasterProducts);
        return $aDataToBeUpload;
    }

    protected function hasAttributeMatching() {
        return true;
    }

    protected function createVariantMasterProducts($variantProducts, $variationMasterItemTitle, $variationMasterSku, $productToClone) {
        $variationProducts = array();
        foreach ($variantProducts as $variation) {
            $variation['ParentSKU'] = $variationMasterSku;
            $variation['Title'] = $variationMasterItemTitle;
            $variation['IsSplit'] = intval($variationMasterSku != $productToClone['SKU']);
            unset($variation['ItemTitle'], $variation['Variation']);
            $this->unsetShopRawData($variation);
            $variationProducts[] = $variation;
        }

        return $variationProducts;
    }


    protected function indexingProductData() {
        /* @var $oHelper ML_Cdiscount_Helper_Model_Service_Product */
        $oHelper = MLHelper::gi('Model_Service_Product');
        $aMasterProducts = array();
        $aPreparedImageExcludeVariantImages = array();
        foreach ($this->oList->getList() as $oProduct) {
            $sParentSku = $oProduct->getMarketPlaceSku();
            $oHelper->setProduct($oProduct);
            foreach ($this->oList->getVariants($oProduct) as $oVariant) {
                /* @var $oVariant ML_Shop_Model_Product_Abstract */
                if ($this->oList->isSelected($oVariant)) {
                    $oHelper->resetData();
                    $variationData = $oHelper->setVariant($oVariant)->getData();
                    $aPreparedImageExcludeVariantImages = $this->gatheringGenericImages($aPreparedImageExcludeVariantImages, $sParentSku, $variationData);
                    unset($variationData['PreparedImages']);
                    $aMasterProducts[$sParentSku][$oVariant->get('id')] = $variationData;

                }
            }
            foreach ($aMasterProducts[$sParentSku] as &$aVariantProduct) {
                if (isset($aPreparedImageExcludeVariantImages[$sParentSku])) {
                    $aVariantProduct['Images'] = array_merge($aVariantProduct['Images'], $aPreparedImageExcludeVariantImages[$sParentSku]);
                    $aImages = array();
                    foreach ($aVariantProduct['Images'] as &$image) {
                        $aImages[] = array('URL' => $image);
                    }
                    $aVariantProduct['Images'] = $aImages;
                }
            }
        }
        return $aMasterProducts;
    }

    protected function processingVariationData($aMasterProducts) {
        $aDataToUpload = array();
        foreach ($aMasterProducts as $sParentSku => $variationData) {
            foreach ($variationData as $variantId => $variationDatum) {
                if ($variationDatum['SKU'] === $sParentSku) {
                    $variationDatum['ParentSKU'] = $sParentSku;
                    $aDataToUpload[$variantId] = $variationDatum;
                    continue;
                }
                $variationDatum['ItemTitle'] = $variationDatum['Title'];
                $aDataToUpload[$variantId] = $variationDatum;
                $aDataToUpload[$variantId]['SKU'] = $sParentSku;
                $variationDatum['Variation'] = $variationDatum;
                $aDataToUpload[$variantId]['Variations'][] = $variationDatum;
            }
        }
        return $aDataToUpload;
    }

    protected function gatheringGenericImages($aPreparedImageExcludeVariantImages, $sParentSku, $variationData) {
        if (!isset($aPreparedImageExcludeVariantImages[$sParentSku])) {//initial prepared image
            // Backwards compatibility for PHP 8
            // PreparedImages could be null, which turns into a Fatal Error on the array_diff() call below
            if (null === $variationData['PreparedImages']) {
                $aPreparedImageExcludeVariantImages[$sParentSku] = null;

                return $aPreparedImageExcludeVariantImages;
            }

            $aPreparedImageExcludeVariantImages[$sParentSku] = $variationData['PreparedImages'];
        }
        //remove variant image from prepared image
        $aPreparedImageExcludeVariantImages[$sParentSku] = array_diff(
            $aPreparedImageExcludeVariantImages[$sParentSku],
            $variationData['Images']
        );
        return $aPreparedImageExcludeVariantImages;
    }

}
