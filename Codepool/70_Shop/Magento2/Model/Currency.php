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

class ML_Magento2_Model_Currency extends ML_Shop_Model_Currency_Abstract {

    static protected $aListOfCurrencies = null;

    /**
     * @see \Magento\Framework\Locale\Test\Unit\FormatTest::getPriceFormatDataProvider
     * @return array|void
     */
    public function getList() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeObj = $objectManager->create('Magento\Store\Model\StoreManagerInterface')->getStore();
        //Kint::dump($storeObj->getBaseCurrency()->getRate('EUR'));


       /* $allCurrencies = $objectManager->create('Magento\Framework\Locale\Bundle\CurrencyBundle')->get(
            $objectManager->create('Magento\Framework\Locale\ResolverInterface')->getLocale()
        )['Currencies'];*/
//echo Kint::dump($allCurrencies);
         //print_r($allCurrencies);
        //$test=array();
       /* foreach ($allCurrencies as $Currency) {

            echo $objectManager->create('Magento\Framework\Locale\CurrencyInterface')->getCurrency($Currency[0])->getSymbol();
        }*/


       /* if (is_array($allCurrencies) && count($allCurrencies) >= 1) {
            foreach ($allCurrencies as $Currency) {

                $allCurrencies = $objectManager->create('Magento\Framework\Locale\Bundle\CurrencyBundle')->get(
                    $objectManager->create('Magento\Framework\Locale\ResolverInterface')->getLocale()
                )['Currencies'];
                $currencies[$code]['title'] = $allCurrencies[$code][1] ?: $code;
                $currencies[$code]['symbol'] = $objectManager->create('Magento\Framework\Locale\CurrencyInterface')->getCurrency($code)->getSymbol();

            }
        }*/

        if (self::$aListOfCurrencies === null) {
            $aCurrencyList = $storeObj->getAvailableCurrencyCodes(true);
            foreach ($aCurrencyList as $aCurrency) {
                self::$aListOfCurrencies[$aCurrency] = array(
                    'title' => $aCurrency,
                    'symbol_left' => '',
                    'symbol_right' => $objectManager->create('Magento\Framework\Locale\CurrencyInterface')->getCurrency($aCurrency)->getSymbol(),
                    'decimal_point' => '.',
                    'thousands_point' => '',
                    'decimal_places' => 2,
                    'value' => $storeObj->getBaseCurrency()->getRate($aCurrency),
                );
            }
        }
        return self::$aListOfCurrencies;
    }

    public function getDefaultIso() {
        $storeID = MLModule::gi()->getConfig('lang');
        $storeManager = MLMagento2Alias::ObjectManagerProvider('Magento\Store\Model\StoreManagerInterface');
        $oCurrency = $storeManager->getStore($storeID)->getDefaultCurrency();
         if($oCurrency == null) {
             return 'EUR';
         }   else{
              return $oCurrency->getCode();
         }

    }

    public function updateCurrencyRate($sCurrency) {
        $updatedTime = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.exchange.rate.time')->get('value');
        $now = date('Y-m-d H:i:s');
        if (!isset($updatedTime) || strtotime($now) - strtotime($updatedTime) >= 3600) {
            $oObserver = MLMagento2Alias::ObjectManagerProvider('Magento\Directory\Model\Observer');
            $oObserver->scheduledUpdateCurrencyRates('');
            MLCache::gi()->delete(strtoupper(get_class($this)).'__currencylist.json');
        }
        MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.exchange.rate.time')->set('value', $now)->save();
        return $this;
    }

    public function getShopCurrency($iShopId = null) {
        $storeManager = MLMagento2Alias::ObjectManagerProvider('Magento\Store\Model\StoreManagerInterface');
        if ($iShopId !== null) {
            $oCurrency = $storeManager->getStore($iShopId)->getCurrentCurrency();
        } else {
            $oCurrency = $storeManager->getStore()->getCurrentCurrency();
        }

        return $oCurrency->getCode();
    }

}
