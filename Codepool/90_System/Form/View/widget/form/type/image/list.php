<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<?php if (array_key_exists('values', $aField) && is_array($aField['values'])): ?>
    <?php
    $i = 0;
    foreach ($aField['values'] as $sOptionKey => $aImage) {
        ?>
        <div>
            <div  class="ml-image-box" style="width:80px; height: 85px; border: 1px solid #dadada;">
                <label for="<?php echo $aField['id'] ?>_<?php echo $sOptionKey ?>">
                    <img height="<?php echo $aImage['height'] ?>px" width="<?php echo $aImage['width'] ?>px" alt="<?php echo $aImage['alt'] ?>" src="<?php echo $aImage['url'] ?>">
                </label>
            </div>
            <div class="ml-image-cb">
                <input type="<?php echo $aField['input_type'] ?>" id="<?php echo $aField['id'] ?>_<?php echo $sOptionKey ?>"
                       value="<?php echo $sOptionKey ?>"<?php echo(is_array($aField['value']) && in_array($sOptionKey, $aField['value']) ? ' checked="checked"' : ''); ?>
                       name="<?php echo ($aField['input_type'] === 'checkbox' ? MLHTTP::gi()->parseFormFieldName($aField['name']) . '[' . $i . ']' : MLHTTP::gi()->parseFormFieldName($aField['name']));
                       $i++; ?>">
            </div>
        </div>
    <?php } ?>
<?php endif; ?>
