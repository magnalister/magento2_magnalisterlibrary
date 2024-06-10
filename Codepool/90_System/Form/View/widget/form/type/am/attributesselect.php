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

/**
 * Displays regular select field with additional JS to handle proper opt group selection for
 * attributes matching purposes.
 */
if (!class_exists('ML', false))
    throw new Exception();

$mlAlertData = '';
if (!empty($aField['i18n']['alert'])) {
    $mlAlertData = json_encode(array(
        'abort' => MLI18n::gi()->get('ML_BUTTON_LABEL_ABORT'),
        'ok' => MLI18n::gi()->get('ML_BUTTON_LABEL_OK')
    ));
}

$valueExists = true;
if (!empty($aField['value'])) {
    $valueExists = false;
    $values = array_key_exists('values', $aField) ? $aField['values'] : array();

    // Values can be key => value for simple option or optGroupKey => array of opt group values
    foreach ($values as $optionKey => $optionValue) {
        $valueExists = $optionKey === $aField['value']; // Check simple case when option is not option group

        // If value is option group, check option group values by key
        if (is_array($optionValue)) {
            $valueExists = array_key_exists($aField['value'], $optionValue);
        }

        if ($valueExists) {
            break;
        }
    }
}

$cssClass = array_merge(
    !empty($aField['cssclass']) ? explode(' ', trim($aField['cssclass'])) : array(),
    !empty($aField['class']) ? explode(' ', trim($aField['class'])) : array()
);
if (!$valueExists || (isset($aField['required']) && empty($aField['value']))) {
    $cssClass[] = 'ml-error';
}

$cssClass = implode(' ', $cssClass);

if (!empty($mlAlertData)) {
    MLSettingRegistry::gi()->addJs('jquery.magnalister.form.select.js');
}

?>
<select <?php echo empty($mlAlertData) ? '' : "data-ml-alert='".$mlAlertData."' " ?>
    name="<?php echo MLHTTP::gi()->parseFormFieldName($aField['name']);?>"
    <?php echo isset($aField['id'])?  'id="'.$aField['id'].'"':uniqid('autoprefix-option')?>
    style="width:100%;" class="<?php echo $cssClass ?>">
    <?php
    if (!$valueExists) { ?>
        <option selected="selected" disabled="disabled"
            value="<?php echo $aField['value']; ?>"
        ><?php echo MLI18n::gi()->get('ML_LABEL_INVALID'); ?></option>
    <?php
    }
    $aField['type'] = 'am_optgroup';
    $this->includeType($aField);
    ?>
</select>

<?php
if (!empty($aField['isAttributeMatching']) && $aField['isAttributeMatching'] === true) {
    $sSelectId = $aField['id'];
    $inputSelector = '#' . $sSelectId . '_input';
    $bIsCustomAttribute = isset($aField['custom']) ? true : false;
    $inputName = '';
    $inputValue = '';
    $inputId = '';
    if ($bIsCustomAttribute) {
        $inputName = $aField['inputName'];
        $inputValue = $aField['inputValue'];
        $inputId = $aField['id'] . '_input';
    }
    ?>
    <script>
        (function($) {
            var isCustomAttribute = '<?php echo $bIsCustomAttribute ?>',
                selectElement = $('#' + ('<?php echo $sSelectId ?>'.replace(/[!"#$%&'()*+,.\/:;<=>?@[\\\]^`{|}~]/g, "\\$&"))),// some attribute of Etsy has these special character, that is problematic for Jquery selector
                disabledSelect = false;
            
            if (isCustomAttribute) {
                selectElement.parent()
                    .append('<input type="text" name="<?php echo $inputName ?>" value="<?php echo addslashes($inputValue) ?>" id="<?php echo $inputId ?>" class="<?php echo $cssClass ?>" style="margin-top:6px;"/>')
                    .html();

                selectElement.change(function(event, initial) {
                    var customAttributeNameInput = selectElement.parent().find('<?php echo $inputSelector ?>'),
                        selectedOption = selectElement.find('option:selected');

                    customAttributeNameInput.hide();

                    if (!initial) {
                        customAttributeNameInput.val(selectedOption.text());
                    }

                    if (!selectedOption.val()) {
                       customAttributeNameInput.val('');
                    }

                    if (selectedOption.val() === 'freetext') {
                        if (!initial) {
                            customAttributeNameInput.val('');
                        }
                        customAttributeNameInput.show();
                    }
                });

                selectElement.trigger('change', [true]);
            }

            selectElement.mouseup(addPrefix)
                .mouseleave(addPrefix)
                .keyup(doPrefixing)
                .mousedown(removePrefix);

            addPrefix.call(selectElement);

            function addPrefix() {
                if (!disabledSelect) {
                    var selectedOption = $(this).find(':selected'),
                        selectedOptionText = selectedOption.text(),
                        optGroup = selectedOption.closest('optgroup').attr('label');
                    $(this).find(':selected').text(optGroup && !selectedOptionText.includes(optGroup) ? optGroup + ': ' + selectedOptionText : selectedOptionText);
                }
                disabledSelect = true;
            }

            function removePrefix() {
                disabledSelect = false;
                $(this).find('option').each(function () {
                    var optionText = $(this).text().split('":"');
                    if (optionText[1] != '') {
                        $(this).text(optionText[1]);
                    }
                });
            }
    
            function doPrefixing() {
                removePrefix.call(this);
                addPrefix.call(this);
            }

            if (selectElement.children().length > 1) {
                selectElement.select2({
                    width: 'resolve'
                });
            }

        }(jqml));
    </script>
<?php
}
