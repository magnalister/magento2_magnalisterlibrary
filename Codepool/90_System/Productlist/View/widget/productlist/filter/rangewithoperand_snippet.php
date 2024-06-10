<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $aFilter array array('name'=>'', 'value'=>'', 'values'=>array('value'=>'','label'=>'translatedText'), 'placeholder'=>'') */
if (!class_exists('ML', false))
    throw new Exception();
?>
<?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) {
    $Label = $aFilter['title'];
    ?>
    <div class="ml-plist-filter-container">
        <span style="position: relative; top: -15px; left: -5px; background-color: #ffffff;padding: 0 3px;"><?php echo $Label ?></span>
        <div class="ml-plist-filter-items-container">
            <?php $filterName = MLHttp::gi()->parseFormFieldName('filter[' . $aFilter['name'] . ']'); ?>
            <?php
            $value = isset($aFilter['value']) ? $aFilter['value'] : null;
            $operandValue = isset($value['operand']) ? $value['operand'] : '';
            ?>
            <input type="number" name="<?php echo $filterName . '[number]' ?>"
                   value="<?php echo isset($value['number']) ? $value['number'] : '' ?>"><br>
            <select name="<?php echo $filterName . '[operand]' ?>">
                <?php foreach (array('=', '>', '<') as $operand) { ?>
                    <option <?php echo $operandValue === $operand ? ' selected="selected" ' : '' ?>>  <?php echo $operand; ?> </option>
                <?php } ?>
            </select><br>
            <label style="color:#ffffff; float: left; line-height: 0"><?php echo $Label ?></label>
            <!-- that is only to keep container in same size at least as title of box-->
        </div>
    </div>
<?php } ?>
