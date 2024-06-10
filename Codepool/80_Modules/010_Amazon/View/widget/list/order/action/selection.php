<?php
/* @var $this  ML_Amazon_Controller_Amazon_ShippingLabel_Orderlist */
/* @var $oList ML_Amazon_Model_List_Amazon_Order */
/* @var $aStatistic array */
 if (!class_exists('ML', false))
     throw new Exception();
?>
<div class="actionTop" style="float:left;">
    <form action="<?php echo $this->getCurrentUrl() ?>" method="post" class="js-mlAllDataFormRows global-ajax" >
        <div>
            <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>" />
            <?php } ?>
            <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('filter[meta][page]') ?>" value="<?php echo $aStatistic['iCurrentPage'] ?>" />
            <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('filter[meta][order]') ?>" value="<?php echo count($aStatistic['aOrder']) == 2 ? implode('_', $aStatistic['aOrder']) : '' ?>" />
            <?php foreach ($oList->getFilters() as $sFilterName => $mFilter) { /** @deprecated array | productlist-depenendcies */ ?>
                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('filter[' . $sFilterName . ']') ?>" value="<?php echo is_object($mFilter) ? $mFilter->getFilterValue() : $mFilter['value'] ?>" />
            <?php } ?>
            <select name="<?php echo MLHttp::gi()->parseFormFieldName('filter[meta][selection]') ?>">
                <?php foreach (MLI18n::gi()->get('Orderlist_Cell_aToMagnalisterSelection', array('count' => $this->getSelectedCount())) as $sKey => $aValue) { ?>
                    <?php if ($sKey == 'selection') { ?>
                        <?php $this->includeView('widget_list_order_action_selection_selectionoption', array('sValue' => $sKey, 'sName' => $aValue['name'])); ?>
                    <?php } elseif (!isset($aValue['values'])) { ?>
                        <option value="<?php echo $sKey ?>" /><?php echo $aValue['name'] ?></option>
                    <?php } else { //$aValue=array ?>
                        <optgroup label="<?php echo $aValue['name'] ?>">
                            <?php foreach ($aValue['values'] as $sGroupKey => $sGroupValue) { ?>
                                <option value="<?php echo $sKey . '_' . $sGroupKey ?>" /><?php echo $sGroupValue ?></option>
                            <?php } ?>
                        </optgroup>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
    </form>
</div>