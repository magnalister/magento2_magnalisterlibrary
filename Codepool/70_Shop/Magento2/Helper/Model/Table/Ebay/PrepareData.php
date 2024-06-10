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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

MLFilesystem::gi()->loadClass('Ebay_Helper_Model_Table_Ebay_PrepareData');
class ML_Magento2_Helper_Model_Table_Ebay_PrepareData extends ML_Ebay_Helper_Model_Table_Ebay_PrepareData{
    /**
     * @param $aField
     * @todo here freitextfeld should be change with custome_field and should be tested in eBay description
     */
    public function descriptionField(&$aField) {
        parent::descriptionField($aField);
        $sValue = preg_replace(
            '/#(Bezeichnung|Freitextfeld)\d+#/','',$aField['value']
        );

        $aField['value'] = $sValue;
    }

}
