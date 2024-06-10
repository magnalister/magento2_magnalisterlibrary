<?php
if (!class_exists('ML', false))
    throw new Exception(); ?>
<div>
    <div style="display: inline-block;width: 85%;vertical-align: sub;">
        <?php

        $aField['type'] = 'select';
        $this->includeType($aField);

        ?>
    </div>

    <div style="display: inline-block;float:right">
        <button type="button" value="newstore" id="amazon_prepare_config_bopis_add" class="mlbtn ml-js-noBlockUi action" name="ml[action][add]">
            +
        </button>

        <?php if (MLRequest::gi()->data('storeindex') !== null) { ?>

            <button type="submit" value="deletestore" id="amazon_prepare_config_bopis_remove" class="mlbtn ml-js-noBlockUi action" name="ml[action][deletestoreaction]">
                -
            </button>
        <?php } ?>
    </div>
</div>
<script type="text/javascript">
    jqml(document).ready(function () {
        var searchParams = new URLSearchParams(window.location.search)
        if (!searchParams.has('ml[storeindex]')) {
            jqml('.ml-bopisStoreForm').parent().parent().parent().parent().parent().children('tr').each(function (index) {
                // never hide the first one
                if (index > 1) {
                    jqml(this).hide();
                    jqml(this).find("[name^='ml[field][bopis.array']").each(function (){
                        jqml(this).attr('disabled', true);
                    });
                }
            });
        }
        jqml('#amazon_config_bopis_field_bopis_stores').change(function () {
            if (jqml(this).val() === '') {
                window.location.href = '<?php echo MLHttp::gi()->getCurrentUrl() ?>'
            } else {
                window.location.href = '<?php echo MLHttp::gi()->getCurrentUrl() ?>&ml[storeindex]=' + jqml(this).val()
            }
        });
        jqml('#amazon_prepare_config_bopis_add').click(function (event) {
            jqml('#amazon_config_bopis_field_bopis_stores').val('');
            event.preventDefault();
            jqml('.ml-bopisStoreForm').parent().parent().parent().parent().parent().children('tr').each(function (index) {
                // never hide the first one
                if (index > 1) {
                    jqml(this).show();
                    jqml(this).find("[name^='ml[field][bopis.array']").each(function (){
                        jqml(this).attr('disabled', false);
                    });
                }
            });
        });
    });
</script>
