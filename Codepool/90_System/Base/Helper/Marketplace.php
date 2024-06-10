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

class ML_Base_Helper_Marketplace {
    /**
     * @return array
     * @throws Exception
     */
    public function magnaGetInvolvedMarketplaces() {
        $_modules = MLSetting::gi()->get('aModules');
        $fm = array();

        // backwards compat for the js thingy.
        $aGet = MLRequest::gi()->data();
        if (isset($aGet['mps']) && !empty($aGet['mps'])) {
            $mps = explode(',', $aGet['mps']);
            foreach ($mps as $m) {
                if (array_key_exists($m, $_modules) && ($_modules[$m]['type'] === 'marketplace')) {
                    $fm[] = $m;
                }
            }
        }
        if (!empty($fm)) {
            return $fm;
        }
        foreach ($_modules as $m => $mp) {
            if ($mp['type'] === 'marketplace') {
                $fm[] = $m;
            }
        }
        return $fm;
    }

    /**
     * @param $marketplace
     * @return array|false return available marketplace id of given marketplace name of the current shop
     * or return marketplace id from url query "mpid"
     */
    public function magnaGetInvolvedMPIDs($marketplace) {
        $mpIDs = $this->magnaGetIDsByMarketplace($marketplace);
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


    /**
     * @param $mp
     * @return array|false return available marketplace id of given marketplace name
     */
    public function magnaGetIDsByMarketplace($mp) {
        global $magnaConfig;

        if (!is_array($magnaConfig) ||
            !array_key_exists('maranon', $magnaConfig) ||
            !is_array($magnaConfig['maranon']) ||
            !array_key_exists('Marketplaces', $magnaConfig['maranon']) ||
            empty($magnaConfig['maranon']['Marketplaces'])
        ) {
            return false;
        }
        $ids = array();
        foreach ($magnaConfig['maranon']['Marketplaces'] as $mpID => $marketplace) {
            if ($marketplace == $mp) {
                $ids[] = $mpID;
            }
        }
        sort($ids, SORT_NUMERIC);
        return $ids;
    }
}
