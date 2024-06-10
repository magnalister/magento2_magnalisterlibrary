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

MLFilesystem::gi()->loadClass('Tabs_Controller_Widget_Tabs_Abstract');

class ML_Magnalister_Controller_Main extends ML_Tabs_Controller_Widget_Tabs_Abstract {
    protected $aParameters = array('mp');

    public function getTabUrlHierarchy() {
        return array();
    }

    protected function tabsController() {
        return $this->getChildController('head_tabs');
    }

    protected function headController() {
        return $this->getChildController('head_header');
    }

    public function footController() {
        return $this->getChildController('foot_footer');
    }

    public function getTabContentController() {
        $sCurrentController = 'main_content_empty';
        $sRequestController = MLHelper::gi('php8compatibility')->checkNull(MLRequest::gi()->data('controller'));
        $this->processRookieController($sRequestController);

        if (
            MLRequest::gi()->data('mp') != 'configuration'
            && !MLDatabase::factory('config')->isGCConfigured()
            && !empty($sRequestController)
            && !preg_match('/main_tools_*/', $sRequestController)
            && 'guide' != $sRequestController
        ) {
            MLHttp::gi()->redirect(array('controller' => 'configuration'));
        }
        $aMarketplaces = MLShop::gi()->getMarketplaces();
        $sMp = $this->getRequest('mp');

        if (array_key_exists($sMp, $aMarketplaces)) {
            $sCurrentModul = $aMarketplaces[$sMp];
        } elseif ($sMp !== null) {
            $sCurrentModul = $sMp;
        } else {
            $sCurrentModul = '';
        }

        $aModules = MLSetting::gi()->get('aModules');

        if (array_key_exists($sCurrentModul, $aModules)) {
            try {
                $blConf = MLModule::gi()->isConfigured();
            } catch (Exception $oEx) {//no modul
                $blConf = true;
            }
            if (!$blConf) {
                MLRequest::gi()->set('mode', 'conf', true);
            }
            try {
                MLController::gi($sCurrentModul);
                $sCurrentController = $sCurrentModul;
            } catch (Exception $oEx) {
                MLMessage::gi()->addDebug($oEx);
                $sCurrentController = 'main_content_notimplemented';
            }
        } else {
            if ($this->getRequest('controller') && strpos($this->getRequest('controller'), '_') !== false) {
                $aController = explode('_', $this->getRequest('controller'));
                $sCurrentController = $aController[0].'_'.$aController[1];
            } else {
                try {
                    $sCurrentController = 'main_'.MLRequest::gi()->get('mp');
                } catch (Exception $oEx) {
                    //                echo $oEx->getMessage();
                    try {
                        $sCurrentController = 'main_content_'.MLRequest::gi()->get('content');
                    } catch (Exception $oEx) {
                        $sCurrentController = 'main_content_welcome';
                    }
                }
            }
        }
        if (MLMessage::gi()->haveFatal() && !in_array($sCurrentController, array('main_content_welcome', 'main_tools', 'guide', 'configuration', 'dummymodule', 'rookie'))) {
            $sCurrentController = 'main_content_empty';
        }
        return MLController::gi($sCurrentController);
    }

    public function getTabsWidget() {
        $this->includeView('widget_tabs');
    }

    public function getTabsWidgetBuffered() {
        return $this->includeViewBuffered('widget_tabs');
    }

