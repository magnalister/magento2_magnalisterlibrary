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
/* @var $this ML_Core_Controller_Abstract */
?>

</select>
<table class="attributesTable">
    <tr>
        <td style="width:90%;border:none;"><?php
            $aSelect = array(
                'name' => $aField['name'],
                'i18n' => array(),
                'type' => 'select',
                'values' => array(10 => '10', 20 => '20', 30 => '30', 40 => '40', 50 => '50', 60 => '60', 70 => '70', 80 => '80', 90 => '90', 100 => '100', 0 => 'Alle',),
                'value' => $aField['value']
            );
            $this->includeType($aSelect);
            ?></td>
        <!--        <td style="border:none;">-->
        <!--            <button class="mlbtn ml-js-topten-btn" type="button" data-ml-topten="#modal-topten">-->
        <!--                --><?php //echo MLI18n::gi()->get('ML_TOPTEN_MANAGE'); ?>
        <!--            </button>-->
        <!--        </td>-->
    </tr>
</table>
<?php
$sType = isset($aSubField)?$aSubField['cattype']:null;
ob_start();
?>
<div class="ml-modal" id="modal-topten"
     title="<?php echo MLI18n::gi()->get('ML_MODULE_' . strtoupper(MLModule::gi()->getMarketPlaceName())) . ' ' . $this->__(ML_TOPTEN_MANAGE_HEAD) ?>"></div>
<span class="ml-js-ui-dialog-titlebar-additional">
    <a class="ui-icon ui-corner-all ui-state-focus global-ajax ui-icon-arrowrefresh-wrap ml-js-noBlockUi"
       href="<?php echo MLHttp::gi()->getUrl(array('mp' => MLModule::gi()->getMarketPlaceId(), 'controller' => 'do_categories', 'method' => 'getChildCategories', 'parentid' => 0, 'type' => $sType)); ?>">
        <span class="ui-icon ui-icon-arrowrefresh-1-n">reload</span>
    </a>
</span>
<div class="ml-topten-content"></div> 
</div>
<?php
$sModal = ob_get_contents();
ob_end_clean();
MLSetting::gi()->add('aModals', $sModal);
?>
<script type="text/javascript">//<![CDATA[
    (function ($) {
        $(document).ready(function () {
            $('.ml-js-topten-btn').click(function () {
                createTopTen();
            });
        });
        function createTopTen() {
            var eDialog = jqml('<div class="dialog2" title="<?php echo MLModule::gi()->getMarketPlaceName() . ' ' . $this->__(ML_TOPTEN_MANAGE_HEAD) ?>"></div>');
            eDialog.bind('ml-init', function (event, argument) {//behavior
                $(this).find('.successBox').each(function () {
                    $(this).fadeOut(5000);
                });
                $(this).find('button').button({'disabled': false});
                $('.ui-widget-overlay').css({zIndex: 1001, cursor: 'auto'});
            });
            eDialog.bind('ml-load', function (event, argument) {//behavior
                $('.ui-widget-overlay').css({zIndex: 99999, cursor: 'wait'});
            });
            $("body").append(eDialog);
            eDialog.jDialog({
                buttons: {},
                position: {my: "center center", at: "center top+80", of: window},
                close: function (event, ui) {
                    eDialog.remove();
                }
            });
            eDialog.trigger('ml-load');
            $.ajax({
                method: 'get',
                url: '<?php echo $this->getCurrentUrl(array_merge(MLHttp::gi()->getNeededFormFields(), array('what' => 'topTenConfig', 'kind' => 'ajax', 'ajax' => 'true'))) ?>',
                success: function (data) {
                    //tabs
                    var eData = $(data);
                    var eTabs = $(eData).find('.ml-tabs').andSelf();
                    eTabs.tabs({
                        beforeLoad: function (event, ui) {
                            if ($.trim(ui.panel.html()) == '') {//have no content
                                eDialog.trigger('ml-load');
                                return true;
                            } else {
                                return false;
                            }
                        },
                        load: function (event, ui) {
                            eDialog.trigger('ml-init');
                            return true;
                        }
                    });
                    eDialog.html(eData);
                    $(eDialog).on('submit', 'form', function () {
                        var eForm = $(this);
                        $(eData).find('button').button('option', 'disabled', true);
                        eDialog.trigger('ml-load');
                        $.ajax({
                            type: this.method,
                            url: this.action,
                            data: $(this).serialize(),
                            success: function (data) {
                                if (eForm.attr('id') == 'ml-config-topTen-init-submit') {//clean all other loaded tabs, top ten have changed
                                    eTabs.find('[role=tabpanel][aria-hidden=true]').html('');
                                }
                                $(eForm).parents('[role=tabpanel]').html(data);//fill curent tab
                                eDialog.trigger('ml-init');
                            }
                        });
                        return false;
                    });
                }
            });
        }
    })(jqml);

//]]></script>