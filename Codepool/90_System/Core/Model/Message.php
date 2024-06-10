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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

/**
 * Description of Message
 * To change this template, choose Tools | Templates and open the template in the editor.
 * @author mba
 */
class ML_Core_Model_Message {
    const SUCCESS = 1;
    const INFO = 2;
    const DEBUG = 3;
    const WARN = 4;
    const NOTICE = 5;
    const ERROR = 6;
    const FATAL = 7;
    const API = 8;
    //    const MAGNAEXCEPTION = 8;
    
    /**
     * @var array $aData
     *    The data store for the various types of messages.
     *    The key represents the message type (see this class constants)
     *    and the values are a list of messages.
     */
    protected $aData = array(
        1 => array(),
        2 => array(),
        3 => array(),
        4 => array(),
        5 => array(),
        6 => array(),
        7 => array(),
        8 => array()
    );
    
    /**
     * message for models, only live current request
     * @var array
     */
    protected $aObjectMessages = array();
    
    /**
     * @var bool $blIsDestructed
     *    Indicates whether the descructor has been called yet.
     */
    protected $blIsDestructed = false;
    
    /**
     * Creates an instance of this class.
     * @return self
     */
    public function __construct() {
        $aDefault = $this->aData;
        if (ML::gi()->isAdmin() && ML::isInstalled()) {
            $aData = MLSession::gi()->get('messages');
            MLSession::gi()->set('messages', $aDefault);
            if (!is_null($aData)) {
                foreach ($aData as $iMessageType => $aMessages) {
                    foreach ($aMessages as $sMessageId => $aMessage) {
                        $this->aData[$iMessageType][$sMessageId] = $aMessage;
                    }
                }
                $this->aData = $aData;
            }
        }
        $oCache = MLCache::gi();
        $sCacheKey = strtoupper(__CLASS__) . '__messages.json';
        if ($oCache->exists($sCacheKey)) {
            try{
                $aCacheData = $oCache->get($sCacheKey);
            } catch (Exception $ex) {
                $aCacheData = array();
            }
            foreach ($aCacheData as $iMessageType => $aMessages) {
                foreach ($aMessages as $sMessageId => $aMessage) {
                    $this->aData[$iMessageType][$sMessageId] = $aMessage;
                }
            }
            $oCache->delete($sCacheKey);
        }
        register_shutdown_function(array(&$this, "destruct"));
    }
    
    /**
     * Saves the current messages in the cache.
     * @return self
     */
    protected function save() {
        if ($this->blIsDestructed) { //only save after shutdown
            $this->aData[self::FATAL] = array();
            if (ML::gi()->isAdmin() && ML::isInstalled()) {
                MLSession::gi()->set('messages', $this->aData);
            } else {
                $oCache = MLCache::gi();
                $sCacheKey = strtoupper(__CLASS__) . '__messages.json';
                if ($oCache->exists($sCacheKey)) {
                    try{
                        $aCacheData = $oCache->get($sCacheKey);
                    } catch (Exception $ex) {
                        $aCacheData = array();
                    }
                    foreach ($aCacheData as $iMessageType => $aMessages) {
                        foreach ($aMessages as $sMessageId => $aMessage) {
                            $this->aData[$iMessageType][$sMessageId] = $aMessage;
                        }
                    }
                }
                $oCache->set($sCacheKey, $this->aData);
            }
        }
        return $this;
    }
    
    /**
     * An own destruction method. DO NOT CALL FROM EXTERN!
     * @return void
     */
    public function destruct() {
        $this->blIsDestructed = true;
        $this->save();
    }
    
    /**
     * Removes a message based on its md5 hash.
     *
     * @param string $sMd5
     * @return array of removed messages, normally one
     */
    public function remove($sMd5) {
        $aOut = array();
        foreach ($this->aData as $iMessageType => &$aMessagesType) {
            if (isset($aMessagesType[$sMd5])) {
                if ($iMessageType !== self::DEBUG) {
                    $this->addDebug('message deleted', array('oldMd5' => $sMd5, 'message' => $aMessagesType[$sMd5]));
                    $aOut[$iMessageType] = $aMessagesType[$sMd5];
                }
                unset($aMessagesType[$sMd5]);
            }
        }
        return $aOut;
    }

