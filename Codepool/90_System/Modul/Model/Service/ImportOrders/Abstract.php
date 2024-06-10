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

abstract class ML_Modul_Model_Service_ImportOrders_Abstract extends ML_Modul_Model_Service_Abstract {
    protected $aOrders = array();
    protected $iMutexId = null;
    protected $aOrdersList = array();
    protected $sGetOrdersApiAction = 'GetOrdersForDateRange';
    protected $sAcknowledgeApiAction = 'AcknowledgeImportedOrders';
    protected $blUpdateMode = false;

    /**
     * @var null no local test orders
     * @var array $aLocalTestOrders form orders tools_testorders (no api requests)
     */
    protected $aLocalTestOrders = null;

    public function __construct() {
        $iOrderImportTimeLimit = 60 * 2; // 2 minutes per module
        if (MLSetting::gi()->iOrderImportTimeLimit !== null) {
            $iOrderImportTimeLimit = (int)MLSetting::gi()->iOrderImportTimeLimit;
        }
        MagnaConnector::gi()->setTimeOutInSeconds(120);
        @set_time_limit($iOrderImportTimeLimit);
        parent::__construct();
    }

    public function __destruct() {
        MagnaConnector::gi()->resetTimeOut();
    }

    public function execute() {
        try {
            if ($this->isMutex()) {
                $this->getOrders();
            }
        } catch (Exception $oEx) {
            echo $oEx->getMessage();
        }
        $this->cleanMutex();
        return $this;
    }

    protected function isMutex() {
        $oCache = MLShop::gi()->getCacheObject();
        $sLock = get_class($this) . '.lock';
        if (!$oCache->exists($sLock)) {
            usleep(rand(200, 800));
            if (!$oCache->exists($sLock)) {
                $sRandom = '';
                if (function_exists('random_bytes') && function_exists('bin2hex')) {
                    try {
                        $sRandom = bin2hex(random_bytes(32));
                    } catch (Exception $oEx) {
                    }
                }
                if (empty($sRandom) && function_exists('openssl_random_pseudo_bytes') && function_exists('bin2hex')) {
                    $sRandom = bin2hex(openssl_random_pseudo_bytes(32));
                }
                if (empty($sRandom)) {
                    $sRandom = uniqid('', true);
                }
                $this->iMutexId = $sRandom;
                $oCache->set($sLock, $this->iMutexId, 1200);
                $aMicroSeconds = array("100000", '200000', '300000', '400000', '500000', '600000', '700000', '800000', '900000', '1000000');
                $randIndex = array_rand($aMicroSeconds);
                $rand = $aMicroSeconds[$randIndex];
                usleep($rand);
            }
        }
        return $oCache->get($sLock) == $this->iMutexId;
    }

    protected function cleanMutex() {
        if ($this->isMutex()) {
            $oCache = MLShop::gi()->getCacheObject();
            $sLock = get_class($this) . '.lock';
            $oCache->delete($sLock);
        }
        return $this;
    }

