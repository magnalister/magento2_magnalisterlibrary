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


use Magento\Framework\App\ResourceConnection;

MLFilesystem::gi()->loadClass('Shop_Helper_Model_ShopOrder_Abstract');

class ML_Magento2_Helper_Model_ShopOrder extends ML_Shop_Helper_Model_ShopOrder_Abstract {

    /**
     * By updating an order or merging new order with an imported order this object will be set
     * @var  $oExistingOrder \Magento\Sales\Model\Order
     */
    protected $oExistingOrder = null;

    /**
     * Object of current order that is by creating or updating
     * @var \Magento\Sales\Model\Order $oCurrentShopOrder
     */
    protected $oCurrentShopOrder = null;

    /** @var ML_Magento2_Model_Order|null */
    protected $oOrder = null;

    /** @var float */
    protected $fTotalAmount = 0.00;

    /** @var float */
    protected $fTotalAmountNet = 0.00;

    /** @var float */
    protected $fTotalAmountTax = 0.00;

    /** @var float */
    protected $fTotalProductAmount = 0.00;

    /** @var float */
    protected $fTotalProductAmountNet = 0.00;

    /** @var float */
    protected $fTotalDiscountAmount = 0.00;

    /** @var float */
    protected $fMaxProductTax;

    /** @var ML_Shop_Model_Price_Interface|ML_Prestashop_Model_Price|null */
    protected $oPrice = null;

    /** @var array */
    protected $aOrderPorducts = [];

    /**
     *
     */
    public function __construct() {
        $this->oPrice = MLPrice::factory();
    }

    /**
     * Set order object in initializing the order helper
     *
     * @param ML_Magento2_Model_Order $oOrder
     * @return ML_Magento2_Helper_Model_ShopOrder
     * @throws Exception
     */
    public function setOrder($oOrder) {
        $this->fTotalAmount = 0.00;
        $this->fTotalAmountNet = 0.00;
        $this->fMaxProductTax = 0.00;
        $this->blNewAddress = true;
        $this->oOrder = $oOrder;
        $this->oExistingOrder = null;
        $this->oCurrentShopOrder = null;
        if ($this->oOrder->exists() && $this->oOrder->existsInShop()) {
            $this->oCurrentShopOrder = $this->oExistingOrder = $oOrder->getShopOrderObject();
        }
        $this->aExistingOrderData = $oOrder->get('orderdata');
        return $this;
    }

    /**
     * initializing order import and update
     * @return array
     * @throws Exception
     */
    public function shopOrder(): array {
        if ($this->aExistingOrderData === null || count($this->aExistingOrderData) == 0) {
            $aReturnData = $this->createUpdateOrder();
        } elseif (!is_object($this->oExistingOrder)) {// if order doesn't exist in shop  we create new order
            $this->aNewData = MLHelper::gi('model_service_orderdata_merge')->mergeServiceOrderData($this->aNewData, $this->aExistingOrderData, $this->oOrder);
            $aReturnData = $this->createUpdateOrder();
        } else {//update order if exist
            if ($this->checkForUpdate()) {
                $this->aNewData = MLHelper::gi('model_service_orderdata_merge')->mergeServiceOrderData($this->aNewData, $this->aExistingOrderData, $this->oOrder);
                $this->updateOrder();
                $aReturnData = $this->aNewData;
            } else {
                $this->aNewData = MLHelper::gi('model_service_orderdata_merge')->mergeServiceOrderData($this->aNewData, $this->aExistingOrderData, $this->oOrder);
                $aReturnData = $this->createUpdateOrder();
            }
        }
        return $aReturnData;
    }

    /**
     * Only if shipping method name or payment method name or order status or addresses are changed
     *
     * @return \Magento\Sales\Model\Order
     * @throws Exception
     */
    public function updateOrder(): \Magento\Sales\Model\Order {
        $oShopOrder = $this->oOrder->getShopOrderObject();
        $oPayment = $this->getPaymentMethod();
        $shippingMethod = $this->getShippingMethod();
        $orderStatus = $this->aNewData['Order']['Status'];
        $orderState = $this->getOrderState($orderStatus);
        $aBillingAddress = $this->getAddress($this->aNewData['AddressSets']['Billing']);
        $aShippingAddress = $this->getAddress($this->aNewData['AddressSets']['Shipping']);


        $oShopOrder->setPayment($oPayment);
        $oShopOrder->setShippingDescription($shippingMethod['name']);
        $oShopOrder->setShippingMethod($shippingMethod['code']);
        $oShopOrder->setStatus($orderStatus);
        if (isset($orderState)) {
            $oShopOrder->setState($orderState);
        }
        $oShopOrder->setBillingAddress($aBillingAddress);
        $oShopOrder->setShippingAddress($aShippingAddress);

        if($this->aNewData['Order']['Payed']){
            $this->createInvoice($this->oCurrentShopOrder);
        }

        if($this->aNewData['Order']['Shipped']){
            $this->createShipping($this->oCurrentShopOrder);
        }

        $orderRepository = MLMagento2Alias::CreateObjectManagerProvider('Magento\Sales\Api\OrderRepositoryInterface');
        $orderRepository->save($oShopOrder);


        return $oShopOrder;
    }

