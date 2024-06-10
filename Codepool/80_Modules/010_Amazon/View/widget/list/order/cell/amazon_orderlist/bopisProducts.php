<?php
/* @var $this  ML_Amazon_Controller_Amazon_ShippingLabel_Orderlist */
/* @var $oList ML_Amazon_Model_List_Amazon_Order */
 if (!class_exists('ML', false))
     throw new Exception();

if (isset($aOrder['Products'])) {
    $productsList = explode(',', $aOrder['Products']);
    foreach($productsList as $i => $product) {
        if($i < 1) {
            $aOrder['Products'] = '- <span style="text-decoration: underline">'.$product.'</span>';
        } else {
            $aOrder['Products'] .= ' <br> - <span style="text-decoration: underline">'.$product.'</span>';
        }
    }
}
$items = json_decode($aOrder['ItemList'], true);

?>
<div class="ml-hidden-detail">
<span> <?php echo $aOrder['Products'] ?></span>
<div class="tooltip">
    <?php
    foreach ($items as $aItem) {
        echo $aItem['quantity'] . ' x ' . $aItem['name'] . '<br>';
    }
    ?>
</div>
</div>
