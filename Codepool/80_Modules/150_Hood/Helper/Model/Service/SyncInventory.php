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

require_once MLFilesystem::getOldLibPath('php/modules/magnacompatible/crons/MagnaCompatibleSyncInventory.php');

class ML_Hood_Helper_Model_Service_SyncInventory extends MagnaCompatibleSyncInventory {

    private $productData = array();
    // true if setting is set to auto
    protected $fixedStockSync = false;
    protected $fixedPriceSync = false;
    protected $auctionStockSync = false;
    protected $auctionPriceSync = false;
    // depends on listing type of the product (fixed or auction config values)
    private $syncStockOption = false;
    private $syncPriceOption = false;

    public function __construct() {
        global $_MagnaSession;

        # Ensure that $_MagnaSession contains needed data
        if (!isset($_MagnaSession) || !is_array($_MagnaSession)) {
            $_MagnaSession = array('mpID' => MLModul::gi()->getMarketPlaceId(),
                'currentPlatform' => MLModul::gi()->getMarketplaceName());
        } else {
            $_MagnaSession['mpID'] = MLModul::gi()->getMarketPlaceId();
            $_MagnaSession['currentPlatform'] = MLModul::gi()->getMarketplaceName();
        }

        parent::__construct(MLModul::gi()->getMarketPlaceId(), MLModul::gi()->getMarketplaceName(), 100);
        $iConfigTimeout = MLModul::gi()->getConfig('updateitems.timeout');
        $this->timeouts['UpdateItems'] = $iConfigTimeout == null ? 1 : (int)$iConfigTimeout;
        $this->timeouts['GetInventory'] = 1200;

        $this->startedAtTimestamp = time();
    }

    protected function getConfigKeys() {
        return array(
            'FixedStockSync' => array(
                'key' => 'stocksync.tomarketplace',
                'default' => '',
            ),
            'FixedPriceSync' => array(
                'key' => 'inventorysync.price',
                'default' => '',
            ),
            'AuctionStockSync' => array(
                'key' => 'chinese.stocksync.tomarketplace',
                'default' => '',
            ),
            'AuctionPriceSync' => array(
                'key' => 'chinese.inventorysync.price',
                'default' => '',
            ),
            'StatusMode' => array(
                'key' => 'general.inventar.productstatus',
                'default' => 'false',
            )
        );
    }

    protected $blVariantAsMaster;
    protected function identifySKU() {
        $this->blVariantAsMaster = false;
        $oMaster = MLProduct::factory()->getByMarketplaceSKU($this->cItem['SKU'], true);
        if (!$oMaster->exists()) {
            $oProduct = MLProduct::factory()->getByMarketplaceSKU($this->cItem['SKU']);

            if ($oProduct->exists() && $oProduct->get('parentid') != 0) {
                $this->blVariantAsMaster = true;
                $oMaster = $oProduct->getParent();
            }
        }
        $this->oProduct = $oMaster;
        $this->cItem['pID'] = (($this->oProduct->exists()) ? (int)$this->oProduct->get('id') : 0);
    }

