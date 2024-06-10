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

/* @var $aFilter array array('name'=>'', 'value'=>'', 'values'=>array('value'=>'','label'=>'translatedText'), 'placeholder'=>'') */

 if (!class_exists('ML', false))
     throw new Exception();
?>
<?php if (isset($aFilter)) {
    $selectid = str_replace(array(']', '['), '', MLHttp::gi()->parseFormFieldName('filter[' . $aFilter['name'] . ']'));
    ?>
    <div class='ml-searchable-select ml-category-selecr2-search' lang="<?php echo strtolower(MLLanguage::gi()->getCurrentIsoCode()); ?>" >
        <select id="<?php echo $selectid ?>" name="<?php echo MLHttp::gi()->parseFormFieldName('filter[' . $aFilter['name'] . ']') ?>">
            <option selected disabled>
                <i class="select2-search-image"></i> Kategorie-Suche
            </option>
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
    (function(jqml) {
        jqml(document).ready(function() {

            jqml.ajax({
                url : "<?php echo $this->getCurrentURl(array('ajax' => 'true', 'method' => 'dependency' , 'dependency' => 'categoryfilter')) ?>",
                data: {
                    'ml[categoryfilter]' : 'PreloadCategoryCache',
                }
            });

            jqml("#<?php echo $selectid ?>").select2({
                ajax: {
                    delay: 250, // wait 250 milliseconds before triggering the request
                    url : "<?php echo $this->getCurrentURl(array('ajax' => 'true', 'method' => 'GetCategories')) ?>",
                    data: function (params) {
                        return {
                            'ml[categoryfilter]' : 'GetCategories',
                            'ml[categoryfilterSearch]': params.term,
                            'ml[categoryfilterPage]': params.page || 1,
                        };
                    },
                    dataType: 'json'
                }
            });
        });
    })(jqml);
/*]]>*/
</script>

<?php }
