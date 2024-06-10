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

class ML_GoogleShopping_Helper_Model_Table_GoogleShopping_PrepareData extends ML_Form_Helper_Model_Table_PrepareData_Abstract {
    public $aErrors = array();

    public function getPrepareTableProductsIdField() {
        return 'products_id';
    }
    
    protected function products_idField(&$aField) {
        $aField['value'] = $this->oProduct->get('id');
    }

    protected function productTypeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function shippingServiceField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function titleField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getName());

        if (!isset($aField['value']) || $aField['value'] === '') {
            $this->aErrors[] = 'ML_GOOGLESHOPPING_ERROR_MISSING_TITLE';
        }
    }

    protected function descriptionField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField, $this->oProduct->getDescription());

        if (!isset($aField['value']) || $aField['value'] === '') {
            $this->aErrors[] = 'ML_GOOGLESHOPPING_ERROR_MISSING_DESCRIPTION';
        }
    }

    protected function clientIdField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function clientSecretField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function shippingTemplateField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function offerIdField(&$aField) {
        $aField['value'] = $this->oProduct->getSku();
    }

    protected function conditionField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function primaryCategoryNameField(&$aField) {
        $aField['value'] = $this->oProduct->getCategoryPath();
    }

    protected function primaryCategoryField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function attributesField(&$aField) {
        $aField['dependonfield']['depend'] = 'primarycategory';
        $aField['value'] = $this->getFirstValue($aField, array());
    }

    protected function imageField(&$aField) {
        $aImages = $this->oProduct->getImages();
        foreach ($aImages as $sImage) {
            try {
                $aField['values'][$sImage] = MLImage::gi()->resizeImage($sImage, 'products', 60, 60);
            } catch (Exception $oEx) {
                $this->aErrors[] = 'googleshopping_prepare_images_not_exist';
            }
        }

        if (isset($aField['values'])) {
            $aField['value'] = array_keys($aField['values']);
            foreach ($aField['values'] as $imgKey => $imgVal) {
                $aField['value']['url'][] = $imgKey;
            }
        }
    }

    protected function variationGroups_ValueField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        $aField['optional'] = array('active' => true);
    }
}
