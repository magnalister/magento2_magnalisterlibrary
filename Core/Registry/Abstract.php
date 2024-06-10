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

/**
 * Base class for registry inside of ml-plugin
 */
abstract class MLRegistry_Abstract {
    
    protected static $aInstances = array();

    protected static $aAllInstances = array();

    protected $aData = array();
    
    /**
     * @var string exception-class to throw
     */
    protected $sExceptionClass = '';
    
    /**
     * @var bool return default(input)-value instead throw exception
     */
    protected $blDefaultValue = false;
    
    /**
     * @var bool $blReplaceMode if false disable replaceing
     */
    protected $blReplaceMode = true;
    
    /**
     * Creates an instance of the class.
     */
    protected function __construct() {
    }
    
    
    /**
     * @param string $sInstance name of instance-type
     * @abstract php<=5.2 dont allow it
     */
    #abstract public static function gi($sInstance = null);
    
    /**
     * Sets the replace mode.
     *    true: Enables replaceing
     *    false: Disables replaceing
     * @param bool $blMode
     * @return self
     */
    public function setReplaceMode($blMode) {
        $this->blReplaceMode = $blMode;
        return $this;
    }
    
    /**
     * Registeres a class and returns the insance of the class.
     * @param string $sClass
     *    The class name
     * @param string $sInstance
     *    The name of the instace. Enables you to create multiple instances of
     *    a class using different names.
     * @return MLRegistry_Abstract
     */
    protected static function getInstance($sClass, $sInstance = null) {
        if ($sInstance === null && isset(self::$aInstances[$sClass])) {//current Instance
            return self::$aInstances[$sClass];
        } else {
            $sInstance = $sInstance === null ? '' : $sInstance;
            if (!isset(self::$aAllInstances[$sClass][$sInstance])) {
                $oInstance = new $sClass;
                $oInstance->sExceptionClass = $sClass.'_Exception';
                self::$aInstances[$sClass] = $oInstance;
                $oInstance->bootstrap();
                self::$aAllInstances[$sClass][$sInstance] = $oInstance;
            } else {
                self::$aInstances[$sClass] = self::$aAllInstances[$sClass][$sInstance];
            }
            return self::getInstance($sClass);
        }
    }
    
    /**
     * Set defines for old magnalister.
     * @deprecated 
     * @return MLRegistry_Abstract
     */
    public function setDefinesForOldMl() {
        foreach ($this->data() as $sName => $mValue) {
            if (
                !defined($sName) 
                && (
                    (strpos($sName,'ML_')===0)
                    || (strpos($sName,'MAGNA_')===0)
                )
                && is_string($mValue)
            ) {
                define($sName, $mValue);
            }
        }
        return $this;
    }
    
    /**
     * Called after create instance.
     * Prepares the current instance.
     */
    abstract protected function bootstrap();
    
    /**
     * setter for config value
     * if $sName have '__' it will used as array and merged with existing data
     * eg:
     *  foo__bar__example => array('foo'=>array('bar'=>array('example'=>$mValue)))
     * @param string $sName
     * @param mixed $mValue
     * @param bool $blForce
     * @return MLRegistry_Abstract
     * @throws MLAbstract_Exception
     */
    public function set($sName, $mValue, $blForce = false) {
        if (strpos($sName,'__') !== false ) {
            $aData = MLHelper::getArrayInstance()->flat2Nested(array($sName => $mValue));

            $this->aData = array_merge_recursive($this->aData, $aData);
        } else {
            if (!isset($this->aData[$sName]) || $blForce) {
                $this->aData[$sName] = $mValue;
            } else {
                throw new $this->sExceptionClass('Value `'.$sName.'` alerady exists.', 1356259108);
            }
        }
        return $this;
    }

    /**
     * @param $sName
     * @param $mValue
     * @return $this
     */
    public function overwrite($sName, $mValue) {
        if (strpos($sName,'__') !== false ) {
            $aData = MLHelper::getArrayInstance()->flat2Nested(array($sName => $mValue));

            $this->aData = array_replace_recursive($this->aData, $aData);
        } else {
            $this->aData[$sName] = $mValue;
        }

        return $this;
    }
    