    public function getTabs() {
        if ($this->getRequest('controller')) {
            $aMp = explode('_', $this->getRequest('controller'));
            $sMp = $aMp[0];
        } else {
            $sMp = $this->getRequest('mp');
        }
        $aModules = MLSetting::gi()->get('aModules');
        $aAlwaysDisplayedModules = array();
        foreach ($aModules as $sKey => $aItem) {
            if ($aItem['displayAlways']) {
                $aAlwaysDisplayedModules[$sKey] = true;
            }
        }
        $aMarketplaces = MLShop::gi()->getMarketplaces();
        $aStructure = array();

        $blDoinavtive = true;
        if (!empty($aMarketplaces)) {
            foreach ($aMarketplaces as $mpID => $sKey) {
                if (array_key_exists($sKey, $aModules)) {
                    $aCurrentItem = array();
                    $aItem = $aModules[$sKey];
                    $aClasses = array();
                    if (!MLShop::gi()->apiAccessAllowed()) {
                        $aClasses [] = 'inactive';
                        $aClasses[] = 'ml-js-noBlockUi';
                    }
                    if (MLRequest::gi()->data('mp') == $mpID) {
                        $aClasses[] = 'selected';
                    }
                    if (array_key_exists($sKey, $aAlwaysDisplayedModules)) {
                        unset($aAlwaysDisplayedModules[$sKey]);
                    }
                    $aUrl = array('controller' => $sKey.':'.$mpID, 'mp' => null);
                    $aCurrentItem['title'] = $aItem['title'];
                    $aCurrentItem['subtitle'] = isset($aItem['subtitle']) && !empty($aItem['subtitle']) ? $aItem['subtitle'] : $aItem['title'];
                    $aCurrentItem['label'] = getDBConfigValue(array('general.tabident', $mpID), '0', '');
                    $aCurrentItem['url'] = $this->getCurrentUrl($aUrl);

                    try {
                        $aCurrentItem['image'] = isset($aItem['logo']) ? MLHttp::gi()->getResourceUrl('images/logos/'.$aItem['logo'].(!MLDatabase::factory('config')->isGCConfigured() ? '_inactive' : '').'.svg') : '';
                    } catch (ML_Filesystem_Exception $oEx) {
                    }

                    if (empty($aCurrentItem['image'])) {
                        $aCurrentItem['image'] = isset($aItem['logo']) ? MLHttp::gi()->getResourceUrl('images/logos/'.$aItem['logo'].'.png') : '';
                    }

                    $aCurrentItem['class'] = implode(' ', $aClasses);
                    //$aCurrentItem['key'] = $sKey . '_' . $mpID;

                    $aStructure[] = $aCurrentItem;
                }
            }
        } else {
            $blDoinavtive = false;
        }
        if (!empty($aAlwaysDisplayedModules)) {
            $sCurrentModule = $sMp !== null ? $sMp : '';
            foreach (array_keys($aAlwaysDisplayedModules) as $sKey) {
                $aItem = $aModules[$sKey];
                $aClasses = array();
                if ($sCurrentModule == $sKey) {
                    $aClasses[] = 'selected';
                }
                if (
                    ((!isset($aItem['type']) || ($aItem['type'] !== 'system')) && $blDoinavtive)
                    || (!MLShop::gi()->apiAccessAllowed() && $sKey === 'more')
                ) {
                    $aClasses[] = 'inactive';
                    $aClasses[] = 'ml-js-noBlockUi';
                }
                $aCurrentItem = array();
                $aCurrentItem['title'] = $aItem['title'];
                $aCurrentItem['subtitle'] = isset($aItem['subtitle']) && !empty($aItem['subtitle']) ? $aItem['subtitle'] : $aItem['title'];
                $aCurrentItem['label'] = isset($aItem['label']) ? $aItem['label'] : '';
                $aCurrentItem['url'] = $this->getUrl(array('controller' => $sKey, 'mp' => null));
                try {
                    $aCurrentItem['image'] = isset($aItem['logo']) ? MLHttp::gi()->getResourceUrl('images/logos/'.$aItem['logo'].'_inactive.svg') : '';
                } catch (ML_Filesystem_Exception $oEx) {
                }

                if (empty($aCurrentItem['image'])) {
                    $aCurrentItem['image'] = isset($aItem['logo']) ? MLHttp::gi()->getResourceUrl('images/logos/'.$aItem['logo'].'_inactive.png') : '';
                }

                $aCurrentItem['class'] = implode(' ', $aClasses);
                $aCurrentItem['key'] = $sKey;
                $aStructure[] = $aCurrentItem;
            }
        }

        // Debug Bar
        if (MLSetting::gi()->get('blDebug')) {
            $aStructure[] = array(
                'title'    => 'Service / Developer',
                'subtitle' => 'Service / Developer',
                'label'    => '',
                'url'      => $this->getUrl(array('mp' => null, 'controller' => 'main_tools')),
                'class'    => isset($aMp[1]) && $aMp[1] == 'tools' ? 'selected' : ''
            );
        }
        return $this->tabsClasses($aStructure);
    }

    /**
     * Redirect to Rookie controller if it is needed
     * @param mixed $sRequestController
     */
    protected function processRookieController($sRequestController) {
        try {
            $shopData = MLShop::gi()->getShopInfo();

            // controller is set but IsRookieLimitExceeded is true - only redirect when it's not already rookie
            if (
                is_string($sRequestController)
                && !in_array($sRequestController, array('configuration', 'guide', 'rookie'))
                && !preg_match('/configuration|guide|rookie|main_tools_*/', $sRequestController)
                && isset($shopData['DATA']['IsRookieLimitExceeded'])
                && $shopData['DATA']['IsRookieLimitExceeded'] == 'yes'
            ) {
                MLHttp::gi()->redirect(array('controller' => 'rookie'));
            }
        } catch (\Exception $ex) {
            //Do nothing if magnalister is not configure or the account is deactivated
        }
    }

}