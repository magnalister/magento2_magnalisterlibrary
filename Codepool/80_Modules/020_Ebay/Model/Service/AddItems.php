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

class ML_Ebay_Model_Service_AddItems extends ML_Modul_Model_Service_AddItems_Abstract {

    protected $sVariationDimensionForPictures = null;
    
    /**
     * needed to get correct index for variationimages (if value of varition have baseprice added)
     * @var array $aVariationTranslation
     */
    protected $aVariationTranslationBasePrice = array();
    
    protected $blCheckVariantQuantity = false;

    /**
     * data of product that should be sent to ebay
     * @var array
     */
    protected $aOut = array();
    
    /**
     * category condition
     * @var array
     */
    protected $aCatCondition;
    
    /**
     * if category support variation
     * @var boolean
     */
    protected $blMasterVariant;


    /**
     * Current master product object
     * @var ML_Shop_Model_Product_Abstract
     */
    protected $oCurrentProduct = null;

    /**
     * Current variation object if exists, it is useful when we want to send each variation as single product
     * @var ML_Shop_Model_Product_Abstract
     */
    protected $oCurrentVariant = null;

    protected static $aCachedVariationDimensionForPictures = array();

    public function setValidationMode($blValidation) {
        $this->sAction = $blValidation ? 'VerifyAddItems' : 'AddItems';
        return $this;
    }

    protected function getProductArray() {
        $this->aOut = array();
        try {
            $blMasterVariant = $this->getCategoryVariationStatus();
            $blConfigUseVariation = MLModule::gi()->getConfig('usevariations') == '1';
            if (!$blConfigUseVariation) {
                //if variation is disable in configuration
                $this->setOnlyMaster();
            } else
                if ($blMasterVariant) {
                    $this->setMasterVariation();
                } else {//all variants transferred as single master article
                    $this->setVariationsAsSingle();
                }
        } catch (Exception $oEx) {
            $this->handleException($oEx);
        }
        return $this->aOut;
    }
    
    
    /**
     * set only master product, if variation are disabled
     */
    protected function setOnlyMaster() {
        foreach ($this->oList->getList() as $oMaster) {
            /* @var $oMaster ML_Shop_Model_Product_Abstract */
            $this->oCurrentProduct = $oMaster;
            $oVariant = current($this->oList->getVariants($oMaster));
            $this->aOut[$oMaster->get('id')] = $this->replacePrepareData(
            $this->getPrepareHelper()
                    ->setPrepareList(null)
                    ->setProduct($oVariant)
                    ->setMasterProduct($oMaster)
                    ->getPrepareData($this->getFieldDefineComplete(), 'value')
            );
            $this->aOut[$oMaster->get('id')]['rawDescription'] = stringToUTF8(html_entity_decode(fixHTMLUTF8Entities(MLProduct::factory()->set('id', $oMaster->get('id'))->getDescription())));
            $this->setTaxToZero($this->aOut[$oMaster->get('id')]);
        }
    }
    
    /**
     * set variation as single product, the category doesn't support variations
     */
    protected function setVariationsAsSingle() {
        $aDefineComplete = $this->getFieldDefineComplete();
        foreach ($this->oList->getList() as $oMaster) {
            $this->oCurrentProduct = $oMaster;
            /* @var $oMaster ML_Shop_Model_Product_Abstract */
            $aListOfVariant = $this->oList->getVariants($oMaster);
            $iVariantCount = count($aListOfVariant);
            foreach ($aListOfVariant as $oVariant) {
                /* @var $oVariant ML_Shop_Model_Product_Abstract **/
                if ($this->oList->isSelected($oVariant)) {
                    $this->oCurrentVariant = $oVariant;
                    $oPrepareHelper =$this->getPrepareHelper();
                    $oPrepareHelper
                            ->setPrepareList(null)
                            ->setProduct($oVariant)
                            ->setMasterProduct($oMaster);
                    if ($iVariantCount > 1) {
                        $aDefineComplete['Title']['value'] = $oPrepareHelper->replaceTitle(MLModule::gi()->getConfig('template.name'));
                    }

                    $aPrepareData = $oPrepareHelper->getPrepareData($aDefineComplete, 'value');
                    $aPrepareData['PictureURL'] = $this->variationImageAsSingleProductImage($aPrepareData['PictureURL'], $oVariant);

                    $this->setTaxToZero($aPrepareData);
                    $this->aOut[$oVariant->get('id')] = $this->replacePrepareData(
                            $aPrepareData
                    );
                    $this->aOut[$oVariant->get('id')]['rawDescription'] = stringToUTF8(html_entity_decode(fixHTMLUTF8Entities(MLProduct::factory()->set('id', $oVariant->get('id'))->getDescription())));
                    $this->aOut[$oVariant->get('id')]['IsSplit'] = 1;
                    unset($this->aOut[$oVariant->get('id')]['BasePriceString']);
                }
            }
        }
    }

