<?php if (!class_exists('ML', false))
    throw new Exception(); ?>
<input type="hidden" id="action" name="<?php echo MLHttp::gi()->parseFormFieldName('action') ?>" value="">
<input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('timestamp') ?>" value="<?php echo time() ?>">
<div class="ml-container-action-head">
    <h4>
        <?php echo $this->__('ML_LABEL_ACTIONS') ?>
    </h4>
</div>
<div class="ml-container-action">
    <div class="ml-container-inner ml-container-sm">
        <input type="button" class="mlbtn-gray" value="<?php echo $this->__('ML_BUTTON_LABEL_DELETE') ?>" id="listingDelete" name="<?php echo MLHttp::gi()->parseFormFieldName('listing[delete]'); ?>"/>
    </div>
    <div class="ml-container-inner ml-container-md">
        <?php if ($this->isSearchable()) { ?>
            <div class="newSearch">
                <input id="tfSearch" placeholder="<?php $this->__('Productlist_Filter_sSearch') ?>" name="<?php echo MLHttp::gi()->parseFormFieldName('tfSearch') ?>" type="text" value="<?php echo fixHTMLUTF8Entities($this->search, ENT_COMPAT) ?>"/>
                <button type="submit" class="mlbtn action">
                    <span></span>
                </button>
            </div>
        <?php } ?>
    </div>
    <div class="ml-container-inner ml-container-wd">
        <input type="submit" class="mlbtn-red" name="<?php echo MLHttp::gi()->parseFormFieldName('listing[import]'); ?>" value="<?= $this->__('ML_BUTTON_REFRESH_STOCK') ?>"/>
    </div>
</div>
<div class="spacer"></div>
<div id="infodiag" class="ml-modal dialog2" title="Information"></div>
<span id="afterdelete" style="display: none"><?= MLI18n::gi()->get('ricardo_after_delete') ?></span>
<script type="text/javascript">
    /*<![CDATA[*/
    jqml(document).ready(function () {
        jqml('#listingDelete').click(function () {
            var me = this;
            if ((jqml('.ml-js-plist input[type="checkbox"]:checked').length > 0) &&
                confirm(unescape(<?php echo "'".addslashes(html_entity_decode(sprintf($this->__('ML_GENERIC_DELETE_LISTINGS'), $this->getShopTitle())))."'";?>))
            ) {
                var d = jqml('#afterdelete').html();
                jqml('#infodiag').html(d).jDialog(
                    {'width': (d.length > 1000) ? '700px' : '500px'},
                    function () {
                        jqml('#action').val('delete');
                        jqml(me).parents('form').submit();
                    });
            }
        });
    });
/*]]>*/
</script>