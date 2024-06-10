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

class ML_Ebay_Helper_Model_Table_Ebay_PrepareData extends ML_Form_Helper_Model_Table_PrepareData_Abstract{

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
        if (in_array(strtolower($sField), array('ebayplus', 'secondarycategory', 'storecategory', 'storecategory2'))) {
            $aFieldBackup = $aField;
            $aField = $this->getField($aField);
            if (empty($aField)) {
                $aField = $aFieldBackup; //could be in ebay plus
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
            $this->aErrors[] = 'ml_ebay_prepare_form_category_notvalid';
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
        $aField['value'] = MLModule::gi()->getConfig('paypal.address');
    }
    
    protected function taxField(&$aField) {
        $aField['value'] = $this->getField('mwst', 'value');
    }

    protected function mwstField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        $sConfigValue = (int)MLModule::gi()->getConfig('mwst');
        if($aField['value'] === null && $aField['value'] !== $sConfigValue){
            $aField['value'] = $sConfigValue;
        }
        if($aField['value'] !== '' && $aField['value'] !== null) {
            $aField['value'] = (int)$aField['value'];
        }
    }
    
    protected function postalCodeField(&$aField) {
        $aField['value'] = MLModule::gi()->getConfig('postalcode');
    }
    
    protected function locationField(&$aField) {
        $aField['value'] = MLModule::gi()->getConfig('location');
    }
    
    protected function countryField(&$aField) {
        $aField['value'] = MLModule::gi()->getConfig('country');
    }
    
    protected function skuField(&$aField) {
        $aField['value'] = $this->oProduct->getMarketPlaceSku();
    }
    
    protected function quantityField(&$aField) {
        $aConf = MLModule::gi()->getStockConfig($this->getField('ListingType', 'value'));
        $aField['value'] = $this->oProduct->getSuggestedMarketplaceStock($aConf['type'], $aConf['value'],$aConf['max']);
    }
    
    protected function products_idField(&$aField) {
        $aField['value'] = $this->oProduct->get('id');
    }
    
