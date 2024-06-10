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
MLFilesystem::gi()->loadClass('Tabs_Controller_Widget_Tabs_Abstract');

/**
 * create tabs by filesystem
 */
abstract class ML_Tabs_Controller_Widget_Tabs_Filesystem_Abstract extends ML_Tabs_Controller_Widget_Tabs_Abstract {

    protected $aParameters = array('controller');
    protected $blMarketplace = true;
    protected $aTabs = null;
    
    public function getTabsWidget() {
        $this->includeView('widget_tabs');
    }
    
    public function getTabUrlHierarchy() {
        return array();
    }
    
    /**
     * calculates tabs
     * every child-controller can have following abstract methods:
     *  - ml_controller_child::public static (bool) getTabVisibility() // default = true
     *  - ml_controller_child::public static (string) getTabTitle() // default = ucfirst of string after last _ (Child)
     *  - ml_controller_child::public static (string) getTabLabel() // default = empty string
     *  - ml_controller_child::public static (bool) getTabActive() // default = true (adds css-class "inactive" if false)
     *  - ml_controller_child::public static (bool) getTabDefault() // default = false (adds css-class "selected", will be deleted if other tab is selected by request)
     * 
     * @return array
     */
    public function getTabs() {
        if ($this->aTabs === null) {
            $aTabs = array();
            $iDeep = substr_count($this->getIdent(), '_')+1;
            $sRequest = '';
            foreach (explode('_', $this->getRequest('controller')) as $iRequestPart => $sRequestPart) {
                if ($iRequestPart > $iDeep) {
                    break;
                } else {
                    $sRequest .= '_'.$sRequestPart;
                }
            }
            $sRequest = substr($sRequest, 1);
            $blActiveFound = false;
            foreach ($this->getChildControllersNames(true) as $sChildClass) {
                try {
                    $blShow = MLFilesystem::gi()->callStatic($sChildClass, 'getTabVisibility');
                } catch (ReflectionException $oEx) {// method dont exists
                    $blShow = true;
                }
                if (!$blShow) {
                    continue;
                }
                $aControllers = explode('_', $sChildClass);
                array_shift($aControllers);// remove 'controller'
                $sChild = implode('_', $aControllers);
                try {//add mp-id
                    $aControllers[0] .= ':' . MLModule::gi()->getMarketPlaceId();
                } catch (Exception $oEx) {

                }
                try {
                    $sTitle = MLFilesystem::gi()->callStatic($sChildClass, 'getTabTitle');
                } catch (ReflectionException $oEx) {// method dont exists
                    $sTitle = ucfirst($aControllers[count($aControllers)-1]);
                }
                try {
                    $sLabel = MLFilesystem::gi()->callStatic($sChildClass, 'getTabLabel');
                } catch (ReflectionException $oEx) {// method dont exists
                    $sLabel = '';
                }

                $aTabs[$sChild] = array(
                    'title' => $sTitle,
                    'subtitle' => $sTitle,
                    'label' => $sLabel,
                    'class' => '',
                    'url' => $this->getUrl(array('controller' => implode('_', $aControllers))),
                    'controller' => $aControllers,
                    'controllerClass' => $sChildClass,
                );
            }
            $this->aTabs = $aTabs;
        }
        return $this->aTabs;
    }
    
    public function getTabContentController() {
        $aActiveTabs = array();
        $aDefaultTabs = array();
        foreach ($this->getChildControllersNames(true) as $sChildClass) {
            try {
                $blShow = MLFilesystem::gi()->callStatic($sChildClass, 'getTabActive');
            } catch (ReflectionException $oEx) { // method dont exists
                $blShow = true;
            }
            if ($blShow) {
                $aActiveTabs[] = $sChildClass;
                try {
                    $blDefault = MLFilesystem::gi()->callStatic($sChildClass, 'getTabDefault');
                } catch (ReflectionException $oEx) { // method dont exists
                    $blDefault = false;
                }
                if ($blDefault) {
                    $aDefaultTabs[] = $sChildClass;
                }
            }
        }
        $sController = $this->getIdent();
        $aController = explode('_', MLRequest::gi()->cleanMarketplaceId('controller'));
        $aClass = explode('_', $this->getIdent());
        if (array_key_exists(count($aClass), $aController)) {
            $sController .= '_'.$aController[count($aClass)];
        }
        if (in_array('controller_'.$sController, $aActiveTabs)) {
            $sTab = 'controller_'.$sController;
        } elseif (in_array('controller_'.$sController, $aDefaultTabs)) {
            $sTab = $aDefaultTabs[array_search($sController, $aDefaultTabs)];
        } elseif (!empty ($aDefaultTabs)) {
            $sTab = current($aDefaultTabs);
        } elseif (!empty ($aActiveTabs)) {
            $sTab = current($aActiveTabs);
        } else {
            $sTab = 'controller_main_content_empty';
        }
        // adding next controller class to request
        if ($sTab != 'controller_main_content_empty' && !array_key_exists(count($aClass), $aController)) {
            MLRequest::gi()->set(
                'controller', 
                MLRequest::gi()->get('controller').substr($sTab, strrpos($sTab, '_')), 
                true
            );
        }
        return MLController::gi(substr($sTab, 11/*_controller*/));
    }
    
    public function render(){
        $this->getTabsWidget();
    }
    
}
