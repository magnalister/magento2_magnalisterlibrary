<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<span style="display:table-cell;"><?php echo $this->__('ML_EBAY_PRICE_CALCULATED') ?></span>
<span style="display:table-cell;padding-right:1em;">:</span>
<span style="display:table-cell;">
	<input type="hidden"
           name="<?php echo MLHttp::gi()->parseFormFieldName($aField['name']) ?>"
        <?php echo isset($aField['id']) ? "id='{$aField['id']}'" : ''; ?>
        <?php echo(isset($aField['value']) ? 'value="'.htmlspecialchars($aField['value'], ENT_COMPAT).'"' : '') ?> />
        <?php echo(isset($aField['value']) ? htmlspecialchars($aField['value'], ENT_COMPAT) : '') ?>
    <?php echo $aField['currency'] ?>
</span>
<script type="text/javascript">
    (function ($) {
        $(document).ready(function () {
            <?php if ((isset($aField['issingleview'])) && ($aField['issingleview'] === false)) : ?>
            $('#cdiscount_prepare_apply_form_fieldset_details').hide();
            $('#cdiscount_prepare_apply_form_field_price').closest('.js-field').hide();
            $('#cdiscount_prepare_match_manual_field_price').closest('.js-field').hide();
            <?php endif ?>
        });
    })(jqml);

</script>