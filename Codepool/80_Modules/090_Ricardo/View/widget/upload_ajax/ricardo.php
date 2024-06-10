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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $sProcess  string */
/* @var $sError  string */
/* @var $sSuccess  string */
if (!class_exists('ML', false))
    throw new Exception();
?>
<div style="display:none;" id="js-ml-modal-uploadConfirmPurge" title="<?php echo MLI18n::gi()->get('ML_HINT_HEADLINE_CONFIRM_PURGE'); ?>">
    <?php echo MLI18n::gi()->get('ML_TEXT_CONFIRM_PURGE'); ?>
</div>
<?php
$mConfig = MLModul::gi()->getConfig('checkin.showlimitationwarning');
if ($mConfig === '1' || $mConfig === null) {
    ?>
    <div id="js-ml-modal-uploadWarning" style="display:none;" title="<?php echo MLI18n::gi()->get('ML_LABEL_INFORMATION') ?>">
        <p><?php echo MLI18n::gi()->get('ricardo_productlist_upload_shippingfee_notice_content') ?></p>
    </div>
<?php }?>
<script type="text/javascript">/*<![CDATA[*/
    (function ($) {
        jqml(document).ready(function () {
            function addItems(btn) {
                jqml(btn).magnalisterRecursiveAjax({
                    sOffset: '<?php echo MLHttp::gi()->parseFormFieldName('offset') ?>',
                    sAddParam: '<?php echo MLHttp::gi()->parseFormFieldName('ajax') ?>=true',
                    oFinalButtons: {
                        oError: [
                            {text: 'Ok', click: function () {
                                    var eDialog = jqml('#recursiveAjaxDialog');
                                    if (eDialog.find(".requestErrorBox").is(':hidden')) {
                                        window.location.href = '<?php
                                        $sMpId = MLModul::gi()->getMarketPlaceId();
                                        $sMpName = MLModul::gi()->getMarketPlaceName();
                                        echo $this->getUrl(array('controller' => "{$sMpName}:{$sMpId}_errorlog"));
                                        ?>';
                                    } else {
                                        window.location.href = '<?php echo $this->getCurrentUrl() ?>';
                                    }
                                }}
                        ],
                        oSuccess: [
                            {text: 'Ok', click: function () {
                                    window.location.href = '<?php echo $this->getUrl(array('controller' => "{$sMpName}:{$sMpId}_listings")); ?>';
                                }}
                        ]
                    },
                    oI18n: {
                        sProcess: <?php echo json_encode($sProcess) ?>,
                        sError: <?php echo json_encode($sError) ?>,
                        sErrorLabel: <?php echo json_encode($this->__('ML_ERROR_LABEL')) ?>,
                        sSuccess: <?php echo json_encode($this->__('ML_STATUS_SUBMIT_PRODUCTS_SUMMARY')) ?>,
                        sSuccessLabel: <?php echo json_encode($sSuccess) ?>,
                        <?php if (array_key_exists('sInfo', get_defined_vars())) { ?>
                            sInfo: <?php echo json_encode($sInfo) ?>,
                        <?php } ?>
                    },
                    onProgessBarClick: function (data) {
                        console.dir({data: data});

                    },
                    onFinalize: function (blError) {

                    },
                    blDebug: <?php echo MLSetting::gi()->get('blDebug') ? 'true' : 'false' ?>,
                    sDebugLoopParam: "<?php echo MLHttp::gi()->parseFormFieldName('saveSelection') ?>=true"
                });
                return false;
            }

            function mlEbayCheckDontShowAgain() {
                if(jqml('#ml-checkbox-dontshowitagain').is(':checked') === true){
                    $.ajax({
                            url: '<?php echo $this->getUrl(array('controller' => "{$sMpName}:{$sMpId}_checkin")); ?>',
                            type: 'GET',
                            data: {'<?php echo MLHttp::gi()->parseFormFieldName('method') ?>':'dontShowWarning'}
                        });
                    jqml('#js-ml-modal-uploadWarning').remove();
                }
            }
            
            function mlEbayUploadShowWarning(btn) {
                var eModal = jqml('#js-ml-modal-uploadWarning');
                if(eModal.length > 0){
                    eModal.dialog({
                        modal: true,
                        width: '600px',
                        buttons: [
                            {
                                text: "<?php echo $this->__('ML_BUTTON_LABEL_ABORT'); ?>",
                                click: function () {
                                    jqml(this).dialog("close");
                                    mlEbayCheckDontShowAgain();
                                    return false;
                                }
                            },
                            {
                                text: "<?php echo $this->__('ML_BUTTON_LABEL_OK'); ?>",
                                click: function () {
                                    jqml(this).dialog("close");
                                    mlEbayCheckDontShowAgain();
                                    addItems(btn);
                                    return false;
                                }
                            }
                        ]
                    });
                }else{
                    addItems(btn);
                }
            }
            jqml('.js-marketplace-upload').on("click forceClick", function (event) {
                var btn = this;
                var form = jqml(this.form);
                if (form.find('[value="checkinPurge"]').length > 0 && event.type === 'click') {
                    var eModal = jqml("#js-ml-modal-uploadConfirmPurge");
                    eModal.dialog({
                        modal: true,
                        width: '600px',
                        buttons: [
                            {
                                text: "<?php echo $this->__('ML_BUTTON_LABEL_ABORT'); ?>",
                                click: function () {
                                    jqml(this).dialog("close");
                                    return false;
                                }
                            },
                            {
                                text: "<?php echo $this->__('ML_BUTTON_LABEL_OK'); ?>",
                                click: function () {
                                    jqml(this).dialog("close");
                                    mlEbayUploadShowWarning(btn);
                                    return false;
                                }
                            }
                        ]
                    });
                }else{
                    mlEbayUploadShowWarning(btn);
                }
                
                return false;
            });
        });
    })(jqml);
    /*]]>*/</script>
