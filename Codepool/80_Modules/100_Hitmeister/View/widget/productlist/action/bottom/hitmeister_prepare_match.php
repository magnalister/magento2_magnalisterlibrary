<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $aStatistic array */
if (!class_exists('ML', false))
    throw new Exception();
?>
<?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) { ?>
    <div class="ml-container-action-head">
        <h4>
            <?php echo $this->__('ML_LABEL_ACTIONS') ?>
        </h4>
    </div>
    <div class="ml-container-action">
        <div class="ml-container-inner ml-container-md">
            <form action="<?php echo $this->getCurrentUrl() ?>" method="post">
                <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                    <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
                <?php } ?>
                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('execute') ?>" value="unprepare"/>
                <input class="mlbtn-gray" type="submit" value="<?php echo $this->__('ML_AMAZON_BUTTON_MATCHING_DELETE'); ?>">
            </form>
        </div>
        <div class="ml-container-inner ml-container-md">
            <div style="display: flex; flex-direction: row-reverse; justify-content: center; align-items: center">
                <a class="mlbtn-red action" style="margin: 0px 3px 3px 3px;" href="<?php echo $this->getUrl(array('controller' => $this->getRequest('controller').'_manual')); ?>">
                    <?php echo $this->__('ML_AMAZON_LABEL_MANUAL_MATCHING') ?>
                </a>
                <div class="desc" id="desc_man_match" title="<?php echo ML_LABEL_INFOS; ?>" style="flex-grow: 0; flex-shrink: 0; margin-right: 6px;">
                    <span><?php echo ML_AMAZON_LABEL_MANUAL_MATCHING; ?></span>
                </div>
            </div>
            <div style="display: flex; flex-direction: row-reverse; justify-content: center; align-items: center">
                <input type="button" class="mlbtn-red action" style="margin: 0px 3px 3px 3px;"
                       value="<?php echo MLI18n::gi()->ML_AMAZON_LABEL_AUTOMATIC_MATCHING; ?>" id="automatching"
                       name="automatching"/>
                <div class="desc" id="desc_auto_match" title="<?php echo MLI18n::gi()->ML_LABEL_INFOS; ?>"
                     style="flex-grow: 0; flex-shrink: 0; margin-right: 6px;">
                    <span><?php echo MLI18n::gi()->ML_AMAZON_LABEL_AUTOMATIC_MATCHING; ?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="spacer"></div>
    <div id="finalInfo" class="dialog2" title="<?php echo MLI18n::gi()->ML_LABEL_INFORMATION; ?>"></div>
    <div id="noItemsInfo" class="dialog2"
         title="<?php echo MLI18n::gi()->ML_LABEL_NOTE; ?>"><?php echo MLI18n::gi()->ML_AMAZON_TEXT_MATCHING_NO_ITEMS_SELECTED; ?></div>
    <div id="manMatchInfo" class="dialog2"
         title="<?php echo MLI18n::gi()->ML_LABEL_INFORMATION . ' ' . MLI18n::gi()->ML_AMAZON_LABEL_MANUAL_MATCHING; ?>"><?php echo MLI18n::gi()->get('Hitmeister_Productlist_Match_Manual_Desc'); ?></div>
    <div id="autoMatchInfo" class="dialog2"
         title="<?php echo MLI18n::gi()->ML_LABEL_INFORMATION . ' ' . MLI18n::gi()->ML_AMAZON_LABEL_AUTOMATIC_MATCHING; ?>"><?php echo MLI18n::gi()->get('Hitmeister_Productlist_Match_Auto_Desc'); ?></div>
    <div id="confirmDiag" class="dialog2"
         title="<?php echo MLI18n::gi()->ML_LABEL_NOTE; ?>"><?php echo MLI18n::gi()->get('Hitmeister_Productlist_Match_Auto_Confirm'); ?></div>
    <script type="text/javascript">/*<![CDATA[*/
        var selectedItems = 0;
        var percent = 0.0;

        function runAutoMatching(success = 0, almost = 0, offset = 0, nosuccess = 0, total = null) {
            let itemsPerCall = 25;
            jqml.ajax({
                type: 'POST',
                url: '<?php echo $this->getCurrentUrl() ?>_auto',
                data: ({
                    'ml[method]': 'AutoMatching',
                    'ml[ajax]': true
                    <?php foreach(MLHttp::gi()->getNeededFormFields() as $sName => $sValue ){ ?>
                    , '<?php echo $sName ?>': '<?php echo $sValue?>'
                    <?php } ?>,
                    'ml[total]': total,
                    'ml[success]': success,
                    'ml[almost]': almost,
                    'ml[offset]': offset,
                    'ml[nosuccess]': nosuccess,
                    'ml[itemsPerCall]': itemsPerCall,
                }),
                success: function (data) {
                    let response = data.Data;

                    if (!is_object(response)) {
                        selectedItems = 0;
                        jqml.unblockUI();
                        return;
                    }
                    selectedItems = response.total;

                    let processedItems = response.success + response.almost + response.nosuccess;

                    percent = 100 - (((response.total - processedItems) / response.total) * 100);
                    if (percent === 0) {
                        percent = 100;
                    } else if (percent > 100) {
                        percent = 100;
                    }

                    // re trigger until it is not 100 percent
                    if (percent < 100) {
                        runAutoMatching(response.success, response.almost, response.offset + itemsPerCall, response.nosuccess, response.total);
                    } else {
                        jqml.unblockUI();
                        jqml('#finalInfo').html(data.message).jDialog({
                            buttons: {
                                '<?php echo MLI18n::gi()->ML_BUTTON_LABEL_OK; ?>': function () {
                                    window.location.href = '<?php echo $this->getCurrentUrl(); ?>';
                                }
                            }
                        });
                    }

                    myConsole.log('Progress: ' + response.offset + '/' + selectedItems + ' (' + percent + '%)');
                    jqml('div.progressBarContainer div.progressPercent').html(Math.round(percent) + '%');
                    jqml('div.progressBarContainer div.progressBar').css({'width': percent + '%'});
                },
                dataType: 'json'
            });
        }

        jqml(document).ready(function () {
            jqml('#desc_man_match').click(function () {
                jqml('#manMatchInfo').jDialog();
            });
            jqml('#desc_auto_match').click(function () {
                jqml('#autoMatchInfo').jDialog();
            });
            jqml('#automatching').click(function () {
                jqml('#confirmDiag').jDialog({
                    buttons: {
                        '<?php echo MLI18n::gi()->ML_BUTTON_LABEL_ABORT; ?>': function () {
                            jqml(this).dialog('close');
                        },
                        '<?php echo MLI18n::gi()->ML_BUTTON_LABEL_OK; ?>': function () {
                            jqml(this).dialog('close');
                            var blockUILoading2 = jqml.extend({}, blockUILoading);
                            jqml.blockUI(jqml.extend(blockUILoading2, {
                                onBlock: function () {
                                    jqml.blockUI(blockUIProgress);
                                    runAutoMatching();
                                }
                            }));
                        }
                    }
                });
            });
        });
        /*]]>*/</script>
<?php } ?>
