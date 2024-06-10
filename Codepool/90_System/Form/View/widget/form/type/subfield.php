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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
if (!class_exists('ML', false))
    throw new Exception();

$display = isset($aField['breakbefore']) && $aField['breakbefore'] == 'true' ? '' : 'display:table-cell;';
$padding = $aField['type'] == 'bool' ? '.2' : (isset($aField['padding-right']) ? $aField['padding-right'] : '1.35');
$float = (isset($aField['float']) ? $aField['float'] : 'none');
if (!empty($aField['i18n']['label']) && $aField['type'] != 'bool') { ?>
    <span style="<?php echo $display; ?>"><label style="margin-right: 5px;" for="<?php echo $aField['id']; ?>"><?php echo $aField['i18n']['label']; ?><lable></span>
<?php }
if (!empty($aField['i18n']['help'])) { ?>
    <span style="<?php echo $display; ?>" class="mlhelp ml-js-noBlockUi">
		<a style="display:inline-block;" data-ml-modal="#modal-<?php echo $aField['id']; ?>">&nbsp;&nbsp;</a>
		<div class="ml-modal" id="modal-<?php echo $aField['id']; ?>"
             title="<?php echo isset($aField['i18n']['hint']) ? $aField['i18n']['hint'] : ''; ?>"><?php echo $aField['i18n']['help'] ?></div>
	</span>
<?php }
if (!empty($aField['i18n']['label']) && $aField['type'] != 'bool') { ?>
    <span style="<?php echo $display; ?>padding-right:1em;"></span>
<?php } ?>
<span style="<?php echo $display;?>padding-right:<?php echo $padding; ?>em;float:<?php echo $float; ?>">
	<?php $this->includeType($aField, array('iValue' => $iValue)); ?>
</span>
<?php if (!empty($aField['i18n']['label']) && $aField['type'] == 'bool') { ?>
    <span style="<?php echo $display; ?>padding-right:1.2em;"><?php echo $aField['i18n']['label']; ?></span>
<?php }
