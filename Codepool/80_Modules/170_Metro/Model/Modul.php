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

class ML_Metro_Model_Modul extends ML_Modul_Model_Modul_Abstract {

    /**
     *
     * @var array $aPrice list of ML_Shop_Model_Price_Interface
     */
    protected $aPrice = array(
        'price' => null,
        '2'     => null,
        '3'     => null,
        '4'     => null,
        '5'     => null,
        'a'     => null,
        'b'     => null,
    );

    /**
     * better cache it, for exceptions in metro-api
     * @var string side id
     */
    protected $sMetroSiteId = null;

    public function getConfig($sName = null) {
        if ($sName === 'currency') {
            $mReturn = 'EUR';
        } else {
            $mReturn = parent::getConfig($sName);
        }

        if ($sName === null) {// merge
            $mReturn = MLHelper::getArrayInstance()->mergeDistinct($mReturn, array('lang' => $this->getConfig('lang'), 'currency' => 'EUR'));
        }

        return $mReturn;
    }

    public function getMarketPlaceName($blIntern = true) {
        return $blIntern ? 'metro' : MLI18n::gi()->get('sModuleNameMetro');
    }

    public function hasStore() {
        try {
            $aStore = MagnaConnector::gi()->submitRequestCached(array('ACTION' => 'HasStore'), 30 * 60);
            //$blHasStore = $aStore['DATA']['Answer'] == 'True';
            return $aStore['DATA'];
        } catch (Exception $oEx) { //no store
            return false;
        }
    }

    public function getDaysValue() {
        $oI18n = MLI18n::gi();
        return array(
            '0' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_X'),
            '1' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_0'),
            '2' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_1'),
            '4' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_2'),
            '5' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_3'),
            '6' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_4'),
            '7' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_5'),
            '8' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_6'),
            '9' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_7'),
            '10' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_8'),
            '11' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_9'),
            '12' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_10'),
            '13' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_13'),
            '14' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_14'),
            '15' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_15'),
            '16' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_16'),
            '17' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_17'),
            '18' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_18'),
            '19' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_19'),
            '20' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_20'),
            '21' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_21'),
            '22' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_22'),
            '23' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_23'),
            '24' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_24'),
            '25' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_25'),
            '26' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_26'),
            '27' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_27'),
            '28' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_28'),
            '29' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_29'),
            '30' => $oI18n->get('ML_METRO_LABEL_LISTINGDURATION_DAYS_30'),
        );
    }

    public function getStockConfig($sType = null) {
        return array(
            'type'  => $this->getConfig('quantity.type'),
            'value' => $this->getConfig('quantity.value'),
            'max'   => $this->getConfig('quantity.maxquantity')
        );
    }

    /**
     * @return array('configKeyName'=>array('api'=>'apiKeyName', 'value'=>'currentSantizedValue'))
     */
    protected function getConfigApiKeysTranslation() {
        $sDate = $this->getConfig('preimport.start');
        //magento tip to find empty date
        $sDate = (preg_replace('#[ 0:-]#', '', $sDate) === '') ? date('Y-m-d') : $sDate;
        $sDate = date('Y-m-d', strtotime($sDate));

        return array_merge(
            array(
                'import'          => array('api' => 'Orders.Import', 'value' => ($this->getConfig('import') ? 'true' : 'false')),
                'preimport.start' => array('api' => 'Orders.Import.Start', 'value' => $sDate),
                'shippingorigin' => array(
                    'api' => 'Access.Shipping.Origin',
                    'value' => ($this->getConfig('shippingorigin'))
                ),
                'shippingdestination' => array(
                    'api' => 'Access.Shipping.Destination',
                    'value' => ($this->getConfig('shippingdestination'))
                ),
            ), $this->getInvoiceAPIConfigParameter()
        );
    }

