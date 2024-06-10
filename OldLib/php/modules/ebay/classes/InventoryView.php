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


MLFilesystem::gi()->loadClass('Listings_Controller_Widget_Listings_ListingAbstract');
class InventoryView extends ML_Listings_Controller_Widget_Listings_ListingAbstract{

    protected $marketplace = '';
    protected $currentPlatform = '';
    protected $mpID = 0;
    protected $settings = array();
    protected $sort = array();
    protected $iNumberofitems = 0;
    protected $offset = 0;
    protected $renderableData = array();
    protected $magnasession = array();
    protected $magnaShopSession = array();
    protected $pendingItems = array();
    protected $search = '';
    protected $aParameters = array('controller');

    public function __construct($marketplace, $settings = array()) {
        parent::__construct();
        $this->setCurrentState();
        $aPost = $this->getRequest();

        $this->marketplace = $marketplace;
        $oModul = MLModule::gi();
        $this->currentPlatform = $oModul->getMarketPlaceName(false);
        $this->mpID = $oModul->getMarketPlaceId();

        if (isset($aPost['itemsPerPage'])) {
            $this->magnasession[$this->mpID]['InventoryView']['ItemLimit'] = (int) $aPost['itemsPerPage'];
        }
        if (!isset($this->magnasession[$this->mpID]['InventoryView']['ItemLimit']) || ($this->magnasession[$this->mpID]['InventoryView']['ItemLimit'] <= 0)
        ) {
            $this->magnasession[$this->mpID]['InventoryView']['ItemLimit'] = 50;
        }

        $this->settings = array_merge(array(
            'maxTitleChars' => 80,
            'itemLimit' => $this->magnasession[$this->mpID]['InventoryView']['ItemLimit'],
                ), $settings);

        if (array_key_exists('tfSearch', $aPost) && !empty($aPost['tfSearch'])) {
            $this->search = $aPost['tfSearch'];
        } else if (array_key_exists('search', $aPost) && !empty($aPost['search'])) {
            $this->search = $aPost['search'];
        }
    }

    private function getInventory() {
        try {
            $request = array(
                'ACTION' => 'GetInventory',
                'LIMIT' => $this->settings['itemLimit'],
                'OFFSET' => $this->offset,
                'ORDERBY' => $this->sort['order'],
                'SORTORDER' => $this->sort['type'],
                'EXTRA' => 'ShowPending',
            );
            if (!empty($this->search)) {
                #$request['SEARCH'] = (!isUTF8($this->search)) ? utf8_encode($this->search) : $this->search;
                $request['SEARCH'] = $this->search;
            }
            $result = MagnaConnector::gi()->submitRequest($request);
            $this->iNumberofitems = (int) $result['NUMBEROFLISTINGS'];
            return $result;
        } catch (MagnaException $e) {
            return false;
        }
    }

 	private function getPendingFunction($sRequest = 'Items') {
		try {
			$result = MagnaConnector::gi()->submitRequest(array(
				'ACTION' => 'GetPending'.$sRequest,
			));
		} catch (MagnaException $e) {
			$result = array('DATA' => false);
		}
		$waitingItems = 0;
		$maxEstimatedTime = 0;
		if (is_array($result['DATA']) && !empty($result['DATA'])) {
			foreach ($result['DATA'] as $item) {
				$maxEstimatedTime = max($maxEstimatedTime, $item['EstimatedWaitingTime']);
				$waitingItems  += 1;
			}
		}
		$this->pendingItems[$sRequest] = array (
			'itemsCount' => $waitingItems,
			'estimatedWaitingTime' => $maxEstimatedTime
		);
	}

        protected function getTotalPage() {
            return ceil($this->iNumberofitems / $this->settings['itemLimit']);
        }

        protected function getCurrentPage() {
            $iPage = $this->getRequest('page');
            if (isset($iPage) && (1 <= (int) $iPage) && ((int) $iPage <= $this->getTotalPage())) {
                return (int) $iPage;
            }
            return 1;
        }

        public function getData(){
            return $this->renderableData;
        }


        public function getNumberOfItems(){
            return $this->iNumberofitems;
        }

