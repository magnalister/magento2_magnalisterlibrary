<?php

abstract class ML_Productlist_Helper_Model_ProductList_List_Abstract {

    protected $aHeader = array();

    abstract public function shopSystemAttribute($sCode, $blUse = true, $sTitle = null, $sTypeVariant = null);

    public function __call($name, $aData) {
        $sValue = MLModule::gi()->getConfig($name);
        if (!empty($sValue)) {
            $sI18N = is_array($aData) && isset($aData[0]['title']) ? MLI18n::gi()->get($aData[0]['title']) : null;
            return $this->shopSystemAttribute($sValue, true, $sI18N);
        }
    }

    public function image($sTypeVariant = null) {
        if ($this->oLoadedProduct === null) {
            if (!in_array(__function__, $this->aFields)) {
                $this->aFields[] = __function__;
                $this->aHeader[__function__] = array(
                    'title' => MLI18n::gi()->get('Productlist_Header_sImage'),
                    'type' => 'image',
                    'type_variant' => $sTypeVariant === null ? 'image' : $sTypeVariant
                );
            }
            return $this;
        }
    }

    public function quantityMarketplace($sTypeVariant = null) {
        if ($this->oLoadedProduct === null) {
            if (!in_array(__function__, $this->aFields)) {
                $this->aFields[] = __function__;
                $this->aHeader[__function__] = array(
                    'title' => sprintf(MLI18n::gi()->get('Productlist_Header_sStockMarketplace'), MLModule::gi()->getMarketPlaceName(false)),
                    'type' => 'quantityMarketplace',
                    'type_variant' => $sTypeVariant === null ? 'quantityMarketplace' : $sTypeVariant
                );
            }
            return $this;
        }
    }

    public function getHeader() {
        return $this->aHeader;
    }

    public function priceMarketplace($sTypeVariant = null) {
        if ($this->oLoadedProduct === null) {
            if (!in_array(__function__, $this->aFields)) {
                $this->aFields[] = __function__;
                $this->aHeader[__function__] = array(
                    'title' => sprintf(MLI18n::gi()->get('Productlist_Header_sPriceMarketplace'), MLModule::gi()->getMarketPlaceName(false)),
                    'type' => 'priceMarketplace',
                    'type_variant' => $sTypeVariant === null ? 'priceMarketplace' : $sTypeVariant
                );
            }
            return $this;
        }
    }

    public function product($sTypeVariant = null) {
        if ($this->oLoadedProduct === null) {
            if (!in_array(__function__, $this->aFields)) {
                $this->aFields[] = __function__;
                $this->aHeader[__function__] = array(
                    'title' => MLI18n::gi()->get('Productlist_Header_sProduct'),
                    'order' => 'name',
                    'type' => 'product',
                    'type_variant' => $sTypeVariant === null ? 'product' : $sTypeVariant
                );
            }
            return $this;
        }
    }

    public function preparedStatus($sTypeVariant = null) {
        if ($this->oLoadedProduct === null) {
            $this->aFields[] = __function__;
            $this->aHeader[__function__] = array(
                'title' => MLI18n::gi()->get('Productlist_Header_sPreparedStatus'),
                'type' => 'preparedStatus',
                'type_variant' => $sTypeVariant === null ? 'preparedStatus' : $sTypeVariant
            );
            return $this;
        }
    }

    public function preparedType($sTypeVariant = null) {
        if ($this->oLoadedProduct === null) {
            $sTitle = MLI18n::gi()->get(ucfirst(MLModule::gi()->getMarketPlaceName()) . '_Productlist_Header_sPreparedType');
            if ($sTitle == ucfirst(MLModule::gi()->getMarketPlaceName()) . '_Productlist_Header_sPreparedType') {
                $sTitle = MLI18n::gi()->get('Productlist_Header_sPreparedType');
            }
            $this->aFields[] = __function__;
            $this->aHeader[__function__] = array(
                'title' => $sTitle,
                'type' => 'preparedType',
                'type_variant' => $sTypeVariant === null ? 'preparedType' : $sTypeVariant
            );
            return $this;
        }
    }

    public function addMLField($aHead) {
        if ($this->oLoadedProduct === null) {
            $this->aHeader[] = $aHead;
            return $this;
        }
    }

    public function categoryMarketplace() {
        if ($this->oLoadedProduct === null) {
            if (!in_array(__FUNCTION__, $this->aFields)) {
                $this->aFields[] = __FUNCTION__;
                $this->aHeader[__FUNCTION__] = array(
                    'title' => MLI18n::gi()->get('Productlist_Header_sMarketplaceCategory'),
                    'type' => 'categoryMarketplace',
                );
            }

            return $this;
        }
    }

}
