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

// Part of the bootstrap. Load all neccessary classes.
require_once (dirname(__file__).DIRECTORY_SEPARATOR.'Filesystem.php');
$oFilesystem = MLFilesystem::gi();
foreach(
    array(
        $oFilesystem->glob(dirname(__file__).'/../'.DIRECTORY_SEPARATOR.'Codepool/10_Customer/Core/*.php'),//load core classes from customer-folder
        $oFilesystem->glob(dirname(__file__).DIRECTORY_SEPARATOR.'Abstract'.DIRECTORY_SEPARATOR.'*.php'),//abstract classes are not inherit
        $oFilesystem->glob(dirname(__file__).DIRECTORY_SEPARATOR.'*'.DIRECTORY_SEPARATOR.'Interface.php'),//interfaces are not inherit
        $oFilesystem->glob(dirname(__file__).DIRECTORY_SEPARATOR.'*'.DIRECTORY_SEPARATOR.'*.php'),//first subclasses eg. config/abstract
        $oFilesystem->glob(dirname(__file__).DIRECTORY_SEPARATOR.'*.php'),//load mainclasses
        $oFilesystem->glob(dirname(dirname(__file__)).DIRECTORY_SEPARATOR.'Alias'.DIRECTORY_SEPARATOR.'*')//alias classnames
    )
    as $aPaths
) {
    foreach($aPaths as $sPath){
        require_once $sPath;
    }
}

/**
 * Main class. Implements the factory pattern.
 * Routes requests and manages the syncronization processes.
 *
 * Can not be inherited.
 */
final class ML {
    const MAX_RECURSION_DEPTH = 10;

    protected static $blAdmin = false;
    protected static $blEvent = false;
    protected static $blInstalled = null;
    protected static $blUpdate = null;
    protected $blBootstrapped = false;
    /**
     * @var array $aInstances array of instances of classes
     */
    protected $aInstances = array();
    protected $aLoadedClasses = array();
    protected $aChildIdents = array();

    /**
     * @var ML $oInstance
     */
    protected static $oInstance = null;
    protected static $aAllInstances = array();

    /**
     * if we don't need to get currecnt version
     * @var bool
     */
    protected static $blFastLoad = false;

    /**
     * singleton protected constructor
     */
    protected function __construct(){

    }

    /**
     *
     * @param type $blFastLoad
     */
    public static function setFastLoad($blFastLoad) {
        self::$blFastLoad = $blFastLoad;
    }


    /**
     *
     * @return bool
     */
    public static function getFastLoad() {
        return self::$blFastLoad ;
    }

    /**
     * Strips objects and resources from stack traces to minify the output to only the relevant informations.
     *
     * @param array $a
     *    The stack trace (debug_backtrace(true))
     * @param int $lv
     *    The recursive level (do not use)
     *
     * @return array
     *    The cleaned stack trace
     */
    public static function stripObjectsAndResources($a, $lv = 0) {
        if (empty($a) || ($lv >= self::MAX_RECURSION_DEPTH))
            return $a;
        //echo print_m($a, trim(var_dump_pre($lv, true)));
        $aa = array();
        foreach ($a as $k => $value) {
            $toString = '';
            // echo var_dump_pre($value, 'value');
            if (!is_object($value) && !is_array($value)) {
                $toString = $value . '';
            }
            if (is_object($value)) {
                $value = 'OBJECT (' . get_class($value) . ')';
            } else if (is_resource($value) || (strpos($toString, 'Resource') !== false)) {
                if (is_resource($value)) {
                    $value = 'RESOURCE (' . get_resource_type($value) . ')';
                } else {
                    $value = $toString . ' (Unknown)';
                }
            } else if (is_array($value)) {
                $value = self::stripObjectsAndResources($value, $lv + 1);
            } else if (is_string($value)) {

            }
            if ($k == 'args') {
                if (is_string($value) && (strlen($value) > 5000)) {
                    $value = substr($value, 0, 5000) . '[...]';
                }
            }
            $aa[$k] = $value;
        }
        return $aa;
    }

    /**
     * Checks if the plugin is installed completely. Otherwise the missing files will be pulled
     * from the magnalister server.
     *
     * @return bool
     */
    public static function isInstalled() {
        if (self::$blInstalled === null) {
            self::$blInstalled = file_exists(MLFilesystem::getLibPath('ClientVersion'));
        }
        return self::$blInstalled;
    }

    /**
     * Checks if the plugin was anytime clomplete. Needs to decide wording in updater.
     *
     * @return bool
     */
    public static function isUpdate() {
        if (self::$blUpdate === null) {
            self::$blUpdate = file_exists(MLFilesystem::getLibPath('Update'));
        }
        return self::$blUpdate;
    }


