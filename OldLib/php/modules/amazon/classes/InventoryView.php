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
require_once (DIR_MAGNALISTER_MODULES.'amazon/crons/AmazonSyncInventory.php');
MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_ListingAbstract');
class InventoryView extends ML_Listings_Controller_Widget_Listings_ListingAbstract{
	private $settings = array();
	private $sort = array();

	private $latestChange = 0;
	private $latestReport = 0;
	private $numberofitems = 0;
	private $offset = 0;

	private $add = array();
	private $updatedelete = array();
	private $getPendingItemsCalled = false;
	private $renderableData = array();

	private $url = array();
	private $magnaSession = array();
        protected $aPostGet = array();
	private $search = '';
        protected $aParameters = array('controller');

        public function __construct($settings = array()) {
                parent::__construct();
		global $_MagnaShopSession, $_MagnaSession, $_url;
                $this->setCurrentState();
                $this->aPostGet = $this->getRequest();
		
		$this->settings = array_merge(array(
			'maxTitleChars'	=> 35,
			'itemLimit'		=> 50,
		), $settings);

		$this->magnaSession = &$_MagnaSession;
                
		$this->url = $_url;
		$this->url['view'] = 'inventory';

		if (array_key_exists('tfSearch', $this->aPostGet) && !empty($this->aPostGet['tfSearch'])) {
			$this->search = $this->aPostGet['tfSearch'];
		} else if (array_key_exists('search', $this->aPostGet) && !empty($this->aPostGet['search'])) {
			$this->search = $this->aPostGet['search'];
		}
		initArrayIfNecessary($_MagnaShopSession, array($this->magnaSession['mpID'], 'InventoryView', 'Add'));
		$this->add = &$_MagnaShopSession[$this->magnaSession['mpID']]['InventoryView']['Add'];
		#$this->add = array();
		initArrayIfNecessary($_MagnaShopSession, array($this->magnaSession['mpID'], 'InventoryView', 'UpdateDelete'));
		$this->updatedelete = &$_MagnaShopSession[$this->magnaSession['mpID']]['InventoryView']['UpdateDelete'];
		#$this->updatedelete = array();
		if (!array_key_exists('LatestReport', $_MagnaShopSession[$this->magnaSession['mpID']]['InventoryView'])) {
			$_MagnaShopSession[$this->magnaSession['mpID']]['InventoryView']['LatestReport'] = 0;
		}
		$this->latestReport = &$_MagnaShopSession[$this->magnaSession['mpID']]['InventoryView']['LatestReport'];
	}
        
        protected function getTotalPage() {
            return ceil($this->numberofitems / $this->settings['itemLimit']);
        }
        
        
        protected function getCurrentPage() {
            if (isset($this->aPostGet['page']) && (1 <= (int) $this->aPostGet['page']) && ((int) $this->aPostGet['page'] <= $this->getTotalPage())) {
                return (int) $this->aPostGet['page'];
            }

            return 1;
        }    

        public function getData(){
            return $this->renderableData;
        }
                
        public function getNumberOfItems(){
            return $this->numberofitems;
        }

        public function getOffset(){
            return $this->offset;
        }

	private function getInventory() {
		try {
			$request = array(
				'ACTION' => 'GetInventory',
				'LIMIT' => $this->settings['itemLimit'],
				'OFFSET' => $this->offset,
				'ORDERBY' => $this->sort['order'],
				'SORTORDER' => $this->sort['type']
			);
			if (!empty($this->search)) {
				$request['SEARCH'] = $this->search;
			}
			#echo print_m($request);
			$result = MagnaConnector::gi()->submitRequest($request);
			if ($result['LATESTCHANGE']) {
				$this->latestChange = strtotime($result['LATESTCHANGE'].' +0000');
			}
			if ($result['LATESTREPORT']) {
				$latestReport = strtotime($result['LATESTREPORT'].' +0000');
				if ($this->latestReport != $latestReport) {
					$this->getPendingItems();
				}
				$this->latestReport = $latestReport;
			}
			$this->numberofitems = (int)$result['NUMBEROFLISTINGS'];
			return $result;

		} catch (MagnaException $e) {
			$this->latestChange = 0;
			return array();
		}
	}

