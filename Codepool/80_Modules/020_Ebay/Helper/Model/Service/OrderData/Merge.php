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

MLFilesystem::gi()->loadClass('Modul_Helper_Model_Service_OrderData_Merge');

class ML_Ebay_Helper_Model_Service_OrderData_Merge extends ML_Modul_Helper_Model_Service_OrderData_Merge {

    protected $aEbayDebug = array();

    public function mergeServiceOrderData($aNewOrder, $aExistingOrder, $oMlOrder) {
        if( MLModule::gi()->getConfig('importonlypaid') != '1') {
            return parent::mergeServiceOrderData($aNewOrder, $aExistingOrder, $oMlOrder);
        } else {
            //If user configure to import only paid order, there can be a problem occurs
            // that the different positions of orders are not processed together
            // Only the first one could be imported
            // to fix this problem we should merge new orders data with imported order
            return $aNewOrder;
        }
    }

    protected function mergeTotalShipping ($aOldTotal, $aNewTotal) {
        if (isset($aOldTotal['orgValue']) && is_array($aOldTotal['orgValue'])) {
            //copy origin value from older orders
            $aNewTotal['orgValue'] = $aOldTotal['orgValue'];
        }
        // preserve the original value for each order for comparison when merging orders
        $aNewTotal['orgValue'][$this->aCurrentOrder['MPSpecific']['MOrderID']] = $aNewTotal['Value'];

        $aProduct = array();
        if (empty($this->aCurrentOrder['Products']) && !empty($this->aExistingOrder['Products'])) { //update
            foreach ($this->aExistingOrder['Products'] as $aExistingProduct) {
                if (isset($aExistingProduct['MOrderID']) && $aExistingProduct['MOrderID'] == $this->aCurrentOrder['MPSpecific']['MOrderID']) {
                    $aProduct = $aExistingProduct;// max 1 article per ebay order
                    break;
                }
            }
        } else {
            $aProduct = current($this->aCurrentOrder['Products']);
        }
        if (empty($aProduct)) { //update
            $aCosts = $this->ebayGetPreviousShippingCost();
        } else {
            $aCosts = array_merge(
                $this->ebayGetPreviousShippingCost(),
                $this->ebayGetCurrentShippingCost(
                    $aNewTotal['Value'],
                    $aProduct, // max 1 article per ebay order
                    $this->aCurrentOrder['MPSpecific']['MOrderID']
                )
            );
        }
        $aMaxCost = array('cost' => (float)0, 'add' => null, 'qty' => (int)0, 'total' => (float)0, 'promotional' => false);
        $fSumCost = $aMaxCost['cost'];
        $iProductQty = $aMaxCost['qty'];
        $fOrderCost = $aMaxCost['total'];
        foreach ($aCosts as &$aCost) {
            /** @deprecated '&' needed for $this->ebayManipulateDeprecatedCost() */
            $this->ebayManipulateDeprecatedCost($aCost);
            if (($aMaxCost['cost'] < $aCost['cost'])
                // case: Same shipping costs, but one has a shipping profile
                || ($aMaxCost['cost'] == $aCost['cost']
                    && $aMaxCost['add'] === null
                    && $aCost['add'] !== null)) {
                $aMaxCost = $aCost;
            }

            $fSumCost += $aCost['cost'] * $aCost['qty'];
            $iProductQty += $aCost['qty'];
            $fOrderCost += $aCost['total'];
        }
        $this->ebayDebug(array('aCosts' => $aCosts));
        $this->oMlOrder->set('internaldata', $aCosts);
        $this->ebayDebug(array('fOrderCost' => $fOrderCost));
        $this->ebayDebug(array('aMaxCost' => $aMaxCost));
        if ($aMaxCost['add'] === null) {
            $this->ebayDebug(array('fSumCost' => $fSumCost));
            $fCost = $fSumCost;
        } else {
            $this->ebayDebug(array('iProductQty' => $iProductQty));
            $fCost = max($aMaxCost['cost'], $aMaxCost['cost'] + (($iProductQty - 1) * $aMaxCost['add']));
        }
        $this->ebayDebug(array('fCost' => $fCost));
        if ($aMaxCost['promotional']) {
            $fCost = $this->ebayCalcPromotionalDiscount($fCost, $fOrderCost, $iProductQty);
            $this->ebayDebug(array('fCostPromotional' => $fCost));
        }
        $aNewTotal['Value'] = $fCost;
        $this->ebayDebug();
        return $aNewTotal;
    }