    /**
     * catches exeption
     * @see MLRegistry::set()
     * @param string $sName
     * @param mixed $mValue 
     */
    public function __set($sName, $mValue) {
        try {
            $this->set($sName, $mValue);
        } catch(Exception $oEx) {
            
        }
    }
    
    /**
     * catches exception
     * @see MLRegistry::get()
     * @param string $sName
     * @return mixed
     */
    public function __get($sName) {
        try {
            return $this->get($sName);
        } catch(Exception $oEx) {
            return null;
        }
    }
    
    /**
     * Merge $sName data from all current instances (eg. Request model, Settings model).
     * @param string $sName
     * @param array $aReplace
     * @return array
     */
    public function getGlobal($sName, $aReplace = array()) {
        if (!$this->blReplaceMode) {
            $aOut = $this->get($sName, $aReplace);
        } else {
            try {
                $aOut = $this->get($sName, $aReplace);
            } catch (MLAbstract_Exception $oEx) {
                $aOut = array();
            }
            foreach (self::$aInstances as $oCurrent) {
                if ($oCurrent->blReplaceMode && get_class($oCurrent) != get_class($this)) {
                    try {
                        $aOut = MLHelper::getArrayInstance()->mergeDistinct($oCurrent->get($sName, $aReplace), $aOut);
                    }catch(Exception $oEx){
                        // instance dont have $sName
                    }
                }
            }
        }
        return $aOut;
    }
    static $aExceptionCache = array();
    /**
     * Getter for setted values, Content can be replaced.
     * @param string $sName
     * @param array $aReplace
     * @return mixed
     * @throws MLAbstract_Exception
     */
    public function get($sName, $aReplace = array()) {
        if (isset($this->aData[$sName])) {
            return $this->replace($this->aData[$sName], $aReplace);
        }
        if (!empty($sName) && strpos($sName, '__') !== false) {//perhaps in nested
            $mSearchValue = MLHelper::getArrayInstance()->findInNested($sName, $this->aData, '__');
            if ($mSearchValue !== null) {
                return $this->replace($mSearchValue, $aReplace);
            }
        }
        if ($this->blDefaultValue === true){//return input because not found
            return $this->replace($sName, $aReplace);
        } else {
            if(!isset(self::$aExceptionCache[$this->sExceptionClass.$sName])){
                self::$aExceptionCache[$this->sExceptionClass.$sName] = new $this->sExceptionClass('Value `'.$sName.'` does not exist.', 1356095474);
            }
            throw self::$aExceptionCache[$this->sExceptionClass.$sName];

        }
    }
    
    /**
     * looks in mdata for {#i18n:i18nkey#} and replace results with $this->get('i18nkey')
     * @param array $aReplace looks for {#key#} replace value
     * @param mixed $mData string or array
     */
    public function replace($mData, $aReplace) {
        if ($this->blReplaceMode) {
            if (is_string($mData)) {
                $aMatch = array();
                if (preg_match_all('/\{#i18n:\s*(.*)#\}/Uis', $mData, $aMatch) > 0) {
                    foreach ($aMatch[0] as $iI18n => $sSearch) {
                        if ($sSearch == $mData) { // same value, could be array
                            $mData = MLI18n::gi()->get($aMatch[1][$iI18n]);
                            if (!is_string($mData)) {
                                break;
                            }
                        }
                        $mData = str_replace($sSearch, MLI18n::gi()->get($aMatch[1][$iI18n]), $mData);
                    }
                    if (MLI18n::gi()->isTranslationActive()) {
                        MLI18n::gi()->addGlobalTranslationData(array_values($aMatch[1]));
                    }
                }
            }
            if (is_string($mData)) {
                $aMatch = array();
                if (preg_match_all('/\{#setting:\s*(.*)#\}/Uis', $mData, $aMatch) > 0) {
                    foreach ($aMatch[0] as $iI18n => $sSearch) {
                        if ($sSearch == $mData) { // same value, could be array
                            $mData = MLSetting::gi()->get($aMatch[1][$iI18n]);
                            if (!is_string($mData)) {
                                break;
                            }
                        }
                        $mData = str_replace($sSearch, MLSetting::gi()->get($aMatch[1][$iI18n]), $mData);
                    }
                }
            }
            if (is_string($mData)) {
                foreach ($aReplace as $sKey => $sValue) {
                    $mData = str_replace('{#'.$sKey.'#}', $sValue, $mData);
                }
            }
            if(is_array($mData)) {
                foreach ($mData as &$mValue) {
                    $mValue = $this->replace($mValue, $aReplace);
                }
                unset($mValue);
            }
        }
        return $mData;
    }
    