    /**
     * Adds a message that will be displayed.
     * @param mixed $mMessage
     * @param mixed $mData
     * @param int $iMessageType
     * @param bool $blShowInAjax
     * @param string $sHtmlSelector
     * @return self
     */
    public function add($mMessage, $mData, $iMessageType, $blShowInAjax = true, $sHtmlSelector = '') {
        $mData = empty($mData) ? array() : $mData;
        $mData = is_array($mData) ? $mData : (array) $mData;
        if (array_key_exists('md5', $mData)) {
            $sMd5 = $mData['md5'];
            unset($mData['md5']);
        }
        $aMessage = array(
            'message' => '',
            'htmlSelector' => $sHtmlSelector,
            'additional' => array(
                'data' => empty($mData) ? '&mdash;' : $mData,
                'class' => '&mdash;',
                'code' => '&mdash;',
                'file' => '&mdash;',
                'line' => '&mdash;',
                'trace' => array()
            ),
        );
        if ($mMessage instanceof Exception || (interface_exists('Throwable') && $mMessage instanceof Throwable)) {
            $aMessage['message']             = $mMessage->getMessage();
            $aMessage['additional']['class'] = get_class($mMessage);
            $aMessage['additional']['code']  = $mMessage->getCode();
            $aMessage['additional']['file']  = $mMessage->getFile();
            $aMessage['additional']['line']  = $mMessage->getLine();
            $aMessage['additional']['trace'] = $mMessage->getTrace();
            if ($mMessage instanceof MagnaException) {
                $aErrors = $mMessage->getErrorArray();
                if (isset($aErrors['RESPONSEDATA']) && is_array($aErrors['RESPONSEDATA'])) { //ebay error
                    foreach ($aErrors['RESPONSEDATA'] as $aErrorPart) {
                        if (isset($aErrorPart['ERRORS'])) {
                            foreach ($aErrorPart['ERRORS'] as $aError) {
                                if ($aError['ERRORLEVEL'] === 'Error' || MLSetting::gi()->data('blDebug') === true) {
                                    $aMessage['message'] .= '<br /><span class="error">' . sprintf(ML_EBAY_LABEL_EBAYERROR, $aError['ERRORCODE']) . '</span>: ' . $aError['ERRORMESSAGE'];
                                }
                            }
                        }
                    }
                } else if (isset($aErrors['ERRORS']) && is_array($aErrors['ERRORS'])) { //amazon and some other marketplace error 
                    foreach ($aErrors['ERRORS'] as $aError) {
                        if (isset($aError['ERRORLEVEL']) && ($aError['ERRORLEVEL'] === 'ERROR' || $aError['ERRORLEVEL'] === 'WARNING' || MLSetting::gi()->data('blDebug') === true)) {
                            $aMessage['message'] .= '<br />'
                                .'<span class="error">'.(isset($aError['SUBSYSTEM']) ? $aError['SUBSYSTEM'] : '').'</span>: '
                                .(isset($aError['SKU']) ? ' Item SKU ( '.$aError['SKU'].' ) - ' : '').$aError['ERRORMESSAGE'];
                        }
                    }
                }
            }
        } elseif (is_array($mMessage)) {
            $aMessage['message'] = json_encode($mMessage);
            $aBt = debug_backtrace();
            array_shift($aBt);
            $aMessage['additional']['file'] = $aBt[0]['file'];
            $aMessage['additional']['line'] = $aBt[0]['line'];
            array_shift($aBt);
            $aMessage['additional']['trace'] = $aBt;
        } else {
            $aMessage['message'] = $mMessage;
            $aBt = debug_backtrace();
            array_shift($aBt);
            $aMessage['additional']['file'] = $aBt[0]['file'];
            $aMessage['additional']['line'] = $aBt[0]['line'];
            array_shift($aBt);
            $aMessage['additional']['trace'] = $aBt;
        }
        if (!empty($aMessage['message'])) {
            foreach ($aMessage['additional']['trace'] as $iTrace => $aTrace) {
                if (MLSetting::gi()->blDev === null) {
                    if (isset($aTrace['file']) && (substr($aTrace['file'], 0, strlen(MLFilesystem::getLibPath())) == MLFilesystem::getLibPath())) {
                        $aMessage['additional']['trace'][$iTrace] = array(
                            'file' => './' . substr($aTrace['file'], strlen(MLFilesystem::getLibPath()), strlen($aTrace['file'])),
                            'line' => $aTrace['line']
                        );
                    } else {
                        unset($aMessage['additional']['trace'][$iTrace]);
                    }
                } else {

                    $aMessage['additional']['trace'][$iTrace] = (isset($aTrace['file']) ? $aTrace['file'] : '') . ':' . (isset($aTrace['line']) ? $aTrace['line'] : '');
                }
            }
            if (substr($aMessage['additional']['file'], 0, strlen(MLFilesystem::getLibPath())) == MLFilesystem::getLibPath()) {
                $aMessage['additional']['file'] = './' . substr($aMessage['additional']['file'], strlen(MLFilesystem::getLibPath()), strlen($aMessage['additional']['file']));
            }
            $aMessage['ajax'] = $blShowInAjax;
            if (!isset($sMd5)) {
                $sMd5 = md5(json_encode(array(
                    'message' => $aMessage['message'],
                    'data' => $aMessage['additional']['data']
                )));
            }
            
            // if (!array_key_exists($sMd5, $this->aData[$iMessageType])) {
            $this->aData[$iMessageType][$sMd5] = $aMessage;
            // }    
        }
        return $this;
    }

