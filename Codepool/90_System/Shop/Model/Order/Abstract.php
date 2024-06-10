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

MLFilesystem::gi()->loadClass('Database_Model_Table_Order');

/**
 * Implements some generic methods that can be shared between various shopsystems for the
 * Order Model.
 */
abstract class ML_Shop_Model_Order_Abstract extends ML_Database_Model_Table_Order {
    /**
     * @var ML_Modul_Model_Modul_Abstract $oModul
     */
    protected $oModul = null;
    protected $oShop = null;
    protected $oProduct = null;
    protected $oPrice = null;

    /**
     * Initializes the order model and loads all needed resources.
     *
     * @param bool $blForce
     *    Forces something
     * @return self
     */
    public function init($blForce = false) {
        parent::init($blForce);

        $this->oShop = MLShop::gi();
        $this->oProduct = MLProduct::factory();
        $this->oPrice = MLPrice::factory();
        return $this;
    }

    /**
     * Loads the order module and returns it (registry like behaviour).
     * @return ML_Modul_Model_Modul_Abstract
     * @deprecated was it only use for orderlogo?
     */
    public function getModul() {
        if ($this->oModul === null) {
            try {
                $this->oModul = MLModule::gi();
            } catch (Exception $oEx) {

            }
        }
        return $this->oModul;
    }

    /**
     * Creates order and manipulates $aData
     * eg. $aData['AddressSets']['Main']['Password'] if possible
     *
     * @param array $aData
     * @return array
     * @see /Doku/orderexport.json
     */
    abstract public function shopOrderByMagnaOrderData($aData);

    /**
     * will be triggered after $this->shopOrderByMagnaOrderData and $this->save(with orderdata)
     * @return \ML_Shop_Model_Order_Abstract
     */
    public function triggerAfterShopOrderByMagnaOrderData() {
        return $this;
    }

    /**
     * Gets the translation of the order status from this order.
     *
     * @return string
     */
    abstract public function getShopOrderStatusName();

    /**
     * @deprecated this function doesn't have any use, so deprecated
     * @return string
     *    A Timestamp with the format YYYY-mm-dd
     */
    abstract public function getShippingDate();

    /**
     * Get the carrier for this order.
     * If there is no carrier information available for this order
     * this method will return the setting orderstatus.carrier.default.
     *
     * @return string
     *    The shipping carrier
     */
    abstract public function getShippingCarrier();

    /**
     * Prestashop orders have carrier.
     * Shopware, WooCommerce orders have shipping method.
     * Magento and Shopify orders have both of shipping method and carrier.
     * If carrier is available this function return carrier of the order and if not it return shipping method of the order
     * @return string|null
     */
    public function getShopOrderCarrierOrShippingMethod() {
        return $this->getShippingCarrier();
    }

    /**
     * In Prestashop, Shopware, and WooCommerce carrier id is different from carrier name
     * @return string|null
     */
    public function getShopOrderCarrierOrShippingMethodId() {
        return $this->getShopOrderCarrierOrShippingMethod();
    }

    /**
     * Get time when the order is shipped
     * @return string
     *    A Timestamp with the format Y-m-d H:i:s
     */
    abstract public function getShippingDateTime();

    /**
     * Gets the tracking code for this order.
     * If there is no tracking code available the setting
     * orderstatus.carrier.additional will be
     * returned (which does not make any sense.
     * An empty string should be returned instead.)
     *
     * @return string
     */
    abstract public function getShippingTrackingCode();

    /**
     * Returns a link to the order detail page if possible.
     *
     * @return string
     */
    abstract public function getEditLink();

    /**
     * Gets list of ML_Shop_Model_Order_Abstract for current marketplace which are
     * not synchronized (shop.status != magnalister.status)
     * @param int $iOffset
     * @param bool $blCount
     * @return array array(shop.orders_id, ..)
     *     array(shop.orders_id, ..)
     * @throws Exception
     */
    public static function getOutOfSyncOrdersArray($iOffset = 0, $blCount = false) {
        throw new Exception ("Method '".__METHOD__."' is not implemented.");
    }

    /**
     * Gets the "last modified" timestamp of this order.
     *
     * @return string
     *    Timestamp with the format YYYY-mm-dd h:i:s
     */
    abstract public function getShopOrderLastChangedDate();

    /**
     * Gets the order status from this order.
     *
     * @return string be careful about return value , if the status is id , you should convert it to string , otherwise there could be some problem in coparision with config data
     */
    abstract public function getShopOrderStatus();

    /**
     * Gets an order model instance by the marketplace specific order id.
     *
     * @param string $sId
     * @return ML_Shop_Model_Order_Abstract
     */
    public function getByMagnaOrderId($sId) {
        $oSelect = MLDatabase::factorySelectClass();
        $aData = $oSelect->from($this->sTableName)->where(array('data', 'like', "%\"$sId\"%"))->getResult();
        if (!empty($aData)) {
            $aData = array_shift($aData);
            $this->blLoaded = true;
            foreach ($aData as $sKey => $sValue) {
                $this->__set($sKey, $sValue);
                $this->aOrginData[strtolower($sKey)] = $sValue;
            }
        } else { //prevent table_abstract exception to show "keys are not filled" if no order found
            $this->init(true)->set('special', $sId)->aKeys = array('special');
        }
        return $this;
    }

    /**
     * Returns the logo (path) of the platform from this order.
     *
     * @return string
     * @throws Exception
     */
    public function getLogo() {
        if ($this->get('platform') !== null) {
            if ($this->get('logo') !== null) {
                $sLogo = $this->get('logo');
            } else {
                $sOrderLogoClass = 'ML_'.ucfirst($this->get('platform')).'_Model_OrderLogo';
                if (class_exists($sOrderLogoClass, false)) {
                    $oOrderLogo = new $sOrderLogoClass;
                    $sLogo = $oOrderLogo->getLogo($this);
                    $this->set('logo', $sLogo)->save();
                } else {
                    return null;
                }
            }
            return MLHttp::gi()->getResourceUrl('images/logos/'.$sLogo, true);
        } else {
            return null;
        }
    }

