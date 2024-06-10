<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<input class="fullwidth<?php echo ((isset($aField['required']) && empty($aField['value'])) ? ' ml-error' : '').(isset($aField['cssclasses']) ? ' '.implode(' ', $aField['cssclasses']) : '') ?>"
       type="text" <?php echo isset($aField['id']) ? "id='{$aField['id']}'" : ''; ?>
       name="<?php echo MLHttp::gi()->parseFormFieldName($aField['name']) ?>"
       placeholder="<?php echo isset($aField['placeholder']) ? $aField['placeholder'] : (!empty($aField['i18n']['placeholder']) ? $aField['i18n']['placeholder'] : ''); ?>"
    <?php echo(isset($aField['value']) && is_scalar($aField['value']) ? 'value="'.htmlspecialchars($aField['value'], ENT_COMPAT).'"' : '') ?>
    <?php echo isset($aField['maxlength']) ? "maxlength='{$aField['maxlength']}'" : ''; ?> />
