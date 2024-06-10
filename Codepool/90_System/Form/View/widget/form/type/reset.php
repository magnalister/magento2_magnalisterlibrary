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
/* @var $this ML_Form_Controller_Widget_Form_Abstract */
/* @var $aField array */
if (!class_exists('ML', false))
    throw new Exception();
?>
<button type="button" class="mlbtn ml-js-config-reset" id="">
    <?php echo $aField['i18n']['label'] ?>
</button>
<script type="text/javascript">/*<![CDATA[*/
    jqml(document).ready(function () {
            jqml('.mlbtn.ml-js-config-reset').on('click', function () {
                jqml('.ml-js-field-resetdefault').each(function () {
                    var sElmentId = jqml(this).attr('id').replace(/_resetdefault/g, "");
                    var oElement = jqml('#' + sElmentId);
                    oElement.val(jqml(this).val());
                    if (oElement.hasClass('tinymce') && typeof tinyMCE !== 'undefined' && typeof tinyMCE.get(sElmentId) !== null) {
                        tinyMCE.get(sElmentId).setContent(oElement.val());
                    }
                });
            });
        });
/*]]>*/</script>