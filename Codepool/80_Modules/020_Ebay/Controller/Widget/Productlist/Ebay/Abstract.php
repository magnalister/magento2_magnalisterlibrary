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

MLFilesystem::gi()->loadClass('Productlist_Controller_Widget_ProductList_UploadAbstract');

abstract class ML_Ebay_Controller_Widget_ProductList_Ebay_Abstract extends ML_Productlist_Controller_Widget_ProductList_UploadAbstract {

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
        $oModel = MLDatabase::factory('ebay_prepare')->set('products_id', $oProduct->get('id'));
        if ($oModel->exists()) {
            $oHelper = MLHelper::gi('Model_Table_Ebay_PrepareData');
            /* @var $oHelper ML_Ebay_Helper_Model_Table_Ebay_PrepareData */
            $oHelper->setProduct($oProduct)->setPrepareList(null);
            $aData = $oHelper->getPrepareData(array(
                'startprice' => array('optional' => array('active' => true)),
                'currencyId'
            ));
            $aAuto = MLDatabase::factory('ebay_prepare')->set('products_id', $oProduct->get('id'))->get('startprice');
            $aRet = array(
                array(
                    'price' => MLPrice::factory()->format($aData['startprice']['value'], $aData['currencyId']['value'], false),
                    'style' => $aAuto === null ? 'color:gray' : ''
                )
            );
            $sStrike = MLDatabase::factory('ebay_prepare')->set('products_id', $oProduct->get('id'))->get('strikeprice');
            if ($sStrike == 'true') {
                $fStrikePriceValue = $oProduct->getSuggestedMarketplacePrice(MLModule::gi()->getPriceObject('strikeprice'), true, false);
                if ($fStrikePriceValue > $aData['startprice']['value']) {
                    $aRet[] =
                        array(
                            'price' => MLPrice::factory()->format($fStrikePriceValue, $aData['currencyId']['value'], false),
                            'style' => 'color:#e31a1c;text-decoration:line-through'
                        );
                }
            }
            return $aRet;
        } else {
            return array(
                array(
                    'price' => MLI18n::gi()->Productlist_Cell_sNotPreparedYet
                    )
                );
        }
    }

}
