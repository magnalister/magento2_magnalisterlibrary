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
?>
<table class="attributesTable">
    <?php foreach ($aField['subfields'] as $aSubField){ ?>
        <?php $aSubField['type'] = 'select'; ?>
        <tr>
            <td style="width:95%; border:none;"><?php $this->includeType($aSubField); ?></td>
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
        <div class="ml-modal" id="modal-<?php echo $aSubField['id']; ?>" title="Kategorie-Auswahl">
            <?php if (isset($aSubField['i18n']['catinfo'])) { ?>
            <div class="successBoxBlue"><?php echo $aSubField['i18n']['catinfo'] ?></div>
            <?php } ?>
            <span class="ml-js-ui-dialog-titlebar-additional">
                <span class="last-sync-category">Data synchronized: <br>
                    <span class='last-category-import-date'></span>
                </span>
                <a title="<?php echo MLI18n::gi()->get('ML_OTTO_IMPORT_CATEGORIES') ?>" id="importCategories" class="ui-icon ui-corner-all ui-state-focus global-ajax ui-icon-arrowrefresh-wrap ml-js-noBlockUi" href="<?php echo MLHttp::gi()->getUrl(array('mpid' => MLModul::gi()->getMarketPlaceId(), 'do' => 'ImportCategories')); ?>">
                    <span class="ui-icon ui-icon-arrowrefresh-1-n">reload</span>
                </a>
            </span>
            <?php $this->includeView('do_categories_childcategories', array('aFilter' => array('sParentId' => 0, 'sType' => $sType, 'sSearchId' => isset($aSubField['value']) ? $aSubField['value'] : '', 'name' => '', 'value' => ''))); ?>
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

        $lastImportTime = '-';
        $tableName = 'magnalister_'.MLModul::gi()->getMarketPlaceName().'_categories_marketplace';
        $sql = "SELECT ImportOrUpdateTime FROM $tableName ORDER BY ImportOrUpdateTime DESC LIMIT 1";

        $result = MLDatabase::getDbInstance()->fetchRow($sql);

        if ($result) {
            if (isset($result['ImportOrUpdateTime'])) {
                $date = new DateTime($result['ImportOrUpdateTime']);
            } else {
                $date = new DateTime('now');
            }
            $lastImportTime = $date->format("F d, Y, H:i a");
        }

        ?>
        <script type="text/javascript">//<![CDATA[
            (function(jqml) {
                function escapeSelector(s){
                    return s.replace( /(:|\.|\[|\])/g, "\\$1" );
                }
                jqml(document).ready(function() {

                    jqml('.last-category-import-date').text("<?php echo $lastImportTime; ?>");

                    jqml('.ml-js-category-btn').click(function() {
                        var element = jqml(this);
                        var eModal = jqml(element.attr("data-ml-catselector"));
                        var eSelect = element.closest("tr").find("select");
                        eModal.jDialog({
                            width : '530px',
                            buttons: [
                                {
                                    "text": "<?php echo MLI18n::gi()->get('ML_BUTTON_LABEL_ABORT'); ?>",
                                    "class": 'mlbtnreset',
                                    "click": function () {
                                        jqml(this).dialog("close");
                                    }
                                }, {
                                    "text": "<?php echo MLI18n::gi()->get('ML_BUTTON_LABEL_OK'); ?>",
                                    "class": 'mlbtnok',
                                    "click": function () {
                                        var select2Value = jqml('#mlfilter').select2('data');
                                        if (eSelect.find("option[value=" + select2Value[0].id + "]").length == 0) {
                                            eSelect.append('<option value="' + select2Value[0].id + '">' + select2Value[0].text + '</option>');
                                        }
                                        eSelect.val(select2Value[0].id).change();
                                        jqml(this).dialog("close");
                                    }
                                }
                            ]
                        });
                        eModal.parents('.ui-dialog').find('.ui-dialog-titlebar').append(eModal.find('.ml-js-ui-dialog-titlebar-additional').addClass('ml-ui-dialog-titlebar-additional'));
                    });

                    //js for loader needs to be added on the new popup
                    jqml('#importCategories').click(function(){
                        var currentA = jqml(this);
                        currentA.magnalisterRecursiveAjax({
                            sOffset:'<?php echo MLHttp::gi()->parseFormFieldName('offset') ?>',
                            sAddParam:'<?php echo MLHttp::gi()->parseFormFieldName('ajax') ?>=true',
                            oI18n:{
                                sProcess    : '<?php echo $this->__s('ML_STATUS_FILTER_SYNC_CONTENT',array('\'')) ?>',
                                sError      : '<?php echo $this->__s('ML_ERROR_LABEL',array('\'')) ?>',
                                sSuccess    : '<?php echo $this->__s('ML_OTTO_IMPORT_CATEGORIES_SUCCESS',array('\'')) ?>'
                            },
                            onFinalize: function(){
                                window.location=window.location;//reload without post
                            },
                            onProgessBarClick:function(data){
                                console.dir({data:data});
                            },
                            blDebug: <?php echo MLSetting::gi()->get('blDebug') ? 'true' : 'false' ?>,
                            sDebugLoopParam: "<?php echo MLHttp::gi()->parseFormFieldName('saveSelection') ?>=true"
                        });
                        return false;
                    });
                });
            })(jqml);
        //]]></script>

<style>
    .last-sync-category {
        color: gray !important;
        font-size: 9px !important;
        line-height: 1.5;
        font-weight: normal;
        left: 0;
        float: left;
        margin-right: 24px;
        padding-top: 0px;
        text-align: right
    }

    .last-category-import-date {
        color: gray !important;
        font-size: 9px !important;
        font-weight: normal;
        left: 0;
        float: left;
        text-align: right;
    }

    .ui-dialog-titlebar {
        padding-bottom: 0.7rem !important;
    }

    .ml-ui-dialog-titlebar-additional {
        padding-right: 0 !important
    }

    .ui-dialog-buttonset {
        margin-top: 10px;
    }

    #ui-id-1 {
        margin-top: 0px;
    }

    #select2-mlfilter-container {
        margin-left: -2px;
    }

/*    .mlbtnreset {
        background-color: #E31A1C !important;
        color: #fff !important;
        border: 1px solid #E31A1C !important;
    }*/

    .mlbtnreset:hover {
        background-color: #666666 !important;
        border-color: #666666 !important;
    }
</style>


<?php } ?>
