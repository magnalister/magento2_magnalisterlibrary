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
MLFilesystem::gi()->loadClass('Modul_Model_ConfigForm_Modul_Abstract');

class ML_Hitmeister_Model_ConfigForm_Modul extends ML_Modul_Model_ConfigForm_Modul_Abstract {

    public function getCurrencyValue($aAllCurrencies) {

        if (MLHttp::gi()->isAjax()) {
            $aFields = MLRequest::gi()->data('field');
            $sSite = $aFields['site'];
        } elseif (MLModule::gi()->getConfig('site') != null) {
            $sSite = MLModule::gi()->getConfig('site');
        }else{
            $sSite = 'de';
        }
        if(empty($sSite) ){
            return '';
        }
        $aCurrencies = $aAllCurrencies;
        if (array_key_exists($sSite, $aCurrencies) &&
            !empty($aCurrencies[$sSite])
        ) {
            $aSelectOption = array ($aCurrencies[$sSite] => $aCurrencies[$sSite]);
            return $aCurrencies[$sSite];
        } else {
            return '';
        }
    }
}
