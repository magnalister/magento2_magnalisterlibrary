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
 * (c) 2010 - 2024 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

if (!class_exists('ML', false)) {
    throw new Exception();
}

/**
 * One Model per defined value or all values will be created (may there are radiobuttons)
 *
 * @var array $aField
 */

if (!isset($aField['i18n']['modal'])) {
    return;
} elseif (empty($aField['i18n']['modal'])) {
    MLMessage::gi()->addDebug('Missing modal data for: '.$aField['id']);
}

?>
<script type="text/javascript">/*<![CDATA[*/
    function modalGenerateDialog(id) {
        const specificRadioButton = document.getElementById(id);
        const radioButtons = document.getElementsByName(specificRadioButton.name);
        let oldCheckedValue = null;

        // Speichern des ursprünglichen ausgewählten Werts
        radioButtons.forEach(radioButton => {
            if (radioButton.checked) {
                oldCheckedValue = radioButton.value;
            }
        });

        specificRadioButton.addEventListener('change', function() {
            // Open the modal dialog
            jqml('#modal-'+id).jDialog({
                buttons: {
                    "<?php echo MLI18n::gi()->get('ML_BUTTON_LABEL_ABORT'); ?>" : function() {
                        // If the user clicks "Abort", reset the radio button to its old value
                        radioButtons.forEach(radioButton => {
                            if (radioButton.value === oldCheckedValue) {
                                radioButton.checked = true;
                            }
                        });
                        jqml( this ).dialog( "close" );
                    },
                    "<?php echo MLI18n::gi()->get('ML_BUTTON_LABEL_OK'); ?>" : function() {
                        oldCheckedValue = this.value;
                        jqml( this ).dialog( "close" );
                    }
                }
            });
        });

    }
/*]]>*/</script>
<?php

$modal = $aField['i18n']['modal'];

if (!is_array($modal)) {
    $aField['values']['undefined'] = $modal;
}

foreach ($aField['values'] as $key => $content) {
    if (array_key_exists($key, $modal)) {
        $idName = $aField['id'].'_'.$key;
        if ($key == 'undefined') {
            $idName = $aField['id'];
        }
        ?>
        <div class="ml-modal dialog2" id="modal-<?php echo $idName; ?>" title="<?php echo $aField['i18n']['label']; ?>">
            <?php echo $modal[$key]; ?>
        </div>
        <script type="text/javascript">/*<![CDATA[*/
            (function ($) {
                $(document).ready(function () {
                    modalGenerateDialog('<?php echo $idName; ?>')
                });
            })(jqml);
        /*]]>*/</script>
        <?php
    }
}

?>
