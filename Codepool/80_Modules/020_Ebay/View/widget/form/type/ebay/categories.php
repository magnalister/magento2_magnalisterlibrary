<?php
 if (!class_exists('ML', false))
     throw new Exception();
if (MLHttp::gi()->isAjax()) {
    MLSetting::gi()->add('aAjaxPlugin', array('content' => $aField['ebay_categories']['oCategory']->renderAjax()));
} else {
    ?>
    <div class="ebayCatVisual" id="<?php echo $aField['id'] ?>_visual">
        <?php $this->includeType($this->getSubField($aField)) ?>
    </div>
    <?php
    if (isset($aField['ebay_categories']['oCategory'])) {
        echo $aField['ebay_categories']['oCategory']->renderView();
    }
}
?>