    /**
     * Alias for self::add() that just adds success messages.
     * @param mixed $mMessage
     * @param mixed $mData
     * @param bool $blShowInAjax
     * @param string $sHtmlSelector
     * @return self
     * @throws Exception
     */
    public function addSuccess($mMessage, $mData = '', $blShowInAjax = true, $sHtmlSelector = '') {
        return $this->add($mMessage, $mData, self::SUCCESS, $blShowInAjax, $sHtmlSelector);
    }

    /**
     * Alias for self::add() that just adds info messages.
     * @param mixed $mMessage
     * @param mixed $mData
     * @param bool $blShowInAjax
     * @param string $sHtmlSelector
     * @return self
     * @throws Exception
     */
    public function addInfo($mMessage, $mData = '', $blShowInAjax = true, $sHtmlSelector = '') {
        return $this->add($mMessage, $mData, self::INFO, $blShowInAjax, $sHtmlSelector);
    }

    /**
     * Alias for self::add() that just adds debug messages.
     * @param mixed $mMessage
     * @param mixed $mData
     * @param bool $blShowInAjax
     * @param string $sHtmlSelector
     * @return self
     */
    public function addDebug($mMessage, $mData = '', $blShowInAjax = true, $sHtmlSelector = '') {
        return $this->add($mMessage, $mData, self::DEBUG, $blShowInAjax, $sHtmlSelector);
    }

    /**
     * Alias for self::add() that just adds warning messages.
     * @param mixed $mMessage
     * @param mixed $mData
     * @param bool $blShowInAjax
     * @param string $sHtmlSelector
     * @return self
     */
    public function addWarn($mMessage, $mData = '', $blShowInAjax = true, $sHtmlSelector = '') {
        return $this->add($mMessage, $mData, self::WARN, $blShowInAjax, $sHtmlSelector);
    }

    /**
     * Alias for self::add() that just adds error messages.
     * @param mixed $mMessage
     * @param mixed $mData
     * @param bool $blShowInAjax
     * @param string $sHtmlSelector
     * @return self
     */
    public function addError($mMessage, $mData = '', $blShowInAjax = true, $sHtmlSelector = '') {
        return $this->add($mMessage, $mData, self::ERROR, $blShowInAjax, $sHtmlSelector);
    }

    /**
     * Alias for self::add() that just adds fatal messages.
     * @param mixed $mMessage
     * @param mixed $mData
     * @param bool $blShowInAjax
     * @param string $sHtmlSelector
     * @return self
     */
    public function addFatal($mMessage, $mData = '', $blShowInAjax = true, $sHtmlSelector = '') {
        return $this->add($mMessage, $mData, self::FATAL, $blShowInAjax, $sHtmlSelector);
    }

    /**
     * Alias for self::add() that just adds notice messages.
     * @param mixed $mMessage
     * @param mixed $mData
     * @param bool $blShowInAjax
     * @param string $sHtmlSelector
     * @return self
     */
    public function addNotice($mMessage, $mData = '', $blShowInAjax = true, $sHtmlSelector = '') {
        return $this->add($mMessage, $mData, self::NOTICE, $blShowInAjax, $sHtmlSelector);
    }
    