    protected function getCategoryVariationStatus(){
        // (master and variant) or (variants as master)
        $blMasterVariant = false;
        $this->aCatCondition = array();
        $blBreak = false;
        foreach ($this->oList->getList() as $oMaster) {
            /* @var $oMaster ML_Shop_Model_Product_Abstract */
            $aVariants = $this->oList->getVariants($oMaster);
            foreach ($aVariants as $oVariant) {
                /* @var $oVariant ML_Shop_Model_Product_Abstract */
                if ($this->oList->isSelected($oVariant)) {
                    $aCategoryData = $this->getPrepareHelper()
                        ->setPrepareList(null)
                        ->setProduct($oVariant)
                        ->setMasterProduct($oMaster)
                        ->getPrepareData(array('PrimaryCategory' => array('optional' => array('active' => true))));
                    $oEabyCategory = MLDatabase::factory('ebay_categories')
                        ->set('categoryid', $aCategoryData['PrimaryCategory']['value']);
                    $blMasterVariant = $oEabyCategory
                        ->variationsEnabled();
                    $this->aCatCondition = $oEabyCategory
                        ->getConditionValues();
                    $blBreak = true;
                    break;
                }
            }
            if ($blBreak) {
                break;
            }
        }
        return $blMasterVariant;
    }
    
