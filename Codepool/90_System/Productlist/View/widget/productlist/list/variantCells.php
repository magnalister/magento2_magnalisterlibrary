<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $oProduct ML_Shop_Model_Product_Abstract */
if (!class_exists('ML', false))
    throw new Exception();
if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) {
    foreach ($oList->getHead() as $sHead => $aHead) {
        if (
            isset($aHead['type_variant'])
            && $aHead['type_variant'] != ''
            ||
            !isset($aHead['type_variant'])
        ) {
            ?>
            <td class="cell-<?php echo(isset($aHead['type_variant']) ? $aHead['type_variant'] : $aHead['type']); ?>"<?php echo (isset($aHead['width_variant'])) ? ' colspan="'.$aHead['width_variant'].'"' : ''; ?>><?php
            $this->includeView(
                array(
                    'widget_productlist_cell_variant_'.(isset($aHead['type_variant']) ? $aHead['type_variant'] : $aHead['type']),
                    'widget_productlist_cell_'.$aHead['type']
                ),
                array('sHead' => $sHead, 'oList' => $oList, 'oProduct' => $oProduct)
            );
            ?></td><?php
        }
    }
}
?>