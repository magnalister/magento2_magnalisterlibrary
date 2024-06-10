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

MLFilesystem::gi()->loadClass('Productlist_Controller_Widget_ProductList_UploadAbstract');

abstract class ML_Hood_Controller_Widget_ProductList_Hood_Abstract extends ML_Productlist_Controller_Widget_ProductList_UploadAbstract {

    public function getMarketplacePrice($oProduct) {
        if ($oProduct->get('parentid') == 0) {
            if ($oProduct->isSingle()) {
                $oProduct = $this->getFirstVariant($oProduct);
            } else {
                return array(
                    array(
                        'price' => '&mdash;'
                    )
                );
            }
        }
        $oModel = MLDatabase::factory('hood_prepare')->set('products_id', $oProduct->get('id'));
        if ($oModel->exists()) {
            $oHelper = MLHelper::gi('Model_Table_Hood_PrepareData');
            /* @var $oHelper ML_Hood_Helper_Model_Table_Hood_PrepareData */
            $oHelper->setProduct($oProduct)->setPrepareList(null);
            $aData = $oHelper->getPrepareData(array(
                'price' => array('optional' => array('active' => true)),
                'currencyId'
            ));
            $aAuto = MLDatabase::factory('hood_prepare')->set('products_id', $oProduct->get('id'))->get('price');
            return array(
                array(
                    'price' => MLPrice::factory()->format($aData['price']['value'], $aData['currencyId']['value'], false),
                    'style' => $aAuto === null ? 'color:gray' : ''
                )
            );
        } else {
            return array(
                array(
                    'price' => MLI18n::gi()->Productlist_Cell_sNotPreparedYet
                )
            );
        }
    }

}
