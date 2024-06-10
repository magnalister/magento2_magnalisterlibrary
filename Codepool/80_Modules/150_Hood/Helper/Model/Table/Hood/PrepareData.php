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

MLFilesystem::gi()->loadClass('Form_Helper_Model_Table_PrepareData_Abstract');

class ML_Hood_Helper_Model_Table_Hood_PrepareData extends ML_Form_Helper_Model_Table_PrepareData_Abstract {

    /**
     * checks if a field is active, or not
     * force some fields to get full value because after its optional active
     *
     * @param array $aField
     * @param bool $blDefault defaultvalue, if  no request or dont find in prepared
     * @return bool
     */
    public function optionalIsActive($aField) {
        if (is_string($aField)) {
            $sField = $aField;
        } else {
            if (isset($aField['optional']['name'])) {
                $sField = $aField['optional']['name'];
            } else {
                $sField = isset($aField['realname']) ? $aField['realname'] : $aField['name'];
            }
        }
        if (in_array(strtolower($sField), array('secondarycategory', 'storecategory', 'storecategory2', 'storecategory3'))) {
            $aFieldBackup = $aField;
            $aField = $this->getField($aField);
            if (empty($aField)) {
                $aField = $aFieldBackup; //could be in hoodplus
            }
        }
        return parent::optionalIsActive($aField);
    }

    /**
     * @var ML_Shop_Model_Product_Abstract $oMasterProduct
     */
    protected $oMasterProduct = null;

    protected function variationGroups_ValueField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        $aField['optional'] = array('active' => true);