    /**
     * set variation in master product data
     */
    protected function setMasterVariation() {
        $aDefineMasterMaster = $this->getFieldDefineMasterMaster();
        $aDefineMasterVariant = $this->getFieldDefineMasterVariant();
        $aDefineVariant = $this->getFieldDefineVariant();
        $oPrepareHelper = $this->getPrepareHelper();
        foreach ($this->oList->getList() as $oMaster) {
            /* @var $oMaster ML_Shop_Model_Product_Abstract */
            $this->oCurrentProduct = $oMaster;
            $aVariants = array();
            foreach ($this->oList->getVariants($oMaster) as $oVariant) {
                /* @var $oVariant ML_Shop_Model_Product_Abstract */
                if ($this->oList->isSelected($oVariant)) {
                    $aVariants[] = $oVariant;
                }
            }
            if (count($aVariants) == 1 && current($aVariants)->getVariatonData() == array()) {
                //master only
                $this->aOut[$oMaster->get('id')] = $this->replacePrepareData(
                        $oPrepareHelper
                                ->setPrepareList(null)
                                ->setProduct($oVariant)
                                ->setMasterProduct($oMaster)
                                ->getPrepareData($this->getFieldDefineComplete(), 'value')
                );
                $this->aOut[$oMaster->get('id')]['rawDescription'] = stringToUTF8(html_entity_decode(fixHTMLUTF8Entities(MLProduct::factory()->set('id', $oMaster->get('id'))->getDescription())));
            } else {
                $oFirstVariant = current($aVariants);
                $oPrepareList = MLDatabase::factory(MLModule::gi()->getMarketPlaceName() . '_prepare')->getList();
                $oPrepareList->getQueryObject()->where($oPrepareHelper->getPrepareTableProductsIdField() . " = '" . $oFirstVariant->get('id') . "'");
                foreach (array('Title', 'Description', 'PictureURL', 'GalleryType', 'Subtitle', 'StartPrice', 'StartTime', 'BuyItNowPrice') as $sField) {
                    $aPrepared = $oPrepareList->get($sField, true);
                    if (count($aPrepared) > 0 && !in_array(null, $aPrepared, true)) {
                        $aDefineMasterVariant[$sField] = $aDefineMasterMaster[$sField];
                        unset($aDefineMasterMaster[$sField]);
                    }
                }
                $aMasterData = $oPrepareHelper
                        ->setPrepareList(null)
                        ->setProduct($oMaster)
                        ->setMasterProduct($oMaster)
                        ->getPrepareData($aDefineMasterMaster, 'value');
                // set first variation data to master
                foreach ($oPrepareHelper
                        ->setPrepareList(null)
                        ->setProduct($oFirstVariant)
                        ->setMasterProduct($oMaster)
                        ->getPrepareData($aDefineMasterVariant, 'value')
                as $sKey => $mValue) {
                    $aMasterData[$sKey] = $mValue;
                }

                $aMasterData['ShopProductInstance'] = $oMaster;
                $aMasterData['Variations'] = array();
                $aMasterData['Quantity'] = 0;
                foreach ($aVariants as $oVariant) {
                    /* @var $oVariant ML_Shop_Model_Product_Abstract */
                    $aPreparedVariant = $this->replacePrepareData($oPrepareHelper
                                    ->setPrepareList(null)
                                    ->setProduct($oVariant)
                                    ->setMasterProduct($oMaster)
                                    ->getPrepareData($aDefineVariant, 'value')
                    );

                    $aPreparedVariant['ShopProductInstance'] = $oVariant;
                    $aMasterData['Variations'][] = $aPreparedVariant;
                    $aMasterData['Quantity'] += (int) $aPreparedVariant['Quantity']; //when Product have several variants , master quantity is sum of all variants quantity
                }
                if (count($aMasterData['Variations']) == 1 && $aMasterData['Variations'][0]['Variation'] == array()) {//is master
                    $aMasterData = array_merge($aMasterData, $aMasterData['Variations'][0]);
                    $this->unsetShopRawData($aMasterData);
                    unset($aMasterData['Variation'], $aMasterData['Variations'], $aMasterData['VariationPictures'], $aMasterData['VariationDimensionForPictures']);
                } else {
                    //remove base price from master and variation if they have different baseprice, eBay suport only baseprice for master product, that is not reasonable to show baseprice in this situation
                    if ($oPrepareHelper->isVariationBasePriceDifferent($aMasterData['Variations'])) {
                        MLMessage::gi()->addWarn(MLI18n::gi()->get('ML_EBAY_NO_BASEPRICE_FOR_VARIATIONS_WITH_DIFFERENT_BASEPRICE', array('SKU' => $aMasterData['SKU'])));
                        MLErrorLog::gi()->addError(
                            $oMaster->get('id'),
                            $aMasterData['SKU'],
                            strip_tags(MLI18n::gi()->get('ML_EBAY_NO_BASEPRICE_FOR_VARIATIONS_WITH_DIFFERENT_BASEPRICE', array('SKU' => $aMasterData['SKU']))),
                            array(
                                'SKU' => $aMasterData['SKU'],
                                'origin' => 'magnalister',
                            )
                        );

                        $aMasterData['BasePrice'] = array();
                        foreach ($aMasterData['Variations'] as &$aVariation) {
                            $aVariation['BasePrice'] = array();
                        }
                    }
                    if ($oPrepareHelper->haveVariationBasePrice($aMasterData['Variations'])) {// => so we dont show it in main-title
                        unset($aMasterData['BasePriceString']);
                    }

                    foreach ($aMasterData['Variations'] as $sKey => &$aVariation) {
                        $blFoundNotMatch = false;
                        foreach ($aVariation['Variation'] as $aDimension){
                            if($aDimension['value'] === 'notmatch'){
                                $blFoundNotMatch = true;
                                break;
                            }
                        }
                        if($blFoundNotMatch){
                            unset($aMasterData['Variations'][$sKey]);
                            continue;
                        }
                        if (isset($aMasterData['BasePriceString'])) {
                            $oPrepareHelper->manageVariationBasePrice($aVariation, true);
                        } else {// variations can have baseprice
                            $iKey = key($aVariation['Variation']);
                            $sOld = $aVariation['Variation'][$iKey]['value'];
                            $oPrepareHelper->manageVariationBasePrice($aVariation, false);
                            $this->aVariationTranslationBasePrice[$sOld] = $aVariation['Variation'][$iKey]['value'];
                        }
                        $aVariation = $this->replacePrepareData($aVariation);
                    }
                    // if some items of array are removed, array_values should be used to reset numeric index in array
                    $aMasterData['Variations'] = array_values($aMasterData['Variations']);
                }
                $aMasterData = $this->replacePrepareData($aMasterData);
                unset($aMasterData['BasePriceString']);
                $this->aOut[$oMaster->get('id')] = $aMasterData;
            }
            $this->setTaxToZero($this->aOut[$oMaster->get('id')]);
            $this->aOut[$oMaster->get('id')]['rawDescription'] = stringToUTF8(html_entity_decode(fixHTMLUTF8Entities(MLProduct::factory()->set('id', $oMaster->get('id'))->getDescription())));
        }
    }

    /**
     * Set tax to string 'zero' in case the tax is set to 0
     * and customer wants to include the tax in the price
     *
     * @param $aMasterData
     * @return void
     */
    private function setTaxToZero(&$aMasterData){
        if (isset($aMasterData['Tax']) && $aMasterData['Tax'] == 0) {
            if (MLModule::gi()->getConfig('mwst.always')) {
                $aMasterData['Tax'] = 'zero';
            }
        }
    }
    
    protected function variationImageAsSingleProductImage($aPreparedImages, $oVariant){
        $aVariatioImages = array();
        $aImages = $oVariant->getImages(); 
        foreach ($aImages as $sImage) {
                if(in_array($sImage, $aPreparedImages)){
                    $aVariatioImages[] = $sImage;
                }
        }
        return $aVariatioImages;
    }
    
