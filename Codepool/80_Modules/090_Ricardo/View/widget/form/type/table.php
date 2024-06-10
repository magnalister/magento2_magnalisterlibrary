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
?>
<table style="width:100%" data-name="<?= $aField['name'] ?>"
    <?php echo isset($aField['cssclass']) ? 'class="'.$aField['cssclass'].'"' : '' ?> >
    <tbody>
    <tr>
        <th><?= 'Language' ?></th>
        <th><?= 'Description' ?></th>
    </tr>
    <?php
    foreach ($aField['values'] as $sKey => $sValue) {
        ?>
        <tr class="lang<?php echo $sKey ?>" <?= ($sValue === 'true') ? '' : 'style="display: none;"' ?>>
            <td style="width:50%">
                <?= $sKey ?>
            </td>
            <td style="width:50%">
				<textarea class="fullwidth" name="<?php echo MLHTTP::gi()->parseFormFieldName($aField['name']).'['.$sKey.']'; ?>" type="text"
				<?php
					if (!is_array($aField['value'])) {
                        // Helper for php8 compatibility - can't pass null to json_decode 
                        $aField['value'] = MLHelper::gi('php8compatibility')->checkNull($aField['value']);
						$aField['value'] = json_decode($aField['value'], true);
					}
					
					echo (isset($aField['value'][$sKey]) ? 'value="'. htmlspecialchars($aField['value'][$sKey], ENT_COMPAT) . '"' : '');
				?>
				><?= isset($aField['value'][$sKey]) ? $aField['value'][$sKey] : '' ?></textarea>
            </td>
        </tr>
        <?php
    }
		?>
    </tbody>
</table>