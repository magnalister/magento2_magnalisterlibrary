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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

abstract class ML_Shop_Helper_Model_ShopOrder_Abstract {

    /**
     * @var array $aExistingOrderData
     */
    protected $aExistingOrderData = array();

    /**
     * @var array $aNewData
     */
    protected $aNewData = array();


    /**
     * need just for order update, to know if address needs to be updated
     * @var boolean
     */
    protected $blNewAddress = true;


    /**
     * set new order data
     */
    public function setNewOrderData($aData) {
        $this->aNewData = is_array($aData) ? $aData : array();
        return $this;
    }


    /**
     * get specific total of Order data by total Type
     * ex. $this->getTotal('Shipping') return
     * {
     * "Type":"Shipping",
     * "Code":"DE_DHLPaket",
     * "Value":4.5,
     * "Tax":false
     * }
     *
     * @param string $sName
     * @return array
     */
    public function getTotal($sName) {
        $aTotals = $this->aNewData['Totals'];
        foreach ($aTotals as $aTotal) {
            if ($aTotal['Type'] === $sName) {
                return $aTotal;
            }
        }
        return array();
    }

    protected function getCustomerGroup(){
        $sConfigCustomerGroup = MLModule::gi()->getConfig('CustomerGroup');
        if ($sConfigCustomerGroup === null) {
            $sConfigCustomerGroup = MLModule::gi()->getConfig('customergroup');
        }
        return $sConfigCustomerGroup;
    }


    /**
     * check if order should be updated or should we added or extended
     * @return boolean
     */
    protected function checkForUpdate() {
        if (count($this->aNewData['Products']) > 0) {
            return false;
        }

        if ($this->isNewAddress()) {
            return false;
        }

        foreach ($this->aNewData['Totals'] as $aNewTotal) {
            $blFound = false;
            foreach ($this->aExistingOrderData['Totals'] as $aCurrentTotal) {
                if ($aNewTotal['Type'] == $aCurrentTotal['Type']) {
                    $blFound = true;
                    if ((float)$aCurrentTotal['Value'] != (float)$aNewTotal['Value']
                        //|| // we don't need to compare the Tax , because it is false in ebay and most of the marketplaces
                        //(float) $aCurrentTotal['Tax'] != (float) $aNewTotal['Tax']
                    ) {
                        return false;
                    }
                }
            }
            if (!$blFound) {
                return false;
            }
        }
        return true;
    }

    /**
     * get random number as transaction id , we have this function individually because some customer need to change this behavior by overriding this function
     * @return string
     */
    protected function getTransactionId() {
        $aPayment = $this->getTotal('Payment');
        if (/*isset($aPayment['Code']) && $aPayment['Code'] == 'PayPal' && *///we cannot check for Code because it is already changed in normalize class
            isset($aPayment['ExternalTransactionID']) && !empty($aPayment['ExternalTransactionID'])) {
            return $aPayment['ExternalTransactionID'];
        } else {
            return '';
        }
    }

    /**
     * @param bool $return
     * @return bool
     */
    protected function isNewAddress() {
        foreach (array('Shipping', 'Billing') as $sAddressType) {//in shopware we use just shipping and billing address , we use just email of main address
            foreach (array('Gender', 'Firstname', 'Company', 'Street', 'Housenumber', 'Postcode', 'City', 'Suburb', 'CountryCode', 'Phone', 'EMail', 'DayOfBirth',) as $sField) {
                if (
                    (isset($this->aNewData['AddressSets'][$sAddressType][$sField]) && !isset($this->aExistingOrderData['AddressSets'][$sAddressType][$sField]))
                    || (isset($this->aNewData['AddressSets'][$sAddressType][$sField]) && $this->aNewData['AddressSets'][$sAddressType][$sField] !== $this->aExistingOrderData['AddressSets'][$sAddressType][$sField])
                ) {
                    return true;
                }
            }
        }
        return false;
    }

    protected function getFallbackTax() {
        $fDefaultProductTax = MLModule::gi()->getConfig('mwst.fallback');
        if ($fDefaultProductTax === null) {
            $fDefaultProductTax = MLModule::gi()->getConfig('mwstfallback'); // some modules have this, other that
        }
        return $fDefaultProductTax;
    }
}