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

MLFilesystem::gi()->loadClass('Form_Helper_Model_Table_ConfigData_Abstract');

class ML_GoogleShopping_Helper_Model_Table_GoogleShopping_ConfigData extends ML_Form_Helper_Model_Table_ConfigData_Abstract {

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

    /**
     * @param $aField
     */
    public function shippingtemplateField(&$aField) {
        $aShippingTemplates = $this->callApi(array('ACTION' => 'GetShippingTemplates'), 12 * 12 * 60);
        foreach ($aShippingTemplates['services'] as $aShippingTemplate) {
            $aField['values'][self::generateKey($aShippingTemplates['accountId'], $aShippingTemplate)] = self::generateName($aShippingTemplate);
        }
    }

    public function shippingtemplatecountryField(&$aField) {
        $aCountries = $this->callApi(array('ACTION' => 'GetCountries'), 12 * 12 * 60);
        foreach ($aCountries as $sKey => $sCountry) {
            $aField['values'][$sKey] = $sCountry;
        }
    }

    public function googleshopping_currencyField(&$aField) {
        foreach (MLCurrency::gi()->getList() as $currency) {
            $aField['values'][$currency['title']] = $currency['title'];
        }
    }

	public function langField(&$aField)
	{
		$aField['values'] = MLFormHelper::getShopInstance()->getDescriptionValues();
    }

	public function googleshopping_languageField(&$aField)
	{
		global $_MagnaSession;
		$languages = $aField['values'];
		$aField['values'] = array();
		$aField['values'][0] = MLI18n::gi()->get('googleshopping.choose.language');
		$targetCountry = getDBConfigValue('googleshopping.targetcountry',$_MagnaSession['mpID']);
		foreach ($languages[$targetCountry] as $language) {
			$aField['values'][$language['code']] = $language['title'];
		}
		if ($targetCountry !== 'UA') {
			$aField['values'][$languages['GB'][0]['code']] = $languages['GB'][0]['title'];
		}
    }

    public function fixed_price_addkindField(&$aField) {
        $this->price_addKindField($aField);
    }

    public function productTypeField(&$aField) {
        $aField['values'] = $this->callApi(array('ACTION' => 'GetProductTypes'), 12 * 12 * 60);
    }

    public function primaryCategoryField(&$aField) {
        $aRequest = MLRequest::gi()->data();
        if (MLModule::gi()->getMarketPlaceName() . ':' . MLModule::gi()->getMarketPlaceId() . '_prepare_variations' === $aRequest['controller']) {
            $aField['values'] = MLDatabase::factory(MLModule::gi()->getMarketPlaceName() . '_variantmatching')->getTopPrimaryCategories();
        } else {
            $aField['values'] = MLDatabase::factory(MLModule::gi()->getMarketPlaceName() . '_prepare')->getTopPrimaryCategories();
        }
    }

    public function shippingServiceField(&$aField) {
        $aResponse = $this->callApi(array('ACTION' => 'GetShippingServiceDetails'), 12 * 60 * 60);
        $aField['values'] = array();
        foreach ($aResponse as $iServiceId => $aService) {
            $aField['values'][$iServiceId] = $aService['Name'];
        }
    }

    public function order_importonlypaidField(&$aField) {
        $aField['values'] = array(
            1 => MLI18n::gi()->get('ML_BUTTON_LABEL_YES'),
            0 => MLI18n::gi()->get('ML_BUTTON_LABEL_NO'));
    }
}
