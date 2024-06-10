<?php
MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_InventoryAbstract');
class ML_Check24_Controller_Check24_Listings_Inventory extends ML_Listings_Controller_Widget_Listings_InventoryAbstract {
    protected $aParameters=array('controller');
    
    public static function getTabTitle () {
        return MLI18n::gi()->get('ML_GENERIC_INVENTORY');
    }
    public static function getTabActive() {
        return MLModule::gi()->isConfigured();
    }
    

    
    protected function getFields() {
        $aFields = parent::getFields();
        unset($aFields['ItemID'], $aFields['DateAdded']);
        return array_merge(
                $aFields, array(
            'LastSync' => array(
                'Label' => MLI18n::gi()->ML_GENERIC_LASTSYNC,
                'Sorter' => null,
                'Getter' => 'getItemLastSyncTime',
                'Field' => null
            ),
            'Status' => array(
                'Label' => MLI18n::gi()->check24_inventory_listing_status,
                'Getter' => 'getStatus',
                'Field' => null
            ),
        ));
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

	/**
	 * Overridden method, because of asynchronous upload concept, here parameter EXTRA is added
	 *
	 * @return bool
	 */
	protected function getInventory() {
		try {
			$request = array(
				'ACTION' => 'GetInventory',
				'LIMIT' => $this->aSetting['itemLimit'],
				'OFFSET' => $this->iOffset,
				'ORDERBY' => $this->aSort['order'],
				'SORTORDER' => $this->aSort['type'],
				'EXTRA' => 'ShowPending'
			);
			if (!empty($this->search)) {
				$request['SEARCH'] = $this->search;
			}
			$result = MagnaConnector::gi()->submitRequest($request);
			$this->iNumberofitems = (int)$result['NUMBEROFLISTINGS'];
			return $result;
		} catch (MagnaException $e) {
			return false;
		}
	}

	/**
	 * Prints indicators in inventory table
	 * @param $item
	 * @return string
	 */
	protected function getStatus($item) {
		$html = '<td>';
		$status = $item['Status'];
		$updated = $item['Updated'];
		if ($status == 'active') {
			$html .= '<div class="semaphore-base semaphoreGreen"></div>';
		} elseif ($status == 'pending' && $updated == 'false') {
			$html .= '<div class="semaphore-base semaphoreGray"></div>';
		} elseif ($status == 'pending' && $updated == 'true') {
			$html .= '<div class="semaphore-base semaphoreBlue"></div>';
		}

		return $html . '</td>';
	}
        
}
