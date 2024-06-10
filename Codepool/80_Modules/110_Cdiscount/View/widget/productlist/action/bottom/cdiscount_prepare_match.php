<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $aStatistic array */
if (!class_exists('ML', false))
    throw new Exception();
?>
<?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) { ?>
    <table class="actions">
        <tbody class="firstChild">
        <tr>
            <td>
                <div class="actionBottom">
                    <div class="left">
                        <div>
                            <form action="<?php echo $this->getCurrentUrl() ?>" method="post">
                                <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                                    <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
                                <?php } ?>
                                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('execute') ?>" value="unprepare"/>
                                <input class="mlbtn" type="submit" value="<?php echo $this->__('ML_AMAZON_BUTTON_MATCHING_DELETE'); ?>">
                            </form>
                        </div>
                    </div>
                    <div class="right" style="padding-right: 6px">
                        <div>
                            <a class="mlbtn action" style="margin: 0px 3px 3px 3px;" href="<?php echo $this->getUrl(array('controller' => $this->getRequest('controller').'_manual')); ?>">
                                <?php echo $this->__('ML_AMAZON_LABEL_MANUAL_MATCHING') ?>
                            </a>
                            <div class="desc" id="desc_man_match" title="<?php echo MLI18n::gi()->ML_LABEL_INFOS; ?>">
                                <span><?php echo MLI18n::gi()->ML_AMAZON_LABEL_MANUAL_MATCHING; ?></span></div>
                        </div>
                        <div>
                            <input type="button" class="mlbtn action" style="margin: 0px 3px 3px 3px;"
                                   value="<?php echo MLI18n::gi()->ML_AMAZON_LABEL_AUTOMATIC_MATCHING; ?>"
                                   id="automatching" name="automatching"/>
                            <div class="desc" id="desc_auto_match" title="<?php echo MLI18n::gi()->ML_LABEL_INFOS; ?>">
                                <span><?php echo MLI18n::gi()->ML_AMAZON_LABEL_AUTOMATIC_MATCHING; ?></span></div>
                        </div>
                    </div>
                            <div class="clear"></div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    <div id="finalInfo" class="dialog2" title="<?php echo MLI18n::gi()->ML_LABEL_INFORMATION; ?>"></div>
    <div id="noItemsInfo" class="dialog2"
         title="<?php echo MLI18n::gi()->ML_LABEL_NOTE; ?>"><?php echo MLI18n::gi()->ML_AMAZON_TEXT_MATCHING_NO_ITEMS_SELECTED; ?></div>
    <div id="manMatchInfo" class="dialog2"
         title="<?php echo MLI18n::gi()->ML_LABEL_INFORMATION . ' ' . MLI18n::gi()->ML_AMAZON_LABEL_MANUAL_MATCHING; ?>"><?php echo MLI18n::gi()->get('Cdiscount_Productlist_Match_Manual_Desc'); ?></div>
    <div id="autoMatchInfo" class="dialog2"
         title="<?php echo MLI18n::gi()->ML_LABEL_INFORMATION . ' ' . MLI18n::gi()->ML_AMAZON_LABEL_AUTOMATIC_MATCHING; ?>"><?php echo MLI18n::gi()->get('Cdiscount_Productlist_Match_Auto_Desc'); ?></div>
    <div id="confirmDiag" class="dialog2"
         title="<?php echo MLI18n::gi()->ML_LABEL_NOTE; ?>"><?php echo MLI18n::gi()->get('Cdiscount_Productlist_Match_Auto_Confirm'); ?></div>
<script type="text/javascript">/*<![CDATA[*/
var selectedItems = 0;
var progressInterval = null;
var percent = 0.0;

var _demo_sub = 0;
function updateProgressDemo() {
	_demo_sub -= 300;
	if (_demo_sub <= 0) {
		_demo_sub = 0;
		window.clearInterval(progressInterval);
		jqml.unblockUI();
	}
	percent = 100 - ((_demo_sub / selectedItems) * 100);
	myConsole.log('Progress: '+_demo_sub+'/'+selectedItems+' ('+percent+'%)');	
	jqml('div.progressBarContainer div#progressPercent').html(Math.round(percent)+'%');
	jqml('div.progressBarContainer div#progressBar').css({'width' : percent+'%'});
}