        if (!isset($aField['value']) || $aField['value'] === '') {
            $this->aErrors[] = 'ml_hood_prepare_form_category_notvalid';
        }
    }

    public function getPrepareTableProductsIdField() {
        return 'products_id';
    }

    public function setMasterProduct(ML_Shop_Model_Product_Abstract $oMasterProduct) {
        $this->oMasterProduct = $oMasterProduct;

        return $this;
    }

    protected function dispatchTimeMaxField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function payPalEmailAddressField(&$aField) {
        $aField['value'] = MLModul::gi()->getConfig('paypal.address');
    }

    protected function taxField(&$aField) {
        // forcefallback active or not configured (then behave like before)
        if (    (MLModul::gi()->getConfig('forcefallback') === null)
             || (MLModul::gi()->getConfig('forcefallback') == 1)) {
            $aField['value'] = MLModul::gi()->getConfig('mwst');
            return;
        }
        // Hood.de is a German MP, so we use the German tax rate
        $taxRate = $this->oProduct->getTax(array('Shipping' => array('CountryCode' => 'DE')));
        if ($taxRate !== null) {
            $aField['value'] = $taxRate;
        } else {
            $aField['value'] = MLModul::gi()->getConfig('mwst');
        }
    }

    protected function postalCodeField(&$aField) {
        $aField['value'] = MLModul::gi()->getConfig('postalcode');
    }

    protected function locationField(&$aField) {
        $aField['value'] = MLModul::gi()->getConfig('location');
    }

    protected function countryField(&$aField) {
        $aField['value'] = MLModul::gi()->getConfig('country');
    }

    protected function skuField(&$aField) {
        $aField['value'] = $this->oProduct->getMarketPlaceSku();
    }

    protected function quantityField(&$aField) {
        $aConf = MLModul::gi()->getStockConfig($this->getField('ListingType', 'value'));

        $aField['value'] = $this->oProduct->getSuggestedMarketplaceStock($aConf['type'], $aConf['value'], $aConf['max']);
    }

    protected function products_idField(&$aField) {
        $aField['value'] = $this->oProduct->get('id');
    }

    protected function startTimeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function titleField(&$aField) {
        $sValue = $this->getFirstValue($aField, MLModul::gi()->getConfig('template.name'));
        $aField['value'] = $this->replaceTitle($sValue);
    }

    public function replaceTitle($sTitle) {
        if ($this->oProduct !== null) {
            //          $sBasePrice = $this->getField('BasePriceString', 'value');
            $this->hookHoodTitle($sTitle);
            $aReplace = array(
                '#TITLE#' => $this->oProduct->getName(),
                '#ARTNR#' => $this->oProduct->getMarketPlaceSku(),
                '#PID#'   => $this->oProduct->get('marketplaceidentid'),
                //            '#BASEPRICE#'       => $sBasePrice,
            );
            $aReplace['#PRICE#'] = html_entity_decode(MLPrice::factory()->format($this->getField('Price', 'value'), MLModul::gi()->getConfig('currency')), ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, 'UTF-8');
            $sTitle = str_replace(array_keys($aReplace), array_values($aReplace), $sTitle);
        }
        return trim($sTitle) == '' ? $this->oProduct->getName() : $sTitle;
    }

    protected function basePriceStringField(&$aField) {
        $fPrice = $this->getField('Price', 'value');
        $aField['value'] = $this->oProduct->getBasePriceString($fPrice);
    }

    protected function shortBasePriceStringField(&$aField) {
        $fPrice = $this->getField('Price', 'value');
        $aField['value'] = $this->oProduct->getBasePriceString($fPrice, false);
    }

    protected function subtitleField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function getImageSize() {
        $sSize = MLModul::gi()->getConfig('imagesize');
        $iSize = $sSize == null ? 500 : (int)$sSize;
        return $iSize;
    }

    protected function hookHoodDescription(&$sDescription) {
        /* {Hook} "hooddescription": Enables you to extend or modify the product description (e.g. add substitution) that will be submitted to the marketplace.
          Variables that can be used:
          <ul>
          <li>$iMagnalisterProductsId (int): Id of the product in the database table `magnalister_product`.</li>
          <li>$aProductData (array): Data row of `magnalister_product` for the corresponding $iMagnalisterProductsId. The field "productsid" is the product id from the shop.</li>
          <li>$iMarketplaceId (int): Id of marketplace</li>
          <li>$sMarketplaceName (string): Name of marketplace</li>
          <li>&$sDescription (string): description for hood.</li>
          </ul>
         */
        if (($sHook = MLFilesystem::gi()->findhook('hooddescription', 1)) !== false) {
            $iMagnalisterProductsId = $this->oProduct->get('id');
            $aProductData = $this->oProduct->data();
            $iMarketplaceId = MLModul::gi()->getMarketPlaceId();
            $sMarketplaceName = MLModul::gi()->getMarketPlaceName();
            require $sHook;
        }
    }

    protected function hookHoodTitle(&$sTitle) {
        /* {Hook} "hoodtitle": Enables you to extend or modify the product title (e.g. add substitution) that will be submitted to the marketplace.
          Variables that can be used:
          <ul>
          <li>$iMagnalisterProductsId (int): Id of the product in the database table `magnalister_product`.</li>
          <li>$aProductData (array): Data row of `magnalister_product` for the corresponding $iMagnalisterProductsId. The field "productsid" is the product id from the shop.</li>
          <li>$iMarketplaceId (int): Id of marketplace</li>
          <li>$sMarketplaceName (string): Name of marketplace</li>
          <li>&$sTitle (string): title for hood.</li>
          </ul>
         */
        if (($sHook = MLFilesystem::gi()->findhook('hoodtitle', 1)) !== false) {

            $iMagnalisterProductsId = $this->oProduct->get('id');
            $aProductData = $this->oProduct->data();
            $iMarketplaceId = MLModul::gi()->getMarketPlaceId();
            $sMarketplaceName = MLModul::gi()->getMarketPlaceName();
            require $sHook;
        }
    }

    public function replaceDescription($sDescription) {
        if (version_compare(PHP_VERSION, '5.2.0', '>=') && version_compare(PHP_VERSION, '5.3.6', '<=')) {
            if (!@ini_set('pcre.backtrack_limit', '10000000') || !ini_set('pcre.recursion_limit', '10000000')) {
                MLMessage::gi()->addDebug('cannot set pcre limits (ini_set)');
            }
        }
        $this->hookHoodDescription($sDescription);
        $oProduct = $this->oProduct;
        $aReplace = $oProduct->getReplaceProperty();
        $aReplace['#PRICE#'] = MLPrice::factory()->format($this->getField('Price', 'value'), MLModul::gi()->getConfig('currency'));
        $sDescription = str_replace(array_keys($aReplace), array_values($aReplace), $sDescription);
        $iSize = $this->getImageSize();
        //images
        $aImages = $oProduct->getImages();
        $iImageIndex = 1;
        foreach ($aImages as $sPath) {
            try {
                $aImage = MLImage::gi()->resizeImage($sPath, 'products', $iSize, $iSize);
                $sDescription = preg_replace('/(url|URL)(\s*)(\()([\'"]{0,1})#PICTURE'.$iImageIndex.'#([\'"]{0,1})(\))/', '\1\2\3\4'.$aImage['url'].'\5\6', $sDescription);
                $sDescription = preg_replace('/(src|SRC|href|HREF|rev|REV)(\s*=\s*)(\'|")(#PICTURE'.$iImageIndex.'#)/', '\1\2\3'.$aImage['url'], $sDescription);
                $sDescription = str_replace('#PICTURE'.$iImageIndex.'#', "<img src=\"".$aImage['url']."\" style=\"border:0;\" alt=\"\" title=\"\" />", $sDescription);
                $iImageIndex++;
            } catch (Exception $oEx) {
                //no image in fs
            }
        }
        // delete not replaced #PICTUREx#
        $sDescription = preg_replace('/<[^<]*(src|SRC|href|HREF|rev|REV)\s*=\s*(\'|")#PICTURE\d+#(\'|")[^>]*\/*>/', '', $sDescription);
        $sDescription = preg_replace('/#PICTURE\d+#/', '', $sDescription);
        // delete empty images
        $sDescription = preg_replace('/<img[^>]*src=(""|\'\')[^>]*>/i', '', $sDescription);
        $sDescription = preg_replace(
            '/#('.implode('|', $oProduct->getReplacePropertyCountingKeys()).')\d+#/', '', $sDescription
        );
        return $sDescription;
    }

    public function replaceDescriptionMain($sDescription) {
        return $this->replaceDescription($sDescription);
    }

    public function descriptionField(&$aField) {
        $sDescription = $this->getFirstValue($aField, MLModul::gi()->getConfig('template.content'));
        $aField['value'] = $this->replaceDescriptionMain($sDescription);
    }

    protected function asynchronousField(&$aField) {
        $aField['value'] = true;
    }

    public function imagesField(&$aField) {
        $aImages = $this->oProduct->getImages();
        if ($this->oProduct->get('parentid') != 0) {
            $aImages = array_merge($aImages, $this->oProduct->getParent()->getImages());
        }
        foreach ($aImages as $sImage) {
            try {
                $aField['values'][$sImage] = MLImage::gi()->resizeImage($sImage, 'products', 80, 80);
            } catch (Exception $oEx) {
                //no image in fs
            }
        }
        if (isset($aField['values'])) {
            reset($aImages);
            $aField['value'] = $this->getFirstValue($aField, array_keys($aField['values']));
            $aField['value'] = empty($aField['value']) ? array_keys($aField['values']) : $aField['value'];
            $aField['value'] = (array)$aField['value'];
        } else {
            $aField['value'] = (array)$this->getFirstValue($aField, $aImages);
        }
    }

    protected function picturePackField(&$aField) {
        $aField['value'] = MLModul::gi()->getConfig('picturepack') && MLShop::gi()->addonBooked('HoodPicturePack') ? true : false;
    }


    protected function purgePicturesField(&$aField) {
        $aField['value'] = MLModul::gi()->getConfig('picturepack') && MLShop::gi()->addonBooked('HoodPicturePack');
    }

    protected function ConditionTypeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function noIdentifierFlagField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function priceField(&$aField) {

        $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getSuggestedMarketplacePrice(MLModul::gi()->getPriceObject($this->getField('ListingType', 'value')), true));
    }

    protected function currencyIdField(&$aField) {
        $aField['value'] = MLModul::gi()->getConfig('currency');
    }

    protected function primaryCategoryField(&$aField) {
        $this->_categoryField($aField);
    }

    protected function secondaryCategoryField(&$aField) {
        $this->_categoryField($aField);
    }

    protected function storeCategoryField(&$aField) {
        $this->_categoryField($aField, true);
    }

    protected function storeCategory2Field(&$aField) {
        $this->_categoryField($aField, true);
    }

    protected function storeCategory3Field(&$aField) {
        $this->_categoryField($aField, true);
    }

    protected function _categoryField(&$aField, $blStore = false) {
        $aField['value'] = $this->getFirstValue($aField, '0');
        $aTableInfo = $this->oPrepareList->getModel()->getTableInfo($aField['realname']);
        if (isset($aTableInfo['Null']) && $aTableInfo['Null'] == 'YES') {
            $aField['autooptional'] = false;
            $aField['optional']['active'] = $aField['value'] != '0';
        }
    }

    protected function primaryCategoryAttributesField(&$aField) {
        $this->_attributesField($aField);
    }

    protected function secondaryCategoryAttributesField(&$aField) {
        $this->_attributesField($aField);
    }

    protected function _attributesField(&$aField) {
        $aList = $this->getPrepareList()->get($aField['name'], true);
        if (count($aList) != 1) {
            $aList = '[]';
        }
        $aField['value'] = $this->getFirstValue($aField, $aList, '[]');
    }

    protected function shopVariationField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, array());
    }

    protected function variationThemeBlacklistField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, array());
        if (!empty($aField['value']) && is_string($aField['value'])) {
            $aField['value'] = json_decode(htmlspecialchars_decode($aField['value']), true);
        }
    }

    protected function rawShopVariationField(&$aField) {
        $aField['value'] = $this->oProduct->getPrefixedVariationData();
    }

    protected function rawAttributesMatchingField(&$aField) {
        $aField['value'] = $this->getField('shopVariation', 'value');
    }

    protected function rawVariationThemeBlacklistField(&$aField) {
        $aField['value'] = $this->getField('VariationThemeBlacklist', 'value');
    }

    protected function itemSpecificsField(&$aField) {
        $shopVariations = $this->getField('shopVariation', 'value');
        if (empty($shopVariations)) {
            $this->oldItemSpecificsField($aField);
            return;
        }

        $aField['value'] = array('ShopVariation' => $this->fixShopVariationValues($shopVariations));
    }

    protected function fixShopVariationValues($shopVariations) {
        /* @var $attributesMatchingService ML_Modul_Helper_Model_Service_AttributesMatching */
        $attributesMatchingService = MLHelper::gi('Model_Service_AttributesMatching');
        return $attributesMatchingService->mergeConvertedMatchingToNameValue(
            $shopVariations, $this->oProduct, $this->oMasterProduct
        );
    }

    protected function oldItemSpecificsField(&$aField) {
        foreach (array(1 => 'primaryCategoryAttributes', 2 => 'secondaryCategoryAttributes') as $iKey => $sField) {
            $aCatField = $this->getField($sField, 'value');
            if (is_array($aCatField) && count($aCatField) > 0) {
                $aCatField = current($aCatField);
                if (isset($aCatField['specifics'])) {
                    $aField['value'][$iKey] = $aCatField['specifics'];
                }
            }
        }
    }

    protected function attributesField(&$aField) {
        foreach (array(1 => 'primaryCategoryAttributes', 2 => 'secondaryCategoryAttributes') as $iKey => $sField) {
            $aCatField = $this->getField($sField, 'value');
            if (is_array($aCatField) && count($aCatField) > 0) {
                $aCatField = current($aCatField);
                if (isset($aCatField['attributes'])) {
                    $aField['value'][$iKey] = $aCatField['specifics'];
                }
            }
        }
    }

    protected function listingTypeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, key(MLModul::gi()->getListingTypeValues()));
    }

    protected function listingDurationField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function fskField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, false);
    }

    protected function uskField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, false);
    }

    protected function privateListingField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, false);
        if (empty($aField['value'])) {
            $aField['value'] = '0';
        }
    }

    protected function hitCounterField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function paymentMethodsField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, array());
    }

    /**
     * compatibility between old config and new prepare
     * @param array $aField
     */
    protected function _shippingField(&$aField) {

        $aField['value'] = array_values($this->getFirstValue($aField, array()));
        $aField['value'] = is_array($aField['value']) ? $aField['value'] : array();
    }

    protected function shippingLocalField(&$aField) {
        $this->_shippingField($aField);
    }

    protected function shippingInternationalField(&$aField) {
        $this->_shippingField($aField);
    }

    protected function shippingLocalDiscountField(&$aField) {
        $this->_shippingDiscountField($aField);
    }

    protected function shippingInternationalDiscountField(&$aField) {
        $this->_shippingDiscountField($aField);
    }

    protected function shippingLocalProfileField(&$aField) {
        $this->_shippingProfileField($aField, MLModul::gi()->getConfig('default.shippingprofile.international'));
    }

    protected function shippingInternationalProfileField(&$aField) {
        $this->_shippingProfileField($aField, MLModul::gi()->getConfig('default.shippingprofile.local'));
    }

    protected function _shippingProfileField(&$aField, $iDefault) {
        $aField['value'] = $this->getFirstValue($aField, $iDefault);
    }

    protected function topPrimaryCategoryField(&$aField) {
        $this->_topCategoryField($aField);
    }

    protected function topSecondaryCategoryField(&$aField) {
        $this->_topCategoryField($aField);
    }

    protected function topStoreCategoryField(&$aField) {
        $this->_topCategoryField($aField);
    }

    protected function topStoreCategory2Field(&$aField) {
        $this->_topCategoryField($aField);
    }

    protected function topStoreCategory3Field(&$aField) {
        $this->_topCategoryField($aField);
    }

    protected function _topCategoryField(&$aField) {
        $aField['value'] = $this->getField(substr($aField['name'], 3), 'value');
    }

    protected function variationField(&$aField) {
        $variations = array();
        /* @var $attributesMatchingService ML_Modul_Helper_Model_Service_AttributesMatching */
        $attributesMatchingService = MLHelper::gi('Model_Service_AttributesMatching');
        foreach ($this->getField('RawShopVariation', 'value') as $variationDefinition) {
            $convertedVariationDefinition = $attributesMatchingService->convertSingleProductMatchingToNameValue(
                $this->getField('RawAttributesMatching', 'value'), $this->oProduct, array($variationDefinition['code'])
            );
            $names = array_keys($convertedVariationDefinition);
            $sName = current($names);
            $sValue = current($convertedVariationDefinition);
            if (empty($sName)) {
                $sName = $variationDefinition['name'];
                $sValue = $variationDefinition['value'];
            }
            $variations[] = array(
                'name'  => $sName,
                'value' => $sValue,
            );
        }
        $aField['value'] = $variations;
    }

    protected function paymentInstructionsField(&$aField) {
        $aField['value'] = MLModul::gi()->getConfig('paymentinstructions');
    }

    /**
     *
     * @todo make config, table etc like $sKey... after improve config-form
     */
    protected function shippingDetailsField(&$aField) {
        foreach (array(
                     'ShippingServiceOptions'                   => 'shippingLocal',
                     'InternationalShippingServiceOption'       => 'shippingInternational',
                     'ShippingDiscountProfileID'                => 'shippingLocalProfile',
                     'PromotionalShippingDiscount'              => 'shippingLocalDiscount',
                     'InternationalShippingDiscountProfileID'   => 'shippingInternationalProfile',
                     'InternationalPromotionalShippingDiscount' => 'shippingInternationalDiscount',
                 ) as $sKey => $sField) {
            if ($this->optionalIsActive($sField) && $this->getField($sField, 'value') !== null) {
                $mValue = $this->getField($sField, 'value');
                $aField['value'][$sKey] = $mValue;
            }
        }
        if (isset($aField['value']['ShippingDiscountProfileID']) && isset($aField['value']['ShippingServiceOptions'])) {
            foreach ($aField['value']['ShippingServiceOptions'] as &$aService) {
                $aService['ShippingServiceAdditionalCost'] = MLModul::gi()->getShippingDiscountProfiles($aField['value']['ShippingDiscountProfileID']);
            }
        }
        if (isset($aField['value']['InternationalShippingDiscountProfileID'])) {
            foreach ($aField['value']['InternationalShippingServiceOption'] as &$aService) {
                $aService['ShippingServiceAdditionalCost'] = MLModul::gi()->getShippingDiscountProfiles($aField['value']['InternationalShippingDiscountProfileID']);
            }
        }
        // RateTableDetails: possibly switchable-off by config in the future
        $aField['value']['UseRateTables'] = 'true';
    }

    public function basePriceField(&$aField) {
        $aField['value'] = $this->oProduct->getBasePrice();
    }

    public function manufacturerField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getManufacturer());
    }

    public function manufacturerPartNumberField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getManufacturerPartNumber());
    }

    public function shortDescriptionField(&$aField) {
        // Helper for php8 compatibility - can't pass null to strip_tags 
        $sDescription = MLHelper::gi('php8compatibility')->checkNull($this->getFirstValue($aField, $this->oProduct->getShortDescription()));
        $aField['value'] = substr(trim(strip_tags($sDescription)), 0, 500);
    }

    public function eanField(&$aField) {
        $aField['value'] = $this->oProduct->getEAN();
    }

    /**
     * in version 3 we always calculate baseprice in Plugin , because each shopsystem(e.g. Shopware and Prestashop) has different style to show baseprice
     * @param array $aField
     */
    public function doCalculateBasePriceForVariantsField(&$aField) {
        $aField['value'] = 'false';
    }

    protected function restrictedToBusinessField(&$aField) {
        if (MLModul::gi()->getConfig('restrictedtobusiness')) {
            $aField['value'] = true;
        }
    }

    public function haveVariationBasePrice($aVariations) {
        $iVariationMaxCount = 0;
        $aVariationBasePrice = array();
        foreach ($aVariations as $aVariation) {
            if (!in_array($aVariation['ShortBasePriceString'], $aVariationBasePrice)) {
                $aVariationBasePrice[] = $aVariation['ShortBasePriceString'];
            }
            $iVariationMaxCount = max($iVariationMaxCount, count($aVariation['Variation']));
        }
        return (
            $iVariationMaxCount < 2 //one-dimension
            && count($aVariationBasePrice) > 1 //not all have same baseprice
        );
    }

    public function manageVariationBasePrice(&$aVariation, $sIsMasterBasePrice) {
        foreach ($aVariation['Variation'] as &$aVariationData) {
            if ($sIsMasterBasePrice) { // no Baseprice, just cut end of string
                $aVariationData['value'] = $this->basePriceReplace($aVariationData['value'], $aVariation, 65);
            } else {
                $aVariationData['value'] = $this->basePriceReplace($aVariationData['value'].' #BASEPRICE#', $aVariation, 65);
            }
            unset($aVariation['ShortBasePriceString']);
        }
    }

    /**
     * cuts title, but rescue #BASPRICE#
     * @param string $mValue
     * @param array $aData
     * @return string
     */
    public function basePriceReplace($mValue, $aData, $iMaxChars = 85) {
        if (isset($aData['ShortBasePriceString'])) {
            $sBasePriceString = $aData['ShortBasePriceString'];
        } elseif (isset($aData['BasePriceString'])) {
            $sBasePriceString = $aData['BasePriceString'];
        } else {
            $sBasePriceString = '';
        }
        $iBasePriceLength = strlen($sBasePriceString);
        $iBasePricePos = strpos($mValue, '#BASEPRICE#');
        if (
            $iBasePricePos !== false //have #BASEPRICE#
            && strlen($sBasePriceString) != 0 // Baseprice exists
            && $iBasePricePos + 1 + $iBasePriceLength > $iMaxChars // baseprice is out of string
        ) {
            $mValue = str_replace('#BASEPRICE#', '', $mValue); //remove #BASEPRICE#
            if (function_exists('mb_substr')) {
                $mValue = mb_substr($mValue, 0, $iMaxChars - $iBasePriceLength, 'UTF-8').'#BASEPRICE#'; // short string and add #BASEPRICE# to the end
            } else {
                $mValue = substr($mValue, 0, $iMaxChars - $iBasePriceLength).'#BASEPRICE#'; // short string and add #BASEPRICE# to the end
            }
        }
        $mValue = str_replace('#BASEPRICE#', $sBasePriceString, $mValue);
        if (function_exists('mb_substr')) {
            $mValue = mb_substr($mValue, 0, $iMaxChars, 'UTF-8');
        } else {
            $mValue = substr($mValue, 0, $iMaxChars);
        }
        return $mValue;
    }

    public function shippingLocalContainerField(&$aField) {

    }

    public function shippingInternationalContainerField(&$aField) {

    }

    protected function _shippingDiscountField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    public function weightField(&$aField) {
        $aField['value'] = $this->oProduct->getWeight();
    }

    protected function featuresField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        $aSubmittedFields = MLRequest::gi()->data('field');
        $sKey = (isset($aField['realname']) ? $aField['realname'] : $aField['name']);
        if ($aField['value'] == NULL ||
            (// If it is saving preparation but none of checkboxes are checked
                $aSubmittedFields !== null &&
                !isset($aSubmittedFields[$sKey])
            )
        ) {
            $aField['value'] = array();
        }
    }
}