    /**
     * create a new order by magnalister order data
     * @return array
     * @throws Exception
     */
    public function createUpdateOrder() {
        try {
            $storeID = $this->getStoreId();
            $aData = $this->aNewData;
            $aAddresses = $aData['AddressSets'];

            if (empty($aAddresses['Main'])) {// add new order when Main address is filled
                throw new Exception('main address is empty');
            }

            if (count($aData['Products']) <= 0) {// add new order when order has any product
                throw new Exception('product is empty');
            }
            $oStore = $this->getMagentoStore();
            $shopCurrencies = $oStore->getAvailableCurrencyCodes(true);
            $currencyRate = $oStore->getBaseCurrency()->getRate($aData['Order']['Currency']);
            // check if currencies the rates for the currencies as well
            if (!in_array($aData['Order']['Currency'], $shopCurrencies) || !$currencyRate) {
                $sMessage = MLI18n::gi()->get('Orderimport_CurrencyCodeDontExistsError', array(
                        'mpOrderId' => MLSetting::gi()->get('sCurrentOrderImportMarketplaceOrderId'),
                        'ISO'       => $aData['Order']['Currency']
                    )
                );
                MLErrorLog::gi()->addError(0, ' ', $sMessage, array('MOrderID' => MLSetting::gi()->get('sCurrentOrderImportMarketplaceOrderId')));
                throw new Exception($sMessage);
            }

            $oBaseCurrency = $oStore->getBaseCurrency();
            $oDefaultCurrency = $oStore->getDefaultCurrency();

            //show  in order detail
            $sInternalComment = isset($aData['MPSpecific']['InternalComment']) ? $aData['MPSpecific']['InternalComment'] : '';
            $sCustomerComment = isset($aData['Order']['Comments']) ? $aData['Order']['Comments'] : '';

            //show in order detail and invoice pdf
            $sPaymentInfo = '';
            if (MLModule::gi()->getConfig('order.information')) {
                $sPaymentInfo= isset($aData['MPSpecific']['InternalComment']) ? $aData['MPSpecific']['InternalComment'] : '';
            }


            $shippingMethod = $this->getShippingMethod();
            $oPayment = $this->getPaymentMethod($sPaymentInfo);
            $aBillingAddress = $this->getAddress($aData['AddressSets']['Billing']);
            $aShippingAddress = $this->getAddress($aData['AddressSets']['Shipping']);
            $createCustomer = $customerGroupId = MLModule::gi()->getConfig('customergroup');
            $orderStatus = $aData['Order']['Status'];
            $orderState = $this->getOrderState($orderStatus);
            //think this is not needed since we set the tax on product level and shipment
//            $fMaxTaxRate = $this->getTaxRate();
            $oCustomer = $this->getCustomer($createCustomer);


            if ($this->oCurrentShopOrder === null) {
                $this->oCurrentShopOrder = MLMagento2Alias::CreateObjectManagerProvider('\Magento\Sales\Model\Order');
            }
            $this->oCurrentShopOrder->setStoreId($storeID);
            $this->oCurrentShopOrder->setStatus($orderStatus);
            if (isset($orderState)) {
                $this->oCurrentShopOrder->setState($orderState);
            }

            // possible setShippingDescription
            $this->oCurrentShopOrder->setPayment($oPayment);

            $this->oCurrentShopOrder->setExtOrderId($aData['MPSpecific']['MOrderID']);
            $this->oCurrentShopOrder->setBaseCurrencyCode($oBaseCurrency->getCode());       // base - currency which is set for current website.
            $this->oCurrentShopOrder->setGlobalCurrencyCode($oDefaultCurrency->getCode());  // default - currency which is set for default in backend
            $this->oCurrentShopOrder->setOrderCurrencyCode($aData['Order']['Currency']);   // order - currency which was selected by customer
            $this->oCurrentShopOrder->setStoreCurrencyCode($oBaseCurrency->getCode());     // store - all the time it was currency of website
            $this->oCurrentShopOrder->setBaseToGlobalRate((float)$oBaseCurrency->getRate($oDefaultCurrency->getCode()));
            $this->oCurrentShopOrder->setBaseToOrderRate((float)$oBaseCurrency->getRate($aData['Order']['Currency']));
            $this->oCurrentShopOrder->setStoreToBaseRate((float)$oBaseCurrency->getRate($oDefaultCurrency->getCode()));
            $this->oCurrentShopOrder->setStoreToOrderRate((float)$oBaseCurrency->getRate($aData['Order']['Currency']));

            $aLineItems = $this->addProductsAndTotals();
            if ($this->fTotalDiscountAmount < 0.00) {
                $this->oCurrentShopOrder->setDiscountAmount($this->fTotalDiscountAmount);
            }

            if($this->oCurrentShopOrder->canComment()) {
                if (!empty($sInternalComment)) {
                    $this->oCurrentShopOrder->addCommentToStatusHistory($sInternalComment);
                }

                if (!empty($sCustomerComment)) {
                    $this->oCurrentShopOrder->addCommentToStatusHistory($sCustomerComment);
                }
            }
            if ($createCustomer) {
                $this->oCurrentShopOrder->setCustomerId($oCustomer->getId());
                $this->oCurrentShopOrder->setCustomerIsGuest(false);
            } else {
                $this->oCurrentShopOrder->setCustomerIsGuest(true);
            }


            $this->oCurrentShopOrder->setBillingAddress($aBillingAddress);
            $this->oCurrentShopOrder->setShippingAddress($aShippingAddress);
            $this->oCurrentShopOrder->setCustomerEmail($oCustomer->getEmail());
            $this->oCurrentShopOrder->setCustomerFirstname($oCustomer->getFirstname());
            $this->oCurrentShopOrder->setCustomerLastname($oCustomer->getLastname());
            $this->oCurrentShopOrder->setCustomerPrefix($oCustomer->getPrefix());
            $this->oCurrentShopOrder->setCustomerGroupId($customerGroupId);

            foreach ($aLineItems as $aLineItem){
                $this->oCurrentShopOrder->addItem($aLineItem);
            }
            $aShippingCost = $this->getShippingCost();
            $this->oCurrentShopOrder->setShippingDescription($shippingMethod['name']);
            $this->oCurrentShopOrder->setShippingMethod($shippingMethod['code']);
            $this->oCurrentShopOrder->setShippingAmount($aShippingCost['shippingAmount']);
            $this->oCurrentShopOrder->setShippingInclTax($aShippingCost['shippingInclTax']);
            $this->oCurrentShopOrder->setShippingTaxAmount($aShippingCost['shippingTaxAmount']);
            // adding order shipping prices for the base currency
            $this->setBaseValues($this->oCurrentShopOrder, array('ShippingAmount', 'ShippingTaxAmount', 'ShippingInclTax'));
            $this->oCurrentShopOrder->setGrandTotal($this->fTotalAmount);
            $this->oCurrentShopOrder->setSubtotal($this->fTotalProductAmountNet);
            $this->oCurrentShopOrder->setSubtotalInclTax($this->fTotalProductAmount);
            $this->oCurrentShopOrder->setTaxAmount($this->fTotalAmountTax);
            // adding order total prices for the base currency
            $this->setBaseValues($this->oCurrentShopOrder, array('Subtotal', 'SubtotalInclTax', 'GrandTotal', 'TaxAmount'));
            $oTransaction = MLMagento2Alias::CreateObjectManagerProvider('\Magento\Framework\DB\Transaction');
            $oTransaction->addObject($this->oCurrentShopOrder);
            $oTransaction->addCommitCallback(array($this->oCurrentShopOrder, 'place'));
            $oTransaction->addCommitCallback(array($this->oCurrentShopOrder, 'save'));
            $oTransaction->save();
            if($aData['Order']['Payed']){
                $this->createInvoice($this->oCurrentShopOrder);
            }

            if($aData['Order']['Shipped']){
                $this->createShipping($this->oCurrentShopOrder);
            }

            $orderRepository = MLMagento2Alias::CreateObjectManagerProvider('Magento\Sales\Api\OrderRepositoryInterface');
            $orderRepository->save($this->oCurrentShopOrder);

            //Forcing "new" state to get all option such as "Create Invoices" , "Create Shipped" and ... in order detail of new order
            //Forcing Configured order status in magnalister->marketplaces->Order Import
            $orderId = $this->oCurrentShopOrder->getId();// get the new order id
            $order = MLMagento2Alias::CreateObjectManagerProvider('\Magento\Sales\Model\Order')->load($orderId);
            if (isset($orderState)) {
                $order->setState('new');// set the "new" state to get all option such as "Create Invoices" , "Create Shipped" and ... in order detail of new order
            }
            $order->setStatus($orderStatus);// set the configured status to the order
            $order->setCreatedAt($aData['Order']['DatePurchased']);// set Order Date as Purchase date
            $order->save();

            //adding new status comment history for order
            $orderHistoryStatus = MLMagento2Alias::CreateObjectManagerProvider('Magento\Sales\Model\Order\Status\HistoryFactory');
            $history = $orderHistoryStatus->create();
            $history->setParentId($orderId)
                ->setComment($sInternalComment)
                ->setEntityName('order')
                ->setStatus($orderStatus);//adding new magnalister status comment for status history
            $historyRepository = MLMagento2Alias::CreateObjectManagerProvider('\Magento\Sales\Api\OrderStatusHistoryRepositoryInterface');
            $historyRepository->save($history);

            $this->oOrder->set('orders_id', $this->oCurrentShopOrder->getId());//important to show order number in backoffice of magnalister
            $this->oOrder->set('current_orders_id', $this->oCurrentShopOrder->getId());

        } catch (\Exception $ex) {
            MLMessage::gi()->addDebug($ex);
            throw $ex;
        }
        return $aData;
    }

