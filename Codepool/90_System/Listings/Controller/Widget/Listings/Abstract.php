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
 * @deprecated use instead ML_Tabs_Controller_Widget_Tabs_Filesystem_Abstract
 */

MLFilesystem::gi()->loadClass('Tabs_Controller_Widget_Tabs_Abstract');

abstract class ML_Listings_Controller_Widget_Listings_Abstract extends ML_Tabs_Controller_Widget_Tabs_Abstract {

    protected $aParameters = array('mp', 'mode', 'view');
    
    /**
     * return string value that show which parameter in oRequst->data specify the currect tab
     * @return string parameter of request
     */
    protected function getControllerSelector() {
        return 'view';
    }

    public function subTabValidation($sController) {
        return true;
    }
    
    /**
     * translate tab label if exist 
     */
    protected function translate($sExpression) {
        return $this->__('ML_GENERIC_'.strtoupper($sExpression));
    }
    
    protected function getCurrentControllerName(){
        $aControllers=$this->getChildControllersNames();
        $sSelector = $this->getControllerSelector();
        if(in_array($this->getRequest($sSelector), $aControllers)){
            $sFile=$this->getRequest($sSelector);
        }else{
            $sFile=current($aControllers);
        }
        return $sFile;
    }
    
    public function getTabUrlHierarchy() {
        return array();
    }

    public function getTabs() {
        $aOut = array();
        $sCurrent = $this->getCurrentControllerName();
        foreach ($this->getChildControllersNames() as $sController) {            
            if ($this->subTabValidation($sController)) {
                $aOut[] = array(
                    'title' => $this->translate($sController),
                    'url' => $this->getCurrentUrl(array($this->getControllerSelector() => $sController)),
                    'class' => $sCurrent == $sController ? 'selected' : ''
                );
            }
        }
        return $aOut;
    }    
    
    public function getTabContentController() {
        return $this->getChildController($this->getCurrentControllerName());
    }
    
    public function getTabsWidget() {
        $this->includeView('widget_tabs');
    }
    
}
