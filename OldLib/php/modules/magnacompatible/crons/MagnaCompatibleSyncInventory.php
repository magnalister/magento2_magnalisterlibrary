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

if (!defined('_ML_INSTALLED'))
    throw new Exception('Direct Access to this location is not allowed.');

require_once(DIR_MAGNALISTER_MODULES . 'magnacompatible/crons/MagnaCompatibleCronBase.php');

abstract class MagnaCompatibleSyncInventory extends MagnaCompatibleCronBase {

    /** @var ML_Shop_Model_Product_Abstract     */
    protected $oProduct = null;
    protected $offset = 0;
    protected $limit = 100;
    protected $steps = false;
    protected $syncStock = false;
    protected $syncPrice = false;
    protected $cItem = array();
    protected $stockBatch = array();
    protected $helperClass = '';
    protected $timeouts = array(
        'GetInventory' => 60,
        'UpdateItems' => 5,
        'UploadItems' => 30,
    );
    protected $iErrorCode = null;

    public function __construct($mpID, $marketplace, $limit = 100) {
        parent::__construct($mpID, $marketplace);
        $this->limit = $limit;

        $this->initSync();

        $this->helperClass = ucfirst($this->marketplace) . 'Helper';
        $helperPath = DIR_MAGNALISTER_MODULES . strtolower($this->marketplace) . '/' . $this->helperClass . '.php';
        if (file_exists($helperPath)) {
            include_once($helperPath);
        }
        // $this->limit = 10;
    }

    protected function initSync() {
    }

    protected function getConfigKeys() {
        return array(
            'StockSync' => array(
                'key' => 'stocksync.tomarketplace',
            ),
            'PriceSync' => array(
                'key' => 'inventorysync.price',
            ),
            'QuantityType' => array(// @deprecated v3 uses $this->getStockConfig()
                'key' => 'quantity.type',
                'default' => '',
            ),
            'QuantityValue' => array(// @deprecated v3 uses $this->getStockConfig()
                'key' => 'quantity.value',
                'default' => 0,
            ),
            'StatusMode' => array(
                'key' => 'general.inventar.productstatus',
                'default' => 'false',
            )
        );
    }

    protected function processUpdateItemsErrors($result) {
        if (!array_key_exists('ERRORS', $result) || !is_array($result['ERRORS']) || empty($result['ERRORS'])
        ) {
            if ($this->_debugLevel >= self::DBGLV_HIGH)
                $this->log("\n\nNo errors.");
            return;
        }
        if ($this->_debugLevel >= self::DBGLV_HIGH)
            $this->logAPIErrors($result['ERRORS']);

        if (class_exists($this->helperClass, false)) {
            $callback = $this->helperClass . '::processCheckinErrors';
            if (is_callable($callback)) {
                call_user_func($callback, $result, $this->mpID);
                return;
            }
        }

        foreach ($result['ERRORS'] as $err) {
            MLErrorLog::gi()->addApiError($err);
        }
    }

    protected function postProcessRequest(&$request) {

    }

    protected function updateItems($data) {
        if (!is_array($data) || empty($data)) {
            if ($this->_debug)
                $this->log("\n\nNothing to update in this batch.");
            return false;
        }
        $request = $this->getBaseRequest();
        $request['ACTION'] = 'UpdateItems';
        $request['DATA'] = $data;
        $this->postProcessRequest($request);

        if ($this->_debug) {
            if (!self::isAssociativeArray($request['DATA'])) {
                $this->log("\nUpdating " . count($request['DATA']) . ' item(s) in this batch.');
            } else {
                $this->log("\nUpdating items.");
            }
        }
        if ($this->_debugLevel >= self::DBGLV_HIGH) {
            $this->logAPIRequest($request);
        }
        if ($this->_debug && $this->_debugDryRun) {
            return true;
        }
        MagnaConnector::gi()->setTimeOutInSeconds($this->timeouts['UpdateItems']);
        try {
            $r = MagnaConnector::gi()->submitRequest($request);
            if ($this->_debug && ($this->_debugLevel >= self::DBGLV_HIGH))
                $this->logAPIResponse($r);
            $this->processUpdateItemsErrors($r);
        } catch (MagnaException $e) {
            $this->iErrorCode = $e->getCode();
            if ($this->_debugLevel >= self::DBGLV_HIGH)
                $this->logException($e);
            if ($e->getCode() == MagnaException::TIMEOUT) {
                //$e->saveRequest();
                $e->setCriticalStatus(false);
            }
            return false;
        }
        return true;
    }

