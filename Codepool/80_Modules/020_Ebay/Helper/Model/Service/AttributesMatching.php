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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLFilesystem::gi()->loadClass('Modul_Helper_Model_Service_AttributesMatching');
class ML_Ebay_Helper_Model_Service_AttributesMatching extends ML_Modul_Helper_Model_Service_AttributesMatching {

    protected function findMatchingMPValueForExactShopValue($shopAttributeValue, $matchedAttributeValues)
    {
        if (empty($matchedAttributeValues) || !is_array($matchedAttributeValues)) {
            return '';
        }
        if(!is_array($shopAttributeValue)){
            if (empty($shopAttributeValue)) {
                $shopAttributeValue = array();
            } else {
                $shopAttributeValue = array($shopAttributeValue);
            }
        }
        $attributeValue = '';
        if (count($shopAttributeValue) > 1) {
            // if there is more than one attribute value set in the shop, make an array of attribute values
            $attributeValue = array();
        }

        foreach ($matchedAttributeValues as $value) {
            if (!is_array($value['Shop']['Value'])) {
                $aJson = json_decode($value['Shop']['Value'], true);
                if (is_array($aJson)) {
                    $value['Shop']['Value'] = $aJson;
                } else {
                    $value['Shop']['Value'] = array($value['Shop']['Value']);
                }
            }

            if (!is_array($shopAttributeValue)) {
                $shopAttributeValue = array($shopAttributeValue);
            }

            $missingShopValues = array_diff($value['Shop']['Value'], $shopAttributeValue);
            $missingMatchedValues = array_diff($shopAttributeValue, $value['Shop']['Value']);

            if (count($shopAttributeValue) > 1) {
                // if there is more than one attribute value set in the shop, add values to the array
                foreach ($shopAttributeValue as $shopValue) {
                    if ($shopValue == $value['Shop']['Value'][0]) {
                        $attributeValue[] = $value['Marketplace']['Key'];
                    }
                }
            }

            if (count($missingShopValues) === 0 && count($missingMatchedValues) === 0) {
                if ($value['Marketplace']['Key'] === 'manual') {
                    $wordsInInfo = explode('-', $value['Marketplace']['Info']);
                    array_pop($wordsInInfo);
                    $attributeValue = trim(implode('-', $wordsInInfo));
                    break;
                }

                $attributeValue = $value['Marketplace']['Key'];
                break;
            }
        }

        return $attributeValue;
    }
}
