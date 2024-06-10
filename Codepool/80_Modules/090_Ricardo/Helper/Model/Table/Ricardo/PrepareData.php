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

MLFilesystem::gi()->loadClass('Form_Helper_Model_Table_PrepareData_Abstract');

class ML_Ricardo_Helper_Model_Table_Ricardo_PrepareData extends ML_Form_Helper_Model_Table_PrepareData_Abstract {

    const TITLE_MAX_LENGTH = 60;
    const SUBTITLE_MAX_LENGTH = 60;

    public $aErrors = array();
    public $bIsSinglePrepare;

    public function getPrepareTableProductsIdField() {
        return 'products_id';
    }

    protected function primaryCategoryField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);

        if (!isset($aField['value']) || $aField['value'] === '') {
            $this->aErrors[] = 'ricardo_prepareform_category';
        }
    }

    protected function products_idField(&$aField) {
        $aField['value'] = $this->oProduct->get('id');
    }

    protected function listinglangsField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        $aField['issingleview'] = isset($this->oProduct);
    }

    protected function descriptionTemplateField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function articleConditionField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        unset($aField['type']);
    }

    protected function availabilityField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function deliveryConditionField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function deliveryPackageField(&$aField) {
        $aField['type'] = 'select';
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function deliveryDescriptionField(&$aField) {
        $this->getOptionalDescription($aField, 'deliverycondition', 'ricardo_prepareform_delivery_description');
    }

    protected function deliveryCostField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function cumulativeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function warrantyConditionField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function warrantyDescriptionField(&$aField) {
        $this->getOptionalDescription($aField, 'warrantycondition', 'ricardo_prepareform_warranty_description');
    }

    protected function maxRelistCountField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function buyingModeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function paymentMethodsField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);

        $posible = array('0', '8192', '1073741824');
        $intersect = array_intersect($posible, is_array($aField['value']) ? $aField['value'] : array());
        if (count($intersect) !== 1 || (count($aField['value']) == 2 && in_array('1073741824', $aField['value']))) {
            $this->aErrors[] = 'ricardo_prepareform_paymentmethods';
        }
    }

    protected function paymentDescriptionField(&$aField) {
        $this->getOptionalDescription($aField, 'paymentmethods', 'ricardo_prepareform_payment_description');
    }

    protected function fixPriceField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        $buyingMode = $this->getField('buyingMode', 'value');
        if (isset($this->oProduct) && (($buyingMode === 'buy_it_now') || !isset($aField['value']))) {
            $aField['value'] = $this->oProduct->getSuggestedMarketplacePrice(MLModul::gi()->getPriceObject());
        }
    }

    protected function enableBuyNowPriceField(&$aField) {
        $fFixPrice = $this->getField('fixprice', 'value');
        $aField['value'] = $this->getFirstValue($aField);
        if (isset($fFixPrice) && $fFixPrice > 0 && $this->bIsSinglePrepare === true) {
            $aField['value'] = '1';
        } elseif (isset($aField['value']) === false || $this->bIsSinglePrepare === true) {
            $aField['value'] = '0';
        }
    }

    protected function priceForAuctionField(&$aField) {
        $aField['type'] = 'price';
        $aField['currency'] = 'CHF';
        $aField['value'] = $this->getFirstValue($aField);
        if (!isset($aField['value']) || $aField['value'] === "") {
            $aField['value'] = 0.00;
        }
    }

    protected function priceIncrementField(&$aField) {
        $aField['type'] = 'price';
        $aField['currency'] = 'CHF';
        $aField['value'] = $this->getFirstValue($aField);
        if (!isset($aField['value']) || $aField['value'] === "") {
            $aField['value'] = 0.00;
        }
    }

    protected function startDateField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);

        if (!isset($aField['value'])) {
            $this->aErrors[] = 'ricardo_prepareform_setdate';
        }
    }

    protected function endDateField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);

        if (!isset($aField['value'])) {
            $this->aErrors[] = 'ricardo_prepareform_setdate';
        }
    }

    protected function durationField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function deTitleField(&$aField) {
        $this->getTitle($aField, 'de');
    }

    protected function frTitleField(&$aField) {
        $this->getTitle($aField, 'fr');
    }

    protected function deSubtitleField(&$aField) {
        $this->getSubtitle($aField, 'de');
    }

    protected function frSubtitleField(&$aField) {
        $this->getSubtitle($aField, 'fr');
    }

    protected function deDescriptionField(&$aField) {
        $this->getDescription($aField, 'de');
    }

    protected function frDescriptionField(&$aField) {
        $this->getDescription($aField, 'fr');
    }

    protected function imagesField(&$aField) {
        $aField['values'] = array();
        $aIds = array();
        if (isset($this->oProduct)) {
            if ($this->oProduct->get('parentid') == 0) {
                $aImages = $this->oProduct->getImages();
            } else {
                $aImages = $this->oProduct->getParent()->getImages();
            }

            foreach ($aImages as $sImagePath) {
                $sId = $this->substringAferLast('\\', $sImagePath);
                if (isset($sId) === false || strpos($sId, '/') !== false) {
                    $sId = $this->substringAferLast('/', $sImagePath);
                }

                try {
                    $aUrl = MLImage::gi()->resizeImage($sImagePath, 'products', 80, 80);
                    $aField['values'][$sId] = array(
                        'height' => '80',
                        'width' => '80',
                        'alt' => $sId,
                        'url' => $aUrl['url'],
                    );
                    $aIds[] = $sId;
                } catch (Exception $ex) {
                    // Happens if image doesn't exist.
                }
            }
        }
        $aField['value'] = $this->getFirstValue($aField, $aIds, array());
    }

    protected function firstPromotionField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function secondPromotionField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    private function getOptionalDescription(&$aField, $sCondition, $sMessage) {
        $aField['type'] = 'table';
        $aField['value'] = $this->getFirstValue($aField);
        $aField['values'] = $this->getField('listinglangs', 'value');

        $bValueEmpty = false;
        $aLangs = $this->getField('listinglangs', 'value');
        if (($aLangs['de'] === 'true') && (isset($aField['value']['de']) === false || $aField['value']['de'] === '')) {
            $bValueEmpty = true;
        }

        if (($aLangs['fr'] === 'true') && (isset($aField['value']['fr']) === false || $aField['value']['fr'] === '')) {
            $bValueEmpty = true;
        }

        $aIds = $this->getField($sCondition, 'value');
        if (is_array($aIds) === true) {
            $condition = in_array('0', $aIds);
        } else {
            $condition = $aIds === '0';
        }

        if ((isset($aField['value']) === false || $bValueEmpty) && $condition) {
            $this->aErrors[] = $sMessage;
        }
    }

    private function getTitle(&$aField, $sLang) {
        $aListinglangs = $this->getField('listinglangs', 'value');

        if (isset($this->oProduct)) {
            $sValue = $this->getFirstValue($aField);
            if (empty($sValue)) {
                $sValue = MLModul::gi()->getConfig('template.name');
            }

            if (empty($sValue)) {
                $sValue = '#TITLE#';
            }

            $aLangs = MLModul::gi()->getConfig('langs');
            $this->oProduct->setLang($aLangs[$sLang]);

            $parent = $this->oProduct->getParent();
            try {
                $sShopTitle = $parent->getName();
                if (empty($sShopTitle)) {
                    $sShopTitle = $this->oProduct->getName();
                }
            } catch (Exception $ex) {
                $sShopTitle = $this->oProduct->getName();
            }

            $sBasePrice = $this->getField('fixPrice', 'value');
            $aReplace = array(
                '#TITLE#' => $sShopTitle,
                '#ARTNR#' => $this->oProduct->getMarketPlaceSku(),
                '#PID#' => $this->oProduct->get('marketplaceidentid'),
                '#BASEPRICE#' => $sBasePrice,
            );

            $aField['value'] = str_replace(array_keys($aReplace), array_values($aReplace), $sValue);
            if (trim($aField['value']) == '') {
                $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getName());
            }
        }

        if (isset($aField['value']) && mb_strlen($aField['value'], 'UTF-8') > self::TITLE_MAX_LENGTH) {
            $aField['value'] = mb_substr($aField['value'], 0, self::TITLE_MAX_LENGTH, 'UTF-8');
        }

        $aField['maxlength'] = self::TITLE_MAX_LENGTH;
        $aField['value'] = isset($aField['value']) ? $aField['value'] : '';
        $aField['value'] = html_entity_decode(fixHTMLUTF8Entities($aField['value']), ENT_COMPAT, 'UTF-8');

        if ($this->bIsSinglePrepare && empty($aField['value']) && $aListinglangs[$sLang] === 'true') {
            $this->aErrors[] = 'ricardo_prepareform_title';
        }
    }

    /**
     * Check if subtitle should be submit (see prepare form) if null then do not submit (leave it empty)
     *
     * @param $aField
     * @param $sLang
     */
    protected function getSubtitle(&$aField, $sLang) {
        $aField['value'] = $this->getFirstValue($aField);
        if (isset($this->oProduct)) {
            $aLangs = MLModul::gi()->getConfig('langs');
            $this->oProduct->setLang($aLangs[$sLang]);
            if (empty($aField['value']) && $aField['value'] !== null) {
                $aField['value'] = $this->oProduct->getShortDescription();
            }
        }

        $aField['value'] = isset($aField['value']) ? $aField['value'] : '';
        $aField['value'] = $this->ricardoSanitizeDescription($aField['value']);
        $aField['maxlength'] = self::SUBTITLE_MAX_LENGTH;
        $aField['value'] = html_entity_decode(fixHTMLUTF8Entities($aField['value']), ENT_COMPAT, 'UTF-8');
    }

    private function getDescription(&$aField, $sLang) {
        $aListinglangs = $this->getField('listinglangs', 'value');

        if (isset($this->oProduct)) {
            $sValue = $this->getFirstValue($aField);
            if (empty($sValue)) {
                $sValue = MLModul::gi()->getConfig('template.content');
                 $sVariantDetails = $this->getVariantDetails($this->oProduct);
                if (empty($sValue)) {
                    $sValue = '<p>#TITLE#<br>
                        #VARIATIONDETAILS#</p> 
                        <p>#ARTNR#</p>
                        <p>#SHORTDESCRIPTION#</p>
                        <p>#PICTURE1#</p>
                        <p>#PICTURE2#</p>
                        <p>#PICTURE3#</p>
                        <p>#DESCRIPTION#</p>';
                } elseif (strpos($sValue, '#VARIATIONDETAILS#') === false) {
                     if (isset($sVariantDetails) && $sVariantDetails != "") {
                        $strPosTitle = strpos($sValue, '#TITLE#');
                        if ($strPosTitle !== false) {
                            $sValue = substr_replace($sValue, '<br>#VARIATIONDETAILS#<br>', $strPosTitle + strlen('#TITLE#'), 0);
                        } else {
                            $sValue = '#VARIATIONDETAILS#<br>' . $sValue;
                        }
                    } 
                }
                $aLangs = MLModul::gi()->getConfig('langs');
                $this->oProduct->setLang($aLangs[$sLang]);
                $oProduct = $this->oProduct;
                $aReplace = $oProduct->getReplaceProperty();
                $parent = $oProduct->getParent();
                /* @var $aReplace type */
                if (isset($aReplace['#PROPERTIES#']) && $aReplace['#PROPERTIES#'] != '') {
                    $aReplace['#PROPERTIES#'] = str_replace('</span><span  class="magna_property_value">', '</span>: <span  class="magna_property_value">', $aReplace['#PROPERTIES#']);
                }
                try {
                    $aReplace['#TITLE#'] = $parent->getName();
                    if (empty($aReplace['#TITLE#'])) {
                        $aReplace['#TITLE#'] = $this->oProduct->getName();
                    }
                } catch (Exception $ex) {
                    $aReplace['#TITLE#'] = $this->oProduct->getName();
                }                
                $aReplace['#VARIATIONDETAILS#'] = $sVariantDetails;
                $sValue = str_replace(array_keys($aReplace), array_values($aReplace), $sValue);
                $iSize = $this->getImageSize();
                //images
                $iImageIndex = 1;
                foreach ($oProduct->getImages() as $sPath) {
                    try {
                        $aImage = MLImage::gi()->resizeImage($sPath, 'products', $iSize, $iSize);
                        $sValue = str_replace(
                            '#PICTURE'.(string)($iImageIndex).'#', "<img src=\"".
                            $aImage['url']."\" style=\"border:0;\" alt=\"\" title=\"\" />", preg_replace('/(src|SRC|href|HREF|rev|REV)(\s*=\s*)(\'|")(#PICTURE'.
                                (string)($iImageIndex).'#)/', '\1\2\3'.$aImage['url'], $sValue)
                        );
                        $iImageIndex++;
                    } catch (Exception $oEx) {
                        //no image in fs
                    }
                }
                // delete not replaced #PICTUREx#  
                $sValue = preg_replace(
                    '/#PICTURE\d+#/', '', preg_replace('/<[^<]*(src|SRC|href|HREF|rev|REV)\s*=\s*(\'|")#PICTURE\d+#(\'|")[^>]*\/*>/', '', $sValue)
                );
                // delete empty images
                $sValue = preg_replace('/<img[^>]*src=(""|\'\')[^>]*>/i', '', $sValue);
            }

            $aField['value'] = html_entity_decode(fixHTMLUTF8Entities($sValue), ENT_COMPAT, 'UTF-8');;
        }

        $aField['value'] = isset($aField['value']) ? $aField['value'] : '';
        $aField['value'] = html_entity_decode(fixHTMLUTF8Entities($aField['value']), ENT_COMPAT, 'UTF-8');
        if ($this->bIsSinglePrepare && empty($aField['value']) && $aListinglangs[$sLang] === 'true') {
            $this->aErrors[] = 'ricardo_prepareform_description';
        }
    }

    private function getVariantDetails($oProduct) {
        $aVariantData = $oProduct->getVariatonData();
        $sVariantDetails = '';
        foreach ($aVariantData as $aDimension) {
            $sVariantDetails .= $aDimension['name'].' - '.$aDimension['value'].' ';
        }

        return $sVariantDetails;
    }

    protected function getImageSize() {
        $sSize = MLModul::gi()->getConfig('imagesize');
        $iSize = $sSize == null ? 500 : (int)$sSize;
        return $iSize;
    }

    private function substringAferLast($sNeedle, $sString) {
        if (!is_bool($this->strrevpos($sString, $sNeedle))) {
            return substr($sString, $this->strrevpos($sString, $sNeedle) + strlen($sNeedle));
        }
    }

    private function strrevpos($instr, $needle) {
        $rev_pos = strpos(strrev($instr), strrev($needle));
        if ($rev_pos === false) {
            return false;
        } else {
            return strlen($instr) - $rev_pos - strlen($needle);
        }
    }

    /**
     * Sanitizes description and preparing it for Ricardo because Ricardo doesn't allow html tags.
     *
     * @param string $sDescription
     * @return string $sDescription
     */
    private function ricardoSanitizeDescription($sDescription) {
        $sDescription = preg_replace("#(<\\?div>|<\\?li>|<\\?p>|<\\?h1>|<\\?h2>|<\\?h3>|<\\?h4>|<\\?h5>|<\\?blockquote>)([^\n])#i", "$1\n$2", $sDescription);
        // Replace <br> tags with new lines
        $sDescription = preg_replace('/<[h|b]r[^>]*>/i', "\n", $sDescription);
        $sDescription = trim(strip_tags($sDescription));
        // Normalize space
        $sDescription = str_replace("\r", "\n", $sDescription);
        $sDescription = preg_replace("/\n{3,}/", "\n\n", $sDescription);

        if (strlen($sDescription) > self::SUBTITLE_MAX_LENGTH) {
            $sDescription = mb_substr($sDescription, 0, self::SUBTITLE_MAX_LENGTH - 3, 'UTF-8').'...';
        } else {
            $sDescription = mb_substr($sDescription, 0, self::SUBTITLE_MAX_LENGTH, 'UTF-8');
        }

        return $sDescription;
    }

}