    /**
     * @deprecated we use now all promotionals versions
     */
    protected function ebayManipulateDeprecatedCost(&$aCost) {
        $aCost['promotional'] = isset($aCost['promotional']) ? $aCost['promotional'] : isset($aCost['max']) && $aCost['max'] !== null;
        $aCost['total'] = isset($aCost['total']) ? $aCost['total'] : (float)0;
        return $this;
    }

    protected function ebayDebug($aDebug = null) {
        if ($aDebug === null) {
            MLLog::gi()->add(MLSetting::gi()->get('sCurrentOrderImportLogFileName'), array(
                'MOrderId'            => MLSetting::gi()->get('sCurrentOrderImportMarketplaceOrderId'),
                'PHP'                 => get_class($this).'::'.__METHOD__.'('.__LINE__.')',
                'eBay-shipping-costs' => $this->aEbayDebug,
            ));
            MLMessage::gi()->addDebug('eBay-shipping-costs', $this->aEbayDebug);
            $this->aEbayDebug = array();
        } else {
            $this->aEbayDebug = array_merge($this->aEbayDebug, $aDebug);
        }
        return $this;
    }

    /**
     * calculates shipping promotional discount
     * @param float $fCost cost for order depends on item addcost
     * @param float $fTotal cost for all products
     * @param int $iQty quantity for all products
     * @return float
     */
    protected function ebayCalcPromotionalDiscount ($fCost, $fOrderCost, $iQty) {
        $aPromotion = MLModule::gi()->getShippingPromotionalDiscount();
        $this->ebayDebug(array('aPromotion' => $aPromotion));
        $blPromotion = false;
        if (empty($aPromotion)) {
            $aPromotion['ShippingCost'] = $fCost;
        } else {
            switch ($aPromotion['DiscountName']) {
                case 'ShippingCostXForAmountY' : { // "Geben Sie EUR (Y) für mindestens zwei Artikel aus und die Versandkosten betragen (X)"
                    $blPromotion = $fOrderCost >= $aPromotion['OrderAmount'] ;
                    break;
                }
                case 'ShippingCostXForItemCountN' : { // "Kaufen Sie mindestens (N) Artikelanzahl Artikel und die Versandkosten betragen Wählen Sie einen Sonderpreis für den Versand aus. EUR (X)"
                    $blPromotion = $iQty >= $aPromotion['ItemCount'];
                    break;
                }
                case 'MaximumShippingCostPerOrder' : { // "Geben Sie nicht mehr als EUR () für den Versand pro Bestellung aus."
                    $blPromotion = $fCost >= $aPromotion['ShippingCost'];
                    break;
                }
            }
        }
        return $blPromotion ? $aPromotion['ShippingCost'] : $fCost;
    }

    protected function ebayGetPreviousShippingCost () {
        if (is_array($this->oMlOrder->get('internaldata'))) {
            return $this->oMlOrder->get('internaldata');
        } else {
            $fCost = 0;
            foreach ($this->aExistingOrder['Totals'] as $aTotal) {
                if ($aTotal['Type'] == 'Shipping') {
                    $fCost = $aTotal['Value'];
                    break;
                }
            }
            return $this->ebayGetCurrentShippingCost($fCost, current($this->aExistingOrder['Products']), $this->aExistingOrder['MPSpecific']['MOrderID']);
        }
    }