    /**
     * Returns true if a fatal message has been added.
     * @return bool
     */
    public function haveFatal() {
        return count($this->aData[self::FATAL]) > 0;
    }
    
    /**
     * Get all messages from one type.
     * @param int $iMessageType
     * @return array
     */
    protected function get($iMessageType) {
        $aData = $aNoAjaxData = array();
        foreach ($this->aData[$iMessageType] as $iRow => $aRow) {
            if (
                (isset($aRow['ajax']) && $aRow['ajax'] === true) 
                || 
                !MLHttp::gi()->isAjax() || !isset($aRow['ajax'])
            ) {
                $aData[$iRow]['message'] = is_string($aRow) ? $aRow : $aRow['message'];
                $aData[$iRow]['htmlSelector'] = $aRow['htmlSelector'];
                foreach (array(
                    'data' => '&mdash;',
                    'class' => '&mdash;',
                    'code' => '&mdash;',
                    'file' => '&mdash;',
                    'line' => '&mdash;',
                    'trace' => array()
                ) as $sKey => $mDefault) {
                    $aData[$iRow]['additional'][$sKey] = isset($aRow['additional'][$sKey]) ? $aRow['additional'][$sKey] : $mDefault;
                }
            } else {
                $aNoAjaxData[$iRow] = $aRow;
            }
        }
        $this->aData[$iMessageType] = $aNoAjaxData;
        $this->save();
        return $aData;
    }
    
    /**
     * Alias for self::get() that just returns success messages.
     */
    public function getSuccess() {
        return $this->get(self::SUCCESS);
    }
    
    /**
     * Alias for self::get() that just returns info messages.
     */
    public function getInfo() {
        return $this->get(self::INFO);
    }
    
    /**
     * Alias for self::get() that just returns debug messages.
     */
    public function getDebug() {
        if (MLSetting::gi()->get('blDebug')) {
            return $this->get(self::DEBUG);
        } else {
            return array();
        }
    }
    
    /**
     * Alias for self::get() that just returns warning messages.
     */
    public function getWarn() {
        return $this->get(self::WARN);
    }
    
    /**
     * Alias for self::get() that just returns error messages.
     */
    public function getError() {
        return $this->get(self::ERROR);
    }
    
    /**
     * Alias for self::get() that just returns fatal messages.
     */
    public function getFatal() {
        return $this->get(self::FATAL);
    }
    
    /**
     * Alias for self::get() that just returns notice messages.
     */
    public function getNotice() {
        return $this->get(self::NOTICE);
    }
    
    /**
     * Alias for self::get() that just returns api messages.
     */
    public function getAPI() {
        return $this->get(self::API);
    }
    
    /**
     * Adds a message for a table model instance
     * @param ML_Database_Model_Table_Abstract $oModel
     * @param string $sMessage
     * @return self
     */
    public function addObjectMessage(ML_Database_Model_Table_Abstract $oModel, $sMessage) {
        $sHash = self::calcObjectHash($oModel);
        $this->aObjectMessages[$sHash] = isset($this->aObjectMessages[$sHash]) ? $this->aObjectMessages[$sHash] : array();
        if (!in_array($sMessage, $this->aObjectMessages[$sHash])) {
            $this->aObjectMessages[$sHash][] = $sMessage;
        }
        return $this;
    }
    
    /**
     * Returns all messages for a table model
     * @param ML_Database_Model_Table_Abstract $oModel
     * @return array
     */
    public function getObjectMessages(ML_Database_Model_Table_Abstract $oModel) {
        $sHash = self::calcObjectHash($oModel);
        return isset($this->aObjectMessages[$sHash]) ? $this->aObjectMessages[$sHash] : array();
    }
    
    /**
     * Return a hash for a table model instance.
     * @param ML_Database_Model_Table_Abstract $oModel
     * @return string
     */
    protected static function calcObjectHash($oModel) {
        //calc hash
        $aHash = array();
        foreach ($oModel->getKeys(false) as $sKey) {
            $aHash[$sKey] = $oModel->get($sKey);
        }
        $sHash = md5(json_encode($aHash));
        return $sHash;
    }
    
}