    /**
     * It returns number order item or position that are imported in shop-system
     * At the moment is only important for eBay
     * @param $aOrder
     * @return int
     */
    protected function getNumberOfImportedPosition($aOrder){
        return count($aOrder['Products']);
    }
    protected function acknowledgeOrders() {
        $aProcessedOrders = array();
        $oModul = $this->oModul;
        foreach ($this->aOrders as $iKey => $aOrder) {
            $sOrderId = $this->aOrdersList[$iKey]->getOrderIdForAcknowledge();
            if (!empty($sOrderId)) {
                $aOrderParameters = array();
                $aOrderParameters['MOrderID'] = $aOrder['MPSpecific']['MOrderID'];
                $aOrderParameters['ShopOrderID'] = $sOrderId;
                $aOrderParameters['NumberOfImportedPosition'] = $this->getNumberOfImportedPosition($aOrder);
                $this->aOrdersList[$iKey]->setSpecificAcknowledgeField($aOrderParameters,$aOrder);
                $aProcessedOrders[] = $aOrderParameters;
            }
        }
        if (count($aProcessedOrders) > 0) {
            $aRequest = array(
                'ACTION' => $this->sAcknowledgeApiAction,
                'SUBSYSTEM' => $oModul->getMarketplaceName(),
                'MARKETPLACEID' => $oModul->getMarketplaceId(),
                'DATA' => $aProcessedOrders,
            );
            $aRequest = $this->manipulateRequest($aRequest);
            if($this->getLocalTestOrders() !== null) {
                echo "AcknowledgeImportedOrders - Request:";
                Kint::dump($aRequest);
                return $this;
            }
            try {
                $aResponse = MagnaConnector::gi()->submitRequest($aRequest);
                MLLog::gi()->add(MLSetting::gi()->get('sCurrentOrderImportLogFileName'), array(
                    'MOrderId' => 'AcknowledgeOrders',
                    'PHP' => get_class($this).'::'.__METHOD__.'('.__LINE__.')',
                    'Request' => $aRequest,
                    'Response' => $aResponse,
                ));
            } catch (MagnaException $oEx) {
                if ($oEx->getCode() == MagnaException::TIMEOUT) {
                    $oEx->saveRequest();
                    $oEx->setCriticalStatus(false);
                }
                MLLog::gi()->add(MLSetting::gi()->get('sCurrentOrderImportLogFileName'), array(
                    'MOrderId' => 'AcknowledgeOrdersException',
                    'PHP' => get_class($this).'::'.__METHOD__.'('.__LINE__.')',
                    'Request' => $aRequest,
                    'Exception' => $oEx->getMessage(),
                ));
            }
        }
        return $this;
    }

    protected function updateExchangeRate() {
        if ((boolean)$this->oModul->getConfig('exchangerate_update')) {
            $aCurrencies = array();
            foreach ($this->aOrders as $aOrder) {
                if(isset($aOrder['Order']['Currency']) && !empty($aOrder['Order']['Currency']) && !in_array($aOrder['Order']['Currency'], $aCurrencies)){
                    $aCurrencies[] = $aOrder['Order']['Currency'];
                    MLCurrency::gi()->updateCurrencyRate($aOrder['Order']['Currency']);
                }

            }
        }
        return $this;
    }

    protected function normalizeOrder($aOrder) {
        $aExistingOrder = array();
        foreach (array('Main', 'Billing', 'Shipping') as $sAddressType) {
            if (!isset($aOrder['AddressSets'][$sAddressType]) || empty($aOrder['AddressSets'][$sAddressType])) {
                $aExistingOrder = empty($aExistingOrder) ? MLOrder::factory()->getByMagnaOrderId($aOrder['MPSpecific']['MOrderID'])->get('orderdata') : $aExistingOrder;
                if (isset($aExistingOrder['AddressSets'][$sAddressType])) {
                    $aOrder['AddressSets'][$sAddressType] = $aExistingOrder['AddressSets'][$sAddressType];
                }
            }
        }
        if (!isset($aOrder['AddressSets']['Main']) || count($aOrder['AddressSets']['Main']) < 5) {// < 5 = threshold
            throw new Exception('Main Address is empty.');
        }
        return MLHelper::gi('model_service_orderdata_normalize')->setUpdateMode($this->blUpdateMode)->normalizeServiceOrderData($aOrder);

    }

    /**
     * sets local test orders
     * @param array $aOrders
     * @return \ML_Modul_Model_Service_ImportOrders_Abstract
     */
    public function setLocalTestOrders ($aOrders) {
        $this->aLocalTestOrders = $aOrders;
        return $this;
    }

    /**
     * get local test orders
     * @return array
     */
    protected function getLocalTestOrders () {
        return $this->aLocalTestOrders;
    }


    protected function manipulateRequest($aRequest){
        return $aRequest;
    }

    protected function getCountOfOrderToBeProcessed(){
        if(MLRequest::gi()->data('OrderCount') !== null){
            $iCount = MLRequest::gi()->data('OrderCount');
        } else if(MLSetting::gi()->iOrderImportOrderCount !== null){
            $iCount = MLSetting::gi()->iOrderImportOrderCount;
        } else {
            $iCount = 50;
        }
        return $iCount;
    }

