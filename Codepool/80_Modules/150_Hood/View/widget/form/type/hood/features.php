<?php
 if (!class_exists('ML', false))
     throw new Exception();
?>
<div style="display: table-row;">
    <?php
    foreach (array(
                 "boldtitle",
                 "backgroundcolor",
                 "gallery",
                 "category",
                 "homepage",
                 "homepageimage",
                 "xxlimage",
                 "noads"
             ) as $sKey
    ) {
        $aFeature['type'] = 'bool';
        $aFeature['id'] = 'features_'.$sKey;
        $aFeature['name'] = $aField['name'].'['.$sKey.']';
        $aFeature['i18n']['valuehint'] = MLI18n::gi()->{'hood_prepare_features__'.$sKey};
        $aFeature['htmlvalue'] = $sKey;
        $aFeature['value'] = isset($aField['value'][$sKey]) ? $aField['value'][$sKey] : '';
        ?>
        <?php $this->includeType($aFeature); ?>
        <br>
        <?php
    }
    ?>
</div>