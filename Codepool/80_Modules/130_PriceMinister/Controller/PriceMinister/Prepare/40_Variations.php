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
 * (c) 2010 - 2017 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_VariationsAbstract');

class ML_PriceMinister_Controller_PriceMinister_Prepare_Variations extends ML_Form_Controller_Widget_Form_VariationsAbstract {

    /**
     * Gets marketplace attributes for selected category (variation group).
     * Since Priceminister has subcategories as an attribute to parent category, this is removed
     * because it can confuse user.
     *
     * @param string $sVariationValue
     * @return array
     */
    public function getMPVariationAttributes($sVariationValue) {
        $response = MagnaConnector::gi()->submitRequest(array(
            'ACTION' => 'GetCategoryAttributes',
            'DATA' => array('CategoryID' => $sVariationValue))
        );
        $aCategoryAttributes = !empty($response['DATA']) ? $response['DATA'] : array();

        $result = parent::getMPVariationAttributes($sVariationValue);
        // remove attributes that represent category
        foreach ($result as $key => $attribute) {
            if (in_array($key, $aCategoryAttributes)) {
                unset($result[$key]);
            }
        }

        return $result;
    }

    public function resetAction($blExecute = true)
    {
        if ($blExecute) {
            $aActions = $this->getRequest($this->sActionPrefix);
            $reset = $aActions['resetaction'] === '1';
            if ($reset) {
                $aMatching = $this->getRequestField();
                $sIdentifier = $aMatching['variationgroups.value'];
                if ($sIdentifier === 'none') {
                    MLMessage::gi()->addSuccess(self::getMessage('_prepare_variations_saved'));
                    return;
                }

                $oVariantMatching = $this->getVariationDb();
                $oVariantMatching->deleteVariation($sIdentifier);
                MLRequest::gi()->set('resetForm', true);
            }
        }
    }

    /**
     * Checks whether there are some items prepared differently than in Variation Matching tab.
     * If so, adds notice to
     *
     * @param $sIdentifier
     * @param $sIdentifierName
     */
    protected function checkAttributesFromDB($sIdentifier, $sIdentifierName)
    {
        // similar validation exists in ML_Productlist_Model_ProductList_Abstract::isPreparedDifferently
        $aValue = MLDatabase::getVariantMatchingTableInstance()->getMatchedVariations($sIdentifier);

        $oPrepareTable = MLDatabase::getPrepareTableInstance();
        $sShopVariationField = $oPrepareTable->getShopVariationFieldName();

        $aValuesFromPrepare = $oPrepareTable->set($oPrepareTable->getPrimaryCategoryFieldName(), $sIdentifier)->getList();
        $aValuesFromPrepare = $aValuesFromPrepare->get($sShopVariationField);

        if (!empty($aValuesFromPrepare)) {
            foreach ($aValuesFromPrepare as $prepareValue) {
                $this->removeCatAttributes($prepareValue);
                // comparing arrays! do not use '!=='
                if ($prepareValue != $aValue) {
                    MLMessage::gi()->addNotice(self::getMessage('_prepare_variations_notice', array('category_name' => $sIdentifierName)));
                    return;
                }
            }
        }
    }

    private function removeCatAttributes(&$attributes) {
        // remove attributes that represent category
        foreach ($attributes as $key => $attribute) {
            if (substr($key, 0, 3) === 'cat') {
                unset($attributes[$key]);
            }
        }
    }
}
