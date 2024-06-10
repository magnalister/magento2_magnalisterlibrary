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
ini_set('xdebug.max_nesting_level', 200);
MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_PrepareWithVariationMatchingAbstract');

class ML_PriceMinister_Controller_PriceMinister_Prepare_Apply_Form extends ML_Form_Controller_Widget_Form_PrepareWithVariationMatchingAbstract {
    protected function categoriesField(&$aField) {
        $aField['subfields']['primary']['values'] = array('' => '..')
            + ML::gi()->instance('controller_priceminister_config_prepare')->getField('primarycategory', 'values');

        foreach ($aField['subfields'] as &$aSubField) {
            //adding current cat, if not in top cat
            if (!array_key_exists($aSubField['value'], $aSubField['values'])) {
                $oCat = MLDatabase::factory('priceminister_categories' . $aSubField['cattype']);
                $oCat->init(true)->set('categoryid', $aSubField['value'] ? $aSubField['value'] : 0);
                $sCat = '';
                foreach ($oCat->getCategoryPath() as $oParentCat) {
                    $sCat = $oParentCat->get('categoryname') . ' &gt; ' . $sCat;
                }

                $aSubField['values'][$aSubField['value']] = substr($sCat, 0, -6);
            }
        }
    }

    protected function itemConditionField(&$aField) {
        $aField['values'] = $this->callApi('GetItemConditions');
    }

    /**
     * Get attributes that represent subcategories. These attributes are rendered separately
     * because they could confuse user if they are rendered inside attributes matching.
     *
     * @param string $categoryId Identifier of a category to get subcategories.
     * @return array
     */
    protected function getCategoryAttributes($categoryId) {
        $response = MagnaConnector::gi()->submitRequest(array('ACTION' => 'GetCategoryAttributes', 'DATA' => array('CategoryID' => $categoryId)));
        $result = !empty($response['DATA']) ? $response['DATA'] : array();

        // Get MP attributes because that call will prepare attributes as they should be rendered.
        // Do not call $this->getMPVariationAttributes method because it will cause circular reference (stack overflow).
        $mpAttributes = parent::getMPVariationAttributes($categoryId);
        $catAttributes = array();
        foreach ($mpAttributes as $key => $attribute) {
            if (in_array($key, $result)) {
                $catAttributes[$key] = $attribute;
            }
        }

        return $catAttributes;
    }

    /**
     * Gets marketplace attributes for selected category (variation group).
     * Since Priceminister has subcategories as an attribute to parent category, this is removed
     * because it can confuse user.
     *
     * @param string $sVariationValue
     * @return array
     */
    public function getMPVariationAttributes($sVariationValue) {
        $result = parent::getMPVariationAttributes($sVariationValue);
        $this->removeCatAttributes($result, $sVariationValue);

        return $result;
    }

    /**
     * Saves prepare attributes to AM table if it does not exist.
     *
     * @param ML_Database_Model_Table_VariantMatching_Abstract $oVariantMatching
     * @param string $sIdentifier
     * @param string $sCustomIdentifier
     * @param array $aMatching
     */
    protected function saveToAttributesMatchingTable($oVariantMatching, $sIdentifier, $sCustomIdentifier, $aMatching) {
        $aShopVariation = $oVariantMatching
            ->set('Identifier', $sIdentifier)
            ->set('CustomIdentifier', $sCustomIdentifier)
            ->get('ShopVariation');

        if (!isset($aShopVariation)) {
            $this->removeCatAttributes($aMatching, $sIdentifier);

            $oVariantMatching
                ->set('Identifier', $sIdentifier)
                ->set('CustomIdentifier', $sCustomIdentifier)
                ->set('ShopVariation', json_encode($aMatching))
                ->set('ModificationDate', date('Y-m-d H:i:s'))
                ->save();
        }
    }

    protected function getAttributeValues($sIdentifier, $sCustomIdentifier, $sAttributeCode = null, $bFreeText = false) {
        $result = parent::getAttributeValues($sIdentifier, $sCustomIdentifier, $sAttributeCode, $bFreeText);
        if ($sAttributeCode === null) {
            $this->removeCatAttributes($result, $sIdentifier);
        }

        return $result;
    }

    /**
     * Removes attributes that represent subcategories from supplied array of attributes.
     * @param array $attributes
     * @param string $sIdentifier Category identifier
     */
    private function removeCatAttributes(&$attributes, $sIdentifier) {
        $aCategoryAttributes = $this->getCategoryAttributes($sIdentifier);
        foreach ($attributes as $key => $attribute) {
            if (isset($aCategoryAttributes[$key])) {
                unset($attributes[$key]);
            }
        }
    }
}
