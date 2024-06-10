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
 * (c) 2010 - 2020 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */

if (!class_exists('ML', false)) {
    throw new Exception();
}
/**
 * @var array $aField
 */
?>
<input class="mlbtn action text" type="button" value="<?php echo MLI18n::gi()->get('ML_BUTTON_TOKEN_NEW'); ?>" id="requestToken<?php echo $aField['id']?>"/>
<script type="text/javascript">/*<![CDATA[*/
    jqml(document).ready(function () {
        jqml('#requestToken<?php echo $aField['id']?>').click(function () {
            jqml.blockUI(blockUILoading);
            jqml.ajax({
                'method': 'get',
                'url': '<?php echo MLHttp::gi()->getCurrentUrl(array('what' => $aField['realname'], 'kind' => 'ajax')) ?>', 
                'success': function (data) {
                    jqml.unblockUI();
                    try {
                        var data = $.parseJSON(data);
                    } catch (e) {
                    }
                    if (data == 'error') {
                        jqml('<div></div>')
                            .attr('title', '<?php echo $this->__s('ML_ERROR_CREATE_TOKEN_LINK_HEADLINE',array('\'',"\n","\r")) ?>')
                            .html('<?php echo  $this->__s('ML_ERROR_CREATE_TOKEN_LINK_TEXT',array('\'',"\n","\r"));  ?>')
                            .jDialog();
                    } else {
                        var hwin = window.open(data, "popup", "resizable=yes,scrollbars=yes");
                        if (hwin.focus) {
                            hwin.focus();
                        }
                    }
                }
            });
        });
    });
    /*]]>*/</script>
