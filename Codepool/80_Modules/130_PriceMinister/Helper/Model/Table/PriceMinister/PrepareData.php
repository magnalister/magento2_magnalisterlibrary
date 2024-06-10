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
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Form_Helper_Model_Table_PrepareData_Abstract');

class ML_PriceMinister_Helper_Model_Table_PriceMinister_PrepareData extends ML_Form_Helper_Model_Table_PrepareData_Abstract
{
    const TITLE_MAX_LENGTH = 200;
    const DESC_MAX_LENGTH = 4000;

    public $aErrorFields = array();
    public $bIsSinglePrepare;

    public $itemsPerPage;
    public $productChunks;
    public $totalPages;
    public $currentPage;
    public $currentChunk;

    public function getPrepareTableProductsIdField()
    {
        return 'products_id';
    }

    protected function listingTypeField(&$aField)
    {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function itemTitleField(&$aField)
    {
        $sValue = $this->getFirstValue($aField);
        if (isset($this->oProduct)){
            $parent = $this->oProduct->getParent();
            try{
                $sTitle = $parent->getName();
                if (empty($sTitle)) {
                    $sTitle = $this->oProduct->getName();
                }
            } catch (Exception $ex){
                $sTitle = $this->oProduct->getName();
            }

            if (!isset($sValue) || $sValue === ''){
                $sValue = MLModule::gi()->getConfig('template.name');
            }

            if (!isset($sValue) || $sValue === ''){
                $sValue = '#TITLE#';
            }

            $sBasePrice = $this->getField('price', 'value');
            $aReplace = array(
                '#TITLE#' => $sTitle,
                '#ARTNR#' => $this->oProduct->getMarketPlaceSku(),
                '#PID#' => $this->oProduct->get('marketplaceidentid'),
                '#BASEPRICE#' => $sBasePrice,
            );

            $aField['value'] = str_replace(array_keys($aReplace), array_values($aReplace), $sValue);
            if (trim($aField['value']) == ''){
                $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getName());
            }
        }

        if (isset($aField['value'])) {
            $aField['value'] = html_entity_decode(fixHTMLUTF8Entities($aField['value']), ENT_COMPAT, 'UTF-8');

            if (mb_strlen($aField['value'], 'UTF-8') > self::TITLE_MAX_LENGTH) {
                $aField['value'] = mb_substr($aField['value'], 0, self::TITLE_MAX_LENGTH - 3, 'UTF-8') . '...';
            }
        }


        $aField['maxlength'] = self::TITLE_MAX_LENGTH;
    }

    protected function itemConditionField(&$aField)
    {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function priceField(&$aField)
    {
        $aField['issingleview'] = isset($this->oProduct);
        if ($aField['issingleview']){
            $price = $aField['value'] = $this->oProduct->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject());
            $aField['value'] = round($price, 2);
        }
    }

    protected function imagesField(&$aField)
    {
        $aField['value'] = $this->getFirstValue($aField);
        $aField['values'] = array();
        $aIds = array();
        if (isset($this->oProduct)){
            $aImages = $this->oProduct->getImages();

            foreach ($aImages as $sImagePath){
                $sId = self::substringAferLast('\\', $sImagePath);
                if (isset($sId) === false || strpos($sId, '/') !== false){
                    $sId = self::substringAferLast('/', $sImagePath);
                }

                try{
                    $aUrl = MLImage::gi()->resizeImage($sImagePath, 'products', 80, 80);
                    $aField['values'][$sId] = array(
                        'height' => '80',
                        'width' => '80',
                        'alt' => $sId,
                        'url' => $aUrl['url'],
                    );
                    $aIds[] = $sId;
                } catch (Exception $ex){
                    // Happens if image doesn't exist.
                }
            }
        }

        if (!empty($aField['value']) && in_array('false', $aField['value']) === true) {
            array_shift($aField['value']);
        }

        if (empty($aField['value'])) {
            $aField['value'] = $aIds;
        }
    }

