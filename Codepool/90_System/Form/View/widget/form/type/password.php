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
<?php
$blHasValue = isset($aField['value']) && !empty($aField['value']);
?>
<input 
    class="fullwidth<?php echo ((isset($aField['required']) && empty($aField['value']))? ' ml-error' : '') . (isset($aField['cssclasses']) ? ' ' . implode(' ', $aField['cssclasses']) : ''); ?>"
    autocomplete="off" type="password" id="<?php echo $aField['id']; ?>_placeholder"  <?php echo $blHasValue ? 'placeholder="'.MLI18n::gi()->get('ML_LABEL_SAVED').'" ' : ''; ?> value="" />
<input type="hidden" id="<?php echo $aField['id']; ?>" name="<?php echo MLHttp::gi()->parseFormFieldName($aField['name']) ?>" <?php echo $blHasValue ? 'value="__saved__" ' : ''; ?> />
<script type="text/javascript">/*<![CDATA[*/
    jqml(document).ready(function () {
        jqml('#<?php echo $aField['id'].'_placeholder' ?>').on('change',
            function () {
                jqml('#<?php echo $aField['id'] ?>').val(jqml(this).val());
            });

    });
/*]]>*/</script>