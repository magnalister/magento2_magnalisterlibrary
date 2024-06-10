<tr class="js-field">
    <td class=" mlhelp ml-js-noBlockUi">
        <div class="ml-translate-toolbar">
            <a href="#" title="Translate" class="translate-label abutton"
               data-ml-translate-modal="<?php /** @var string $mainKey */
               echo '#modal-tr-' . str_replace('.', '\\.', $mainKey); ?>">&nbsp;</a>
        </div>
        <div class="ml-modal-translate dialog2" id="modal-tr-<?php echo str_replace('.', '\\.', $mainKey) ?>">
            <script type="text/plain"
                    class="data"><?php echo json_encode(MLI18n::gi()->getTranslationData($mainKey)); ?></script>
        </div>
    </td>
    <th scope="row" colspan="3">
        <label>
            <?php
            /** @var string $sKey */
            echo $sKey; ?>
        </label>
    </th>
</tr>
