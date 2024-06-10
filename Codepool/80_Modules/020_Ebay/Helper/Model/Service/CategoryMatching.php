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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

if (!defined('_ML_INSTALLED'))
    throw new Exception('Direct Access to this location is not allowed.');

class ML_Ebay_Helper_Model_Service_CategoryMatching {
	const EBAY_CAT_VALIDITY_PERIOD = 86400; # Nach welcher Zeit werden Kategorien ungueltig (Sekunden)
	const EBAY_STORE_CAT_VALIDITY_PERIOD = 600; # Nach welcher Zeit werden Store-Kategorien ungueltig (Sekunden)

	private $request = 'view';
	private $isStoreCategory = false;
    private $SiteID;


	public function __construct($request = 'view') {
		$this->request = $request;
        $this->SiteID = MLModule::gi()->getEbaySiteID();
	}

	private function rendereBayCategories($ParentID = 0, $purge = false) {
        $iStoreCategory = $this->isStoreCategory ? 1 : 0;

        $ebaySubCats = MLDatabase::factory('ebay_categories')
            ->set('storecategory',$iStoreCategory)
            ->set('categoryid', $ParentID)
            ->getChildCategories(false, $purge)
            ->data()
        ;

        // restrictedtobusiness: Show only B2B enabled categories
        if (    !$iStoreCategory
            && MLModule::gi()->getConfig('restrictedtobusiness') == '1') {
            foreach ($ebaySubCats as $iSubCatNo => $aSubCat) {
                if($aSubCat['b2bvatenabled'] == '0') {
                    unset($ebaySubCats[$iSubCatNo]);
                }
            }
            unset($iSubCatNo); 
            unset($aSubCat); 
        }

		if ($ebaySubCats === false) {
			return '';
		}
		$ebayTopLevelList = '';
		foreach ($ebaySubCats as $item) {
			if (1 == $item['leafcategory']) {
				$class = 'leaf';
			} else {
				$class = 'plus';
			}
			$ebayTopLevelList .= '
				<div class="catelem" id="y_'.$item['categoryid'].'">
					<span class="toggle '.$class.'" id="y_toggle_'.$item['categoryid'].'">&nbsp;</span>
					<div class="catname" id="y_select_'.$item['categoryid'].'">
						<span class="catname">'.fixHTMLUTF8Entities($item['categoryname']).'</span>
					</div>
				</div>';
		}
		return $ebayTopLevelList;
	}

	# Artikel-Auswahl anzeigen. Spaeter schauen ob wir das auch strukturiert mit Kategorien machen,
	# aber erschtmal flat.
	private function renderSelection() {
		$selection = $this->getSelection();
		if ($selection === false) {
			return '';
		}
		$itemList = '';
		foreach ($selection as $item) {
			$itemList .= '
				<div class="catelem" id="y_'.$item['SKU'].'">
					<span class="toggle leaf" id="y_toggle_'.$item['SKU'].'">&nbsp;</span>
					<div class="catname" id="y_select_'.$item['SKU'].'">
						<span class="catname">'.fixHTMLUTF8Entities($item['products_name'].' ('.$item['SKU'].')').'</span>
					</div>
				</div>';
		}
		return $itemList;

	}

	private function rendereBayCategoryItem($id) {
		return '
			<div id="yc_'.$id.'" class="ebayCategory">
				<div id="y_remove_'.$id.'" class="y_rm_handle">&nbsp;</div><div class="ycpath">'.geteBayCategoryPath($id, $this->isStoreCategory).'</div>
			</div>';
	}

        protected function getTryAgainBlock(){
            return json_encode('<div class="category_tryagain">'.MLI18n::gi()->get('ML_ERROR_LABEL_API_CONNECTION_PROBLEM').'</div>');
        }