    protected function getOrders() {
        MLHelper::gi('stream')->stream('Getting orders from magnalister-server');
        if (MLSetting::gi()->blDev && MLRequest::gi()->data('begin') !== null) {
            $iStartTime = strtotime(MLRequest::gi()->data('begin'));
        } else if (!$this->oModul->getConfig('import') || $this->oModul->getConfig('import') == 'false') {
            return $this;
        } else {
            $iStartTime = MLSetting::gi()->get('iOrderMinTime');
            $aTimes = array($iStartTime);
            foreach (array('orderimport.lastrun', 'preimport.start') as $sConfig) {
                // Helper for php8 compatibility - can't pass null to strtotime
                $sConfig = MLHelper::gi('php8compatibility')->checkNull($sConfig);
                if ($this->oModul->getConfig($sConfig) === null) {
                    continue;
                }
                $iTimestamp = strtotime($this->oModul->getConfig($sConfig));
                if ($sConfig == 'orderimport.lastrun') {
                    $iTimestamp = $iTimestamp - MLSetting::gi()->get('iOrderPastInterval');
                } elseif (
                    $sConfig == 'preimport.start'
                    && $iTimestamp > time()
                ) {
                    return $this;
                }
                $aTimes[] = $iTimestamp;
                $iStartTime = $iTimestamp > $iStartTime ? $iTimestamp : $iStartTime;
            }
        }

        $iCount = $this->getCountOfOrderToBeProcessed();

        $aRequest = array(
            'ACTION' => $this->sGetOrdersApiAction,
            'SUBSYSTEM' => $this->getMarketPlaceName(),
            'MARKETPLACEID' => $this->getMarketPlaceId(),
            'IgnoreLastImport' => false,
            'BEGIN' => gmdate('Y-m-d H:i:s', $iStartTime),
            'OFFSET' => array(
                'COUNT' => (int)$iCount,
                'START' => 0,
            )
        );
        $aRequest = $this->manipulateRequest($aRequest);
        $sPreimportStart = strtotime($this->oModul->getConfig('preimport.start'));
        while (is_array($aRequest)) {
            try {
                $this->aOrdersList = array();
                $this->aOrders = array();
                if ($this->getLocalTestOrders() === null) {
                    if (MLRequest::gi()->data('MLDEBUG') === 'true' || MLSetting::gi()->blDebug) {
                        echo print_m($aRequest);
                    }
                    $aResponse = MagnaConnector::gi()->submitRequest($aRequest);
                    if (!isset($aResponse['HASNEXT']) || !$aResponse['HASNEXT'] || MLRequest::gi()->data('OrderCount')) {
                        $aRequest = null;
                    } else {
                        $aRequest['OFFSET']['START'] += $aRequest['OFFSET']['COUNT'];
                    }
                    foreach ($aResponse['DATA'] as $aOrder) {
                        // skip orders placed before configured time
                        if (array_key_exists('Order', $aOrder)
                            && array_key_exists('DatePurchased', $aOrder['Order'])
                            && strtotime($aOrder['Order']['DatePurchased']) < $sPreimportStart) {
                            continue;
                        }
                        $this->aOrders[] = $aOrder;
                    }
                } else {
                    $this->aOrders = $this->getLocalTestOrders();
                    $aRequest = null;
                }
                $this->updateExchangeRate();
                if ($this->isMutex()) {
                    $this->doOrders();
                    $this->acknowledgeOrders();
                }
            } catch (MagnaException $oEx) {
                $aRequest = null;
                if (MAGNA_CALLBACK_MODE == 'STANDALONE') {
                    echo print_m($oEx->getErrorArray(), 'Error: '.$oEx->getMessage(), true);
                } elseif (MLSetting::gi()->get('blDebug')) {
                    MLMessage::gi()->addFatal($oEx->getMessage());
                }
                if (MLSetting::gi()->get('blDebug') && ($oEx->getMessage() == ML_INTERNAL_API_TIMEOUT)) {
                    $oEx->setCriticalStatus(false);
                }
            }
        }
        return $this;
    }

    abstract public function canDoOrder(ML_Shop_Model_Order_Abstract $oOrder, &$aOrder);

    protected function hookAddOrder(&$aOrder) {
        /* {Hook} "addOrder": Enables you to extend or modify order that's being imported from marketplace.
            Variables that can be used:
            <ul>
                <li>$iMarketplaceId (int): Id of marketplace</li>
                <li>$sMarketplaceName (string): Name of marketplace</li>
                <li>&$aOrder (array): Order data received from marketplace.</li>
            </ul>
        */
        foreach(array(1, 2, 3) as $indexOfFile) {
            if (($sHook = MLFilesystem::gi()->findhook('addOrder', $indexOfFile)) !== false) {
                $iMarketplaceId = MLModule::gi()->getMarketPlaceId();
                $sMarketplaceName = MLModule::gi()->getMarketPlaceName();
                require $sHook;
            }
        }
    }

