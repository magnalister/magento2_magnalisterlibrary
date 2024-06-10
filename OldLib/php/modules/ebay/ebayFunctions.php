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

function geteBayShippingDetails() {
	global $_MagnaSession;

	$mpID = $_MagnaSession['mpID'];
    $site = MLModule::gi()->getConfig('site');
	
	initArrayIfNecessary($_MagnaSession, array($mpID, $site, 'eBayShippingDetails'));
	
	if (!empty($_MagnaSession[$mpID][$site]['eBayShippingDetails'])) {
		return $_MagnaSession[$mpID][$site]['eBayShippingDetails'];
	}
	try {
		$shippingDetails = MagnaConnector::gi()->submitRequest(array(
			'ACTION' => 'GetShippingServiceDetails',
			'DATA' => array('Site' => $site),
		));
		$shippingDetails = $shippingDetails['DATA'];
	} catch (MagnaException $e) {
		return false;
	}
	unset($shippingDetails['Version']);
	unset($shippingDetails['Timestamp']);
	unset($shippingDetails['Site']);
	foreach ($shippingDetails['ShippingServices'] as &$service) {
		$service['Description'] = fixHTMLUTF8Entities($service['Description']);
	}
	foreach ($shippingDetails['ShippingLocations'] as &$location) {
		$location = fixHTMLUTF8Entities($location);
	}
	$_MagnaSession[$mpID][$site]['eBayShippingDetails'] = $shippingDetails;
	return $_MagnaSession[$mpID][$site]['eBayShippingDetails'];
}


function geteBayLocalShippingServicesList() {
	$shippingDetails = geteBayShippingDetails();
	$servicesList = array();
	foreach($shippingDetails['ShippingServices'] as $service=>$serviceData) {
		if ('1' == $serviceData['InternationalService']) continue;
	#	$servicesList["$service"] = utf8_decode($serviceData['Description']);
		$servicesList["$service"] = $serviceData['Description'];
	}
	return $servicesList;
}

function geteBayInternationalShippingServicesList() {
	$shippingDetails = geteBayShippingDetails();
	$servicesList = array('' => ML_EBAY_LABEL_NO_INTL_SHIPPING);
	foreach($shippingDetails['ShippingServices'] as $service=>$serviceData) {
		if ('0' == $serviceData['InternationalService']) continue;
	#	$servicesList["$service"] = utf8_decode($serviceData['Description']);
		$servicesList["$service"] = $serviceData['Description'];
	}
	return $servicesList;
}

function geteBayShippingLocationsList() {
	$shippingDetails = geteBayShippingDetails();
	return $shippingDetails['ShippingLocations'];
}

function VariationsEnabled($cID) {
    return MLDatabase::factory('ebay_categories')
        ->set('categoryid',$cID)
        ->variationsEnabled()
    ;
}

function geteBayCategoryPath($CategoryID, $StoreCategory = false) {
    $aCachedPaths = MLModule::gi()->getConfig('toptenCategoryPaths');
    if (is_array($aCachedPaths)) {
        foreach ($aCachedPaths as $aCachedPath) {
            if ($aCachedPath['categoryid'] == $CategoryID
                && $aCachedPath['storecategory'] == (int)$StoreCategory
                && $aCachedPath['siteid'] == MLModule::gi()->getConfig('site')) {
                return $aCachedPath['path'];
            }
        }
    }
    $path = MLDatabase::factory('ebay_categories')
        ->set('categoryid', $CategoryID)
        ->set('storecategory', (int)$StoreCategory)
        ->getCategoryPath();
    $aCachedPaths[] = array(
        'categoryid'    => $CategoryID,
        'storecategory' => (int)$StoreCategory,
        'siteid' => MLModule::gi()->getConfig('site'),
        'path' => $path
    );
    MLModule::gi()->setConfig('toptenCategoryPaths', $aCachedPaths, true);
    return $path;
}

# Die Funktion wird verwendet beim Aufruf der Kategorie-Zuordnung, nicht vorher.
# Beim Aufruf werden die Hauptkategorien gezogen,
# und beim Anklicken der einzelnen Kategorie die Kind-Kategorien, falls noch nicht vorhanden.
function importeBayCategoryPath($CategoryID) {
    MLDatabase::factory('ebay_categories')
        ->set('storecategory', 0)
        ->set('categoryid', $CategoryID)
        ->save()
    ;
    return true;
}

function eBayInsertPrepareData($data) {
	foreach (array('ItemSpecifics', 'Attributes') as $sAttributeOrSpecific) {
		if (array_key_exists($sAttributeOrSpecific, $data)) {
			$aAttribute = json_decode($data[$sAttributeOrSpecific], true);
			if (!empty($aAttribute) && is_array($aAttribute)) {
				$aMyAttribute = array();
				foreach ($aAttribute as $sKey => $aValue) {
					foreach ($aValue as $sAttributeKey => $aAttributeValue) {
						$aMyAttribute[$sKey][pack('H*', $sAttributeKey)] = $aAttributeValue;
					}
				}
				$data[$sAttributeOrSpecific] = json_encode($aMyAttribute);
			}
		}
	}
	$data['topPrimaryCategory']	  = $data['PrimaryCategory']      == NULL ? '': $data['PrimaryCategory'];
	$data['topSecondaryCategory'] = $data['topSecondaryCategory'] == NULL ? '': $data['SecondaryCategory'];
	$data['topStoreCategory1']    = $data['topStoreCategory1']    == NULL ? '': $data['StoreCategory'];
	$data['topStoreCategory2']    = $data['topStoreCategory2']    == NULL ? '': $data['StoreCategory2'];
	/* {Hook} "eBayInsertPrepareData": Enables you to modify the prepared product data before it will be saved.<br>
	   Variables that can be used:
	   <ul>
		<li><code>$data</code>: The data of a product.</li>
		<li><code>$data['mpID']</code>: The ID of the marketplace.</li>
	   </ul>
	 */
	if (($hp = magnaContribVerify('eBayInsertPrepareData', 1)) !== false) {
		require($hp);
	}
	MagnaDB::gi()->insert(TABLE_MAGNA_EBAY_PROPERTIES, $data, true);
}

function eBaySubstituteTemplate($mpID, $pID, $template, $substitution) {
	/* {Hook} "eBaySubstituteTemplate": Enables you to extend the eBay Template substitution (e.g. use your own placeholders).<br>
	   Variables that can be used:
	   <ul><li><code>$mpID</code>: The ID of the marketplace.</li>
	       <li><code>$pID</code>: The ID of the product (Table <code>products.products_id</code>).</li>
	       <li><code>$template</code>: The eBay product template.</li>
	       <li><code>$substitution</code>: Associative array. Keys are placeholders, Values are their content.</li>
	   </ul>
	 */
	if (($hp = magnaContribVerify('eBaySubstituteTemplate', 1)) !== false) {
		require($hp);
	}

	return substituteTemplate($template, $substitution);
}

