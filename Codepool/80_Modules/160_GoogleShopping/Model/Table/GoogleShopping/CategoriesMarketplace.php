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

MLFilesystem::gi()->loadClass('Modul_Model_Table_Categories_Abstract');
class ML_GoogleShopping_Model_Table_GoogleShopping_CategoriesMarketplace extends ML_Modul_Model_Table_Categories_Abstract {
    protected $sTableName = 'magnalister_googleshopping_categories_marketplace';
    
    public function init($blForce = false) {
        parent::init($blForce);
        if (!isset($this->aFields['Language'])) {
            $this->aFields['Language'] = array(
                'isKey' => true,
                'Type' => 'varchar(2)', 'Null' => 'NO', 'Default' => '', 'Extra' => '', 'Comment' => ''
            );
        }
        return $this;
    }
    
    protected function setDefaultValues() {
        $aField = array();
        MLHelper::gi('model_table_googleshopping_configdata')->langField($aField);
        foreach ($aField['valuessrc'] as $sMainLang => $aLang) {
            if ($aLang['required']) {
                break;
            }
            $sMainLang = null;
        }
        $this->set('Language', $sMainLang);

        return $this;
    }


    protected function getChildCategoriesRequest() {
        $aRequest = parent::getChildCategoriesRequest();
        $aRequest['DATA']['Language'] = $this->get('language');

        return $aRequest;
    }


    /**
     * @param bool $blForce - pulls and updates the data anyway
     * @return mixed
     * @throws Exception
     */
    public function getChildCategories($blForce = false) {
        $oChildModel = new $this;
        $oChildModel->set('parentid', $this->get('categoryid'));
        foreach ($this->getKeys(true) as $sKey ) {
            if (
                $sKey !== 'categoryid' //setted as parentid
                && !isset($oChildModel->aData[$sKey])
            ) {
                $oChildModel->set($sKey, $this->get($sKey));
            }
        }

        $oChildList = $oChildModel->getList();
        $oChildList->getQueryObject()->orderBy('CategoryName');

        if ($blForce || $oChildList->getCountTotal() == 0) {
            try {
                $aRequest = $this->getChildCategoriesRequest();
                $aResponse = MagnaConnector::gi()->submitRequest($aRequest);
                if (
                    isset($aResponse['STATUS']) && $aResponse['STATUS'] == 'SUCCESS'
                    && isset($aResponse['DATA']) && is_array($aResponse['DATA']) && count($aResponse['DATA']) > 0
                ) {
                    // Workaround when returned category id is the same as parent category id
                    foreach ($aResponse['DATA'] as $iChildCat => $aChildCat) {
                        if ($this->compareCategoryIds($aChildCat['CategoryID'], $this->get('categoryid')) ) {
                            foreach ($aChildCat as $sKey => $sValue) {
                                $this->set($sKey, $sValue);
                            }

                            $this->save();
                            unset($aResponse['DATA'][$iChildCat]);
                        }
                    }
                    if (count($aResponse['DATA']) > 0) {
                        foreach ($aResponse['DATA'] as $aChildCat) {
                            $oChildList->add($aChildCat);
                        }

                        return $oChildList->save();
                    }
                }
                return $oChildList; // no categories
            } catch (MagnaException $oEx) {
                MLMessage::gi()->addDebug($oEx);
                throw new Exception();
            }
        } else {
            return $oChildList;
        }
    }
}
