<?php /** @see ../Main.php */ ?>
    <table class="attributesTable globalTranslate">
        <thead>
        <tr class="headline">
            <th colspan="4"><h4>Translation</h4></th>
        </tr>
        </thead>
        <tbody>

        <?php $isOdd = false;
        foreach (MLI18n::gi()->data() as $mKey => $sMainContent) {

            if (is_array(MLI18n::gi()->get($mKey))) {
                foreach (MLHelper::getArrayInstance()->nested2Flat(array($mKey => MLI18n::gi()->get($mKey))) as $sKey => $sContent) {
                    /** @see  ./translation/row.php */
                    $this->includeView('main_translation_row', array('sKey' => $sKey, 'mainKey' => $mKey));
                }

            } else {
                /** @see  ./translation/row.php */
                $this->includeView('main_translation_row', array('sKey' => $mKey, 'mainKey' => $mKey));
            }
        }
        ?>
        <tr class="spacer">
            <td colspan="4"></td>
        </tr>
        <tr class="spacer">
            <td colspan="4"></td>
        </tr>
        <tr class="spacer">
            <td colspan="4"></td>
        </tr>
        </tbody>
    </table>