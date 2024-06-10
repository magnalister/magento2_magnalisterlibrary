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
 * (c) 2010 - 2021 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

if (!class_exists('ML', false))
    throw new Exception();
MLSettingRegistry::gi()->addJs(array('jquery-ui-timepicker-addon.js'));

    // Helper for php8 compatibility - can't pass null to explode 
    $aField['value'] = MLHelper::gi('php8compatibility')->checkNull($aField['value']);
    if (empty($aField['value'])) {
        $aField['value'] = '00:00:00';
    }
	$timeParts = explode(':', $aField['value']);
    if (is_array($timeParts)){
        for ($i = 0; $i <= 2; $i++) {
            if (empty($timeParts[$i])){
                $timeParts[$i] = '00';
            }
        }
    }
?>
<div class="datetimepicker">
    <input type="text" id="<?php echo $aField['id']; ?>"
        <?php echo(isset($aField['value']) ? 'value="'.htmlspecialchars($aField['value'], ENT_COMPAT).'"' : '') ?>
           name="<?php echo MLHttp::gi()->parseFormFieldName($aField['name']) ?>" readonly="readonly" class="autoWidth rightSpacer"/>
</div>
<script type="text/javascript">
    (function ($) {
        jqml(document).ready(function () {
            jqml.timepicker.setDefaults(jqml.timepicker.regional['']);
            jqml("#<?= $aField['id'] ?>").timepicker(
                jqml.timepicker.regional['de']
            ).datetimepicker("option", {
                onClose: function (dateText, inst) {
                    var t = jqml("#<?= $aField['id'] ?>").val();
					var tArray = t.split(':');
					if ((t !== null) && (tArray.length === 2)) {
						jqml("#<?= $aField['id'] ?>").val(t + ':00');
					}
				}
			})<?php if (isset($aField['value']) === true) : ?>.datetimepicker(
				"setDate", new Date(2000, 1, 1, <?= $timeParts[0] ?>, <?= $timeParts[1] ?>, <?= $timeParts[2] ?>)
			)<?php endif ?>;

			jqml('#ricardo_prepare_form_field_duration').change(function() {
				if (this.value === '10') {
					jqml('#<?= $aField['id'] ?>').closest('span').parent().hide();
				} else {
					jqml('#<?= $aField['id'] ?>').closest('span').parent().show();
				}
			});
		});
	})(jqml);
</script>



