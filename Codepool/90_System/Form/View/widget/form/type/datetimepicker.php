<?php
if (!class_exists('ML', false))
    throw new Exception();
MLSetting::gi()->set('blFormDatepickerLoaded', true, true);
MLSettingRegistry::gi()->addJs(array(
    'jquery-ui-timepicker-addon.js',
    'jquery.magnalister.form.datepicker.js'
));
?>
<div class="datetimepicker">
    <input type="text" id="<?php echo $aField['id']; ?>" name="<?php echo MLHttp::gi()->parseFormFieldName($aField['name']) ?>" value="<?php echo $aField['value'] ?>"/>
    <span class="gfxbutton small delete "></span>
</div>