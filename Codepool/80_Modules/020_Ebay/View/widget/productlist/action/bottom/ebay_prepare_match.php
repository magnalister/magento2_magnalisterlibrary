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
                                    <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('view') ?>" value="resetvalues" />
                                    <a style="padding-left: 0; padding-right: 0;" class="mlbtn ml-js-noBlockUi" id="ml-ebay-prepare-reset-control"><?php echo $this->__('Ebay_Productlist_Matching_sResetValuesButton'); ?></a>
                                    <?php $aResetI18n = $this->__('Ebay_Productlist_Matching_aResetValues'); ?>
                                    <div id="ml-ebay-prepare-reset-content" title="<?php echo $this->__('Ebay_Productlist_Matching_sResetValuesButton'); ?>" class="ml-modal dialog2"> 
                                        <form action="<?php echo $this->getCurrentUrl() ?>" method="post">
                                            <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                                                <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>" />
                                            <?php } ?>
                                            <label><input name="<?php echo MLHttp::gi()->parseFormFieldName('view[]') ?>" value="reset_matching" type="checkbox" />&nbsp;<?php echo $aResetI18n['checkboxes']['matching']; ?></label><br />
                                            <label><input id="ml-ebay-prepare-reset-complete" name="<?php echo MLHttp::gi()->parseFormFieldName('view') ?>" value="unprepare" type="checkbox" />&nbsp;<?php echo $aResetI18n['checkboxes']['unprepare']; ?></label><br />
                                        </form>
                                    </div>
                                    <script type="text/javascript">//<![CDATA[
                                        (function ($) {
                                            jqml(document).ready(function () {
                                                jqml("#ml-ebay-prepare-reset-complete").change(function () {
                                                    if (jqml(this).prop('checked')) {
                                                        jqml(this).parent().siblings().find('input[type="checkbox"]').not(jqml(this)).attr('disabled', 'disabled');
                                                    } else {
                                                        jqml(this).parent().siblings().find('input[type="checkbox"]').not(jqml(this)).removeAttr('disabled');
                                                    }
                                                });
                                                jqml("#ml-ebay-prepare-reset-control").click(function () {
                                                    var eModal = jqml("#ml-ebay-prepare-reset-content");
                                                    eModal.dialog({
                                                        modal: true,
                                                        width: '600px',
                                                        buttons: [
                                                            {
                                                                text: "<?php echo $aResetI18n['buttons']['abort']; ?>",
                                                                click: function () {
                                                                    jqml(this).dialog("close");
                                                                    return false;
                                                                }
                                                            },
                                                            {
                                                                text: "<?php echo $aResetI18n['buttons']['ok']; ?>",
                                                                click: function () {
                                                                    $.blockUI(blockUILoading);
                                                                    jqml(this).find('form')[0].submit();
                                                                    jqml(this).dialog("close");
                                                                    return false;
                                                                }
                                                            }
                                                        ]
                                                    });
                                                });
                                            });
                                        })(jqml);
                                    //]]></script>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </td>
                    <td>
                        <div class="actionBottom">
                            <div class="right">
                                <a class="mlbtn action" href="<?php echo $this->getUrl(array('controller' => $this->getRequest('controller') . '_manual')); ?>">
                                    <?php echo $this->__('ML_AMAZON_LABEL_MANUAL_MATCHING') ?>
                                </a>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
<?php } ?>