    protected function checkQuantity() {
        if ($this->sAction == 'VerifyAddItems') {
            return true;
        }
        return parent::checkQuantity();
    }

    /*
     * Special case for eBay Catalog Items:
     * Ignore the "Catalog Required" Errors within Preparation (Verify),
     * cos we do the automatching only when we really add Items
     */
    protected function handleException($oEx) {
        //new dBug($oEx->getErrorArray());
        if ($this->sAction == 'VerifyAddItems' && method_exists($oEx, 'getErrorArray')) {
            $aErrorArray = $oEx->getErrorArray();
            foreach ($aErrorArray['ERRORS'] as $i => $aErr) {
                if (    strpos($aErr['ERRORMESSAGE'], '21920000')
                     || strpos($aErr['ERRORMESSAGE'], '21920064')
                     || strpos($aErr['ERRORMESSAGE'], '21920071')
                ) {
                    unset($aErrorArray['ERRORS'][$i]);
                }
            }
            if (!count($aErrorArray['ERRORS'])) return;
        }
        MLMessage::gi()->addError($oEx, '', false);
        $this->aError[] = $oEx->getMessage();
    }


    protected function hasAttributeMatching()
    {
        return true;
    }

    /**
     * Filter request data based on what needs to be skipped and do splitting if needed.
     */
    protected function filterAndSplitSubmitData()
    {
        $submitData = array();
        $submitOldProductData = array();
        foreach ($this->aData as $product) {
            // If product is prepared with old AM don't do any new AM logic
            if (empty($product['ItemSpecifics']['ShopVariation']) || isset($product['IsSplit'])) {
                $this->unsetShopRawData($product);
                $submitOldProductData[] = $product;
            } else {
                // General AM splitting logic expects ItemTitle instead of Title, so we must prepare product for that
                $product['ItemTitle'] = $product['Title'];
                $submitData[] =$product;
            }
        }

        $this->aData = $submitData;
        parent::filterAndSplitSubmitData();
        $this->aData = array_merge($submitOldProductData, $this->aData);

        // Make sure master product quantity is sum of all its variation quantities after splitting, that
        // variation attributes are not in itemspecifics and that single variation products are sent as master only
        foreach ($this->aData as &$masterProduct) {
            if (empty($masterProduct['Variations'])) {
                continue;
            }

            $masterProduct['Quantity'] = 0;
            $oFirstVariant = reset($masterProduct['Variations']);
            if (!empty($oFirstVariant['ItemSpecifics'])) {
                $masterProduct['ItemSpecifics'] = $oFirstVariant['ItemSpecifics'];
            }

            foreach ($masterProduct['Variations'] as &$variation) {
                $masterProduct['Quantity'] += (int)$variation['Quantity'];
                unset($variation['ItemSpecifics']);
                foreach ($variation['Variation'] as $variationDefinition) {
                    unset($masterProduct['ItemSpecifics']['ShopVariation'][$variationDefinition['name']]);
                }
            }
        }
    }

    protected function setVariationDefinition($categoryAttributes)
    {
        $newVariationDefinitions = array();
        foreach ($categoryAttributes as $categoryAttributeKey => $categoryAttributeValue) {
            $newVariationDefinitions[] = array(
                'name' => $categoryAttributeKey,
                'value'=> $categoryAttributeValue,
            );
        }

        return $newVariationDefinitions;
    }

    protected function createVariantMasterProducts($variantProducts, $variationMasterItemTitle, $variationMasterSku, $productToClone)
    {
        $masterProducts = parent::createVariantMasterProducts($variantProducts, $variationMasterItemTitle, $variationMasterSku, $productToClone);

        foreach ($masterProducts as &$masterProduct) {
            $masterProduct['Title'] = $masterProduct['ItemTitle'];

            if (count($variantProducts) === 1 && isset($variantProducts[0]['Variation']) && $variantProducts[0]['Variation'] == array()) {
                unset(
                    $masterProduct['Variation'],
                    $masterProduct['Variations'],
                    $masterProduct['VariationPictures'],
                    $masterProduct['VariationDimensionForPictures']
                );
            }

            unset($masterProduct['ItemTitle']);
        }

        return $masterProducts;
    }

