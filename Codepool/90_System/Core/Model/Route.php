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
 * calculates routes and sets header() if necessary
 */
class ML_Core_Model_Route {
    
    /**
     * defines if html or plaintext
     * @var bool $blPlainTextMode
     */
    protected $blPlainTextMode = false;
    
    /**
     * Process the request. The generated response will be buffered and returned.
     * 
     * @parm $sType type of controller, actual only frontend
     * @return array of array('controller' => ML_Core_Controller_Abstract)
     */
    public function getControllers($sType = null){
        $aControllers = array();
        if (ML::gi()->isAdmin()) {
            if (MLRequest::gi()->data('do') !== null) {
                //call directly requested controller
                ML::gi()->bootstrap();
                $this->preparePlainTextMode();
                $aControllers = $this->getDoControllers('');
            } elseif (MLHttp::gi()->isAjax()) {
                //call directly requested controller
                ML::gi()->bootstrap();
                $this->preparePlainTextMode();
                if (MLRequest::gi()->data('controller') !== null) {
                    $sController = MLRequest::gi()->data('controller');
                } else {
                    $sController = $this->oldRouting();
                }
                $sController = empty($sController) ? 'main' : $sController;
                if (preg_match('/:\\d+((_+)|($))/', $sController)) {
                    $sController = preg_replace('/:\\d+((_+)|($))/', '$1', $sController);
                }
                try {
                    $aControllers[] = array(
                        'controller' => MLController::gi($sController),
                    );
                } catch (Exception $oEx) {
                    MLMessage::gi()->addDebug($oEx);
                }
            } else {
                //call main-controller and main-controller calls childcontroller and .... till requested controller
                if (ML::gi()->isInstalled()) {
                    ML::gi()->bootstrap();
                }
                $aControllers[] = array(
                    'controller' => MLController::gi(ML::isInstalled() ? 'main' : 'install'),
                );
            }
        } else {
            if ($sType == 'do') {
                $this->preparePlainTextMode();
                ML::gi()->bootstrap();
                $sPassPhrase = trim(MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.passphrase')->get('value'));
                $sShopId = MLShop::gi()->getShopId();
                if (
                    empty($sShopId)
                    || empty($sPassPhrase)
                    || MLRequest::gi()->data('auth') != md5($sShopId.$sPassPhrase)
                ) {
                    $aControllers[] = array(
                        'controller' => MLController::gi('frontend_accessdenied')
                    );
                } else {
                    try {
                        $aControllers = $this->getDoControllers('frontend_');   
                    } catch (Exception $oEx) {
                        MLMessage::gi()->addDebug($oEx);
                    }
                }
            } elseif (in_array($sType, array('resource', 'images', 'writable'))) {
                ML::gi()->bootstrap(false);//no bootstrap - performace!!!
                try {
                    $aControllers[] = array(
                        'controller' => MLController::gi('frontend_resource')->setFolder($sType),
                    );   
                } catch (Exception $oEx) {
                    MLMessage::gi()->addDebug($oEx);
                }
            }
        }
        return $aControllers;
    }
    
    /**
     * Process the request. For Do-Controllers
     * Do-Controllers could be multiple
     * 
     * @parm $sMain path to controller (front or backens)
     * @return array of array('controller' => ML_Core_Controller_Abstract)
     */
    protected function getDoControllers ($sMain) {
        $aControllers = array();
        $aDo = explode(',', MLRequest::gi()->get('do'));
        foreach ($aDo as $sDo) {
            $sDo = trim($sDo);
            if (empty($sDo)) {
                continue;
            }
            try {
                $aControllers[] = array(
                    'controller' => MLController::gi($sMain.'do_'.$sDo),
                );
            } catch (Exception $oEx) {
                MLMessage::gi()->addDebug($oEx);
            }
        }
        return $aControllers;
    }


    /**
     * emulates v2-compatible routing
     * @return string
     */
    protected function oldRouting() {
        $aController = array();
        foreach (array('mp', 'mode', 'view', 'execute') as $sParam){
            if(MLRequest::gi()->data($sParam)!==null){
                $sValue = MLRequest::gi()->data($sParam);
                if($sParam == 'mp' && is_numeric($sValue)) {
                    $aController[] = magnaGetMarketplaceByID($sValue);
                } else {
                    $aController[] = $sValue;
                }
            }
        }
        return implode('_', $aController);
    }
    
    
    /**
     * info about rendering-mode
     * @return bool
     */
    public function isPlainTextMode() {
        return $this->blPlainTextMode;
    }
    
    /**
     * prepares request for plan-text for do-urls or ajax responses
     * @return \ML_Core_Model_Route
     */
    protected function preparePlainTextMode () {
        $this->blPlainTextMode = true;
        $iObLevel = ob_get_level();
        $sOutHandler = ini_get('output_handler');
        $iObLevel = empty($sOutHandler) ? $iObLevel : $iObLevel - 1;
        for ($i = $iObLevel; $i!=0; $i--) {// if master (shop) buffers, dont here
            ob_end_clean();
        }
        if (headers_sent() === false) {
            header('Content-Type: text/plain; charset="utf-8"');
        }
        return $this;
    }
    
}