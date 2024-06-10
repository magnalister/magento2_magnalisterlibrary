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

MLFilesystem::gi()->loadClass('Modul_Helper_Model_Service_OrderData_Normalize');

class ML_Otto_Helper_Model_Service_OrderData_Normalize extends ML_Modul_Helper_Model_Service_OrderData_Normalize {

    protected function normalizeAddressSets () {

        $buyerId = isset($this->aOrder['MPSpecific']['BuyerId']) ? $this->aOrder['MPSpecific']['BuyerId'] : '';

        parent::normalizeAddressSets();
        $this->aOrder['AddressSets']['Main']['EMailIdent'] = $this->ottoFindCustomerIdent(
            $buyerId,
            $this->aOrder['AddressSets']['Main']['EMail']
        );
        return $this;
    }

    protected function normalizeOrder() {
        parent::normalizeOrder();

        $this->aOrder['Order']['Status'] = MLModul::gi()->getConfig('orderstatus.open');

        foreach ($this->aOrder['Totals'] as $aTotal) {
                $this->aOrder['Order']['Payed'] = true;
                break;
        }
        return $this;
    }

    protected function ottoFindCustomerIdent ($sBuyer, $sDefault) {
        if (MLModul::gi()->getConfig('customersync')) {
            $sResult = MLDatabase::getDbInstance()->fetchOne("
                SELECT orderdata
                FROM magnalister_orders
                WHERE orderdata like  '%\"BuyerId\":\"".$sBuyer."\"%'
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

    protected function normalizeMpSpecific () {
        parent::normalizeMpSpecific();

        $this->aOrder['MPSpecific']['InternalComment'] =
            sprintf(MLI18n::gi()->get('ML_GENERIC_AUTOMATIC_ORDER_MP_SHORT'), MLModul::gi()->getMarketPlaceName(false) )."\n".
            MLModul::gi()->getMarketPlaceName(false).' '.MLI18n::gi()->get('ML_LABEL_ORDER_ID').': '.$this->aOrder['MPSpecific']['OttoOrderNumber']."\n\n"
            .$this->aOrder['Order']['Comments']
        ;
    }
}
