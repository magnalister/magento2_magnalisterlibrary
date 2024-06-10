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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_VariationsAbstract');

class ML_GoogleShopping_Controller_GoogleShopping_Prepare_Variations extends ML_Form_Controller_Widget_Form_VariationsAbstract {

    private $targetCountry;
    private $language;

    public function __construct()
    {
        parent::__construct();
        $this->language = MLModule::gi()->getConfig('shop.language');
        $this->targetCountry = MLModule::gi()->getConfig('targetcountry');
    }

    /**
     * Resolving issues with 'attribute matching' tab under 'prepare items' tab
     * @param $sCategoryId
     * @return mixed
     */
    protected function callGetCategoryDetails($sCategoryId)
    {
        return MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetCategoryDetails',
                'DATA' => [
                    'categoryId' => $sCategoryId,
                    'targetCountry' => $this->targetCountry,
                    'Language' => $this->language
                ])
        );
    }

    /**
     * Resolving issues with 'attribute matching' tab under 'prepare items' tab
     * @param $sCategoryId
     * @param $sMpAttributeCode
     * @param bool $sAttributeCode
     * @return array
     */
    protected function getMPAttributeValues($sCategoryId, $sMpAttributeCode, $sAttributeCode = false)
    {
        $response = MagnaConnector::gi()->submitRequestCached(array(
            'ACTION' => 'GetCategoryDetails',
            'DATA' => [
                'categoryId' => $sCategoryId,
                'targetCountry' => $this->targetCountry,
                'Language' => $this->language
            ]));

        $fromMP = false;
        foreach ($response['DATA']['attributes'] as $key => $attribute) {
            if ($key === $sMpAttributeCode && !empty($attribute['values'])) {
                $aValues = $attribute['values'];
                $fromMP = true;
                break;
            }
        }

        if (!isset($aValues)) {
            if ($sAttributeCode) {
                $shopValues = $this->getShopAttributeValues($sAttributeCode);
                foreach ($shopValues as $value) {
                    $aValues[$value] = $value;
                }
            } else {
                $aValues = array();
            }
        }

        return array(
            'values' => isset($aValues) ? $aValues : array(),
            'from_mp' => $fromMP
        );
    }

}
