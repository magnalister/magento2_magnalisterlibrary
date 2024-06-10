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

class ML_MercadoLivre_Helper_Model_Service_Product {

    /** @var ML_Database_Model_Table_Selection $oSelection */
    protected $oSelection = null;
    protected $aSelectionData = array();

    /** @var ML_MercadoLivre_Model_Table_MercadoLivre_Prepare $oPrepare  */
    protected $oPrepare = null;

    /** @var ML_Shop_Model_Product_Abstract $oProduct  */
    protected $oProduct = null;
    protected $oVariant = null;
    protected $aData = null;

    public function __call($sName, $mValue) {
        return $sName . '()';
    }

    public function __construct() {
        $this->oPrepare = MLDatabase::factory('mercadolivre_prepare');
        $this->oSelection = MLDatabase::factory('selection');
    }

    public function setProduct(ML_Shop_Model_Product_Abstract $oProduct) {
        $this->oProduct = $oProduct;
        $this->sPrepareType = '';
        $this->aData = null;
        return $this;
    }
    
    public function setVariant(ML_Shop_Model_Product_Abstract $oProduct){
        $this->oVariant=$oProduct;
        return $this;
    }
    
    public function resetData () {
        $this->aData = null;
        return $this;
    }
    
    public function getData() {
        if ($this->aData === null) {
            $this->oPrepare->init()->set('products_id', $this->oVariant->get('id'));
            $aData = array();
            foreach (
            array(
                'SKU',
				'Title',
                'Description',
                'Images',
                'Quantity',
                'Price',
                'CategoryID',
                'Currency',
                'ConditionType',
                'ListingType',
                'BuyingMode',
                'Shipping',
				'VariationId',
            ) as $sField) {
                if (method_exists($this, 'get' . $sField)) {
                    $mValue = $this->{'get' . $sField}();
                    if (is_array($mValue)) {
                        foreach ($mValue as $sKey => $mCurrentValue) {
                            if (empty($mCurrentValue)) {
                                unset ($mValue[$sKey]);
                            }
                        }
                        $mValue = empty($mValue) ? null : $mValue;
                    }
                    if ($mValue !== null) {
                        $aData[$sField] = $mValue;
                    }
                } else {
                    MLMessage::gi()->addWarn("function  ML_MercadoLivre_Helper_Model_Service_Product::get" . $sField . "() doesn't exist");
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

	protected function getTitle() {
        $iLangId = MLModule::gi()->getConfig('lang');
		$this->oVariant->setLang($iLangId);

        return $this->oVariant->getName();
	}

    protected function getDescription() {
        $iLangId = MLModule::gi()->getConfig('lang');
		$this->oVariant->setLang($iLangId);

        return $this->oVariant->getDescription();
    }

    protected function getImages() {
        $aOut = array();
        foreach ($this->oVariant->getImages() as $sImage ) {
			try {
				$aImage = MLImage::gi()->resizeImage($sImage, 'products', 500, 500);
				$aOut[]['URL'] = $aImage['url'];
			} catch(Exception $ex) {
				// Happens if image doesn't exist.
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
        if (isset($this->aSelectionData['price'])) {
            return $this->aSelectionData['price'];
        } else {
            return $this->oVariant->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject());
        }
    }

    protected function getCategoryID() {
        return $this->oPrepare->get('PrimaryCategory');
    }

    protected function getCurrency() {
        return $this->oPrepare->get('Currency');
    }

    protected function getConditionType() {
        return $this->oPrepare->get('ItemCondition');
    }

    protected function getListingType() {
        return $this->oPrepare->get('ListingType');
    }

    protected function getBuyingMode() {
        return $this->oPrepare->get('BuyingMode');
    }

    protected function getShipping() {
		$aOut = array(
			'Mode' => $this->oPrepare->get('ShippingMode')
		);

		if ($aOut['Mode'] === 'custom') {
            $aCustomShipping = MLModule::gi()->getConfig('checkin.customshipping');
			if ($aCustomShipping !== null) {
				foreach ($aCustomShipping as $aShipping) {
					$aOut['Costs'][] = array(
						'Description' => $aShipping['key'],
						'Cost' => $aShipping['value'],
					);
				}
			}
		}

		return $aOut;
    }

	protected function getVariationId() {
        $aResult = $this->oVariant->getVariatonData();
        if (count($aResult) != 0) {
			return $this->oVariant->get('id');
        } else {
			return null;
		}
    }

}
