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

class ML_PriceMinister_Controller_PriceMinister_Prepare_Apply extends ML_Productlist_Controller_Widget_ProductList_Selection {

    public static function getTabTitle() {
        return MLI18n::gi()->get('priceminister_prepare_apply');
    }

    public static function getTabDefault() {
        $sValue = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.ean')->get('value');
        return (empty($sValue)) ? false : true;
    }

    protected function getListName() {
        $sValue = MLDatabase::factory('config')->set('mpid', 0)->set('mkey', 'general.ean')->get('value');
        if (empty($sValue)) {
        }
        return parent::getListName();//'apply';
    }

    public function __construct() {
        parent::__construct();
        try {
            $sExecute = $this->oRequest->get('execute');
            if (in_array($sExecute, array('unprepare', 'resetdescription'))) {
                $oModel = MLDatabase::factory('priceminister_prepare');
                $oList = MLDatabase::factory('selection')->set('selectionname', 'apply')->getList();
                foreach ($oList->get('pid') as $iPid) {
                    $oModel->init()->set('products_id', $iPid);
                    switch ($sExecute) {
                        case 'unprepare': {//delete from priceminister_prepare
                            $oModel->delete();
                            break;
                        }
                        case 'resetdescription': {//set products description of priceminister to actual product-description
                            if ($oModel->exists()) {
                                $sLang = MLModule::gi()->getConfig('lang');

                                MLProduct::factory()->set('id', $iPid)->setLang($sLang);
                                $sName = MLProduct::factory()->set('id', $iPid)->getName();
                                if (isset($sName) === true) {
                                    $oModel->set('ItemTitle', $sName)->save();
                                } else {
                                    $oModel->set('ItemTitle', '')->save();
                                }

                                $sDescription = MLProduct::factory()->set('id', $iPid)->getDescription();
                                if (isset($sDescription) === true) {
                                    $oModel->set('Description', $sDescription)->save();
                                } else {
                                    $oModel->set('Description', '')->save();
                                }

                                $aImages = MLProduct::factory()->set('id', $iPid)->getImages();
                                if (empty($aImages) === false) {
                                    $aIds = array();
                                    foreach ($aImages as $sImagePath) {
                                        $sId = $this->substringAferLast('\\', $sImagePath);
                                        if (isset($sId) === false || strpos($sId, '/') !== false) {
                                            $sId = $this->substringAferLast('/', $sImagePath);
                                        }

                                        $aIds[] = $sId;
                                    }

                                    $oModel->set('Images', json_encode($aIds))->save();
                                }
                            }
                            break;
                        }
                    }
                }
            }
        } catch (Exception $oEx) {
//            echo $oEx->getMessage();
        }
    }

    private function substringAferLast($sNeedle, $sString) {
        if (!is_bool($this->strrevpos($sString, $sNeedle))) {
            return substr($sString, $this->strrevpos($sString, $sNeedle) + strlen($sNeedle));
        }
    }

    private function strrevpos($instr, $needle) {
        $rev_pos = strpos(strrev($instr), strrev($needle));
        if ($rev_pos === false) {
            return false;
        } else {
            return strlen($instr) - $rev_pos - strlen($needle);
        }
    }

}