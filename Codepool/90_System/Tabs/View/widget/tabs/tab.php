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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

$translationData = false;
$missingTranslationCss = '';
if (isset($aItem['controllerClass'])) {
    try {
        if (!MLFilesystem::gi()->callStatic($aItem['controllerClass'], 'getTabActive')) {// here we check again for changed config
            $aItem['class'] .= (empty($aItem['class']) ? '' : ' ').'inactive ml-js-noBlockUi';
        }
    } catch (ReflectionException $oEx) {
    }

    if ('controller_'.$sTabIdent == $aItem['controllerClass']) {
        $aItem['class'] .= (empty($aItem['class']) ? '' : ' ').'selected';
    }

    if (MLI18n::gi()->isTranslationActive()) {
        try {
            $translationData = MLFilesystem::gi()->callStatic($aItem['controllerClass'], 'getTabTitleTranslationData');
            $missingTranslationCss = !empty($translationData['missing_key']) ? 'missing_translation' : '';
        } catch (ReflectionException $oEx) {
        }
    }
}
if($sIfStatement) { ?>
    <li class="<?php echo $aItem['class'] ?> ml-translate-toolbar-wrapper <?php echo $missingTranslationCss ?> tab">
        <a <?php echo isset($aItem['breadcrumb']) && $aItem['breadcrumb'] !== false ? 'style="pointer-events: none;" class="breadcrumb '.$missingTranslationCss.'"' : 'class="'.$missingTranslationCss.'"' ?>href="<?php echo $aItem['url'] ?>"
           title="<?php echo str_replace(array('<', '>', '"'), array('&lt;', '&gt;', '&quot;'), $aItem['subtitle'].(empty($aItem['label']) ? '' : '&nbsp;::&nbsp;'.$aItem['label'])); ?>"<?php echo strpos($aItem['class'], 'inactive') !== false ? ' onclick="return false;"' : '' ?>>
            <?php if (!empty($aItem['image'])) { ?>
                <img src="<?php echo $aItem['image']; ?>"
                     alt="<?php echo str_replace(array('<', '>', '"'), array('&lt;', '&gt;', '&quot;'), $aItem['subtitle'].(empty($aItem['label']) ? '' : '&nbsp;::&nbsp;'.$aItem['label'])); ?>"/>
            <?php } else { ?>
                <?php echo str_replace(array('<', '>', '"', '&amp;hellip;'), array('&lt;', '&gt;', '&quot;', '&hellip;'), fixHTMLUTF8Entities($aItem['title'])); ?>
            <?php } ?>
            <?php echo str_replace(array('<', '>', '"', '&amp;hellip;'), array('&lt;', '&gt;', '&quot;', '&hellip;'), fixHTMLUTF8Entities($aItem['label'])); ?>
        </a>
        <?php if ($translationData) { ?>
            <div class="ml-translate-toolbar">
                <a href="#" title="Translate label"
                   class="translate-label abutton" <?php echo 'data-ml-translate-modal="#modal-tr-'.str_replace('.', '\\.', $translationData['key']).'"'; ?>>&nbsp;</a>
                <div class="ml-modal-translate dialog2"
                     id="modal-tr-<?php echo str_replace('.', '\\.', $translationData['key']) ?>">
                    <script type="text/plain"
                            class="data"><?php echo json_encode($translationData); ?></script>
                </div>
            </div>
        <?php } ?>
    </li>
<?php } ?>