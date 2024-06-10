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

class ML_Hitmeister_Helper_Model_Service_OrderData_Normalize extends ML_Modul_Helper_Model_Service_OrderData_Normalize {

    /**
     * Normalize order data.
     *
     * * It will set the order status to the configured one, if it's a FBK order.
     * * Always set the paid status to true.
     *
     * @return self
     */
    protected function normalizeOrder() {
        parent::normalizeOrder();

        if (
            array_key_exists('FulfillmentType', $this->aOrder['MPSpecific'])
            && 'fulfilled_by_kaufland' == $this->aOrder['MPSpecific']['FulfillmentType']
        ) {
            $this->aOrder['Order']['Status'] = MLModule::gi()->getConfig('orderstatus.fbk');
        }

        $this->aOrder['Order']['Payed'] = true;

        return $this;
    }

    /**
     * Decide if the stock will be synchronized, depends on the setting from the merchant and the fulfillment type from
     * Kaufland.
     *
     * @param $aProduct
     * @param $fDefaultProductTax
     * @return self
     */
    protected function normalizeProduct(&$aProduct, $fDefaultProductTax) {
        parent::normalizeProduct($aProduct, $fDefaultProductTax);

        $aProduct['StockSync'] =
            (MLModule::gi()->getConfig('stocksync.frommarketplace') == 'rel'
                && (!array_key_exists('FulfillmentType', $this->aOrder['MPSpecific'])
                    || $this->aOrder['MPSpecific']['FulfillmentType'] != 'fulfilled_by_kaufland'
                )
            )
            || MLModule::gi()->getConfig('stocksync.frommarketplace') == 'fbk';

        return $this;
    }

}
