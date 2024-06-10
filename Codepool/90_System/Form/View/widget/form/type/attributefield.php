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
?>

<tbody id="<?php echo $aFieldset['id'] ?>">
<tr class="headline<?php echo isset($aFieldset['legend']['classes']) ? ' '.implode(' ', $aFieldset['legend']['classes']) : '' ?>">
    <?php $this->includeView('widget_form_legend_'.$aFieldset['legend']['template'],array('aFieldset'=>$aFieldset));?>
</tr>
<?php if (empty($aFieldset['fields'])) { ?>
    <tr class="js-field">
        <th></th>
        <td class="mlhelp ml-js-noBlockUi"></td>
        <td class="input"><?php echo MLI18n::gi()->get(MLModule::gi()->getMarketPlaceName() . '_prepare_variations_category_without_attributes_info') ?></td>
        <td class="info"></td>
    </tr>
<?php } else {
    foreach ($aFieldset['fields'] as $iField => $aField) {
        ?>
        <tr class="js-field <?php echo(isset($aField['subFieldsContainer']['classes']) ? ' ' . implode(' ', $aField['subFieldsContainer']['classes']) : ''); ?>">
            <th>
            <?php if (isset($aField['subFieldsContainer']['customAttributeSelect'])) { ?>
                <div id="attributeDropDown_<?php echo $aField['subFieldsContainer']['id']?>_customAttributeName"
                     style="overflow: hidden;
                <?php if (!empty($aField['subFieldsContainer']['subfields']['select']['value'])) { ?>
                    background-color: #e9e9e9;
                <?php } ?>">
                    <?php $this->includeType($aField['subFieldsContainer']['customAttributeSelect']); ?>
                </div>
            <?php } else { ?>
                <label for="<?php echo $aField['subFieldsContainer']['id'] ?>"><?php echo $aField['subFieldsContainer']['i18n']['label'] ?></label>
                <?php if (isset($aField['subFieldsContainer']['requiredField']) && $aField['subFieldsContainer']['requiredField'] === true) { ?>
                    <span>•</span>
                <?php }
            } ?>
            </th>
            <td class="mlhelp ml-js-noBlockUi">
                <?php if (isset($aField['subFieldsContainer']['i18n']['help'])) { ?>
                    <a data-ml-modal="#modal-<?php echo str_replace('.', '\\.', $aField['subFieldsContainer']['id']); ?>">
                        &nbsp;
                    </a>
                    <div class="ml-modal dialog2" id="modal-<?php echo $aField['subFieldsContainer']['id'] ?>"
                         title="<?php echo $aField['subFieldsContainer']['i18n']['label']; ?>">
                        <?php echo $aField['subFieldsContainer']['i18n']['help']; ?>
                    </div>
                <?php } ?>
            </td>
            <td class="input">
                <div id="attributeDropDown_<?php echo $aField['subFieldsContainer']['id'] ?>"
                     style="overflow: hidden;
                <?php if (isset($aField['subFieldsContainer']['subfields']['select']['value']) && !empty($aField['subFieldsContainer']['subfields']['select']['value'])) { ?>
                    background-color: #fff;
                <?php } ?>">
                    <?php
                    if (array_key_exists('debug', $aField['subFieldsContainer']) && $aField['subFieldsContainer']['debug']) {
                        new dBug($aField['subFieldsContainer'], '', true);
                    }
                    ?>
                    <div style="float: left">
                        <?php
                        $this->includeType($aField['subFieldsContainer']);
                        ?>
                    </div>
                    <?php if (isset($aField['subFieldsContainerExtra'])) { ?>
                        <div id="attributeExtraFields_<?php echo $aField['subFieldsContainer']['id'] ?>" style="display: flex; width: 360px; flex-direction: row">
                            <?php $this->includeType($aField['subFieldsContainerExtra']); ?>
                        </div>
                    <?php } ?>
                </div>
                <div id="attributeMatchedTable_<?php echo $aField['subFieldsContainer']['id'] ?>"
                    <?php if (isset($aField['subFieldsContainerExtra']['subfields']['collapsebutton']) && !$aField['subFieldsContainerExtra']['Expand']) { ?>
                        style="display: none"
                    <?php } ?>>
                    <?php if (isset($aField['ajax'])) {
                        $this->includeType($aField['ajax']);
                    } ?>
                </div>
            </td>
            <td class="info">
                <?php
                if (isset($aField['subFieldsContainer']['hint']['template'])) {
                    $this->includeView('widget_form_hint_' . $aField['subFieldsContainer']['hint']['template'], array('aField' => $aField['subFieldsContainer']));
                }
                ?>
            </td>
        </tr>
        <?php
    }
}
?>
<tr class="spacer"><td colspan="4"></td></tr>
</tbody>