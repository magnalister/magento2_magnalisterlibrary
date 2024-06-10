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
?>
<div class="datetimepicker">
    <input type="text" id="<?php echo $aField['id']; ?>"
        <?php echo(isset($aField['value']) ? 'value="'.htmlspecialchars($aField['value'], ENT_COMPAT).'"' : '') ?>
           readonly="readonly" class="autoWidth rightSpacer"/>
    <input type="hidden" id="<?php echo $aField['id'].'_hidden'; ?>" name="<?php echo MLHttp::gi()->parseFormFieldName($aField['name']) ?>" value="<?php echo $aField['value'] ?>"/>
</div>
<script type="text/javascript">
    (function ($) {
        jqml(document).ready(function () {
            jqml.datepicker.setDefaults(jqml.datepicker.regional['']);
            jqml.timepicker.setDefaults(jqml.timepicker.regional['']);
            jqml("#<?php echo $aField['id']; ?>").datetimepicker(
                jqml.extend(
                    jqml.datepicker.regional['de'],
                    jqml.timepicker.regional['de']
                )
            ).datetimepicker("option", {
                onClose: function (dateText, inst) {
                    var d = jqml("#<?php echo $aField['id']; ?>").datetimepicker("getDate");
                    if (d !== null) {
                        var s = jqml.datepicker.formatDate("yy-mm-dd", d) + ' ' +
                            jqml.datepicker.formatTime("HH:mm:ss", {
                                hour: d.getHours(),
                                minute: d.getMinutes(),
                                second: d.getSeconds()
						}, { ampm: false });
						jqml("#<?php echo $aField['id']; ?>_hidden").val(s);
					}
				}
			}).datetimepicker(
				"option", "minDate", 0
			).datetimepicker(
				"option", "maxDate", <?= $aField['MaxStartDate'] ?>
			)<?php if (isset($aField['value']) === true) : ?>.datetimepicker(
				"setDate", new Date('<?= $aField['value'] ?>')
			)<?php endif ?>;
		});
	})(jqml);
</script>