    protected function replacePrepareData($aData) {
        foreach ($aData as $sKey => $mValue) {
            if ($mValue === null) {
                unset($aData[$sKey]);
            } else {
                if (method_exists($this, 'replace'.$sKey)) {
                    $aData[$sKey] = $this->{'replace'.$sKey}($mValue, $aData);
                    if ($sKey == 'StrikePrice') {
                        // replace by sth like $aData['ManufacturersPrice'] = 100.00
                        if (!empty($aData['StrikePrice']) && MLModule::gi()->getConfig('strikeprice.kind') !== null) {
                            $aData[MLModule::gi()->getConfig('strikeprice.kind')] = $aData['StrikePrice'];
                        }
                        unset($aData['StrikePrice']);
                        if (isset($aData['StrikePriceForUpload'])) unset($aData['StrikePriceForUpload']);
                    }
                }
            }
        }
        return $aData;
    }

    protected function _getImageUrl($mValue) {
        $sSize = MLModule::gi()->getConfig('imagesize');
        $iSize = $sSize == null ? 500 : (int)$sSize;
        $aOut = array();
        foreach (is_array($mValue) ? $mValue : array($mValue) as $sImage) {
            try {
                $aImage = MLImage::gi()->resizeImage($sImage, 'products', $iSize, $iSize);
//                if (MLModule::gi()->getConfig('picturepack') && MLShop::gi()->addonBooked('EbayPicturePack')) {
                    $aOut[] = $aImage['url'];
//                } else {
//                    $aOut[] = str_replace('https:', 'http:', $aImage['url']);
//                }
            } catch (Exception $oEx) {//no image
            }
        }
        return is_array($mValue) ? $aOut : current($aOut);
    }

    protected function replaceVariationDimensionForPictures($mValue, $aData) {
        $this->sVariationDimensionForPictures = $mValue;
        $aSearch = array();
        foreach ($this->oCurrentProduct->getVariants() as $oVariant) {
            foreach ($oVariant->getVariatonDataOptinalField(array('name', 'code')) as $aVariationData) {
                 $aSearch[$aVariationData['code']] = $aVariationData['name'];
            }
        }
        if (array_key_exists($mValue, $aSearch)) {
            $sValue = $aSearch[$mValue];
            $aVariant = current($aData['Variations']);
            $aRawVariant = $aVariant['RawShopVariation'];
            foreach ($aRawVariant as $iKey => $aValue) {
                if ($aValue['name'] == $aSearch[$mValue]) {
                    $sValue = $aVariant['Variation'][$iKey]['name'];
                    break;
                }
            }
        } else if (in_array($mValue, $aSearch)) {
            $sValue = $mValue;
        } else {
            $sValue = null;
        }
        return $sValue;
    }

    protected function replaceMpn($mValue, $aData) {
        $oItem = $this->oCurrentVariant === null ? $this->oCurrentProduct : $this->oCurrentVariant;
        return empty($mValue) ? $oItem->getSku() : $mValue;
    }
    
    protected function replaceItemSpecifics ($mValue, $aData) {
        foreach (is_array($mValue) ? $mValue : array() as $sSpecificsKey => $aSpecifics) {
            foreach (is_array($aSpecifics) ? $aSpecifics : array() as $sKey => $sValue ) {
                if (is_array($sValue)) {
                    if (array_key_exists('select', $sValue) && $sValue['select'] == -6 && array_key_exists('text', $sValue)) {
                        $sMyValue = $sValue['text'];
                    } elseif (array_key_exists('select', $sValue)) {
                        $sMyValue = $sValue['select'];
                    }
                } elseif (is_string($sValue)) {
                    $sMyValue = $sValue;
                } else {
                    continue;
                }
                foreach (
                    array(
                        array(
                            'fieldKey' => 'ean', 
                            'globalField' => true,
                            'search' => array('EAN', 'ISBN', 'UPC'),
                            'onlySyncModul' => false
                        ),
                        array(
                            'fieldKey' => 'manufacturerpartnumber', 
                            'globalField' => true,
                            'search' => array('Herstellernummer', 'MPN'),
                            'onlySyncModul' => false
                        ),
                        array(
                            'fieldKey' => 'productfield.brand', 
                            'globalField' => false,
                            'search' => array('Marke', 'Hersteller', 'Brand'),
                            'onlySyncModul' => true
                        ),
                    ) as $aConfig
                ) {
                    if (
                        empty($mValue[$sSpecificsKey][$sKey])
                        && in_array($sKey, $aConfig['search'])
                        && (
                            (MLShop::gi()->addonBooked('EbayProductIdentifierSync') && MLModule::gi()->getConfig('syncproperties'))
                            || (
                                $sMyValue == '(matching)'
                                && ! $aConfig['onlySyncModul']
                            )
                        )
                    ) {
                        $sConfigKey = MLModule::gi()->getConfig($aConfig['fieldKey']);
                        if (!empty($sConfigKey)) {
                            $sMyValue = empty($sConfigKey) ? $sMyValue : $this->oCurrentProduct->getModulField(($aConfig['globalField'] ? 'general.' : '').$aConfig['fieldKey'], $aConfig['globalField']);
                            if (is_array($sValue)) {
                                $mValue[$sSpecificsKey][$sKey] = array(
                                    'select' => '-6',
                                    'text' => $sMyValue,
                                );
                            } else {
                                $mValue[$sSpecificsKey][$sKey] = $sMyValue;
                            }
                        }
                    }
                }
            }
        }
        return $mValue;
    }
    
