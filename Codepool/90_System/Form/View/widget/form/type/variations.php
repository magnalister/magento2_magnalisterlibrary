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
 * (c) 2010 - 2023 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

/** @var ML_Form_Controller_Widget_Form_VariationsAbstract $this */
if (!class_exists('ML', false))
    throw new Exception();
$marketplaceName = MLModule::gi()->getMarketPlaceName();
// if there are more than 5 optional attributes, they are displayed as a dropdown
$optionalAttributesMaxSize = 5;
$mParentValue = $this->getField('variationgroups.value', 'value');

// Getting type of tab (is it variation tab or apply form)
$sChangedSelector = ' ' . $aField['id'];
$ini = strpos($sChangedSelector, $marketplaceName . '_prepare_');
if ($ini == 0) return '';
$ini += strlen($marketplaceName . '_prepare_');
$len = strpos($sChangedSelector, '_field', $ini) - $ini;
$tabType = substr($sChangedSelector, $ini, $len);

//Check if collapsing field should be set
$aActions = $this->getRequest($this->sActionPrefix);
$sAction = isset($aActions['prepareaction']) ? $aActions['prepareaction'] : '';

if (is_array($mParentValue)) {
    reset($mParentValue);
    $mParentValue = key($mParentValue);
}

$sCustomAttribute = $this->getField('attributename', 'value');
if ($sCustomAttribute !== null) {
    $mParentValue = $sCustomAttribute;
}

if (strpos($mParentValue, ':') !== false) {
    $mParentValue = explode(':', $mParentValue);
    $mParentValue = $mParentValue[0];
}

$sCustomIdentifier = $this->getCustomIdentifier();

