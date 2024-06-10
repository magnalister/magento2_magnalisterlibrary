<?php
/**
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
 * (c) 2010 - 2019 RedGecko GmbH -- http://www.redgecko.de
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
        if (is_numeric($expires)) {
            $expires = sprintf(ML_GOOGLESHOPPING_TEXT_TOKEN_EXPIRES_AT, date('d.m.Y H:i:s', $expires));
        } else {
            $expires = sprintf(ML_GOOGLESHOPPING_TEXT_TOKEN_EXPIRES_AT, date('d.m.Y H:i:s', unix_timestamp($expires)));
        }
    } else {
        $firstToken = ' action';
    }
} catch (Exception $oExc) {
}

?>

<input class="mlbtn<?php echo $firstToken ?> action" type="button" value="<?php echo $this->__('ML_GOOGLESHOPPING_BUTTON_TOKEN_NEW') ?>" id="requestToken"/>
<?php echo $expires ?>
<script type="text/javascript">/*<![CDATA[*/
    jqml(document).ready(function () {
        jqml('#requestToken').click(function () {
            var clientId = jqml('#googleshopping_config_account_field_clientid').val();
            var clientSecret = jqml('#googleshopping_config_account_field_clientsecret').val();
            jqml.blockUI(blockUILoading);
            var url =  '<?php echo MLHttp::gi()->getCurrentUrl(array(
                'what' => 'GetTokenCreationLink',
                'kind' => 'ajax',
                'client_id' => "{{client_id}}",
                'client_secret' => "{{client_secret}}",
            )) ?>';

            jqml.ajax({
                'method': 'get',
                'url': url
                    .replace('{{client_id}}', clientId)
                    .replace('{{client_secret}}', clientSecret),

                'success': function (data) {
                    jqml.unblockUI();
                    try {
                        var data = $.parseJSON(data);
                    } catch (e) {
                    }
                    myConsole.log('ajax.success', data);
                    if (data == 'error') {
                        jqml('<div></div>')
                            .attr('title', '<?php echo $this->__s('ML_GOOGLESHOPPING_ERROR_CREATE_TOKEN_LINK_HEADLINE', array('\'',"\n","\r")) ?>')
                            .html('<?php echo  $this->__s('ML_GOOGLESHOPPING_ERROR_CREATE_TOKEN_LINK_TEXT', array('\'',"\n","\r"));  ?>')
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
