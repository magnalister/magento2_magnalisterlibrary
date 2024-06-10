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
<?php if (is_array($aFieldset['legend']['i18n'])) {
    $translationData = array(
        'title' => array(),
        'info' => array(),
    );
    if (MLI18n::gi()->isTranslationActive()) {
        $translationData = array(
            'title' => MLI18n::gi()->getTranslationData($aFieldset['translation_key'] . '_title'),
            'info' => MLI18n::gi()->getTranslationData($aFieldset['translation_key'] . '_info'),
        );
    }
    ?>
    <td colspan="4">
        <h4 class="ml-translate-toolbar-wrapper <?php echo !empty($translationData['title']['missing_key']) ? 'missing_translation' : '' ?>">
            <?php echo $aFieldset['legend']['i18n']['title']; ?>
            <?php if (MLI18n::gi()->isTranslationActive()) { ?>
                <div class="ml-translate-toolbar">
                    <a href="#" title="Translate label"
                       class="translate-label abutton" <?php echo 'data-ml-translate-modal="#modal-tr-' . str_replace('.', '\\.', $aFieldset['translation_key']) . '-title"'; ?>>&nbsp;</a>
                    <div class="ml-modal-translate dialog2"
                         id="modal-tr-<?php echo str_replace('.', '\\.', $aFieldset['translation_key']) ?>-title">
                        <script type="text/plain"
                                class="data"><?php echo json_encode($translationData['title']); ?></script>
                    </div>
                </div>
            <?php } ?>
        </h4>
        <div id="ml-form-header-<?php echo(empty($aFieldset['legend']['i18n']['info']) ? '' : md5($aFieldset['legend']['i18n']['info'])) ?>"
             class="ml-translate-toolbar-wrapper <?php echo !empty($translationData['info']['missing_key']) ? 'missing_translation' : '' ?>">
            <p><?php echo $aFieldset['legend']['i18n']['info']; ?></p>
            <?php if (MLI18n::gi()->isTranslationActive()) { ?>
                <div class="ml-translate-toolbar">
                    <a href="#" title="Translate label"
                       class="translate-label abutton" <?php echo 'data-ml-translate-modal="#modal-tr-' . str_replace('.', '\\.', $aFieldset['translation_key']) . '-info"'; ?>>&nbsp;</a>
                    <div class="ml-modal-translate dialog2"
                         id="modal-tr-<?php echo str_replace('.', '\\.', $aFieldset['translation_key']) ?>-info">
                        <script type="text/plain"
                                class="data"><?php echo json_encode($translationData['info']); ?></script>
                    </div>
                </div>
            <?php } ?>
        </div>
    </td>
<?php } else {
    $translationData = array();
    if (MLI18n::gi()->isTranslationActive()) {
        $translationData = MLI18n::gi()->getTranslationData($aFieldset['translation_key']);
    }
    ?>
    <td colspan="4">
        <h4 id="ml-form-header-<?php echo(empty($aFieldset['legend']['i18n']) ? '' : md5($aFieldset['legend']['i18n'])) ?>"
            class="ml-translate-toolbar-wrapper  <?php echo !empty($translationData['missing_key']) ? 'missing_translation' : '' ?>">
            <?php echo $aFieldset['legend']['i18n']; ?>
            <?php if (MLI18n::gi()->isTranslationActive()) { ?>
                <div class="ml-translate-toolbar">
                    <a href="#" title="Translate label"
                       class="translate-label abutton" <?php echo 'data-ml-translate-modal="#modal-tr-' . str_replace('.', '\\.', $aFieldset['translation_key']) . '"'; ?>>&nbsp;</a>
                    <div class="ml-modal-translate dialog2"
                         id="modal-tr-<?php echo str_replace('.', '\\.', $aFieldset['translation_key']) ?>">
                        <script type="text/plain" class="data"><?php echo json_encode($translationData); ?></script>
                    </div>
                </div>
            <?php } ?>
        </h4>
    </td>
<?php } 

