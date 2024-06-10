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

abstract class ML_Modul_Model_Service_Abstract {
    protected $oModul = null;

    protected $iLogLevel = 1;//default=1

    const LOG_LEVEL_NONE = 0;
    const LOG_LEVEL_LOW = 1;
    const LOG_LEVEL_MEDIUM = 2;
    const LOG_LEVEL_HIGH = 3;

    /**
     * executes complete service-process
     */
    abstract public function execute();

    public function __construct() {
        require_once MLFilesystem::getOldLibPath('php/callback/callbackFunctions.php');
        MLShop::gi()->getShopInfo();
        $this->oModul = MLModule::gi();
    }

    protected function getMarketplaceName() {
        return $this->oModul->getMarketplaceName();
    }

    protected function getMarketplaceId() {
        return $this->oModul->getMarketplaceId();
    }

    /**
     *
     * @param string $sString
     * @param array $aReplace array('search'=>'replace',...)
     * @return string Description
     */
    protected function replace($sString, $aReplace) {
        foreach ($aReplace as $sSearch => $sReplace) {
            $sString = str_replace($sSearch, $sReplace, $sString);
        }
        return $sString;
    }

    protected function log($sString, $iLogLevel = 0, $sLimiter = '==') {
        if ($iLogLevel <= $this->iLogLevel || MLSetting::gi()->get('blDebug')) {
            $this->out($sString);
        }
        return $this;
    }

    protected function out($mValue) {
        echo is_array($mValue) ? "\n{#".base64_encode(json_encode(array_merge(array('Marketplace' => $this->getMarketPlaceName(), 'MPID' => $this->getMarketPlaceId(),), $mValue)))."#}\n\n" : $mValue."\n";
        flush();
        return $this;
    }

}