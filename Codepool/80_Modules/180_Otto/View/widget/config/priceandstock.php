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

 if (!class_exists('ML', false))
     throw new Exception();
$sMpId = MLModul::gi()->getMarketPlaceId();
$sMpName = MLModul::gi()->getMarketPlaceName();
?>
<?php if(MLModul::gi()->getConfig('Orders.DontShowWarning') !== '1'){?>
<div id="js-ml-modal-stockWarning" style="display:none;" title="<?php echo MLI18n::gi()->get('ML_OTTO_IMPORTANT_INFORMATION_QUANTITYSYNC_TITLE'); ?>">
    <?php echo MLI18n::gi()->get('ML_OTTO_IMPORTANT_INFORMATION_QUANTITYSYNC_TEXT'); ?>
    <input id="ml-checkbox-dontshowitagain" type="checkbox" value="1"/>
    <label for="ml-checkbox-dontshowitagain" ><?php echo MLI18n::gi()->get('ML_LABEL_DONTSHOWAGAIN') ?></label>
</div>
<?php }?>
<script type="text/javascript">/*<![CDATA[*/
    (function (jqml) {
        jqml(document).ready(function () {
            var eModal = jqml('#js-ml-modal-stockWarning');
            eModal.dialog({
                modal: true,
                width: '600px',
                buttons: [
                    {
                        text: "<?php echo $this->__('ML_BUTTON_LABEL_ABORT'); ?>",
                        click: function () {
                            jqml(this).dialog("close");
                            mlOttoCheckDontShowAgain();
                            return false;
                        }
                    },
                    {
                        text: "<?php echo $this->__('ML_BUTTON_LABEL_OK'); ?>",
                        click: function () {
                            jqml(this).dialog("close");
                            mlOttoCheckDontShowAgain();
                            return false;
                        }
                    }
                ]
            });

            function mlOttoCheckDontShowAgain() {
                if(jqml('#ml-checkbox-dontshowitagain').is(':checked') === true){
                    jqml.ajax({
                            url: '<?php echo $this->getUrl(array('controller' => "{$sMpName}:{$sMpId}_config_priceandstock")); ?>',
                            type: 'GET',
                            data: {'<?php echo MLHttp::gi()->parseFormFieldName('method') ?>':'DontShowWarning'}
                        });
                    jqml('#js-ml-modal-stockWarning').remove();
                }
            }
        });
    })(jqml);
/*]]>*/</script>
