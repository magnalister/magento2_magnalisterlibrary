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
class ML_Form_Helper_Controller_Widget_Form_PrepareAMCommon {

    /**
     *
     * @param string $sAttributeCode
     * @return array
     */
    public function getShopAttributeValues($sAttributeCode) {
        $shopValues = MLFormHelper::getShopInstance()->getPrefixedAttributeOptions($sAttributeCode);
        if (!isset($shopValues) || empty($shopValues)) {
            $shopValues = MLFormHelper::getShopInstance()->getAttributeOptions($sAttributeCode);
        }

        return $shopValues;
    }


    /**
     *
     * @param array $aFields
     * @param string $sFirst
     * @param array $aNameWithoutValue
     * @param string $sLast
     * @param array $aField
     * @return mixed
     */
    public function getSelector($aFields, $sFirst, $aNameWithoutValue, $sLast, &$aField) {
        return $aFields[$sFirst.'.'.strtolower($aNameWithoutValue[1]).'.'.strtolower($sLast).'.code']['id'];
    }

    /**
     * Detects if matched attribute is deleted on shop.
     * @param array $savedAttribute
     * @param string $warningMessageCode message code that should be displayed
     * @return boolean
     */
    public function detectIfAttributeIsDeletedOnShop($savedAttribute, &$warningMessageCode) {
        if (!isset($savedAttribute['Code'])) {
            // this will happen only if attribute was matched and then it was deleted from the shop
            $savedAttribute['Code'] = '';
        }

        if (
            $savedAttribute['Code'] === '' ||
            $savedAttribute['Code'] === 'freetext' ||
            $savedAttribute['Code'] === 'attribute_value' ||
            $savedAttribute['Code'] === 'notmatch'
        ) {
            return false;
        }

        $shopAttributes = MLFormHelper::getShopInstance()->getFlatShopAttributesForMatching();

        if (!isset($shopAttributes[$savedAttribute['Code']])) {
            $warningMessageCode = '_varmatch_attribute_deleted_from_shop';
            return true;
        }

        if (isset($savedAttribute['Values']) && is_array($savedAttribute['Values'])) {
            $shopAttributeValues = $this->getShopAttributeValues($savedAttribute['Code']);
            foreach ($savedAttribute['Values'] as $savedAttributeValue) {

                // If attribute is not an array that means that it has single value. It is explicitly casted to
                // an array and then checking function is the same both for single and multi values.
                if (!is_array($savedAttributeValue['Shop']['Key'])) {
                    $savedAttributeValue['Shop']['Key'] = array($savedAttributeValue['Shop']['Key']);
                }

                $missingShopValueKeys = array_diff_key(array_flip($savedAttributeValue['Shop']['Key']), $shopAttributeValues);
                //                MLMessage::gi()->addWarn(microtime(true).'-'.$savedAttribute['AttributeName'],$missingShopValueKeys);

                if (count($missingShopValueKeys) > 0) {

                    $warningMessageCode = '_varmatch_attribute_value_deleted_from_shop';
                    return true;
                }
            }
            return false;
        }

        return false;
    }



    public function getCategoryDetails($sCategoryId) {
        $aCategoryDetails = MagnaConnector::gi()->submitRequestCached(array(
            'ACTION' => 'GetCategoryDetails',
            'DATA' => array('CategoryID' => $sCategoryId),
        ));
        if (MLModule::gi()->isNeededPackingAttrinuteName()) {
            $aCodedKeys = array();
            $attributes = isset($aCategoryDetails['DATA']['attributes']) && isset($aCategoryDetails['DATA']['attributes']) ? $aCategoryDetails['DATA']['attributes'] : array();
            foreach ($attributes as $aCategoryDetail) {
                $aCodedKeys[current(unpack('H*', $aCategoryDetail['name']))] = $aCategoryDetail;
            }
            $aCategoryDetails['DATA']['attributes'] = $aCodedKeys;
        }
        return $aCategoryDetails;
    }

    public function getMPAttributeCode($aParentValue, $aField) {
        return key($aParentValue);
    }


    public function getSName($aName, $aField, $sMPAttributeCode) {
        return 'field['.implode('][', $aName).'][Values]';
    }

    public function shouldCheckOtherIdentifier() {
        return true;
    }

    public function addExtraInfo(&$aField) {

    }

    /**
     * @param $values array
     * @return array
     */
    public function getManipulateMarketplaceAttributeValues($values) {
        return $values;
    }
}
