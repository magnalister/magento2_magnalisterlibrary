<?php
if (!class_exists('ML', false))
    throw new Exception();
MLSetting::gi()->set('blFormDatepickerLoaded', true, true);
MLSettingRegistry::gi()->addJs(array(
    'jquery-ui-timepicker-addon.js',
    'jquery.magnalister.form.datepicker.js'
));
?>
<div class="datepicker">
    <input type="text" id="<?php echo $aField['id']; ?>" name="<?php echo MLHttp::gi()->parseFormFieldName($aField['name']) ?>" value="<?php echo $aField['value'] ?>" <?php echo((isset($aField['required']) && empty($aField['value'])) ? ' class="ml-error"' : ''); ?> />
    <span class="gfxbutton small delete "></span>
</div>
