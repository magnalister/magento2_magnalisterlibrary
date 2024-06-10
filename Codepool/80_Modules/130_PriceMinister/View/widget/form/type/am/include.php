<?php
/** @var string $tabType */
/** @var string $categoryId */
/** @var array $i18n */
/** @var ML_PriceMinister_Controller_PriceMinister_Prepare_Apply_Form $this */

if ($tabType !== 'variations') {
    $aCategoryAttributes = $this->getCategoryAttributes($categoryId);
    if (!empty($aCategoryAttributes)) {
        $aCategoryFieldset = array(
            'id' => $this->getIdent() . '_fieldset_' . $categoryId,
            'legend' => array(
                'i18n' => $i18n['legend']['subcategories'],
                'template' => 'h4',
            ),
            'row' => array(
                'template' => 'default',
            ),
        );

        foreach ($aCategoryAttributes as $sAttributeKey => $aAttribute) {
            $aMatchedAttributes = $this->getAttributeValues($categoryId, '', $sAttributeKey);
            $sBaseName = "field[variationgroups][$categoryId][$sAttributeKey]";
            $sName = $sBaseName . '[Values]';
            $sId = 'variationgroups.' . $categoryId . '.' . $sAttributeKey . '.code';
            $sKind = !empty($aAttribute['values']) ? 'Matching' : 'FreeText';
            $bError = $this->getErrorValue($categoryId, '', $sAttributeKey);

            $aSelectField = $this->getField($sId);
            $aSelectField['type'] = 'select';
            $aSelectField['values'] = array('' => ML_AMAZON_LABEL_APPLY_PLEASE_SELECT) + $aAttribute['values'];
            $aSelectField['value'] = $aMatchedAttributes;
            $aSelectField['name'] = $sName;
            $aSelectField['i18n'] = '';
            $style = '';
            if ($bError == true) {
                $aSelectField['cssclass'] = 'error';
                $style = 'color:#e31a1c';
            }

            $aSubfield = $this->getField($sId . '_sub');
            $aSubfield['type'] = 'subFieldsContainer';
            $aSubfield['i18n']['hint'] = isset($aAttribute['desc']) ? $aAttribute['desc'] : '';
            $aSubfield['i18n']['label'] = '<p style="display: inline-table;' . $style . '">' . $aAttribute['value'] .
                (($aAttribute['required']) ? '<span class="bull">&bull;</span></p>' : '');
            $aSubfield['subfields']['select'] = $aSelectField;

            $aSubfield['subfields'] = array_merge($aSubfield['subfields'], array(
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
                    'value' => $aAttribute['required'] ? true : false, // has to be bool
                    'padding-right' => 0,
                ),
                'hidden_attribute_name' => array(
                    'type' => 'hidden',
                    'name' => $sBaseName . '[AttributeName]',
                    'id' => $sId . '_attribute_name',
                    'value' => $aAttribute['value'],
                    'padding-right' => 0,
                ),
                'hidden_attribute_code' => array(
                    'type' => 'hidden',
                    'name' => $sBaseName . '[Code]',
                    'id' => $sId . '_attribute_name',
                    'value' => 'attribute_value',
                    'padding-right' => 0,
                ),
            ));

            $aCategoryFieldset['fields'][] = array(
                'subFieldsContainer' => $aSubfield,
            );

        }
        ?>
        <table class="attributesTable" id="attributesTable">
            <?php $this->includeView('widget_form_type_attributefield', array('aFieldset' => $aCategoryFieldset)); ?>
        </table>
        <?php
    }
}