<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $aStatistic array */
if (!class_exists('ML', false))
    throw new Exception();
?>
<?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) { ?>
    <div class="actionBottom">
        <form action="<?php echo $this->getCurrentUrl() ?>" method="post" class="js-mlAllFormRows" id="js-send">
            <div id="additionalParams">
                <?php $this->includeView('cdiscount_prepare_match_forminputs', get_defined_vars()); ?>
            </div>
            <table class="actions">
                <tbody class="firstChild">
                <tr>
                    <td>
                        <div class="left">
                            <a class="mlbtn" href="<?php $this->getParentUrl() ?>"><?php echo $this->__('ML_BUTTON_LABEL_BACK') ?></a>
                        </div>
                        <div class="right">
                            <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
                                <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>"/>
                            <?php } ?>
                            <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('filter[meta][page]') ?>" value="<?php echo $aStatistic['iCurrentPage'] ?>"/>
                            <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('filter[meta][order]') ?>" value="<?php echo count($aStatistic['aOrder']) == 2 ? implode('_', $aStatistic['aOrder']) : '' ?>"/>
                            <?php foreach ($oList->getFilters() as $aFilter) { ?>
                                <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('filter['.$aFilter['name'].']') ?>" value="<?php echo $aFilter['value'] ?>"/>
                            <?php } ?>
                            <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('filter[meta][selectionname]') ?>" value="match"/>
                            <input class="mlbtn action" type="submit" value="<?= $currentPage == $totalPages ? $this->__('ML_BUTTON_LABEL_SAVE_DATA') : $this->__('ML_BUTTON_LABEL_SAVE_AND_NEXT') ?>"/>
                        </div>
                        <div class="clear"></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<?php }?>