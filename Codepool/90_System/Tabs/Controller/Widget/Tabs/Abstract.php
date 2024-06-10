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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');
abstract class ML_Tabs_Controller_Widget_Tabs_Abstract extends ML_Core_Controller_Abstract {

    static public $menuView = '';

    public function getMenuView() {
        return self::$menuView;
    }

    public function setMenuView($menu) {
        if (empty(self::$menuView)) {
            self::$menuView = $menu . self::$menuView;
        } else {
            self::$menuView = $menu . '<div class="ml-triangle magnaTabs2"></div>' . self::$menuView;
        }
    }

    abstract public function getTabsWidget();
    /**
     * array(
     *  array(
     *      [title] => 
     *      [label] => 
     *      [url] => 
     *      [image] => 
     *      [class] => 
     *  ),
     *  ...
     * )
     * @return array 
     */
    abstract public function getTabs();

    protected function tabsClasses($aTabs) {
        $aTabsCopy = $aTabs;
        $found = false;
        foreach ($aTabsCopy as &$aTab) {
            if (isset($aTab['class']) && strpos($aTab['class'], 'selected') !== false) {
                $found = true;
            } else {
                if (isset($aTab['class'])) {
                    $aTab['class'] = trim($aTab['class']);
                }
                if (isset($aTab['class']) && !empty($aTab['class'])) {
                    $aTab['class'] .= ' ml-menu-item';
                } else {
                    $aTab['class'] = 'ml-menu-item';

                }
            }

        }
        if ($found) {
            return $aTabs;
        } else {
            return $aTabsCopy;
        }

    }
    /**
     * @return ML_Core_Controller_Abstract
     */
    abstract public function getTabContentController();
    
    /**
     * needed for prepare request-object, to add parent parameters, if not exists
     * array(
     *  'http-parameter'=>array('of','possible','parameters')
     * )
     * @return array 
     */
    abstract public function getTabUrlHierarchy();
    
}