    /**
     * @param $oOrder
     * @return $this
     * @throws Exception
     */
    protected function createInvoice($oOrder){
        try {
            if (!$oOrder->canInvoice()) {
                throw new Magento\Framework\Exception\LocalizedException(__('Cannot create an invoice.'));
            }
            $orderService = MLMagento2Alias::CreateObjectManagerProvider('\Magento\Sales\Api\InvoiceManagementInterface');
            $oInvoice = $orderService->prepareInvoice($oOrder);

            if (!$oInvoice->getTotalQty()) {
                throw new Magento\Framework\Exception\LocalizedException(__('Cannot create an invoice without products.'));
            }
            $oInvoice->setRequestedCaptureCase(\Magento\Sales\Model\Order\Invoice::CAPTURE_ONLINE);
            $oInvoice->register();
            $oInvoice->save();
            $oTransaction = MLMagento2Alias::CreateObjectManagerProvider('\Magento\Framework\DB\Transaction');
            $oTransaction->addObject($oInvoice)
                ->addObject($oInvoice->getOrder())
                ->save();
            $oTransaction->save();
        } catch (Exception $oEx) {
            MLLog::gi()->add(MLSetting::gi()->get('sCurrentOrderImportLogFileName'), array(
                'MOrderId' => MLSetting::gi()->get('sCurrentOrderImportMarketplaceOrderId'),
                'PHP' => get_class($this).'::'.__METHOD__.'('.__LINE__.')',
                'Exception' => array(
                    'class' => get_class($oEx),
                    'message' => $oEx->getMessage(),
                ),
            ));
        }
        return $this;
    }

    /**
     * @param $oOrder
     * @return $this
     * @throws Exception
     */
    protected function createShipping($oOrder){
        try {
            if (!$oOrder->canShip()) {
                throw new Magento\Framework\Exception\LocalizedException(__('Can not create the Shipment.'));
            }
            // Initializzing Object for the order shipment
            $convertOrder = MLMagento2Alias::CreateObjectManagerProvider('Magento\Sales\Model\Convert\Order');
            $oShipment = $convertOrder->toShipment($oOrder);

            // Looping the Order Items
            foreach ($oOrder->getAllItems() as $orderItem) {

                // Check if the order item has Quantity to ship or is virtual
                if (!$orderItem->getQtyToShip() || $orderItem->getIsVirtual()) {
                    continue;
                }
                $qtyShipped = $orderItem->getQtyToShip();

                // Create Shipment Item with Quantity
                $shipmentItem = $convertOrder->itemToShipmentItem($orderItem)->setQty($qtyShipped);

                // Add Shipment Item to Shipment
                $oShipment->addItem($shipmentItem);
            }

            // Register Shipment
            $oShipment->register();
            $oShipment->getOrder()->setIsInProcess(true);

            // Save created Shipment and Order
            $oShipment->save();
            $oShipment->getOrder()->save();
        } catch (Exception $oEx) {
            MLLog::gi()->add(MLSetting::gi()->get('sCurrentOrderImportLogFileName'), array(
                'MOrderId' => MLSetting::gi()->get('sCurrentOrderImportMarketplaceOrderId'),
                'PHP' => get_class($this).'::'.__METHOD__.'('.__LINE__.')',
                'Exception' => array(
                    'class' => get_class($oEx),
                    'message' => $oEx->getMessage(),
                ),
            ));
        }
        return $this;
    }

