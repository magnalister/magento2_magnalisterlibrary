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

class ML_Idealo_Helper_Model_Table_Idealo_PrepareData extends ML_Form_Helper_Model_Table_PrepareData_Abstract {

    public function getPrepareTableProductsIdField() {
        return 'products_id';
    }

    protected function products_idField(&$aField) {
        $aField['value'] = $this->oProduct->get('id');
    }

    protected function titleField(&$aField) {
        $sTitle = $this->getFirstValue($aField);

        // If it will be loaded as $this->>itemTitleField
        if (empty($sTitle) && $aField['name'] == 'ItemTitle') {
            $aField['name'] = $aField['realname'] = 'title';
            $sTitle = $this->getFirstValue($aField);
            $aField['name'] = $aField['realname'] = 'ItemTitle';
        }

        // Helper for php8 compatibility - can't pass null to trim 
        $sTitle = MLHelper::gi('php8compatibility')->checkNull($sTitle);
        $aField['value'] = trim($sTitle) == '' ? $this->oProduct->getName() : $sTitle;
    }

    protected function itemTitleField(&$aField) {
        $this->titleField($aField);
    }

    protected function descriptionField(&$aField) {
        $sDescription = $this->getFirstValue($aField);

        // Helper for php8 compatibility - can't pass null to trim 
        $sDescription = MLHelper::gi('php8compatibility')->checkNull($sDescription);
        $aField['value'] = trim($sDescription) == '' ? $this->oProduct->getDescription() : $sDescription;
    }

    protected function imageField(&$aField) {
        $aImages = $this->oProduct->getImages();
        if ($this->oProduct->get('parentid') != 0) {
            $aImages = array_merge($aImages, $this->oProduct->getParent()->getImages());
        }
        foreach ($aImages as $sImage) {
            try {
                $aField['values'][$sImage] = MLImage::gi()->resizeImage($sImage, 'products', 80, 80);
            } catch (Exception $oEx) {
                //no image in fs
            }
        }
        if (isset($aField['values'])) {
            reset($aImages);
            $aField['value'] = $this->getFirstValue($aField, array_keys($aField['values']));
            $aField['value'] = empty($aField['value']) ? array_keys($aField['values']) : $aField['value'];
            $aField['value'] = (array)$aField['value'];
        } else {
            $aField['value'] = (array)$this->getFirstValue($aField, $aImages);
        }
    }

    public function shippingCountryField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    public function shippingCostMethodField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    public function shippingCostField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        $aField['value'] = isset($aField['value']) ? str_replace(',', '.',trim($aField['value'])) : '';
        if ($aField['value'] == '') {
            $aField['value'] = '0.00';
        }
    }

    public function shippingTimeField(&$aField) {
        if (
            !$this->optionalIsActive('shippingtime')
            && $this->oProduct !== null
            && MLModul::gi()->getConfig('shippingtimeproductfield') != ''
            && $this->oProduct->getModulField('shippingtimeproductfield') != ''
        ) {
            $aField['value'] = array(
                'type' => '__ml_lump',
                'value' => $this->oProduct->getModulField('shippingtimeproductfield')
            );
        }
        $aField['value'] = $this->getFirstValue($aField);
    }

    public function basePriceField(&$aField) {
        $aField['value'] = $this->oProduct->getBasePrice();
        if ($aField['value'] === array()) {
            $aField['value'] = null;
        }
    }

    public function quantityField(&$aField) {
        $aField['value'] = $this->oProduct->getSuggestedMarketplaceStock(
            MLModule::gi()->getConfig('quantity.type'),
            MLModule::gi()->getConfig('quantity.value')
        );
    }

    public function priceField(&$aField) {
        $aField['value'] = $this->oProduct->getSuggestedMarketplacePrice(MLModul::gi()->getPriceObject());
    }

    public function skuField(&$aField) {
        $aField['value'] = $this->oProduct->getMarketPlaceSku();
    }

    public function itemUrlField(&$aField) {
        $aField['value'] = $this->oProduct->getFrontendLink();
    }

    public function manufacturerField(&$aField) {
        $aField['value'] = $this->oProduct->getModulField('manufacturer');
        if ($aField['value'] === '') {
            $aField['value'] = null;
        }
    }

    public function itemWeightField(&$aField) {
        $aWeight = $this->oProduct->getWeight();
        $aField['value'] = is_array($aWeight) && isset($aWeight['Value']) ? $aWeight['Value'] : 0;
    }

    public function eanField(&$aField) {
        $aField['value'] = $this->oProduct->getModulField('general.ean', true);
        if ($aField['value'] === '') {
            $aField['value'] = null;
        }
    }

    public function manufacturerPartNumberField(&$aField) {
        $aField['value'] = $this->oProduct->getModulField('manufacturerpartnumber');
        if ($aField['value'] === '') {
            $aField['value'] = null;
        }
    }

    public function merchantCategoryField(&$aField) {
        $aField['value'] = $this->oProduct->getCategoryPath();
    }

    public function paymentMethodField(&$aField) {
        $sValue = $this->getFirstValue($aField);
        $aField['value'] = $sValue === null ? array() : $sValue;
    }

}