    protected function startTimeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }
    
    protected function titleField(&$aField) {
        $sValue = $this->getFirstValue($aField, MLModule::gi()->getConfig('template.name'));
        $aMyField = $aField;
        unset($aMyField['value']);
        $oParentProduct = $this->oProduct;
        if ($this->oProduct->get('ParentId') !== '0') {
            $oParentProduct = $this->oProduct->getParent();
        }
        $sPreparedTitle = $this->getFirstValue($aMyField);
        $sParentProductName = $oParentProduct->getName();
        if (
            $sPreparedTitle !== null && //if any title is prepared
            strpos($sValue, $sPreparedTitle) === false &&//prepared title doesn't exist in current product title(it happens by single product)
            $sPreparedTitle !== $sParentProductName && //if prepared title is different from product title
            strpos($sValue, $sParentProductName) === 0//if current product title contain product title(e.g. The variation title contains product title)
        ) {
            $sValue = str_replace($sParentProductName, $sPreparedTitle, $sValue);
        }
        $aField['value'] = $this->replaceTitle($sValue);
    }
    
    public function replaceTitle($sTitle) {
        if ($this->oProduct !== null) {
//          $sBasePrice = $this->getField('BasePriceString', 'value');
            $this->hookEbayTitle($sTitle);
            $aReplace = array(
                '#TITLE#'           => $this->oProduct->getName(),
                '#ARTNR#'           => $this->oProduct->getMarketPlaceSku(),
                '#PID#'             => $this->oProduct->get('marketplaceidentid'),
    //            '#BASEPRICE#'       => $sBasePrice,
            );
            $aReplace['#PRICE#'] = html_entity_decode(MLPrice::factory()->format($this->getField('StartPrice', 'value'), MLModule::gi()->getConfig('currency')), ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, 'UTF-8');
            $sTitle =  str_replace(array_keys($aReplace), array_values($aReplace), $sTitle);
        }
        // Replace &nbsp; (if any) by single spaces
        $sTitle = str_replace('&nbsp;', ' ', $sTitle);
        return trim($sTitle) == '' ? str_replace('&nbsp;', ' ', $this->oProduct->getName()) : $sTitle;
    }
    
    protected function basePriceStringField(&$aField) {
        $fPrice = $this->getField('StartPrice', 'value');
        $aField['value'] = $this->oProduct->getBasePriceString($fPrice);
    }
    
    protected function shortBasePriceStringField(&$aField) {
        $fPrice = $this->getField('StartPrice', 'value');
        $aField['value'] = $this->oProduct->getBasePriceString($fPrice, false);
    }
    
    protected function subtitleField(&$aField) {
        // Helper for php8 compatibility - can't pass null to strip_tags 
        $sShortDescription = MLHelper::gi('php8compatibility')->checkNull($this->oProduct->getShortDescription());
        $aField['value'] = strip_tags($this->getFirstValue($aField, $sShortDescription));
    }
    
    protected function getImageSize() {
        $sSize = MLModule::gi()->getConfig('imagesize');
        $iSize = $sSize == null ? 500 : (int)$sSize;
        return $iSize;
    }
    
    protected function hookEbayDescription(&$sDescription) {
        /* {Hook} "ebaydescription": Enables you to extend or modify the product description (e.g. add substitution) that will be submitted to the marketplace.<br>
            Note: The hook only works when preparing single products or while uploading products to the marketplace.<br>
            Variables that can be used:
            <ul>
                <li>$iMagnalisterProductsId (int): Id of the product in the database table `magnalister_product`.</li>
                <li>$aProductData (array): Data row of `magnalister_product` for the corresponding $iMagnalisterProductsId. The field "productsid" is the product id from the shop.</li>
                <li>$iMarketplaceId (int): Id of marketplace</li>
                <li>$sMarketplaceName (string): Name of marketplace</li>
                <li>&$sDescription (string): description for ebay.</li>
            </ul>
        */
        if (($sHook = MLFilesystem::gi()->findhook('ebaydescription', 1)) !== false) {
            $iMagnalisterProductsId = $this->oProduct->get('id');
            $aProductData = $this->oProduct->data();
            $iMarketplaceId = MLModule::gi()->getMarketPlaceId();
            $sMarketplaceName = MLModule::gi()->getMarketPlaceName();
            require $sHook;
        }
    }

     protected function hookEbayTitle(&$sTitle) {
        /* {Hook} "ebaytitle": Enables you to extend or modify the product title (e.g. add substitution) that will be submitted to the marketplace.<br>
            Note: The hook only works when preparing single products or while uploading products to the marketplace.<br>
            Variables that can be used:
            <ul>
                <li>$iMagnalisterProductsId (int): Id of the product in the database table `magnalister_product`.</li>
                <li>$aProductData (array): Data row of `magnalister_product` for the corresponding $iMagnalisterProductsId. The field "productsid" is the product id from the shop.</li>
                <li>$iMarketplaceId (int): Id of marketplace</li>
                <li>$sMarketplaceName (string): Name of marketplace</li>
                <li>&$sTitle (string): title for ebay.</li>
            </ul>
        */
        if (($sHook = MLFilesystem::gi()->findhook('ebaytitle', 1)) !== false) {
            
            $iMagnalisterProductsId = $this->oProduct->get('id');
            $aProductData = $this->oProduct->data();
            $iMarketplaceId = MLModule::gi()->getMarketPlaceId();
            $sMarketplaceName = MLModule::gi()->getMarketPlaceName();
            require $sHook;
        }
    }
    
    public function replaceDescription($sDescription) {
        if (version_compare(PHP_VERSION, '5.2.0', '>=') && version_compare(PHP_VERSION, '7.0.0', '<')) {
            if (!@ini_set('pcre.backtrack_limit', '10000000') || !ini_set('pcre.recursion_limit', '10000000')) {
                MLMessage::gi()->addDebug('cannot set pcre limits (ini_set)');
            }
        }
        $this->hookEbayDescription($sDescription);
        $oProduct = $this->oProduct;
        $aReplace = $oProduct->getReplaceProperty();
        $aReplace['#PRICE#'] = MLPrice::factory()->format($this->getField('StartPrice', 'value'), MLModule::gi()->getConfig('currency'));
        $sDescription = str_replace(array_keys($aReplace), array_values($aReplace), $sDescription);
        $iSize = $this->getImageSize();
        //images
        $aImages = $oProduct->getImages();
        $iImageIndex = 1;
        foreach ($aImages as $sPath){
            try {
                $aImage = MLImage::gi()->resizeImage($sPath, 'products', $iSize, $iSize);
                $sDescription = preg_replace( '/(url|URL)(\s*)(\()([\'"]{0,1})#PICTURE'.$iImageIndex.'#([\'"]{0,1})(\))/', '\1\2\3\4'.$aImage['url'].'\5\6', $sDescription);
                $sDescription = preg_replace( '/(src|SRC|href|HREF|rev|REV)(\s*=\s*)(\'|")(#PICTURE'.$iImageIndex.'#)/', '\1\2\3'.$aImage['url'], $sDescription);
                $sDescription = str_replace('#PICTURE'.$iImageIndex.'#', "<img src=\"".$aImage['url']."\" style=\"border:0;\" alt=\"\" title=\"\" />", $sDescription);
                $iImageIndex ++;
            }catch(Exception $oEx){
                //no image in fs
            }
        }
        // delete not replaced #PICTUREx#
        $sDescription = preg_replace('/<[^<]*(src|SRC|href|HREF|rev|REV)\s*=\s*(\'|")#PICTURE\d+#(\'|")[^>]*\/*>/', '', $sDescription);
        $sDescription = preg_replace('/#PICTURE\d+#/','', $sDescription);
        // delete empty images
        $sDescription = preg_replace('/<img[^>]*src=(""|\'\')[^>]*>/i', '', $sDescription);
        return $sDescription;
    }
    
    public function replaceDescriptionMobile($sDescription) {
        $sDescription = $this->replaceDescription($sDescription);
        $sDescription = trim(strip_tags($sDescription, '<ol></ol><ul></ul><li></li><br><br/><br />'));
        return $sDescription;
    }
    
    public function replaceDescriptionMain($sDescription) {
        $sMobileTemplateText = '';
        if (
            strpos($sDescription, '#MOBILEDESCRIPTION#') !== false && MLModule::gi()->getConfig('template.mobile.active') == 'true'
        ) {
            $sDescriptionMobile = $this->getField('descriptionmobile', 'value');
            $sMobileTemplateText = empty($sDescriptionMobile) ? '' : 
                    '<div vocab="http://schema.org/" typeof="Product">'
                    . '<span property="description">'.$sDescriptionMobile.'</span>'
                    . '</div>';

            $sMobileDesc = MLModule::gi()->getConfig('template.mobile.content');

            $aPlaceholders = array(
                '#TITLE#',
                '#ARTNR#',
                '#PID#',
                '#PRICE#',
                '#VPE#',
                '#BASEPRICE#',
                '#SHORTDESCRIPTION#',
                '#DESCRIPTION#',
                '#WEIGHT#');
            foreach ($aPlaceholders as $sPlaceholder) {
                if ((strpos($sDescription, $sPlaceholder) !== false) && (strpos($sMobileDesc, $sPlaceholder) !== false)) {
                    $sDescription = str_replace($sPlaceholder, '', $sDescription);
                }
            }
        }
        $sDescription = str_replace('#MOBILEDESCRIPTION#', $sMobileTemplateText, $sDescription);
        return $this->replaceDescription($sDescription);
    }

    public function descriptionField(&$aField) {
        $sDescription = $this->getFirstValue($aField, MLModule::gi()->getConfig('template.content'));
        $aField['value'] =$this->replaceDescriptionMain($sDescription);
    }
    
    public function descriptionMobileField(&$aField) {
        $sValue = $this->getFirstValue($aField, MLModule::gi()->getConfig('template.mobile.content'));
        $aField['value'] = $this->replaceDescriptionMobile($sValue);
    }
    
    protected function asynchronousField(&$aField) {
        $aField['value'] = true;
    }
    
    public function pictureUrlField(&$aField) {
        $aImages = $this->oProduct->getImages();
        if ($this->oProduct->get('parentid') != 0) {
            $aImages = array_merge($aImages, $this->oProduct->getParent()->getImages());
        }
        foreach ($aImages as $sImage) {
            try {
                $aField['values'][$sImage] = MLImage::gi()->resizeImage($sImage, 'products', 80, 80);
            } catch(Exception $oEx) {
                //no image in fs
            }
        }
        if (isset($aField['values'])) {
            reset($aImages);
            $aField['value'] = $this->getFirstValue($aField, array_keys($aField['values']));
            //Remove the false value from pictureUrl and prevent to submite false value.
            if (is_array($aField['value'])) {
                foreach ($aField['value'] as $key => $value) {
                    if ($value === 'false') {
                        unset($aField['value'][$key]);
                    }
                }
                $aField['value'] = empty($aField['value']) ? array_keys($aField['values']) : $aField['value'];
            }
            $aField['value'] = (array) $aField['value'];
        }else{
            $aField['value'] = (array)$this->getFirstValue($aField, $aImages);
        }
    }
    
    protected function galleryTypeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, 'Gallery');
    }
     
    protected function picturePackField(&$aField) {
        $aField['value'] =
            MLModule::gi()->getConfig('picturepack') && MLShop::gi()->addonBooked('EbayPicturePack')
            ? true
            : false
        ;
    }
    
    protected static $aCachedVariationDimensionForPictures = array();
    protected function variationDimensionForPicturesField (&$aField) {
        if (
            MLModule::gi()->getConfig('picturepack')
            && MLShop::gi()->addonBooked('EbayPicturePack')
            && (
                !$this->oProduct instanceof ML_Shop_Model_Product_Abstract
                ||
                $this->oProduct->getVariantCount() > 1
            )
        ) {
            if ($this->oProduct instanceof ML_Shop_Model_Product_Abstract) { // only from product
                $iProductId = $this->oProduct->get('parentid');
                $oMaster = $this->oProduct;
                $this->oProduct = $iProductId == 0 ? $this->oProduct : $this->oProduct->getParent();// getVariants should be always called by master product object
                if(!isset(self::$aCachedVariationDimensionForPictures[$iProductId])){
                    foreach ($this->oProduct->getVariants() as $oVariant) {
                        self::$aCachedVariationDimensionForPictures[$iProductId] = array('' => MLI18n::gi()->get('ConfigFormEmptySelect'));
                        foreach ($oVariant->getVariatonDataOptinalField(array('name', 'code')) as $aVariationData) {
                            self::$aCachedVariationDimensionForPictures[$iProductId][$aVariationData['code']] = $aVariationData['name'];
                        }
                    }
                }
                $aField['values'] = self::$aCachedVariationDimensionForPictures[$iProductId];
                $this->oProduct = $oMaster;
            } else {
                $aField['values'] = array();
                foreach (MLFormHelper::getShopInstance()->getPossibleVariationGroupNames() as $iKey => $sValue) {
                    $aField['values'][$iKey] = $sValue;
                }
            }
            reset ($aField['values']);
            $aField['value'] = $this->getFirstValue($aField, MLModule::gi()->getConfig('variationdimensionforpictures'), key($aField['values']));
        }
    }

    protected static $aCachedVariationPictures = array();
    protected function variationPicturesField(&$aField) {
        if (
            MLModule::gi()->getConfig('picturepack')
            && MLShop::gi()->addonBooked('EbayPicturePack')
            && $this->oProduct instanceof ML_Shop_Model_Product_Abstract
            && $this->oProduct->getVariantCount() > 1
        ) {
            $iProductId = $this->oProduct->get('parentid');
            if(!isset(self::$aCachedVariationPictures[$iProductId])) {
                self::$aCachedVariationPictures[$iProductId] = $aField;
                $sControlValue = $this->getField('VariationDimensionForPictures', 'value');
                if (!empty($sControlValue)) {
                    $aValue = $this->getFirstValue(self::$aCachedVariationPictures[$iProductId], array());
                    foreach ($aValue as $iImageGroup => $aImageGroups) {
                        if ((string)$iImageGroup !== (string)$sControlValue) {
                            unset($aValue[$iImageGroup]);
                        } else {
                            foreach ($aImageGroups as $iImageGroupKey => $aImageGroup) {
                                foreach ($aImageGroup as $iImage => $sImage) {
                                    if ($sImage === 'false') {
                                        unset($aValue[$iImageGroup][$iImageGroupKey][$iImage]);
                                    }
                                }
                            }
                        }
                    }
                    $oMaster = $this->oProduct;
                    $this->oProduct = $iProductId == 0 ? $this->oProduct : $this->oProduct->getParent();// getVariants should be always called by master product object
                    foreach ($this->oProduct->getVariants() as $oVariant) {
                        foreach ($oVariant->getVariatonDataOptinalField(array('code', 'value')) as $aVariationData) {
                            if ($aVariationData['code'] == $sControlValue) {
                                foreach (array_unique($oVariant->getImages()) as $sImage) {
                                    try {
                                        self::$aCachedVariationPictures[$iProductId]['variationpictures'][$aVariationData['code']][$aVariationData['value']]['values'][$sImage] = MLImage::gi()->resizeImage($sImage, 'products', 80, 80);
                                        self::$aCachedVariationPictures[$iProductId]['variationpictures'][$aVariationData['code']][$aVariationData['value']]['title'] = $aVariationData['value'];
                                        self::$aCachedVariationPictures[$iProductId]['default'][$aVariationData['code']][$aVariationData['value']][] = $sImage;
                                    } catch (Exception $oEx) {
                                        //no image in fs
                                    }
                                }
                                if(isset(self::$aCachedVariationPictures[$iProductId]['default'][$aVariationData['code']][$aVariationData['value']])) {
                                    self::$aCachedVariationPictures[$iProductId]['default'][$aVariationData['code']][$aVariationData['value']] = array_unique(self::$aCachedVariationPictures[$iProductId]['default'][$aVariationData['code']][$aVariationData['value']]);
                                    self::$aCachedVariationPictures[$iProductId]['value'][$aVariationData['code']][$aVariationData['value']] = array_unique(
                                        array_key_exists($aVariationData['code'], $aValue) && array_key_exists($aVariationData['value'], $aValue[$aVariationData['code']]) ? $aValue[$aVariationData['code']][$aVariationData['value']] // saved
                                            : self::$aCachedVariationPictures[$iProductId]['default'][$aVariationData['code']][$aVariationData['value']] // default = all
                                    );
                                }
                                break;
                            }
                        }
                    }
                    $this->oProduct = $oMaster;
                }
            }
            $aField = self::$aCachedVariationPictures[$iProductId];
        }
    }

    protected function purgePicturesField(&$aField) {
        $aField['value'] =
            MLModule::gi()->getConfig('picturepack')
            && MLShop::gi()->addonBooked('EbayPicturePack')
        ;
    }

    protected function conditionIdField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, MLModule::gi()->getConfig('acondition'));
    }

    protected function conditionDescriptionField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function conditionDescriptorsField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function startPriceField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject($this->getField('ListingType', 'value')), true));
    }

    protected function strikePriceField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, MLModule::gi()->getConfig('strikeprice.active'));
        if ($aField['value'] === '1') $aField['value'] = 'true';
    }

    protected function strikePriceForUploadField(&$aField) {
        if($this->getField('StrikePrice', 'value') == 'true') {
            //MLMessage::gi()->addDebug(__LINE__.':'.microtime(true), array());
            $aField['value'] = $this->oProduct->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject('strikeprice'));
        }else{
            $aField['value'] = null;
        }
    }

    protected function buyItNowPriceField(&$aField) {
        if($this->getField('ListingType', 'value') == 'Chinese'){
            $sPrice = $this->oProduct->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject('buyitnow'));
            $aField['value'] = $this->getFirstValue($aField, $sPrice);
        }else{
            $aField['value'] = null;
        }
    }
    
    protected function currencyIdField(&$aField) {
        $aField['value'] = MLModule::gi()->getConfig('currency');
    }
    
    protected function siteField(&$aField) {
        $aField['value'] = MLModule::gi()->getConfig('site');
    }
    
    protected function primaryCategoryField(&$aField) {
        $this->_categoryField($aField);
    }
    
    protected function secondaryCategoryField(&$aField){
        $this->_categoryField($aField);
    }
    protected function storeCategoryField(&$aField){
        $this->_categoryField($aField,true);
    }
    protected function storeCategory2Field(&$aField){
        $this->_categoryField($aField,true);
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
        if (count($aList) != 1 ) {
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
            if (is_array($aCatField) && count($aCatField) > 0){
                $aCatField = current($aCatField);
                if (isset($aCatField['attributes'])) {
                    $aField['value'][$iKey] = $aCatField['specifics'];
                }
            }
        }
    }
    
    protected function listingTypeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, key(MLModule::gi()->getListingTypeValues()));
    }
    
    protected function listingDurationField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }
    
    protected function privateListingField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, false);
    }
    
    protected function bestOfferEnabledField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, false);
    }
    
    protected function paymentMethodsField(&$aField) {
        if (!MLHelper::gi('model_form_type_sellerprofiles')->manipulateFieldForSellerProfile($aField, $this->getField('paymentSellerProfile'), 'Payment')) {
            $aField['value'] = $this->getFirstValue($aField, array());
        }
    }
    
    /**
     * compatibility between old config and new prepare
     * @param array $aField
     */
    protected function _shippingField (&$aField) {
        if (!MLHelper::gi('model_form_type_sellerprofiles')->manipulateShippingFieldForSellerProfile($aField, $this->getField('shippingSellerProfile'))) {
            $aField['value'] = array_values($this->getFirstValue($aField, array()));
            $aField['value'] = is_array($aField['value']) ? $aField['value'] : array();
        }
    }
    
    protected function shippingLocalField(&$aField) {
        $this->_shippingField($aField);
    }
    
    protected function shippingInternationalField(&$aField) {
        $this->_shippingField($aField);
    }
    
    protected function shippingLocalDiscountField(&$aField){
        $this->_shippingDiscountField($aField);
    }
    
    protected function shippingInternationalDiscountField(&$aField) {
        $this->_shippingDiscountField($aField);
    }
    
    protected function shippingLocalProfileField(&$aField) {
        $this->_shippingProfileField($aField, MLModule::gi()->getConfig('default.shippingprofile.international'));
    }
    
    protected function shippingInternationalProfileField(&$aField) {
        $this->_shippingProfileField($aField, MLModule::gi()->getConfig('default.shippingprofile.local'));
    }
    
    protected function _shippingProfileField(&$aField, $iDefault) {
        $aField['value'] = $this->getFirstValue($aField,$iDefault);
        MLHelper::gi('model_form_type_sellerprofiles')->manipulateShippingProfileFieldForSellerProfile($aField, $this->getField('shippingSellerProfile'));
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
    
    protected function _topCategoryField(&$aField) {
        $aField['value'] = $this->getField(substr($aField['name'], 3), 'value');
    }

    public $aAttributeMatchingMapping = array();
    protected function variationField(&$aField) {
        $variations = array();
        /* @var $attributesMatchingService ML_Modul_Helper_Model_Service_AttributesMatching */
        $attributesMatchingService = MLHelper::gi('Model_Service_AttributesMatching');
        $iProductId = $this->getCurrentProductMasterId();
        foreach ($this->getField('RawShopVariation', 'value') as $variationDefinition) {
            $convertedVariationDefinition = $attributesMatchingService->convertSingleProductMatchingToNameValue(
                $this->getField('RawAttributesMatching', 'value'),
                $this->oProduct,
                array($variationDefinition['code'])
            );
            $names = array_keys($convertedVariationDefinition);
            $sName = current($names);
            $sValue = current($convertedVariationDefinition);
            if (empty($sName)) {
                    $sName = $variationDefinition['name'];
                    $sValue = $variationDefinition['value'];
            } else {
                $this->aAttributeMatchingMapping[$iProductId]['names'][$variationDefinition['name']] = $sName;
                $this->aAttributeMatchingMapping[$iProductId]['values'][$variationDefinition['value']] = $sValue;
            }
            $variations[] = array(
                'name' => $sName,
                'value' => $sValue,
            );
        }
        $aField['value'] = $variations;
    }

    protected function getCurrentProductMasterId(){
        $iProductId = 0;
        if(is_object($this->oProduct)){
            $iProductId = $this->oProduct->get('parentid');
            if((int)$iProductId === 0){
                $iProductId = $this->oProduct->get('id');
            }
        } else if(is_object($this->oMasterProduct)){
            $iProductId = $this->oMasterProduct->get('id');
        }
        return $iProductId;
    }
    
    protected function paymentInstructionsField(&$aField) {
        $aField['value'] = MLModule::gi()->getConfig('paymentinstructions');
    }
    
    protected function returnPolicyField(&$aField) {
        $aReturnPolicy = array();
        $aReturnPolicy['ReturnsAcceptedOption'] = MLModule::gi()->getConfig('returnpolicy.returnsaccepted');
        if (!isset($aReturnPolicy['ReturnsAcceptedOption']) || empty($aReturnPolicy['ReturnsAcceptedOption'])) {
            $aReturnPolicy['ReturnsAcceptedOption'] = 'ReturnsAccepted';
        }
        $aReturnPolicy['ReturnsWithinOption'] = MLModule::gi()->getConfig('returnpolicy.returnswithin');
        if (empty($aReturnPolicy['ReturnsWithinOption'])) {
            unset($aReturnPolicy['ReturnsWithinOption']);
        }
        $aReturnPolicy['ShippingCostPaidByOption'] = MLModule::gi()->getConfig('returnpolicy.shippingcostpaidby');
        if (empty($aReturnPolicy['ShippingCostPaidByOption'])){
            unset($aReturnPolicy['ShippingCostPaidByOption']);
        }
        $aReturnPolicy['WarrantyDurationOption'] = MLModule::gi()->getConfig('returnpolicy.warrantyduration');
        if (empty($aReturnPolicy['WarrantyDurationOption'])) {
            $aReturnPolicy['WarrantyDurationOption'] = 'none';
        }
        $aReturnPolicy['Description'] = MLModule::gi()->getConfig('returnpolicy.description');
        if (empty($aReturnPolicy['Description'])) {
            unset($aReturnPolicy['Description']);
        }
        $aField['value'] = $aReturnPolicy ;
    }
    
    /**
     *
     * @todo make config, table etc like $sKey... after improve config-form
     */
    protected function shippingDetailsField(&$aField) {
        foreach(array(
            'ShippingServiceOptions'                    => 'shippingLocal',
            'InternationalShippingServiceOption'        => 'shippingInternational',
            'ShippingDiscountProfileID'                 => 'shippingLocalProfile',
            'PromotionalShippingDiscount'               => 'shippingLocalDiscount',
            'InternationalShippingDiscountProfileID'    => 'shippingInternationalProfile',
            'InternationalPromotionalShippingDiscount'  => 'shippingInternationalDiscount',
        ) as $sKey => $sField) {
            if ($this->optionalIsActive($sField) && $this->getField($sField,'value') !== null) {
                $mValue = $this->getField($sField, 'value');
                $aField['value'][$sKey] = $mValue;
            }
        }
        if (isset($aField['value']['ShippingDiscountProfileID']) && isset($aField['value']['ShippingServiceOptions'])) {
            foreach ($aField['value']['ShippingServiceOptions'] as &$aService) {
                $aService['ShippingServiceAdditionalCost'] = MLModule::gi()->getShippingDiscountProfiles($aField['value']['ShippingDiscountProfileID']);
            }
        }
        if (isset($aField['value']['InternationalShippingDiscountProfileID'])) {
            foreach ($aField['value']['InternationalShippingServiceOption'] as &$aService) {
                $aService['ShippingServiceAdditionalCost'] = MLModule::gi()->getShippingDiscountProfiles($aField['value']['InternationalShippingDiscountProfileID']);
            }
        }
        // RateTableDetails: possibly switchable-off by config in the future
        $aField['value']['UseRateTables'] = 'true';
    }
    public function basePriceField(&$aField) {
        $aField['value'] = $this->oProduct->getBasePrice();
    }
    
    public function mpnField(&$aField) {
        $aField['value'] = $this->oProduct->getManufacturerPartNumber();
    }
    
    public function eanField(&$aField) {
        $aField['value'] = $this->oProduct->getEAN();
    }
    
    public function brandField(&$aField) {
        $aField['value'] = $this->oProduct->getModulField('productfield.brand');
    }
    public function tecDocKTypeField(&$aField) {
        $aField['value'] = $this->oProduct->getModulField('productfield.tecdocktype', false, true);
    }
    /**
     * in version 3 we always calculate baseprice in Plugin , because each shopsystem(e.g. Shopware and Prestashop) has different style to show baseprice
     * @param array $aField
     */
    public function doCalculateBasePriceForVariantsField(&$aField) {
        $aField['value'] = 'false';
    }

    public function eBayPlusField(&$aField) {
        $mValue = $this->getFirstValue($aField, false);
        $blEbayPlusActive = true;
        $aSetting = MLModule::gi()->getEBayAccountSettings();
        if(!isset($aSetting['eBayPlus']) || $aSetting['eBayPlus'] != "true"){
            $blEbayPlusActive = false;
        }
        if($blEbayPlusActive && $mValue !== null && $this->getField('ListingType', 'value') !='Chinese'){
            $aField['optional']['active'] = true;
            if(in_array($mValue, array("true" , "false"))){//ebay preapare table "true", "false"
                $aField['value'] = $mValue ;
            }else {//config 1,0
                $aField['value'] = $mValue ? "true" : "false";
            }
        }else{
            $aField = array();
        }
    }

    protected function restrictedToBusinessField(&$aField) {
        if (MLModule::gi()->getConfig('restrictedtobusiness')) {
            $aField['value'] = true;
        }
    }
    
    public function isVariationBasePriceDifferent($aVariations){
        $aVariationBasePrice = array();
        foreach ($aVariations as $aVariation) {
            $aVariationBasePrice[$aVariation['ShortBasePriceString']] = true;
            
        }                                
        return count($aVariationBasePrice) > 1; //not all have same baseprice
    }
    
    public function haveVariationBasePrice($aVariations){
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
        ) ;
    }

    public function manageVariationBasePrice(&$aVariation , $sIsMasterBasePrice){
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
    public function basePriceReplace($mValue, $aData, $iMaxChars = 80) {
        if (isset($aData['ShortBasePriceString'])) {
            $sBasePriceString = $aData['ShortBasePriceString'];
        } elseif (isset($aData['BasePriceString'])) {
            $sBasePriceString = $aData['BasePriceString'];
        } else {
            $sBasePriceString = '';
        }
        $iBasePriceLength = strlen($sBasePriceString);
        $iBasePricePos = strpos($mValue, '#BASEPRICE#');
        // omit double strings (like '5 kg 5 kg (1 EUR / kg)' )
        if (!empty($sBasePriceString)) {
            $sBasePriceQuantity = trim(substr($sBasePriceString, 0, strpos($sBasePriceString, '(')));
            if (    !empty($sBasePriceQuantity)
                 && strpos($mValue, $sBasePriceQuantity) !== false) {
                $sBasePriceString = trim(str_replace($sBasePriceQuantity, '', $sBasePriceString));
            }
        }
        if (
            $iBasePricePos !== false //have #BASEPRICE#
            && strlen($sBasePriceString) != 0 // Baseprice exists
            && $iBasePricePos + 1 + $iBasePriceLength  > $iMaxChars // baseprice is out of string
        ) {
            $mValue = str_replace('#BASEPRICE#', '', $mValue);//remove #BASEPRICE#
            if(function_exists('mb_substr')) {
              $mValue = mb_substr($mValue, 0, $iMaxChars - $iBasePriceLength, 'UTF-8').'#BASEPRICE#';// short string and add #BASEPRICE# to the end
            } else {
              $mValue = substr($mValue, 0, $iMaxChars - $iBasePriceLength).'#BASEPRICE#';// short string and add #BASEPRICE# to the end
            }
        }
        $mValue = str_replace('#BASEPRICE#', $sBasePriceString, $mValue);
        if(function_exists('mb_substr')) {
          $mValue = mb_substr($mValue, 0, $iMaxChars, 'UTF-8');
        } else {
          $mValue = substr($mValue, 0, $iMaxChars);
        }
        return $mValue;
    }
    
    public function sellerProfilesField(&$aField) {
        $aField['value'] = array(
            'Payment' => $this->getField('paymentSellerProfile', 'value'),
            'Shipping' => $this->getField('shippingSellerProfile', 'value'),
            'Return' => $this->getField('returnSellerProfile', 'value'),
        );
    }
    
    public function paymentSellerProfileField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        MLHelper::gi('model_form_type_sellerprofiles')->sellerProfileField($aField, 'payment');
    }
    
    public function returnSellerProfileField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        MLHelper::gi('model_form_type_sellerprofiles')->sellerProfileField($aField, 'return');
    }

    public function shippingSellerProfileField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        MLHelper::gi('model_form_type_sellerprofiles')->sellerProfileField($aField, 'shipping');
    }
    
    public function shippingLocalContainerField(&$aField) {
        MLHelper::gi('model_form_type_sellerprofiles')->manipulateFieldForSellerProfile($aField, $this->getField('shippingSellerProfile'), 'Shipping');
    }
    
    public function shippingInternationalContainerField(&$aField) {
        MLHelper::gi('model_form_type_sellerprofiles')->manipulateFieldForSellerProfile($aField, $this->getField('shippingSellerProfile'), 'Shipping');
    }

    protected function _shippingDiscountField(&$aField) {
        if (!MLHelper::gi('model_form_type_sellerprofiles')->manipulateFieldForSellerProfile($aField, $this->getField('shippingSellerProfile'), 'Shipping')) {
            $aField['value'] = $this->getFirstValue($aField);
        }
        MLHelper::gi('model_form_type_sellerprofiles')->manipulateFieldForSellerProfile($aField, $this->getField('shippingSellerProfile'), 'Shipping');
    }

    protected function ePIDField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function weightField(&$aField) {
        $aField['value'] = $this->oProduct->getWeight();
    }
}
