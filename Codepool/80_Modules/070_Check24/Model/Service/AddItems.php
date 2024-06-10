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
 * $Id$
 *
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
class ML_Check24_Model_Service_AddItems extends ML_Modul_Model_Service_AddItems_Abstract {

    protected function uploadItems() {
        $aRequest = array(
            'ACTION' => 'UploadItems',
            'SUBSYSTEM' => $this->oModul->getMarketPlaceName(),
            'MARKETPLACEID' => $this->oModul->getMarketPlaceId(),
        );
        try {
            if (!MLSetting::gi()->get('blDryAddItems')) {
                $aResponse = MagnaConnector::gi()->submitRequest($aRequest);
                if (isset($aResponse['ERRORS'])) {
                    foreach ($aResponse['ERRORS'] as $aError) {
                        $sMessage = (isset($aError['SUBSYSTEM']) ? $aError['SUBSYSTEM'].' : ' : '').(isset($aError['ERRORDATA']) && isset($aError['ERRORDATA']['SKU']) ? ' Item SKU ( '.$aError['ERRORDATA']['SKU'].' ) ' : '').$aError['ERRORMESSAGE'];
                        MLMessage::gi()->addWarn($sMessage, '', false);
                        MLErrorLog::gi()->addApiError($aError);
                    }
                }
                $this->additionalErrorManagement($aResponse);
            }
        } catch (MagnaException $oEx) {
            $this->handleException($oEx);
        } catch (Exception $oEx) {
            MLMessage::gi()->addDebug($oEx);
        }

        MLMessage::gi()->addDebug('Api Response: upload', json_indent(json_encode((isset($aResponse) && !empty($aResponse)) ? $aResponse : $aRequest)));
        if (isset($oEx)) {
            throw $oEx;
        } else {
            $aStatistic = $this->oList->getStatistic();
            if ($aStatistic['iCountPerPage'] != $aStatistic['iCountTotal']) {
                throw new Exception('list not finished');
            }

            return $this;
        }
    }

    protected function getProductArray() {
        $oHelper = MLHelper::gi('Model_Service_Product');
        $aMasterProducts = array();
        foreach ($this->oList->getList() as $oProduct) {
            $sParentSku = $oProduct->getMarketPlaceSku();
            foreach ($this->oList->getVariants($oProduct) as $oVariant) {
                if ($this->oList->isSelected($oVariant)) {
                    $oHelper->resetData();
                    $aMasterProducts[$oVariant->get('id')] = $oHelper->setVariant($oVariant)->getData();
                    $aMasterProducts[$oVariant->get('id')]['MasterSKU'] = $sParentSku;
                }
            }
        }

        return $aMasterProducts;
    }

    /**
     * Overridden method, because of asynchronous upload concept,
     * since cron will fire the action for product upload to MP, method uploadItems is not needed.
     *
     * @return $this
     * @throws Exception
     */
    public function execute() {
        $this->addItems();
        return $this;
    }

}
