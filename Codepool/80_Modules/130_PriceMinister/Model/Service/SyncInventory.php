<?php

class ML_PriceMinister_Model_Service_SyncInventory extends ML_Modul_Model_Service_SyncInventory_Abstract {
    public function execute() {
        if ($this->syncIsEnabled()) {
            $aRequest = $this->getSyncInventoryRequest();
            $this->log('FetchInventory', self::LOG_LEVEL_LOW);
            try {
                do {
                    MagnaConnector::gi()->setTimeOutInSeconds($this->aRequestTimeouts['iSyncInventoryTimeout']);
                    $aResponse = MagnaConnector::gi()->submitRequest($aRequest);
                    $this->log(
                        'Received ' . count($aResponse['DATA']) . ' items ' .
                        '(' . ($aRequest['OFFSET'] + count($aResponse['DATA'])) . ' of ' . $aResponse['NUMBEROFLISTINGS'] . ') ' .
                        'in ' . microtime2human($aResponse['Client']['Time']),
                        self::LOG_LEVEL_LOW
                    );
                    $aResponse['DATA'] = empty($aResponse['DATA']) ? array() : $aResponse['DATA'];
                    $aUpdateRequest = array();
                    foreach ($aResponse['DATA'] as $iItem => $aItem) {
                        $this->log('currentItem: ' . json_encode($aItem), self::LOG_LEVEL_HIGH);
                        try {
                            $oProduct = MLProduct::factory()->getByMarketplaceSKU($aItem['SKU']);
                            if ($oProduct->exists()) {
                                $this->log(
                                    'SKU: ' . $aItem['SKU'] . ' (' . $aItem['ItemTitle'] . ') found (' .
                                    'MP-SKU: ' . $oProduct->get('MarketplaceIdentSku') . '; ' .
                                    'MP-ID: ' . $oProduct->get('MarketplaceIdentId') . '; ' .
                                    'Shop-SKU: ' . $oProduct->get('ProductsSku') . '; ' .
                                    'Shop-ID: ' . $oProduct->get('ProductsId') .
                                    ')',
                                    $iItem % 10 === 0 ? self::LOG_LEVEL_NONE : self::LOG_LEVEL_MEDIUM //log every 10th item to have continues output
                                );
                                @set_time_limit(180);
                                $aCurrentUpdateRequest = $this->getItemRequestData($oProduct, $aItem);
                                if (!empty($aCurrentUpdateRequest)) {
                                    $aUpdateRequest[$iItem] = $aCurrentUpdateRequest;
                                }
                                if (isset($aUpdateRequest[$iItem])) {
                                    $this->log(
                                        'SKU: ' . $aItem['SKU'] . ' (' . $aItem['ItemTitle'] . ') new data (' . json_encode($aUpdateRequest[$iItem]) . ')',
                                        self::LOG_LEVEL_MEDIUM
                                    );
                                    $aUpdateRequest[$iItem]['SKU'] = $aItem['SKU'];
                                }
                            } else {
                                $this->log('SKU: ' . $aItem['SKU'] . ' (' . $aItem['ItemTitle'] . ') not found');
                            }
                        } catch (Exception $oEx) {
                            $this->log('SKU: ' . $aItem['SKU'] . ' (' . $aItem['ItemTitle'] . ') throws Exception (' . $oEx->getMessage() . ')', self::LOG_LEVEL_LOW);
                        }
                    }
                    if (empty($aUpdateRequest)) {
                        $blNext = true;
                        $this->log('Nothing to update in this batch.', self::LOG_LEVEL_LOW);
                    } else {
                        $this->log('do UpdateRequest', self::LOG_LEVEL_LOW);
                        $this->log('UpdateRequest : ' . json_encode($aUpdateRequest), self::LOG_LEVEL_HIGH);
                        MagnaConnector::gi()->setTimeOutInSeconds($this->aRequestTimeouts['iUpdateItemsTimeout']);
                        try {
                            $this->log(
                                'UpdateResponse : ' . json_encode(
                                    MagnaConnector::gi()->submitRequest(array(
                                        'ACTION' => 'UpdateItems',
                                        'DATA' => $aUpdateRequest
                                    ))
                                ),
                                self::LOG_LEVEL_HIGH
                            );
                            $blNext = true;
                        } catch (Exception $oEx) {
                            $blNext = false;
                            $this->log($oEx->getMessage(), self::LOG_LEVEL_MEDIUM);
                            if ($oEx->getCode() == MagnaException::TIMEOUT) {
                                $oEx->setCriticalStatus(false);
                                $blNext = true;
                            }
                        }
                    }
                    if ($blNext) {
                        $aRequest['OFFSET'] += $aRequest['LIMIT'];
                    }
                    if ($aRequest['OFFSET'] < $aResponse['NUMBEROFLISTINGS']) {
                        $this->out(array(
                            'Done' => (int)$aRequest['OFFSET'],
                            'Step' => isset($aRequest['steps']) ? $aRequest['steps'] : false,
                            'Total' => $aResponse['NUMBEROFLISTINGS'],
                        ));
                    } else {
                        $blNext = false;
                    }
                    if (isset($aRequest['steps']) && $aRequest['steps'] <= 1) {
                        $blNext = false;
                    }
                } while ($blNext);
            } catch (MagnaExeption $oEx) {
                $this->log($oEx->getMessage(), self::LOG_LEVEL_MEDIUM);
            }
        }
        if (!isset($aRequest['steps']) || $aRequest['steps'] <= 1) {
            $this->out(array(
                'Complete' => 'true',
            ));
        }
        return $this;
    }
}