    /**
     * send specific field in order Acknowledge
     * @param array $aOrderParameters
     * @param array $aOrder
     */
    abstract public function setSpecificAcknowledgeField(&$aOrderParameters, $aOrder);

    /**
     * @return string
     * @throws Exception
     */
    public function getTitle() {
        return '<div style="color: #000000;font: bold 14px sans-serif;">
            <span style="color:#dc043d;" >m</span>agnalister Details
            <img style="vertical-align: middle;" src="'.$this->getLogo().'" alt="">
            </div>';
    }

    /**
     * @param $sSubsystem
     * @param $iMpId
     * @param $iMorderID
     * @param $iShopOrderID
     * @param bool $blSentApiRequest
     * @return bool
     * @throws MagnaException
     */
    public static function unAcknowledgeImportedOrder($sSubsystem, $iMpId, $iMorderID, $iShopOrderID, $blSentApiRequest = true) {
        if ($blSentApiRequest) {
            try {

                MagnaConnector::gi()->submitRequest(array(
                    'ACTION'        => 'UnAcknowledgeImportedOrders',
                    'SUBSYSTEM'     => $sSubsystem,
                    'MARKETPLACEID' => $iMpId,
                    'DATA'          => array(
                        array(
                            'MOrderID'    => $iMorderID,
                            'ShopOrderID' => $iShopOrderID,
                        )
                    )
                ));
            } catch (\MagnaException $ex) {
                MLMessage::gi()->addDebug($ex);
            }
        }
        MLDatabase::getDbInstance()->delete('magnalister_orders', array('orders_id' => $iShopOrderID));
        return true;
    }

    public function getShopOrderId() {
        return $this->get('orders_id');
    }
    public function getShopAlternativeOrderId() {
        return $this->get('current_orders_id');
    }

    public function getMarketplaceOrderId() {
        return $this->get('special');
    }

    abstract public function getShopOrderTotalAmount();

    abstract public function getShopOrderTotalTax();

    /**
     * @return string base64 encoded string of pdf file
     */
    public function getShopOrderInvoice($sType) {
        return '';
    }

    public function getShopOrderInvoiceNumber($sType) {
        return '';
    }

    public function getInvoiceNumber($sType) {
        $sInvoiceNumber = '';
        $sConfigKeyPrefix = $this->isInvoiceDocumentType($sType) ? '' : 'reversal';
        if (MLModule::gi()->getConfig('amazonvcs.invoice') === 'magna' && MLModule::gi()->getConfig('amazonvcsinvoice.'.$sConfigKeyPrefix.'invoicenumberoption') === 'matching') {
            $sInvoiceNumber = $this->getAttributeValue(MLModule::gi()->getConfig('amazonvcsinvoice.'.$sConfigKeyPrefix.'invoicenumber.matching'));
        } else if (MLModule::gi()->getConfig('invoice.option') === 'magna' && MLModule::gi()->getConfig('invoice.'.$sConfigKeyPrefix.'invoicenumberoption') === 'matching') {
            $sInvoiceNumber = $this->getAttributeValue(MLModule::gi()->getConfig('invoice.'.$sConfigKeyPrefix.'invoicenumber.matching'));
        } else {
            $sInvoiceNumber = $this->getShopOrderInvoiceNumber($sType);
        }
        return $sInvoiceNumber;
    }

    /**
     *
     * @param $sKey
     * @return mixed|null
     */
    public function getAdditionalOrderField($sKey) {
        $aData = $this->get('shopAdditionalOrderField');
        if (is_array($aData) && !empty($aData[$sKey])) {
            return $aData[$sKey];
        } else {
            return null;
        }

    }

    /**
     * @return bool
     */
    public function onlyFirstTrackingCode() {
        $blOnlyFirst = true;
        try {
            $blOnlyFirst = MLModule::gi()->submitFirstTrackingNumber();
        } catch (\Exception $ex) {
            //here no marketplace is loaded
        }
        return $blOnlyFirst;
    }

    /**
     * @param $sType
     * @return bool
     */
    protected function isInvoiceDocumentType($sType) {
        return in_array($sType, array('SHIPMENT', 'Invoice'), true);
    }

    /**
     * @param $sType
     * @return bool
     */
    protected function isCreditNoteDocumentType($sType) {
        return in_array($sType, array('RETURN', 'REFUND', 'Reversal'), true);
    }

    /**
     * @return array|mixed|null
     */
    protected function getMarketplaceDefaultCarrier() {
        $sDefaultCarrier = MLModule::gi()->getConfig('orderstatus.carrier.default');
        $sDefaultCarrier = $sDefaultCarrier === null ? MLModule::gi()->getConfig('orderstatus.carrier') : $sDefaultCarrier;
        return $sDefaultCarrier;
    }

    protected function getDefaultCarrier() {
        $sDefaultCarrier = MLModule::gi()->getConfig('orderstatus.carrier.default');
        $sDefaultCarrier = $sDefaultCarrier === null ? MLModule::gi()->getConfig('orderstatus.carrier') : $sDefaultCarrier;
        return $sDefaultCarrier;
    }

    /**
     * Return a formatted array of product data
     *
     * @return array[]
     * @throws Exception
     */
    abstract public function getShopOrderProducts();

    public function getOrderIdForAcknowledge() {
        return $this->get('orders_id');
    }

}
