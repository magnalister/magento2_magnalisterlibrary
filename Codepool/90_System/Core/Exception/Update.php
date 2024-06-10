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
 * Exception for install/update process
 */
class ML_Core_Exception_Update extends Exception {
    
    /**
     * path to file or folder
     * @var string
     */
    protected $aData = array();
    
    /**
     * copy of message
     * @var string
     */
    protected $sOrgMessage = 'Unknown exception';
    
    /**
     * translation id => i18n
     * @var array
     */
    protected static $aTranslations = array(
        1407751100 => 'sException_update_notEnoughDiskSpace',
        1407752557 => 'sException_update_cantCreateFolder',
        1407753851 => 'sException_update_insufficientFilesCount',
        1407759765 => 'sException_update_pathNotWriteable',
        1407761097 => 'sException_update_cantDeleteFolder',
        1407761504 => 'sException_update_cantCopyFile',
        1407762193 => 'sException_update_cantDeleteFile',
        1407833718 => 'sException_update_wrongMethodParameter',
        1410962251 => 'sException_update_cantRenameFolder',
        1422435595 => 'sException_afterUpdate_devTestMessageWithoutTranslation',
        1423819826 => 'sException_update_pathNotReadable',
        1423821549 => 'sException_update_pathNotExists',
        1424074789 => 'ML_TEXT_GENERIC_SAFE_MODE',
        1424075291 => 'sException_update_misc',
        1424244622 => 'sException_update_pathOutsideRoot'
    );

    public function __construct($message = null, $code = 0, Exception $previous = null) {
        if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
            parent::__construct($message, $code, $previous);
        } else {
            parent::__construct($message, $code);
        }
        $this->sOrgMessage = $this->getMessage();
    }

    /**
     * translates exception code to message
     * @return string
     */
    public function getTranslation () {
        if (array_key_exists($this->getCode(), self::$aTranslations)) {
            $sMessage = self::$aTranslations[$this->getCode()];
        } else {
            $sMessage = '';
        }
        if (isset($this->aData['path']) &&
            strpos($this->aData['path'], '/var/www/vhosts/magnalister.com/sites/') !== false &&
            strpos($this->aData['path'], '/web/customers/') !== false
        ) {//Don't show absolute path for shopware cloud and shopify
            $this->aData['path'] = '***';
        }
        return MLI18n::gi()->get($sMessage, $this->aData).'<br /><sup>Code: ML-'.$this->getCode().'</sup>';
    }
    
    /**
     * sets path(s) for translated exception messages
     * @param mixed $mPath
     * @return \ML_Core_Exception_Update
     */
    public function setData ($aData) {
        $this->aData = $aData;
        $this->message = MLI18n::gi()->get($this->sOrgMessage, $this->aData);
        return $this;
    }
}