    /**
     * @param $aOrder array
     * @return bool
     */
    protected function getUpdateMode($aOrder){
        return $this->blUpdateMode || !isset($aOrder['Products']) || empty($aOrder['Products']);
    }

    protected function doOrders() {
        $aTabIdents = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.tabident')->get('value');
        foreach ($this->aOrders as $iOrder => $aOrder) {
            $this->blUpdateMode = $this->getUpdateMode($aOrder);
            $sMpId = MLModule::gi()->getMarketPlaceId();
            MLSetting::gi()->set('sCurrentOrderImportLogFileName', 'OrderImport_'.$sMpId, true);
            MLSetting::gi()->set('sCurrentOrderImportMarketplaceOrderId', isset($aOrder['MPSpecific']) && isset($aOrder['MPSpecific']['MOrderID']) ? $aOrder['MPSpecific']['MOrderID'] : 'unknown', true);
            MLLog::gi()->add(MLSetting::gi()->get('sCurrentOrderImportLogFileName'), array(
                'MOrderId' => MLSetting::gi()->get('sCurrentOrderImportMarketplaceOrderId'),
                'PHP' => get_class($this).'::'.__METHOD__.'('.__LINE__.')',
                'OrderDataApiResponse' => $aOrder,
            ));
            try {
                $aOrder = $this->normalizeOrder($aOrder);
                $this->hookAddOrder($aOrder);
                MLLog::gi()->add(MLSetting::gi()->get('sCurrentOrderImportLogFileName'), array(
                    'MOrderId' => MLSetting::gi()->get('sCurrentOrderImportMarketplaceOrderId'),
                    'PHP' => get_class($this).'::'.__METHOD__.'('.__LINE__.')',
                    'OrderDataNormalized' => $aOrder,
                ));
                MLHelper::gi('stream')->deeper('Start ('.$aOrder['MPSpecific']['MOrderID'].')');
                //check if order exist
                $oOrder = MLOrder::factory()->getByMagnaOrderId($aOrder['MPSpecific']['MOrderID']);
                if ($oOrder->get('orders_id') !== null && !$this->blUpdateMode) {
                    throw MLException::factory('Model_Service_ImportOrders_OrderExist')->setShopOrder($oOrder);
                }

                if (isset($aOrder['MPSpecific']['MPreviousOrderID']) && !empty($aOrder['MPSpecific']['MPreviousOrderID'])) { // check for extend order
                    $sMPreviousOrderID = is_array($aOrder['MPSpecific']['MPreviousOrderID']) ? $aOrder['MPSpecific']['MPreviousOrderID']['id'] : $aOrder['MPSpecific']['MPreviousOrderID'];
                    $oOrder = MLOrder::factory()->getByMagnaOrderId($sMPreviousOrderID);
                    $blSendmail = !in_array($aOrder['MPSpecific']['MOrderID'], $aOrder['MPSpecific']['MPreviousOrderIDS']);
                } else {
                    $blSendmail = $oOrder->get('orders_id') === null;
                }
                $sInfo = $this->canDoOrder($oOrder, $aOrder);
                if ($oOrder->get('special') === null) {
                    $oOrder
                        ->set('mpid', MLModule::gi()->getMarketPlaceId())
                        ->set('platform', MLModule::gi()->getMarketPlaceName())
                        ->set('special', $this->aOrders[$iOrder]['MPSpecific']['MOrderID'])
                        ->set('logo', null)//reset oder-logo when order is updated
                    ;
                }
                $this->aOrders[$iOrder] = $oOrder->shopOrderByMagnaOrderData($aOrder);
                $oOrder
                    ->set('mpid', MLModule::gi()->getMarketPlaceId())
                    ->set('platform', MLModule::gi()->getMarketPlaceName())
                    ->set('logo', null)//reset oder-logo when order is updated
                    ->set('status', $this->aOrders[$iOrder]['Order']['Status'])
                    ->set('data', $this->aOrders[$iOrder]['MPSpecific'])
                    ->set('special', $this->aOrders[$iOrder]['MPSpecific']['MOrderID'])
                    ->set('orderdata', $this->aOrders[$iOrder])
                    ->save()
                    ->triggerAfterShopOrderByMagnaOrderData()
                ;
                if (   $blSendmail
                    && (MLModule::gi()->getConfig('mail.send') == 'true' || MLModule::gi()->getConfig('mail.send') == '1') //some times config value is not a string
                    && !$this->blUpdateMode
                ) {
                    $this->sendPromotionMail($this->aOrders[$iOrder], $oOrder);//we should use $this->aOrders, because some important data like user password is filled by shopspecific
                }
                MLLog::gi()->add(MLSetting::gi()->get('sCurrentOrderImportLogFileName'), array(
                    'MOrderId' => MLSetting::gi()->get('sCurrentOrderImportMarketplaceOrderId'),
                    'PHP' => get_class($this).'::'.__METHOD__.'('.__LINE__.')',
                    'Info' => 'imported in ' . $this->aOrders[$iOrder]['MPSpecific']['MOrderID'] . '.' . ($blSendmail && (MLModule::gi()->getConfig('mail.send') == 'true' || MLModule::gi()->getConfig('mail.send') == '1') ? ' Promotion mail sended.' : ''),
                    'FinalTableData' => $oOrder->data(),
                ));
                // $aData=$oOrder->data();
                $this->aOrdersList[$iOrder] = $oOrder;
            } catch (ML_Modul_Exception_Model_Service_ImportOrders_OrderExist $oEx) {
                $sInfo = $oEx->getMessage();
                MLLog::gi()->add(MLSetting::gi()->get('sCurrentOrderImportLogFileName'), array(
                    'MOrderId' => MLSetting::gi()->get('sCurrentOrderImportMarketplaceOrderId'),
                    'PHP' => get_class($this).'::'.__METHOD__.'('.__LINE__.')',
                    'ML_Modul_Exception_Model_Service_ImportOrders_OrderExist' => $sInfo,
                )); // temporarily log to check some problem in extended orders
                $this->aOrdersList[$iOrder] = $oEx->getShopOrder();
            } catch (Exception $oEx) {
                $sInfo = $oEx->getMessage();
                MLLog::gi()->add(MLSetting::gi()->get('sCurrentOrderImportLogFileName'), array(
                    'MOrderId'  => MLSetting::gi()->get('sCurrentOrderImportMarketplaceOrderId'),
                    'PHP'       => get_class($this).'::'.__METHOD__.'('.__LINE__.')',
                    'Exception' => $sInfo,
                    'Backtrace' => $oEx->getTraceAsString(),
                ));
                MLMessage::gi()->addDebug($oEx); // exception like when one currency doesn't exit in shop is shown by a warning message
                unset($this->aOrders[$iOrder]);
            }
            if (MLSetting::gi()->get('blDebug')) {
                MLLog::gi()->add('ordersSync', array(
                    'display' => array(
                        'info' => $sInfo,
                        'marketplace' => MLModule::gi()->getMarketPlaceName() . ' (' . (isset($aTabIdents[MLModule::gi()->getMarketPlaceId()]) && $aTabIdents[MLModule::gi()->getMarketPlaceId()] != '' ? $aTabIdents[MLModule::gi()->getMarketPlaceId()] . ' - ' : '') . MLModule::gi()->getMarketPlaceId() . ')',
                        'orderno_marketplace' => $aOrder['MPSpecific']['MOrderID'],
                        'orderno_shop' => (isset($oOrder) && $oOrder->exists() )? '<div class="order-link"><a class="ml-js-noBlockUi" target="_blank" href="'.$oOrder->getEditLink().'">'.$oOrder->get('orders_id').'</a></div>' : '&mdash;',
                        'status' => (isset($oOrder) && $oOrder->exists() )?$aOrder['Order']['Status']." - ".$oOrder->getShopOrderStatusName():'&mdash;'
                    )
                ));
            }
            MLHelper::gi('stream')->stream($sInfo.' ('.$aOrder['MPSpecific']['MOrderID'].')');
            MLHelper::gi('stream')->higher('End ('.$aOrder['MPSpecific']['MOrderID'].')');
        }
        return $this;
    }

