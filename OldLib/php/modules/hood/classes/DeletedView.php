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

class DeletedView extends ML_Core_Controller_Abstract {

    protected $marketplace;
    protected $settings = array();
    protected $sort = array();
    protected $numberofitems = 0;
    protected $offset = 0;
    protected $renderableData = array();
    protected $magnasession = array();
    protected $magnaShopSession = array();
    protected $aParameters = array('controller');
    protected $search = '';

    public function __construct($marketplace, $settings = array()) {
        parent::__construct();
        $aPost = $this->getRequest();
        global $_MagnaShopSession, $_MagnaSession;

        $this->marketplace = $marketplace;

        $this->settings = array_merge(array(
            'maxTitleChars' => 80,
            'itemLimit' => 50,
                ), $settings);
        $this->magnasession = &$_MagnaSession;
        $this->magnaShopSession = &$_MagnaShopSession;

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
                'FILTER' => 'DELETED'
            );
            if (!empty($this->search)) {
                #$request['SEARCH'] = (!isUTF8($this->search)) ? utf8_encode($this->search) : $this->search;
                $request['SEARCH'] = $this->search;
            }
            $result = MagnaConnector::gi()->submitRequest($request);
            $this->numberofitems = (int) $result['NUMBEROFLISTINGS'];
            return $result;
        } catch (MagnaException $e) {
            return false;
        }
    }

    protected function sortByType($type) {
        $tmpURL = array();
        if (!empty($this->search)) {
            $tmpURL['search'] = urlencode($this->search);
        }
        return '
            <div class="ml-plist">
                <a class="noButton ml-right arrowAsc" href="' . $this->getCurrentUrl(array_merge($tmpURL, array('sorting' => $type . ''))) . '">' . $this->__('ML_LABEL_SORT_ASCENDING') . '</a>
                <a class="noButton ml-right arrowDesc" href="' . $this->getCurrentUrl(array_merge($tmpURL, array('sorting' => $type . '-desc'))) . '">' . $this->__('ML_LABEL_SORT_DESCENDING') . '</a>
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
                $this->sort['order'] = 'Title';
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
            case 'dateend':
                $this->sort['order'] = 'EndTime';
                $this->sort['type'] = 'ASC';
                break;
            case 'dateend-desc':
                $this->sort['order'] = 'EndTime';
                $this->sort['type'] = 'DESC';
                break;
            case 'starttime-desc':
                $this->sort['order'] = 'StartTime';
                $this->sort['type'] = 'DESC';
                break;
            case 'starttime':
            default:
                $this->sort['order'] = 'StartTime';
                $this->sort['type'] = 'DESC';
                break;
        }
    }

    protected function postDelete() { /* Nix :-) */
    }

    private function initDeletedView() {
        $aPost = MLRequest::gi()->data();
        //$aPost['timestamp'] = time();
        if (isset($aPost['ItemIDs']) && is_array($aPost['ItemIDs']) && isset($aPost['action']) &&
                ($_SESSION['POST_TS'] != $aPost['timestamp']) // Re-Post Prevention
        ) {
            $_SESSION['POST_TS'] = $aPost['timestamp'];
            switch ($aPost['action']) {
                case 'delete': {
                        $itemIDs = $aPost['ItemIDs'];
                        $request = array(
                            'ACTION' => 'DeleteItems',
                            'DATA' => array(),
                        );
                        $insertData = array();
                        foreach ($itemIDs as $itemID) {
                            $request['DATA'][] = array(
                                'ItemID' => $itemID,
                            );
                        }
                        /*
                          echo print_m($insertData, '$insertData');
                          echo print_m($request, '$request');
                         */
                        try {
                            $result = MagnaConnector::gi()->submitRequest($request);
                        } catch (MagnaException $e) {
                            $result = array(
                                'STATUS' => 'ERROR'
                            );
                        }
                        /*
                          if ($result['STATUS'] == 'SUCCESS') {
                          $result['DeletedItemIDs'] = array_keys($insertData);
                          }
                          echo print_m($result, '$result');
                         */
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
        global $magnaConfig;

        $result = $this->getInventory();
        if (($result !== false) && !empty($result['DATA'])) {
            $this->renderableData = $result['DATA'];
            foreach ($this->renderableData as &$item) {
                $item['ItemTitleShort'] = (strlen($item['Title']) > $this->settings['maxTitleChars'] + 2) ? (fixHTMLUTF8Entities(substr($item['Title'], 0, $this->settings['maxTitleChars'])) . '&hellip;') : fixHTMLUTF8Entities($item['Title']);
                if (isset($item['VariationAttributesText'])) {
                    $item['VariationAttributesText'] = fixHTMLUTF8Entities($item['VariationAttributesText']);
                } else {
                    $item['VariationAttributesText'] = "";
                }
                $item['StartTime'] = strtotime($item['StartTime']);
                $item['EndTime'] = ('1' == $item['ListingDuration'] ? '&mdash;' : strtotime($item['EndTime']));
                $item['LastSync'] = strtotime($item['LastSync']);
            }
            unset($result);
        }
    }

    private function getShopDataForItems() {
        foreach ($this->renderableData as &$item) {
            $oProduct = MLProduct::factory();
            try {
                /* @var $oProduct ML_Shop_Model_Product_Abstract  */
                if (!$oProduct->getByMarketplaceSKU($item['SKU'])->exists() && !$oProduct->getByMarketplaceSKU($item['SKU'], true)->exists()) {
                    throw new Exception;
                }
                $item['ShopQuantity'] = $oProduct->getStock();
                $item['ShopPrice'] = $oProduct->getShopPrice();
                $item['ShopTitle'] = $oProduct->getName();
                $item['ShopVarText'] = $oProduct->getName();
                $item['Currency'] = MLModule::gi()->getConfig('currency');
            } catch (Exception $oEx) {
                $item['ShopQuantity'] = $item['ShopPrice'] = $item['ShopTitle'] = '&mdash;';
                $item['ShopVarText'] = '&nbsp;';
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
        global $magnaConfig;

        $html = '
			<table' . (($id != '') ? ' id="' . $id . '"' : '') . ' class="datagrid ml-plist-old-fix">
				<thead class="small"><tr>
					<td>' . $this->__('ML_LABEL_SKU') . ' ' . $this->sortByType('sku') . '</td>
					<td>' . $this->__('ML_LABEL_SHOP_TITLE') . '</td>
					<td>' . $this->__('ML_LABEL_HOOD_TITLE') . ' ' . $this->sortByType('title') . '</td>
					<td>' . $this->__('ML_LABEL_HOOD_ITEM_ID') . '</td>
					<td>' . $this->__('ML_PRICE_SHOP_PRICE_HOOD') . ' ' . $this->sortByType('price') . '</td>
					<td>' . $this->__('ML_LAST_SYNC') . '</td>
					<td>' . $this->__('ML_LABEL_HOOD_LISTINGTIME_FROM') . ' ' . $this->sortByType('starttime') . '</td>
					<td>' . $this->__('ML_LABEL_HOOD_LISTINGTIME_TILL') . ' ' . $this->sortByType('dateend') . '</td>
					<td>' . $this->__('ML_LABEL_HOOD_DELETION_REASON') . '</td>
				</tr></thead>
				<tbody>
		';
        $oddEven = false;
        $this->getShopDataForItems();
        foreach ($this->renderableData as $item) {
            $details = htmlspecialchars(str_replace('"', '\\"', serialize(array(
                'SKU' => $item['SKU'],
                'Price' => $item['Price'],
                'Currency' => MLModule::gi()->getConfig('currency'),
            ))));


            $renderedShopPrice = ((isset($item['Currency']) && isset($item['ShopPrice']) && 0 != $item['ShopPrice']) ? MLPrice::factory()->format($item['ShopPrice'], $item['Currency']) : '&mdash;');
            if (isset($item['deletedBy'])) {               
                switch ($item['deletedBy']) {
                    case('Sync'): $deletedBy = $this->__('ML_SYNCHRONIZATION');
                        break;
                    case('Button'): $deletedBy = $this->__('ML_DELETION_BUTTON');
                        break;
                    case('notML'): $deletedBy = $this->__('ML_NOT_BY_ML');
                        break;
                    default: $deletedBy = '&mdash;';
                        break;
                }
            } else {
                $deletedBy="";
            }
            $html .= '
				<tr>
					<td>' . $item['SKU'] . '</td>
					<td title="' . fixHTMLUTF8Entities($item['ShopTitle'], ENT_COMPAT) . '">' . $item['ShopTitle'] . '<br /><span class="small">' . $item['ShopVarText'] . '</span></td>
					<td title="' . fixHTMLUTF8Entities($item['Title'], ENT_COMPAT) . '">' . $item['ItemTitleShort'] . '<br /><span class="small">' . $item['VariationAttributesText'] . '</span></td>
					<td><a class="ml-js-noBlockUi" href="http://www.hood.de/00' . $item['AuctionId'] . '.htm" target="_blank">' . $item['AuctionId'] . '</a></td>
					<td>' . $renderedShopPrice . ' / ' . ((isset($item['Currency']) && isset($item['Price']) && 0 != $item['Price']) ? MLPrice::factory()->format($item['Price'], $item['Currency']) : '&mdash;') . '</td>
					<td>' . date("d.m.Y", $item['LastSync']) . ' &nbsp;&nbsp;<span class="small">' . date("H:i", $item['LastSync']) . '</span></td>
					<td>' . date("d.m.Y", $item['StartTime']) . ' &nbsp;&nbsp;<span class="small">' . date("H:i", $item['StartTime']) . '</span></td>
                    <td>' . ('&mdash;' == $item['EndTime'] ? '&mdash;' : date("d.m.Y", $item['EndTime']) . ' &nbsp;&nbsp;<span class="small">' . date("H:i", $item['EndTime']) . '</span>') . '</td>
					<td>' . $deletedBy . '</td>';
            $html .= '	
				</tr>';
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
        #echo print_m($this->renderableData, 'renderInventoryTable: $this->renderableData');

        $html .= $this->includeViewBuffered('widget_listings_misc_pagination');

        if (!empty($this->renderableData)) {
            $html .= $this->renderDataGrid('hoodinventory');
        } else {
            $html .= '<table class="magnaframe"><tbody><tr><td>' .
                    (empty($this->search) ? $this->__('ML_GENERIC_NO_INVENTORY') : $this->__('ML_LABEL_NO_SEARCH_RESULTS')) .
                    '</td></tr></tbody></table>';
        }

        ob_start();
        ?>
        <script type="text/javascript">/*<![CDATA[*/
            jqml(document).ready(function () {
                jqml('#selectAll').click(function () {
                    state = jqml(this).attr('checked');
                    jqml('#hoodinventory input[type="checkbox"]:not([disabled])').each(function () {
                        jqml(this).attr('checked', state);
                    });
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
        global $_modules;
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
                    if ((jqml('#hoodinventory input[type="checkbox"]:checked').length > 0) &&
                        confirm(unescape(<?php echo "'".addslashes(html_entity_decode(sprintf($this->__s('ML_GENERIC_DELETE_LISTINGS', array("'")), $_modules[$this->magnasession['currentPlatform']]['title'])))."'"; ?>))
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
		    <div class="ml-container-action">
		        <div class="ml-container-inner ml-container-sm">
		            ' . $left . '
                </div>
		         <div class="ml-container-inner ml-container-sm">
		            <div class="newSearch">
                        <input id="tfSearch" name="' . MLHttp::gi()->parseFormFieldName('tfSearch') . '" type="text" value="' . fixHTMLUTF8Entities($this->search, ENT_COMPAT) . '"/>
                        <button type="submit" class="mlbtn action" name="' . MLHttp::gi()->parseFormFieldName('search_go') . '" />  <span></span>
                    </div>
		            
                </div>
                <div class="ml-container-inner ml-container-sm">
		            ' . $right . '
                </div>
            </div>
	    ' . $js;
    }

    public function renderView() {
        $html = '<form action="' . $this->getCurrentUrl() . '" id="hoodDeletedView" method="post" class="ml-plist ml-js-plist">';
        foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) {
            $html .= "<input type='hidden' name='$sName' value='$sValue' />";
        }
        $this->initDeletedView();
        $html .= $this->renderInventoryTable();
        return $html . $this->renderActionBox() . '
			</form>
			<script type="text/javascript">/*<![CDATA[*/
				jqml(document).ready(function() {
					jqml(\'#hoodDeletedView\').submit(function () {
						jqml.blockUI(blockUILoading);
					});
				});
			/*]]>*/</script>';
    }

    protected function getTotalPage() {
        return ceil($this->numberofitems / $this->settings['itemLimit']);
    }

    protected function getCurrentPage() {
        $iPage = $this->getRequest('page');
        if (isset($iPage) && (1 <= (int) $iPage) && ((int) $iPage <= $this->getTotalPage())) {
            return (int) $iPage;
        }
        return 1;
    }

    public function getData() {
        return $this->renderableData;
    }

    public function getNumberOfItems() {
        return $this->numberofitems;
    }

    public function getOffset() {
        return $this->offset;
    }

}