    protected function replaceVariationPictures($mValue, $aData) {
        if ($this->sVariationDimensionForPictures !== null) {
            $sVariationDimension = $this->sVariationDimensionForPictures;
        } elseif (is_array($aData) && array_key_exists('VariationDimensionForPictures', $aData)) {
            $sVariationDimension = $aData['VariationDimensionForPictures'];
        } else {
            return null;
        }
        if (is_array($mValue) && array_key_exists($sVariationDimension, $mValue)) {
            $aOut = array();
            foreach ($mValue[$sVariationDimension] as $sKey => $aImages) {
                if(array_key_exists($sKey, $this->aVariationTranslationBasePrice)){
                    $sBasePricedKey = $this->aVariationTranslationBasePrice[$sKey];
                } else if(isset($this->getPrepareHelper()->aAttributeMatchingMapping[$this->oCurrentProduct->get('id')]['values'][$sKey])){
                    $sBasePricedKey = $this->getPrepareHelper()->aAttributeMatchingMapping[$this->oCurrentProduct->get('id')]['values'][$sKey];
                } else {
                    $sBasePricedKey = $sKey;
                }

                if (!empty($aImages)) {
                    $aOut[$sBasePricedKey] = $this->replacePictureUrl($aImages, $aData);
                }
            }
            return $aOut;
        } else {
            return null;
        }
    }

    protected function replacePictureUrl($mValue, $aData) {
        if ($this->sAction == 'VerifyAddItems') {
            if (is_array($mValue)) {
                foreach ($mValue as &$sLink) {
                    $sLink = 'http://example.com/test.png';
                }
                return $mValue;
            } else {
                return 'http://example.com/test.png';
            }
        } else {
            return $this->_getImageUrl($mValue);
        }

    }

    protected function replaceQuantity($mValue, $aData) {
        if ($this->sAction == 'VerifyAddItems' && array_key_exists('Description', $aData)) {// we need replacement only for master
            return 1;
        } else {
            return $mValue;
        }
    }

    protected function replaceShippingDetails($mValue, $aData) {
        if (is_array($mValue['ShippingServiceOptions']) && count($mValue['ShippingServiceOptions']) > 0) {
            foreach ($mValue['ShippingServiceOptions'] as &$aService) {
                if ($aService['ShippingServiceCost'] == '=GEWICHT') {
                    $aWeight = $this->oCurrentProduct->getWeight();
                    $aService['ShippingServiceCost'] = empty($aWeight) ? '0' : (string)$aWeight['Value'];
                }
                $aService['ShippingServiceCost'] = MLPrice::factory()->unformat($aService['ShippingServiceCost']);
            }
        }
        if (isset($mValue['InternationalShippingServiceOption']) && is_array($mValue['InternationalShippingServiceOption']) && count($mValue['InternationalShippingServiceOption']) > 0) {
            foreach ($mValue['InternationalShippingServiceOption'] as $iService => &$aService) {
                if (
                    empty($aService['ShippingService']) // config value = no-shipping
                    || !isset($aService['ShipToLocation']) // no location
                    || empty($aService['ShipToLocation']) // no location
                ) {
                    unset($mValue['InternationalShippingServiceOption'][$iService]);
                } else {
                    if ($aService['ShippingServiceCost'] == '=GEWICHT') {
                        $aWeight = $this->oCurrentProduct->getWeight();
                        $aService['ShippingServiceCost'] = empty($aWeight) ? '0' : (string)$aWeight['Value'];
                    }
                    $aService['ShippingServiceCost'] = MLPrice::factory()->unformat($aService['ShippingServiceCost']);
                }
            }
        }
        if (!isset($mValue['InternationalShippingServiceOption']) || empty($mValue['InternationalShippingServiceOption'])) {
            unset($mValue['InternationalShippingServiceOption']);
            unset($mValue['InternationalPromotionalShippingDiscount']);
            unset($mValue['InternationalShippingDiscountProfileID']);
        }
        return $mValue;
    }

    protected function replaceStartPrice($mValue, $aData) {
        return MLPrice::factory()->unformat($mValue);
    }

