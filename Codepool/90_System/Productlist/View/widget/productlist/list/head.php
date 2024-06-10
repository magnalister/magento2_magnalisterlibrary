<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $aStatistic array */
if (!class_exists('ML', false))
    throw new Exception();
?>
<?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) { ?>
    <thead>
    <tr>
        <th></th>
        <?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Selection) { ?>
            <th></th>
        <?php } ?>
        <?php foreach ($oList->getHead() as $aHead) { ?>
            <th class="ml-plist-cell-<?php echo $aHead['type'] ?>">
                <div class="plist-th">
                    <div>
                        <?php echo $aHead['title'] ?>
                    </div>
                    <div style="min-width: 42px;">
                        <?php if (isset($aHead['order']) && $aHead['order'] != '') { ?>
                            <?php foreach (array('asc', 'desc') as $sSort) { ?>
                                <form action="<?php echo $this->getCurrentUrl() ?>" method="post">
                                    <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                                        <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
                                    <?php } ?>
                                    <?php foreach ($oList->getFilters() as $sFilterName => $mFilter) {
                                        /** @deprecated array | productlist-depenendcies */ ?>
                                        <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('filter['.$sFilterName.']') ?>" value="<?php echo is_object($mFilter) ? $mFilter->getFilterValue() : $mFilter['value'] ?>"/>
                                    <?php } ?>
                                    <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('filter[meta][order]') ?>" value="<?php echo $aHead['order'] ?>_<?php echo $sSort ?>"/>
                                    <input class="noButton ml-right<?php echo ' arrow'.ucfirst($sSort) ?>" type="submit" value="" title="<?php echo $this->__('Productlist_Header_sSort'.ucfirst($sSort)) ?>" <?php echo ($aHead['order'] == $aStatistic['aOrder']['name'] && $sSort == $aStatistic['aOrder']['direction']) ? ' disabled="disabled"' : '' ?> />
                                </form>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </th>
        <?php } ?>
    </tr>
    </thead>
<?php } ?>
