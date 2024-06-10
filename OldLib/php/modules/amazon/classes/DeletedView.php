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

if (!defined('_ML_INSTALLED'))
    throw new Exception('Direct Access to this location is not allowed.');

require_once (DIR_MAGNALISTER_MODULES.'amazon/amazonFunctions.php');

class DeletedView  extends ML_Core_Controller_Abstract{
	private $delFromDate;
	private $deToDate;
	private $settings = array();
        protected $aParameters = array('controller');

	public function __construct($settings = array()) {
                parent::__construct();
		$aPost = MLHttp::gi()->getRequest();
		$this->settings = array_merge(array(
			'maxTitleChars'	=> 40,
		), $settings);

		$this->delFromDate = mktime(0, 0, 0, date('n'), 1, date('Y'));
		$this->deToDate = mktime(23, 59, 59, date('n'), date('j'), date('Y'));
		
		if (isset($aPost['date']['from'])) {
			$this->delFromDate = strtotime($aPost['date']['from']);
		}
		if (isset($aPost['date']['to'])) {
			$this->deToDate = strtotime($aPost['date']['to']);
			$this->deToDate += 24 * 60 * 60 - 1;
		}
	}

    private function getDeteltedItems() {
        $result = array();
        try {
            $result = MagnaConnector::gi()->submitRequest(array(
                'ACTION' => 'GetDeletedItemsForDateRange',
                'BEGIN' => date('Y-m-d H:i:s', $this->delFromDate),
                'END' => date('Y-m-d H:i:s', $this->deToDate),
            ));
        } catch (MagnaException $e) {
            $this->latestChange = 0;
            return false;
        }
        if (!array_key_exists('DATA', $result) || empty($result['DATA'])) {
            return array();
        }
        foreach ($result['DATA'] as &$item) {
            $item['DateAdded'] = strtotime($item['DateAdded'] . ' +0000');
            //$pID = magnaAmazonSKU2pID($item['SKU'], $item['ASIN']);
            $oProduct = MLProduct::factory();
            $iPIDbyASIN = false;
            if (!($oProduct->getByMarketplaceSKU($item['SKU'])->exists() || $oProduct->getByMarketplaceSKU($item['SKU'], true)->exists()) && !empty($item['ASIN'])) {
                $iPIDbyASIN = MLDatabase::factory('amazon_prepare')->getByIdentifier($item['ASIN'], 'asin');
                $oProduct->set('id', $iPIDbyASIN);
            }
            if ($oProduct->exists()) {
                $item['ShopItemName'] = $oProduct->getName();
                $item['ShopItemNameShort'] = (
                        (strlen($item['ShopItemName']) > $this->settings['maxTitleChars'] + 2) ?
                                (fixHTMLUTF8Entities(substr($item['ShopItemName'], 0, $this->settings['maxTitleChars']), ENT_COMPAT) . '&hellip;') :
                                fixHTMLUTF8Entities($item['ShopItemName'], ENT_COMPAT)
                        );
                $item['ShopItemName'] = fixHTMLUTF8Entities($item['ShopItemName'], ENT_COMPAT);
            } else {
                $item['ShopItemName'] = $item['ShopItemNameShort'] = $item['ShopItemNameShort'] = '&mdash;';
            }
        }
        return $result['DATA'];
    }

