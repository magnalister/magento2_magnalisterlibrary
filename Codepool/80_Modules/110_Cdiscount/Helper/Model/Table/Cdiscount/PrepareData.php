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
class ML_Cdiscount_Helper_Model_Table_Cdiscount_PrepareData extends ML_Form_Helper_Model_Table_PrepareData_Abstract {

    public $aErrors = array();
    public $bIsSinglePrepare;

    public $itemsPerPage;
    public $productChunks;
    public $totalPages;
    public $currentPage;
    public $currentChunk;

    const TITLE_MAX_LENGTH = 132;
    const SUBTITLE_MAX_LENGTH = 30;
    const DESC_MAX_LENGTH = 420;
    const MARKETING_DESC_MAX_LENGTH = 5000;
    const COMMENT_MAX_LENGTH = 200;

    public function getPrepareTableProductsIdField() {
        return 'products_id';
    }

    protected function productMatchField(&$aField) {

    }

    protected function variationGroups_ValueField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        $aField['optional'] = array('active' => true);

        if (empty($aField['value'])) {
            $this->aErrors[] = 'cdiscount_prepareform_category';
        }
    }

    protected function products_idField(&$aField) {
        $aField['value'] = $this->oProduct->get('id');
    }

    protected function priceField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        $aField['issingleview'] = isset($this->oProduct);
        if ($this->bIsSinglePrepare === true && isset($aField['value']) === false) {
            $aField['value'] = $this->oProduct->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject());
        } elseif ($this->bIsSinglePrepare === false) {
            $aField['value'] = 0;
        }
    }

    public function getProductInfoById($iProductId) {
        /* @var $oP ML_Shop_Model_Product_Abstract */
        $oP = MLProduct::factory()->set('id', $iProductId)->load();

        $oProduct = array(
            'Id'			=> $iProductId,
            'Model'			=> $oP->getSKU(),
            'Title'			=> $oP->getName(),
            'Description'	=> $oP->getDescription(),
            'Images'		=> $oP->getImages(),
            'Price' => $oP->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject(), true, true),
            'Manufacturer'	=> $oP->getManufacturer(),
            'EAN'			=> $oP->getModulField('general.ean', true),
            //				'ShippingTime'	=> $p['ShippingTime'],
            //				'Condition'		=> $p['ConditionType'],
            //				'Comment'		=> $p['Comment'],
            //				'Country'		=> $p['Location'],
        );


        $aSearchResult = false;
        $oProduct['Results'] = false;

        if (empty($oProduct['EAN']) === false) {
            $aSearchResult = $this->searchOnCdiscount($oProduct['EAN'], 'EAN');
        }

        if ($aSearchResult === false) {
            $aSearchResult = $this->searchOnCdiscount($oProduct['EAN'], 'Title');
        }

        if ($aSearchResult !== false) {
            $oProduct['Results'] = $aSearchResult;
        }

        return $oProduct;
    }

    public function searchOnCdiscount($sSearch = '', $sSearchBy = 'EAN') {
        try {
            $aData = MagnaConnector::gi()->submitRequest(array(
                'ACTION' => 'GetItemsFromMarketplace',
                'DATA' => array(
                    $sSearchBy => $sSearch
                )
            ));
        } catch (MagnaException $e) {
            $aData = array(
                'DATA' => false
            );
        }

        if (!is_array($aData) || !isset($aData['DATA']) || empty($aData['DATA'])) {
            return false;
        }

        return $aData['DATA'];
    }

    protected function titleField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        if (isset($this->oProduct) && empty($aField['value'])) {
            $parent = $this->oProduct->get('ParentID') === '0' ? $this->oProduct : $this->oProduct->getParent();
            try {
                $aField['value'] = $parent->getName();
                if (empty($aField['value'])) {
                    $aField['value'] = $this->oProduct->getName();
                }
            } catch(Exception $ex) {
                $aField['value'] = $this->oProduct->getName();
            }
        }

        if (!empty($aField['value']) && mb_strlen($aField['value'], 'UTF-8') > self::TITLE_MAX_LENGTH) {
            $aField['value'] = mb_substr($aField['value'], 0, self::TITLE_MAX_LENGTH - 3, 'UTF-8') . '...';
        }

        $aField['maxlength'] = self::TITLE_MAX_LENGTH;

        if (empty($aField['value']) && isset($this->oProduct)) {
            $this->aErrors[] = array(
                'product_id' => $this->oProduct->get('id'),
                'message' => 'cdiscount_prepareform_title',
            );
        }
    }

    /**
     * Subtile equals the ShortLabel in XML and is used for "Basked Short Title"
     *  that will appear in the shopping cart and on the customer’s bill
     *
     * @param $aField
     */
    protected function subtitleField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        if (isset($this->oProduct) && empty($aField['value'])) {
            $aField['value'] = $this->oProduct->getName();
        }

        // convert html tags - backwards compatibility
        $aField['value'] = html_entity_decode(fixHTMLUTF8Entities($aField['value']), ENT_COMPAT, 'UTF-8');

        if (mb_strlen($aField['value'], 'UTF-8') > self::SUBTITLE_MAX_LENGTH) {
            $aField['value'] = mb_substr($aField['value'], 0, self::SUBTITLE_MAX_LENGTH - 3, 'UTF-8').'...';
        } else {
            $aField['value'] = mb_substr($aField['value'], 0, self::SUBTITLE_MAX_LENGTH, 'UTF-8');
        }

        $aField['maxlength'] = self::SUBTITLE_MAX_LENGTH;

        if (empty($aField['value']) && isset($this->oProduct)) {
            $this->aErrors[] = array(
                'product_id' => $this->oProduct->get('id'),
                'message' => 'cdiscount_prepareform_subtitle',
            );
        }
    }

    protected function descriptionField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        if (isset($this->oProduct) && empty($aField['value'])) {
            //Check first if in config something is set for description. If not use product description from shop.
            $aField['value'] = $this->oProduct->getModulField('standarddescription');
            if (isset($aField['value']) === false || empty($aField['value'])) {
                $aField['value'] = $this->oProduct->getDescription();
            }
        }

        $aField['value'] = $this->cdiscountSanitizeDescription($aField['value']);

        $aField['maxlength'] = self::DESC_MAX_LENGTH;
        if (!empty($aField['value']) && mb_strlen($aField['value'], 'UTF-8') > self::DESC_MAX_LENGTH) {
            $aField['value'] = mb_substr($aField['value'], 0, self::DESC_MAX_LENGTH - 3, 'UTF-8') . '...';
        }

        if (empty($aField['value']) && isset($this->oProduct)) {
            $this->aErrors[] = array(
                'product_id' => $this->oProduct->get('id'),
                'message' => 'cdiscount_prepareform_description',
            );
        }
    }

    protected function marketingDescriptionField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        if (isset($this->oProduct) && empty($aField['value'])) {
            //Check first if in config something is set for marketing description. If not use product description from shop.
            $aField['value'] = $this->oProduct->getModulField('marketingdescription');
            if (empty($aField['value'])) {
                $aField['value'] = $this->oProduct->getDescription();
            }
        }

        $aField['maxlength'] = self::MARKETING_DESC_MAX_LENGTH;
        $aField['value'] = $this->truncateStringHtmlSafe($aField['value'], self::MARKETING_DESC_MAX_LENGTH);
    }

    protected function imagesField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        $aField['values'] = array();
        $aIds = array();
        if (isset($this->oProduct)) {
            $aImages = $this->oProduct->getImages();

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
                } catch(Exception $ex) {
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

    protected function itemConditionField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function preparationTimeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        $aField['value'] = isset($aField['value']) ? str_replace(',', '.', trim($aField['value'])) : 0;
        if ((string)((int)$aField['value']) != $aField['value'] || (int)$aField['value'] < 1 || (int)$aField['value'] > 10) {
            $this->addError($aField, 'cdiscount_config_checkin_badshippingtime');
        } else {
            $aField['value'] = number_format($aField['value'], 0);
        }
    }

    // Shipping
    protected function shippingprofilenameField(&$aField) {
        try {
            $aField['values'] = MagnaConnector::gi()->submitRequestCached(array('ACTION' => 'GetDeliveryModes'), 60)['DATA'];
        } catch (\Exception $ex) {
            MLMessage::gi()->addDebug($ex);
        }
        $aField['value'] = $this->getFirstValue($aField);
    }

    public function shippingfeeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        if (empty($aField['value'])) {
            $aField['value'] = MLModule::gi()->getConfig('shippingfee');
        }
    }

    public function shippingfeeadditionalField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        if (empty($aField['value'])) {
            $aField['value'] = MLModule::gi()->getConfig('shippingfeeadditional');
        }
    }
    // -----------------

    protected function itemCountryField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function commentField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        if (isset($aField['value']) && mb_strlen($aField['value'], 'UTF-8') > self::COMMENT_MAX_LENGTH) {
            $aField['value'] = mb_substr($aField['value'], 0, self::COMMENT_MAX_LENGTH, 'UTF-8');
        }

        $aField['maxlength'] = self::COMMENT_MAX_LENGTH;
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

    /**
     * Sanitazes description and preparing it for Fyndiq because Fyndiq doesn't allow html tags.
     *
     * @param string $sDescription
     * @return string $sDescription
     *
     */
    private function cdiscountSanitizeDescription($sDescription) {
        $sDescription= preg_replace("#(<\\?div>|<\\?li>|<\\?p>|<\\?h1>|<\\?h2>|<\\?h3>|<\\?h4>|<\\?h5>|<\\?blockquote>)([^\n])#i", "$1\n$2", $sDescription);
        // Replace <br> tags with new lines
        $sDescription = preg_replace('/<[h|b]r[^>]*>/i', "\n", $sDescription);
        $sDescription = trim(strip_tags($sDescription));
        // Normalize space
        $sDescription = str_replace("\r", "\n", $sDescription);
        $sDescription = preg_replace("/\n{3,}/", "\n\n", $sDescription);

        if(strlen($sDescription) > self::DESC_MAX_LENGTH){
            $sDescription = mb_substr($sDescription,0,self::DESC_MAX_LENGTH - 3, 'UTF-8') . '...';
        }else{
            $sDescription = mb_substr($sDescription,0,self::DESC_MAX_LENGTH, 'UTF-8');
        }

        return $sDescription;
    }

    protected function addError(&$aField, $sMessage) {
        $aField['cssclasses'] = isset ($aField['cssclasses']) ? $aField['cssclasses'] : array();
        if (!in_array('ml-error', $aField['cssclasses'])) {
            $aField['cssclasses'][] = 'ml-error';
        }

        $this->aErrors[] = $sMessage;
    }
}
