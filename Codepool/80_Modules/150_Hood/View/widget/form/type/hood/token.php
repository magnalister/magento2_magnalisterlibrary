<?php
 if (!class_exists('ML', false))
     throw new Exception();

$expires = '';
try {
    $expires .= MLModul::gi()->getConfig('token.expires');
    $firstToken = '';
    if (!empty($expires)) {
        if (is_numeric($expires))
            $expires = sprintf(ML_HOOD_TEXT_TOKEN_EXPIRES_AT, date('d.m.Y H:i:s', $expires));
        else
            $expires = sprintf(ML_HOOD_TEXT_TOKEN_EXPIRES_AT, date('d.m.Y H:i:s', unix_timestamp($expires)));
    } else {
        $firstToken = ' action';
    }
} catch (Exception $oExc) {

}
?>
<input class="mlbtn<?php echo $firstToken ?> action" type="button" value="<?php echo $this->__('ML_HOOD_BUTTON_TOKEN_NEW') ?>" id="requestToken"/>
<?php echo $expires ?>
<script type="text/javascript">/*<![CDATA[*/
    jqml(document).ready(function () {
        jqml('#requestToken').click(function () {
            jqml.blockUI(blockUILoading);
            jqml.ajax({
                'method': 'get',
                'url': '<?php echo MLHttp::gi()->getCurrentUrl(array('what' => 'GetTokenCreationLink', 'kind' => 'ajax')) ?>',
                'success': function (data) {
                    jqml.unblockUI();

                    try {
                        var data = $.parseJSON(data);
                    } catch (e) {
                    }
                    myConsole.log('ajax.success', data);
                    if (data == 'error') {
                        jqml('<div></div>')
                            .attr('title', '<?php echo $this->__s('ML_HOOD_ERROR_CREATE_TOKEN_LINK_HEADLINE', array('\'', "\n", "\r")) ?>')
                            .html('<?php echo $this->__s('ML_HOOD_ERROR_CREATE_TOKEN_LINK_TEXT', array('\'', "\n", "\r"));  ?>')
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
