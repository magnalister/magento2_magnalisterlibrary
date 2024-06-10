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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

/**
 * Implements some generic methods that can be shared between various shopsystems for the
 * Http Model
 */
abstract class ML_Shop_Model_Http_Abstract {
    
    static protected $sImagePath = null;

    /**
     * Implodes the params in standard behavior  (name1=value1&name2=value2...)
     * concrete class can use this 
     * if concrete class use mod_rewrite, dont use me
     * @param array $aParams
     * @return string
     */
    public function getUrl($aParams = array()){
        $sPrefix = MLSetting::gi()->get('sRequestPrefix');
        if ($sPrefix != '') {
            $aParams=array($sPrefix => $aParams);
        }
        return urldecode(http_build_query($aParams, '', '&'));
    }
    
    /**
     * Returns only request data that has been prefixed by our prefix (currently ml).
     *
     * If sRequestPrefix is setted (MLSetting::gi()->sRequestPrefix = 'ml') it just returns the defined array value
     * eg. 
     *    sRequestPrefix= 'ml'
     *    param $aArray = array('key' => 'value', 'session' => '535jkhk345jkh34', 'ml[module]' => 'tools', ml['tools'] => 'config' )
     *    => return array('module' => 'tools', 'tools' => 'config');
     * Otherwise full array
     * @return array
     */
    protected function filterRequest($aArray){
        $sPrefix = MLSetting::gi()->get('sRequestPrefix');
        if ($sPrefix != '') {
            $aArray = isset($aArray[$sPrefix]) ? $aArray[$sPrefix] : array();
            if (isset($aArray['FullSerializedForm'])) {
                $aRequestArray= $this->parseUrlToArray($aArray['FullSerializedForm']);
                foreach ($aRequestArray[$sPrefix] as $sKey => $mValue) {
                    if(!isset($aArray[$sKey])){
                        $aArray[$sKey] = $mValue;
                    }
                }
                unset($aArray['FullSerializedForm']);
            }
            $aArray = $this->validate($aArray);
        }
        return $aArray;
    }
    
    protected function validate($aArray){
        if(isset($aArray['controller']) && is_array($aArray['controller'])){
            unset($aArray['controller']);
        }
        return $aArray;
    }


    /**
     * Wraps a field name with the ml prefix.
     * @return string
     */
    public function parseFormFieldName($sString) {
        $sPrefix = MLSetting::gi()->get('sRequestPrefix');
        if ($sPrefix != '') {
            $iPos = strpos($sString, '[');
            if ($iPos !== false) {
                $sOut = $sPrefix.'['.substr($sString, 0, $iPos).']'.substr($sString, strpos($sString, '['));
            } else {
                $sOut = $sPrefix.'['.$sString.']';
            }
        } else {
            $sOut = $sString;
        }
        return $sOut;
    }

    /**
     * Redirects to url
     * @return null
     * @var int $iStatus
     * @var string|array $mUrl as string is complete url and use $this->getUrl($mUrl);
     */
    public function redirect($mUrl, $iStatus = 302, $aReason = array()) {
        if (is_array($mUrl)) {
            $sUrl = $this->getUrl($mUrl);
        } else {
            $sUrl = $mUrl;
        }  
        if (function_exists('header_remove')) {
            header_remove(); //(PHP 5 >= 5.3.0)
        }
        $sNoR = MLRequest::gi()->data('nor');
        if ($sNoR !== null) {
            $iNumber = (int)$sNoR;
            if ($iNumber > 2) {
                return null;//it seems there is a loop
            }
            $iNumber++;
        } else {
            $iNumber = 1;
        }
        if ($sUrl !== MLHttp::gi()->getCurrentUrl()) {
            MLMessage::gi()->addDebug('It is redirected from: ' . MLHttp::gi()->getCurrentUrl(), $aReason);
            header('Location: ' . $sUrl . '&ml[nor]=' . $iNumber, true, $iStatus);
            MagnalisterFunctions::stop();
        }
    }
    
