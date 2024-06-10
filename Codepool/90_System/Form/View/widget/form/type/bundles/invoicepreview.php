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

<input class="mlbtn" type="button" value="<?php /** @var array $aField */
echo $aField['i18n']['buttontext'] ?>" id="invoice_preview"
    <?php echo((isset($aField['disabled']) && $aField['disabled']) ? ' disabled="disabled"' : ''); ?>
/>

<script type="text/javascript">/*<![CDATA[*/
    jqml(document).ready(function () {
        jqml('#invoice_preview').click(function () {
            jqml.blockUI(blockUILoading);
            jqml.ajax({
                'method': 'get',
                'url': '<?php echo MLHttp::gi()->getCurrentUrl(array('method' => 'invoicePreview', 'blAjax' => true)) ?>',
                'success': function (data) {
                    let error = false;
                    jqml.unblockUI();
                    try {
                        data = jqml.parseJSON(data);
                        console.log(data)
                    } catch (e) {
                        console.log(e);
                        error = true;
                    }
                    if (error || data.error + '' !== '') {
                        jqml('<div></div>')
                            .attr('title', '<?php echo $this->__s('ML_ERROR_API', array('\'', "\n", "\r")) ?>')
                            .html('<?php echo $this->__s('ML_ERROR_API', array('\'', "\n", "\r"));  ?>')
                            .jDialog();
                    } else {
                        let hwin = window.open(data.iframeUrl, "_blank");
                        if (hwin.focus) {
                            hwin.focus();
                        }
                    }
                }
            });
        });
    });
    /*]]>*/</script>