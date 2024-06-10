<?php
/*
 * 888888ba                 dP  .88888.                    dP
 * 88    `8b                88 d8'   `88                   88
 * 88aaaa8P' .d8888b. .d888b88 88        .d8888b. .d8888b. 88  .dP  .d8888b.
 * 88   `8b. 88ooood8 88'  `88 88   YP88 88ooood8 88'  `"" 88888"   88'  `88
 * 88     88 88.  ... 88.  .88 Y8.   .88 88.  ... 88.  ... 88  `8b. 88.  .88
 * dP     dP `88888P' `88888P8  `88888'  `88888P' `88888P' dP   `YP `88888P'
 *
 *                          m a g n a l i s t e r
 *                                      boost your Online-Shop
 *
 * -----------------------------------------------------------------------------
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

if (!class_exists('ML', false))
    throw new Exception(); ?>
<input type="hidden" id="action" name="<?php echo MLHttp::gi()->parseFormFieldName('action') ?>" value="">
<input type="hidden" name="<?php echo MLHttp::gi()->parseFormFieldName('timestamp') ?>" value="<?php echo time() ?>">
<div class="ml-container-action-head">
    <h4>
        <?php echo $this->__('ML_LABEL_ACTIONS') ?>
    </h4>
</div>
<div class="ml-container-action">
    <div class="ml-container-inner ml-container-sm"></div>
    <div class="ml-container-inner ml-container-md">
        <?php if($this->isSearchable()){?>
            <div class="newSearch">
                <input id="tfSearch" placeholder="<?php $this->__('Productlist_Filter_sSearch') ?>"  name="<?php echo MLHttp::gi()->parseFormFieldName('tfSearch') ?>" type="text" value="<?php echo fixHTMLUTF8Entities($this->search, ENT_COMPAT) ?>"/>
                <button type="submit" class="mlbtn action">
                    <span></span>
                </button>
            </div>
        <?php }?>
    </div>
    <div class="ml-container-inner ml-container-sm"></div>
</div>
<div class="spacer"></div>
<script type="text/javascript">/*<![CDATA[*/
    jqml(document).ready(function() {
        jqml('#listingDelete').click(function() {
            if ((jqml('.ml-js-plist input[type="checkbox"]:checked').length > 0) &&
                    confirm(unescape(<?php

echo "'".addslashes(html_entity_decode(sprintf($this->__('ML_GENERIC_DELETE_LISTINGS'), $this->getShopTitle())))."'";
?>))
                    ) {
                jqml('#action').val('delete');
                jqml(this).parents('form').submit();
            }
        });
    });
    /*]]>*/</script>