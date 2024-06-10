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
 * Class for handling filesystem.
 * it find files in cascading filesystem
 */
class MLFilesystem {

    /**
     * prefix for all classes inside of extension-path - filename don't have prefix
     * @var string $sPrefix
     */
    protected $sPrefix = 'ml_';
    
    protected static $oInstance = null;
    
    protected $aBasePaths=array();

    /**
     * Creates the instance of the class and creates the cache directory for the filesystem.
     */
    protected function __construct() {
        if (!file_exists(self::getCachePath())) {
            @mkdir(self::getCachePath(), 0777, true);
        }
    }

    /**
     * Singleton. Returns the created instance.
     * @return MLFilesystem
     */
    public static function gi() {
        if (self::$oInstance === null) {
            self::$oInstance = new MLFilesystem;
        }
        return self::$oInstance;
    }

    /**
     * Returns the prefix of the cache files.
     * @return string
     */
    public function getPrefix() {
        return $this->sPrefix;
    }
    
    /**
     * Builds the filesystem cache name for a class instance.
     * @param object $oClass
     * @return string
     */
    public static function getIdent($oClass) {
        $aClassName = explode('_', get_class($oClass));
        unset($aClassName[0]);
        $sPrefix = MLFilesystem::gi()->getPrefix();
        if (substr($sPrefix,-1) == '_') {
            unset($aClassName[1]);
        }
        $sIdent = implode('_', $aClassName);
        return strtolower($sIdent);
    }
    
    /**
     * Initializes the class and resets the base paths.
     * @return self
     * @todo did "all" need a reset?
     */
    public function init() {
        $this->aBasePaths = array('active' => array(), 'all' => array());
        return $this;
    }

    /**
     * Prepares the information where is what.
     * @return array array('class'=>array(), 'i18n'=>array(), ..)
     */
    protected function getClasses($aBasePaths, $blActive = true , $sBasePath = '') {
        $sDs = DIRECTORY_SEPARATOR;
        $sPrefix = $this->getPrefix();
        $aOut = array();

        if (!empty($sBasePath)) {
            if (file_exists($sBasePath.DIRECTORY_SEPARATOR.'isShop.php')) {
                $blIsShop = include($sBasePath.DIRECTORY_SEPARATOR.'isShop.php');
            } else {
                $blIsShop = false;
            }
            if (($blActive || $blIsShop) && file_exists($sBasePath.DIRECTORY_SEPARATOR.'isActive.php')) {
                $blIncludeClasses = include($sBasePath.DIRECTORY_SEPARATOR.'isActive.php');
            } else {
                $blIncludeClasses = true;
            }
        } else {
            $blIsShop = false;
            $blIncludeClasses = true;
        }

        $blUseCache = count($aBasePaths)>1;
        foreach ($aBasePaths as $sIdent=>$sValue) {
            $aOutCurrent = array();
            if ($blUseCache) {
                $sCacheFile = self::getCachePath(strtoupper(__CLASS__).'__'.strtolower($sIdent));
                if (($blActive || $blIsShop) && file_exists($sValue.$sDs.'isActive.php')) {
                    $sCacheFile .= (include($sValue.$sDs.'isActive.php')) ? '_active' : '_deactive' ;
                } elseif ($blActive) {
                    $sCacheFile .= '_active';
                } else {
                    $sCacheFile .='_all';
                }
                $sCacheFile .= '.json';
                if (file_exists($sCacheFile)) {
                    $mJson = json_decode(file_get_contents($sCacheFile), true);
                    if (is_array($mJson)) {
                        $aOut = array_merge_recursive($aOut, $mJson);
                        continue;
                    }
                }
            }
            $aSubPaths = $this->glob($sValue . $sDs . '*');
            if (is_array($aSubPaths)) {
                foreach ($aSubPaths as $sPath) {
                    if (is_dir($sPath)) {
                        $aOutCurrent = array_merge_recursive($aOutCurrent, $this->getClasses(array($sPath), $blActive, $sBasePath == '' ? $sValue : $sBasePath));
                    } elseif (!in_array(basename($sPath), array('isActive.php', 'isShop.php'))) {//don't need it moore
                            /**
                             * @var string $sType type of file (class, setting, i18n, ...)
                             */
                            $sType = strtolower(
                                substr(
                                    dirname($sPath),  
                                    strlen($sBasePath)+1,  
                                    strpos(substr(dirname($sPath),  
                                    strlen($sBasePath)+1), $sDs)
                                )
                            );
                            $sType =
                                $sType != ''
                                ? $sType
                                : strtolower(basename(dirname($sPath)))
                            ;
                            if (!in_array($sType, array('setting', 'view', 'i18n', 'resource', 'init', 'include'))) {//is class
                                $sType = 'class';
                                $sBaseName = basename($sPath);
                                $sTestNumericBaseName = substr($sBaseName,0,strpos($sBaseName, '_')-1);
                                if ($sTestNumericBaseName == ((string)(int)$sTestNumericBaseName)) {//have numeric index, dont use in classname, or ident => use number for sorting 
                                    $sBaseName = substr($sBaseName,  strpos($sBaseName, '_')+1);
                                }
                                $sIdentPath = dirname($sPath).$sDs.$sBaseName;
                            } else {//no-classes, just include
                                $sIdentPath = $sPath;
                            }
                        if (
                                $sType == 'resource'//can be any file
                                ||
                                pathinfo($sPath,PATHINFO_EXTENSION) == 'php'
                                ||
                                ($sType == 'i18n' && pathinfo($sPath,PATHINFO_EXTENSION) == 'csv')
                        ) {
                            if ($sType == 'resource' ) {//add extension to ident
                                $sName      = strtolower(str_replace($sDs, '_', substr($sIdentPath, strlen($sBasePath) + 1)));
                                $sTypeName  = strtolower(str_replace($sDs, '_', substr($sIdentPath, strlen(dirname($sBasePath)) + 1)));
                            } else {
                                $sName      = strtolower(str_replace($sDs, '_', substr($sIdentPath, strlen($sBasePath) + 1, -(strlen($sIdentPath) - strrpos($sIdentPath, '.')))));
                                $sTypeName  = strtolower(str_replace($sDs, '_', substr($sIdentPath, strlen(dirname($sBasePath)) + 1, -(strlen($sIdentPath) - strrpos($sIdentPath, '.')))));
                            }
                            if (is_numeric(substr($sTypeName, 0, strpos($sTypeName, '_')))) {
                                $sTypeName = substr($sTypeName, strpos($sTypeName, '_') + 1);
                            }
                            $sTypeName = $sPrefix . $sTypeName;
                            $aAllowedDeactiveTypes = $blIsShop ? array() : array(/*'i18n','setting',*/'resource','include');
                            if ($blIncludeClasses || in_array($sType, $aAllowedDeactiveTypes)){
                                $aOutCurrent[$sType][$sName][] = array('path' => $sPath, $sType => $sTypeName,);
                            }
                        }
                    }
                }
            }
            if($blUseCache){
                $sCacheFile = self::getCachePath(strtoupper(__CLASS__).'__'.strtolower($sIdent));
                if (($blActive || $blIsShop) && file_exists($sValue.$sDs.'isActive.php')) {
                    $sCacheFile .= (include($sValue.$sDs.'isActive.php')) ? '_active' : '_deactive';
                } elseif ($blActive) {
                    $sCacheFile .= '_active';
                } else {
                    $sCacheFile .= '_all';
                }
                $sCacheFile .= '.json';
                file_put_contents($sCacheFile, json_encode($aOutCurrent));
            }
            $aOut = array_merge_recursive($aOut, $aOutCurrent);
        }
        return $aOut;
    }
   
