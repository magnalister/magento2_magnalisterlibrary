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

class ML_Metro_Model_Service_AddItems extends ML_Modul_Model_Service_AddItems_Abstract {

    protected $oCurrentProduct = null;

    protected function handleException($oEx) {
        $mError = $oEx->getErrorArray();
        foreach ($mError['ERRORS'] as $aError) {
            MLMessage::gi()->addError($aError['ERRORMESSAGE'], '', false);
            $this->aError[] = $aError['ERRORMESSAGE'];
        }
    }

    protected function getProductArray() {

        $aOut = array();
        /* @var $oPrepareHelper ML_Metro_Helper_Model_Table_Metro_PrepareData */
        $oPrepareHelper = MLHelper::gi('Model_Table_Metro_PrepareData');
        try {
            $aDefineMasterMaster = $this->getFieldDefinition();

            foreach ($this->oList->getList() as $oMaster) {
                $this->oCurrentProduct = $oMaster;
                /* @var $oMaster ML_Shop_Model_Product_Abstract */
                $aListOfVariant = $this->oList->getVariants($oMaster);
                foreach ($aListOfVariant as $oVariant) {
                    /* @var $oVariant ML_Shop_Model_Product_Abstract */
                    if ($this->oList->isSelected($oVariant)) {
                        $oPrepareHelper
                            ->setPrepareList(null)
                            ->setProduct($oVariant)
                            ->setMasterProduct($oMaster);

                        $aProductData = $oPrepareHelper->getPrepareData($aDefineMasterMaster, 'value');
                        $aProductData['Price'] = (float)$aProductData['ShippingCost'] + (float)$aProductData['ProductPrice'];
                        $aProductData['Images'] = $this->replaceImages($aProductData['Images']);
                        $aProductData['ShippingGroup'] = $this->replaceShippingGroup($aProductData['ShippingGroup']);
                        $aProductData['FreightForwarding'] = $aProductData['FreightForwarding'] === 'true';
                        $aOut[] = $aProductData;
                    }
                }
            }

        } catch (Exception $oEx) {

            echo $oEx->getMessage();
        }
        return $aOut;
    }


    /**
     * zero quantity is allowed
     * @return bool
     */
    protected function checkQuantity() {
        return true;
    }

    /**
     * no need to upload
     * @return ML_Modul_Model_Service_AddItems_Abstract|void
     */
    protected function uploadItems() {
    }

    protected function getFieldDefinition() {
        $aReturn = array(
            'SKU' => array('optional' => array('active' => true)),
            'MasterSKU' => array('optional' => array('active' => true)),
            'Quantity'                          => array('optional' => array('active' => true)),
            'GTIN'                              => array('optional' => array('active' => true)),
            'CategoryID'                        => array('optional' => array('active' => true)),
            'Title'                             => array('optional' => array('active' => true)),
            'Manufacturer'                      => array('optional' => array('active' => true)),
            'ManufacturerPartNumber'            => array('optional' => array('active' => true)),
            'Brand'                             => array('optional' => array('active' => true)),
            'ManufacturersSuggestedRetailPrice' => array('optional' => array('active' => true)),
            'ShortDescription'                  => array('optional' => array('active' => true)),
            'Description'                       => array('optional' => array('active' => true), 'preparemode' => true),
            'Features'                          => array('optional' => array('active' => true)),
            'ProcessingTime'                    => array('optional' => array('active' => true)),
            'MaxProcessingTime'                 => array('optional' => array('active' => true)),
            'BusinessModel'                     => array('optional' => array('active' => true)),
            'FreightForwarding'                 => array('optional' => array('active' => true)),
            'Vat'                               => array('optional' => array('active' => true)),
            'Images'                            => array('optional' => array('active' => true), 'additemmode' => true),
            'ShippingCost'                      => array('optional' => array('active' => true)),
            'ShippingGroup'                     => array('optional' => array('active' => true)),
            'ProductPrice'                      => array('optional' => array('active' => true)),
            'MarketplaceAttributes'             => array('optional' => array('active' => true)),
            'VolumePrices'                      => array('optional' => array('active' => true)),
        );
        return $aReturn;
    }

    /**
     * @param $aImages
     * @return array
     */
    protected function replaceImages($aImages) {
        $sSize = MLModul::gi()->getConfig('imagesize');
        $iSize = $sSize === null ? 500 : (int)$sSize;
        $aOut = array();
        foreach ($aImages as $sImage) {
            try {
                $aImage = MLImage::gi()->resizeImage($sImage, 'products', $iSize, $iSize);
                $aOut[] = $aImage['url'];
            } catch (Exception $oEx) {//no image
            }
        }
        return $aOut;
    }
     /**
     * @param $iShippingGroup
     * @return string
     */
    protected function replaceShippingGroup($iShippingGroup) {
        $groups = MLModule::gi()->getConfig('shipping.group.name');
        if (!is_array($groups)) {
            return '';
        }
        if (array_key_exists($iShippingGroup, $groups)) {
            return $groups[$iShippingGroup];
        } else {
            $aDefaults = MLModule::gi()->getConfig('shipping.group');
            foreach ($aDefaults as $aNo => $aDefault) {
                if ($aDefault['default'] == 1) {
                    return $groups[$aNo];
                }
            }
        }
        return '';
    }
}