    protected function descriptionField(&$aField)
    {
        $sValue = $this->getFirstValue($aField);
        if ($this->oProduct){
            if (!isset($sValue) || $sValue === ''){
                $sValue = MLModule::gi()->getConfig('template.content');
            }

            if (!isset($sValue) || $sValue === ''){
                $sValue = '<p>#TITLE#</p>
                    <p>#ARTNR#</p>
                    <p>#SHORTDESCRIPTION#</p>
                    <p>#PICTURE1#</p>
                    <p>#PICTURE2#</p>
                    <p>#PICTURE3#</p>
                    <p>#DESCRIPTION#</p>';
            }

            $oProduct = $this->oProduct;
            $aReplace = $oProduct->getReplaceProperty();
            $sValue = str_replace(array_keys($aReplace), array_values($aReplace), $sValue);
            $iSize = $this->getImageSize();
            //images
            $iImageIndex = 1;
            foreach ($oProduct->getImages() as $sPath){
                try{
                    $aImage = MLImage::gi()->resizeImage($sPath, 'products', $iSize, $iSize);
                    $sValue = str_replace(
                        '#PICTURE' . (string)($iImageIndex) . '#', " <img src=\"" . $aImage['url'] . "\" style=\"border:0;\" alt=\"\" title=\"\" /> ", preg_replace('/(src|SRC|href|HREF|rev|REV)(\s*=\s*)(\'|")(#PICTURE' . (string)($iImageIndex) . '#)/', '\1\2\3' . $aImage['url'], $sValue)
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
            $aField['value'] = $sValue;
        }

        if (isset($aField['value'])) {
            $aField['value'] = html_entity_decode(fixHTMLUTF8Entities($aField['value']), ENT_COMPAT, 'UTF-8');

            $aField['maxlength'] = self::DESC_MAX_LENGTH;
            $aField['value'] = $this->truncateString($aField['value'], self::DESC_MAX_LENGTH);
        }
    }

    /**
     * Truncates HTML text without breaking HTML structure.
     *
     * @param string $text String to truncate.
     * @param integer $length Length of returned string, including ellipsis.
     *
     * @return string Trimmed string.
     */
    private function truncateString($text, $length = 100) {
        if (strlen($text) <= $length) {
            return $text;
        }

        $textLength = min($length, strlen(preg_replace('/<.*?>/', '', $text)));
        $resultText = $this->truncateStringHtmlSafe($text, $textLength);
        while (strlen($resultText) > $length) {
            $textLength -= 100;
            $resultText = $this->truncateStringHtmlSafe($text, $textLength);
        }

        return $resultText;
    }

    protected function products_idField(&$aField)
    {
        $aField['value'] = $this->oProduct->get('id');
    }

    protected function attributesField(&$aField)
    {
        $aAttributes = $this->getFirstValue($aField, array());
        $aField['value'] = json_encode($aAttributes);
        $aCat = reset($aAttributes);
        $aCat = is_array($aCat) ? $aCat : array();
        $sCategoryId = key($aAttributes);

        foreach ($aCat as $sAttributeId => $sAttributeValue){
            $blRequired = (int)$sAttributeValue['Required'] === 1;
            $iMaxLength = (int)$sAttributeValue['MaxLength'];
            $sCode = $sAttributeValue['Code'];
            $sMatchAttribute = isset($sAttributeValue['MatchAttribute']) ? $sAttributeValue['MatchAttribute'] : null;

            if ($blRequired === true){
                if ($sCode === '__none__' || ($sCode === '__freevalue__' && empty($sMatchAttribute) === true)){
                    $this->aErrorFields["attributes.$sCategoryId.$sAttributeId.code"] = true;
                } else if ($blRequired === true && $sCode === 'aamatchaa'){
                    if (empty($sMatchAttribute) === true){
                        $this->aErrorFields["attributes.$sCategoryId.$sAttributeId.code"] = true;//
                    }
                }
            }

            if (count($this->aErrorFields) > 0){
                MLMessage::gi()->addError(MLI18n::gi()->get('configform_check_entries_error'));
            }

            if ($sCode === '__freevalue__' && strlen($sMatchAttribute) > $iMaxLength){
                MLMessage::gi()->addError(MLI18n::gi()->get('priceminister_prepareform_max_length_part1')
                    . ' ' . $sAttributeValue['AttrName'] . ' ' . MLI18n::gi()->get('priceminister_prepareform_max_length_part2')
                    . ' ' . $sAttributeValue['MaxLength'] . '.');
                $this->aErrorFields["attributes.$sCategoryId.$sAttributeId.code"] = true;
            }
        }
    }

    protected function eanField(&$aField)
    {
        $ean = $this->getFirstValue($aField);
        if ($this->oProduct && (!$ean || $this->bIsSinglePrepare === false)){
            $ean = $this->oProduct->getModulField('general.ean', true);
        }

        $aField['value'] = $ean;
    }

    protected function callApi($aRequest, $iLifeTime)
    {
        try{
            $aResponse = MagnaConnector::gi()->submitRequestCached($aRequest, $iLifeTime);
            if ($aResponse['STATUS'] == 'SUCCESS' && isset($aResponse['DATA']) && is_array($aResponse['DATA'])){
                return $aResponse['DATA'];
            } else{
                return array();
            }
        } catch (MagnaException $e){
            return array();
        }
    }

    public static function substringAferLast($sNeedle, $sString)
    {
        if (!is_bool(self::strrevpos($sString, $sNeedle))){
            return substr($sString, self::strrevpos($sString, $sNeedle) + strlen($sNeedle));
        }
    }

    private static function strrevpos($instr, $needle)
    {
        $rev_pos = strpos(strrev($instr), strrev($needle));
        if ($rev_pos === false){
            return false;
        } else{
            return strlen($instr) - $rev_pos - strlen($needle);
        }
    }

    protected function getImageSize()
    {
        $sSize = MLModule::gi()->getConfig('imagesize');
        $iSize = $sSize == null ? 500 : (int)$sSize;
        return $iSize;
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

    protected function variationGroups_ValueField(&$aField)
    {
        $aField['value'] = $this->getFirstValue($aField);
        $aField['optional'] = array('active' => true);

        if (!isset($aField['value']) || $aField['value'] === ''){
            $this->aErrors[] = 'priceminister_prepareform_category';
        }
    }

    protected function productMatchField(&$aField)
    {
        if (MLRequest::gi()->data('matching_nextpage') !== null){
            $this->currentPage = MLRequest::gi()->data('matching_nextpage');
        } else{
            $this->currentPage = 1;
        }

        foreach ($this->oSelectList->getList() as $product){
            $aField['products'][] = $this->getProductInfoById($product->pID);
        }

        $this->itemsPerPage = MLModule::gi()->getConfig('itemsperpage');
        $this->productChunks = array_chunk($aField['products'], $this->itemsPerPage);
        $this->totalPages = count($this->productChunks);
        $this->currentChunk = ($this->currentPage - 1) >= 0 ? $this->productChunks[$this->currentPage - 1] : $this->productChunks[0];
    }

    public function getProductInfoById($iProductId)
    {
        /* @var $oP ML_Shop_Model_Product_Abstract */
        $oP = MLProduct::factory()->set('id', $iProductId)->load();

        $oProduct = array(
            'Id' => $iProductId,
            'Model' => $oP->getSKU(),
            'Title' => $oP->getName(),
            'Description' => $oP->getDescription(),
            'Images' => $oP->getImages(),
            'Price' => $oP->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject(), true, true),
            'Manufacturer' => $oP->getManufacturer(),
            'EAN' => $oP->getModulField('general.ean', true)
        );

        $aSearchResult = false;
        $oProduct['Results'] = false;

        if (empty($oProduct['EAN']) === false){
            $aSearchResult = $this->searchOnPriceMinister($oProduct['EAN'], 'EAN');
            if($aSearchResult){
                $oProduct['SearchCriteria'] = 'EAN';
            }
        }

        if ($aSearchResult === false){
            $aSearchResult = $this->searchOnPriceMinister($oProduct['Title'], 'KW');
            if($aSearchResult){
                $oProduct['SearchCriteria'] = 'KW';
            }
        }

        if ($aSearchResult !== false){
            $oProduct['Results'] = $aSearchResult;
        }

        return $oProduct;
    }

    public function searchOnPriceMinister($sSearch = '', $sSearchBy = 'EAN')
    {
        try{
            //$aData = json_decode(file_get_contents(__DIR__.'/info.json'), true);
            $aData = MagnaConnector::gi()->submitRequest(array(
                'ACTION' => 'GetItemsFromMarketplace',
                'DATA' => array(
                    $sSearchBy => $sSearch
                )
            ));
        } catch (MagnaException $e){
            $aData = array(
                'DATA' => false
            );
        }

        if (!is_array($aData) || !isset($aData['DATA']) || empty($aData['DATA'])){
            return false;
        }

        return $aData['DATA'];
    }


}
