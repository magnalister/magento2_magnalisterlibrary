<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $aField array array('name'=>'', 'value'=>'', 'values'=>array('key'=> 'value'), 'shopMatchingValue'=>'') */
 if (!class_exists('ML', false))
     throw new Exception();
?>
<?php if (isset($aField)) {
    $selectid = uniqid('autoprefix-option');
    ?>
    <div style="width: 100%" class='ml-searchable-select' lang="<?php echo strtolower(MLLanguage::gi()->getCurrentIsoCode()); ?>" >
        <select style="width: 100%"
                class="<?php echo isset($aField['shopBrand']) ? $aField['shopBrand'] : ''; ?>"
                data-css="<?php echo isset($aField['cssclass']) ? $aField['cssclass'] : ''; ?>"
                data-shopmatchingvalue="<?php echo isset($aField['shopMatchingValue']) ? $aField['shopMatchingValue'] : ''; ?>"
                data-variationvalue="<?php echo isset($aField['variationValue']) ? $aField['variationValue'] : ''; ?>"
                data-customidentifier="<?php echo isset($aField['customIdentifier']) ? $aField['customIdentifier'] : ''; ?>"
                data-mpattributecode="<?php echo isset($aField['mpAttributeCode']) ? $aField['mpAttributeCode'] : ''; ?>"
                name="<?php echo empty($aField['name']) ? '' : MLHttp::gi()->parseFormFieldName($aField['name']);?>"
            <?php echo 'id="'.$selectid.'"'?>>
            <optgroup label="Possible Values">
                <?php foreach ($aField['values'] as $aKey => $aValue) {?>
                    <option style="padding: 5px 0;" <?php if($aKey == 'freetext') echo "disabled='disabled'"; ?> value="<?php echo $aKey ?>" <?php echo $aField['value'] == $aKey ? ' selected="selected"' : '' ?> > <?php echo $aValue ?></option>
                <?php }?>
            </optgroup>
        </select>
    </div>
<?php
    MLSettingRegistry::gi()->addJs('select2/select2.min.js');
    MLSettingRegistry::gi()->addJs('select2/i18n/' . strtolower(MLLanguage::gi()->getCurrentIsoCode() . '.js'));
    MLSetting::gi()->add('aCss', array('select2/select2.min.css'), true);
    ?>
<script type="text/javascript">
/*<![CDATA[*/
    (function(jqml) {
        jqml(document).ready(function() {
            jqml("#<?php echo $selectid ?>").select2({minimumResultsForSearch: Infinity});
            jqml("#<?php echo 'select2-' . $selectid . '-container' ?>").addClass('select2__rendered_matching_selected_brand_fix');
        });
    })(jqml);
/*]]>*/
</script>

<style>
    .select2__rendered_matching_selected_brand_fix::before {
        background-image: none !important;
        width: 0 !important;
    }
</style>

<?php }
