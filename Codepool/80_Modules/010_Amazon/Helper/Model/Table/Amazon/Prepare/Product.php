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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

/**
 * @todo use form modul
 */
class ML_Amazon_Helper_Model_Table_Amazon_Prepare_Product {
    protected $oPrepare = null;
    protected $aModulConfig = array();
    protected $oProduct = null;

    public function __construct() {
        $this->oPrepare = MLDatabase::factory('amazon_prepare');
        $this->aModulConfig = MLModule::gi()->getConfig();
    }

    public function apply(ML_Shop_Model_Product_Abstract $oProduct, $aData = array()) {
        $this->oProduct = $oProduct;
        $iPID = $oProduct->get('id');
        $iPID ? $this->init('apply') : $this->oPrepare->set('preparetype', 'apply');
        $sManufacturer = $iPID ? $this->oProduct->getParent()->getModulField('general.manufacturer', true) : '';
        if (empty($sManufacturer)) {
            $sManufacturer = $this->aModulConfig['prepare.manufacturerfallback'];
        }
        if (isset($this->aModulConfig['checkin.skuasmfrpartno']) && $this->aModulConfig['checkin.skuasmfrpartno']) {
            $sManufacturerPartNumber = $this->oProduct->getSku();
        } else {
            $sManufacturerPartNumber = $iPID ? $this->oProduct->getModulField('general.manufacturerpartnumber', true) : '';
        }

        $sDescription = $iPID ? $this->oProduct->getParent()->getDescription() : '';
        $sDescription = $this->amazonSanitizeDescription($sDescription);

        // For USA we set UPC instead of EAN
        if ($this->aModulConfig['site'] === 'US') {
            $sType = 'UPC';
            $sInternationalIdentifier = $iPID ? $this->oProduct->getModulField('general.upc', true) : '';
        } else {
            $sType = 'EAN';
            $sInternationalIdentifier = $iPID ? $this->oProduct->getModulField('general.ean', true) : '';
        }

        $aBasePrice = $iPID ? $this->oProduct->getBasePrice() : array();
        $aImages = array();
        if ($iPID) {
            foreach ($this->oProduct->getParent()->getImages() as $sImage) {
                $aImages[$sImage] = true;
            }
        }

        $sProductKeywords = $this->getMetaKeywords();

        $this->oPrepare
            ->set('aidenttype', $sType)
            ->set('aidentid', $sInternationalIdentifier)
            ->set('maincategory', '')
            ->set('topmaincategory', '')
            ->set('topproducttype', '')
            ->set('topbrowsenode1', '')
            ->set('topbrowsenode2', '')
            ->set('ProductType', '')
            ->set('BrowseNodes', array())
            ->set('ItemTitle', $iPID ? $this->oProduct->getParent()->getName() : '')
            ->set('Manufacturer', $sManufacturer)
            ->set('Brand', $sManufacturer)
            ->set('ManufacturerPartNumber', $sManufacturerPartNumber)
            ->set('Images', $aImages)
            ->set('BulletPoints', $this->stringToArray($iPID ? $this->oProduct->getParent()->getMetaDescription() : '', 5, 500))
            ->set('Description', $sDescription)
            ->set('Keywords',  $sProductKeywords)
            ->set('Attributes', array())
            ->set('match', array())
            ->set('BasePrice', $aBasePrice)
            ->set('ApplyData', '');

        if (isset($aData['ShippingTime'])) {
            if ($aData['ShippingTime'] != 'X') {
                $this->oPrepare
                    ->set('leadtimetoship', is_numeric($aData['ShippingTime']) ? $aData['ShippingTime'] : 0) //deprecated
                    ->set('shippingtime', is_numeric($aData['ShippingTime']) ? $aData['ShippingTime'] : 0);
            }
            unset($aData['ShippingTime']);
        }

        // all values will set to prepare table (may unset some)
        $this->setData($aData);
        return $this;
    }

