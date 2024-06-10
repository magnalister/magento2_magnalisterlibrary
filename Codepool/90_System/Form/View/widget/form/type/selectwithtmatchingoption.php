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
if (!isset($aField)) {
    return;
}

$aSelect = $aField['subfields']['select'];
$aSelect['type'] = isset($aSelect['type']) ? $aSelect['type'] : 'am_attributesselect';

$matchingOptionValue = '';
// matching value must be defined and must be the same as defined for $aSelect
if (isset($aSelect['matching']) && $aSelect['matching'] !== 'noMatching') {
    foreach ($aSelect['values'] as $value) {
        if (is_array($value) && array_key_exists($aSelect['matching'], $value)) {
            $matchingOptionValue = $aSelect['matching'];
        }
    }
}

$aMatching = $aField['subfields']['matching'];
$aMatching['type'] = isset($aMatching['type']) ? $aMatching['type'] : 'duplicate';
MLSetting::gi()->add('aJs', 'jquery.magnalister.form.selectwithmatchingoption.js');
?>
<table style="width:100%"  class="ml-selectwithmatchingoption <?php echo ((isset($aField['required']) && empty($aField['value']))? ' ml-error' : ''); ?>" data-matching="<?php echo $matchingOptionValue ?>">
    <tbody>
        <tr>
            <td style="width:50%" class="ml-translate-toolbar-wrapper">
                <?php
                    $this->includeType($aSelect);
                ?>
            </td>
            <td class="<?php echo isset($aSelect['tdclass']) ? $aSelect['tdclass'] : '' ?>" style="width:50%">
                <?php
                foreach ($aField['subfields'] as $key => $subfield) {
                    if (!in_array($key, array('select', 'matching'))) {
                        echo '<div class="ml-selectwithmatchingoption-'.$key.'" style="display: table">';
                        echo '    <div style="display: table-cell; padding: 0px 8px 0px 0px;">'.$subfield['i18n']['label'].'</div>';
                        echo '    <div style="display: table-cell; width: 100%;">';
                        $this->includeType($subfield);
                        echo '    </div>';
                        echo '</div>';
                    }
                }
                ?>
            </td>
        </tr>
    </tbody>
</table>
<?php if ($aSelect['matching'] !== 'noMatching') { ?>
    <div class="ml-duplicatematchingoption-<?php echo $matchingOptionValue ?> borderCollapseInitial"<?php if ($aSelect['value'] !== $matchingOptionValue) { ?> style="display: none;" <?php } ?> >
    <?php
        $this->includeType($aMatching);
    ?>
    </div>
<?php }