    protected function replaceStrikePrice($mValue, $aData) {
        if (!empty($aData['StrikePriceForUpload'])) {
            if ((float)$aData['StrikePriceForUpload'] > (float)$aData['StartPrice']) {
                return $aData['StrikePriceForUpload'];
            } else {
                MLMessage::gi()->addDebug('Strike price is ignored because it is smaller than start price', array((float)$aData['StrikePriceForUpload'], (float)$aData['StartPrice']));
            }
        }
        return null;
    }

    /**
     * cuts title, but rescue #BASPRICE#
     * @param string $mValue
     * @param array $aData
     * @return string
     */
    protected function replaceTitle($mValue, $aData, $iMaxChars = 80) {
        // Replace &nbsp; (if any) by single spaces
        $mValue = str_replace('&nbsp;', ' ', $mValue);
        /* @var $oPrepareHelper ML_Ebay_Helper_Model_Table_Ebay_PrepareData */
        $oPrepareHelper = MLHelper::gi('Model_Table_Ebay_PrepareData');
        return $oPrepareHelper->basePriceReplace($mValue, $aData, $iMaxChars);
    }

    /**
     * ebay api dont support uploaditems yet
     * @return \ML_Ebay_Model_Service_AddItems
     */
    protected function uploadItems() {
        return $this;
    }

    /**
     * example array value
     *
     * 1. 'Title' => array('optional' => array('active' => true)),
     *     For fields, if they are not prepared or are null, the default value should be fetched from the configuration or default product field
     *
     * 2.  'BuyItNowPrice' => array(),
     *     For fields, if they are not prepared or are null, they shouldn't be submitted or they should submitted as null.
     *
     * @return array
     */
    protected function getFieldDefineMasterMaster() {
        $aReturn = array(
            'Title' => array('optional' => array('active' => true)),
            'SKU' => array('optional' => array('active' => true)),
            'Description' => array('optional' => array('active' => true), 'preparemode' => true),
            'rawDescription' => array(),
            'PictureURL' => array('optional' => array('active' => true)),
            'GalleryType' => array(),
            'Subtitle' => array(),
            'StartTime' => array(),
            'StartPrice' => array('optional' => array('active' => true)),
            'StrikePrice' => array('optional' => array('active' => true)),
            'StrikePriceForUpload' => array('optional' => array('active' => true)),
            'BuyItNowPrice' => array(),
            'Quantity' => array('optional' => array('active' => true)),
            'BasePrice' => array('optional' => array('active' => true)),
            'BasePriceString' => array('optional' => array('active' => true)),
            'MPN' => array('optional' => array('active' => true)),
            'EAN' => array('optional' => array('active' => true)),
            'ePID' => array('optional' => array('active' => true)),
            'ConditionID' => array('optional' => array('active' => true)),
            'ConditionDescriptors' => array('optional' => array('active' => true)),
            'ConditionDescription' => array('optional' => array('active' => true)),
            'tecDocKType' => array('optional' => array('active' => true)),
            //add Tecdoc
        );

        if (MLShop::gi()->addonBooked('EbayProductIdentifierSync') && MLModule::gi()->getConfig('syncproperties')) {
            $aReturn += array(
                'Brand' => array('optional' => array('active' => true)),
            );
        }
        return $aReturn;
    }