        public function getOffset(){
            return $this->offset;
        }
    protected function sortByType($type) {
        $tmpURL = array();
        if (!empty($this->search)) {
            $tmpURL['search'] = urlencode($this->search);
        }
        return '
            <div class="ml-plist">
                <a class="noButton ml-right arrowAsc" href="'.$this->getCurrentUrl(array('sorting' => $type.'')).'">'.$this->__('ML_LABEL_SORT_ASCENDING').'</a>
                <a class="noButton ml-right arrowDesc" href="'.$this->getCurrentUrl(array('sorting' => $type.'-desc')).'">'.$this->__('ML_LABEL_SORT_DESCENDING').'</a>
           </div>
        ';
    }

    protected function getSortOpt() {
        $aPost = MLRequest::gi()->data();
        if (isset($aPost['sorting'])) {
            $sorting = $aPost['sorting'];
        } else {
            $sorting = 'blabla'; // fallback for default
        }

        switch ($sorting) {
            case 'sku':
                $this->sort['order'] = 'SKU';
                $this->sort['type'] = 'ASC';
                break;
            case 'sku-desc':
                $this->sort['order'] = 'SKU';
                $this->sort['type'] = 'DESC';
                break;
            case 'itemtitle':
                $this->sort['order'] = 'ItemTitle';
                $this->sort['type'] = 'ASC';
                break;
            case 'itemtitle-desc':
                $this->sort['order'] = 'ItemTitle';
                $this->sort['type'] = 'DESC';
                break;
            case 'price':
                $this->sort['order'] = 'Price';
                $this->sort['type'] = 'ASC';
                break;
            case 'price-desc':
                $this->sort['order'] = 'Price';
                $this->sort['type'] = 'DESC';
                break;
            case 'dateadded-desc':
                $this->sort['order'] = 'DateAdded';
                $this->sort['type'] = 'DESC';
                break;
            case 'dateadded':
            default:
                $this->sort['order'] = 'DateAdded';
                $this->sort['type'] = 'DESC';
                break;
        }
    }

    protected function postDelete() { /* Nix :-) */
    }

    private function initInventoryView() {
        $aPost = MLRequest::gi()->data();
        //$aPost['timestamp'] = time();
        if (isset($aPost['ItemIDs']) && is_array($aPost['ItemIDs']) && isset($aPost['action']) &&
                (!isset($_SESSION['POST_TS']) || $_SESSION['POST_TS'] != $aPost['timestamp']) // Re-Post Prevention
        ) {
            $_SESSION['POST_TS'] = $aPost['timestamp'];
            switch ($aPost['action']) {
                case 'delete': {
                        $itemIDs = $aPost['ItemIDs'];
                        $request = array(
                            'ACTION' => 'DeleteItems',
                            'DATA' => array(),
                        );
                        foreach ($itemIDs as $itemID) {
                            $request['DATA'][] = array(
                                'ItemID' => $itemID,
                            );
                        }
                        try {
                            $result = MagnaConnector::gi()->submitRequest($request);
                        } catch (MagnaException $e) {
                            $result = array(
                                'STATUS' => 'ERROR'
                            );
                        }
                        if (($result['STATUS'] == 'SUCCESS') && array_key_exists('DeletedItemIDs', $result) && is_array($result['DeletedItemIDs']) && !empty($result['DeletedItemIDs'])
                        ) {
                            $this->postDelete();
                        }
                        break;
                    }
            }
        }

        $this->getSortOpt();

        if (isset($aPost['page']) && ctype_digit($aPost['page'])) {
            $this->offset = ($aPost['page'] - 1) * $this->settings['itemLimit'];
        } else {
            $this->offset = 0;
        }
    }

    public function prepareInventoryData() {
        $result = $this->getInventory();
        $this->getPendingFunction('Items');
        $this->getPendingFunction('ProductDetailUpdates');
        if (($result !== false) && !empty($result['DATA'])) {
            $this->renderableData = $result['DATA'];
            foreach ($this->renderableData as &$item) {
                $item['SKU'] = html_entity_decode(fixHTMLUTF8Entities($item['SKU']));
                $item['ItemTitleShort'] = (strlen($item['ItemTitle']) > $this->settings['maxTitleChars'] + 2) ? (fixHTMLUTF8Entities(substr($item['ItemTitle'], 0, $this->settings['maxTitleChars'])) . '&hellip;') : fixHTMLUTF8Entities($item['ItemTitle']);
                $item['VariationAttributesText'] = fixHTMLUTF8Entities($item['VariationAttributesText']);
                $item['DateAdded'] = strtotime($item['DateAdded']);
                $item['DateEnd'] = ('1' == $item['GTC'] ? '&mdash;' : strtotime($item['End']));
                $item['LastSync'] = strtotime($item['LastSync']);
            }
            unset($result);
        }
        $this->getShopDataForItems();
    }

