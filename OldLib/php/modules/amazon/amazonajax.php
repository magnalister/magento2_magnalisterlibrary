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
 * (c) 2010 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the GNU General Public License v2 or later
 * -----------------------------------------------------------------------------
 */

if (!defined('_ML_INSTALLED'))
    throw new Exception('Direct Access to this location is not allowed.');
$aPost=  MLRequest::gi()->data();
if (isset($aPost['request'])) {
	$r = $aPost['request'];

	if ($r == 'ItemSearch') {
		include_once(DIR_MAGNALISTER_MODULES.'amazon/matching/matchingViews.php');
		if (isset($aPost['search']) && !empty($aPost['search']) &&
		    isset($aPost['productID']) && !empty($aPost['productID'])) {
			$search = $aPost['search'];
			$productID = $aPost['productID'];

			try {
				$result = MagnaConnector::gi()->submitRequest(array(
					'ACTION' => 'ItemSearch',
					'NAME'   => $search
				));
			} catch (MagnaException $e) {
				$result = array('DATA' => array());
			}
			if (!empty($result['DATA'])) {
			    foreach ($result['DATA'] as &$data) {
			    	if (!empty($data['Author'])) {
			    		$data['Title'] .= ' ('.$data['Author'].')';
			    	}
                    if (!empty($data['LowestPrice']['Price']) && !empty($data['LowestPrice']['CurrencyCode'])) {
                        $price = MLPrice::factory()->format($data['LowestPrice']['Price'], $data['LowestPrice']['CurrencyCode']);
                        $data['LowestPrice'] = $data['LowestPrice']['Price'];
                        $data['LowestPriceFormated'] = $price->format();
                    } else {
                        $data['LowestPrice'] = '-';
                        $data['LowestPriceFormated'] = '&mdash;';
                    }
			    }
			}

			$dbProd = MLDatabase::getDbInstance()->getProductById($productID);
			header('Content-Type: text/html; charset=ISO-8859-1');
			renderMathingResultTr($productID, $search, '', $result['DATA']);
		}
	}

	if ($r == 'ItemLookup') {
		include_once(DIR_MAGNALISTER_MODULES.'amazon/matching/matchingViews.php');
		if (isset($aPost['asin']) && !empty($aPost['asin']) &&
		    isset($aPost['productID']) && !empty($aPost['productID'])) {
			$asin = $aPost['asin'];
			$productID = $aPost['productID'];

			try {
				$result = MagnaConnector::gi()->submitRequest(array(
					'ACTION' => 'ItemLookup',
					'ASIN' => $asin
				));
			} catch (MagnaException $e) {
				$result = array('DATA' => array());
			}
			$dbProd = MLDatabase::getDbInstance()->getProductById($productID);

			if (!empty($result['DATA'])) {
			    foreach ($result['DATA'] as &$data) {
			    	if (array_key_exists('Author', $data) && !empty($data['Author'])) {
			    		$data['Title'] .= ' ('.$data['Author'].')';
			    	}
                    if (!empty($data['LowestPrice']['Price']) && !empty($data['LowestPrice']['CurrencyCode'])) {
                        $price = MLPrice::factory()->format($data['LowestPrice']['Price'], $data['LowestPrice']['CurrencyCode']);
                        $data['LowestPrice'] = $data['LowestPrice']['Price'];
                        $data['LowestPriceFormated'] = $price->format();
                    } else {
                        $data['LowestPrice'] = '-';
                        $data['LowestPriceFormated'] = '&mdash;';
                    }
			    }
			}
			header('Content-Type: text/html; charset=ISO-8859-1');
			renderMathingResultTr($productID, $dbProd['products_name'], '', $result['DATA']);
		}
	}
}