    /**
     * add config to existing (as array)
     * @param string $sName
     * @param string|array $mValue
     * @param bool $blOverwrite , this parameter didn't exist before but we added this because of some shop need to overwrite some of default value in i18n or other setting
     * so please use it carefully and with a lot of test
     */
    public function add($sName, $mValue, $blOverwrite = true) {
        $mValue = is_string($mValue) ? array($mValue) : $mValue;
        if (isset($this->aData[$sName])) {
            $aOld = (array) $this->aData[$sName];//$this->get($sName); uses replace and can try to get unsetted values which throws exception
        } else {
            $aOld = array();
        }
        try {
            if ($blOverwrite) {
                $this->set($sName, self::arrayMergeRecursiveSimple($aOld, $mValue), true);
            } else {
                $this->set($sName, self::arrayMergeRecursiveSimple($mValue, $aOld), true);
            }
        } catch(Exception $oEx){
        }
        return $this;
    }
    
    /**
     * Merges multiple arrays.
     * @return array
     * @throws Exception
     */
    protected static function arrayMergeRecursiveSimple() {
        if (func_num_args() < 2) {
            throw new Exception('needs two or more array arguments');
        }
        $aArrays = func_get_args();
        $aMerges = array();
        while ($aArrays) {
            $aArray = array_shift($aArrays);
            if (!is_array($aArray)) {
                throw new Exception('encountered a non array argument');
            }
            if (!$aArray){
                continue;
            }
            foreach ($aArray as $mKey => $mValue){
                if (is_string($mKey)){
                    if (is_array($mValue) && array_key_exists($mKey, $aMerges) && is_array($aMerges[$mKey])){
                        $aMerges[$mKey] = self::arrayMergeRecursiveSimple($aMerges[$mKey], $mValue);
                    }else{
                        $aMerges[$mKey] = $mValue;
                    }
                }else{//int
                    $aMerges[] = $mValue;
                }
            }
        }
        return $aMerges;
    }
    
    /**
     * Getter for setted values that doesn't throw exceptions.
     * @param ?string $sName
     *     If set to null all data will be returned.
     * @param array $aReplace
     *     Array with key-value pairs for search and replace
     * @return ?mixed
     *     1: null if the key was not found
     *     2: Array with all data (replaced) if $sName was null
     *     3: Value of the key $sName (replaced)
     */
    public function data($sName = null, $aReplace = array()) {
        if ($sName === null) {
            $aOut = array();
            foreach (array_keys($this->aData) as $sKey) {
                try {
                    $aOut[$sKey]=$this->get($sKey, $aReplace);
                } catch (Exception $oEx) {
//                    echo $oEx->getMessage().'<br />';
                }
            }
            return $aOut;
        } elseif (isset($this->aData[$sName])) {
            return $this->get($sName, $aReplace);
        }else{
            return null;
        }
    }
    
    /**
     * Initilaize class. Resets all values to their default.
     * @return \MLRegistry_Abstract
     */
    public function init() {
        $oRef = new ReflectionClass($this);
        $aStaticProperties = array_keys($oRef->getStaticProperties());
        foreach ($oRef->getDefaultProperties() as $sKey => $mValue) {
            if ($sKey != 'sExceptionClass' && !in_array($sKey, $aStaticProperties)) {
                $this->$sKey = $mValue;
            }
        }
        $this->bootstrap();
        return $this;
    }
    
}
