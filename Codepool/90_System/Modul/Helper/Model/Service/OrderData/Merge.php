<?php
class ML_Modul_Helper_Model_Service_OrderData_Merge {
    
    protected $aCurrentOrder = null;
    
    protected $aExistingOrder = null;
    
    /**
     * @var ML_Shop_Model_Order_Abstract
     */
    protected $oMlOrder = null;
    
    public function mergeServiceOrderData($aNewOrder, $aExistingOrder, $oMlOrder){
        MLLog::gi()->add(MLSetting::gi()->get('sCurrentOrderImportLogFileName'), array(
            'MOrderId' => MLSetting::gi()->get('sCurrentOrderImportMarketplaceOrderId'),
            'PHP' => get_class($this).'::'.__METHOD__.'('.__LINE__.')',
            'OrderDataActual' => $aNewOrder,
            'OrderDataPrevious' => $aExistingOrder,
        ));
        $this->aCurrentOrder = $aNewOrder;
        $this->aExistingOrder = $aExistingOrder;
        $this->oMlOrder = $oMlOrder;
        $aMerged = array(
            'AddressSets'   => $this->mergeAddressSets(),
            'Order'         => $this->mergeOrder(),
            'MPSpecific'    => $this->mergeMpSpecific(),
            'Totals'        => $this->mergeTotals(),
            'Products'      => $this->mergeProducts(),
            
        );
        MLLog::gi()->add(MLSetting::gi()->get('sCurrentOrderImportLogFileName'), array(
            'MOrderId' => MLSetting::gi()->get('sCurrentOrderImportMarketplaceOrderId'),
            'PHP' => get_class($this).'::'.__METHOD__.'('.__LINE__.')',
            'OrderDataMerged' => $aMerged,
        ));
        return $aMerged;
    }
    
    protected function mergeAddressSets(){
        $aOld = isset($this->aExistingOrder['AddressSets']) ? $this->aExistingOrder['AddressSets'] : array();
        $aNew = isset($this->aCurrentOrder['AddressSets']) ? $this->aCurrentOrder['AddressSets'] : array();
        foreach ($aOld as $sAddress => $aAddress) {
            if (!isset($aNew[$sAddress]) || count($aNew[$sAddress]) == 0) {
                $aNew[$sAddress] = $aAddress;
            }
        }
        return $aNew;
    }
    
    /**
     * maximum value of each total is in use
     * only one kind of type possible
     * @return array
     */
    protected function mergeTotals() {
        $aOld = isset($this->aExistingOrder['Totals']) ? $this->aExistingOrder['Totals'] : array();
        $aNew = isset($this->aCurrentOrder['Totals']) ? $this->aCurrentOrder['Totals'] : array();
        foreach ($aNew as $iNewTotal => $aNewTotal) {
            foreach ($aOld as $iOldTotal => $aOldTotal) {
                if ($aOldTotal['Type'] == $aNewTotal['Type']) {
                    $aOldTotal['Value']=isset($aOldTotal['Value'])?$aOldTotal['Value']:0;
                    $aNewTotal['Value']=isset($aNewTotal['Value'])?$aNewTotal['Value']:0;
                    if (method_exists($this, 'mergetotal'.$aNewTotal['Type'])) {
                        $aNew[$iNewTotal] = $this->{'mergetotal'.$aNewTotal['Type']}($aOldTotal, $aNewTotal);
                    } else {
                        $aNew[$iNewTotal] = $this->mergeTotal($aOldTotal, $aNewTotal);
                    }
                    unset($aOld[$iOldTotal]);
                    break;
                }
            }
        }
        foreach ($aOld as $aOldTotal) {
            $aNew[] = $aOldTotal;
        }
        return $aNew;
    }
    
    /**
     * 
     * @param array $aOldTotal
     * @param array $aNewTotal
     * @return array newTotal
     */
    protected function mergeTotal ($aOldTotal, $aNewTotal) {
        return $aOldTotal['Value'] > $aNewTotal['Value'] ? $aOldTotal : $aNewTotal;
    }
    
    /**
     * just a dummy for mergin specific total
     * @return array newTotal
     */
    /*
    protected function mergeTotalShipping ($aOldTotal, $aNewTotal) {
        return $this->mergeTotal($aOldTotal, $aNewTotal);
    }
    //*/
    
    /**
     * add products, or change qty
     * @return array
     */
    protected function mergeProducts() {
        $aOld = isset($this->aExistingOrder['Products']) ? $this->aExistingOrder['Products'] : array();
        $aNew = isset($this->aCurrentOrder['Products']) ? $this->aCurrentOrder['Products'] : array();
        foreach ($aOld as $aOldProduct) {
            $aNew[] = $aOldProduct;
        }
        return $aNew;
    }
    /**
     * new value
     * @return array
     */
    protected function mergeOrder() {
        $aOld = isset($this->aExistingOrder['Order']) ? $this->aExistingOrder['Order'] : array();
        $aNew = isset($this->aCurrentOrder['Order']) ? $this->aCurrentOrder['Order'] : array();
        foreach ($aOld as $sOld => $mOld) {
            if (!isset($aNew[$sOld])) {
                $aNew[$sOld] = $mOld;
            }
        }
        return $aNew;
    }
    /**
     * new value
     * @return array
     */
    protected function mergeMpSpecific() {
        $aOld = isset($this->aExistingOrder['MPSpecific']) ? $this->aExistingOrder['MPSpecific'] : array();
        $aNew = isset($this->aCurrentOrder['MPSpecific']) ? $this->aCurrentOrder['MPSpecific'] : array();
        foreach ($aOld as $sOld => $mOld) {
            if (!isset($aNew[$sOld])) {
                $aNew[$sOld] = $mOld;
            }
        }
        return $aNew;
    }
    
}