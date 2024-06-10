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
MLFilesystem::gi()->loadClass('ProductList_Model_ProductListDependency_PrepareStatusFilter');
class ML_Ebay_Model_ProductListDependency_PrepareStatusFilter extends ML_ProductList_Model_ProductListDependency_PrepareStatusFilter {

    protected function getWhereConditionForVariantIsActive($sValue) {
        if($this->getConfig('selectionname') == 'match'){
            switch ($sValue) {
                case 'ERROR': return "(ePID IS NULL OR ePID = '')";
                case 'OK': return " ePID IS NOT NULL AND ePID <> '' ";                
                case 'not':
                default : return '';
            }
        } else if ($sValue === 'ERROR') {
            return MLDatabase::getPrepareTableInstance()->getPreparedStatusFieldName()." in ('".MLDatabase::getDbInstance()->escape($sValue)."', 'OPEN')";
        } else {
            return parent::getWhereConditionForVariantIsActive($sValue);
        }
    }
    
    protected function getWhereConditionForGetMasterIdents($sValue) {
        if($this->getConfig('selectionname') == 'match'){
            switch ($sValue) {
                case 'ERROR': return "(ePID IS NULL OR ePID = '')";
                case 'OK': return " ePID IS NOT NULL AND ePID <> '' ";                
                case 'not':
                default : return '';
            }
        } else if ($sValue === 'ERROR') {
            return "prepare.".MLDatabase::getPrepareTableInstance()->getPreparedStatusFieldName()." in ('".MLDatabase::getDbInstance()->escape($sValue)."', 'OPEN')";
        } else {
            return parent::getWhereConditionForGetMasterIdents($sValue);
        }
    }
    
}