    protected function uploadItems() {
        $request = $this->getBaseRequest();
        $request['ACTION'] = 'UploadItems';

        if ($this->_debugLevel >= self::DBGLV_HIGH) {
            $this->logAPIRequest($request);
        }
        if ($this->_debug && $this->_debugDryRun) {
            return true;
        }
        MagnaConnector::gi()->setTimeOutInSeconds($this->timeouts['UploadItems']);
        try {
            $r = MagnaConnector::gi()->submitRequest($request);
        } catch (MagnaException $e) {
            if ($this->_debugLevel >= self::DBGLV_HIGH)
                $this->logException($e);
            if ($e->getCode() == MagnaException::TIMEOUT) {
                //$e->saveRequest();
                $e->setCriticalStatus(false);
            }
            return false;
        }
        return true;
    }

    protected function calcNewQuantity() {
        $oProduct = $this->oProduct;
        if (!$oProduct->exists() || ($this->config['StatusMode'] === 'true') && !$oProduct->isActive()) {
            return 0;
        }
//        if ($this->config['QuantityType'] == 'lump') {// @deprecated v3 uses $this->getStockConfig()
//            return (int) $this->config['QuantityValue'];
//        }
        $aStockConf = $this->getStockConfig();
        return $oProduct->getSuggestedMarketplaceStock($aStockConf['type'], $aStockConf['value'],isset($aStockConf['max'])?$aStockConf['max']:null);
    }

    /**
     * marketplace can have different stock-configs (eg. ebay)
     * if its so check $this->oProduct in prepare-table and
     * return array('type'=>,'value'=>);
     * @retun ML_Shop_Model_Price_Interface
     */
    abstract protected function getStockConfig();

    protected function isAutoSyncEnabled() {
        $this->syncStock = $this->config['StockSync'] == 'auto';
        $this->syncPrice = $this->config['PriceSync'] == 'auto';

        //$this->syncStock = $this->syncPrice = true;

        if (!($this->syncStock || $this->syncPrice)) {
            $this->log('== ' . $this->marketplace . ' (' . $this->mpID . '): no autosync ==' . "\n");
            return false;
        }
        $this->log(
            '== ' . $this->marketplace . ' (' . $this->mpID . '): ' .
            'Sync stock: ' . ($this->syncStock ? 'true' : 'false') . '; ' .
            'Sync price: ' . ($this->syncPrice ? 'true' : 'false') . " ==\n"
        );
        return true;
    }

    /**
     * @deprecated v3 uses $this->getStockConfig()
     */
    protected function initQuantitySub() {
        $this->config['QuantitySub'] = 0;
        if ($this->syncStock) {
            if ($this->config['QuantityType'] == 'stocksub') {
                $this->config['QuantitySub'] = $this->config['QuantityValue'];
            }
        }
    }

    protected function identifySKU() {
        $this->cItem['pID'] = (int) magnaSKU2pID($this->cItem['SKU']);
        $this->cItem['aID'] = (int) magnaSKU2aID($this->cItem['SKU']);
    }

    protected function updateQuantity() {
        if (!$this->syncStock) {
            return false;
        }

        $data = false;
        $curQty = $this->calcNewQuantity();

        if (!isset($this->cItem['Quantity'])) {
            $this->cItem['Quantity'] = 0;
        }

        if (isset($this->cItem['Quantity']) && ($this->cItem['Quantity'] != $curQty)) {
            $data = array(
                'Mode' => 'SET',
                'Value' => (int) $curQty
            );
            $this->log("\n\t" .
                'Quantity changed (old: ' . $this->cItem['Quantity'] . '; new: ' . $curQty . ')'
            );
        } else {
            $this->log("\n\t" .
                'Quantity not changed (' . $curQty . ')'
            );
        }
        return $data;
    }

    /**
     * marketplace can have different price-configs (eg. ebay)
     * if its so check $this->oProduct in prepare-table and
     * manipulate price-object like the product is prepared
     * @retun ML_Shop_Model_Price_Interface
     */
    abstract protected function getPriceObject();

    protected function updatePrice() {
        if (!$this->oProduct->exists() || !$this->syncPrice) {
            return false;
        } else {
            $data = false;
            try{
                $price = $this->oProduct->getSuggestedMarketplacePrice($this->getPriceObject());
                // Format price to maximum 4 decimals because we only store 4 decimals also on API
                $price = number_format($price, 4, '.', '');
                if (($price > 0) && ((float) $this->cItem['Price'] != $price)) {
                    $this->log("\n\t" .
                        'Price changed (old: ' . $this->cItem['Price'] . '; new: ' . $price . ')'
                    );
                    $data = $price;
                } else {
                    $this->log("\n\t" .
                        'Price not changed (' . $price . ')'
                    );
                }
            }  catch (Exception $oExc){
                $this->log("\n\t" .$oExc->getMessage());
            }
            return $data;
        }
    }

    protected function updateCustomFields(&$data) {
        /* Child classes may add aditional fields that have to be provided or can be synced. */
    }

