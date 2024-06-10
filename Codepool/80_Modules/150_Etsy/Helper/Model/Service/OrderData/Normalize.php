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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Modul_Helper_Model_Service_OrderData_Normalize');

class ML_Etsy_Helper_Model_Service_OrderData_Normalize extends ML_Modul_Helper_Model_Service_OrderData_Normalize {
    
    protected function normalizeAddressSets () {

        $buyerUsername = isset($this->aOrder['MPSpecific']['BuyerUsername']) ? $this->aOrder['MPSpecific']['BuyerUsername'] : '';

        parent::normalizeAddressSets();
        $this->aOrder['AddressSets']['Main']['EMailIdent'] = $this->etsyFindCustomerIdent(
            $buyerUsername,
            $this->aOrder['AddressSets']['Main']['EMail']
        );
        return $this;
    }

    protected function normalizeOrder() {
        parent::normalizeOrder();
        foreach ($this->aOrder['Totals'] as $aTotal) {
            if ($aTotal['Type'] == 'Payment' && isset($aTotal['Complete']) && $aTotal['Complete'] == 1) {
                $this->aOrder['Order']['Payed']  = true;
                break;
            }
        }

        return $this;
    }

    /**
     * add payment to totals
     */
    protected function normalizeTotals () {
        $this->aOrder['Totals'] = array_key_exists('Totals', $this->aOrder) ? $this->aOrder['Totals'] : array();
        $blFound = false;
        foreach ($this->aOrder['Totals'] as $aTotal) {
            if ($aTotal['Type'] == 'Payment') {
                $blFound = true;
            }

            if (!$blFound && isset($aTotal['Payment']) && isset($aTotal['Payment']['Code'])) {
                $this->aOrder['Totals'][] = array(
                    'Type' => 'Payment',
                    'Code' => $aTotal['Payment']['Code'],
                    'Value' => 0
                );
            }
        }

        return parent::normalizeTotals();
    }
    
    protected function etsyFindCustomerIdent ($sBuyer, $sDefault) {
        if (MLModul::gi()->getConfig('customersync')) {
            $sResult = MLDatabase::getDbInstance()->fetchOne("
                SELECT orderdata 
                FROM magnalister_orders 
                WHERE orderdata like  '%\"BuyerUsername\":\"".$sBuyer."\"%' 
                AND platform = '".  MLModul::gi()->getMarketPlaceName()."'
                ORDER BY inserttime desc
                LIMIT 1
            ");
            $aResult = json_decode($sResult, true);
            if (
                !empty($aResult)
                && isset($aResult['AddressSets']['Main']['EMail'])
            ) {
                return $aResult['AddressSets']['Main']['EMail'];
            }
        }
        return $sDefault;
    }
    
}
