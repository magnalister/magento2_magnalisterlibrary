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

/**
 * base controller nearly all concrete controllers extend it
 */
class ML_Core_Controller_Abstract{
    
    protected $aParameters = array();
    protected $oShop = null;
    /**
     * @var ML_Database_Model_Db 
     */
    protected $oDB = null;
    protected $oRequest = null;
    protected $oModul = null;

    /**
     * constructor set default values
     */
    public function __construct() {
        $this->oShop=  MLShop::gi();
        $this->oRequest=MLRequest::gi();
        if(ML::isInstalled()){
            $this->oDB = MLDatabase::getDbInstance();
        }
    }
    
    /**
     * Returns true if this controller is the one requested by the controller
     * request parameter (eg. ml[controller]=marketplace:12345_checkin).
     *
     * @return bool
     */
    protected function isCurrentController() {
        $sIdent = $this->getIdent();
        $sController = $this->getRequest('controller');
        if (preg_match('/:\\d+((_+)|($))/', $sController)) {
            $sController = preg_replace('/:\\d+((_+)|($))/', '$1', $sController);
        }
        return (strlen($sController) < strlen($sIdent)) || ($sIdent == $sController);
    }
    
    /**
     * Call method self::{'callAjax'.MLRequest::gi()->get('method')};
     */
    public function renderAjax() {
        try {
            $sAction =  MLRequest::gi()->get('method');
            if (method_exists($this, 'callAjax'.$sAction)) {
                $this->{'callAjax'.$sAction}();
            } else {
                throw new Exception('unknown command');
            }
        } catch( MLRequest_Exception $oEx){// no method
            MLSetting::gi()->add('aAjax', array('success' => true));
        } catch (Exception $oEx) {
              MLSetting::gi()->add('aAjax', array('success' => false));
              MLSetting::gi()->add('aAjax', array('error' => $oEx->getMessage()));
              MLMessage::gi()->addDebug($oEx);
        }
        $this->finalizeAjax();
    }
    
    /**
     * adding messages, debug to ajaxJson
     */
    protected function finalizeAjax() {
        $aAjax = MLSetting::gi()->get('aAjax');
        if (!isset($aAjax['Redirect'])) {//message after redirect
            ob_start();
            MLController::gi('widget_message')
                ->renderSuccess()
                ->renderInfo()
                ->renderWarn()
                ->renderNotice()
                ->renderError()
                ->renderFatal()
            ;
            if (!ML::isInstalled()) {
                MLController::gi('widget_message')->renderDebug();
            }
            $sMainMessages = ob_get_contents();
            ob_end_clean();
            if(!empty($sMainMessages)){
                MLSetting::gi()->add('aAjaxPlugin', array('dom' => array('#ml-js-pushMessages' => array('content' => $sMainMessages, 'action' => 'appendifnotexists'))));
            }
        }
        if (MLSetting::gi()->get('blDebug') && ML::isInstalled()) {
            $this->includeViewBuffered('main_debug_bar_ajax');//add ajax-debug info to aAjax
            if (is_array($this->getRequest('setting'))) {
                $this->includeViewBuffered('main_debug_bar_setting');//update setting
            }
        }
        $sJson=json_encode(array_merge($aAjax, array('plugin'=>  MLSetting::gi()->get('aAjaxPlugin'))));
        if(!MLSetting::gi()->get('blJsonBase64')){
            echo $sJson;
        }else{
            echo "\n{#".base64_encode($sJson)."#}\n";
        }
        MagnalisterFunctions::stop();
    }
    
    /**
     * finds a controller who is in filesystem deeper (a child) than current controller
     * @param string $sChild
     * @return ML_Core_Controller_Abstract
     */
    protected function getChildController($sChild){
        return MLController::gi($this->getIdent().'_'.$sChild);
    }
    
    /**
     * finds a controller who is in filesystem deeper (a child) than current controller and return its name
     * @param bool $blFullIdent
     * @return string
     */
    protected function getChildControllersNames($blFullIdent=false){
        return ML::gi()->getChildClassesNames('controller_'.$this->getIdent(), $blFullIdent);
    }
    
    /**
     * calculate ident of controller
     * @return string
     */
    protected function getIdent(){
        return substr(MLFilesystem::getIdent($this),11);
    }
    
    /**
     * alias method for http-class 
     * @param string $sFile
     * @param bool $blAbsolute
     * @return string
     */
    public function getResourceUrl($sFile='',$blAbsolute=true){
        return MLHttp::gi()->getResourceUrl($sFile,$blAbsolute);
    }
    
    /**
     * return url from magnalister-plugin
     * @param array $aParams
     * @return string
     */
    public function getUrl($aParams=array()){
        return MLHttp::gi()->getUrl($aParams);
    }
    
    /**
     * return frontend-do-url 
     * @param array $aParams
     * @return string
     */
    public function getFrontendDoUrl($aParams=array()){
        return MLHttp::gi()->getFrontendDoUrl($aParams);
    }
    
    /**
     * return url of parent controller
     * @param array $aParams
     * @return string
     */
    public function getParentUrl( $aParams = array()) {
        if ($this->aParameters == array('controller')) {
            $aParams = array_merge(array('controller' => substr($this->getRequest('controller'),0 , strrpos($this->getRequest('controller'), '_'))), $aParams);
        } else { //old urls deprecated
            $aDefault = array();
            $sMyKey = end($this->aParameters);
            foreach ($this->aParameters as $sKey) {
                $sRequest = $this->oRequest->data($sKey);
                if ($sRequest !== null && $sKey != $sMyKey) {
                    $aDefault[$sKey]=$sRequest;
                }
            }
            $aParams = array_merge($aDefault,$aParams);
        }
        return $this->getUrl($aParams);
    }
    