    protected function updateItem() {
        @set_time_limit(180);
        $this->identifySKU();
        if ((int) $this->cItem['pID'] <= 0) {
            $title = isset($this->cItem['ItemTitle']) ? $this->cItem['ItemTitle'] : '';
            $this->log("\n" .
                    'SKU: ' . $this->cItem['SKU'] . ' (' . $title . ') not found'
            );
            return;
        } else {
            $title = isset($this->cItem['ItemTitle']) ? $this->cItem['ItemTitle'] : '';
            $this->log("\n" .
                'SKU: ' . $this->cItem['SKU'] . ' (' . $title . ') found (' .
                'pID: ' . $this->cItem['pID'] . '; aID: ' . $this->cItem['aID'] .
            ')');
        }

        $data = array();

        $qU = $this->updateQuantity();
        if ($qU !== false) {
            $data['NewQuantity'] = $qU;
        }

        $pU = $this->updatePrice();
        if ($pU !== false) {
            $data['Price'] = $pU;
        }
        $this->updateCustomFields($data);

        $mpID = $this->mpID;
        $marketplace = $this->marketplace;
        /* {Hook} "SyncInventory_UpdateItem": Runs during the inventory synchronization from your shop to the marketplace.<br>
           Variables that can be used:
           <ul><li>$this->mpID: The ID of the marketplace.</li>
               <li>$this->marketplace: The name of the marketplace.</li>
               <li>$data (array): The content of the changes of one product (used to generate the <code>UpdateItem</code> request).<br>
                   Supported are <span class="tt">Price</span> and <span class="tt">Quantity</span>
               </li>
               <li>$this->cItem (array): The current product from the marketplaces inventory including some identification information.
                   <ul><li>SKU: Article number of marketplace</li>
                       <li>pID: products_id of product</li>
                       <li>aID: attributes_id of product</li>
                   </ul>
               </li>
          </ul>
          <p>Notice: It is only possible to modify products that have been identified by the magnalister plugin!</p>
          Example:
          <pre>// For amazon set the quantity of the product with the SKU blabla123 to be always 5
if (($this->marketplace == 'amazon') && ($this->cItem['SKU'] == 'blabla123')) {
    $data['Quantity'] = 5;
}</pre>
        */
        if (($hp = magnaContribVerify('SyncInventory_UpdateItem', 1)) !== false) {
            require($hp);
        }

        if (!empty($data)) {
            $data['SKU'] = $this->cItem['SKU'];
            $this->stockBatch[] = $data;
        }
    }

    protected function extendGetInventoryRequest(&$request) {

    }

    protected function submitStockBatch() {
        $this->updateItems($this->stockBatch);
    }