    private function getShopDataForItems() {
        foreach ($this->renderableData as &$item) {
            $oProduct = MLProduct::factory();
            try {
            /* @var $oProduct ML_Shop_Model_Product_Abstract  */
                if (
                       !$oProduct->getByMarketplaceSKU($item['SKU'])->exists()
                    && !$oProduct->getByMarketplaceSKU($item['SKU'], true)->exists()
                ) {
                    throw new Exception;
                }
                $item['ProductsID'] = $oProduct->get('productsid');
                $item['ShopQuantity'] = $oProduct->getStock();
                $item['ShopPrice'] = $oProduct->getShopPrice();
                $item['ShopTitle'] = $oProduct->getName();
                $item['ShopVarText'] = $oProduct->getName();
            } catch(Exception $oExc) {
                $item['ShopQuantity'] = $item['ShopPrice'] = $item['ShopTitle'] = '&mdash;';
                $item['ShopVarText'] = '&nbsp;';
                $item['ProductsID'] = 0;
            }
        }
    }

    private function emptyStr2mdash($str) {
        return (empty($str) || (is_numeric($str) && ($str == 0))) ? '&mdash;' : $str;
    }

    protected function additionalHeaders() {

    }

    protected function additionalValues($item) {

    }

    private function renderDataGrid($id = '') {

        $priceBrutto = !(defined('PRICE_IS_BRUTTO') && (PRICE_IS_BRUTTO == 'false'));

        $html = '
			<table' . (($id != '') ? ' id="' . $id . '"' : '') . ' class="datagrid ml-plist-old-fix">
				<thead class="small"><tr>
					<td class="nowrap" style="width: 5px;"><input type="checkbox" id="selectAll"/><label for="selectAll">' . $this->__('ML_LABEL_CHOICE') . '</label></td>
					<td>' . $this->__('ML_LABEL_SKU') . ' ' . $this->sortByType('sku') . '</td>
					<td>' . $this->__('ML_LABEL_SHOP_TITLE') . '</td>
					<td>' . $this->__('ML_LABEL_EBAY_TITLE') . ' ' . $this->sortByType('itemtitle') . '</td>
					<td>' . $this->__('ML_LABEL_EBAY_ITEM_ID') . '</td>
					<td>' . ($priceBrutto ? $this->__('ML_LABEL_SHOP_PRICE_BRUTTO') : $this->__('ML_LABEL_SHOP_PRICE_NETTO')
                ) . ' / eBay ' . $this->sortByType('price') . '</td>
					<td>' . $this->__('ML_STOCK_SHOP_STOCK_EBAY') . '<br />' . $this->__('ML_LAST_SYNC') . '</td>
					<td>' . $this->__('ML_LABEL_EBAY_LISTINGTIME') . ' ' . $this->sortByType('dateadded') . '</td>
                    <td>' . $this->__('ML_GENERIC_STATUS').'</td>
                    <td>'.$this->__('ML_GENERIC_INVENTORY_IS_SPLIT').'</td>
				</tr></thead>
				<tbody>
		';

