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

class ML_Cdiscount_Helper_Model_Service_Product {

    const TITLE_MAX_LENGTH = 132;
    const SUBTITLE_MAX_LENGTH = 30;
    const DESC_MAX_LENGTH = 420;
    const MARKETING_DESC_MAX_LENGTH = 5000;
    const COMMENT_MAX_LENGTH = 200;

    /** @var ML_Database_Model_Table_Selection $oSelection */
    protected $oSelection = null;
    protected $aSelectionData = array();

    /** @var ML_Cdiscount_Model_Table_Cdiscount_Prepare $oPrepare  */
    protected $oPrepare = null;

    /** @var ML_Shop_Model_Product_Abstract $oProduct  */
    protected $oProduct = null;
    /** @var ML_Shop_Model_Product_Abstract $oProduct */
    protected $oVariant = null;
    protected $aData = null;

    protected $aLang = null;
    /**
     * @var string
     */
    private $sPrepareType;

    public function __call($sName, $mValue) {
        return $sName . '()';
    }

    public function __construct() {
        $this->oPrepare = MLDatabase::factory('cdiscount_prepare');
        $this->oSelection = MLDatabase::factory('selection');
    }

    public function setProduct(ML_Shop_Model_Product_Abstract $oProduct) {
        $this->oProduct = $oProduct;
        $this->sPrepareType = '';
        $this->aData = null;
        return $this;
    }

    public function setVariant(ML_Shop_Model_Product_Abstract $oProduct){
        $this->oVariant=$oProduct;
        return $this;
    }

    public function resetData() {
        $this->aData = null;
        $this->aLang = MLModule::gi()->getConfig('lang');
        return $this;
    }

    public function getData() {
        if ($this->aData === null) {
            $this->oPrepare->init()->set('products_id', $this->oVariant->get('id'));
            $aData = array();
            $aData['ShopProductInstance'] = $this->oVariant;
            $aFields = array(
                'SKU',
                'EAN',
                'MarketplaceCategory',
                'CategoryAttributes',
                'Title',
                'VariantTitle',
                'Subtitle',
                'Description',
                'MarketingDescription',
                'Images',
                'Quantity',
                'Price',
                'BasePrice',
                'Brand',
                'ManufacturerPartNumber',
                'Tax',
                'ShippingInfo',
                'OfferCondition',
                'OfferComment',
                'RawShopVariation',
                'RawAttributesMatching',
                'variation_theme',
                'PreparedImages'
            );

            foreach ($aFields as $sField) {
                if (method_exists($this, 'get' . $sField)) {
                    $mValue = $this->{'get' . $sField}();
                    if (is_array($mValue)) {
                        $mValue = empty($mValue) ? null : $mValue;
                    }
                    if ($mValue !== null) {
                        $aData[$sField] = $mValue;
                    }
                } else {
                    MLMessage::gi()->addWarn("function  ML_Cdiscount_Helper_Model_Service_Product::get" . $sField . "() doesn't exist");
                }
            }

            if (empty($aData['BasePrice'])) {
                unset($aData['BasePrice']);
            }

            $this->aData = $aData;
        }

        return $this->aData;
    }

    /**
     * Checks from which shop is called this function,gets BasePrice and formats it for API.This function is implemented in this way
     * because $this->oVariant->getBasePrice() returns different structures of arrays and API needs to recieve the same BasePrice data.
     * This function is implemented in this part because there is possibility in 70_SHOP e-commerce folder for something else to not work.
     */

    ///couldnt test because of problem with cdiscount authentication on v3 plugin side
    protected function getBasePrice(){
        $basePrice = $this->oVariant->getBasePrice();
        $formattedBasePrice = array();
        // Shopware shop
        if(array_key_exists('ShopwareDefaults',$basePrice)){
            $formattedBasePrice['Unit'] = $basePrice['ShopwareDefaults']['$sUnit'];
            $formattedBasePrice['Value'] = number_format((float)$basePrice['Value'], 2, '.','');
            return $formattedBasePrice;
            //prestashop
        }elseif(array_key_exists('Unit',$basePrice)){
            $formattedBasePrice['Unit'] = $basePrice['Unit'];
            $formattedBasePrice['Value'] = number_format((float)$basePrice['Value'], 2, '.','');
            return $formattedBasePrice;
        }
    }

