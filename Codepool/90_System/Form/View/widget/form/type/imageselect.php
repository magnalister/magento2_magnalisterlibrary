<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
    <div class="ml-image-wrapper">
        <?php
        $aField['type'] = 'image_list';
        $aField['input_type'] = 'radio';
        $this->includeType($aField);
        ?>
    </div>