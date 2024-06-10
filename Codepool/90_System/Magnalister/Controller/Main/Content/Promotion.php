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
 * (c) 2010 - 2015 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Core_Controller_Abstract');

class ML_Magnalister_Controller_Main_Content_Promotion extends ML_Core_Controller_Abstract {

    protected function getPromotion() {
        $sKey = strtoupper(__CLASS__).'__promotion'.MLLanguage::gi()->getCurrentIsoCode();
        $sContent = MLCache::gi()->exists($sKey) ? MLCache::gi()->get($sKey) : '';
        if (!MLCache::gi()->exists($sKey)) {
            try {
                $this->callAjaxGetPromotion();
                $sContent = MLCache::gi()->get($sKey);
            } catch (Exception $oEx) { // cache not actualized

            }
        }
        return $sContent;
    }

    protected function callAjaxGetPromotion() {
        $mWarnings = '';
        $sKey = strtoupper(__CLASS__).'__promotion'.MLLanguage::gi()->getCurrentIsoCode();

	  $sUrl = MLSetting::gi()->get('sApiRelatedUrl').'promotion/'.'?shopsystem='.MLShop::gi()->getShopSystemName() . '&lang='.MLLanguage::gi()->getCurrentIsoCode();

        $sPartner = MLSetting::gi()->data('magnaPartner');
        if (!empty($sPartner)) {
            $sUrl .= '&partner='.$sPartner;
        }

        $sContent = MLHelper::gi('remote')->fileGetContents(
            $sUrl,
            $mWarnings,
            10
        );
        if ($sContent !== false || $mWarnings !== '') {
            MLCache::gi()->set($sKey, $sContent);
        } else {
            throw new Exception('Can\'t load URL.', 1444735220);
        }
    }

}