	public function renderView() {
        if (MLModule::gi()->getConfig('restrictedtobusiness') == '1') {
			$sNotice = '<tr><td><div class="noticeBox">'.MLI18n::gi()->get('ML_EBAY_ONLY_B2B_CATS').'</div></td></tr>';
		} else {
			$sNotice = '';
		}
		$html = '
			<div id="ebayCategorySelector" style="margin-top: 20px" class="dialog2" title="' . MLI18n::gi()->ML_EBAY_LABEL_SELECT_CATEGORY . '">
				<table id="catMatch"><tbody>
					'.$sNotice.'
					<tr>
						<td id="ebayCats" class="catView"><div class="catView">'.$this->rendereBayCategories(0).'</div></td>
					</tr>
					<tr>
						<td id="selectedeBayCategory" class="catView" ><div class="catView" style="height: fit-content;padding-bottom: 20px;"></div></td>
					</tr>
				</tbody></table>
				<div id="messageDialog" class="dialog2"></div>
			</div>
		';
		ob_start();
                $sPostNeeded = '';
                foreach (MLHttp::gi()->getNeededFormFields() as $sKey => $sValue) {
                    $sPostNeeded .= "'$sKey' : '$sValue' ,";
                }
                $aMlHttp = MLHttp::gi();
?>
<script type="text/javascript">/*<![CDATA[*/
    jqml('#importCategories').click(function(){
        //debugger
        var currentA = jqml(this);
    });
(function($){
    var selectedEBayCategory = '';
    var madeChanges = false;
    var isStoreCategory = false;

    function collapseAllNodes(elem) {
        jqml('div.catelem span.toggle:not(.leaf)', jqml(elem)).each(function() {
            jqml(this).removeClass('minus').addClass('plus');
            jqml(this).parent().children('div.catname').children('div.catelem').css({display: 'none'});
        });
        jqml('div.catname span.catname.selected', jqml(elem)).removeClass('selected').css({'font-weight':'normal'});
    }

    function resetEverything() {
        madeChanges = false;
        collapseAllNodes(jqml('#ebayCats'));
        /* Expand Top-Node */
        jqml('#s_toggle_0').removeClass('plus').addClass('minus').parent().children('div.catname').children('div.catelem').css({display: 'block'});
        jqml('#selectedeBayCategory div.catView').empty();
        selectedEBayCategory = '';
    }

    function selectEBayCategory(yID, html) {
        madeChanges = true;
    	jqml('#selectedeBayCategory div.catView').html(html);

        selectedEBayCategory = yID;
        myConsole.log('selectedeBayCategory', selectedEBayCategory);

        //jqml('#ebayCats div.catname span.catname.selected').removeClass('selected').css({'font-weight':'normal'});
        jqml('#ebayCats div.catView').find('span.catname.selected').removeClass('selected').css({'font-weight':'normal'});
        jqml('#ebayCats div.catView').find('span.toggle.tick').removeClass('tick');

        jqml('#'+yID+' span.catname').addClass('selected').css({'font-weight':'bold'});
        jqml('#'+yID+' span.catname').parents().prevAll('span.catname').addClass('selected').css({'font-weight':'bold'});
        jqml('#'+yID+' span.catname').parents().prev('span.toggle').addClass('tick');

    }

    function clickEBayCategory(elem) {
        // hier Kategorien zuordnen, zu allen ausgewaehlten Items
        tmpNewID = jqml(elem).parent().attr('id');
        mlShowLoading();
        jqml.ajax({
            type: 'POST',
            url: '<?php echo $aMlHttp->getCurrentUrl(array('kind' => 'ajax'));?>',
            data: {
                <?php echo $sPostNeeded ?>
                '<?php echo MLHttp::gi()->parseFormFieldName('method') ?>': 'getField',
                '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[method]': 'primaryCategory',
                '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[action]': 'rendereBayCategoryItem',
                '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[id]': tmpNewID,
                '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[isStoreCategory]': isStoreCategory
            },
            success: function(data) {
                try {
                    var oJson=$.parseJSON(data);
                    var data=oJson.plugin.content;
                    selectEBayCategory(tmpNewID, data);
                } catch(oExeception) {
                }
                mlHideLoading();
            },
            error: function() {
                mlHideLoading();
            },
            dataType: 'html'
        });
    }

    function addeBayCategoriesEventListener(elem) {
        jqml('div.catelem span.toggle:not(.leaf)', jqml(elem)).each(function() {
            jqml(this).click(function () {
                myConsole.log(jqml(this).attr('id'));
                if (jqml(this).hasClass('plus')) {
                    tmpElem = jqml(this);
                    if (tmpElem.parent().children('div.catname').children('div.catelem').length == 0) {
                        mlShowLoading();
                        jqml.ajax({
                            type: 'POST',
                            url: '<?php echo $aMlHttp->getCurrentUrl(array('kind' => 'ajax'));?>',
                            data: {
                                <?php echo $sPostNeeded ?>
                                '<?php echo MLHttp::gi()->parseFormFieldName('method') ?>': 'getField',
                                '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[method]': 'primaryCategory',
                                '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[action]': 'geteBayCategories',
                                '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[objID]': tmpElem.attr('id'),
                                '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[isStoreCategory]': isStoreCategory
                            },
                            success: function(data) {
                                try {
                                    var oJson = $.parseJSON(data);
                                    var data = oJson.plugin.content;
                                    if(data != '' && data != null && data != 'undefined') {
                                        tmpElem.removeClass('plus').addClass('minus');
                                    } else {
                                        data = <?php echo $this->getTryAgainBlock()?>;
                                    }
                                } catch(oExeception) {
                                    data = <?php echo $this->getTryAgainBlock()?>;
                                }
                                appendTo = tmpElem.parent().children('div.catname');
                                appendTo.find("div.category_tryagain").remove();
                                appendTo.append(data);
                                addeBayCategoriesEventListener(appendTo);
                                appendTo.children('div.catelem').css({display: 'block'});
                                mlHideLoading();
                            },
                            error: function() {
                                mlHideLoading();
                            },
                            dataType: 'html'
                        });
                    } else {
                        tmpElem.parent().children('div.catname').children('div.catelem').css({display: 'block'});
                    }
                } else {
                    jqml(this).removeClass('minus').addClass('plus');
                    jqml(this).parent().children('div.catname').children('div.catelem').css({display: 'none'});
                }
            });
        });
        jqml('div.catelem span.toggle.leaf', jqml(elem)).each(function() {
            jqml(this).click(function () {
                clickEBayCategory(jqml(this).parent().children('div.catname').children('span.catname'));
            });
            jqml(this).parent().children('div.catname').children('span.catname').each(function() {
                jqml(this).click(function () {
                    clickEBayCategory(jqml(this));
                });
                if (jqml(this).parent().attr('id') == selectedEBayCategory) {
                    //jqml(this).addClass('selected').css({'font-weight':'bold'});
                }
            });
        });
    }

    function returnCategoryID() {
        if (selectedEBayCategory == '') {
            jqml('#messageDialog').html(
                'Bitte w&auml;hlen Sie eine eBay-Kategorie aus.'
            ).jDialog({
                title: <?php echo json_encode(MLI18n::gi()->ML_LABEL_NOTE); ?>
            });
            return false;
        }
        cID = selectedEBayCategory;
        cID = str_replace('y_select_', '', cID);
        resetEverything();
        return cID;
    }

    function generateEbayCategoryPath(cID, viewElem) {
        cID = typeof cID === 'undefined' ? 0 : cID;
        viewElem.find('option').removeAttr('selected');
        if (viewElem.find('option[value="'+cID+'"]').length > 0) {
            viewElem.find('option[value="'+cID+'"]').attr('selected','selected');
            viewElem.find('select').blur();
            viewElem.find('select').trigger('change');
        } else {
            mlShowLoading();
            jqml.ajax({
                type: 'POST',
                url: '<?php echo $aMlHttp->getCurrentUrl(array('kind' => 'ajax'));?>',
                data: {
                    <?php echo $sPostNeeded ?>
                    '<?php echo MLHttp::gi()->parseFormFieldName('method') ?>': 'getField',
                    '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[method]': 'primaryCategory',
                    '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[action]': 'geteBayCategoryPath',
                    '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[id]': cID,
                    '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[isStoreCategory]': isStoreCategory
                },
                success: function(data) {
                    try {
                        var oJson = $.parseJSON(data);
                        var data = oJson.plugin.content;
                        viewElem.find('select').append('<option selected="selected" value="'+cID+'">'+data+'</option>');
                        viewElem.find('select').trigger('change');
                    } catch(oExeception) {
                    }
                    mlHideLoading();
                },
                error: function() {
                    mlHideLoading();
                },
                dataType: 'html'
            });
        }
    }

    function VariationsEnabled(cID, viewElem) {
        viewElem.html('');
        if (cID != 0) {
            mlShowLoading();
            jqml.ajax({
                type: 'POST',
                url: '<?php echo $aMlHttp->getCurrentUrl(array('kind' => 'ajax'));?>',
                data: {
                    <?php echo $sPostNeeded ?>
                    '<?php echo MLHttp::gi()->parseFormFieldName('method') ?>': 'getField',
                    '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[method]': 'primaryCategory',
                    '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[action]': 'VariationsEnabled',
                    '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[id]': cID
                },
                success: function(data) {
                    try{
                        var oJson = $.parseJSON(data);
                        var data = oJson.plugin.content;
                    } catch(oExeception) {
                    }
                    mlHideLoading();
                    var msg;
                    if(data == 'true') msg = <?php echo json_encode(MLI18n::gi()->ML_EBAY_NOTE_VARIATIONS_ENABLED) ?>;
                    else msg = <?php echo json_encode(MLI18n::gi()->ML_EBAY_NOTE_VARIATIONS_DISABLED) ?>;
                    viewElem.html(msg);
                },
                error: function() {
                    mlHideLoading();
                },
                dataType: 'html'
            });
        }
    }
    

    function ProductRequired(cID, viewElem) {
        viewElem.html('');
        if (cID != 0) {
            mlShowLoading();
            jqml.ajax({
                type: 'POST',
                url: '<?php echo $aMlHttp->getCurrentUrl(array('kind' => 'ajax'));?>',
                data: {
                    <?php echo $sPostNeeded ?>
                    '<?php echo MLHttp::gi()->parseFormFieldName('method') ?>': 'getField',
                    '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[method]': 'primaryCategory',
                    '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[action]': 'ProductRequired',
                    '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[id]': cID
                },
                success: function(data) {
                    try{
                        var oJson = $.parseJSON(data);
                        var data = oJson.plugin.content;
                    } catch(oExeception) {
                    }
                    mlHideLoading();
                    var msg;
                    if (data == 'true') msg = <?php echo json_encode('<table><tr><td><div class="noticeBox">' . MLI18n::gi()->ml_ebay_note_product_required_short . '</div></td><td style="vertical-align:middle"><div class="gfxbutton info" id="infobuttonProductRequired" title="Infos"><span style="position:absolute">' . MLI18n::gi()->ml_ebay_note_product_required . '</span></div></td></tr></table><div id="infobuttonProductRequiredDialog" class="dialog2" title="' . MLI18n::gi()->ML_LABEL_NOTE . '"></div>') ?>;
                    else msg = '';
                    viewElem.html(msg);
                },
                error: function() {
                    mlHideLoading();
                },
                dataType: 'html'
            });
        }
        window.setTimeout(function() {productRequiredInfoPopup();}, 500);
    }

    function productRequiredInfoPopup() {
        jqml('div#infobuttonProductRequired').off();
        jqml('div#infobuttonProductRequired').click(function() {
                jqml('#infobuttonProductRequiredDialog').html(jqml('span', this).html()).jDialog();
        });
        window.setTimeout(function() {productRequiredInfoPopup();}, 500);
    }

    function initEBayCategories(purge) {
        purge = purge || false;
        myConsole.log('isStoreCategory', isStoreCategory);
        mlShowLoading();
        jqml.ajax({
            type: 'POST',
            url: '<?php echo $aMlHttp->getCurrentUrl(array('kind' => 'ajax'));?>',
            data: {
                <?php echo $sPostNeeded ?>
                '<?php echo MLHttp::gi()->parseFormFieldName('method') ?>': 'getField',
                '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[method]': 'primaryCategory',
                '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[action]': 'geteBayCategories',
                '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[objID]': '',
                '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[isStoreCategory]': isStoreCategory,
                '<?php echo MLHttp::gi()->parseFormFieldName('ajaxData') ?>[purge]': purge ? 'true' : 'false'
            },
            success: function (data) {
                try {
                    var oJson = $.parseJSON(data);
                    var data = oJson.plugin.content;
                    jqml('#ebayCats > div.catView').html(data);
                    addeBayCategoriesEventListener(jqml('#ebayCats'));
                } catch (oExeception) {
                }
                mlHideLoading();
            },
            error: function () {
                mlHideLoading();
            },
            dataType: 'html'
        });
    }

    function startCategorySelector(callback, kind) {
        newStoreState = (kind == 'store');
        if (newStoreState != isStoreCategory) {
            isStoreCategory = newStoreState;
            jqml('#ebayCats > div.catView').html('');
            initEBayCategories();
        }

        jqml('#ebayCategorySelector').jDialog({
            width: '75%',
            minWidth: '300px',
            buttons: {
                <?php echo json_encode(MLI18n::gi()->ML_BUTTON_LABEL_ABORT); ?>: function() {
                    jqml(this).dialog('close');
                },
                <?php echo json_encode(MLI18n::gi()->ML_BUTTON_LABEL_OK); ?>: function() {
                    cID = returnCategoryID();
                    if (cID != false) {
                        callback(cID);
                        jqml(this).dialog('close');
                    }
                }
            },
            open: function(event, ui) {
                var tbar = jqml('#ebayCategorySelector').parent().find('.ui-dialog-titlebar');
                if (tbar.find('.ui-icon-arrowrefresh-1-n').length == 0) {
                    var rlBtn = jqml(
                        '<a title="<?php echo MLI18n::gi()->get('ML_EBAY_IMPORT_CATEGORIES') ?>" class="ui-dialog-titlebar-close ui-corner-all ui-state-focus ml-js-noBlockUi" '+
                        'href="<?php echo MLHttp::gi()->getUrl(array('mpid' => MLModul::gi()->getMarketPlaceId(), 'do' => 'ImportCategories')); ?>" role="button" href="#" style="right: 2em; padding: 0px;top:30px"  get="GET">' +
			    		'<span class="ui-icon ui-icon-arrowrefresh-1-n">reload</span>'+
                        '</a>'
                    );
                    tbar.append(rlBtn);
                    rlBtn.click(function (event) {
                        var currentA = jqml(this);
                        currentA.magnalisterRecursiveAjax({
                            sOffset:'<?php echo MLHttp::gi()->parseFormFieldName('offset') ?>',
                            sAddParam:'<?php echo MLHttp::gi()->parseFormFieldName('ajax') ?>=true',
                            oI18n:{
                                sProcess    : '<?php echo addslashes(MLI18n::gi()->get('ML_STATUS_FILTER_SYNC_CONTENT')); ?>',
                                sError      : '<?php echo addslashes(MLI18n::gi()->get('ML_ERROR_LABEL')); ?>',
                                sSuccess    : '<?php echo addslashes(MLI18n::gi()->get('ML_OTTO_IMPORT_CATEGORIES_SUCCESS')); ?>'
                            },
                            onFinalize: function(){
                                // debugger
                                window.location=window.location;//reload without post
                            },
                            onProgessBarClick:function(data){
                                console.dir({data:data});
                            },
                            blDebug: <?php echo MLSetting::gi()->get('blDebug') ? 'true' : 'false' ?>,
                            sDebugLoopParam: "<?php echo MLHttp::gi()->parseFormFieldName('saveSelection') ?>=true"
                        });
                        initEBayCategories(true);
                        return false;
    			    });
        		}
            }
        });
    }

    jqml(document).ready(function() {
        addeBayCategoriesEventListener(jqml('#ebayCats'));
        jqml('.js-category-dialog').click(function(){
            var sField=jqml(this).attr('data-field');
            var blStore=jqml(this).attr('data-store');
            startCategorySelector(
                function(cID) {
                    jqml('#'+sField+'_visual').val(cID);
                    generateEbayCategoryPath(cID, jqml('#'+sField+'_visual'));
                },
                blStore ? 'store' : 'eBay'
            );
        });
        jqml('[data-field]').each(function(){
            var sField = jqml(this).attr('data-field');
            var cId = jqml(this).closest('tr').find('select').val();
            generateEbayCategoryPath(cId, jqml('#'+sField+'_visual'));
        });

        jqml('.magna .magnalisterForm button.js-category-dialog').closest('tr').find('select').change(function () {
            var self = jqml(this);// select-element
            var button = self.closest('tr').find('button.js-category-dialog');// cat-popup-button
            if (button.data('variationsenabled')) {
                VariationsEnabled(self.val(), jqml('#noteVariationsEnabled'));
                ProductRequired(self.val(), jqml('#noteProductRequired'));
            }
//            if (!button.data('store')) {
//                getEBayCategoryAttributes(self.val(), button.data('field').replace('_field_','_fieldset_')+'_attributes', button.data('method'));
//            }
        });

    });
})(jqml);
/*]]>*/</script>
<?php
		$html .= ob_get_contents();
		ob_end_clean();

		return $html;
	}

