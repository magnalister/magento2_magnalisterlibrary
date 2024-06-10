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

MLFilesystem::gi()->loadClass('Modul_Helper_Model_Service_OrderData_Normalize');

class ML_Ebay_Helper_Model_Service_OrderData_Normalize extends ML_Modul_Helper_Model_Service_OrderData_Normalize {

    /**
     * @deprecated (1429879042) we dont take care of shipping data, but its deprecated, perhaps we need it
     */
    protected $sAddressIdDeprecated = null;
    
    protected function getShippingCode($aTotal) {
        $sShippingMethod = MLModule::gi()->getConfig('orderimport.shippingmethod');
        if ('textfield' == $sShippingMethod) {
            $sShippingName = MLModule::gi()->getConfig('orderimport.shippingmethod.name');
            $sShippingMethod = $sShippingName == '' ? $aTotal['Code'] : $sShippingName;
        } else if ($sShippingMethod === null || 'matching' === $sShippingMethod) {
            if (!isset($aTotal['Code']) || in_array($aTotal['Code'], array('', 'none', 'None'))) {
                $sShippingMethod = MLModule::gi()->getMarketPlaceName();
            } else {
                $sShippingMethod = $aTotal['Code'];
            }
        }
        return $sShippingMethod;
    }
    
    protected function normalizeOrder() {
        parent::normalizeOrder();
        if (!isset($this->aOrder['Products']) || empty($this->aOrder['Products'])) {
            $aOrderData = MLOrder::factory()->getByMagnaOrderId($this->aOrder['MPSpecific']['MOrderID'])->get('orderdata');
            $this->aOrder['Order']['DatePurchased'] =
                isset($this->aOrder['Order']['DatePurchased'])
                    ? $this->aOrder['Order']['DatePurchased']
                    : $aOrderData['Order']['DatePurchased'];
        }
        foreach ($this->aOrder['Totals'] as $aTotal) {
            if ($aTotal['Type'] == 'Payment' && isset($aTotal['Complete']) && $aTotal['Complete'] == true) {
                $this->aOrder['Order']['Payed'] = true;
                $this->aOrder['Order']['Status'] = MLModule::gi()->getConfig('orderstatus.paid');
                break;
            }
        }
        return $this;
    }

    protected function normalizeMpSpecific() {
        $blEBayPlus = array_key_exists('eBayPlus', $this->aOrder['MPSpecific']);
        parent::normalizeMpSpecific();
        if ($blEBayPlus) {
            $this->aOrder['MPSpecific']['InternalComment'] = str_replace('(eBay)', '(eBayPlus)', $this->aOrder['MPSpecific']['InternalComment']);
        }
        if (    array_key_exists('ExtendedOrderID', $this->aOrder['MPSpecific'])
             && !empty($this->aOrder['MPSpecific']['ExtendedOrderID'])) {
            $this->aOrder['MPSpecific']['InternalComment'] .= 'ExtendedOrderID: ' . $this->aOrder['MPSpecific']['ExtendedOrderID'];
        }
        $this->aOrder['MPSpecific']['InternalComment'] .= "\n" . str_replace('{#_platformName_#}', MLModule::gi()->getMarketPlaceName(false), MLI18n::gi()->BuyerUsername) . ': ' . $this->aOrder['MPSpecific']['BuyerUsername'];
        // Move the Buyer Message (if any) to the end
        if (!empty($this->aOrder['Order']['Comments'])) {
            $this->aOrder['MPSpecific']['InternalComment'] = str_replace("\n".$this->aOrder['Order']['Comments'], '', $this->aOrder['MPSpecific']['InternalComment']) . "\n\n". $this->aOrder['Order']['Comments'] . "\n";
        }
        foreach ($this->aOrder['Totals'] as $aTotal) {
            if ($aTotal['Type'] == 'Payment' && isset($aTotal['Complete']) && $aTotal['Complete'] == true) {
                foreach ($aTotal as $sTotalKey => $mTotalValue) {
                    if (!in_array($sTotalKey, array('Type', 'Value', 'Tax'))) {
                        $this->aOrder['MPSpecific']['Payment'][$sTotalKey] = $mTotalValue;
                    }
                }
                break;
            }
        }

        // prev. order-ids
        if ($this->getUpdateMode()) {
            $oOrder = MLOrder::factory()->getByMagnaOrderId($this->aOrder['MPSpecific']['MOrderID']);
        } elseif (MLModule::gi()->getConfig('importonlypaid') != '1') {
            //we don't need set MPreviousOrderID in update order and if we import only paid orders
            $oOrder = $this->ebayGetNotFinalizedOrder();
        } else {
            $oOrder = null;
        }

        if (is_object($oOrder)) {
            $iPreviousId = $oOrder->get('special');
            $iNewId = $this->aOrder['MPSpecific']['MOrderID'];
            $aOrderData = $oOrder->get('orderdata');
            if ($iPreviousId != $iNewId) {
                $this->aOrder['MPSpecific']['MPreviousOrderID'] = array(
                    'id' => $iPreviousId,
                    'date' => $aOrderData['Order']['DatePurchased']
                );
            }
            $aData = $oOrder->get('data');
            $aIds = isset($aData['MPreviousOrderIDS']) ? $aData['MPreviousOrderIDS'] : array();
            $aIds[] = $iPreviousId;
            $this->aOrder['MPSpecific']['MPreviousOrderIDS'] = array_unique($aIds);
        }

        if(isset($this->aOrder['MPSpecific']['EbayRefundUrl'])){
            $this->aOrder['MPSpecific'][''] = sprintf(MLI18n::gi()->{'ebay_order_detail_information_to_ebay_seller_hub'}, $this->aOrder['MPSpecific']['EbayRefundUrl']);
            unset($this->aOrder['MPSpecific']['EbayRefundUrl']);
        }

        return $this;
    }