    /**
     * example array value
     *
     * 1. 'Title' => array('optional' => array('active' => true)),
     *     For fields, if they are not prepared or are null, the default value should be fetched from the configuration or default product field
     *
     * 2.  'BuyItNowPrice' => array(),
     *     For fields, if they are not prepared or are null, they shouldn't be submitted or they should submitted as null.
     *
     * @return array
     */
    protected function getFieldDefineMasterVariant() {
        $aReturn = array(
            'BestOfferEnabled' => array('optional' => array('active' => true)),
            'PrimaryCategory' => array('optional' => array('active' => true)),
            'SecondaryCategory' => array(),
            'StoreCategory' => array(),
            'StoreCategory2' => array(),
            'ItemSpecifics' => array('optional' => array('active' => true)),
            'Attributes' => array('optional' => array('active' => true)),
            'ListingType'                     => array('optional' => array('active' => true)),
            'ListingDuration'                 => array('optional' => array('active' => true)),
            'Country'                         => array('optional' => array('active' => true)),
            'Site'                            => array('optional' => array('active' => true)),
            'currencyID'                      => array('optional' => array('active' => true)),
            'Location'                        => array('optional' => array('active' => true)),
            'PostalCode'                      => array('optional' => array('active' => true)),
            'Tax'                             => array('optional' => array('active' => true)),
            'ReturnPolicy'                    => array('optional' => array('active' => true)),
            'doCalculateBasePriceForVariants' => array('optional' => array('active' => true)),
            'eBayPlus'                        => array('optional' => array('active' => true)),
            'PurgePictures'                   => array(),
            'VariationDimensionForPictures'   => array('optional' => array('active' => true)),
            'VariationPictures'               => array('optional' => array('active' => true)),
            'Asynchronous'                    => array('optional' => array('active' => true)),
            'PicturePack'                     => array('optional' => array('active' => true)),
            'RestrictedToBusiness'            => array('optional' => array('active' => true)),
            'RawAttributesMatching'           => array('optional' => array('active' => true)),
            'RawVariationThemeBlacklist'      => array('optional' => array('active' => true)),
            'StrikePriceForUpload'            => array('optional' => array('active' => true)),
            'Weight'                          => array('optional' => array('active' => true)),
        );
        
        if (empty($this->aCatCondition)) {
            $aReturn['ConditionID'] = array('optional' => array('active' => true));
        }
        $aReturn['ConditionDescription'] = array('optional' => array('active' => true));
        $aReturn['ConditionDescriptors'] = array('optional' => array('active' => true));
        if (MLHelper::gi('model_form_type_sellerprofiles')->hasSellerProfiles()) {
            $aReturn['SellerProfiles'] = array('optional' => array('active' => true));
        } else {
            $aReturn['PaymentMethods'] = array('optional' => array('active' => true));
            $aReturn['PayPalEmailAddress'] = array('optional' => array('active' => true));
            $aReturn['PaymentInstructions'] = array('optional' => array('active' => true));
            $aReturn['ShippingDetails'] = array('optional' => array('active' => true));
            $aReturn['ReturnPolicy'] = array('optional' => array('active' => true));
            $aReturn['DispatchTimeMax'] = array('optional' => array('active' => true));
        }
        return $aReturn;
    }

    /**
     * example array value
     *
     * 1. 'Title' => array('optional' => array('active' => true)),
     *     For fields, if they are not prepared or are null, the default value should be fetched from the configuration or default product field
     *
     * 2.  'BuyItNowPrice' => array(),
     *     For fields, if they are not prepared or are null, they shouldn't be submitted or they should submitted as null.
     *
     * @return array
     */
    protected function getFieldDefineVariant() {
        $aRetrun = array(
            'StartPrice' => array('optional' => array('active' => true)),
            'StrikePrice' => array('optional' => array('active' => true)),
            'StrikePriceForUpload' => array('optional' => array('active' => true)),
            'SKU' => array('optional' => array('active' => true)),
            'Quantity' => array('optional' => array('active' => true)),
            'Variation' => array('optional' => array('active' => true)),
            'ItemSpecifics' => array('optional' => array('active' => true)),
            'BasePrice' => array('optional' => array('active' => true)),
            'ShortBasePriceString' => array('optional' => array('active' => true)),
            'MPN' => array('optional' => array('active' => true)),
            'EAN' => array('optional' => array('active' => true)),
            'RawShopVariation' => array('optional' => array('active' => true)),
            'ePID' => array('optional' => array('active' => true)),
            'ConditionID' => array('optional' => array('active' => true)),
            'ConditionDescription' => array('optional' => array('active' => true)),
            'ConditionDescriptors' => array('optional' => array('active' => true)),
        );

//        if (MLShop::gi()->addonBooked('EbayProductIdentifierSync') && MLModule::gi()->getConfig('syncproperties')) {
//            $aRetrun += array(
//            );
//        }
        return $aRetrun;
    }
    
    protected function getFieldDefineComplete(){
        $aDefineMasterMaster = $this->getFieldDefineMasterMaster();
        $aDefineMasterVariant = $this->getFieldDefineMasterVariant();
        $aDefineVariant = $this->getFieldDefineVariant();
        $aDefineComplete =  array_merge($aDefineMasterMaster, $aDefineMasterVariant, $aDefineVariant);
        unset($aDefineComplete['Variation'], $aDefineComplete['VariationDimensionForPictures'], $aDefineComplete['VariationPictures']);
        return $aDefineComplete;
    }


    protected function shouldSendShopData() {
        return true;
    }
    
   
    /**
     * 
     * @return ML_Ebay_Helper_Model_Table_Ebay_PrepareData
     */
    protected function getPrepareHelper(){
        return MLHelper::gi('Model_Table_Ebay_PrepareData');
    }

    protected function setProductVariationValues($product) {
        $product = parent::setProductVariationValues($product);

        /*
         * it could be that the product in shop has variations but we failed to load them for some reason or there are translations missing
         *      This prevents Exceptions on API when we set Field 'Variation' to be 'ItemSpecifics'
         */
        foreach ($product['Variations'] as &$variationProduct) {
            if (empty($variationProduct['RawShopVariation'])) {
                $variationProduct['Variation'] = array();
                throw new Exception('', 1605109425);
            }
        }

        return $product;
    }

}
