<?php
 if (!class_exists('ML', false))
     throw new Exception();
?>
<button
        data-field="<?php echo $aField['id'] ?>"
        data-variationsEnabled="<?php echo $aField['realname'] == 'primarycategory' ? 'true' : 'false'; ?>"
        data-method="<?php echo $aField['realname'].'attributes' ?>"
        data-store="<?php echo in_array($aField['realname'], array('storecategory', 'storecategory2', 'storecategory3')) ?>"
        class="mlbtn js-category-dialog <?php echo $aField['realname'] == 'primarycategory' ? 'action' : ''; ?>"
        style="width:100%;margin:0;display:inline;float:left;" type="button">
    <div style="width:100%;float:left;">
        <?php echo $aField['i18n']['hint'] ?>
    </div>
    <div class="clear"></div>
</button>