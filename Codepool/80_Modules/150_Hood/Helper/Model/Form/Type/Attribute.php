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
 * (c) 2010 - 2018 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

class ML_Hood_Helper_Model_Form_Type_Attribute {

    public function fillValue($oProduct, $sLabel) {
        $isMultiProduct = !($oProduct instanceof ML_Shop_Model_Product_Abstract);
        $mValue = '';
        $blSyncProperties = MLShop::gi()->addonBooked('HoodProductIdentifierSync') && MLModul::gi()->getConfig('syncproperties');
        $sBrandKey = MLModul::gi()->getConfig('productfield.brand');
        $sMpnKey = MLModul::gi()->getConfig('manufacturerpartnumber');
        $sEanKey = MLModul::gi()->getConfig('ean');
        if ($blSyncProperties && in_array($sLabel, array('Marke', 'Hersteller', 'Brand')) && !empty($sBrandKey)) {
            $mValue = $isMultiProduct ? '(matching)' : $oProduct->getModulField('productfield.brand');
        } elseif (in_array($sLabel, array('Herstellernummer', 'MPN')) && !empty($sMpnKey)) {
            $mValue = $isMultiProduct ? '(matching)' : $oProduct->getModulField('general.manufacturerpartnumber', true);
        } elseif (in_array($sLabel, array('EAN', 'ISBN', 'UPC')) && !empty ($sEanKey)) {
            $mValue = $isMultiProduct ? '(matching)' : $oProduct->getModulField('general.ean', true);
        }
        return $mValue;
    }

}
