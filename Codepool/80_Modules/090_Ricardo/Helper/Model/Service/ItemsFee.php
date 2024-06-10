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
MLFilesystem::gi()->loadClass('Modul_Helper_Model_Service_ItemsFee');

class ML_Ricardo_Helper_Model_Service_ItemsFee extends ML_Modul_Helper_Model_Service_ItemsFee {

    protected function getPrepareTableName() {
        return 'ricardo_prepare';
    }

    protected function getFields() {
        return array(
            'ListingType',
            'ConditionType',
            'Price',
            'Category',
            'Quantity',
            'ImageCount',
            'Promotions',
            'StartDate',
            'StartPrice'
        );
    }

    protected function getListingType() {
		return $this->oPrepare->get('BuyingMode');
	}

    protected function getConditionType() {
		return $this->oPrepare->get('ArticleCondition');
	}

    protected function getPrice() {
		$sPrice = $this->oPrepare->get('FixPrice');
		$sRicardoPrice = $this->oVariant->getSuggestedMarketplacePrice(MLModul::gi()->getPriceObject());
		$bEnable = $this->oPrepare->get('EnableBuyNowPrice');
		if ($this->oPrepare->get('BuyingMode') === 'buy_it_now') {
            return $sRicardoPrice;
		} else {
			if ($bEnable === '0') {
				return null;
			}

			if (empty($sPrice) === false && (float)$sPrice > 0) {
				return $sPrice;
			} else {
				return $sRicardoPrice;
			}
		}
    }

    protected function getCategory() {
        return $this->oPrepare->get('PrimaryCategory');
    }

    protected function getQuantity() {
        $iQty = $this->oVariant->getSuggestedMarketplaceStock(
            MLModul::gi()->getConfig('quantity.type'),
            MLModul::gi()->getConfig('quantity.value')
        );
        return $iQty < 0 ? 0 : $iQty;
    }

    protected function getImageCount() {
		$aImagesPrepare = $this->oPrepare->get('Images');
        $iCount = 0;
		if (empty($aImagesPrepare) === false) {
            $aImages = $this->oVariant->getImages();
            
			foreach ($aImages as $sImage) {
				$sImageName = $this->substringAferLast('\\', $sImage);
				if (isset($sImageName) === false || strpos($sImageName, '/') !== false) {
					$sImageName = $this->substringAferLast('/', $sImage);
				}
				
				if (in_array($sImageName, $aImagesPrepare) === false) {
					continue;
				}

				try {
					$aImage = MLImage::gi()->resizeImage($sImage, 'products', 500, 500);
					$iCount++;
				} catch(Exception $ex) {
					// Happens if image doesn't exist.
				}
			}
		}

        return $iCount;
    }

    protected function getPromotions() {
		$sFirstPromotion = $this->oPrepare->get('FirstPromotion');
		$sSecondPromotion = $this->oPrepare->get('SecondPromotion');

		$aPromotions = array();

		if ($sFirstPromotion !== '-1') {
			$aPromotions[] = $sFirstPromotion;
		}

		if ($sSecondPromotion !== '-1') {
			$aPromotions[] = $sSecondPromotion;
		}

		return $aPromotions;
	}

	protected function getStartDate() {
		return $this->oPrepare->get('StartDate');
	}

	protected function getStartPrice() {
		$sBuyingMode = $this->oPrepare->get('BuyingMode');

		if ($sBuyingMode === 'auction') {
			return $this->oPrepare->get('PriceForAuction');
        } else {
            return 0;
        }
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
}
