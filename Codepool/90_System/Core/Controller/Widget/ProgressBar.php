<?php
MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

/**
 * Widget controller for a simple progress bar.
 */
class ML_Core_Controller_Widget_ProgressBar extends ML_Core_Controller_Abstract {
    
    /**
     * total count of progress (default = 100)
     * @var float 
     */
    protected $fTotal = 100;
    
    /**
     * done count of progress (default = 0)
     * @var float
     */
    protected $fDone = 0;
    
    /**
     * id for html
     * @var string
     */
    protected $sId = '';
    
    /**
     * title
     * @var string|null if null translate by id
     */
    protected $sTitle = null;
    
    /**
     * content
     * @var string|null if null translate by id
     */
    protected $sContent = null;
    
    /**
     * bar-info
     * @var string
     */
    protected $sBarInfo = '';
    
    /**
     * log (only dev)
     * @var array
     */
    protected $aLog = array();
    
    /**
     * Creates an instance of the progress bar widget.
     * @return self
     */
    public function __construct() {
        $blInstalled = ML::isInstalled();
        MLSetting::gi()->add($blInstalled ? 'aCss' : 'aInstallCss', $blInstalled ? 'progressbar.css?%s' : 'install.progressbar.css');
        return parent::__construct();
    }
    
    /**
     * Sets the number of total items.
     * @param float $fTotal
     *    Number of items.
     * @return self
     */
    public function setTotal($fTotal) {
        $this->fTotal = (float) ($fTotal > 0 ? $fTotal : $this->fTotal);
        return $this;
    }
    
    /**
     * Get the number of total items/steps/whatever.
     * @return float
     */
    protected function getTotal () {
        return $this->fTotal;
    }
    
    /**
     * Set the number of processed items/steps/whatever(s).
     * @param float $fCurrent
     * @return self;
     */
    public function setDone ($fCurrent) {
        $this->fDone = (float) $fCurrent;
        return $this;
    }
    
    /**
     * Get the number of processed items/steps/whatever(s).
     * @return float
     */
    protected function getDone() {
        return $this->fDone;
    }
    
    /**
     * Get the percentage of the current process status.
     * @param int $iDecimals
     *    Precision
     * @return float
     */
    protected function getPercent($iDecimals = 2) {
        $fPercent = ($this->fDone * 100) / $this->fTotal;
        return number_format(round($fPercent, $iDecimals), $iDecimals);
    }
    
    /** 
     * Sets the id of this widget.
     * @return self
     */
    public function setId($sId) {
        $this->sId = $sId;
        return $this;
    }
    
    /**
     * Gets the current id of this widget.
     * @return string
     */
    public function getId() {
        return 'ml-modal_'.$this->sId;
    }

    /**
     * Translates something based on a name.
     * @param string $sName
     * @return string
     */
    protected function translate($sName) {
        return 
            $this->__('sModal_'.$this->sId.'_'.$sName) == 'sModal_'.$this->sId.'_'.$sName
                ? ''
                : $this->__('sModal_'.$this->sId.'_'.$sName)
        ;
    }
    
    /**
     * Gets the translated (i18n) title of the progress bar item.
     * @return string
     */
    protected function getTitle() {
        return $this->sTitle === null ? $this->translate('title') : $this->sTitle;
    }
    
    /**
     * sets title, to change default title of translation
     * @param string $sTitle
     * @return \ML_Core_Controller_Widget_ProgressBar
     */
    public function setTitle ($sTitle) {
        $this->sTitle = $sTitle;
        return $this;
    }
    
    /**
     * Gets the translated (i18n) content of the progress bar item.
     * @return string
     */
    protected function getContent() {
        return $this->sContent === null ? $this->translate('content') : $this->sContent;
    }
    
    /**
     * sets contenten, to change default content of translation
     * @param string $sContent
     * @return \ML_Core_Controller_Widget_ProgressBar
     */
    public function setContent ($sContent) {
        $this->sContent = $sContent;
        return $this;
    }
    
    /**
     * sets bar-info
     * @param string $sInfo
     * @return \ML_Core_Controller_Widget_ProgressBar
     */
    public function setBarInfo ($sInfo) {
        $this->sBarInfo = $sInfo;
        return $this;
    }
    
    /**
     * Gets the bar info of the progress bar item.
     * @return string
     */
    protected function getBarInfo() {
        return $this->sBarInfo;
    }
        
    /**
     * adds log-entree
     * @param string $sLog
     * @return \ML_Core_Controller_Widget_ProgressBar
     */
    public function addLog ($sLog) {
        $this->aLog[] = $sLog;
        return $this;
    }
    
    /**
     * get log entries
     * @return array
     */
    protected function getLog() {
        return $this->aLog;
    }
    
    /**
     * decide rendering if ajax
     * @return $this
     */
    public function render() {
        if (MLHttp::gi()->isAjax()) {
            MLSetting::gi()->add('aAjaxPlugin', array('dom' => array(
                '#' . $this->getId() . ' .ml-js-modalPushMessages' => $this->includeViewBuffered('widget_progressbar_messages'),
                '#' . $this->getId() . ' .viaAjax' => $this->includeViewBuffered('widget_progressbar_content'),
                '#' . $this->getId() . ' .progressBarContainer' => $this->includeViewBuffered('widget_progressbar_bar'),
                '#' . $this->getId() . ' .console>.console-content' => array(
                    'action' => 'append',
                    'content' => $this->includeViewBuffered('widget_progressbar_log')
                ),
            )));
        } else {
            parent::render();
        }
        return $this;
    }
}
