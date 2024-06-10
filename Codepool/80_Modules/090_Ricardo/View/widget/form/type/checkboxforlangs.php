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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

if (!class_exists('ML', false))
    throw new Exception();
$aLangs = $aField['value'];
if (!empty($aLangs['de']) || !empty($aLangs['fr'])) {
    if ($aLangs['de'] === 'true') {
        $de = 'checked';
    } else {
        $de = '';
    }

    if ($aLangs['fr'] === 'true') {
        $fr = 'checked';
    } else {
        $fr = '';
    }
} else {
	$de = 'checked';
	$fr = '';
}

?>
<div class="input langCheckBoxes">
	<input id="<?php echo $aField['id'] ?>_de_hidden" type="hidden" value="false" name="<?php echo MLHTTP::gi()->parseFormFieldName($aField['name']) ?>[de]"/>
	<input id="<?php echo $aField['id'] ?>_de" type="checkbox" value="true" name="<?php echo MLHTTP::gi()->parseFormFieldName($aField['name']) ?>[de]" <?= $de?>/>
	<label for="<?php echo $aField['id'] ?>_de">DE</label>

	<input id="<?php echo $aField['id'] ?>_fr_hidden" type="hidden" value="false" name="<?php echo MLHTTP::gi()->parseFormFieldName($aField['name']) ?>[fr]"/>
	<input id="<?php echo $aField['id'] ?>_fr" type="checkbox" value="true" name="<?php echo MLHTTP::gi()->parseFormFieldName($aField['name']) ?>[fr]" <?= $fr?>/>
	<label for="<?php echo $aField['id'] ?>_fr">FR</label>
</div>
<script type="text/javascript">
	(function($) {
		$(document).on("click", ".langCheckBoxes input", function(e) {
			if ($(".langCheckBoxes :checked").length === 0 && $(this).prop('checked') === false) {
				e.preventDefault();
			} else {
				<?php if ($aField['isdynamic'] === 'true') { ?>
					if ($('#<?php echo $aField['id'] ?>_de').prop('checked')) {
						<?php if ((isset($aField['issingleview'])) && ($aField['issingleview'] === true)) {?>
							$('#ricardo_prepare_form_field_detitle').closest('.js-field').show();
							$('#ricardo_prepare_form_field_desubtitle').closest('.js-field').show();
							$('#ricardo_prepare_form_field_dedescription').closest('.js-field').show();
						<?php } else { ?>
                            $('#ricardo_prepare_form_field_desubtitle_optional').closest('.js-field').show();
                        <?php } ?>
						$('.langde').show();
					} else {
						$('#ricardo_prepare_form_field_detitle').closest('.js-field').hide();
						$('#ricardo_prepare_form_field_desubtitle').closest('.js-field').hide();
                        $('#ricardo_prepare_form_field_desubtitle_optional').closest('.js-field').hide();
						$('#ricardo_prepare_form_field_dedescription').closest('.js-field').hide();
						$('.langde').hide();
					}

					if ($('#<?php echo $aField['id'] ?>_fr').prop('checked')) {
						<?php if ((isset($aField['issingleview'])) && ($aField['issingleview'] === true)) {?>
							$('#ricardo_prepare_form_field_frtitle').closest('.js-field').show();
							$('#ricardo_prepare_form_field_frsubtitle').closest('.js-field').show();
							$('#ricardo_prepare_form_field_frdescription').closest('.js-field').show();
                        <?php } else { ?>
                            $('#ricardo_prepare_form_field_frsubtitle_optional').closest('.js-field').show();
                        <?php } ?>
						$('.langfr').show();
					} else {
						$('#ricardo_prepare_form_field_frtitle').closest('.js-field').hide();
						$('#ricardo_prepare_form_field_frsubtitle').closest('.js-field').hide();
						$('#ricardo_prepare_form_field_frsubtitle_optional').closest('.js-field').hide();
						$('#ricardo_prepare_form_field_frdescription').closest('.js-field').hide();
						$('.langfr').hide();
					}
					
					<?php if ((isset($aField['issingleview'])) && ($aField['issingleview'] === false)) { ?>
                        $('td[class="input"]:empty').closest('.js-field').hide();
					<?php } ?>
				<?php }?>
			}
		});
		
		$(document).ready(function() {
			<?php if ($de === '' && $aField['isdynamic'] === 'true') : ?>
				$('#ricardo_prepare_form_field_detitle').closest('.js-field').hide();
				$('#ricardo_prepare_form_field_desubtitle').closest('.js-field').hide();
				$('#ricardo_prepare_form_field_desubtitle_optional').closest('.js-field').hide();
				$('#ricardo_prepare_form_field_dedescription').closest('.js-field').hide();
				$('.langde').hide();
			<?php endif; ?>
			<?php if ($fr === '' && $aField['isdynamic'] === 'true') : ?>
				$('#ricardo_prepare_form_field_frtitle').closest('.js-field').hide();
				$('#ricardo_prepare_form_field_frsubtitle').closest('.js-field').hide();
				$('#ricardo_prepare_form_field_frsubtitle_optional').closest('.js-field').hide();
				$('#ricardo_prepare_form_field_frdescription').closest('.js-field').hide();
				$('.langfr').hide();
			<?php endif; ?>
			<?php if ((isset($aField['issingleview'])) && ($aField['issingleview'] === false)) { ?>
                $('td[class="input"]:empty').closest('.js-field').hide();
			<?php } ?>
		});
	})(jqml);
</script>