    /**
     * Singleton, gets instance of self.
     * @return ML
     */
    public static function gi() {
        if (self::$oInstance === null) {
            $sDir = self::getWritablePath();
            try {
                try {//new urls to old parameters
                    $aController = explode('_', MLRequest::gi()->get('controller'));
                    $sPattern = '/^.*:(.*)$/';
                    if (preg_match($sPattern , $aController[0])) {
                        $aController[0] = preg_replace($sPattern, '$1', $aController[0]);
                    }

                    $aParams = array('mp');
                    foreach ($aParams as $iKey => $sParam) {
                        if (isset($aController[$iKey])) {
                            MLRequest::gi()->set($sParam, $aController[$iKey]);
                        }
                    }
                } catch (Exception $ex) {

                }
                $sInstanceName = md5(json_encode(MLRequest::gi()->data()));
                self::$oInstance = new ML();
                self::$aAllInstances[$sInstanceName] = self::$oInstance;
                self::$oInstance->init();
            } catch (Exception $oEx) {
                if (!file_exists($sDir.'magnalister_ForceCleanCache')) {
                    @file_put_contents($sDir.'magnalister_reason_of_force_clean.log',
                        date('Y-m-d H:i:s').':'.$oEx->getMessage()."\n".$oEx->getTraceAsString()."\n\n");
                    // try to clean cache and rebuild application again
                    @file_put_contents($sDir.'magnalister_ForceCleanCache', '');
                    try {
                        MLCache::gi()->flush();
                    } catch (Exception $oEx) {//MLCache dont exists
                        foreach (MLFilesystem::gi()->glob(MLFilesystem::gi()->getWritablePath('cache/*')) as $sPath) {
                            if (is_file($sPath)) {
                                @unlink($sPath);
                            }
                        }
                    }
                    try {
                        MLHttp::gi()->redirect('', 307);// redirect to clean all memory
                    } catch (Exception $oEx) {// no http class - we try it in same request
                        MLFilesystem::gi()->init();
                        if (isset($sInstanceName)) {
                            unset (self::$aAllInstances[$sInstanceName]);
                        }
                        self::$oInstance = null;
                        return self::gi();
                    }
                } else {
                    @file_put_contents($sDir.'install_errors.log',
                        date('Y-m-d H:i:s').':'.$oEx->getMessage()."\n".$oEx->getTraceAsString()."\n\n");

                    // cannot clean cache or it dont helps - suggest for update
                    echo '
                        magnalister konnte aus unbekannter Ursache nicht geladen werden. Damit sich magnalister aktualisieren kann, l&ouml;schen Sie bitte die Datei ClientVersion unter '.MLFilesystem::getLibPath().'.<br />
                        Achtung: Die magnalister-Dateien werden danach teilsweise &uuml;berschrieben, so dass Individualanpassungen an den Dateien verloren gehen k&ouml;nnen.<br />
                        <br />
                        Sollte die Ursache damit nicht behoben werden k&ouml;nnen, ben&ouml;tigt unser Support Shop-Admin und Server-Zugangsdaten (support@magnalister.com).
                        <br />
                        <br />
                        <br />
                        magnalister could not be loaded. To update magnalister, please delete the file ClientVersion at the location '.MLFilesystem::getLibPath().'.<br />
                        Caution: This triggers an overwrite of magnalister files. Custom changes can possibly get lost.<br />
                        <br />
                        If that doesn\'t help, please contact us (support@magnalister.com). We will need an access to the shop administration and an FTP access to the shop server.
                    ';
                    throw $oEx;
                }
            }
            MLHelper::getFilesystemInstance()->rm($sDir.'magnalister_ForceCleanCache');
        }
        return self::$oInstance;
    }

