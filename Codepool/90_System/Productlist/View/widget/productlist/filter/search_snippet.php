<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $aFilter array array('name'=>'', 'value'=>'', 'values'=>array('value'=>'','label'=>'translatedText'), 'placeholder'=>'') */
if (!class_exists('ML', false))
    throw new Exception();
?>
<?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) { ?>
    <div class="newSearch">
        <input type="text" name="<?php echo MLHttp::gi()->parseFormFieldName('filter['.$aFilter['name'].']') ?>" value="<?php echo $aFilter['value'] ?>" placeholder="<?php echo $this->__($aFilter['placeholder']); ?>"/>
        <button class="mlbtn mlbtn-search action" type="submit">
            <span></span>
        </button>
    </div>
<?php } ?>