    private function getPendingItems() {
        //*
        if ($this->getPendingItemsCalled) {
            return;
        }
        //*/
        $this->getPendingItemsCalled = true;

        /* Gibt es neue Listings? */
        $this->add = array();
        $this->updatedelete = array();

        try {
            $result = MagnaConnector::gi()->submitRequest(array(
                'ACTION' => 'GetPendingItems',
            ));
        } catch (MagnaException $e) {
            $result = array('DATA' => false);
        }
        #echo print_m($result);
        if (is_array($result['DATA']) && !empty($result['DATA'])) {
            foreach ($result['DATA'] as $item) {
                /* Get some more informations */
                if (($item['Mode'] == 'ADD') || ($item['Mode'] == 'PURGE')) {
                    $oMLProduct = MLProduct::factory();
                    if ($oMLProduct->getByMarketplaceSKU($item['SKU'])->exists() || $oMLProduct->getByMarketplaceSKU($item['SKU'],true)->exists()) {
                       $item['ShopItemName'] = strip_tags($oMLProduct->getName());
                    }else{
                        $item['ShopItemName'] = '--';
                    }
                    unset($item['BatchID']);
                    $this->add[$item['SKU']] = $item;
                } else {
                    unset($item['BatchID']);
                    $this->updatedelete[$item['SKU']] = $item;
                }
            }
        }
    }

    protected function getSortOpt() {
        if (isset($this->aPostGet['sorting'])) {
            $sorting = $this->aPostGet['sorting'];
        } else {
            $sorting = 'blabla'; // fallback for default
        }
        $sortFlags = array (
            'sku' => 'SKU',
            'itemtitle' => 'ItemTitle',
            'asin' => 'ASIN',
            'price' => 'Price',
            'quantity' => 'Quantity',
            'dateadded' => 'DateAdded'
        );
		
        $order = 'ASC';
        if (strpos($sorting, '-asc') !== false) {
            $sorting = str_replace('-asc', '', $sorting);
        } else if (strpos($sorting, '-desc') !== false) {
            $order = 'DESC';
            $sorting = str_replace('-desc', '', $sorting);
        }

        if (array_key_exists($sorting, $sortFlags)) {
            $this->sort['order'] = $sortFlags[$sorting];
            $this->sort['type'] = $order;
        } else {
            $this->sort['order'] = 'DateAdded';
            $this->sort['type'] = 'DESC';
        }
    }

    private function initInventoryView() {
		/* Listings beenden */
		if (isset($this->aPostGet['timestamp']) && isset($this->aPostGet['skus']) && is_array($this->aPostGet['skus']) && isset($this->aPostGet['action'])
			 && (!isset($_SESSION['posttime']) || $_SESSION['posttime'] != $this->aPostGet['timestamp']) // Re-Post Prevention
		) {
			$_SESSION['posttime'] = $this->aPostGet['timestamp'];
			switch ($this->aPostGet['action']) {
				case 'delete': {
					$skus = $this->aPostGet['skus'];
					$data = array();
					foreach ($skus as $sku) {
						$data[] = array (
							'SKU' => $sku,
						);
					}
					//*
					try {
						$result = MagnaConnector::gi()->submitRequest(array(
							'ACTION' => 'DeleteItems',
							'DATA' => $data,
							'UPLOAD' => true,
						));
						#echo print_m($result);
					} catch (MagnaException $e) { }
					//*/
					break;
				}
			}
		}

		$this->getSortOpt();

		if (isset($this->aPostGet['page']) && ctype_digit($this->aPostGet['page'])) {
			$this->offset = ($this->aPostGet['page'] - 1) * $this->settings['itemLimit'];
		} else {
			$this->offset = 0;
		}
	}

    protected function sortByType($type) {
        $tmpURL = $this->url;
        if (!empty($this->search)) {
            $tmpURL['search'] = urlencode($this->search);
        }
        return '
            <div class="ml-plist">
            <input class="noButton ml-right arrowAsc" type="submit" value="'.$type.'-asc" title="'.$this->__('Productlist_Header_sSortAsc') .'"  name="'.MLHttp::gi()->parseFormFieldName('sorting').'" />
            <input class="noButton ml-right arrowDesc" type="submit" value="'.$type .'-desc" title="'.$this->__('Productlist_Header_sSortDesc').'"  name="'.MLHttp::gi()->parseFormFieldName('sorting').'" /> 
           </div>
        ';
    }

