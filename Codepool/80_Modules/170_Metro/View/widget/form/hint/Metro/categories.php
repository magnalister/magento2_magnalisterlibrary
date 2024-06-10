<?php
/**
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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

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