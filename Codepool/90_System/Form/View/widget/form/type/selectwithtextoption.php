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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

if (!class_exists('ML', false))
    throw new Exception();
$aTextValues = array();
$aSelect = $aField['subfields']['select'];
$aSelect['type'] = isset($aSelect['type']) ? $aSelect['type'] : 'select';
$inlineTranslationData = array(
    'translationKeys' => array()
);
$missingTranslationCss = '';

foreach ($aSelect['values'] as $sKey => &$mValue) {
    if (is_array($mValue)) {
        if (isset($mValue['textoption']) && $mValue['textoption']) {
            $aTextValues[] = $sKey;
        }
        if (!empty($mValue['translationData'])) {
            $inlineTranslationData['translationKeys'][$mValue['translationData']['key']] = $mValue['translationData'];
            if ($mValue['translationData']['missing_key']) {
                $missingTranslationCss = 'missing_translation';
            }
        }

        $mValue = $mValue['title'];
    }
}
$aString = $aField['subfields']['string'];
$aString['type'] = isset($aString['type']) ? $aString['type'] : 'string';

// fix for duplicate
if (isset($iValue) && is_int($iValue)) {
    if (isset($aSelect['value'][$iValue])) {
        $aSelect['value'] = $aSelect['value'][$iValue];
        $aSelect['name'] .= '['.$iValue.']';
    }
    if (isset($aString['value'][$iValue])) {
        $aString['value'] = $aString['value'][$iValue];
        $aString['name'] .= '['.$iValue.']';
    }
}

MLSetting::gi()->add('aJs', 'jquery.magnalister.form.selectewithtextoption.js');
?>
<table style="width:100%" class="ml-selectwithtextoption<?php echo ((isset($aField['required']) && empty($aField['value']))? ' ml-error' : ''); ?>" data-selectwithtextoption="<?php echo implode(' ', $aTextValues); ?>">
    <tbody>
        <tr>
            <td style="width:50%" class="ml-translate-toolbar-wrapper <?php echo $missingTranslationCss?>">
                <?php
                    $this->includeType($aSelect, array('iValue' => isset($iValue) ? $iValue : null));
                ?>
                <?php if (MLI18n::gi()->isTranslationActive()) { ?>
                    <div class="ml-translate-toolbar">
                        <a href="#" title="Translate label" class="translate-label abutton" <?php echo 'data-ml-translate-modal="#modal-tr-' . str_replace('.', '\\.', $aField['id']) . '"'; ?>>&nbsp;</a>
                        <div class="ml-modal-translate dialog2" id="modal-tr-<?php echo $aField['id'] ?>">
                            <script type="text/plain" class="data"><?php echo json_encode($inlineTranslationData); ?></script>
                        </div>
                    </div>
                <?php } ?>
            </td>
            <td style="width:50%">
                <div>
                <?php
                $this->includeType($aString, array('iValue' => isset($iValue) ? $iValue : null));
                ?>
                </div>
            </td>
        </tr>
    </tbody>
</table>
