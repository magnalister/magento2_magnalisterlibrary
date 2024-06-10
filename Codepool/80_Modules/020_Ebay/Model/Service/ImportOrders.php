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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Ebay_Model_Service_ImportOrders extends ML_Modul_Model_Service_ImportOrders_Abstract {

//    /**
//     * @deprecated (1429879042) we don't take care of shipping data, but its deprecated, perhaps we need it
//     */
//    public function canDoOrderDeprecated(ML_Shop_Model_Order_Abstract $oOrder, &$aOrder) {
//        $aOrderData = $oOrder->get('data');
//        if ( //same address
//               isset($aOrderData['AddressId'])
//            && isset($aOrder['MPSpecific']['AddressId'])
//            && $aOrderData['AddressId'] == $aOrder['MPSpecific']['AddressId']
//        ) {
//            return 'Extend existing order - same email address';
//        } elseif ($oOrder->get('orders_id') === null) {
//            return 'Create order';
//        } else {
//            throw MLException::factory('Model_Service_ImportOrders_OrderExist')->setShopOrder($oOrder);
//        }
//    }

    private $sBlackListedMailPrefix = 'blacklisted-';

    protected function getUpdateMode($aOrder) {
        $blUpdateMode =  parent::getUpdateMode($aOrder) || MLModule::gi()->getConfig('importonlypaid') === '1';
        return $blUpdateMode;
    }

    public function canDoOrder(ML_Shop_Model_Order_Abstract $oOrder, &$aOrder) {
        $aOrderData = $oOrder->get('orderdata');
        $aOrderAllData = $oOrder->get('orderData');
        if (   isset($aOrderData['AddressSets']['Main']['EMail'])
            && isset($aOrder['AddressSets']['Main']['EMail'])
            && $aOrderData['AddressSets']['Main']['EMail'] == $aOrder['AddressSets']['Main']['EMail']
            && isset($aOrderAllData['Order']['Currency'])
            && isset($aOrder['Order']['Currency'])
            && $aOrderAllData['Order']['Currency'] == $aOrder['Order']['Currency']
            && (
               MLModule::gi()->getConfig('importonlypaid') != '1'
                ||
                $this->IfOnlyPaidOrderCouldBeExtended($aOrder, $aOrderAllData)
            )
        ) {
            return 'Extend existing order - same customer address';
        } elseif ($oOrder->get('orders_id') === null) {
            return 'Create order';
        } else {
            //throw new Exception('Order already exists');
            throw MLException::factory('Model_Service_ImportOrders_OrderExist')->setShopOrder($oOrder);
        }
    }

    /**
     * This function is only used when "Only paid order" is activated
     * It returns true if any new product from API order any hook manipulation that should be imported
     *
     * @param $aOrder array
     * @param $aOrderAllData array
     * @return bool
     */
    protected function IfOnlyPaidOrderCouldBeExtended($aOrder, $aOrderAllData){
        return isset($aOrder['Products'], $aOrderAllData['Products'])
            &&  is_array($aOrder['Products'])
            && count($aOrder['Products']) !== count($aOrderAllData['Products']);
    }


    /**
     * It returns number eBay order item that are imported in shop-system
     * This function is only used when "Only paid order" is activated
     * It returns true if all items of order from eBay are not imported into shop-system
     * We cannot use only comparison count($aOrder['Products']), count($aOrderAllData['Products']), order hooks can
     * add some extra products to order (like what Pickware plug-in in Shopware does)
     *
     * @param $aOrder array
     * @return int
     */
    protected function getNumberOfImportedPosition($aOrder){
        $aOrderItemLine = array();
        foreach ($aOrder['Products'] as $aProduct){
            if (!empty($aProduct['eBayOrderLineItemID'])) {
                $aOrderItemLine[$aProduct['eBayOrderLineItemID']] = $aProduct['eBayOrderLineItemID'];
            }
        }
        return count($aOrderItemLine);
    }

    /**
     * add 'blacklisted-' from customer's e-mail address
     *  if configured so (not recommended)
     *
     * @param $aOrder
     * @return mixed
     * @throws Exception
     */
    protected function normalizeOrder($aOrder) {
        // check if "blacklisted-" configured by customer
        $sBlacklistEmails = MLModule::gi()->getConfig('orderimport.blacklisting');
        if (isset($sBlacklistEmails) && $sBlacklistEmails === '1') { // in case of emails should  be blacklisted, add prefix (0 = do not blacklist, 1 = blacklist mail)
            if (array_key_exists('AddressSets', $aOrder)) {
                foreach ($aOrder['AddressSets'] as &$addressSet) {
                    if (!empty($addressSet['EMail'])) {
                        $addressSet['EMail'] = $this->sBlackListedMailPrefix.$addressSet['EMail'];
                    }
                }
            }
        }

        return parent::normalizeOrder($aOrder);
    }

    /**
     * E-Mail to Buyer (Overwrite function because of blacklisted email feature)
     *
     * @param array $aOrder
     * @param null $oOrder
     * @return bool|mixed
     */
    protected function sendPromotionMail($aOrder, $oOrder = null) {
        // check for "blacklisted-" prefix in email address
        $sBlacklistEmails = MLModule::gi()->getConfig('orderimport.blacklisting');
        if (isset($sBlacklistEmails) && $sBlacklistEmails === '1') { // in case of emails are blacklisted, remove prefix (0 = not blacklist, 1 = blacklisted mail)
            if (!empty($aOrder['AddressSets']['Main']['EMail'])
                && (substr($aOrder['AddressSets']['Main']['EMail'], 0, strlen($this->sBlackListedMailPrefix)) == $this->sBlackListedMailPrefix)
            ) {
                $aOrder['AddressSets']['Main']['EMail'] = substr($aOrder['AddressSets']['Main']['EMail'], strlen($this->sBlackListedMailPrefix));
            }
        }
        return parent::sendPromotionMail($aOrder, $oOrder);
    }

}
