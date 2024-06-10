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
?>
<?php foreach ($aField['values'] as $sKey => $sValue) { ?>
<input <?php echo array_key_exists('cssclasses', $aField) ? 'class="'.implode(' ', $aField['cssclasses']).'" ' : '' ?>id="<?php echo $aField['id'].'_'.$sKey; ?>" <?php echo ($aField['value']==$sKey ? 'checked="checked"' :'' );?>type="radio" value="<?php echo $sKey ?>" name="<?php echo MLHttp::gi()->parseFormFieldName($aField['name']); ?>" />
    <label for="<?php echo $aField['id'].'_'.$sKey; ?>"><?php echo $sValue; ?></label>
<?php } ?>
<?php if (isset($aField['i18n']['alert'])) {
    $oI18n = MLI18n::gi();
    if(is_array($aField['i18n']['alert'])){
        $aAlerts = $aField['i18n']['alert'];
    } else {
        $aAlerts = array($aField['alertvalue'] => $aField['i18n']['alert']);
    }
    foreach ($aAlerts as $sKey => $sAlert){
            ?>
    <script type="text/javascript">/*<![CDATA[*/
        (function ($) {
            $(document).ready(function () {
                $('<?php echo '#' . $aField['id']. '_'.$sKey ?>').click(function (event, rec) {
                    if (typeof rec !== 'undefined' && rec) {
                        return true;
                    } else {
                        var blProp = $(this).prop('checked');//actual state
                        if (!blProp) {
                            return true;
                        } else {
                            var checkbox = $(this);
                            // wrap modal content in div to prevent multi modals
                            $('<div></div>').html('<?php echo str_replace(array("\n", "\r","'"), array('','',"\\'"), $sAlert); ?>').dialog({
                                modal: true,
                                width: '600px',
                                buttons: {
                                    "<?php echo str_replace('"', '\"', $oI18n->ML_BUTTON_LABEL_ABORT); ?>": function () {
                                        $(this).dialog("close");
                                    },
                                    "<?php echo str_replace('"', '\"', $oI18n->ML_BUTTON_LABEL_OK); ?>": function () {
                                        $(this).dialog("close");
                                        checkbox.trigger('click', true);
                                    }
                                }
                            });
                            return false;
                        }
                    }
                });
            });
        })(jqml);
        /*]]>*/</script>
<?php
    }
}

// custom modal
if (isset($aField['i18n']['modal'])) {
    $aMyField = $aField;
    $aMyField['type'] = 'radio_modal';
    $this->includeType($aMyField);
}
