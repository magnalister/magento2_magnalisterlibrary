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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
if (!class_exists('ML', false))
    throw new Exception();
?>
<?php
    $blShow=false;
    if(isset($aFieldset['fields'])){
        foreach ($aFieldset['fields'] as $aField) {
            if ((isset($aField['type'])
                && (isset($this->oProduct) || !isset($aField['singleproduct']) || !$aField['singleproduct'] || (isset($aField['multiprepareonlyswitch']) && $aField['multiprepareonlyswitch']))
            )) {
                $blShow = true;
            }
        }
    }

?>
<tbody<?php echo $blShow ? '' : ' style="display:none;"' ?> id="<?php echo $aFieldset['id'] ?>" class="<?php echo !empty($aFieldset['cssclasses']) ? ' '.implode(' ', $aFieldset['cssclasses']) : '' ?>">
<tr class="headline<?php echo isset($aFieldset['legend']['classes']) ? ' '.implode(' ', $aFieldset['legend']['classes']) : '' ?>">
    <?php $this->includeView('widget_form_legend_'.$aFieldset['legend']['template'], array('aFieldset' => $aFieldset)); ?>
</tr>
<?php
if (isset($aFieldset['fields'])) {
    $this->includeView('widget_form_row_'.$aFieldset['row']['template'], array('aFields' => $aFieldset['fields']));
}
?>
<tr class="spacer">
    <td colspan="4"></td>
</tr>
</tbody>