    private function prepareInventoryData() {
        $result = $this->getInventory();
        if (empty($this->add) && empty($this->updatedelete)) {
            $this->getPendingItems();
        }
        $this->renderableData = array();
        if (!empty($this->add)) {
            foreach ($this->add as $item) {
                if ($item['Mode'] == 'PURGE') {
                    $result['DATA'] = array();
                }
                $item = array_merge(array(
                    'pID' => magnaSKU2pID($item['SKU']),
                    'ItemTitle' => '',
                    'Type' => 'add',
                        ), $item);
                $item['DateAdded'] = strtotime($item['DateAdded'] . ' +0000');
                $this->renderableData[] = $item;
            }
        }
        if (array_key_exists('DATA', $result) && !empty($result['DATA'])) {
            foreach ($result['DATA'] as $item) {
                if (array_key_exists($item['SKU'], $this->add))
                    continue;
                unset($item['ConditionType']);
                unset($item['ConditionNote']);
                unset($item['Description']);
                $item['Type'] = 'regular';
                $oProduct = MLProduct::factory();
                if (!($oProduct->getByMarketplaceSKU($item['SKU'])->exists())) {//if product doesn't exist in variation we search it Master product
                    $oProduct->getByMarketplaceSKU($item['SKU'], true);
                    /* doesn't need to search product by ASIN anymore 
                    $iPIDbyASIN = MLDatabase::factory('amazon_prepare')->getByIdentifier($item['ASIN'], 'asin');
                    $oProduct = MLProduct::factory()->set('id', $iPIDbyASIN);
                     */
                }
                if ($oProduct->exists()) {
                    $item['ShopItemName'] = $oProduct->getName();
                    $item['editurl'] = $oProduct->getEditLink();
                    $item['Type'] = 'inventory';
                } else {
                    $item['ShopItemName'] = '';
                }
                if (array_key_exists($item['SKU'], $this->updatedelete)) {
                    $tItem = $this->updatedelete[$item['SKU']];
                    if (!empty($tItem['Price'])) {
                        $item['Price'] = $tItem['Price'];
                    }
                    if (!empty($tItem['Quantity'])) {
                        $item['Quantity'] = $tItem['Quantity'];
                    }
                    $item['Type'] = strtolower($tItem['Mode']);
                }
                $item['DateAdded'] = ($item['DateAdded'] == '0000-00-00 00:00:00') ? 0 : strtotime($item['DateAdded'] . ' +0000');

                $this->renderableData[] = $item;
            }
        }
    }

