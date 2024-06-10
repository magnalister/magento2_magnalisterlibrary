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
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
MLFilesystem::gi()->loadClass('Form_Controller_Widget_Form_PrepareWithVariationMatchingAbstract');

class ML_PriceMinister_Controller_PriceMinister_Prepare_Match_Auto extends ML_Form_Controller_Widget_Form_PrepareWithVariationMatchingAbstract
{

    protected $aParameters = array('controller');

    public function construct()
    {
        parent::construct();
        $this->oPrepareHelper->bIsSinglePrepare = $this->oSelectList->getCountTotal() === '1';
    }

    public function getRequestField($sName = null, $blOptional = false)
    {
        if (count($this->aRequestFields) == 0){
            $this->aRequestFields = $this->getRequest($this->sFieldPrefix);
            $this->aRequestFields = is_array($this->aRequestFields) ? $this->aRequestFields : array();
        }

        return parent::getRequestField($sName, $blOptional);
    }

    protected function getSelectionNameValue()
    {
        return 'match';
    }

    protected function triggerBeforeFinalizePrepareAction()
    {
        $this->oPrepareList->set('preparetype', 'auto');
        $this->oPrepareList->set('verified', 'OK');

        return true;
    }

    protected function callAjaxGetProgress()
    {
        $data = json_encode(array('x' => (int)$this->oSelectList->getCountTotal()));
        MLSetting::gi()->add('aAjax', $data);
    }

    protected function callAjaxStartAutomatching()
    {
        $autoMatchingStats = $this->insertAutoMatchProduct();
        $warningForCategories = empty($autoMatchingStats['categories']) ? '' : trim(sprintf(MLI18n::gi()->get('PriceMinister_Productlist_Match_Auto_Summary_Categories'), implode(', ', $autoMatchingStats['categories'])));

        $re = trim(sprintf(
            MLI18n::gi()->get('PriceMinister_Productlist_Match_Auto_Summary'),
            $autoMatchingStats['success'],
            $autoMatchingStats['nosuccess'],
            $autoMatchingStats['almost'],
            $warningForCategories
        ));

        MLSetting::gi()->add('aAjax', array(
            'Data' => $re
        ));
    }

    protected function insertAutoMatchProduct()
    {
        $autoMatchingStats = array(
            'success' => 0,
            'almost' => 0,
            'nosuccess' => 0,
            'categories' => array(),
            '_timer' => microtime(true)
        );

        foreach ($this->oSelectList->getList() as $product){
            $product = $this->oPrepareHelper->getProductInfoById($product->pID);
            $searchResults = $this->oPrepareHelper->searchOnPriceMinister($product['EAN'], 'EAN');

            if ($searchResults === false
                || (is_array($searchResults) && count($searchResults) === 0)
            ){
                $searchResults = $this->oPrepareHelper->searchOnPriceMinister($product['Title'], 'KW');
            }

            $iMatchedArrayKey = null;
            if (!empty($searchResults)){
                foreach ($searchResults as $sKey => $searchResult){
                    if ($searchResult['ean_match'] === true){
                        $iMatchedArrayKey = $sKey;
                        break;
                    }
                }
            } else{
                $searchResults = array();
            }

            if ($iMatchedArrayKey === null
                && count($searchResults) != 1
            ){
                if (count($searchResults) > 0){
                    $autoMatchingStats['almost']++;
                }

                $autoMatchingStats['nosuccess']++;
                MLDatabase::getDbInstance()->delete(TABLE_MAGNA_SELECTION, array(
                    'pID' => $product['Id'],
                    'mpID' => MLModule::gi()->getMarketPlaceId(),
                    'selectionname' => 'match',
                    'session_id' => session_id()
                ));
                continue;
            } elseif ($iMatchedArrayKey === null){
                $iMatchedArrayKey = 0;
            }

            $oModul = MLModule::gi();
            $ShopVariation = $this->getMatchedVariations($searchResults[$iMatchedArrayKey]['alias']);

            if (empty($ShopVariation)){
                $autoMatchingStats['categories'][] = $searchResults[$iMatchedArrayKey]['category_name'];
                continue;
            }

            $matchedProduct = array(
                'mpID' => $oModul->getMarketPlaceId(),
                'products_id' => $product['Id'],
                'ItemTitle' => $searchResults[$iMatchedArrayKey]['headline'],
                'Description' => $product['Description'],
                'ItemCondition' => $oModul->getPrepareDefaultConfig('itemcondition'),
                'ean' => $product['EAN'],
                'Images' => '[]', // Column in database table cannot be null
                'PrimaryCategory' => $searchResults[$iMatchedArrayKey]['alias'],
                'TopPrimaryCategory' => $searchResults[$iMatchedArrayKey]['alias'],
                'ShopVariation' => $ShopVariation,
                'PrepareType' => 'auto',
                'MPProductId' => $searchResults[$iMatchedArrayKey]['productid'],
                'PreparedTS' => date('Y-m-d H:i:s'),
                'Verified' => 'OK'
            );

            MLDatabase::getDbInstance()->insert(TABLE_MAGNA_PRICEMINISTER_PREPARE, $matchedProduct, true);

            MLDatabase::getDbInstance()->delete(TABLE_MAGNA_SELECTION, array(
                'pID' => $product['Id'],
                'mpID' => MLModule::gi()->getMarketPlaceId(),
                'selectionname' => 'match',
                'session_id' => session_id()
            ));

            $autoMatchingStats['success']++;
        }

        return $autoMatchingStats;
    }

    /**
     * Gets matched values for selected identifier
     *
     * @param string $sIdentifier Matching identifier (usually category name or ID).
     * @return array|bool
     */
    private function getMatchedVariations($sIdentifier)
    {
        $oVariantMatching = $this->getVariationDb();
        $oSelect = MLDatabase::factorySelectClass();
        $aData = $oSelect->select("*")->from($oVariantMatching->getTableName())->where(array('identifier' => $sIdentifier))->getResult();
        return empty($aData) ? '' : $aData[0]['ShopVariation'];
    }

}
