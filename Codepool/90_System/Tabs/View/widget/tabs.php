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

if (!class_exists('ML', false))
    throw new Exception();

if ($this instanceof ML_Tabs_Controller_Widget_Tabs_Abstract) {
    ob_start();
    try {
        $oTabContent = $this->getTabContentController();
        $oTabContent->render();
        $sContent = ob_get_contents();
    } catch (Exception $oEx) {
        MLMessage::gi()->addDebug($oEx);
        try {
            MLController::gi('widget_message')->renderByMd5($oEx->getCode());
        } catch (Exception $oEx) {
            
        }
        $oTabContent = MLController::gi('main_content_empty');
        $oTabContent->render();
        $sContent = ob_get_contents();
    }
    ob_end_clean();
    //manipulate request for current url
    foreach ($this->getTabUrlHierarchy() as $sParameter => $aConfig) {
        $sRequest = $this->getRequest($sParameter);
        if (!in_array($sRequest, $aConfig)) {
            MLRequest::gi()->set($sParameter, current($aConfig), true);
        }
    }
    //render
    $this->setMenuView($this->includeViewBuffered('widget_tabs_navigator', array('sTabIdent' => $oTabContent->getIdent())));
    ?>
    <div class="magnamain"><?php echo $sContent; ?></div><?php
}