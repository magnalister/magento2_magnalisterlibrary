<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<span style="display: block;">
	<input style="width: 115px; margin-right: 5px;" class="<?php echo(isset($aField['cssclasses']) ? ' '.implode(' ', $aField['cssclasses']) : '') ?>"
           type="text" <?php echo isset($aField['id']) ? "id='{$aField['id']}'" : ''; ?>
		name="<?php echo MLHttp::gi()->parseFormFieldName($aField['name']) ?>"
		<?php if (isset($aField['enabled']) === true && $aField['enabled'] === false) {
            echo 'disabled';
        } ?>
        <?php echo(isset($aField['value']) ? 'value="'.htmlspecialchars($aField['value'], ENT_COMPAT).'"' : '') ?> />
	<label><?= $aField['currency'] ?></label>
</span>