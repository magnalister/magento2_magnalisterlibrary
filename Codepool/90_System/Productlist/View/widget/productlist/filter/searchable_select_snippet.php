<?php
/* @var $this  ML_Productlist_Controller_Widget_ProductList_Abstract */
/* @var $aFilter array array('name'=>'', 'value'=>'', 'values'=>array('value'=>'','label'=>'translatedText'), 'placeholder'=>'') */
if (!class_exists('ML', false))
    throw new Exception();
?>
<?php if ($this instanceof ML_Productlist_Controller_Widget_ProductList_Abstract) {
    $selectid = str_replace(array(']', '['), '', MLHttp::gi()->parseFormFieldName('filter[' . $aFilter['name'] . ']'));
    ?>
    <div class='ml-searchable-select' lang="<?php echo strtolower(MLLanguage::gi()->getCurrentIsoCode()); ?>" >
        <select id="<?php echo $selectid ?>" name="<?php echo MLHttp::gi()->parseFormFieldName('filter[' . $aFilter['name'] . ']') ?>">
            <?php foreach ($aFilter['values'] as $aValue) {?>
                <option value="<?php echo $aValue['value'] ?>"<?php echo $aFilter['value'] == $aValue['value'] ? ' selected="selected"' : '' ?>><?php echo $aValue['label'] ?></option>
            <?php }?>
        </select>
    </div>
<?php
MLSettingRegistry::gi()->addJs('select2/select2.min.js');
    MLSettingRegistry::gi()->addJs('select2/i18n/' . strtolower(MLLanguage::gi()->getCurrentIsoCode() . '.js'));
    MLSetting::gi()->add('aCss', array('select2/select2.min.css'), true);
    MLSetting::gi()->add('aCss', array('fix-select2.css?%s'), true);
    ?>
<script type="text/javascript">
/*<![CDATA[*/
    (function($) {
        $(document).ready(function() {
            $.ajax({
                url : "<?php echo $this->getCurrentURl(array('ajax' => 'true', 'method' => 'dependency' , 'dependency' => 'categoryfilter')) ?>",
                data: {
                    'ml[categoryfilter]' : 'PreloadCategoryCache',
                }
            });

            $("#<?php echo $selectid ?>").select2({
                ajax: {
                    delay: 250, // wait 250 milliseconds before triggering the request
                    url : "<?php echo $this->getCurrentURl(array('ajax' => 'true', 'method' => 'dependency' , 'dependency' => 'categoryfilter')) ?>",
                    data: function (params) {
                        return {
                            'ml[categoryfilter]' : 'GetCategories',
                            'ml[categoryfilterSearch]': params.term,
                            'ml[categoryfilterPage]': params.page || 1,
                        };
                    },
                    dataType: 'json'
                    // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
                }
            });
        });
    })(jqml);
/*]]>*/
</script>
<?php }