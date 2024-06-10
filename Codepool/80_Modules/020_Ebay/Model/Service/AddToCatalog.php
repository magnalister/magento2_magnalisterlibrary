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
class ML_Ebay_Model_Service_AddToCatalog extends ML_Ebay_Model_Service_AddItems {

    protected $sAction = 'AddProductToCatalog';
    protected $aEpidList = array();

    public function setEPidList($aEpidList) {
        $this->aEpidList = $aEpidList;
    }

    protected function getProductArray() {
        $this->oCurrentProduct = current($this->oList->getList());
        /* @var $oMaster ML_Shop_Model_Product_Abstract */
        $iId = $this->oCurrentProduct->get('id');
        $oParent = $this->oCurrentProduct->getParent();
        $this->aOut[$iId] = $this->replacePrepareData(
                $this->getPrepareHelper()
                        ->setPrepareList(null)
                        ->setProduct($this->oCurrentProduct)
                        ->setMasterProduct($oParent)
                        ->getPrepareData($this->getFieldDefineComplete(), 'value')
        );
        $this->aOut[$iId]['Description'] = stringToUTF8(html_entity_decode(fixHTMLUTF8Entities(MLProduct::factory()->set('id', $iId)->getDescription())));
        if (isset($this->aEpidList[$iId])) {
            $this->aOut[$iId]['changeRequestType'] = 'PRODUCT_UPDATE';
            $this->aOut[$iId]['ePID'] = $this->aEpidList[$iId];
        } else {
            $this->aOut[$iId]['changeRequestType'] = 'PRODUCT_CREATION';
        }
        return $this->aOut;
    }

    protected function getFieldDefineMasterMaster() {
        $aRetrun = array(
            'Title' => array('optional' => array('active' => true)),
            'PictureURL' => array('optional' => array('active' => true)),
            'Subtitle' => array(),
            'StartTime' => array(),
            'StartPrice' => array('optional' => array('active' => true)),
            'Quantity' => array('optional' => array('active' => true)),
            'BasePrice' => array('optional' => array('active' => true)),
            'BasePriceString' => array('optional' => array('active' => true)),
            'MPN' => array('optional' => array('active' => true)),
            'EAN' => array('optional' => array('active' => true)),
        );

        if (MLShop::gi()->addonBooked('EbayProductIdentifierSync') && MLModule::gi()->getConfig('syncproperties')) {
            $aRetrun += array(
                'Brand' => array('optional' => array('active' => true)),
            );
        }
        //add Tecdoc
        return $aRetrun;
    }

    protected function getFieldDefineMasterVariant() {
        $aReturn = array(
            'PrimaryCategory' => array('optional' => array('active' => true)),
            'ConditionID' => array('optional' => array('active' => true)),
            'SecondaryCategory' => array(),
            'StoreCategory' => array(),
            'StoreCategory2' => array(),
            'ItemSpecifics' => array('optional' => array('active' => true)),
            'Attributes' => array('optional' => array('active' => true)),
            'doCalculateBasePriceForVariants' => array('optional' => array('active' => true)),
            'PurgePictures' => array(),
            'VariationDimensionForPictures' => array('optional' => array('active' => true)),
            'VariationPictures' => array('optional' => array('active' => true)),
            'PicturePack' => array('optional' => array('active' => true)),
            'RestrictedToBusiness' => array('optional' => array('active' => true)),
            'RawAttributesMatching' => array('optional' => array('active' => true)),
            'RawVariationThemeBlacklist' => array('optional' => array('active' => true)),
        );
        if (MLHelper::gi('model_form_type_sellerprofiles')->hasSellerProfiles()) {
            
        } else {
            $aReturn['PaymentInstructions'] = array('optional' => array('active' => true));
        }
        return $aReturn;
    }

    protected function getFieldDefineVariant() {
        $aRetrun = array(
            'StartPrice' => array('optional' => array('active' => true)),
            'SKU' => array('optional' => array('active' => true)),
            'Quantity' => array('optional' => array('active' => true)),
            'Variation' => array('optional' => array('active' => true)),
            'ItemSpecifics' => array('optional' => array('active' => true)),
            'BasePrice' => array('optional' => array('active' => true)),
            'ShortBasePriceString' => array('optional' => array('active' => true)),
            'MPN' => array('optional' => array('active' => true)),
            'EAN' => array('optional' => array('active' => true)),
            'RawShopVariation' => array('optional' => array('active' => true)),
        );

        return $aRetrun;
    }

    protected function unsetShopRawData(&$product) {
    }

}
