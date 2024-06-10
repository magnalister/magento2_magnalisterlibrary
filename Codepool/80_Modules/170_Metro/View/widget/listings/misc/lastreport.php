<?php 
 if (!class_exists('ML', false))
     throw new Exception();
$latestReport = MLModul::gi()->getConfig('inventory.import');
?>

<table class="magnaframe">
    <thead><tr><th><?= $this->__('ML_LABEL_NOTE') ?></th></tr></thead>
    <tbody><tr><td class="fullWidth">
        <table>
            <tbody>
            <tr><td>
                    <?php echo MLI18n::gi()->ML_METRO_DELETED_OFFER_PURGE_INFO; ?>
                </td>
            </tr>
            </tbody>
        </table>
    </td></tr></tbody>
</table>