    /**
     * @return array
     * @throws Exception
     */
    protected function getShippingCost() {
        $fMaxTaxRate = $this->getTaxRate(true);
        $fShippingCostGross = (float)$this->getTotal('Shipping')['Value'];
        $fShippingCostNet = $this->oPrice->calcPercentages($fShippingCostGross, null, $fMaxTaxRate);
        $this->addTotalAmount($fShippingCostGross, $fShippingCostNet);

        return array(
            'shippingTaxAmount' => $fShippingCostGross - $fShippingCostNet,
            'shippingInclTax' => $fShippingCostGross,
            'shippingAmount' => $fShippingCostNet
        );
    }

    /**
     * @return string
     * @throws Exception
     */
    protected function getExistingDeliveryId(): string {
        if ($this->oExistingOrder === null) {
            throw new Exception('Use this function only for merging and updating order');
        }
        $aExistingDelivery = MLMagento2Alias::getRepository('order_delivery')->search((new Criteria())
            ->addFilter(new EqualsFilter('orderId', $this->oExistingOrder->getId())), Context::createDefaultContext())
            ->getEntities()->first();
        return $aExistingDelivery->getId();
    }

    /**
     * This function is only implemented to prevent errors for duplicated of code
     * @throws Exception
     */
    protected function addProductsAndTotals(): array {
        $fOtherAmount = $this->fTotalAmount;
        $fOtherAmountNet = $this->fTotalAmountNet;
//        $this->oTotalTaxRuleCollection = new TaxRuleCollection();

        $this->aOrderPorducts = $this->getProductArray($this->aNewData['Products']);
        $aTotalProducts = [];
        // add orders totals
        foreach ($this->aNewData['Totals'] as &$aTotal) {
            switch ($aTotal['Type']) {
                case 'Shipping':
                {
                    //it is already managed in caller functions
                    break;
                }
                case 'Payment':
                default:
                {
                    if ((float)$aTotal['Value'] !== 0.0) {
                        $aTotalProducts[] = [
                            'SKU'        => $aTotal['SKU'] ?? '',
                            'ItemTitle'  => (isset($aTotal['Code']) && $aTotal['Code'] !== '') ? $aTotal['Code'] : $aTotal['Type'],
                            'Quantity'   => 1,
                            'Price'      => $aTotal['Value'],
                            'Tax'        => array_key_exists('Tax', $aTotal) ? $aTotal['Tax'] : false,
                            'ForceMPTax' => false
                        ];

                    }
                    break;
                }
            }
        }
        $aAllItems = array_merge($this->getProductArray($aTotalProducts), $this->aOrderPorducts);
        $this->fTotalProductAmount = $this->fTotalAmount - $fOtherAmount;
        $this->fTotalProductAmountNet = $this->fTotalAmountNet - $fOtherAmountNet;
        return $aAllItems;
    }

