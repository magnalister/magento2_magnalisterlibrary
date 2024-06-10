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
MLSetting::gi()->add('aCss', array('magnalister.form.action.css?%s'), true);
?>

<tr class="action">
    <td colspan="4">
        <div class="ml-row-action">
            <div class="ml-row-container ml-row-container-md">
                <?php foreach ($aFields as $iField => $aField) { ?>
                    <?php if (
                        (
                            isset($aField['position'])
                            && $aField['position'] == 'left'
                        )
                    ) {
                        $this->includeView('widget_form_row_actionrowrowrow_button-with-popup', array('aField' => $aField));
                    }
                } ?>
            </div>
            <div class="ml-row-container ml-row-container-md">
                <?php foreach ($aFields as $iField => $aField) { ?>
                    <?php if (
                        (
                            isset($aField['position'])
                            && $aField['position'] != 'left'
                        )
                    ) {
                        $this->includeView('widget_form_row_actionrowrowrow_button-with-popup', array('aField' => $aField));
                    } ?>
                <?php } ?>
            </div>
        </div>
        <table>




           <!--<tr>
                <?php /*foreach (array('left', 'center', 'right') as $sPosition) { */?>
                    <td class="ml-form-action-<?php /*echo $sPosition; */?>">
                        <table>
                            <tr>
                                <?php /*foreach ($aFields as $iField => $aField) { */?>
                                    <?php /*if (
                                        (
                                            isset($aField['position'])
                                            && $aField['position'] == $sPosition
                                        )
                                        ||
                                        (
                                            !isset($aField['position'])
                                            && $sPosition == 'right'
                                        )
                                    ) {
                                        $translationData = array();
                                        if(MLI18n::gi()->isTranslationActive()) {
                                            $translationData = MLI18n::gi()->getTranslationData($aField['translation_key']);
                                        }
                                        */?>
                                        <td class="ml-translate-toolbar-wrapper<?php /*echo !empty($translationData['missing_key']) ? 'missing_translation' : ''*/?>">
                                            <?php /*$this->includeType($aField) */?>
                                            <?php /*if (MLI18n::gi()->isTranslationActive()) { */?>
                                                <div class="ml-translate-toolbar">
                                                    <a href="#" title="Translate label" class="translate-label abutton" <?php /*echo 'data-ml-translate-modal="#modal-tr-' . str_replace('.', '\\.', $aField['translation_key']) . '"'; */?>>&nbsp;</a>
                                                    <div class="ml-modal-translate dialog2" id="modal-tr-<?php /*echo str_replace('.', '\\.', $aField['translation_key']) */?>">
                                                        <script type="text/plain" class="data"><?php /*echo json_encode($translationData); */?></script>
                                                    </div>
                                                </div>
                                            <?php /*} */?>
                                        </td>
                                    <?php /*} */?>
                                <?php /*} */?>
                            </tr>
                        </table>
                    </td>
                <?php /*} */?>
            </tr>-->
        </table>
    </td>
</tr>