    public function sendPromotionMailTest() {
        $oModul = $this->oModul;
        $aOrder = array(
            'AddressSets' => array(
                'Main' => array(
                    'EMail' => $oModul->getConfig('mail.originator.adress'),
                    'Firstname' => 'Max',
                    'Lastname' => 'Mustermann',
                )
            ),
            'Order' => array(
                'Currency' => $oModul->getConfig('currency')
            ),
            'Products' => array(
                array(
                    'Quantity' => 2,
                    'ItemTitle' => 'Lorem Ipsum - Das Buch',
                    'Price' => 12.99,
                ),
                array(
                    'Quantity' => 1,
                    'ItemTitle' => 'Dolor Sit Amet - Das Nachschlagewerk',
                    'Price' => 22.59,
                )
            )
        );
        return $this->sendPromotionMail($aOrder);
    }

    /**
     * Option for specific marketplaces to extent the promotion mail placeholders
     *
     * @param $placeHolders
     * @param $aOrder
     */
    protected function extendPromotionMailPlaceholders(&$placeHolders, $aOrder) {

    }

    /**
     * @param $aOrder array data from API
     * @param $oOrder ML_Shop_Model_Order_Abstract
     * @return bool|mixed
     */
    protected function sendPromotionMail($aOrder, $oOrder = null) {
        $oModule = $this->oModul;
        ob_start();
        {
            include MLFilesystem::gi()->getViewPath('hook_ordermailsummary');
            $sSummary = ob_get_contents();
        }
        ob_end_clean();

        $sMailTo = $aOrder['AddressSets']['Main']['EMail'];
        $sMailFrom = $oModule->getConfig('mail.originator.adress');

        $aReplace = array(
            '#FIRSTNAME#' => $aOrder['AddressSets']['Main']['Firstname'],
            '#LASTNAME#' => $aOrder['AddressSets']['Main']['Lastname'],
            '#PASSWORD#' => isset($aOrder['AddressSets']['Main']['Password']) ? $aOrder['AddressSets']['Main']['Password'] : '(wie bekannt)',
            '#ORIGINATOR#' => $oModule->getConfig('mail.originator.name'),
            '#EMAIL#' => $aOrder['AddressSets']['Main']['EMail'],
            '#MARKETPLACE#' => $oModule->getMarketPlaceName(false),
            '#ORDERSUMMARY#' => $sSummary,
            '#SHOPURL#' => MLHttp::gi()->getBaseUrl(),
            '#MARKETPLACEORDERID#' => '',
        );

        if ($oOrder !== null) {
            $aReplace['#SHOPORDERID#'] = $oOrder->getShopOrderId();
            $aReplace['#MARKETPLACEORDERID#'] = $oOrder->getMarketplaceOrderId();
        }

        $this->extendPromotionMailPlaceholders($aReplace, $aOrder);

        $sMailContent = $this->replace($oModule->getConfig('mail.content'), $aReplace);
        unset($aReplace['#ORDERSUMMARY']);
        $sMailSubject = $this->replace($oModule->getConfig('mail.subject'), $aReplace);
        MLHelper::gi('stream')->stream('Send promotion email to '.$sMailTo);
        try {
            MLLog::gi()->add(MLSetting::gi()->get('sCurrentOrderImportLogFileName'), array(
                'MOrderId' => MLSetting::gi()->get('sCurrentOrderImportMarketplaceOrderId'),
                'PHP' => get_class($this).'::'.__METHOD__.'('.__LINE__.')',
                'Send email' => 'Send promotion email to '.$sMailTo,
            ));
        } catch (Exception $oEx) {

        }
        try {
            return MagnaConnector::gi()->submitRequest(array(
                'ACTION' => 'SendSaleConfirmationMail',
                'SUBSYSTEM' => 'Core',
                'RECIPIENTADRESS' => $sMailTo,
                'ORIGINATORNAME' => $oModule->getConfig('mail.originator.name'),
                'ORIGINATORADRESS' => $sMailFrom,
                'SUBJECT' => fixHTMLUTF8Entities($sMailSubject),
                'CONTENT' => $sMailContent,
                'BCC' => ($oModule->getConfig('mail.copy') == 'true' || MLModule::gi()->getConfig('mail.copy') == '1') && $sMailFrom != $sMailTo
            ));
        } catch (Exception $oEx) {
            return false;
        }
    }
}