    /**
     * collect all classes with ident = regex($sidentPattern) as array
     * @param string $sIdentPattern regex-pattern
     * @param bool $blOnlyActive if true only from active moduls otherwise all
     * @return array
     */
    public function getClassCollection($sIdentPattern = '/.*/', $blOnlyActive = true) {
        $aOut = array();
        foreach ($this->getBasePaths('class', $blOnlyActive) as $sIdent => $aPaths) {
            if (preg_match($sIdentPattern, $sIdent)) {
                foreach ($aPaths as $aInfo) {
                    $aOut[$sIdent][] = $aInfo;
                }
            }
        }
        return $aOut;
    }
    
    /**
     * Prepares the information where is what.
     *  array(
     *      'config=>array(//self::findFile uses this vector
     *          'identName'=>array(//identName is for search
     *              array('path'=>'/path/to/file','class'=>'className'),//highest prio||iIndex=0
     *              array('path'=>'/path/to/other/file','class'=>'classNameOfOtherFile')//if dont found, searchs for class
     *          )
     *      ), 
     *      'class'=>array(..), 
     *      'i18n'=>array(..), 
     *      'view'=>array(..)
     * )
     * @link self::getClasses
     * @return array
     * @throws ML_Filesystem_Exception no shoptype found
     */
    public function getBasePaths($sType = null, $blActive = true) {
        if (empty($this->aBasePaths[$blActive ? 'active' : 'all'])) {
            $sDs = DIRECTORY_SEPARATOR;
            $sLibPath = self::getLibPath();
            $aBasePaths = array(); 
            foreach ($this->glob($sLibPath . 'Codepool' . $sDs . '*', GLOB_ONLYDIR) as $sBasePath) {
                $sExtension = basename($sBasePath);
                $aSubPaths = $this->glob($sBasePath . $sDs . '*', GLOB_ONLYDIR);
                $aSubPaths = is_array($aSubPaths) ? $aSubPaths :array();
                foreach ($aSubPaths as $sSubPath) {
                    $aBasePaths[$sExtension . '_' . basename($sSubPath)] = $sSubPath;
                }
            }
            ksort($aBasePaths);
            $aBasePaths = $this->getClasses($aBasePaths, $blActive);
//           if(class_exists('dBug',false)){new dBug($aBasePaths,'',true);}else{/*echo'<textarea>'.print_r($aBasePaths,true).'</textarea>';*/}
            $this->aBasePaths[$blActive ? 'active' : 'all'] = $aBasePaths;
        }
        if ($sType === null) {
            return $this->aBasePaths[$blActive ? 'active' : 'all'];
        } else {
            return isset($this->aBasePaths[$blActive ? 'active' : 'all'][$sType]) ? $this->aBasePaths[$blActive ? 'active' : 'all'][$sType] : array();
        }
    }

