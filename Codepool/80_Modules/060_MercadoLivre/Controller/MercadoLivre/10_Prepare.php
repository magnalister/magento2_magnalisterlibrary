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

class ML_MercadoLivre_Controller_MercadoLivre_Prepare extends ML_Productlist_Controller_Widget_ProductList_Selection {

    public function __construct() {
        parent::__construct();
        try {
            $sExecute = $this->oRequest->get('view');
            if (in_array($sExecute, array('unprepare'))) {
                $oModel = MLDatabase::factory('mercadolivre_prepare');
                $oList = MLDatabase::factory('selection')->set('selectionname', 'match')->getList();
                foreach ($oList->get('pid') as $iPid) {
                    $oModel->init()->set('products_id', $iPid);
                    if ('unprepare' == $sExecute) {
                        $oModel->delete();
                    }
                }
            }
        } catch (Exception $oEx) {
//            echo $oEx->getMessage();
        }
    }

}
