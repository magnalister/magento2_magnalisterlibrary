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
abstract class ML_Productlist_Model_ProductList_Abstract{
    
    const PRODUCTLIST_PREPARE_COLUMNS = 'Productlist_Prepare_Columns';
    const PRODUCTLIST_UPLOAD_COLUMNS = 'Productlist_Upload_Columns';
    const PRODUCTLIST_UPLOAD_NOPREPARETYPE_COLUMNS = 'Productlist_Upload_NoPrepareType_Columns';
    
    protected static $aPreparedData = null;
    
    /**
     * set ml['filter']
     * including 
     *  meta=>array(
     *      'page'=>int, 
     *      'order'=>%fieldName%_%asc|desc%, 
     *      'additional stuff'=>'' 
     * )
     * @return $this
     */
    abstract public function setFilters($aFilter);
    
    /**
     * get list of ML_Magnalister_Model_Shop_Product
     * ML_Shop_Model_Product_Abstract::getMixedData('@key'=>array(mo optional data, need the same key like getHead),..)
     * @see /Extensions/System/Magnalister/View/widget/productlist/filter/%typeValue%.php
     * @return iterator
     */
    abstract public function getList();
    
    /**
     * get list of filters
     *  array(
     *      array(//filter
     *          //type: defines template for render.
     *          //@see /Extensions/System/Magnalister/View/widget/productlist/filter/%typeValue%.php
     *          'type'=>'typeValue',
     *          'depend'=>'on',
     *          'typeValue'=>'template',
     *      ),
     *      ...
     *  )
     * @return array
     */
    abstract public function getFilters();
    
    /**
     * get statistic of list
     * array(
     *  'blPagination'=>bool,//optional, if false no pagination
     *  'iCountPerPage'=>0
     *  'iCurrentPage'=>0
     *  'iCountTotal'=>0,
     *  'aOrder'=>array(
     *      'name'=>''
     *      'direction'=>''
     *  )
     * )
     * @return array 
     */
    abstract public function getStatistic();
    
    /**
     * get columns of productlist (thead)
     * array(
     *  '@key'=>array(
     *      'title'=>'th-element',
     *      'type'=>'for th-class'
     *      'order'=>'order-name'//if isset will be possible order asc or desc
     *  ),
     *  ---
     * )
     * @return array 
     */
    abstract public function getHead();
    
    /**
     * array(
     *      //single row
     *      //@see /Extensions/System/Magnalister/View/widget/productlist/row/%type%.php
     *      'type'=> '',//defines template for render.
     *      'type_variant'=>'',//defines template for render. optional
     *      'width_variant'=>'',//difines colspan. optional
     *      'title'=>'',...
     * );
     * @return array
     * @param $oProduct ML_Shop_Model_Product_Abstract for manipulating $oProduct->__set();
     */
    abstract public function additionalRows(ML_Shop_Model_Product_Abstract $oProduct);
    
    /**
     * 
     * @param ML_Shop_Model_Product_Abstract $oProduct
     * @param string $sKey col-index
     */
    abstract public function getMixedData(ML_Shop_Model_Product_Abstract $oProduct, $sKey);
    /**
     * 
     * @param ML_Shop_Model_Product_Abstract $oProduct
     * @return bool
     */
    abstract public function variantInList(ML_Shop_Model_Product_Abstract $oProduct);
    /**
     *
     * @param int $iFrom
     * @param int $iCount
     * @return ML_Productlist_Model_ProductList_Abstract
     */
    abstract public function setLimit($iFrom, $iCount);
    /**
     * @param bool $blPage ? current page : complete list
     * @return array 
     */
    abstract public function getMasterIds($blPage = false);

    /**
     * @var array cache variant of loaded product to speed it up for next load
     */
    static protected $aProductVariantCache = array();

    /**
     * return array of ML_Shop_Model_Product_Abstract
     */
    public function getVariants(ML_Shop_Model_Product_Abstract $oProduct) {
        if (!isset(self::$aProductVariantCache[$oProduct->get('id')])) {
            foreach ($oProduct->getVariants() as $oVariant) {
                if ($this->variantInList($oVariant)) {
                    self::$aProductVariantCache[$oProduct->get('id')][] = $oVariant;
                }
            }
        }
        return self::$aProductVariantCache[$oProduct->get('id')];
    }
    
