<?php
/* @var $this  ML_Amazon_Controller_Amazon_ShippingLabel_Upload_Orderlist */
/* @var $oList ML_Amazon_Model_List_Amazon_Order */
 if (!class_exists('ML', false))
     throw new Exception();
?>
<tr class="main" data-actionTopForm="<?php echo $this->getRowAction($aOrder); ?>">
    <?php if ($this->isSelectable()) { ?>
    <th class="cell-magnalisterSelectionRow">
        <?php foreach (MLHttp::gi()->getNeededFormFields() as $sName => $sValue) { ?>
            <input type="hidden" name="<?php echo $sName ?>" value="<?php echo $sValue ?>" />
        <?php } ?>
        <input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('method') ?>" value="changeOrderStatus" />
        <input <?php echo $aOrder['isselected'] ? 'checked="checked"' : '' ?> style="  margin: auto;" value="<?php echo $aOrder['AmazonOrderID']."_".$aOrder['AmazonOrderItemID']."_".$aOrder['OrderStatus']."_".$aOrder['Currency']."_".$aOrder['ItemPriceAdj']?>" class="js-mlFilter-activeRowCheckBox" name="<?php echo MLHttp::gi()->parseFormFieldName('method') ?>" title="addToSelection" type="checkbox" />
    </th>
     <?php } ?>
    <?php foreach ($oList->getHead() as $sHead => $aHead) { ?>
        <th class="cell<?php echo isset($aHead['type'])? '-'.$aHead['type']:'' ?>">
            <?php
            if (isset($aHead['type'])) {
                $this->includeView('widget_list_order_cell_amazon_orderlist_' . $aHead['type'], array('aOrder' => $aOrder, 'sHead' => $sHead));
            } else {
                echo $aOrder[$sHead];
            }
            ?>
        </th>
    <?php } ?>
</tr>