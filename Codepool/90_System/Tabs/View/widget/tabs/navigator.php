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
 * @call from /Codepool/90_System/Tabs/View/widget/tabs.php
 */

if (!class_exists('ML', false))
    throw new Exception();

if ($this instanceof ML_Tabs_Controller_Widget_Tabs_Abstract) {
    ?>
    <div class="magnaTabs2">
        <ul style="background-color: white">
            <div class="ml-tabLine" style="display: flex;">
                <?php $isMarketplace = isset($this->getTabs()[0]); ?>
                <div class="<?php echo ($isMarketplace) ? 'ml-wrapper' : ''; ?>" style="display: flex;">
                    <div class="ml-tabs-box" style="margin-right: 3px;">
                        <?php
                        foreach ($this->getTabs() as $aItem) {
                            $this->includeView('widget_tabs_tab', array('aItem' => $aItem,
                                                                                        'sTabIdent' => $sTabIdent,
                                                                                        'sIfStatement' => ((strpos($aItem['url'], '=configuration') === false) && (strpos($aItem['url'], '=more') === false) && (strpos($aItem['url'], '=guide') === false) && (strpos($aItem['url'], '=statistics') === false) && (strpos($aItem['url'], '=main_tools') === false))
                            ));
                        } ?>
                    </div>
                    <?php if ($isMarketplace) { ?>
                        <div class="ml-icon ml-hide"><i id="left" class="ml-arrow-slider-left"></i>
                            <div class="ml-fade-left"></div>
                        </div>
                        <div class="ml-icon" ><i id="right" class="ml-arrow-slider-right"></i>
                            <div class="ml-fade-right"></div>
                        </div>
                    <?php } ?>
                </div>
                <div id="ml-static-tabs" class="ml-tabs-box" style="display: flex; gap: 3px;">
                    <?php
                    foreach ($this->getTabs() as $aItem) {
                        $this->includeView('widget_tabs_tab', array('aItem' => $aItem,
                                                                                   'sTabIdent' => $sTabIdent,
                                                                                   'sIfStatement' => ((strpos($aItem['url'], '=more') !== false) || (strpos($aItem['url'], '=configuration') !== false) || (strpos($aItem['url'], '=statistic') !== false) || (strpos($aItem['url'], '=guide') !== false) || (strpos($aItem['url'], '=main_tools') !== false))
                        ));
                    } ?>
                </div>
            </div>

        </ul>

    </div>
    <?php
}