    /**
     * returns prepared info of current product
     * 
     * @param ML_Shop_Model_Product_Abstract $oProduct
     * @return array array('color'=>'','title'=>'')
     */
    public function getPreparedFieldData($oProduct) {
        $iProductId = $oProduct->get('id');
        if(self::$aPreparedData == null || !isset(self::$aPreparedData[$iProductId])){
            $oPrepareTable = MLDatabase::getPrepareTableInstance();
            $sPrepareTableName = $oPrepareTable->getTableName();
            $aI18n = $oPrepareTable->getPreparedProductListValues();
            $sPreparedType = $oPrepareTable->getPreparedTypeFieldName();
            $sPreparedStatusFieldName = $oPrepareTable->getPreparedStatusFieldName();

            if ($oProduct->get('parentid') == 0) {          
                $sQuery = "
                    SELECT COUNT(*) AS count, $sPreparedStatusFieldName
                           " . (($sPreparedType === null) ? '' : ', ' . $sPreparedType) . "
                    FROM magnalister_products
                    INNER JOIN ".$sPrepareTableName." ON magnalister_products.id = ".$sPrepareTableName.".".$oPrepareTable->getProductIdFieldName()."
                    WHERE     " . $oPrepareTable->getMarketplaceIdFieldName() . "='" . MLModule::gi()->getMarketPlaceId() . "'
                        AND magnalister_products.parentid= ".(int)$oProduct->get('id')."
                    GROUP BY ".$sPreparedStatusFieldName."
                           ".(($sPreparedType === null) ? '' : ', '.$sPreparedType)."
                ";
                $aGrouped = MLDatabase::getDbInstance()->fetchArray($sQuery);
                $aOut = array();
                $iCount = 0;
                $iGroup = 0;
                foreach ($aGrouped as $iGroup => $aSelected) {
                    if (   isset($aSelected[$sPreparedStatusFieldName])
                        && array_key_exists($aSelected[$sPreparedStatusFieldName], $aI18n)
                    ) {
                        $aOut[$iGroup] = $aI18n[$aSelected[$sPreparedStatusFieldName]];
                        $aOut[$iGroup]['status'] = $aSelected[$sPreparedStatusFieldName];
                        $aTypeI18n = MLI18n::gi()->get(ucfirst(MLModule::gi()->getMarketPlaceName()) . '_Productlist_Cell_aPreparedType');
                        if ($sPreparedType !== null) {
                            $aOut[$iGroup]['type'] =
                                isset($aTypeI18n[$aSelected[$sPreparedType]])
                                    ? $aTypeI18n[$aSelected[$sPreparedType]]
                                    : $aSelected[$sPreparedType];
                        }
                        $aOut[$iGroup]['count'] = $aSelected['count'];
                        $iCount += $aSelected['count'];
                    }
                }

                if ($oProduct->getVariantCount() > $iCount || ($oProduct->getVariantCount() == 0 && $iCount == 0)) {
                    $iGroup++;
                    $aOut[$iGroup] = MLI18n::gi()->getGlobal('Productlist_Cell_aNotPreparedStatus');
                    $aOut[$iGroup]['status'] = 'not';
                    if ($sPreparedType !== null) {
                        $aOut[$iGroup]['type'] = MLI18n::gi()->get('Productlist_Cell_sNotPreparedType');
                    }
                    $aOut[$iGroup]['count'] = $oProduct->getVariantCount() - $iCount;
                }
                self::$aPreparedData[$iProductId] = $aOut;
            } else {
                 $aSelected = MLDatabase::factorySelectClass()
                        ->select($sPreparedStatusFieldName." ".(($sPreparedType === null) ? '' : ', '.$sPreparedType))
                        ->from($sPrepareTableName)
                        ->where(array(
                            $oPrepareTable->getMarketplaceIdFieldName() => MLModule::gi()->getMarketPlaceId(),
                            $oPrepareTable->getProductIdFieldName() => $oProduct->get('id')
                        ))->getRowResult();
                if (   isset($aSelected[$sPreparedStatusFieldName])
                    && array_key_exists($aSelected[$sPreparedStatusFieldName], $aI18n)
                ) {
                    $aOut = $aI18n[$aSelected[$sPreparedStatusFieldName]];
                    $aOut['status'] = $aSelected[$sPreparedStatusFieldName];
                    $aTypeI18n = MLI18n::gi()->get(ucfirst(MLModule::gi()->getMarketPlaceName()) . '_Productlist_Cell_aPreparedType');
                    if ($sPreparedType !== null) {
                        $aOut['type'] =
                            isset($aTypeI18n[$aSelected[$sPreparedType]])
                                ? $aTypeI18n[$aSelected[$sPreparedType]]
                                : $aSelected[$sPreparedType];
                    }
                    self::$aPreparedData[$iProductId] = $aOut;
                } else {
                    $aOut = MLI18n::gi()->getGlobal('Productlist_Cell_aNotPreparedStatus');
                    $aOut['status'] = 'not';
                    if ($sPreparedType !== null) {
                        $aOut['type'] = MLI18n::gi()->get('Productlist_Cell_sNotPreparedType');
                    }
                    self::$aPreparedData[$iProductId] = $aOut;
                }
            }
        }
        return self::$aPreparedData[$iProductId];
    }
    
