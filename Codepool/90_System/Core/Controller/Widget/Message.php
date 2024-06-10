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
 * hmvc-controller for handling message
 */
class ML_Core_Controller_Widget_Message extends ML_Core_Controller_Abstract {
    
    /**
     * render debug-messages
     * @return \ML_Core_Controller_Widget_Message
     */
    public function renderDebug(){
        $this->renderMessages('debug'.(ML::isInstalled() ? '' : 'Box'), 'debug');
        return $this;
    }
    
    /**
     * render success-messages
     * @return \ML_Core_Controller_Widget_Message
     */
    public function renderSuccess(){
        $this->renderMessages('successBox', 'success');
        return $this;
    }
    
    /**
     * render info-messages
     * @return \ML_Core_Controller_Widget_Message
     */
    public function renderInfo(){
        $this->renderMessages('successBoxBlue', 'info');
        return $this;
    }
    
    /**
     * render warning-messages
     * @return \ML_Core_Controller_Widget_Message
     */
    public function renderWarn(){
        $this->renderMessages('noticeBox', 'warn');
        return $this;
    }
    
    /**
     * render notice-messages
     * @return \ML_Core_Controller_Widget_Message
     */
    public function renderNotice(){
        $this->renderMessages('noticeBox', 'notice');
        return $this;
    }
    
    /**
     * render error-messages
     * @return \ML_Core_Controller_Widget_Message
     */
    public function renderError(){
        $this->renderMessages('errorBox', 'error');
        return $this;
    }
    
    /**
     * render fatal-messages
     * @return \ML_Core_Controller_Widget_Message
     */
    public function renderFatal(){
        $this->renderMessages('errorBox', 'fatal');
        return $this;
    }
    
    /**
     * render message by type
     * @return \ML_Core_Controller_Widget_Message
     */
    protected function renderMessages($sMessageCssClass, $sMessageType){
        $this->includeView('widget_message', array('sClass'=>$sMessageCssClass, 'aMessages' => MLMessage::gi()->{'get'.$sMessageType}()));
        return $this;
    }
    
    public function renderByMd5 ($sMd5) {
        foreach(MLMessage::gi()->remove($sMd5) as $iMessageType => $aMessage) {
            if ($iMessageType == ML_Core_Model_Message::SUCCESS) {
                $sMessageCssClass = 'successBox';
            } elseif ($iMessageType == ML_Core_Model_Message::INFO) {
                $sMessageCssClass = 'successBoxBlue';
            } elseif ($iMessageType == ML_Core_Model_Message::DEBUG) {
                $sMessageCssClass = '';
            } elseif ($iMessageType == ML_Core_Model_Message::WARN) {
                $sMessageCssClass = 'noticeBox';
            } elseif ($iMessageType == ML_Core_Model_Message::NOTICE) {
                $sMessageCssClass = 'noticeBox';
            } elseif ($iMessageType == ML_Core_Model_Message::ERROR) {
                $sMessageCssClass = 'errorBox';
            } elseif ($iMessageType == ML_Core_Model_Message::FATAL) {
                $sMessageCssClass = 'errorBox';
            }
            if ($sMessageCssClass != '') {
                $this->includeView('widget_message', array('sClass'=>$sMessageCssClass, 'aMessages' => array($aMessage) , 'blClose' => false));
            }
        }
        return $this;
    }
}