    /**
     * Executes part of the bootstrap based on the current request.
     * This also calls the init() methods of several required classes.
     */
    public function init($aRequestParams = array()) {
        $oRequest = MLRequest::gi()->init();
        try {//new urls to old parameters
            $aController = explode('_', MLRequest::gi()->get('controller'));
            $sPattern = '/^.*:(.*)$/';
            if (preg_match($sPattern , $aController[0])) {
                $aController[0] = preg_replace($sPattern, '$1', $aController[0]);
            }

            $aParams = array('mp');
            foreach ($aParams as $iKey => $sParam) {
                if (isset($aController[$iKey])) {
                    MLRequest::gi()->set($sParam, $aController[$iKey]);
                }
            }
        } catch (Exception $ex) {

        }
        foreach ($aRequestParams as $sKey => $mValue) {
            $oRequest->set($sKey, $mValue,true);
        }

        MLFilesystem::gi()->init();
        $sInstanceName = md5(json_encode(MLRequest::gi()->data()));
        if (isset(self::$aAllInstances[$sInstanceName])) {
            self::$oInstance = self::$aAllInstances[$sInstanceName];
            // some files are not included before minboot
            MLSetting::gi($sInstanceName)->includeFiles();
            MLI18n::gi($sInstanceName)->includeFiles();
        } else {
            self::$oInstance = new ML();
            self::$aAllInstances[$sInstanceName] = self::$oInstance;
            MLSetting::gi($sInstanceName)->init();
            MLI18n::gi($sInstanceName)->init();
        }
        if (self::isInstalled()) {
            //including init files - bootstrap
            foreach (MLFilesystem::gi()->getInitFiles() as $sFile) {
                include($sFile);
            }
        }
        try {
            MLShop::gi()->getShopInfo();
        } catch (\MagnaException $ex) {
            //passphrase is wrong
        }
        return self::$oInstance;
    }

    /**
     * It returns basic path it should be writable in the shop-systems
     * to write some basic logs and errors
     * @return string
     */
    protected static function getWritablePath() {
        if (defined('MAGNALISTER_WRITABLE_DIRECTORY')) {
            return MAGNALISTER_WRITABLE_DIRECTORY;
        }
        return MLFilesystem::getLibPath();
    }

    /**
     * Returns true if the plugin is called from the admin context of the shop.
     * @return bool
     */
    public function isAdmin() {
        return self::$blAdmin;
    }

    public function setEvent($blEvent) {
        self::$blEvent = $blEvent;
    }

    public function isEvent(){
        return self::$blEvent;
    }

    /**
     * Process the request. The generated response will be buffered and returned.
     *
     * @return string
     */
    public function run() {
        self::$blAdmin = true;
        MLMessage::gi();
        try {
            MLModule::gi(); //activate modul
        } catch (Exception $oEx) {

        }
        return $this->render();
    }

    /**
     * Run frontend requests. Eg. syncronization processes.
     * @param $sType
     * @return string
     */
    public function runFrontend($sType){
        MLRequest::gi();
        return $this->render($sType);
    }

    /**
     * renders complete plugin
     * @param string $sType only needed for frontend
     * @return string
     */
    protected function render($sType = null) {
        $sOut = '';
        $oRoute = $this->factory('model_route');
        /* @var $oRoute ML_Core_Model_Route */
        foreach ($oRoute->getControllers($sType) as $aController) {
            MLSetting::gi()->set('sMainController', get_class($aController['controller']), true);
            try {
                if ($oRoute->isPlainTextMode()) {
                    $aController['controller']->renderAjax();
                } else {
                    // we buffer, to add css, js files to header before output
                    ob_start();
                    $aController['controller']->render();
                    $sOut .= ob_get_contents() ;
                    ob_end_clean ();
                }
            } catch (Exception $oEx) {
                MLMessage::gi()->addDebug($oEx);
            }
        }
        if ($oRoute->isPlainTextMode()) {
            MagnalisterFunctions::stop();
        } else {
            return $sOut;
        }
    }

    /**
     * Runs the bootstrap, which currently uses parts of OldLib.
     * @parm bool $blDoBootstrap if false set bootstrapped to true (eg. for resources)
     * @return self
     */
    public function bootstrap($blDoBootstrap = true){
        if (!$blDoBootstrap) {
            $this->blBootstrapped = true;
        }
        if(!$this->blBootstrapped && ML::isInstalled()){
            $this->blBootstrapped = true;
            try{
                define('_ML_INSTALLED', true);
                MLI18n::gi()->setDefinesForOldMl();
                MLSetting::gi()->setDefinesForOldMl();
                foreach(MLFilesystem::gi()->glob(MLFilesystem::getOldLibPath('minBoot/functions/').'*.php') as $sFile){
                    require_once $sFile;
                }
                foreach(MLFilesystem::gi()->glob(MLFilesystem::getOldLibPath('minBoot/classes/').'*.php') as $sFile){
                    require_once $sFile;
                }


                ob_start();
                include(MLFilesystem::getOldLibPath('minBoot.php'));
                MLShop::gi()->getShopInfo();
                $sContent=  ob_get_clean();
                if(strlen($sContent)){
                    MLMessage::gi()->addDebug('minBoot.php generates output', htmlentities($sContent));
                }
                magnaFixRamSize();
                $this->init();
            }catch(OldMagnaExeption $oEx){
                switch($oEx->getCode()){
                    case OldMagnaExeption::iShopAdminDiePage:{//render as normal html @todo Mba
                        MLMessage::gi()->addFatal($oEx);
                    }
                }
            }catch(Exception $oEx){
                if($oEx->getMessage()!=''){
                    MLMessage::gi()->addFatal($oEx);
                }
            }
        }
        return $this;
    }

