<?php
/* @var $this  ML_Amazon_Controller_Amazon_ShippingLabel_Orderlist */
/* @var $oList ML_Amazon_Model_List_Amazon_Order */
/* @var $aStatistic array */
 if (!class_exists('ML', false))
     throw new Exception();
?>
<thead>
    <tr>
        <?php if($this->isSelectable()) { ?>
            <th style="width: 20px;">
                <?php if(method_exists($this,'isBopis') && $this->isBopis()) { ?>
                    <div class="nowrap" style="display: flex; align-items: center">
                        <input type="checkbox" id="selectAll"/>
                        <label for="selectAll"><?php echo $this->__('ML_LABEL_CHOICE') ?>
                        </label>
                    </div>
                <?php } ?>
            </th>
        <?php } ?>
        <?php foreach ($oList->getHead() as $aHead) { ?>
            <th class="ml-plist-cell<?php echo isset($aHead['type'])? '-'.$aHead['type']:'' ?>">
                <div class="plist-th">
                    <div>
                        <?php echo str_replace(' ', '&nbsp', htmlentities($aHead['title'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401, 'UTF-8')); ?>
                    </div>
                    <div style="min-width: 42px">
                        <?php if (isset($aHead['order']) && $aHead['order'] != '') { ?>
                            <?php foreach (array('asc', 'desc') as $sSort) { ?>
                                    <form action="<?php echo $this->getCurrentUrl() ?>" method="post">
                                        <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                                            <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
                                        <?php } ?>
                                        <?php
                                        foreach ($oList->getFilters() as $sFilterName => $mFilter) {
                                            /** @deprecated array | productlist-depenendcies */ ?>
                                            <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('filter['.$sFilterName.']') ?>" value="<?php echo is_object($mFilter) ? $mFilter->getFilterValue() : $mFilter['value'] ?>"/>
                                        <?php } ?>
                                        <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('filter[meta][order]') ?>" value="<?php echo $aHead['order'] ?>_<?php echo $sSort ?>"/>
                                        <input class="noButton ml-right<?php echo ' arrow'.ucfirst($sSort) ?>" type="submit" value="" title="<?php echo $this->__('Productlist_Header_sSort'.ucfirst($sSort)) ?>" <?php echo (isset($aStatistic['aOrder']['name']) && $aHead['order'] == $aStatistic['aOrder']['name'] && $sSort == $aStatistic['aOrder']['direction']) ? ' disabled="disabled"' : '' ?> />
                                    </form>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </th>
        <?php } ?>
    </tr>
</thead>
