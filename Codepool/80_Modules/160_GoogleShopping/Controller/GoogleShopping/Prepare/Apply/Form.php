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

MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_PrepareWithVariationMatchingAbstract');



class ML_GoogleShopping_Controller_GoogleShopping_Prepare_Apply_Form extends ML_Form_Controller_Widget_Form_PrepareWithVariationMatchingAbstract {

    /**
     * Get shipping template from Google Shopping
     *
     * @param $aField
     */
    protected function shippingTemplateField(&$aField) {
        $aShippingTemplates = $this->callApi('GetShippingTemplates');
        foreach ($aShippingTemplates['services'] as $sShippingTemplate) {
            $aField['values'][self::generateKey($aShippingTemplates['accountId'], $sShippingTemplate)] = self::generateName($sShippingTemplate);
        }
    }

    protected function callGetCategoryDetails($sCategoryId) {

        $locale = MLModule::gi()->getConfig('googleshopping.language');
        $targetCountry = MLModule::gi()->getConfig('googleshopping.targetcountry');
        $response = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetCategoryDetails',
                'DATA' => array(
                    'categoryId' => $sCategoryId,
                    'targetCountry' => $targetCountry,
                    'Language' => $locale,
                )
            )
        );


        return $response;
    }

    /**
     * @param $accountId
     * @param array $name
     * @return string
     */
    private static function generateKey($accountId, array $name) {
        return sprintf('%s:%s:%s:%s', $accountId, $name['name'], $name['currency'], $name['deliveryCountry']);
    }

    /**
     * @param array $name
     * @return string
     */
    private static function generateName(array $name) {
        return sprintf('%s (%s) (%s)', $name['name'], $name['currency'], $name['deliveryCountry']);
    }
    
}
