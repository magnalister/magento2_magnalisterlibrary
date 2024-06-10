<?php
/**
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
 * (c) 2010 - 2018 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Modul_Helper_Model_Service_OrderData_Normalize');

class ML_Hood_Helper_Model_Service_OrderData_Normalize extends ML_Modul_Helper_Model_Service_OrderData_Normalize {

    /**
     * @deprecated (1429879042) we dont take care of shipping data, but its deprecated, perhaps we need it
     */
    protected $sAddressIdDeprecated = null;

    protected function getShippingCode($aTotal) {
        $sShippingMethod = MLModul::gi()->getConfig('orderimport.shippingmethod');
        if ('textfield' == $sShippingMethod) {
            $sShippingName = MLModul::gi()->getConfig('orderimport.shippingmethod.name');
            $sShippingMethod = $sShippingName == '' ? $aTotal['Code'] : $sShippingName;
        } else if ('matching' == $sShippingMethod) {
            if (in_array($aTotal['Code'], array('', 'none', 'None'))) {
                $sShippingMethod = MLModul::gi()->getMarketPlaceName();
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
                break;
            }
        }
        return $this;
    }

    protected function normalizeProduct(&$aProduct, $fDefaultProductTax) {
        parent::normalizeProduct($aProduct, $fDefaultProductTax);
        $aProduct['MOrderID'] = $this->aOrder['MPSpecific']['MOrderID'];
        return $this;
    }

}