    protected function syncInventory() {
        $this->initQuantitySub();

        $request = $this->getBaseRequest();
        if(MLHttp::gi()->isAjax()){
        //in plugin in each ajax request of syncInventory we sync 25 product ,
        // it is safer and customer can see better the progress of syncing
        // steps x limit = 1 x 30 = 30
            $this->steps = 1;
            $this->limit = 30;
        }
        $request['ACTION'] = 'GetInventory';
        $request['MODE'] = 'SyncInventory';

        $sRequestSearch = MLRequest::gi()->data('SEARCH');
        if ($sRequestSearch !== null) {
            $request['SEARCH'] = $sRequestSearch;
        }

        $this->extendGetInventoryRequest($request);

        do {
            $sGettSku = MLRequest::gi()->data('SKU');
            if($sGettSku !== null){

                $request['ACTION'] = 'GetInventoryBySKUs';
                $request["DATA"][] =
                        array(
                            "SKU" => $sGettSku
                        );
            }else{
                $request['LIMIT'] = $this->limit;
                $request['OFFSET'] = $this->offset;
            }

            $this->log("\n\nFetch Inventory: ");
            MagnaConnector::gi()->setTimeOutInSeconds($this->timeouts['GetInventory']);
            try {
                $result = $this->getInventory($request);
            } catch (MagnaException $e) {
                $this->logException($e, $this->_debugLevel >= self::DBGLV_HIGH);
                return false;
            }
            $this->log(
                'Received ' . count($result['DATA']) . ' items ' .
                '(' . ($this->offset + count($result['DATA'])) . ' of ' . $result['NUMBEROFLISTINGS'] . ') ' .
                'in ' . microtime2human($result['Client']['Time']) . "\n"
            );
            try {
                if (!empty($result['DATA'])) {
                    $this->stockBatch = array();
                    foreach ($result['DATA'] as $iItem => $item) {
                        $this->cItem = $item;
                        try {
                            $this->oProduct = MLProduct::factory()->getByMarketplaceSKU($this->cItem['SKU']);
                        } catch (Exception $exception) {
                            $this->log("\n" .
                                'SKU: ' . $this->cItem['SKU'] . ' (' . (isset($this->cItem['ItemTitle']) ? $this->cItem['ItemTitle'] : '') . ') PHP ERROR occurred'
                            );
                            continue;
                        }

                        $this->updateItem();
                        if ( $iItem % 10 === 0) {
                            // every 10th item to have some outputs
                            // - we can resume if limit can't executed completely
                            // - also we have continously output (some servers stops, if there is no output)
                            // Marker for continue requests from the API
                            // If Synchro not completed, API takes the last marker arrived,
                            // and uses the data for a continue request
                            // Always send this, no matter if MLDEBUG is on.
                            $this->dataOut(array(
                                'Marketplace' => $this->marketplace,
                                'MPID' => $this->mpID,
                                'Done' => (int) ($this->offset + $iItem),
                                'Step' => $this->steps,
                                'Total' => $result['NUMBEROFLISTINGS'],
                            ));
                        }
                    }
                    $this->submitStockBatch();
                }
            } catch (Exception $oExc) {
                $this->log("\n\t" . $oExc->getMessage() . $oExc->getTraceAsString());
            }
            $aResult = array(
                'Marketplace' => $this->marketplace,
                'MPID' => $this->mpID,
                'Done' => (int) ($this->offset + count($result['DATA'])),
                'Step' => $this->steps,
                'Total' => $result['NUMBEROFLISTINGS'],
            );
            // Marker for continue requests from the API
            // If Synchro not completed, API takes the last marker arrived,
            // and uses the data for a continue request
            // Always send this, no matter if MLDEBUG is on.
            $this->dataOut($aResult);
            $this->offset += $this->limit;
            MLSetting::gi()->add(
                'aAjax',
                array(
                    'success' => ($this->offset >= $result['NUMBEROFLISTINGS']),
                    'error' => '',
                    'offset' => $this->offset,
                    'info' => array(
                        'total' => $result['NUMBEROFLISTINGS'],
                        'current' => $this->offset,
                        'purge' => false,
                    ),
                )
            );

            if (($this->steps !== false) && ($this->offset < $result['NUMBEROFLISTINGS'])) {
                if ($this->steps <= 1) {
                    // Abort sync. Will be continued though another callback request.
                    return true;
                } else {
                    --$this->steps;
                }
            }
        } while ($this->offset <= ($result['NUMBEROFLISTINGS']));

        $this->uploadItems();

        // Marker for completed operation, so that no continue request is made
        $this->dataOut(array(
            'Complete' => 'true',
        ));

        return true;
    }

    protected function out($str) {
        if(!MLHttp::gi()->isAjax()){
            echo $str;
            flush();
        }else{//in ajax call in pluin we break maxitems and steps of each request ,so we don't have lang request ,so we don't need echo any output
//            MLLog::gi()->add('SyncInventory_'.MLModule::gi()->getMarketPlaceId(), $str);
        }
    }

    public function process() {
        if (!$this->isAutoSyncEnabled()) {
            $this->dataOut(array(
                'Complete' => 'true',
            ));
            return;
        }
        $aRequest = MLRequest::gi()->data();
        if (isset($aRequest['mpid']) && ($aRequest['mpid'] == $this->mpID) && isset($aRequest['offset']) && ctype_digit($aRequest['offset'])) {
            $this->offset = (int) $aRequest['offset'];
            $this->log('--> Continue from offset: ' . $this->offset . "\n");
        }

        // Only sync X steps. Execution will then be aborted and later continued though another request.
        if (isset($aRequest['steps']) && ((int)$aRequest['steps'] >= 1)) {
            $this->steps = (int)$aRequest['steps'];
        }
        // Define the size of the response of the GetInventory call
        if (isset($aRequest['maxitems']) && ((int)$aRequest['maxitems'] >= 1)) {
            $this->limit = (int)$aRequest['maxitems'];
        }

        $this->syncInventory();
        MagnaConnector::gi()->resetTimeOut();

    }


    protected function testGetInventory(){
        return array(
            'DATA' => array(
//                array(
//                    'SKU' => 'SW10171.3',
//                    'Currency' => 'EUR',
//                    'Quantity' => 12,
//                    'Price' => 12,
//                ),
//                array(
//                    'SKU' => 'SW10170',
//                    'Currency' => 'EUR',
//                    'Quantity' => 20,
//                    'Price' => 20,
//                ),
            )
        );
    }

    /**
     * @param $request
     * @return bool|mixed
     * @throws MagnaException
     */
    protected function getInventory($request) {

        if(MLRequest::gi()->data('Testing') != true) {
            $result = MagnaConnector::gi()->submitRequest($request);

        } else {
            $result = $this->testGetInventory();
        }

        return $result;
    }
}