        $oddEven = false;
        foreach ($this->renderableData as $item) {
            try{
            $details = htmlspecialchars(str_replace('"', '\\"', serialize(array(
                'SKU' => $item['SKU'],
                'Price' => $item['Price'],
                'Currency' => $item['Currency'],
            ))));
            $renderedShopPrice = (isset($item['Currency']) && isset($item['ShopPrice']) && 0 != $item['ShopPrice']) ? MLPrice::factory()->format($item['ShopPrice'], $item['Currency']) : '&mdash;';
            $addStyle = ('&mdash;' == $item['ShopTitle']) ? 'style="color:#900;"' : '';
            $icon = (('ml' == $item['listedBy']) ? '&nbsp;<img src="' . MLHttp::gi()->getResourceUrl('images/magnalister_11px_icon_color.png') . '" width=11 height=11 />' : '');
            $aStatusI18n = MLI18n::gi()->get('Ebay_listings_status');
            if ($item['Status'] == 'active') {
                $sStatusColor = '#00f1ba, #00d768';
                $sStatusTitle = $aStatusI18n['active'];
            } elseif (array_key_exists('ItemID', $item) && !empty($item['ItemID'])) {
                $sStatusColor = '#96bff0, #96b0d0';
                $sStatusTitle = $aStatusI18n['pending_process'];
            } else {
                $sStatusColor = '#bdbdbd, #5b5b5b';
                $sStatusTitle = $aStatusI18n['pending'];
            }
            $html .= '
				<tr class="' . (($oddEven = !$oddEven) ? 'odd' : 'even') . '" ' . $addStyle . '>
					<td><input type="checkbox" name="' . MLHttp::gi()->parseFormFieldName('ItemIDs[]') . '" value="' . $item['ItemID'] . '">
						<input type="hidden" name="' . MLHttp::gi()->parseFormFieldName('details[' . $item['ItemID'] . ']') . '" value="' . $details . '">'
                    . $icon . '</td>
					<td>' . fixHTMLUTF8Entities($item['SKU'], ENT_COMPAT) . '</td>
					<td title="' . fixHTMLUTF8Entities($item['ShopTitle'], ENT_COMPAT) . '">' . $item['ShopTitle'] . '<br /><span class="small">' . $item['ShopVarText'] . '</span></td>
					<td title="' . fixHTMLUTF8Entities($item['ItemTitle'], ENT_COMPAT) . '">' . $item['ItemTitleShort'] . '<br /><span class="small">' . $item['VariationAttributesText'] . '</span></td>
					<td><a class="ml-js-noBlockUi" href="' . $item['SiteUrl'] . '?ViewItem&item=' . $item['ItemID'] . '" target="_blank">' . $item['ItemID'] . '</a></td>
					<td>' . $renderedShopPrice . ' / ' . ((isset($item['Currency']) && isset($item['Price']) && 0 != $item['Price']) ? MLPrice::factory()->format($item['Price'], $item['Currency']) : '&mdash;') . '</td>
					<td>' . $item['ShopQuantity'] . ' / ' . $item['Quantity'] . '<br />' . date("d.m.Y", $item['LastSync']) . ' &nbsp;&nbsp;<span class="small">' . date("H:i", $item['LastSync']) . '</span></td>
					<td>' . date("d.m.Y", $item['DateAdded']) . ' &nbsp;&nbsp;<span class="small">' . date("H:i", $item['DateAdded']) . '</span><br />' . ('&mdash;' == $item['DateEnd'] ? '&mdash;' : date("d.m.Y", $item['DateEnd']) . ' &nbsp;&nbsp;<span class="small">' . date("H:i", $item['DateEnd']) . '</span>') . '</td>
                    <td title="'.$sStatusTitle.'"><div style="border-radius: 5px; height: 10px; margin: auto; width: 10px; color: #FFF;background-image: linear-gradient(to bottom, '.$sStatusColor.');">&nbsp;</div>&nbsp;</td>
                    <td>'.(empty($item['IsSplit']) ? $this->__('ML_BUTTON_LABEL_NO') : $this->__('ML_BUTTON_LABEL_YES')).'</td>';
            $html .= '
				</tr>';
            }catch(Exception $oEx){
                MLMessage::gi()->addWarn($oEx);
            }
        }
        $html .= '
				</tbody>
			</table>';

