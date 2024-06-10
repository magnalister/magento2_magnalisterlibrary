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

class ML_Etsy_Helper_Model_Table_Etsy_PrepareData extends ML_Form_Helper_Model_Table_PrepareData_Abstract {

    public $aErrors = array();

    public function getPrepareTableProductsIdField() {
        return 'products_id';
    }

    protected function products_idField(&$aField) {
        $aField['value'] = $this->oProduct->get('id');
    }

    protected function primaryCategoryField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function attributesField(&$aField) {
        $aField['dependonfield']['depend'] = 'primarycategory';
        $aField['value'] = $this->getFirstValue($aField, array());
    }

    protected function titleField(&$aField) {
        $sProductTitle = $this->getFirstValue($aField) == '' ? $this->oProduct->getName() : $this->getFirstValue($aField);
        $aField['value'] = $sProductTitle;
    }

    protected function descriptionField(&$aField) {
        $productDescription = $this->getFirstValue($aField) == '' ? $this->oProduct->getDescription() : $this->getFirstValue($aField);

        if (strlen($productDescription) > 63000) {
            $this->aErrors[] = 'etsy_prepare_description_not_valid';
        }

        if (strlen($productDescription) < 5) {
            $this->aErrors[] = 'etsy_prepare_description_not_exist';
        }

        $aField['value'] = $productDescription;
    }

    protected function whomadeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function whenmadeField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    protected function issupplyField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    public function shippingprofileField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
    }

    public function shippingprofileorigincountryField(&$aField) {
        $this->getShippingProfileCountry($aField);
    }

    public function shippingprofiledestinationcountryField(&$aField) {
        $this->getShippingProfileCountry($aField);
    }

    public function shippingprofiledestinationregionField(&$aField) {
        $regions = MagnaConnector::gi()->submitRequestCached(array('ACTION' => 'GetShippingDestinationRegions'), 12 * 12 * 60);

        if (isset($regions)) {
            foreach ($regions['DATA'] as $value => $name) {
                $aField['values'][$value] = $name;
            }
        } else {
            $aField['values'][] = 'No regions available';
        }
    }

    private function getShippingProfileCountry(&$aField) {
        $countries = MagnaConnector::gi()->submitRequestCached(array('ACTION' => 'GetCountries', 'SUBSYSTEM' => 'Core'), 12 * 12 * 60);

        if (isset($countries)) {
            foreach ($countries['DATA'] as $iso => $countryName) {
                $aField['values'][$iso] = $countryName;
            }
        } else {
            $aField['values'][] = 'No country available';
        }
    }

    public function shippingtemplatecountryField(&$aField) {
        $countries = MagnaConnector::gi()->submitRequestCached(array('ACTION' => 'GetCountries'), 12 * 12 * 60);

        foreach ($countries['DATA']['OriginCountries'] as $country) {
            $aField['values'][$country['countryId']] = $country['name'];
        }
    }

    public function marketplacecategoryField(&$aField) {
        $sLang = MLModule::gi()->getConfig('shop.language');
        $sLang = strtoupper(substr($sLang, 0, 2));

        $categories = MagnaConnector::gi()->submitRequestCached(array(
            'ACTION' => 'GetCategories',
            'DATA' => array(
                'Language' => $sLang,
            ),
        ), 12 * 12 * 60);

        foreach ($categories['Categories'] as $category) {
            $aField['values'][$category['CategoryID']] = $category['CategoryName'];
        }

        $aField['value'] = $this->getFirstValue($aField);
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
                //$this->aErrors[] = 'etsy_prepare_images_not_exist';
            }

        }
        if (isset($aField['values'])) {
            reset($aImages);
            $aField['value'] = $this->getFirstValue($aField, array_keys($aField['values']));
            $aField['value'] = empty($aField['value']) ? array_keys($aField['values']) : $aField['value'];
            if (count($aField['value']) > 10) {
                MLMessage::gi()->addInfo('Etsy supports only 10 images per listing. If you select more than 10, first 10 selected images will be sent.');
            }
            $aField['value'] = count($aField['values']) > 10 ? array_slice($aField['value'], 0, 10) : (array)$aField['value'];
        } else {
            $aField['value'] = (array)$this->getFirstValue($aField, $aImages);
        }
    }

    protected function variationGroups_ValueField(&$aField) {
        $aField['value'] = $this->getFirstValue($aField);
        $aField['optional'] = array('active' => true);
    }
}
