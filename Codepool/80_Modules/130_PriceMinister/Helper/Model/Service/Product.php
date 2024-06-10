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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_PriceMinister_Helper_Model_Service_Product
{
    const TITLE_MAX_LENGTH = 200;
    const DESC_MAX_LENGTH = 4000;

    /** @var ML_Database_Model_Table_Selection $oSelection */
    protected $oSelection = null;
    protected $aSelectionData = array();

    /** @var ML_PriceMinister_Model_Table_PriceMinister_Prepare $oPrepare */
    protected $oPrepare = null;

    /** @var ML_Shop_Model_Product_Abstract $oProduct */
    protected $oProduct = null;
    protected $oVariant = null;
    protected $aData = null;

    public function __call($sName, $mValue)
    {
        return $sName . '()';
    }

    public function __construct()
    {
        $this->oPrepare = MLDatabase::factory('priceminister_prepare');
        $this->oSelection = MLDatabase::factory('selection');
    }

    public function setProduct(ML_Shop_Model_Product_Abstract $oProduct)
    {
        $this->oProduct = $oProduct;
        $this->sPrepareType = '';
        $this->aData = null;
        return $this;
    }

    public function setVariant(ML_Shop_Model_Product_Abstract $oProduct)
    {
        $this->oVariant = $oProduct;
        return $this;
    }

    public function resetData()
    {
        $this->aData = null;
        return $this;
    }

    public function getData()
    {
        if ($this->aData === null){
            $this->oPrepare->init()->set('products_id', $this->oVariant->get('id'));
            $aData = array();
            $aData['ShopProductInstance'] = $this->oVariant;
            foreach (
                array(
                    'SKU',
                    'ItemTitle',
                    'VariantTitle',
                    'Description',
                    'CategoryId',
                    'Images',
                    'Price',
                    'Quantity',
                    'CategoryAttributes',
                    'Condition',
                    'Matched',
                    'Ean',
                    'ParentSKU',
                    'variation_theme',
                    'RawShopVariation',
                    'RawAttributesMatching',
                ) as $sField){
                if (method_exists($this, 'get' . $sField)){
                    $mValue = $this->{'get' . $sField}();
                    if (is_array($mValue)){
                        foreach ($mValue as $sKey => $mCurrentValue){
                            if (empty($mCurrentValue)){
                                unset ($mValue[$sKey]);
                            }
                        }
                        $mValue = empty($mValue) ? null : $mValue;
                    }
                    if ($mValue !== null){
                        $aData[$sField] = $mValue;
                    }
                } else{
                    MLMessage::gi()->addWarn("function  ML_PriceMinister_Helper_Model_Service_Product::get" . $sField . "() doesn't exist");
                }
            }

            $this->aData = $aData;
        }
        return $this->aData;
    }

    protected function getSKU()
    {
        return $this->oVariant->getMarketPlaceSku();
    }

    protected function getvariation_theme()
    {
        // Variation theme for Priceminister is hardcoded
        return array(
            'PMVariationTheme' => array(
                'color',
                'size',
                'couleur',
                'taille',
            ),
        );
    }


    protected function getItemTitle()
    {
        $iLang = MLModule::gi()->getConfig('lang');

        $sTitle = $this->oPrepare->get('ItemTitle');
        if (empty($sTitle) === false && $sTitle !== ''){
            $sTitle = html_entity_decode(fixHTMLUTF8Entities($sTitle), ENT_COMPAT, 'UTF-8');
        } else{
            $this->oVariant->setLang($iLang);

            $sValue = MLModule::gi()->getConfig('template.name');
            if (!isset($sValue) || $sValue === ''){
                $sValue = '#TITLE#';
            }

            $parent = $this->oVariant->getParent();
            if (isset($parent)) {
                $sShopTitle = $parent->getName();
            } else {
                $sShopTitle = $this->oVariant->getName();
            }

            $sBasePrice = $this->getPrice();
            $aReplace = array(
                '#TITLE#' => $sShopTitle,
                '#ARTNR#' => $this->oVariant->getMarketPlaceSku(),
                '#PID#' => $this->oVariant->get('marketplaceidentid'),
                '#BASEPRICE#' => $sBasePrice,
            );

            $sTitle = str_replace(array_keys($aReplace), array_values($aReplace), $sValue);
            $sTitle = html_entity_decode(fixHTMLUTF8Entities($sTitle), ENT_COMPAT, 'UTF-8');

            if (mb_strlen($sTitle, 'UTF-8') > self::TITLE_MAX_LENGTH) {
                $sTitle = mb_substr($sTitle, 0, self::TITLE_MAX_LENGTH - 3, 'UTF-8') . '...';
            }
        }

        return $sTitle;
    }

    protected function getVariantTitle() {
        $iLang = MLModule::gi()->getConfig('lang');
        $this->oVariant->setLang($iLang);
        $sTitle = $this->oVariant->getName();
        $sTitle = html_entity_decode(fixHTMLUTF8Entities($sTitle), ENT_COMPAT, 'UTF-8');
        if (mb_strlen($sTitle, 'UTF-8') > self::TITLE_MAX_LENGTH) {
            $sTitle = mb_substr($sTitle, 0, self::TITLE_MAX_LENGTH - 3, 'UTF-8') . '...';
        }

        return $sTitle;
    }

    protected function getDescription()
    {
        $sDescription = $this->oPrepare->get('Description');
        if (empty($sDescription) === false && $sDescription !== ''){
            $sDescription = html_entity_decode(fixHTMLUTF8Entities($sDescription), ENT_COMPAT, 'UTF-8');
        } else{
            $iLang = MLModule::gi()->getConfig('lang');
            $this->oVariant->setLang($iLang);
            $oProduct = $this->oVariant;

            $sValue = MLModule::gi()->getConfig('template.content');
            if (!isset($sValue) || $sValue === ''){
                $sValue = '<p>#TITLE#</p>
                            <p>#ARTNR#</p>
                            <p>#SHORTDESCRIPTION#</p>
                            <p>#PICTURE1#</p>
                            <p>#PICTURE2#</p>
                            <p>#PICTURE3#</p>
                            <p>#DESCRIPTION#</p>';
            }


            $aReplace = $oProduct->getReplaceProperty();
            $sValue = str_replace(array_keys($aReplace), array_values($aReplace), $sValue);
            $iSize = $this->getImageSize();
            //images
            $iImageIndex = 1;
            foreach ($oProduct->getImages() as $sPath){
                try{
                    $aImage = MLImage::gi()->resizeImage($sPath, 'products', $iSize, $iSize);
                    $sValue = str_replace(
                        '#PICTURE' . (string)($iImageIndex) . '#', "<img src=\"" . $aImage['url'] . "\" style=\"border:0;\" alt=\"\" title=\"\" />", preg_replace('/(src|SRC|href|HREF|rev|REV)(\s*=\s*)(\'|")(#PICTURE' . (string)($iImageIndex) . '#)/', '\1\2\3' . $aImage['url'], $sValue)
                    );
                    $iImageIndex++;
                } catch (Exception $oEx){
                    //no image in fs
                }
            }
            // delete not replaced #PICTUREx#
            $sValue = preg_replace(
                '/#PICTURE\d+#/', '', preg_replace('/<[^<]*(src|SRC|href|HREF|rev|REV)\s*=\s*(\'|")#PICTURE\d+#(\'|")[^>]*\/*>/', '', $sValue)
            );
            // delete empty images
            $sValue = preg_replace('/<img[^>]*src=(""|\'\')[^>]*>/i', '', $sValue);
            $sDescription = html_entity_decode(fixHTMLUTF8Entities($sValue), ENT_COMPAT, 'UTF-8');
            $sDescription = $this->truncateStringHtmlSafe($sDescription, self::DESC_MAX_LENGTH);
        }

        return $sDescription;
    }

    protected function getImages()
    {
        $aImagesPrepare = $this->oPrepare->get('Images');
        $aOut = array();
        if (empty($aImagesPrepare) === false){
            $aImages = $this->oVariant->getImages();

            foreach ($aImages as $sImage){
                $sImageName = $this->substringAferLast('\\', $sImage);
                if (isset($sImageName) === false || strpos($sImageName, '/') !== false){
                    $sImageName = $this->substringAferLast('/', $sImage);
                }

                if (in_array($sImageName, $aImagesPrepare) === false){
                    continue;
                }

                try{
                    $aImage = MLImage::gi()->resizeImage($sImage, 'products', 2000, 2000);
                    $sImagePath = $aImage['url'];

                    $aOut[] = array('URL' => $sImagePath);
                } catch (Exception $ex){
                    echo '';
                    // Happens if image doesn't exist.
                }
            }
        }

        return $aOut;
    }

    protected function getQuantity()
    {
        $iQty = $this->oVariant->getSuggestedMarketplaceStock(
            MLModule::gi()->getConfig('quantity.type'),
            MLModule::gi()->getConfig('quantity.value')
        );
        return $iQty < 0 ? 0 : $iQty;
    }

    protected function getPrice()
    {
        if (isset($this->aSelectionData['price'])){
            $fPrice = $this->aSelectionData['price'];
        } else{
            $fPrice = $this->oVariant->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject());
        }

        return $fPrice;
    }

    protected function getCategoryID()
    {
        return $this->oPrepare->get('PrimaryCategory');
    }

    protected function getCondition()
    {
        $sItemCondition = $this->oPrepare->get('ItemCondition');
        if ($sItemCondition === ''){
            $sItemCondition = MLModule::gi()->getConfig('itemcondition');
        }

        return $sItemCondition;
    }

    protected function getMatched()
    {
        return $this->oPrepare->get('PrepareType') == 'apply' ? 'false' : 'true';
    }

    protected function getEan()
    {
        return $this->oPrepare->get('Ean');
    }

    protected function getParentSKU()
    {
        if ($this->oPrepare->get('PrepareType') != 'apply'){ // check if product is matched
            return $this->oPrepare->get('MPProductId');
        } else{
            // if not matched
            return $this->oVariant->getMarketPlaceSku();
        }
    }

    private function substringAferLast($sNeedle, $sString)
    {
        if (!is_bool($this->strrevpos($sString, $sNeedle))){
            return substr($sString, $this->strrevpos($sString, $sNeedle) + strlen($sNeedle));
        }
    }

    private function strrevpos($instr, $needle)
    {
        $rev_pos = strpos(strrev($instr), strrev($needle));
        if ($rev_pos === false){
            return false;
        } else{
            return strlen($instr) - $rev_pos - strlen($needle);
        }
    }

    private function toFloat($num)
    {
        $dotPos = strrpos($num, '.');
        $commaPos = strrpos($num, ',');
        $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
            ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);

        if (!$sep){
            return floatval(preg_replace("/[^0-9]/", "", $num));
        }

        return floatval(
            preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
            preg_replace("/[^0-9]/", "", substr($num, $sep + 1, strlen($num)))
        );
    }

    private function fixImages($imgsVariant, $imgsMaster)
    {
        foreach ($imgsMaster as $imageMaster){
            if (!in_array($imageMaster, $imgsVariant)){
                $imgsVariant[] = $imageMaster;
            }
        }

        return $imgsVariant;
    }

    protected function getCategoryAttributes()
    {
        $aCatAttributes = array(
            'Product' => array(),
            'Advert' => array(),
        );

        /* @var $attributesMatchingService ML_Modul_Helper_Model_Service_AttributesMatching */
        $attributesMatchingService = MLHelper::gi('Model_Service_AttributesMatching');
        $convertedAttributes = $attributesMatchingService->mergeConvertedMatchingToNameValue(
            $this->oPrepare->get('ShopVariation'),
            $this->oVariant,
            $this->oProduct
        );

        $sPrimaryCategory = $this->oPrepare->get('PrimaryCategory');
        $aCatAttributesFromMP = $this->getAttributesFromMP($sPrimaryCategory);
        foreach ($convertedAttributes as $mpName => $mpValue) {
            //Checking if it attribute for product or for advert and put it in proper array
            if (array_key_exists($mpName, $aCatAttributesFromMP['attributes']) && $aCatAttributesFromMP['attributes'][$mpName]['product'] == true){
                $aCatAttributes['Product'][$mpName] = $mpValue;
            } else{
                $aCatAttributes['Advert'][$mpName] = $mpValue;
            }
        }

        return $aCatAttributes;
    }
    
    protected function getCategoryAttributesOld()
    {
        $sPrimaryCategory = $this->oPrepare->get('PrimaryCategory');

        $aCatAttributesFromMP = $this->getAttributesFromMP($sPrimaryCategory);
        $aCatAttributesFromDB = $this->oPrepare->get('ShopVariation');
        $aCatAttributes = array(
            'Product' => array(),
            'Advert' => array()
        );

        foreach ($aCatAttributesFromDB as $key => $aCatAttributeFromDB) {
            if (empty($aCatAttributeFromDB['Code'])) {
                // when can this happen???
                continue;
            }

            $sCode = $aCatAttributeFromDB['Code'];
            if ($sCode === 'freetext'|| $sCode === 'attribute_value') {
                if (!isset($aCatAttributeFromDB['Values']) || empty($aCatAttributeFromDB['Values'])) {
                    continue;
                } else {
                    //Checking if it attribute for product or for advert and put it in proper array
                    if (array_key_exists($key, $aCatAttributesFromMP['attributes'])
                            && $aCatAttributesFromMP['attributes'][$key]['product'] == true) {
                        $aCatAttributes['Product'][$key] = $aCatAttributeFromDB['Values'];
                    } else{
                        $aCatAttributes['Advert'][$key] = $aCatAttributeFromDB['Values'];
                    }
                }
            } else {
                $shopAttributeValue = $this->oVariant->getAttributeValue($sCode);
                if (!isset($shopAttributeValue) || empty($shopAttributeValue)) {
                    continue;
                } else {
                    if (isset($aCatAttributeFromDB['Values']) && is_array($aCatAttributeFromDB['Values'])) {
                        foreach ($aCatAttributeFromDB['Values'] as $value){
                            if ($shopAttributeValue === $value['Shop']['Value']){
                                //Checking if it attribute for product or for advert and put it in proper array
                                if (array_key_exists($key, $aCatAttributesFromMP['attributes']) && $aCatAttributesFromMP['attributes'][$key]['product'] == true){
                                    $aCatAttributes['Product'][$key] = str_replace(array(' - (Manually matched)', ' - (Auto matched)', ' - (Free text)'), '', $value['Marketplace']['Value']);
                                } else{
                                    $aCatAttributes['Advert'][$key] = str_replace(array(' - (Manually matched)', ' - (Auto matched)', ' - (Free text)'), '', $value['Marketplace']['Value']);
                                }

                                break;
                            }
                        }
                    }

                    if (is_array($aCatAttributeFromDB)) {
                        //Checking if it attribute for product or for advert and put it in proper array
                        if (   array_key_exists($key, $aCatAttributesFromMP['attributes'])
                            && $aCatAttributesFromMP['attributes'][$key]['product'] == true
                            && !isset($aCatAttributes['Product'][$key])
                        ) {
                            $aCatAttributes['Product'][$key] = $shopAttributeValue;
                        } elseif (!isset($aCatAttributes['Advert'][$key])) {
                            $aCatAttributes['Advert'][$key] = $shopAttributeValue;
                        }
                    }
                }
            }
        }

        return $aCatAttributes;
    }

    // Just used to get information that is needed for splitting and skipping of variations.
    protected function getRawShopVariation()
    {
        return $this->oVariant->getPrefixedVariationData();
    }

    // Just used to get information that is needed for splitting and skipping of variations.
    protected function getRawAttributesMatching()
    {
        return  $this->oPrepare->get('ShopVariation');
    }

    private function getAttributesFromMP($categoryID)
    {
        try{
            $aResponse = MagnaConnector::gi()->submitRequestCached(array('ACTION' => 'GetCategoryDetails', 'DATA' => array('CategoryID' => $categoryID)), 60);
            if ($aResponse['STATUS'] == 'SUCCESS' && isset($aResponse['DATA']) && is_array($aResponse['DATA'])){
                return $aResponse['DATA'];
            } else{
                return array('attributes' => array());
            }
        } catch (MagnaException $e){
            return array('attributes' => array());
        }
    }

    private function stringStartsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    /**
     * Truncates HTML text without breaking HTML structure.
     * Source: https://dodona.wordpress.com/2009/04/05/how-do-i-truncate-an-html-string-without-breaking-the-html-code
     *
     * @param string $text String to truncate.
     * @param integer $length Length of returned string, including ellipsis.
     * @param string $ending Ending to be appended to the trimmed string.
     * @param boolean $exact If false, $text will not be cut mid-word
     * @param boolean $considerHtml If true, HTML tags would be handled correctly
     * @return string Trimmed string.
     */
    private function truncateStringHtmlSafe($text, $length = 100, $ending = '...', $exact = false, $considerHtml = true)
    {
        if ($considerHtml) {
            // if the plain text is shorter than the maximum length, return the whole text
            if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
                return $text;
            }

            // splits all html-tags to scannable lines
            preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
            $total_length = strlen($ending);
            $open_tags = array();
            $truncate = '';
            foreach ($lines as $line_matchings) {
                // if there is any html-tag in this line, handle it and add it (uncounted) to the output
                if (!empty($line_matchings[1])) {
                    // if it's an "empty element" with or without xhtml-conform closing slash
                    if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                        // do nothing
                        // if tag is a closing tag
                    } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                        // delete tag from $open_tags list
                        $pos = array_search($tag_matchings[1], $open_tags);
                        if ($pos !== false) {
                            unset($open_tags[$pos]);
                        }
                        // if tag is an opening tag
                    } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                        // add tag to the beginning of $open_tags list
                        array_unshift($open_tags, strtolower($tag_matchings[1]));
                    }
                    // add html-tag to $truncate'd text
                    $truncate .= $line_matchings[1];
                }
                // calculate the length of the plain text part of the line; handle entities as one character
                $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
                if ($total_length + $content_length > $length) {
                    // the number of characters which are left
                    $left = $length - $total_length;
                    $entities_length = 0;
                    // search for html entities
                    if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                        // calculate the real length of all entities in the legal range
                        foreach ($entities[0] as $entity) {
                            if ($entity[1] + 1 - $entities_length <= $left) {
                                $left--;
                                $entities_length += strlen($entity[0]);
                            } else {
                                // no more characters left
                                break;
                            }
                        }
                    }
                    $truncate .= substr($line_matchings[2], 0, $left + $entities_length);
                    // maximum length is reached, so get off the loop
                    break;
                } else {
                    $truncate .= $line_matchings[2];
                    $total_length += $content_length;
                }
                // if the maximum length is reached, get off the loop
                if ($total_length >= $length) {
                    break;
                }
            }
        } else {
            if (strlen($text) <= $length) {
                return $text;
            } else {
                $truncate = substr($text, 0, $length - strlen($ending));
            }
        }

        // if the words shouldn't be cut in the middle...
        if (!$exact) {
            // ...search the last occurrence of a space...
            $spacepos = strrpos($truncate, ' ');
            if (isset($spacepos)) {
                // ...and cut the text in this position
                $truncate = substr($truncate, 0, $spacepos);
            }
        }

        // add the defined ending to the text
        $truncate .= $ending;
        if ($considerHtml) {
            // delete unclosed tags in the end of string
            $truncate = preg_replace('/]*$/', '', $truncate);

            // close all unclosed html-tags
            foreach ($open_tags as $tag) {
                $truncate .= '</' . $tag . '>';
            }
        }

        return $truncate;
    }
}
