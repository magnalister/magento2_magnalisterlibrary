<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<form action="<?php echo $this->getCurrentUrl() ?>" method="post">
    <div style="display:none">
        <?php foreach (MLHttp::gi()->getNeededFormFields() as $sKey => $sValue) { ?>
            <input type="hidden" name="<?php echo $sKey ?>" value="<?php echo $sValue ?>"/>
        <?php } ?>
    </div>
    <div>
        Current Path :<?php echo MLFilesystem::gi()->getLibPath(); ?>
    </div>
    <div>
        File Path :
        <input type="text" value="<?php echo MLRequest::gi()->data('path'); ?>" name="<?php echo MLHttp::gi()->parseFormFieldName('path'); ?>" style="width: 100%">
    </div>
    <div>
        Mode :
        <input type="text" value="<?php echo MLRequest::gi()->data('mode') ? MLRequest::gi()->data('mode') : '0777'; ?>" name="<?php echo MLHttp::gi()->parseFormFieldName('mode'); ?>" style="width: 100%">
    </div>
    <div>
        <input class="mlbtn" type="submit" name="" value='Chmod File'/>
    </div>
</form>