    /**
     *
     * @param float $fCost
     * @param array $aProduct | ebay have only on article per order
     * @param $sMlOrderId
     * @return array
     */
    protected function ebayGetCurrentShippingCost($fCost, $aProduct, $sMlOrderId) {
        $fCost = (float)$fCost;
        $oPrepareHelper = MLHelper::gi('Model_Table_Ebay_PrepareData')->setPrepareList(null);
        /* @var $oPrepareHelper ML_Ebay_Helper_Model_Table_Ebay_PrepareData */
        if (isset($aProduct['SKU']) && !empty($aProduct['SKU'])) {
            $oProduct = MLProduct::factory()->getByMarketplaceSKU($aProduct['SKU']);
            if (
                !$oProduct->exists()
                || !MLDatabase::getPrepareTableInstance()->set('products_id', $oProduct->get('id'))->exists()
            ) { // product is not prepared
                $oProduct = null;
            }
        } else {
            $oProduct = null;
        }
        $this->ebayDebug(array('productIsPrepared' => $oProduct !== null));
        # getDestination
        $sOrderCountry = '';
        foreach (array('Shipping', 'Main', 'Billing') as $sAddressType) {
            if (
                array_key_exists($sAddressType, $this->aCurrentOrder['AddressSets'])
                && array_key_exists('CountryCode', $this->aCurrentOrder['AddressSets'][$sAddressType])
            ) {
                $sOrderCountry = $this->aCurrentOrder['AddressSets'][$sAddressType]['CountryCode'];
                break;
            }
        }
        $sDestination = strtoupper(MLModule::gi()->getConfig('country')) == strtoupper($sOrderCountry) ? 'Local' : 'International';
        $this->ebayDebug(array('destination' => $sDestination));
        $aPreparedDestinationData = $oPrepareHelper
            ->setProduct($oProduct)//could be null for default values
            ->getPrepareData(array(
                'ShippingSellerProfile' => array('optional' => array('active' => true)),
                'Shipping'.$sDestination.'Profile'  => (($oProduct === null) ? array('optional' => array('active' => true)) : array()),
                'Shipping'.$sDestination.'Discount' => (($oProduct === null) ? array('optional' => array('active' => true)) : array()),
            ))
        ;
        $aSellerProfile = $aPreparedDestinationData['ShippingSellerProfile'];
        unset($aPreparedDestinationData['ShippingSellerProfile']);
        foreach ($aPreparedDestinationData as $sKey => $aValue){
            MLHelper::gi('model_form_type_sellerprofiles')->manipulateShippingProfileFieldForSellerProfile($aValue, $aSellerProfile);
            $aPreparedDestinationData[$sKey] = $aValue;
        }
        $this->ebayDebug(array('preparedDestinationData' => $aPreparedDestinationData));
        $iProfileId = $aPreparedDestinationData['Shipping'.$sDestination.'Profile']['value'];
        $blDiscount = (bool)$aPreparedDestinationData['Shipping'.$sDestination.'Discount']['value'];
        $aMpProfileData = MLModule::gi()->getShippingDiscountProfiles();
        if (array_key_exists($iProfileId, $aMpProfileData)) {
            $this->ebayDebug(array('shippingDiscountProfile' => array('id' => $iProfileId, 'data' => $aMpProfileData[$iProfileId])));
            $fAdd = $aMpProfileData[$iProfileId]['amount'];
            if ($fAdd > 0) {
                //@todo this equation should be check when we have any customer with same situation
                $fCost = max(0, $fCost - (($aProduct['Quantity'] -1 ) * $fAdd));
            } elseif ($fAdd < 0) {
                /**
                 * totalCost <=> qty * x - (qty - 1) * - additionalCost
                 * $fCost                                                                       <=> ($aProduct['Quantity'] * x) - (($aProduct['Quantity'] - 1) * -$fAdd)    | +(($aProduct['Quantity'] - 1) * -$fAdd)
                 * $fCost + (($aProduct['Quantity'] - 1) * -$fAdd)                              <=> $aProduct['Quantity'] * x                                             | / $aProduct['Quantity]
                 * ($fCost + (($aProduct['Quantity'] - 1) * -$fAdd)) / $aProduct['Quantity']    <=> x
                 */
                //@todo this equation should be check when we have any customer with same situation
                $fCost = ($fCost + (($aProduct['Quantity'] - 1) * -$fAdd)) / $aProduct['Quantity'];
            }
        } else {
            $fAdd = null;
            $fCost = $fCost / $aProduct['Quantity'];
        }
        return array($sMlOrderId => array(
            'cost' => $fCost, // 1. article
            'add' => $fAdd, // each other article
            'qty' => $aProduct['Quantity'], // qty of product
            'total' => $aProduct['Quantity'] * $aProduct['Price'], // cost for ordered products
            'promotional' => $blDiscount,
        ));
    }

