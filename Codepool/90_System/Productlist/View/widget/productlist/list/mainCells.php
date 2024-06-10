<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $oList ML_Productlist_Model_ProductList_Abstract */
/* @var $oProduct ML_Shop_Model_Product_Abstract */
if (!class_exists('ML', false))
    throw new Exception();
if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) {
    foreach ($oList->getHead() as $sHead => $aHead) {
        ?>
        <th class="cell-<?php echo $aHead['type']; ?>"><?php
        try {
            $this->includeView('widget_productlist_cell_'.$aHead['type'], array('sHead' => $sHead, 'oList' => $oList, 'oProduct' => $oProduct));
        } catch (ML_Filesystem_Exception $oEx) {
            print_r($aHead['type']);
        }
        ?></th><?php
    }
}
?>