        return $html;
    }

    public function renderInventoryTable() {
        $html = '';
        if (empty($this->renderableData)) {
            $this->prepareInventoryData();
        }
        # echo print_m($this->renderableData, 'renderInventoryTable: $this->renderableData');

        $itemsPerPageSelect = array(50, 100, 250, 500, 1000, 2500);
        $chooser = '
        		<select id="itemsPerPage" name="' . MLHttp::gi()->parseFormFieldName('itemsPerPage') . '" class="">' . "\n";
        foreach ($itemsPerPageSelect as $chc) {
            $chcselected = ($this->settings['itemLimit'] == $chc) ? 'selected' : '';
            $chooser .= '<option value="' . $chc . '" ' . $chcselected . '>' . $chc . '</option>';
        }
        $chooser .= '
        		</select>';

        $html .= $this->includeViewBuffered('widget_listings_misc_pagination',array('sChooser'=>$chooser));
                if (!empty($this->pendingItems)) {
			foreach ($this->pendingItems as $sKye => $aPendingItems) {
				if (!empty($aPendingItems['itemsCount'])) {
					$html .= '<p class="successBoxBlue"> '.$this->__('ML_EBAY_N_PENDING_UPDATES_TITLE_'.strtoupper($sKye)). " "
						.' '.sprintf(ML_EBAY_N_PENDING_UPDATES_ESTIMATED_TIME_M, $aPendingItems['itemsCount'], $aPendingItems['estimatedWaitingTime'])
						.'</p>';
				}
			}
		}

		if (    !empty($this->pendingItems)
		     && !empty($this->pendingItems['itemsCount'])
		   ) {
			$html .= '<p class="successBoxBlue">'
			.sprintf($this->__('ML_EBAY_N_PENDING_UPDATES_ESTIMATED_TIME_M'), $this->pendingItems['itemsCount'], $this->pendingItems['estimatedWaitingTime'])
			.'</p>';
		}
        if (!empty($this->renderableData)) {
            $html .= $this->renderDataGrid('ebayinventory');
        } else {
            $html .= '<table class="magnaframe"><tbody><tr><td>' .
                    (empty($this->search) ? $this->__('ML_GENERIC_NO_INVENTORY') : $this->__('ML_LABEL_NO_SEARCH_RESULTS')) .
                    '</td></tr></tbody></table>';
        }

        ob_start();
        ?>
        <script type="text/javascript">/*<![CDATA[*/
            jqml(document).ready(function() {
                jqml('#selectAll').click(function() {
                    state = jqml(this).attr('checked');
                    jqml('#ebayinventory input[type="checkbox"]:not([disabled])').each(function() {
                        jqml(this).attr('checked', state);
                    });
                });
                jqml('#itemsPerPage').change(function() {
                    jqml("#ebayInventoryView").submit();
                });
            });
            /*]]>*/</script>
        <?php
        $html .= ob_get_contents();
        ob_end_clean();

        return $html;
    }

    protected function getRightActionButton() {
        return '';
    }

    public function renderActionBox() {
        $left = (!empty($this->renderableData) ?
                        '<input type="button" class="mlbtn" value="' . $this->__('ML_BUTTON_LABEL_DELETE') . '" id="listingDelete" name="' . MLHttp::gi()->parseFormFieldName('listing[delete]') . '"/>' :
                        ''
        );

        $right = $this->getRightActionButton();

        ob_start();
        ?>
        <script type="text/javascript">/*<![CDATA[*/
            jqml(document).ready(function () {
                jqml('#listingDelete').click(function () {
                    if ((jqml('#ebayinventory input[type="checkbox"]:checked').length > 0) &&
                        confirm(unescape(<?php echo "'".addslashes(html_entity_decode(sprintf($this->__s('ML_GENERIC_DELETE_LISTINGS', array("'")), $this->currentPlatform)))."'"; ?>))
                    ) {
                        jqml('#action').val('delete');
                        jqml(this).parents('form').submit();
                    }
                });
            });
            /*]]>*/</script>
        <?php
        // Durch aufrufen der Seite wird automatisch ein Aktualisierungsauftrag gestartet
        $js = ob_get_contents();
        ob_end_clean();

        if (($left == '') && ($right == '')) {
            return '';
        }
        return '
			<input type="hidden" id="action" name="' . MLHttp::gi()->parseFormFieldName('action') . '" value="">
			<input type="hidden" name="' . MLHttp::gi()->parseFormFieldName('timestamp') . '" value="' . time() . '">
			<table class="actions">
				<tbody><tr><td>
					<table><tbody><tr>
						<td class="firstChild">' . $left . '</td>
						<td><label for="tfSearch">' . $this->__('ML_LABEL_SEARCH') . ':</label>
							<input id="tfSearch" name="' . MLHttp::gi()->parseFormFieldName('tfSearch') . '" type="text" value="' . fixHTMLUTF8Entities($this->search, ENT_COMPAT) . '"/>
							<input type="submit" class="mlbtn" value="'.$this->__('ML_BUTTON_LABEL_GO').'" name="'.MLHttp::gi()->parseFormFieldName('search_go').'" /></td>
						<td class="lastChild">' . $right . '</td>
					</tr></tbody></table>
				</td></tr></tbody>
			</table>
			' . $js;
    }

    public function renderView() {
        $html = '<form action="' . $this->getCurrentUrl() . '" id="ebayInventoryView" method="post">';
        foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) {
            $html .= "<input type='hidden' name='$sName' value='$sValue' />";
        }
        $this->initInventoryView();
        $html .= $this->renderInventoryTable();
        return $html . $this->renderActionBox() . '
			</form>
			<script type="text/javascript">/*<![CDATA[*/
				jqml(document).ready(function() {
					jqml(\'#ebayInventoryView\').submit(function () {
						jqml.blockUI(blockUILoading);
					});
				});
			/*]]>*/</script>';
    }

}
