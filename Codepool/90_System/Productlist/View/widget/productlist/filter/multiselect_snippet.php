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
            <?php
            foreach ($aFilter['values'] as $aValue) {
                $filterName = MLHttp::gi()->parseFormFieldName('filter[' . $aFilter['name'] . '][' . $aValue['value'] . ']');
                $filterID = str_replace(array('[', ']'), array('_', ''), $filterName);
                $value = isset($aFilter['value']) ? $aFilter['value'] : null;
                ?>
                <input name="<?php echo $filterName ?>" id="<?php echo $filterID ?>" type="checkbox"
                       value="<?php echo $aValue['value'] ?>"<?php echo in_array($aValue['value'], $value) ? ' checked="checked"' : '' ?>>
                <label for="<?php echo $filterID ?>"><?php echo $aValue['label'] ?></label><br>

            <?php } ?>
            <label style="color:#ffffff; float: left; line-height: 0"><?php echo $Label ?></label>
            <!-- that is only to keep container in same size at least as title of box-->
        </div>
    </div>
<?php } ?>
