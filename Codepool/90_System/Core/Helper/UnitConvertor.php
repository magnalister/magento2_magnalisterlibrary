<?php

/**
 * Helper class for generic serializazion and deserialization operations.
 */
class ML_Core_Helper_UnitConvertor {

    /**
     * 
     * @param type $sUnit
     * @return real|int
     * @throws Exception
     */
    protected function getWeightRate($sUnit) {
        switch (strtolower($sUnit)) {
            case 'g': case 'gr' :case'gm':case'gram': return 1000;
            case 'kg':case 'kilogram': return 1;
            case 'oz':case 'ounce': return 35.273966;
            case 'lb':case 'lbm' :case 'pound': return 2.204623;
            case 'st': return 0.157473;
            default : throw new Exception('unit is not supported');
        }
    }

    /**
     * 
     * @param float $fWeight
     * @param string $sResUnit unit should be converted from
     * @param string $sDesUnit unit should be converted to
     * @return float|null
     */
    public function convertWeight($fWeight, $sUnitFrom, $sUnitTo) {
        try {
            $fRateFrom = $this->getWeightRate($sUnitFrom);
            $fRateTo = $this->getWeightRate($sUnitTo);
            return $fWeight * $fRateTo / $fRateFrom;
        } catch (Exception $oEx) {
            MLMessage::gi()->addDebug($oEx);
            return null;
        }
    }

}