    /**
     * Returns true if the current request is an ajax request.
     * @return bool
     */
    public function isAjax() {
        $aServer = $this->getServerRequest();
        if (
            MLRequest::gi()->data('ajax')
            || (isset($aServer['HTTP_X_REQUESTED_WITH']) && ($aServer['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'))
        ) {
            return true;
        }
    }
    
    /**
     * return directory or path (file system) of specific shop images
     * @param string $sFiles
     */
    public function getImagePath($sFile) {
        if(self::$sImagePath === null ){
            $sImagePath = $this->getShopImagePath();
            if(file_exists($sImagePath) && is_writable($sImagePath)){
                if(!file_exists($sImagePath.'magnalister/')){
                    mkdir($sImagePath.'magnalister/');
                }
                self::$sImagePath = $sImagePath.'magnalister/';
            }else{
                MLMessage::gi()->addError(MLI18n::gi()->get('sException_update_pathNotWriteable', array(
                    'path' => $sImagePath
                  )));
                throw new Exception('cannot create images');
            }
        }
        return self::$sImagePath.$sFile;
    }
    
    /**
   * return url of specific shop images
   * @param string $sFiles
   */
    public function getImageUrl($sFile){
        if(self::$sImagePath === null || self::$sImagePath === false ){
            throw new Exception('cannot create images ');
        }else{
            $aImageEncoded = array();
            foreach (explode('/', $sFile) as $sFilePart) {
                $aImageEncoded[] = rawurlencode(rawurldecode($sFilePart));//decode and encode together to be sure that orginal url is not encoded
            }
            return $this->getShopImageUrl().'magnalister/'. implode('/', $aImageEncoded);
        }
    }
    
    /**
     * return current url
     * @param array $aParams
     * @return string
     */
    public function getCurrentUrl($aParams=array(),$aParameters=array('controller')){
        $aDefault=array();
        foreach($aParameters as $sKey){
            $sRequest=  MLRequest::gi()->data($sKey);
            if($sRequest!==null){
                $aDefault[$sKey]=$sRequest;
            }
        }
        $aParams = array_merge($aDefault,$aParams);
        return $this->getUrl($aParams);
    }
        
    /**
     * @param $sUrlString
     * @return array
     */
    protected function parseUrlToArray($sUrlString) {
        $aArray = array();
        if ($sUrlString != '') {
            $aPairs = explode('&', $sUrlString);
            $blIsUrlEncoded = (strpos($sUrlString, '%5B') !== false);
            foreach ($aPairs as $sPair) {
                $aKeyValue = explode('=', $sPair);
                if (is_array($aKeyValue)) {
                    $mKey = isset($aKeyValue[0]) ? ($blIsUrlEncoded ? urldecode($aKeyValue[0]) : $aKeyValue[0]) : null;
                    $mValue = isset($aKeyValue[1]) ? ($blIsUrlEncoded ? urldecode($aKeyValue[1]) : $aKeyValue[1]) : null;
                    if (strpos($mKey, '[') !== false) {
                        $aKeys = explode('[', $mKey);
                        $aArray = $this->mlSetArrayKeysOfEachUrlParameter($aKeys, $aArray, $mValue);
                    } else {
                        $aArray[$mKey] = $mValue;
                    }
                }
            }
        }
        return $aArray;
    }

    /**
     * for a string like this ml[material][]=asdf 
     * it fill array like this
     * array(
     *     material 
     *        => array(
     *               0 => asdf
     *           )
     * )
     * 
     * @param array $aKeys
     * @param array $aArray
     * @param mix $mValue
     * @return array
     */
    protected function mlSetArrayKeysOfEachUrlParameter($aKeys, $aArray, $mValue) {
        if (count($aKeys) > 0) {
            $sKey = array_shift($aKeys);// get key in frist level of hirarchy of array, e.g. ml[first][second][third]
            $sKey = str_replace(']', '', $sKey);
            if ($sKey == '') {//dynamic key
                $sKey = (is_array($aArray) && is_int(max(array_keys($aArray)))) ? (max(array_keys($aArray)) + 1) : 0;
            }
            if (!isset($aArray[$sKey])) {//if it is new key
                $aArray[$sKey] = null;
            }
            $aArray[$sKey] = $this->mlSetArrayKeysOfEachUrlParameter($aKeys, $aArray[$sKey], $mValue);
            return $aArray;
        } else {
            return $mValue;
        }
    }

    protected $frontUrlBeginningSign = '?';
    /**
     * @return string
     */
    public function getConfigFrontCronURL($aParams) {
        $sParent = self::getUrl($aParams);
        $aSubmittedValues = MLRequest::gi()->data();
        if (isset($aSubmittedValues['field']['general.cronfronturl'])) {
            $mConfig = $aSubmittedValues['field']['general.cronfronturl'] === '' ? null : $aSubmittedValues['field']['general.cronfronturl'];
        } else {
            $cacheFile = strtoupper(__CLASS__).'__'.__FUNCTION__.'txt';
            if (!MLCache::gi()->exists($cacheFile)) {
                $mConfig = MLDatabase::factory('config')->set('mpid', '0')->set('mkey', 'general.cronfronturl')->get('value');
                MLCache::gi()->set($cacheFile, $mConfig, 360);
            } else {
                $mConfig = MLCache::gi()->get($cacheFile);
            }
        }

        if ($mConfig != null) {
            return $mConfig . ($sParent == '' ? '' : $this->frontUrlBeginningSign . $sParent);
        } else {
            return '';
        }
    }

    /**
     * return directory or path (file system) of specific shop images
     * @param string $sFiles
     */
    abstract public function getShopImagePath();

    /**
     * return url of specific shop images
     * @param string $sFiles
     */
    abstract public function getShopImageUrl() ;
    
    /**
     * Gets the url to a file in the resources folder.
     * @param string $sFile
     *    Filename
     * @param bool $blAbsolute
     *
     * @return string
     */
    abstract public function getResourceUrl($sFile = '', $blAbsolute = true);
    
    /**
     * Gets the baseurl of the shopsystem.
     * @return string
     */
    abstract public function getBaseUrl();
        
    /**
     * Gets the magnalister cache FS url.
     * @return string
     */
    abstract public function getCacheUrl($sFile = '');
    
    /**
     * Gets the frontend url of the magnalister app.
     * @param array $aParams
     * @return string
     */
    abstract public function getFrontendDoUrl($aParams = array());
    
    /**
     * Returns _SERVER.
     * @return array
     */
    abstract public function getServerRequest();
    
    /**
     * Gets the request params merged from _POST and _GET.
     * @return array
     */
    abstract public function getRequest();
    
    /**
     * Parse hidden fields that are wanted by different shop systems for security measurements.
     * @return array
     *    Assoc of hidden neccessary form fields array(name => value, ...)
     */
    abstract public function getNeededFormFields();

}