    protected function ebayGetNotFinalizedOrder($iStart = 0) {
        // find existing order;
        $aClosedStatuses = MLModule::gi()->getConfig('orderstatus.closed');
        $aClosedStatuses = is_array($aClosedStatuses) ? $aClosedStatuses : array();
        $oOrderList = MLOrder::factory()->getList();
        $oOrderList
            ->getQueryObject()
            ->where("orderdata LIKE '%\"EMailIdent\":\"".$this->aOrder['AddressSets']['Main']['EMail']."\"%'")
            ->where("orderdata LIKE '%\"Currency\":\"".$this->aOrder['Order']['Currency']."\"%'")
            ->where("status NOT IN('".implode("', '", $aClosedStatuses)."')")
            ->orderBy('orders_id DESC')
            ->limit($iStart, 1);
        if (count($oOrderList->getList()) != 0) {
            $oOrder = current($oOrderList->getList());
            /** @var $oOrder ML_Shop_Model_Order_Abstract */
            try {
                if (!in_array($oOrder->getShopOrderStatus(), $aClosedStatuses)) {
                    return $oOrder;
                } else {
                    return $this->ebayGetNotFinalizedOrder($iStart + 1);
                }
            } catch (\Exception $ex) {
                //If order is already deleted from Shop-System or it not available, it throw an exception,
                // so here we shouldn't merge the order (It will be thrown already in Shopware and Shopify)
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * @deprecated (1429879042) we dont take care of shipping data, but its deprecated, perhaps we need it
     */
    protected function ebayGetNotFinalizedOrderDeprecated($iStart = 0) {
        if ($this->sAddressIdDeprecated === null) {
            $aComparableData = array();
            foreach (array_keys($this->aOrder['AddressSets']) as $sAddressType) {
                if ($sAddressType == 'Shipping') {
                    foreach (array('Gender', 'Firstname', 'Company', 'Street', 'Housenumber', 'Postcode', 'City', 'Suburb', 'CountryCode', 'Phone', 'EMail', 'DayOfBirth',) as $sField) {
                        $aComparableData[$sAddressType][$sField] = $this->aOrder['AddressSets'][$sAddressType][$sField];
                    }
                } else {
                    $aComparableData[$sAddressType]['EMail'] = $this->aOrder['AddressSets'][$sAddressType]['EMail'];
                }
            }
            $this->sAddressIdDeprecated = md5(json_encode($aComparableData));
            $this->aOrder['MPSpecific']['AddressId'] = $this->sAddressIdDeprecated; // for finding existing order by same customer
        }
        $sAddressId = $this->sAddressIdDeprecated;
        // find existing order;
        $aClosedStatuses = MLModule::gi()->getConfig('orderstatus.closed');
        $aClosedStatuses = is_array($aClosedStatuses) ? $aClosedStatuses : array();
        $oOrderList = MLOrder::factory()->getList();
        $oOrderList
            ->getQueryObject()
            ->where("data LIKE '%\"AddressId\":\"".$sAddressId."\"%'")
            ->where("status NOT IN('".implode("', '", $aClosedStatuses)."')")
            ->orderBy('orders_id DESC')
            ->limit($iStart, 1);
        if (count($oOrderList->getList()) != 0) {
            $oOrder = current($oOrderList->getList());
            if (!in_array($oOrder->getShopOrderStatus(), $aClosedStatuses)) {
                return $oOrder;
            } else {
                return $this->ebayGetNotFinalizedOrderDeprecated($iStart + 1);
            }
        } else {
            return false;
        }
    }
    
    protected function normalizeProduct (&$aProduct, $fDefaultProductTax) {
        parent::normalizeProduct($aProduct, $fDefaultProductTax);
        $aProduct['MOrderID'] = $this->aOrder['MPSpecific']['MOrderID'];
        return $this;
    }

}
