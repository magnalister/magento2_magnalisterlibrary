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
MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_InventoryAbstract');

class ML_MercadoLivre_Controller_MercadoLivre_Listings_Inventory extends ML_Listings_Controller_Widget_Listings_InventoryAbstract {
	protected $aParameters=array('controller');

    public static function getTabTitle () {
        return MLI18n::gi()->get('ML_GENERIC_INVENTORY');
    }
    public static function getTabActive() {
        return MLModule::gi()->isConfigured();
    }

    protected function getFields() {
        $oI18n = MLI18n::gi();
		return array(
			'SKU' => array (
				'Label' => $oI18n->ML_LABEL_SKU,
				'Sorter' => 'sku',
				'Getter' => null,
				'Field' => 'SKU'
			),
			'Title' => array (
				'Label' => $oI18n->ML_LABEL_SHOP_TITLE,
				'Sorter' => null,
				'Getter' => 'getTitle',
				'Field' => null,
			),
			'Price' => array (
                'Label' => $oI18n->ML_LABEL_SHOP_PRICE.' / '.MLModule::gi()->getMarketPlaceName(false).' '.$oI18n->ML_GENERIC_PRICE,
				'Sorter' => 'price',
				'Getter' => 'getItemPrice',
				'Field' => null
			),
			'Quantity' => array (
				'Label' => $oI18n->ML_LABEL_QUANTITY,
				'Sorter' => 'quantity',
				'Getter' => null,
				'Field' => 'Quantity',
			),
			'StartTime' => array (
				'Label' => $oI18n->ML_GENERIC_CHECKINDATE,
				'Sorter' => 'starttime',
				'Getter' => 'getItemStartTime',
				'Field' => null
			),
			'LastSync' => array (
				'Label' => $oI18n->ML_GENERIC_LASTSYNC,
				'Sorter' => null,
				'Getter' => 'getItemLastSyncTime',
				'Field' => null
			),
		);
	}

	protected function getItemStartTime($item) {
		$item['StartTime'] = strtotime($item['StartTime']);
		return '<td>'.date("d.m.Y", $item['StartTime']).' &nbsp;&nbsp;<span class="small">'.date("H:i", $item['StartTime']).'</span>'.'</td>';
	}

	protected function getItemLastSyncTime($item) {
		$item['LastSync'] = strtotime($item['LastSync']);
		if ($item['LastSync'] < 0) {
			return '<td>-</td>';
		}
		return '<td>'.date("d.m.Y", $item['LastSync']).' &nbsp;&nbsp;<span class="small">'.date("H:i", $item['LastSync']).'</span>'.'</td>';
	}

	protected function postDelete() {
		MagnaConnector::gi()->submitRequest(array(
			'ACTION' => 'UploadItems'
		));
    }
}
