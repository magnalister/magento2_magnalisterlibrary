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
     throw new Exception();
$latestReport = MLModul::gi()->getConfig('inventory.import');
?>

<table class="magnaframe">
    <thead><tr><th><?= $this->__('ML_LABEL_NOTE') ?></th></tr></thead>
    <tbody><tr><td class="fullWidth">
        <table>
            <tbody>
            <tr><td>
                    <?php echo MLI18n::gi()->ML_OTTO_DELETED_OFFER_PURGE_INFO; ?>
                </td>
            </tr>
            </tbody>
        </table>
    </td></tr></tbody>
</table>
