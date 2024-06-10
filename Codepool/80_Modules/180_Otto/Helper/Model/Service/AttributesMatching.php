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

class ML_OTTO_Helper_Model_Service_AttributesMatching extends ML_Modul_Helper_Model_Service_AttributesMatching {

    private function isMultipleAllowed($matchedAttribute) {
        if (empty($matchedAttribute['CategoryId'])) {
            return false;
        }

        $attributes = array();
        try {
            $aResponse = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetCategoryDetails',
                'DATA' => array(
                    'CategoryID' => $matchedAttribute['CategoryId']
                )
            ), 60);

            if ($aResponse['STATUS'] == 'SUCCESS' && isset($aResponse['DATA']) && is_array($aResponse['DATA'])) {
                $attributes = $aResponse['DATA']['attributes'];
            }
        } catch (MagnaException $e) {
        }

        $attributeFieldName = hex2bin($matchedAttribute['MPCode']);
        return !empty($attributes[$attributeFieldName]['multiValue']);
    }

    protected function convertMatchedAttributeValue($matchedAttribute, $attributeValue) {
        if (    !empty($attributeValue) 
            && is_array($attributeValue) 
            && $this->matchedMPAttributeIsText($matchedAttribute) 
            && !$this->isMultipleAllowed($matchedAttribute)
        ) {
            $attributeValue = join(', ', $attributeValue);
        }

        return $attributeValue;
    }
}