    /**
     * return current url
     * @param array $aParams
     * @return string
     */
    public function getCurrentUrl($aParams=array()){
        $aDefault=array();
        foreach($this->aParameters as $sKey){
            $sRequest=$this->oRequest->data($sKey);
            if($sRequest!==null){
                $aDefault[$sKey]=$sRequest;
            }
        }
        $aParams = array_merge($aDefault,$aParams);
        return $this->getUrl($aParams);
    }
    
    /**
     * returns current request-parameters
     * @param string $sName
     * @return string|array
     */
    public function getRequest($sName=null){
        return $this->oRequest->data($sName);
    }
    
    /**
     * translate a ident
     * @param string $sName
     * @return string
     */
    public function i18n($sName){
        return $this->__($sName);
    }
    
    /**
     * translate a ident
     * @param string $sName
     * @return string
     */
    public function __($sName){
        return MLI18n::gi()->{$sName};
    }
    
    /**
     * translate a ident and skip charectors if needed
     * @param string $sName
     * @param array $aSkip
     * @return string
     */
    public function __s($sName, $aSkip = array()){
        $sTranslation = MLI18n::gi()->{$sName};
        foreach ($aSkip as $sSkip) {
            $sTranslation = str_replace($sSkip, '\\'.$sSkip, $sTranslation);
        }
        return $sTranslation;
    }
    /**
     * render (html) output
     * @return \ML_Core_Controller_Abstract
     */
    public function render(){
//        include MLFilesystem::gi()->getViewPath($this->getIdent());
        $this->includeView();
        return $this;
    }
    
    /**
     * no variables in scope
     * @return \ML_Core_Controller_Abstract
     */
    protected function includeViewScoped(){
        extract(func_get_arg(1));
        include func_get_arg(0);
        return $this;
    }

    
    /**
     * if starts with "widget_" use (explode) $this->getIdent() to find template
     * if ends witch "_snippet" dont use debug
     * 
     * widget = complex global structure (productlist)
     * snippet = small stuff (formfield)
     * 
     * @param array $aViewNames array of view idents
     * @param string $aViewNames string of view ident
     * @param array $aVars vars for assign
     * @param bool $blAddFileErrorToMessage 
     * @return \ML_Core_Controller_Abstract
     */
    public function includeView( $aViewNames=array(), $aVars=array(), $blAddFileErrorToMessage=true){
        $aViewNames=is_string($aViewNames)?array($aViewNames):$aViewNames;
        $aViewNames=count($aViewNames)==0?array($this->getIdent()):$aViewNames;
        $aPossibleViewNames=array();
        foreach($aViewNames as $sViewName){
            $sViewName=  strtolower($sViewName);
            if(substr($sViewName,0,strpos($sViewName,'_'))=='widget'){//starts with widget_
                $sIdent=  strtolower($this->getIdent()).'_';
                while($sIdent=substr($sIdent,0, strrpos($sIdent, '_'))){
                    $aPossibleViewNames[]=$sViewName.'_'.$sIdent;
                }
            }
            $aPossibleViewNames[]=$sViewName;
        }
        $aExtract=array();
        foreach($aVars as $sKey=>$sValue){
            if($sKey!='this'){
                $aExtract[$sKey]=$sValue;
            }
        }
        foreach ($aPossibleViewNames as $sView) {
            unset($oFileEx);//dont rethrow
            try {
                $blDebug = MLSetting::gi()->get('blTemplateDebug') && substr($sView, strrpos($sView, '_')) != '_snippet';
                $sFile = MLFilesystem::gi()->getViewPath($sView);
                //                new dBug(array($sView=>$aPossibleViewNames));
                if ($blDebug) {
                    echo '<div data-content="controller: '.strtolower($this->getIdent()).' | view: '.$sView.'">';
                    $time = microtime(true);
                }

                $this->includeViewScoped($sFile, $aExtract);


                if ($blDebug) {
                    $executed_time = microtime(true) - $time;
                    echo '<div style="display: inline;">'.$sFile.': '.microtime2human($executed_time).'</div>';
                    echo '</div>';
                }
                break;
            } catch (ML_Filesystem_Exception $oFileEx) {

            } catch (Exception $oEx) {
                MLMessage::gi()->addNotice($oEx);
            }
        }
        if(isset($oFileEx)&&$blAddFileErrorToMessage){
            MLMessage::gi()->addNotice($oFileEx);
        }
        return $this;
    }
    
    /**
     * calls self::includeView(), but returns output instead echo
     * @param array $aViewNames
     * @param array $aVars
     * @param bool $blAddFileErrorToMessage
     * @return string
     */
    public function includeViewBuffered($aViewNames = array(), $aVars = array(), $blAddFileErrorToMessage = true) {
        ob_start();
        $this->includeView($aViewNames, $aVars, $blAddFileErrorToMessage);
        $sOut = ob_get_contents();
        ob_end_clean();
        return $sOut;
    }


    /**
     * It is useful when we are show a progress bar with magnalisterRecursiveAjax and we want to show error message in pop up dialog box
     * @param $sMessage
     * @return void
     */
    protected function showErrorInPopupProgressBar($sMessage) {
        MLSetting::gi()->add('aAjaxPlugin', array('dom' => array('#recursiveAjaxDialog .errorBox' => array('action' => 'append', 'content' => $sMessage))));
    }
}