    protected function getvariation_theme()
    {
        $variationTheme = $this->oPrepare->get('variation_theme');
        if (!is_array($variationTheme )) {
            $variationTheme = array();
        }

        return $variationTheme;
    }

    protected function getSKU() {
        return $this->oVariant->getMarketPlaceSku();
    }

    protected function getEAN() {
        $sEan = $this->oPrepare->get('EAN');
        if (isset($sEan) === false || empty($sEan)) {
            $sEan = $this->oVariant->getEAN();
        }

        return $sEan;
    }

    protected function getMarketplaceCategory() {
        return $this->oPrepare->get('PrimaryCategory');
    }

    protected function getCategoryAttributes() {
        /* @var $attributesMatchingService ML_Modul_Helper_Model_Service_AttributesMatching */
        $attributesMatchingService = MLHelper::gi('Model_Service_AttributesMatching');

        return $attributesMatchingService->mergeConvertedMatchingToNameValue(
            $this->oPrepare->get('ShopVariation'),
            $this->oVariant,
            $this->oProduct
        );
    }

    protected function getTitle() {
        $sTitle = $this->oPrepare->get('Title');
        if (empty($sTitle) === false && $sTitle !== '') {
            $sTitle = html_entity_decode(fixHTMLUTF8Entities($sTitle), ENT_COMPAT, 'UTF-8');
        } else {
            $iLang = MLModule::gi()->getConfig('lang');
            $this->oVariant->setLang($iLang);
            $parent = $this->oVariant->getParent();
            if (isset($parent)) {
                $sTitle = $parent->getName();
            } else {
                $sTitle = $this->oVariant->getName();
            }
            $sTitle = html_entity_decode(fixHTMLUTF8Entities($sTitle), ENT_COMPAT, 'UTF-8');
        }

        if(strlen($sTitle) > self::TITLE_MAX_LENGTH) {
            $sTitle = mb_substr($sTitle, 0, self::TITLE_MAX_LENGTH - 3, 'UTF-8') . '...';
        }

        return $sTitle;
    }

    protected function getVariantTitle() {
        $iLang = MLModule::gi()->getConfig('lang');
        $this->oVariant->setLang($iLang);
        $sTitle = $this->oVariant->getName();
        $sTitle = html_entity_decode(fixHTMLUTF8Entities($sTitle), ENT_COMPAT, 'UTF-8');

        if(strlen($sTitle) > self::TITLE_MAX_LENGTH) {
            $sTitle = mb_substr($sTitle, 0, self::TITLE_MAX_LENGTH - 3, 'UTF-8') . '...';
        }

        return $sTitle;
    }

    /**
     * @return false|string
     */
    protected function getSubtitle() {
        $sSubtitle = $this->oPrepare->get('Subtitle');
        if (empty($sSubtitle)) {
            $iLang = MLModule::gi()->getConfig('lang');
            $this->oVariant->setLang($iLang);
            $sSubtitle = $this->oVariant->getName();
        }

        // convert html tags - backwards compatibility
        $sSubtitle = html_entity_decode(fixHTMLUTF8Entities($sSubtitle), ENT_COMPAT, 'UTF-8');

        if (mb_strlen($sSubtitle, 'UTF-8') > self::SUBTITLE_MAX_LENGTH) {
            $sSubtitle = mb_substr($sSubtitle, 0, self::SUBTITLE_MAX_LENGTH - 3, 'UTF-8').'...';
        } else {
            $sSubtitle = mb_substr($sSubtitle, 0, self::SUBTITLE_MAX_LENGTH, 'UTF-8');
        }

        return $sSubtitle;
    }

    protected function getDescription()
    {
        $sDescription = $this->oPrepare->get('Description');
        if (empty($sDescription)) {
            $iLang = MLModule::gi()->getConfig('lang');
            $this->oVariant->setLang($iLang);
            //Check first if in config something is set for description. If not use product description from shop.
            $sDescription = $this->oVariant->getModulField('standarddescription');
            if (isset($sDescription) === false || empty($sDescription)) {
                $sDescription = $this->oVariant->getDescription();
            }
        }

        $sDescription = html_entity_decode(fixHTMLUTF8Entities($sDescription), ENT_COMPAT, 'UTF-8');
        $sDescription = $this->cdiscountSanitizeDescription($sDescription);

        return $sDescription;
    }

