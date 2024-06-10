<?php
if (!class_exists('ML', false))
    throw new Exception();
$sEditor = MLDatabase::factory('config')->set('mpid',0)->set('mkey','general.editor')->get('value');
if($sEditor=='tinyMCE' || $sEditor === null){
    try{
        MLSetting::gi()->get('blFormWysiwigLoaded');
    }catch(Exception $oEx){
        MLSetting::gi()->set('blFormWysiwigLoaded',true);
        MLSettingRegistry::gi()->addJs(array('tiny_mce/tiny_mce.js','jquery.magnalister.form.wysiwyg.js'));
        ?>
            <script type="text/javascript">/*<![CDATA[*/
                <?php echo getTinyMCEDefaultConfigObject(); ?>;
            /*]]>*/</script>
        <?php
    }
}
?><div class="ml-js-noBlockUi"><textarea class="fullwidth tinymce<?php echo ((isset($aField['required']) && empty($aField['value'])) ? ' ml-error' : '').(array_key_exists('cssclasses', $aField) ? ' '.implode(' ', $aField['cssclasses']): ''); ?>" <?php echo isset($aField['maxlength']) ? "maxlength='{$aField['maxlength']}'" : ''; ?> rows="40" id="<?php echo $aField['id']; ?>" name="<?php echo MLHttp::gi()->parseFormFieldName($aField['name']) ?>"><?php echo isset($aField['value']) ? $aField['value'] : '' ?></textarea></div>
<?php if(isset($aField['resetdefault'])){?>
            <input class="ml-js-field-resetdefault" id="<?php echo $aField['id']; ?>_resetdefault" type="hidden" value="<?php echo $aField['resetdefault']; ?>">
<?php }?>            
