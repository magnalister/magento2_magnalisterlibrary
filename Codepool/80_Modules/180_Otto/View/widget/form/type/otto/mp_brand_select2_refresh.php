
                        <div style="display: flex; justify-content: space-between; width: 100%">
                            <div style="width: 100%">
                                <?php
                                $aSelect = array(
                                    'name' => $aField['name'].'[0][Marketplace][Key]',
                                    'type' => 'otto_select2',
                                    'isbrand' => $aField['isbrand'],
                                    'i18n' => array(),
                                    'values' => $aField['valuesdst']['values'],
                                    'value' => 'noselection',
                                );

                                $aHidden = array(
                                    'type' => 'hidden',
                                    'id' => $sSelector.'_hidden_marketplace_value',
                                    'name' => $aField['name'].'[0][Marketplace][Value]'
                                );

                                if (isset($aField['error']) && $aField['error'] == true) {
                                    $aSelect['cssclass'] = 'error';
                                }

                                $aNewArray = array(
                                    'noselection' => MLI18n::gi()->get('otto_please_value_search'),
                                    'auto' => MLI18n::gi()->get('form_type_matching_select_auto'),
                                    'reset' => MLI18n::gi()->get('form_type_matching_select_reset'),
                                    'separator_line_3' => MLI18n::gi()->get($marketplaceName.'_prepare_variations_separator_line_label'),
                                );

                                if (is_array($aField['values'])) {
                                    foreach ($aField['values'] as $aValue) {
                                        if (isset($aValue['Marketplace']['Key']) && !is_array($aValue['Marketplace']['Key'])) {
                                            unset($aNewArray[$aValue['Marketplace']['Key']]);
                                        }
                                    }
                                }

                                $aSelect['values'] = $aNewArray;
                                $this->includeType($aSelect);
                                $this->includeType($aHidden);

                                $marketplaceDataType = isset($aField['marketplaceDataType']) ? $aField['marketplaceDataType'] : 'text';

                                if ($blDisableFreeText) { ?>
                                    <script>
                                        (function ($) {
                                            $('#<?php echo $sSelector.'_hidden_marketplace_value';?>').parent().find('select option[value="manual"]').attr('disabled', 'disabled');
                                        })(jqml);
                                    </script>
                                <?php }
                                ?>
                            </div>

                            <!-- RefreshBrands -->
                            <div style="background: #fff; padding: 2px; padding-top: 3px; border: 1px solid #dadada; margin-left: 12px; margin-bottom: 5px; height: 36px;">
                                <a id="refreshBrands" href="javascript:void(0);">
                                    <span class="ui-icon ui-icon-arrowrefresh-1-n ui-icon ui-icon-arrowrefresh-1-n refresh-btn">reload</span>
                                </a>
                            </div>
                            <!-- End RefreshBrands -->
                        </div>
