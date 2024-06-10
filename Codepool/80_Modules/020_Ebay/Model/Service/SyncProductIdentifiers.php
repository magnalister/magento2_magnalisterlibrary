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

class ML_Ebay_Model_Service_SyncProductIdentifiers extends ML_Modul_Model_Service_SyncInventory_Abstract {
    
    protected $itemsProcessed = array();
    /**
     * @todo check config and addondata
     * @return boolean
     */
    protected function syncIsEnabled () {
        return MLModule::gi()->getConfig('syncproperties') == true;
    }
    
    protected function getSyncInventoryRequest () {
        $aParent = parent::getSyncInventoryRequest();
        $aParent['ORDERBY'] = 'DateAdded';
        $aParent['SORTORDER'] = 'DESC';
        return $aParent;
    }
    
    /**
     * returns empty array, because ebay upload is only single item, so we do it here
     * @param ML_Shop_Model_Product_Abstract $oProduct
     * @param array $aItem
     * @return array
     */
    protected function getItemRequestData($oProduct, $aItem) {
        $aUpdateRequest = array();
        if(in_array($aItem['ItemID'] , $this->itemsProcessed)){
            return array();
        }
                
        if($oProduct->get('parentid') != 0){
            $oMaster = $oProduct->getParent();
        }  else {
            $oMaster = $oProduct;
        }
        
        foreach (array('Brand' => 'productfield.brand' , 'MPN' => 'manufacturerpartnumber', 'EAN' => 'ean') as $sRequestName => $sConfigName) {
            if ($sRequestValue = $oMaster->getModulField($sConfigName)) {
                $aUpdateRequest[$sRequestName] = $sRequestValue;
            }
        }
        //Add Tecdoc

        if (!empty ($aUpdateRequest)) {
            $aUpdateRequest['SKU'] = $oMaster->getMarketPlaceSku();
            $aVariants = $oMaster->getVariants();
            foreach ($aVariants as $oVariant) {
                        $aUpdateRequest['Variations'][] = array(
                            'SKU' => $oVariant->getMarketPlaceSku(),
                            'EAN' => $oVariant->getEAN(),
                        );
            }
            if(isset($aUpdateRequest['Variations']) && count($aUpdateRequest['Variations']) < 2 ){
                unset($aUpdateRequest['Variations']);
            }
            $this->log('do UpdateRequest', self::LOG_LEVEL_LOW);
            $this->log('UpdateRequest : '. json_indent(json_encode($aUpdateRequest), self::LOG_LEVEL_HIGH));
             try {
                $this->log(
                    'UpdateProductListingDetails : '. json_indent(json_encode(
                        MagnaConnector::gi()->submitRequest(array (
                            'ACTION' => 'UpdateProductListingDetails',
                            'DATA' => $aUpdateRequest
                        )))
                    ), 
                    self::LOG_LEVEL_HIGH
                );
                $this->itemsProcessed[] = $aItem['ItemID'];
            } catch (MagnaException $oEx) {
                $this->log($oEx->getMessage(), self::LOG_LEVEL_MEDIUM);
                if ($oEx->getCode() == MagnaException::TIMEOUT) {
                    $oEx->setCriticalStatus(false);
                }
            }
        }
        return array();
    }
    
    /**
     * do nothing
     */
    protected function uploadItems() {
        return $this;
    }
    
}