    protected function getMarketingDescription()
    {
        $sDescription = $this->oPrepare->get('MarketingDescription');
        if (empty($sDescription)) {
            $iLang = MLModule::gi()->getConfig('lang');
            $this->oVariant->setLang($iLang);
            //Check first if in config something is set for description. If not use product description from shop.
            $sDescription = $this->oVariant->getModulField('marketingdescription');
            if (isset($sDescription) === false || empty($sDescription)) {
                $sDescription = $this->oVariant->getDescription();
            }
        }

        $sDescription = $this->truncateString($sDescription, self::MARKETING_DESC_MAX_LENGTH);
        return $sDescription;
    }

    protected function getImages() {
        $aImagesPrepare = $this->oPrepare->get('Images');
        $aOut = array();
        if (empty($aImagesPrepare) === false) {
            $aImages = $this->oVariant->getImages();

            foreach ($aImages as $sImage) {
                $sImageName = $this->substringAferLast('\\', $sImage);
                if (isset($sImageName) === false || strpos($sImageName, '/') !== false) {
                    $sImageName = $this->substringAferLast('/', $sImage);
                }

                if (in_array($sImageName, $aImagesPrepare) === false) {
                    continue;
                }

                try {
                    $aImage = MLImage::gi()->resizeImage($sImage, 'products', 3000, 3000);
                    $sImagePath = $aImage['url'];

                    $aOut[] = $sImagePath;
                } catch(Exception $ex) {
                    // Happens if image doesn't exist.
                }
            }
        }

        return $aOut;
    }

    protected function getQuantity() {
        $iQty = $this->oVariant->getSuggestedMarketplaceStock(
            MLModule::gi()->getConfig('quantity.type'),
            MLModule::gi()->getConfig('quantity.value')
        );

        return $iQty < 0 ? 0 : $iQty;
    }

