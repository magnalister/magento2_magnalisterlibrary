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
 * Class to handle settings.
 */
class MLSetting extends MLRegistry_Abstract {
    
    protected $blDefaultValue = false;
    
    protected $aIncludedFiles = array();
    
    /**
     * returns instance as singleton
     * @return MLSetting
     */
    public static function gi($sInstance = null) {
        return parent::getInstance('MLSetting', $sInstance);
    }
    
    /**
     * Loads all settings files.
     * @return void
     */
 protected function bootstrap() {
        $this->includeFiles();
        if(!ML::getFastLoad()){
            $this->getCurrentVersionInfo();
        }
    }
    
    /**
     * Sets the session variables needed for the developer menu.
     * Overwrites the default values with the session values or values from the request.
     * @return void
     */
    protected function setSessionVars() {
        try {
            MLRequest::gi()->get('resetSetting');//throws
            MLSession::gi()->set('setting', array());
        } catch(Exception $oEx) {
            try {
                MLSession::gi()->set('setting', MLRequest::gi()->get('setting'));
            } catch(Exception $oEx) {
            }
        }
        if (getenv('ML_DEBUG') == 'true') {
            MLSetting::gi()->set('blDebug', true, true);
        }
        if (MLSession::gi()->get('setting')) {
            $aServiceVars = $this->get('aServiceVars');
            $aServiceVars['blDev'] = array(
                'validation' => FILTER_VALIDATE_BOOLEAN,
                'ajax' => false
            );
            foreach (MLSession::gi()->get('setting') as $sKey => $mValue) {
                if (substr($sKey, 0, 2) == 'bl') {
                    $mValue = (bool)$mValue;
                    
                }
                if (substr($sKey, 0, 1) == 'i') {
                    $mValue = (int)$mValue;
                    
                }
                if (isset($aServiceVars[$sKey]['validation'])) {
                    if ((
                            is_numeric($aServiceVars[$sKey]['validation'])
                            && filter_var( $mValue ,$aServiceVars[$sKey]['validation'])
                            && !in_array($aServiceVars[$sKey]['validation'], array(FILTER_VALIDATE_BOOLEAN, FILTER_VALIDATE_INT))
                        )
                        || (
                            is_numeric($aServiceVars[$sKey]['validation'])
                            && is_bool($mValue)
                            && $aServiceVars[$sKey]['validation'] == FILTER_VALIDATE_BOOLEAN
                        )
                        || (
                            is_numeric($aServiceVars[$sKey]['validation'])
                            && is_int($mValue)
                            && $aServiceVars[$sKey]['validation'] == FILTER_VALIDATE_INT
                        )
                        || (
                            is_string($aServiceVars[$sKey]['validation'])
                            && preg_match($aServiceVars[$sKey]['validation'], $mValue)
                        )
                    ) {
                        MLSetting::gi()->set($sKey, $mValue, true);
                    }
                }
            }
        }
    }
    
    /**
     * Same as parent class. But surpresses exceptions if the request $sName is "blDebug".
     * @param array $aReplace
     */
    public function get($sName, $aReplace = array()) {
        try {
            return parent::get($sName, $aReplace);
        }  catch (Exception $oEx) {
            if ($sName == 'blDebug') {
                return false;
            } else {
                throw $oEx;
            }
        }
    }
    
