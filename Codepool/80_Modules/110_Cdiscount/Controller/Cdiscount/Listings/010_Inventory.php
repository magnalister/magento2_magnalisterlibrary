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
MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_InventoryAbstract');

class ML_Cdiscount_Controller_Cdiscount_Listings_Inventory extends ML_Listings_Controller_Widget_Listings_InventoryAbstract {
	protected $aParameters = array('controller');

    public static function getTabTitle () {
        return MLI18n::gi()->get('ML_GENERIC_INVENTORY');
    }
    
    public static function getTabActive() {
        return MLModule::gi()->isConfigured();
    }

    public function prepareData() {
        $result = $this->getInventory();

        if (($result !== false) && !empty($result['DATA'])) {
            $this->aData = $result['DATA'];
            foreach ($this->aData as &$item) {
                if (isset($item['Title'])) {
                    $item['MarketplaceTitle'] = $item['Title'];
                }

                $oProduct = MLProduct::factory()->getByMarketplaceSKU($item['SKU']);

                $item['Title'] = '&mdash;';
                $item['editUrl'] = '';
                $item['ShopQuantity'] = '&mdash;';
                if ($oProduct->exists()) {
                    $item['ShopTitle'] = $item['Title'] = $oProduct->getName();
                    $item['editUrl'] = $oProduct->getEditLink();
                    $item['ShopQuantity'] = $oProduct->getStock();
                }

                if (isset($item['ItemId']) && $item['SKU'] === $item['ItemId']) {
					$item['SKU'] = '&mdash;';
				}
            }
            unset($result);
        }
    }

    protected function getFields() {        
        $oI18n = MLI18n::gi();
		return array(
			'SKU' => array (
				'Label' => $oI18n->ML_LABEL_SKU,
				'Sorter' => 'sku',
				'Getter' => 'getSku',
				'Field' => null,
			),
			'Title' => array (
				'Label' => $oI18n->ML_LABEL_SHOP_TITLE,
				'Sorter' => null,
				'Getter' => null,
				'Field' => 'Title',
			),
            'MarketplaceTitle' => array(
                'Label' => MLI18n::gi()->cdiscount_label_title,
                'Sorter' => 'title',
                'Getter' => null,
                'Field' => 'MarketplaceTitle',
            ),
            'EAN' => array (
                'Label' => $oI18n->ML_LABEL_EAN,
                'Sorter' => 'ean',
                'Getter' => 'getEANLink',
                'Field' => null,
            ),
			'Price' => array (
				'Label' => $oI18n->Cdiscount_Productlist_Label_Price,
				'Sorter' => 'price',
				'Getter' => 'getItemPrice',
				'Field' => null,
			),
			'Quantity' => array (
				'Label' => MLI18n::gi()->cdiscount_inventory_listing_quantity,
				'Sorter' => 'quantity',
				'Getter' => 'getQuantities',
				'Field' => null,
			),
            'DateAdded' => array (
 				'Label' => $oI18n->ML_GENERIC_CHECKINDATE,
 				'Sorter' => 'dateadded',
 				'Getter' => 'getItemDateAdded',
 				'Field' => null,
 			),
            'Status' => array(
				'Label' => MLI18n::gi()->cdiscount_inventory_listing_status,
 				'Sorter' => null,
 				'Getter' => 'getStatus',
 				'Field' => null,
			),
		);
	}
    
    protected function getSortOpt() {
        if (isset($this->aPostGet['sorting'])) {
            $sorting = $this->aPostGet['sorting'];
        } else {
            $sorting = 'blabla'; // fallback for default
        }
        //ToDo
        $sortFlags = array(
            'sku' => 'SKU',
            'ean' => 'EAN',
            'title' => 'Title',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'dateadded' => 'DateAdded',
        );
        $order = 'ASC';
        if (strpos($sorting, '-asc') !== false) {
            $sorting = str_replace('-asc', '', $sorting);
        } else if (strpos($sorting, '-desc') !== false) {
            $order = 'DESC';
            $sorting = str_replace('-desc', '', $sorting);
        }

        if (array_key_exists($sorting, $sortFlags)) {
            $this->aSort['order'] = $sortFlags[$sorting];
            $this->aSort['type'] = $order;
        } else {
            $this->aSort['order'] = 'DateAdded';
            $this->aSort['type'] = 'DESC';
        }
    }

    protected function getEANLink($item) {
        if (empty($item['EAN'])) {
            return '<td>&mdash</td>';
        }

        if (empty($item['CdiscountSKU'])) {
            return '<td>'.$item['EAN'].'</td>';
        } else {
            // since Cdiscount can only find parent remove -XXXX from SKU (that's the parent) example: MP32312-0001 (-0001 is indicator for variation)
            $aExplode = explode('-', $item['CdiscountSKU']);
            $sMasterSKU = $aExplode[0];
            return '<td><a href="http://www.cdiscount.com/search/'.$sMasterSKU.'.html" target="_blank">'.$item['EAN'].'</a></td>';
        }
    }