	public function renderAjax() {
            $aData= MLRequest::gi()->data('ajaxData');
		$id = '';
		if (isset($aData['id'])) {
			if (($pos = strrpos($aData['id'], '_')) !== false) {
				$id = substr($aData['id'], $pos+1);
			} else {
				$id = $aData['id'];
			}
		}
		$this->isStoreCategory = (array_key_exists('isStoreCategory', $aData))
			? (($aData['isStoreCategory'] == 'false')
				? false
				: true
			) : false;

		switch($aData['action']) {
			case 'geteBayCategories': {
				return $this->rendereBayCategories(
					empty($aData['objID'])
						? 0
						: str_replace('y_toggle_', '', $aData['objID']),
					isset($aData['purge']) ? $aData['purge'] : false
				);
				break;
			}
			case 'rendereBayCategoryItem': {
				return $this->rendereBayCategoryItem($id);
			}
			case 'geteBayCategoryPath': {
				return geteBayCategoryPath($id, $this->isStoreCategory);
			}
			case 'VariationsEnabled': {
				return VariationsEnabled($id)?'true':'false';
			}
			case 'ProductRequired': {
				return MLDatabase::factory('ebay_categories')->set('categoryid',$id)->productRequired()?'true':'false';
			}
			case 'saveCategoryMatching': {
				if (!isset($aData['selectedShopCategory']) || empty($aData['selectedShopCategory']) ||
					(isset($aData['selectedeBayCategories']) && !is_array($aData['selectedeBayCategories']))
				) {
					return json_encode(array(
						'debug' => var_dump_pre($aData['selectedeBayCategories'], true),
                        'error' => preg_replace('/\s\s+/', ' ', MLI18n::gi()->ML_EBAY_ERROR_SAVING_INVALID_EBAY_CATS)
					));
				}

				$cID = str_replace('s_select_', '', $aData['selectedShopCategory']);
				if (!ctype_digit($cID)) {
					return json_encode(array(
						'debug' => var_dump_pre($cID, true),
                        'error' => preg_replace('/\s\s+/', ' ', MLI18n::gi()->ML_EBAY_ERROR_SAVING_INVALID_SHOP_CAT)
					));
				}
				$cID = (int)$cID;

				if (isset($aData['selectedeBayCategories']) && !empty($aData['selectedeBayCategories'])) {
					$ebayIDs = array();
					foreach ($aData['selectedeBayCategories'] as $tmpYID) {
						$tmpYID = str_replace('y_select_', '', $tmpYID);
						if (preg_match('/^[0-9]{2}-[0-9]{2}-[0-9]{2}$/', $tmpYID)) {
							$ebayIDs[] = $tmpYID;
						}
					}
					if (empty($ebayIDs)) {
						return json_encode(array(
                            'error' => preg_replace('/\s\s+/', ' ', MLI18n::gi()->ML_EBAY_ERROR_SAVING_INVALID_EBAY_CATS_ALL)
						));
					}
				} else {
				}

				return json_encode(array(
					'error' => ''
				));

				break;
			}
			default: {
				return json_encode(array(
                    'error' => MLI18n::gi()->ML_EBAY_ERROR_REQUEST_INVALID
				));
			}
		}
	}

	public function render() {
		if ($this->request == 'ajax') {
			return $this->renderAjax();
		} else {
			return $this->renderView();
		}

	}
}
