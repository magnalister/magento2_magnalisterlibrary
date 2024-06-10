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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLFilesystem::gi()->loadClass('Form_Helper_Controller_Widget_Form_PrepareAMCommon');

class ML_Ebay_Helper_Controller_Widget_Form_PrepareAMCommon extends ML_Form_Helper_Controller_Widget_Form_PrepareAMCommon {

    public function getSelector($aFields, $sFirst, $aNameWithoutValue, $sLast, &$aField) {

        $aField['doKeyPacking'] = !empty($aField['doKeyPacking']) ? $aField['doKeyPacking'] : false;

        $selectorKey = $aField['doKeyPacking'] ? pack('H*', $sLast) : $sLast;
        $selectorKey = str_replace('.', '!dot!', $selectorKey);
        $sSelector = $aFields[$sFirst.'.'.strtolower($aNameWithoutValue[1]).'.'.strtolower($selectorKey).'.code']['id'];
        $sSelector = str_replace('!dot!', '.', $sSelector);

        if ($aField['doKeyPacking']) {
            $aUnpackedKey = unpack('H*', $selectorKey);
            $unpackedKey = $aUnpackedKey[1];
            $sSelector = str_replace(strtolower($selectorKey), $unpackedKey, $sSelector);
        }

        return $sSelector;
    }

    public function getMPAttributeCode($aParentValue, $aField) {
        return $aField['doKeyPacking'] ? key($aParentValue) : pack('H*', key($aParentValue));
    }

    public function getSName($aName, $aField, $sMPAttributeCode) {
        $sName = 'field['.implode('][', $aName).'][Values]';
        $sName = str_replace('!dot!', '.', $sName);
        if ($aField['doKeyPacking']) {
            $unpackedKey = unpack('H*', $sMPAttributeCode);
            $unpackedKey = $unpackedKey[1];
            $sName = str_replace($sMPAttributeCode, $unpackedKey, $sName);
        }
        return $sName;
    }

    /**
     * in old implementation other identifier wasn't check, we didn't do it now neither
     * @return bool
     */
    public function shouldCheckOtherIdentifier() {
        return false;
    }

    public function addExtraInfo(&$aField) {
        $aField['doKeyPacking'] = !empty($aField['doKeyPacking']) ? $aField['doKeyPacking'] : false;
    }

}