    protected function getSku($item)
    {
        $html = '<td>'.$item['SKU'].'</td>';
        if (!empty($item['editUrl'])) {
            $html = '<td><div class="product-link" ><a class="ml-js-noBlockUi" href="'.$item['editUrl'].'" target="_blank" title="'.MLI18n::gi()->ML_LABEL_EDIT.'">'.$item['SKU'].'</a></div></td>';
        }

        return $html;
    }
    
    protected function getQuantities($item)
    {
        return '<td>' . $item['ShopQuantity'] . ' / ' . $item['Quantity'] . '</td>';
    }
    
    protected function getItemDateAdded($item) {
        if (empty($item['DateAdded'])) {
            return '<td>&mdash</td>';
        }

        $timestamp = strtotime($item['DateAdded']);
        if ($timestamp < strtotime('2001-01-01')) {
            return '<td>&mdash;</td>';
        }

        return '<td>' . date("d.m.Y", $timestamp) . ' &nbsp;&nbsp;<span class="small">' . date("H:i", $timestamp) . '</span>' . '</td>';
    }
    
    protected function getStatus($item) {

        $item['Status'] = $item['StatusOffer']; // status offer is status that merchant wants

		if (isset($item['Status']) === false) {
			$status = '-';
		} else if ($item['Status'] === 'Update') {
			$status = MLI18n::gi()->cdiscount_inventory_listing_status_update;
        } else if ($item['Status'] === 'Active') {
            $status = MLI18n::gi()->cdiscount_inventory_listing_status_active;
		} else if ($item['Status'] === 'Waiting' || $item['Status'] === 'WaitingUpdate') {
			$status = MLI18n::gi()->cdiscount_inventory_listing_status_waiting;
		} else {
			$status = MLI18n::gi()->cdiscount_inventory_listing_status_new;
		}
		
		return '<td>' . $status . '</td>';
	}

	protected function postDelete() {
		MagnaConnector::gi()->submitRequest(array(
			'ACTION' => 'UploadItems'
		));
    }
    
    public function initAction() {
        if (isset($this->aPostGet['SKUs']) && is_array($this->aPostGet['SKUs']) 
                && isset($this->aPostGet['action']) && $this->aPostGet['action'] == 'delete') {
            $_SESSION['POST_TS'] = $this->aPostGet['timestamp'];

            $aInsertData = array();
			$aDeleteItemsData = array();
            foreach ($this->aPostGet['SKUs'] as $sSku) {
                $oProduct = MLProduct::factory()->getByMarketplaceSKU($sSku);

                $aDetails = unserialize(str_replace('\\"', '"', $this->aPostGet['details'][$sSku]));
                $iProductId = $sProductSku = '';
                if ($oProduct->exists()) {
                    $iProductId = $oProduct->get('MarketplaceIdentId');
                    $sProductSku = $oProduct->get('MarketplaceIdentSku');
                } else {
                    $sProductSku = $sSku;
                }

                $aInsertData[] = array(
                    'mpID' => $this->iMpId,
                    'productsId' => $iProductId,
                    'productsSku' => $sProductSku,
                    'price' => $aDetails['Price'],
                    'timestamp' => date('Y-m-d H:i:s')
                );

                $aDeleteItemsData[] = array(
					'SKU' => $sSku,
				);
            }

            try {
                $result = MagnaConnector::gi()->submitRequest(array(
                    'ACTION' => 'DeleteItems',
                    'DATA' => $aDeleteItemsData
                ));
                /** @todo create helper if need  call_user_func(ucfirst($this->marketplace) . 'Helper::processCheckinErrors', $result, $this->iMpId); */
            } catch (MagnaException $e) {
                $result = array(
                    'STATUS' => 'ERROR'
                );
            }

            if ($result['STATUS'] == 'SUCCESS') {
                $oDb = MLDatabase::getDbInstance();
                if ($oDb->batchinsert(
                        'magnalister_listings_deleted', $aInsertData
                    ) != true) {
                    MLMessage::gi()->addWarn($oDb->getLastError());
                }
                $this->postDelete();
            }
        }

        $this->getSortOpt();

        if (isset($this->aPostGet['page']) && ctype_digit($this->aPostGet['page'])) {
            $this->iOffset = ($this->aPostGet['page'] - 1) * $this->aSetting['itemLimit'];
        } else {
            $this->iOffset = 0;
        }
    }
}
