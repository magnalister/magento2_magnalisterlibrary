<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $oProduct ML_Shop_Model_Product_Abstract */
if (!class_exists('ML', false))
    throw new Exception();
if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract && $oProduct->exists()) {
    $sError = $this->includeViewBuffered('widget_productlist_list_articleerror', array('oProduct' => $oProduct));
    $sProduct = $this->includeViewBuffered('widget_productlist_list_variantcells', array('oProduct' => $oProduct, 'oList' => $oList));
    ?>
    <tr class="child" data-actionTopForm="<?php echo $this->getRowAction($oProduct); ?>">
        <td></td>
        <?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Selection) { ?>
            <td class="cell-magnalisterSelectionRow">
                <?php
                if (count(MLMessage::gi()->getObjectMessages($oProduct)) == 0) {
                    foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) {
                        ?><input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>" /><?php
                    }
                    ?>
                    <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('method'); ?>" value="deleteFromSelection"/>
                    <input <?php echo($this->productSelectable($oProduct, true) ? '' : 'style="display:none" '); ?>title="<?php echo $oProduct->get('id') ?>" class="js-mlFilter-activeRowCheckBox" name="<?php echo MLHttp::gi()->parseFormFieldName('method'); ?>" value="addToSelection" type="checkbox"<?php echo $oList->isSelected($oProduct) ? ' checked="checked"' : ''; ?> />
                    <?php
                }
                ?>
            </td>
        <?php }
        echo $sProduct; ?>
    </tr>
    <?php
}
?>

