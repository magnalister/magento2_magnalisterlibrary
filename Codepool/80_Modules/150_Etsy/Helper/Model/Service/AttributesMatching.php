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
MLFilesystem::gi()->loadClass('Modul_Helper_Model_Service_AttributesMatching');

class ML_Etsy_Helper_Model_Service_AttributesMatching extends ML_Modul_Helper_Model_Service_AttributesMatching {


    /**
     * @param $product ML_Shop_Model_Product_Abstract
     * @param $attributesToUpload
     * @param $marketplaceAttributeCode
     * @param $attributeData
     * @param $attributeName
     * @param $attributeValue
     * @return mixed
     */
    protected function convertSingleProductMatchingToNameValueManipulate($product, $attributesToUpload, $marketplaceAttributeCode, $attributeData, $attributeName, $attributeValue) {
        //MLMessage::gi()->addDebug(__LINE__.':'.microtime(true), array($attributesToUpload,$attributeData, $attributeName, $attributeValue));
        $propertyId = $marketplaceAttributeCode;
        if (!empty($attributeData['AttributeId'])) {
            $propertyId = $attributeData['AttributeId'];
        }
        $values = array();
        if (strpos($attributeValue, '-') !== false && isset($attributeData['Kind']) && $attributeData['Kind'] === 'Matching') {
            $array = explode('-', $attributeValue);
            $propertyId = $array[0];
            $valueIds = $array[1];
            if (count($array) > 2) {
                $values = $array[2];
                $values = array($values);
            }
            $valueIds = array($valueIds);
        } else {
            $valueIds = array($attributeValue);
            $values = array($attributeValue);
        }
        $shopVariantAttribute = array();
        foreach ($product->getVariatonDataOptinalField(array('value', 'code', 'name')) as $aVariationData) {
            if ($attributeData['Code'] === $aVariationData['code']) {
                $shopVariantAttribute = array(
                    'value' => $aVariationData['value'],
                    'name'  => $aVariationData['name'],
                );
            }
        }
        $values = empty($values) && isset($shopVariantAttribute['value']) ? $shopVariantAttribute['value'] : $values;
        $aEtsyAttribute = array(
            'property_id'   => $propertyId,
            'value_ids'     => $valueIds,
            'property_name' => ucfirst($attributeName),
            'values'        => is_array($values) ? $values : array(),
        );
        if (isset($shopVariantAttribute[$attributeData['Code']])) {
            $attributeValue = $shopVariantAttribute[$attributeData['Code']];
        }
        $attributeGroups = MLFormHelper::getShopInstance()->getFlatShopAttributesForMatching();
        $sShopAttributeGroupCode = $attributeData['Code'];
        if (isset($attributeGroups[$sShopAttributeGroupCode]['name'])) {
            $attributeName = $attributeGroups[$sShopAttributeGroupCode]['name'];
        }
        //MLMessage::gi()->addDebug(__LINE__.':'.microtime(true), array($attributeName, $attributeGroups, $sShopAttributeGroupCode));

        $aEtsyAttribute = $this->checkEtsyCustomAttribute($aEtsyAttribute, $attributeValue, $attributeName, $marketplaceAttributeCode);
        $attributesToUpload[] = $aEtsyAttribute;
        return $attributesToUpload;
    }

    protected function checkEtsyCustomAttribute($attributeData, $attributeValue, $attributeName, $marketplaceAttributeCode) {
        if ($marketplaceAttributeCode === 'Custom1') {
            $attributeData = array(
                'property_id'   => 513,
                'value_ids'     => array(),
                'property_name' => $attributeName,
                'values'        => array($attributeValue)
            );
        } else if ($attributeData['property_id'] === 'Custom2') {
            $attributeData = array(
                'property_id'   => 514,
                'value_ids'     => array(),
                'property_name' => $attributeName,
                'values'        => array($attributeValue),
            );
        }
        return $attributeData;
    }

    protected function marketplaceSpecific($Marketplace) {
        $attribute = null;
        if (strpos($Marketplace['Key'], '-') !== false) {
            $wordsInInfo = explode('-', $Marketplace['Info']);
            array_pop($wordsInInfo);
            $attribute = $Marketplace['Key'].'-'.trim(implode(' - ', $wordsInInfo));
        }
        return $attribute;
    }
}
