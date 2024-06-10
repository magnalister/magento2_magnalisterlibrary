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

if (!class_exists('ML', false))
     throw new Exception();
//$latestReport = MLModule::gi()->getConfig('inventory.import');
?>

<table class="magnaframe">
    <thead><tr><th><?= $this->__('ML_LABEL_NOTE') ?></th></tr></thead>
    <tbody><tr><td class="fullWidth">
        <table>
            <tbody>
            <tr>
                <td><?= $this->__('ML_ETSY_TEXT_CHECKIN_DELAY') ?></td></tr>
            </tbody>
        </table>
    </td></tr></tbody>
</table>
