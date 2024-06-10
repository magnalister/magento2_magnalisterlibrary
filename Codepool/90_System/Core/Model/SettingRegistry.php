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
 * alias for special-vars of MLSetting
 * 
 * @todo same like aJs aAjax, aAjaxPluginDom
 */
class ML_Core_Model_SettingRegistry {

    /**
     * add a js-script to registry
     * @param string|array $mScript script name
     * @param bool $blOverwrite
     * @return $this
     */
    public function addJs($mScript, $blOverwrite = true) {
        $mScript = is_string($mScript) ? array($mScript) : $mScript;
        foreach ($mScript as $i => $sScript) {
            $mScript[$i] = $sScript.'?%s';
        }
        MLSetting::gi()->add('aJs', $mScript, $blOverwrite);
        return $this;
    }
    
    /**
     * get registered js-scripts
     * @return array
     */
    public function getJs() {
        return array_unique(MLSetting::gi()->get('aJs'));
    }

    /**
     * Add a css style file to registry
     *
     * @param $mStyle
     * @param $blOverwrite
     * @return $this
     */
    public function addCss($mStyle, $blOverwrite = true) {
        $mStyle = is_string($mStyle) ? array($mStyle) : $mStyle;
        foreach ($mStyle as $i => $sStyle) {
            $mStyle[$i] = $sStyle . '?%s';
        }
        MLSetting::gi()->add('aCss', $mStyle, $blOverwrite);
        return $this;
    }

    /**
     * Get all registered css style files (unique)
     *
     * @return false|mixed|string
     * @throws Exception
     */
    public function getCss() {
        return array_unique(MLSetting::gi()->get('aCss'));
    }
    
}
