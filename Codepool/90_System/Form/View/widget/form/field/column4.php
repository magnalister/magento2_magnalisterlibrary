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
if (isset($aField['hint']['template'])) {
    $this->includeView('widget_form_hint_'.$aField['hint']['template'], array('aField' => $aField));
}
if (MLI18n::gi()->isTranslationActive() && isset($aField['i18n']['hint'])) {
    ?>
        <div class="ml-translate-toolbar">
            <a href="#" title="Translate hint" class="translate-hint abutton" <?php echo 'data-ml-translate-modal="#modal-tr-' . str_replace('.', '\\.', $aField['id']) . '-hint"'; ?>>&nbsp;</a>
            <div class="ml-modal-translate dialog2" id="modal-tr-<?php echo str_replace('.', '\\.', $aField['id']) ?>-hint">
                <script type="text/plain" class="data"><?php echo json_encode($translationData['hint']); ?></script>
            </div>
        </div>
    <?php
}