	private function renderDataGrid($id = '') {
		$html = '
			<table'.(($id != '') ? ' id="'.$id.'"' : '').' class="datagrid ml-plist-old-fix">
				<thead><tr>
					<td class="nowrap"><input type="checkbox" id="selectAll"/><label for="selectAll">'.$this->__('ML_LABEL_CHOICE').'</label></td>
					<td>'.'SKU'.' '.$this->sortByType('sku').'</td>
					<td>'.$this->__('ML_LABEL_SHOP_TITLE').'</td>
					<td>'.$this->__('ML_AMAZON_LABEL_TITLE').' '.$this->sortByType('itemtitle').'</td>
					<td>ASIN '.$this->sortByType('asin').'</td>
					<td>'.$this->__('ML_AMAZON_LABEL_AMAZON_PRICE').' '.$this->sortByType('price').'</td>
					<td>'.$this->__('ML_LABEL_QUANTITY').' '.$this->sortByType('quantity').'</td>
					<td>'.$this->__('ML_GENERIC_CHECKINDATE').' '.$this->sortByType('dateadded').'</td>
					<td>'.$this->__('ML_GENERIC_STATUS').'</td>
				</tr></thead>
				<tbody>
		';
		$oddEven = false;
		#echo print_m($this->renderableData);
                $aFirstItem = current($this->renderableData);
        $aItem = MLModule::gi()->amazonLookUp($aFirstItem['ASIN']);
                if(empty($aItem) || !isset($aItem[0]['URL']) || empty($aItem[0]['URL']) || strpos($aItem[0]['URL'], $aItem[0]['ASIN']) === false){
                    $sUrl =  "http://www.amazon.de/gp/offer-listing/" ;
                }else{
                    $sUrl = str_replace($aItem[0]['ASIN'],'',$aItem[0]['URL']) ;
                }
                
		foreach ($this->renderableData as $item) {
			if (!empty($item['ShopItemName'])) {
				$item['ShopItemNameShort'] = (
					(strlen($item['ShopItemName']) > $this->settings['maxTitleChars'] + 2) 
						? 
							(fixHTMLUTF8Entities(substr($item['ShopItemName'], 0, $this->settings['maxTitleChars']), ENT_COMPAT).'&hellip;')
						: 
							fixHTMLUTF8Entities($item['ShopItemName'], ENT_COMPAT)
				);
				$item['ShopItemName'] = fixHTMLUTF8Entities($item['ShopItemName'], ENT_COMPAT);
			} else {
				$item['ShopItemNameShort'] = $item['ShopItemNameShort'] = '&mdash;';
			}

			if (!empty($item['ItemTitle'])) {
				$item['ItemTitleShort'] = (
					(strlen($item['ItemTitle']) > $this->settings['maxTitleChars'] + 2) 
						? 
							(fixHTMLUTF8Entities(substr($item['ItemTitle'], 0, $this->settings['maxTitleChars']), ENT_COMPAT).'&hellip;')
						: 
							fixHTMLUTF8Entities($item['ItemTitle'], ENT_COMPAT)
				);
				$item['ItemTitle'] = fixHTMLUTF8Entities($item['ItemTitle'], ENT_COMPAT);
			} else {
				$item['ItemTitleShort'] = '<span class="italic grey">'.$this->__('ML_LABEL_IN_QUEUE').'</span>';
				$item['ItemTitle'] = $this->__('ML_LABEL_IN_QUEUE');
			}
			
			$item['SKU_Rendered'] = $item['SKU'];
			if ($item['Type'] == 'inventory') {
				$item['SKU_Rendered'] = '<div class="product-link" ><a class="ml-js-noBlockUi" href="'.$item['editurl'].'" target="_blank" title="'.$this->__('ML_LABEL_EDIT').'">'.$item['SKU'].'</a></div>';
			}
			$class = (($oddEven = !$oddEven) ? 'odd' : 'even').' '.$item['Type'];
			if ($item['ItemTitle'] == 'incomplete') {
				$class .= ' incomplete';
			}
			$html .= '
				<tr class="'.$class.'">
					<td><input type="checkbox" name="'.MLHttp::gi()->parseFormFieldName('skus[]').'" value="'.$item['SKU'].'" '.((in_array($item['Type'], array(
						'add', 'delete', 'sysdelete'
					))) ? 'disabled="disabled"' : '').'/></td>
					<td>'.$item['SKU_Rendered'].'</td>
					<td title="'.$item['ShopItemName'].'">'.str_replace(' ', '&nbsp;', $item['ShopItemNameShort']).'</td>
					'.(($item['ItemTitle'] == 'incomplete')
						? ('<td>'.$this->__('ML_AMAZON_LABEL_INCOMPLETE').'</td>')
						: ('<td title="'.$item['ItemTitle'].'">'.str_replace(' ', '&nbsp;', $item['ItemTitleShort']).'</td>')
					).'
					<td>'.(empty($item['ASIN']) 
						? '&mdash;' 
						: '<a href="'.$sUrl.$item['ASIN'].'" '.
					      'title="'.$this->__('ML_AMAZON_LABEL_PRODUCT_IN_AMAZON').'" class="ml-js-noBlockUi" '.
					      'target="_blank">'.$item['ASIN'].'</a>').
					'</td>
					<td>' . (isset($item['Price']) ? MLPrice::factory()->format($item['Price'], MLModule::gi()->getConfig('currency')) : '&mdash;') . '</td>
					<td>'.(($item['Quantity'] > 0) ? $item['Quantity'] : $this->__('ML_LABEL_SOLD_OUT')).'</td>
					<td>'.(($item['DateAdded'] == 0)
						? '&mdash;'
						: (date("d.m.Y", $item['DateAdded']).' &nbsp;&nbsp;<span class="small">'.date("H:i", $item['DateAdded']).'</span>')
					).'</td>';

			switch ($item['Type']) {
				case 'add': {
					$html .= '
						<td title="'.$this->__('ML_AMAZON_LABEL_ADD_WAIT').'"><img src="'.MLHttp::gi()->getResourceUrl('images/status/grey_dot.png').'" alt="'.$this->__('ML_AMAZON_LABEL_ADD_WAIT').'"/></td>';
					break;
				}
				case 'update': {
					$html .= '
						<td title="'.$this->__('ML_AMAZON_LABEL_EDIT_WAIT').'"><img src="'.MLHttp::gi()->getResourceUrl('images/status/blue_dot.png').'" alt="'.$this->__('ML_AMAZON_LABEL_EDIT_WAIT').'"/></td>';
					break;					
				}
				case 'delete':
				case 'sysdelete': {
					$html .= '
						<td title="'.$this->__('ML_AMAZON_LABEL_DELETE_WAIT').'"><img src="'.MLHttp::gi()->getResourceUrl('images/status/red_dot.png').'" alt="'.$this->__('ML_AMAZON_LABEL_DELETE_WAIT').'"/></td>';					
					break;
				}
				default: {
					$html .= '
						<td title="'.$this->__('ML_AMAZON_LABEL_IN_INVENTORY').'"><img src="'.MLHttp::gi()->getResourceUrl('images/status/green_dot.png').'" alt="'.$this->__('ML_AMAZON_LABEL_IN_INVENTORY').'"/></td>';
				}
			}
			$html .= '	
				</tr>';
		}
		$html .= '
				</tbody>
			</table>';

		return $html;
	}

	private function renderInventoryTable() {
		$html = '';

		if (empty($this->renderableData)) {
			$this->prepareInventoryData();
		}

		$html .= '
			<table class="magnaframe">
				<thead><tr><th>'.$this->__('ML_LABEL_NOTE').'</th></tr></thead>
				<tbody><tr><td class="fullWidth">
					<table><tbody>
						<!--<tr><td>'.$this->__('ML_AMAZON_LABEL_LAST_INVENTORY_CHANGE').':</td>
							<td>'.(($this->latestChange > 0) ? date("d.m.Y &\b\u\l\l; H:i:s", $this->latestChange) : $this->__('ML_LABEL_UNKNOWN')).'</td></tr>-->
						<tr><td>'.$this->__('ML_AMAZON_LABEL_LAST_REPORT').'
								<div id="amazonInfo" class="desc"><span>
									'.$this->__('ML_AMAZON_TEXT_CHECKIN_DELAY').'
								</span></div>:
							</td>
							<td>'.(($this->latestReport > 0) ? date("d.m.Y &\b\u\l\l; H:i:s", $this->latestReport) : $this->__('ML_LABEL_UNKNOWN')).'</td></tr>
						</tbody></table>
				</td></tr></tbody>
			</table>
			<div id="infodiag" class="dialog2" title="'.$this->__('ML_LABEL_NOTE').'"></div>
		    <script type="text/javascript">/*<![CDATA[*/
				jqml(document).ready(function() {
					jqml(\'#amazonInfo\').click(function () {
						jqml(\'#infodiag\').html(jqml(\'#amazonInfo span\').html()).jDialog();
					});
				});
			/*]]>*/</script>';

		if (isset($this->aPostGet['reload'])) {
			$html .= '
			<div id="reloaddiag" class="dialog2" title="'.$this->__('ML_LABEL_NOTE').'">'.$this->__('ML_AMAZON_TEXT_REFRESH_REQUEST_SEND').'</div>
		    <script type="text/javascript">/*<![CDATA[*/
				jqml(document).ready(function() {
					jqml(\'#reloaddiag\').jDialog();
				});
			/*]]>*/</script>
			';
		}
		if (isset($this->aPostGet['refreshStock'])) {
			@set_time_limit(60 * 10);
			$asi = new AmazonSyncInventory($this->magnaSession['mpID'], 'amazon');
			$asi->disableMarker(true);
			$asi->process();
		}		
                $html .= $this->includeViewBuffered('widget_listings_misc_pagination');
		if (!empty($this->renderableData)) {
			$html .= $this->renderDataGrid('inventory');
		} else {
			$html .= '<table class="magnaframe"><tbody><tr><td>'.
						(empty($this->search) ? $this->__('ML_AMAZON_LABEL_NO_INVENTORY') : $this->__('ML_LABEL_NO_SEARCH_RESULTS')).
					 '</td></tr></tbody></table>';
		}

		ob_start();
?>
<script type="text/javascript">/*<![CDATA[*/
    (function($){
$(document).ready(function() {
	$('#selectAll').click(function() {
		state = $(this).attr('checked');
		$('#inventory input[type="checkbox"]:not([disabled])').each(function() {
			$(this).attr('checked', state);
		});
	});
	$('table.datagrid tbody tr').click(function() {
		cb = $('input[type="checkbox"]:not(:disabled)', $(this));
		if (cb.length != 1) return;
		if (cb.is(':checked')) {
			cb.removeAttr('checked');
		} else {
			cb.attr('checked', 'checked');
		}
	});
	$('table.datagrid tbody tr td input[type="checkbox"]').click(function () {
		this.checked = !this.checked;
	});
});})(jqml);
/*]]>*/</script>
<?php
		$html .= ob_get_contents();	
		ob_end_clean();
		
		return $html;
	}

	private function renderActionBox() {
		global $_modules;

		$left = '<input type="button" class="mlbtn" value="'.$this->__('ML_BUTTON_LABEL_DELETE').'" id="listingDelete" name="'.MLHttp::gi()->parseFormFieldName('listing[delete]').'"/>';
		$right = '<table class="right"><tbody>
			<tr><td><input type="submit" class="mlbtn fullWidth smallmargin" name="'.MLHttp::gi()->parseFormFieldName('reload').'" value="'.$this->__('ML_BUTTON_RELOAD_INVENTORY').'"/></td></tr>
			' . (in_array(MLModule::gi()->getConfig('stocksync.tomarketplace'), array('abs', 'auto'))
				? '<tr><td><input type="submit" class="mlbtn fullWidth smallmargin" name="'.MLHttp::gi()->parseFormFieldName('refreshStock').'" value="'.$this->__('ML_BUTTON_REFRESH_STOCK').'"/></td></tr>'
				: ''
			).'
		</tbody></table>';

		ob_start(); ?>
		<script type="text/javascript">/*<![CDATA[*/
			(function ($) {
				$(document).ready(function () {
					$('#listingDelete').click(function () {
						if (($('#inventory input[type="checkbox"]:checked').length > 0) &&
							confirm(unescape(<?php echo "'".addslashes(html_entity_decode(sprintf($this->__('ML_GENERIC_DELETE_LISTINGS'), $_modules[$this->magnaSession['currentPlatform']]['title'])))."'"; ?>))
						) {
							$('#action').val('delete');
							$(this).parents('form').submit();
						}
					});
				});
			})(jqml);
			/*]]>*/</script>
		<?php // Durch aufrufen der Seite wird automatisch ein Aktualisierungsauftrag gestartet
		$js = ob_get_contents();
		ob_end_clean();

		return '
			<input type="hidden" id="action" name="'.MLHttp::gi()->parseFormFieldName('action').'" value="">
			<input type="hidden" name="'.MLHttp::gi()->parseFormFieldName('timestamp').'" value="'.time().'">
			<table class="actions">
				<tbody><tr><td>
					<table><tbody><tr>
						<td class="firstChild">'.$left.'</td>
						<td><label for="tfSearch">'.$this->__('ML_LABEL_SEARCH').':</label>
							<input id="tfSearch" name="'.MLHttp::gi()->parseFormFieldName('tfSearch').'" type="text" value="'.fixHTMLUTF8Entities($this->search, ENT_COMPAT).'"/>
							<input type="submit" class="mlbtn" value="'.$this->__('ML_BUTTON_LABEL_GO').'" name="'.MLHttp::gi()->parseFormFieldName('search_go').'" /></td>
						<td class="lastChild">'.$right.'</td>
					</tr></tbody></table>
				</td></tr></tbody>
			</table>
			'.$js;
	}

	public function renderView() {
		$html = '<form action="'.$this->getCurrentUrl().'" id="amazonInventoryView" method="post">';
                foreach(MLHttp::gi()->getNeededFormFields() as $sName=>$sValue){
                    $html .= "<input type='hidden' name='$sName' value='$sValue' />";
                }
		$this->initInventoryView();
		$html .= $this->renderInventoryTable();
		return $html.$this->renderActionBox().'
			</form>
			<script type="text/javascript">/*<![CDATA[*/
				(function($){
                $(document).ready(function() {
					$(\'#amazonInventoryView\').submit(function () {
						jqml.blockUI(blockUILoading);
					});
				});})(jqml);
			/*]]>*/</script>';
	}
}
