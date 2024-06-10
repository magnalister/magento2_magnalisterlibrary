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
MLSetting::gi()->add('aCss', array('magnalister.form.action.css?%s'), true);
?>
<tr class="action">
    <td colspan="4">
        <div class="ml-row-action">
            <div class="ml-row-container ml-row-container-md">
                <?php foreach ($aFields as $iField => $aField) { ?>
                    <?php if (
                        (
                            isset($aField['position'])
                            && $aField['position'] == 'left'
                        )
                    ) {
                        $this->includeView('widget_form_row_actionrowrowrow_button-with-popup', array('aField' => $aField));
                    }
                } ?>
            </div>
            <div class="ml-row-container ml-row-container-md">
                <?php foreach ($aFields as $iField => $aField) { ?>
                    <?php if (
                        (
                            isset($aField['position'])
                            && $aField['position'] != 'left'
                        )
                    ) {
                        $this->includeView('widget_form_row_actionrowrowrow_button-with-popup', array('aField' => $aField));
                    } ?>
                <?php } ?>
            </div>
        </div>
    </td>
</tr>