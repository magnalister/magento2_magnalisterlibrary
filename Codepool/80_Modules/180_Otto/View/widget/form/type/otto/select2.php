<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $aField array array('name'=>'', 'value'=>'', 'values'=>array('key'=> 'value'), 'shopMatchingValue'=>'') */
 if (!class_exists('ML', false))
     throw new Exception();
?>
<?php if (isset($aField)) {
    $selectid = isset($aField['id']) ? 'id="'.$aField['id'].'"' : uniqid('autoprefix-option');
    if (!empty($aField['value']) && isset($aField['values'][$aField['value']])) {
        $blValueExists = false;
    } else {
        $blValueExists = true;
    }
    ?>
    <div style="width: 100%" class='ml-searchable-select' lang="<?php echo strtolower(MLLanguage::gi()->getCurrentIsoCode()); ?>" >
        <select style="width: 100%"
                class="<?php echo isset($aField['shopBrand']) ? $aField['shopBrand'] : ''; ?>"
                data-css="<?php echo isset($aField['cssclass']) ? $aField['cssclass'] : ''; ?>"
                data-shopmatchingvalue="<?php echo isset($aField['shopMatchingValue']) ? $aField['shopMatchingValue'] : ''; ?>"
                data-variationvalue="<?php echo isset($aField['variationValue']) ? $aField['variationValue'] : ''; ?>"
                data-customidentifier="<?php echo isset($aField['customIdentifier']) ? $aField['customIdentifier'] : ''; ?>"
                data-excludeauto="<?php echo isset($aField['excludeauto']) ? $aField['excludeauto'] : ''; ?>"
                data-mpattributecode="<?php echo isset($aField['mpAttributeCode']) ? $aField['mpAttributeCode'] : ''; ?>"
                data-isbrand="<?php echo isset($aField['isbrand']) && $aField['isbrand'] != null ? $aField['isbrand'] : 0; ?>"
                name="<?php echo empty($aField['name']) ? '' : MLHttp::gi()->parseFormFieldName($aField['name']);?>"
            <?php echo 'id="'.$selectid.'"'?>>
            <?php if (!empty($aField['values']) && isset($aField['isbrand']) && !$aField['isbrand']) {
                foreach ($aField['values'] as $value => $label) {
                    if(isset($aField['value']) && !empty($aField['value']) && $aField['value'] !== 'noselection' && $aField['value'] == $value)  {?>
                        <option value="<?php echo $aField['value'] ?>"
                                selected="selected"><?php echo(isset($aField['values'][$aField['value']]) ? $aField['values'][$aField['value']] : MLI18n::gi()->get('ML_LABEL_INVALID')); ?></option>
                    <?php  } else { ?>
                        <option value="<?php echo $value?>"><?php echo $label?></option>
                    <?php
                    }
                }
            } else {
                if(isset($aField['value']) && !empty($aField['value']) && $aField['value'] !== 'noselection')  {?>
                    <option value="<?php echo $aField['value'] ?>"
                            selected="selected"><?php echo(isset($aField['values'][$aField['value']]) ? $aField['values'][$aField['value']] : MLI18n::gi()->get('ML_LABEL_INVALID')); ?></option>
            <?php  } else {?>
            <option value="noselection"><?php echo MLI18n::gi()->get('otto_please_value_search')?></option>

                <?php }
            } ?>

        </select>
    </div>
<?php
    MLSettingRegistry::gi()->addJs('select2/select2.min.js');
    MLSettingRegistry::gi()->addJs('select2/i18n/' . strtolower(MLLanguage::gi()->getCurrentIsoCode() . '.js'));
    MLSetting::gi()->add('aCss', array('select2/select2.min.css'), true);

    $sPostNeeded = '';
    foreach (MLHttp::gi()->getNeededFormFields() as $sKey => $sValue) {
        $sPostNeeded .= "'$sKey' : '$sValue' ,";
    }
    ?>
<script type="text/javascript">
/*<![CDATA[*/
    (function(jqml) {
        if (jqml("#<?php echo $selectid ?>").data('isbrand') == 1) {
            jqml(document).ready(function () {
                jqml.ajax({
                    url: "<?php echo $this->getCurrentURl(array('ajax' => 'true', 'method' => 'GetBrands')) ?>",
                    data: {
                        'ml[brandmatching]': 'PreloadBrandCache',
                    }
                });
                jqml("#<?php echo $selectid ?>").select2({
                    dropdownAutoWidth: true,
                    width: '100%',
                    ajax: {
                        type: 'POST',
                        delay: 250, // wait 250 milliseconds before triggering the request
                        url: "<?php echo $this->getCurrentURl(array('ajax' => 'true', 'method' => 'GetBrands')) ?>",
                        data: function (params) {
                            return {
                                <?php echo $sPostNeeded ?>
                                'ml[brandmatching]': 'GetBrands',
                                'ml[brandmatchingSearch]': params.term,
                                'ml[brandmatchingPage]': params.page || 1,
                                'ml[brandmatchingShopMatchingValue]': jqml("#<?php echo $selectid ?>").data('shopmatchingvalue'),
                                'ml[brandmatchingVariationValue]': jqml("#<?php echo $selectid ?>").data('variationvalue'),
                                'ml[brandmatchingCustomIdentifier]': jqml("#<?php echo $selectid ?>").data('customidentifier'),
                                'ml[brandmatchingExcludeAuto]': jqml("#<?php echo $selectid ?>").data('excludeauto'),
                                'ml[brandmatchingMpAttributeCode]': jqml("#<?php echo $selectid ?>").data('mpattributecode')
                            };
                        },
                        dataType: 'json'
                    }
                });
                var css = jqml("#<?php echo $selectid ?>").data('css')

                // validation error
                if (css === 'error') {
                    jqml("#<?php echo 'select2-'.$selectid.'-container' ?>").addClass('select2__rendered_error');
                    jqml("#<?php echo 'select2-'.$selectid.'-container' ?>").parent().addClass('select2__rendered_error');
                }

                jqml("#<?php echo 'select2-'.$selectid.'-container' ?>").addClass('select2__rendered_matching_fix');
            });
        }
    })(jqml);
/*]]>*/
</script>
<?php }
