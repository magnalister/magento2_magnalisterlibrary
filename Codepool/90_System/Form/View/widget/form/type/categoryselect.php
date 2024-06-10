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
if (!class_exists('ML', false))
    throw new Exception();
?>
<table class="attributesTable">
    <?php foreach ($aField['subfields'] as $aSubField){ ?>
        <?php $aSubField['type'] = 'select'; ?>
        <tr>
            <td style="width:95%;border:none; padding-left: 0px;padding-right: 0px;"><?php $this->includeType($aSubField); ?></td>
            <td style="border:none;">
                <button class="mlbtn ml-js-category-btn" type="button" data-ml-catselector="#modal-<?php echo $aSubField['id']; ?>">
                    <?php echo MLI18n::gi()->get('form_text_choose'); ?>
                </button>
            </td>
        </tr>
    <?php } ?>
</table>

<?php foreach ($aField['subfields'] as $aSubField){ ?>
    <?php
        $sType = $aSubField['cattype'];
        ob_start();
    ?>
        <div class="ml-modal" id="modal-<?php echo $aSubField['id']; ?>" title="<?php echo $aSubField['i18n']['label']; ?>">
            <?php if (isset($aSubField['i18n']['catinfo'])) { ?>
            <div class="successBoxBlue"><?php echo $aSubField['i18n']['catinfo'] ?></div>
            <?php } ?>
            <span class="ml-js-ui-dialog-titlebar-additional">
                <a class="ui-icon ui-corner-all ui-state-focus global-ajax ui-icon-arrowrefresh-wrap ml-js-noBlockUi"
                   href="<?php echo MLHttp::gi()->getUrl(array('mp' => MLModule::gi()->getMarketPlaceId(), 'controller' => 'do_categories', 'method' => 'getChildCategories', 'parentid' => 0, 'type' => $sType)); ?>">
                    <span class="ui-icon ui-icon-arrowrefresh-1-n">reload</span>
                </a>
            </span>
            <?php $this->includeView('do_categories_childcategories', array('sParentId' => 0, 'sType' => $sType, 'sSearchId' => isset($aSubField['value'])? $aSubField['value'] : '')); ?>
        </div>
    <?php
      $sModal = ob_get_contents();
      ob_end_clean();
      MLSetting::gi()->add('aModals', $sModal);
    ?>
<?php } ?>
<?php
    try {
        MLSetting::gi()->get('catSelectorJSInit');
    } catch (Exception $oEx) {
        MLSetting::gi()->set('catSelectorJSInit', true);
        ?>
        <script type="text/javascript">//<![CDATA[
            (function($) {
                function escapeSelector(s){
                    return s.replace( /(:|\.|\[|\])/g, "\\$1" );
                }
                jqml(document).ready(function() {
                    jqml('.ml-js-category-btn').click(function() {
                        var element = jqml(this);
                        var eModal = jqml(element.attr("data-ml-catselector"));
                        var eSelect = element.closest("tr").find("select");
                        eModal.jDialog({
                            width : '75%',
                            buttons: [
                                {
                                    "text": '<?php echo MLI18n::gi()->get('ML_BUTTON_LABEL_ABORT'); ?>',
                                    "class": 'mlbtnreset',
                                    "click": function () {
                                        jqml(this).dialog("close");
                                    }
                                }, {
                                    "text": "<?php echo MLI18n::gi()->get('ML_BUTTON_LABEL_OK'); ?>",
                                    "class": 'mlbtnok',
                                    "click": function () {
                                        var eRadio = eModal.find("input[type=radio]:checked");
                                        if (eSelect.find("option[value=" + escapeSelector(eRadio.val()) + "]").length == 0) {
                                            eSelect.append('<option value="' + eRadio.val() + '">' + eRadio.attr("title") + '</option>');
                                        }
                                        eSelect.val(eRadio.val()).change();
                                        jqml(this).dialog("close");
                                    }
                                }
                            ]
                        });
                        eModal.parents('.ui-dialog').find('.ui-dialog-titlebar').append(eModal.find('.ml-js-ui-dialog-titlebar-additional').addClass('ml-ui-dialog-titlebar-additional'));
                    });
                });
            })(jqml);
        //]]></script>
<?php } ?>