    /**
     * Gets the current client version that is installed and that is available on the
     * magnalister update servers.
     * Also adds messages if a new version is available.
     * @return void
     */
    protected function getCurrentVersionInfo() {
        $sCachename=  strtoupper(__class__).'__clientversion.json';
        try {
            $aVersion = MLCache::gi()->get($sCachename);
            if (
                !isset($aVersion['MIN_CLIENT_VERSION']) || ($aVersion['MIN_CLIENT_VERSION'] == '')
                || !isset($aVersion['CLIENT_VERSION']) || ($aVersion['CLIENT_VERSION'] == '')
                || !isset($aVersion['CLIENT_BUILD_VERSION']) || ($aVersion['CLIENT_BUILD_VERSION'] == '')
            ) {
                $aVersion = array();
                throw new Exception('load from server');
            }
        } catch(Exception $oEx) {
            try {
                $aVersion = json_decode(
                    MLHelper::gi('remote')->fileGetContents(
                        MLSetting::gi()->get('sUpdateUrl').'/ClientVersion/'.MLSetting::gi()->get('sClientVersion')
                    ), 
                    true
                );
                MLCache::gi()->set($sCachename, $aVersion, 60);
            } catch(Exception $oEx) {
                MLMessage::gi()->addFatal(
                    '<h2>'.MLI18n::gi()->ML_ERROR_CANNOT_CONNECT_TO_SERVICE_LAYER_HEADLINE.'</h2>'.
                    MLI18n::gi()->ML_ERROR_CANNOT_CONNECT_TO_SERVICE_LAYER_TEXT
                );
            }
        }        
        MLSetting::gi()->sMinClientVersion = isset($aVersion['MIN_CLIENT_VERSION']) ? $aVersion['MIN_CLIENT_VERSION'] : '';
        MLSetting::gi()->sCurrentVersion = isset($aVersion['CLIENT_VERSION']) ? $aVersion['CLIENT_VERSION'] : '';
        MLSetting::gi()->sCurrentBuild = isset($aVersion['CLIENT_BUILD_VERSION']) ? $aVersion['CLIENT_BUILD_VERSION'] : '';
        if (
            version_compare(MLSetting::gi()->sCurrentVersion, MLSetting::gi()->sClientVersion, '>') 
            && version_compare(MLSetting::gi()->sMinClientVersion, MLSetting::gi()->sClientVersion, '>')
        ) {
            if (! MLSetting::gi()->get('blSaveMode')) {
                MLMessage::gi()->addFatal(
                    MLI18n::gi()->get('ML_TEXT_IMPORTANT_UPDATE', array('version' => MLSetting::gi()->sCurrentVersion)),
                    array('md5' => 'newVersion')
                );
            } else {
                MLMessage::gi()->addSuccess(
                    MLI18n::gi()->get('ML_TEXT_IMPORTANT_UPDATE_SAFE_MODE', array('version' => MLSetting::gi()->sCurrentVersion)), 
                    array('md5' => 'newVersion')
                );
            }
        } elseif (
            version_compare(MLSetting::gi()->sCurrentVersion, MLSetting::gi()->sClientVersion, '>') 
            && !version_compare(MLSetting::gi()->sMinClientVersion, MLSetting::gi()->sClientVersion, '>')
        ) {
            if (! MLSetting::gi()->get('blSaveMode')) {
                MLMessage::gi()->addSuccess(
                    MLI18n::gi()->get('ML_TEXT_NEW_VERSION', array('version' => MLSetting::gi()->sCurrentVersion)),
                    array('md5' => 'newVersion')
                );
            } else { 
                MLMessage::gi()->addSuccess(
                    MLI18n::gi()->get('ML_TEXT_NEW_VERSION_SAFE_MODE', array('version' => MLSetting::gi()->sCurrentVersion)),
                    array('md5' => 'newVersion')
                );
            }
        }
    }
    
    /**
     * Bootstrap: Read all files in config folders, customerspecific first.
     * @return void
     */
    public function includeFiles() {
        $blWalk = true;
        while ($blWalk && count (MLFilesystem::gi()->getSettingFiles()) != count($this->aIncludedFiles)) {
            $blWalk = false;
            foreach (array_diff(
                MLFilesystem::gi()->getSettingFiles(),
                $this->aIncludedFiles
            ) as $sPath) {
                try {
                    include($sPath);
                    $this->aIncludedFiles[] = $sPath;
                    $blWalk = true; //one included
                } catch (Exception $oEx) {
                    // try to include later
                }
            }
        }
        try {
            MLSetting::gi()->set('blDebug', (MLRequest::gi()->get('MLDEBUG') === 'true'), true);
        }  catch (Exception $oEx){ 
        }
        $this->setSessionVars();
    }
}