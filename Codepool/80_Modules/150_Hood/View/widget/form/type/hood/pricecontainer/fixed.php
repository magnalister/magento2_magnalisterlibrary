<?php
 if (!class_exists('ML', false))
     throw new Exception();
?>
<th><?php echo $this->__('ML_HOOD_YOUR_CHINESE_PRICE'); ?> :</th>
<td class="input">
    <?php $this->includeType($this->getSubField($aField)); ?>
</td>