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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Modul_Helper_Model_Service_OrderData_Normalize');

class ML_Amazon_Helper_Model_Service_OrderData_Normalize extends ML_Modul_Helper_Model_Service_OrderData_Normalize {
    
    protected $oModul = null;
    protected function getModul(){
        if($this->oModul === null ){
            $this->oModul = MLModule::gi();
        }
        return $this->oModul;
    }

    protected function normalizeTotalTypeShipping(&$aTotal) {
        parent::normalizeTotalTypeShipping($aTotal);
        if ($this->aOrder['MPSpecific']['FulfillmentChannel'] == 'AFN') { //amazon payed and shipped
            if (isset($this->aOrder['MPSpecific']['Carrier'])) {
                $aTotal['Data']['Carrier'] = $this->aOrder['MPSpecific']['Carrier'];
            }
            if (isset($this->aOrder['MPSpecific']['Trackingcode'])) {
                $aTotal['Data']['Trackingcode'] = $this->aOrder['MPSpecific']['Trackingcode'];
            }
        }
        return $this;
    }
    
    protected function getPaymentCode($aTotal, $sPaymentMethodConfigKey = 'orderimport.paymentmethod') {//till this version amazon doesn't send any paymentmethod information
        $sPaymentMethodConfigKey = 
            ($this->aOrder['MPSpecific']['FulfillmentChannel'] == 'AFN' && $this->getModul()->getConfig('orderimport.fbapaymentmethod') !== null) 
            ? 'orderimport.fbapaymentmethod'
            : 'orderimport.paymentmethod'
        ;
        return parent::getPaymentCode($aTotal, $sPaymentMethodConfigKey);
    }
    
    protected function getShippingCode($aTotal) {//till this version amazon doesn't send any paymentmethod information
        if ($this->aOrder['MPSpecific']['FulfillmentChannel'] == 'AFN' && $this->getModul()->getConfig('orderimport.fbashippingmethod') !== null) { //amazon payed and shipped
            $sStatusKey = 'orderimport.fbashippingmethod';
        }else{
            $sStatusKey = 'orderimport.shippingmethod';
        }
        if ('textfield' === $this->getModul()->getConfig($sStatusKey)) {
            $sPayment = $this->getModul()->getConfig($sStatusKey.'.name');
            return $sPayment == '' ? MLModule::gi()->getMarketPlaceName() : $sPayment;
        } elseif($this->getModul()->getConfig($sStatusKey) === null){//'matching'
            return MLModule::gi()->getMarketPlaceName();
        }else{
            return $this->getModul()->getConfig($sStatusKey);
        }
    }
    
    protected function normalizeOrder () {
        parent::normalizeOrder();
        $this->aOrder['Order']['Payed'] = true;
        $this->aOrder['Order']['PaymentStatus'] = MLModule::gi()->getConfig('orderimport.paymentstatus');
        if ($this->aOrder['MPSpecific']['FulfillmentChannel'] === 'AFN') { //amazon payed and shipped
            $this->aOrder['Order']['Shipped'] = true;
            $this->aOrder['Order']['Status'] = MLModule::gi()->getConfig('orderstatus.fba');
        }
        if ($this->aOrder['MPSpecific']['FulfillmentChannel'] === 'Bopis') { //amazon BOPIS
            $orderStatusForBopisOrder = MLModule::gi()->getConfig('bopis.orderstatus.open');

            // check if it's configured if not use default order status for new orders
            if ($orderStatusForBopisOrder !== null) {
                $this->aOrder['Order']['Status'] = $orderStatusForBopisOrder;
            }
        }
        return $this;
    }
    
    protected function normalizeProduct (&$aProduct, $fDefaultTax) {
        // discount for product or shipping: Tax follows the highest product tax
        if ($aProduct['SKU'] == MLModule::gi()->getConfig('orderimport.amazonpromotionsdiscount.products_sku')
            || $aProduct['SKU'] == MLModule::gi()->getConfig('orderimport.amazonpromotionsdiscount.shipping_sku')
        ) {
            $fTaxMax = 0.00;
            foreach ($this->aOrder['Products'] as $aPr) {
                if (    isset($aPr['Tax'])
                     && is_numeric($aPr['Tax'])
                     && $aPr['Tax'] > $fTaxMax
                ) {
                    $fTaxMax = $aPr['Tax'];
                }
            }
            $aProduct['Tax'] = $fTaxMax;
        }
        parent::normalizeProduct($aProduct, $fDefaultTax);
        $aProduct['StockSync'] =
            (MLModule::gi()->getConfig('stocksync.frommarketplace') == 'rel' && $this->aOrder['MPSpecific']['FulfillmentChannel'] != 'AFN')
            || MLModule::gi()->getConfig('stocksync.frommarketplace') == 'fba'
        ;
        return $this;
    }
    
    protected function normalizeMpSpecific () {
        parent::normalizeMpSpecific();
        if (array_key_exists('FulfillmentChannel', $this->aOrder['MPSpecific'])) {
            switch ($this->aOrder['MPSpecific']['FulfillmentChannel']){
                case 'MFN-Prime':
                    $sTitle = MLModule::gi()->getMarketPlaceName(false) . ' Prime';
                    break;
                case 'AFN':
                    $sTitle = MLModule::gi()->getMarketPlaceName(false) . 'FBA';
                    break;
                default :
                    $sTitle = MLModule::gi()->getMarketPlaceName(false);
                    break;
            }
            $this->aOrder['MPSpecific']['InternalComment'] =
                sprintf(MLI18n::gi()->get('ML_GENERIC_AUTOMATIC_ORDER_MP_SHORT'), $sTitle)."\n".
                MLI18n::gi()->get('ML_LABEL_MARKETPLACE_ORDER_ID').': '.$this->aOrder['MPSpecific']['MOrderID']."\n\n"
                .$this->aOrder['Order']['Comments'];
        }
        return $this;
    }

    /**
     * Filling $aOrder['AddressSets']['Shipping']['UstId'] with $aOrder['AddressSets']['Main']['UstId']
     */
    protected function normalizeAddressSets() {
        parent::normalizeAddressSets();
        if (!isset($this->aOrder['AddressSets']['Shipping']['UstId']) && isset($this->aOrder['AddressSets']['Main']['UstId'])) {
            $this->aOrder['AddressSets']['Shipping']['UstId'] = $this->aOrder['AddressSets']['Main']['UstId'];
        }
        return $this;
    }
}
