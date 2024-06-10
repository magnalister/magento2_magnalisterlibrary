<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<input class="fullwidth" type="text" readonly="readonly" id="<?php echo $aField['id']; ?>" placeholder="<?php if (array_key_exists('placeholder', $aField))
    echo $aField['placeholder']; else echo ''; ?>" name="<?php echo MLHttp::gi()->parseFormFieldName($aField['name']) ?>" value="<?php echo $aField['value'] ?>"/>
