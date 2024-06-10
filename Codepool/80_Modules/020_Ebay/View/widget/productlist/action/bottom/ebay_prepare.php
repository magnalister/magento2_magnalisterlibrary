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
    <div class="ml-container-action-head">
        <h4>
            <?php echo $this->__('ML_LABEL_ACTIONS') ?>
        </h4>
    </div>
    <div class="ml-container-action">
        <div class="ml-container-inner ml-container-wd">
            <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('view') ?>" value="resetvalues" />
            <a style="padding-left: 0; padding-right: 0;" class="mlbtn-gray ml-js-noBlockUi" id="ml-ebay-prepare-reset-control"><?php echo $this->__('Ebay_Productlist_Prepare_sResetValuesButton'); ?></a>
            <?php $aResetI18n = $this->__('Ebay_Productlist_Prepare_aResetValues'); ?>
            <div id="ml-ebay-prepare-reset-content" title="<?php echo $this->__('Ebay_Productlist_Prepare_sResetValuesButton'); ?>" class="ml-modal dialog2">
                <form action="<?php echo $this->getCurrentUrl() ?>" method="post">
                    <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                        <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>" />
                    <?php } ?>
                    <label><input name="<?php echo MLHttp::gi()->parseFormFieldName('view[]') ?>" value="reset_title" type="checkbox" />&nbsp;<?php echo $aResetI18n['checkboxes']['title']; ?></label><br />
                    <label><input name="<?php echo MLHttp::gi()->parseFormFieldName('view[]') ?>" value="reset_subtitle" type="checkbox" />&nbsp;<?php echo $aResetI18n['checkboxes']['subtitle']; ?></label><br />
                    <label><input name="<?php echo MLHttp::gi()->parseFormFieldName('view[]') ?>" value="reset_description" type="checkbox" />&nbsp;<?php echo $aResetI18n['checkboxes']['description']; ?></label><br />
                    <label><input name="<?php echo MLHttp::gi()->parseFormFieldName('view[]') ?>" value="reset_pictures" type="checkbox" />&nbsp;<?php echo $aResetI18n['checkboxes']['pictures']; ?></label><br />
                    <label><input name="<?php echo MLHttp::gi()->parseFormFieldName('view[]') ?>" value="reset_strikeprices" type="checkbox" />&nbsp;<?php echo $aResetI18n['checkboxes']['strikeprices']; ?></label><br />
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
        <div class="ml-container-inner ml-container-sm">
            <a class="mlbtn-red action" href="<?php echo $this->getUrl(array('controller' => $this->getRequest('controller') . '_form')); ?>">
                <?php echo $this->__('ML_EBAY_LABEL_PREPARE') ?>
            </a>
        </div>
    </div>
    <div class="spacer"></div>
<?php } ?>

<?php

if ((int)(MLDatabase::factory('ebay_categories')->getList()->getQueryObject()->getCount()) === 0) { ?>

    <a style="visibility: hidden"
       class="ui-icon ui-corner-all ui-state-focus global-ajax ui-icon-arrowrefresh-wrap ml-js-noBlockUi"
       id="importCategories" title="<?php echo MLI18n::gi()->get('ML_EBAY_IMPORT_CATEGORIES') ?>"
       href="<?php echo MLHttp::gi()->getUrl(array('mpid' => MLModule::gi()->getMarketPlaceId(), 'do' => 'ImportCategories')); ?>">
        <span class="ui-icon ui-icon-arrowrefresh-1-n">reload</span>
    </a>
    <script>
        jqml(document).ready(function () {
            var currentA = jqml('#importCategories');
            currentA.magnalisterRecursiveAjax({
                sOffset: '<?php echo MLHttp::gi()->parseFormFieldName('offset') ?>',
                sAddParam: '<?php echo MLHttp::gi()->parseFormFieldName('ajax') ?>=true',
                oI18n: {
                    sProcess: '<?php echo $this->__s('ML_STATUS_FILTER_SYNC_CONTENT', array('\'')) ?>',
                    sError: '<?php echo $this->__s('ML_ERROR_LABEL', array('\'')) ?>',
                    sSuccess: '<?php echo $this->__s('ML_OTTO_IMPORT_CATEGORIES_SUCCESS', array('\'')) ?>'
                },
                onFinalize: function () {
                    window.location = window.location;//reload without post
                },
                onProgessBarClick: function (data) {
                    console.dir({data: data});
                },
                blDebug: <?php echo MLSetting::gi()->get('blDebug') ? 'true' : 'false' ?>,
                sDebugLoopParam: "<?php echo MLHttp::gi()->parseFormFieldName('saveSelection') ?>=true"
            });
        });
    </script>
<?php } ?>
