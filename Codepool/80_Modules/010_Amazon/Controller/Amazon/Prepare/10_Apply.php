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

MLFilesystem::gi()->loadClass('Productlist_Controller_Widget_ProductList_Selection');

class ML_Amazon_Controller_Amazon_Prepare_Apply extends ML_Productlist_Controller_Widget_ProductList_Selection {

    public static function getTabTitle() {
        return MLI18n::gi()->get('amazon_prepare_apply');
    }

    public static function getTabDefault() {
        $sValue = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.ean')->get('value');
        return (empty($sValue)) ? false : true;
    }

    protected function getListName() {
        $sValue = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.ean')->get('value');
        if (empty($sValue)) {
            MLMessage::gi()->addError($this->__('ML_ERROR_MISSING_PRODUCTS_EAN'), array('md5' => 1423132127));
            throw new Exception($this->__('ML_ERROR_MISSING_PRODUCTS_EAN'), 1423132127); //message will be rendered inside tab by md5
        }
        return parent::getListName();//'apply';
    }

    public function __construct() {
        parent::__construct();
        try {
            $sExecute = $this->oRequest->get('execute');
            if (in_array($sExecute, array('unprepare', 'resetdescription'))) {
                $oModel = MLDatabase::factory('amazon_prepare');
                $oList = MLDatabase::factory('selection')->set('selectionname', 'apply')->getList();
                foreach ($oList->get('pid') as $iPid) {
                    $oModel->init()->set('productsid', $iPid);
                    switch ($sExecute) {
                        case 'unprepare':
                            {//delete from amazon_prepare
                                $oModel->delete();
                                break;
                            }
                        case 'resetdescription':
                            {//set products description of amazon to actual product-description
                                $aModelData = $oModel->get('applydata');
                                if (!empty($aModelData)) {
                                    $aProductType = $aModelData['ProductType'];
                                    $aBrowseNodes = $aModelData['BrowseNodes'];
                                    $aAttributes = $aModelData['Attributes'];
                                } else {
                                    $aProductType = $oModel->get('ProductType');
                                    $aBrowseNodes = $oModel->get('BrowseNodes');
                                    $aAttributes = $oModel->get('Attributes');
                                }

                                $mainCategory = $oModel->get('maincategory');
                                $aData = array(//data we dont change
                                    'maincategory' => isset($mainCategory) ? $mainCategory : '',
                                    'ProductType' => isset($aProductType) ? $aProductType : '',
                                    'BrowseNodes' => isset($aBrowseNodes) ? $aBrowseNodes : '',
                                    'Attributes' => isset($aAttributes) ? $aAttributes : '',
                                );

                                $oProduct = MLProduct::factory()->set('id', $iPid);
                                MLHelper::gi('model_table_amazon_prepare_product')
                                    ->apply($oProduct, $aData)
                                    ->getTableModel()
                                    ->save();
                                break;
                            }
                    }
                }
            }
        } catch (Exception $oEx) {
            MLMessage::gi()->addDebug($oEx);
        }
    }

}