<?php
    $translationData = array();
    if(MLI18n::gi()->isTranslationActive()) {
    $translationData = MLI18n::gi()->getTranslationData($aField['translation_key']);
    }
    ?>

    <div class="ml-translate-toolbar-wrapper<?php echo !empty($translationData['missing_key']) ? 'missing_translation' : ''?>">
        <?php $this->includeType($aField) ?>
        <?php if (MLI18n::gi()->isTranslationActive()) { ?>
            <div class="ml-translate-toolbar">
                <a href="#" title="Translate label" class="translate-label abutton" <?php echo 'data-ml-translate-modal="#modal-tr-' . str_replace('.', '\\.', $aField['translation_key']) . '"'; ?>>&nbsp;</a>
                <div class="ml-modal-translate dialog2" id="modal-tr-<?php echo str_replace('.', '\\.', $aField['translation_key']) ?>">
                    <script type="text/plain" class="data"><?php echo json_encode($translationData); ?></script>
                </div>
            </div>
        <?php } ?>
    </div>