    public function isConfigured() {
        $bReturn = parent::isConfigured();
        $sCurrency = $this->getConfig('currency');
        $aFields = MLRequest::gi()->data('field');
        if (!MLHttp::gi()->isAjax() && $aFields !== null && isset($aFields['currency'])) { // saving new site in configuration
            $sCurrency = $aFields['currency'];
        }
        if (!empty($sCurrency) && !array_key_exists($sCurrency, MLCurrency::gi()->getList())) {
            MLMessage::gi()->addWarn(sprintf(MLI18n::gi()->ML_GENERIC_ERROR_CURRENCY_NOT_IN_SHOP, $sCurrency));
            return false;
        }

        return $bReturn;
    }

    public function getMetroCancellationReasons() {
        try {
            $result = MagnaConnector::gi()->submitRequestCached(array(
                'ACTION' => 'GetCancellationReasons',
            ));

            if (isset($result['DATA'])) {
                return $result['DATA'];
            }
        } catch (MagnaException $e) {
        }
        return array('noselection' => MLI18n::gi()->ML_ERROR_API);
    }

    /**
     * @return ML_Shop_Model_Price_Interface
     * @var string $sType defines price type, if marketplace supports multiple prices
     */
    public function getPriceObject($sType = 'price') {
        $sType = empty($sType) ? 'price' : $sType;
        if (!isset($this->aPrice[$sType]) || $this->aPrice[$sType] === null) {
            $this->aPrice[$sType] = MLPrice::factory();
            if ($sType === 'price') {
                $sKind = $this->getConfig('price.addkind');
                $fFactor = (float)$this->getConfig('price.factor');
                $iSignal = $this->getConfig('price.signal');
                $iSignal = ($iSignal === '' || $iSignal === null) ? null : $iSignal;
                $sGroup = $this->getConfig('price.group');
                $blSpecial = (boolean)$this->getConfig($this->aPrice[$sType]->getSpecialPriceConfigKey());
                $this->aPrice[$sType]->setPriceConfig($sKind, $fFactor, $iSignal, $sGroup, $blSpecial);
            } elseif ($sType === 'webshoppriceoptions') {
                $sKind = $this->getConfig('volumeprices'.$sType.'addkind');
                $fFactor = (float)$this->getConfig('volumeprices'.$sType.'factor');
                $iSignal = $this->getConfig('volumeprices'.$sType.'signal');
                $iSignal = ($iSignal === '' || $iSignal === null) ? null : $iSignal;
                $sGroup = $this->getConfig('price.group');

                // without activating special price in Prestashop group price won't be included
                $blSpecial = MLShop::gi()->getShopSystemName() === 'prestashop' ? true : false;
                $this->aPrice[$sType]->setPriceConfig($sKind, $fFactor, $iSignal, $sGroup, $blSpecial);
            } else { //volume price calculation
                $sKind = $this->getConfig('volumepriceprice'.$sType.'addkind');
                if ($sKind !== 'dontuse') {
                    $fFactor = (float)$this->getConfig('volumepriceprice'.$sType.'factor');
                    $iSignal = $this->getConfig('volumepriceprice'.$sType.'signal');
                    $iSignal = ($iSignal === '' || $iSignal === null) ? null : $iSignal;
                    if ($sKind === 'customergroup') {
                        $sGroup = $this->getConfig('volumepriceprice'.$sType.'customergroup');
                        $iSignal = null; // no price signal using customer group
                    } else {
                        $sGroup = $this->getConfig('price.group');
                    }
                    $blSpecial = MLShop::gi()->getShopSystemName() === 'prestashop' ? true : false;//Without activating special price in PrestaShop group price won't be included
                    $this->aPrice[$sType]->setPriceConfig($sKind, $fFactor, $iSignal, $sGroup, $blSpecial);
                }
            }
        }
        return $this->aPrice[$sType];
    }

    /**
     * if attribute name in GetCategoryDetail contains some specific character, those are not allowed in jquery selector,
     * it is better to encode them by preparation and attribute matching to hex, and by add-item we can decode them to real name
     * @return bool
     */
    public function isNeededPackingAttrinuteName() {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getPriceConfigurationUrlPostfix() {
        return '_priceandstock';
    }

    public function getCountry() {
        return substr($this->getConfig('shippingorigin'), 0, -5);
    }
}