    /**
     * Merges order data for payment
     *
     * @return array
     */
    protected function mergeOrder() {
        $aOld = isset($this->aExistingOrder['Order']) ? $this->aExistingOrder['Order'] : array();
        $aNew = isset($this->aCurrentOrder['Order']) ? $this->aCurrentOrder['Order'] : array();
        // all fields that no exists in new data will be copied from existing shop order (old)
        foreach ($aOld as $sOld => $mOld) {
            if (!isset($aNew[$sOld])) {
                $aNew[$sOld] = $mOld;
            }
        }

        //merge paid status
        $sOldId = (isset($this->aExistingOrder['MPSpecific']) && isset($this->aExistingOrder['MPSpecific']['MOrderID']))
            ? $this->aExistingOrder['MPSpecific']['MOrderID']
            : 'unknown';
        $sOldPaidStatus = isset($aOld['Payed']) ? $aOld['Payed'] : false;

        $sNewId = (isset($this->aCurrentOrder['MPSpecific']) && isset($this->aCurrentOrder['MPSpecific']['MOrderID']))
            ? $this->aCurrentOrder['MPSpecific']['MOrderID']
            : 'unknown';
        $sNewPaidStatus = isset($aNew['Payed']) ? $aNew['Payed'] : false;

        // aNew[StatusDetails] is only set right now when it was copied from exiting order
        if (isset($aNew['StatusDetails'])) {
            $aNew['StatusDetails'] = $aOld['StatusDetails'];
        } elseif (!empty($this->aExistingOrder)) {
            // at first import there is no existing data so don't create status details for old data
            $aNew['StatusDetails'] = array($sOldId => $sOldPaidStatus);
        }
        // when order id is same as before this overwrite the status details with new payment status
        $aNew['StatusDetails'][$sNewId] = $sNewPaidStatus;

        $blStatus = true;
        // $blStatus is only true if for all marketplaceOrderIds in this order the payment status is true
        foreach ($aNew['StatusDetails'] as $blStatusDetail) {
            $blStatus = $blStatus && $blStatusDetail;
        }

        $aNew['Payed'] = $blStatus;
        if ($blStatus) {
            $aNew['Status'] = MLModule::gi()->getConfig('orderstatus.paid');
        } else {
            $aNew['Status'] = MLModule::gi()->getConfig('orderstatus.open');
        }

        return $aNew;
    }

    /**
     * We always import newset Payment data(e.g. Code, PaidTime)
     * @param array $aOldTotal
     * @param array $aNewTotal
     * @return array newTotal
     */
    protected function mergeTotalPayment ($aOldTotal, $aNewTotal) {
        if($aOldTotal['Value'] > $aNewTotal['Value']){
            $aNewTotal['Value'] = $aOldTotal['Value'];
            $aNewTotal['Tax'] = $aOldTotal['Tax'];
        }
        return $aNewTotal;
    }

    protected function mergeMpSpecific() {
        $aNew = parent::mergeMpSpecific();
        $aOldSpecific = isset($this->aExistingOrder['MPSpecific']) ? $this->aExistingOrder['MPSpecific'] : array();
        $aNewSpecific = isset($this->aCurrentOrder['MPSpecific']) ? $this->aCurrentOrder['MPSpecific'] : array();
        $aEbaySalesRecordNumber = array();
        if (isset($aOldSpecific['eBaySalesRecordNumber'])) {
            $aEbaySalesRecordNumber[] = $aOldSpecific['eBaySalesRecordNumber'];
        }
        if (isset($aNewSpecific['eBaySalesRecordNumber']) && (empty($aEbaySalesRecordNumber) || strpos($aEbaySalesRecordNumber[0], $aNewSpecific['eBaySalesRecordNumber']) === false)) {
            $aEbaySalesRecordNumber[] = $aNewSpecific['eBaySalesRecordNumber'];
        }
        if (!empty($aEbaySalesRecordNumber)) {
            $aNew['eBaySalesRecordNumber'] = implode(', ', $aEbaySalesRecordNumber);
        }
        $aExtendedOrderID = array();
        if (isset($aOldSpecific['ExtendedOrderID'])) {
            $aExtendedOrderID[] = $aOldSpecific['ExtendedOrderID'];
        }
        if (isset($aNewSpecific['ExtendedOrderID']) && (empty($aExtendedOrderID) || strpos($aExtendedOrderID[0], $aNewSpecific['ExtendedOrderID']) === false)) {
            $aExtendedOrderID[] = $aNewSpecific['ExtendedOrderID'];
        }
        if (!empty($aExtendedOrderID)) {
            $aNew['ExtendedOrderID'] = implode(', ', $aExtendedOrderID);
        }
        return $aNew;
    }

}
