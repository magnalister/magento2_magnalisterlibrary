<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<?php
/* @var $this  ML_Amazon_Controller_Amazon_ShippingLabel_Orderlist */
/* @var $oList ML_Amazon_Model_List_Amazon_Order */

?>
<select data="<?php echo $aOrder['MPSpecific']['MOrderID'] ?>" class="ml-shippinglabel-quantity ml-shippinglabel-orderid-<?php echo $aOrder['MPSpecific']['MOrderID'] ?>" name="<?php echo MLHttp::gi()->parseFormFieldName('ItemList['.$aOrder['MPSpecific']['MOrderID'].']['.$aProduct['AmazonOrderItemID'].']') ?>">
    <?php for ($i = 0; $i <= $aProduct['Quantity']; $i++) {
        ?>
        <option <?php echo $aProduct['Quantity'] == $i ? 'selected=selected' : '' ?> value=" <?php echo $i; ?>"> <?php echo $i; ?></option> <?php
    }
    ?>
</select>
<?php
?>
<input class="ml-shippinglable-product-weight" name="<?php echo MLHttp::gi()->parseFormFieldName('productweight') ?>" type="hidden" value="<?php echo $aProduct['Weight'] ?>">