    /**
     * Checks whether product attributes are prepared differently than in variation matching tab.
     *
     * @param ML_Shop_Model_Product_Abstract $oProduct
     * @return array
     */
    public function isPreparedDifferently($oProduct)
    {
        $warningMessages = array();
        $oPrepareTable = MLDatabase::getPrepareTableInstance();
        $sTableName = $oPrepareTable->getTableName();
        if (!$oPrepareTable->isVariationMatchingSupported()) {
            return $warningMessages;
        }

        $sShopVariationField = $oPrepareTable->getShopVariationFieldName();
        $sCategoryField = $oPrepareTable->getPrimaryCategoryFieldName();
        $mpId = MLModule::gi()->getMarketPlaceId();
        $productId = (int)$oProduct->get('id');

        if ($oProduct->get('parentid') == 0) {
            $aPreparedData = MLDatabase::getDbInstance()->fetchRow("
                SELECT $sTableName.$sShopVariationField, $sTableName.$sCategoryField
                  FROM magnalister_products
                      INNER JOIN $sTableName ON magnalister_products.id = $sTableName.{$oPrepareTable->getProductIdFieldName()}
                  WHERE {$oPrepareTable->getMarketplaceIdFieldName()} = '$mpId'
                      AND magnalister_products.parentid='".$productId."'
            ");
        } else {
            $aPreparedData = MLDatabase::getDbInstance()->fetchRow("
                SELECT $sShopVariationField, $sCategoryField
                  FROM $sTableName
                 WHERE {$oPrepareTable->getMarketplaceIdFieldName()} = '$mpId'
                   AND {$oPrepareTable->getProductIdFieldName()} = '".$productId."'
            ");
        }

        if (isset($aPreparedData[$sCategoryField])) {
            $sGlobalMatching = $this->getMatchedAttributes($aPreparedData[$sCategoryField]);
            $shopAttributes = MLFormHelper::getShopInstance()->getFlatShopAttributesForMatching();

            $preparedData = isset($aPreparedData[$sShopVariationField]) ? json_decode($aPreparedData[$sShopVariationField], true) : null;

            $this->filterAMPreparedDataBeforeComparison($preparedData, $aPreparedData[$sCategoryField], $sGlobalMatching);

            if ($sGlobalMatching && $sGlobalMatching != $preparedData) {
                $warningMessages[] = 'Productlist_ProductMessage_sPreparedDifferently';
            }

            if (is_array($preparedData)) {
                foreach ($preparedData as $attribute) {
                    if ($attribute['Code'] === '' || $attribute['Code'] === 'freetext' || $attribute['Code'] === 'attribute_value') {
                        continue;
                    }

                    if (!isset($shopAttributes[$attribute['Code']])) {
                        $warningMessages[] = 'Productlist_ProductMessage_sAttributeDeletedFromTheShop';
                        return $warningMessages;
                    }

                    $shopAttributeValues = MLFormHelper::getShopInstance()->getAttributeOptions($attribute['Code']);

                    if (isset($attribute['Values']) && is_array($attribute['Values'])) {
                        foreach ($attribute['Values'] as $attributeValue) {
                            if (!is_array($attributeValue['Shop']['Key'])) {
                                $attributeValue['Shop']['Key'] = array($attributeValue['Shop']['Key']);
                            }

                            $missingShopValueKeys = array_diff_key(array_flip($attributeValue['Shop']['Key']), $shopAttributeValues);
                            if (count($missingShopValueKeys) > 0) {
                                $warningMessages[] = 'Productlist_ProductMessage_sAttributeValuesDeletedFromTheShop';
                                return $warningMessages;
                            }
                        }
                    }
                }
            }
        }

        return $warningMessages;
    }

    /**
     * Filters prepared attributes matching data additionally before comparing it to global matching.
     *
     * @param array $preparedData Attributes matching data from Prepare table for product
     * @param string $categoryCode Category code
     */
    protected function filterAMPreparedDataBeforeComparison(&$preparedData, $categoryCode)
    {
    }

    /**
     * Gets matched values for selected identifier
     *
     * @param string $sIdentifier Matching identifier (usually category name or ID).
     * @return array|bool
     */
    protected function getMatchedAttributes($sIdentifier)
    {
        $oVariantMatching = MLDatabase::getVariantMatchingTableInstance();
        $oSelect = MLDatabase::factorySelectClass();
        $aResult = $oSelect->select("*")->from($oVariantMatching->getTableName())
            ->where(array('identifier' => $sIdentifier))->getResult();
        $aData = isset($aResult[0]) ? $aResult[0] : array();
        return empty($aData) ? array() : json_decode($aData['ShopVariation'], true);
    }
}
