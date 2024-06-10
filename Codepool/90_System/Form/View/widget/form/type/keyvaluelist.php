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
 * $Id$
 *
 * (c) 2010 - 2014 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
if (!class_exists('ML', false))
    throw new Exception();
?>
<table style="width:100%;" class="keyvaluelist" data-name="<?= $aField['name'] ?>">
    <tbody>
        <tr>
            <th><?= $aField['i18n']['keytitle'] ?></th>
            <th><?= $aField['i18n']['valuetitle'] ?></th>
            <td></td>
        </tr>
        <?php
        $i = 0;
        foreach($aField['value'] as $aPair) {
        ?>
        <tr>
            <td style="width:50%">
                <input class="fullwidth" type="text" name="ml[field][<?= $aField['name'] ?>][<?= $i ?>][key]" 
                       value="<?= $aPair['key']?>">
            </td>
            <td style="width:50%">
                <input class="fullwidth<?= isset($aPair['error']) ? ' ml-error' : ''?>" type="text" 
                       name="ml[field][<?= $aField['name'] ?>][<?= $i ?>][value]" value="<?= $aPair['value'] ?>">
            </td>
            <td style="width:100px;white-space: nowrap;">
                <button class="mlbtn fullfont btn-add" type="button">+</button>
                <button class="mlbtn fullfont btn-remove" type="button">-</button>
            </td>
        </tr>
        <?php 
            $i++;
        } ?>
        <tr class='template' <?php echo $i > 0 ? 'style="display:none;"' : '' ?>>
            <td style="width:50%">
                <input class="fullwidth" type="text" name="ml[field][<?= $aField['name'] ?>][<?= $i ?>][key]">
            </td>
            <td style="width:50%">
                <input class="fullwidth" type="text" name="ml[field][<?= $aField['name'] ?>][<?= $i ?>][value]">
            </td>
            <td style="width:100px;white-space: nowrap;">
                <button class="mlbtn fullfont btn-add" type="button">+</button>
                <button class="mlbtn fullfont btn-remove" type="button">-</button>
            </td>
        </tr>
    </tbody>
</table>
<script type='text/javascript' src='<?= MLHttp::gi()->getResourceUrl('js/jquery.magnalister.form.keyvaluelist.js') ?>'></script>
