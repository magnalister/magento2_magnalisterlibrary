<?php
/**
 * Helper class for generic serializazion and deserialization operations.
 */
class ML_Core_Helper_Encoder {
    
    /**
     * decoding have memory leak seems that every json_encode, serialize stays in memory
     * 
     * @var array
     */
    protected static $aDecodeCache = array();
    
    /**
     * Encodes a data element
     * @param mixed $mValue
     *    The element that has to be encoded.
     *    Arrays will be json encoded
     *    Objects will be serialized
     *    Other values will be converted to string unless they are null.
     * @return ?string
     */
    public function encode($mValue) {
        if (is_array($mValue)) {
            $sValue = json_encode($mValue);
        } elseif (is_object($mValue)) {
            $sValue = serialize($mValue);
        } elseif ($mValue !== null) {
            $sValue = (string) $mValue;
        } else {
             $sValue = null;
        }
        return $sValue;
    }

    /**
     * Decodes a string to an Array or Object.
     * @param ?string $mData
     * @return mixed
     *    The decoded array or object.
     */
    public function decode($mData, $blSerializable = false) {
        if ($mData !== null){
            if (is_string($mData)) {
                $sHash = md5($mData);
                if (array_key_exists($sHash, self::$aDecodeCache)) {
                    return self::$aDecodeCache[$sHash];
                }
            } else {
                $sHash = null;
            }
            $aJson = json_decode($mData, true);
            if (is_array($aJson)) {
                $mData = $aJson;
            } else {
                $oSerialized = null;
                if($blSerializable){
                    if (is_string($mData) && (strpos($mData, 'O:') === false || !preg_match('/(^|;|{|})O:[0-9]+:"/', $mData)) ) {
                        $oSerialized = @unserialize($mData);
                    }
                }
                if (is_object($oSerialized)) {
                    $mData = $oSerialized;
                } else {
                    $mData = (string) $mData;
                }
            }
            if ($sHash !== null && !is_object($mData)) {// dont cache objects, they are references
                self::$aDecodeCache[$sHash] = $mData;
            }
        }
        return $mData;
    }

}