	public function renderView() {
		$data = $this->getDeteltedItems();
		#echo print_m($data);
		$fromDate = date('Y', $this->delFromDate).', '.(date('n', $this->delFromDate) - 1).', 1';
		$toDate   = date('Y', $this->deToDate).', '.(date('n', $this->deToDate) - 1).', '.date('j', $this->deToDate);
		
		$langCode = MLLanguage::gi()->getCurrentIsoCode();
		
		$html = '
			<form method="POST" action="'.$this->getCurrentUrl().'"><table class="magnaframe">';
                        foreach(MLHttp::gi()->getNeededFormFields() as $sName=>$sValue){
                            $html .= "<input type='hidden' name='$sName' value='$sValue' />";
                        }
			$html .= '<thead><tr><th>Zeitraum</th></tr></thead>
				<tbody><tr><td class="fullWidth">
					<table><tbody>
						<tr>
							<td>Von:</td>
							<td>
								<input type="text" id="fromDate" readonly="readonly"/>
								<input type="hidden" id="fromActualDate" name="'.MLHttp::gi()->parseFormFieldName('date[from]').'" value=""/>
							</td>
							<td>Bis:</td>
							<td>
								<input type="text" id="toDate" readonly="readonly"/>
								<input type="hidden" id="toActualDate" name="'.MLHttp::gi()->parseFormFieldName('date[to]').'" value=""/>
							</td>
							<td><input class="mlbtn" type="submit" value="Los"/></td>
						</tr>
					</tbody></table>
				</td></tr></tbody>
			</table></form>
			<script type="text/javascript">
            (function($){
				$(document).ready(function() {
					jqml.datepicker.setDefaults(jqml.datepicker.regional[\'\']);
					$("#fromDate").datepicker(
						jqml.datepicker.regional[\''.$langCode.'\']
					).datepicker(
						"option", "altField", "#fromActualDate"
					).datepicker(
						"option", "altFormat", "yy-mm-dd"
					).datepicker(
						"option", "defaultDate", new Date('.$fromDate.')
					);
					var dateFormat = $("#fromDate").datepicker("option", "dateFormat");
					$("#fromDate").val(jqml.datepicker.formatDate(dateFormat, new Date('.$fromDate.')));
					$("#fromActualDate").val(jqml.datepicker.formatDate("yy-mm-dd", new Date('.$fromDate.')));

					$("#toDate").datepicker(
						jqml.datepicker.regional[\''.$langCode.'\']
					).datepicker(
						"option", "altField", "#toActualDate"
					).datepicker(
						"option", "altFormat", "yy-mm-dd"
					).datepicker(
						"option", "defaultDate", new Date('.$toDate.')
					);
					$("#toDate").val(jqml.datepicker.formatDate(dateFormat, new Date('.$toDate.')));
					$("#toActualDate").val(jqml.datepicker.formatDate("yy-mm-dd", new Date('.$toDate.')));
				});
             })(jqml);   
			</script>';
		
		if (is_array($data) && !empty($data)) {
			$html .= '
				<table id="deleted" class="datagrid">
					<thead><tr>
						<td>'.$this->__('ML_LABEL_SHOP_TITLE').'</td>
						<td>ASIN</td>
						<td>'.$this->__('ML_AMAZON_LABEL_AMAZON_PRICE').'</td>
						<td>'.$this->__('ML_LABEL_QUANTITY').'</td>
						<td>'.$this->__('ML_GENERIC_DELETEDDATE').'</td>
						<td>'.$this->__('ML_GENERIC_STATUS').'</td>
					</tr></thead>
					<tbody>
			';

			$oddEven = false;
			foreach ($data as $item) {
				/* Waehrung von Preis nicht umrechnen, da bereits in Zielwaehrung. */
				$html .= '
					<tr class="'.(($oddEven = !$oddEven) ? 'odd' : 'even').'">
						<td title="'.$item['ShopItemName'].'">'.$item['ShopItemNameShort'].'</td>
						<td><a href="http://www.amazon.de/gp/offer-listing/'.$item['ASIN'].'" class="ml-js-noBlockUi" title="'.$this->__('ML_AMAZON_LABEL_SAME_PRODUCTS').'" target="_blank">'.$item['ASIN'].'</a></td>
						<td>' . (isset($item['Price']) ? MLPrice::factory()->format($item['Price'], MLModule::gi()->getConfig('currency')) : '') . '</td>
						<td>'.$item['Quantity'].'</td>
						<td>'.date("d.m.Y", $item['DateAdded']).' &nbsp;&nbsp;<span class="small">'.date("H:i", $item['DateAdded']).'</span>'.'</td>
						<td title="'.$this->__('ML_GENERIC_DELETED').'"><img src="'.MLHttp::gi()->getResourceUrl('images/status/green_dot.png').'" alt="'.$this->__('ML_GENERIC_DELETED').'"/></td>
					</tr>';
			}
			$html .= '
					</tbody>
				</table>';
		} else {
			$html .= '<table class="magnaframe"><tbody><tr><td>'.$this->__('ML_GENERIC_NO_DELETED_ITEMS_IN_TIMEFRAME').'</td></tr></tbody></table>';
		}
		return $html;
	}

} 
