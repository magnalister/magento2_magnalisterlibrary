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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Modul_Model_ConfigForm_Modul_Abstract');

class ML_Hood_Model_ConfigForm_Modul extends ML_Modul_Model_ConfigForm_Modul_Abstract {

    public function UpdateCurrencyValuesAjax($args) {
        global $magnaConfig;
        $ret = '';
        if (array_key_exists($args['value'], $magnaConfig['hood']['currencies']) &&
            !empty($magnaConfig['hood']['currencies'][$args['value']])
        ) {
            foreach ($magnaConfig['hood']['currencies'][$args['value']] as $key => $val) {
                $ret .= '<option value="'.$val.'">'.$val.'</option>';
            }
        } else {
            $ret = 'FAILURE';
        }
        return $ret;
    }

    public function getCurrencyValues() {

        if (MLHttp::gi()->isAjax()) {
            $aFields = MLRequest::gi()->data('field');
            $sSite = $aFields['site'];
        } elseif (MLModul::gi()->getConfig('site') != null) {
            $sSite = MLModul::gi()->getConfig('site');
        } else {
            $sSite = '';
        }
        if (empty($sSite)) {
            return array('' => MLI18n::gi()->hood_configform_account_sitenotselected);
        }
        $aCurrencies = MLI18n::gi()->config_hood_currencies;
        if (array_key_exists($sSite, $aCurrencies) &&
            !empty($aCurrencies[$sSite])
        ) {
            $aSelectOption = array();
            foreach ($aCurrencies[$sSite] as $sCurrency) {
                $aSelectOption[$sCurrency] = $sCurrency;
            }
            return $aSelectOption;
        } else {
            return array();
        }
    }

    public function hoodShippingConfig($args, &$value = '') {
        global $_MagnaSession;
        $shipProc = new hoodShippingDetailsProcessor($args, 'conf', array(
            'mp' => $_MagnaSession['mpID'],
            'mode' => 'conf'
        ), $value);
        return $shipProc->process();
    }

    public function getListingFixedDurations() {
        $sRequest = 'FixedPriceItem';

        if (MLModul::gi()->hasStore()) {
            $sRequest = 'StoresFixedPrice';
        }

        return MLModul::gi()->getListingDurations($sRequest);
    }


    public function getListingChineseDurations() {
        return MLModul::gi()->getListingDurations('Chinese');
    }

    public function getCarrier() {
        $aData = MLModul::gi()->getCarrier();
        return array_merge(array('--' => MLI18n::gi()->ML_OPTION_EMPTY), $aData);//in hood carrier is optional (checked Hood API 2.0.1)
    }
}
