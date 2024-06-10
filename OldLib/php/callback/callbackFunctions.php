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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

if (!defined('_ML_INSTALLED'))
    throw new Exception('Direct Access to this location is not allowed.');


/**
 * @deprecated use ML_Modul_Helper_Marketplace instead
 * e.g. MLHelper::gi('Marketplace')->magnaGetInvolvedMarketplaces()
 * @return array
 * @throws Exception
 */
function magnaGetInvolvedMarketplaces() {
	$_modules = MLSetting::gi()->get('aModules');
	$fm = array();

	// backwards compat for the js thingy.
    $aGet = MLRequest::gi()->data();
	if (isset($aGet['mps']) && !empty($aGet['mps'])) {
		$mps = explode(',', $aGet['mps']);
		foreach ($mps as $m) {
			if (array_key_exists($m, $_modules) && ($_modules[$m]['type'] == 'marketplace')) {
				$fm[] = $m;
			}
		}
	}
	if (!empty($fm)) {
		return $fm;
	}
	foreach ($_modules as $m => $mp) {
		if ($mp['type'] == 'marketplace') {
			$fm[] = $m;
		}
	}
	return $fm;
}

/**
 * @deprecated use ML_Modul_Helper_Marketplace instead
 * e.g. MLHelper::gi('Marketplace')->magnaGetInvolvedMPIDs()
 * @param $marketplace
 * @return array|false
 */
function magnaGetInvolvedMPIDs($marketplace) {
	$mpIDs = magnaGetIDsByMarketplace($marketplace);
	if (empty($mpIDs)) {
		return array();
	}
    $aGet = MLRequest::gi()->data();
	if (isset($aGet['mpid'])) {
		if (in_array($aGet['mpid'], $mpIDs)) {
			return array($aGet['mpid']);
		} else {
			return array();
		}
	}
	return $mpIDs;
}