$i18n = $this->getFormArray('aI18n');
if (!empty($mParentValue) && $mParentValue !== 'none' && $mParentValue !== 'new') {
    $aShopAttributes = $this->getShopAttributes();
    $aShopCustomAttributes = $aShopAttributes;
    $dModificationDate = $this->getModificationDate($mParentValue, $sCustomIdentifier);

    $aShopAttributes[MLI18n::gi()->get( 'attributes_matching_additional_options')] = array(
        'freetext' => array('name' => MLI18n::gi()->get($marketplaceName . '_prepare_variations_free_text')),
        'attribute_value' => array('name' => MLI18n::gi()->get($marketplaceName . '_prepare_variations_choose_mp_value')),
        'optGroupClass' => 'additionalOptions'
    );
    $aShopCustomAttributes[MLI18n::gi()->get('attributes_matching_additional_options')] = array(
        'freetext' => array('name' => MLI18n::gi()->get($marketplaceName . '_prepare_variations_free_text')),
        'optGroupClass' => 'additionalOptions'
    );

    $aMPAttributes = $this->getMPVariationAttributes($mParentValue);

    $aFieldset = array(
        'id' => $this->getIdent() . '_fieldset_' . $mParentValue,
        'legend' => array(
            'i18n' => isset($i18n['legend']['variationmatching']) ? $i18n['legend']['variationmatching'] : '',
            'template' => 'two-columns',
        ),
        'row' => array(
            'template' => 'default',
        ),
    );

    $aFieldsetOptional = array(
        'id' => $this->getIdent() . '_fieldset_optional_' . $mParentValue,
        'legend' => array(
            'i18n' => isset($i18n['legend']['variationmatchingoptional']) ? $i18n['legend']['variationmatchingoptional'] : '',
            'template' => 'two-columns',
        ),
        'row' => array(
            'template' => 'default',
        ),
        'fields' => array(),
    );

    $aFieldsetCustom = array(
        'id' => $this->getIdent() . '_fieldset_custom_' . $mParentValue,
        'legend' => array(
            'i18n' => isset($i18n['legend']['variationmatchingcustom']) ? $i18n['legend']['variationmatchingcustom'] : '',
            'template' => 'two-columns',
        ),
        'row' => array(
            'template' => 'default',
        ),
        'fields' => array(),
    );

    $optionalAttributesMap = array();

    $sizeOfOptionalAttributes = 0;
    foreach ($aMPAttributes as $sAttribute) {
        if (!isset($sAttribute['required']) || !$sAttribute['required']) {
            $sizeOfOptionalAttributes++;
        }
    }

    $aSavedValues = $this->getAttributeValues($mParentValue, $sCustomIdentifier);

    foreach ($aMPAttributes as $key => $sAttribute) {
        $aMatchedAttributes = $this->getAttributeValues($mParentValue, $sCustomIdentifier, $key);
        $sAttribute['custom'] = !empty($sAttribute['custom']) ? $sAttribute['custom'] : false;
        $sBaseName = "field[variationgroups][$mParentValue][$key]";
        $sName = $sBaseName . '[Code]';
        $sId = 'variationgroups.' . $mParentValue . '.' . $key . '.code';
        $sCustomAttributeId = 'variationgroups.' . $mParentValue . '.' . $key . '.custom_name';
        $sKind = !empty($sAttribute['values']) ? 'Matching' : 'FreeText';
        $bError = $this->getErrorValue($mParentValue, $sCustomIdentifier, $key);
        $required = isset($sAttribute['required']) && $sAttribute['required'];
        $attributeDataType = !empty($sAttribute['dataType']) ? $sAttribute['dataType'] : 'text';

        $aSelectField = $this->getField($sId);
        $aSelectField['type'] = 'am_attributesselect';
        if (!empty($aSelectField['value'])) {
            $aSelectField['values'] = $aShopAttributes;
        }

        $aSelectField['isAttributeMatching'] = true;
        $aSelectField['name'] = $sName;
        $aSelectField['i18n'] = isset($i18n['field']['webshopattribute']) ? $i18n['field']['webshopattribute'] : '';

        $aCustomSelectField = $this->getField($sCustomAttributeId);
        $aCustomSelectField['type'] = 'am_attributesselect';
        $aCustomSelectField['values'] = $aShopCustomAttributes;
        $aCustomSelectField['isAttributeMatching'] = true;
        $aCustomSelectField['name'] = $sBaseName . '[CustomAttributeNameCode]';
        $aCustomSelectField['inputName'] = 'ml' . "[field][variationgroups][$mParentValue][$key]" . '[AttributeName]';
        $aCustomSelectField['i18n'] = isset($i18n['field']['webshopattribute']) ? $i18n['field']['webshopattribute'] : '';
        $aCustomSelectField['custom'] = true;

        $style = '';
        if ($bError == true) {
            $aSelectField['cssclass'] = 'error';
            $aCustomSelectField['cssclass'] = 'error';
            $style = 'color:#e31a1c;';
        }

        $aAjaxField = $this->getField($sId . '_ajax');
        $aAjaxField['type'] = 'attributeajax';
        $aAjaxField['cascading'] = true;
        $aAjaxField['breakbefore'] = true;
        $aAjaxField['padding-right'] = 0;
        $aAjaxField['i18n']['label'] = '';
        if (isset($aSelectField['value']) && $aSelectField['value'] != null) {
            // value field on ajax is used to initialize cascading ajax fields in attributematch.php
            // when variation group is selected
            $aAjaxField['value'] = array(
                $key => $aSelectField['value'],
                'name' => 'variationgroups.' . $mParentValue . '.' . $key,
            );
        }
        $sJSSelector = str_replace(array('/', ' ', '(', ')'), array('\\/', '\\ ', '\\(', '\\)'), $aSelectField['id']);// some attribute of Etsy has these special character, that is problematic for Jquery selector
        $aAjaxField['ajax'] = array(
            'selector' => '#' . $sJSSelector,
            'trigger' => 'change',
            'field' => array(
                'id' => $sId . '_ajax_field',
                'type' => 'attributematch',
            ),
        );

        $aSubfield = $this->getField($sId . '_sub');
        $aSubfield['type'] = 'subFieldsContainer';
        $aSubfield['i18n']['hint'] = isset($sAttribute['desc']) ? $sAttribute['desc'] : '';
        $sAttributeValue = isset($sAttribute['value']) ? $sAttribute['value'] : '';
        $aSubfield['i18n']['label'] = '<p style="display: inline-table;' . $style . '">' . $sAttributeValue
            . ($required ? '<span class="bull">&bull;</span></p>' : '</p>');
        $aSubfield['subfields']['select'] = $aSelectField;

        if (MLHelper::gi('Model_Service_AttributesMatching')->isMultiSelectType($attributeDataType)) {
            $aSubfield['i18n']['hint'] = !empty($aSubfield['i18n']['hint']) ? $aSubfield['i18n']['hint'] . '<br>' : '';
            $aSubfield['i18n']['hint'] .= MLI18n::gi()->get($marketplaceName . '_prepare_variations_multiselect_hint');
        }

        $aSubfieldExtra = $this->getField($sId . '_sub');
        $aSubfieldExtra['type'] = 'subFieldsContainer';

        if (!empty($aMatchedAttributes)) {
            if (!empty($aSelectField['value'])) {
                $aSubfieldExtra['subfields']['deletebutton'] = array(
                    'id' => $sId . '_button_matching_delete',
                    'type' => 'deletematchingbutton',
                    'name' => $sBaseName,
                    'i18n' => array(
                        'info' => MLI18n::gi()->get($marketplaceName . '_prepare_variations_already_matched'),
                    ),
                    'float' => 'left',
                    'value' => $key,
                );
            }

            if (!empty($aSelectField['value']) && !empty($sAttribute['changed']) && !empty($dModificationDate)
                && strtotime($sAttribute['changed']) > strtotime($dModificationDate)) {
                $aSubfieldExtra['subfields']['warning'] = array(
                    'type' => 'warning',
                    'name' => $sBaseName . '[Warning]',
                    'id' => $sId . '_warning',
                    'i18n' => array(
                        'title' => $sAttribute['value'],
                        'text' => MLI18n::gi()->get($marketplaceName . '_varmatch_attribute_changed_on_mp'),
                    ),
                );
            }

            if (!empty($aSelectField['value']) && $tabType !== 'variations' && is_array($aMatchedAttributes)) {
                $aSubfieldExtra['subfields']['collapsebutton'] = array(
                    'id' => $sId . '_button_matching_collapse',
                    'type' => 'collapsebutton',
                    'name' => $sBaseName . '[Collapse]',
                    'float' => 'right',
                    'padding-right' => 0,
                );
            }

            $aSubfieldExtra['Expand'] = $sAction === $key;
        } else if (!$required) {
            if (!$sAttribute['custom'] && !isset($aSavedValues[$key])) {
                $aSubfield['classes'] = array_merge(
                    !empty($aSubfield['classes']) ? $aSubfield['classes'] : array(),
                    array('optionalAttribute', $aSubfield['id'])
                );
                if ($sizeOfOptionalAttributes > $optionalAttributesMaxSize) {
                    $aSubfield['classes'][] = 'hide';
                }

                $optionalAttributesMap[$aSelectField['id']] = $aSubfield['i18n']['label'];
            }

            if (!empty($aSelectField['value'])) {
                $aSubfieldExtra['subfields']['deletebutton'] = array(
                    'id' => $sId . '_button_matching_delete',
                    'type' => 'deletematchingbutton',
                    'name' => $sBaseName,
                    'i18n' => array(
                        'info' => MLI18n::gi()->get($marketplaceName . '_prepare_variations_already_matched'),
                    ),
                    'float' => 'left',
                    'value' => $key,
                );
            } else if ($sAttribute['custom'] || $sizeOfOptionalAttributes > $optionalAttributesMaxSize) {
                $aSubfieldExtra['subfields']['addbutton'] = array(
                    'id' => $sId . '_button_matching_add',
                    'type' => 'addmatchingbutton',
                    'classes' => array('add-matching'),
                    'value' => $key,
                );
            }
        }

        if (isset($sAttribute['modified']) && $sAttribute['modified'] !== false) {
            $aSubfieldExtra['subfields']['warning'] = array(
                'type' => 'warning',
                'name' => $sBaseName . '[Warning]',
                'id' => $sId . '_warning',
                'i18n' => array(
                    'title' => $sAttribute['value'],
                    'text' => MLI18n::gi()->get($marketplaceName . '_varmatch_attribute_different_on_product'),
                ),
            );
        }

        $warningMessageCode = '_varmatch_attribute_deleted_from_shop';

        if (isset($aSavedValues[$key])
            && $this->detectIfAttributeIsDeletedOnShop($aSavedValues[$key], $warningMessageCode)
        ) {
            $aSubfieldExtra['subfields']['warning1'] = array(
                'type' => 'warning',
                'name' => $sBaseName . '[DeletedFromShopWarning]',
                'id' => $sId . '_deleted_from_shop_warning',
                'i18n' => array(
                    'title' => $sAttribute['value'],
                    'text' => MLI18n::gi()->get($marketplaceName . $warningMessageCode),
                ),
            );
        }

        $aAttributeMatchingSubfields = array(
            'hidden_kind' => array(
                'type' => 'hidden',
                'name' => $sBaseName . '[Kind]',
                'id' => $sId . '_kind',
                'value' => $sKind,
                'padding-right' => 0,
            ),
            'hidden_required' => array(
                'type' => 'hidden',
                'name' => $sBaseName . '[Required]',
                'id' => $sId . '_required',
                'value' => $required,
                'padding-right' => 0,
            ),
            'hidden_data_type' => array(
                'type' => 'hidden',
                'name' => $sBaseName . '[DataType]',
                'id' => $sId . '_data_type',
                'value' => $attributeDataType,
                'padding-right' => 0,
            ),
        );

        if (!empty($sAttribute['custom'])) {
            $aCustomSelectField['value'] = !empty($aSavedValues[$key]['CustomAttributeNameCode']) ? $aSavedValues[$key]['CustomAttributeNameCode'] : '';
            $aCustomSelectField['inputValue'] = !empty($aSavedValues[$key]['AttributeName']) ? $aSavedValues[$key]['AttributeName'] : '';
            $aSubfield['customAttributeSelect'] = $aCustomSelectField;
        } else {
            $aAttributeMatchingSubfields['hidden_attribute_name'] = array(
                'type' => 'hidden',
                'name' => $sBaseName . '[AttributeName]',
                'id' => $sId . '_attribute_name',
                'value' => isset($sAttribute['value']) ? $sAttribute['value'] : '',
                'padding-right' => 0,
            );
        }
        if (isset($sAttribute['attributeId'])) {
            $aAttributeMatchingSubfields['hidden_attribute_id'] = array(
                'type' => 'hidden',
                'name' => $sBaseName . '[AttributeId]',
                'id' => $sId . '_attribute_id',
                'value' => $sAttribute['attributeId'],
                'padding-right' => 0,
            );
        }

        if (!empty($sAttribute['categoryId'])) {
            $aAttributeMatchingSubfields['categoryIdhidden'] = array(
                'type' => 'hidden',
                'name' =>  $sBaseName . '[CategoryId]',
                'id' => $sId . '_category_id',
                'value' => $sAttribute['categoryId'],
                'padding-right' => 0,
            );
        }

        $aSubfield['subfields'] = array_merge($aSubfield['subfields'], $aAttributeMatchingSubfields);

        if ($required) {
            $aFieldset['fields'][] = array(
                'subFieldsContainer' => $aSubfield,
                'subFieldsContainerExtra' => $aSubfieldExtra,
                'ajax' => $aAjaxField,
            );
        } else if ($sAttribute['custom']) {
            $aFieldsetCustom['fields'][] = array(
                'subFieldsContainer' => $aSubfield,
                'subFieldsContainerExtra' => $aSubfieldExtra,
                'ajax' => $aAjaxField,
            );
        } else {
            $aFieldsetOptional['fields'][] = array(
                'subFieldsContainer' => $aSubfield,
                'subFieldsContainerExtra' => $aSubfieldExtra,
                'ajax' => $aAjaxField,
            );
        }
    }

    foreach ($aSavedValues as $sCode => $aAttribute) {
        if (empty($aMPAttributes[$sCode])) {
            // deleted from marketplace
            $sId = 'variationgroups.' . $mParentValue . '.' . $sCode . '.code';

            $aSubfield = $this->getField($sId . '_sub');
            $aSubfield['type'] = 'subFieldsContainer';
            $aSubfield['i18n']['hint'] = '';
            $aSubfield['i18n']['label'] = '<p class="error">' . $aAttribute['AttributeName'] . '</p>';
            $aSubfield['subfields']['information'] = array(
                'type' => 'information',
                'value' => '<p class="error">' . MLI18n::gi()->get($marketplaceName . '_varmatch_attribute_deleted_from_mp') . '</p>',
            );

            $aFieldset['fields'][] = array('subFieldsContainer' => $aSubfield);
        }
    }

    $this->includeView('widget_form_type_am_include', array(
        'i18n' => $i18n,
        'categoryId' => $mParentValue,
        'tabType' => $tabType,
        'aMPAttributes' => $aMPAttributes,
    ));

    if (!empty($aFieldset['fields'])
        || (empty($aFieldset['fields']) && empty($aFieldsetOptional['fields']) && empty($aFieldsetCustom['fields']))
    ) {
    ?>
        <table class="attributesTable ml-js-attribute-matching" id="attributesTable">
            <?php $this->includeView('widget_form_type_attributefield', array('aFieldset' => $aFieldset)); ?>
        </table>
    <?php }
    if (!empty($aFieldsetOptional['fields'])) { ?>
        <table class="attributesTable ml-js-attribute-matching" id="attributesTableOptional">
            <?php $this->includeView('widget_form_type_attributefield', array('aFieldset' => $aFieldsetOptional)); ?>
        </table>
    <?php }
    if (!empty($aFieldsetCustom['fields'])) {
        ?>
        <table class="attributesTable ml-js-attribute-matching" id="attributesTableCustom">
            <?php $this->includeView('widget_form_type_attributefield', array('aFieldset' => $aFieldsetCustom)); ?>
        </table>
    <?php } ?>
    <p><?php echo MLI18n::gi()->get($marketplaceName . '_prepare_variations_mandatory_fields_info') ?></p>
    <script type="text/javascript">/*<![CDATA[*/
        (function($) {
            $(document).ready(function() {
                var optionalAttributesMaxSize = <?php echo $optionalAttributesMaxSize ?>,
                    savedAttributes = <?php echo json_encode($aSavedValues);?>,
                    additionalAttributeIndicator = 'additional_attribute',
                    attributesOptions = <?php echo json_encode($aShopAttributes) ?>;

                $('#attributesTable > tbody > tr').removeClass('odd even');

                $('#<?php echo $marketplaceName ?>_prepare_variations_field_variationgroups_value').change(function() {
                    $('div.noticeBox').remove();
                });

                function fireAttributeAjaxRequest(eElement, ajaxAdditional, selector, oldValue) {
                    var selectorName = selector.substring(1),
                        extraField =  $('div#attributeExtraFields_' + selectorName + '_sub span');
                    extraField.children('.add-matching').show();
                    $('[id^=attributeDropDown_' + selectorName + ']').css('background-color', '');
                    if ($.trim($(selector + '_button_matched_table').html())) {
                        var d = '<?php echo addslashes(MLI18n::gi()->get($marketplaceName . '_prepare_variations_change_attribute_info')) ?>';
                        $('<div class="ml-modal dialog2" title="<?php echo addslashes(MLI18n::gi()->get('ML_LABEL_NOTE')) ?>"></div>').html(d).jDialog({
                            width: (d.length > 1000) ? '700px' : '500px',
                            buttons: {
                                'OK': function() {
                                    var selectElement = $(selector),
                                        lastSelectedOption = selectElement.find('option[value='+ oldValue +'] '),
                                        optGroup = lastSelectedOption.closest('optgroup').attr('label'),
                                        optionText = lastSelectedOption.text().split(':')[1] ?
                                            lastSelectedOption.text().split(':')[1] : lastSelectedOption.text();
                                    lastSelectedOption.text(optGroup ? optGroup + ': ' + optionText : optionText);
                                    selectElement.val(oldValue);
                                    $(this).dialog('close');
                                }
                            }
                        });
                    } else {
                        if (selector.indexOf(additionalAttributeIndicator) === -1) {
                            extraField.children('*:not(.add-matching)').hide();
                        }
                        $('div#attributeMatchedTable_' + selectorName + '_sub').show();

                        $.blockUI(blockUILoading);
                        var eForm = eElement.parentsUntil('form').parent(),
                            aData = $(eForm).serializeArray(),
                            aAjaxData = $.parseJSON(eElement.attr('data-ajax')),
                            i;

                        for (i in aAjaxData) {
                            if (aAjaxData.hasOwnProperty(i)) {
                                if (aAjaxData[i]['value'] === null) {
                                    aAjaxData[i]['value'] = ajaxAdditional;
                                }

                                aData.push(aAjaxData[i]);
                            }
                        }
                        aData = mlSerializer.prepareSerializedDataForAjax(aData);
                        eElement.hide('slide', {direction: 'right'});
                        $.ajax({
                            url: eForm.attr("action"),
                            type: eForm.attr("method"),
                            data: aData,
                            complete: function () {
                                var eRow;
                                try {// need it for ebay-categories and attributes, cant do with global ajax, yet
                                    var oJson = $.parseJSON(data);
                                    var content = oJson.content;
                                    eElement.html(content);
                                } catch (oExeception) {
                                }

                                eRow = eElement.closest('.js-field');
                                if (!eRow.hasClass('hide')) {
                                    eRow.show();
                                } else {
                                    eRow.hide();
                                }

                                initAttributeAjaxForm(eElement, true);
                                $.unblockUI();
                                eElement.show('slide', {direction: 'right'});
                                $(".magnalisterForm select.optional").trigger("change");
                            }
                        });
                    }
                }

                function initAttributeAjaxForm(eElements, onlyChildren) {
                    var els = eElements.find('.magnalisterAttributeAjaxForm');
                    if (!onlyChildren) {
                        els = els.andSelf();
                    }

                    els.each(function() {
                        var eElement = $(this),
                            aAjaxController = $.parseJSON(eElement.attr('data-ajax-controller'));

                        if (aAjaxController !== null) {
                            var previous;
                            if (eElement.find(aAjaxController.selector).length === 0) {
                                $(eElements).find(aAjaxController.selector).on('focus', function() {
                                    previous = $(aAjaxController.selector).val();
                                }).change(function(event) {
                                    fireAttributeAjaxRequest(eElement, event.ajaxAdditional, aAjaxController.selector,
                                        previous);
                                    previous = $(aAjaxController.selector).val();
                                });
                            } else {
                                $(eElement).on('focus', $('.magnalisterForm').find(aAjaxController.selector), function() {
                                    previous = $(aAjaxController.selector).val();
                                }).change(function(event) {
                                    fireAttributeAjaxRequest(eElement, event.ajaxAdditional, aAjaxController.selector,
                                        previous);
                                    previous = $(aAjaxController.selector).val();
                                });
                            }

                            if (eElement.attr('data-ajax-trigger') === 'true') {
                                // only trigger by first load
                                eElement.attr('data-ajax-trigger', 'false');
                                fireAttributeAjaxRequest(eElement);
                            }
                        }
                    });

                    // detach double click on attribute tables header because it reveals rows hidden on purpose
                    eElements.off('dblclick', 'tr.headline');
                }

                initAttributeAjaxForm($('.magnalisterForm'));
                $('button.delete-matched-value').click(function() {
                    var form = $(this).closest('form');
                    $(this).closest('table')[0].deleteRow(this.parentNode.parentNode.rowIndex);

                    <?php if ($tabType === 'variations') { ?>
                        var actionData = {"ml[action][saveaction]":"0"};
                    <?php } else { ?>
                        var actionData = {"ml[action][prepareaction]":this.value};
                    <?php }?>
                    mlSerializer.submitSerializedForm(form, actionData);
                });

                // Optional attributes matching JS logic
                function initOptionalAttributesSelector() {
                    var optionalFieldsetEl = $('#<?php echo $aFieldsetOptional['id']?>'),
                        spacerFieldEl = optionalFieldsetEl.find('.spacer').last(),
                        optionalAttributesMap = <?php echo json_encode($optionalAttributesMap)?>,
                        sizeOfOptionalAttributes = <?php echo $sizeOfOptionalAttributes ?>,
                        currentlySelectedAttribute = null,
                        attributesSelectorEl = null,
                        attributesSelectorOptionsTpl = ['<option value="dont_use"><?php echo addslashes(MLI18n::gi()->get('ML_LABEL_DONT_USE')) ?></option>'];

                    for (var fieldId in optionalAttributesMap) {
                        if (optionalAttributesMap.hasOwnProperty(fieldId)) {
                            attributesSelectorOptionsTpl.push(
                                '<option value="' + fieldId + '">' + optionalAttributesMap[fieldId] + '</option>'
                            );
                        }
                    }

                    // If there is no optional attributes quit
                    if (attributesSelectorOptionsTpl.length === 1) {
                        return;
                    }

                    if (sizeOfOptionalAttributes > optionalAttributesMaxSize) {
                        $([
                            '<tr class="js-field hide optionalAttribute dont_use_sub">',
                            '<th><label for="dont_use_sub"></label></th>',
                            '<td class="mlhelp ml-js-noBlockUi"></td>',
                            '<td class="input"></td>',
                            '<td class="info"></td>',
                            '</tr>'
                        ].join('')).insertBefore(spacerFieldEl);
                    }

                    attributesSelectorEl = jqml([
                        '<select class="ml-searchable-select" name="optional_selector" style="width: 100%">',
                        attributesSelectorOptionsTpl.join(''),
                        '</select>'
                    ].join(''));

                    // sort items alphabetic
                    attributesSelectorEl.html(attributesSelectorEl.find('option').sort(function(x, y) {
                        if($(x).val() == 'dont_use'){
                            return -1;
                        }
                        return $(x).text().toLowerCase() > $(y).text().toLowerCase() ? 1 : -1;
                    }));
                    //select "dont_use" as default
                    attributesSelectorEl.val('dont_use');

                    function showConfirmationDialog(attributeIdToShow) {
                        var d = '<?php echo addslashes(MLI18n::gi()->get($marketplaceName . '_prepare_variations_reset_info')) ?>';
                        $('<div class="ml-modal dialog2" title="<?php echo addslashes(MLI18n::gi()->get('ML_LABEL_INFO')) ?>"></div>').html(d).jDialog({
                            width: (d.length > 1000) ? '700px' : '500px',
                            buttons: {
                                Cancel: {
                                    'text': '<?php echo addslashes(MLI18n::gi()->get('ML_BUTTON_LABEL_ABORT')); ?>',
                                    click: function() {
                                        // Reset attribute selector to previous value silently
                                        attributesSelectorEl.val(currentlySelectedAttribute);
                                        $(this).dialog('close');
                                    }
                                },
                                Ok: {
                                    'text': '<?php echo addslashes(MLI18n::gi()->get('ML_BUTTON_LABEL_OK')); ?>',
                                    click: function() {
                                        $('#' + currentlySelectedAttribute).val('').change();
                                        changeCurrentAttribute(attributeIdToShow);
                                        $(this).dialog('close');
                                    }
                                }
                            }
                        });
                    }

                    function attributeSelectorOnChange() {
                        if (currentlySelectedAttribute) {
                            var attributeValue = $('#' + currentlySelectedAttribute).val();
                            if (attributeValue) {
                                showConfirmationDialog($(this).val());
                                return;
                            }
                        }

                        changeCurrentAttribute($(this).val());
                    }

                    function changeCurrentAttribute(attributeIdToShow) {

                        if (jqml('#' + attributeIdToShow).hasClass("select2-hidden-accessible")) {
                            jqml('#' + attributeIdToShow).select2('destroy');
                        }

                        if (attributesSelectorEl.hasClass("select2-hidden-accessible")) {
                            attributesSelectorEl.select2('destroy');
                        }

                        if (sizeOfOptionalAttributes > optionalAttributesMaxSize) {
                            optionalFieldsetEl.find('.optionalAttribute').addClass('hide').hide();
                        }

                        currentlySelectedAttribute = attributeIdToShow;

                        var attributeFieldEl = optionalFieldsetEl.find('.' + currentlySelectedAttribute + '_sub'),
                            currentAttributeLabelEl = attributeFieldEl.find('label[for="' + currentlySelectedAttribute + '_sub"]').hide();

                        attributesSelectorEl.insertBefore(currentAttributeLabelEl);
                        attributeFieldEl.remove().removeClass('hide').show().insertBefore(spacerFieldEl);
                        initAttributeAjaxForm(attributeFieldEl, true);

                        attributesSelectorEl.select2({
                            width: 'resolve'
                        });

                        attributesSelectorEl.on('select2:select select2:unselecting', attributeSelectorOnChange);

                        jqml('#'+attributeIdToShow).select2({
                            width: 'resolve'
                        });
                        jqml('#' + attributeIdToShow).on('select2:open', function (e) {
                            if (this.options.length === 1) {
                                var name = jqml(this).attr('name'),
                                    mpDataType = jqml('input[name="' + name.replace('[Code]', '[DataType]') + '"]').val(),
                                    span = jqml(this).closest("span"),
                                    select = jqml('select[name="' + name + '"]');

                                span.css("width", "81%");
                                jqml(this).find('option').remove().end();
                                renderOptions(jqml(this));
                                jqml(this).trigger('input');

                                if (mpDataType) {
                                    mpDataType = mpDataType.toLowerCase();
                                    isSelectAndText = mpDataType === 'selectandtext';
                                }

                                select.find('option[value^=separator]').attr('disabled', 'disabled');

                                if (['select', 'multiselect'].indexOf(mpDataType) != -1) {
                                    select.find("option[data-type='text']").attr('disabled', 'disabled');
                                    select.find('option[value=freetext]').attr('disabled', 'disabled');
                                }

                                if ('text' == mpDataType) {
                                    select.find('option[value=attribute_value]').attr('disabled', 'disabled');
                                }


                            }
                        });
                    }

                    attributesSelectorEl.change(attributeSelectorOnChange).change();

                    jqml('select[name="optional_selector"]').each(function (index, link) {
                        if  (!jqml(this).hasClass("select2-hidden-accessible")) {
                            jqml(this).select2({
                                width: 'resolve'
                            });
                        }
                    });

                }

                function appendOption(element, key, value, selected, dataType) {
                    var option = $('<option value="' + key + '">' + value + '</option>');
                    if (selected) {
                        option.attr('selected', 'selected');
                    }

                    if (dataType !== undefined) {
                        option.attr('data-type', dataType);
                    }

                    element.append(option);
                }

                function renderOptions(select) {
                    var selectedValue = select.attr('data-value');

                    for (var optionKey in attributesOptions) {
                        if (!attributesOptions.hasOwnProperty(optionKey)) {
                            continue;
                        }

                        var optionValue = attributesOptions[optionKey],
                            selected = selectedValue === optionKey;

                        if (typeof optionValue !== 'object') {
                            // simple option -> render it
                            appendOption(select, optionKey, optionValue, selected);
                        } else {
                            // this is optgroup so we need to render it
                            var optGroup = $('<optgroup label="' + optionKey + '" class="' +
                                optionValue.optGroupClass + '"></optgroup>');
                            for (var attributeKey in optionValue) {
                                // render attributes
                                if (optionValue.hasOwnProperty(attributeKey) && attributeKey !== 'optGroupClass') {
                                    var attribute = optionValue[attributeKey];
                                    appendOption(optGroup, attributeKey, attribute.name, selected, attribute.type);
                                }
                            }

                            select.append(optGroup);
                        }
                    }
                }

                // for each attribute if it has predefined values, only direct matching is possible
                // so free text fields and attributes must be disabled
                // if not, matching to attribute value must be disabled
                $('input[id$="_kind"]').each(function() {
                    var $input = $(this),
                        name = $input.attr('name').replace('[Kind]', '[Code]'),
                        customAttributeName = $input.attr('name').replace('[Kind]', '[CustomAttributeNameCode]'),
                        select = $('select[name="' + name + '"]'),
                        span = select.closest('span'),
                        mpDataType = $('input[name="' + name.replace('[Code]', '[DataType]') + '"]').val(),
                        isSelectAndText = false,
                        attributeNameSelect = $('select[name="' + customAttributeName + '"]');

                    span.css("width", "83%");
                    var selectElement = document.getElementsByName(name);
                    selectElement = selectElement[0] ? selectElement[0] : null;
                    var dontUseLabel = <?php echo json_encode(MLI18n::gi()->get('ML_LABEL_DONT_USE')) ?>;
                    if (!selectElement.options.length) {
                        appendOption(select, '', dontUseLabel, false);
                    } else {
                        if (mpDataType) {
                            mpDataType = mpDataType.toLowerCase();
                            isSelectAndText = mpDataType === 'selectandtext';
                        }

                        select.find('option[value^=separator]').attr('disabled', 'disabled');

                        if (['select', 'multiselect'].indexOf(mpDataType) != -1) {
                            select.find("option[data-type='text']").attr('disabled', 'disabled');
                            select.find('option[value=freetext]').attr('disabled', 'disabled');
                        }

                        if ('text' == mpDataType) {
                            select.find('option[value=attribute_value]').attr('disabled', 'disabled');
                        }
                    }

                    if (!isSelectAndText) {
                        if (attributeNameSelect.length > 0) {
                            for (var property in savedAttributes) {
                                if (savedAttributes.hasOwnProperty(property)) {
                                    var valueToCheck = $('<textarea />').html(savedAttributes[property]['AttributeName']).text(),
                                        optionToCheck = null;

                                    $.each(attributeNameSelect.find("option"), function (index, option) {
                                        option = $(option);
                                        if (option.text() === valueToCheck) {
                                            optionToCheck = option;
                                        }
                                    });

                                    if (optionToCheck && optionToCheck.text() !== attributeNameSelect.find(':selected').text()) {
                                        optionToCheck.attr('disabled', 'disabled');
                                    }
                                }
                            }
                            attributeNameSelect.find('option[value^=separator]').attr('disabled', 'disabled');
                            attributeNameSelect.find('option[value=attribute_value]').attr('disabled', 'disabled');
                        }
                    }

                    select.select2({
                        width: 'resolve'
                    });
                    select.on('select2:open', function () {
                        if (this.options.length === 1) {
                            $(this).find('option').remove().end();
                            renderOptions($(this));

                            if (mpDataType) {
                                mpDataType = mpDataType.toLowerCase();
                                isSelectAndText = mpDataType === 'selectandtext';
                            }

                            select.find('option[value^=separator]').attr('disabled', 'disabled');

                            if (['select', 'multiselect'].indexOf(mpDataType) != -1) {
                                select.find("option[data-type='text']").attr('disabled', 'disabled');
                                select.find('option[value=freetext]').attr('disabled', 'disabled');
                            }

                            if ('text' == mpDataType) {
                                select.find('option[value=attribute_value]').attr('disabled', 'disabled');
                            }
                        }
                    });

                });

                initOptionalAttributesSelector();
            });
        })(jqml);
    /*]]>*/</script>


    <style>
        table.attributesTable th span, span.bull {
            font-size: 12px !important;
            vertical-align: text-top;


        }
    </style>
    <?php
}
