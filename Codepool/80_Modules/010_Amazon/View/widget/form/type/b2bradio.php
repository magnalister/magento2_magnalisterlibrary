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

 if (!class_exists('ML', false))
     throw new Exception();

$enabled = isset($aField['value']) ? $aField['value'] : 'false';
if (!isset($aField['values']) && isset($aField['i18n']['values'])) {
    $aField['values'] = $aField['i18n']['values'];
}
$aField['type'] = 'radio';
$this->includeType($aField);
?>
<script>
    (function ($) {
        function enableB2b(enable, cls) {
            jqml(cls).parent().find('input, select, button').prop('disabled', !enable);
            jqml(cls).closest('div.duplicate').find('button').prop('disabled', !enable);
            let style;
            if (!enable) {
                style = {
                    color: '#6d6d6d'
                }
            } else {
                style = {
                    color: 'unset',
                }
            }
            jqml(cls).closest('tr').css(style);
            // color #6D6D6D  to all elements as css class .disabled
        }

        function showMessage(message) {
            jqml('<div class="ml-modal dialog2" title="<?php echo addslashes($aField['i18n']['label']) ?>"></div>').html(message)
                .jDialog({
                    width: (window.innerWidth > 1000) ? '580px' : '500px',
                });
        }

        jqml('#<?php echo $aField['id'].'_true'; ?>').click(function() {
            <?php if (isset($aField['disable'])) { ?>
                showMessage('<?php echo str_replace("\n", ' ', addslashes($aField['i18n']['disabledNotification'])) ?>');
                jqml('#<?php echo $aField['id'].'_false'; ?>').click();
            <?php } else { ?>
                showMessage('<?php echo str_replace("\n", ' ', addslashes($aField['i18n']['notification'])) ?>');
                enableB2b(true, '.js-b2b');
                jqml('#<?php echo str_replace('active', 'discounttype', $aField['id']); ?>').change();
            <?php } ?>
        });

        jqml('#<?php echo $aField['id'].'_false'; ?>').click(function() {
            enableB2b(false, '.js-b2b');
        });

        <?php if ($enabled === 'false') { ?>
            jqml(document).ready(function() {
                enableB2b(false, '.js-b2b');
            });
        <?php } ?>
    })(jqml);
</script>
