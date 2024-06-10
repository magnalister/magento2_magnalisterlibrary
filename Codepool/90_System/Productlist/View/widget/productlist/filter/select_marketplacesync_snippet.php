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

/**
 * @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract
 * @var $aFilter array array('name'=>'', 'value'=>'', 'values'=>array('value'=>'','label'=>'translatedText'), 'placeholder'=>'')
 */
if (!class_exists('ML', false))
    throw new Exception();
?>
<?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) { ?>

    <?php
    $oProgress =
        MLController::gi('widget_progressbar')
            ->setId('marketplacesyncfilter')
            ->setTotal(isset($aAjaxData['Total']) ? $aAjaxData['Total'] : 100)
            ->setDone(isset($aAjaxData['Done']) ? $aAjaxData['Done'] : 0)
            ->render();
    ?>

    <select name="<?php echo MLHttp::gi()->parseFormFieldName('filter['.$aFilter['name'].']') ?>">
        <?php foreach ($aFilter['values'] as $aValue) { ?>
            <option <?php echo($aValue['steps'] == '' ? '' : 'data-ml-modal="#'.$oProgress->getId().'" data-marketplacefilter-steps="'.$aValue['steps'].'" '); ?>value="<?php echo $aValue['value'] ?>"<?php echo $aFilter['value'] === $aValue['value'] && empty($aValue['steps']) ? ' selected="selected"' : '' ?>><?php echo $aValue['label'] ?></option>
        <?php } ?>
    </select>
    <script type="text/javascript">
        function checkExpiredSteps(self) {
            if (typeof self.data('marketplacefilter-steps') === "undefined") {
                return true;
            } else {
                jqml.ajax({
                    url: "<?php echo $this->getCurrentURl(array('ajax' => 'true', 'method' => 'dependency', 'dependency' => 'marketplacesyncfilter')) ?>",
                    data: {
                        'ml[marketplacesyncfilter]': self.data('marketplacefilter-steps')
                    },
                    ml: {
                        triggerAfterSuccess: function () {
                            self.parentsUntil('form').parent().trigger('submit');
                        }
                    }
                });
                return false;
            }
        }

        /*<![CDATA[*/
        (function ($) {
            $(document).ready(function () {
                const select = $('form [name="<?php echo MLHttp::gi()->parseFormFieldName('filter['.$aFilter['name'].']') ?>"]');
                select.change(function (event) {
                    var self = $(this).find('option:selected');
                    return checkExpiredSteps(self);
                });
                <?php foreach ($aFilter['values'] as $aValue) { ?>
                <?php if($aFilter['value'] === $aValue['value'] && $aValue['value'] !== 'all' && !empty($aValue['steps'])){?>
                //select.val("<?php //echo $aValue['value'];?>//").change();
                <?php } ?>
                <?php }?>
                // checkExpiredSteps(select.find('option:selected'));
            });
        })(jqml);
        /*]]>*/
    </script>
<?php }?>