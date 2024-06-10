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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
$oCategories = MLDatabase::factory(MLModule::gi()->getMarketPlaceName() . '_categories' . $sType)->set('categoryid', $sParentId);
$sIdent = 'ml-ajax-catContainer_' . MLModule::gi()->getMarketPlaceName() . '_' . MLModule::gi()->getMarketPlaceId() . '_' . $sType . '_';
$sTitle = '';
$sClass = '';
if (!empty($sParentId) && isset($sParentId) && $sParentId !== '0' || $sParentId !== 0) {
    $sTitle = $oCategories->getClickPath(' &gt ');
}

$sDeep = (substr_count($sTitle, ' &gt ') + 2).'. Ebene: ';
foreach ($oCategories->getChildCategories()->getList() as $oCat) {
    $selected = $oCat->get('selectable');
    if ($selected) {
        $sClass = 'ml-js-catMatch-element-selectable';
    } elseif (isset($selected ) && !$selected && $oCat->get('leafcategory')) {
        $sClass = 'ml-js-catMatch-element-disabled';
    }
    ?>
        <li class="ml-js-catMatch-element <?php echo $sClass; ?>">
            <?php if ($oCat->get('leafcategory')) { ?>
                <?php //$sRadioId = uniqid(); ?>
                <label class="ml-catMatch-name" title="<?php echo $sDeep.$sTitle.$oCat->get('categoryname'); ?>">
                    <span class="ml-js-catMatch-toggle ml-js-catMatch-toggle-leaf">
                        <input title="<?php echo $sTitle.$oCat->get('categoryname'); ?>" name="selectedCat" type="radio" value="<?php echo $oCat->get('categoryid') ?>" />
                    </span>
                    <?php echo $oCat->get('categoryname'); ?>
                </label>
            <?php } else { ?>
                <?php 
                    $sLink = MLHttp::gi()->getUrl(array(
                        'mp' => MLModule::gi()->getMarketPlaceId(),
                        'controller' => 'do_categories',
                        'method' => 'getChildCategories', 
                        'parentid' => $oCat->get('categoryid'),
                        'type' => $sType
                    ));
                ?>
                <a class="global-ajax" href="<?php echo $sLink; ?>">
                    <span class="ml-js-catMatch-toggle ml-js-catMatch-toggle-plus">
                        &nbsp;
                        <?php if ($oCat->get('selectable')) {?>
                            <input title="<?php echo $sTitle.$oCat->get('categoryname'); ?>" name="selectedCat" type="radio" value="<?php echo $oCat->get('categoryid') ?>" />
                        <?php } ?>
                    </span>
                </a>
                <div class="ml-js-catMatch-nameContainer">
                    <a class="global-ajax ml-catMatch-name" title="<?php echo $sDeep.$sTitle.$oCat->get('categoryname'); ?>" href="<?php echo $sLink; ?>">
                        <?php echo $oCat->get('categoryname'); ?>
                    </a>
                    <ul class="ml-js-catMatch-branch <?php echo $sIdent.str_replace(':', '_', $oCat->get('categoryid')); ?>"></ul>
                </div>
            <?php } ?>
        </li>
    <?php 
}