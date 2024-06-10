                        <?php
                        $aSelect = array(
                            'name' => $aField['name'] . '[0][Shop][Key]',
                            'type' => 'otto_select2',
                            'isbrand' => $aField['isbrand'],
                            'i18n' => array(),
                            'values' => $aField['valuessrc'],
                            'value' => 'noselection',
                            'shopMatchingValue' => $aField['attributecode'],
                            'variationValue' => $aField['variationvalue'],
                            'customIdentifier' => $aField['customidentifier'],
                            'mpAttributeCode' => $aField['mpattributecode']
                        );

                        $aHidden = array(
                            'type' => 'hidden',
                            'id' => $sSelector . '_hidden_shop_value',
                            'name' => $aField['name'] . '[0][Shop][Value]'
                        );

                        if (isset($aField['error']) && $aField['error'] == true) {
                            $aSelect['cssclass'] = 'error';
                        }

                        $aNewArray = array(
                            'noselection' => MLI18n::gi()->get('otto_please_select'),
                            'all' => MLI18n::gi()->get('form_type_matching_select_all'),
                            // 'separator_line_3' => MLI18n::gi()->get($marketplaceName . '_prepare_variations_separator_line_label'),
                        );
                        foreach ($aSelect['values'] as $sSelectKey => $sSelectValue) {
                            $aNewArray[$sSelectKey] = $sSelectValue;
                        }

                        if (is_array($aField['values'])) {
                            foreach ($aField['values'] as $aValue) {
                                if (isset($aValue['Shop']['Key']) && !is_array($aValue['Shop']['Key'])) {
                                    unset($aNewArray[$aValue['Shop']['Key']]);
                                }
                            }
                        }
                        
                        $aSelect['values'] = $aNewArray;
                        $this->includeType($aSelect);
                        $this->includeType($aHidden);

                        $shopDataType = isset($aField['shopDataType']) ? $aField['shopDataType'] : 'text';
                        ?>
