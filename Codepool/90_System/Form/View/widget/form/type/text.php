<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<textarea class="fullwidth<?php echo ((isset($aField['required']) && empty($aField['value'])) ? ' ml-error' : '').' '.(isset($aField['cssclass']) && is_array($aField['cssclass']) ? implode(' ', $aField['cssclass']) : null); ?>"<?php
if (isset($aField['attributes'])) {
    foreach ($aField['attributes'] as $sKey => $sValue) {
        echo ' '.$sKey.'="'.$sValue.'"';
    }
}
?> id="<?php echo $aField['id']; ?>" name="<?php echo MLHttp::gi()->parseFormFieldName($aField['name']) ?>"
    <?php echo isset($aField['maxlength']) ? "maxlength='{$aField['maxlength']}'" : ''; ?> ><?php echo isset($aField['value']) ? $aField['value'] : '' ?></textarea>
