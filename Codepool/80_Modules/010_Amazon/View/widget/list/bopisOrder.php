<?php
/* @var $this  ML_Amazon_Controller_Amazon_ShippingLabel_Upload_Summary */
 if (!class_exists('ML', false))
     throw new Exception();
//        new dBug($aStatistic);
//        new dBug($oList->getHead());
//        new dBug(array('product'=>$oList->getList()->current(),'data'=>$oList->getList()->current()->mixedData()));
$aStatistic = isset($aStatistic) ? $aStatistic : array();
?>
<div class="ml-plist <?php echo MLModule::gi()->getMarketPlaceName(); ?>">
    <table class="fullWidth nospacing nopadding valigntop topControls"><tbody><tr>
                <td class="actionLeft">
                    <?php
                    if ($this->isSelectable()) {
                        $this->includeView('widget_list_order_action_selection', array('oList' => $oList, 'aStatistic' => $aStatistic));
                    }
                    ?>
                </td>
                <td>
                    <table class="nospacing nopadding right"><tbody><tr>
                                <td class="filterRight">
                                    <div class="filterWrapper">
                                        <?php
                                        if($oList->getFilters() != array()){
                                            $this->includeView('widget_list_order_filter', get_defined_vars());
                                        }
                                        ?>
                                    </div>
                                </td>
                            </tr></tbody></table>
                </td>
            </tr></tbody></table>
    <div class="clear"></div>
    <div class="pagination_bar">
        <?php
        if ($this->showPagination()) {
            $this->includeView('widget_list_order_pagination', get_defined_vars());
        }
        ?>
    </div>
    <?php
    $this->includeView('widget_list_order_bopisList', get_defined_vars());
    ?>
    <div class="pagination_bar">
        <?php
        if ($this->showPagination()) {
            $this->includeView('widget_list_order_pagination', get_defined_vars());
        }
        ?>
    </div>
    <?php
    $this->includeView('widget_list_order_action_bopisBottom', array('oList' => $oList, 'aStatistic' => $aStatistic))
    ;
    MLSettingRegistry::gi()->addJs('magnalister.productlist.js');
    MLSetting::gi()->add('aCss', array('magnalister.productlist.css?%s'), true);
    MLSetting::gi()->add('aCss', array('magnalister.amazon.shippinglabel.css?%s'), true);
    ?>
</div>

<script type="text/javascript">/*<![CDATA[*/
    jqml(document).ready(function() {
        jqml('#selectAll').click(function() {
            state = jqml(this).attr('checked') !== undefined;
            jqml('.js-mlFilter-activeRowCheckBox').each(function() {
                jqml(this).attr('checked', state);
            });
        });
    });
    /*]]>*/</script>