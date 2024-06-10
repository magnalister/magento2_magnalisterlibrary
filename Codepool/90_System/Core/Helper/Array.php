<?php
/**
 * Helper class for various array operations.
 */
class ML_Core_Helper_Array {
    
    /**
     * @see $this->mergeDistinct();
     * current array-key (for debug, recursive)
     * @var string $sArrayMergeDistinctCurrentKey
     */
    protected $sMergeDistinctCurrentKey = '';
    
    /**
     * @see $this->mergeDistinct();
     * container with multiple array-keys
     * @var array $aArrayMergeDistinctMultipleKeys
     */
    protected $aMergeDistinctMultipleKeys = array();
    
    /**
     * if array_keys have $sSeparator ('__') it will used as array and merged with existing data
     * eg:
     *  array('foo__bar__example'=>'test') 
     *  <=> array('foo'=>array('bar'=>array('example'=>'test')))
     * advanced eg:
     *  array('test__test'=>array('hallo__hallo'=>'foobar','hallo'=>array('foo'=>'bar')),'test'=>array('test'=>array('do'=>'da')));
     *  <=> array('test'=>array('test'=>array('hallo'=>array('hallo'=>'foobar','foo'=>'bar'),'do'=>'da')));
     * 
     * @param array $aArray
     * @param string $sSeparator 
     * @return array
     */
    public function flat2Nested($aArray, $sSeparator = '__') {
        $aOut = array();
        foreach ($aArray as $sKey => $mValue) {
            if (strpos($sKey, $sSeparator) !== false) {
                $mValue = is_array($mValue) ? $this->flat2Nested($mValue, $sSeparator) : $mValue;
                $aJson = json_decode('{"' . preg_replace('/' . $sSeparator . '(.*)/Uis', '":{"$1', $sKey) . '":' . json_encode($mValue) . str_repeat('}', substr_count($sKey, $sSeparator)) . '}', true);
                $aOut = $this->mergeDistinct($aOut, $aJson);
            } else {
                $aOut = $this->mergeDistinct($aOut, array(
                    $sKey => $mValue
                )); //[$sKey]=$mValue;
            }
        }
        return $aOut;
    }
    
    /**
     * makes a (deep) nested array to a flat-array
     * eg:
     *  array('test'=>array('test'=>array('hallo'=>array('hallo'=>'foobar','foo'=>'bar'),'do'=>'da')));
     *  <=> 
     *  array('test__test__hallo__hallo'=>'foobar', 'test__test__hallo__foo'=>bar, 'test__test__do'=>'da');
     * @param array $aArray
     * @param string $sSeparator
     * @return array
     */
    public function nested2Flat($aArray, $sSeparator = '__') {
        $aOut = array();
        foreach ($aArray as $sKey => $mValue) {
            if (is_array($mValue)) {
                foreach ($this->nested2Flat($mValue, $sSeparator) as $sSubKey => $sValue) {
                    $aOut[$sKey . $sSeparator . $sSubKey] = $sValue;
                }
            } else {
                $aOut[$sKey] = $mValue;
            }
        }
        return $aOut;
    }
    /**
     * search in nested array recursive if $sSearch have separator, it could be index of array
     * 
     * @param string $sSearchKey
     * @param array $aArray
     * @param string $sSeparator
     * @return mixed
     */
    public function findInNested ($sSearchKey, $aArray, $sSeparator = '__') {
        if (strpos($sSearchKey, $sSeparator) !== false) {
            $sCurrentSearchKey = $sSearchKey;
            foreach (array_reverse(explode($sSeparator, $sSearchKey)) as $sSearchSubKey) {// array_reverse best hit
                $sCurrentSearchKey = substr($sCurrentSearchKey, 0, -strlen($sSearchSubKey) - strlen($sSeparator));
                if (!empty($sCurrentSearchKey)) {
                    if (array_key_exists($sCurrentSearchKey, $aArray)) {
                        $sArrayKey = substr($sSearchKey, strlen($sCurrentSearchKey) + strlen($sSeparator));
                        $aCurrentArray = (array)$aArray[$sCurrentSearchKey];
                        $mRecursive = self::findInNested($sArrayKey, $aCurrentArray, $sSeparator);
                        if ($mRecursive !== null) {
                            return $mRecursive;
                        }
                    }
                }
            }
        }
        return array_key_exists($sSearchKey, $aArray) ? $aArray[$sSearchKey] : null;
    }
    
