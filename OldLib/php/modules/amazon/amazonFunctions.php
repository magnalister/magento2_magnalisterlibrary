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

if (!defined('_ML_INSTALLED'))
    throw new Exception('Direct Access to this location is not allowed.');

require_once(DIR_MAGNALISTER_MODULES.'generic/genericFunctions.php');

function magnaAmazonSKU2pID($sku, $asin = '') {
	$iPID = magnaSKU2pID($sku);
	if (($iPID <= 0) && !empty($asin)) {
        /* @var $oProperty ML_Database_Model_Table_Abstract*/
        $iPID = MLDatabase::factory('amazon_prepare')->getByIdentifier($asin,"asin");

	}
	return $iPID;
}


function amazonGetPossibleOptions($kind, $mpID = false) {
	if ($mpID === false) {
		global $_MagnaSession;
		$mpID = $_MagnaSession['mpID'];
	}
	
	initArrayIfNecessary($_MagnaSession, array($mpID, $kind));
	
	if (empty($_MagnaSession[$mpID][$kind])) {
		try {
			$result = MagnaConnector::gi()->submitRequest(array(
				'ACTION' => 'Get'.$kind,
				'SUBSYSTEM' => 'Amazon',
				'MARKETPLACEID' => $mpID,
			));
			$_MagnaSession[$mpID][$kind] = $result['DATA'];
		} catch (MagnaException $e) { }
	}
	return $_MagnaSession[$mpID][$kind];
}

function amazonGetMarketplaces() {
	global $_MagnaSession;
	
	initArrayIfNecessary($_MagnaSession, array($_MagnaSession['mpID'], 'Marketplaces', 'Sites'));
	initArrayIfNecessary($_MagnaSession, array($_MagnaSession['mpID'], 'Marketplaces', 'Currencies'));

	if (empty($_MagnaSession[$_MagnaSession['mpID']]['Marketplaces']['Sites']) || 
		empty($_MagnaSession[$_MagnaSession['mpID']]['Marketplaces']['Currencies'])
	) {
		try {
			$_MagnaSession[$_MagnaSession['mpID']]['Marketplaces'] = array();
			
			$result = MagnaConnector::gi()->submitRequest(array(
				'ACTION' => 'GetMarketplaces',
				'SUBSYSTEM' => 'Amazon',
			));
			foreach ($result['DATA'] as $item) {
				$_MagnaSession[$_MagnaSession['mpID']]['Marketplaces']['Sites'][$item['Key']] = fixHTMLUTF8Entities($item['Label']);
				$_MagnaSession[$_MagnaSession['mpID']]['Marketplaces']['Currencies'][$item['Key']] = $item['Currency'];
			}
		} catch (MagnaException $e) { }
	}

	return $_MagnaSession[$_MagnaSession['mpID']]['Marketplaces'];
}

function amazonGetLeadtimeToShip($mpID, $pID) {
    $iTime = MLDatabase::factory('amazon_prepare')->set('mpid', $mpID)->set('productsid', $pID)->get('shippingtime');
    if ($iTime == '-') {
        $iTime = ''; // empty string means use default setting of in amazon seller central of client
    }
    if ($iTime == 'config' || $iTime == null) {
        $iTime = MLModule::gi()->getConfig('leadtimetoship');
    }

    return $iTime;
}

function updateAmazonInventoryByEdit($mpID, $updateData) {
	$updateItem = genericInventoryUpdateByEdit($mpID, $updateData);
	if (!is_array($updateItem)) {
		return;
	}
	$timeToShip = getDBConfigValue('amazon.leadtimetoship', $mpID, '');
	if (!empty($timeToShip)) {
		$updateItem['LeadtimeToShip'] = (int)$timeToShip;
	}
	#echo print_m($updateItem, '$updateItem');
	magnaUpdateItems($mpID, array($updateItem), true);
}

function updateAmazonInventoryByOrder($mpID, $boughtItems, $subRelQuant = true) {
	if (getDBConfigValue('amazon.stocksync.tomarketplace', $mpID, 'no') == 'no') {
		return;
	}
	$data = genericInventoryUpdateByOrder($mpID, $boughtItems, $subRelQuant);
	$timeToShip = getDBConfigValue('amazon.leadtimetoship', $mpID, '');
	if (!empty($timeToShip)) {
		foreach ($data as &$item) {
			$item['LeadtimeToShip'] = (int)$timeToShip;
		}
	}
	#echo print_m($data, '$data');
	magnaUpdateItems($mpID, $data, true);
}

function loadCarrierCodes($mpID = false) {
    $aPost= MLRequest::gi()->data();
	if ($mpID === false) {
		global $_MagnaSession;
		$mpID = $_MagnaSession['mpID'];
	}
	$carrier = amazonGetPossibleOptions('CarrierCodes', $mpID);

	# Amazon Config Form
	if (array_key_exists('conf', $aPost) && array_key_exists('amazon.orderstatus.carrier.additional', $aPost['conf'])) {
		setDBConfigValue(
			'amazon.orderstatus.carrier.additional',
			$mpID,
			$aPost['conf']['amazon.orderstatus.carrier.additional']
		);
	}

	$addCarrier = explode(',', getDBConfigValue('amazon.orderstatus.carrier.additional', $mpID, ''));
	if (!empty($addCarrier)) {
		foreach ($addCarrier as $val) {
			$val = trim($val);
			if (empty($val)) continue;
			$carrier[$val] = $val;
		}
	}
	$carrierValues = array('null' => MLI18n::gi()->ML_LABEL_CARRIER_NONE);
	if (!empty($carrier)) {
		foreach ($carrier as $val) {
			if ($val == 'Other') continue;
			$carrierValues[$val] = $val;
		}
	}
	return $carrierValues;
}