    protected function getPrice() {
        return $this->oVariant->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject());
    }

    protected function getBrand() {
        return $this->oVariant->getManufacturer();
    }

    protected function getManufacturerPartNumber() {
        //      $mpn = $this->oVariant->getManufacturerPartNumber();
        return "";
    }

    protected function getTax() {
        return $this->oVariant->getTax();
    }

    // Shipping information, all shipping data is saved in one field
    protected function getShippingInfo() {
        // ensure backwards compatibility with old shipping profiles (MR !576)
        $shippingProfiles = $this->oPrepare->get('ShippingProfileName');

        if (isset($shippingProfiles) & $shippingProfiles !== null & $shippingProfiles !== '') {
            $shippingInfo = array();
            $shippingInfo['PreparationTime'] = $this->oPrepare->get('PreparationTime');

            $shippingFees = $this->oPrepare->get('ShippingFee');
            $shippingFeesAdditional = $this->oPrepare->get('ShippingFeeAdditional');

            foreach ($shippingProfiles as $key => $shippingProfile) {
                $shippingInfo[] = array(
                    'DeliveryMode' => $shippingProfiles[$key],
                    'ShippingFee' => $shippingFees[$key],
                    'ShippingFeeAdditional' => $shippingFeesAdditional[$key],
                );
            }

            return $shippingInfo;
        };
        return array(
            "PreparationTime" => $this->oPrepare->get('PreparationTime'),
            "ShippingFeeStandard" => $this->oPrepare->get('ShippingFeeStandard'),
            "ShippingFeeTracked" => $this->oPrepare->get('ShippingFeeTracked'),
            "ShippingFeeRegistered" => $this->oPrepare->get('ShippingFeeRegistered'),
            "ShippingFeeExtraStandard" => $this->oPrepare->get('ShippingFeeExtraStandard'),
            "ShippingFeeExtraTracked" => $this->oPrepare->get('ShippingFeeExtraTracked'),
            "ShippingFeeExtraRegistered" => $this->oPrepare->get('ShippingFeeExtraRegistered'),
        );

    }

    protected function getOfferCondition() {
        return $this->oPrepare->get('ItemCondition');
    }

    protected function getOfferComment() {
        return $this->oPrepare->get('Comment');
    }

    protected function getMatched() {
        return $this->oPrepare->get('PrepareType') !== 'apply';
    }

    // Just used to get information that is needed for splitting and skipping of variations.
    protected function getRawShopVariation()
    {
        return $this->oVariant->getPrefixedVariationData();
    }

    // Just used to get information that is needed for splitting and skipping of variations.
    protected function getRawAttributesMatching()
    {
        return $this->oPrepare->get('ShopVariation');
    }

    private function getCategoryNameById($categoryID) {
        try {
            $aResponse = MagnaConnector::gi()->submitRequestCached(array('ACTION' => 'GetCategoryDetails', 'DATA' => array('CategoryID' => $categoryID)), 60);
            if ($aResponse['STATUS'] == 'SUCCESS' && isset($aResponse['DATA']) && is_array($aResponse['DATA'])) {
                return $aResponse['DATA']['title_plural'];
            } else {
                return $categoryID;
            }
        } catch (MagnaException $e) {
            return $categoryID;
        }
    }

    private function substringAferLast($sNeedle, $sString) {
        if (!is_bool($this->strrevpos($sString, $sNeedle))) {
            return substr($sString, $this->strrevpos($sString, $sNeedle) + strlen($sNeedle));
        }
    }

    private function strrevpos($instr, $needle) {
        $rev_pos = strpos (strrev($instr), strrev($needle));
        if ($rev_pos === false) {
            return false;
        } else {
            return strlen($instr) - $rev_pos - strlen($needle);
        }
    }

    private function stringStartsWith($haystack, $needle) {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    /**
     * Sanitizes description and preparing it for Cdiscount because Cdiscount doesn't allow html tags.
     *
     * @param string $sDescription
     * @return string $sDescription
     *
     */
    private function cdiscountSanitizeDescription($sDescription)
    {
        $sDescription = preg_replace("#(<\\?div>|<\\?li>|<\\?p>|<\\?h1>|<\\?h2>|<\\?h3>|<\\?h4>|<\\?h5>|<\\?blockquote>)([^\n])#i", "$1\n$2", $sDescription);
        // Replace <br> tags with new lines
        $sDescription = preg_replace('/<[h|b]r[^>]*>/i', "\n", $sDescription);
        $sDescription = trim(strip_tags($sDescription));
        // Normalize space
        $sDescription = str_replace("\r", "\n", $sDescription);
        $sDescription = preg_replace("/\n{3,}/", "\n\n", $sDescription);

        if (strlen($sDescription) > self::DESC_MAX_LENGTH) {
            $sDescription = mb_substr($sDescription, 0, self::DESC_MAX_LENGTH - 3, 'UTF-8') . '...';
        } else {
            $sDescription = mb_substr($sDescription, 0, self::DESC_MAX_LENGTH, 'UTF-8');
        }

        return $sDescription;
    }

    /**
     * Sanitizes subtitle and preparing it for Cdiscount because Cdiscount doesn't allow html tags.
     *
     * @param $sSubtitle
     * @return mixed
     */
    private function cdiscountSanitizeSubtitle($sSubtitle){
        $sSubtitle = preg_replace(array('/<\/?div>/','/<\/?li>/','/<\/?p>/','/<\/?h1>/','/<\/?h2>/','/<\/?h3>/','/<\/?h4>/','/<\/?h5>/','/<\/?blockquote>/','/<\/?br>/')," ", $sSubtitle);

        return $sSubtitle;
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
    private function truncateString($text, $length = 100, $ending = '...', $exact = false, $considerHtml = true) {
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


    protected function getPreparedImages() {
        $aImagesPrepare = $this->oPrepare->get('Images');
        $aOut = array();
        if (empty($aImagesPrepare) === false) {
            $aImages = $this->oVariant->getParent()->getImages();

            foreach ($aImages as $sImage) {
                $sImageName = $this->substringAferLast('\\', $sImage);
                if (isset($sImageName) === false || strpos($sImageName, '/') !== false) {
                    $sImageName = $this->substringAferLast('/', $sImage);
                }

                if (in_array($sImageName, $aImagesPrepare) === false) {
                    continue;
                }

                try {
                    $aImage = MLImage::gi()->resizeImage($sImage, 'products', 3000, 3000);
                    $sImagePath = $aImage['url'];

                    $aOut[] = $sImagePath;
                } catch (Exception $ex) {
                    // Happens if image doesn't exist.
                }
            }
        }

        return $aOut;
    }
}