    /**
     * Returns the absolute path of the Lib/ directory (eg. /path/to/ml/Lib/).
     * @return string
     */
    public static function getLibPath($sPath = '') {
        $sPath = dirname(dirname(__file__)) . DIRECTORY_SEPARATOR.str_replace('/',DIRECTORY_SEPARATOR,$sPath);
        if (is_dir($sPath) && substr($sPath,-1) != DIRECTORY_SEPARATOR) {
            $sPath .= DIRECTORY_SEPARATOR;
        }
        return $sPath;
    }
    
    /**
     * Returns the absolute path of the OldLib/ directory.
     * @return string
     */
    public static function getOldLibPath($sPath='') { 
        return self::getLibPath('OldLib/'.$sPath);
    }
    
    /**
     * Returns the absolute path of the cache directory.
     * @return string
     */
    public static function getCachePath($sPath=''){
        if (defined('MAGNALISTER_CACHE_DIRECTORY')) {
            return MAGNALISTER_CACHE_DIRECTORY.$sPath;
        }
        return self::getWritablePath('cache'.DIRECTORY_SEPARATOR.$sPath);
    }
    
    /**
     * Returns the absolute path of the log directory.
     * @return string
     */
    public static function getLogPath($sPath='') {
        if (defined('MAGNALISTER_LOG_DIRECTORY')) {
            return MAGNALISTER_LOG_DIRECTORY.$sPath;
        }
        return self::getWritablePath('log'.DIRECTORY_SEPARATOR.$sPath);
    }
    
    /**
     * Returns the absolute path of the writable directory.
     * @return string
     */
    public static function getWritablePath($sPath=''){
        if (defined('MAGNALISTER_WRITABLE_DIRECTORY')) {
            return MAGNALISTER_WRITABLE_DIRECTORY.$sPath;
        }
        return dirname(self::getLibPath()).DIRECTORY_SEPARATOR.'writable'.DIRECTORY_SEPARATOR.$sPath;
    }

    /**
     * Gets the paths of all setting files.
     * @return array
     *    eg. array('/path/to/file', ...)
     */
    public function getSettingFiles() {
        $aOut = array();
        foreach ($this->getBasePaths('setting') as $aPaths) {
            foreach ($aPaths as $aInfo) {
                $aOut[] = $aInfo['path'];
            }
        }
        return $aOut;
    }
    
    /**
     * Gets the paths of all language files.
     * @return array
     *    eg. array('/path/to/file', ..)
     */
    public function getLangFiles($sLang) {
        $aOut = array();
        foreach ($this->getBasePaths('i18n') as $aPaths) {
            foreach ($aPaths as $aInfo) {
                if (strtolower(basename(dirname($aInfo['path']))) == strtolower($sLang)) {//filter actual lang
                    $aOut[] = $aInfo['path'];
                }
            }
        }
        return $aOut;
    }
    
    /**
     * Gets the paths of all init and include files.
     * @return array
     */
    public function getInitFiles() {
        $aOut = array();
        foreach ($this->getBasePaths('init') as $aPaths) {
            foreach ($aPaths as $aInfo) {
                $aOut[] = $aInfo['path'];
            }
        }
        foreach ($this->getBasePaths('include') as $aPaths) {
            foreach ($aPaths as $aInfo) {
                $aOut[] = $aInfo['path'];
            }
        }
        return $aOut;
    }

    /**
     * calls a static method of class without needing to instanciate
     * @param string $sClassName
     * @param string $sMethod
     * @param int $iIndex
     * @return mixed
     */
    public function callStatic ($sClassName, $sMethod, $iIndex = 0) {
        $aClassInfo = $this->findFile($sClassName, 'class', $iIndex);
        require_once($aClassInfo['path']);
        $oRef = new ReflectionMethod($aClassInfo['class'], $sMethod);
        return $oRef->invoke(null);
    }
    
