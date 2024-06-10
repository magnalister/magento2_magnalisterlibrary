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
 * (c) 2010 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the GNU General Public License v2 or later
 * -----------------------------------------------------------------------------
 */

if (!defined('_ML_INSTALLED'))
    throw new Exception('Direct Access to this location is not allowed.');

class eBayShippingDetailsProcessor {
	private $args = array();
	private $savedvalue = '';
	private $mainKey = '';

	private $magnasession = array();
	private $mpID = 0;

	public function __construct($args, $mainKey, $url, &$value = '') {
		global $_MagnaSession;
		
		$this->args = $args;
		if (isset($this->args['content'])) {
			foreach($this->args['content'] as $service) {
				if (isset($service['ShipToLocation'])) {
					$this->args['international'] = true;
				} else {
					$this->args['international'] = false;
				}
				break;
			}
		} else if (strpos($this->args['key'], 'local')) {
			$this->args['international'] = false;
		} else {
			$this->args['international'] = true;
		}
		$this->savedvalue = &$value;
		
		$this->magnasession = $_MagnaSession;
		$this->mpID = $_MagnaSession['mpID'];
		
		$this->mainKey = $mainKey;
		
	}

	public function renderView($settings = array()) {
		global $_MagnaSession;

		if ($this->args['international']) {
			$services = geteBayInternationalShippingServicesList();
			$locations = geteBayShippingLocationsList();
			$settings = array_merge(
				array(
					'ShippingService' => '',
					'ShippingServiceCost' => '',
					'ShipToLocation' => '',
					#'addcost' => '',
				),
				$settings
			);
		} else {
			$services = geteBayLocalShippingServicesList();
			$locations = array();
			$settings = array_merge(
				array(
					'ShippingService' => '',
					'ShippingServiceCost' => '',
					#'addcost' => '',
				),
				$settings
			);
		}

		$uniqueKey = (string)mt_rand(0, mt_getrandmax());
		
		$nameKey = empty($this->mainKey) 
			? $this->args['key']
			: 'conf['.$this->args['key'].']';

		if (isset($this->args['content']) && isset($this->mainKey))
			$nameKey = $this->mainKey;
		
		$serviceSelect = '<select name="'.MLHttp::gi()->parseFormFieldName($nameKey.'['.$uniqueKey.'][ShippingService]').'">'."\n";
		foreach ($services as $key => $service) {
			$serviceSelect .= '<option value="'.$key.'"'.(
				($settings['ShippingService'] == $key)
					? ' selected="selected"'
					: ''
			).'>'.$service.'</option>'."\n";
		}
		$serviceSelect .= '</select>';

		$locationSelect = '';
                if (isset($locations['None'])) {
                    unset($locations['None']);
                }
		if (empty($settings['ShipToLocation'])){ 
                    $settings['ShipToLocation'] = array();
                }
		if (!is_array($settings['ShipToLocation'])) {
                    $settings['ShipToLocation'] = array($settings['ShipToLocation']);
                }
		if (!empty($locations)) {
			$maxRows = (int)(ceil(count($locations) / 5));
			$locationSelect .= "<table><tr>\n";
			$currRow=0;
			foreach ($locations as $key => $loc) {
				if (0 == $currRow % $maxRows) {
					$locationSelect .= '<td>';
				}
				$locationSelect .= '<input type="checkbox" name="'.MLHttp::gi()->parseFormFieldName($nameKey.'['.$uniqueKey.'][ShipToLocation][]').'" value="'.$key.'"';
				if (($settings['ShipToLocation'] == $key)
                                    ||
                                    (is_array($settings['ShipToLocation']) && in_array($key, $settings['ShipToLocation']))) { 
                                    $locationSelect .= ' checked="checked"';
				}
				$locationSelect .= ' /><nobr>'.$loc."&nbsp;</nobr>\n";
				if (  ($currRow % $maxRows == $maxRows - 1)
				    ||($currRow == count($locations))) {
					$locationSelect .= '</td>';
				} else {
					$locationSelect .= '<br />';
				}
				$currRow++;
			}
			$locationSelect .= "</tr></table>\n";
		}
		$shippingCost = '<input type="text" name="'.  MLHttp::gi()->parseFormFieldName($nameKey.'['.$uniqueKey.'][ShippingServiceCost]').'" value="'.$settings['ShippingServiceCost'].'">';
		#$additionalShippingCost = '<input type="text" name="MLHttp::gi()->parseFormFieldName('.$nameKey.'['.$uniqueKey.'][addcost]"').' value="'.$settings['addcost'].'">';
		$idkey = str_replace('.', '_', $this->args['key']).'_'.$uniqueKey;

		$html = '
			<table id="'.$idkey.'" class="shippingDetails inlinetable nowrap autoWidth"><tbody>
				<tr class="row1">'. (empty($locationSelect) ? '
					<td class="paddingRight">'.$serviceSelect.'</td>
					<td class="textright">'.ML_EBAY_LABEL_SHIPPING_COSTS.':&nbsp;</td>
					<td class="paddingRight">'.$shippingCost.'</td>
					' : '
					<td class="paddingRight" colspan="3">'.$serviceSelect.'&nbsp;&nbsp;'.ML_EBAY_LABEL_SHIPPING_COSTS.':&nbsp;'.$shippingCost.'</td>').'
					<td rowspan="2">
						<input id="" type="button" value="&#043;" class="mlbtn fullfont plus" />
						'.((array_key_exists('func', $this->args) && ($this->args['func'] == '' || $this->args['func'] == 'addRow'))
							? '<input type="button" value="&#045;" class="mlbtn fullfont minus" />'
							: '<input type="button" value="&#045;" class="mlbtn fullfont minus" style="display: none" />'
						).'
					</td>
				</tr>
				<tr class="bottomDashed">
					'.(!empty($locationSelect) ? '<td class="paddingRight" colspan="3">'.$locationSelect.'</td>' : '')."\n";			
                        $aParams = array();
                        foreach ($this->args as $sKey => $sValue) {
                            if(!in_array($sKey, array('mode','ajax','mp')))
                                 $aParams[MLHttp::gi()->parseFormFieldName($sKey)] = $sValue;
                        }
                        $aParams = array_merge($aParams,MLHttp::gi()->getNeededFormFields());
                        ob_start();
                        ?>
	        <script type="text/javascript">/*<![CDATA[*/
				(function($){
                $(document).ready(function() {
					$('#<?php echo $idkey; ?> input.mlbtn.plus').click(function () {
						myConsole.log();
						jqml.blockUI(blockUILoading); 
						jqml.ajax({
							type: 'POST',
							url: '<?php echo MLHttp::gi()->getCurrentUrl(); ?>',
							data: <?php echo json_encode(array_merge(
								$aParams,
								array (
									MLHttp::gi()->parseFormFieldName('action') => 'extern',
									MLHttp::gi()->parseFormFieldName('function') => 'Modul::eBayShippingConfig',
									MLHttp::gi()->parseFormFieldName('kind') => 'ajax',
									MLHttp::gi()->parseFormFieldName('func') => 'addRow',
                                                                        MLHttp::gi()->parseFormFieldName('ajax') => 'true',
								)
							)); ?>,
							success: function(data) {
                                                                                                                                                                                try{
                                                                                                                                                                                          var data=$.parseJSON(data);
                                                                                                                                                                                      }catch(e){
                                                                                                                                                                                      }
								jqml.unblockUI();
								$('#<?php echo $idkey; ?>').after(data);
							},
							error: function (xhr, status, error) {
								jqml.unblockUI();
							},
							dataType: 'html'
						});
					});
					$('#<?php echo $idkey; ?> input.mlbtn.minus').click(function () {
						var $tableBox = $('#<?php echo $idkey; ?>'),
							tables = $tableBox.parent('td').find('table');
						$tableBox.detach();
						if (tables.length == 2) {
							tables.find('input.mlbtn.minus').fadeOut(0);
						}
					});
				});
                })(jqml);
			/*]]>*/</script><?php
			$html .= ob_get_contents().'
					</td>
				</tr>
			</tbody></table>';
			ob_end_clean();
		return $html;
	}
	
	private function verifyAndFix() {
		$data = MLRequest::gi()->data();
		if (!empty($this->mainKey) && array_key_exists($this->mainKey, $data)) {
			$data = $data[$this->mainKey];
		}
		if (!array_key_exists($this->args['key'], $data)) {
			return false;
		}
		$data = $data[$this->args['key']];
		#echo print_m($data);
		if (!empty($data)) {
			foreach ($data as $key => &$item) {
				if (empty($item['ShippingService'])) {
					unset($data[$key]);
				}
				if ('=GEWICHT' == strtoupper($item['ShippingServiceCost'])) {
					$item['cost'] = '=GEWICHT';
					#unset($item['addcost']);
				} else {
					$item['ShippingServiceCost'] = (float)str_replace(',', '.', trim($item['ShippingServiceCost']));
					#$item['addcost'] = str_replace(',', '.', trim($item['addcost']));
					#if (!empty($item['addcost'])) {
					#	$item['addcost'] = (float)$item['addcost'];
					#}
				}
			}
		}
		$data = array_values($data);
		#echo print_m($data);
		$this->savedvalue = json_encode($data);
		return true;
	}

	public function process() {
		if (!array_key_exists('kind', $this->args)) {
			$this->args['kind'] = 'view';
		}
		switch ($this->args['kind']) {
			case 'ajax': {
				if ($this->args['func'] == 'addRow') {
					return $this->renderView();
				}
				return '';
				break;
			}
			case 'save': {
				return $this->verifyAndFix();
				break;
			}
			default: {
				if (isset($this->args['content'])) {
					$setting = $this->changeShippingArrayKeys($this->args['content']);
				} else {
					$setting = getDBConfigValue($this->args['key'], $this->mpID, array());
				}
				if (!is_array($setting) || empty($setting)) {
					return $this->renderView();
				}
				$html = '';
                                $i = 0;
				foreach ($setting as $item) {
					if ($i > 0) {
						$this->args['func'] = '';
					}
					$html .= $this->renderView($item);
                                        $i++;
				}
				return $html;
				break;
			}
		}
		return false;
	}

	# Aus dem Eintrag in der properties-Tabelle (Wording fuer die eBay-API)
	# einen wie in der config-Tabelle machen (wording wie sonst im plugin)
	# Eingabe muss bereits ein Array sein, Teil fuer lokal oder international
	private function changeShippingArrayKeys($prefilled) {
		foreach ($prefilled as &$service) {
//			if (isset($service['FreeShipping'])) {
//				unset($service['FreeShipping']);
//			}
//			$service['service'] = $service['ShippingService'];
//			unset($service['ShippingService']);
//            
//            $service['cost'] = $sp->setPrice($service['ShippingServiceCost'])->getPrice(); 
//           	unset($service['ShippingServiceCost']);
//            
//            #$service['addcost'] = $sp->setPrice($service['ShippingServiceAdditionalCost'])->getPrice();
//            unset($service['ShippingServiceAdditionalCost']);
			
//			if (isset($service['ShipToLocation'])) {
//				$service['ShipToLocation'] = $service['ShipToLocation'];
//				unset($service['ShipToLocation']);
//			}
		}
		return $prefilled;
	}
}