    /**
     * Creates an instance of a class. The instance will be saved and returned if the class
     * is requested a second time (Registry).
     *
     * @param string $sClassName
     *    Name of the class that will be created
     * @param array $aClassesToLoad
     *    List of dependencies that have to be created before the instance of
     *    $sClassName can be instanciated.
     *
     * @return object
     */
    public function instance($sClassName, $aClassesToLoad=array()){
        $sClassName=strtolower($sClassName);
        if(!isset($this->aInstances[$sClassName])){
            $this->aInstances[$sClassName] = $this->factory($sClassName,$aClassesToLoad);
        }
        return $this->aInstances[$sClassName];
    }

    /**
     * Creates an instance of a class.
     *
     * @param string $sClassName
     *    Name of the class that will be created
     * @param array $aClassesToLoad
     *    List of dependencies that have to be created before the instance of
     *    $sClassName can be instanciated.
     *
     * @return object
     */
    public function factory($sClassName, $aClassesToLoad=array()){
        foreach($aClassesToLoad as $sClassToLoad){
            if(!in_array($sClassToLoad,$this->aLoadedClasses)){
                $this->aLoadedClasses[]=$sClassToLoad;
                MLFilesystem::gi()->loadClass($sClassToLoad);
            }
        }
        $sCurrentClassName=  MLFilesystem::gi()->loadClass($sClassName);
        try {//aClassTreePatterns only setted in dev-modul to avoid this logic
            if (MLSetting::gi()->get('blDebug')) {
                foreach (MLSetting::gi()->get('aClassTreePatterns') as $sPattern) {
                    try {
                        $aDevBar = MLSetting::gi()->get('aDevBar-ClassTree');
                    } catch (Exception $ex) {
                        $aDevBar = array();
                    }
                    if (!array_key_exists($sClassName, $aDevBar)) {

                        $aClassTree = class_parents($sCurrentClassName);
                        $aClassTree = is_array($aClassTree)?$aClassTree:array();
                        $aInterfaces = class_implements($sCurrentClassName);
                        $aInterfaces = is_array($aInterfaces)?$aInterfaces :array();
                        foreach (array_merge($aClassTree, $aInterfaces) as $sWalkingClass) {
                            if (preg_match($sPattern, $sWalkingClass)) {
                                MLSetting::gi()->add('aDevBar-ClassTree', array($sClassName => $sCurrentClassName));
                                break;
                            }
                        }
                    }
                }
            }
        } catch (Exception $oEx) {//to early in bootstrap or not setted
        }

        $oRef= new ReflectionClass($sCurrentClassName);
        if ($oRef->isAbstract()) {
            throw new Exception('cannont initiate class');
        } else {
            if (
                $oRef->hasMethod('__construct')
                && !$oRef->getMethod('__construct')->isPublic()
            ){
                return call_user_func($sCurrentClassName.'::gi');
            }else{
                return new $sCurrentClassName;
            }
        }
    }

    /**
     * Returns a list of child class names for a class name.
     * @param string $sIdent
     * @param bool $blFullIdent
     *    Set this to true if the path should be returned as well.
     * @return array
     */
    public function getChildClassesNames($sIdent, $blFullIdent){
        $sIdent=  strtolower($sIdent);
        $iLength=  strlen($sIdent);
        if(!isset($this->aChildIdents[$sIdent])){
            $aChildIdents=array();
            $oFileSystem=  MLFilesystem::gi();
            $iFolderCount=substr_count($sIdent, '_')+1;
            foreach($oFileSystem->getBasePaths('class') as $sClassIdent=>$aClassInfo){
                if(
                    substr_count($sClassIdent, '_')==$iFolderCount
                    &&
                    substr($sClassIdent,0,$iLength)==$sIdent
                ){
                    $oRef= new ReflectionClass($oFileSystem->loadClass($sClassIdent));
                    if(!$oRef->isAbstract()){
                        $aCurrentClassInfo=current($aClassInfo);
                        $aChildIdents[basename($aCurrentClassInfo['path'])]=$sClassIdent;
                    }
                }
            }
            ksort($aChildIdents);
            $this->aChildIdents[$sIdent]=$aChildIdents;
        }
        $aOut=array();
        foreach($this->aChildIdents[$sIdent] as $sClassIdent){
            $aOut[]=$blFullIdent ? $sClassIdent:substr($sClassIdent,$iLength+1);
        }
        return $aOut;
    }
}