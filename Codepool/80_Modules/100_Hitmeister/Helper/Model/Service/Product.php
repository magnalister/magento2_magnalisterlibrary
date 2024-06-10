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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Hitmeister_Helper_Model_Service_Product {

    /** @var ML_Database_Model_Table_Selection $oSelection */
    protected $oSelection = null;
    protected $aSelectionData = array();

    /** @var ML_Hitmeister_Model_Table_Hitmeister_Prepare $oPrepare  */
    protected $oPrepare = null;

    /** @var ML_Shop_Model_Product_Abstract $oProduct  */
    protected $oProduct = null;
    /** @var ML_Shop_Model_Product_Abstract $oProduct  */
    protected $oVariant = null;
    protected $aData = null;
    /**
     * @var ML_Hitmeister_Helper_Model_Table_Hitmeister_PrepareData
     */
    protected $oPrepareHelper = null;

	protected $aLang = null;

    public function __call($sName, $mValue) {
        return $sName . '()';
    }

    public function __construct() {
        $this->oPrepare = MLDatabase::factory('hitmeister_prepare');
        $this->oSelection = MLDatabase::factory('selection');
    }

    public function setProduct(ML_Shop_Model_Product_Abstract $oProduct) {
        $this->oPrepareHelper = MLHelper::gi('Model_Table_Hitmeister_PrepareData');
        $this->oProduct = $oProduct;//old way to get product data by uploading product, completely different from preparation
        $this->oPrepareHelper
            ->setPrepareList(null)
            ->setProduct($oProduct);//standard way to get product data to upload them, with same method that is used by preparation
        $this->sPrepareType = '';
        $this->aData = null;
        return $this;
    }
    
    public function setVariant(ML_Shop_Model_Product_Abstract $oProduct){
        $this->oVariant=$oProduct;
        $this->oPrepareHelper
            ->setProduct($oProduct);
        return $this;
    }
    
    public function resetData () {
        $this->aData = null;
        $this->aLang = MLModule::gi()->getConfig('lang');
        return $this;
    }
    
    public function getData() {
        if ($this->aData === null) {
            $this->oPrepare->init()->set('products_id', $this->oVariant->get('id'));
            $aData = array();
            $aFields = array(
                'SKU',
                'EAN',
                'MarketplaceCategory',
                'CategoryAttributes',
                'Title',
                'Subtitle',
                'Description',
                'Images',
                'Quantity',
                'Price',
                'Currency',
                'MinimumPrice',
                'Manufacturer',
                'ManufacturerPartNumber',
                'ItemTax',
                'HandlingTime',
                'ConditionType',
                'Location',
                'ShippingGroup',
                'Comment',
                'Matched',
            );
            if (    MLModule::gi()->getConfig('minimumpriceautomatic') !== '2'
                 || MLModule::gi()->getConfig('price.lowest.addkind')  === null) {
                unset($aFields[array_search('MinimumPrice', $aFields)]);
            }

            foreach ($aFields as $sField) {
                if (method_exists($this, 'get' . $sField)) {
                    $mValue = $this->{'get' . $sField}();
                    if (is_array($mValue)) {
//                        foreach ($mValue as $sKey => $mCurrentValue) {
//                            if (empty($mCurrentValue)) {
//                                unset ($mValue[$sKey]);
//                            }
//                        }
                        $mValue = empty($mValue) ? null : $mValue;
                    }
                    if ($mValue !== null) {
                        $aData[$sField] = $mValue;
                    }
                } else if ($sField == 'Currency') {
                    $aData[$sField] = MLModule::gi()->getConfig('currency');
                } else {
                    MLMessage::gi()->addWarn("function  ML_Hitmeister_Helper_Model_Service_Product::get" . $sField . "() doesn't exist");
                }
            }
            
            if (empty($aData['BasePrice'])) {
                unset($aData['BasePrice']);
            }
            
            $this->aData = $aData;
        }

        return $this->aData;
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
        /* @var $attributesMatchingService ML_Hitmeister_Helper_Model_Service_AttributesMatching */
        $attributesMatchingService = MLHelper::gi('Model_Service_AttributesMatching');
        $value = $attributesMatchingService->mergeConvertedMatchingToNameValue(
            $this->oPrepare->get('ShopVariation'),
            $this->oVariant,
            $this->oProduct
        );

        if (is_array($value) && array_key_exists('weight', $value)) {
            $value['weight'] = mb_strtolower($value['weight']);
        }

        return $value;
    }

    protected function getTitle() {
        $sTitle = $this->oPrepare->get('Title');
        if (isset($sTitle) === false || empty($sTitle)) {
            $iLangId = MLModule::gi()->getConfig('lang');
            $this->oVariant->setLang($iLangId);
            $sTitle = $this->oVariant->getName();
        }
        
        if (MLModule::gi()->getConfig('checkin.variationtitle') && !$this->oVariant->isSingle()) {
            foreach ($this->oVariant->getVariatonData() as $aVariation) {
                $sTitle .= ' '.$aVariation['name'].': '.$aVariation['value'];
            }
        }

        return $sTitle;
	}
    
    /**
     * Subtitle will be submitted as "short_description" as part of the csv to Kaufland
     *  Use either already prepared data or if not empty use short description otherwise try to use keywords defined in the shop
     * @return string|string[]|null
     */
    protected function getSubtitle() {
        $sSubtitle = $this->oPrepare->get('Subtitle');
        if (isset($sSubtitle) === false || $sSubtitle === null) {
            $iLangId = MLModule::gi()->getConfig('lang');
            $this->oVariant->setLang($iLangId);
            $sSubtitle = $this->oVariant->getShortDescription();
            if (empty($sSubtitle)) {
                $sSubtitle = $this->oVariant->getMetaKeywords();
            }
        }

        $sSubtitle = $this->sanitizeDescription($sSubtitle);
        
        return $sSubtitle;
	}

    protected function getDescription() {
        $aData = $this->oPrepareHelper->getPrepareData(
            array(
                'Description' => array('optional' => array('active' => true),),
            ), 'value'
        );
        
        return $aData['Description'];
    }

    protected function getImages() {
        $aImages = $this->oVariant->getImages();
        $aImages = empty($aImages) ? $this->oProduct->getImages() : $aImages;
        $aImagesPrepare = $this->oPrepare->get('Images');
        if (empty($aImagesPrepare)){
            $aImagesPrepare = array();
            foreach ($aImages as $sImage) {
                $aImagesPrepare[] = substr($sImage, strrpos($sImage, DIRECTORY_SEPARATOR)+1);
            }
        }
        $aOut = array();
        if (!empty($aImagesPrepare)){
            foreach ($aImages as $sImage){
                $sImageName = substr($sImage, strrpos($sImage, DIRECTORY_SEPARATOR)+1);

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

    protected function getMinimumPrice() {
        return $this->oVariant->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject('lowest'));
    }
           
    protected function getManufacturer() {
        return $this->oVariant->getManufacturer();
    }
    
    protected function getManufacturerPartNumber() {
        return $this->oVariant->getManufacturerPartNumber();
    }
    
    protected function getItemTax() {
        return $this->oVariant->getTax();
    }
	
    protected function getShippingTIme() {
        return $this->oPrepare->get('ShippingTIme');
    }
    
    protected function getHandlingTIme() {
        return $this->oPrepare->get('HandlingTIme');
    }
    
    protected function getConditionType() {
        return $this->oPrepare->get('ItemCondition');
    }
    
    protected function getLocation() {
        return $this->oPrepare->get('ItemCountry');
    }
    
    protected function getShippingGroup() {
        return $this->oPrepare->get('ShippingGroup');
    }
    
    protected function getComment() {
        return $this->oPrepare->get('Comment');
    }
    
    protected function getMatched() {
        return $this->oPrepare->get('PrepareType') !== 'apply';
    }


    private function sanitizeDescription($sDescription)
    {
        $sDescription = preg_replace("#(<\\?div>|<\\?li>|<\\?p>|<\\?h1>|<\\?h2>|<\\?h3>|<\\?h4>|<\\?h5>|<\\?blockquote>)([^\n])#i", "$1\n$2", $sDescription);
        // Replace <br> tags with new lines
        $sDescription = preg_replace('/<[h|b]r[^>]*>/i', "\n", $sDescription);
        $sDescription = trim(strip_tags($sDescription));
        // Normalize space
        $sDescription = str_replace("\r", "\n", $sDescription);
        $sDescription = preg_replace("/\n{3,}/", "\n\n", $sDescription);

        return $sDescription;
    }
    
}