    /**
     * Load class (smarter alias of with some basic autoloading require_once).
     * @param string $sClassName
     * @param integer $iIndex
     * @return string realClassName
     */
    public function loadClass($sClassName, $iIndex = 0) {
        $aClassInfo = $this->findFile($sClassName, 'class', $iIndex);
        require_once($aClassInfo['path']);
        return $aClassInfo['class'];
    }

    /**
     * Finds a view and returns its absolute file path.
     * @param string $sViewName
     * @param integer $iIndex
     * @return string
     *     eg. /path/to/view
     */
    public function getViewPath($sViewName, $iIndex = 0) {
        $aViewInfo = $this->findFile('view_'.$sViewName, 'view', $iIndex);
        return $aViewInfo['path'];
    }

    /**
     * Finds a file in magna-lib-extensions
     * @param string $sFilename
     * @param string $sFileType
     * @param integer $iIndex
     * @return array array('path'=>'/path/to/file', $type=>'identifier/of/type')
     * @throws ML_Filesystem_Exception file not found
     */
    protected function findFile($sFilename, $sFileType, $iIndex = 0) {
        $sFileType = strtolower($sFileType);
        $sFilename = strtolower($sFilename);
        $aBasePaths = $this->getBasePaths($sFileType);
        if (isset($aBasePaths[$sFilename][$iIndex])) {
            if (!file_exists($aBasePaths[$sFilename][$iIndex]['path'])) {
                throw new ML_Filesystem_Exception('File `' . $aBasePaths[$sFilename][$iIndex]['path'] . "` doesn't exists", 1444988637);
            }
            return $aBasePaths[$sFilename][$iIndex];
        } else {
            $sPrefix = $this->getPrefix();
            $sVector = substr($sFilename, strpos($sFilename, '_') + 1);
            if (isset($aBasePaths[$sVector])) {
                foreach ($aBasePaths[$sVector] as $aInfo) {
                    if ($aInfo['class'] == $sPrefix . $sFilename) {
                        if (!file_exists($aInfo['path'])) {
                            throw new ML_Filesystem_Exception('File `' . $aInfo['path'] . "` doesn't exists", 1444988637);
                        }
                        return $aInfo;
                    }
                }
            }
        }
        throw new ML_Filesystem_Exception('File `' . $sFilename . '` not found', 1356613047);
    }
    
    /**
     * Finds a hook file.
     *
     * A hook file is a simple php file which will be executed in place.
     * No methods/functions will be called, no classes will be instantiated.
     * The file will be included with require() and not one of the _once() derivates. The
     * hook file itsself has to make sure it defines all classes/functions only once to
     * avoid php errors.
     *
     * Hook files have to be placed in <ML Lib>/Codepool/10_Customer/Hooks/Hook/$sName_$iVersion.php
     *
     * @param string $sName
     *    Name of the hook
     * @param int $iVersion
     *    Version of the hook.
     *
     * @return string|bool
     *    If a hook file can be found the absolute path of the hook file will be returned.
     *    false otherwise.
     */
    public function findHook($sName, $iVersion) {
        try {
            $aFile = $this->findFile('hook_'.$sName.'_'.$iVersion, 'class');
            return $aFile['path'];
        } catch (Exception $oEx) {
            return false;
        }
    }

    /**
     * Finds a resource file and returns its absolute path.
     *
     * @param string $sResource
     * @return array
     * @throws ML_Filesystem_Exception
     */
    public function findResource($sResource){
        $iPos = strpos($sResource, '?');
        $sResource = $iPos ? substr($sResource, 0, $iPos) : $sResource;
        $sResource=  str_replace('/', '_', $sResource);
//        echo $sResource;
        return $this->findFile($sResource, 'resource');
    }
    
    /**
     * Returns an array of files matching the requested pattern.
     * @param string $pattern
     * @param int $flags
     * @param array $aExclude exclude filenames | default = index.php
     * @return array
     */
     public static function glob($pattern, $flags = 0, $aExclude = array('index.php')) {
        $aExclude[] = '.';
        $aExclude[] = '..';
        $mFiles = glob($pattern, $flags);
        if (is_array($mFiles)) {
            foreach ($mFiles as $iFile => $sFile) {
                if (in_array(basename($sFile), $aExclude)) {
                    unset($mFiles[$iFile]);
                }
            }
            sort($mFiles);// keys are iterable with for($i = 0; count($aFiles); ++$1){}
            return $mFiles;
        } else {
            return array();
        }
    }
}