    /**
     * Checks the variation matrix for changed quantities or prices.
     * It does not check if the variations attributes changed!
     *
     * @return bool
     *    true if there was a change, false otherwise.
     */
    protected function checkVariationsMatix() {
        $newVar = array();
        $oldVar = array();
        // build an accociative index of both lists where the sku is the key
        foreach ($this->productData['Variations'] as $vItem) {
            $newVar[$vItem['SKU']] = $vItem;
        }
        foreach ($this->cItem['Variations'] as $vItem) {
            $oldVar[$vItem['SKU']] = $vItem;
        }

        #echo print_m($newVar, '$newVar');
        #echo print_m($oldVar, '$oldVar');
        // get all skus
        $newSKUs = array_keys($newVar);
        $oldSKUs = array_keys($oldVar);

        // check for additions or removals
        $newDiff = array_diff($newSKUs, $oldSKUs);
        $oldDiff = array_diff($oldSKUs, $newSKUs);

        if (!empty($newDiff) || !empty($oldDiff)) {
            // Something changed, tell the API
            $this->log("\n\t".'Variation matrix changed. Added SKUs: ['.implode(',', $newDiff).'], Removed SKUs: ['.implode(',', $oldDiff).']');
            return true;
        }
        #echo print_m($newDiff, '$newDiff');
        #echo print_m($oldDiff, '$oldDiff');
        // From here on it is save to assume that every key exists in the other array.
        foreach ($newVar as $sku => $nvItem) {
            $ovItem = $oldVar[$sku];

            // check if there is a difference.
            if ($this->fixedStockSync) {
                $nvItem['Quantity'] = (int)$nvItem['Quantity'];
                if (isset($ovItem['Quantity'])) {
                    $ovItem['Quantity'] = (int)$ovItem['Quantity'];
                    if ($ovItem['Quantity'] != $nvItem['Quantity']) {
                        // Found at least one difference, no need to waste more cpu cycles checking the rest.
                        $this->log("\n\t".
                            'Variation quantity changed     (SKU: '.$sku.'    old: '.$ovItem['Quantity'].';  new: '.$nvItem['Quantity'].')'
                        );
                        return true;
                    } else {
                        $this->log("\n\t".
                            'Variation quantity not changed (SKU: '.$sku.'    old: '.$ovItem['Quantity'].';  new: '.$nvItem['Quantity'].')'
                        );
                    }
                } else {
                    // If the quantity field is missing we can't be sure, however this should NEVER happen.
                    $this->log("\n\t".
                        'Old variation quantity unknown     (SKU: '.$sku.'    new: '.$nvItem['Quantity'].')'
                    );
                    return true;
                }
            }
            if ($this->fixedPriceSync) {
                $nvItem['Price'] = round($nvItem['Price'], 2);
                if (isset($ovItem['Price'])) {
                    $ovItem['Price'] = round($ovItem['Price'], 2);
                    if ($ovItem['Price'] != $nvItem['Price']) {
                        // Found at least one difference, no need to waste more cpu cycles checking the rest.
                        $this->log("\n\t".
                            'Variation price changed        (SKU: '.$sku.'    old: '.$ovItem['Price'].';  new: '.$nvItem['Price'].')'
                        );
                        return true;
                    } else {
                        $this->log("\n\t".
                            'Variation price not changed    (SKU: '.$sku.'    old: '.$ovItem['Price'].';  new: '.$nvItem['Price'].')'
                        );
                    }
                } else {
                    // If the quantity field is missing we can't be sure, however this should NEVER happen.
                    $this->log("\n\t".
                        'Old variation price unknown        (SKU: '.$sku.'    new: '.$nvItem['Price'].')'
                    );
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Checks the quantity only for master or stand alone items
     *
     * @return bool
     *    true if there was a change, false otherwise.
     */
    protected function checkQuantity() {
        if (!$this->syncStockOption) {
            return false;
        }

        $curQty = $this->productData['Quantity'];

        if (!isset($this->cItem['Quantity'])) {
            $this->cItem['Quantity'] = 0;
        }

        if ((int)$this->cItem['Quantity'] != (int)$curQty) {
            $this->log("\n\t".
                'Quantity changed (old: '.$this->cItem['Quantity'].'; new: '.$curQty.')'
            );
            return true;
        } else {
            $this->log("\n\t".
                'Quantity not changed ('.$curQty.')'
            );
        }

        return false;
    }

    /**
     * Checks the price only for master or stand alone items
     *
     * @return bool
     *    true if there was a change, false otherwise.
     */
    protected function checkPrice() {
        if (!$this->syncPriceOption) {
            return false;
        }

        $curPrice = round($this->productData['Price'], 2);

        if (!isset($this->cItem['Price'])) {
            $this->cItem['Price'] = 0;
        } else {
            $this->cItem['Price'] = round($this->cItem['Price'], 2);
        }

        if ($this->cItem['Price'] != $curPrice) {
            $this->log("\n\t".
                'Price changed (old: '.$this->cItem['Price'].'; new: '.$curPrice.')'
            );
            return true;
        } else {
            $this->log("\n\t".
                'Price not changed ('.$curPrice.')'
            );
        }

        return false;
    }

    /**
     * Checks the price and quantity only for master or stand alone items
     *
     * @return bool
     *    true if there was a change, false otherwise.
     */
    protected function checkQuantityPriceUpdate() {
        switch ($this->cItem['ListingType']) {
            case 'buyItNow':
            case 'shopProduct':
                $this->syncStockOption = $this->fixedStockSync;
                $this->syncPriceOption = $this->fixedPriceSync;
                break;
            case 'classic':
                $this->syncStockOption = $this->auctionStockSync;
                $this->syncPriceOption = $this->auctionPriceSync;
                break;
            default:
                $this->syncStockOption = false;
                $this->syncPriceOption = false;
                break;
        }

        $cQ = $this->checkQuantity();
        $cP = $this->checkPrice();

        //Returns true if one option is true
        return (($cQ !== false) || ($cP !== false));
    }

    protected function isAutoSyncEnabled() {
        $this->fixedStockSync = $this->config['FixedStockSync'] == 'auto';
        $this->fixedPriceSync = $this->config['FixedPriceSync'] == 'auto';
        $this->auctionStockSync = $this->config['AuctionStockSync'] == 'auto';
        $this->auctionPriceSync = $this->config['AuctionPriceSync'] == 'auto';

        /*
          if ($this->_debugDryRun) {
          $this->syncFixedStock = $this->syncChineseStock = $this->syncFixedPrice = $this->syncChinesePrice = true;
          }
          // */

        if (!($this->fixedStockSync || $this->fixedPriceSync || $this->auctionStockSync || $this->auctionPriceSync)) {
            $this->log('== '.$this->marketplace.' ('.$this->mpID.'): no autosync =='."\n");
            return false;
        }
        $this->log(
            '== '.$this->marketplace.' ('.$this->mpID.'): '.
            'Sync fixed stock: '.($this->fixedStockSync ? 'true' : 'false').'; '.
            'Sync fixed price: '.($this->fixedPriceSync ? 'true' : 'false').'; '.
            'Sync auction stock: '.($this->auctionStockSync ? 'true' : 'false').'; '.
            'Sync auction price: '.($this->auctionPriceSync ? 'true' : 'false')." ==\n"
        );
        return true;
    }

    protected $aMasterData = array();

    protected function getMasterData() {
        /* @var $oPrepareHelper ML_Hood_Helper_Model_Table_Hood_PrepareData */
        $oPrepareHelper = MLHelper::gi('Model_Table_Hood_PrepareData');
        $sKeyType = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.keytype')->get('value');
        if (!array_key_exists($this->cItem['AuctionId'], $this->aMasterData)) {
            /* getProduct, get master and walk childs which are prepared
             * @see additems
             */
            //we start with master article
            $oMaster = $this->oProduct->get('parentid') == 0 ? $this->oProduct : $this->oProduct->getParent();

            // getting all variants
            $aVariants = $oMaster->getVariants();
            if (count($aVariants) == 0) {// eg. variants have no distinct sku (eg. magento attributes)
                throw new Exception('No Variants found.', 1492422768);
            }

            $aDefine = array(
                'Price' => array('optional' => array('active' => true)),
                'SKU' => array('optional' => array('active' => true)),
                'Quantity' => array('optional' => array('active' => true)),
                'Variation' => array('optional' => array('active' => true)),
                'Tax' => array('optional' => array('active' => true)),
                'ListingType' => array('optional' => array('active' => true)),
            );
            $aMasterData = array(
                'SKU' => ('artNr' == $sKeyType 
                     ? $oMaster->get('MarketplaceIdentSku')
                     : $oMaster->get('MarketplaceIdentId')),
                'Price' => 0,
                'Quantity' => 0,
                'Variations' => array(),
            );

            foreach ($aVariants as $oVariant) {
                $aVariation = $oPrepareHelper
                    ->setPrepareList(null)->setProduct($oVariant)
                    ->getPrepareData($aDefine, 'value');

                if (!$oVariant->exists() || ($this->config['StatusMode'] === 'true') && !$oVariant->isActive()) {
                    $aVariation['Quantity'] = 0;
                }

                foreach ($aVariation['Variation'] as $sKey => $value) {
                    $aVariation['Variation'][$sKey]['Name'] = $aVariation['Variation'][$sKey]['name'];
                    $aVariation['Variation'][$sKey]['Value'] = $aVariation['Variation'][$sKey]['value'];
                    unset($aVariation['Variation'][$sKey]['name']);
                    unset($aVariation['Variation'][$sKey]['value']);
                }

                $aVariation['Price'] = (float)$aVariation['Price'];

                if ($aVariation['ListingType'] == 'StoresFixedPrice') {
                    $aVariation['ListingType'] = 'shopProduct';
                } else if ($aVariation['ListingType'] == 'FixedPriceItem') {
                    $aVariation['ListingType'] = 'buyItNow';
                } else if ($aVariation['ListingType'] == 'Chinese') {
                    $aVariation['ListingType'] = 'classic';
                    $aVariation['StartPrice'] = (float)$aVariation['Price'];
                }

                // only handle product as variation when "usevariations" is enabled
                if (MLModule::gi()->getConfig('usevariations') == '1') {
                    $aMasterData['Variations'][] = $aVariation;
                } elseif ($this->cItem['SKU'] == $aVariation['SKU']) { // only if current sku equals variation sku
                    // Change the product data - so that they are threaded as a single product
                    unset($aVariation['Variation']);
                    $aMasterData['Variations'][] = $aVariation;
                    break;
                }

            }
            $this->aMasterData[$this->cItem['AuctionId']] = $aMasterData;

        }

        $aReturn = $this->aMasterData[$this->cItem['AuctionId']];

        # Is it a variation?
        if (count($aReturn['Variations']) == 1 && $aReturn['Variations'][0]['Variation'] == array()) {//is master
            $aReturn = array_merge($aReturn, $aReturn['Variations'][0]);
            $aReturn['Price'] = (float)$aReturn['Variations'][0]['Price'];
            $aReturn['Tax'] = (float)$aReturn['Variations'][0]['Tax'];
            unset($aReturn['Variation'], $aReturn['Variations']);
        } else {
            // has variations
            $aReturn['SKU'] = ($this->blVariantAsMaster ? $this->cItem['SKU'] : $aReturn['SKU']) ;
            $aReturn['Tax'] = (float)$aReturn['Variations'][0]['Tax'];
            $aReturn['ListingType'] = $aReturn['Variations'][0]['ListingType'];
            foreach ($aReturn['Variations'] as &$aVariant) {
                unset($aVariant['Tax'], $aVariant['ListingType']);
                $aVariant['SortOrder'] = '0';
            }
        }

        return $aReturn;
    }

    protected function updateItem() {
        $this->identifySKU();
        $articleIdent = 'SKU: '.$this->cItem['SKU'].' ('.$this->cItem['Title'].'); '.
            'Hood-AuctionID: '.$this->cItem['AuctionId'].'; '.
            'ListingType: '.$this->cItem['ListingType'];

        if ((int)$this->cItem['pID'] <= 0) {
            $this->log("\n".$articleIdent.' not found');
            return;
        }

        $this->log("\n".$articleIdent.' found (pID: '.$this->cItem['pID'].')');

        $this->productData = $this->getMasterData();

        //in this case the product is inactive so set Quantity to 0

        if (empty($this->productData)) {
            if ($this->cItem['Quantity'] > 0) {
                $this->productData['SKU'] = $this->cItem['SKU'];
                $this->productData['ListingType'] = $this->cItem['ListingType'];
                $this->productData['AuctionId'] = $this->cItem['AuctionId'];

                $this->productData['Quantity'] = 0;
                if (isset($this->cItem['Price'])) {
                    $this->productData['Price'] = (float)$this->cItem['Price'];
                }
                if (isset($this->cItem['Variations'])) {
                    foreach ($this->cItem['Variations'] as $var) {
                        $var['Quantity'] = 0;
                        $this->productData['Variations'][] = $var;
                    }
                }
            } else {
                // do nothing if Quantity <= 0
                return;
            }
        }

        $data = array();
        if (isset($this->cItem['Variations']) && isset($this->productData['Variations'])) {
            if ($this->checkVariationsMatix()) {
                // Don't submit price and quantity if variations are set
                unset($this->productData['Price']);
                unset($this->productData['Quantity']);

                $data = $this->productData;
                $data['AuctionId'] = $this->cItem['AuctionId'];
            }
        } else {
            if ($this->checkQuantityPriceUpdate()) {
                // Submit the update.
                $data = $this->productData;
                $data['AuctionId'] = $this->cItem['AuctionId'];
            }
        }

        if (!empty($data)) {
            $this->stockBatch[] = $data;
        }

    }

    public function process() {
        parent::process();
    }

    protected function getStockConfig() {
        return MLModul::gi()->getStockConfig();
    }

    protected function getPriceObject() {
        //$oProduct=$this->oProduct;// amazon dont need it
        return MLModul::gi()->getPriceObject();
    }

}