    /**
     * @param $aProducts
     * @return array
     * @throws Exception
     */
    protected function getProductArray($aProducts) {
        $aItems = [];
        $storeID = $this->getStoreId();
        $aExistingProducts = [];
        if ($this->oExistingOrder !== null) {
            $aExistingProducts = $this->oExistingOrder->getAllItems();
        }
        // $aProducts during update orders on eBay is an array of merged products
        // that are already added on the order and new products
        foreach ($aProducts as $aProduct) {
            $sSKU = $aProduct['SKU'] ?? '';
            $oProduct = MLMagento2Alias::getProductModel()->getByMarketplaceSKU($sSKU);

            $blFound = false;
            $iProductQuantity = (int)$aProduct['Quantity'];
            $fProductPrice = (float)$aProduct['Price'];

            if ($this->oExistingOrder !== null) {
                if (count($aExistingProducts) > 0) {
                    foreach ($aExistingProducts as $key => $item) {
                        // we check if the product is found in shop if the product has exactly the same quantity and price
                        // we do this because we do not want to duplicate the product in case we update order on eBay
                        if ((integer)$item->getQtyOrdered() === $iProductQuantity && ((float)$item->getPriceInclTax() === $fProductPrice)) {
                            if (trim($aProduct) === '' && $item->getName() === $aProduct['ItemTitle']) {//in ebay sku could be empty
                                $blFound = true;
                            } else if (trim($sSKU) !== '') {
                                $shopSKU = $item->getSku();
                                if (isset($shopSKU)) {
                                    if ($shopSKU === $sSKU) {
                                        $blFound = true;
                                    } else {
                                        // perhaps sku have changed or wrong key type of total?
                                        if ($oProduct->exists() && $oProduct->getSku() === $shopSKU) {
                                            $blFound = true;
                                        }
                                    }
                                }
                            }
                        }

                        if ($blFound) {
                            unset($aExistingProducts[$key]);
                            break;
                        }
                    }
                }
            }

            /** @var \Magento\Sales\Model\Order\Item $oOrderItem */
            $oOrderItem = MLMagento2Alias::CreateObjectManagerProvider('\Magento\Sales\Model\Order\Item');
            $oChildOrderItem = null;
            $oOrderItem->setStoreId($storeID)
                ->setQuoteItemId(0)
                ->setQuoteParentItemId(NULL)
                ->setQtyBackordered(NULL)
                ->setName($aProduct['ItemTitle'])
                ->setQtyOrdered($aProduct['Quantity']);
            if (isset($aProduct['SKU'])) {
                $oOrderItem->setSku($aProduct['SKU']);
            }

            $mMarketplaceTax = ($aProduct['Tax'] !== false && array_key_exists('ForceMPTax', $aProduct) && $aProduct['ForceMPTax']) ? (float)$aProduct['Tax'] : null;
            if ($oProduct->exists()) {
                // Stock reduction is done by Magento 2 automatically after creating Shipment
                $oShopProduct = $oProduct->getCorrespondingProductEntity();
                $fProductTaxRate = isset($mMarketplaceTax) ? $mMarketplaceTax : $oProduct->getTax($this->aNewData['AddressSets']);

                // Stock reduction will be done based on magnalister configuration
                // we will not consider Stock management configuration in Magento 2
                if (isset($aProduct['StockSync']) && $aProduct['StockSync']) {
                    $oProduct->setStock($oProduct->getStock() - $aProduct['Quantity']);
                }

                $aWeight = $oProduct->getWeight();
                if (isset($aWeight['Value'])) {
                    $oOrderItem->setWeight($aWeight['Value']);
                }

                $dataObject = array(
                    'uenc' => base64_encode($oProduct->getFrontendLink()),
                    'qty' => $aProduct['Quantity'],
                    'product' => $oShopProduct->getId(),
                    'item' => $oShopProduct->getId(),
                    'selected_configurable_option' => '',
                    'related_product' => '',
                );
                if (
                    $oProduct->get('parentid') != 0
                    && $oProduct->get('ProductsId') != $oProduct->getParent()->get('ProductsId')
                ) {
                    //Product with variations
                    $oConfigModel = MLMagento2Alias::CreateObjectManagerProvider('\Magento\ConfigurableProduct\Model\Product\Type\Configurable');
                    $oParentProduct = $oProduct->getParent()->getCorrespondingProductEntity();
                    $oChildOrderItem = clone $oOrderItem;
                    $oChildOrderItem
                        ->setProductId($oShopProduct->getId())
                        ->setProductType($oShopProduct->getTypeId())
                        ->setSku($oShopProduct->getSku());

                    $oOrderItem->setProductId($oParentProduct->getId())
                        ->setProductType($oParentProduct->getTypeId());

                    $aConfigurableAttributes = $oConfigModel->getConfigurableAttributesAsArray($oParentProduct);
                    $dataObject['product'] = $dataObject['item'] = $oParentProduct->getId();
                    $supperAttributes = array();
                    foreach ($aConfigurableAttributes as $configurableAttribute) {
                        $supperAttributes[$configurableAttribute['attribute_id']] = $oShopProduct->getData($configurableAttribute['attribute_code']);
                    }
                    $dataObject['super_attribute'] = $supperAttributes;
                    $buyRequest = new \Magento\Framework\DataObject($dataObject);
                    $oConfigModel->prepareForCart($buyRequest, $oParentProduct);
                    $oConfigModel->prepareForCart($buyRequest, $oShopProduct);

                    $aParentProductOptions = $oConfigModel->getOrderOptions($oParentProduct);
                    $aChildProductOptions = $oConfigModel->getOrderOptions($oShopProduct);
                    $oChildOrderItem->setProductOptions($aChildProductOptions);
                    $oOrderItem->setProductOptions($aParentProductOptions);
                    $this->oCurrentShopOrder->addItem($oOrderItem);
                    $oChildOrderItem->setParentItem($oOrderItem);
                } else {
                    //Simple product

                    //get the object product if it is a product with simple type
                    $oProductModel = MLMagento2Alias::CreateObjectManagerProvider('Magento\Catalog\Model\Product\Type\Simple');
                    if ($oShopProduct->getTypeId() === 'downloadable') {
                        //get the object product if it is a product with virtual(downloadable) type
                        $oProductModel = MLMagento2Alias::CreateObjectManagerProvider('Magento\Downloadable\Model\Product\Type');
                    }
                    $buyRequest = new \Magento\Framework\DataObject($dataObject);
                    $oProductModel->prepareForCart($buyRequest, $oShopProduct);
                    $aProductOptions = $oProductModel->getOrderOptions($oShopProduct);

                    $oOrderItem->setProductOptions($aProductOptions);
                    $oOrderItem->setProductId($oShopProduct->getId())
                        ->setProductType($oShopProduct->getTypeId());
                }
            } else {
                $fProductTaxRate = isset($mMarketplaceTax) ? $mMarketplaceTax : $this->getTaxRate();
                $oOrderItem->setProductType('simple');
                $oOrderItem->setName($aProduct['ItemTitle']);
            }

            $price = $this->getProductPrice($fProductPrice, $iProductQuantity, $fProductTaxRate);
            // price for current currency
            // Net or gross price based on configuration
            $priceDisplayConfig = MLMagento2Alias::CreateObjectManagerProvider('\Magento\Framework\App\Config\ScopeConfigInterface');
            $priceDisplayValue =  $priceDisplayConfig->getValue('sectionid/groupid/fieldid', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            $fOriginalPrice = isset($priceDisplayValue) && $priceDisplayValue == 2 ? $price['grossPrice'] : $price['netPrice'];

            $oOrderItem->setOriginalPrice($fOriginalPrice)
                ->setTaxPercent($fProductTaxRate)
                ->setPrice($price['netPrice'])
                ->setPriceInclTax($price['grossPrice'])
                ->setTaxAmount(($price['grossPrice'] - $price['netPrice']) * $iProductQuantity)
                ->setRowTotal($price['netPrice'] * $iProductQuantity)
                ->setRowTotalInclTax($price['grossPrice'] * $iProductQuantity)
                ->setStoreId($storeID);

            // adding order item prices for the base currency
            $this->setBaseValues($oOrderItem, array('OriginalPrice', 'Price', 'PriceInclTax', 'TaxAmount', 'RowTotal', 'RowTotalInclTax'));
            // if the product is present in the order we do not want to duplicate it
            if (!$blFound) {
                $aItems[] = isset($oChildOrderItem) ? $oChildOrderItem : $oOrderItem;
            }
        }
        return $aItems;
    }

    /**
     * sets values for base currency by currency rate
     * @param object $oObject Magento 2 -Object
     * @param array $aMethods array of methods executes on $oObject
     * @return ML_Magento2_Helper_Model_ShopOrder
     */
    protected function setBaseValues($oObject, $aMethods) {
        $fBaseToOrderRate = $this->oCurrentShopOrder->getBaseToOrderRate();
        if (!empty($fBaseToOrderRate)) {// division by zero
            $iRate = 1 / $fBaseToOrderRate;
            foreach ($aMethods as $sMethod) {
                $oObject->{'setBase'.$sMethod}($iRate * $oObject->{'get'.$sMethod}());
            }
        }
        return $this;
    }

    /**
     * @param $fGrossAmount
     * @param $fNetAmount
     * @param $fGrossDiscountAmount
     * @return void
     */
    protected function addTotalAmount($fGrossAmount, $fNetAmount, $fGrossDiscountAmount = 0.00): void {
        $this->fTotalAmount += $fGrossAmount;
        $this->fTotalAmountNet += $fNetAmount;
        $this->fTotalAmountTax = $this->fTotalAmount - $this->fTotalAmountNet;
        $this->fTotalDiscountAmount += $fGrossDiscountAmount;
    }

    /**
     * @param boolean $getTotalsTax
     * @return float Rate
     * @throws Exception
     */
    protected function getTaxRate($getShippingTax = false): float {
        $fDefaultProductTax = 0.00;
        if ($getShippingTax && $this->oCurrentShopOrder !== null && $this->oCurrentShopOrder->getItemsCollection() !== null) {
            //getting max product tax for shipment
            foreach ($this->oCurrentShopOrder->getItemsCollection() as $item) {
                $this->fMaxProductTax = max($this->fMaxProductTax, $item->getTaxPercent());
            }
        } elseif (!empty($this->aOrderPorducts) && !$getShippingTax) {
            //getting max product tax for totals
            foreach ($this->aOrderPorducts as $oOrderProduct) {
                $this->fMaxProductTax = max($this->fMaxProductTax, $oOrderProduct->getTaxPercent());
            }
        } else {
            // fallback
            $fDefaultProductTax = $this->getFallbackTax();
        }
        return max((float)$fDefaultProductTax, $this->fMaxProductTax);

    }

    /**
     * @return array|mixed|null
     */
    protected function getFallbackTax() {
        $fDefaultProductTax = MLModule::gi()->getConfig('mwst.fallback');
        if ($fDefaultProductTax === null) {
            $fDefaultProductTax = MLModule::gi()->getConfig('mwstfallback'); // some modules have this, other that
        }
        return $fDefaultProductTax;
    }

    /**
     * Try to find customer in Magento 2 by email. If it doesn't exist, it creates new customer, at the end it returns customer id
     * @return Magento\Customer\Model\Backend\Customer\Interceptor|Magento\Customer\Model\Customer\Interceptor  new created or existing customer entity
     * @throws Exception
     * @see
     */
    protected function getCustomer($createCustomer) {
        $aAddress = $this->aNewData['AddressSets']['Main'];
        /** @var \Magento\Customer\Model\Data\Customer $oCustomer */
        $oCustomer = $this->findCustomerByEmail($aAddress['EMail']);

        if ($oCustomer->getId() == null) {
            $blNewCustomer = true;
            $defaultShippingId = null;
            $defaultBillingId = null;
        } else {
            $blNewCustomer = false;
            $defaultShippingId = $oCustomer->getDefaultShipping();
            $defaultBillingId = $oCustomer->getDefaultBilling();
        }

        $sGenderId = $this->getGenderId($aAddress['Gender']);
        $oDefaultShippingAddress = $this->getAddress($this->aNewData['AddressSets']['Shipping'], true, $defaultShippingId);
        $oDefaultBillingAddress = $this->getAddress($this->aNewData['AddressSets']['Billing'], true, $defaultBillingId);
        $sConfigCustomerGroup = $this->getCustomerGroup();

        // Validation and manipulation of address fields so data can be added into magento 2
        $this->validateAndModifyAddressFields($aAddress);

        $sError = '';
        try {

            if ($blNewCustomer) {
                $oCustomer = MLMagento2Alias::ObjectManagerProvider('\Magento\Customer\Model\CustomerFactory')->create();
                $oCustomer->isObjectNew(true);
            }

            $oStore = $this->getMagentoStore();
            $websiteId = $this->getMagentoStore()->getWebsiteId();

            $oCustomer->setWebsiteId($websiteId)
                ->setStore($oStore)
                ->setFirstname($aAddress['Firstname'])
                ->setDob($aAddress['DayOfBirth'])
                ->setLastname($aAddress['Lastname'])
                ->setPrefix($aAddress['Gender'] === 'f' ? 'Ms.' : 'Mr.')
                ->setGender($sGenderId)
                ->setMobile($aAddress['Phone'])
                ->setEmail($aAddress['EMail'])
                ->setGroupId($sConfigCustomerGroup);
            // password not set!!!
            if ($createCustomer) {
                $oCustomer->save();
                $oAddressRepository = MLMagento2Alias::CreateObjectManagerProvider('\Magento\Customer\Api\AddressRepositoryInterface');
                // set billing address
                $oDefaultBillingAddress->setIsDefaultBilling(true)->setCustomerId($oCustomer->getId());
                $oAddressRepository->save($oDefaultBillingAddress);


                // set shipping address
                $oDefaultShippingAddress->setIsDefaultShipping(true)->setCustomerId($oCustomer->getId());
                $oAddressRepository->save($oDefaultShippingAddress);
            }

        } catch (\Exception $ex) {
            $sError = $ex->getMessage();
        }
        if (
            (is_object($oCustomer) && $oCustomer->getId() != null) ||
            (!$createCustomer && is_object($oCustomer) && $oCustomer->getEmail() != null)
        ) {
            return $oCustomer;
        } else {
            throw new \Exception('Customer cannot be created: '.$sError);
        }

    }

    /**
     * @param $aAddress
     * @param $customerAddress
     * @param $addressId
     * @return mixed
     * @throws MLAbstract_Exception
     */
    protected function getAddress($aAddress, $customerAddress = false, $addressId = null) {
        $sCountryId = $this->getCountryId($aAddress['CountryCode']);
        $iRegionId = $this->getRegionId($aAddress['Suburb'], $sCountryId);
        $sCity = trim($aAddress['City']);
        if ($iRegionId === null) {
            if (!empty($aAddress['Suburb'])) {
                $sCity .= ' - '.trim($aAddress['Suburb']);
            }
        }

        // Validation and manipulation of address fields so data can be added into magento 2
        $this->validateAndModifyAddressFields($aAddress);

        $street = (isset($this->aNewData['MPSpecific']['DeliveryPackstation']['PackstationID']) ) ? array('Packstation ' . $this->aNewData['MPSpecific']['DeliveryPackstation']['PackstationID']) : array($aAddress['StreetAddress']);

        if ($customerAddress) {
            //customer address
            if (isset($addressId)) {
                // update address
                $oAddressRepository = MLMagento2Alias::CreateObjectManagerProvider('\Magento\Customer\Api\AddressRepositoryInterface');
                $address = $oAddressRepository->getById($addressId);
            } else {
                // create new address
                $address = MLMagento2Alias::ObjectManagerProvider('\Magento\Customer\Api\Data\AddressInterfaceFactory')->create();
            }
        } else {
            //order address
            $address = MLMagento2Alias::CreateObjectManagerProvider('\Magento\Sales\Model\Order\Address');
        }


        $address->setCompany($aAddress['Company'])
            ->setPrefix($aAddress['Gender'] === 'f' ? 'Ms.' : 'Mr.')
            ->setFirstname($aAddress['Firstname'])
            ->setLastname($aAddress['Lastname'])
            ->setTelephone($aAddress['Phone'])
            ->setStreet($street)
            ->setCity($sCity)
            ->setCountryId($sCountryId)
            ->setPostcode($aAddress['Postcode'])
            ->setRegionId($iRegionId);

        if (isset($aAddress['UstId'])) {
            $address->setVatId($aAddress['UstId']);
        }

        return $address;
    }

    /**
     * Gets the shipping methods from the configuration
     * @return array
     */
    protected function getShippingMethod(): array {
        $carrierName = '';
        foreach ($this->aNewData['Totals'] as $aTotal) {
            if ($aTotal['Type'] === 'Shipping' && isset($aTotal['Code'])) {
                $carrierName = $aTotal['Code'];
                break;
            }
        }
        $carrierCodeConfig = MLModule::gi()->getConfig('orderimport.shippingmethod');
        $storeID = $this->getStoreId();
        $activeShipping = MLMagento2Alias::CreateObjectManagerProvider('Magento\Shipping\Model\Config')
            ->getActiveCarriers($storeID);

        foreach ($activeShipping as $carrier) {
            $carrierCode = $carrier->getCarrierCode(). '_' .$carrier->getCarrierCode();
            if ($carrierCode == $carrierCodeConfig) {
                $carrierName = !empty($carrierName) ? $carrierName : $carrier->getConfigData('title');;
                break;
            }
        }
        return array('code' => $carrierCodeConfig, 'name' => $carrierName);
    }

    protected function getRegionId($sState, $sCountryId) {

        $countryCollectionFactory = $this->getCountryCollectionFactory();
        $country = $countryCollectionFactory
            ->addFieldToFilter('country_id', ['eq' => $sCountryId])
            ->load()
            ->getFirstItem();

        $region = $country->getRegionCollection()
            ->addRegionNameFilter($sState)
            ->load()
            ->getFirstItem();


       return $region->getId();
    }


    /**
     * @param $sGender === 'f' ? 'mrs' : 'mr'
     * @return mixed
     */
    protected function getGenderId($sGender) {
        $sGender = $sGender === 'f' ? 'Female' : 'Male';
        $attributeRepository = MLMagento2Alias::ObjectManagerProvider('Magento\Eav\Model\AttributeRepository');
        $genderId = $attributeRepository->get(Magento\Customer\Api\CustomerMetadataInterface::ENTITY_TYPE_CUSTOMER, Magento\Customer\Api\Data\CustomerInterface::GENDER)
            ->getSource()->getOptionId($sGender);
        return $genderId;
    }

    /**
     * @param $iCountryCode
     * @return mixed
     * @throws MLAbstract_Exception
     */
    protected function getCountryId($iCountryCode) {
        $sMlOrderId = MLSetting::gi()->get('sCurrentOrderImportMarketplaceOrderId');

        if (!empty($iCountryCode)) {
            $countryCollectionFactory = $this->getCountryCollectionFactory();
            // Get country collection size for given country code
            $collectionSize = $countryCollectionFactory
                ->addFieldToFilter('country_id', ['eq' => $iCountryCode])
                ->setPageSize(1)
                ->setCurPage(1)
                ->getSize();
            if (1 != $collectionSize) {
                $message = MLI18n::gi()->get('Magento2_Orderimport_CountryCodeDontExistsError', array('mpOrderId' => $sMlOrderId, 'ISO' => $iCountryCode));
                MLErrorLog::gi()->addError(0, ' ', $message, array('MOrderID' => $sMlOrderId));
                throw new Exception($message);
            }
        } else {
            $message = MLI18n::gi()->get('Magento2_Orderimport_CountryCodeIsEmptyError', array('mpOrderId' => $sMlOrderId));
            MLErrorLog::gi()->addError(0, ' ', $message, array('MOrderID' => $sMlOrderId));
            throw new Exception($message);
        }


        return $iCountryCode;
    }

    /**
     * Fatch based on configuration
     * @return string
     * @throws Exception
     */
    protected function getPaymentMethod($sPaymentInfo = '') {
        if($this->oExistingOrder !== null && !$this->oExistingOrder->getPayment()) {
            $payment = $this->oExistingOrder->getPayment();
        } else {
            $sPaymentId = MLModule::gi()->getConfig('orderimport.paymentmethod');
            if (empty($sPaymentId)) {
                $aPaymentMethodIds = MLFormHelper::getShopInstance()->getPaymentMethodValues();
                $sPaymentId = key($aPaymentMethodIds);
            }

            $payment = MLMagento2Alias::CreateObjectManagerProvider('\Magento\Sales\Model\Order\Payment');
            $payment->setMethod($sPaymentId);
            foreach ($this->aNewData['Totals'] as $aTotal) {
                if ($aTotal['Type'] === 'Payment' && isset($aTotal['Code'])) {
                    $sPaymentInfo = $sPaymentInfo . "\n" . $aTotal['Code'];
                    break;
                }
            }

            $aPayment = $this->getTotal('Payment');
            if(isset($aPayment['ExternalTransactionID']) && !empty($aPayment['ExternalTransactionID'])) {
                $sPaymentInfo = $sPaymentInfo . "\n" . $aPayment['ExternalTransactionID'];
            }

            if (!empty($sPaymentInfo)) {
                $payment->setAdditionalInformation('instructions', $sPaymentInfo);
            }
        }

        return $payment;
    }

    /**
     * Gets the magento store based on configuration value
     *
     * @return mixed
     */
    private function getMagentoStore() {
        $storeID = $this->getStoreId();
        $storeManager = MLMagento2Alias::ObjectManagerProvider('Magento\Store\Model\StoreManagerInterface');
        return $storeManager->getStore($storeID);
    }

    /**
     * Returns country collection factory
     *
     * @return mixed
     */
    private function getCountryCollectionFactory() {
        $storeID = $this->getStoreId();
        return MLMagento2Alias::ObjectManagerProvider('Magento\Directory\Model\ResourceModel\Country\CollectionFactory')->create()->loadByStore($storeID);
    }

    /**
     * Gets customer object based on email
     *
     * @param $email
     * @return mixed
     */
    protected function findCustomerByEmail($email) {
        $websiteId = $this->getMagentoStore()->getWebsiteId();
        $customerModel = MLMagento2Alias::CreateObjectManagerProvider('Magento\Customer\Model\Customer');
        $customerModel->setWebsiteId($websiteId);
        return $customerModel->loadByEmail($email);
    }

    /**
     * Returns the Magento 2 database connection
     *
     * @return Magento\Framework\App\ResourceConnection\Interceptor
     * @throws Exception
     */
    protected function getMagento2Db() {
        return MLMagento2Alias::CreateObjectManagerProvider('\Magento\Framework\App\ResourceConnection');
    }

    /**
     * @param string $orderStatus
     * @return null
     * @throws Exception
     */
    public function getOrderState(string $orderStatus) {
        $connection = $this->getMagento2Db();
        $tblSalesOrder = $connection->getTableName('sales_order_status_state');
        $orderState = $connection->getConnection(ResourceConnection::DEFAULT_CONNECTION)->fetchRow('SELECT state FROM `'.$tblSalesOrder.'` WHERE status="'.$orderStatus.'"');

        return isset($orderState['state']) ? $orderState['state'] : null;
    }

    /**
     * @param float $fProductPrice
     * @param int $iProductQuantity
     * @param float $fProductTaxRate
     * @return array
     * @throws Exception
     */
    protected function getProductPrice(float $fProductPrice, int $iProductQuantity, float $fProductTaxRate): array {
        $fProductDiscount = 0.00;
        $this->fMaxProductTax = max($this->fMaxProductTax, $fProductTaxRate);
        $fProductTotalPrice = $fProductPrice * $iProductQuantity;
        $fProductTotalPriceNet = $this->oPrice->calcPercentages($fProductTotalPrice, null, $fProductTaxRate);
        if($fProductTotalPrice < 0) {
            $fProductDiscount = $fProductTotalPrice;
        }
        $fProductPriceNet = $this->oPrice->calcPercentages($fProductPrice, null, $fProductTaxRate);
        $this->addTotalAmount($fProductTotalPrice, $fProductTotalPriceNet, $fProductDiscount);

        return array('grossPrice' => $fProductPrice, 'netPrice' => $fProductPriceNet);
    }

    protected function getStoreId() {
        return MLModule::gi()->getConfig('orderimport.shop');
    }

    /**
     * Validate Address fields of magento 2 and replace any invalid characters
     *
     * @param $aAddress
     * @return void
     */
    private function validateAndModifyAddressFields(&$aAddress) {
        if ($aAddress['Firstname'] === '') {
            $aAddress['Firstname'] = '--';
        }

        if ($aAddress['Lastname'] === '') {
            $aAddress['Lastname'] = '--';
        }

        if ($aAddress['Company'] == false) {
            $aAddress['Company'] = null;
        }
        $oCustomer = MLMagento2Alias::ObjectManagerProvider('\Magento\Customer\Model\CustomerFactory')->create();
        $oCustomer->setFirstname($aAddress['Firstname'])->setLastname($aAddress['Lastname']);

        // fallback in magento 2.3 class does not exist
        try {
            $isValid = MLMagento2Alias::CreateObjectManagerProvider('\Magento\Customer\Model\Validator\Name')->isValid($oCustomer);
        } catch (Exception $ex) {
            $isValid = false;
        }

        if (!$isValid) {
            // Negated regex from here: \Magento\Customer\Model\Validator\Name
            $re = '/[^?:\p{L}\p{M}\,\-\_\.\'\s\d{1,255}]/u';

            $aAddress['Firstname'] = preg_replace($re, '_', $aAddress['Firstname']);
            $aAddress['Lastname'] = preg_replace($re, '_', $aAddress['Lastname']);
        }
    }
}