    public function auto(ML_Shop_Model_Product_Abstract $oProduct, $aData = array(),$complete= true) {
        $aData['iscomplete'] = $complete ? 'true' : 'false';
        $this->oProduct = $oProduct;
        $this->init('auto')->matching();
        $sEan = $this->oProduct->getModulField('general.ean', true);
        $this->oPrepare
            ->set('aidenttype', 'EAN')
            ->set('aidentid', $sEan === null ? '' : $sEan);
        $this->setData($aData);
        return $this;
    }

    public function manual(ML_Shop_Model_Product_Abstract $oProduct, $aData = array()) {
        $aData['iscomplete'] = "true";
        $this->oProduct = $oProduct;
        $this->init('manual')->matching();
        $this->oPrepare
            ->set('aidenttype', 'ASIN')
            ->set('aidentid', '')//get from $aData
        ;
        $this->setData($aData);
        return $this;
    }

    public function getTableModel() {
        return $this->oPrepare;
    }

    /**
     * Preset the data for matching view
     */
    protected function matching() {
        foreach ($this->aModulConfig['shipping.template'] as $iKey => $aTemplate) {
            if ($aTemplate['default'] == '1') {
                $sDefaultTemplate = $iKey;
            }
        }

        $this->oPrepare
            ->set('lowestprice', 0.0)
            //->set('shipping', $this->aModulConfig['internationalshipping'])
            ->set('ShippingTime', $this->aModulConfig['leadtimetoship'])
            ->set('ShippingTemplate', $sDefaultTemplate)
        ;

        $shopData = MLShop::gi()->getShopInfo();
        if ($shopData['DATA']['IsBopisPilot'] === 'yes') {
            $this->oPrepare->set('BopisStores', array());
        }
    }

    protected function init($sPrepareType) {
        $this->oPrepare->init(true)->set('productsid', $this->oProduct->get('id'))->load();
        $this->oPrepare->set('preparetype', $sPrepareType);
        return $this;
    }

    protected function setData($aData) {
        foreach ($aData as $sKey => $mValue) {
            $this->oPrepare->set($sKey, $mValue);
        }
        return $this;
    }

    protected function amazonSanitizeDescription($sDescription) {
        $sDescription = str_replace(array('&nbsp;', html_entity_decode('&nbsp;', ENT_COMPAT, 'UTF-8')), ' ', $sDescription);
        $sDescription = sanitizeProductDescription(
            $sDescription,
            '<p><br><ul><ol><li><strong><b><em><i>',
            '_keep_all_'
        );
        $sDescription = str_replace(array('<br />', '<br/>'), '<br>', $sDescription);
        // $sDescription = preg_replace('/(\s*<br[^>]*>\s*)*$/', ' ', $sDescription);
        $sDescription = preg_replace('/\s\s+/', ' ', $sDescription);
        $sDescription = $this->truncateStringHtmlSafe($sDescription, 2000);
        return $sDescription;
    }

    protected function stringToArray($sString, $iCount, $iMaxChars) {
        $aArray = explode(',', $sString);
        array_walk($aArray, array($this, 'trim'));
        $aOut = array_slice($aArray, 0, $iCount);
        foreach ($aOut as $sKey => $sBullet) {
            $aOut[$sKey] = trim($sBullet);
            if (empty($aOut[$sKey])) {
                continue;
            }
            $aOut[$sKey] = substr($sBullet, 0, strpos(wordwrap($sBullet, $iMaxChars, "\n", true)."\n", "\n"));
        }
        return array_pad($aOut, $iCount, '');
    }

    protected function trim(&$v, $k) {
        $v = trim($v);
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

    /**
     * Returns the Meta Keywords
     *
     * @return string
     */
    protected function getMetaKeywords() {
        $sProductKeywords = $this->oProduct->getMetaKeywords();
        return substr($sProductKeywords, 0, strpos(wordwrap($sProductKeywords, 1000, "\n", true)."\n", "\n"));
    }
}
