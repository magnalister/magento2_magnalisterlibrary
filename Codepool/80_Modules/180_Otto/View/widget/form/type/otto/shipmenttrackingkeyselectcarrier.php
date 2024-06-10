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
 if (!class_exists('ML', false))
     throw new Exception();
$sDataMlAlert =
    (
        isset($aField['i18n']) && is_array($aField['i18n']) && array_key_exists('alert', $aField['i18n'])
        && is_array($aField['i18n']['alert'])
        && !empty($aField['i18n']['alert'])
    )
    ? json_encode(array(
        'abort' => MLI18n::gi()->get('ML_BUTTON_LABEL_ABORT'),
        'ok' => MLI18n::gi()->get('ML_BUTTON_LABEL_OK')
    ))
    : ''
;
$blMultiple = array_key_exists('multiple', $aField) && $aField['multiple'];

if(isset($aField['i18n']['firstoption']) && is_array($aField['i18n']['firstoption'])){
    $aField['values'] = $aField['i18n']['firstoption'] + $aField['values'];
}
?>
<select <?php echo $blMultiple ? 'multiple="multiple" size="12" ' : ''; ?><?php echo (isset($aField['cssclasses']) ? '' . 'class="'.implode(' ', $aField['cssclasses']).'"' : ' ') ?><?php echo empty($sDataMlAlert) ? '' : "data-ml-alert='".$sDataMlAlert."' " ?> name="<?php echo empty($aField['name']) ? '' : MLHttp::gi()->parseFormFieldName($aField['name']);?><?php echo $blMultiple ? '[]' : ''; ?>" <?php echo isset($aField['id']) ? 'id="'.$aField['id'].'"' : uniqid('autoprefix-option')?>
                <?php
                    if (!array_key_exists('value', $aField) || empty($aField['value'])) {
                        $blValueExists = true;
                    } else {
                        $blValueExists = false;
                        $aNoNestedValues = array();
                        foreach (array_key_exists('values', $aField) ? $aField['values'] : array() as$sOptionKey => $sOptionValue) {
                            if (is_array($sOptionValue)) {
                                foreach (array_keys($sOptionValue) as $sCurrentOptionValue) {
                                    $aNoNestedValues[] = $sCurrentOptionValue;
                                }
                            } else {
                                $aNoNestedValues[] = $sOptionKey;
                            }
                        }
                        foreach ((array)$aField['value'] as $sCurrentValue) {
                            if (in_array($sCurrentValue, $aNoNestedValues)) {
                                $blValueExists = true;
                                break;
                            }
                        }
                    }
                    if (
                        isset($aField['cssclass'])
                        || (isset($aField['required']) && empty($aField['value']))
                        || !$blValueExists
                    ) {
                        echo 'class="';
                        echo isset($aField['cssclass']) ? (is_array($aField['cssclass'])? implode(' ', $aField['cssclass']):$aField['cssclass']) : '';
                        if (
                            (isset($aField['required']) && empty($aField['value']))
                            || !$blValueExists
                        ) {
                            echo isset($aField['cssclass']) ? ' ' : '';
                            echo 'ml-error';
                        }
                        echo '"';
                    }
                ?>
        style="width:100%;" class="<?php echo !empty($aField['class']) ? $aField['class'] : '' ?>">
    <?php
        if (!$blValueExists) {
            ?><option selected="selected" disabled="disabled" value="<?php echo $aField['value']; ?>"><?php echo MLI18n::gi()->get('ML_LABEL_INVALID'); ?></option><?php
        }
        $aField['type']='select_optgroup';
        $this->includeType($aField);
    ?>
</select>
<?php
    if (!empty($sDataMlAlert)) {
        MLSettingRegistry::gi()->addJs('jquery.magnalister.form.select.js');
    }
?>

<script type="text/javascript">//<![CDATA[
    (function (jqml) {
        jqml(document).ready(function () {
        jqml( "#otto_config_order_field_shipmenttrackingkeyselectcarrier" ).change( returnTrackingKeyAutoAlert );

        function returnTrackingKeyAutoAlert() {
            var selectedValue = jqml( "#otto_config_order_field_shipmenttrackingkeyselectcarrier" ).val();

            if (selectedValue == 'auto') {
                var eModal = jqml('<div title="<?php echo MLI18n::gi()->get('otto_config_account_orderimport_returntrackingkey_title'); ?>"><p style="color: #727273"><?php echo MLI18n::gi()->get('otto_config_account_orderimport_returntrackingkey_info'); ?></p><a class="ml-downloadshippinglabel" target="_blank" href="#"></a></div>');
                    eModal.dialog({
                        modal: true,
                        width: '500px',
                        buttons: [
                            {
                                text: "OK",
                                click: function () {
                                    jqml(this).dialog("close");
                                    return false;
                                }
                            }
                        ]
                    });
                }
            }
        });
})(jqml);
//]]></script>
