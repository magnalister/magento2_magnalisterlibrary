<?php
if (!class_exists('ML', false))
    throw new Exception();
$latestReport = MLModule::gi()->getConfig('inventory.import');
?>

<table class="magnaframe">
    <thead>
    <tr>
        <th><?= $this->__('ML_LABEL_NOTE') ?></th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="fullWidth">
            <table>
                <tbody>
                <tr>
                    <td><?= $this->__('ML_PRICEMINISTER_LABEL_LAST_REPORT') ?>
                        <div id="priceministerInfo" class="desc"></div>
                        :
                    </td>
                    <td><?= (($latestReport > 0) ? date("d.m.Y &\b\u\l\l; H:i:s", $latestReport) : $this->__('ML_LABEL_UNKNOWN')) ?></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<div id="infodiag" class="dialog2" title="<?= $this->__('ML_LABEL_NOTE') ?>"><?= $this->__('ML_PRICEMINISTER_TEXT_CHECKIN_DELAY') ?></div>
<script type="text/javascript">/*<![CDATA[*/
    jqml(document).ready(function () {
        jqml('#priceministerInfo').click(function () {
            jqml('#infodiag').jDialog();
        });
    });
    /*]]>*/</script>