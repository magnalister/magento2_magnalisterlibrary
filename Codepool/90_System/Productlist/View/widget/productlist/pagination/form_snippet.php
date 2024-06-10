<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $aStatistic array */
/* @var $iLinkedPage int */
/* @var $sLabel string */
if (!class_exists('ML', false))
    throw new Exception();

$activeButton = ($aStatistic['iCurrentPage'] == $iLinkedPage) | ($sLabel == '...');

?>
<?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) { ?>
    <form action="<?php echo $this->getCurrentUrl() ?>" method="post">
        <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
            <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
        <?php } ?>
        <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('filter[meta][page]') ?>" value="<?php echo $iLinkedPage ?>"/>
        <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('filter[meta][order]') ?>" value="<?php echo count($aStatistic['aOrder']) == 2 ? implode('_', $aStatistic['aOrder']) : '' ?>"/>
        <?php foreach ($oList->getFilters() as $sFilterName => $mFilter) {
            /** @deprecated array | productlist-depenendcies */ ?>
            <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('filter['.$sFilterName.']') ?>" value="<?php echo is_object($mFilter) ? $mFilter->getFilterValue() : $mFilter['value'] ?>"/>
        <?php } ?>
        <input class="ml-pagButton<?php echo $activeButton ? ' ml-active' : ''; ?>" style="" type="submit" value="<?php echo $sLabel ?>"<?php echo $activeButton ? ' disabled="disabled"' : '' ?> />
    </form>
<?php } ?>