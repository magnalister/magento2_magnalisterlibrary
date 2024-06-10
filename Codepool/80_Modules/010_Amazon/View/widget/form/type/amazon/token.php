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
 * (c) 2010 - 2022 RedGecko GmbH -- http://www.redgecko.de
 *     Released under the MIT License (Expat)
 * -----------------------------------------------------------------------------
 */
 if (!class_exists('ML', false))
     throw new Exception();

$expires = '';
try {
    $expires .= MLModule::gi()->getConfig('token.expires');
    $firstToken = '';
    if (!empty($expires)) {
        if (is_numeric($expires))
            $expires = sprintf($this->__('ML_AMAZON_TEXT_TOKEN_EXPIRES_AT'), date('d.m.Y H:i:s', $expires));
        else
            $expires = sprintf($this->__('ML_AMAZON_TEXT_TOKEN_EXPIRES_AT'), date('d.m.Y H:i:s', unix_timestamp($expires)));
    } else {
        $firstToken = ' action text';
    }
} catch (Exception $oExc) {

}
?>
<input class="mlbtn<?php echo $firstToken ?> action" type="button" value="<?php echo $this->__('ML_AMAZON_BUTTON_TOKEN_NEW') ?>" id="requestToken"/>
<?php echo $expires ?>
<div id="js-ml-modal-stockWarning" style="display:none;" title="<?php echo MLI18n::gi()->get('amazon_config_how_to_authorize_magnalister_header'); ?>">
    <?php echo MLI18n::gi()->get('amazon_config_how_to_authorize_magnalister_body'); ?>
</div>
<script type="text/javascript">/*<![CDATA[*/
    (function (jqml) {
        jqml('#requestToken').click(function () {
            var eModal = jqml('#js-ml-modal-stockWarning');
            eModal.dialog({
                modal: true,
                width: '600px',
                buttons: [
                    {
                        text: "<?php echo $this->__('ML_BUTTON_LABEL_ABORT'); ?>",
                        click: function () {
                            jqml(this).dialog("close");
                            return false;
                        }
                    },
                    {
                        text: "<?php echo $this->__('ML_BUTTON_LABEL_OK'); ?>",
                        click: function () {
                            jqml(this).dialog("close");
                            openIframe();
                            return false;
                        }
                    }
                ]
            });

            function openIframe() {
                jqml.blockUI(blockUILoading);
                var site = jqml("#amazon_config_account_field_site").val()
                jqml.ajax({
                    'method': 'get',
                    'data': {
                        "<?php echo MLHttp::gi()->parseFormFieldName('site'); ?>": site,
                    },
                    'url': '<?php echo MLHttp::gi()->getCurrentUrl(array('method' => 'GetTokenCreationLink', 'kind' => 'ajax')) ?>',
                    'success': function (data) {
                        jqml.unblockUI();
                        let error = false;
                        try {
                            data = jqml.parseJSON(data);
                            console.log(data)
                        } catch (e) {
                            console.log(e);
                            error = true;
                        }
                        if (error || data.error+'' !== '') {
                            console.log('<?php echo MLHttp::gi()->getCurrentUrl(array('method' => 'GetTokenCreationLink', 'kind' => 'ajax')) ?>')
                            jqml('<div></div>')
                                .attr('title', '<?php echo $this->__s('ML_AMAZON_ERROR_CREATE_TOKEN_LINK_HEADLINE', array('\'', "\n", "\r")) ?>')
                                .html('<?php echo $this->__s('ML_AMAZON_ERROR_CREATE_TOKEN_LINK_TEXT', array('\'', "\n", "\r"));  ?>')
                                .jDialog();
                        } else {
                            var hwin = window.open(data.iframeUrl, "popup", "resizable=yes,scrollbars=yes");
                            if (hwin.focus) {
                                hwin.focus();
                            }
                        }
                    }
                });
            }
        });
    })(jqml);
    /*]]>*/</script>