function demoProgress() {
	jqml.blockUI(blockUIProgress);
	selectedItems = _demo_sub = 4635;
	progressInterval = window.setInterval("updateProgressDemo()", 500);
}

function updateProgress() {
	jqml.ajax({
		type: 'GET',
		async: false,
        url: '<?php echo $this->getCurrentUrl() ?>_auto',
        data: ({
            'ml[method]': 'GetProgress',
            'ml[ajax]': true
        }),
		success: function(data) {
            if (typeof data[0] != 'undefined') {
                var parsedData = JSON.parse(data[0]);
            } else {
                var parsedData = '';
            }
            
			if (!is_object(parsedData)) {
				//selectedItems = 0;
				return;
			}
			percent = 100 - ((parsedData['x'] / selectedItems) * 100);
			myConsole.log('Progress: '+parsedData['x']+'/'+selectedItems+' ('+percent+'%)');
			jqml('div.progressBarContainer div.progressPercent').html(Math.round(percent)+'%');
			jqml('div.progressBarContainer div.progressBar').css({'width' : percent+'%'});
		},
		dataType: 'json'
	});
}

function runAutoMatching() {
	jqml.blockUI(blockUIProgress);
	progressInterval = window.setInterval("updateProgress()", 500);
	jqml.ajax({
		type: 'POST',
		url: '<?php echo $this->getCurrentUrl() ?>_auto',
        data: ({
            'ml[method]': 'StartAutomatching',
            'ml[ajax]': true
        }),
		success: function(data) {
			window.clearInterval(progressInterval);
			jqml.unblockUI();
			myConsole.log(JSON.parse(data).Data);
            jqml('div.progressBarContainer div.progressPercent').html('100%');
			jqml('div.progressBarContainer div.progressBar').css({'width' : '100%'});
			jqml('#finalInfo').html(JSON.parse(data).Data).jDialog({
				buttons: {
                    '<?php echo MLI18n::gi()->ML_BUTTON_LABEL_OK; ?>': function () {
						window.location.href = '<?php echo $this->getCurrentUrl(); ?>';
					}
				}
			});
		},
		dataType: 'html'
	});
}

function handleAutomatching() {
	jqml.ajax({
		type: 'GET',
		async: false,
        url: '<?php echo $this->getCurrentUrl() ?>_auto',
        data: ({
            'ml[method]': 'GetProgress',
            'ml[ajax]': true
        }),
		success: function(data) {
            if (typeof data[0] != 'undefined') {
                var parsedData = JSON.parse(data[0]);
            } else {
                var parsedData = '';
            }
            
			if (!is_object(parsedData)) {
				selectedItems = 0;
				return;
			}
			selectedItems = parsedData['x'];
		},
		dataType: 'json'
	});	
	myConsole.log(selectedItems);
	jqml.unblockUI();

	if (selectedItems <= 0) {
		jqml('#noItemsInfo').jDialog();
	} else {
		jqml('#confirmDiag').jDialog({
			buttons: {
                '<?php echo MLI18n::gi()->ML_BUTTON_LABEL_ABORT; ?>': function () {
					jqml(this).dialog('close');
				},
                '<?php echo MLI18n::gi()->ML_BUTTON_LABEL_OK; ?>': function () {
					jqml(this).dialog('close');
					runAutoMatching();
				}
			}
		});
	}
}

jqml(document).ready(function() {
	jqml('#desc_man_match').click(function() {
		jqml('#manMatchInfo').jDialog();
	});
	jqml('#desc_auto_match').click(function() {
		jqml('#autoMatchInfo').jDialog();
	});
	jqml('#automatching').click(function() {
		var blockUILoading2 = jqml.extend({}, blockUILoading);
		jqml.blockUI(jqml.extend(blockUILoading2, {onBlock: function() {
			handleAutomatching();
		}}));		
	});
});
/*]]>*/</script>
<?php } ?>