    /**
     * merge arguments (arrays) if they have same key the last value will be used
     * all keys will be used as assoc-array, so if you will merge numeric arrays you need to define the numbers
     * add debug message for developers if some keys are double
     * eg:
     *   array(1=>1,2=>2)
     * @return array
     */
    public function mergeDistinct($aArray0, $aArray1 /*, $aArrayN*/ ) {
        $aOut = array();
        foreach (func_get_args() as $aArg) { //get all keys
            $aKeys = array_merge(isset($aKeys) ? $aKeys : array(), array_keys($aArg));
        }
        
        $sMergeBackup = $this->sMergeDistinctCurrentKey;
        $blDebug = MLSetting::gi()->get('blDebug');
        $aArgs = func_get_args();
        
        foreach ($aKeys as $sKey) {
            foreach ($aArgs as $iArg => $aArg) {
                $this->sMergeDistinctCurrentKey .= '[' . $sKey . ']';
                if (isset($aArg[$sKey])) {
                    if (is_array($aArg[$sKey])) {
                        $aOut[$sKey] = $this->mergeDistinct(isset($aOut[$sKey]) ? $aOut[$sKey] : array(), $aArg[$sKey]);
                    } else {
                        if ( //debug for check, if all parameters was complete distinct arrays
                            $blDebug && isset($aOut[$sKey]) && ($aOut[$sKey] != $aArg[$sKey])
                        ) {
                            if (!isset($this->aMergeDistinctMultipleKeys[$this->sMergeDistinctCurrentKey])) { //get already setted value
                                $this->aMergeDistinctMultipleKeys[$this->sMergeDistinctCurrentKey][] = $aOut[$sKey];
                            }
                            if (!in_array($aArg[$sKey], $this->aMergeDistinctMultipleKeys[$this->sMergeDistinctCurrentKey])) { //check if new and setted value is queal
                                $this->aMergeDistinctMultipleKeys[$this->sMergeDistinctCurrentKey][] = $aArg[$sKey];
                            }
                        }
                        $aOut[$sKey] = $aArg[$sKey];
                    }
                }
                unset($aArgs[$iArg][$sKey]);
                $this->sMergeDistinctCurrentKey = $sMergeBackup;
            }
        }
        if ($this->sMergeDistinctCurrentKey == '' && $blDebug && count($this->aMergeDistinctMultipleKeys) > 0) {
            $sDebug = '<table style="padding-right:2em;">';
            $iMax   = 10;
            $iCount = 0;
            foreach ($this->aMergeDistinctMultipleKeys as $sKey => $aValue) {
                if ($iCount >= $iMax) {
                    break;
                } else {
                    ++$iCount;
                    $sDebug .= '<tr><td>' . $sKey . '</td><td>: ' . implode(', ', $aValue) . '</td></tr>';
                }
            }
            $sDebug .= (count($this->aMergeDistinctMultipleKeys) > $iMax ? '<tr><td colspan="2">... and ' . (count($this->aMergeDistinctMultipleKeys) - $iMax) . ' more</td></tr>' : '');
            $sDebug .= '</table>';
            MLMessage::gi()->addDebug('Multiple values in <span style="font-style:italic">' . __METHOD__ . '($aArray' . implode(', $aArray', array_keys(func_get_args())) . '</span>):<br />' . $sDebug, func_get_args());
            $this->aMergeDistinctMultipleKeys = array();
        }
        return $aOut;
    }
}
