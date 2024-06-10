<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<h2><?php echo MLI18n::gi()->get('Amazon_Productlist_Match_Auto_Title') ?></h2>

<form id="js-amazon-auto" action="<?php echo $this->getCurrentUrl(array('method'=>'amazonAutoMatching')) ?>" method="post" title="<?php echo $this->__('ML_AMAZON_LABEL_AUTOMATIC_MATCHING'); ?>">
    <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
        <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
    <?php } ?>
    <?php $this->includeView('amazon_prepare_match_forminputs', get_defined_vars()); ?>
    <div class="ml-container-action-head">
        <h4>
            <?php echo $this->__('ML_LABEL_ACTIONS') ?>
        </h4>
    </div>
    <div class="ml-container-action">
        <div class="ml-container-inner ml-container-sm">
        </div>
        <div class="ml-container-inner ml-container-md">
        </div>
        <div class="ml-container-inner ml-container-md">
            <input type="submit" value="<?php echo $this->__('ML_AMAZON_LABEL_AUTOMATIC_MATCHING') ?>" class="mlbtn-red"/>
        </div>
    </div>
    <div id="ml-auto-matching-statistic"></div>
</form>
<div class="spacer"></div>
<script type="text/javascript">/*<![CDATA[*/
    (function ($) {
        jqml('#js-amazon-auto').submit(function(){
            jqml(this).magnalisterRecursiveAjax({
                sOffset: '<?php echo MLHttp::gi()->parseFormFieldName('offset') ?>',
                sAddParam: '<?php echo MLHttp::gi()->parseFormFieldName('ajax') ?>=true',
                oI18n: {
                    sProcess: '<?php echo json_encode($this->__('ML_STATUS_FILTER_SYNC_CONTENT')) ?>',



                },
                onProgessBarClick: function (data) {
                    console.dir({data:data});
                },
                onFinalize: function (blError) {

                },
                blDebug: <?php echo MLSetting::gi()->get('blDebug') ? 'true' : 'false' ?>,
                sDebugLoopParam: "<?php echo MLHttp::gi()->parseFormFieldName('saveSelection') ?>=true",
                oFinalButtons: {

                    oSuccess: [
                        {text: 'Ok', click: function () {
                                var eDialog = jqml('#recursiveAjaxDialog');
                                // eDialog.dialog('close');
                                window.location.href = '<?php
                                    $sMpId = MLModule::gi()->getMarketPlaceId();
                                    $sMpName = MLModule::gi()->getMarketPlaceName();
                                    echo $this->getUrl(array('controller' => "{$sMpName}:{$sMpId}_prepare_match")); ?>';
                            }}
                    ]
                },
            });
            return false;
        });
    })(jqml);
/*]]>*/</script>
