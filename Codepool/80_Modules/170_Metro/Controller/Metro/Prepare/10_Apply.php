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

MLFilesystem::gi()->loadClass('Productlist_Controller_Widget_ProductList_Selection');
class ML_Metro_Controller_Metro_Prepare_Apply extends ML_Productlist_Controller_Widget_ProductList_Selection {

    public static function getTabTitle() {
        return MLI18n::gi()->get('metro_prepare_apply');
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
        MLSetting::gi()->add('aJs', 'metro.form.js');
        try {
            $sExecute = $this->oRequest->get('view');
            if (in_array($sExecute, array('unprepare', 'resetdescription'))) {
                $oModel = MLDatabase::factory('metro_prepare');
                $oList = MLDatabase::factory('selection')->set('selectionname', 'apply')->getList();
                foreach ($oList->get('pid') as $iPid) {
                    $oModel->init()->set('products_id', $iPid);
                    switch ($sExecute) {
                        case 'unprepare':
                            {//delete from metro_prepare
                                $oModel->delete();
                                break;
                            }
                    }
                }
            }
        } catch (Exception $oEx) {
            //echo $oEx->getMessage();
        }
    }

}
